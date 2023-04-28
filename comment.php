
<?php
    require_once('db.php');
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $username = $_SESSION['email'];
        $comment = $_POST['comment'];
        $watch = $_GET['watch'];

        // Insert comment into database
        $sql = "INSERT INTO comments (username, comment, created_at, id_movie) VALUES ('$username', '$comment', NOW(), $watch)";
        mysqli_query($conn, $sql);

        // Display comments
        $sql = "SELECT * FROM comments ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<p>" . $row['username'] . ": " . $row['comment'] . "</p>";
                echo "<small>Posted on " . $row['created_at'] . "</small><hr>";

            }
        } else {
            echo "No comments yet.";
        }
        header("location: watch.php?watch=$watch");
    }
?>