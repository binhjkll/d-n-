-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2024 at 04:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `banner_id` int NOT NULL COMMENT 'id banner',
  `image_url` varchar(255) NOT NULL COMMENT 'url của hình ảnh banner ',
  `link` varchar(255) DEFAULT NULL COMMENT 'đường dẫn khi nhấp vào banner',
  `alt_text` varchar(255) DEFAULT NULL COMMENT 'văn bản thay thế cho hình ảnh',
  `display_order` int DEFAULT NULL COMMENT 'thứ tự hiển thị',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'ngày tạo banner',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'ngày cập nhật banner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int NOT NULL COMMENT 'id của sản phẩm trong giỏ hàng',
  `user_id` int NOT NULL COMMENT 'id người dùng',
  `product_id` int NOT NULL COMMENT 'id sản phẩm',
  `quantity` int NOT NULL COMMENT 'số lượng sản phẩm ',
  `added_at` timestamp NOT NULL COMMENT 'ngày thêm sản phẩm',
  `variant_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `user_id`, `product_id`, `quantity`, `added_at`, `variant_id`) VALUES
(29, 1, 7, 1, '2024-11-25 07:15:13', 1),
(31, 3, 7, 1, '2024-11-25 07:30:06', 1),
(32, 3, 8, 1, '2024-11-25 07:30:30', 2),
(33, 2, 7, 1, '2024-11-25 08:05:03', 1),
(34, 2, 16, 1, '2024-11-25 08:05:18', 11),
(224, 4, 22, 1, '2024-12-05 02:42:22', 20),
(225, 12, 22, 1, '2024-12-05 04:04:05', 18),
(226, 12, 14, 1, '2024-12-05 04:04:13', 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL COMMENT 'id danh mục',
  `name` varchar(255) NOT NULL COMMENT 'tên danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Áo Sweater'),
(2, 'Áo Khoác Phao'),
(3, 'Áo Blazer'),
(4, 'Áo Hoodie');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int NOT NULL COMMENT 'id khuyến mãi',
  `code` varchar(255) NOT NULL COMMENT 'mã khuyến mãi',
  `discount_type` enum('percentage','fixed') NOT NULL COMMENT 'loại giảm giá',
  `amount` decimal(10,0) NOT NULL COMMENT 'giá trị giảm giá',
  `start_date` date NOT NULL COMMENT 'ngày bắt đầu khuyến mãi',
  `end_date` date NOT NULL COMMENT 'ngày kết thúc khuyến mãi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `featured_collections`
--

CREATE TABLE `featured_collections` (
  `collection_id` int NOT NULL COMMENT 'id bộ sưu tập',
  `name` varchar(255) NOT NULL COMMENT 'tên bộ sưu tập',
  `description` text COMMENT 'mô tả bộ sưu tập',
  `display_order` int DEFAULT NULL COMMENT 'thứ tự hiển thị',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'ngày tạo bộ sưu tập',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'ngày cập nhât bộ sưu tập'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL COMMENT 'id đơn hàng',
  `user_id` int NOT NULL COMMENT 'id người dùng đặt hàng',
  `total_amount` decimal(10,0) NOT NULL COMMENT 'tổng giá trị đơn hàng',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'trạng thái thanh toán',
  `delivery_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'trạng thái giao vận',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'ngày đặt hàng',
  `address` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cancel_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `payment_status`, `delivery_status`, `created_at`, `address`, `phone`, `email`, `name`, `cancel_reason`) VALUES
(75, 5, '37026', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 02:09:09', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Tôi muốn đổi thông tin, địa chỉ đặt hàng'),
(76, 5, '84684', 'thanh toán khi nhận hàng', 'Đã huỷ', '2024-12-04 02:10:19', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Không cần nữa'),
(77, 5, '24342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 02:11:07', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Thay đổi ý định'),
(78, 5, '36342', 'thanh toán khi nhận hàng', 'Đã huỷ', '2024-12-04 02:12:04', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'sdfghjkl;\''),
(79, 5, '12342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 02:19:15', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Không cần nữa'),
(80, 5, '12342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 02:38:19', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Thay đổi ý định'),
(81, 5, '12588', 'thanh toán khi nhận hàng', 'Đã giao', '2024-12-04 04:24:57', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', ''),
(82, 5, '12342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 04:49:44', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Thay đổi ý định'),
(83, 5, '12000', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 04:49:56', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Không cần nữa'),
(84, 5, '24342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 05:35:15', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'Đặt nhầm'),
(85, 5, '60684', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 06:16:59', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'azsxdcfgvhjkl;\''),
(86, 5, '24342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-04 11:38:12', 'thôn bình đẹp trai', 366681908, 'binh2004@gmail.com', 'conglon', 'asdfgtyhjkl;'),
(87, 4, '12000', 'thanh toán khi nhận hàng', 'Đã huỷ', '2024-12-04 16:26:08', 'sơn tây', 393063305, 'c@gmail.com', 'con', ''),
(88, 4, '100000', 'thanh toán khi nhận hàng', 'Đã huỷ', '2024-12-05 01:55:21', 'aaaa', 393063305, 'c@gmail.com', 'con', 'Đặt nhầm'),
(89, 4, '136342', 'thanh toán trực tiếp', 'Đã huỷ', '2024-12-05 01:56:43', 'aa', 393063305, 'c@gmail.com', 'con', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int NOT NULL COMMENT 'id chi tiết đơn hàng',
  `order_id` int NOT NULL COMMENT 'id của đơn hàng',
  `variant_id` int NOT NULL COMMENT 'id của bt sản phẩm',
  `quantity` int NOT NULL COMMENT 'số lượng của sản phẩm trong đơn hàng',
  `price` decimal(10,0) NOT NULL COMMENT 'giá sản phẩm vào thời điểm đặt hàng',
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `variant_id`, `quantity`, `price`, `size`) VALUES
(158, 75, 1, 3, '12342', 'XL'),
(162, 76, 1, 2, '12342', 'S'),
(163, 76, 2, 3, '12000', 'M'),
(164, 76, 3, 2, '12000', 'XL'),
(165, 77, 1, 1, '12342', 'XL'),
(166, 77, 2, 1, '12000', 'XXL'),
(167, 78, 1, 1, '12342', 'S'),
(168, 78, 2, 1, '12000', 'M'),
(169, 78, 3, 1, '12000', 'XL'),
(170, 79, 1, 1, '12342', 'XXL'),
(171, 80, 1, 1, '12342', 'XXL'),
(172, 81, 1, 1, '12342', 'S'),
(173, 81, 7, 2, '123', 'M'),
(174, 82, 1, 1, '12342', 'XXL'),
(175, 83, 3, 1, '12000', 'M'),
(176, 84, 1, 1, '12342', 'S'),
(177, 84, 2, 1, '12000', 'M'),
(178, 85, 1, 2, '12342', 'S'),
(179, 85, 2, 1, '12000', 'M'),
(180, 85, 4, 2, '12000', 'XL'),
(181, 86, 1, 1, '12342', 'XL'),
(182, 86, 2, 1, '12000', 'XXL'),
(183, 87, 4, 1, '12000', 'M'),
(184, 88, 7, 1, '100000', 'XL'),
(185, 89, 4, 2, '12000', 'M'),
(186, 89, 7, 1, '100000', 'S'),
(187, 89, 1, 1, '12342', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL COMMENT 'ID sản phẩm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'tên sp chung',
  `description` text COMMENT 'mô tả sp',
  `category_id` int NOT NULL COMMENT 'ID của danh mục sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`) VALUES
(1, 'ádasd', 'ádasd', 1),
(3, 'binh', 's', 1),
(4, 'binh', 's', 1),
(5, 'binh', 'ÂsASa', 1),
(6, 'binh', 'sádsa', 1),
(7, 'áo sweater đen rộng ', 'Form Regular-Fit thoải mái, trẻ trung vừa phải phù hợp với mọi dáng người ', 1),
(8, 'Áo sweater đen', 'Phong cách Cơ bản, Hàn Quốc, Đường phố', 1),
(9, 'Mèo', 'wwwwwwwwwww', 4),
(10, 'binh', 'ádasds', 1),
(11, 'Áo giữ ấm', '1234', 1),
(14, 'Áo nỉ tay dài', 'siêu ấm, siêu giữ ', 1),
(15, 'Áo Hoodie ', 'đẹp', 4),
(16, 'Áo Hodie thiết kế đẹp ', 'Áo đẹp với đường may chi tiết', 1),
(18, 'binh', 'áo bông siêu dày', 1),
(19, 'Hồng Sơn', 'rrrrrrrrr', 1),
(20, 'Áo nỉ thun dài tay nam', 'Áo thun dài tay là sản phẩm tâm huyết của đội ngũ ATINO, được thiết kế với đường may tinh tế cùng họa tiết in khiến cho người mặc luôn được trẻ trung thời thượng, đảm bảo sẽ là mảnh ghép tuyệt vời trong outfit của bạn', 1),
(21, 'Áo Khoác Nam Nữ', 'Đường may chần bông: Áo thường có các đường chỉ chần nổi, tạo thành các ô hoặc khoang đều nhau để giữ lớp lót cố định.', 2),
(22, 'Áo Khoác nam', 'Áo Khoác Phao Nam GrayHomme (5 màu), Chần Bông Cao Cấp, Mềm Mịn, Siêu Nhẹ, Lót Lông Siêu Ấm, Phom Ôm Vừa Trẻ Trung (CF010)', 2),
(23, 'áo blazer đen', 'Chất liệu vải: 100% Polyester', 3),
(24, 'Áo blazer phong cách', 'Chất liệu vải: 100% Polyester', 3),
(25, 'Áo blazer phong cách', 'Chất liệu vải: 100% Polyester', 3),
(26, 'Áo sweater mới nhất', 'siêu bền siêu đẹp', 1),
(27, 'Áo đẹp', 'AAA', 1),
(28, 'Áo sweater nam nữ', 'bền và chống nước', 1),
(29, 'áo đẹp', 'áo siêu ấm chất lượng cao', 1),
(30, 'Áo Hoodie ', 'siêu đẹp, siêu bền', 4),
(31, 'Áo Hoodie giới trẻ', 'Phong cách và phong cách', 4),
(32, 'Áo Hoodie khóa', 'đẹp quá', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_recommendations`
--

CREATE TABLE `product_recommendations` (
  `recommendation_id` int NOT NULL COMMENT 'id gợi ý sản phẩm',
  `product_id` int NOT NULL COMMENT 'id sản phẩm gợi ý',
  `display_order` int NOT NULL COMMENT 'thứ tự hiển thị',
  `created_at` timestamp NOT NULL COMMENT 'ngày tạo gợi ý',
  `updated_at` timestamp NOT NULL COMMENT 'ngày cập nhật gợi ý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` int NOT NULL COMMENT 'id biến thể',
  `product_id` int NOT NULL COMMENT 'id sản phẩm chung',
  `price` decimal(10,0) NOT NULL COMMENT 'giá biến thể',
  `stock_quantity` int NOT NULL COMMENT 'số lượng tồn kho của biến thể',
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `price`, `stock_quantity`, `product_img`) VALUES
(1, 7, '120000', 5, 'images/1733366589_Ảnh chụp màn hình 2024-12-05 093516.png'),
(2, 8, '12000', 2, 'images/1733366247_Ảnh chụp màn hình 2024-12-05 083658.png'),
(3, 9, '12000', 5, 'images/1732362507_tải xuống (2).jpg'),
(4, 11, '12000', 2, 'images/1733366190_Ảnh chụp màn hình 2024-12-05 093503.png'),
(7, 14, '100000', 222, 'images/1733366151_Ảnh chụp màn hình 2024-12-05 093308.png'),
(8, 14, '123', 44, 'images/1733366027_Ảnh chụp màn hình 2024-12-05 093335.png'),
(9, 15, '40000', 20, 'images/1733366646_Ảnh chụp màn hình 2024-12-05 093532.png'),
(10, 15, '49000', 10, 'images/1733366268_Ảnh chụp màn hình 2024-12-05 083639.png'),
(11, 16, '199000', 50, 'images/1732362455_images (1).jpg'),
(14, 20, '100000', 10000, 'images/1733364082_sweat_den_1.webp'),
(15, 20, '100000', 10000, 'images/1733364082_sweat_trang_1.webp'),
(16, 21, '200000', 150, 'images/1733364843_khoacphao_den_1.webp'),
(17, 21, '200000', 70, 'images/1733364843_khoacphao_trang_1.webp'),
(18, 22, '30000', 99, 'images/1733366521_Ảnh chụp màn hình 2024-12-05 093918.png'),
(19, 22, '300000', 50, 'images/1733366521_Ảnh chụp màn hình 2024-12-05 093945.png'),
(20, 22, '299000', 222, 'images/1733366521_Ảnh chụp màn hình 2024-12-05 094008.png'),
(21, 23, '300000', 65, 'images/1733367010_Ảnh chụp màn hình 2024-12-05 094631.png'),
(22, 24, '400000', 50, 'images/1733367129_Ảnh chụp màn hình 2024-12-05 094815.png'),
(23, 24, '425000', 90, 'images/1733367129_Ảnh chụp màn hình 2024-12-05 094835.png'),
(24, 24, '350000', 50, 'images/1733367129_Ảnh chụp màn hình 2024-12-05 094857.png'),
(25, 25, '500000', 10, 'images/1733367225_Ảnh chụp màn hình 2024-12-05 094730.png'),
(26, 26, '99000', 10, 'images/1733369721_Ảnh chụp màn hình 2024-12-05 093335.png'),
(27, 26, '59000', 60, 'images/1733369721_Ảnh chụp màn hình 2024-12-05 093308.png'),
(28, 27, '55000', 10, 'images/1733369798_Ảnh chụp màn hình 2024-12-05 093532.png'),
(29, 28, '100000', 80, 'images/1733369880_Ảnh chụp màn hình 2024-12-05 083639.png'),
(30, 28, '100000', 52, 'images/1733369880_Ảnh chụp màn hình 2024-12-05 083658.png'),
(31, 29, '100000', 50, 'images/1733369964_Ảnh chụp màn hình 2024-12-05 093308.png'),
(32, 29, '99000', 10, 'images/1733369964_Ảnh chụp màn hình 2024-12-05 093335.png'),
(33, 30, '250000', 35, 'images/1733370239_Ảnh chụp màn hình 2024-12-05 104239.png'),
(34, 30, '260000', 64, 'images/1733370239_Ảnh chụp màn hình 2024-12-05 104249.png'),
(35, 31, '350000', 99, 'images/1733370449_Ảnh chụp màn hình 2024-12-05 104155.png'),
(36, 31, '340000', 55, 'images/1733370449_Ảnh chụp màn hình 2024-12-05 104206.png'),
(37, 31, '350000', 82, 'images/1733370449_Ảnh chụp màn hình 2024-12-05 104221.png'),
(38, 32, '300000', 44, 'images/1733370514_Ảnh chụp màn hình 2024-12-05 104304.png'),
(39, 32, '300000', 66, 'images/1733370514_Ảnh chụp màn hình 2024-12-05 104316.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL COMMENT 'id đánh giá',
  `product_id` int NOT NULL COMMENT 'id của sản phẩm',
  `user_id` int NOT NULL COMMENT 'id người dùng để lại đánh giá',
  `comment` text NOT NULL COMMENT 'nd đánh giá',
  `created_at` date NOT NULL COMMENT 'ngày đánh giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `comment`, `created_at`) VALUES
(2, 7, 4, 'ssss', '2024-12-04'),
(3, 11, 4, 'aaaaaaa', '2024-12-04'),
(4, 11, 4, 'aaaaaaa', '2024-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `ticket_id` int NOT NULL COMMENT 'id yêu cầu hỗ trợ',
  `user_id` int NOT NULL COMMENT 'id của khách hàng',
  `subject` varchar(255) NOT NULL COMMENT 'tiêu đề hỗ trợ',
  `message` text NOT NULL COMMENT 'nội dung yêu cầu hỗ trợ',
  `status` enum('open','closed') NOT NULL COMMENT 'trạng thái hỗ trợ',
  `created_at` timestamp NOT NULL COMMENT 'ngày yêu cầu hỗ trợ',
  `updated_at` timestamp NOT NULL COMMENT 'ngày cập nhật trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trangchu`
--

CREATE TABLE `trangchu` (
  `section_id` int NOT NULL COMMENT 'id của mục trên trang chủ',
  `section_type` enum('banner','featured_collection','product_recommendation','custom') NOT NULL COMMENT 'loại nội dung của mục',
  `title` varchar(255) NOT NULL COMMENT 'tiêu đề của mục',
  `description` text COMMENT 'mô tả cho mục',
  `position` int DEFAULT NULL COMMENT 'vị trí của mục trên trang chủ',
  `content_id` int NOT NULL COMMENT 'liên kết đến bảng tương ứng  (ví dụ, banners, products, collections)',
  `created_at` timestamp NOT NULL COMMENT 'ngày tạo mục',
  `updated_at` timestamp NOT NULL COMMENT 'ngày cập nhật mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL COMMENT 'id fuy nhất mỗi người dùng',
  `username` varchar(255) NOT NULL COMMENT 'tên đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu đã được mã hoá',
  `email` varchar(255) NOT NULL COMMENT 'địa chỉ email',
  `phone` varchar(255) NOT NULL COMMENT 'số điện thoại',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'địa chỉ',
  `role` enum('admin','customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'phân quyền người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `address`, `role`) VALUES
(1, 'binhhpph49776', '123456', 'binhhpph49776@gmail.com', '0366681907', 'Thôn Du Đại 1 Đông Hải Quỳnh Phu, Thái Bình', 'admin'),
(2, 'hihi', 'anhzap09', 'bacmap2005@gmail.com', '0969498404', NULL, NULL),
(3, 'kaka', 'anhzap09', 'b@gmail.com', '0123456789', NULL, NULL),
(4, 'con', '11', 'c@gmail.com', '01111111', NULL, NULL),
(5, 'conglon', '111111', 'binh2004@gmail.com', '0366681908', 'thôn bình đẹp trai', NULL),
(7, 'conglon121', '11', 'b234376@gmail.com', '02342424442222222', NULL, NULL),
(8, 'conglon123', '111111', '23425349776@gmail.com', '023424244412312312', '', NULL),
(9, '', '', '', '', '', NULL),
(10, 'conglon123456', '`1234567890', '23456dsdf6@gmail.com', '0134567891', '', NULL),
(11, 'binhưer', '`1234567890', '2345678dsf76@gmail.com', '0234242111', '', NULL),
(12, 'son', '12345', 'scao80888@gmail.com', '0393063305', 'Sơn Tây - Hà Nội', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_options`
--

CREATE TABLE `variant_options` (
  `option_id` int NOT NULL COMMENT 'id của lựa chọn biến thể',
  `variant_id` int NOT NULL COMMENT 'id biến thể',
  `option_name` varchar(255) NOT NULL COMMENT 'tên lựa chọn ( màu săc, kích thước)',
  `option_value` varchar(255) NOT NULL COMMENT 'giá trị lựa chọn (xanh, M,L)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int NOT NULL COMMENT 'id danh sách yêu thích',
  `user_id` int NOT NULL COMMENT 'id người dùng',
  `product_id` int NOT NULL COMMENT 'id sản phẩm',
  `added_at` timestamp NOT NULL COMMENT 'ngày thêm vào danh sách yêu thích'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `lk_cart_items_users` (`user_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `featured_collections`
--
ALTER TABLE `featured_collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `lk_orders_users` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `lk_order_items_orders` (`order_id`),
  ADD KEY `product_id` (`variant_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_recommendations`
--
ALTER TABLE `product_recommendations`
  ADD PRIMARY KEY (`recommendation_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`),
  ADD KEY `lk_product_variants_products` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `lk_reviews_users` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `lk_support_tickets_users` (`user_id`);

--
-- Indexes for table `trangchu`
--
ALTER TABLE `trangchu`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `variant_options`
--
ALTER TABLE `variant_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `lk_wishlist_users` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int NOT NULL AUTO_INCREMENT COMMENT 'id banner';

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int NOT NULL AUTO_INCREMENT COMMENT 'id của sản phẩm trong giỏ hàng', AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT COMMENT 'id danh mục', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT COMMENT 'id khuyến mãi';

--
-- AUTO_INCREMENT for table `featured_collections`
--
ALTER TABLE `featured_collections`
  MODIFY `collection_id` int NOT NULL AUTO_INCREMENT COMMENT 'id bộ sưu tập';

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT COMMENT 'id đơn hàng', AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int NOT NULL AUTO_INCREMENT COMMENT 'id chi tiết đơn hàng', AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID sản phẩm', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_recommendations`
--
ALTER TABLE `product_recommendations`
  MODIFY `recommendation_id` int NOT NULL AUTO_INCREMENT COMMENT 'id gợi ý sản phẩm';

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` int NOT NULL AUTO_INCREMENT COMMENT 'id biến thể', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT COMMENT 'id đánh giá', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `ticket_id` int NOT NULL AUTO_INCREMENT COMMENT 'id yêu cầu hỗ trợ';

--
-- AUTO_INCREMENT for table `trangchu`
--
ALTER TABLE `trangchu`
  MODIFY `section_id` int NOT NULL AUTO_INCREMENT COMMENT 'id của mục trên trang chủ';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'id fuy nhất mỗi người dùng', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `variant_options`
--
ALTER TABLE `variant_options`
  MODIFY `option_id` int NOT NULL AUTO_INCREMENT COMMENT 'id của lựa chọn biến thể';

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int NOT NULL AUTO_INCREMENT COMMENT 'id danh sách yêu thích';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lk_cart_items_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `lk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `lk_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_recommendations`
--
ALTER TABLE `product_recommendations`
  ADD CONSTRAINT `product_recommendations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `lk_product_variants_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `lk_reviews_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `lk_support_tickets_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `trangchu`
--
ALTER TABLE `trangchu`
  ADD CONSTRAINT `trangchu_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `featured_collections` (`collection_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `trangchu_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `product_recommendations` (`recommendation_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `variant_options`
--
ALTER TABLE `variant_options`
  ADD CONSTRAINT `variant_options_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `lk_wishlist_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
