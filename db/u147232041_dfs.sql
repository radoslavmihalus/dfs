-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2015 at 04:01 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u147232041_dfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(150) DEFAULT NULL,
  `table_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_name_UNIQUE` (`form_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_name`, `table_name`) VALUES
(1, 'frmlogIn', 'tbl_user'),
(2, 'frmSignIn', 'tbl_user'),
(3, 'frmKennelCreateProfile', 'tbl_userkennel'),
(4, 'frmEditUser', 'tbl_user'),
(5, 'frmEditPassword', 'tbl_user'),
(6, 'frmEditProfileCoverImage', 'tbl_userkennel'),
(7, 'frmEditProfileImage', 'tbl_userkennel'),
(8, 'frmKennelEditProfile', 'tbl_userkennel'),
(9, 'frmAddAward', 'link_kennel_awards'),
(10, 'frmEditAward', 'link_kennel_awards'),
(11, 'frmOwnerCreateProfile', 'tbl_userowner'),
(12, 'frmOwnerEditProfile', 'tbl_userowner'),
(13, 'frmOwnerEditCoverPhoto', 'tbl_userowner'),
(14, 'frmOwnerEditProfilePhoto', 'tbl_userowner'),
(15, 'frmCreateDogProfile', 'tbl_dogs'),
(16, 'frmEditDogProfile', 'tbl_dogs'),
(17, 'frmDogAddTitle', 'tbl_dogs_championship'),
(18, 'frmEditDogProfilePicture', 'tbl_dogs'),
(19, 'frmDogAddCoowner', 'tbl_dogs_coowners'),
(20, 'frmDogAddHealth', 'tbl_dogs_health'),
(21, 'frmDogAddMating', 'tbl_dogs_matings'),
(22, 'frmDogAddWorkexam', 'tbl_dogs_workexams'),
(23, 'frmPlannedLitter', 'tbl_planned_litters');

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

DROP TABLE IF EXISTS `form_fields`;
CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(150) DEFAULT NULL,
  `element_name` varchar(150) DEFAULT NULL,
  `field_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_name`, `element_name`, `field_name`) VALUES
(1, 'frmlogIn', 'txtEmail', 'email'),
(2, 'frmlogIn', 'txtPassword', 'password'),
(3, 'frmSignIn', 'txtName', 'name'),
(4, 'frmSignIn', 'txtSurname', 'surname'),
(5, 'frmSignIn', 'txtEmail', 'email'),
(6, 'frmSignIn', 'ddlCountries', 'state'),
(7, 'frmSignIn', 'txtPassword', 'password'),
(8, 'frmKennelCreateProfile', 'txtKennelName', 'kennel_name'),
(9, 'frmKennelCreateProfile', 'txtKennelFciNumber', 'kennel_fci_number'),
(10, 'frmKennelCreateProfile', 'txtKennelProfilePicture', 'kennel_profile_picture'),
(11, 'frmKennelCreateProfile', 'txtKennelWebsite', 'kennel_website'),
(12, 'frmKennelCreateProfile', 'txtKennelDescription', 'kennel_description'),
(13, 'frmEditUser', 'txtName', 'name'),
(14, 'frmEditUser', 'txtSurname', 'surname'),
(15, 'frmEditUser', 'txtEmail', 'email'),
(16, 'frmEditUser', 'txtAddress', 'address'),
(17, 'frmEditUser', 'txtTown', 'city'),
(18, 'frmEditUser', 'txtZip', 'zip'),
(19, 'frmEditUser', 'txtPhoneNumber', 'phone'),
(20, 'frmEditUser', 'ddlYear', 'year_of_birth'),
(21, 'frmEditPassword', 'txtNewPassword', 'password'),
(22, 'frmEditUser', 'ddlCountries', 'state'),
(23, 'frmEditProfileCoverImage', 'txtKennelCoverPhoto', 'kennel_background_image'),
(24, 'frmEditProfileImage', 'txtKennelProfilePicture', 'kennel_profile_picture'),
(25, 'frmKennelEditProfile', 'txtKennelName', 'kennel_name'),
(26, 'frmKennelEditProfile', 'txtKennelFciNumber', 'kennel_fci_number'),
(27, 'frmKennelEditProfile', 'txtKennelWebsite', 'kennel_website'),
(28, 'frmKennelEditProfile', 'txtKennelDescription', 'kennel_description'),
(29, 'frmAddAward', 'ddlDate', 'kennel_award_date'),
(30, 'frmAddAward', 'txtAwardName', 'kennel_award_title'),
(31, 'frmAddAward', 'txtAwardPicture', 'kennel_award_image'),
(32, 'frmEditAward', 'ddlDate', 'kennel_award_date'),
(33, 'frmEditAward', 'txtAwardName', 'kennel_award_title'),
(34, 'frmEditAward', 'txtAwardPicture', 'kennel_award_image'),
(35, 'frmOwnerCreateProfile', 'txtOwnerProfilePhoto', 'owner_profile_picture'),
(36, 'frmOwnerCreateProfile', 'txtOwnerDescritpion', 'owner_description'),
(37, 'frmOwnerEditProfile', 'txtOwnerDescritpion', 'owner_description'),
(38, 'frmOwnerEditCoverPhoto', 'txtOwnerCoverPhoto', 'owner_background_image'),
(39, 'frmOwnerEditProfilePhoto', 'txtOwnerProfilePhoto', 'owner_profile_picture'),
(40, 'frmCreateDogProfile', 'radGender', 'dog_gender'),
(41, 'frmCreateDogProfile', 'chckMating', 'offer_for_mating'),
(42, 'frmCreateDogProfile', 'ddlBreedList', 'breed_name'),
(43, 'frmCreateDogProfile', 'txtDogName', 'dog_name'),
(44, 'frmCreateDogProfile', 'txtDogProfilePhoto', 'dog_image'),
(45, 'frmCreateDogProfile', 'txtPedigreeRegistrationNumber', 'dog_registration_number'),
(46, 'frmCreateDogProfile', 'ddlDate', 'date_of_birth'),
(47, 'frmCreateDogProfile', 'txtDogHeight', 'height'),
(48, 'frmCreateDogProfile', 'txtDogWeight', 'weight'),
(49, 'frmCreateDogProfile', 'ddlCountry', 'country'),
(50, 'frmCreateDogProfile', 'ddlDogFather', 'dog_father'),
(51, 'frmCreateDogProfile', 'ddlDogMother', 'dog_mother'),
(52, 'frmEditDogProfile', 'radGender', 'dog_gender'),
(53, 'frmEditDogProfile', 'chckMating', 'offer_for_mating'),
(54, 'frmEditDogProfile', 'ddlBreedList', 'breed_name'),
(55, 'frmEditDogProfile', 'txtDogName', 'dog_name'),
(56, 'frmEditDogProfile', 'txtPedigreeRegistrationNumber', 'dog_registration_number'),
(57, 'frmEditDogProfile', 'ddlDate', 'date_of_birth'),
(58, 'frmEditDogProfile', 'txtDogHeight', 'height'),
(59, 'frmEditDogProfile', 'txtDogWeight', 'weight'),
(60, 'frmEditDogProfile', 'ddlCountry', 'country'),
(61, 'frmEditDogProfile', 'ddlDogFather', 'dog_father'),
(62, 'frmEditDogProfile', 'ddlDogMother', 'dog_mother'),
(63, 'frmDogAddTitle', 'ddlDate', 'date'),
(64, 'frmDogAddTitle', 'txtChampionshipName', 'description'),
(65, 'frmDogAddTitle', 'txtChampionshipPicture', 'image'),
(66, 'frmDogAddTitle', 'dog_id', 'dog_id'),
(67, 'frmEditDogProfilePicture', 'txtDogProfilePhoto', 'dog_image'),
(68, 'frmDogAddCoowner', 'txtCoownerName', 'coowner_name'),
(69, 'frmDogAddCoowner', 'ddlCountry', 'coowner_state'),
(70, 'frmDogAddCoowner', 'dog_id', 'dog_id'),
(71, 'frmDogAddHealth', 'ddlDate', 'date'),
(72, 'frmDogAddHealth', 'txtHealthName', 'description'),
(73, 'frmDogAddHealth', 'txtHealthPicture', 'image'),
(74, 'frmDogAddHealth', 'dog_id', 'dog_id'),
(75, 'frmDogAddMating', 'ddlDate', 'date'),
(76, 'frmDogAddMating', 'txtMatingBitchName', 'description'),
(77, 'frmDogAddMating', 'txtMatingBitchPicture', 'image'),
(78, 'frmDogAddMating', 'dog_id', 'dog_id'),
(79, 'frmDogAddWorkexam', 'ddlDate', 'date'),
(80, 'frmDogAddWorkexam', 'txtWorkExamName', 'description'),
(81, 'frmDogAddWorkexam', 'txtWorkExamPicture', 'image'),
(82, 'frmDogAddWorkexam', 'dog_id', 'dog_id'),
(83, 'frmPlannedLitter', 'ddlDateYear', 'year'),
(84, 'frmPlannedLitter', 'ddlDateMonth', 'month'),
(85, 'frmPlannedLitter', 'txtPlannedLitterName', 'name'),
(86, 'frmPlannedLitter', 'ddlPlannedLitterDogName', 'dog_name'),
(87, 'frmPlannedLitter', 'ddlPlannedLitterBitchName', 'bitch_name'),
(88, 'frmPlannedLitter', 'txtPlannedLitterDogProfilePhoto', 'dog_image'),
(89, 'frmPlannedLitter', 'txtPlannedLitterBitchProfilePhoto', 'bitch_image'),
(90, 'frmPlannedLitter', 'kennel_id', 'kennel_id');

-- --------------------------------------------------------

--
-- Table structure for table `link_kennel_awards`
--

DROP TABLE IF EXISTS `link_kennel_awards`;
CREATE TABLE IF NOT EXISTS `link_kennel_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kennel_id` int(11) NOT NULL,
  `kennel_award_date` date DEFAULT NULL,
  `kennel_award_title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kennel_award_image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `link_kennel_breed`
--

DROP TABLE IF EXISTS `link_kennel_breed`;
CREATE TABLE IF NOT EXISTS `link_kennel_breed` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kennel_id` bigint(20) NOT NULL,
  `breed_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `link_usergroup_users`
--

DROP TABLE IF EXISTS `link_usergroup_users`;
CREATE TABLE IF NOT EXISTS `link_usergroup_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usergroup_id` bigint(20) NOT NULL,
  `assigned_user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lk_breed`
--

DROP TABLE IF EXISTS `lk_breed`;
CREATE TABLE IF NOT EXISTS `lk_breed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `breed` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lk_countries`
--

DROP TABLE IF EXISTS `lk_countries`;
CREATE TABLE IF NOT EXISTS `lk_countries` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CountryName_sk` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `GroupName_sk` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `CountryName_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `GroupName_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `CountryName_cz` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `GroupName_cz` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `CountryCode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `lk_countries`
--

INSERT INTO `lk_countries` (`ID`, `CountryName_sk`, `GroupName_sk`, `CountryName_en`, `GroupName_en`, `CountryName_cz`, `GroupName_cz`, `CountryCode`) VALUES
(1, 'Slovensko', 'Európa', 'Slovakia', 'Europe', 'Slovensko', 'Evropa', 'SK'),
(2, 'Česká republika', 'Európa', 'Czech Republic', 'Europe', 'Česká republika', 'Evropa', 'CZ'),
(135, 'Albánsko', 'Európa', 'Albania', 'Europe', 'Albánie', 'Evropa', NULL),
(17, 'Belgicko', 'Európa', 'Belgium', 'Europe', 'Belgie', 'Evropa', NULL),
(20, 'Bielorusko', 'Európa', 'Belarus', 'Europe', 'Bělorusko', 'Evropa', NULL),
(22, 'Bosna a Hercegovina', 'Európa', 'Bosnia-Herzegovina', 'Europe', 'Bosna a Hercegovina', 'Evropa', NULL),
(136, 'Bulharsko', 'Európa', 'Bulgaria', 'Europe', 'Bulharsko', 'Evropa', 'BG'),
(10, 'Cyprus', 'Európa', 'Cyprus', 'Europe', 'Kypr', 'Evropa', NULL),
(166, 'Čierna Hora', 'Európa', 'Republic of Montenegro', 'Europe', 'Černá Hora', 'Evropa', NULL),
(31, 'Dánsko', 'Európa', 'Denmark', 'Europe', 'Dánsko', 'Evropa', NULL),
(36, 'Estónsko', 'Európa', 'Estonia', 'Europe', 'Estonsko', 'Evropa', 'EE'),
(40, 'Fínsko', 'Európa', 'Finland', 'Europe', 'Finsko', 'Evropa', 'FI'),
(42, 'Francúzsko', 'Európa', 'France', 'Europe', 'Francie', 'Evropa', NULL),
(46, 'Grécko', 'Európa', 'Greece', 'Europe', 'Řecko', 'Evropa', NULL),
(54, 'Holandsko', 'Európa', 'Netherlands', 'Europe', 'Nizozemsko', 'Evropa', NULL),
(165, 'Chorvátsko', 'Európa', 'Croatia', 'Europe', 'Chorvatsko', 'Evropa', 'HR'),
(80, 'Írsko', 'Európa', 'Ireland', 'Europe', 'Irsko', 'Evropa', NULL),
(87, 'Lichtenštajnsko', 'Európa', 'Liechtenstein', 'Europe', 'Lichtenštejnsko', 'Evropa', NULL),
(88, 'Litva', 'Európa', 'Lithuania', 'Europe', 'Litva', 'Evropa', 'LT'),
(176, 'Lotyšsko', 'Európa', 'Latvia', 'Europe', 'Lotyšsko', 'Evropa', 'LV'),
(89, 'Luxembursko', 'Európa', 'Luxembourg', 'Europe', 'Lucembursko', 'Evropa', NULL),
(173, 'Macedónsko', 'Európa', 'Macedonia', 'Europe', 'Makedonie', 'Evropa', NULL),
(3, 'Maďarsko', 'Európa', 'Hungary', 'Europe', 'Maďarsko', 'Evropa', 'HU'),
(95, 'Malta', 'Európa', 'Malta', 'Europe', 'Malta', 'Evropa', NULL),
(102, 'Monako', 'Európa', 'Monaco', 'Europe', 'Monako', 'Evropa', NULL),
(107, 'Nemecko', 'Európa', 'Germany', 'Europe', 'Německo', 'Evropa', NULL),
(112, 'Nórsko', 'Európa', 'Norway', 'Europe', 'Norsko', 'Evropa', NULL),
(119, 'Poľsko', 'Európa', 'Poland', 'Europe', 'Polsko', 'Evropa', 'PL'),
(120, 'Portugalsko', 'Európa', 'Portugal', 'Europe', 'Portugalsko', 'Evropa', NULL),
(4, 'Rakúsko', 'Európa', 'Austria', 'Europe', 'Rakousko', 'Evropa', NULL),
(167, 'Rumunsko', 'Európa', 'Romania', 'Europe', 'Rumunsko', 'Evropa', 'RO'),
(170, 'Rusko', 'Európa', 'Russia', 'Europe', 'Rusko', 'Evropa', NULL),
(133, 'Slovinsko', 'Európa', 'Slovenia', 'Europe', 'Slovinsko', 'Evropa', 'SI'),
(64, 'Srbsko', 'Európa', 'Serbia', 'Europe', 'Srbsko', 'Evropa', NULL),
(25, 'Španielsko', 'Európa', 'Spain', 'Europe', 'Španělsko', 'Evropa', NULL),
(145, 'Švajčiarsko', 'Európa', 'Switzerland', 'Europe', 'Švýcarsko', 'Evropa', NULL),
(146, 'Švédsko', 'Európa', 'Sweden', 'Europe', 'Švédsko', 'Evropa', NULL),
(148, 'Taliansko', 'Európa', 'Italy', 'Europe', 'Itálie', 'Evropa', NULL),
(154, 'Turecko', 'Európa', 'Turkey', 'Europe', 'Turecko', 'Evropa', 'TR'),
(155, 'Ukrajina', 'Európa', 'Ukraine', 'Europe', 'Ukrajina', 'Evropa', NULL),
(6, 'Veľká Británia', 'Európa', 'Great Britain', 'Europe', 'Velká Británie', 'Evropa', NULL),
(134, 'Afganistan', 'Zahraničie', 'Afghanistan', 'Overseas', 'Afghánistán', 'Zahraničí', NULL),
(8, 'Alžírsko', 'Zahraničie', 'Algeria', 'Overseas', 'Alžírsko', 'Zahraničí', NULL),
(9, 'Andorra', 'Zahraničie', 'Andorra', 'Overseas', 'Andorra', 'Zahraničí', NULL),
(12, 'Arménsko', 'Zahraničie', 'Armenia', 'Overseas', 'Arménie', 'Zahraničí', NULL),
(171, 'Austrália', 'Zahraničie', 'Australia', 'Overseas', 'Austrálie', 'Zahraničí', NULL),
(13, 'Azerbajdžan', 'Zahraničie', 'Azerbaidjan', 'Overseas', 'Ázerbájdžán', 'Zahraničí', NULL),
(15, 'Bahrajn', 'Zahraničie', 'Bahrain', 'Overseas', 'Bahrajn', 'Zahraničí', NULL),
(16, 'Bangladéš', 'Zahraničie', 'Bangladesh', 'Overseas', 'Bangladéš', 'Zahraničí', NULL),
(21, 'Bolívia', 'Zahraničie', 'Bolivia', 'Overseas', 'Bolívie', 'Zahraničí', NULL),
(24, 'Brazília', 'Zahraničie', 'Brazil', 'Overseas', 'Brazílie', 'Zahraničí', NULL),
(29, 'Čad', 'Zahraničie', 'Chad', 'Overseas', 'Čad', 'Zahraničí', NULL),
(30, 'Čína', 'Zahraničie', 'China', 'Overseas', 'Čína', 'Zahraničí', NULL),
(34, 'Egypt', 'Zahraničie', 'Egypt', 'Overseas', 'Egypt', 'Zahraničí', NULL),
(35, 'Ekvádor', 'Zahraničie', 'Ecuador', 'Overseas', 'Ekvádor', 'Zahraničí', NULL),
(172, 'Etiópia', 'Zahraničie', 'Ethiopia', 'Overseas', 'Etiopie', 'Zahraničí', NULL),
(37, 'Faerské ostrovy', 'Zahraničie', 'Faroe Islands', 'Overseas', 'Faerské ostrovy', 'Zahraničí', NULL),
(39, 'Filipíny', 'Zahraničie', 'Philippines', 'Overseas', 'Filipíny', 'Zahraničí', NULL),
(45, 'Ghana', 'Zahraničie', 'Ghana', 'Overseas', 'Ghana', 'Zahraničí', NULL),
(47, 'Gruzínsko', 'Zahraničie', 'Georgia', 'Overseas', 'Gruzie', 'Zahraničí', NULL),
(49, 'Guatemala', 'Zahraničie', 'Guatemala', 'Overseas', 'Guatemala', 'Zahraničí', NULL),
(56, 'India', 'Zahraničie', 'India', 'Overseas', 'Indie', 'Zahraničí', NULL),
(57, 'Indonézia', 'Zahraničie', 'Indonesia', 'Overseas', 'Indonésie', 'Zahraničí', NULL),
(58, 'Irak', 'Zahraničie', 'Iraq', 'Overseas', 'Irák', 'Zahraničí', NULL),
(59, 'Irán', 'Zahraničie', 'Iran', 'Overseas', 'Írán', 'Zahraničí', NULL),
(60, 'Island', 'Zahraničie', 'Iceland', 'Overseas', 'Island', 'Zahraničí', NULL),
(61, 'Izrael', 'Zahraničie', 'Israel', 'Overseas', 'Izrael', 'Zahraničí', NULL),
(76, 'Japonsko', 'Zahraničie', 'Japan', 'Overseas', 'Japonsko', 'Zahraničí', NULL),
(63, 'Jordánsko', 'Zahraničie', 'Jordan', 'Overseas', 'Jordánsko', 'Zahraničí', NULL),
(65, 'Juhoafrická republika', 'Zahraničie', 'South Africa', 'Overseas', 'Jihoafrická republika', 'Zahraničí', NULL),
(28, 'Kanada', 'Zahraničie', 'Canada', 'Overseas', 'Kanada', 'Zahraničí', NULL),
(68, 'Katar', 'Zahraničie', 'Qatar', 'Overseas', 'Katar', 'Zahraničí', NULL),
(69, 'Kazachstan', 'Zahraničie', 'Kazakhstan', 'Overseas', 'Kazachstán', 'Zahraničí', NULL),
(70, 'Keňa', 'Zahraničie', 'Kenya', 'Overseas', 'Keňa', 'Zahraničí', NULL),
(81, 'Kuvajt', 'Zahraničie', 'Kuwait', 'Overseas', 'Kuvajt', 'Zahraničí', NULL),
(84, 'Libanon', 'Zahraničie', 'Lebanon', 'Overseas', 'Libanon', 'Zahraničí', NULL),
(86, 'Líbya', 'Zahraničie', 'Libya', 'Overseas', 'Libye', 'Zahraničí', NULL),
(90, 'Madagaskar', 'Zahraničie', 'Madagascar', 'Overseas', 'Madagaskar', 'Zahraničí', NULL),
(174, 'Malajzia', 'Zahraničie', 'Malaysia', 'Overseas', 'Malajsie', 'Zahraničí', NULL),
(96, 'Maroko', 'Zahraničie', 'Morocco', 'Overseas', 'Maroko', 'Zahraničí', NULL),
(97, 'Marshallove ostrovy', 'Zahraničie', 'Marshall Islands', 'Overseas', 'Marshallove ostrovy', 'Zahraničí', NULL),
(100, 'Mexiko', 'Zahraničie', 'Mexico', 'Overseas', 'Mexiko', 'Zahraničí', NULL),
(108, 'Nepál', 'Zahraničie', 'Nepal', 'Overseas', 'Nepál', 'Zahraničí', NULL),
(110, 'Nigéria', 'Zahraničie', 'Nigeria', 'Overseas', 'Nigérie', 'Zahraničí', NULL),
(175, 'Nový Zéland', 'Zahraničie', 'New Zealand', 'Overseas', 'Nový Zéland', 'Zahraničí', NULL),
(113, 'Omán', 'Zahraničie', 'Oman', 'Overseas', 'Omán', 'Zahraničí', NULL),
(117, 'Peru', 'Zahraničie', 'Peru', 'Overseas', 'Peru', 'Zahraničí', NULL),
(128, 'Saudská Arábia', 'Zahraničie', 'Saudi Arabia', 'Overseas', 'Saúdská Arábie', 'Zahraničí', NULL),
(130, 'Seychely', 'Zahraničie', 'Seychelles', 'Overseas', 'Seychely', 'Zahraničí', NULL),
(132, 'Singapur', 'Zahraničie', 'Singapore', 'Overseas', 'Singapur', 'Zahraničí', NULL),
(164, 'Spojené arabské emiráty', 'Zahraničie', 'United Arab Emirates', 'Overseas', 'Spojené arabské emiráty', 'Zahraničí', NULL),
(137, 'Srí Lanka', 'Zahraničie', 'Sri Lanka', 'Overseas', 'Srí Lanka', 'Zahraničí', NULL),
(143, 'Sýria', 'Zahraničie', 'Syria', 'Overseas', 'Sýrie', 'Zahraničí', NULL),
(150, 'Thajsko', 'Zahraničie', 'Thailand', 'Overseas', 'Thajsko', 'Zahraničí', NULL),
(153, 'Tunisko', 'Zahraničie', 'Tunisia', 'Overseas', 'Tunisko', 'Zahraničí', NULL),
(156, 'Uganda', 'Zahraničie', 'Uganda', 'Overseas', 'Uganda', 'Zahraničí', NULL),
(7, 'USA', 'Zahraničie', 'USA', 'Overseas', 'USA', 'Zahraničí', NULL),
(158, 'Uzbekistan', 'Zahraničie', 'Uzbekistan', 'Overseas', 'Uzbekistan', 'Zahraničí', NULL),
(161, 'Venezuela', 'Zahraničie', 'Venezuela', 'Overseas', 'Venezuela', 'Zahraničí', NULL),
(186, 'San Marino', 'Európa', 'San Marino', 'Europe', 'San Marino', 'Evropa', NULL),
(187, 'Moldavsko', 'Európa', 'Moldova', 'Europe', 'Moldavsko', 'Evropa', NULL),
(188, 'Argentína', 'Zahraničie', 'Argentina', 'Overseas', 'Argentina', 'Zahraničí', NULL),
(189, 'Čile', 'Zahraničie', 'Chile', 'Overseas', 'Chile', 'Zahraničí', NULL),
(190, 'Kolumbia', 'Zahraničie', 'Colombia', 'Overseas', 'Kolumbie', 'Zahraničí', NULL),
(191, 'Kostarika', 'Zahraničie', 'Costa Rica', 'Overseas', 'Kostarika', 'Zahraničí', NULL),
(192, 'Kuba', 'Zahraničie', 'Cuba', 'Overseas', 'Kuba', 'Zahraničí', NULL),
(193, 'Dominikánska Republika', 'Zahraničie', 'Dominican Republic', 'Overseas', 'Dominikánská Republika', 'Zahraničí', NULL),
(194, 'El Salvador', 'Zahraničie', 'El Salvador', 'Overseas', 'El Salvador', 'Zahraničí', NULL),
(195, 'Honduras', 'Zahraničie', 'Honduras', 'Overseas', 'Honduras', 'Zahraničí', NULL),
(196, 'Nikaragua', 'Zahraničie', 'Nicaragua', 'Overseas', 'Nicaragua', 'Zahraničí', NULL),
(197, 'Panama', 'Zahraničie', 'Panama', 'Overseas', 'Panama', 'Zahraničí', NULL),
(198, 'Puerto Rico', 'Zahraničie', 'Puerto Rico', 'Overseas', 'Puerto Rico', 'Zahraničí', NULL),
(199, 'Pakistan', 'Zahraničie', 'Pakistan', 'Overseas', 'Pákistán', 'Zahraničí', NULL),
(200, 'Paraguaj', 'Zahraničie', 'Paraguay', 'Overseas', 'Paraguay', 'Zahraničí', NULL),
(201, 'Gibraltár', 'Zahraničie', 'Gibraltar', 'Overseas', 'Gibraltar', 'Zahraničí', NULL),
(202, 'Uruguaj', 'Zahraničie', 'Uruguay', 'Overseas', 'Uruguay', 'Zahraničí', NULL),
(203, 'Pakistan', 'Zahraničie', 'Pakistan', 'Overseas', 'Pákistán', 'Zahraničí', NULL),
(204, 'Južná Kórea', 'Zahraničie', 'Republic of Kore', 'Overseas', 'Jižní Korea', 'Zahraničí', NULL),
(205, 'Taiwan', 'Zahraničie', 'Taiwan', 'Overseas', 'Tchaj-wan', 'Zahraničí', NULL),
(206, 'Vietnam', 'Zahraničie', 'Vietnam', 'Overseas', 'Vietnam', 'Zahraničí', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lk_country`
--

DROP TABLE IF EXISTS `lk_country`;
CREATE TABLE IF NOT EXISTS `lk_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` char(3) DEFAULT NULL,
  `country_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lk_usertype`
--

DROP TABLE IF EXISTS `lk_usertype`;
CREATE TABLE IF NOT EXISTS `lk_usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_breeds`
--

DROP TABLE IF EXISTS `tbl_breeds`;
CREATE TABLE IF NOT EXISTS `tbl_breeds` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FCIGroupID` bigint(20) DEFAULT NULL,
  `BreedName` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `FCINumber` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FCIGroupID` (`FCIGroupID`),
  KEY `FCINumber` (`FCINumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=464 ;

--
-- Dumping data for table `tbl_breeds`
--

INSERT INTO `tbl_breeds` (`ID`, `FCIGroupID`, `BreedName`, `FCINumber`) VALUES
(1, 1, 'Australian Kelpie', 293),
(2, 1, 'Chien de Berger Belge - Groenendael', 15),
(3, 1, 'Chien de Berger Belge - Laekenois', 15),
(4, 1, 'Chien de Berger Belge - Malinois', 15),
(5, 1, 'Chien de Berger Belge - Tervueren', 15),
(6, 1, 'Schipperke', 83),
(7, 1, 'Československý Vlčiak', 332),
(8, 1, 'Hrvatski Ovcar', 277),
(9, 1, 'Deutscher Schäferhund - Short-haired', 166),
(10, 1, 'Deutscher Schäferhund - Long-haired', 166),
(11, 1, 'Ca de Bestiar - Short-haired', 321),
(12, 1, 'Ca de Bestiar - Long-haired', 321),
(13, 1, 'Gos d''Atura Catalá - Long-haired', 87),
(14, 1, 'Gos d''Atura Catalá - Smooth-haired', 87),
(15, 1, 'Berger de Beauce - Harlequin', 44),
(16, 1, 'Berger de Beauce - Black and tan', 44),
(17, 1, 'Berger de Brie - Slate', 113),
(18, 1, 'Berger de Brie - Fawn, grey', 113),
(19, 1, 'Berger de Picardie', 176),
(20, 1, 'Chien de Berger des Pyrénées à poil long', 141),
(21, 1, 'Chien de Berger des Pyrénées à face rase', 138),
(22, 1, 'Bearded Collie', 271),
(23, 1, 'Border Collie', 297),
(24, 1, 'Collie Rough', 156),
(25, 1, 'Collie Smooth', 296),
(26, 1, 'Old English Sheepdog (Bobtail)', 16),
(27, 1, 'Shetland Sheepdog', 88),
(28, 1, 'Welsh Corgi Cardigan', 38),
(29, 1, 'Welsh Corgi Pembroke', 39),
(30, 1, 'Cane da pastore Bergamasco', 194),
(31, 1, 'Cane da pastore Maremmano-Abruzzese', 201),
(32, 1, 'Komondor', 53),
(33, 1, 'Kuvasz', 54),
(34, 1, 'Mudi - Fawn', 238),
(35, 1, 'Mudi - Black', 238),
(36, 1, 'Mudi - Blue-Merle', 238),
(37, 1, 'Mudi - Ashen', 238),
(38, 1, 'Mudi - Brown', 238),
(39, 1, 'Mudi - White', 238),
(40, 1, 'Puli - Black', 55),
(41, 1, 'Puli - Black with few rusty coloured or grey shadings', 55),
(42, 1, 'Puli - Fawn with a distinct black mask', 55),
(43, 1, 'Puli - Grey in any shade', 55),
(44, 1, 'Puli - Pearl-white without any rust-red shade', 55),
(45, 1, 'Pumi - Grey in different shades', 56),
(46, 1, 'Pumi - Black', 56),
(47, 1, 'Pumi - groundcolours red, yellow, cream', 56),
(48, 1, 'Pumi - white', 56),
(49, 1, 'Hollandse Herdershond - Short-haired', 223),
(50, 1, 'Hollandse Herdershond - Long-haired', 223),
(51, 1, 'Hollandse Herdershond - Rough-haired', 223),
(52, 1, 'Saarlooswolfhond', 311),
(53, 1, 'Nederlandse Schapendoes', 313),
(54, 1, 'Polski Owczarek Nizinny', 251),
(55, 1, 'Polski Owczarek Podhalanski', 252),
(56, 1, 'Cão da Serra de Aires', 93),
(57, 1, 'Slovenský Čuvač', 142),
(58, 1, 'Ioujnorousskaïa Ovtcharka', 326),
(59, 1, 'Berger Blanc Suisse', 347),
(60, 1, 'Australian Shepherd', 342),
(61, 1, 'Australian Cattle Dog', 287),
(62, 1, 'Bouvier des Ardennes', 171),
(63, 1, 'Bouvier des Flandres', 191),
(64, 2, 'Dobermann - Black with rust red markings', 143),
(65, 2, 'Dobermann - Brown with rust red markings', 143),
(66, 2, 'Deutscher Pinscher - Stag-red, red-brown to dark red-brown', 184),
(67, 2, 'Deutscher Pinscher - Black with tan markings', 184),
(68, 2, 'Zwergpinscher - Stag-red, red-brown to dark red-brown', 185),
(69, 2, 'Zwergpinscher - Black with tan markings', 185),
(70, 2, 'Affenpinscher', 186),
(71, 2, 'Österreichischer Pinscher', 64),
(72, 2, 'Riesenschnauzer - Pure black with black undercoat', 181),
(73, 2, 'Riesenschnauzer - Pepper and salt', 181),
(74, 2, 'Schnauzer - Pure black with black undercoat', 182),
(75, 2, 'Schnauzer - Pepper and salt', 182),
(76, 2, 'Zwergschnauzer - Pure black with black undercoat', 183),
(77, 2, 'Zwergschnauzer - Pepper and salt', 183),
(78, 2, 'Zwergschnauzer - Black and silver', 183),
(79, 2, 'Zwergschnauzer - Pure white with white undercoat', 183),
(80, 2, 'Hollandse Smoushond', 308),
(81, 2, 'Russkiy Tchiorny Terrier', 327),
(82, 2, 'Dogo Argentino', 292),
(83, 2, 'Fila Brasileiro', 225),
(84, 2, 'Shar Pei', 309),
(85, 2, 'Broholmer', 315),
(86, 2, 'Deutscher Boxer - Fawn', 144),
(87, 2, 'Deutscher Boxer - Brindle', 144),
(88, 2, 'Deutsche Dogge - Fawn', 235),
(89, 2, 'Deutsche Dogge - Brindle', 235),
(90, 2, 'Deutsche Dogge - Black', 235),
(91, 2, 'Deutsche Dogge - Harlequin', 235),
(92, 2, 'Deutsche Dogge - Blue', 235),
(93, 2, 'Rottweiler', 147),
(94, 2, 'Perro dogo mallorquín (Ca de Bou)', 249),
(95, 2, 'Dogo Canario', 346),
(96, 2, 'Dogue de Bordeaux', 116),
(97, 2, 'Bulldog', 149),
(98, 2, 'Bullmastiff', 157),
(99, 2, 'Mastiff', 264),
(100, 2, 'Mastino Napoletano', 197),
(101, 2, 'Cane Corso Italiano', 343),
(102, 2, 'Tosa', 260),
(103, 2, 'Cão Fila de São Miguel', 340),
(104, 2, 'Coban Köpegi', 331),
(105, 2, 'Newfoundland - Black', 50),
(106, 2, 'Newfoundland - Brown', 50),
(107, 2, 'Newfoundland - White with black markings', 50),
(108, 2, 'Hovawart - Black and tan', 190),
(109, 2, 'Hovawart - Black', 190),
(110, 2, 'Hovawart - Blond', 190),
(111, 2, 'Leonberger', 145),
(112, 2, 'Landseer', 226),
(113, 2, 'Mastín español', 91),
(114, 2, 'Mastín del Pirineo', 92),
(115, 2, 'Chien de Montagne des Pyrénées', 137),
(116, 2, 'Jugoslovenski Ovcarski Pas - Sarplaninac', 41),
(117, 2, 'Chien de Montagne de l''Atlas', 247),
(118, 2, 'Cão da Serra da Estrela - Short-haired', 173),
(119, 2, 'Cão da Serra da Estrela - Long-haired', 173),
(120, 2, 'Cão de Castro Laboreiro', 170),
(121, 2, 'Rafeiro do Alentejo', 96),
(122, 2, 'St.Bernhardshund (Bernhardiner) - Short haired', 61),
(123, 2, 'St.Bernhardshund (Bernhardiner) - Long haired', 61),
(124, 2, 'Kraski Ovcar', 278),
(125, 2, 'Kavkazskaïa Ovtcharka', 328),
(126, 2, 'Sredneasiatskaïa Ovtcharka', 335),
(127, 2, 'Do-Khyi (Tibetan Mastiff)', 230),
(128, 2, 'Appenzeller Sennenhund', 46),
(129, 2, 'Berner Sennenhund', 45),
(130, 2, 'Entlebucher Sennenhund', 47),
(131, 2, 'Grosser Schweizer Sennenhund', 58),
(132, 3, 'Terrier Brasileiro', 341),
(133, 3, 'Deutscher Jagdterrier', 103),
(134, 3, 'Airedale Terrier', 7),
(135, 3, 'Bedlington Terrier', 9),
(136, 3, 'Border Terrier', 10),
(137, 3, 'Fox Terrier (Smooth)', 12),
(138, 3, 'Fox Terrier (Wire)', 169),
(139, 3, 'Lakeland Terrier', 70),
(140, 3, 'Manchester Terrier', 71),
(141, 3, 'Parson Russell Terrier', 339),
(142, 3, 'Welsh Terrier', 78),
(143, 3, 'Irish Glen of Imaal Terrier', 302),
(144, 3, 'Irish Terrier', 139),
(145, 3, 'Kerry Blue Terrier', 3),
(146, 3, 'Irish Soft Coated Wheaten Terrier', 40),
(147, 3, 'Australian Terrier', 8),
(148, 3, 'Jack Russell Terrier ', 345),
(149, 3, 'Cairn Terrier', 4),
(150, 3, 'Dandie Dinmont Terrier', 168),
(151, 3, 'Norfolk Terrier', 272),
(152, 3, 'Norwich Terrier', 72),
(153, 3, 'Scottish Terrier', 73),
(154, 3, 'Sealyham Terrier', 74),
(155, 3, 'Skye Terrier', 75),
(156, 3, 'West Highland White Terrier', 85),
(157, 3, 'Nihon Teria', 259),
(158, 3, 'Český Teriér', 246),
(159, 3, 'Bull Terrier', 11),
(160, 3, 'Miniature Bull Terrier', 359),
(161, 3, 'Staffordshire Bull Terrier', 76),
(162, 3, 'American Staffordshire Terrier', 286),
(163, 3, 'Australian Silky Terrier', 236),
(164, 3, 'English Toy Terrier (Black and Tan)', 13),
(165, 3, 'Yorkshire Terrier', 86),
(166, 4, 'Dachshund Standard - Smooth-haired', 148),
(167, 4, 'Dachshund Standard - Long-haired', 148),
(168, 4, 'Dachshund Standard - Wire-haired', 148),
(169, 4, 'Dachshund Miniature - Smooth-haired', 148),
(170, 4, 'Dachshund Miniature - Long-haired', 148),
(171, 4, 'Dachshund Miniature - Wire-haired', 148),
(172, 4, 'Dachshund Rabbit - Smooth-haired', 148),
(173, 4, 'Dachshund Rabbit - Long-haired', 148),
(174, 4, 'Dachshund Rabbit - Wire-haired', 148),
(175, 5, 'Grønlandshund', 274),
(176, 5, 'Samoiedskaïa Sabaka', 212),
(177, 5, 'Alaskan Malamute', 243),
(178, 5, 'Siberian Husky', 270),
(179, 5, 'Norsk Elghund Grå', 242),
(180, 5, 'Norsk Elghund Sort', 268),
(181, 5, 'Norsk Lundehund', 265),
(182, 5, 'Russko-Evropeïskaïa Laïka', 304),
(183, 5, 'Vostotchno-Sibirskaïa Laïka', 305),
(184, 5, 'Zapadno-Sibirskaïa Laïka', 306),
(185, 5, 'Jämthund', 42),
(186, 5, 'Norrbottenspets', 276),
(187, 5, 'Karjalankarhukoira', 48),
(188, 5, 'Suomenpystykorva', 49),
(189, 5, 'Islenskur Fjárhundur', 289),
(190, 5, 'Norsk Buhund', 237),
(191, 5, 'Svensk Lapphund', 135),
(192, 5, 'Västgötaspets', 14),
(193, 5, 'Suomenlapinkoira', 189),
(194, 5, 'Lapinporokoira', 284),
(195, 5, 'Deutscher Spitz Wolfsspitz', 97),
(196, 5, 'Deutscher Spitz Grossspitz - White', 97),
(197, 5, 'Deutscher Spitz Grossspitz - Brown or black', 97),
(198, 5, 'Deutscher Spitz Mittelspitz - White', 97),
(199, 5, 'Deutscher Spitz Mittelspitz - Brown or black', 97),
(200, 5, 'Deutscher Spitz Mittelspitz - Orange, grey shaded and other colours', 97),
(201, 5, 'Deutscher Spitz Kleinspitz - White', 97),
(202, 5, 'Deutscher Spitz Kleinspitz - Brown or black', 97),
(203, 5, 'Deutscher Spitz Kleinspitz - Orange, grey shaded and other colours', 97),
(204, 5, 'Deutscher Spitz Zwergspitz - Any colour', 97),
(205, 5, 'Volpino Italiano', 195),
(206, 5, 'Chow Chow', 205),
(207, 5, 'Eurasier', 291),
(208, 5, 'Korea Jindo Dog', 334),
(209, 5, 'Akita', 255),
(210, 5, 'American Akita', 344),
(211, 5, 'Hokkaïdo', 261),
(212, 5, 'Kai', 317),
(213, 5, 'Kishu', 318),
(214, 5, 'Nihon Supittsu', 262),
(215, 5, 'Shiba', 257),
(216, 5, 'Shikoku', 319),
(217, 5, 'Canaan Dog', 273),
(218, 5, 'Pharaoh Hound', 248),
(219, 5, 'Xoloitzcuintle - Standard', 234),
(220, 5, 'Xoloitzcuintle - Intermediate', 234),
(221, 5, 'Xoloitzcuintle - Miniature', 234),
(222, 5, 'Perro sin pelo del Perú - Large', 310),
(223, 5, 'Perro sin pelo del Perú - Medium-sized', 310),
(224, 5, 'Perro sin pelo del Perú - Miniature', 310),
(225, 5, 'Basenji', 43),
(226, 5, 'Podenco Canario', 329),
(227, 5, 'Podenco Ibicenco - Rough haired', 89),
(228, 5, 'Podenco Ibicenco - Smooth-haired', 89),
(229, 5, 'Cirneco dell''Etna', 199),
(230, 5, 'Podengo Português Large - Long and wire haired', 94),
(231, 5, 'Podengo Português Large - Short and smooth haired', 94),
(232, 5, 'Podengo Português Medium sized - Long and wire haired', 94),
(233, 5, 'Podengo Português Medium sized - Short and smooth haired', 94),
(234, 5, 'Podengo Português Small - Long and wire haired', 94),
(235, 5, 'Podengo Português Small - Short and smooth haired', 94),
(236, 5, 'Thai Ridgeback Dog', 338),
(237, 6, 'Chien de Saint-Hubert', 84),
(238, 6, 'Poitevin', 24),
(239, 6, 'Billy', 25),
(240, 6, 'Français tricolore', 219),
(241, 6, 'Français blanc et noir', 220),
(242, 6, 'Français blanc et orange', 316),
(243, 6, 'Grand anglo-français tricolore', 322),
(244, 6, 'Grand anglo-français blanc et noir', 323),
(245, 6, 'Grand anglo-français blanc et orange', 324),
(246, 6, 'Grand Bleu de Gascogne', 22),
(247, 6, 'Gascon saintongeois', 21),
(248, 6, 'Grand griffon vendéen', 282),
(249, 6, 'English Foxhound', 159),
(250, 6, 'Otterhound', 294),
(251, 6, 'American Foxhound', 303),
(252, 6, 'Black and Tan Coonhound', 300),
(253, 6, 'Bosanski Ostrodlaki Gonic Barak', 155),
(254, 6, 'Istarski Kratkodlaki Gonic', 151),
(255, 6, 'Istarski Ostrodlaki Gonic', 152),
(256, 6, 'Posavski Gonic', 154),
(257, 6, 'Sabueso Español', 204),
(258, 6, 'Anglo-français de petite vénerie', 325),
(259, 6, 'Ariégeois', 20),
(260, 6, 'Beagle-Harrier', 290),
(261, 6, 'Chien d''Artois', 28),
(262, 6, 'Porcelaine', 30),
(263, 6, 'Petit bleu de Gascogne', 31),
(264, 6, 'Gascon saintongeois', 21),
(265, 6, 'Briquet griffon vendéen', 19),
(266, 6, 'Griffon bleu de Gascogne', 32),
(267, 6, 'Griffon fauve de Bretagne', 66),
(268, 6, 'Griffon Nivernais', 17),
(269, 6, 'Harrier', 295),
(270, 6, 'Hellinikos Ichnilatis', 214),
(271, 6, 'Segugio Italiano - Short-haired', 337),
(272, 6, 'Segugio Italiano - Rough-haired', 198),
(273, 6, 'Srpski Trobojni Gonic', 229),
(274, 6, 'Srpski Gonic', 150),
(275, 6, 'Crnogorski Planinski Gonic', 279),
(276, 6, 'Erdélyi Kopó', 241),
(277, 6, 'Dunker', 203),
(278, 6, 'Haldenstøvare', 267),
(279, 6, 'Hygenhund', 266),
(280, 6, 'Brandlbracke', 63),
(281, 6, 'Steirische Rauhhaarbracke', 62),
(282, 6, 'Tiroler Bracke', 68),
(283, 6, 'Ogar Polski', 52),
(284, 6, 'Schweizer Laufhund - Bernese Hound', 59),
(285, 6, 'Schweizer Laufhund - Jura Hound', 59),
(286, 6, 'Schweizer Laufhund - Lucerne Hound', 59),
(287, 6, 'Schweizer Laufhund - Schwyz Hound', 59),
(288, 6, 'Slovenský Kopov', 244),
(289, 6, 'Suomenajokoira', 51),
(290, 6, 'Hamiltonstövare', 132),
(291, 6, 'Schillerstövare', 131),
(292, 6, 'Smålandsstövare', 129),
(293, 6, 'Deutsche Bracke', 299),
(294, 6, 'Westfälische Dachsbracke', 100),
(295, 6, 'Basset artésien normand', 34),
(296, 6, 'Basset bleu de Gascogne', 35),
(297, 6, 'Basset fauve de Bretagne', 36),
(298, 6, 'Grand Basset griffon vendéen', 33),
(299, 6, 'Petit Basset griffon vendéen', 67),
(300, 6, 'Basset Hound', 163),
(301, 6, 'Beagle', 161),
(302, 6, 'Schweizerischer Niederlaufhund - Small Bernese Hound smooth haired', 60),
(303, 6, 'Schweizerischer Niederlaufhund - Small Bernese Hound coarse haired', 60),
(304, 6, 'Schweizerischer Niederlaufhund - Small Jura Hound', 60),
(305, 6, 'Schweizerischer Niederlaufhund - Small Lucerne Hound', 60),
(306, 6, 'Schweizerischer Niederlaufhund - Small Schwyz Hound', 60),
(307, 6, 'Drever', 130),
(308, 6, 'Bayrischer Gebirgsschweisshund', 217),
(309, 6, 'Hannover''scher Schweisshund', 213),
(310, 6, 'Alpenländische Dachsbracke', 254),
(311, 6, 'Dalmatinski pas', 153),
(312, 6, 'Rhodesian Ridgeback', 146),
(313, 7, 'Gammel Dansk Hønsehund', 281),
(314, 7, 'Deutsch Kurzhaar', 119),
(315, 7, 'Deutsch Drahthaar', 98),
(316, 7, 'Pudelpointer', 216),
(317, 7, 'Deutsch Stichelhaar', 232),
(318, 7, 'Weimaraner - Short-haired', 99),
(319, 7, 'Weimaraner - Long-haired', 99),
(320, 7, 'Perdiguero de Burgos', 90),
(321, 7, 'Braque de l''Ariège', 177),
(322, 7, 'Braque d''Auvergne', 180),
(323, 7, 'Braque du Bourbonnais', 179),
(324, 7, 'Braque français - type Gascogne', 133),
(325, 7, 'Braque français - type Pyrénées', 134),
(326, 7, 'Bracco Italiano - White-orange', 202),
(327, 7, 'Bracco Italiano - Chestnut roan', 202),
(328, 7, 'Drötzörü Magyar Vizsla', 239),
(329, 7, 'Rövidszörü Magyar Vizsla', 57),
(330, 7, 'Perdigueiro Português', 187),
(331, 7, 'Slovenský Hrubosrstý Stavač', 320),
(332, 7, 'Kleiner Münsterländer', 102),
(333, 7, 'Grosser Münsterländer Vorstehhund', 118),
(334, 7, 'Deutsch Langhaar', 117),
(335, 7, 'Epagneul bleu de Picardie', 106),
(336, 7, 'Epagneul Breton - White and orange', 95),
(337, 7, 'Epagneul Breton - Other colours', 95),
(338, 7, 'Epagneul français', 175),
(339, 7, 'Epagneul picard', 108),
(340, 7, 'Epagneul de Pont-Audemer', 114),
(341, 7, 'Drentsche Patrijshond', 224),
(342, 7, 'Stabyhoun', 222),
(343, 7, 'Griffon d''arrêt à poil dur Korthals', 107),
(344, 7, 'Spinone Italiano - White-orange', 165),
(345, 7, 'Spinone Italiano - Chestnut roan', 165),
(346, 7, 'Český Fousek', 245),
(347, 7, 'English Pointer', 1),
(348, 7, 'English Setter', 2),
(349, 7, 'Gordon Setter', 6),
(350, 7, 'Irish Red Setter', 120),
(351, 7, 'Irish Red and White Setter', 330),
(352, 8, 'Nova Scotia Duck Tolling Retriever', 312),
(353, 8, 'Curly Coated Retriever', 110),
(354, 8, 'Flat Coated Retriever', 121),
(355, 8, 'Labrador Retriever', 122),
(356, 8, 'Golden Retriever', 111),
(357, 8, 'Chesapeake Bay Retriever', 263),
(358, 8, 'Deutscher Wachtelhund', 104),
(359, 8, 'Clumber Spaniel', 109),
(360, 8, 'English Cocker Spaniel - Red', 5),
(361, 8, 'English Cocker Spaniel - Black', 5),
(362, 8, 'English Cocker Spaniel - Other colours', 5),
(363, 8, 'Field Spaniel', 123),
(364, 8, 'Sussex Spaniel', 127),
(365, 8, 'English Springer Spaniel', 125),
(366, 8, 'Welsh Springer Spaniel', 126),
(367, 8, 'Nederlandse Kooikerhondje', 314),
(368, 8, 'American Cocker Spaniel - Black', 167),
(369, 8, 'American Cocker Spaniel - Any solid colour other than black', 167),
(370, 8, 'American Cocker Spaniel - Particolor', 167),
(371, 8, 'Perro de agua español', 336),
(372, 8, 'Barbet', 105),
(373, 8, 'Irish Water Spaniel', 124),
(374, 8, 'Lagotto Romagnolo', 298),
(375, 8, 'Wetterhoun', 221),
(376, 8, 'Cão de agua Português - Curly', 37),
(377, 8, 'Cão de agua Português - Long and wavy', 37),
(378, 8, 'American Water Spaniel', 301),
(379, 9, 'Maltese', 65),
(380, 9, 'Bichon Havanais', 250),
(381, 9, 'Bichon à poil frisé ', 215),
(382, 9, 'Bolognese', 196),
(383, 9, 'Coton de Tuléar', 283),
(384, 9, 'Petit chien lion', 233),
(385, 9, 'Caniche Standard - White', 172),
(386, 9, 'Caniche Standard - Black', 172),
(387, 9, 'Caniche Standard - Brown', 172),
(388, 9, 'Caniche Standard - Grey', 172),
(389, 9, 'Caniche Standard - Orange fawn (Apricot)', 172),
(390, 9, 'Caniche Standard - Red fawn', 172),
(391, 9, 'Caniche Medium - White', 172),
(392, 9, 'Caniche Medium - Black', 172),
(393, 9, 'Caniche Medium - Brown', 172),
(394, 9, 'Caniche Medium - Grey', 172),
(395, 9, 'Caniche Medium - Orange fawn (Apricot)', 172),
(396, 9, 'Caniche Medium - Red fawn', 172),
(397, 9, 'Caniche Miniature - White', 172),
(398, 9, 'Caniche Miniature - Black', 172),
(399, 9, 'Caniche Miniature - Brown', 172),
(400, 9, 'Caniche Miniature - Grey', 172),
(401, 9, 'Caniche Miniature - Orange fawn (Apricot)', 172),
(402, 9, 'Caniche Miniature - Red fawn', 172),
(403, 9, 'Caniche Toy - White', 172),
(404, 9, 'Caniche Toy - Black', 172),
(405, 9, 'Caniche Toy - Brown', 172),
(406, 9, 'Caniche Toy - Grey', 172),
(407, 9, 'Caniche Toy - Orange fawn (Apricot)', 172),
(408, 9, 'Caniche Toy - Red fawn', 172),
(409, 9, 'Griffon belge', 81),
(410, 9, 'Griffon bruxellois', 80),
(411, 9, 'Petit Brabançon', 82),
(412, 9, 'Chinese Crested Dog - Hairless', 288),
(413, 9, 'Chinese Crested Dog - Powder Puff with veil coat', 288),
(414, 9, 'Lhasa Apso', 227),
(415, 9, 'Shih Tzu', 208),
(416, 9, 'Tibetan Spaniel', 231),
(417, 9, 'Tibetan Terrier', 209),
(418, 9, 'Chihuahua - Smooth-haired', 218),
(419, 9, 'Chihuahua - Long-haired', 218),
(420, 9, 'Cavalier King Charles Spaniel - Black and Tan', 136),
(421, 9, 'Cavalier King Charles Spaniel - Ruby', 136),
(422, 9, 'Cavalier King Charles Spaniel - Blenheim', 136),
(423, 9, 'Cavalier King Charles Spaniel - Tricolour', 136),
(424, 9, 'King Charles Spaniel - Black and Tan', 128),
(425, 9, 'King Charles Spaniel - Ruby', 128),
(426, 9, 'King Charles Spaniel - Blenheim', 128),
(427, 9, 'King Charles Spaniel - Prince Charles', 128),
(428, 9, 'Pekingese', 207),
(429, 9, 'Chin', 206),
(430, 9, 'Epagneul nain Continental - Papillon', 77),
(431, 9, 'Epagneul nain Continental - Phalène', 77),
(432, 9, 'Kromfohrländer', 192),
(433, 9, 'Bouledogue français - with limited white patching', 101),
(434, 9, 'Bouledogue français - with medium or predominant white patching', 101),
(435, 9, 'Pug - Fawn with black mask', 253),
(436, 9, 'Pug - Black', 253),
(437, 9, 'Pug - Silver', 253),
(438, 9, 'Pug - Apricot with black mask', 253),
(439, 9, 'Boston Terrier', 140),
(440, 10, 'Afghan Hound', 228),
(441, 10, 'Saluki - Fringed', 269),
(442, 10, 'Saluki - Short-haired', 269),
(443, 10, 'Russkaya Psovaya Borzaya', 193),
(444, 10, 'Irish Wolfhound', 160),
(445, 10, 'Deerhound', 164),
(446, 10, 'Galgo español', 285),
(447, 10, 'Greyhound', 158),
(448, 10, 'Whippet', 162),
(449, 10, 'Piccolo Levriero Italiano', 200),
(450, 10, 'Magyar Agar ', 240),
(451, 10, 'Azawakh', 307),
(452, 10, 'Sloughi', 188),
(453, 10, 'Chart Polski', 333),
(454, 2, 'Český horský pes', NULL),
(455, 0, 'Moskovskaja storoževaja sobaka', NULL),
(456, 9, 'Russkiy Toy', 352),
(457, NULL, 'Biewer yorkshire terrier', NULL),
(458, NULL, 'Louisiana Catahoula Leopard Dog ', NULL),
(459, NULL, 'Český strakatý pes', NULL),
(460, 2, 'Tornjak', 355),
(461, NULL, 'Pražský krysařík', NULL),
(462, NULL, 'Chodský pes', NULL),
(463, 2, 'Alano español', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timeline_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `comment` mediumtext NOT NULL,
  `comment_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs`
--

DROP TABLE IF EXISTS `tbl_dogs`;
CREATE TABLE IF NOT EXISTS `tbl_dogs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `dog_gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `offer_for_mating` int(11) DEFAULT NULL,
  `breed_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dog_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dog_image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dog_registration_number` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_die` date DEFAULT NULL,
  `height` decimal(20,4) DEFAULT NULL,
  `weight` decimal(20,4) DEFAULT NULL,
  `country` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dog_father` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dog_mother` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=500000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_championship`
--

DROP TABLE IF EXISTS `tbl_dogs_championship`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_championship` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_coowners`
--

DROP TABLE IF EXISTS `tbl_dogs_coowners`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_coowners` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` int(11) NOT NULL,
  `coowner_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coowner_state` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_health`
--

DROP TABLE IF EXISTS `tbl_dogs_health`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_health` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_matings`
--

DROP TABLE IF EXISTS `tbl_dogs_matings`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_matings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_shows`
--

DROP TABLE IF EXISTS `tbl_dogs_shows`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_shows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) DEFAULT NULL,
  `date_of_show` date DEFAULT NULL,
  `type_of_show` varchar(250) DEFAULT NULL,
  `name_of_show` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `name_of_judge` varchar(250) DEFAULT NULL,
  `name_of_handler` varchar(250) DEFAULT NULL,
  `class_of_show` varchar(250) DEFAULT NULL,
  `assesment` varchar(250) DEFAULT NULL,
  `titles` mediumtext,
  `other_titles` mediumtext,
  `image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_workexams`
--

DROP TABLE IF EXISTS `tbl_dogs_workexams`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_workexams` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fci_groups`
--

DROP TABLE IF EXISTS `tbl_fci_groups`;
CREATE TABLE IF NOT EXISTS `tbl_fci_groups` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FCIName` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_fci_groups`
--

INSERT INTO `tbl_fci_groups` (`ID`, `FCIName`) VALUES
(1, 'I.   Sheepdogs and Cattle Dogs'),
(2, 'II.  Pinschers and Schnauzers, Molossoids and Swiss Mountain Dogs'),
(3, 'III. Terriers'),
(4, 'IV.  Dachshunds'),
(5, 'V.   Spitz and Primitive Types'),
(6, 'VI.  Scenthounds'),
(7, 'VII. Pointers and Setters'),
(8, 'VIII.Retrievers, Flushing Dogs and Water Dogs'),
(9, 'IX.  Companion and Toy Dogs'),
(10, 'X.   Sighthounds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handlers_awards`
--

DROP TABLE IF EXISTS `tbl_handlers_awards`;
CREATE TABLE IF NOT EXISTS `tbl_handlers_awards` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handler_breed`
--

DROP TABLE IF EXISTS `tbl_handler_breed`;
CREATE TABLE IF NOT EXISTS `tbl_handler_breed` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kennel_id` bigint(20) NOT NULL,
  `breed_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handler_certificates`
--

DROP TABLE IF EXISTS `tbl_handler_certificates`;
CREATE TABLE IF NOT EXISTS `tbl_handler_certificates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_likes`
--

DROP TABLE IF EXISTS `tbl_likes`;
CREATE TABLE IF NOT EXISTS `tbl_likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timeline_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `like_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `timeline_id` (`timeline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `from_profile_id` bigint(20) DEFAULT NULL,
  `to_profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `unreaded` int(11) DEFAULT NULL,
  `active_from` int(11) DEFAULT NULL,
  `active_to` int(11) DEFAULT NULL,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notify`
--

DROP TABLE IF EXISTS `tbl_notify`;
CREATE TABLE IF NOT EXISTS `tbl_notify` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `notify_user_id` bigint(20) DEFAULT NULL,
  `notify_profile_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `timeline_id` bigint(20) DEFAULT NULL,
  `comment` mediumtext,
  `type` varchar(250) DEFAULT NULL,
  `notify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unreaded` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_notify`
--

INSERT INTO `tbl_notify` (`id`, `notify_user_id`, `notify_profile_id`, `user_id`, `profile_id`, `timeline_id`, `comment`, `type`, `notify_datetime`, `unreaded`) VALUES
(1, 100000000, 200000000, 100000000, 200000000, 2, 'lololo', 'comment', '2015-08-29 21:15:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pedigree`
--

DROP TABLE IF EXISTS `tbl_pedigree`;
CREATE TABLE IF NOT EXISTS `tbl_pedigree` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_name` varchar(250) NOT NULL,
  `father_name` varchar(250) NOT NULL,
  `mother_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dog_name` (`dog_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_planned_litters`
--

DROP TABLE IF EXISTS `tbl_planned_litters`;
CREATE TABLE IF NOT EXISTS `tbl_planned_litters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kennel_id` bigint(20) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` bigint(20) DEFAULT NULL,
  `dog_name` varchar(250) DEFAULT NULL,
  `dog_image` varchar(250) DEFAULT NULL,
  `bitch_name` varchar(250) DEFAULT NULL,
  `bitch_image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=700000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_puppies`
--

DROP TABLE IF EXISTS `tbl_puppies`;
CREATE TABLE IF NOT EXISTS `tbl_puppies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `planned_litter_id` bigint(20) NOT NULL,
  `puppy_gender` varchar(10) NOT NULL,
  `puppy_name` varchar(250) NOT NULL,
  `puppy_photo` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `country` varchar(250) NOT NULL,
  `puppy_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=600000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeline`
--

DROP TABLE IF EXISTS `tbl_timeline`;
CREATE TABLE IF NOT EXISTS `tbl_timeline` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_translate`
--

DROP TABLE IF EXISTS `tbl_translate`;
CREATE TABLE IF NOT EXISTS `tbl_translate` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `text_to_translate` mediumtext COLLATE utf8_unicode_ci,
  `translated_text` mediumtext COLLATE utf8_unicode_ci,
  `lang` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8_unicode_ci,
  `uri` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_uri` (`text_to_translate`(300))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=519 ;

--
-- Dumping data for table `tbl_translate`
--

INSERT INTO `tbl_translate` (`id`, `text_to_translate`, `translated_text`, `lang`, `url`, `uri`) VALUES
(1, 'Registration', 'Registration', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(2, 'About DOGFORSHOW', 'About DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(3, 'Contact', 'Contact', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(4, 'We support breeding of happy and healthy dogs with pedigree', 'We support breeding of happy and healthy dogs with pedigree', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(5, 'Login', 'Login', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(6, 'Afghanistan', 'Afghanistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(7, 'Albania', 'Albania', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(8, 'Algeria', 'Algeria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(9, 'Andorra', 'Andorra', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(10, 'Argentina', 'Argentina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(11, 'Armenia', 'Armenia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(12, 'Australia', 'Australia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(13, 'Austria', 'Austria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(14, 'Azerbaidjan', 'Azerbaidjan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(15, 'Bahrain', 'Bahrain', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(16, 'Bangladesh', 'Bangladesh', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(17, 'Belarus', 'Belarus', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(18, 'Belgium', 'Belgium', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(19, 'Bolivia', 'Bolivia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(20, 'Bosnia-Herzegovina', 'Bosnia-Herzegovina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(21, 'Brazil', 'Brazil', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(22, 'Bulgaria', 'Bulgaria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(23, 'Canada', 'Canada', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(24, 'Colombia', 'Colombia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(25, 'Costa Rica', 'Costa Rica', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(26, 'Croatia', 'Croatia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(27, 'Cuba', 'Cuba', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(28, 'Cyprus', 'Cyprus', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(29, 'Czech Republic', 'Czech Republic', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(30, 'Denmark', 'Denmark', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(31, 'Dominican Republic', 'Dominican Republic', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(32, 'Ecuador', 'Ecuador', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(33, 'Egypt', 'Egypt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(34, 'El Salvador', 'El Salvador', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(35, 'Estonia', 'Estonia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(36, 'Ethiopia', 'Ethiopia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(37, 'Faroe Islands', 'Faroe Islands', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(38, 'Finland', 'Finland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(39, 'France', 'France', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(40, 'Georgia', 'Georgia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(41, 'Germany', 'Germany', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(42, 'Ghana', 'Ghana', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(43, 'Gibraltar', 'Gibraltar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(44, 'Great Britain', 'Great Britain', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(45, 'Greece', 'Greece', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(46, 'Guatemala', 'Guatemala', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(47, 'Honduras', 'Honduras', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(48, 'Hungary', 'Hungary', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(49, 'Chad', 'Chad', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(50, 'Chile', 'Chile', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(51, 'China', 'China', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(52, 'Iceland', 'Iceland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(53, 'India', 'India', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(54, 'Indonesia', 'Indonesia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(55, 'Iran', 'Iran', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(56, 'Iraq', 'Iraq', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(57, 'Ireland', 'Ireland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(58, 'Israel', 'Israel', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(59, 'Italy', 'Italy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(60, 'Japan', 'Japan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(61, 'Jordan', 'Jordan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(62, 'Kazakhstan', 'Kazakhstan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(63, 'Kenya', 'Kenya', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(64, 'Kuwait', 'Kuwait', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(65, 'Latvia', 'Latvia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(66, 'Lebanon', 'Lebanon', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(67, 'Libya', 'Libya', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(68, 'Liechtenstein', 'Liechtenstein', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(69, 'Lithuania', 'Lithuania', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(70, 'Luxembourg', 'Luxembourg', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(71, 'Macedonia', 'Macedonia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(72, 'Madagascar', 'Madagascar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(73, 'Malaysia', 'Malaysia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(74, 'Malta', 'Malta', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(75, 'Marshall Islands', 'Marshall Islands', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(76, 'Mexico', 'Mexico', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(77, 'Moldova', 'Moldova', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(78, 'Monaco', 'Monaco', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(79, 'Morocco', 'Morocco', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(80, 'Nepal', 'Nepal', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(81, 'Netherlands', 'Netherlands', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(82, 'New Zealand', 'New Zealand', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(83, 'Nicaragua', 'Nicaragua', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(84, 'Nigeria', 'Nigeria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(85, 'Norway', 'Norway', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(86, 'Oman', 'Oman', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(87, 'Pakistan', 'Pakistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(88, 'Panama', 'Panama', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(89, 'Paraguay', 'Paraguay', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(90, 'Peru', 'Peru', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(91, 'Philippines', 'Philippines', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(92, 'Poland', 'Poland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(93, 'Portugal', 'Portugal', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(94, 'Puerto Rico', 'Puerto Rico', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(95, 'Qatar', 'Qatar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(96, 'Republic of Kore', 'Republic of Kore', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(97, 'Republic of Montenegro', 'Republic of Montenegro', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(98, 'Romania', 'Romania', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(99, 'Russia', 'Russia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(100, 'San Marino', 'San Marino', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(101, 'Saudi Arabia', 'Saudi Arabia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(102, 'Serbia', 'Serbia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(103, 'Seychelles', 'Seychelles', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(104, 'Singapore', 'Singapore', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(105, 'Slovakia', 'Slovakia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(106, 'Slovenia', 'Slovenia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(107, 'South Africa', 'South Africa', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(108, 'Spain', 'Spain', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(109, 'Sri Lanka', 'Sri Lanka', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(110, 'Sweden', 'Sweden', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(111, 'Switzerland', 'Switzerland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(112, 'Syria', 'Syria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(113, 'Taiwan', 'Taiwan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(114, 'Thailand', 'Thailand', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(115, 'Tunisia', 'Tunisia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(116, 'Turkey', 'Turkey', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(117, 'Uganda', 'Uganda', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(118, 'Ukraine', 'Ukraine', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(119, 'United Arab Emirates', 'United Arab Emirates', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(120, 'Uruguay', 'Uruguay', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(121, 'USA', 'USA', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(122, 'Uzbekistan', 'Uzbekistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(123, 'Venezuela', 'Venezuela', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(124, 'Vietnam', 'Vietnam', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(125, 'Name', 'Name', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(126, 'Surname', 'Surname', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(127, 'Email', 'Email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(128, 'Password', 'Password', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(129, 'Confirm password', 'Confirm password', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(130, 'Register', 'Register', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(131, 'Forgot your password', 'Forgot your password', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(132, 'Your email', 'Your email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(133, 'Send', 'Send', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(134, 'Remember me', 'Remember me', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(135, 'Forgot password', 'Forgot password', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(136, 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(137, 'Kennels', 'Kennels', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(138, 'Owners', 'Owners', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(139, 'Handlers', 'Handlers', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(140, 'Dogs with pedigree', 'Dogs with pedigree', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(141, 'Puppies for sale', 'Puppies for sale', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(142, 'Planned litters', 'Planned litters', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(143, 'Stud dogs', 'Stud dogs', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(144, 'Best in show', 'Best in show', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(145, 'Follow with us how we are growing', 'Follow with us how we are growing', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(146, 'Present internationally on the right place', 'Present internationally on the right place', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(147, 'Possibility to create your own kennel, owners and handlers profile', 'Possibility to create your own kennel, owners and handlers profile', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(148, 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(149, 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(150, 'Inform about planned litters and offer puppies for sale', 'Inform about planned litters and offer puppies for sale', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(151, 'Create friendships and communicate with each other', 'Create friendships and communicate with each other', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(152, 'Take opportunity to be contacted by potential buyers from all over the world', 'Take opportunity to be contacted by potential buyers from all over the world', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(153, 'Contact us', 'Contact us', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(154, 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(155, 'Message', 'Message', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(156, 'Verify', 'Verify', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(157, 'Follow us', 'Follow us', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(158, 'DOGFORSHOW on facebook', 'DOGFORSHOW on facebook', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(159, 'DOGFORSHOW on Google+', 'DOGFORSHOW on Google+', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(160, 'DOGFORSHOW on Twitter', 'DOGFORSHOW on Twitter', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(161, 'DOGFORSHOW on Pinterest', 'DOGFORSHOW on Pinterest', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(162, 'DOGFORSHOW on Tumblr', 'DOGFORSHOW on Tumblr', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(163, 'Friend requests', 'Friend requests', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(164, 'send you a friend request', 'send you a friend request', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(165, 'View all', 'View all', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(166, 'Messages', 'Messages', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(167, 'Notifications', 'Notifications', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(168, 'comment your post', 'comment your post', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(169, 'like your post', 'like your post', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(170, 'User account', 'User account', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(171, 'Account settings', 'Account settings', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(172, 'Delete account', 'Delete account', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(173, 'Logout', 'Logout', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(174, 'Kennel', 'Kennel', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(175, 'Profile settings', 'Profile settings', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(176, 'Switch profile', 'Switch profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(177, 'Edit profile', 'Edit profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(178, 'Delete profile', 'Delete profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(179, 'My Profile', 'My Profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(180, 'Home', 'Home', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(181, 'Awards', 'Awards', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(182, 'Dogs', 'Dogs', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(183, 'Photos', 'Photos', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(184, 'Videos', 'Videos', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(185, 'Friends', 'Friends', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(186, 'Followers', 'Followers', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(187, 'Breeds for handling', 'Breeds for handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(188, 'Certificates', 'Certificates', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(189, 'Show results', 'Show results', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(190, 'About us', 'About us', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(191, 'Terms & conditions', 'Terms & conditions', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(192, 'Return policy', 'Return policy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(193, 'Lists', 'Lists', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(194, 'Owners of purebred dogs', 'Owners of purebred dogs', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(195, 'Dogs for mating', 'Dogs for mating', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(196, 'Active profile', 'Active profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(197, 'Create a clear profile of your kennel', 'Create a clear profile of your kennel', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(198, 'Create unique profiles of your dogs', 'Create unique profiles of your dogs', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(199, 'Offer your dogs at stud', 'Offer your dogs at stud', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(200, 'Inform about planned litters', 'Inform about planned litters', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(201, 'Offer puppies for sale from planned litters', 'Offer puppies for sale from planned litters', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(202, 'Add awards and titles of your dogs', 'Add awards and titles of your dogs', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(203, 'Add dogshow successes and keep show history of your dog in one place', 'Add dogshow successes and keep show history of your dog in one place', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(204, 'Add working exams and health informations', 'Add working exams and health informations', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(205, 'Add pedigrees', 'Add pedigrees', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(206, 'Add photos of your dogs', 'Add photos of your dogs', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(207, 'Share your succeses on social networks', 'Share your succeses on social networks', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(208, 'Communicate with other members of DOGFORSHOW', 'Communicate with other members of DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(209, 'Owner of purebred dog', 'Owner of purebred dog', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(210, 'Create profile', 'Create profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(211, 'Create a clear owner profile', 'Create a clear owner profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(212, 'Possibility to migrate on kennel profile', 'Possibility to migrate on kennel profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(213, 'Handler', 'Handler', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(214, 'Create a clear handler profile', 'Create a clear handler profile', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(215, 'Add awards and certificates', 'Add awards and certificates', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(216, 'Add your dogshow successes and titles', 'Add your dogshow successes and titles', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(217, 'Add breeds list for handling', 'Add breeds list for handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(218, 'Add photos', 'Add photos', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(219, 'Offer your handling services', 'Offer your handling services', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(220, 'Share successes via social networks', 'Share successes via social networks', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(221, 'Update cover photo', 'Update cover photo', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(222, 'Upload', 'Upload', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(223, 'Take picture', 'Take picture', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(224, 'Save Image', 'Save Image', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(225, 'New Snapshot', 'New Snapshot', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(226, 'Capture', 'Capture', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(227, 'Cancel', 'Cancel', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(228, 'Close', 'Close', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(229, 'Select profile image', 'Select profile image', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(230, 'We have puppies', 'We have puppies', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(231, 'Add friend', 'Add friend', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(232, 'Follow', 'Follow', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(233, 'FCI number', 'FCI number', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(234, 'Breeds bred by our kennel', 'Breeds bred by our kennel', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(235, 'Add', 'Add', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(236, 'There are currently no added records', 'There are currently no added records', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(237, 'Bitches', 'Bitches', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(238, 'Timeline events', 'Timeline events', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(239, 'Write a comment', 'Write a comment', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(240, 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(241, 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(242, 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(243, 'Edit award', 'Edit award', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(244, 'Date of the award', 'Date of the award', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(245, 'Select date when award was obtained', 'Select date when award was obtained', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(246, 'Name of the award', 'Name of the award', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(247, 'Picture', 'Picture', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(248, 'Picture of award in jpeg or jpg format', 'Picture of award in jpeg or jpg format', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(249, 'Select picture', 'Select picture', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(250, 'Edit', 'Edit', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(251, 'Purebred dogs', 'Purebred dogs', 'en', 'http://dfs.fsofts.eu/list-of-dogs', NULL),
(252, 'Share', 'Share', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(253, 'Breed', 'Breed', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(254, 'Gender', 'Gender', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(255, 'Date of birth', 'Date of birth', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(256, 'Pedigree registration number', 'Pedigree registration number', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(257, 'Height at the withers (cm)', 'Height at the withers (cm)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(258, 'Weight (kg)', 'Weight (kg)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(259, 'Country', 'Country', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(260, 'Father', 'Father', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(261, 'Mother', 'Mother', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(262, 'Championships', 'Championships', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(263, 'Working exams', 'Working exams', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(264, 'Health', 'Health', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(265, 'Pedigree', 'Pedigree', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(266, 'Matings', 'Matings', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(267, 'Coowners', 'Coowners', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(268, 'Championchips', 'Championchips', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(269, 'Remove from friends', 'Remove from friends', 'en', 'http://dfs.fsofts.eu/list-of-kennels', NULL),
(270, 'Website', 'Website', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=2', NULL),
(271, 'Delete', 'Delete', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(272, 'Bitch', 'Bitch', 'en', 'http://dfs.fsofts.eu/dog-profile?id=1', NULL),
(273, 'Class', 'Class', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(274, 'Champion', 'Champion', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(275, 'Judge', 'Judge', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(276, 'This feature is unavailable to view on small screens', 'This feature is unavailable to view on small screens', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(277, 'Name of the father', 'Name of the father', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(278, 'Add championchip', 'Add championchip', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(279, 'Date of Championship award', 'Date of Championship award', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(280, 'Select date when the championship was awarded', 'Select date when the championship was awarded', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(281, 'Championship', 'Championship', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(282, 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(283, 'Junior champion of Hungary', 'Junior champion of Hungary', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(284, 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(285, 'Edit championship', 'Edit championship', 'en', 'http://dfs.fsofts.eu/dog-championschip-edit?id=1&dog_id=1', NULL),
(286, 'Edit show result', 'Edit show result', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(287, 'Date of show', 'Date of show', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(288, 'Select the date on which the show was held', 'Select the date on which the show was held', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(289, 'Add show result', 'Add show result', 'en', 'http://dfs.fsofts.eu/dog-show-add?dog_id=1', NULL),
(290, 'Edit working exam', 'Edit working exam', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(291, 'Date exam passed', 'Date exam passed', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(292, 'Enter the date working exam completed', 'Enter the date working exam completed', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(293, 'Type of exam', 'Type of exam', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(294, 'Enter the type of working exam (e.g. IPO 1)', 'Enter the type of working exam (e.g. IPO 1)', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(295, 'For example IPO 1', 'For example IPO 1', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(296, 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(297, 'Add working exam', 'Add working exam', 'en', 'http://dfs.fsofts.eu/dog-workexam-add?dog_id=1', NULL),
(298, 'Add health record', 'Add health record', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(299, 'Date of the health record', 'Date of the health record', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(300, 'Enter the date the health record was issued', 'Enter the date the health record was issued', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(301, 'Description of the health record', 'Description of the health record', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(302, 'Enter a description or type of health record (e.g. HD, ED)', 'Enter a description or type of health record (e.g. HD, ED)', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(303, 'Hip Dysplasia', 'Hip Dysplasia', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(304, 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(305, 'Add mating', 'Add mating', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(306, 'Date of mating', 'Date of mating', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(307, 'Enter the date, when the mating was', 'Enter the date, when the mating was', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(308, 'Name of the bitch', 'Name of the bitch', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(309, 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(310, 'Picture of the bitch', 'Picture of the bitch', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(311, 'Record the bitch picture in jpg or jpeg format. This field is optional', 'Record the bitch picture in jpg or jpeg format. This field is optional', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(312, 'Edit dog profile', 'Edit dog profile', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(313, 'Informations', 'Informations', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(314, 'Pictures', 'Pictures', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(315, 'Basic informations about your dog', 'Basic informations about your dog', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(316, 'Select the dog’s gender', 'Select the dog’s gender', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(317, 'Dog', 'Dog', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(318, 'Offer your dog for mating', 'Offer your dog for mating', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(319, 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(320, 'Yes', 'Yes', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(321, 'Select breed', 'Select breed', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(322, 'Choose a breed from the list.', 'Choose a breed from the list.', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(323, 'Please select', 'Please select', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(324, 'Dog name', 'Dog name', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(325, 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(326, 'Dog name as shown in the pedigree', 'Dog name as shown in the pedigree', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(327, 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(328, 'For example SPKP 2667', 'For example SPKP 2667', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(329, 'Day, month and year of birth of your dog', 'Day, month and year of birth of your dog', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(330, 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(331, 'Height at the withers in centimeters', 'Height at the withers in centimeters', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(332, 'Enter your dog’s weight in kilograms', 'Enter your dog’s weight in kilograms', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(333, 'Weight of dog in kilograms', 'Weight of dog in kilograms', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(334, 'Country in which the dog is currently located', 'Country in which the dog is currently located', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(335, 'Father of the dog', 'Father of the dog', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(336, 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(337, 'Mother of the dog', 'Mother of the dog', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(338, 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(339, 'Dog profile picture', 'Dog profile picture', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(340, 'Upload a profile image of your dog in JPG or PNG format', 'Upload a profile image of your dog in JPG or PNG format', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(341, 'Please select state...', 'Please select state...', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(342, 'Add coowner', 'Add coowner', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(343, 'Name of the coowner', 'Name of the coowner', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(344, 'Name and surname of co-owner', 'Name and surname of co-owner', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(345, 'Please select country, where are the co-owner situated', 'Please select country, where are the co-owner situated', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(346, 'Add award', 'Add award', 'en', 'http://dfs.fsofts.eu/kennel-awards-add', NULL),
(347, 'Password change', 'Password change', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(348, 'Account informations', 'Account informations', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(349, 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(350, 'Your name without numeric signs', 'Your name without numeric signs', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(351, 'Your surname without numeric signs', 'Your surname without numeric signs', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(352, 'Country where you live', 'Country where you live', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(353, 'Additional account informations', 'Additional account informations', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(354, 'Address', 'Address', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(355, 'Your address', 'Your address', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(356, 'Town', 'Town', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(357, 'Town where you live', 'Town where you live', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(358, 'ZIP', 'ZIP', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(359, 'Enter the zip code of the place where you live', 'Enter the zip code of the place where you live', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(360, 'Phone number', 'Phone number', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(361, 'Your phone number', 'Your phone number', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(362, 'Year of birth', 'Year of birth', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(363, 'Your year of birth', 'Your year of birth', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(364, 'Save', 'Save', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(365, 'Old password', 'Old password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(366, 'Type your old password', 'Type your old password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(367, 'New password', 'New password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(368, 'Type your new password', 'Type your new password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(369, 'Confirm new password', 'Confirm new password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(370, 'Confirm your new password', 'Confirm your new password', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(371, 'Basic informations about your kennel', 'Basic informations about your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(372, 'Kennel name', 'Kennel name', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(373, 'Name of your kennel', 'Name of your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(374, 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(375, 'Kennel website', 'Kennel website', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(376, 'Enter the website of your kennel', 'Enter the website of your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(377, 'www.yourwebsite.com', 'www.yourwebsite.com', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(378, 'Kennel description', 'Kennel description', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(379, 'Enter information about your kennel', 'Enter information about your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(380, 'Select the breed bred by your kennel', 'Select the breed bred by your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(381, 'Choose one ore more breeds bred by your kennel', 'Choose one ore more breeds bred by your kennel', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(382, 'Owner of purebred dog profile', 'Owner of purebred dog profile', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(383, 'Basic informations about you', 'Basic informations about you', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(384, 'Your profile picture', 'Your profile picture', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(385, 'Your profile picture in jpeg or jpg format', 'Your profile picture in jpeg or jpg format', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(386, 'Short description about you', 'Short description about you', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(387, 'Enter some informations about yourself', 'Enter some informations about yourself', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(388, 'Short description', 'Short description', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(389, 'Add a dog', 'Add a dog', 'en', 'http://dfs.fsofts.eu/add-dog', NULL),
(390, 'Available for mating', 'Available for mating', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=1&_fid=mbbn', NULL),
(391, 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'en', 'http://localhost/dfs/index.php', NULL),
(392, 'Resend registration email', 'Resend registration email', 'en', 'http://localhost/dfs/index.php', NULL),
(393, 'Welcome to DOGFORSHOW', 'Welcome to DOGFORSHOW', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(394, 'Hello', 'Hello', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(395, 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(396, 'Activate account', 'Activate account', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(397, 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(398, 'Wrong username or password.', 'Wrong username or password.', 'en', 'http://www.dogshow.com/index.php', NULL),
(399, 'Your registration has been successfully completed', 'Your registration has been successfully completed', 'en', 'http://www.dogshow.com/index.php', NULL),
(400, 'Please check your Email for your user acccount activation', 'Please check your Email for your user acccount activation', 'en', 'http://www.dogshow.com/index.php', NULL),
(401, 'If you have not received the Email yet, please also check your SPAM folder', 'If you have not received the Email yet, please also check your SPAM folder', 'en', 'http://www.dogshow.com/index.php', NULL),
(402, 'Kennel profile', 'Kennel profile', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(403, 'Kennel profile picture', 'Kennel profile picture', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(404, 'Profile picture of your kennel in jpeg or jpg format', 'Profile picture of your kennel in jpeg or jpg format', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(405, 'Enter some informations about your kennel', 'Enter some informations about your kennel', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(406, 'Owner', 'Owner', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(407, 'About me', 'About me', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(408, 'Name of the kennel', 'Name of the kennel', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(409, 'Name of the planned litter', 'Name of the planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(410, 'Planned litter', 'Planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(411, 'Scheduled date of birth of the puppies', 'Scheduled date of birth of the puppies', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(412, 'Add puppies', 'Add puppies', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(413, 'View detail', 'View detail', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(414, 'Puppies', 'Puppies', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(415, 'Edit awards', 'Edit awards', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(416, 'Remove from timeline', 'Remove from timeline', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(417, 'Like', 'Like', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(418, 'Profile updated', 'Profile updated', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000&_fid=9dff', NULL),
(419, 'Add awards', 'Add awards', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000', NULL),
(420, 'Add show', 'Add show', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(421, 'Add result', 'Add result', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(422, 'Delete messages', 'Delete messages', 'en', 'http://www.dogshow.com/message-list', NULL),
(423, 'Type your message', 'Type your message', 'en', 'http://www.dogshow.com/message-compose', NULL),
(424, 'Breed list does not contain entered breed', 'Breed list does not contain entered breed', 'en', 'http://www.dogshow.com/kennel-edit-profile', NULL),
(425, 'Respected breeder, judge, writer', 'Respected breeder, judge, writer', 'en', 'http://www.dogshow.com/index.php', NULL),
(426, 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'en', 'http://www.dogshow.com/index.php', NULL),
(427, 'Unlike', 'Unlike', 'en', 'http://www.dogshow.com/timeline', NULL),
(428, 'For sale', 'For sale', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(429, 'Reserved', 'Reserved', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(430, 'Sold', 'Sold', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(431, 'Search', 'Search', 'en', 'http://www.dogshow.com/list-of-owners', NULL),
(432, 'Edit a dog', 'Edit a dog', 'en', 'http://www.dogshow.com/dog-profile-edit?id=500000000&dog_id=500000000', NULL),
(433, 'Show type', 'Show type', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(434, 'Select type of exhibition', 'Select type of exhibition', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(435, 'Name of the show', 'Name of the show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(436, 'Enter the name of show (e.g. World dog show Budapest)', 'Enter the name of show (e.g. World dog show Budapest)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(437, 'Enter the show name', 'Enter the show name', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(438, 'Select country in which show was held', 'Select country in which show was held', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(439, 'Name of judge', 'Name of judge', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(440, 'Enter the judge’s name', 'Enter the judge’s name', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(441, 'Name of handler', 'Name of handler', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL);
INSERT INTO `tbl_translate` (`id`, `text_to_translate`, `translated_text`, `lang`, `url`, `uri`) VALUES
(442, 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(443, 'Enter the handler’s name', 'Enter the handler’s name', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(444, 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(445, 'Assesment', 'Assesment', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(446, 'Best minor puppy', 'Best minor puppy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(447, 'Best puppy male & female', 'Best puppy male & female', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(448, 'Titles', 'Titles', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(449, 'Junior Best of Group', 'Junior Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(450, 'Junior Best in Show', 'Junior Best in Show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(451, 'Best of Group', 'Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(452, 'Other titles and awards received at the show', 'Other titles and awards received at the show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(453, 'Enter other titles achieved at this show', 'Enter other titles achieved at this show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(454, 'e.g. National Winner', 'e.g. National Winner', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(455, 'Image from show', 'Image from show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(456, 'Record the picture from show in jpg or jpeg format. This field is optional', 'Record the picture from show in jpg or jpeg format. This field is optional', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(457, 'Add planned litter', 'Add planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(458, 'Name of the litter or litter ranking', 'Name of the litter or litter ranking', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(459, 'Enter the name of the litter or enter the letter of planned litter', 'Enter the name of the litter or enter the letter of planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(460, 'Enter indicative month of birth of puppies as information for prospective buyers', 'Enter indicative month of birth of puppies as information for prospective buyers', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(461, 'Enter dog’s name', 'Enter dog’s name', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(462, 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(463, 'Picture of the dog', 'Picture of the dog', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(464, 'Upload or change profile picture of the dog in jpg or jpeg format', 'Upload or change profile picture of the dog in jpg or jpeg format', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(465, 'Please select the name of the bitch', 'Please select the name of the bitch', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(466, 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(467, 'Upload or change profile picture of the bitch in jpg or jpeg format', 'Upload or change profile picture of the bitch in jpg or jpeg format', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(468, 'Name of planned litter can''t be empty', 'Name of planned litter can''t be empty', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(469, 'Dog name can''t be empty', 'Dog name can''t be empty', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(470, 'Dog image can''t be empty', 'Dog image can''t be empty', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(471, 'Bitch name can''t be empty', 'Bitch name can''t be empty', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(472, 'Bitch image can''t be empty', 'Bitch image can''t be empty', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(473, 'Please select state', 'Please select state', 'en', 'http://www.dogshow.com/index.php', NULL),
(474, 'Name and Surname cannot left blank', 'Name and Surname cannot left blank', 'en', 'http://www.dogshow.com/index.php', NULL),
(475, 'Password and confirm password does not match', 'Password and confirm password does not match', 'en', 'http://www.dogshow.com/index.php', NULL),
(476, 'Fields Name and Surname cannot contains digits', 'Fields Name and Surname cannot contains digits', 'en', 'http://www.dogshow.com/index.php', NULL),
(477, 'Email cannot left blank', 'Email cannot left blank', 'en', 'http://www.dogshow.com/index.php', NULL),
(478, 'Profile created', 'Profile created', 'en', 'http://www.dogshow.com/kennel-profile?id=1&_fid=hpgn', NULL),
(479, 'Select or enter the name of the dog', 'Select or enter the name of the dog', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(480, 'Name of the dog', 'Name of the dog', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(481, 'Name of the mother', 'Name of the mother', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(482, 'No', 'No', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(483, 'Are you sure you want to delete this dog?', 'Are you sure you want to delete this dog?', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(484, 'Question', 'Question', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(485, 'Are you sure you want to delete this profile?', 'Are you sure you want to delete this profile?', 'en', 'http://www.dogshow.com/dog-profile?id=2', NULL),
(486, 'Are you sure you want to delete this record?', 'Are you sure you want to delete this record?', 'en', 'http://www.dogshow.com/dog-profile?id=5&dog_id=5&_fid=yvc6', NULL),
(487, 'By clicking Register, you agree to our', 'By clicking Register, you agree to our', 'en', 'http://www.dogshow.com/index.php', NULL),
(488, 'General terms', 'General terms', 'en', 'http://www.dogshow.com/index.php', NULL),
(489, 'and you have read our', 'and you have read our', 'en', 'http://www.dogshow.com/index.php', NULL),
(490, 'Cookie policy', 'Cookie policy', 'en', 'http://www.dogshow.com/index.php', NULL),
(491, 'Father of the planned litter', 'Father of the planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(492, 'Mother of the planned litter', 'Mother of the planned litter', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(493, 'Please select planned litter...', 'Please select planned litter...', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(494, 'Add a puppy', 'Add a puppy', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(495, 'Basic informations about puppy', 'Basic informations about puppy', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(496, 'Select your planned litter', 'Select your planned litter', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(497, 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(498, 'Select the puppy’s gender', 'Select the puppy’s gender', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(499, 'Puppy''s name', 'Puppy''s name', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(500, 'Enter the puppy’s name', 'Enter the puppy’s name', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(501, 'Picture of puppy', 'Picture of puppy', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(502, 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(503, 'Day, month and year of puppy’s birth', 'Day, month and year of puppy’s birth', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(504, 'Country in which the puppy is currently located', 'Country in which the puppy is currently located', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(505, 'Share on Facebook', 'Share on Facebook', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(506, 'Share on Google+', 'Share on Google+', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(507, 'Share on Twitter', 'Share on Twitter', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(508, 'Share on Pinterest', 'Share on Pinterest', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(509, 'Share on Tumblr', 'Share on Tumblr', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(510, 'Post to a friend', 'Post to a friend', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(511, 'I am interested', 'I am interested', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(512, 'Description', 'Description', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(513, 'Edit puppy profile', 'Edit puppy profile', 'en', 'http://www.dogshow.com/puppy-edit-profile', NULL),
(514, 'Peoples who liked this', 'Peoples who liked this', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(515, 'Required field', 'Required field', 'en', 'http://www.dogshow.com/index.php', NULL),
(516, 'User with this e-mail, is not in our database', 'User with this e-mail, is not in our database', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(517, 'Login to your account', 'Login to your account', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(518, 'Your password has been successfully sent to your e-mail', 'Your password has been successfully sent to your e-mail', 'en', 'http://172.16.46.5/dfs/index.php', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `state` varchar(150) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `year_of_birth` int(11) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `active_profile_id` bigint(20) NOT NULL DEFAULT '0',
  `active_profile_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000000 ;

--
-- Triggers `tbl_user`
--
DROP TRIGGER IF EXISTS `tbl_user_AFTER_INSERT`;
DELIMITER //
CREATE TRIGGER `tbl_user_AFTER_INSERT` AFTER INSERT ON `tbl_user`
 FOR EACH ROW INSERT INTO tbl_usergroup(user_id,group_name,is_default,is_public)
    VALUES(NEW.id,'Public',1,1)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usergroup`
--

DROP TABLE IF EXISTS `tbl_usergroup`;
CREATE TABLE IF NOT EXISTS `tbl_usergroup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `is_default` bit(1) NOT NULL DEFAULT b'0',
  `is_public` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_usergroup`
--

INSERT INTO `tbl_usergroup` (`id`, `user_id`, `group_name`, `is_default`, `is_public`) VALUES
(1, 1, 'Public', b'1', b'1'),
(2, 2, 'Public', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userhandler`
--

DROP TABLE IF EXISTS `tbl_userhandler`;
CREATE TABLE IF NOT EXISTS `tbl_userhandler` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `handler_fci_number` varchar(20) DEFAULT NULL,
  `handler_profile_picture` blob,
  `handler_website` varchar(150) DEFAULT NULL,
  `handler_description` text,
  `handler_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=400000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userkennel`
--

DROP TABLE IF EXISTS `tbl_userkennel`;
CREATE TABLE IF NOT EXISTS `tbl_userkennel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `kennel_name` varchar(150) DEFAULT NULL,
  `kennel_fci_number` varchar(20) DEFAULT NULL,
  `kennel_profile_picture` varchar(1000) DEFAULT NULL,
  `kennel_background_image` varchar(1000) DEFAULT NULL,
  `kennel_website` varchar(150) DEFAULT NULL,
  `kennel_description` text,
  `kennel_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userowner`
--

DROP TABLE IF EXISTS `tbl_userowner`;
CREATE TABLE IF NOT EXISTS `tbl_userowner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `owner_fci_number` varchar(20) DEFAULT NULL,
  `owner_profile_picture` blob,
  `owner_background_image` blob,
  `owner_website` varchar(150) DEFAULT NULL,
  `owner_description` text,
  `owner_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=300000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_0`
--

DROP TABLE IF EXISTS `tmp_0`;
CREATE TABLE IF NOT EXISTS `tmp_0` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_0`
--

INSERT INTO `tmp_0` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_1`
--

DROP TABLE IF EXISTS `tmp_1`;
CREATE TABLE IF NOT EXISTS `tmp_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_1`
--

INSERT INTO `tmp_1` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_2`
--

DROP TABLE IF EXISTS `tmp_2`;
CREATE TABLE IF NOT EXISTS `tmp_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_2`
--

INSERT INTO `tmp_2` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_3`
--

DROP TABLE IF EXISTS `tmp_3`;
CREATE TABLE IF NOT EXISTS `tmp_3` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_4`
--

DROP TABLE IF EXISTS `tmp_4`;
CREATE TABLE IF NOT EXISTS `tmp_4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_4`
--

INSERT INTO `tmp_4` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_5`
--

DROP TABLE IF EXISTS `tmp_5`;
CREATE TABLE IF NOT EXISTS `tmp_5` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_5`
--

INSERT INTO `tmp_5` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_6`
--

DROP TABLE IF EXISTS `tmp_6`;
CREATE TABLE IF NOT EXISTS `tmp_6` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_6`
--

INSERT INTO `tmp_6` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_7`
--

DROP TABLE IF EXISTS `tmp_7`;
CREATE TABLE IF NOT EXISTS `tmp_7` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_7`
--

INSERT INTO `tmp_7` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_8`
--

DROP TABLE IF EXISTS `tmp_8`;
CREATE TABLE IF NOT EXISTS `tmp_8` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_8`
--

INSERT INTO `tmp_8` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_9`
--

DROP TABLE IF EXISTS `tmp_9`;
CREATE TABLE IF NOT EXISTS `tmp_9` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_9`
--

INSERT INTO `tmp_9` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_10`
--

DROP TABLE IF EXISTS `tmp_10`;
CREATE TABLE IF NOT EXISTS `tmp_10` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_description` mediumtext,
  `event_image` mediumtext,
  `date` timestamp NULL DEFAULT NULL,
  `timeline_profile_image` longblob,
  `timeline_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tmp_10`
--

INSERT INTO `tmp_10` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(2, 200000000, 1, 5, '29.07.2015 - Best Awards show 2010', '', '2015-08-29 20:37:20', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel'),
(4, 200000000, 200000000, 2, 'Labradors kennel', 'uploads/VqHnvmskrx.jpg', '2015-09-01 08:00:22', 0x75706c6f6164732f5671486e766d736b72782e6a7067, 'Labradors kennel');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_1`
--

DROP TABLE IF EXISTS `tmp_msg_1`;
CREATE TABLE IF NOT EXISTS `tmp_msg_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2720 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_2`
--

DROP TABLE IF EXISTS `tmp_msg_2`;
CREATE TABLE IF NOT EXISTS `tmp_msg_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2613 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_3`
--

DROP TABLE IF EXISTS `tmp_msg_3`;
CREATE TABLE IF NOT EXISTS `tmp_msg_3` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2880 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_4`
--

DROP TABLE IF EXISTS `tmp_msg_4`;
CREATE TABLE IF NOT EXISTS `tmp_msg_4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2855 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_5`
--

DROP TABLE IF EXISTS `tmp_msg_5`;
CREATE TABLE IF NOT EXISTS `tmp_msg_5` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2861 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_6`
--

DROP TABLE IF EXISTS `tmp_msg_6`;
CREATE TABLE IF NOT EXISTS `tmp_msg_6` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2615 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_7`
--

DROP TABLE IF EXISTS `tmp_msg_7`;
CREATE TABLE IF NOT EXISTS `tmp_msg_7` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2750 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_8`
--

DROP TABLE IF EXISTS `tmp_msg_8`;
CREATE TABLE IF NOT EXISTS `tmp_msg_8` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2683 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_9`
--

DROP TABLE IF EXISTS `tmp_msg_9`;
CREATE TABLE IF NOT EXISTS `tmp_msg_9` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2870 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_msg_10`
--

DROP TABLE IF EXISTS `tmp_msg_10`;
CREATE TABLE IF NOT EXISTS `tmp_msg_10` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2570 ;

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_1`
--

DROP TABLE IF EXISTS `_tmp_msg_1`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_2`
--

DROP TABLE IF EXISTS `_tmp_msg_2`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_2`
--

INSERT INTO `_tmp_msg_2` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_3`
--

DROP TABLE IF EXISTS `_tmp_msg_3`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_3` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_3`
--

INSERT INTO `_tmp_msg_3` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_4`
--

DROP TABLE IF EXISTS `_tmp_msg_4`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_5`
--

DROP TABLE IF EXISTS `_tmp_msg_5`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_5` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_5`
--

INSERT INTO `_tmp_msg_5` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_7`
--

DROP TABLE IF EXISTS `_tmp_msg_7`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_7` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_7`
--

INSERT INTO `_tmp_msg_7` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_8`
--

DROP TABLE IF EXISTS `_tmp_msg_8`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_8` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_8`
--

INSERT INTO `_tmp_msg_8` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_9`
--

DROP TABLE IF EXISTS `_tmp_msg_9`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_9` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_tmp_msg_9`
--

INSERT INTO `_tmp_msg_9` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(2, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `_tmp_msg_10`
--

DROP TABLE IF EXISTS `_tmp_msg_10`;
CREATE TABLE IF NOT EXISTS `_tmp_msg_10` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `profile_id` bigint(20) DEFAULT NULL,
  `message` mediumtext,
  `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_tmp_msg_10`
--

INSERT INTO `_tmp_msg_10` (`id`, `user_id`, `profile_id`, `message`, `message_datetime`) VALUES
(1, 100000000, 200000000, 'Lolol ja som prva message', '2015-08-20 13:50:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
