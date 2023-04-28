
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movie_web";
    $conn = mysqli_connect($servername , $username,$password, $dbname);
    if(!$conn){
        die("Connect error: ". mysqli_connect_error());
    }
    //Load Composer's autoloader
    function open_database(){
        $conn = new mysqli('localhost' , 'root','', 'movie_web');
        if($conn->connect_error){
            die('Connect error: '. $conn->connect_error);
        }
        return $conn;
    }
    function login($user, $pass){
        $sql = "select * from account where username = ?";
        $conn = open_database();  
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $user);
        if(!$stm->execute()){
            return array('code'=> 1,'error'=> 'Can not execute command');
        }
        $result = $stm->get_result();

        if($result->num_rows == 0){
            return array('code'=> 1,'error'=> 'User does not exists');
        }

        $data = $result->fetch_assoc();
        $hashed_password= $data['password'];
        if(!password_verify($pass, $hashed_password)){
            return array('code'=> 2,'error'=> 'Invalid password');
        }
        // else if($data['activated'] == 0){
        //     return array('code'=>3,'error'=>'This account is not activated');
        // }
        else return 
         array('code'=> 0,'error'=> '', 'data'=>$data);
    }
      
    function is_email_exists($email){
        $sql = 'select username from account where email = ?';
        $conn = open_database();

        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if(!$stm->execute()){
            die('Query error: '.$stm->error);
        }
        $result = $stm->get_result();
        if($result->num_rows>0){
            return true;
        }else   
            return false;
    }

    function register($user, $pass, $first, $last, $email){
        if(is_email_exists($email)){
            return array('code'=> 1,'error'=> 'Email exists');
        }
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = 'insert into account (username, firstname, lastname, email, password, activate_token) values(?,?,?,?,?,?)';
        $rand = random_int(0,1000);
        $token = md5($user. '+'.$rand);
        $conn = open_database();
        $stm = $conn -> prepare($sql);
        $stm->bind_param('ssssss', $user, $first,$last, $email, $hash, $token);

        if(!$stm->execute()){
            return array('code'=> 2, 'error'=>'can not execute command');
        }
        return array('code'=>0,'error'=>'Create account successful');
    }
    function sendActivationEmail($email, $token){


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'admin@gmail.com';                     //SMTP username
            //$mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('admin@gmail.com', 'Admin web');
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($email, 'Người nhận');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Xác minh tài khoản của bạn ';
            $mail->Body    = "Click vào <a href='http://localhost/activative.php?email=$email&token=$token'> </a> để xác minh tài khoản của bạn";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
?>