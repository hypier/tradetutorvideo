-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 08:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `your_videos_channel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ads`
--

CREATE TABLE `tbl_ads` (
  `id` int(11) NOT NULL,
  `ad_status` varchar(5) NOT NULL DEFAULT 'on',
  `ad_type` varchar(45) NOT NULL DEFAULT 'admob',
  `backup_ads` varchar(45) NOT NULL DEFAULT 'none',
  `admob_publisher_id` varchar(45) NOT NULL DEFAULT '0',
  `admob_app_id` varchar(255) NOT NULL DEFAULT '0',
  `admob_banner_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `admob_interstitial_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `admob_native_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `admob_app_open_ad_unit_id` varchar(255) NOT NULL DEFAULT '''0''',
  `ad_manager_banner_unit_id` varchar(255) NOT NULL DEFAULT '/6499/example/banner',
  `ad_manager_interstitial_unit_id` varchar(255) NOT NULL DEFAULT '/6499/example/interstitial',
  `ad_manager_native_unit_id` varchar(255) NOT NULL DEFAULT '/6499/example/native',
  `ad_manager_app_open_ad_unit_id` varchar(255) NOT NULL DEFAULT '/6499/example/app-open',
  `fan_banner_unit_id` varchar(255) NOT NULL DEFAULT 'IMG_16_9_APP_INSTALL#1102290040176998_1102321626840506',
  `fan_interstitial_unit_id` varchar(255) NOT NULL DEFAULT 'IMG_16_9_APP_INSTALL#1102290040176998_1103218190084183',
  `fan_native_unit_id` varchar(255) NOT NULL DEFAULT 'IMG_16_9_APP_INSTALL#1102290040176998_1142394442833224',
  `ironsource_app_key` varchar(255) NOT NULL DEFAULT '85460dcd',
  `ironsource_banner_placement_name` varchar(255) NOT NULL DEFAULT 'DefaultBanner',
  `ironsource_interstitial_placement_name` varchar(255) NOT NULL DEFAULT 'DefaultInterstitial',
  `wortise_app_id` varchar(255) NOT NULL DEFAULT 'test-app-id',
  `wortise_banner_unit_id` varchar(255) NOT NULL DEFAULT 'test-banner',
  `wortise_interstitial_unit_id` varchar(255) NOT NULL DEFAULT 'test-interstitial',
  `wortise_native_unit_id` varchar(255) NOT NULL DEFAULT 'test-native',
  `wortise_app_open_unit_id` varchar(255) NOT NULL DEFAULT 'test-app-open',
  `startapp_app_id` varchar(255) NOT NULL DEFAULT '0',
  `unity_game_id` varchar(255) NOT NULL DEFAULT '0',
  `unity_banner_placement_id` varchar(255) NOT NULL DEFAULT 'banner',
  `unity_interstitial_placement_id` varchar(255) NOT NULL DEFAULT 'video',
  `applovin_banner_ad_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `applovin_interstitial_ad_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `applovin_native_ad_manual_unit_id` varchar(45) NOT NULL DEFAULT '0',
  `applovin_app_open_ad_unit_id` varchar(255) NOT NULL DEFAULT '0',
  `applovin_banner_mrec_zone_id` varchar(255) NOT NULL DEFAULT '0',
  `applovin_banner_zone_id` varchar(45) NOT NULL DEFAULT '0',
  `applovin_interstitial_zone_id` varchar(45) NOT NULL DEFAULT '0',
  `interstitial_ad_interval` int(11) NOT NULL DEFAULT 3,
  `native_ad_interval` int(11) NOT NULL DEFAULT 20,
  `native_ad_index` int(11) NOT NULL DEFAULT 4,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ads`
--

INSERT INTO `tbl_ads` (`id`, `ad_status`, `ad_type`, `backup_ads`, `admob_publisher_id`, `admob_app_id`, `admob_banner_unit_id`, `admob_interstitial_unit_id`, `admob_native_unit_id`, `admob_app_open_ad_unit_id`, `ad_manager_banner_unit_id`, `ad_manager_interstitial_unit_id`, `ad_manager_native_unit_id`, `ad_manager_app_open_ad_unit_id`, `fan_banner_unit_id`, `fan_interstitial_unit_id`, `fan_native_unit_id`, `ironsource_app_key`, `ironsource_banner_placement_name`, `ironsource_interstitial_placement_name`, `wortise_app_id`, `wortise_banner_unit_id`, `wortise_interstitial_unit_id`, `wortise_native_unit_id`, `wortise_app_open_unit_id`, `startapp_app_id`, `unity_game_id`, `unity_banner_placement_id`, `unity_interstitial_placement_id`, `applovin_banner_ad_unit_id`, `applovin_interstitial_ad_unit_id`, `applovin_native_ad_manual_unit_id`, `applovin_app_open_ad_unit_id`, `applovin_banner_mrec_zone_id`, `applovin_banner_zone_id`, `applovin_interstitial_zone_id`, `interstitial_ad_interval`, `native_ad_interval`, `native_ad_index`, `date_time`) VALUES
(1, 'on', 'admob', 'none', 'pub-3940256099942544', 'ca-app-pub-3940256099942544~3347511713', 'ca-app-pub-3940256099942544/6300978111', 'ca-app-pub-3940256099942544/1033173712', 'ca-app-pub-3940256099942544/2247696110', 'ca-app-pub-3940256099942544/3419835294', '/6499/example/banner', '/6499/example/interstitial', '/6499/example/native', '/6499/example/app-open', 'IMG_16_9_APP_INSTALL#1102290040176998_1102321626840506', 'IMG_16_9_APP_INSTALL#1102290040176998_1103218190084183', 'IMG_16_9_APP_INSTALL#1102290040176998_1142394442833224', '85460dcd', 'DefaultBanner', 'DefaultInterstitial', 'test-app-id', 'test-banner', 'test-interstitial', 'test-native', 'test-app-open', '0', '4089993', 'banner', 'video', '0', '0', '0', '0', '0', '0', '0', 3, 10, 2, '2023-05-12 06:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ads_placement`
--

CREATE TABLE `tbl_ads_placement` (
  `ads_placement_id` int(11) NOT NULL DEFAULT 1,
  `banner_home` int(11) NOT NULL DEFAULT 1,
  `banner_post_details` int(11) NOT NULL DEFAULT 1,
  `banner_category_details` int(11) NOT NULL DEFAULT 1,
  `banner_search` int(11) NOT NULL DEFAULT 1,
  `interstitial_post_list` int(11) NOT NULL DEFAULT 1,
  `interstitial_post_details` int(11) NOT NULL DEFAULT 1,
  `native_ad_post_list` int(11) NOT NULL DEFAULT 1,
  `native_ad_post_details` int(11) NOT NULL DEFAULT 1,
  `native_ad_exit_dialog` int(11) NOT NULL DEFAULT 1,
  `app_open_ad_on_start` int(11) NOT NULL DEFAULT 1,
  `app_open_ad_on_resume` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ads_placement`
--

INSERT INTO `tbl_ads_placement` (`ads_placement_id`, `banner_home`, `banner_post_details`, `banner_category_details`, `banner_search`, `interstitial_post_list`, `interstitial_post_details`, `native_ad_post_list`, `native_ad_post_details`, `native_ad_exit_dialog`, `app_open_ad_on_start`, `app_open_ad_on_resume`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_config`
--

CREATE TABLE `tbl_app_config` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL,
  `redirect_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`) VALUES
(1, 'Funny', '8638-2016-09-11.png'),
(2, 'Gaming', '1113-2016-09-11.png'),
(3, 'Amazing', '0758-2016-09-11.png'),
(4, 'Music', '5090-2016-09-11.png'),
(5, 'Sports', '6257-2017-03-06.png'),
(6, 'Kids', '6007-2020-04-25.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fcm_template`
--

CREATE TABLE `tbl_fcm_template` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Notification',
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_fcm_template`
--

INSERT INTO `tbl_fcm_template` (`id`, `message`, `image`, `title`, `link`) VALUES
(1, 'Hello World, This is Your Videos Channel App, you can purchase it on Codecanyon officially.', '1008-2020-04-25.jpg', 'Your Videos Channel 5.0.0', 'https://codecanyon.net/item/your-videos-channel/11395325');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_url` varchar(500) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `video_thumbnail` varchar(255) NOT NULL,
  `video_duration` varchar(255) NOT NULL,
  `video_description` text NOT NULL,
  `video_type` varchar(45) NOT NULL,
  `video_status` int(11) NOT NULL DEFAULT 1,
  `size` varchar(255) NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id`, `cat_id`, `video_title`, `video_url`, `video_id`, `video_thumbnail`, `video_duration`, `video_description`, `video_type`, `video_status`, `size`, `total_views`, `date_time`) VALUES
(1, 1, 'Top Funny Home Video Fails', 'https://www.youtube.com/watch?v=O3w0ALouv3E', 'O3w0ALouv3E', '', '10:20', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 2, '2018-02-12 14:01:54'),
(2, 2, 'The Amazing Spider Man 2', 'https://www.youtube.com/watch?v=o9kr9ZhydK0', 'o9kr9ZhydK0', '', '16:37', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 1, '2018-02-12 14:01:54'),
(3, 3, 'The Lucky People In the World', 'https://www.youtube.com/watch?v=f-LqV6Vq8S4', 'f-LqV6Vq8S4', '', '12:21', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 3, '2018-02-12 14:01:54'),
(4, 4, 'Satu Indonesiaku Persembahan untuk Negeri', 'https://www.youtube.com/watch?v=fcIML2MI_U0', 'fcIML2MI_U0', '', '7:18', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 9, '2018-02-12 14:01:54'),
(5, 5, 'Crazy Football High Level Skills', 'https://www.youtube.com/watch?v=jIuwP1tLRnM', 'jIuwP1tLRnM', '', '6:07', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 3, '2018-02-12 14:01:54'),
(6, 4, 'Jalani Mimpi Video Clip of Noah Band', 'https://www.youtube.com/watch?v=MhaWRStfP_c', 'MhaWRStfP_c', '', '04:02', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 7, '2018-02-12 14:01:54'),
(7, 1, 'Tujhme Rab Dikhta Hai by Shreya Ghoshal', 'https://www.youtube.com/watch?v=KQc3bAItPEw', 'KQc3bAItPEw', '', '02:09', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 6, '2018-02-12 14:01:54'),
(8, 4, 'Tiba2 Ku Menangis - Koes Plus Live Concert', 'https://www.youtube.com/watch?v=PuQjXiGdPAk', 'PuQjXiGdPAk', '', '03:11', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 13, '2018-02-12 14:01:54'),
(9, 3, 'Top 5 most Advanced Space Technology Countries', 'https://www.youtube.com/watch?v=E-3GfI9yZOI', 'E-3GfI9yZOI', '', '02:45', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'youtube', 1, '', 22, '2018-02-12 14:01:54'),
(10, 6, 'My Name Song', 'https://www.youtube.com/watch?v=95EFNsXgRhQ', '95EFNsXgRhQ', '', '04:01', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'youtube', 1, '', 2, '2020-04-25 15:38:08'),
(11, 4, 'Black Clover Opening 10', 'https://www.youtube.com/watch?v=8-6tfOK47uc', '8-6tfOK47uc', '', '03:31', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'youtube', 1, '', 2, '2020-04-25 15:38:41'),
(12, 5, 'Bugatti Vision GT vs Super Cars at Highlands', 'https://www.youtube.com/watch?v=bHWgc5MPnPA', 'bHWgc5MPnPA', '', '11:32', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'youtube', 1, '', 6, '2020-04-25 15:39:05'),
(13, 6, 'Dinosaur Day Song', 'https://www.youtube.com/watch?v=P10p7ALXkcU', 'P10p7ALXkcU', '', '03:20', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'youtube', 1, '', 13, '2020-04-25 15:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_license`
--

CREATE TABLE `tbl_license` (
  `id` int(11) NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `license_type` varchar(45) NOT NULL,
  `purchase_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_fcm_key` text NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `package_name` varchar(500) NOT NULL DEFAULT 'com.app.yourvideoschannel',
  `onesignal_app_id` varchar(500) NOT NULL DEFAULT '0',
  `onesignal_rest_api_key` varchar(500) NOT NULL DEFAULT '0',
  `providers` varchar(45) NOT NULL DEFAULT 'onesignal',
  `protocol_type` varchar(10) NOT NULL DEFAULT 'http://',
  `fcm_notification_topic` varchar(255) NOT NULL DEFAULT 'your_videos_channel_topic',
  `privacy_policy` text NOT NULL,
  `youtube_api_key` varchar(255) NOT NULL DEFAULT '0',
  `more_apps_url` varchar(500) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_fcm_key`, `api_key`, `package_name`, `onesignal_app_id`, `onesignal_rest_api_key`, `providers`, `protocol_type`, `fcm_notification_topic`, `privacy_policy`, `youtube_api_key`, `more_apps_url`, `last_update`) VALUES
(1, '0', 'cda11QbXIO9Z4ly0a2khTFDPA3x6UgSVtCiYRjBqpsfL7w5neN', 'com.app.yourvideoschannel', '0', '0', 'firebase', 'http', 'your_videos_channel_topic', '<p>Solodroid built the Your Videos Channel app as a Free app. This SERVICE is provided by Solodroid at no cost and is intended for use as is.</p>\r\n\r\n<p>This page is used to inform visitors regarding my policies with the collection, use, and disclosure of Personal Information if anyone decided to use my Service.</p>\r\n\r\n<p>If you choose to use my Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that I collect is used for providing and improving the Service. I will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which are accessible at Your Videos Channel unless otherwise defined in this Privacy Policy.</p>\r\n\r\n<p><strong>Information Collection and Use</strong></p>\r\n\r\n<p>For a better experience, while using our Service, I may require you to provide us with certain personally identifiable information. The information that I request will be retained on your device and is not collected by me in any way.</p>\r\n\r\n<p>The app does use third-party services that may collect information used to identify you.</p>\r\n\r\n<p>Link to the privacy policy of third-party service providers used by the app</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\">Google Play Services</a></li>\r\n	<li><a href=\"https://support.google.com/admob/answer/6128543?hl=en\" target=\"_blank\">AdMob</a></li>\r\n	<li><a href=\"https://firebase.google.com/policies/analytics\" target=\"_blank\">Google Analytics for Firebase</a></li>\r\n	<li><a href=\"https://www.facebook.com/about/privacy/update/printable\" target=\"_blank\">Facebook</a></li>\r\n	<li><a href=\"https://unity3d.com/legal/privacy-policy\" target=\"_blank\">Unity</a></li>\r\n	<li><a href=\"https://onesignal.com/privacy_policy\" target=\"_blank\">One Signal</a></li>\r\n	<li><a href=\"https://www.applovin.com/privacy/\" target=\"_blank\">AppLovin</a></li>\r\n	<li><a href=\"https://www.startapp.com/privacy/\" target=\"_blank\">StartApp</a></li>\r\n</ul>\r\n\r\n<p><strong>Log Data</strong></p>\r\n\r\n<p>I want to inform you that whenever you use my Service, in a case of an error in the app I collect data and information (through third-party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing my Service, the time and date of your use of the Service, and other statistics.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device&#39;s internal memory.</p>\r\n\r\n<p>This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third-party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</p>\r\n\r\n<p><strong>Service Providers</strong></p>\r\n\r\n<p>I may employ third-party companies and individuals due to the following reasons:</p>\r\n\r\n<ul>\r\n	<li>To facilitate our Service;</li>\r\n	<li>To provide the Service on our behalf;</li>\r\n	<li>To perform Service-related services; or</li>\r\n	<li>To assist us in analyzing how our Service is used.</li>\r\n</ul>\r\n\r\n<p>I want to inform users of this Service that these third parties have access to their Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n\r\n<p><strong>Security</strong></p>\r\n\r\n<p>I value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and I cannot guarantee its absolute security.</p>\r\n\r\n<p><strong>Links to Other Sites</strong></p>\r\n\r\n<p>This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by me. Therefore, I strongly advise you to review the Privacy Policy of these websites. I have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n\r\n<p><strong>Children&rsquo;s Privacy</strong></p>\r\n\r\n<p>These Services do not address anyone under the age of 13. I do not knowingly collect personally identifiable information from children under 13 years of age. In the case I discover that a child under 13 has provided me with personal information, I immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact me so that I will be able to do the necessary actions.</p>\r\n\r\n<p><strong>Changes to This Privacy Policy</strong></p>\r\n\r\n<p>I may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. I will notify you of any changes by posting the new Privacy Policy on this page.</p>\r\n\r\n<p>This policy is effective as of 2022-02-28</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions or suggestions about my Privacy Policy, do not hesitate to contact me at help.solodroid@gmail.com.</p>\r\n', '0', 'https://play.google.com/store/apps/developer?id=Solodroid', '2022-10-10 14:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_role` enum('100','101','102') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `user_role`) VALUES
(1, 'admin', 'd82494f05d6917ba02f7aaa29689ccb444bb73f20380876cb05d1f37537b7892', 'help.solodroid@gmail.com', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ads`
--
ALTER TABLE `tbl_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ads_placement`
--
ALTER TABLE `tbl_ads_placement`
  ADD PRIMARY KEY (`ads_placement_id`);

--
-- Indexes for table `tbl_app_config`
--
ALTER TABLE `tbl_app_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_fcm_template`
--
ALTER TABLE `tbl_fcm_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_license`
--
ALTER TABLE `tbl_license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ads`
--
ALTER TABLE `tbl_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_app_config`
--
ALTER TABLE `tbl_app_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_fcm_template`
--
ALTER TABLE `tbl_fcm_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_license`
--
ALTER TABLE `tbl_license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
