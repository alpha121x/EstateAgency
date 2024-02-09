-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 11:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `user_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `first_name`, `last_name`, `password`, `email`, `user_type`, `user_image`) VALUES
(1, 'abbas.ch', 'Abbas', 'Ch', '123', 'abbasshakor0123@gmail.com', 'admin', 'uploads/abbas.jpeg'),
(2, 'farheen', 'Farheen', 'Imran', '123', 'farheenimran1907@gmail.com', 'agent', 'uploads/agent-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_about` varchar(255) NOT NULL,
  `agent_phone` varchar(255) NOT NULL,
  `agent_email` varchar(255) NOT NULL,
  `agent_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `agent_name`, `agent_about`, `agent_phone`, `agent_email`, `agent_image`) VALUES
(1, 'Abbas ch', 'Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor volutpat.', '923053389495', 'abbasshakor0123@gmail.com', 'uploads/abbas.jpeg'),
(2, 'Farheen Imran', 'Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor volutpat.', '923030303101', 'farheenimran1907@gmail.com', 'uploads/agent-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Abbas', 'abbasshakor0123@gmail.com', 'Test', 'this is test message.'),
(2, 'Abbas', 'abbasshakor0123@gmail.com', 'Test', 'this is test message.'),
(3, 'Ethan Santos', 'xyfasuxoru@mailinator.com', 'Exercitation vero si', 'Ad at quia est Nam d'),
(4, 'Olga Clemons', 'sacyhymun@mailinator.com', 'Aliquid in iure aut ', 'Quod sit odit recusa');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `plot_id`, `is_read`, `created_by`) VALUES
(1, 'New Bid Entered for Plot ID: 2', 'A new bid has been entered by test with email test@gmail.com for Plot ID: 2 with a bid amount of $1000001. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'test'),
(2, 'New Bid Entered for Plot ID: 2', 'A new bid has been entered by test with email test@gmail.com for Plot ID: 2 with a bid amount of $1000001. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'test'),
(3, 'New Bid Entered for Plot ID: 2', 'A new bid has been entered by test1 with email test1@gmail.com for Plot ID: 2 with a bid amount of $100000011. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'test1'),
(4, 'New Bid Entered for Plot ID: 2', 'A new bid has been entered by jyvew with email lopi@mailinator.com for Plot ID: 2 with a bid amount of $67. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, '1'),
(5, 'New Bid Entered for Plot ID: 2', 'A new bid has been entered by hevaja with email wejef@mailinator.com for Plot ID: 2 with a bid amount of $10000000. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'abbas.ch'),
(6, 'New Bid Entered for Plot NO: Array', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot ID: 2 with a bid amount of $10505000. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'Abbas'),
(7, 'New Bid Entered for Plot NO: 102', 'A new bid has been entered by juqitymiq with email fegir@mailinator.com for Plot ID: 2 with a bid amount of $15. <a href=\"#\"><strong>Click here</strong></a> to check the detail', 2, 0, 'juqitymiq'),
(8, 'New Bid Entered for Plot NO: 102', 'A new bid has been entered by luneboz with email rovy@mailinator.com for Plot ID: 2 with a bid amount of $1', 2, 1, 'luneboz'),
(9, 'New Bid Entered for Plot NO: 102', 'A new bid has been entered by jia with email jia@gmail.com for Plot ID: 2 with a bid amount of $1000005', 2, 0, 'jia'),
(10, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by zain with email zain@gmail.com for Plot ID: 4 with a bid amount of $10001111', 4, 0, 'zain'),
(11, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by neziwytoju with email xunajimaho@mailinator.com for Plot ID: 4 with a bid amount of $25', 4, 0, 'neziwytoju'),
(12, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email alpha121xyz@gmail.com for Plot ID: 4 with a bid amount of $10001234', 4, 0, 'Abbas'),
(13, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email alpha121xyz@gmail.com for Plot ID: 4 with a bid amount of $1', 4, 0, 'Abbas'),
(14, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by test with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $1', 4, 0, 'test'),
(15, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by test with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $111', 4, 0, 'test'),
(16, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by test with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $11', 4, 0, 'test'),
(17, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by test with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $12', 4, 0, 'test'),
(18, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $11111', 4, 0, 'Abbas'),
(19, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by admin with email alpha121xyz@gmail.com for Plot ID: 4 with a bid amount of $0123', 4, 0, 'admin'),
(20, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $123456', 4, 0, 'Abbas'),
(21, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by admin with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $12345678', 4, 0, 'admin'),
(22, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by jia with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $121212', 4, 0, 'jia'),
(23, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by admin with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $1111', 4, 0, 'admin'),
(24, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $1111', 4, 0, 'Abbas'),
(25, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by jia with email alpha121xyz@gmail.com for Plot ID: 4 with a bid amount of $1112222', 4, 0, 'jia'),
(26, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by test with email alpha121xyz@gmail.com for Plot ID: 4 with a bid amount of $1', 4, 0, 'test'),
(27, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot ID: 4 with a bid amount of $1', 4, 0, 'Abbas'),
(28, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot Num: 103 with a bid amount of Rs.1000000', 4, 0, 'Abbas'),
(29, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by daud with email daudsattar0123@gmail.com for Plot Num: 103 with a bid amount of Rs.1500000', 4, 0, 'daud'),
(30, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by daud with email daudsattar0123@gmail.com for Plot Num: 103 with a bid amount of Rs.1500000', 4, 0, 'daud'),
(31, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by Abbas with email abbasshakor0123@gmail.com for Plot Num: 103 with a bid amount of Rs.2000000', 4, 0, 'Abbas'),
(32, 'New Bid Entered for Plot NO: 103', 'A new bid has been entered by admin with email abbasshakor0123@gmail.com for Plot Num: 103 with a bid amount of Rs.2500000', 4, 0, 'admin'),
(33, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by abbas.ch with email abbasshakor0123@gmail.com for Plot Num: 104 with a bid amount of Rs.3.1 Cr.', 5, 0, 'abbas.ch'),
(34, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by Abbas with email alpha121xyz@gmail.com for Plot Num: 104 with a bid amount of Rs.3.2 Cr', 5, 0, 'Abbas'),
(35, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by farheen with email farheenimran1907@gmail.com for Plot Num: 104 with a bid amount of Rs.1.21 Cr.', 5, 0, 'farheen'),
(36, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by Abbas Ch with email abbasshakor0123@gmail.com for Plot Num: 104 with a bid amount of Rs.1.22 Cr.', 5, 0, 'Abbas Ch'),
(37, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by abbas.ch with email abbasshakor0123@gmail.com for Plot Num: 104 with a bid amount of Rs.1.22 Cr.', 5, 0, 'abbas.ch'),
(38, 'New Bid Entered for Plot NO: 104', 'A new bid has been entered by admin with email abbasshakor0123@gmail.com for Plot Num: 104 with a bid amount of Rs.1.23 Cr.', 5, 0, 'admin'),
(39, 'New Bid Entered for Plot NO: 102', 'A new bid has been entered by admin with email abbasshakor0123@gmail.com for Plot Num: 102 with a bid amount of Rs.1.1 Cr.', 2, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `plot_bidding`
--

CREATE TABLE `plot_bidding` (
  `bid_id` int(11) NOT NULL,
  `bid` varchar(255) NOT NULL,
  `bid_date` varchar(255) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plot_bidding`
--

INSERT INTO `plot_bidding` (`bid_id`, `bid`, `bid_date`, `plot_id`, `user_name`, `user_email`) VALUES
(1, '1000000', '', 2, 'Abbas', 'abbasshakor0123@gmail.com'),
(2, '1005000', '', 2, 'jia', 'jia@gmail.com'),
(3, '1005000', '', 2, 'jia', 'jia@gmail.com'),
(4, '1000500', '', 2, 'jia', 'jia@gmail.com'),
(5, '1000500', '', 2, 'jia', 'jia@gmail.com'),
(6, '1050000', '', 2, 'ali', 'ali@gmail.com'),
(7, '1000001', '', 2, 'test', 'test@gmail.com'),
(8, '1000001', '', 2, 'test', 'test@gmail.com'),
(9, '100000011', '', 2, 'test1', 'test1@gmail.com'),
(10, '23', '', 2, 'sicev', 'fululemug@mailinator.com'),
(11, '67', '', 2, 'jyvew', 'lopi@mailinator.com'),
(12, '10000000', '', 2, 'hevaja', 'wejef@mailinator.com'),
(13, '10505050', '', 2, 'Abbas', 'abbasshakor0123@gmail.com'),
(14, '10505000', '', 2, 'Abbas', 'abbasshakor0123@gmail.com'),
(15, '15', '', 2, 'juqitymiq', 'fegir@mailinator.com'),
(16, '1', '', 2, 'luneboz', 'rovy@mailinator.com'),
(17, '1000005', '', 2, 'jia', 'jia@gmail.com'),
(18, '10001111', '', 4, 'zain', 'zain@gmail.com'),
(19, '100000', '2024-02-04 15:27:00', 4, 'test', 'test@gmail.com'),
(20, '1000000', '2024-02-04 15:27:21', 4, 'test', 'test@gmail.com'),
(21, '25', '2024-02-04 15:28:17', 4, 'neziwytoju', 'xunajimaho@mailinator.com'),
(22, '25', '2024-02-04 15:29:18', 4, 'neziwytoju', 'xunajimaho@mailinator.com'),
(23, '10001234', '2024-02-04 20:28:46', 4, 'Abbas', 'alpha121xyz@gmail.com'),
(24, '1', '2024-02-04 20:41:17', 4, 'Abbas', 'alpha121xyz@gmail.com'),
(25, '1', '2024-02-04 20:43:48', 4, 'test', 'abbasshakor0123@gmail.com'),
(26, '111', '2024-02-04 20:45:24', 4, 'test', 'abbasshakor0123@gmail.com'),
(27, '11', '2024-02-04 20:50:35', 4, 'test', 'abbasshakor0123@gmail.com'),
(28, '12', '2024-02-04 20:52:07', 4, 'test', 'abbasshakor0123@gmail.com'),
(29, '11111', '2024-02-04 20:55:09', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(30, '0123', '2024-02-04 20:56:49', 4, 'admin', 'alpha121xyz@gmail.com'),
(31, '123456', '2024-02-04 21:04:34', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(32, '12345678', '2024-02-04 21:05:42', 4, 'admin', 'abbasshakor0123@gmail.com'),
(33, '121212', '2024-02-04 21:19:10', 4, 'jia', 'abbasshakor0123@gmail.com'),
(34, '1111', '2024-02-04 21:21:37', 4, 'admin', 'abbasshakor0123@gmail.com'),
(35, '1111', '2024-02-04 21:24:17', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(36, '1112222', '2024-02-04 21:25:54', 4, 'jia', 'alpha121xyz@gmail.com'),
(37, '1', '2024-02-04 21:28:19', 4, 'test', 'alpha121xyz@gmail.com'),
(38, '1', '2024-02-04 21:29:21', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(39, '1000000', '2024-02-06 13:02:45', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(40, '1500000', '2024-02-06 13:06:09', 4, 'daud', 'daudsattar0123@gmail.com'),
(41, '1500000', '2024-02-06 13:06:36', 4, 'daud', 'daudsattar0123@gmail.com'),
(42, '2000000', '2024-02-06 15:41:20', 4, 'Abbas', 'abbasshakor0123@gmail.com'),
(43, '2500000', '2024-02-06 15:53:20', 4, 'admin', 'abbasshakor0123@gmail.com'),
(44, '3.1 Cr.', '2024-02-06 17:25:29', 5, 'abbas.ch', 'abbasshakor0123@gmail.com'),
(45, '3.2 Cr', '2024-02-06 17:57:32', 5, 'Abbas', 'alpha121xyz@gmail.com'),
(46, '1.21 Cr.', '2024-02-07 16:57:14', 5, 'farheen', 'farheenimran1907@gmail.com'),
(47, '1.22 Cr.', '2024-02-07 17:03:12', 5, 'Abbas Ch', 'abbasshakor0123@gmail.com'),
(48, '1.22 Cr.', '2024-02-07 17:12:10', 5, 'abbas.ch', 'abbasshakor0123@gmail.com'),
(49, '1.23 Cr.', '2024-02-07 17:31:23', 5, 'admin', 'abbasshakor0123@gmail.com'),
(50, '1.1 Cr.', '2024-02-07 17:43:03', 2, 'admin', 'abbasshakor0123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `plot_listing`
--

CREATE TABLE `plot_listing` (
  `plot_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plot_num` varchar(255) NOT NULL,
  `plot_title` varchar(255) NOT NULL,
  `plot_description` varchar(255) NOT NULL,
  `plot_image` varchar(255) NOT NULL,
  `plot_location` varchar(255) NOT NULL,
  `plot_price` varchar(255) NOT NULL,
  `plot_status` int(255) NOT NULL,
  `added_on` varchar(255) NOT NULL,
  `plot_area` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `beds` varchar(255) NOT NULL,
  `baths` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plot_listing`
--

INSERT INTO `plot_listing` (`plot_id`, `username`, `plot_num`, `plot_title`, `plot_description`, `plot_image`, `plot_location`, `plot_price`, `plot_status`, `added_on`, `plot_area`, `property_type`, `beds`, `baths`) VALUES
(1, 'abbas.ch', '101', 'Chronicles of Cipher ', 'A luxurious villa with panoramic ocean views, perfect for those who appreciate the calming sound of waves and stunning sunsets.', 'uploads/p7.jpg', 'Azure Shores, California', '1.2 Cr.', 1, '2024-02-06 12:54:50', '340', 'House', '4', '2'),
(2, 'abbas.ch', '102', 'Qui aliquam excepteu', 'Mollit magnam culpa ', 'uploads/p2.jpg', 'Enim sunt dolore fac', '1 Cr.', 1, '2024-02-06 12:54:50', '400', 'Property', '', ''),
(4, 'abbas.ch', '103', 'Coastal Horizon Villa', 'A luxurious villa with panoramic ocean views, perfect for those who appreciate the calming sound of waves and stunning sunsets.', 'uploads/p4.jpg', 'Azure Shores, California', '80 Lakh', 1, '2024-02-06 12:54:50', '15', 'House', '3', '4'),
(5, 'farheen', '104', 'Serene Haven Retreat', 'Experience tranquility in this spacious retreat, featuring modern amenities and breathtaking views. Elegant interiors, state-of-the-art kitchen, and a private garden make it perfect for relaxation.', 'uploads/p6.jpg', 'Mountainview Estates, Serenity Valley', '3 Cr.', 1, '2024-02-06 12:54:50', '300', 'Property', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_category` varchar(200) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_content` text NOT NULL,
  `post_image` varchar(200) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_category`, `post_title`, `post_content`, `post_image`, `date_posted`) VALUES
(1, 'Property', 'A Luxury Flat For Sale', 'Explore the epitome of sophistication and comfort with our exclusive listing â€“ a luxurious flat for sale! This opulent residence boasts stunning architecture, high-end finishes, and panoramic views that redefine urban living. Immerse yourself in the allure of luxury as you discover spacious interiors, state-of-the-art amenities, and a lifestyle tailored for those who appreciate the finer things. Don\'t miss the opportunity to make this extraordinary flat your new home. Contact us now to schedule a private viewing and experience the epitome of elegance.', 'uploads/post-4.jpg', '2024-02-01'),
(2, 'Property Investment', 'Real Estate Forecast', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac libero quis arcu varius malesuada. Quisque vestibulum eros vel nunc aliquet, nec fermentum urna efficitur. Duis volutpat urna eget odio posuere, at finibus sapien vestibulum. Aenean consectetur odio vel metus accumsan, eu fermentum tellus feugiat. Proin cursus interdum justo, ac vulputate leo tempus eu. Maecenas eleifend, elit a fermentum malesuada, erat ipsum hendrerit odio, vel auctor mi quam eget est. Sed sit amet velit euismod, blandit lacus nec, fermentum urna. Vivamus non tortor quis felis tincidunt vehicula. In hac habitasse platea dictumst. Nunc fringilla euismod tristique. Curabitur fermentum erat vel nisi ultricies, id volutpat nunc tincidunt. Integer tincidunt odio a nisl facilisis, vel laoreet sapien cursus. Sed sit amet vestibulum risus.', 'uploads/35839.jpg', '2024-02-01'),
(3, 'Property Investment', 'The Basics of Real Estate', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac libero quis arcu varius malesuada. Quisque vestibulum eros vel nunc aliquet, nec fermentum urna efficitur. Duis volutpat urna eget odio posuere, at finibus sapien vestibulum. Aenean consectetur odio vel metus accumsan, eu fermentum tellus feugiat. Proin cursus interdum justo, ac vulputate leo tempus eu. Maecenas eleifend, elit a fermentum malesuada, erat ipsum hendrerit odio, vel auctor mi quam eget est. Sed sit amet velit euismod, blandit lacus nec, fermentum urna. Vivamus non tortor quis felis tincidunt vehicula. In hac habitasse platea dictumst. Nunc fringilla euismod tristique. Curabitur fermentum erat vel nisi ultricies, id volutpat nunc tincidunt. Integer tincidunt odio a nisl facilisis, vel laoreet sapien cursus. Sed sit amet vestibulum risus.', 'uploads/real-estate-concept-with-house-made-wooden-blocks-glasses-magnifying-glass-keyboards-grey-background-close-up.jpg', '2024-02-01'),
(5, 'Travel', 'Discover the Serenity of Bali', 'Immerse yourself in the breathtaking landscapes and vibrant culture of Bali. From pristine beaches to lush rice terraces, this destination offers a perfect blend of relaxation and adventure. Unwind in luxurious resorts, explore ancient temples, and savor the exquisite local cuisine. Your Balinese getaway awaits!', 'uploads/post-3.jpg', '2024-02-04'),
(6, 'Property', 'Invest in Luxury Living: Exclusive Waterfront Properties Available Now', 'Explore a world of opulence with our exclusive waterfront properties. Nestled in scenic locations, these homes offer unparalleled views and top-notch amenities. Whether you seek a serene retreat or a sophisticated urban dwelling, our collection caters to the most discerning tastes. Elevate your lifestyle with these exquisite waterfront residences.', 'uploads/post-2.jpg', '2024-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `visited_count`
--

CREATE TABLE `visited_count` (
  `id` int(11) NOT NULL,
  `visit_count` int(255) NOT NULL,
  `visit_datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visited_count`
--

INSERT INTO `visited_count` (`id`, `visit_count`, `visit_datetime`) VALUES
(1, 1, '2024-02-04 18:14:06'),
(2, 1, '2024-02-04 18:14:22'),
(3, 1, '2024-02-04 18:14:35'),
(4, 1, '2024-02-04 18:16:37'),
(5, 1, '2024-02-04 18:17:06'),
(6, 1, '2024-02-04 18:17:45'),
(7, 1, '2024-02-04 18:17:51'),
(8, 1, '2024-02-05 12:28:22'),
(9, 2, '2024-02-06 12:54:50'),
(10, 2, '2024-02-07 16:40:08'),
(11, 2, '2024-02-09 10:48:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plot_bidding`
--
ALTER TABLE `plot_bidding`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `plot_listing`
--
ALTER TABLE `plot_listing`
  ADD PRIMARY KEY (`plot_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visited_count`
--
ALTER TABLE `visited_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `plot_bidding`
--
ALTER TABLE `plot_bidding`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `plot_listing`
--
ALTER TABLE `plot_listing`
  MODIFY `plot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visited_count`
--
ALTER TABLE `visited_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
