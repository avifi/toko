-- SQL Schema and Sample Seed Data for Toko Multi-Tenant Application (Single Database, Shared Schema with tenant_id)

SET FOREIGN_KEY_CHECKS=0;

-- --------------------------------------------------------
-- Table structure for `tenants`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tenants` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `domain` VARCHAR(255) NOT NULL UNIQUE,
  `email` VARCHAR(255) DEFAULT NULL,
  `username` VARCHAR(100) DEFAULT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `ends_on` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed tenant data
INSERT INTO `tenants` (`id`, `domain`, `email`, `username`, `phone`) VALUES
(1, 'localhost', 'admin@example.com', 'afifi', '081234567890'),
(2, 'toko-b.com', 'tokob@example.com', 'owner_b', '089876543210')
ON DUPLICATE KEY UPDATE `domain`=`domain`;

-- --------------------------------------------------------
-- Table structure for `categories`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed categories for Tenant 1
INSERT INTO `categories` (`id`, `tenant_id`, `name`, `slug`, `description`, `image`) VALUES
(1, 1, 'Pakaian', 'pakaian', 'Koleksi pakaian pria dan wanita eksklusif', 'assets/uploads/kaos.png'),
(2, 1, 'Elektronik', 'elektronik', 'Gadget dan barang elektronik canggih terfavorit', 'assets/uploads/headphone.png'),
(3, 1, 'Aksesoris', 'aksesoris', 'Berbagai macam aksesoris gaya terkini', 'assets/uploads/jam.png'),
-- Categories for Tenant 2
(4, 2, 'Kebutuhan Rumah', 'kebutuhan-rumah', 'Peralatan rumah tangga pilihan terbaik', 'assets/uploads/kaos.png')
ON DUPLICATE KEY UPDATE `name`=`name`;

-- --------------------------------------------------------
-- Table structure for `products`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `category_id` INT DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `price` DECIMAL(12,2) DEFAULT 0,
  `stock` INT DEFAULT 0,
  `description` TEXT DEFAULT NULL,
  `thumbnail_image` VARCHAR(255) DEFAULT NULL,
  `prime` ENUM('Ya', 'Tidak') DEFAULT 'Tidak',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed products for Tenant 1
INSERT INTO `products` (`id`, `tenant_id`, `category_id`, `name`, `slug`, `price`, `stock`, `description`, `thumbnail_image`, `prime`) VALUES
(1, 1, 1, 'Kaos Polos Cotton Combed Premium', 'kaos-polos-cotton-combed-premium', 85000, 50, 'Kaos berbahan 100% Katun Combed 30s super lembut, adem, dan menyerap keringat. Cocok untuk penggunaan santai harian maupun hangout.', 'assets/uploads/kaos.png', 'Ya'),
(2, 1, 2, 'Headphone Wireless Bluetooth Bass', 'headphone-wireless-bluetooth-bass', 385000, 25, 'Headphone nirkabel kelas audio profesional dengan fitur Noise Cancellation aktif, suara bass mendalam, dan daya tahan baterai hingga 25 jam non-stop.', 'assets/uploads/headphone.png', 'Ya'),
(3, 1, 3, 'Jam Tangan Analog Minimalis Elegan', 'jam-tangan-analog-minimalis-elegan', 245000, 18, 'Jam tangan pria/wanita dengan desain bezel stainless steel ramping, kaca anti gores, serta tahan air hingga kedalaman 30m.', 'assets/uploads/jam.png', 'Ya'),
(4, 1, 1, 'Jaket Denim Casual Premium', 'jaket-denim-casual-premium', 290000, 12, 'Jaket jeans berdesain timeless dari bahan denim berkualitas tinggi yang tahan lama dan stylish di segala kesempatan.', 'assets/uploads/kaos.png', 'Tidak'),
-- Products for Tenant 2
(5, 2, 4, 'Set Panci Stainless Steel', 'set-panci-stainless-steel', 175000, 30, 'Set alat masak lengkap tahan karat.', 'assets/uploads/kaos.png', 'Ya')
ON DUPLICATE KEY UPDATE `name`=`name`;

-- --------------------------------------------------------
-- Table structure for `product_images`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `product_id` INT NOT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `alt` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed product images
INSERT INTO `product_images` (`id`, `tenant_id`, `product_id`, `image_url`, `alt`) VALUES
(1, 1, 1, 'assets/uploads/kaos.png', 'Tampak Depan Kaos Polos'),
(2, 1, 2, 'assets/uploads/headphone.png', 'Tampak Samping Headphone Wireless'),
(3, 1, 3, 'assets/uploads/jam.png', 'Tampak Detail Jam Tangan')
ON DUPLICATE KEY UPDATE `image_url`=`image_url`;

-- --------------------------------------------------------
-- Table structure for `features`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `features` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed features for Tenant 1
INSERT INTO `features` (`id`, `tenant_id`, `title`, `description`, `icon`) VALUES
(1, 1, 'Pengiriman Cepat 24 Jam', 'Pesanan Anda diproses dan dikirim secepatnya dengan konfirmasi resi instan.', 'bi bi-lightning-charge-fill'),
(2, 1, 'Produk 100% Original', 'Semua barang terjamin keasliannya dan telah melewati proses Quality Check ketat.', 'bi bi-patch-check-fill'),
(3, 1, 'Pembayaran & Order Mudah', 'Pesan langsung melalui WhatsApp atau sistem keranjang belanja serba praktis.', 'bi bi-whatsapp'),
(4, 1, 'Layanan Pelanggan CS 24/7', 'Tim customer service kami selalu siap membantu pertanyaan dan kendala Anda.', 'bi bi-headset')
ON DUPLICATE KEY UPDATE `title`=`title`;

-- --------------------------------------------------------
-- Table structure for `sosmed`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sosmed` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `name` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(100) DEFAULT NULL,
  `url` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sosmed for Tenant 1
INSERT INTO `sosmed` (`id`, `tenant_id`, `name`, `icon`, `url`) VALUES
(1, 1, 'Instagram', 'bi bi-instagram', 'https://instagram.com/toko_online'),
(2, 1, 'WhatsApp', 'bi bi-whatsapp', 'https://wa.me/6281234567890'),
(3, 1, 'Facebook', 'bi bi-facebook', 'https://facebook.com/toko_online'),
(4, 1, 'TikTok', 'bi bi-tiktok', 'https://tiktok.com/@toko_online')
ON DUPLICATE KEY UPDATE `name`=`name`;

-- --------------------------------------------------------
-- Table structure for `store`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `store` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tenant_id` INT NOT NULL DEFAULT 1,
  `key` VARCHAR(100) NOT NULL,
  `value` TEXT DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `tenant_key_unique` (`tenant_id`, `key`),
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed store settings for Tenant 1
INSERT INTO `store` (`id`, `tenant_id`, `key`, `value`) VALUES
(1, 1, 'name', 'TOKO MODERN SHOP'),
(2, 1, 'slogan', 'Pusat belanja online terpercaya dengan harga & kualitas terbaik'),
(3, 1, 'description', 'Menyediakan beragam pilihan produk pilihan: pakaian stylish, gadget canggih, hingga aksesoris masa kini. Garansi memuaskan!'),
(4, 1, 'hero_title', 'Promo Hemat Hingga 40%! 🔥'),
(5, 1, 'hero_subtitle', 'Dapatkan penawaran terbatas untuk koleksi produk terfavorit bulan ini.'),
(6, 1, 'logo', 'assets/uploads/kaos.png'),
(7, 1, 'favicon', 'assets/uploads/kaos.png'),
(8, 1, 'tema', 'tema_modern'),
(9, 1, 'phone', '081234567890'),
(10, 1, 'whatsapp', '6281234567890'),
(11, 1, 'address', 'Jl. Jendral Sudirman No. 88, Jakarta Selatan'),
(12, 1, 'email', 'cs@tokomodernshop.com'),

-- Store settings for Tenant 2
(13, 2, 'name', 'TOKO B HOUSEHOLD'),
(14, 2, 'slogan', 'Perlengkapan rumah tangga terlengkap'),
(15, 2, 'whatsapp', '6289876543210')
ON DUPLICATE KEY UPDATE `key`=`key`;

SET FOREIGN_KEY_CHECKS=1;
