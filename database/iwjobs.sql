-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2012 at 04:26 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iwjobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `CityId` int(11) NOT NULL AUTO_INCREMENT,
  `CityName` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` enum('0','1') NOT NULL COMMENT '''0''->Inactive,''1''->Active',
  PRIMARY KEY (`CityId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityId`, `CityName`, `Date`, `Status`) VALUES
(1, 'Carolina', '2012-05-03 19:04:05', '1'),
(2, 'North Carolina', '2012-05-03 19:04:25', '1'),
(3, 'Down Town', '2012-05-03 19:05:01', '1'),
(4, 'New Jersey', '2012-05-03 19:05:17', '1'),
(5, 'Oklahoma city', '2012-05-03 19:05:41', '1'),
(6, 'Manchester', '2012-05-03 19:06:15', '1'),
(7, 'Chelsey', '2012-05-03 19:06:27', '1'),
(8, 'Liverpool', '2012-05-03 19:06:43', '1'),
(9, 'Chicago', '2012-05-03 19:06:57', '1'),
(10, 'California', '2012-05-03 19:07:07', '1'),
(11, 'Los Angeles', '2012-05-03 19:07:30', '1'),
(12, 'Southamptom', '2012-05-03 19:08:11', '1'),
(13, 'Sent Luis', '2012-05-03 19:08:51', '1'),
(14, 'New Castle', '2012-05-03 19:09:36', '1'),
(15, 'Stoke city', '2012-05-03 19:09:57', '1'),
(16, 'Michigaan', '2012-05-03 19:10:29', '1'),
(17, 'Detroit', '2012-05-03 19:11:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `ContacId` varchar(50) NOT NULL,
  `RecruiterId` varchar(50) NOT NULL,
  `UserId` varchar(50) NOT NULL,
  `Message` mediumtext NOT NULL,
  `AddedDate` datetime NOT NULL,
  `Status` enum('0','1','3') NOT NULL COMMENT '''0''->unread,''1''->read,''3''->delete',
  PRIMARY KEY (`ContacId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContacId`, `RecruiterId`, `UserId`, `Message`, `AddedDate`, `Status`) VALUES
('1337173644UKQPYSDF', '1336651020EYAPL', '1336465929AHILDZ', 'hi', '2012-05-16 13:07:24', '1'),
('1337174292LFZMHYJA', '1336651020EYAPL', '1336465929AHILDZ', 'hey', '2012-05-16 13:18:12', '1'),
('1337175150EABFGTZU', '1336651020EYAPL', '1336468684MFDCXE', 'hello', '2012-05-16 13:32:30', '1'),
('1337176260FCJMOWHX', '1336651020EYAPL', '1336465929AHILDZ', 'hi', '2012-05-16 13:51:00', '1'),
('1337176297DKAQIWTB', '1336651020EYAPL', '1336465929AHILDZ', 'hey', '2012-05-16 13:51:37', '1'),
('1337176426PLBHTIJZ', '1336651020EYAPL', '1336465929AHILDZ', 'hmm..', '2012-05-16 13:53:46', '1'),
('1337176821YRKVFNLA', '1336651020EYAPL', '1336465929AHILDZ', 'hi', '2012-05-16 14:00:21', '1'),
('1337230014QRWHCEDM', '1337070107TXEDYN', '1336468684MFDCXE', 'hey !!', '2012-05-17 04:46:54', '1'),
('1337232203JDYPGLOT', '1337070107TXEDYN', '1336465929AHILDZ', 'hello !!', '2012-05-17 05:23:23', '1'),
('1337247583QRUYHGKE', '1336651020EYAPL', '1336465929AHILDZ', 'I want to hire you.', '2012-05-17 09:39:43', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `Id` varchar(50) NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) NOT NULL,
  `CountryCode` varchar(5) NOT NULL,
  `Subject` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Ip` varchar(100) NOT NULL,
  `AddedDate` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--


-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `CountryCode` varchar(50) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `Status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>inactive, 1=>active, 3=>delete',
  `AddedDate` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  PRIMARY KEY (`CountryCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Country Details';

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`CountryCode`, `CountryName`, `Status`, `AddedDate`, `UpdatedDate`) VALUES
('AD', 'Andorra', '1', '2011-04-20 13:33:27', '0000-00-00 00:00:00'),
('AE', 'United Arab Emirates', '1', '2011-04-20 17:39:57', '2011-07-27 07:22:27'),
('AF', 'Afghanistan', '1', '2011-04-28 14:28:24', '2011-07-19 07:33:28'),
('AG', 'Antigua and Barbuda', '1', '2010-04-21 12:04:25', '0000-00-00 00:00:00'),
('AI', 'Anguilla', '1', '2011-04-20 13:35:30', '0000-00-00 00:00:00'),
('AL', 'Albania', '1', '2011-04-28 14:34:47', '2011-07-19 07:33:57'),
('AM', 'Armenia', '1', '2011-04-20 13:41:04', '0000-00-00 00:00:00'),
('AN', 'Netherlands Antilles', '1', '2011-04-20 16:39:17', '0000-00-00 00:00:00'),
('AO', 'Angola', '1', '2011-04-20 13:34:05', '0000-00-00 00:00:00'),
('AQ', 'Antarctica', '3', '2010-04-21 12:04:19', '0000-00-00 00:00:00'),
('AR', 'Argentina', '1', '2011-04-20 13:40:28', '0000-00-00 00:00:00'),
('AS', 'American Samoa', '1', '2011-04-20 13:31:59', '0000-00-00 00:00:00'),
('AT', 'Austria', '1', '2011-04-20 13:43:35', '0000-00-00 00:00:00'),
('AU', 'Australia', '1', '2011-04-20 13:42:55', '0000-00-00 00:00:00'),
('AW', 'Aruba', '1', '2011-04-20 13:41:53', '0000-00-00 00:00:00'),
('AZ', 'Azerbaijan', '1', '2011-04-20 13:44:40', '2011-07-19 13:57:52'),
('BA', 'Bosnia and Herzegovina', '3', '2010-04-21 12:09:25', '0000-00-00 00:00:00'),
('BB', 'Barbados', '1', '2011-04-20 13:48:00', '0000-00-00 00:00:00'),
('BD', 'Bangladesh', '1', '2011-04-20 13:46:56', '0000-00-00 00:00:00'),
('BE', 'Belgium', '1', '2011-04-20 13:51:10', '2011-07-19 13:53:36'),
('BF', 'Burkina Faso', '1', '2011-04-20 14:53:50', '0000-00-00 00:00:00'),
('BG', 'Bulgaria', '1', '2011-04-20 14:53:02', '0000-00-00 00:00:00'),
('BH', 'Bahrain', '1', '2011-04-20 13:46:21', '0000-00-00 00:00:00'),
('BI', 'Burundi', '1', '2011-04-20 14:54:52', '0000-00-00 00:00:00'),
('BJ', 'Benin', '1', '2011-04-20 13:52:26', '0000-00-00 00:00:00'),
('BM', 'Bermuda', '1', '2011-04-20 13:53:31', '0000-00-00 00:00:00'),
('BN', 'Brunei Darussalam', '3', '2010-04-21 12:10:40', '0000-00-00 00:00:00'),
('BO', 'Bolivia', '1', '2011-04-20 13:54:55', '0000-00-00 00:00:00'),
('BR', 'Brazil', '1', '2011-04-20 14:51:37', '0000-00-00 00:00:00'),
('BS', 'Bahamas', '1', '2011-04-20 13:45:20', '0000-00-00 00:00:00'),
('BT', 'Bhutan', '1', '2011-04-20 13:54:20', '2011-07-19 13:54:55'),
('BV', 'Bouvet Island', '3', '2010-04-21 12:10:00', '0000-00-00 00:00:00'),
('BW', 'Botswana', '1', '2011-04-20 13:56:07', '0000-00-00 00:00:00'),
('BY', 'Belarus', '1', '2011-04-20 13:50:45', '2011-07-19 13:53:01'),
('BZ', 'Belize', '1', '2011-04-20 13:51:33', '0000-00-00 00:00:00'),
('CA', 'Canada', '1', '2011-04-20 15:00:03', '2011-07-19 13:58:51'),
('CC', 'Cocos (Keeling) Islands', '3', '2010-04-21 12:12:15', '0000-00-00 00:00:00'),
('CF', 'Central African Republic', '1', '2011-04-20 15:15:21', '2011-07-27 07:04:14'),
('CG', 'Congo', '1', '2011-04-20 15:22:03', '0000-00-00 00:00:00'),
('CH', 'Switzerland', '1', '2011-04-20 17:30:00', '0000-00-00 00:00:00'),
('CK', 'Cook Islands', '1', '2011-04-20 15:22:53', '0000-00-00 00:00:00'),
('CL', 'Chile', '1', '2011-04-20 15:17:28', '0000-00-00 00:00:00'),
('CM', 'Cameroon', '3', '2010-04-21 12:11:04', '0000-00-00 00:00:00'),
('CN', 'China', '1', '2011-04-20 15:18:41', '0000-00-00 00:00:00'),
('CO', 'Colombia', '1', '2011-04-20 15:19:49', '2011-07-19 13:59:53'),
('CR', 'Costa Rica', '1', '2011-04-20 15:23:58', '0000-00-00 00:00:00'),
('CS', 'Czechoslovakia (former)', '3', '2010-04-21 12:13:06', '0000-00-00 00:00:00'),
('CU', 'Cuba', '3', '2010-04-21 12:12:48', '0000-00-00 00:00:00'),
('CV', 'Cape Verde', '1', '2011-04-20 15:01:46', '0000-00-00 00:00:00'),
('CX', 'Christmas Island', '3', '2010-04-21 12:12:09', '0000-00-00 00:00:00'),
('CY', 'Cyprus', '1', '2011-04-20 15:25:03', '2011-07-27 07:05:16'),
('CZ', 'Czech Republic', '1', '2011-04-20 15:25:47', '2011-07-27 07:05:47'),
('DE', 'Germany', '1', '2011-04-20 15:49:11', '0000-00-00 00:00:00'),
('DJ', 'Djibouti', '1', '2011-04-20 15:28:09', '0000-00-00 00:00:00'),
('DK', 'Denmark', '1', '2011-04-20 15:27:16', '0000-00-00 00:00:00'),
('DM', 'Dominica', '1', '2011-04-20 15:28:51', '0000-00-00 00:00:00'),
('DO', 'Dominican Republic', '1', '2011-04-20 15:29:48', '2011-07-27 07:06:24'),
('DZ', 'Algeria', '1', '2011-04-20 13:31:39', '0000-00-00 00:00:00'),
('EC', 'Ecuador', '1', '2011-04-20 15:31:20', '0000-00-00 00:00:00'),
('EE', 'Estonia', '1', '2011-04-20 15:35:41', '0000-00-00 00:00:00'),
('EG', 'Egypt', '1', '2011-04-20 15:31:56', '0000-00-00 00:00:00'),
('EH', 'Western Sahara', '3', '2010-04-21 12:45:58', '0000-00-00 00:00:00'),
('ER', 'Eritrea', '1', '2011-04-20 15:34:45', '0000-00-00 00:00:00'),
('ES', 'Spain', '1', '2011-04-20 17:22:13', '2011-07-27 07:20:12'),
('ET', 'Ethiopia', '1', '2011-04-20 15:36:21', '2011-07-27 07:07:26'),
('FI', 'Finland', '1', '2011-04-20 15:38:11', '0000-00-00 00:00:00'),
('FJ', 'Fiji', '1', '2011-04-20 15:37:46', '0000-00-00 00:00:00'),
('FK', 'Falkland Islands (Malvinas)', '3', '2010-04-21 12:14:40', '0000-00-00 00:00:00'),
('FM', 'Micronesia', '3', '2010-04-21 12:32:46', '0000-00-00 00:00:00'),
('FO', 'Faroe Islands', '1', '2011-04-20 15:37:13', '0000-00-00 00:00:00'),
('FR', 'France', '1', '2011-04-20 15:38:48', '0000-00-00 00:00:00'),
('FX', 'France, Metropolitan', '3', '2010-04-21 12:15:14', '0000-00-00 00:00:00'),
('GA', 'Gabon', '1', '2011-04-20 15:42:15', '2011-07-27 07:09:28'),
('GB', 'Great Britain (UK)', '1', '2010-04-21 12:17:14', '2011-07-27 07:10:16'),
('GD', 'Grenada', '1', '2011-04-20 15:51:51', '0000-00-00 00:00:00'),
('GE', 'Georgia', '1', '2011-04-20 15:48:45', '0000-00-00 00:00:00'),
('GF', 'French Guiana', '1', '2011-04-20 15:39:46', '2011-07-27 07:08:30'),
('GH', 'Ghana', '1', '2011-04-20 15:49:46', '0000-00-00 00:00:00'),
('GI', 'Gibraltar', '1', '2010-04-21 12:17:10', '0000-00-00 00:00:00'),
('GL', 'Greenland', '1', '2011-04-20 15:51:11', '0000-00-00 00:00:00'),
('GM', 'Gambia', '1', '2011-04-20 15:43:07', '0000-00-00 00:00:00'),
('GN', 'Guinea', '1', '2011-04-20 15:54:47', '0000-00-00 00:00:00'),
('GP', 'Guadeloupe', '3', '2010-04-21 12:17:35', '0000-00-00 00:00:00'),
('GQ', 'Equatorial Guinea', '1', '2011-04-20 15:33:59', '0000-00-00 00:00:00'),
('GR', 'Greece', '1', '2011-04-20 15:50:51', '0000-00-00 00:00:00'),
('GS', 'S. Georgia and S. Sandwich Isls.', '3', '2010-04-21 12:40:04', '0000-00-00 00:00:00'),
('GT', 'Guatemala', '1', '2011-04-20 15:53:48', '0000-00-00 00:00:00'),
('GU', 'Guam', '1', '2011-04-20 15:52:39', '0000-00-00 00:00:00'),
('GW', 'Guinea-Bissau', '1', '2011-04-20 15:55:22', '0000-00-00 00:00:00'),
('GY', 'Guyana', '1', '2011-04-20 15:55:45', '0000-00-00 00:00:00'),
('HK', 'Hong Kong', '1', '2011-04-20 15:59:33', '0000-00-00 00:00:00'),
('HM', 'Heard and McDonald Islands', '3', '2010-04-21 12:18:09', '0000-00-00 00:00:00'),
('HN', 'Honduras', '1', '2011-04-20 15:57:40', '0000-00-00 00:00:00'),
('HR', 'Croatia (Hrvatska)', '1', '2010-04-21 12:12:43', '0000-00-00 00:00:00'),
('HT', 'Haiti', '1', '2011-04-20 15:56:20', '2011-07-27 07:10:51'),
('HU', 'Hungary', '1', '2011-04-20 16:00:14', '2011-07-27 07:11:24'),
('ID', 'Indonesia', '1', '2011-04-20 16:01:34', '0000-00-00 00:00:00'),
('IE', 'Ireland', '1', '2011-04-20 16:02:59', '0000-00-00 00:00:00'),
('IL', 'Israel', '1', '2011-04-20 16:03:28', '0000-00-00 00:00:00'),
('IN', 'India', '1', '2011-04-20 13:25:26', '0000-00-00 00:00:00'),
('IO', 'British Indian Ocean Territory', '3', '2010-04-21 12:10:33', '0000-00-00 00:00:00'),
('IQ', 'Iraq', '1', '2011-04-20 16:02:22', '0000-00-00 00:00:00'),
('IR', 'Iran', '3', '2010-04-21 12:28:09', '0000-00-00 00:00:00'),
('IS', 'Iceland', '1', '2011-04-20 16:00:44', '0000-00-00 00:00:00'),
('IT', 'Italy', '1', '2011-04-20 16:03:54', '0000-00-00 00:00:00'),
('JM', 'Jamaica', '1', '2011-04-20 16:04:30', '0000-00-00 00:00:00'),
('JO', 'Jordan', '1', '2011-04-20 16:05:58', '0000-00-00 00:00:00'),
('JP', 'Japan', '1', '2011-04-20 16:04:55', '2011-07-27 07:12:05'),
('KE', 'Kenya', '1', '2011-04-20 16:07:41', '0000-00-00 00:00:00'),
('KG', 'Kyrgyzstan', '1', '2011-04-20 16:11:13', '2011-07-27 07:12:57'),
('KH', 'Cambodia', '1', '2011-04-20 14:55:15', '0000-00-00 00:00:00'),
('KI', 'Kiribati', '3', '2010-04-21 12:29:42', '0000-00-00 00:00:00'),
('KM', 'Comoros', '3', '2010-04-21 12:12:25', '0000-00-00 00:00:00'),
('KN', 'Saint Kitts and Nevis', '1', '2010-04-21 12:40:10', '0000-00-00 00:00:00'),
('KP', 'Korea (North)', '1', '2010-04-21 12:29:47', '0000-00-00 00:00:00'),
('KR', 'Korea (South)', '1', '2011-04-20 16:10:09', '0000-00-00 00:00:00'),
('KW', 'Kuwait', '1', '2011-04-20 16:10:45', '0000-00-00 00:00:00'),
('KY', 'Cayman Islands', '1', '2011-04-20 15:14:45', '0000-00-00 00:00:00'),
('KZ', 'Kazakhstan', '1', '2011-04-20 16:07:11', '2011-07-27 07:12:31'),
('LA', 'Laos', '1', '2011-04-20 16:12:22', '0000-00-00 00:00:00'),
('LB', 'Lebanon', '1', '2011-04-20 16:13:35', '2011-07-27 07:13:42'),
('LC', 'Saint Lucia', '1', '2010-04-21 12:40:16', '2011-07-27 07:18:40'),
('LI', 'Liechtenstein', '1', '2011-04-20 16:15:54', '0000-00-00 00:00:00'),
('LK', 'Sri Lanka', '1', '2011-04-20 17:22:45', '0000-00-00 00:00:00'),
('LR', 'Liberia', '1', '2011-04-20 16:14:45', '0000-00-00 00:00:00'),
('LS', 'Lesotho', '1', '2011-04-20 16:14:13', '0000-00-00 00:00:00'),
('LT', 'Lithuania', '1', '2011-04-20 16:16:26', '0000-00-00 00:00:00'),
('LU', 'Luxembourg', '1', '2011-04-20 16:17:16', '0000-00-00 00:00:00'),
('LV', 'Latvia', '1', '2011-04-20 16:12:48', '0000-00-00 00:00:00'),
('LY', 'Libya', '1', '2011-04-20 16:15:10', '0000-00-00 00:00:00'),
('MA', 'Morocco', '1', '2011-04-20 16:33:58', '0000-00-00 00:00:00'),
('MC', 'Monaco', '1', '2011-04-20 16:32:29', '2011-07-27 07:14:45'),
('MD', 'Moldova', '1', '2011-04-20 16:32:02', '0000-00-00 00:00:00'),
('MG', 'Madagascar', '1', '2011-04-20 16:18:41', '0000-00-00 00:00:00'),
('MH', 'Marshall Islands', '1', '2011-04-20 16:23:27', '0000-00-00 00:00:00'),
('MK', 'Macedonia', '1', '2011-04-20 16:18:14', '0000-00-00 00:00:00'),
('ML', 'Mali', '1', '2011-04-20 16:22:13', '2011-07-27 07:14:14'),
('MM', 'Myanmar', '3', '2010-04-21 12:33:28', '0000-00-00 00:00:00'),
('MN', 'Mongolia', '1', '2011-04-20 16:32:53', '0000-00-00 00:00:00'),
('MO', 'Macau', '1', '2011-04-20 16:17:49', '0000-00-00 00:00:00'),
('MP', 'Northern Mariana Islands', '3', '2010-04-21 12:35:02', '0000-00-00 00:00:00'),
('MQ', 'Martinique', '1', '2011-04-20 16:28:38', '0000-00-00 00:00:00'),
('MR', 'Mauritania', '1', '2011-04-20 16:29:15', '0000-00-00 00:00:00'),
('MS', 'Montserrat', '1', '2011-04-20 16:33:27', '0000-00-00 00:00:00'),
('MT', 'Malta', '1', '2011-04-20 16:22:52', '0000-00-00 00:00:00'),
('MU', 'Mauritius', '1', '2011-04-20 16:29:39', '0000-00-00 00:00:00'),
('MV', 'Maldives', '1', '2011-04-20 16:21:29', '0000-00-00 00:00:00'),
('MW', 'Malawi', '1', '2011-04-20 16:19:08', '0000-00-00 00:00:00'),
('MX', 'Mexico', '1', '2011-04-20 16:30:26', '0000-00-00 00:00:00'),
('MY', 'Malaysia', '1', '2011-04-20 16:19:43', '0000-00-00 00:00:00'),
('MZ', 'Mozambique', '1', '2011-04-20 16:34:26', '0000-00-00 00:00:00'),
('NA', 'Namibia', '1', '2011-04-20 16:35:26', '0000-00-00 00:00:00'),
('NC', 'New Caledonia', '1', '2011-04-20 16:42:20', '0000-00-00 00:00:00'),
('NE', 'Niger', '1', '2011-04-20 16:44:29', '2011-07-27 07:15:45'),
('NF', 'Norfolk Island', '3', '2010-04-21 12:34:48', '0000-00-00 00:00:00'),
('NG', 'Nigeria', '1', '2011-04-20 16:45:00', '0000-00-00 00:00:00'),
('NI', 'Nicaragua', '1', '2011-04-20 16:43:43', '0000-00-00 00:00:00'),
('NL', 'Netherlands', '1', '2011-04-20 16:38:48', '2011-07-27 07:15:13'),
('NO', 'Norway', '1', '2011-04-20 16:47:00', '0000-00-00 00:00:00'),
('NP', 'Nepal', '1', '2011-04-20 16:36:39', '0000-00-00 00:00:00'),
('NR', 'Nauru', '3', '2010-04-21 12:33:35', '0000-00-00 00:00:00'),
('NT', 'Neutral Zone', '3', '2010-04-21 12:34:03', '0000-00-00 00:00:00'),
('NU', 'Niue', '3', '2010-04-21 10:50:27', '0000-00-00 00:00:00'),
('NZ', 'New Zealand (Aotearoa)', '1', '2010-04-21 12:34:12', '0000-00-00 00:00:00'),
('OM', 'Oman', '1', '2011-04-20 16:47:26', '2011-07-27 07:16:14'),
('PA', 'Panama', '1', '2011-04-20 16:48:55', '0000-00-00 00:00:00'),
('PE', 'Peru', '1', '2011-04-20 16:50:59', '2011-07-27 07:17:00'),
('PF', 'French Polynesia', '1', '2011-04-20 15:40:35', '2011-07-27 07:08:51'),
('PG', 'Papua New Guinea', '1', '2011-04-20 16:49:36', '0000-00-00 00:00:00'),
('PH', 'Philippines', '3', '2010-04-21 12:35:43', '0000-00-00 00:00:00'),
('PK', 'Pakistan', '1', '2011-04-20 16:47:54', '2011-07-27 07:16:29'),
('PL', 'Poland', '1', '2011-04-20 16:52:12', '0000-00-00 00:00:00'),
('PM', 'St. Pierre and Miquelon', '3', '2010-04-21 12:42:04', '0000-00-00 00:00:00'),
('PN', 'Pitcairn', '3', '2010-04-21 12:35:47', '0000-00-00 00:00:00'),
('PR', 'Puerto Rico', '1', '2011-04-20 16:53:22', '0000-00-00 00:00:00'),
('PT', 'Portugal', '1', '2011-04-20 16:52:45', '0000-00-00 00:00:00'),
('PW', 'Palau', '1', '2011-04-20 16:48:25', '0000-00-00 00:00:00'),
('PY', 'Paraguay', '1', '2011-04-20 16:50:27', '0000-00-00 00:00:00'),
('QA', 'Qatar', '1', '2011-04-20 16:54:21', '0000-00-00 00:00:00'),
('RE', 'Reunion', '1', '2011-04-20 16:56:08', '2011-07-27 07:17:32'),
('RO', 'Romania', '1', '2011-04-20 16:56:42', '0000-00-00 00:00:00'),
('RU', 'Russian Federation', '1', '2010-04-21 12:38:12', '2011-07-27 07:18:02'),
('RW', 'Rwanda', '1', '2011-04-20 16:57:30', '0000-00-00 00:00:00'),
('SA', 'Saudi Arabia', '1', '2011-04-20 17:16:19', '0000-00-00 00:00:00'),
('Sb', 'Solomon Islands', '3', '2010-04-21 12:41:34', '0000-00-00 00:00:00'),
('SC', 'Seychelles', '1', '2011-04-20 17:17:12', '0000-00-00 00:00:00'),
('SD', 'Sudan', '3', '2010-04-21 12:42:09', '0000-00-00 00:00:00'),
('SE', 'Sweden', '3', '2010-04-21 12:42:31', '0000-00-00 00:00:00'),
('SG', 'Singapore', '1', '2011-04-20 17:18:43', '0000-00-00 00:00:00'),
('SH', 'St. Helena', '3', '2010-04-21 12:41:59', '0000-00-00 00:00:00'),
('SI', 'Slovenia', '1', '2011-04-20 17:19:47', '0000-00-00 00:00:00'),
('SJ', 'Svalbard and Jan Mayen Islands', '3', '2010-04-21 12:42:20', '0000-00-00 00:00:00'),
('SK', 'Slovak Republic', '1', '2011-04-20 17:19:15', '2011-07-27 07:19:08'),
('SL', 'Sierra Leone', '1', '2011-04-20 17:17:56', '0000-00-00 00:00:00'),
('SM', 'San Marino', '1', '2011-04-20 17:14:59', '0000-00-00 00:00:00'),
('SN', 'Senegal', '1', '2011-04-20 17:16:47', '0000-00-00 00:00:00'),
('SO', 'Somalia', '3', '2010-04-21 12:41:40', '0000-00-00 00:00:00'),
('SR', 'Suriname', '1', '2011-04-20 17:27:59', '0000-00-00 00:00:00'),
('ST', 'Sao Tome and Principe', '3', '2010-04-21 12:40:47', '0000-00-00 00:00:00'),
('SU', 'USSR (former)', '3', '2010-04-21 12:45:07', '0000-00-00 00:00:00'),
('SV', 'El Salvador', '1', '2011-04-20 15:33:08', '0000-00-00 00:00:00'),
('SY', 'Syria', '1', '2011-04-20 17:30:28', '0000-00-00 00:00:00'),
('SZ', 'Swaziland', '1', '2011-04-20 17:29:07', '0000-00-00 00:00:00'),
('TC', 'Turks and Caicos Islands', '1', '2011-04-20 17:37:51', '0000-00-00 00:00:00'),
('TD', 'Chad', '1', '2011-04-20 15:16:59', '0000-00-00 00:00:00'),
('TF', 'French Southern Territories', '3', '2010-04-21 12:15:46', '0000-00-00 00:00:00'),
('TG', 'Togo', '1', '2011-04-20 17:33:01', '0000-00-00 00:00:00'),
('TH', 'Thailand', '1', '2011-04-20 17:32:33', '0000-00-00 00:00:00'),
('TJ', 'Tajikistan', '3', '2010-04-21 12:43:06', '0000-00-00 00:00:00'),
('TK', 'Tokelau', '3', '2010-04-21 12:43:26', '0000-00-00 00:00:00'),
('TM', 'Turkmenistan', '1', '2011-04-20 17:37:04', '2011-07-27 07:21:43'),
('TN', 'Tunisia', '1', '2011-04-20 17:35:38', '2011-07-27 07:20:52'),
('TO', 'Tonga', '1', '2011-04-20 17:34:16', '0000-00-00 00:00:00'),
('TP', 'East Timor', '1', '2011-04-20 15:30:38', '0000-00-00 00:00:00'),
('TR', 'Turkey', '1', '2011-04-20 17:36:27', '2011-07-27 07:21:12'),
('TT', 'Trinidad and Tobago', '1', '2011-04-20 17:35:03', '0000-00-00 00:00:00'),
('TV', 'Tuvalu', '3', '2010-04-21 12:44:06', '0000-00-00 00:00:00'),
('TW', 'Taiwan', '1', '2011-04-20 17:30:53', '0000-00-00 00:00:00'),
('TZ', 'Tanzania', '1', '2011-04-20 17:31:59', '0000-00-00 00:00:00'),
('UA', 'Ukraine', '1', '2011-04-20 17:39:20', '0000-00-00 00:00:00'),
('UG', 'Uganda', '1', '2011-04-20 17:38:50', '0000-00-00 00:00:00'),
('UK', 'United Kingdom', '1', '2010-04-21 12:44:38', '0000-00-00 00:00:00'),
('UM', 'US Minor Outlying Islands', '3', '2010-04-21 12:45:03', '0000-00-00 00:00:00'),
('US', 'United States', '1', '2010-04-21 12:44:46', '0000-00-00 00:00:00'),
('UY', 'Uruguay', '1', '2011-04-20 17:41:28', '0000-00-00 00:00:00'),
('UZ', 'Uzbekistan', '3', '2010-04-21 12:45:12', '0000-00-00 00:00:00'),
('VA', 'Vatican City State (Holy See)', '1', '2010-04-21 12:45:21', '0000-00-00 00:00:00'),
('VC', 'Saint Vincent and the Grenadines', '3', '2010-04-21 12:40:20', '0000-00-00 00:00:00'),
('VE', 'Venezuela', '3', '2010-04-21 12:45:25', '0000-00-00 00:00:00'),
('VG', 'Virgin Islands (British)', '1', '2010-04-21 12:45:35', '2011-07-27 07:23:08'),
('VI', 'Virgin Islands (U.S.)', '1', '2011-04-20 17:47:03', '2011-07-27 07:23:26'),
('VN', 'Viet Nam', '1', '2011-04-20 17:45:48', '0000-00-00 00:00:00'),
('VU', 'Vanuatu', '1', '2011-04-20 17:44:09', '0000-00-00 00:00:00'),
('WF', 'Wallis and Futuna Islands', '1', '2010-04-21 12:45:53', '0000-00-00 00:00:00'),
('WS', 'Samoa', '1', '2011-04-20 17:14:26', '0000-00-00 00:00:00'),
('YE', 'Yemen', '1', '2010-04-21 12:46:10', '0000-00-00 00:00:00'),
('YT', 'Mayotte', '3', '2010-04-21 12:32:36', '0000-00-00 00:00:00'),
('YU', 'Yugoslavia', '3', '2010-04-21 12:46:14', '0000-00-00 00:00:00'),
('ZA', 'South Africa', '1', '2011-04-20 17:21:39', '2011-07-27 07:19:34'),
('ZM', 'Zambia', '1', '2011-04-20 17:50:48', '0000-00-00 00:00:00'),
('ZR', 'Zaire', '3', '2010-04-21 12:46:18', '0000-00-00 00:00:00'),
('ZW', 'Zimbabwe', '1', '2011-04-20 17:51:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Degree` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`Id`, `Degree`) VALUES
(1, 'B.tech'),
(2, 'M.tech'),
(3, 'BCA'),
(4, 'MCA'),
(5, 'BSC'),
(6, 'MSC'),
(7, 'MBA'),
(8, 'BSC(IT)'),
(9, 'MSC(IT)'),
(10, 'BHM'),
(11, 'BE'),
(12, 'ME'),
(13, 'Phd'),
(14, 'MS');

-- --------------------------------------------------------

--
-- Table structure for table `email_notification`
--

CREATE TABLE IF NOT EXISTS `email_notification` (
  `EmailCode` varchar(100) NOT NULL,
  `About` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Body` text NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  `Status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>inactive, 1=>active, 3=>delete',
  PRIMARY KEY (`EmailCode`),
  KEY `Status` (`Status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_notification`
--

INSERT INTO `email_notification` (`EmailCode`, `About`, `Subject`, `Body`, `UpdatedDate`, `Status`) VALUES
('candidate_signup', 'Notification sent to a candidate on signup', 'IwJobs :: Signup confirmation', '<p>Thank you for creating your own user account on iwjobs.com ({BASE_URL}). Please verify your username provided below.</p>\r\n<p><strong>Username:</strong> {ACCOUNT_USERNAME}</p>\r\n<p>To activate your account please click on the link below:</p>\r\n<p>{ACCOUNT_ACTIVATION_LINK}</p>\r\n<p>Imagine viewing hundreds of job openings presented by Top Recruitment Consultants of India at a single page is so simple at this section.</p>\r\n<p>For further assistance please contact us at {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of iwjobs.com. We hope to serve you better.</p>', '2011-08-01 10:56:59', '1'),
('change_password', 'Notification sent to a user confirming change of password', 'Gestorialowcost :: Your password has changed', '<p>This is to notify you that you have changed your password for your account on IwJobs.com. If there was a mistake, please feel free to contact us for any further assistance at {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of IwJobs.com. We hope to serve you better.</p>', '2011-08-01 10:56:23', '1'),
('forgot_password', 'Email sent to the account owner on request for password recovery.', 'Gestorialowcost :: Password recovery assistance', '<p>Welcome to IwJobs.com''s Password Recovery Assistance. To change your forgotten password please click the link below and enter a new password with a re-confirmation.</p>\r\n<p>{RESET_PASSWORD_LINK}</p>\r\n<p>For further assistance please contact {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of gestorialowcost. We hope to serve you better.</p>', '2011-08-01 10:56:04', '1'),
('contact_us', 'Email sent to the support when an user submitted any contact us request', 'Gestorialowcost :: Contact us request', '<p>This is to notify you that there is a new contact us request submission from an user. Below is the detailed excerpt of what the user has told or asked for in his submission.</p>\r\n<p><strong>Detailed Excerpt:</strong></p>\r\n<p><strong>Subject:</strong> {SUBJECT}</p>\r\n<p><strong>Message:</strong> {MESSAGE}</p>\r\n<p>Ip: {IP}</p>', '2011-08-01 10:55:51', '1'),
('change_email', 'Notification sent to a user confirming change of email', 'Gestorialowcost :: Your email has changed', '<p>This is to notify you that you have changed your email for your account on IwJobs.com. If there is a mistake, please feel free to contact us for any further assistance at {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of IwJobs.com. We hope to serve you better.</p>', '2012-05-09 12:05:42', '1'),
('recruiter_signup', 'Notification sent to a recruiter on signup', 'IwJobs :: Signup confirmation', '<p>Thank you for creating your own user account on iwjobs.com ({BASE_URL}). Please verify your username provided below.</p>\r\n<p><strong>Username:</strong> {ACCOUNT_USERNAME}</p>\r\n<p>To activate your account please click on the link below:</p>\r\n<p>{ACCOUNT_ACTIVATION_LINK}</p>\r\n<p>Hundreds of candidates are waiting for applying job openings presented by Top Recruitment Consultants of India at a single page is so simple at this section.</p>\r\n<p>For further assistance please contact us at {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of iwjobs.com. We hope to serve you better.</p>', '2012-05-09 12:05:42', '1'),
('contact_candidate', 'Notification sent to a candidate on contact', 'IwJobs :: Contact canidate for job', '<p>the following company send you a message.</p>\r\n<p><strong>Company :</strong> {COMPANY_NAME}</p>\r\n<p><strong>Message :</strong>{MESSAGE}</p>\r\n<p>Imagine viewing hundreds of job openings presented by Top Recruitment Consultants of India at a single page is so simple at this section.</p>\r\n<p>For further assistance please contact us at {SITEMGR_EMAIL}.</p>\r\n<p>Thank you for being a member of iwjobs.com. We hope to serve you better.</p>', '2012-05-16 19:40:45', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expertise_area`
--

CREATE TABLE IF NOT EXISTS `expertise_area` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `expertise_area`
--

INSERT INTO `expertise_area` (`Id`, `Name`) VALUES
(1, 'Accounting/Tax/Company Secretary/Audit'),
(2, ' Banks/Insurance/Financial Services'),
(3, ' Online & Offline Marketing / MR / Media Planning '),
(4, ' Sales/Business Development'),
(5, ' Advertising / Public Relation / Events'),
(6, ' Adminstration / Operations'),
(7, ' Human Resource / IR / Training & Development'),
(8, ' Production / Maintenance / Manufacturing '),
(9, ' Quality/Process Control'),
(10, ' IT Hardware - Control'),
(11, ' IT Hardware - EDA/ VLSI/ ASIC/ Chip Designing'),
(12, ' IT Hardware - Embedded Technology'),
(13, ' IT Hardware - External hardware'),
(14, ' IT Hardware - IC Fabrication/ Programming'),
(15, ' IT Hardware - Installation/ Maintenance'),
(16, ' IT Hardware - Large Equipments'),
(17, ' IT Hardware - Networking'),
(18, ' IT Hardware - Remote Sensing'),
(19, ' IT Hardware - Support'),
(20, ' IT/Telecom - Hardware'),
(21, ' IT Software - Application Programming'),
(22, ' IT Software - Business/ Systems Analysis'),
(23, ' IT Software - DataBase, Datawarehousing'),
(24, ' IT Software - E-Commerce/ Internet Technologies'),
(25, ' IT Software - ERP,CRM'),
(26, ' IT Software - Maintenance/ Systems'),
(27, ' IT Software - Middleware'),
(28, ' IT Software - MIS/ EDP'),
(29, ' IT Software - Mobile Technologies'),
(30, ' IT Software - Networking'),
(31, ' IT Software - Operations/ Support Services'),
(32, ' IT Software - Security/ Operating Systems'),
(33, ' IT Software - Quality Management/ Testing'),
(34, ' IT Software - Systems Programming'),
(35, ' IT Software - Training & Development'),
(36, ' IT/Telecom - Software'),
(37, ' Telecom - Design'),
(38, ' Telecom - Mobile Technologies'),
(39, ' Telecom - Networking'),
(40, ' Telecom - Operations/ Support'),
(41, ' Telecom - Training & Development'),
(42, ' Entertainment/ Media/ Journalism');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE IF NOT EXISTS `forgot_password` (
  `Id` varchar(50) NOT NULL,
  `UserId` varchar(50) NOT NULL,
  `Ip` varchar(100) NOT NULL,
  `ForgotDate` datetime NOT NULL,
  `UpdateDate` datetime NOT NULL,
  `Status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>not use, 1=> use',
  PRIMARY KEY (`Id`),
  KEY `UserId` (`UserId`),
  KEY `Status` (`Status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`Id`, `UserId`, `Ip`, `ForgotDate`, `UpdateDate`, `Status`) VALUES
('1312270708EGVDYH', '1308222927CPOJZR', '192.168.1.34', '2011-08-02 07:38:28', '2011-08-02 07:39:29', '1'),
('1336547211JXLEQA', '1336465929AHILDZ', '192.168.3.107', '2012-05-09 07:06:51', '0000-00-00 00:00:00', '0'),
('1336550510LXRBNQ', '1336465929AHILDZ', '192.168.3.107', '2012-05-09 08:01:50', '2012-05-09 08:02:47', '1'),
('1336550630CYDUHQ', '1336465929AHILDZ', '192.168.3.107', '2012-05-09 08:03:50', '2012-05-09 08:55:40', '1'),
('1336553777YTZOPH', '1336465929AHILDZ', '192.168.3.107', '2012-05-09 08:56:17', '2012-05-09 08:56:35', '1'),
('1336554009TZPCNK', '1336465929AHILDZ', '192.168.3.107', '2012-05-09 09:00:09', '2012-05-09 09:00:22', '1'),
('1337061049MBXKQU', '1336651020EYAPL', '192.168.3.109', '2012-05-15 05:50:49', '0000-00-00 00:00:00', '0'),
('1337061099PWIGCL', '1336651020EYAPL', '192.168.3.109', '2012-05-15 05:51:39', '0000-00-00 00:00:00', '0'),
('1337061211FCBPTO', '1336651020EYAPL', '192.168.3.109', '2012-05-15 05:53:31', '2012-05-15 05:57:33', '1'),
('1337265945JVONQG', '1336465929AHILDZ', '127.0.0.1', '2012-05-17 20:15:45', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `Id` varchar(50) NOT NULL,
  `RecruiterId` varchar(50) NOT NULL,
  `JobName` varchar(255) NOT NULL,
  `JobDescription` varchar(255) NOT NULL,
  `JobLocation` varchar(100) NOT NULL,
  `Skill` mediumtext NOT NULL,
  `FunctionalExpertise` mediumtext NOT NULL,
  `Salary` varchar(50) NOT NULL,
  `Experience` varchar(50) NOT NULL,
  `JobAddedDate` datetime NOT NULL,
  `JobLastUpdatedDate` datetime NOT NULL,
  `Status` enum('0','1','3') NOT NULL COMMENT '0->Inactive,1->Active,3->delete',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`Id`, `RecruiterId`, `JobName`, `JobDescription`, `JobLocation`, `Skill`, `FunctionalExpertise`, `Salary`, `Experience`, `JobAddedDate`, `JobLastUpdatedDate`, `Status`) VALUES
('1337064828RUOZDQ', '1336651020EYAPL', 'System Engineer', 'Check the System.', 'Detroit', 'a:4:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.8";}i:1;a:1:{s:9:"SkillName";s:6:"AMAZON";}i:2;a:1:{s:9:"SkillName";s:13:"ADVANCED JAVA";}i:3;a:1:{s:9:"SkillName";s:13:"RUBY ON RAILS";}}', 'a:4:{i:0;a:1:{s:4:"Name";s:27:" Adminstration / Operations";}i:1;a:1:{s:4:"Name";s:43:" IT Software - Operations/ Support Services";}i:2;a:1:{s:4:"Name";s:42:" IT Software - Security/ Operating Systems";}i:3;a:1:{s:4:"Name";s:34:" IT Software - Systems Programming";}}', '30000', '2', '2012-05-17 20:06:18', '0000-00-00 00:00:00', '1'),
('1337065187UMSJQY', '1336651020EYAPL', 'Web Tester', 'Testing various websites.', 'California', 'a:4:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:1;a:1:{s:9:"SkillName";s:4:"HTML";}i:2;a:1:{s:9:"SkillName";s:5:"CSS 3";}i:3;a:1:{s:9:"SkillName";s:9:"PHOTOSHOP";}}', 'a:2:{i:0;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:1;a:1:{s:4:"Name";s:42:" IT Software - Quality Management/ Testing";}}', '15000', '3', '2012-05-15 06:59:47', '0000-00-00 00:00:00', '1'),
('1337065967HLDPWB', '1336651020EYAPL', 'Web Designer', 'Website design.', 'California', 'a:7:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:1;a:1:{s:9:"SkillName";s:4:"JSON";}i:2;a:1:{s:9:"SkillName";s:6:"JQUERY";}i:3;a:1:{s:9:"SkillName";s:4:"HTML";}i:4;a:1:{s:9:"SkillName";s:6:"HTML 5";}i:5;a:1:{s:9:"SkillName";s:5:"CSS 3";}i:6;a:1:{s:9:"SkillName";s:9:"PHOTOSHOP";}}', 'a:3:{i:0;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:1;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:2;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}}', '17000', '1', '2012-05-17 13:34:16', '0000-00-00 00:00:00', '1'),
('1337068304LQZSYD', '1336651020EYAPL', 'Web Developer', 'Website Development.', 'Los Angeles', 'a:10:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:1;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:2;a:1:{s:9:"SkillName";s:4:"JSON";}i:3;a:1:{s:9:"SkillName";s:6:"JQUERY";}i:4;a:1:{s:9:"SkillName";s:4:"HTML";}i:5;a:1:{s:9:"SkillName";s:5:"MYSQL";}i:6;a:1:{s:9:"SkillName";s:3:"CSS";}i:7;a:1:{s:9:"SkillName";s:13:"WORDPRESS 2.8";}i:8;a:1:{s:9:"SkillName";s:11:"CODEIGNITER";}i:9;a:1:{s:9:"SkillName";s:6:"SMARTY";}}', 'a:5:{i:0;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:1;a:1:{s:4:"Name";s:40:" IT Software - DataBase, Datawarehousing";}i:2;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:3;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}i:4;a:1:{s:4:"Name";s:34:" IT Software - Mobile Technologies";}}', '40000', '4', '2012-05-17 13:34:21', '0000-00-00 00:00:00', '0'),
('1337070173AGOPIE', '1337070107TXEDYN', 'BPO', 'Business Process Outsourcing.', 'Chelsey', 'a:5:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:1;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:2;a:1:{s:9:"SkillName";s:4:"HTML";}i:3;a:1:{s:9:"SkillName";s:9:"PHOTOSHOP";}i:4;a:1:{s:9:"SkillName";s:3:"XML";}}', 'a:42:{i:0;a:1:{s:4:"Name";s:38:"Accounting/Tax/Company Secretary/Audit";}i:1;a:1:{s:4:"Name";s:35:" Banks/Insurance/Financial Services";}i:2;a:1:{s:4:"Name";s:50:" Online & Offline Marketing / MR / Media Planning ";}i:3;a:1:{s:4:"Name";s:27:" Sales/Business Development";}i:4;a:1:{s:4:"Name";s:39:" Advertising / Public Relation / Events";}i:5;a:1:{s:4:"Name";s:27:" Adminstration / Operations";}i:6;a:1:{s:4:"Name";s:45:" Human Resource / IR / Training & Development";}i:7;a:1:{s:4:"Name";s:42:" Production / Maintenance / Manufacturing ";}i:8;a:1:{s:4:"Name";s:24:" Quality/Process Control";}i:9;a:1:{s:4:"Name";s:22:" IT Hardware - Control";}i:10;a:1:{s:4:"Name";s:46:" IT Hardware - EDA/ VLSI/ ASIC/ Chip Designing";}i:11;a:1:{s:4:"Name";s:34:" IT Hardware - Embedded Technology";}i:12;a:1:{s:4:"Name";s:32:" IT Hardware - External hardware";}i:13;a:1:{s:4:"Name";s:42:" IT Hardware - IC Fabrication/ Programming";}i:14;a:1:{s:4:"Name";s:40:" IT Hardware - Installation/ Maintenance";}i:15;a:1:{s:4:"Name";s:31:" IT Hardware - Large Equipments";}i:16;a:1:{s:4:"Name";s:25:" IT Hardware - Networking";}i:17;a:1:{s:4:"Name";s:29:" IT Hardware - Remote Sensing";}i:18;a:1:{s:4:"Name";s:22:" IT Hardware - Support";}i:19;a:1:{s:4:"Name";s:22:" IT/Telecom - Hardware";}i:20;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:21;a:1:{s:4:"Name";s:41:" IT Software - Business/ Systems Analysis";}i:22;a:1:{s:4:"Name";s:40:" IT Software - DataBase, Datawarehousing";}i:23;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:24;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}i:25;a:1:{s:4:"Name";s:35:" IT Software - Maintenance/ Systems";}i:26;a:1:{s:4:"Name";s:25:" IT Software - Middleware";}i:27;a:1:{s:4:"Name";s:23:" IT Software - MIS/ EDP";}i:28;a:1:{s:4:"Name";s:34:" IT Software - Mobile Technologies";}i:29;a:1:{s:4:"Name";s:25:" IT Software - Networking";}i:30;a:1:{s:4:"Name";s:43:" IT Software - Operations/ Support Services";}i:31;a:1:{s:4:"Name";s:42:" IT Software - Security/ Operating Systems";}i:32;a:1:{s:4:"Name";s:42:" IT Software - Quality Management/ Testing";}i:33;a:1:{s:4:"Name";s:34:" IT Software - Systems Programming";}i:34;a:1:{s:4:"Name";s:37:" IT Software - Training & Development";}i:35;a:1:{s:4:"Name";s:22:" IT/Telecom - Software";}i:36;a:1:{s:4:"Name";s:17:" Telecom - Design";}i:37;a:1:{s:4:"Name";s:30:" Telecom - Mobile Technologies";}i:38;a:1:{s:4:"Name";s:21:" Telecom - Networking";}i:39;a:1:{s:4:"Name";s:30:" Telecom - Operations/ Support";}i:40;a:1:{s:4:"Name";s:33:" Telecom - Training & Development";}i:41;a:1:{s:4:"Name";s:33:" Entertainment/ Media/ Journalism";}}', '15550', '6', '2012-05-17 13:37:16', '0000-00-00 00:00:00', '1'),
('1337157960ITBUAC', '1336732081KCPRF', 'KPO', 'Knoledge process outsourcing', 'Chicago', 'a:6:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 3";}i:1;a:1:{s:9:"SkillName";s:5:"PHP 4";}i:2;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:3;a:1:{s:9:"SkillName";s:13:"WORDPRESS 2.8";}i:4;a:1:{s:9:"SkillName";s:11:"CODEIGNITER";}i:5;a:1:{s:9:"SkillName";s:6:"SMARTY";}}', 'a:6:{i:0;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:1;a:1:{s:4:"Name";s:41:" IT Software - Business/ Systems Analysis";}i:2;a:1:{s:4:"Name";s:40:" IT Software - DataBase, Datawarehousing";}i:3;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:4;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}i:5;a:1:{s:4:"Name";s:34:" IT Software - Mobile Technologies";}}', '22000', '4', '2012-05-16 08:46:00', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `key_skills`
--

CREATE TABLE IF NOT EXISTS `key_skills` (
  `SkillId` int(11) NOT NULL AUTO_INCREMENT,
  `SkillName` varchar(50) NOT NULL,
  PRIMARY KEY (`SkillId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `key_skills`
--

INSERT INTO `key_skills` (`SkillId`, `SkillName`) VALUES
(1, 'PHP 3'),
(2, 'PHP 4'),
(3, 'PHP 5'),
(4, 'JAVASCRIPT 1.3'),
(5, 'JAVASCRIPT 1.8'),
(6, 'JSON'),
(7, 'JAVA'),
(8, '.NET'),
(9, 'JQUERY'),
(10, 'HTML'),
(11, 'HTML 5'),
(12, 'AJAX'),
(13, 'MYSQL'),
(14, 'AMAZON'),
(15, 'SYMPHONY'),
(16, 'LINUX'),
(17, 'CSS'),
(18, 'CSS 3'),
(19, 'PHOTOSHOP'),
(20, 'XML'),
(21, 'ADVANCED JAVA'),
(22, 'JSP 2.0'),
(23, 'JDBC 2.1'),
(24, 'J2ME'),
(25, 'EJB 2.0'),
(26, 'E4X'),
(27, 'XHTML 1.0'),
(28, 'DRUPAL 6.14'),
(29, 'WORDPRESS 2.8'),
(30, 'CODEIGNITER'),
(31, 'SMARTY'),
(32, 'RUBY ON RAILS'),
(33, 'DHTML'),
(34, 'PERL 5'),
(35, 'LAMP'),
(36, 'SOAP 1.2'),
(37, 'PYTHON'),
(38, 'JOOMLA'),
(39, 'MAGENTO'),
(40, 'ZEND'),
(41, 'SQL'),
(42, 'MYSQL 5.0');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_login`
--

CREATE TABLE IF NOT EXISTS `recruiter_login` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(50) NOT NULL,
  `LogDate` datetime NOT NULL,
  `Ip` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `recruiter_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `recruiter_master`
--

CREATE TABLE IF NOT EXISTS `recruiter_master` (
  `RecruiterId` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Organization` varchar(100) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `CityName` varchar(255) NOT NULL,
  `PostalCode` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `CompanyLogo` varchar(50) NOT NULL,
  `CompanyLink` varchar(100) NOT NULL,
  `AddedDate` datetime NOT NULL,
  `LastUpdatedDate` datetime NOT NULL,
  `Status` enum('0','1','2','3') NOT NULL COMMENT '''0''->Inactive,''1''->Active,''3''->deleted',
  PRIMARY KEY (`RecruiterId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_master`
--

INSERT INTO `recruiter_master` (`RecruiterId`, `UserName`, `Email`, `Password`, `Organization`, `Country`, `CityName`, `PostalCode`, `Address`, `CompanyLogo`, `CompanyLink`, `AddedDate`, `LastUpdatedDate`, `Status`) VALUES
('1336651020EYAPL', 'soumalyanandy', 'soumalya@infoway.us', 'c33367701511b4f6020ec61ded352059', 'INFOWAY LLC123', 'USA', 'Down Town', '85019', 'some where.', '1336651020EYAPL.jpg', 'http://www.infoway.us', '2012-05-11 08:15:23', '2012-05-17 20:06:32', '1'),
('1336732081KCPRF', 'ibmrec', 'some@ibm.com', '96e79218965eb72c92a549dd5a330112', 'IBM', 'USA', 'Chicago', '85632', 'Some Place', '1336732081KCPRFA.jpg', 'http://www.ibm.com/us/en/', '2012-05-11 10:28:01', '2012-05-11 10:32:59', '1'),
('1337070107TXEDYN', 'sounak', 'sounak1@infoway.us', 'e10adc3949ba59abbe56e057f20f883e', 'Intel', 'USA', 'Sent Luis', '85012', 'ghana', '1337070107TXEDYN.jpg', 'www.intel.com', '2012-05-15 08:21:47', '2012-05-17 13:40:28', '1'),
('1337271292HQWKOG', 'rohit123', 'infoway.testphp@gmail.com', '96e79218965eb72c92a549dd5a330112', 'ewewew', 'USA', 'California', '90703', 'erererer', '1337271292HQWKOG.jpg', 'www.weweew.com', '2012-05-17 16:14:52', '2012-05-17 16:18:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(50) NOT NULL,
  `LogDate` datetime NOT NULL,
  `Ip` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `UserId` (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_login`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `UserId` varchar(50) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  `Biography` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Gender` enum('m','f') NOT NULL COMMENT 'm=male, f=female',
  `CountryCode` varchar(5) NOT NULL,
  `CityName` varchar(200) NOT NULL,
  `PostalCode` varchar(100) NOT NULL,
  `Address` tinytext NOT NULL,
  `Ip` varchar(100) NOT NULL,
  `JoinDate` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` enum('0','1','2','3','11') NOT NULL DEFAULT '0' COMMENT '0=>inactive, 1=>active, 2=>block, 3=>delete, 11=>inactive by admin',
  PRIMARY KEY (`UserId`),
  KEY `Status` (`Status`),
  KEY `Password` (`Password`),
  KEY `UserName` (`UserName`),
  KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Details of user information';

--
-- Dumping data for table `user_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_professional_details`
--

CREATE TABLE IF NOT EXISTS `user_professional_details` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(50) NOT NULL,
  `KeySkill` text NOT NULL,
  `FunctionalExpertise` text NOT NULL,
  `CurrentLoc` varchar(255) NOT NULL,
  `PreferredLoc` varchar(50) NOT NULL,
  `EmpStatus` enum('F','E') NOT NULL,
  `Experience` varchar(10) NOT NULL,
  `CurrentSal` varchar(10) NOT NULL,
  `ExpectedSal` varchar(10) NOT NULL,
  `CurrentComp` varchar(50) NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `ResumeDesc` mediumtext NOT NULL,
  `ResumeName` varchar(50) NOT NULL,
  `Degree` varchar(50) NOT NULL,
  `PassingYear` int(4) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1337270432 ;

--
-- Dumping data for table `user_professional_details`
--

INSERT INTO `user_professional_details` (`Id`, `UserId`, `KeySkill`, `FunctionalExpertise`, `CurrentLoc`, `PreferredLoc`, `EmpStatus`, `Experience`, `CurrentSal`, `ExpectedSal`, `CurrentComp`, `Designation`, `ResumeDesc`, `ResumeName`, `Degree`, `PassingYear`) VALUES
(1336222426, '1336222426YXETD', '', '', '0', '10', 'F', '', '', '', '', '', 'dasdasdcxzsdcasd', 'bunkerada_phase - dev.docx', '1', 0),
(1336377744, '1336377744IQBDO', 'a:3:{i:0;a:1:{s:9:"SkillName";s:4:"AJAX";}i:1;a:1:', 'a:2:{i:0;a:1:{s:4:"Name";s:39:" Advertising / Publ', '0', 'California', 'F', '', '', '', '', '', 'adasda', 'Absence_Request_Form.doc', 'B.tech', 0),
(1336465929, '1336465929AHILDZ', 'a:11:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:1;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:2;a:1:{s:9:"SkillName";s:4:"JSON";}i:3;a:1:{s:9:"SkillName";s:4:"JAVA";}i:4;a:1:{s:9:"SkillName";s:6:"JQUERY";}i:5;a:1:{s:9:"SkillName";s:4:"HTML";}i:6;a:1:{s:9:"SkillName";s:4:"AJAX";}i:7;a:1:{s:9:"SkillName";s:3:"CSS";}i:8;a:1:{s:9:"SkillName";s:13:"WORDPRESS 2.8";}i:9;a:1:{s:9:"SkillName";s:11:"CODEIGNITER";}i:10;a:1:{s:9:"SkillName";s:6:"SMARTY";}}', 'a:10:{i:0;a:1:{s:4:"Name";s:39:" Advertising / Public Relation / Events";}i:1;a:1:{s:4:"Name";s:27:" Adminstration / Operations";}i:2;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:3;a:1:{s:4:"Name";s:41:" IT Software - Business/ Systems Analysis";}i:4;a:1:{s:4:"Name";s:40:" IT Software - DataBase, Datawarehousing";}i:5;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:6;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}i:7;a:1:{s:4:"Name";s:34:" IT Software - Mobile Technologies";}i:8;a:1:{s:4:"Name";s:34:" IT Software - Systems Programming";}i:9;a:1:{s:4:"Name";s:37:" IT Software - Training & Development";}}', 'California', 'California', 'E', '2', '10100.00', '22000', 'Infoway', 'Trainee Devoloper', 'I am Good PHP developer.', '1336465929AHILDZ.', 'B.tech', 0),
(1336468684, '1336468684MFDCXE', 'a:4:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:1;a:1', 'a:2:{i:0;a:1:{s:4:"Name";s:22:" IT Hardware - Cont', '', 'California', 'F', '', '', '', '', '', 'I am a fresher.', 'Absence_Request_Form.doc', 'B.tech', 0),
(1336483727, '1336483727VPCZEA', 'a:13:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.', 'a:2:{i:0;a:1:{s:4:"Name";s:39:" Advertising / Publ', 'Chelsey', 'Chicago', 'E', '4', '2000', '5000', 'sdfsf', 'sdfsdfs', 'sfsdfds\r\ndfsdfdf fdsfsdfsdf  df sd.', '1336483727VPCZEA.doc', 'MCA', 0),
(1336561201, '1336561201UVLIKE', 'a:13:{i:0;a:1:{s:9:"SkillName";s:5:"PHP 3";}i:1;a:1:{s:9:"SkillName";s:5:"PHP 4";}i:2;a:1:{s:9:"SkillName";s:5:"PHP 5";}i:3;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:4;a:1:{s:9:"SkillName";s:4:"JSON";}i:5;a:1:{s:9:"SkillName";s:4:"JAVA";}i:6;a:1:{s:9:"SkillName";s:6:"JQUERY";}i:7;a:1:{s:9:"SkillName";s:4:"HTML";}i:8;a:1:{s:9:"SkillName";s:4:"AJAX";}i:9;a:1:{s:9:"SkillName";s:3:"CSS";}i:10;a:1:{s:9:"SkillName";s:13:"WORDPRESS 2.8";}i:11;a:1:{s:9:"SkillName";s:11:"CODEIGNITER";}i:12;a:1:{s:9:"SkillName";s:6:"SMARTY";}}', 'a:39:{i:0;a:1:{s:4:"Name";s:35:" Banks/Insurance/Financial Services";}i:1;a:1:{s:4:"Name";s:50:" Online & Offline Marketing / MR / Media Planning ";}i:2;a:1:{s:4:"Name";s:27:" Sales/Business Development";}i:3;a:1:{s:4:"Name";s:39:" Advertising / Public Relation / Events";}i:4;a:1:{s:4:"Name";s:45:" Human Resource / IR / Training & Development";}i:5;a:1:{s:4:"Name";s:42:" Production / Maintenance / Manufacturing ";}i:6;a:1:{s:4:"Name";s:24:" Quality/Process Control";}i:7;a:1:{s:4:"Name";s:22:" IT Hardware - Control";}i:8;a:1:{s:4:"Name";s:46:" IT Hardware - EDA/ VLSI/ ASIC/ Chip Designing";}i:9;a:1:{s:4:"Name";s:34:" IT Hardware - Embedded Technology";}i:10;a:1:{s:4:"Name";s:32:" IT Hardware - External hardware";}i:11;a:1:{s:4:"Name";s:42:" IT Hardware - IC Fabrication/ Programming";}i:12;a:1:{s:4:"Name";s:40:" IT Hardware - Installation/ Maintenance";}i:13;a:1:{s:4:"Name";s:31:" IT Hardware - Large Equipments";}i:14;a:1:{s:4:"Name";s:25:" IT Hardware - Networking";}i:15;a:1:{s:4:"Name";s:29:" IT Hardware - Remote Sensing";}i:16;a:1:{s:4:"Name";s:22:" IT Hardware - Support";}i:17;a:1:{s:4:"Name";s:22:" IT/Telecom - Hardware";}i:18;a:1:{s:4:"Name";s:38:" IT Software - Application Programming";}i:19;a:1:{s:4:"Name";s:41:" IT Software - Business/ Systems Analysis";}i:20;a:1:{s:4:"Name";s:40:" IT Software - DataBase, Datawarehousing";}i:21;a:1:{s:4:"Name";s:48:" IT Software - E-Commerce/ Internet Technologies";}i:22;a:1:{s:4:"Name";s:22:" IT Software - ERP,CRM";}i:23;a:1:{s:4:"Name";s:35:" IT Software - Maintenance/ Systems";}i:24;a:1:{s:4:"Name";s:25:" IT Software - Middleware";}i:25;a:1:{s:4:"Name";s:23:" IT Software - MIS/ EDP";}i:26;a:1:{s:4:"Name";s:34:" IT Software - Mobile Technologies";}i:27;a:1:{s:4:"Name";s:25:" IT Software - Networking";}i:28;a:1:{s:4:"Name";s:43:" IT Software - Operations/ Support Services";}i:29;a:1:{s:4:"Name";s:42:" IT Software - Security/ Operating Systems";}i:30;a:1:{s:4:"Name";s:42:" IT Software - Quality Management/ Testing";}i:31;a:1:{s:4:"Name";s:34:" IT Software - Systems Programming";}i:32;a:1:{s:4:"Name";s:37:" IT Software - Training & Development";}i:33;a:1:{s:4:"Name";s:22:" IT/Telecom - Software";}i:34;a:1:{s:4:"Name";s:17:" Telecom - Design";}i:35;a:1:{s:4:"Name";s:30:" Telecom - Mobile Technologies";}i:36;a:1:{s:4:"Name";s:21:" Telecom - Networking";}i:37;a:1:{s:4:"Name";s:30:" Telecom - Operations/ Support";}i:38;a:1:{s:4:"Name";s:33:" Entertainment/ Media/ Journalism";}}', '', 'California', 'F', '0', '', '24000', '', '', 'i''m a good boy...', 'bunkerada_phase - dev.docx', 'B.tech', 0),
(1336566954, '1336566954TPOUSR', 'a:2:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}i:1;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.8";}}', 'a:4:{i:0;a:1:{s:4:"Name";s:45:" Human Resource / IR / Training & Development";}i:1;a:1:{s:4:"Name";s:22:" IT Hardware - Control";}i:2;a:1:{s:4:"Name";s:46:" IT Hardware - EDA/ VLSI/ ASIC/ Chip Designing";}i:3;a:1:{s:4:"Name";s:34:" IT Hardware - Embedded Technology";}}', '', 'Southamptom', 'F', '0', '', '', '', '', 'fhfgh', 'bunkerada_phase - dev.docx', 'BCA', 0),
(1336630556, '1336630556VQSREJ', 'a:1:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}}', 'a:3:{i:0;a:1:{s:4:"Name";s:35:" Banks/Insurance/Financial Services";}i:1;a:1:{s:4:"Name";s:39:" Advertising / Public Relation / Events";}i:2;a:1:{s:4:"Name";s:45:" Human Resource / IR / Training & Development";}}', 'Sent Luis', 'North Carolina', 'F', '0', '12', '245632', 'fghfgh', 'fhfgh', 'nice...', '', 'Phd', 0),
(1337270431, '1337270431HNOVQX', 'a:1:{i:0;a:1:{s:9:"SkillName";s:14:"JAVASCRIPT 1.3";}}', 'a:3:{i:0;a:1:{s:4:"Name";s:39:" Advertising / Public Relation / Events";}i:1;a:1:{s:4:"Name";s:27:" Adminstration / Operations";}i:2;a:1:{s:4:"Name";s:33:" Entertainment/ Media/ Journalism";}}', '', 'California', 'F', '0', '', '2000', '', '', 'ewewwewewewewewe', '', 'B.tech', 0);
