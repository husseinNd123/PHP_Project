-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2022 at 04:35 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barakatdb`
--

-- -------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`eid`, `user_name`, `password`) VALUES
(1, 'BARAKAT', 'admin'),
(2, 'JOHN', 'password123'),
(3, 'ALICE', 'securePass'),
(4, 'DAVID', '123456'),
(5, 'EMMA', 'password');


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `category_name`) VALUES
(1, 'shoes'),
(5, 'shorts'),
(2, 'shirts'),
(3, 'equipments');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `products` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_name`, `products`) VALUES
(1, 'admin', '35(1)36(1)'),
(2, 'admin', '35(1)36(1)'),
(3, 'admin', '19(2)20(7)'),
(5, 'BARAKAT', '49(5)20(1)19(1)'),
(6, 'BARAKAT', '56(3)54(1)53(3)'),
(7, 'BARAKAT', '18(2)19(1)44(2)'),
(45, 'BARAKAT', '19(2)20(2)53(1)'),
(52, 'BARAKAT', '55(2)20(1)53(1)'),
(53, 'BARAKAT', '20(1)48(1)51(1)'),
(54, 'BARAKAT', '39(3)38(1)44(1)'),
(55, 'BARAKAT', '38(4)53(2)'),
(56, 'BARAKAT', '49(2)'),
(57, 'BARAKAT', '50(2)'),
(58, 'BARAKAT', '52(1)55(2)'),
(59, 'BARAKAT', '55(3)'),
(60, 'user', '51(1)44(2)48(1)');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clicks` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `image`, `price`, `quantity`, `category`, `description`, `clicks`) VALUES
(18, 'DRI-FIT Miler', 'https://i.imgur.com/J276Md6.jpg', 250, 0, 'shirts', '				Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus earum culpa possimus a cum fugit mollitia praesentium iusto perspiciatis recusandae?\n', 4),
(19, 'Nike Gloves', 'https://i.imgur.com/voVb3ks.jpg', 80, 9, 'equipments', '				Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus earum culpa possimus a cum fugit mollitia praesentium iusto perspiciatis recusandae?\n', 14),
(20, 'Bottle XR', 'https://i.imgur.com/ucTChl9.jpg', 20, 21, 'equipments', '				Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus earum culpa possimus a cum fugit mollitia praesentium iusto perspiciatis recusandae?\n', 18),
(36, 'DR-Fit Shirt', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/65824099-3d43-47b4-b7cd-063becb2733b/dri-fit-run-18cm-running-shorts-8nS1Vf.png', 60, 18, 'shorts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos illo accusantium hic numquam. Incidunt sit, quis molestiae quo eveniet alias.\r\n', 2),
(38, 'DR-Fit Shirt', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/611e0006-45a1-4e70-a28e-4e95f6184f0d/dri-fit-woven-training-shorts-2BzdRX.png', 60, 13, 'shorts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos illo accusantium hic numquam. Incidunt sit, quis molestiae quo eveniet alias.\r\n', 9),
(39, 'NBA SHX', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/b0982500-97d1-4220-9b6a-97b6825ac825/team-31-courtside-dri-fit-nba-shorts-ZDfD2w.png', 75, 7, 'shorts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 4),
(40, 'Barca 3RDZ Sh', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/605874d3-0f7f-4e28-b2f9-234143c60673/fc-barcelona-2022-23-stadium-third-dri-fit-football-shorts-H5rB2D.png', 33, 12, 'shorts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 2),
(45, 'AED Special', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/cab65c24-4e05-4218-819f-11c3b171c263/air-max-95-se-shoe-xmjCBF.png', 65, 40, 'shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 2),
(44, 'AirMAx BRT', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/16ac02e4-ad36-4237-a10c-05e1ab9a5fe8/air-max-plus-shoes-NL7sg9.png', 85, 25, 'shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 5),
(46, 'Ebernon Sneaker', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/h4htip4yec6s22sqijex/ebernon-mid-shoes-2bbBFC.png', 70, 25, 'shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 1),
(55, 'Third Gold Ball', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/22d15d87-b630-4e6a-94a8-871d15bc3f74/premier-league-strike-third-football-8M8sVt.png', 145, 23, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 18),
(48, 'Fire AirMax', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/8d584e3e-e2b5-4d19-9e73-174d599055eb/air-max-plus-shoes-6hWChj.png', 110, 16, 'shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 2),
(49, 'Retro Comf', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/d58acf15-2506-40f9-80ed-beff5114392c/retro-gts-shoe-Ld6R4g.png', 150, 3, 'shoes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 10),
(50, 'Camo Shirt', 'https://static.nike.com/a/images/t_PDP_864_v1,f_auto,q_auto:eco/3035c346-792c-458e-9bbf-e44546f96534/dri-fit-camo-training-t-shirt-k3Zt5V.png', 100, 28, 'shirts', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 3),
(51, 'BredZy Cap', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/eb355b32-2195-435c-b824-e6748251566d/nikecourt-aerobill-advantage-tennis-cap-DkCrmZ.png', 50, 28, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 4),
(52, 'Tottenham Socks', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/f7ac33fa-a82d-4f34-9165-e7e93622696b/tottenham-hotspur-2022-23-stadium-home-over-calf-football-socks-VBnPkm.png', 45, 7, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 1),
(53, 'Waistpack XYZ', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/8ed8ca70-2468-4512-bc46-51eec98134f9/heritage-waistpack-q3knRf.png', 35, 23, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 7),
(54, 'Training Duffel Bag', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/5ed1250b-0dea-4124-85a8-c85368098a30/utility-power-training-duffel-bag-BV4ll8.png', 90, 14, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 1),
(56, 'Shingaurds', 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/5c212034-2377-4c7d-91e7-d126e24e96b2/charge-football-shinguards-DB50dZ.png', 50, 0, 'equipments', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam facilis inventore, veritatis laborum repellendus distinctio tempore aliquid sapiente nostrum sunt velit cumque, dolor dolore corporis molestiae earum quae. Hic, ad.\r\n', 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `first_name`, `last_name`, `password`) VALUES
('user', '', '', 'user@');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
