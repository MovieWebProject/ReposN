-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 04, 2023 lúc 07:46 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `movie_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `activated` bit(1) DEFAULT b'0',
  `activate_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `firstname`, `lastname`, `email`, `password`, `activated`, `activate_token`) VALUES
('admin', 'minh', 'ngoc', 'minh_m100@yahoo.com', '$2y$10$OH6sd.k1InRwDWGSW/8k3.vnLsMKLois8Bplvb9IWVmSuwH7zN7SK', b'0', 'db889f422df6582d315ea3f87eb09073'),
('minh', 'minh', 'ngoc', 'minh@gmail.com', '$2y$10$cXrJKv4whHv0DTzIULebZOA6OrQObMHRSBsGI1wPYRNhiQI1W5mb2', b'0', '530ff7437c19098490aba94c9114829c'),
('vip', 'vip', 'vip', 'vip@gmail.con', '$2y$10$S0B8QGX2GYCSaZz4ee9M..8kb6UkT8vh2aKQkCfH1Uah.z5.osKmW', b'0', '4bff224400f6214dd7cc21647029ff7f');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` date NOT NULL,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id_comments`, `comment`, `created_at`, `username`, `id_movie`) VALUES
(14, 'hello', '2023-04-27', 'minh@gmail.com', 8),
(15, 'hello\r\n', '2023-04-27', 'minh@gmail.com', 8),
(16, 'mkmkm', '2023-04-27', 'minh@gmail.com', 1),
(17, 'mkmkmk', '2023-04-27', 'minh@gmail.com', 1),
(18, 'oke minh ngọc', '2023-04-27', 'minh@gmail.com', 2),
(19, 'hihi', '2023-04-27', 'vip@gmail.con', 1),
(20, 'cmt đầu :V', '2023-04-27', 'vip@gmail.con', 3),
(21, 'phim hay quá\r\n', '2023-04-28', 'minh@gmail.com', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id_genres` int(11) NOT NULL,
  `genres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `genres`
--

INSERT INTO `genres` (`id_genres`, `genres`) VALUES
(1, 'Comedy'),
(2, 'Adventure'),
(3, 'Horror'),
(4, 'Anime'),
(5, 'sport'),
(6, 'action'),
(7, 'fiction');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_movie`
--

CREATE TABLE `list_movie` (
  `id_movie` int(11) NOT NULL,
  `name_movie` text NOT NULL,
  `img_movie` text NOT NULL,
  `genres` int(11) NOT NULL,
  `time` varchar(50) NOT NULL,
  `actor` text NOT NULL,
  `detail` text DEFAULT NULL,
  `age` text NOT NULL,
  `view` int(11) NOT NULL,
  `link_trailer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `list_movie`
--

INSERT INTO `list_movie` (`id_movie`, `name_movie`, `img_movie`, `genres`, `time`, `actor`, `detail`, `age`, `view`, `link_trailer`) VALUES
(1, 'John Wick 4', 'images/favorite/f1.jpg', 6, '130m', 'Keanu Reeves, Donnie Yen, Bill Skarsgård, Laurence Fishburne', 'Content of the movie Assassin John Wick: Chapter 4 - John Wick: Chapter 4 continues to revolve around the character John Wick this time he has found a way to defeat the High Table. However, the first thing to do now is to be forced to confront new enemies that appear to be powerful allies around the globe, when they turn old friends into enemies of John Wick.', '16+', 515, 'https://www.youtube.com/watch?v=MLXvyqJWQ9A'),
(2, 'Black Adam', 'images/favorite/f2.jpg', 2, '118m', 'Dwayne Johnson, Sarah Shahi, Pierce Brosnan', 'The film tells the story of a man Black Adam who has been imprisoned for nearly 5000 years, now he is given powerful powers by the Egyptian gods, and since then he has been released from captivity. From here, Black Adam took advantage of this power to begin a life of justice unique to this modernized world. Not only that, but he also has to face new vicious enemies.', '5+', 1004, 'https://www.youtube.com/watch?v=XBH5bmXOyUc'),
(3, 'One Piece Film: Red', 'images/favorite/f3.jpg', 4, '115m', 'Mayumi Tanaka, Shuichi Ikeda, Hiroaki Hirata, Ikue Otani', 'One Piece Film Red takes place on the musical island of Elegia, where the world\'s most famous diva named Uta performs her first live performance in public. Uta stood on stage with a simple dream that \"My music will make the world happy\". Behind the image of the singer, whose voice is considered to be on a \"completely different level\" is an extremely mysterious hidden identity. The Straw Hat Pirates and other Uta fans from various powers such as pirates and marines all gathered for this concert. The incident begins as soon as the horrifying truth is revealed that Uta is the \"daughter of Shanks\". Luffy and Uta first reunited after meeting 12 years ago at Foosha Village.', '16+', 305, 'https://www.youtube.com/watch?v=L-aFL-bX1ao'),
(4, 'Babylon', './images/favorite/f4.jpg', 1, '3h9m', 'Brad Pitt, Jean Smart, Margot Robbie', 'A tale of outsized ambition and outrageous excess, it traces the rise and fall of multiple characters during an era of unbridled decadence and depravity in early Hollywood.', '15+', 2011, 'https://www.youtube.com/watch?v=CHcnkZqxbUE'),
(5, 'Doctor Strange', 'images/favorite/f5.jpg', 7, '1h55m', 'Benedict Wong, Elizabeth Olsen, Rachel McAdams, Benedict Cumberbatch, Chiwetel Ejiofor\r\n', 'While on a journey of physical and spiritual healing, a brilliant neurosurgeon is drawn into the world of the mystic arts.', '12+', 10003, 'https://www.youtube.com/watch?v=wwcSki7r9cQ'),
(7, 'The First Slam Dunk', 'images/popular/u1.jpg', 5, '124m', 'Masaya Fukunishi, Yoshiaki Hasegawa, Katsuhisa Hoki, Tetsu Inada, Ryota Iwasaki, Shinichiro Kamio, Mitsuaki Kanuka, Jun Kasama, Subaru Kimura,..', 'The anime adaptation of the popular manga series \"Slam Dunk\" by Takehiko Inoue depicts the personal growth of high school students who dedicate their youth to basketball. The film follows Ryota Miyagi, the defender of the Shohoku high school basketball team. He has an older brother, Sota, who is three years older than him and who inspired his love of basketball. Ryota and his teammates Hanamichi Sakuragi, Takenori Akagi, Hisashi Mitsui and Kaede Rukawa challenge the interscholastic basketball champion, the Sannoh High School basketball team. Original author Inoue is in charge of directing and writing the script.', '0+', 2501, 'https://www.youtube.com/watch?v=kDuiynKxjQU'),
(8, 'Everything Everywhere All at Once', 'images/popular/u2.jpg', 6, '139m', 'Stephanie Hsu, Quan Kế Huy, Dương Tử Quỳnh\r\n\r\n', 'A middle-aged Chinese immigrant woman is caught up in a bizarre adventure. Now, she must save the world alone by exploring other universes and other selves of herself.', '16+', 2, 'https://www.youtube.com/watch?v=wxN1T1uxQ2g'),
(9, 'Nhà Bà Nữ', 'images/popular/u3.jpg', 1, '105m', 'Trấn Thành', 'Ba Nu\'s House revolves around Mrs. Nu\'s family consisting of three generations living together in one house. The one-handed Mrs. Nu is known for her crab cakes and is also notorious for controlling the lives of everyone, from her daughter to her son-in-law. Everything was going normally until the youngest daughter fell in love with a handsome guy from a rich family.', '0+', 4, 'https://www.youtube.com/watch?v=pg4L29p98Kw'),
(10, 'Ant Man 2', 'images/popular/u4.jpg', 7, '118m', 'Michael Douglas, Paul Rudd, Michelle Pfeiffer, Evangeline Lilly\r\n\r\n', 'In the aftermath of \"Captain America: Civil War,\" Scott Lang struggles to balance family life with his responsibilities as Ant-Man. He meets Hope van Dyne and Dr. Hank Pym with an urgent new mission: learn to fight alongside The Wasp to uncover the secrets of their past. See more at: https://www.galaxycine.vn/dat-ve/ant-man-and-the-wasp\r\n\r\nSee more at: https://www.galaxycine.vn/dat-ve/ant-man-and-the-wasp', '0+', 0, ''),
(11, 'SHAZAM 2', 'images/popular/u5.jpg', 1, '130m', 'Zachary Levi, Asher Angel, Jack Dylan Grazer', 'Shazam! Wrath Of The Gods - Shazam! Fury of the Gods revolves around the return of the \"boy\" superhero Shazam no longer believes in himself, because he thinks he is just a kid, not majestic, brave like other superheroes like The Flash is as fast as the top, or as tall as Aquanman, or as smart as Batman, .. Because Shazam is just a boy hiding in the body of a tall, clumsy superhero who lacks control of his supernatural abilities. me. However, this time, to save the world, Shazam was really angry to punish the evil forces 1 lesson.', '0+', 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`) VALUES
(1, 'The Shawshank Redemption', 'Drama'),
(2, 'The Godfather', 'Drama'),
(3, 'The Godfather: Part II', 'Drama'),
(4, 'The Dark Knight', 'Action'),
(5, '12 Angry Men', 'Drama'),
(6, 'Schindler\'s List', 'Drama'),
(7, 'The Lord of the Rings: The Return of the King', 'Fantasy'),
(8, 'Pulp Fiction', 'Crime'),
(9, 'The Lord of the Rings: The Fellowship of the Ring', 'Fantasy'),
(10, 'Forrest Gump', 'Drama'),
(11, 'Inception', 'Action'),
(12, 'The Lord of the Rings: The Two Towers', 'Fantasy'),
(13, 'Star Wars: Episode V - The Empire Strikes Back', 'Sci-Fi'),
(14, 'The Matrix', 'Sci-Fi'),
(15, 'Goodfellas', 'Crime');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`);

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genres`);

--
-- Chỉ mục cho bảng `list_movie`
--
ALTER TABLE `list_movie`
  ADD PRIMARY KEY (`id_movie`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `list_movie`
--
ALTER TABLE `list_movie`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
