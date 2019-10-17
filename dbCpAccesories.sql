-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 02:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `product_name`, `product_desc`, `product_price`, `product_qty`, `product_img`) VALUES
(1, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 200, 20, '24769003a6b8fcca832a2eda3cac21a8c8996c2b.jpg'),
(2, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 2001, 20, '24769003a6b8fcca832a2eda3cac21a8c8996c2b.jpg'),
(3, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 2001, 20, '24769003a6b8fcca832a2eda3cac21a8c8996c2b.jpg'),
(4, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 2001, 20, '24769003a6b8fcca832a2eda3cac21a8c8996c2b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transac_tbl`
--

CREATE TABLE `transac_tbl` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_item` longtext,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transac_tbl`
--

INSERT INTO `transac_tbl` (`order_id`, `user_id`, `order_item`, `status`) VALUES
(5, 4, '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":4},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":16},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":18}]', 'Deleviring'),
(6, 4, '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":4},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":16},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":18}]', 'Deleviring'),
(7, 4, '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":4},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":16},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":18}]', 'Deleviring'),
(8, 4, '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":4},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":16},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":18}]', 'Deleviring'),
(9, 4, '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":4},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":16},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":18}]', 'Deleviring'),
(10, 4, '[{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(11, 4, '[{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(12, 4, '[{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(13, 4, '[{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(14, 4, '[{\"id\":\"17\",\"product_name\":\"qweqwe\",\"product_desc\":\"asdwwwweweweewasdasdasdxczxcxzczxsadasd\",\"product_price\":\"200\",\"product_img\":\"1c91e2f4b7904274215742c02291e99b217c51bd.jpg\",\"qty\":\"2\"},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":\"2\"},{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":\"2\"},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(15, 4, '[{\"id\":\"17\",\"product_name\":\"qweqwe\",\"product_desc\":\"asdwwwweweweewasdasdasdxczxcxzczxsadasd\",\"product_price\":\"200\",\"product_img\":\"1c91e2f4b7904274215742c02291e99b217c51bd.jpg\",\"qty\":2},{\"id\":\"16\",\"product_name\":\"qwewqeqweqweqweqwewqeqweqwe\",\"product_desc\":\"qwhveqjwhenvqwheiqvhwehqiwvuhenqwuvehnqwhneviqwnevqwuevhiqwhnevqwehnviqwehvqiwhnevnqwhenivhwqueqwhneqvnwieuhiqwvneqhwnvhiuqwhevniqwievnqweqwvveunvqwienhvqiwnehnvqw\",\"product_price\":\"200\",\"product_img\":\"981db84859b254ee9dc0df89c6adc9afb3c69f54.jpg\",\"qty\":\"2\"},{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":\"2\"},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"2\"}]', 'Deleviring'),
(16, 4, '[{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":\"23\"}]', 'Deleviring');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `product_id`, `user_id`, `qty`) VALUES
(1, NULL, NULL, NULL),
(2, NULL, NULL, 22),
(3, 14, 0, 22),
(4, 14, 4, 12),
(5, 14, 4, 0),
(6, 14, 4, 0),
(7, 14, 4, 0),
(8, 14, 4, 0),
(9, 14, 4, 0),
(10, 14, 4, 0),
(11, 14, 4, 23),
(12, 14, 4, 23),
(13, 15, 4, 23),
(14, 15, 4, 12),
(15, 15, 4, 12),
(16, 14, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `user_info_tbl`
--

CREATE TABLE `user_info_tbl` (
  `id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_street` varchar(255) DEFAULT NULL,
  `user_barangay` varchar(255) DEFAULT NULL,
  `user_cpno_a` varchar(255) DEFAULT NULL,
  `user_fname_a` varchar(255) DEFAULT NULL,
  `user_lname_a` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info_tbl`
--

INSERT INTO `user_info_tbl` (`id`, `address_id`, `user_id`, `user_city`, `user_street`, `user_barangay`, `user_cpno_a`, `user_fname_a`, `user_lname_a`) VALUES
(11, 2, 0, 'Taguig', 'Dayap Street Western Bicutan Taguig City', 'Western', '09196400509', 'Flores', 'Jason'),
(13, 2, 4, 'Taguig', 'Dayap Street Western Bicutan Taguig City', 'Western', '09196400509', 'Flores', 'Jason'),
(14, 3, 4, 'Taguig', 'Dayap Street Western Bicutan Taguig City', 'western', '09196400509', 'Flores', 'Jason');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_gender` varchar(45) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_fname` varchar(255) DEFAULT NULL,
  `user_lname` varchar(255) DEFAULT NULL,
  `user_cpno` varchar(225) DEFAULT NULL,
  `user_cart` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `user_type`, `user_name`, `user_pass`, `user_gender`, `user_dob`, `user_fname`, `user_lname`, `user_cpno`, `user_cart`) VALUES
(1, 1, 'jason0127', '123456', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 0, 'asd', '123456', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, 'asd', 'qwe', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0, 'jasonflores0127@gmail.com', '123456', 'male', '1999-01-27', 'Flores', 'Jason', '019196400509', '[{\"id\":\"15\",\"product_name\":\"qweqwe\",\"product_desc\":\"askdashdkashdkajhdkashdbnwbmenqvwrb qer webnrwenrvqweq eqwjkeh qw heqwhevnqwhevqwedeqwechqwcbeqcweqwe\",\"product_price\":\"2019\",\"product_img\":\"1d7e48ca77e58c283fe093ef83c014d782cb984a.jpg\",\"qty\":\"2\"},{\"id\":\"14\",\"product_name\":\"Sample\",\"product_desc\":\"Hello World asdasdvasjdvashdvasjdvahsdvajsdvasvdajdsvasvdjasvdhasvdajvdajsdvajdvasjdvajsdvasjdvasjhdvajsdvashvdajsvdajdsvasdvjasdvajsdvasjdvasjdvjsavdjasvdjasdvjasvdasdvajsvdajsvdajsdvajsvdajsvdashdvasjvdasvd\",\"product_price\":\"200\",\"product_img\":\"1c50d2f440817055dd09935fe5fcdfd1281f01a2.jpg\",\"qty\":6}]'),
(5, 1, 'admin@admin.com', 'admin', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'nin@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transac_tbl`
--
ALTER TABLE `transac_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info_tbl`
--
ALTER TABLE `user_info_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transac_tbl`
--
ALTER TABLE `transac_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_info_tbl`
--
ALTER TABLE `user_info_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
