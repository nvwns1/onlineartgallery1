-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 05:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oag`
--

-- --------------------------------------------------------

--
-- Table structure for table `artworks`
--

CREATE TABLE `artworks` (
  `artwork_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT current_timestamp(),
  `price` decimal(10,2) DEFAULT NULL,
  `units_available` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artworks`
--

INSERT INTO `artworks` (`artwork_id`, `title`, `artist_id`, `description`, `image_path`, `creation_date`, `price`, `units_available`) VALUES
(23, 'Whispers of Serenity', 37, 'A mesmerizing oil painting that captures the essence of a tranquil forest at dusk. Soft hues of purple and blue dance harmoniously, while delicate rays of moonlight illuminate the mysterious foliage, creating an enchanting atmosphere of serenity and peace.', 'photo/p1.jpg', '2023-07-21', '500.00', 20),
(24, 'Ephemeral Dreams', 37, 'An ethereal mixed-media artwork that evokes the fleeting nature of dreams. Delicate brushstrokes blend with wisps of watercolors, forming abstract shapes that seem to dissolve into the canvas. This evocative piece invites viewers to contemplate the intangible realm of imagination.', 'photo/IMG-34e27ad88225af40f29773448fb85f1c-V.jpg', '2023-07-21', '200.00', 10),
(25, 'Infinite Horizons', 37, 'A stunning photograph that encapsulates the vastness of nature\'s beauty. The golden sun dips below the horizon, casting a warm glow across the endless expanse of a serene seascape. The meeting of sky and ocean paints a breathtaking panorama, inviting spectators to lose themselves in the boundless horizon.', 'photo/IMG-6a23eb2fb3221fa07a204269e1641e79-V.jpg', '2023-07-21', '1000.00', 5),
(26, 'Cosmic Odyssey', 40, 'Venture into space\'s grandeur as an intrepid astronaut glides amidst celestial wonders, evoking awe and wonder for the boundless universe.', 'photo/IMG-3ffed2c99767d16d5d5202913e26aaf7-V.jpg', '2023-07-21', '400.00', 10),
(27, 'Astronaut\'s Reverie', 40, 'Surrender to an astronaut\'s dreamscape, where surreal visions blend with cosmic landscapes, igniting cosmic introspection.', 'photo/IMG-4b68bf7815cd0d0a5eba998b3c30ac25-V.jpg', '2023-07-21', '500.00', 20),
(28, 'Stellar Ascent', 40, ' Witness the triumphant ascent of a brave astronaut, reaching for the stars amid a celestial symphony of galaxies.', 'photo/IMG-87a7e58526f8ea8d32ae8bf9339552a0-V.jpg', '2023-07-21', '1000.00', 10),
(29, 'Whiskered Watercolors', 41, 'An enchanting artwork where playful feline spirits curate a palette of vibrant watercolors. Watch as their furry paws brush across the canvas, creating a symphony of colors that reflects the joy and spontaneity of our feline friends.', 'photo/IMG-975eb7c6d079a15ca7aed70d30aa738e-V.jpg', '2023-07-21', '2000.00', 5),
(30, 'Purrfect Pigments', 41, ' Dive into a world of \"Purrfect Pigments\" with this captivating artwork. Immerse yourself in a tapestry of vivid hues carefully curated by a mischievous cat artist, whose intuitive strokes and discerning eye blend together to compose an expressive and striking masterpiece.', 'photo/IMG-4893ba1d4ca1379208a745ed095ed932-V.jpg', '2023-07-21', '2000.00', 20),
(31, 'Feline Artistry Unleashed', 41, 'Witness \"Feline Artistry Unleashed\" as our talented cat painter takes center stage, crafting an extraordinary visual symphony with its magical meow palette. This captivating artwork captures the essence of feline grace and creativity, inviting viewers into a world where whiskers become brushes and purrs become the soundtrack to artistic brilliance.', 'photo/IMG-390d2c85fe374e37a7b67fd97150f9b3-V.jpg', '2023-07-21', '2500.00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `artwork_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `artwork_id`, `quantity`, `timestamp`) VALUES
(79, 41, 24, 1, '2023-07-21 04:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','delivered','canceled') DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `shipping_address`, `payment_method`) VALUES
(28, 37, '2023-07-21 06:50:37', '10000.00', 'delivered', 'Kathmandu', 'cod'),
(29, 37, '2023-07-21 06:52:20', '12500.00', 'canceled', 'Kathmandu', 'cod'),
(30, 37, '2023-07-21 06:54:09', '2500.00', 'canceled', 'nepal', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `artwork_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `artwork_id`, `quantity`) VALUES
(25, 28, 29, 5),
(26, 29, 31, 5),
(27, 30, 27, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status` varchar(30) NOT NULL,
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `status`, `pp`) VALUES
(23, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$RKh/mJDQNFZ8yYWmDrwjguQZxvkAUFH2yGpPexhj7Qh0yJEaEDnZ6', 'active', 'profile.png'),
(37, 'Luna', 'Starlight', 'user1', 'user1@gmail.com', '$2y$10$SkgDhtBqjZkNZvelYaNaouAyOFe3trMR5PMAI6OnE/3NFY.XchpWO', 'active', 'user1.png'),
(40, 'Jasper', 'Phoenix', 'user2', 'user2@gmail.com', '$2y$10$F9MqCILQV0xkoDklq.TrfudlU.q1ApEJo2i9aEbmt4Ywmap1WILgS', 'active', 'user2.png'),
(41, 'Meow', 'Palette', 'user3', 'user3@gmail.com', '$2y$10$bzNgzBf634281XoIc34iM.oWylPJ8aYaptyvoIEOXMr5UU3Gz7Gzm', 'active', 'user3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`artwork_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_cart_artworks` (`artwork_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `artwork_id` (`artwork_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artworks`
--
ALTER TABLE `artworks`
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artworks`
--
ALTER TABLE `artworks`
  ADD CONSTRAINT `artworks_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`artwork_id`) REFERENCES `artworks` (`artwork_id`),
  ADD CONSTRAINT `fk_cart_artworks` FOREIGN KEY (`artwork_id`) REFERENCES `artworks` (`artwork_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`artwork_id`) REFERENCES `artworks` (`artwork_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
