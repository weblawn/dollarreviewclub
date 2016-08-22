-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2015 at 09:56 PM
-- Server version: 5.5.46-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `q5server_dollar`
--

-- --------------------------------------------------------

--
-- Table structure for table `dlr_category`
--

CREATE TABLE IF NOT EXISTS `dlr_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `slug` varchar(64) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dlr_category`
--

INSERT INTO `dlr_category` (`cid`, `name`, `slug`, `since`) VALUES
(1, 'Media', 'media', '2015-06-15 13:47:18'),
(2, 'Electronics & Computers', 'electronics-computers', '2015-06-15 13:53:39'),
(3, 'Home, Garden & Tools', 'home-garden-tools', '2015-06-15 13:53:39'),
(4, 'Beauty & Health', 'beauty-health', '2015-06-15 13:53:39'),
(5, 'Grocery', 'grocery', '2015-06-15 13:53:39'),
(6, 'Toys', 'toys', '2015-06-15 13:53:39'),
(7, 'Kids & Baby', 'kids-baby', '2015-06-15 13:53:39'),
(8, 'Clothing, Shoes & Jewellry', 'clothing-shoes-jewellry', '2015-06-15 13:53:39'),
(9, 'Sports & Outdoors', 'sports-outdoors', '2015-06-15 13:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `dlr_companies`
--

CREATE TABLE IF NOT EXISTS `dlr_companies` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cname` varchar(120) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dlr_companies`
--

INSERT INTO `dlr_companies` (`cid`, `uid`, `cname`, `is_blocked`, `registered`) VALUES
(1, 2, 'testComp', 0, '2015-06-08 13:01:14'),
(2, 6, 'TransBiz', 0, '2015-07-28 10:01:30'),
(3, 17, 'TestLLC', 0, '2015-08-03 09:43:29'),
(4, 18, 'Ok LLC', 0, '2015-08-03 10:01:36'),
(5, 20, 'Smile Development Company', 0, '2015-08-04 11:46:44'),
(6, 22, 'Fastclick LLC', 0, '2015-08-22 09:00:17'),
(7, 26, 'testing', 0, '2015-09-02 11:11:27'),
(8, 32, 'TransBiz Ltd.', 0, '2015-09-19 11:45:13'),
(9, 34, 'TestingCompany', 0, '2015-10-29 09:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `dlr_pages`
--

CREATE TABLE IF NOT EXISTS `dlr_pages` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `slug` text NOT NULL,
  `keywords` longtext NOT NULL,
  `metadesc` longtext NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dlr_pages`
--

INSERT INTO `dlr_pages` (`pid`, `title`, `content`, `slug`, `keywords`, `metadesc`, `since`) VALUES
(1, 'About', '<span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Quisque rutrum massa sit amet nulla condimentum vestibulum. In id posuere sapien, sit amet suscipit dui. Nulla lobortis condimentum ullamcorper. Nullam a sodales quam. Donec ut suscipit velit, ut facilisis sem. Donec semper fringilla dolor, in laoreet metus venenatis ac. Curabitur a diam eleifend dui sagittis sollicitudin vitae sed velit. Proin a felis vulputate, fermentum velit sit amet, elementum mauris. Mauris vulputate molestie vestibulum. Sed sed augue et orci ultrices pellentesque. Nam sollicitudin mattis massa, non mattis turpis rutrum et. Mauris pharetra odio massa, in mattis turpis varius et. Ut elementum efficitur metus, hendrerit maximus leo fermentum a.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Phasellus vitae ante ipsum. Phasellus sit amet turpis magna. Aliquam non sagittis turpis. Sed ullamcorper ultrices eros, in eleifend ex consectetur varius. Vestibulum sed luctus risus, efficitur dignissim mauris. Integer feugiat sed magna et dapibus. Aliquam dapibus mauris non leo ornare sodales.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">In hac habitasse platea dictumst. Nulla ultrices, neque non ultricies dictum, orci orci tristique ante, at venenatis enim arcu tempus purus. Vivamus vel felis nec orci molestie eleifend non at sapien. Mauris a dolor orci. Mauris sed erat dui. Etiam rutrum velit malesuada elit lacinia tempor. Donec consequat sem a tellus facilisis mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla vulputate, nisi lacinia aliquet tincidunt, leo odio consequat ipsum, sit amet eleifend felis nisi in ligula. Nulla egestas lorem sed imperdiet laoreet.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Sed lacinia mattis odio sit amet elementum. Sed sodales massa massa. Duis ac feugiat nisi. Duis vel porta sapien. Donec bibendum porta mi et vestibulum. Vestibulum volutpat tempor ipsum, ac sodales velit ullamcorper tincidunt. Duis mattis convallis dui, in porta dolor tincidunt sed. Sed id libero efficitur, tincidunt sem quis, hendrerit urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum mauris odio, eu ornare orci lobortis ut. Nunc vel nisi venenatis, lacinia lorem quis, malesuada est. Mauris eget hendrerit dui, vitae ultrices felis. Ut ac ligula et orci mattis gravida ut eget enim.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Nullam mi elit, iaculis non laoreet sit amet, varius quis eros. Vivamus vel ligula euismod, tempor dui vitae, consequat felis. Fusce semper fermentum lobortis. Suspendisse potenti. Etiam laoreet lobortis eros, sed faucibus justo mollis a. Phasellus pulvinar ullamcorper velit, a placerat risus. Maecenas ligula arcu, malesuada vitae congue vel, eleifend vel ligula. Aenean rutrum sem ac condimentum vulputate. Maecenas gravida consequat sapien nec condimentum.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Morbi id turpis at felis consectetur maximus. Donec pulvinar a elit scelerisque viverra. Nulla varius leo tellus. Aenean mattis id turpis ut porttitor. Phasellus suscipit, urna ac efficitur vehicula, est est rutrum mi, eu vulputate ex ex a erat. Vivamus ut auctor diam. Suspendisse non aliquet lacus. Duis in porttitor neque.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Suspendisse consectetur vitae dolor in lacinia. Fusce nulla diam, convallis in consequat sit amet, finibus eget diam. Fusce suscipit ornare ligula eu eleifend. Duis eu nibh eget elit interdum tincidunt. Quisque mattis tempus eros in egestas. Cras lectus lacus, ultrices vitae massa in, facilisis egestas lacus. Vivamus faucibus, urna at molestie laoreet, erat arcu faucibus enim, commodo pellentesque magna quam in elit. Praesent nunc orci, euismod a metus vel, condimentum pharetra ipsum. Cras eu ligula rutrum, lobortis ipsum consectetur, ultricies est. Nulla pulvinar, libero at congue tincidunt, lorem libero consectetur neque, vitae luctus nunc tortor et diam. Cras nec venenatis lacus, sed pulvinar tellus. Donec at venenatis tortor. Nam bibendum semper lacinia. Donec faucibus metus quam, sed facilisis est tempor eget.</span>', 'about', 'Dollar review club', 'dollar review club is online amazon market', '2015-06-17 07:58:26'),
(2, 'FAQ', '<span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Quisque rutrum massa sit amet nulla condimentum vestibulum. In id posuere sapien, sit amet suscipit dui. Nulla lobortis condimentum ullamcorper. Nullam a sodales quam. Donec ut suscipit velit, ut facilisis sem. Donec semper fringilla dolor, in laoreet metus venenatis ac. Curabitur a diam eleifend dui sagittis sollicitudin vitae sed velit. Proin a felis vulputate, fermentum velit sit amet, elementum mauris. Mauris vulputate molestie vestibulum. Sed sed augue et orci ultrices pellentesque. Nam sollicitudin mattis massa, non mattis turpis rutrum et. Mauris pharetra odio massa, in mattis turpis varius et. Ut elementum efficitur metus, hendrerit maximus leo fermentum a.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Phasellus vitae ante ipsum. Phasellus sit amet turpis magna. Aliquam non sagittis turpis. Sed ullamcorper ultrices eros, in eleifend ex consectetur varius. Vestibulum sed luctus risus, efficitur dignissim mauris. Integer feugiat sed magna et dapibus. Aliquam dapibus mauris non leo ornare sodales.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">In hac habitasse platea dictumst. Nulla ultrices, neque non ultricies dictum, orci orci tristique ante, at venenatis enim arcu tempus purus. Vivamus vel felis nec orci molestie eleifend non at sapien. Mauris a dolor orci. Mauris sed erat dui. Etiam rutrum velit malesuada elit lacinia tempor. Donec consequat sem a tellus facilisis mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla vulputate, nisi lacinia aliquet tincidunt, leo odio consequat ipsum, sit amet eleifend felis nisi in ligula. Nulla egestas lorem sed imperdiet laoreet.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Sed lacinia mattis odio sit amet elementum. Sed sodales massa massa. Duis ac feugiat nisi. Duis vel porta sapien. Donec bibendum porta mi et vestibulum. Vestibulum volutpat tempor ipsum, ac sodales velit ullamcorper tincidunt. Duis mattis convallis dui, in porta dolor tincidunt sed. Sed id libero efficitur, tincidunt sem quis, hendrerit urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum mauris odio, eu ornare orci lobortis ut. Nunc vel nisi venenatis, lacinia lorem quis, malesuada est. Mauris eget hendrerit dui, vitae ultrices felis. Ut ac ligula et orci mattis gravida ut eget enim.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Nullam mi elit, iaculis non laoreet sit amet, varius quis eros. Vivamus vel ligula euismod, tempor dui vitae, consequat felis. Fusce semper fermentum lobortis. Suspendisse potenti. Etiam laoreet lobortis eros, sed faucibus justo mollis a. Phasellus pulvinar ullamcorper velit, a placerat risus. Maecenas ligula arcu, malesuada vitae congue vel, eleifend vel ligula. Aenean rutrum sem ac condimentum vulputate. Maecenas gravida consequat sapien nec condimentum.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Morbi id turpis at felis consectetur maximus. Donec pulvinar a elit scelerisque viverra. Nulla varius leo tellus. Aenean mattis id turpis ut porttitor. Phasellus suscipit, urna ac efficitur vehicula, est est rutrum mi, eu vulputate ex ex a erat. Vivamus ut auctor diam. Suspendisse non aliquet lacus. Duis in porttitor neque.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Suspendisse consectetur vitae dolor in lacinia. Fusce nulla diam, convallis in consequat sit amet, finibus eget diam. Fusce suscipit ornare ligula eu eleifend. Duis eu nibh eget elit interdum tincidunt. Quisque mattis tempus eros in egestas. Cras lectus lacus, ultrices vitae massa in, facilisis egestas lacus. Vivamus faucibus, urna at molestie laoreet, erat arcu faucibus enim, commodo pellentesque magna quam in elit. Praesent nunc orci, euismod a metus vel, condimentum pharetra ipsum. Cras eu ligula rutrum, lobortis ipsum consectetur, ultricies est. Nulla pulvinar, libero at congue tincidunt, lorem libero consectetur neque, vitae luctus nunc tortor et diam. Cras nec venenatis lacus, sed pulvinar tellus. Donec at venenatis tortor. Nam bibendum semper lacinia. Donec faucibus metus quam, sed facilisis est tempor eget.</span>', 'faq', 'Frequently asked questions', 'dollar review club frequently asked questioned', '2015-06-17 07:59:48'),
(3, 'Terms of Service', '<span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Quisque rutrum massa sit amet nulla condimentum vestibulum. In id posuere sapien, sit amet suscipit dui. Nulla lobortis condimentum ullamcorper. Nullam a sodales quam. Donec ut suscipit velit, ut facilisis sem. Donec semper fringilla dolor, in laoreet metus venenatis ac. Curabitur a diam eleifend dui sagittis sollicitudin vitae sed velit. Proin a felis vulputate, fermentum velit sit amet, elementum mauris. Mauris vulputate molestie vestibulum. Sed sed augue et orci ultrices pellentesque. Nam sollicitudin mattis massa, non mattis turpis rutrum et. Mauris pharetra odio massa, in mattis turpis varius et. Ut elementum efficitur metus, hendrerit maximus leo fermentum a.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Phasellus vitae ante ipsum. Phasellus sit amet turpis magna. Aliquam non sagittis turpis. Sed ullamcorper ultrices eros, in eleifend ex consectetur varius. Vestibulum sed luctus risus, efficitur dignissim mauris. Integer feugiat sed magna et dapibus. Aliquam dapibus mauris non leo ornare sodales.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">In hac habitasse platea dictumst. Nulla ultrices, neque non ultricies dictum, orci orci tristique ante, at venenatis enim arcu tempus purus. Vivamus vel felis nec orci molestie eleifend non at sapien. Mauris a dolor orci. Mauris sed erat dui. Etiam rutrum velit malesuada elit lacinia tempor. Donec consequat sem a tellus facilisis mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla vulputate, nisi lacinia aliquet tincidunt, leo odio consequat ipsum, sit amet eleifend felis nisi in ligula. Nulla egestas lorem sed imperdiet laoreet.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Sed lacinia mattis odio sit amet elementum. Sed sodales massa massa. Duis ac feugiat nisi. Duis vel porta sapien. Donec bibendum porta mi et vestibulum. Vestibulum volutpat tempor ipsum, ac sodales velit ullamcorper tincidunt. Duis mattis convallis dui, in porta dolor tincidunt sed. Sed id libero efficitur, tincidunt sem quis, hendrerit urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum mauris odio, eu ornare orci lobortis ut. Nunc vel nisi venenatis, lacinia lorem quis, malesuada est. Mauris eget hendrerit dui, vitae ultrices felis. Ut ac ligula et orci mattis gravida ut eget enim.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Nullam mi elit, iaculis non laoreet sit amet, varius quis eros. Vivamus vel ligula euismod, tempor dui vitae, consequat felis. Fusce semper fermentum lobortis. Suspendisse potenti. Etiam laoreet lobortis eros, sed faucibus justo mollis a. Phasellus pulvinar ullamcorper velit, a placerat risus. Maecenas ligula arcu, malesuada vitae congue vel, eleifend vel ligula. Aenean rutrum sem ac condimentum vulputate. Maecenas gravida consequat sapien nec condimentum.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Morbi id turpis at felis consectetur maximus. Donec pulvinar a elit scelerisque viverra. Nulla varius leo tellus. Aenean mattis id turpis ut porttitor. Phasellus suscipit, urna ac efficitur vehicula, est est rutrum mi, eu vulputate ex ex a erat. Vivamus ut auctor diam. Suspendisse non aliquet lacus. Duis in porttitor neque.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Suspendisse consectetur vitae dolor in lacinia. Fusce nulla diam, convallis in consequat sit amet, finibus eget diam. Fusce suscipit ornare ligula eu eleifend. Duis eu nibh eget elit interdum tincidunt. Quisque mattis tempus eros in egestas. Cras lectus lacus, ultrices vitae massa in, facilisis egestas lacus. Vivamus faucibus, urna at molestie laoreet, erat arcu faucibus enim, commodo pellentesque magna quam in elit. Praesent nunc orci, euismod a metus vel, condimentum pharetra ipsum. Cras eu ligula rutrum, lobortis ipsum consectetur, ultricies est. Nulla pulvinar, libero at congue tincidunt, lorem libero consectetur neque, vitae luctus nunc tortor et diam. Cras nec venenatis lacus, sed pulvinar tellus. Donec at venenatis tortor. Nam bibendum semper lacinia. Donec faucibus metus quam, sed facilisis est tempor eget.</span>', 'terms', 'Terms of Service', 'Dollar review club terms of Service', '2015-06-17 08:00:48'),
(4, 'Privacy Policy', '<span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Quisque rutrum massa sit amet nulla condimentum vestibulum. In id posuere sapien, sit amet suscipit dui. Nulla lobortis condimentum ullamcorper. Nullam a sodales quam. Donec ut suscipit velit, ut facilisis sem. Donec semper fringilla dolor, in laoreet metus venenatis ac. Curabitur a diam eleifend dui sagittis sollicitudin vitae sed velit. Proin a felis vulputate, fermentum velit sit amet, elementum mauris. Mauris vulputate molestie vestibulum. Sed sed augue et orci ultrices pellentesque. Nam sollicitudin mattis massa, non mattis turpis rutrum et. Mauris pharetra odio massa, in mattis turpis varius et. Ut elementum efficitur metus, hendrerit maximus leo fermentum a.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Phasellus vitae ante ipsum. Phasellus sit amet turpis magna. Aliquam non sagittis turpis. Sed ullamcorper ultrices eros, in eleifend ex consectetur varius. Vestibulum sed luctus risus, efficitur dignissim mauris. Integer feugiat sed magna et dapibus. Aliquam dapibus mauris non leo ornare sodales.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">In hac habitasse platea dictumst. Nulla ultrices, neque non ultricies dictum, orci orci tristique ante, at venenatis enim arcu tempus purus. Vivamus vel felis nec orci molestie eleifend non at sapien. Mauris a dolor orci. Mauris sed erat dui. Etiam rutrum velit malesuada elit lacinia tempor. Donec consequat sem a tellus facilisis mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla vulputate, nisi lacinia aliquet tincidunt, leo odio consequat ipsum, sit amet eleifend felis nisi in ligula. Nulla egestas lorem sed imperdiet laoreet.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Sed lacinia mattis odio sit amet elementum. Sed sodales massa massa. Duis ac feugiat nisi. Duis vel porta sapien. Donec bibendum porta mi et vestibulum. Vestibulum volutpat tempor ipsum, ac sodales velit ullamcorper tincidunt. Duis mattis convallis dui, in porta dolor tincidunt sed. Sed id libero efficitur, tincidunt sem quis, hendrerit urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum mauris odio, eu ornare orci lobortis ut. Nunc vel nisi venenatis, lacinia lorem quis, malesuada est. Mauris eget hendrerit dui, vitae ultrices felis. Ut ac ligula et orci mattis gravida ut eget enim.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Nullam mi elit, iaculis non laoreet sit amet, varius quis eros. Vivamus vel ligula euismod, tempor dui vitae, consequat felis. Fusce semper fermentum lobortis. Suspendisse potenti. Etiam laoreet lobortis eros, sed faucibus justo mollis a. Phasellus pulvinar ullamcorper velit, a placerat risus. Maecenas ligula arcu, malesuada vitae congue vel, eleifend vel ligula. Aenean rutrum sem ac condimentum vulputate. Maecenas gravida consequat sapien nec condimentum.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Morbi id turpis at felis consectetur maximus. Donec pulvinar a elit scelerisque viverra. Nulla varius leo tellus. Aenean mattis id turpis ut porttitor. Phasellus suscipit, urna ac efficitur vehicula, est est rutrum mi, eu vulputate ex ex a erat. Vivamus ut auctor diam. Suspendisse non aliquet lacus. Duis in porttitor neque.</span><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><br style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><span style="color: rgb(85, 85, 85); font-family: ''Open Sans''; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22.8571434020996px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(255, 255, 255);">Suspendisse consectetur vitae dolor in lacinia. Fusce nulla diam, convallis in consequat sit amet, finibus eget diam. Fusce suscipit ornare ligula eu eleifend. Duis eu nibh eget elit interdum tincidunt. Quisque mattis tempus eros in egestas. Cras lectus lacus, ultrices vitae massa in, facilisis egestas lacus. Vivamus faucibus, urna at molestie laoreet, erat arcu faucibus enim, commodo pellentesque magna quam in elit. Praesent nunc orci, euismod a metus vel, condimentum pharetra ipsum. Cras eu ligula rutrum, lobortis ipsum consectetur, ultricies est. Nulla pulvinar, libero at congue tincidunt, lorem libero consectetur neque, vitae luctus nunc tortor et diam. Cras nec venenatis lacus, sed pulvinar tellus. Donec at venenatis tortor. Nam bibendum semper lacinia. Donec faucibus metus quam, sed facilisis est tempor eget.</span>', 'privacy', 'Privacy policy', 'dollar review club privacy policy', '2015-06-17 08:16:14'),
(5, 'Prices', 'Pricing table here...', 'pricing', '', '', '2015-09-05 18:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `dlr_products`
--

CREATE TABLE IF NOT EXISTS `dlr_products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` text NOT NULL,
  `asin` varchar(15) NOT NULL,
  `aws_url` text NOT NULL COMMENT 'AmazonUrl',
  `img_url` text NOT NULL,
  `keywords` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `shipping_price` float(10,2) NOT NULL,
  `daily_limit` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `promo_type` varchar(15) NOT NULL,
  `description` longtext NOT NULL,
  `merchant_id` varchar(32) NOT NULL,
  `category` int(11) NOT NULL,
  `fulfillment` varchar(40) NOT NULL,
  `child_asin` text NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `fk_dlr_products_category_idx` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `dlr_products`
--

INSERT INTO `dlr_products` (`pid`, `uid`, `name`, `asin`, `aws_url`, `img_url`, `keywords`, `price`, `shipping_price`, `daily_limit`, `start_date`, `end_date`, `promo_type`, `description`, `merchant_id`, `category`, `fulfillment`, `child_asin`, `disabled`, `since`) VALUES
(1, 3, 'Modi Effect', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=modi+effect', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'modi effect', 10.00, 0.00, 10, '2015-06-12', '2015-06-30', 'onetime', 'Just modi effect', '36542542542545', 1, 'Fulfilled By Amazon', 'a:1:{i:0;s:6:"sdfdsf";}', 0, '2015-06-12 12:10:02'),
(2, 3, 'BUGATCHI Men''s Prato Sweater IND', 'B00NFBULXC', 'http://www.amazon.com/dp/B00NFBULXC?keywords=coll+swater', 'http://ecx.images-amazon.com/images/I/41W6G5qJAwL._SL160_.jpg', 'coll swater', 30.00, 10.00, 15, '2015-06-12', '2015-06-28', 'onetime', 'Bugatchi cool sweater', 'D5845EFWF', 8, 'Fulfilled By Amazon', 'a:1:{i:0;s:6:"123654";}', 0, '2015-06-12 12:13:42'),
(3, 3, 'Orient Men''s EM65007B Stainless Steel Automatic Dive Watch', 'B00A6U2GIS', 'http://www.amazon.com/dp/B00A6U2GIS?keywords=Metal+watch', 'http://ecx.images-amazon.com/images/I/51Mj7h4gfaL._SL160_.jpg', 'Metal watch', 90.00, 5.00, 30, '2015-06-12', '2015-06-30', 'onetime', 'Metal watch', 'DFDSDEWESS', 8, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-06-12 12:16:07'),
(4, 3, 'Ray-Ban RB2132 - 811/32 New Wayfarer Sunglasses, Black Rubber Frame/Green Lens, 55 mm', 'B003KGTDGI', 'http://www.amazon.com/dp/B003KGTDGI?keywords=Lens+55mm', 'http://ecx.images-amazon.com/images/I/31eiGKGd3OL._SL160_.jpg', 'Lens 55mm', 85.00, 5.00, 30, '2015-06-12', '2015-06-30', 'onetime', 'Ray-Ban is the world''s most iconic eyewear brand and is a global leader in its sector. ', 'DFDSDEWESS', 2, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-06-12 12:18:12'),
(5, 3, 'WallyBags 40 Inch Garment Bag, Black, One Size', 'B000AB286S', 'http://www.amazon.com/dp/B000AB286S?keywords=one+piece', 'http://ecx.images-amazon.com/images/I/41VbLJsuh6L._SL160_.jpg', 'one piece', 120.00, 7.00, 65, '2015-06-01', '2015-06-30', 'onetime', 'description', '3215465', 2, 'Merchant Fulfilled', 'a:0:{}', 0, '2015-06-12 12:22:27'),
(6, 3, 'Leather Honey Leather Conditioner, the Best Leather Conditioner Since 1968, 8 Oz Bottle. For Use on Leather Apparel, Furniture, Auto Interiors, Shoes, Bags and Accessories. Non-Toxic and Made in the USA!', 'B003IS3HV0', 'http://www.amazon.com/dp/B003IS3HV0?keywords=Honey+leather', 'http://ecx.images-amazon.com/images/I/31bkIoo7liL._SL160_.jpg', 'Honey leather', 90.00, 10.00, 30, '2015-06-13', '2015-06-30', 'onetime', 'test description', 'DFDSDEWESS', 2, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-06-12 12:32:00'),
(7, 3, 'Indian Prim Minister', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test', 10.00, 10.00, 10, '2015-07-23', '2015-07-30', 'onetime', 'fsddffsdfd', 'sdffdsfsdfsdfdfdsf', 3, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:09:38'),
(8, 3, 'Great Man', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test', 10.00, 10.00, 10, '2015-07-23', '2015-07-30', 'onetime', 'fsddffsdfd', 'sdffdsfsdfsdfdfdsf', 3, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:11:32'),
(9, 3, 'Narendra Modi', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test', 10.00, 10.00, 10, '2015-07-23', '2015-07-30', 'onetime', 'fsddffsdfd', 'sdffdsfsdfsdfdfdsf', 3, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:30:27'),
(10, 3, 'Gujarat CM', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test', 10.00, 10.00, 10, '2015-07-16', '2015-07-31', 'onetime', 'dfdffgdgfggfdgfdgd', 'dfsdfsfdfdsfsff', 8, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:34:29'),
(11, 3, 'P.M. India', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test+zip', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test zip', 10.00, 10.00, 10, '2015-07-16', '2015-07-30', 'onetime', 'dsfdsffs fdsfdfd fdsfdfsdf', 'dsf dff sdfdf dsfsdf sd', 9, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:40:05'),
(12, 3, 'Iron Man', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test+zip', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test zip', 10.00, 10.00, 10, '2015-07-16', '2015-07-30', 'onetime', 'dsfdsffs fdsfdfd fdsfdfsdf', 'dsf dff sdfdf dsfsdf sd', 9, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:41:00'),
(13, 3, 'PM Bio', '1623659388', 'http://www.amazon.com/dp/1623659388?keywords=test+zip', 'http://ecx.images-amazon.com/images/I/41UAtr%2BVUkL._SL160_.jpg', 'test zip', 10.00, 10.00, 10, '2015-07-16', '2015-07-30', 'general', 'dsfdsffs fdsfdfd fdsfdfsdf', 'dsf dff sdfdf dsfsdf sd', 9, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-16 14:44:23'),
(14, 3, 'BUGATCHI Men''s Prato Sweater', 'B00NFBULXC', 'http://www.amazon.com/dp/B00NFBULXC?keywords=test+zip+322', 'http://ecx.images-amazon.com/images/I/41W6G5qJAwL._SL160_.jpg', 'test zip 322', 10.00, 10.00, 10, '2015-07-17', '2015-07-20', 'onetime', 'sdfdsfdfsd', 'sdfdsfdsf', 7, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-17 07:59:13'),
(15, 3, 'Latest BUGATCHI Men''s Prato Sweater', 'B00NFBULXC', 'http://www.amazon.com/dp/B00NFBULXC?keywords=Latest+DRC+product', 'http://ecx.images-amazon.com/images/I/41W6G5qJAwL._SL160_.jpg', 'Latest DRC product', 600.00, 10.00, 10, '2015-07-29', '2015-07-31', 'onetime', 'consectetur adipiscing elit. Vivamus sit amet sagittis mauris. Pellentesque id venenatis eros, at sollicitudin quam. Aenean eget bibendum ligula. Donec ultrices ex dignissim, tristique sem nec, lacinia quam. Maecenas at ultrices quam. Vivamus metus velit, pellentesque in nulla ullamcorper, iaculis accumsan nulla. Aliquam ultricies vestibulum justo vitae imperdiet. Sed eros diam, dapibus a dolor quis, rutrum tempor augue. Aenean consectetur, turpis at interdum tincidunt, nunc mauris lobortis augue, non hendrerit justo urna eget libero. Vivamus ex ex, aliquet at purus in, pulvinar dignissim purus. In et tristique mi. Maecenas purus justo, faucibus et maximus placerat, ultricies at massa. Fusce lacus lacus, rhoncus id volutpat ac, efficitur sollicitudin arcu.', 'G76E9775KGD', 8, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-07-29 06:01:50'),
(16, 18, 'Orient Men''s EM65007B Stainless Steel Automatic Dive Watch', 'B00A6U2GIS', 'http://www.amazon.com/dp/B00A6U2GIS?keywords=Toys+Watch', 'http://ecx.images-amazon.com/images/I/51Mj7h4gfaL._SL160_.jpg', 'Toys Watch', 120.00, 10.00, 10, '2015-08-03', '2015-08-05', 'onetime', 'Toys category item only for testing.', 'GKKAJDJSJD', 6, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-08-03 10:27:59'),
(17, 22, 'Mamaway Ring Sling Baby Carrier - One Size Fits All - Easy On Your Back - Comfort For Your Baby - Can Be Used For Different Positions - Breastfeeding Privacy - Red Anchors', 'B00SAHFAWI', 'http://www.amazon.com/dp/B00SAHFAWI?keywords=ring+sling', 'http://ecx.images-amazon.com/images/I/51fjzg-46pL._SL160_.jpg', 'ring sling', 67.99, 0.00, 500, '2015-09-03', '2015-09-18', 'general', '', '', 7, 'Fulfilled By Amazon', 'a:0:{}', 0, '2015-09-03 20:29:29'),
(18, 34, 'Mamaway Postpartum Belly Band - Comfortable & Incredibly Stretchy - Medium', 'B011UPGDU4', 'http://www.amazon.com/dp/B011UPGDU4?keywords=Cloth', 'http://ecx.images-amazon.com/images/I/51JmuWw22SL._SL160_.jpg', 'Cloth', 99.95, 0.00, 10, '2015-10-29', '2015-10-30', 'general', 'Good', '123456', 4, 'Fulfilled By Amazon', 'a:0:{}', 1, '2015-10-29 09:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `dlr_promo_codes`
--

CREATE TABLE IF NOT EXISTS `dlr_promo_codes` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`promo_id`),
  KEY `dlr_promo_codes_product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `dlr_promo_codes`
--

INSERT INTO `dlr_promo_codes` (`promo_id`, `promo_code`, `product_id`, `is_used`) VALUES
(1, 'FLWL-E2GBRV-8X5MY3', 13, 1),
(2, 'FLEC-3GDEPN-B5P8C7', 13, 0),
(3, 'FLGP-SY8EJ9-MTM2QH', 13, 0),
(4, 'FLTT-U2QE4M-XC5J4N', 13, 0),
(5, 'FLDG-KA72HN-W9WQ43', 13, 0),
(6, 'FLC5-KHWR3S-B4N5GR', 13, 0),
(7, 'FLQC-Z7BHGW-9LRQ4E', 13, 0),
(8, 'FLN7-YCNT3A-XFUM44', 13, 0),
(9, 'FLSJ-3ZXX33-6L7U2R', 13, 0),
(10, 'FLVB-DNQA9L-PVQJYG', 13, 0),
(11, 'FLFK-69X8MZ-TEGDCP', 13, 0),
(12, 'FL6T-QSDFZT-WZ9BJG', 13, 0),
(13, 'FL7Z-55RXPP-XQA8WU', 13, 0),
(14, 'FLPX-7JV5U4-TBXH8V', 13, 0),
(15, 'FLGB-KYDFGB-WWGZLL', 13, 0),
(16, 'FLKK-6H5FFR-PG6AEB', 13, 0),
(17, 'FLJ2-87F9YG-FG7NN3', 13, 0),
(18, 'FLCJ-6MGGPW-865CLQ', 13, 0),
(19, 'FLH2-JJVRFD-XK36EQ', 13, 0),
(20, 'FLWJ-RLD48B-DT8NY6', 13, 0),
(21, 'FLV5-LFH6FC-9VT5GN', 13, 0),
(22, 'FLJA-PQABZC-JDEU4X', 13, 0),
(23, 'FLGB-KFNLWM-9PS32A', 13, 0),
(24, 'FL49-XRDHZH-ZF63NZ', 13, 0),
(25, 'FLE9-SEADBV-F34ZSG', 13, 0),
(26, 'FLS3-KPLLTV-RWVKJ3', 13, 0),
(27, 'FL2T-W42ZZ6-ZHK66X', 13, 0),
(28, 'FLGN-QH9CXY-D74H4Q', 13, 0),
(29, 'FLMV-ANNQM9-9XMPAY', 13, 0),
(30, 'FLM3-Z5APXU-NX2M8F', 13, 0),
(31, 'FLRU-KTWUMD-CEBQER', 13, 0),
(32, 'FL8Y-GJMR7Q-ENX52D', 13, 0),
(33, 'FLHJ-RZ93LV-BGX3S6', 13, 0),
(34, 'FLDR-6N4BXL-5S23AL', 13, 0),
(35, 'FLS6-MD86T4-T8JSG7', 13, 0),
(36, 'FLDY-SVRCPG-5UEASL', 13, 0),
(37, 'FLP3-7GZMHP-2XRNSG', 13, 0),
(38, 'FLB7-FY6V38-SKZDNM', 13, 0),
(39, 'FLJ2-BUUVUW-WHKRSM', 13, 0),
(40, 'FLST-6C4UEM-YEJCQ6', 13, 0),
(41, 'FLP5-KMCQ9B-CQ6YWZ', 13, 0),
(42, 'FL6T-3BXXFS-LR58LK', 13, 0),
(43, 'FL9H-RQBYFL-S2QD8U', 13, 0),
(44, 'FLQD-AJC76X-TMG5EX', 13, 0),
(45, 'FL8N-CU6TKX-7BQP2B', 13, 0),
(46, 'FLUD-QM9CJN-JMY8YF', 13, 0),
(47, 'FL5S-UQMQE8-A3TEEN', 13, 0),
(48, 'FL28-3GPA9A-F7HLEH', 13, 0),
(49, 'FLV2-EQSXDH-KXQ3L9', 13, 0),
(50, 'FL69-FZYEN5-X9FANJ', 13, 0),
(51, 'FLUB-LLXMDE-UQGALY', 13, 0),
(52, 'FLJE-YTJX4M-PLMNCP', 13, 0),
(53, 'FL4Z-YTJSVX-R3VWJJ', 13, 0),
(54, 'FLBP-QUGQJW-D95AQE', 13, 0),
(55, 'FLL4-YFDYX9-CXCK2L', 13, 0),
(56, 'FL6F-2HHMSH-Q2CCS6', 13, 0),
(57, 'FL5M-5JLLJV-Y9DCW6', 13, 0),
(58, 'FLRD-RRG4ZQ-SPZR6D', 13, 0),
(59, 'FL6X-RHJSE5-A42347', 13, 0),
(60, 'FLR9-AULLJD-TQF8N6', 13, 0),
(61, 'FLXN-QTQMRW-3HUGQM', 13, 0),
(62, 'FLHZ-2RV3KR-NSLZ82', 13, 0),
(63, 'FLDS-9E5PHF-WDYJQK', 13, 0),
(64, 'FLTH-BUG7Q7-4LHFWV', 13, 0),
(65, 'FL5R-T68WEU-QM3KQH', 13, 0),
(66, 'FLCX-G7EU8X-49M3JP', 13, 0),
(67, 'FLHR-WW6EPK-6YVTNS', 13, 0),
(68, 'FL5N-H9JKVL-8874NV', 13, 0),
(69, 'FLVL-GTVREY-PCK9JL', 13, 0),
(70, 'FLU6-XNDXGR-9DXSEJ', 13, 0),
(71, 'FL4N-JAL2XY-DAVFLP', 13, 0),
(72, 'FLSG-JH8XYE-MADL6W', 13, 0),
(73, 'FL65-9VYLZ6-4HJ9UF', 13, 0),
(74, 'FLGV-GYZ3P4-JQ2NW7', 13, 0),
(75, 'FLUJ-M3Z8QC-B6XHS8', 13, 0),
(76, 'FLBL-YYAJLB-QSY9SX', 13, 0),
(77, 'FLH6-EV7BSA-4EF4SW', 13, 0),
(78, 'FLMR-V2REM6-35ULJP', 13, 0),
(79, 'FLUE-G59MAT-R47NS2', 13, 0),
(80, 'FL8M-XYAKJ6-WF5JJ6', 13, 0),
(81, 'FLFM-935UVJ-WLJPC6', 13, 0),
(82, 'FLAH-MNWKN4-8FNX6L', 13, 0),
(83, 'FL9M-6DBUJR-U7GUJS', 13, 0),
(84, 'FLAN-KJVJX2-P5JU2B', 13, 0),
(85, 'FLU5-3QXYFK-YCB8UY', 13, 0),
(86, 'FLMW-E4RKNX-D5PZJH', 13, 0),
(87, 'FLP6-TR285E-9AG84U', 13, 0),
(88, 'FLNC-9H675X-5GPBJW', 13, 0),
(89, 'FLDX-PB5CHF-ZQG42X', 13, 0),
(90, 'FL77-L7BSTP-Q44L6D', 13, 0),
(91, 'FLGV-CTQSEH-JKP9NX', 13, 0),
(92, 'FLX4-AA6YJH-38Y666', 13, 0),
(93, 'FL7G-J7TFX9-HHU42R', 13, 0),
(94, 'FLM9-MTE53Q-PXYNSN', 13, 0),
(95, 'FLN3-LEHP43-BCTMJD', 13, 0),
(96, 'FLPT-JSCBFF-X2SYSM', 13, 0),
(97, 'FLMV-7NYSTS-TUJ7EJ', 13, 0),
(98, 'FL9M-5VYMVJ-9ESQLC', 13, 0),
(99, 'FLZN-FBUS3T-H5CPAG', 13, 0),
(100, 'FLZF-JKVMLY-JWLUEV', 13, 0),
(101, '95a46-fsdfe-45s14', 14, 0),
(102, '95a46-eeete-45s14', 1, 1),
(103, '95a46-jkjhg-45s14', 2, 0),
(104, '95a46-jgffg-45s14', 3, 1),
(105, '95a46-54d25-45s14', 4, 1),
(106, '95a46-erwsc-45s14', 5, 1),
(107, '95a46-ds4s5-45s14', 6, 0),
(108, '95a46-sdssd-45s14', 7, 1),
(109, '95a46-fd6ds5-45s14', 8, 0),
(110, '95a46-sdf6d5-45s14', 9, 0),
(111, '95a46-ff6dfd-45s14', 10, 1),
(112, '95a46-dsfddf-45s14', 11, 0),
(113, '95a46-sdfd4s-45s14', 12, 0),
(114, 'DKSKERI-DKSJJE-KSKJSH-FKDJSS', 15, 0),
(115, 'GJFSDJJJF-DJSKJSKDJ-DJDHSJDHS', 16, 0),
(116, 'GHTCJ982N6', 17, 1),
(117, '12345678', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dlr_users`
--

CREATE TABLE IF NOT EXISTS `dlr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `verification_code` varchar(32) NOT NULL,
  `role` varchar(10) NOT NULL,
  `is_fb` tinyint(1) NOT NULL,
  `isDel` tinyint(1) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `dlr_users`
--

INSERT INTO `dlr_users` (`id`, `fname`, `lname`, `email`, `pass`, `verification_code`, `role`, `is_fb`, `isDel`, `registered`) VALUES
(1, 'Backend', 'User', 'backend@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', 'backend', 0, 0, '2015-06-05 15:31:26'),
(2, 'Shopper', 'User', 'shopper@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', 'shopper', 0, 0, '2015-06-08 07:48:09'),
(3, 'Company', 'User', 'companies@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', 'companies', 0, 0, '2015-06-08 08:11:33'),
(6, 'Anfernee', 'Chang', 'anfernee@transbiz.com.tw', '38ebc9f9789dfc61b4c0089889fc3600', '', 'companies', 0, 0, '2015-07-28 10:01:30'),
(13, 'Sateesh', 'Kumar', 'sateesh@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', 'shopper', 0, 0, '2015-07-29 06:46:03'),
(16, 'Sateesh', 'Kumar', 'rex.sateesh@gmail.com', '', '', 'shopper', 1, 0, '2015-08-01 06:26:14'),
(17, 'Test', 'LLC', 'testllc@gmail.com', '4bc96825862f0f15b487399fd8f3dace', '', 'companies', 0, 0, '2015-08-03 09:43:29'),
(18, 'Okays', 'LLC', 'okayllc@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', 'companies', 0, 0, '2015-08-03 10:01:36'),
(19, 'Anfernee', 'Chang', 'bepharmacy@gmail.com', '', '', 'shopper', 1, 0, '2015-08-04 09:26:02'),
(20, 'Smile', 'Development', 'asfds@fads.com', '38ebc9f9789dfc61b4c0089889fc3600', '', 'companies', 0, 0, '2015-08-04 11:46:44'),
(21, 'Sudeep', 'Panda', 'sudeep.panda@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7d25297d7e59c3f5b3657f60dbdffd34', 'shopper', 0, 1, '2015-08-17 06:21:39'),
(22, 'John', 'Lopez', 'john@transbiz.com.tw', '144e33b5ef519e223838a250f121edd5', '', 'companies', 0, 0, '2015-08-22 09:00:17'),
(23, 'Erika', 'Lopez', 'mp.hub.online@gmail.com', '144e33b5ef519e223838a250f121edd5', 'd061c19f63dbf64b060de16831346905', 'shopper', 0, 1, '2015-08-31 15:36:30'),
(24, 'Kate', 'Loriel', 'solutions.fastclick@gmail.com', '144e33b5ef519e223838a250f121edd5', '0e492a816daf60fda5c69d27d7c2b083', 'shopper', 0, 1, '2015-08-31 15:45:43'),
(25, 'tariq', 'hussain', 'infowiz.tariq@gmail.com', '5c180b4b199368d479caeabd0f411ab5', '', 'shopper', 0, 0, '2015-09-02 11:07:41'),
(26, 'tariq', 'hussain', 'kiran.tariq@gmail.com', '5c180b4b199368d479caeabd0f411ab5', '', 'companies', 0, 0, '2015-09-02 11:11:27'),
(27, 'asdfasd', 'fasdfasdf', 'asdfasdfas@gmail.com', '25c0783596f8dc77528ff692a9dc82d1', '222aa61f63828499a0008955bf9783d6', 'shopper', 0, 1, '2015-09-02 11:14:46'),
(28, 'Rahul', 'Sharma', 'rahul.sharma@ggmail.com', '4bc96825862f0f15b487399fd8f3dace', 'b12d2c2466df1106307f3e8e9feb47f6', 'shopper', 0, 1, '2015-09-05 17:45:51'),
(29, 'Rajan', 'Saxena', 'rajansaxena66@gmail.com', '004361e46128c7a5d2a3c87de9b1cec8', '', 'shopper', 0, 0, '2015-09-05 17:47:10'),
(30, 'aakash', 'deep', 'aakashdeep.15031994@gmail.com', 'c4a33f7a5254301a314b7d40385501a4', '', 'shopper', 0, 0, '2015-09-05 17:55:19'),
(31, 'Erika', 'Santos', 'barqs.aicom@gmail.com', '144e33b5ef519e223838a250f121edd5', '', 'shopper', 0, 0, '2015-09-06 15:01:15'),
(32, 'Anfernee', 'Chang', 'hello@transbiz.com.tw', '38ebc9f9789dfc61b4c0089889fc3600', '', 'companies', 0, 0, '2015-09-19 11:45:13'),
(33, 'John', 'Curto', 'carbineer25@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', 'shopper', 0, 0, '2015-10-29 06:14:36'),
(34, 'Julia', 'Santo', 'carbineer25@yahoo.com.tw', '25d55ad283aa400af464c76d713c07ad', '', 'companies', 0, 0, '2015-10-29 09:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `dlr_users_history`
--

CREATE TABLE IF NOT EXISTS `dlr_users_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  `reason` varchar(120) NOT NULL,
  `comment` text NOT NULL,
  `is_pending` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`history_id`),
  KEY `fk_users_history_idx` (`user_id`),
  KEY `fk_users_history_product_id_idx` (`product_id`),
  KEY `fk_users_history_promo_id_idx` (`promo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `dlr_users_history`
--

INSERT INTO `dlr_users_history` (`history_id`, `user_id`, `product_id`, `promo_id`, `reason`, `comment`, `is_pending`) VALUES
(1, 2, 1, 102, 'Offer is expired', 'Praesent ultrices fermentum tortor. Fusce id metus dictum, suscipit tortor in, luctus nisi. Nunc tempor felis varius, placerat nisi et, pulvinar lacus. Nullam pharetra arcu libero, ut lacinia ligula blandit a. Integer sit amet enim blandit, vulputate dolor vitae, viverra arcu. Sed volutpat malesuada lacus, sit amet egestas nunc finibus ac. Suspendisse sollicitudin nisi nisl, vel vulputate risus aliquet at. Sed sed augue et lectus dictum tempor quis eu purus. Nam scelerisque venenatis arcu ut mattis. Nullam quis interdum tortor. Etiam sed quam nec elit pulvinar lacinia quis vel dolor. Donec felis libero, semper nec tempus ut, imperdiet quis risus.', 1),
(2, 2, 3, 104, 'Coupon is invalid', 'Aenean id ultrices metus, at congue dolor. In at tempus velit, non feugiat enim. Donec consectetur vestibulum felis sed accumsan. Etiam malesuada ornare nulla, eu consectetur odio semper vehicula. Nunc pulvinar enim ac leo gravida, malesuada vestibulum odio placerat. Vivamus semper massa eu nisl porttitor blandit. Nam eget iaculis dui. Nunc sit amet mattis quam. Etiam gravida faucibus ante, sit amet tincidunt turpis suscipit ut. Sed dignissim vitae diam sit amet faucibus. Pellentesque elementum eu ligula non congue. Integer malesuada felis ac lectus gravida malesuada. Proin in augue turpis. Integer tempor faucibus dolor vitae tempor.', 1),
(3, 2, 5, 106, 'I did not want to purchase this item', 'Sed at leo posuere, fringilla orci eget, facilisis tortor. Curabitur in massa eu enim dapibus tincidunt. Aenean in lorem sem. Suspendisse potenti. Vestibulum dignissim metus at mollis faucibus. Aliquam at venenatis metus. Integer vehicula nibh eu lectus fermentum malesuada. Etiam euismod dictum dictum. Sed molestie iaculis enim, sagittis porta sapien malesuada ut. Nullam aliquet elit at nisl rutrum porta. Curabitur ut tincidunt purus. Etiam imperdiet urna a lectus gravida tempor quis eu mauris.', 1),
(4, 2, 13, 1, 'My review is not being found', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam venenatis erat leo, ac fermentum arcu dapibus sit amet. Sed molestie odio sed dictum mattis. Vivamus non odio ante. Nullam venenatis, risus id egestas tempus, purus felis dapibus lacus, non sagittis lectus turpis vitae purus. Quisque quis est sapien. Ut congue ante eget lacus cursus, et pulvinar orci ultricies. Sed euismod tempus lectus sed egestas. Duis blandit imperdiet quam vel blandit.', 1),
(5, 2, 10, 111, '', '', 1),
(6, 2, 4, 105, '', '', 1),
(7, 30, 17, 116, '', '', 1),
(8, 33, 7, 108, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dlr_users_meta`
--

CREATE TABLE IF NOT EXISTS `dlr_users_meta` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `mkey` varchar(120) NOT NULL,
  `mval` longtext NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dlr_users_meta`
--

INSERT INTO `dlr_users_meta` (`mid`, `uid`, `mkey`, `mval`) VALUES
(1, 2, 'category', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"9";}'),
(5, 2, 'amazon_url', 'https://www.amazon.com/gp/profile/A5UB256BF4T3W'),
(8, 3, 'cc_number', '4111111111111111'),
(9, 3, 'cc_name', 'Companies User'),
(10, 3, 'cc_expiry', '12/31'),
(11, 3, 'cc_cvc', '333'),
(12, 3, 'cc_type', 'visa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dlr_products`
--
ALTER TABLE `dlr_products`
  ADD CONSTRAINT `fk_dlr_products_category` FOREIGN KEY (`category`) REFERENCES `dlr_category` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dlr_promo_codes`
--
ALTER TABLE `dlr_promo_codes`
  ADD CONSTRAINT `dlr_promo_codes_product_id` FOREIGN KEY (`product_id`) REFERENCES `dlr_products` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dlr_users_history`
--
ALTER TABLE `dlr_users_history`
  ADD CONSTRAINT `fk_users_history_product_id` FOREIGN KEY (`product_id`) REFERENCES `dlr_products` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_history_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `dlr_promo_codes` (`promo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_history_user_id` FOREIGN KEY (`user_id`) REFERENCES `dlr_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
