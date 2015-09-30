-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2015 at 09:27 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

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
(23, 'frmPlannedLitter', 'tbl_planned_litters'),
(24, 'frmCreateHandlerProfile', 'tbl_userhandler'),
(25, 'frmHandlerEditProfile', 'tbl_userhandler');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_name`, `element_name`, `field_name`) VALUES
(1, 'frmlogIn', 'txtEmail', 'email'),
(2, 'frmlogIn', 'txtPassword', 'password'),
(3, 'frmSignIn', 'txtName', 'name'),
(4, 'frmSignIn', 'txtSurname', 'surname'),
(5, 'frmSignIn', 'txtEmail', 'email'),
(6, 'frmSignIn', 'hidddlCountries', 'state'),
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
(90, 'frmPlannedLitter', 'kennel_id', 'kennel_id'),
(91, 'frmCreateHandlerProfile', 'txtHandlerProfilePhoto', 'handler_profile_picture'),
(92, 'frmCreateHandlerProfile', 'txtHandlerDescritpion', 'handler_description'),
(93, 'frmHandlerEditProfile', 'txtHandlerDescription', 'handler_description'),
(94, 'frmEditUser', 'ddlLanguage', 'lang');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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
  `CountryName_sk` varchar(255) DEFAULT NULL,
  `GroupName_sk` varchar(255) DEFAULT NULL,
  `CountryName_en` varchar(255) DEFAULT NULL,
  `GroupName_en` varchar(255) DEFAULT NULL,
  `CountryName_cz` varchar(255) DEFAULT NULL,
  `GroupName_cz` varchar(255) DEFAULT NULL,
  `CountryName_hu` varchar(255) NOT NULL,
  `CountryCode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `lk_countries`
--

INSERT INTO `lk_countries` (`ID`, `CountryName_sk`, `GroupName_sk`, `CountryName_en`, `GroupName_en`, `CountryName_cz`, `GroupName_cz`, `CountryName_hu`, `CountryCode`) VALUES
(1, 'Slovensko', 'Európa', 'Slovakia', 'Europe', 'Slovensko', 'Evropa', 'Szlovákia', 'SK'),
(2, 'Česká republika', 'Európa', 'Czech Republic', 'Europe', 'Česká republika', 'Evropa', 'Cseh Köztársaság / Csehország', 'CZ'),
(135, 'Albánsko', 'Európa', 'Albania', 'Europe', 'Albánie', 'Evropa', 'Albánia', NULL),
(17, 'Belgicko', 'Európa', 'Belgium', 'Europe', 'Belgie', 'Evropa', 'Belgium', NULL),
(20, 'Bielorusko', 'Európa', 'Belarus', 'Europe', 'Bělorusko', 'Evropa', 'Belorusszia', NULL),
(22, 'Bosna a Hercegovina', 'Európa', 'Bosnia-Herzegovina', 'Europe', 'Bosna a Hercegovina', 'Evropa', 'Bosznia-Hercegovina', NULL),
(136, 'Bulharsko', 'Európa', 'Bulgaria', 'Europe', 'Bulharsko', 'Evropa', 'Bulgária', 'BG'),
(10, 'Cyprus', 'Európa', 'Cyprus', 'Europe', 'Kypr', 'Evropa', 'Ciprusi Köztársaság / Ciprus', NULL),
(166, 'Čierna Hora', 'Európa', 'Republic of Montenegro', 'Europe', 'Černá Hora', 'Evropa', 'Montenegrói Köztársaság', NULL),
(31, 'Dánsko', 'Európa', 'Denmark', 'Europe', 'Dánsko', 'Evropa', 'Dán Királyság / Dánia', NULL),
(36, 'Estónsko', 'Európa', 'Estonia', 'Europe', 'Estonsko', 'Evropa', 'Észt Köztársaság / Észtország', 'EE'),
(40, 'Fínsko', 'Európa', 'Finland', 'Europe', 'Finsko', 'Evropa', 'Finnország', 'FI'),
(42, 'Francúzsko', 'Európa', 'France', 'Europe', 'Francie', 'Evropa', 'Franciaország', NULL),
(46, 'Grécko', 'Európa', 'Greece', 'Europe', 'Řecko', 'Evropa', 'Görögország', NULL),
(54, 'Holandsko', 'Európa', 'Netherlands', 'Europe', 'Nizozemsko', 'Evropa', 'Hollandia ', NULL),
(165, 'Chorvátsko', 'Európa', 'Croatia', 'Europe', 'Chorvatsko', 'Evropa', 'Horvátország', 'HR'),
(80, 'Írsko', 'Európa', 'Ireland', 'Europe', 'Irsko', 'Evropa', 'Írország', NULL),
(87, 'Lichtenštajnsko', 'Európa', 'Liechtenstein', 'Europe', 'Lichtenštejnsko', 'Evropa', 'Liechtenstein', NULL),
(88, 'Litva', 'Európa', 'Lithuania', 'Europe', 'Litva', 'Evropa', 'Litvánia', 'LT'),
(176, 'Lotyšsko', 'Európa', 'Latvia', 'Europe', 'Lotyšsko', 'Evropa', 'Lettország', 'LV'),
(89, 'Luxembursko', 'Európa', 'Luxembourg', 'Europe', 'Lucembursko', 'Evropa', 'Luxembourg', NULL),
(173, 'Macedónsko', 'Európa', 'Macedonia', 'Europe', 'Makedonie', 'Evropa', 'Macedónia', NULL),
(3, 'Maďarsko', 'Európa', 'Hungary', 'Europe', 'Maďarsko', 'Evropa', 'Magyarország', 'HU'),
(95, 'Malta', 'Európa', 'Malta', 'Europe', 'Malta', 'Evropa', 'Málta', NULL),
(102, 'Monako', 'Európa', 'Monaco', 'Europe', 'Monako', 'Evropa', 'Monaco', NULL),
(107, 'Nemecko', 'Európa', 'Germany', 'Europe', 'Německo', 'Evropa', 'Németország', NULL),
(112, 'Nórsko', 'Európa', 'Norway', 'Europe', 'Norsko', 'Evropa', 'Norvégia', NULL),
(119, 'Poľsko', 'Európa', 'Poland', 'Europe', 'Polsko', 'Evropa', 'Lengyelország', 'PL'),
(120, 'Portugalsko', 'Európa', 'Portugal', 'Europe', 'Portugalsko', 'Evropa', 'Portugália', NULL),
(4, 'Rakúsko', 'Európa', 'Austria', 'Europe', 'Rakousko', 'Evropa', 'Ausztria', NULL),
(167, 'Rumunsko', 'Európa', 'Romania', 'Europe', 'Rumunsko', 'Evropa', 'Románia', 'RO'),
(170, 'Rusko', 'Európa', 'Russia', 'Europe', 'Rusko', 'Evropa', 'Oroszország', NULL),
(133, 'Slovinsko', 'Európa', 'Slovenia', 'Europe', 'Slovinsko', 'Evropa', 'Szlovénia', 'SI'),
(64, 'Srbsko', 'Európa', 'Serbia', 'Europe', 'Srbsko', 'Evropa', 'Szerbia', NULL),
(25, 'Španielsko', 'Európa', 'Spain', 'Europe', 'Španělsko', 'Evropa', 'Spanyolország', NULL),
(145, 'Švajčiarsko', 'Európa', 'Switzerland', 'Europe', 'Švýcarsko', 'Evropa', 'Svájc', NULL),
(146, 'Švédsko', 'Európa', 'Sweden', 'Europe', 'Švédsko', 'Evropa', 'Svédország', NULL),
(148, 'Taliansko', 'Európa', 'Italy', 'Europe', 'Itálie', 'Evropa', 'Olaszország', NULL),
(154, 'Turecko', 'Európa', 'Turkey', 'Europe', 'Turecko', 'Evropa', 'Törökország', 'TR'),
(155, 'Ukrajina', 'Európa', 'Ukraine', 'Europe', 'Ukrajina', 'Evropa', 'Ukrajna', NULL),
(6, 'Veľká Británia', 'Európa', 'Great Britain', 'Europe', 'Velká Británie', 'Evropa', 'Nagy-Britannia', NULL),
(134, 'Afganistan', 'Zahraničie', 'Afghanistan', 'Overseas', 'Afghánistán', 'Zahraničí', 'Afganisztán', NULL),
(8, 'Alžírsko', 'Zahraničie', 'Algeria', 'Overseas', 'Alžírsko', 'Zahraničí', 'Algéria', NULL),
(9, 'Andorra', 'Zahraničie', 'Andorra', 'Overseas', 'Andorra', 'Zahraničí', 'Andorra', NULL),
(12, 'Arménsko', 'Zahraničie', 'Armenia', 'Overseas', 'Arménie', 'Zahraničí', 'Örményország', NULL),
(171, 'Austrália', 'Zahraničie', 'Australia', 'Overseas', 'Austrálie', 'Zahraničí', 'Ausztrália', NULL),
(13, 'Azerbajdžan', 'Zahraničie', 'Azerbaidjan', 'Overseas', 'Ázerbájdžán', 'Zahraničí', 'Azerbajdzsán', NULL),
(15, 'Bahrajn', 'Zahraničie', 'Bahrain', 'Overseas', 'Bahrajn', 'Zahraničí', 'Bahrain', NULL),
(16, 'Bangladéš', 'Zahraničie', 'Bangladesh', 'Overseas', 'Bangladéš', 'Zahraničí', 'Bangladesh', NULL),
(21, 'Bolívia', 'Zahraničie', 'Bolivia', 'Overseas', 'Bolívie', 'Zahraničí', 'Bolívia', NULL),
(24, 'Brazília', 'Zahraničie', 'Brazil', 'Overseas', 'Brazílie', 'Zahraničí', 'Brazília', NULL),
(29, 'Čad', 'Zahraničie', 'Chad', 'Overseas', 'Čad', 'Zahraničí', 'Csád', NULL),
(30, 'Čína', 'Zahraničie', 'China', 'Overseas', 'Čína', 'Zahraničí', 'Kína', NULL),
(34, 'Egypt', 'Zahraničie', 'Egypt', 'Overseas', 'Egypt', 'Zahraničí', 'Egyiptom', NULL),
(35, 'Ekvádor', 'Zahraničie', 'Ecuador', 'Overseas', 'Ekvádor', 'Zahraničí', 'Ecuadori Köztársaság / Ecuador', NULL),
(172, 'Etiópia', 'Zahraničie', 'Ethiopia', 'Overseas', 'Etiopie', 'Zahraničí', 'Etiópia', NULL),
(37, 'Faerské ostrovy', 'Zahraničie', 'Faroe Islands', 'Overseas', 'Faerské ostrovy', 'Zahraničí', 'Feröer-szigetek', NULL),
(39, 'Filipíny', 'Zahraničie', 'Philippines', 'Overseas', 'Filipíny', 'Zahraničí', 'Fülöp-szigetek', NULL),
(45, 'Ghana', 'Zahraničie', 'Ghana', 'Overseas', 'Ghana', 'Zahraničí', 'Ghána', NULL),
(47, 'Gruzínsko', 'Zahraničie', 'Georgia', 'Overseas', 'Gruzie', 'Zahraničí', 'Grúzia', NULL),
(49, 'Guatemala', 'Zahraničie', 'Guatemala', 'Overseas', 'Guatemala', 'Zahraničí', 'Guatemala', NULL),
(56, 'India', 'Zahraničie', 'India', 'Overseas', 'Indie', 'Zahraničí', 'India', NULL),
(57, 'Indonézia', 'Zahraničie', 'Indonesia', 'Overseas', 'Indonésie', 'Zahraničí', 'Indonézia', NULL),
(58, 'Irak', 'Zahraničie', 'Iraq', 'Overseas', 'Irák', 'Zahraničí', 'Irak', NULL),
(59, 'Irán', 'Zahraničie', 'Iran', 'Overseas', 'Írán', 'Zahraničí', 'Irán', NULL),
(60, 'Island', 'Zahraničie', 'Iceland', 'Overseas', 'Island', 'Zahraničí', 'Izland', NULL),
(61, 'Izrael', 'Zahraničie', 'Israel', 'Overseas', 'Izrael', 'Zahraničí', 'Izrael', NULL),
(76, 'Japonsko', 'Zahraničie', 'Japan', 'Overseas', 'Japonsko', 'Zahraničí', 'Japán', NULL),
(63, 'Jordánsko', 'Zahraničie', 'Jordan', 'Overseas', 'Jordánsko', 'Zahraničí', 'Jordánia', NULL),
(65, 'Juhoafrická republika', 'Zahraničie', 'South Africa', 'Overseas', 'Jihoafrická republika', 'Zahraničí', 'Dél-Afrika', NULL),
(28, 'Kanada', 'Zahraničie', 'Canada', 'Overseas', 'Kanada', 'Zahraničí', 'Kanada', NULL),
(68, 'Katar', 'Zahraničie', 'Qatar', 'Overseas', 'Katar', 'Zahraničí', 'Katar', NULL),
(69, 'Kazachstan', 'Zahraničie', 'Kazakhstan', 'Overseas', 'Kazachstán', 'Zahraničí', 'Kazahsztán', NULL),
(70, 'Keňa', 'Zahraničie', 'Kenya', 'Overseas', 'Keňa', 'Zahraničí', 'Kenya', NULL),
(81, 'Kuvajt', 'Zahraničie', 'Kuwait', 'Overseas', 'Kuvajt', 'Zahraničí', 'Kuvait', NULL),
(84, 'Libanon', 'Zahraničie', 'Lebanon', 'Overseas', 'Libanon', 'Zahraničí', 'Libanon', NULL),
(86, 'Líbya', 'Zahraničie', 'Libya', 'Overseas', 'Libye', 'Zahraničí', 'Líbia', NULL),
(90, 'Madagaskar', 'Zahraničie', 'Madagascar', 'Overseas', 'Madagaskar', 'Zahraničí', 'Madagaszkár', NULL),
(174, 'Malajzia', 'Zahraničie', 'Malaysia', 'Overseas', 'Malajsie', 'Zahraničí', 'Malaysia', NULL),
(96, 'Maroko', 'Zahraničie', 'Morocco', 'Overseas', 'Maroko', 'Zahraničí', 'Marokkó', NULL),
(97, 'Marshallove ostrovy', 'Zahraničie', 'Marshall Islands', 'Overseas', 'Marshallove ostrovy', 'Zahraničí', 'Marshall-szigetek', NULL),
(100, 'Mexiko', 'Zahraničie', 'Mexico', 'Overseas', 'Mexiko', 'Zahraničí', 'Mexikó', NULL),
(108, 'Nepál', 'Zahraničie', 'Nepal', 'Overseas', 'Nepál', 'Zahraničí', 'Nepál', NULL),
(110, 'Nigéria', 'Zahraničie', 'Nigeria', 'Overseas', 'Nigérie', 'Zahraničí', 'Nigéria', NULL),
(175, 'Nový Zéland', 'Zahraničie', 'New Zealand', 'Overseas', 'Nový Zéland', 'Zahraničí', 'Új Zéland', NULL),
(113, 'Omán', 'Zahraničie', 'Oman', 'Overseas', 'Omán', 'Zahraničí', 'Oman', NULL),
(117, 'Peru', 'Zahraničie', 'Peru', 'Overseas', 'Peru', 'Zahraničí', 'Peru', NULL),
(128, 'Saudská Arábia', 'Zahraničie', 'Saudi Arabia', 'Overseas', 'Saúdská Arábie', 'Zahraničí', 'Szaud-Arábia', NULL),
(130, 'Seychely', 'Zahraničie', 'Seychelles', 'Overseas', 'Seychely', 'Zahraničí', 'Seychelle-szigetek', NULL),
(132, 'Singapur', 'Zahraničie', 'Singapore', 'Overseas', 'Singapur', 'Zahraničí', 'Szingapúr', NULL),
(164, 'Spojené arabské emiráty', 'Zahraničie', 'United Arab Emirates', 'Overseas', 'Spojené arabské emiráty', 'Zahraničí', 'Egyesült Arab Emírségek', NULL),
(137, 'Srí Lanka', 'Zahraničie', 'Sri Lanka', 'Overseas', 'Srí Lanka', 'Zahraničí', 'Sri Lanka', NULL),
(143, 'Sýria', 'Zahraničie', 'Syria', 'Overseas', 'Sýrie', 'Zahraničí', 'Szíria', NULL),
(150, 'Thajsko', 'Zahraničie', 'Thailand', 'Overseas', 'Thajsko', 'Zahraničí', 'Thaiföld', NULL),
(153, 'Tunisko', 'Zahraničie', 'Tunisia', 'Overseas', 'Tunisko', 'Zahraničí', 'Tunézia', NULL),
(156, 'Uganda', 'Zahraničie', 'Uganda', 'Overseas', 'Uganda', 'Zahraničí', 'Uganda', NULL),
(7, 'USA', 'Zahraničie', 'USA', 'Overseas', 'USA', 'Zahraničí', 'Amerikai Egyesült Államok', NULL),
(158, 'Uzbekistan', 'Zahraničie', 'Uzbekistan', 'Overseas', 'Uzbekistan', 'Zahraničí', 'Üzbegisztán', NULL),
(161, 'Venezuela', 'Zahraničie', 'Venezuela', 'Overseas', 'Venezuela', 'Zahraničí', 'Venezuela', NULL),
(186, 'San Marino', 'Európa', 'San Marino', 'Europe', 'San Marino', 'Evropa', 'San Marino', NULL),
(187, 'Moldavsko', 'Európa', 'Moldova', 'Europe', 'Moldavsko', 'Evropa', 'Moldova', NULL),
(188, 'Argentína', 'Zahraničie', 'Argentina', 'Overseas', 'Argentina', 'Zahraničí', 'Argentína', NULL),
(189, 'Čile', 'Zahraničie', 'Chile', 'Overseas', 'Chile', 'Zahraničí', 'Chile', NULL),
(190, 'Kolumbia', 'Zahraničie', 'Colombia', 'Overseas', 'Kolumbie', 'Zahraničí', 'Kolumbia', NULL),
(191, 'Kostarika', 'Zahraničie', 'Costa Rica', 'Overseas', 'Kostarika', 'Zahraničí', 'Costa Rica', NULL),
(192, 'Kuba', 'Zahraničie', 'Cuba', 'Overseas', 'Kuba', 'Zahraničí', 'Kuba', NULL),
(193, 'Dominikánska Republika', 'Zahraničie', 'Dominican Republic', 'Overseas', 'Dominikánská Republika', 'Zahraničí', 'Dominikai Köztársaság', NULL),
(194, 'El Salvador', 'Zahraničie', 'El Salvador', 'Overseas', 'El Salvador', 'Zahraničí', 'El Salvardor', NULL),
(195, 'Honduras', 'Zahraničie', 'Honduras', 'Overseas', 'Honduras', 'Zahraničí', 'Honduras', NULL),
(196, 'Nikaragua', 'Zahraničie', 'Nicaragua', 'Overseas', 'Nicaragua', 'Zahraničí', 'Nicaragua', NULL),
(197, 'Panama', 'Zahraničie', 'Panama', 'Overseas', 'Panama', 'Zahraničí', 'Panama', NULL),
(198, 'Puerto Rico', 'Zahraničie', 'Puerto Rico', 'Overseas', 'Puerto Rico', 'Zahraničí', 'Puerto Rico', NULL),
(199, 'Pakistan', 'Zahraničie', 'Pakistan', 'Overseas', 'Pákistán', 'Zahraničí', 'Pakisztán', NULL),
(200, 'Paraguaj', 'Zahraničie', 'Paraguay', 'Overseas', 'Paraguay', 'Zahraničí', 'Paraguay', NULL),
(201, 'Gibraltár', 'Zahraničie', 'Gibraltar', 'Overseas', 'Gibraltar', 'Zahraničí', 'Gibraltár', NULL),
(202, 'Uruguaj', 'Zahraničie', 'Uruguay', 'Overseas', 'Uruguay', 'Zahraničí', 'Uruguay', NULL),
(203, 'Pakistan', 'Zahraničie', 'Pakistan', 'Overseas', 'Pákistán', 'Zahraničí', 'Pakisztán', NULL),
(204, 'Južná Kórea', 'Zahraničie', 'Republic of Kore', 'Overseas', 'Jižní Korea', 'Zahraničí', 'Koreai Köztársaság', NULL),
(205, 'Taiwan', 'Zahraničie', 'Taiwan', 'Overseas', 'Tchaj-wan', 'Zahraničí', 'Tajvan', NULL),
(206, 'Vietnam', 'Zahraničie', 'Vietnam', 'Overseas', 'Vietnam', 'Zahraničí', 'Vietnám', NULL);

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
  `event_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `comment` mediumtext NOT NULL,
  `comment_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1000000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1100000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1200000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1400000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dogs_shows`
--

DROP TABLE IF EXISTS `tbl_dogs_shows`;
CREATE TABLE IF NOT EXISTS `tbl_dogs_shows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dog_id` bigint(20) NOT NULL,
  `show_name` varchar(250) NOT NULL,
  `show_type` varchar(250) NOT NULL,
  `show_country` varchar(250) NOT NULL,
  `handler_name` varchar(250) NOT NULL,
  `judge_name` varchar(250) NOT NULL,
  `show_class` varchar(100) NOT NULL,
  `VP1` int(11) NOT NULL,
  `VP2` int(11) NOT NULL,
  `VP3` int(11) NOT NULL,
  `VP` int(11) NOT NULL,
  `BestMinorPuppy1` int(11) NOT NULL,
  `BestMinorPuppy2` int(11) NOT NULL,
  `BestMinorPuppy3` int(11) NOT NULL,
  `BestPuppy1` int(11) NOT NULL,
  `BestPuppy2` int(11) NOT NULL,
  `BestPuppy3` int(11) NOT NULL,
  `EXC1` int(11) NOT NULL,
  `EXC2` int(11) NOT NULL,
  `EXC3` int(11) NOT NULL,
  `EXC4` int(11) NOT NULL,
  `VG1` int(11) NOT NULL,
  `VG2` int(11) NOT NULL,
  `VG3` int(11) NOT NULL,
  `VG4` int(11) NOT NULL,
  `CAJC` int(11) NOT NULL,
  `JBOB` int(11) NOT NULL,
  `BOB` int(11) NOT NULL,
  `BOS` int(11) NOT NULL,
  `JBOG1` int(11) NOT NULL,
  `JBOG2` int(11) NOT NULL,
  `JBOG3` int(11) NOT NULL,
  `JBIS1` int(11) NOT NULL,
  `JBIS2` int(11) NOT NULL,
  `JBIS3` int(11) NOT NULL,
  `BOG1` int(11) NOT NULL,
  `BOG2` int(11) NOT NULL,
  `BOG3` int(11) NOT NULL,
  `BIS1` int(11) NOT NULL,
  `BIS2` int(11) NOT NULL,
  `BIS3` int(11) NOT NULL,
  `CAC` int(11) NOT NULL,
  `RESCAC` int(11) NOT NULL,
  `CACIB` int(11) NOT NULL,
  `RESCACIB` int(11) NOT NULL,
  `other_title` text NOT NULL,
  `show_image` varchar(250) NOT NULL,
  `show_date` date NOT NULL,
  `show_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=800000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1600000000 ;

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
-- Table structure for table `tbl_handler_awards`
--

DROP TABLE IF EXISTS `tbl_handler_awards`;
CREATE TABLE IF NOT EXISTS `tbl_handler_awards` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1800000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handler_breed`
--

DROP TABLE IF EXISTS `tbl_handler_breed`;
CREATE TABLE IF NOT EXISTS `tbl_handler_breed` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) NOT NULL,
  `breed_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2000000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2200000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handler_shows`
--

DROP TABLE IF EXISTS `tbl_handler_shows`;
CREATE TABLE IF NOT EXISTS `tbl_handler_shows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) NOT NULL,
  `show_id` bigint(20) NOT NULL COMMENT 'for handler shows',
  `dog_name` varchar(250) NOT NULL,
  `judge_name` varchar(250) NOT NULL,
  `show_class` varchar(100) NOT NULL,
  `VP1` int(11) NOT NULL,
  `VP2` int(11) NOT NULL,
  `VP3` int(11) NOT NULL,
  `VP` int(11) NOT NULL,
  `BestMinorPuppy1` int(11) NOT NULL,
  `BestMinorPuppy2` int(11) NOT NULL,
  `BestMinorPuppy3` int(11) NOT NULL,
  `BestPuppy1` int(11) NOT NULL,
  `BestPuppy2` int(11) NOT NULL,
  `BestPuppy3` int(11) NOT NULL,
  `EXC1` int(11) NOT NULL,
  `EXC2` int(11) NOT NULL,
  `EXC3` int(11) NOT NULL,
  `EXC4` int(11) NOT NULL,
  `VG1` int(11) NOT NULL,
  `VG2` int(11) NOT NULL,
  `VG3` int(11) NOT NULL,
  `VG4` int(11) NOT NULL,
  `CAJC` int(11) NOT NULL,
  `JBOB` int(11) NOT NULL,
  `BOB` int(11) NOT NULL,
  `BOS` int(11) NOT NULL,
  `JBOG1` int(11) NOT NULL,
  `JBOG2` int(11) NOT NULL,
  `JBOG3` int(11) NOT NULL,
  `JBIS1` int(11) NOT NULL,
  `JBIS2` int(11) NOT NULL,
  `JBIS3` int(11) NOT NULL,
  `BOG1` int(11) NOT NULL,
  `BOG2` int(11) NOT NULL,
  `BOG3` int(11) NOT NULL,
  `BIS1` int(11) NOT NULL,
  `BIS2` int(11) NOT NULL,
  `BIS3` int(11) NOT NULL,
  `CAC` int(11) NOT NULL,
  `RESCAC` int(11) NOT NULL,
  `CACIB` int(11) NOT NULL,
  `RESCACIB` int(11) NOT NULL,
  `other_title` text NOT NULL,
  `show_image` varchar(250) NOT NULL,
  `show_date` date NOT NULL,
  `show_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2400000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_handler_show_groups`
--

DROP TABLE IF EXISTS `tbl_handler_show_groups`;
CREATE TABLE IF NOT EXISTS `tbl_handler_show_groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handler_id` bigint(20) NOT NULL,
  `show_date` date NOT NULL,
  `show_name` varchar(250) NOT NULL,
  `show_type` varchar(250) NOT NULL,
  `show_country` varchar(250) NOT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2600000000 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_import`
--

DROP TABLE IF EXISTS `tbl_import`;
CREATE TABLE IF NOT EXISTS `tbl_import` (
  `id` int(3) DEFAULT NULL,
  `text_to_translate` varchar(313) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `translated_text_en` varchar(328) DEFAULT NULL,
  `translated_text_hu` varchar(411) DEFAULT NULL,
  `translated_text_cz` varchar(10) DEFAULT NULL,
  `translated_text_sk` varchar(384) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `url` varchar(69) DEFAULT NULL,
  `uri` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_import`
--

INSERT INTO `tbl_import` (`id`, `text_to_translate`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(1, 'Registration', 'Registration', 'Regisztráció', NULL, 'Registrovať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(2, 'About DOGFORSHOW', 'About DOGFORSHOW', 'DOGFORSHOWról', NULL, 'O DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(3, 'Contact', 'Contact', 'Elérhetőség', NULL, 'Kontakt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(4, 'We support breeding of happy and healthy dogs with pedigree', 'We support breeding of happy and healthy dogs with pedigree', 'Támogatjuk az egészséges és boldog törzskönyvi kutyák tenyésztését', NULL, 'Podporujeme chov šťastných a zdravých psov s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(5, 'Login', 'Login', 'Bejelentkezés', NULL, 'Prihlásiť', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(6, 'Afghanistan', 'Afghanistan', 'Afganisztán', NULL, 'Afganistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(7, 'Albania', 'Albania', 'Albánia', NULL, 'Albánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(8, 'Algeria', 'Algeria', 'Algéria', NULL, 'Alžírsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(9, 'Andorra', 'Andorra', 'Andorra', NULL, 'Andorra', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(10, 'Argentina', 'Argentina', 'Argentína', NULL, 'Argentína', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(11, 'Armenia', 'Armenia', 'Örményország', NULL, 'Arménsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(12, 'Australia', 'Australia', 'Ausztrália', NULL, 'Austrália', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(13, 'Austria', 'Austria', 'Ausztria', NULL, 'Rakúsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(14, 'Azerbaidjan', 'Azerbaidjan', 'Azerbajdzsán', NULL, 'Azerbajdžan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(15, 'Bahrain', 'Bahrain', 'Bahrain', NULL, 'Bahrajn', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(16, 'Bangladesh', 'Bangladesh', 'Bangladesh', NULL, 'Bangladéš', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(17, 'Belarus', 'Belarus', 'Belorusszia', NULL, 'Bielorusko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(18, 'Belgium', 'Belgium', 'Belgium', NULL, 'Belgicko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(19, 'Bolivia', 'Bolivia', 'Bolívia', NULL, 'Bolívia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(20, 'Bosnia-Herzegovina', 'Bosnia-Herzegovina', 'Bosznia-Hercegovina', NULL, 'Bosna a Hercegovina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(21, 'Brazil', 'Brazil', 'Brazília', NULL, 'Brazília', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(22, 'Bulgaria', 'Bulgaria', 'Bulgária', NULL, 'Bulharsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(23, 'Canada', 'Canada', 'Kanada', NULL, 'Kanada', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(24, 'Colombia', 'Colombia', 'Kolumbia', NULL, 'Kolumbia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(25, 'Costa Rica', 'Costa Rica', 'Costa Rica', NULL, 'Kostarika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(26, 'Croatia', 'Croatia', 'Horvátország', NULL, 'Chorvátsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(27, 'Cuba', 'Cuba', 'Kuba', NULL, 'Kuba', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(28, 'Cyprus', 'Cyprus', 'Ciprusi Köztársaság / Ciprus', NULL, 'Cyprus', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(29, 'Czech Republic', 'Czech Republic', 'Cseh Köztársaság / Csehország', NULL, 'Česká republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(30, 'Denmark', 'Denmark', 'Dán Királyság / Dánia', NULL, 'Dánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(31, 'Dominican Republic', 'Dominican Republic', 'Dominikai Köztársaság', NULL, 'Dominikánska Republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(32, 'Ecuador', 'Ecuador', 'Ecuadori Köztársaság / Ecuador', NULL, 'Ekvádor', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(33, 'Egypt', 'Egypt', 'Egyiptom', NULL, 'Egypt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(34, 'El Salvador', 'El Salvador', 'El Salvardor', NULL, 'El Salvador', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(35, 'Estonia', 'Estonia', 'Észt Köztársaság / Észtország', NULL, 'Estónsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(36, 'Ethiopia', 'Ethiopia', 'Etiópia', NULL, 'Etiópia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(37, 'Faroe Islands', 'Faroe Islands', 'Feröer-szigetek', NULL, 'Faerské ostrovy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(38, 'Finland', 'Finland', 'Finnország', NULL, 'Fínsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(39, 'France', 'France', 'Franciaország', NULL, 'Francúzsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(40, 'Georgia', 'Georgia', 'Grúzia', NULL, 'Gruzínsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(41, 'Germany', 'Germany', 'Németország', NULL, 'Nemecko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(42, 'Ghana', 'Ghana', 'Ghána', NULL, 'Ghana', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(43, 'Gibraltar', 'Gibraltar', 'Gibraltár', NULL, 'Gibraltár', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(44, 'Great Britain', 'Great Britain', 'Nagy-Britannia', NULL, 'Veľká Británia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(45, 'Greece', 'Greece', 'Görögország', NULL, 'Grécko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(46, 'Guatemala', 'Guatemala', 'Guatemala', NULL, 'Guatemala', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(47, 'Honduras', 'Honduras', 'Honduras', NULL, 'Honduras', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(48, 'Hungary', 'Hungary', 'Magyarország', NULL, 'Maďarsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(49, 'Chad', 'Chad', 'Csád', NULL, 'Čad', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(50, 'Chile', 'Chile', 'Chile', NULL, 'Čile', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(51, 'China', 'China', 'Kína', NULL, 'Čína', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(52, 'Iceland', 'Iceland', 'Izland', NULL, 'Island', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(53, 'India', 'India', 'India', NULL, 'India', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(54, 'Indonesia', 'Indonesia', 'Indonézia', NULL, 'Indonézia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(55, 'Iran', 'Iran', 'Irán', NULL, 'Irán', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(56, 'Iraq', 'Iraq', 'Irak', NULL, 'Irak', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(57, 'Ireland', 'Ireland', 'Írország', NULL, 'Írsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(58, 'Israel', 'Israel', 'Izrael', NULL, 'Izrael', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(59, 'Italy', 'Italy', 'Olaszország', NULL, 'Taliansko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(60, 'Japan', 'Japan', 'Japán', NULL, 'Japonsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(61, 'Jordan', 'Jordan', 'Jordánia', NULL, 'Jordánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(62, 'Kazakhstan', 'Kazakhstan', 'Kazahsztán', NULL, 'Kazachstan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(63, 'Kenya', 'Kenya', 'Kenya', NULL, 'Keňa', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(64, 'Kuwait', 'Kuwait', 'Kuvait', NULL, 'Kuvajt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(65, 'Latvia', 'Latvia', 'Lettország', NULL, 'Lotyšsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(66, 'Lebanon', 'Lebanon', 'Libanon', NULL, 'Libanon', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(67, 'Libya', 'Libya', 'Líbia', NULL, 'Líbya', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(68, 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', NULL, 'Lichtenštajnsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(69, 'Lithuania', 'Lithuania', 'Litvánia', NULL, 'Litva', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(70, 'Luxembourg', 'Luxembourg', 'Luxembourg', NULL, 'Luxembursko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(71, 'Macedonia', 'Macedonia', 'Macedónia', NULL, 'Macedónsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(72, 'Madagascar', 'Madagascar', 'Madagaszkár', NULL, 'Madagaskar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(73, 'Malaysia', 'Malaysia', 'Malaysia', NULL, 'Malajzia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(74, 'Malta', 'Malta', 'Málta', NULL, 'Malta', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(75, 'Marshall Islands', 'Marshall Islands', 'Marshall-szigetek', NULL, 'Marshallove ostrovy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(76, 'Mexico', 'Mexico', 'Mexikó', NULL, 'Mexiko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(77, 'Moldova', 'Moldova', 'Moldova', NULL, 'Moldavsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(78, 'Monaco', 'Monaco', 'Monaco', NULL, 'Monako', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(79, 'Morocco', 'Morocco', 'Marokkó', NULL, 'Maroko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(80, 'Nepal', 'Nepal', 'Nepál', NULL, 'Nepál', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(81, 'Netherlands', 'Netherlands', 'Hollandia ', NULL, 'Holandsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(82, 'New Zealand', 'New Zealand', 'Új Zéland', NULL, 'Nový Zéland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(83, 'Nicaragua', 'Nicaragua', 'Nicaragua', NULL, 'Nikaragua', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(84, 'Nigeria', 'Nigeria', 'Nigéria', NULL, 'Nigéria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(85, 'Norway', 'Norway', 'Norvégia', NULL, 'Nórsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(86, 'Oman', 'Oman', 'Oman', NULL, 'Omán', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(87, 'Pakistan', 'Pakistan', 'Pakisztán', NULL, 'Pakistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(88, 'Panama', 'Panama', 'Panama', NULL, 'Panama', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(89, 'Paraguay', 'Paraguay', 'Paraguay', NULL, 'Paraguaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(90, 'Peru', 'Peru', 'Peru', NULL, 'Peru', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(91, 'Philippines', 'Philippines', 'Fülöp-szigetek', NULL, 'Filipíny', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(92, 'Poland', 'Poland', 'Lengyelország', NULL, 'Poľsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(93, 'Portugal', 'Portugal', 'Portugália', NULL, 'Portugalsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(94, 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', NULL, 'Puerto Rico', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(95, 'Qatar', 'Qatar', 'Katar', NULL, 'Katar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(96, 'Republic of Kore', 'Republic of Kore', 'Koreai Köztársaság', NULL, 'Južná Kórea', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(97, 'Republic of Montenegro', 'Republic of Montenegro', 'Montenegrói Köztársaság', NULL, 'Čierna Hora', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(98, 'Romania', 'Romania', 'Románia', NULL, 'Rumunsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(99, 'Russia', 'Russia', 'Oroszország', NULL, 'Rusko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(100, 'San Marino', 'San Marino', 'San Marino', NULL, 'San Marino', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(101, 'Saudi Arabia', 'Saudi Arabia', 'Szaud-Arábia', NULL, 'Saudská Arábia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(102, 'Serbia', 'Serbia', 'Szerbia', NULL, 'Srbsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(103, 'Seychelles', 'Seychelles', 'Seychelle-szigetek', NULL, 'Seychely', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(104, 'Singapore', 'Singapore', 'Szingapúr', NULL, 'Singapur', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(105, 'Slovakia', 'Slovakia', 'Szlovákia', NULL, 'Slovensko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(106, 'Slovenia', 'Slovenia', 'Szlovénia', NULL, 'Slovinsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(107, 'South Africa', 'South Africa', 'Dél-Afrika', NULL, 'Juhoafrická republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(108, 'Spain', 'Spain', 'Spanyolország', NULL, 'Španielsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(109, 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', NULL, 'Srí Lanka', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(110, 'Sweden', 'Sweden', 'Svédország', NULL, 'Švédsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(111, 'Switzerland', 'Switzerland', 'Svájc', NULL, 'Švajčiarsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(112, 'Syria', 'Syria', 'Szíria', NULL, 'Sýria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(113, 'Taiwan', 'Taiwan', 'Tajvan', NULL, 'Taiwan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(114, 'Thailand', 'Thailand', 'Thaiföld', NULL, 'Thajsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(115, 'Tunisia', 'Tunisia', 'Tunézia', NULL, 'Tunisko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(116, 'Turkey', 'Turkey', 'Törökország', NULL, 'Turecko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(117, 'Uganda', 'Uganda', 'Uganda', NULL, 'Uganda', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(118, 'Ukraine', 'Ukraine', 'Ukrajna', NULL, 'Ukrajina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(119, 'United Arab Emirates', 'United Arab Emirates', 'Egyesült Arab Emírségek', NULL, 'Spojené arabské emiráty', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(120, 'Uruguay', 'Uruguay', 'Uruguay', NULL, 'Uruguaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(121, 'USA', 'USA', 'Amerikai Egyesült Államok', NULL, 'USA', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(122, 'Uzbekistan', 'Uzbekistan', 'Üzbegisztán', NULL, 'Uzbekistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(123, 'Venezuela', 'Venezuela', 'Venezuela', NULL, 'Venezuela', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(124, 'Vietnam', 'Vietnam', 'Vietnám', NULL, 'Vietnam', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(125, 'Name', 'Name', 'Név', NULL, 'Meno', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(126, 'Surname', 'Surname', 'Vezetéknév', NULL, 'Priezvisko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(127, 'Email', 'Email', 'Email', NULL, 'Email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(128, 'Password', 'Password', 'Jelszó', NULL, 'Heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(129, 'Confirm password', 'Confirm password', 'Jelszó megerősítése', NULL, 'Potvrdenie hesla', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(130, 'Register', 'Register', 'Regisztráció', NULL, 'Regitrovať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(131, 'Forgot your password', 'Forgot your password', 'Elfelejtette jelszavát', NULL, 'Zabudli ste heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(132, 'Your email', 'Your email', 'Email címe', NULL, 'Váš email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(133, 'Send', 'Send', 'Elküldés', NULL, 'Odoslať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(134, 'Remember me', 'Remember me', 'Emlékezz rám', NULL, 'Zapamätať si ma', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(135, 'Forgot password', 'Forgot password', 'Elfelejtett jelszó', NULL, 'Zabudnuté heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(136, 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which helps them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'Nemzetközi közösségi háló törzskönyves kutya tenyésztők, tulajdonosok, kennelek és handlerek számára.', NULL, 'Medzinárodná sociálna sieť venovaná chovateľským staniciam, majiteľom a handlerom psov s preukazom pôvodu. Vytvorte si prehľadný profil s množstvom funkcií, komunikujte s ostatnými užívateľmi a navzájom sa inšpirujte. Zabudnite na klasické inzertné portály a pridajte sa ešte dnes k rýchlorastúcej komunite majiteľov psov s preukazom pôvodu z celého sveta.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(137, 'Kennels', 'Kennels', 'Kennelek', NULL, 'Chovateľské stanice', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(138, 'Owners', 'Owners', 'Tulajdonosok', NULL, 'Majitelia psov', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(139, 'Handlers', 'Handlers', 'Handlerek', NULL, 'Handlery', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(140, 'Dogs with pedigree', 'Dogs with pedigree', 'Törzskönyves kutyák', NULL, 'Psy s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(141, 'Puppies for sale', 'Puppies for sale', 'Eladó kiskutyák', NULL, 'Šteniatká na predaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(142, 'Planned litters', 'Planned litters', 'Tervezett párosítások', NULL, 'Plánované vrhy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(143, 'Stud dogs', 'Stud dogs', 'Tenyészkutyák', NULL, 'Chovní psy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(144, 'Best in show', 'Best in show', 'Best in show', NULL, 'Best in Show', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(145, 'Follow with us how we are growing', 'Follow with us how we are growing', 'Kövesse velünk, hogyan nő a közösség', NULL, 'Sledujte spolu s nami ako rastieme', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(146, 'Present internationally on the right place', 'Present internationally on the right place', 'Nemzetközileg prezentáljon a megfelelő helyen', NULL, 'Prezentujte sa medzinárodne na tom správnom mieste', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(147, 'Possibility to create your own kennel, owners and handlers profile', 'Possibility to create your own kennel, owners and handlers profile', 'Lehetőség saját kennel, kutya tulajdonos és handler profil létrehozása', NULL, 'Vytvorte si profil chovateľskej stanice, majiteľa a handlera', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(148, 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'Create unique profiles of your dogs with possibility to offer your stud dogs', 'Készítsen egyedi profilt a kutyájának és használja ki a lehetőséget kínálni őt mint tenyészkant', NULL, 'Vytvorte si unikátne profily Vašich psov s možnosťou ponuky na krytie', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(149, 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Tüntesse fel kutyakiállítási eredményeit, díjait, címeit, munkavizsgáit, egészségügyi szűréseit, fenyképeit és videójait', NULL, 'Pridávajte výstavné úspechy, ocenenia, tituly, pracovné skúšky, informácie o zdraví, fotografie a videá', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(150, 'Inform about planned litters and offer puppies for sale', 'Inform about planned litters and offer puppies for sale', 'Informálja többieket a tervezett párosításairól és kínálja kiskutyáit ', NULL, 'Informujte o plánovaných vrhoch ', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(151, 'Create friendships and communicate with each other', 'Create friendships and communicate with each other', 'Hozzon létre új barátságokat és kommunikáljon velük', NULL, 'Vytvárajte priateľstvá a navzájom spolu komunikujte', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(152, 'Take opportunity to be contacted by potential buyers from all over the world', 'Take the opportunity to be contacted by potential buyers from all over the world', 'Használja ki a lehetőséget, hogy a potenciális vásárlók kapcsolatba lépjenek magával világ minden tájáról', NULL, 'Využite jedinečnú príležitosť kontaktovania potencionálnymi záujemcami z celého sveta', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(153, 'Contact us', 'Contact us', 'Lépjen kapcsolatba velünk', NULL, 'Kontaktujte nás', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(154, 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Kérjük, lépjen kapcsolatba velünk az alábbi űrlap segítségével, ha bármilyen kérdése van, problémája, vagy DOGFORSHOW hirdetéssel kapcsolatos kérdései vannak.', NULL, 'V prípade akýchkoľvek otázok, nezrovnalostí alebo v prípade záujmu o reklamu na portáli DOGFORSHOW nás neváhajte kontaktovať prostredníctvom nižšie uvedeného kontaktného formulára.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(155, 'Message', 'Message', 'Üzenet', NULL, 'Vaša správa', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(156, 'Verify', 'Verify', 'Megerősít', NULL, 'Overenie', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(157, 'Follow us', 'Follow us', 'Kövess minket', NULL, 'Sledujte nás', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(158, 'DOGFORSHOW on facebook', 'DOGFORSHOW on facebook', 'DOGFORSHOW a facebook-on', NULL, 'DOGFORSHOW na Facebooku', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(159, 'DOGFORSHOW on Google+', 'DOGFORSHOW on Google+', 'DOGFORSHOW a Google+-on', NULL, 'DOGFORSHOW na Google+', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(160, 'DOGFORSHOW on Twitter', 'DOGFORSHOW on Twitter', 'DOGFORSHOW a Twitter-en', NULL, 'DOGFORSHOW na Twitter', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(161, 'DOGFORSHOW on Pinterest', 'DOGFORSHOW on Pinterest', 'DOGFORSHOW a Pinterest-en', NULL, 'DOGFORSHOW na Pintereste', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(162, 'DOGFORSHOW on Tumblr', 'DOGFORSHOW on Tumblr', 'DOGFORSHOW a Tumblr-en', NULL, 'DOGFORSHOW na Tumblr', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(163, 'Friend requests', 'Friend requests', 'Ismerősök jelölése', NULL, 'Žiadosti o priateľstvo', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(164, 'send you a friend request', 'sent you a friend request', 'ismerősnek jelölt', NULL, 'vás žiada o priateľstvo', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(165, 'View all', 'View all', 'Mindet megnéz', NULL, 'Zobraziť všetko', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(166, 'Messages', 'Messages', 'Üzenetek', NULL, 'Správy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(167, 'Notifications', 'Notifications', 'Értesítések', NULL, 'Upozornenia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(168, 'comment your post', 'commented on your post', 'hozzászólt a bejegyzésedhez', NULL, 'okomentoval váš príspevok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(169, 'like your post', 'likes your post', 'kedveli a bejegyzésedet', NULL, 'sa páči váš príspevok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(170, 'User account', 'User account', 'Felhasználói fiók', NULL, 'Užívateľský účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(171, 'Account settings', 'Account settings', 'Beállítások', NULL, 'Nastaviť účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(172, 'Delete account', 'Delete account', 'Fiók törlése', NULL, 'Zmazať účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(173, 'Logout', 'Logout', 'Kijelentkezés', NULL, 'Odhlásiť', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(174, 'Kennel', 'Kennel', 'Kennel', NULL, 'Chovateľská stanica', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(175, 'Profile settings', 'Profile settings', 'Adatlap szerkesztése', NULL, 'Nastaviť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(176, 'Switch profile', 'Switch profile', 'Adatlap átváltása', NULL, 'Prepnúť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(177, 'Edit profile', 'Edit profile', 'Adatlap módosítása', NULL, 'Upraviť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(178, 'Delete profile', 'Delete profile', 'Adatlap törlése', NULL, 'Zmazať profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(179, 'My Profile', 'My Profile', 'Adatlapom', NULL, 'Môj profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(180, 'Home', 'Home', 'Kezdőlap', NULL, 'Domov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(181, 'Awards', 'Awards', 'Díjak', NULL, 'Ocenenia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(182, 'Dogs', 'Dogs', 'Kutyák', NULL, 'Psy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(183, 'Photos', 'Photos', 'Fenyképek', NULL, 'Fotografie', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(184, 'Videos', 'Videos', 'Videók', NULL, 'Videá', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(185, 'Friends', 'Friends', 'Barátok', NULL, 'Priatelia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(186, 'Followers', 'Followers', 'Követők', NULL, 'Sledujúci', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(187, 'Breeds for handling', 'Breeds for handling', 'Felvezetendő fajták', NULL, 'Plemená pre handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(188, 'Certificates', 'Certificates', 'Bizonylatok', NULL, 'Certifikáty', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(189, 'Show results', 'Show results', 'Kiállítási eredmények', NULL, 'Výstavné úspechy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(190, 'About us', 'About us', 'Rólunk', NULL, 'O nás', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(191, 'Terms & conditions', 'Terms & conditions', 'Felhasználási feltételek', NULL, 'Všobecné podmienky', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(192, 'Return policy', 'Return policy', 'Visszatérési irányelv', NULL, 'Reklamačné podmienky', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(193, 'Lists', 'Lists', 'Listák', NULL, 'Zoznamy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(194, 'Owners of purebred dogs', 'Owners of purebred dogs', 'Törzskönyves kutyák tulajdonosai', NULL, 'Majitelia psov s PP', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(195, 'Dogs for mating', 'Stud dogs', 'Tenyészkutyák', NULL, 'Chovní psy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(196, 'Active profile', 'Active profile', 'Aktív adatlap', NULL, 'Aktívny profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(197, 'Create a clear profile of your kennel', 'Create a clear profile of your kennel', 'Hozzon létre egy egyértelmű adatlapot a kenneléről', NULL, 'Prehľadný profil chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(198, 'Create unique profiles of your dogs', 'Create unique profiles of your dogs', 'Készítsen egyedi adatlapokat kutyáiról', NULL, 'Unikátne profily psov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(199, 'Offer your dogs at stud', 'Offer your stud dogs', 'Kínálja tenyészkutyáit', NULL, 'Možnosť ponuky psa na krytie', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(200, 'Inform about planned litters', 'Inform about planned litters', 'Informálja többieket a tervezett párosításairól', NULL, 'Pridávanie plánovaných vrhov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(201, 'Offer puppies for sale from planned litters', 'Offer puppies for sale from planned litters', 'Kínálja kiskutyáit a tervezett párosításaiból', NULL, 'Ponuka šteniatok na predaj', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(202, 'Add awards and titles of your dogs', 'Add awards and titles of your dogs', 'Tüntesse fel kutyái díjait és címeit', NULL, 'Pridávanie ocenení a titulov ', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(203, 'Add dogshow successes and keep show history of your dog in one place', 'Add dogshow successes and keep show history of your dog in one place', 'Tüntesse fel kutyakiállítási eredményeit és folyamatosan kövesse a kutya eredményeit, mindezt egy helyen', NULL, 'Pridávanie výstavných úspechov s prehľadnou výstavnou históriou', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(204, 'Add working exams and health informations', 'Add working exams and health informations', 'Tüntesse fel kutyái munka vizsgáit és egészségügyi szűréseit', NULL, 'Pridávanie pracovných skúšok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(205, 'Add pedigrees', 'Add pedigrees', 'Töltse ki kutyái törzskönyvét', NULL, 'Pridávanie interaktívnych rodokmeňov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(206, 'Add photos of your dogs', 'Add photos of your dogs', 'Töltse fel kutyái képeit', NULL, 'Pridávanie fotografií', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(207, 'Share your succeses on social networks', 'Share your succeses on social networks', 'Osztja meg kutyái sikereit a többi közösségi hálón', NULL, 'Zdieľanie vašich úspechov prostedníctvom sociálnych sietí', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(208, 'Communicate with other members of DOGFORSHOW', 'Communicate with other members of DOGFORSHOW', 'Kommunikáljon a többi DOGFORSHOW taggal', NULL, 'Komunikovanie s ostatnými členmi DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(209, 'Owner of purebred dog', 'Owner of purebred dog', 'Törzskönyves kutya tulajdonosa', NULL, 'Majiteľ psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(210, 'Create profile', 'Create profile', 'Hozzon létre egy adatlapot', NULL, 'Vytvoriť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(211, 'Create a clear owner profile', 'Create a clear owner''s profile', 'Hozzon létre egy egyértelmű kutya tulajdonosi adatlapot ', NULL, 'Prehľadný profil majiteľa psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(212, 'Possibility to migrate on kennel profile', 'Possibility to migrate to kennel''s profile', 'Lehetőség migrálni tulajdonos adatlapról egy kennel adatlapra', NULL, 'Možnosť zmeny profilu na chovateľskú stanicu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(213, 'Handler', 'Handler', 'Handler ', NULL, 'Handler', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(214, 'Create a clear handler profile', 'Create a clear handler''s profile', 'Hozzon létre egy egyértelmű handler adatlapot ', NULL, 'Prehľadný profil handlera', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(215, 'Add awards and certificates', 'Add awards and certificates', 'Töltse fel díjait és bizonylatait', NULL, 'Pridávanie ocenení a certifikátov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(216, 'Add your dogshow successes and titles', 'Add your dogshow successes and titles', 'Töltse fel kutyakiállítási sikereit és címeit', NULL, 'Pridávanie výstavných úspechov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(217, 'Add breeds list for handling', 'Add your list of breeds for handling', 'Tüntesse fel az Ön által felvezetni kívánt fajtákat', NULL, 'Pridanie zoznamu plemien pre handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(218, 'Add photos', 'Add photos', 'Töltse fel képeit', NULL, 'Pridávanie fotografií', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(219, 'Offer your handling services', 'Offer your handling services', 'Kínálja handler szolgáltatásait', NULL, 'Možnosť ponuky Vašich služieb handlingu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(220, 'Share successes via social networks', 'Share successes via social networks', 'Osztja meg sikereit a többi közösségi hálón', NULL, 'Zdieľanie úspechov prostedníctvom sociálnych sietí', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(221, 'Update cover photo', 'Update cover photo', 'Töltse fel a borítóképét', NULL, 'Aktualizovať titulnú fotku', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(222, 'Upload', 'Upload', 'Töltés', NULL, 'Nahrať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(223, 'Take picture', 'Take picture', 'Készíts fotót', NULL, 'Urobiť snímku', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(224, 'Save Image', 'Save Image', 'Kép mentése', NULL, 'Uložiť obrázok', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(225, 'New Snapshot', 'New Snapshot', 'Új pillanatkép', NULL, 'Nová snímka', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(226, 'Capture', 'Capture', 'Készítés', NULL, 'Odfotiť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(227, 'Cancel', 'Cancel', 'Mégsem', NULL, 'Zrušiť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(228, 'Close', 'Close', 'Bezár', NULL, 'Zavrieť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(229, 'Select profile image', 'Select profile image', 'Profilkép kiválasztása', NULL, 'Zvoliť profilový obrázok', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(230, 'We have puppies', 'We have puppies', 'Vannak kiskutyáink', NULL, 'Máme šteniatka', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(231, 'Add friend', 'Add friend', 'Ismerős hozzáadása', NULL, 'Pridať priateľa', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(232, 'Follow', 'Follow', 'Követés', NULL, 'Sledovať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(233, 'FCI number', 'FCI number', 'FCI szám', NULL, 'FCI číslo', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(234, 'Breeds bred by our kennel', 'Breeds bred by our kennel', 'Fajták, amiket kennelük tenyészt', NULL, 'Plemená chované ', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(235, 'Add', 'Add', 'Hozzáad', NULL, 'Pridať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(236, 'There are currently no added records', 'There are currently no added records', 'Jelenleg nincs hozzáadott bejegyzés', NULL, 'Momentálne nie sú pridané žiadne záznamy', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(237, 'Bitches', 'Bitches', 'Szukák', NULL, 'Feny', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(238, 'Timeline events', 'Timeline events', 'Idővonal események', NULL, 'Časová os', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(239, 'Write a comment', 'Write a comment', 'Írj egy megjegyzést', NULL, 'Napísať komentár', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(240, 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'Simplicity, accessibility, clarity and beautiful graphics of the website have charmed me and I have added my kennel to it. Its overall reach and audience on the web is an excellent presentation of successful individuals and excellent support for real breeders.', 'Egyszerűség, hozzáférhetőség, egyértelműség és a gyönyörű grafika volt az, ami a honlapon elbűvölt, és e-miatt adtam hozzá a kennelemet. Az elérése és a látogatottsága kitűnő a sikeres tenyésztők bemutatására és kiváló támogatást nyújt a valódi tenyésztőknek.', NULL, 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(241, 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'I think it''s a great idea to create a large database of breeders, kennels, stud dogs and handlers. Good luck to you and wish that your database will grow each day and people from the whole world will know about it!', 'Azt hiszem, ez egy jó ötlet létrehozni egy nagy adatbázist a tenyésztőkkel, kennelekkel, tenyészkutyákkal és handlerekkel. Sok szerencsét nektek és azt kívánom, hogy az adatbázis növekedjen minden egyes nappal és az emberek az egész világból tudjanak róla!', NULL, 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(242, 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'Nice and well organized website, user friendly with nice visuals. I enjoy it, it helps me to keep track of my attended dog shows and represent my dogs and kennel.', 'Szép, jól szervezett honlap, user friendly és szép látványt nyújt a felhasználóknak. Nagyon tetszik és segít nekem nyomon követni az eddigi kiállításaimat, képviseli a kutyáimat és kennelemet.', NULL, 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(243, 'Edit award', 'Edit an award', 'Díj módosítása', NULL, 'Upraviť ocenenie', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(244, 'Date of the award', 'Date of the award ', 'Díj időpontja', NULL, 'Dátum získania ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(245, 'Select date when award was obtained', 'Select the date when the award was obtained', 'Válassza ki az időpontot, amikor a díjat nyerte', NULL, 'Vyberte dátum, kedy bolo ecenenie získané', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(246, 'Name of the award', 'Name of the award', 'Díj neve', NULL, 'Názov ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(247, 'Picture', 'Picture', 'Fenykép', NULL, 'Obrázok', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(248, 'Picture of award in jpeg or jpg format', 'Picture of the award in jpeg or jpg format', 'Díj fenyképe jpeg vagy jpg formátumban', NULL, 'Obrázok ocenenia v jpeg alebo jpg formáte', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(249, 'Select picture', 'Select a picture', 'Kép kiválasztása', NULL, 'Zvoliť obrázok', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(250, 'Edit', 'Edit', 'Módosítás', NULL, 'Upraviť', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(251, 'Purebred dogs', 'Purebred dogs', 'Törzskönyves kutyák', NULL, 'Psy s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/list-of-dogs', NULL),
(252, 'Share', 'Share', 'Megosztás', NULL, 'Zdielať', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(253, 'Breed', 'Breed', 'Fajta', NULL, 'Plemeno', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(254, 'Gender', 'Gender', 'Nem', NULL, 'Pohlavie', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(255, 'Date of birth', 'Date of birth', 'Születési dátum', NULL, 'Dátum narodenia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(256, 'Pedigree registration number', 'Pedigree registration number', 'Törzskönyvi szám', NULL, 'Pedigree No', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(257, 'Height at the withers (cm)', 'Height at the withers (cm)', 'Marmagasság (cm)', NULL, 'Výška v kohútiku (cm)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(258, 'Weight (kg)', 'Weight (kg)', 'Súly (kg)', NULL, 'Váha (kg)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(259, 'Country', 'Country', 'Ország', NULL, 'Krajina', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(260, 'Father', 'Father (Sire)', 'Apa ', NULL, 'Otec', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(261, 'Mother', 'Mother (Dam)', 'Anya', NULL, 'Matka', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(262, 'Championships', 'Championships', 'Championátusok', NULL, 'Šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(263, 'Working exams', 'Working exams', 'Munkavizsgák', NULL, 'Pracovné skúšky', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(264, 'Health', 'Health', 'Egészség', NULL, 'Zdravotné záznamy', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(265, 'Pedigree', 'Pedigree ', 'Törzskönyv', NULL, 'Rodokmeň', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(266, 'Matings', 'Matings', 'Fedezések', NULL, 'Krytia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(267, 'Coowners', 'Co-owners', 'Társtulajdonosok', NULL, 'Spolumajitelia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(268, 'Championchips', 'Championships', 'Championátusok', NULL, 'Šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(269, 'Remove from friends', 'Remove from friends', 'Ismerős törlése', NULL, 'Odobrať z priateľov', 'en', 'http://dfs.fsofts.eu/list-of-kennels', NULL),
(270, 'Website', 'Website', 'Weboldal', NULL, 'Webstránka', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=2', NULL),
(271, 'Delete', 'Delete', 'Törlés', NULL, 'Odstrániť', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(272, 'Bitch', 'Bitch', 'Szuka', NULL, 'Fena', 'en', 'http://dfs.fsofts.eu/dog-profile?id=1', NULL),
(273, 'Class', 'Class', 'Osztály', NULL, 'Trieda', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(274, 'Champion', 'Champion', 'Champion', NULL, 'Šampión', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(275, 'Judge', 'Judge', 'Bíró', NULL, 'Rozhodca', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(276, 'This feature is unavailable to view on small screens', 'This feature is unavailable to view on small screens', 'Ez a szolgáltatás nem elérhető megtekinteni kis képernyőn', NULL, 'Táto funkcia nie je prístupná pre zariadenia s malým rozlíšením obrazovky', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(277, 'Name of the father', 'Name of the father (sire)', 'Apa neve', NULL, 'Meno otca', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(278, 'Add championchip', 'Add championship', 'Championátus hozzáadása', NULL, 'Pridať šampionát', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(279, 'Date of Championship award', 'Date of the Championship award', 'Championátus időpontja', NULL, 'Dátum získania šampionátu', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(280, 'Select date when the championship was awarded', 'Select date when the championship was awarded', 'Válassza ki az időpontot, amikor a Championátust megszerezte', NULL, 'Vyberte dátum, kedy bolo šampionát získaný', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(281, 'Championship', 'Championship', 'Championátus', NULL, 'Šampionát', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(282, 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Enter the championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Írja be a championátust (pl. Junior Champion of Slovakia). Kérjük, írjon csak egy címet egy időben a jobb érthetőség végett.', NULL, 'Zadajte názov šampionátu (napr. Junior šampión Slovenska). Pre lepšiu prehľadnosť zadávajte prosím naraz iba jeden šampionát ', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(283, 'Junior champion of Hungary', 'Junior Champion of Hungary', 'Hungária Junior Champion', NULL, 'Junior šampión Maďarska', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(284, 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Kép feltöltése (pl.a diplomáról, bizonyítványról - jpeg vagy jpg formátumban) Ez a mező nem kötelező', NULL, 'Nahrajte obrázok (diplom alebo certifikát vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(285, 'Edit championship', 'Edit the championship', 'Championátus módosítása', NULL, 'Úprava šampionátu', 'en', 'http://dfs.fsofts.eu/dog-championschip-edit?id=1&dog_id=1', NULL),
(286, 'Edit show result', 'Edit the show result', 'Kutyakiállítás eredmény módosítása', NULL, 'Úprava výstavného výsledku', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(287, 'Date of show', 'Date of the show', 'Kutyakiállítás időpontja', NULL, 'Dátum výstavy', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(288, 'Select the date on which the show was held', 'Select the date on which the show was held', 'Válassza ki az időpontot, amikor a kutyakiállítás tartott', NULL, 'Vyberte dátum, kedy sa výstava konala', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(289, 'Add show result', 'Add show result', 'Kutyakiállítási eredmény hozzáadása', NULL, 'Pridanie výstavného výsledku', 'en', 'http://dfs.fsofts.eu/dog-show-add?dog_id=1', NULL),
(290, 'Edit working exam', 'Edit the working exam', 'Munkavizsga módosítása', NULL, 'Úprava pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(291, 'Date exam passed', 'Date of passed exam', 'Munkavizsga időpontja', NULL, 'Dátum absolvovania pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(292, 'Enter the date working exam completed', 'Enter the date when working exam was completed', 'Válassza ki az időpontot, amikor a munkavizsgát megszerezte', NULL, 'Vyberte dátum absolvovania pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(293, 'Type of exam', 'Type of the exam', 'Munkavizsga típusa', NULL, 'Typ pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(294, 'Enter the type of working exam (e.g. IPO 1)', 'Enter the type of working exam (e.g. IPO 1)', 'Írja be a munkavizsga típusát (pl. IPO 1)', NULL, 'Zadajte názov alebo typ pracovnej skúšky (napríklad IPO1)', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(295, 'For example IPO 1', 'For example IPO 1', 'Pl. IPO 1', NULL, 'napríklad IPO1', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(296, 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Upload the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Kép feltöltése (pl.a diplomaról, bizonylatról - jpeg vagy jpg formátumban) Ez a mező nem kötelező', NULL, 'Nahrajte obrázok (diplom alebo certifikát vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(297, 'Add working exam', 'Add working exam', 'Munkavizsga hozzáadása', NULL, 'Pridanie pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-add?dog_id=1', NULL),
(298, 'Add health record', 'Add health record', 'Egészségügyi szűrés hozzáadása', NULL, 'Pridanie zdravotného záznamu', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(299, 'Date of the health record', 'Date of the health record', 'Egészségügyi szűrés időpontja', NULL, 'Dátum zdravotného vyšetrenia', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(300, 'Enter the date the health record was issued', 'Enter the date when health record was issued', 'Válassza ki az időpontot, amikor az egészségügyi szűrést megcsináltatta', NULL, 'Vyberte dátum kedy bolo zdravotné vyšetrenie absolvované', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(301, 'Description of the health record', 'Description of the health record', 'Egészségügyi szűrés leírása', NULL, 'Typ zdravotného vyšetrenia', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(302, 'Enter a description or type of health record (e.g. HD, ED)', 'Enter a description or type of health record (e.g. HD, ED)', 'Írja be az egészségügyi szűrés típusát (pl. HD/csípő diszplázia, ED/könyök diszplázia)', NULL, 'Zadajte popis alebo ty zdravotného vyšetrenia (napríklad HD, ED)', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(303, 'Hip Dysplasia', 'Hip Dysplasia', 'Csípő diszplázia', NULL, 'napríklad HD A/A', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(304, 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Upload the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Kép feltöltése (pl.az egészségügyi szűrésről - jpeg vagy jpg formátumban) Ez a mező nem kötelező', NULL, 'Nahrajte obrázok (zdravotný záznam vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(305, 'Add mating', 'Add mating', 'Fedezés hozzáadása', NULL, 'Pridanie krytia', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(306, 'Date of mating', 'Date of mating', 'Fedezés időpontja', NULL, 'Dátum krytia', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(307, 'Enter the date, when the mating was', 'Enter the date when mating was accomplished', 'Válassza ki az időpontot, amikor a fedezés megtörtént', NULL, 'Vyberte dátum, kedy prebehlo krytie', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL);
INSERT INTO `tbl_import` (`id`, `text_to_translate`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(308, 'Name of the bitch', 'Name of the bitch', 'Szuka neve', NULL, 'Meno suky', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(309, 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'Please enter the bitch''s name or select the bitch from the DOGFORSHOW database for interactivity', 'Kérjük, adja meg a szuka nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', NULL, 'Zadajte meno suky alebo vyberte meno suky z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(310, 'Picture of the bitch', 'Picture of the bitch', 'Szuka fenyképe', NULL, 'Obrázok suky', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(311, 'Record the bitch picture in jpg or jpeg format. This field is optional', 'Upload the bitch''s picture in jpg or jpeg format. This field is optional', 'Kép feltöltése a szukától jpeg vagy jpg formátumban. Ez a mező nem kötelező', NULL, 'Nahrajte obrázok suky vo formáte jpg alebo jpeg. Obrázok nie je povinný', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(312, 'Edit dog profile', 'Edit the dog''s profile', 'Kutya adatlapja módosítása', NULL, 'Upraviť profil psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(313, 'Informations', 'Informations', 'Információk', NULL, 'Informácie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(314, 'Pictures', 'Pictures', 'Fenyképek', NULL, 'Obrázky', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(315, 'Basic informations about your dog', 'Basic informations about your dog', 'Alapvető információk a kutyájáról', NULL, 'Základné informácie o vašom psovi', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(316, 'Select the dog’s gender', 'Select the dog’s gender', 'Válassza ki a kutya nemét', NULL, 'Vyberte pohlavie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(317, 'Dog', 'Dog', 'Kutya', NULL, 'Pes', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(318, 'Offer your dog for mating', 'Offer your dog as a stud dog', 'Kínálja kutyáját fedezésre', NULL, 'Ponúknuť psa na krytie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(319, 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'This option is available only for males. After checking this option, your dog will be automatically added also to the list of stud dogs.', 'Ez a lehetőség csak a kanok számára elérhető. Ha él ezzel a lehetőséggel, akkor a tenyészkanja automatikusan bekerül a többi tenyészkan közé.', NULL, 'Táto možnosť môže byť vybraná iba v prípade, že pohlavie jedinca je pes', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(320, 'Yes', 'Yes', 'Igen', NULL, 'Áno', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(321, 'Select breed', 'Select breed', 'Fajta kiválasztása', NULL, 'Vyberte plemeno', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(322, 'Choose a breed from the list.', 'Choose the breed from the list.', 'Válasszon egy fajtát a listából.', NULL, 'Vyberte plemeno zo zoznamu ', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(323, 'Please select', 'Please select', 'Kérem válasszon', NULL, 'Vyberte si', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(324, 'Dog name', 'Dog''s name', 'Kutya neve', NULL, 'Meno psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(325, 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'Enter your dog’s name which is shown in the pedigree certificate. Please don''t fill any championships before the name.', 'Adja meg a kutya nevét, ami a törzskönyvében szerepel. Kérjük, ne írjon semmi championátust a neve elé.', NULL, 'Zadajte meno psa tak, ako má uvedené v preukaze o pôvode psa. Pred menom nevypĺňajte žiadne dosiahnuté šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(326, 'Dog name as shown in the pedigree', 'Dog name which is shown in the pedigree', 'Kutya neve ami a törzskönyvében szerepel.', NULL, 'Meno psa ako je uvedené v rodokmeni', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(327, 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number which is shown in the pedigree certificate', 'Írja be a törzskönyvi jelét (pl. LOSM, SPKP, CSHPK) és ezután írja be a törzskönyvi számát, ami látható a törzskönyvében', NULL, 'Zadajte zápis v plemenej knihe v tvare (napríklad LOSM, SPKP, CMKU, CSHPK) a následne registračné číslo', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(328, 'For example SPKP 2667', 'For example SPKP 2667', 'Pl. SPKP 2667', NULL, 'napríklad SPKP 2667', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(329, 'Day, month and year of birth of your dog', 'Day, month and year of birth of your dog', 'Kutya születési dátuma (nap, hónap, év)', NULL, 'Deň, mesiac a rok narodenia psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(330, 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'Enter the height at withers in centimeters. This information is very useful for people who are using the searching of dogs for mating with some specific height in withers', 'Tüntesse fel a marmagasságot centiméterben. Ez az információ nagyon hasznos azok számára, akik használják a keresést és konkrét magasság érdekli őket.', NULL, 'Zadajte výšku v kohútiku v centimetroch. Táto informácia je veľmi užitočná pre ľudí, ktorí hľadajú napríklad psov na krytie so špecifickou výškou', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(331, 'Height at the withers in centimeters', 'Height at the withers in centimeters', 'Marmagasság centiméterben', NULL, 'Výsška v kohútiku v centimetroch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(332, 'Enter your dog’s weight in kilograms', 'Enter your dog’s weight in kilograms', 'Tüntesse fel a kutyája súlyát kilogramban', NULL, 'Zadajte váhu psa v kilogramoch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(333, 'Weight of dog in kilograms', 'Weight of the dog in kilograms', 'Kutya súlya kilogramban', NULL, 'Váha psa v kilogramoch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(334, 'Country in which the dog is currently located', 'Country in which the dog is currently located', 'Ország ahol a kutya tartózkodik', NULL, 'Názov štátu v ktorom sa pes momentálne nachádza', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(335, 'Father of the dog', 'Father (sire) of the dog', 'Kutya apja', NULL, 'Otec psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(336, 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter the father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Kérjük, adja meg a kutya apja nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', NULL, 'Zadajte meno otca psa alebo vyberte meno otca psa z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(337, 'Mother of the dog', 'Mother (dam) of the dog', 'Kutya anyja', NULL, 'Matka psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(338, 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter the mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Kérjük, adja meg a kutya anyja nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', NULL, 'Zadajte meno matky psa alebo vyberte meno matky psa z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(339, 'Dog profile picture', 'Dog''s profile picture', 'Kutya profilképe', NULL, 'Profilový obrázok psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(340, 'Upload a profile image of your dog in JPG or PNG format', 'Upload a profile image of your dog in JPG or PNG format', 'Profilkép feltöltése JPG vagy PNG formátumban', NULL, 'Nahrajte profilový obrázok psa vo formáte jpg alebo jpeg', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(341, 'Please select state...', 'Please select the state...', 'Kérem válasszon országot', NULL, 'Prosím vyberte štát', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(342, 'Add coowner', 'Add co-owner', 'Társtulajdonos hozzáadása', NULL, 'Pridanie spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(343, 'Name of the coowner', 'Name of the co-owner', 'Társtulajdonos neve', NULL, 'Meno spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(344, 'Name and surname of co-owner', 'Name and surname of the co-owner', 'Társtulajdonos keresztneve és vezetékneve', NULL, 'Meno a priezvisko spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(345, 'Please select country, where are the co-owner situated', 'Please select country where the co-owner lives', 'Kérem válasszon országot, ahol a társtulajdonos lakik', NULL, 'Prosím vyberte štát, v ktorom sa spolumajiteľ nachádza', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(346, 'Add award', 'Add award', 'Díj hozzáadása', NULL, 'Pridanie ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-add', NULL),
(347, 'Password change', 'Password change', 'Jelszócsere', NULL, 'Zmeniť heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(348, 'Account informations', 'Account informations', 'Fiók beállitások', NULL, 'Informácie o účte', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(349, 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Információk jelöltek ezzel a jellel nem lesznek hozzáférhetők a nyilvánosságnak vagy nem lesznek kereskedelmi használatra felhasználva harmadik fél által', NULL, 'Informácie označené týmto symbolom nebudú sprístupnené verejnosti alebo zneužívané pre komerčné účely tretích strán', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(350, 'Your name without numeric signs', 'Your name without numeric signs', 'Az Ön neve numerikus jelek nélkül', NULL, 'Vaše meno bez číslic', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(351, 'Your surname without numeric signs', 'Your surname without numeric signs', 'Az Ön vezetékneve numerikus jelek nélkül', NULL, 'Vaše priezvisko bez číslic', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(352, 'Country where you live', 'Country where you live', 'Az ország, ahol él', NULL, 'Štát v ktorom žijete', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(353, 'Additional account informations', 'Additional account informations', 'További fiók információk', NULL, 'Doplnkové informácie o účte', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(354, 'Address', 'Address', 'Cím', NULL, 'Adresa', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(355, 'Your address', 'Your address', 'Az Ön címe', NULL, 'Vaša adresa', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(356, 'Town', 'Town', 'Város', NULL, 'Mesto', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(357, 'Town where you live', 'Town where you live', 'A város ahol él', NULL, 'Mesto v ktorom žijete', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(358, 'ZIP', 'ZIP', 'Irányítószám', NULL, 'PSČ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(359, 'Enter the zip code of the place where you live', 'Enter the zip code of the place where you live', 'Tüntesse fel a hely irányítószámát, ahol él', NULL, 'Zadajte poštové smerovacie číslo ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(360, 'Phone number', 'Phone number', 'Telefonszám', NULL, 'Telefónne číslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(361, 'Your phone number', 'Your phone number', 'Az Ön telefonszáma', NULL, 'Zadajte telefóne číslo v medzinárodnom tvare napríklad +42xxxxxxxxxx', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(362, 'Year of birth', 'Year of birth', 'Születési év', NULL, 'Rok narodenia', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(363, 'Your year of birth', 'Your year of birth', 'Az Ön születési éve', NULL, 'Váš rok narodenia', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(364, 'Save', 'Save', 'Mentés', NULL, 'Uložiť', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(365, 'Old password', 'Old password', 'Régi jelszó', NULL, 'Staré heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(366, 'Type your old password', 'Type your old password', 'Írja be a régi jelszavát', NULL, 'Zadajte vaše staré heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(367, 'New password', 'New password', 'Új jelszó', NULL, 'Nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(368, 'Type your new password', 'Type your new password', 'Írja be az új jelszavát', NULL, 'Zadajte vaše nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(369, 'Confirm new password', 'Confirm new password', 'Erősítse meg az új jelszót', NULL, 'Potvrďte vaše nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(370, 'Confirm your new password', 'Confirm your new password', 'Erősítse meg az új jelszavát', NULL, 'Zadajte ešte raz vaše nové heslo ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(371, 'Basic informations about your kennel', 'Basic informations about your kennel', 'Alapvető információk a kenneléről', NULL, 'Základné informácie o vašej chovateľskej stanici', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(372, 'Kennel name', 'Kennel name', 'Kennel név', NULL, 'Názov chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(373, 'Name of your kennel', 'Name of your kennel', 'A kennel neve', NULL, 'Zadajte názov vašej chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(374, 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Írja be az FCI számot ebben a formátumban - 1580/2015. Ha nem FCI kennel, kérjük hagyja üresen a mezőt', NULL, 'Zadajte FCI číslo chovateľskej stanice v tvare napríklad 1580/2015. Pokiaľ nie ste FCI chovateľská stanica, nevypĺňajte toto pole', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(375, 'Kennel website', 'Kennel''s website', 'Kennel weboldala', NULL, 'Webstránka vašej chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(376, 'Enter the website of your kennel', 'Enter the website of your kennel', 'Tüntesse fel a kennel weboldalát', NULL, 'Zadajte adresu webstránky vašej chovateľskej stanice v tvare www.vasastranka.com', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(377, 'www.yourwebsite.com', 'www.yourwebsite.com', NULL, NULL, '', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(378, 'Kennel description', 'Kennel''s description', 'Kennel leírása', NULL, 'Popis chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(379, 'Enter information about your kennel', 'Enter some informations about your kennel', 'Tüntessen fel valami információt kenneléről', NULL, 'Zadajte informácie o vašej chovateľskej stanici', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(380, 'Select the breed bred by your kennel', 'Select the breed(s) bred by your kennel', 'Válasszon fajtát (fajtákat) amiket kennelük tenyészt', NULL, 'Vyberte plemeno, ktorého chovu sa venuje vaša chovateľská stanica', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(381, 'Choose one ore more breeds bred by your kennel', 'Choose one or more breeds bred by your kennel', 'Válasszon egy vagy több fajtát, amiket kennelük tenyészt', NULL, 'Vyberte zo zoznamu plemien jedno alebo viacej plemien ktorého chovu sa venuje vaša chovateľská stanica', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(382, 'Owner of purebred dog profile', 'Owner of purebred dog''s profile', 'Kutya tulajdonos adatlapja', NULL, 'Majiteľ psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(383, 'Basic informations about you', 'Basic informations about you', 'Alapvető információk Önről', NULL, 'Základné ifnormácie o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(384, 'Your profile picture', 'Your profile picture', 'Az Ön profilképe', NULL, 'Váš profilový obrázok', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(385, 'Your profile picture in jpeg or jpg format', 'Your profile picture in jpeg or jpg format', 'Az Ön profilképe jpeg vagy jpg formátumban', NULL, 'Nahrajte váš profilový obrázok vo formáte jpg alebo jpeg', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(386, 'Short description about you', 'Short description about you', 'Rövid leírás Önről', NULL, 'Krátky popis o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(387, 'Enter some informations about yourself', 'Enter some informations about yourself', 'Tüntessen fel valami információt Önről', NULL, 'Zadajte krátky popis o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(388, 'Short description', 'Short description', 'Rövid leírás', NULL, 'Krátky popis', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(389, 'Add a dog', 'Add a dog', 'Kutya hozzáadása', NULL, 'Pridať psa', 'en', 'http://dfs.fsofts.eu/add-dog', NULL),
(390, 'Available for mating', 'Available for stud ', 'Fedezésre rendelkezésre álló', NULL, 'Ponuka na krytie', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=1&_fid=mbbn', NULL),
(391, 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'Your user account has not been activated yet. Please confirm by clicking on the link in your email to fully activate your account. You can resend it by clicking on following link', 'Az Ön felhasználói fiókja nincs még aktiválva. Kérjük, erősítse meg egy kattintással az e-mail-ben szerepelő linkre, hogy teljes mértékben aktiválja fiókját. Úrja küldheti egy kattintással a linkre.', NULL, 'Váš užívateľský účet nie je aktivovaný. Aktivujte ho prosím kliknutím na odkaz, ktorý vám bol odoslaný v registračnom emaily. Váš registračný email si môžete znova preposlať kliknutím na nasledujúci odkaz.', 'en', 'http://localhost/dfs/index.php', NULL),
(392, 'Resend registration email', 'Resend activation email', 'E-mail újraküldése', NULL, 'Preposlať registračný email', 'en', 'http://localhost/dfs/index.php', NULL),
(393, 'Welcome to DOGFORSHOW', 'Welcome to DOGFORSHOW', 'Üdvözöljük a DOGFORSHOW oldalon', NULL, 'Vitajte na DOGFORSHOW', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(394, 'Hello', 'Hello', 'Szia', NULL, 'Ahoj', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(395, 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Köszönjük regisztrációját a DOGFORSHOW oldalon. Kérjük aktiválja fiókját egy kattintással a következő linkre.', NULL, 'Ďakujeme za registráciu na portáli DOGFORSHOW. Aktivujte si účet kliknutím na nasledujúci odkaz', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(396, 'Activate account', 'Account activation', 'Fiók aktiválása', NULL, 'Aktivovať účet', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(397, 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'This is an automatically generated email sent by the DOGFORSHOW system, please do not reply to this message.', 'Ez egy automatikusan generált e-mail a DOGFORSHOW-tól, kérjük, ne válaszoljon erre az üzenetre.', NULL, 'Tento email bol odoslaný automaticky systémom DOGFORSHOW. Prosíme Vás neodpovedajte na tento email', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(398, 'Wrong username or password.', 'Incorrect username or password', 'Hibás felhasználónév vagy jelszó', NULL, 'Zle zadané užívateľské meno alebo heslo', 'en', 'http://www.dogshow.com/index.php', NULL),
(399, 'Your registration has been successfully completed', 'Your registration has been completed successfully.', 'A regisztráció sikeresen befejeződött.', NULL, 'Vaša registrácia bola úspešne ukončená', 'en', 'http://www.dogshow.com/index.php', NULL),
(400, 'Please check your Email for your user acccount activation', 'Please check your email to activate your user account', 'Kérjük ellenőrizze, hogy regisztrációja során megadott e-mail címére érkezett levelét látta-e, és rákattintott-e az aktiváló linkre', NULL, 'Skontrolujte si prosím email pre aktiváciu účtu', 'en', 'http://www.dogshow.com/index.php', NULL),
(401, 'If you have not received the Email yet, please also check your SPAM folder', 'If you have not received the email yet, please also check your SPAM folder', 'Ha még nem kapta meg az e-mail, kérjük, ellenőrizze a spam mappát is', NULL, 'Ak ste email ešte neobdržali, skontrolujte si prosím priečinok SPAM alebo nevyžiadanú poštu', 'en', 'http://www.dogshow.com/index.php', NULL),
(402, 'Kennel profile', 'Kennel''s profile', 'Kennel adatlapja', NULL, 'Profil chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(403, 'Kennel profile picture', 'Kennel''s profile picture', 'Kennel profilképe', NULL, 'Profilový obrázok chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(404, 'Profile picture of your kennel in jpeg or jpg format', 'Profile picture of your kennel in jpeg or jpg format', 'Profilkép feltöltése jpeg vagy jpg formátumban', NULL, 'Profilový obrázok chovateľskej stanice vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(405, 'Enter some informations about your kennel', 'Enter some informations about your kennel', 'Tüntessen fel valami információkat kenneléről', NULL, 'Zadajte informácie alebo stručný popis o vašej chovateľskej stanici', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(406, 'Owner', 'Owner', 'Tulajdonos', NULL, 'Majiteľ psa s preukazom pôvodu', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(407, 'About me', 'About me', 'Rólam', NULL, 'O mne', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(408, 'Name of the kennel', 'Name of the kennel', 'Kennelnév', NULL, 'Názov chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(409, 'Name of the planned litter', 'Name of the planned litter', 'Tervezett alom neve', NULL, 'Názov plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(410, 'Planned litter', 'Planned litter ', 'Tervezett alom', NULL, 'Plánovaný vrh', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(411, 'Scheduled date of birth of the puppies', 'Scheduled date of birth of the puppies', 'Kiskutyák tervezett születési dátuma', NULL, 'Plánovaný dátum narodenia šteniatok', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(412, 'Add puppies', 'Add puppies', 'Kiskutyák hozzáadása', NULL, 'Pridať šteňiatko', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(413, 'View detail', 'View details', 'Részletek megtekintése', NULL, 'Zobraziť detail', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(414, 'Puppies', 'Puppies', 'Kiskutyák', NULL, 'Šteniatká', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(415, 'Edit awards', 'Edit awards ', 'Díjak szerkesztése', NULL, 'Upraviť ocenenia', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(416, 'Remove from timeline', 'Remove from timeline', 'Eltávolítás az idővonalról', NULL, 'Odstrániť z časovej osi', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(417, 'Like', 'Like', 'Tetszik', NULL, 'Páči sa mi', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(418, 'Profile updated', 'Profile updated', 'Adatlap frissítve', NULL, 'Profil aktualizovaný', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000&_fid=9dff', NULL),
(419, 'Add awards', 'Add awards', 'Díj hozzáadása', NULL, 'Pridať ocenenia', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000', NULL),
(420, 'Add show', 'Add a show', 'Kutyakiállítás hozzáadása', NULL, 'Pridať výstavu', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(421, 'Add result', 'Add a result', 'Eredmény hozzáadása', NULL, 'Pridať výsledok', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(422, 'Delete messages', 'Delete messages', 'Üzenetek törlése', NULL, 'Zmazať správy', 'en', 'http://www.dogshow.com/message-list', NULL),
(423, 'Type your message', 'Type your message', 'Írja be az üzenetet', NULL, 'Napísať správu', 'en', 'http://www.dogshow.com/message-compose', NULL),
(424, 'Breed list does not contain entered breed', 'Breed list does not contain the entered breed', 'A lista nem tartalmazza a beírt fajtát', NULL, 'Zoznam plemien neobsahuje zadané plemeno', 'en', 'http://www.dogshow.com/kennel-edit-profile', NULL),
(425, 'Respected breeder, judge, writer', 'Respected breeder, judge, writer', 'Tisztelt tenyésztő, bíró, író', NULL, 'Rešpetkovaný chovateľ, rozhodca, spisovateľ', 'en', 'http://www.dogshow.com/index.php', NULL),
(426, 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'Nagyon tetszik a minőség, amit eddig láttam a DOGFORSHOW oldalon. Sok aktív tagot kívánok a honlapnak, mivel biztos vagyok benne, hogy még sok jót fog hozni és nem csak a kutya tulajdonosoknak, vagy más kutyás embernek. ', NULL, 'Som naozaj zaujatý kvalitou toho, čo som videl na portáli DOGFORSHOW. Želám stránke veľký úspech pretože som si istý, že je veľkým prínosom či už majiteľom psov alebo iným osobám.', 'en', 'http://www.dogshow.com/index.php', NULL),
(427, 'Unlike', 'Dislike', 'Nem tetszik', NULL, 'Nepáči sa mi', 'en', 'http://www.dogshow.com/timeline', NULL),
(428, 'For sale', 'For sale ', 'Eladó', NULL, 'Na predaj', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(429, 'Reserved', 'Reserved', 'Foglalt', NULL, 'Rezervované', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(430, 'Sold', 'Sold', 'Eladott', NULL, 'Predané', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(431, 'Search', 'Search', 'Keresés', NULL, 'Hľadať', 'en', 'http://www.dogshow.com/list-of-owners', NULL),
(432, 'Edit a dog', 'Edit a dog', 'Kutya szerkesztése', NULL, 'Upraviť psa', 'en', 'http://www.dogshow.com/dog-profile-edit?id=500000000&dog_id=500000000', NULL),
(433, 'Show type', 'Show type', 'Kutykiállítás típusa', NULL, 'Druh výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(434, 'Select type of exhibition', 'Select the type of the exhibition', 'Válassza ki a kiállítás típusát', NULL, 'Vyberte druh výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(435, 'Name of the show', 'Name of the show', 'Kiállítás neve', NULL, 'Názov výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(436, 'Enter the name of show (e.g. World dog show Budapest)', 'Enter the name of the show (e.g. World Dog Show Budapest)', 'Tüntesse fel a kiállítás nevét (pl. World Dog Show Budapest)', NULL, 'Zadajte názov výstavy (napr. Svetová výstava Budapešť)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(437, 'Enter the show name', 'Enter the name of the show', 'Tüntesse fel a kiállítás nevét ', NULL, 'Zadajte názov výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(438, 'Select country in which show was held', 'Select the country in which the show was held', 'Válassza ki az országot, ahol a kiállítás meg volt rendezve', NULL, 'Vyberte krajinu v ktorej sa výstava konala', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(439, 'Name of judge', 'Name of the judge', 'Bíró neve', NULL, 'Meno rozhodcu', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(440, 'Enter the judge’s name', 'Enter the judge’s name', 'Tüntesse fel a bíró nevét', NULL, 'Zadajte meno rozhodcu', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(441, 'Name of handler', 'Name of the handler', 'Handler neve', NULL, 'Meno handlera', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(442, 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'Enter the handler’s name or select the handler from the DOGFORSHOW database for interactivity. If you do not have any handler, please just leave this field empty', 'Tüntesse fel a handler nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából. Ha nem volt handler, csak hagyja üresen ezt a mezőt', NULL, 'Zadajte meno handlera alebo vyberte handlera z databázy DOGFORSHOW pre možnosť prepojenia.Pokiaľ ste nemali handlera, nevyplňujte toto pole', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(443, 'Enter the handler’s name', 'Enter the handler’s name', 'Tüntesse fel a handler nevét', NULL, 'Zadajte meno handlera', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(444, 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'Choose the class: Minor Puppy (3-6 months), Puppy (6-9 months), Junior(9-18 months), Intermediate (15-24 months), Open (from 15 months), Working (from 15 months, with a working exam), Champions (from 15 months with ICH or CH title), Veteran (from 8 years), Honor (from 15 months with title ICH, CH, Club Winner, National Winner)', 'Válasszon az osztályt: Minor Puppy (3-6 hónapos korig), Kölyök (6-9 hónapos korig), Fiatal (9-18 hónapos korig), Növendék (15-24 hónapos korig), Nyílt (15 hónapos kortól), Munka (15 hónapos kortól, munkavizsga köteles), Champion (15 hónapos kortóI, CH vagy CH cím köteles), Veterán (8 éves kortól), Honor (15 hónapos kortól, ICH, CH, Klubgyőztes, vagy Országos győztes cím köteles)', NULL, 'Vyberte si triedu Mladší dorast (3-6 mesiacov), Dorast (6-9 mesiacov), Mladí (9-18 mesiacov), Stredná (15-24 mesiacov), Otvorená (od 15 mesiacov), Pracovná (od 15 mesiacov so skúškou z výkonu), Šampióni (od 15 mesiacov s titulom ICH alebo CH), Veteráni (od 8 rokov), Čestná (od 15 mesiacov s titulom ICH,CH,Klubový víťaz,Národný víťaz)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(445, 'Assesment', 'The written critique', 'Szöveges leírás', NULL, 'Hodnotenie', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(446, 'Best minor puppy', 'Best Minor Puppy', 'Legjobb Minor Puppy', NULL, 'Best minor puppy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(447, 'Best puppy male & female', 'Best Puppy Male & Female', 'Legjobb Puppy Kan & Szuka', NULL, 'Best puppy male & female', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(448, 'Titles', 'Titles', 'Címek', NULL, 'Tituly', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(449, 'Junior Best of Group', 'Junior Best of Group', 'Fiatal Best of Group', NULL, 'Junior Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(450, 'Junior Best in Show', 'Junior Best in Show', 'Fiatal Best in Show ', NULL, 'Junior Best in Show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(451, 'Best of Group', 'Best of Group', 'Best of Group', NULL, 'Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(452, 'Other titles and awards received at the show', 'Other titles and awards achieved at the show', 'Egyéb elért címek és díjak a kiállításon', NULL, 'Iné obdržané ocenenia v rámci výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(453, 'Enter other titles achieved at this show', 'Enter other titles achieved at this show', 'Tüntesse fel az egyéb elért címeket a kiállításról', NULL, 'Zadajte iné obdržané tituly a čakateľstvá v rámci zadanej výstavy ', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(454, 'e.g. National Winner', 'e.g.National Winner', 'pl. Országos győztes', NULL, 'napr. Národný víťaz', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(455, 'Image from show', 'Image from the show', 'Fenykép a kiállításról', NULL, 'Obrázok z výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(456, 'Record the picture from show in jpg or jpeg format. This field is optional', 'Add the picture from the show in jpg or jpeg format. This field is optional', 'Kiállítási fenykép feltöltése jpeg vagy jpg formátumban', NULL, 'Nahrajte obrázok z výstavy vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(457, 'Add planned litter', 'Add planned litter', 'Tervezett alom hozzáadása', NULL, 'Pridanie plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(458, 'Name of the litter or litter ranking', 'Name of the litter or litter ranking', 'Az alom neve vagy az alom betűje', NULL, 'Názov alebo písmeno plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(459, 'Enter the name of the litter or enter the letter of planned litter', 'Enter the name of the litter or enter the letter of the planned litter', 'Tüntesse fel az alom nevét, vagy betűjét, amivel a tervezett alom fog kezdődni', NULL, 'Zadajte názov alebo písmeno plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(460, 'Enter indicative month of birth of puppies as information for prospective buyers', 'Enter the planned month of birth of puppies as information for prospective buyers', 'Tüntesse fel kiskutyák tervezett születési hónapját, hogy tudja informálni a leendő vásárlókat', NULL, 'Zadajte orientačný dátum narodenia šteniatok ako informáciu pre potencionálnych záujemcov', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(461, 'Enter dog’s name', 'Enter the dog’s name', 'Tüntesse fel a kutya nevét', NULL, 'Zadajte meno psa', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(462, 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Enter the dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Tüntesse fel a kutya nevét, vagy válassza ki őt a DOGFORSHOW interaktív adatbázisából', NULL, 'Zadajte meno psa alebo vyberte psa z databázy DOGFORSHOW pre možnosť prepojenia', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(463, 'Picture of the dog', 'Picture of the dog', 'Kutyáról készült fenykép', NULL, 'Obrázok psa', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(464, 'Upload or change profile picture of the dog in jpg or jpeg format', 'Upload or change the profile picture of the dog in jpg or jpeg format', 'Töltse fel vagy cserélje ki a kutya profilképét JPG vagy JPEG formátumban', NULL, 'Nahrajte alebo zmeňte obrázok psa vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(465, 'Please select the name of the bitch', 'Please select the name of the bitch', 'Kérjük, válassza ki a szuka nevét', NULL, 'Vyberte meno suky', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(466, 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'Please select one of your added bitches. If you do not have any bitch to select, you have to add the bitch to the list of your dogs first', 'Kérjük, válasszon egyet a hozzáadott szukákból. Ha nincs lehetősége választani, először hozzá kell adni a szukát a többi kutya közé.', NULL, 'Vyberte meno suky zo zoznamu. Pokiaľ sa v zozname nenachádza meno suky, musíte si ju najprv pridať do zoznamu vašich psov', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(467, 'Upload or change profile picture of the bitch in jpg or jpeg format', 'Upload or change the profile picture of the bitch in jpg or jpeg format', 'Töltse fel vagy cserélje ki a szuka profilképét JPG vagy JPEG formátumban', NULL, 'Nahrajte alebo zmeňte obrázok suky vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(468, 'Name of planned litter can''t be empty', 'The field of the name of the planned litter cannot be empty', 'Mező a tervezett alom nevével nem maradhat üres', NULL, 'Názov plánovaného vrhu nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(469, 'Dog name can''t be empty', 'The field of the dog''s name cannot be empty', 'Mező a kutya nevével nem maradhat üres', NULL, 'Meno psa nemôže byť prázdne', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(470, 'Dog image can''t be empty', 'The field of the dog''s image cannot be empty', 'Mező a kutya fenyképével nem maradhat üres', NULL, 'Obrázok psa nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(471, 'Bitch name can''t be empty', 'The field of the bitch''s name cannot be empty', 'Mező a szuka nevével nem maradhat üres', NULL, 'Meno suky nemôže byť prázdne', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(472, 'Bitch image can''t be empty', 'The field of the bitch''s image cannot be empty', 'Mező a szuka fenyképével nem maradhat üres', NULL, 'Obrázok suky nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(473, 'Please select state', 'Please select your state', 'Kérem válasszon országot', NULL, 'Prosím vyberte štát', 'en', 'http://www.dogshow.com/index.php', NULL),
(474, 'Name and Surname cannot left blank', 'The fields of the name and surname cannot be empty', 'Mezők a kereszt- és vezetéknevével nem maradhatnak üresek', NULL, 'Meno a priezvisko nemôžu byť prázdne', 'en', 'http://www.dogshow.com/index.php', NULL),
(475, 'Password and confirm password does not match', 'Password does not match the confirm password', 'A jelszó és a megerősítése nem egyezik', NULL, 'Heslo a potvrdenie hesla sa musia zhodovať', 'en', 'http://www.dogshow.com/index.php', NULL),
(476, 'Fields Name and Surname cannot contains digits', 'The fields of the name and surname cannot contain numeric signs', 'Mezők a kereszt- és vezetéknevével nem tartalmazhatnak numerikus jeleket', NULL, 'Meno a priezvisko nesmú obsahovať číselné znaky', 'en', 'http://www.dogshow.com/index.php', NULL),
(477, 'Email cannot left blank', 'The field of the email cannot be empty', 'Mező a email címmel nem maradhat üres', NULL, 'Email nemôže byť prázdny', 'en', 'http://www.dogshow.com/index.php', NULL),
(478, 'Profile created', 'Profile created', 'Adatlap létrehozva', NULL, 'Profil vytvorený', 'en', 'http://www.dogshow.com/kennel-profile?id=1&_fid=hpgn', NULL),
(479, 'Select or enter the name of the dog', 'Select or enter the name of the dog', 'Válassza ki vagy írja be a kutya nevét', NULL, 'Vyberte alebo zadajte meno psa', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(480, 'Name of the dog', 'Name of the dog', 'Kutya neve', NULL, 'Meno psa', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(481, 'Name of the mother', 'Name of the mother (dam)', 'Anya neve', NULL, 'Meno matky', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(482, 'No', 'No', 'Nem', NULL, 'Nie', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(483, 'Are you sure you want to delete this dog?', 'Are you sure you want to delete this dog?', 'Biztosan törölni szeretné ezt a kutyát?', NULL, 'Naozaj si želáte odstrániť tohto psa?', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(484, 'Question', 'Question', 'Kérdés', NULL, 'Otázka', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(485, 'Are you sure you want to delete this profile?', 'Are you sure you want to delete this profile?', 'Biztosan törölni szeretné ezt az adatlapot?', NULL, 'Naozaj si želáte odstrániť tento profil?', 'en', 'http://www.dogshow.com/dog-profile?id=2', NULL),
(486, 'Are you sure you want to delete this record?', 'Are you sure you want to delete this record?', 'Biztosan törölni szeretné ezt az feljegyzést?', NULL, 'Naozaj si želáte odstrániť tento záznam?', 'en', 'http://www.dogshow.com/dog-profile?id=5&dog_id=5&_fid=yvc6', NULL),
(487, 'By clicking Register, you agree to our', 'By clicking Register you agree to our', 'A Regisztráció gombra kattintva Ön elfogadja a', NULL, 'Kliknutím na odkaz Registrovať, akceptujete naše', 'en', 'http://www.dogshow.com/index.php', NULL),
(488, 'General terms', 'General terms ', 'Általános feltételek', NULL, 'Všeobecné podmienky', 'en', 'http://www.dogshow.com/index.php', NULL),
(489, 'and you have read our', 'and you have read our ', 'és elolvasta a ', NULL, 'a taktiež akceptujete', 'en', 'http://www.dogshow.com/index.php', NULL),
(490, 'Cookie policy', 'Cookie policy ', 'Cookie írányelv', NULL, 'Politika Cookies', 'en', 'http://www.dogshow.com/index.php', NULL),
(491, 'Father of the planned litter', 'Father (sire) of the planned litter', 'Tervezett alom apja', NULL, 'Otec plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(492, 'Mother of the planned litter', 'Mother (dam) of the planned litter', 'Tervezett alom anyja', NULL, 'Matka plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(493, 'Please select planned litter...', 'Please select the planned litter...', 'Kérem válasszon tervezett almot...', NULL, 'Prosím vyberte plánovaný vrh ...', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(494, 'Add a puppy', 'Add a puppy', 'Kiskutya hozzáadása', NULL, 'Pridať šteniatko', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(495, 'Basic informations about puppy', 'Basic informations about the puppy', 'Alapvető információk a kiskutyáról', NULL, 'Základné informácie o šteniatku', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(496, 'Select your planned litter', 'Select your planned litter', 'Válassza ki a tervezett alomját', NULL, 'Vyberte plánovaný vrh', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(497, 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Válasszon hozzáadott tervezett almokból vagy tüntessen fel egy tervezett almot a menü segítségével', NULL, 'Vyberte plánovaný vrh zo zoznamu vašich pridaných plánovaných vrhov, alebo si pridajte plánovaný vrh v sekcii plánované vrhy', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(498, 'Select the puppy’s gender', 'Select the puppy’s gender', 'Válassza ki a kiskutya nemét', NULL, 'Vyberte pohlavie šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(499, 'Puppy''s name', 'The puppy''s name', 'Kiskutya neve', NULL, 'Meno šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(500, 'Enter the puppy’s name', 'Enter the puppy’s name', 'Tüntesse fel a kiskutya nevét', NULL, 'Zadajte meno šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(501, 'Picture of puppy', 'Picture of the puppy', 'Kiskutya fenyképe', NULL, 'Obrázok šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(502, 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'Upload the profile picture the puppy in PNG, JPG or GIF format', 'Töltse fel a kiskutya profilképét JPG vagy JPEG formátumban', NULL, 'Nahrajte profilový obrázok šteniatka vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(503, 'Day, month and year of puppy’s birth', 'Day, month and year of the puppy’s birth', 'Kiskutya születési dátuma nap, hónap és év formátumban', NULL, 'Deň, mesiac a rok narodenia šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(504, 'Country in which the puppy is currently located', 'Country in which the puppy is currently located', 'Ország, ahol a kiskutya jelenleg található', NULL, 'Vyberte štát v ktorom sa šteniatko momentálne nachádza', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(505, 'Share on Facebook', 'Share on Facebook', 'Megosztás Facebook-on', NULL, 'Zdieľať na Facebook', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(506, 'Share on Google+', 'Share on Google+', 'Megosztás Google+-on', NULL, 'Zdieľať na Google+', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(507, 'Share on Twitter', 'Share on Twitter', 'Megosztás Twitter-en', NULL, 'Zdieľať na Twitter', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(508, 'Share on Pinterest', 'Share on Pinterest', 'Megosztás Pinterest-en', NULL, 'Zdieľať na Pinterest', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(509, 'Share on Tumblr', 'Share on Tumblr', 'Megosztám Tumblr-en', NULL, 'Zdieľať na Tumblr', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(510, 'Post to a friend', 'Post to a friend', 'Hozzászólás az ismerőséhez', NULL, 'Poslať priateľovi', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(511, 'I am interested', 'I am interested', 'Érdekel', NULL, 'Mám záujem', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(512, 'Description', 'Description', 'Leírás', NULL, 'Popis', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(513, 'Edit puppy profile', 'Edit the puppy''s profile', 'Kiskutya adatalpjának módosítása ', NULL, 'Upraviť šteniatko', 'en', 'http://www.dogshow.com/puppy-edit-profile', NULL),
(514, 'Peoples who liked this', 'People who liked this', 'Emberek, akik kedvelik ezt', NULL, 'Ľudia, ktorým sa to páči', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(515, 'Required field', 'Required field', 'Kötelező mező', NULL, 'Potrebné vyplniť', 'en', 'http://www.dogshow.com/index.php', NULL),
(516, 'User with this e-mail, is not in our database', 'User with this e-mail is not in our database', 'Felhasználó ezzel az e-mailel nincs az adatbázisunkban', NULL, 'Užívateľ s týmto emailom sa nenachádza v našej databáze', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(517, 'Login to your account', 'Login to your account', 'Jelentkezzen be a fiókjába', NULL, 'Prihlásenie do vásho účtu', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(518, 'Your password has been successfully sent to your e-mail', 'Your password has been successfully sent to your e-mail', 'A jelszavat sikeresen elküldtük az e-mail-re', NULL, 'Vaše heslo bolo úspešne odoslané na váš email', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(519, 'Handler profile', 'The handler''s profile', 'Handler adatlapja', NULL, 'Profil handlera', 'en', 'http://www.dogshow.com/handler-create-profile', NULL),
(520, 'Select the breed that you can handle', 'Select the breeds that you can show', 'Válassza ki az Ön által felvezetni kívánt fajtákat', NULL, 'Vyberte plemená pre handling zo zoznamu plemien', 'en', 'http://www.dogshow.com/handler-create-profile', NULL);
INSERT INTO `tbl_import` (`id`, `text_to_translate`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(521, 'Select the breeds that you can handle', 'Select the breeds that you can show', 'Válassza ki az Ön által felvezetni kívánt fajtákat', NULL, 'Vyberte plemená pre handling zo zoznamu plemien', 'en', 'http://www.dogshow.com/handler-create-profile', NULL),
(522, 'Your cover photo', 'Your cover photo', 'Borítóképe', NULL, 'Váš profilový obrázok', 'en', 'http://www.dogshow.com/handler-edit-profile', NULL),
(523, 'Add breeds for handling', 'Add breeds for handling', 'Felveztésre alkalmas fajta hozzáadása ', NULL, 'Pridanie plemien pre handling', 'en', 'http://www.dogshow.com/handler-handling-breed-add', NULL),
(524, 'Record has been successfully added.', 'The record has been successfully added.', 'A feljegyzék sikeresen hozzáadva.', NULL, 'Záznam bol úspešne pridaný', 'en', 'http://www.dogshow.com/handler-awards-add?handler_id=400000000', NULL),
(525, 'Record has been successfully updated.', 'The record has been successfully updated.', 'A feljegyzék sikeresen frissítve lett.', NULL, 'Záznam bol úspešne upravený', 'en', 'http://www.dogshow.com/handler-awards-edit?id=7', NULL),
(526, 'Add certificate', 'Add the certificate', 'Bizonylat hozzáadása', NULL, 'Pridanie certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(527, 'Date of certificate passed', 'Date of passed certificate ', 'Bizonylat megszerzésének az időpontja', NULL, 'Dátum získania certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(528, 'Select date certificate was obtained', 'Select the date when the certificate was obtained', 'Válassza ki bizonylat megszerzésének az időpontját', NULL, 'Vyberte dátum kedy ste získali certifikát', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(529, 'Name of the certificate', 'Name of the certificate', 'Bizonylat neve', NULL, 'Názov certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(530, 'Picture of certificate in jpeg or jpg format', 'Picture of the certificate in jpeg or jpg format', 'Bizonylat fenyképe jpeg vagy jpg formátumban', NULL, 'Obrázok certifikátu vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(531, 'Edit certificate', 'Edit the certificate', 'Bizonylat szerkesztése', NULL, 'Úprava certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-edit?id=1', NULL),
(532, 'Date certificate passed', 'Date of passed certificate', 'Bizonylat megszerzésének az időpontja', NULL, 'Dátum získania certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-edit?id=1', NULL),
(533, 'Name of the handled dog', 'Name of the showed dog', 'Felvezetett kutya neve', NULL, 'Meno psa ktorého ste handlovali', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(534, 'Enter the dog’s name or select dog from DOGFORSHOW database for interactivity', 'Enter the dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Tüntesse fel a kutya nevét, vagy válassza ki őt a DOGFORSHOW interaktív adatbázisából', NULL, 'Zadajte meno psa alebo vyberte psa z databázy DOGFORSHOW pre možnosť prepojenia', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(535, 'Enter other titles achieved at this show (e.g. National Winner)', 'Enter other titles achieved at this show (e.g. National Winner)', 'Tüntesse fel a többi címeket, amit elért ezen a kiállításon (pl. Országos győztes)', NULL, 'Zadajte iné obdržané tituly a čakateľstvá v rámci zadanej výstavy (napr. Narodný víťaz) ', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(536, 'Minor Puppy', 'Minor Puppy', 'Minor Puppy', NULL, 'Mladší dorast', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(537, 'Puppy', 'Puppy', 'Puppy', NULL, 'Dorast', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(538, 'Junior', 'Junior', 'Fiatal', NULL, 'Mladí', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(539, 'Intermediate', 'Intermediate', 'Növendék', NULL, 'Stredná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(540, 'Open', 'Open', 'Nyílt', NULL, 'Otvorená', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(541, 'Working', 'Working', 'Munka', NULL, 'Pracovná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(542, 'Champions', 'Champions', 'Champions', NULL, 'Šampióni', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(543, 'Veteran', 'Veteran', 'Veterán', NULL, 'Veteráni', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(544, 'Honor', 'Honor', 'Honor', NULL, 'Čestná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(545, 'Please select...', 'Please select…', 'Kérem válasszon...', NULL, 'Prosím vyberte si ...', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(546, 'Language', 'Language', 'Nyelv', NULL, 'Jazyk', 'en', 'http://www.dogshow.com/edit-account', NULL),
(547, 'Language for current user', 'Language for current user', 'Aktuális felhasználó nyelve', NULL, 'Vyberte si prosím požadovaný jazyk zo zoznamu', 'en', 'http://www.dogshow.com/edit-account', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photos`
--

DROP TABLE IF EXISTS `tbl_photos`;
CREATE TABLE IF NOT EXISTS `tbl_photos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2800000000 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_translate`
--

DROP TABLE IF EXISTS `tbl_translate`;
CREATE TABLE IF NOT EXISTS `tbl_translate` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `text_to_translate` mediumtext CHARACTER SET utf8,
  `translated_text_de` mediumtext CHARACTER SET utf8 NOT NULL,
  `translated_text_en` mediumtext CHARACTER SET utf8,
  `translated_text_hu` mediumtext CHARACTER SET utf8 NOT NULL,
  `translated_text_cz` mediumtext CHARACTER SET utf8 NOT NULL,
  `translated_text_sk` mediumtext CHARACTER SET utf8 NOT NULL,
  `lang` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `url` mediumtext CHARACTER SET utf8,
  `uri` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_uri` (`text_to_translate`(300))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=557 ;

--
-- Dumping data for table `tbl_translate`
--

INSERT INTO `tbl_translate` (`id`, `text_to_translate`, `translated_text_de`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(1, 'Registration', 'Registration', 'Registration', 'Regisztráció', 'Registration', 'Registrovať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(2, 'About DOGFORSHOW', 'About DOGFORSHOW', 'About DOGFORSHOW', 'DOGFORSHOWról', 'About DOGFORSHOW', 'O DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(3, 'Contact', 'Contact', 'Contact', 'Elérhetőség', 'Contact', 'Kontakt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(4, 'We support breeding of happy and healthy dogs with pedigree', 'We support breeding of happy and healthy dogs with pedigree', 'We support breeding of happy and healthy dogs with pedigree', 'Támogatjuk az egészséges és boldog törzskönyvi kutyák tenyésztését', 'We support breeding of happy and healthy dogs with pedigree', 'Podporujeme chov šťastných a zdravých psov s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(5, 'Login', 'Login', 'Login', 'Bejelentkezés', 'Login', 'Prihlásiť', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(6, 'Afghanistan', 'Afghanistan', 'Afghanistan', 'Afganisztán', 'Afghanistan', 'Afganistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(7, 'Albania', 'Albania', 'Albania', 'Albánia', 'Albania', 'Albánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(8, 'Algeria', 'Algeria', 'Algeria', 'Algéria', 'Algeria', 'Alžírsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(9, 'Andorra', 'Andorra', 'Andorra', 'Andorra', 'Andorra', 'Andorra', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(10, 'Argentina', 'Argentina', 'Argentina', 'Argentína', 'Argentina', 'Argentína', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(11, 'Armenia', 'Armenia', 'Armenia', 'Örményország', 'Armenia', 'Arménsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(12, 'Australia', 'Australia', 'Australia', 'Ausztrália', 'Australia', 'Austrália', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(13, 'Austria', 'Austria', 'Austria', 'Ausztria', 'Austria', 'Rakúsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(14, 'Azerbaidjan', 'Azerbaidjan', 'Azerbaidjan', 'Azerbajdzsán', 'Azerbaidjan', 'Azerbajdžan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(15, 'Bahrain', 'Bahrain', 'Bahrain', 'Bahrain', 'Bahrain', 'Bahrajn', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(16, 'Bangladesh', 'Bangladesh', 'Bangladesh', 'Bangladesh', 'Bangladesh', 'Bangladéš', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(17, 'Belarus', 'Belarus', 'Belarus', 'Belorusszia', 'Belarus', 'Bielorusko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(18, 'Belgium', 'Belgium', 'Belgium', 'Belgium', 'Belgium', 'Belgicko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(19, 'Bolivia', 'Bolivia', 'Bolivia', 'Bolívia', 'Bolivia', 'Bolívia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(20, 'Bosnia-Herzegovina', 'Bosnia-Herzegovina', 'Bosnia-Herzegovina', 'Bosznia-Hercegovina', 'Bosnia-Herzegovina', 'Bosna a Hercegovina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(21, 'Brazil', 'Brazil', 'Brazil', 'Brazília', 'Brazil', 'Brazília', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(22, 'Bulgaria', 'Bulgaria', 'Bulgaria', 'Bulgária', 'Bulgaria', 'Bulharsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(23, 'Canada', 'Canada', 'Canada', 'Kanada', 'Canada', 'Kanada', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(24, 'Colombia', 'Colombia', 'Colombia', 'Kolumbia', 'Colombia', 'Kolumbia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(25, 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Kostarika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(26, 'Croatia', 'Croatia', 'Croatia', 'Horvátország', 'Croatia', 'Chorvátsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(27, 'Cuba', 'Cuba', 'Cuba', 'Kuba', 'Cuba', 'Kuba', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(28, 'Cyprus', 'Cyprus', 'Cyprus', 'Ciprusi Köztársaság / Ciprus', 'Cyprus', 'Cyprus', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(29, 'Czech Republic', 'Czech Republic', 'Czech Republic', 'Cseh Köztársaság / Csehország', 'Czech Republic', 'Česká republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(30, 'Denmark', 'Denmark', 'Denmark', 'Dán Királyság / Dánia', 'Denmark', 'Dánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(31, 'Dominican Republic', 'Dominican Republic', 'Dominican Republic', 'Dominikai Köztársaság', 'Dominican Republic', 'Dominikánska Republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(32, 'Ecuador', 'Ecuador', 'Ecuador', 'Ecuadori Köztársaság / Ecuador', 'Ecuador', 'Ekvádor', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(33, 'Egypt', 'Egypt', 'Egypt', 'Egyiptom', 'Egypt', 'Egypt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(34, 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvardor', 'El Salvador', 'El Salvador', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(35, 'Estonia', 'Estonia', 'Estonia', 'Észt Köztársaság / Észtország', 'Estonia', 'Estónsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(36, 'Ethiopia', 'Ethiopia', 'Ethiopia', 'Etiópia', 'Ethiopia', 'Etiópia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(37, 'Faroe Islands', 'Faroe Islands', 'Faroe Islands', 'Feröer-szigetek', 'Faroe Islands', 'Faerské ostrovy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(38, 'Finland', 'Finland', 'Finland', 'Finnország', 'Finland', 'Fínsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(39, 'France', 'France', 'France', 'Franciaország', 'France', 'Francúzsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(40, 'Georgia', 'Georgia', 'Georgia', 'Grúzia', 'Georgia', 'Gruzínsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(41, 'Germany', 'Germany', 'Germany', 'Németország', 'Germany', 'Nemecko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(42, 'Ghana', 'Ghana', 'Ghana', 'Ghána', 'Ghana', 'Ghana', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(43, 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltár', 'Gibraltar', 'Gibraltár', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(44, 'Great Britain', 'Great Britain', 'Great Britain', 'Nagy-Britannia', 'Great Britain', 'Veľká Británia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(45, 'Greece', 'Greece', 'Greece', 'Görögország', 'Greece', 'Grécko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(46, 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(47, 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(48, 'Hungary', 'Hungary', 'Hungary', 'Magyarország', 'Hungary', 'Maďarsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(49, 'Chad', 'Chad', 'Chad', 'Csád', 'Chad', 'Čad', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(50, 'Chile', 'Chile', 'Chile', 'Chile', 'Chile', 'Čile', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(51, 'China', 'China', 'China', 'Kína', 'China', 'Čína', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(52, 'Iceland', 'Iceland', 'Iceland', 'Izland', 'Iceland', 'Island', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(53, 'India', 'India', 'India', 'India', 'India', 'India', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(54, 'Indonesia', 'Indonesia', 'Indonesia', 'Indonézia', 'Indonesia', 'Indonézia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(55, 'Iran', 'Iran', 'Iran', 'Irán', 'Iran', 'Irán', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(56, 'Iraq', 'Iraq', 'Iraq', 'Irak', 'Iraq', 'Irak', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(57, 'Ireland', 'Ireland', 'Ireland', 'Írország', 'Ireland', 'Írsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(58, 'Israel', 'Israel', 'Israel', 'Izrael', 'Israel', 'Izrael', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(59, 'Italy', 'Italy', 'Italy', 'Olaszország', 'Italy', 'Taliansko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(60, 'Japan', 'Japan', 'Japan', 'Japán', 'Japan', 'Japonsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(61, 'Jordan', 'Jordan', 'Jordan', 'Jordánia', 'Jordan', 'Jordánsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(62, 'Kazakhstan', 'Kazakhstan', 'Kazakhstan', 'Kazahsztán', 'Kazakhstan', 'Kazachstan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(63, 'Kenya', 'Kenya', 'Kenya', 'Kenya', 'Kenya', 'Keňa', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(64, 'Kuwait', 'Kuwait', 'Kuwait', 'Kuvait', 'Kuwait', 'Kuvajt', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(65, 'Latvia', 'Latvia', 'Latvia', 'Lettország', 'Latvia', 'Lotyšsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(66, 'Lebanon', 'Lebanon', 'Lebanon', 'Libanon', 'Lebanon', 'Libanon', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(67, 'Libya', 'Libya', 'Libya', 'Líbia', 'Libya', 'Líbya', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(68, 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Lichtenštajnsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(69, 'Lithuania', 'Lithuania', 'Lithuania', 'Litvánia', 'Lithuania', 'Litva', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(70, 'Luxembourg', 'Luxembourg', 'Luxembourg', 'Luxembourg', 'Luxembourg', 'Luxembursko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(71, 'Macedonia', 'Macedonia', 'Macedonia', 'Macedónia', 'Macedonia', 'Macedónsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(72, 'Madagascar', 'Madagascar', 'Madagascar', 'Madagaszkár', 'Madagascar', 'Madagaskar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(73, 'Malaysia', 'Malaysia', 'Malaysia', 'Malaysia', 'Malaysia', 'Malajzia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(74, 'Malta', 'Malta', 'Malta', 'Málta', 'Malta', 'Malta', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(75, 'Marshall Islands', 'Marshall Islands', 'Marshall Islands', 'Marshall-szigetek', 'Marshall Islands', 'Marshallove ostrovy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(76, 'Mexico', 'Mexico', 'Mexico', 'Mexikó', 'Mexico', 'Mexiko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(77, 'Moldova', 'Moldova', 'Moldova', 'Moldova', 'Moldova', 'Moldavsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(78, 'Monaco', 'Monaco', 'Monaco', 'Monaco', 'Monaco', 'Monako', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(79, 'Morocco', 'Morocco', 'Morocco', 'Marokkó', 'Morocco', 'Maroko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(80, 'Nepal', 'Nepal', 'Nepal', 'Nepál', 'Nepal', 'Nepál', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(81, 'Netherlands', 'Netherlands', 'Netherlands', 'Hollandia ', 'Netherlands', 'Holandsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(82, 'New Zealand', 'New Zealand', 'New Zealand', 'Új Zéland', 'New Zealand', 'Nový Zéland', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(83, 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nikaragua', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(84, 'Nigeria', 'Nigeria', 'Nigeria', 'Nigéria', 'Nigeria', 'Nigéria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(85, 'Norway', 'Norway', 'Norway', 'Norvégia', 'Norway', 'Nórsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(86, 'Oman', 'Oman', 'Oman', 'Oman', 'Oman', 'Omán', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(87, 'Pakistan', 'Pakistan', 'Pakistan', 'Pakisztán', 'Pakistan', 'Pakistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(88, 'Panama', 'Panama', 'Panama', 'Panama', 'Panama', 'Panama', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(89, 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(90, 'Peru', 'Peru', 'Peru', 'Peru', 'Peru', 'Peru', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(91, 'Philippines', 'Philippines', 'Philippines', 'Fülöp-szigetek', 'Philippines', 'Filipíny', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(92, 'Poland', 'Poland', 'Poland', 'Lengyelország', 'Poland', 'Poľsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(93, 'Portugal', 'Portugal', 'Portugal', 'Portugália', 'Portugal', 'Portugalsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(94, 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(95, 'Qatar', 'Qatar', 'Qatar', 'Katar', 'Qatar', 'Katar', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(96, 'Republic of Kore', 'Republic of Kore', 'Republic of Kore', 'Koreai Köztársaság', 'Republic of Kore', 'Južná Kórea', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(97, 'Republic of Montenegro', 'Republic of Montenegro', 'Republic of Montenegro', 'Montenegrói Köztársaság', 'Republic of Montenegro', 'Čierna Hora', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(98, 'Romania', 'Romania', 'Romania', 'Románia', 'Romania', 'Rumunsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(99, 'Russia', 'Russia', 'Russia', 'Oroszország', 'Russia', 'Rusko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(100, 'San Marino', 'San Marino', 'San Marino', 'San Marino', 'San Marino', 'San Marino', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(101, 'Saudi Arabia', 'Saudi Arabia', 'Saudi Arabia', 'Szaud-Arábia', 'Saudi Arabia', 'Saudská Arábia', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(102, 'Serbia', 'Serbia', 'Serbia', 'Szerbia', 'Serbia', 'Srbsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(103, 'Seychelles', 'Seychelles', 'Seychelles', 'Seychelle-szigetek', 'Seychelles', 'Seychely', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(104, 'Singapore', 'Singapore', 'Singapore', 'Szingapúr', 'Singapore', 'Singapur', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(105, 'Slovakia', 'Slovakia', 'Slovakia', 'Szlovákia', 'Slovakia', 'Slovensko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(106, 'Slovenia', 'Slovenia', 'Slovenia', 'Szlovénia', 'Slovenia', 'Slovinsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(107, 'South Africa', 'South Africa', 'South Africa', 'Dél-Afrika', 'South Africa', 'Juhoafrická republika', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(108, 'Spain', 'Spain', 'Spain', 'Spanyolország', 'Spain', 'Španielsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(109, 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Srí Lanka', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(110, 'Sweden', 'Sweden', 'Sweden', 'Svédország', 'Sweden', 'Švédsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(111, 'Switzerland', 'Switzerland', 'Switzerland', 'Svájc', 'Switzerland', 'Švajčiarsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(112, 'Syria', 'Syria', 'Syria', 'Szíria', 'Syria', 'Sýria', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(113, 'Taiwan', 'Taiwan', 'Taiwan', 'Tajvan', 'Taiwan', 'Taiwan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(114, 'Thailand', 'Thailand', 'Thailand', 'Thaiföld', 'Thailand', 'Thajsko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(115, 'Tunisia', 'Tunisia', 'Tunisia', 'Tunézia', 'Tunisia', 'Tunisko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(116, 'Turkey', 'Turkey', 'Turkey', 'Törökország', 'Turkey', 'Turecko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(117, 'Uganda', 'Uganda', 'Uganda', 'Uganda', 'Uganda', 'Uganda', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(118, 'Ukraine', 'Ukraine', 'Ukraine', 'Ukrajna', 'Ukraine', 'Ukrajina', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(119, 'United Arab Emirates', 'United Arab Emirates', 'United Arab Emirates', 'Egyesült Arab Emírségek', 'United Arab Emirates', 'Spojené arabské emiráty', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(120, 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(121, 'USA', 'USA', 'USA', 'Amerikai Egyesült Államok', 'USA', 'USA', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(122, 'Uzbekistan', 'Uzbekistan', 'Uzbekistan', 'Üzbegisztán', 'Uzbekistan', 'Uzbekistan', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(123, 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(124, 'Vietnam', 'Vietnam', 'Vietnam', 'Vietnám', 'Vietnam', 'Vietnam', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(125, 'Name', 'Name', 'Name', 'Név', 'Name', 'Meno', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(126, 'Surname', 'Surname', 'Surname', 'Vezetéknév', 'Surname', 'Priezvisko', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(127, 'Email', 'Email', 'Email', 'Email', 'Email', 'Email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(128, 'Password', 'Password', 'Password', 'Jelszó', 'Password', 'Heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(129, 'Confirm password', 'Confirm password', 'Confirm password', 'Jelszó megerősítése', 'Confirm password', 'Potvrdenie hesla', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(130, 'Register', 'Register', 'Register', 'Regisztráció', 'Register', 'Regitrovať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(131, 'Forgot your password', 'Forgot your password', 'Forgot your password', 'Elfelejtette jelszavát', 'Forgot your password', 'Zabudli ste heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(132, 'Your email', 'Your email', 'Your email', 'Email címe', 'Your email', 'Váš email', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(133, 'Send', 'Send', 'Send', 'Elküldés', 'Send', 'Odoslať', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(134, 'Remember me', 'Remember me', 'Remember me', 'Emlékezz rám', 'Remember me', 'Zapamätať si ma', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(135, 'Forgot password', 'Forgot password', 'Forgot password', 'Elfelejtett jelszó', 'Forgot password', 'Zabudnuté heslo', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(136, 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which helps them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'Nemzetközi közösségi háló törzskönyves kutya tenyésztők, tulajdonosok, kennelek és handlerek számára.', 'International social network dedicated to owners of dogs with pedigree, kennels and handlers, which help them to present themselves, communicate with each other and motivate each other. Forget about the classic advertising portals and join to the fast growing community from all over the world.', 'Medzinárodná sociálna sieť venovaná chovateľským staniciam, majiteľom a handlerom psov s preukazom pôvodu. Vytvorte si prehľadný profil s množstvom funkcií, komunikujte s ostatnými užívateľmi a navzájom sa inšpirujte. Zabudnite na klasické inzertné portály a pridajte sa ešte dnes k rýchlorastúcej komunite majiteľov psov s preukazom pôvodu z celého sveta.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(137, 'Kennels', 'Kennels', 'Kennels', 'Kennelek', 'Kennels', 'Chovateľské stanice', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(138, 'Owners', 'Owners', 'Owners', 'Tulajdonosok', 'Owners', 'Majitelia psov', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(139, 'Handlers', 'Handlers', 'Handlers', 'Handlerek', 'Handlers', 'Handlery', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(140, 'Dogs with pedigree', 'Dogs with pedigree', 'Dogs with pedigree', 'Törzskönyves kutyák', 'Dogs with pedigree', 'Psy s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(141, 'Puppies for sale', 'Puppies for sale', 'Puppies for sale', 'Eladó kiskutyák', 'Puppies for sale', 'Šteniatká na predaj', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(142, 'Planned litters', 'Planned litters', 'Planned litters', 'Tervezett párosítások', 'Planned litters', 'Plánované vrhy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(143, 'Stud dogs', 'Stud dogs', 'Stud dogs', 'Tenyészkutyák', 'Stud dogs', 'Chovní psy', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(144, 'Best in show', 'Best in show', 'Best in show', 'Best in show', 'Best in show', 'Best in Show', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(145, 'Follow with us how we are growing', 'Follow with us how we are growing', 'Follow with us how we are growing', 'Kövesse velünk, hogyan nő a közösség', 'Follow with us how we are growing', 'Sledujte spolu s nami ako rastieme', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(146, 'Present internationally on the right place', 'Present internationally on the right place', 'Present internationally on the right place', 'Nemzetközileg prezentáljon a megfelelő helyen', 'Present internationally on the right place', 'Prezentujte sa medzinárodne na tom správnom mieste', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(147, 'Possibility to create your own kennel, owners and handlers profile', 'Possibility to create your own kennel, owners and handlers profile', 'Possibility to create your own kennel, owners and handlers profile', 'Lehetőség saját kennel, kutya tulajdonos és handler profil létrehozása', 'Possibility to create your own kennel, owners and handlers profile', 'Vytvorte si profil chovateľskej stanice, majiteľa a handlera', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(148, 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'Create unique profiles of your dogs with possibility to offer your stud dogs', 'Készítsen egyedi profilt a kutyájának és használja ki a lehetőséget kínálni őt mint tenyészkant', 'Create unique profiles of your dogs with possibility to offer your dog at stud', 'Vytvorte si unikátne profily Vašich psov s možnosťou ponuky na krytie', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(149, 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Tüntesse fel kutyakiállítási eredményeit, díjait, címeit, munkavizsgáit, egészségügyi szűréseit, fenyképeit és videójait', 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos', 'Pridávajte výstavné úspechy, ocenenia, tituly, pracovné skúšky, informácie o zdraví, fotografie a videá', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(150, 'Inform about planned litters and offer puppies for sale', 'Inform about planned litters and offer puppies for sale', 'Inform about planned litters and offer puppies for sale', 'Informálja többieket a tervezett párosításairól és kínálja kiskutyáit ', 'Inform about planned litters and offer puppies for sale', 'Informujte o plánovaných vrhoch ', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(151, 'Create friendships and communicate with each other', 'Create friendships and communicate with each other', 'Create friendships and communicate with each other', 'Hozzon létre új barátságokat és kommunikáljon velük', 'Create friendships and communicate with each other', 'Vytvárajte priateľstvá a navzájom spolu komunikujte', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(152, 'Take opportunity to be contacted by potential buyers from all over the world', 'Take opportunity to be contacted by potential buyers from all over the world', 'Take the opportunity to be contacted by potential buyers from all over the world', 'Használja ki a lehetőséget, hogy a potenciális vásárlók kapcsolatba lépjenek magával világ minden tájáról', 'Take opportunity to be contacted by potential buyers from all over the world', 'Využite jedinečnú príležitosť kontaktovania potencionálnymi záujemcami z celého sveta', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(153, 'Contact us', 'Contact us', 'Contact us', 'Lépjen kapcsolatba velünk', 'Contact us', 'Kontaktujte nás', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(154, 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'Kérjük, lépjen kapcsolatba velünk az alábbi űrlap segítségével, ha bármilyen kérdése van, problémája, vagy DOGFORSHOW hirdetéssel kapcsolatos kérdései vannak.', 'Please contact us via the contact form below if you have any questions, issues or if you are interested in advertising on the DOGFORSHOW', 'V prípade akýchkoľvek otázok, nezrovnalostí alebo v prípade záujmu o reklamu na portáli DOGFORSHOW nás neváhajte kontaktovať prostredníctvom nižšie uvedeného kontaktného formulára.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(155, 'Message', 'Message', 'Message', 'Üzenet', 'Message', 'Vaša správa', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(156, 'Verify', 'Verify', 'Verify', 'Megerősít', 'Verify', 'Overenie', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(157, 'Follow us', 'Follow us', 'Follow us', 'Kövess minket', 'Follow us', 'Sledujte nás', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(158, 'DOGFORSHOW on facebook', 'DOGFORSHOW on facebook', 'DOGFORSHOW on facebook', 'DOGFORSHOW a facebook-on', 'DOGFORSHOW on facebook', 'DOGFORSHOW na Facebooku', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(159, 'DOGFORSHOW on Google+', 'DOGFORSHOW on Google+', 'DOGFORSHOW on Google+', 'DOGFORSHOW a Google+-on', 'DOGFORSHOW on Google+', 'DOGFORSHOW na Google+', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(160, 'DOGFORSHOW on Twitter', 'DOGFORSHOW on Twitter', 'DOGFORSHOW on Twitter', 'DOGFORSHOW a Twitter-en', 'DOGFORSHOW on Twitter', 'DOGFORSHOW na Twitter', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(161, 'DOGFORSHOW on Pinterest', 'DOGFORSHOW on Pinterest', 'DOGFORSHOW on Pinterest', 'DOGFORSHOW a Pinterest-en', 'DOGFORSHOW on Pinterest', 'DOGFORSHOW na Pintereste', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(162, 'DOGFORSHOW on Tumblr', 'DOGFORSHOW on Tumblr', 'DOGFORSHOW on Tumblr', 'DOGFORSHOW a Tumblr-en', 'DOGFORSHOW on Tumblr', 'DOGFORSHOW na Tumblr', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(163, 'Friend requests', 'Friend requests', 'Friend requests', 'Ismerősök jelölése', 'Friend requests', 'Žiadosti o priateľstvo', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(164, 'send you a friend request', 'send you a friend request', 'sent you a friend request', 'ismerősnek jelölt', 'send you a friend request', 'vás žiada o priateľstvo', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(165, 'View all', 'View all', 'View all', 'Mindet megnéz', 'View all', 'Zobraziť všetko', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(166, 'Messages', 'Messages', 'Messages', 'Üzenetek', 'Messages', 'Správy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(167, 'Notifications', 'Notifications', 'Notifications', 'Értesítések', 'Notifications', 'Upozornenia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(168, 'comment your post', 'comment your post', 'commented on your post', 'hozzászólt a bejegyzésedhez', 'comment your post', 'okomentoval váš príspevok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(169, 'like your post', 'like your post', 'likes your post', 'kedveli a bejegyzésedet', 'like your post', 'sa páči váš príspevok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(170, 'User account', 'User account', 'User account', 'Felhasználói fiók', 'User account', 'Užívateľský účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(171, 'Account settings', 'Account settings', 'Account settings', 'Beállítások', 'Account settings', 'Nastaviť účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(172, 'Delete account', 'Delete account', 'Delete account', 'Fiók törlése', 'Delete account', 'Zmazať účet', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(173, 'Logout', 'Logout', 'Logout', 'Kijelentkezés', 'Logout', 'Odhlásiť', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(174, 'Kennel', 'Kennel', 'Kennel', 'Kennel', 'Kennel', 'Chovateľská stanica', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(175, 'Profile settings', 'Profile settings', 'Profile settings', 'Adatlap szerkesztése', 'Profile settings', 'Nastaviť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(176, 'Switch profile', 'Switch profile', 'Switch profile', 'Adatlap átváltása', 'Switch profile', 'Prepnúť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(177, 'Edit profile', 'Edit profile', 'Edit profile', 'Adatlap módosítása', 'Edit profile', 'Upraviť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(178, 'Delete profile', 'Delete profile', 'Delete profile', 'Adatlap törlése', 'Delete profile', 'Zmazať profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(179, 'My Profile', 'My Profile', 'My Profile', 'Adatlapom', 'My Profile', 'Môj profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(180, 'Home', 'Home', 'Home', 'Kezdőlap', 'Home', 'Domov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(181, 'Awards', 'Awards', 'Awards', 'Díjak', 'Awards', 'Ocenenia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(182, 'Dogs', 'Dogs', 'Dogs', 'Kutyák', 'Dogs', 'Psy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(183, 'Photos', 'Photos', 'Photos', 'Fenyképek', 'Photos', 'Fotografie', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(184, 'Videos', 'Videos', 'Videos', 'Videók', 'Videos', 'Videá', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(185, 'Friends', 'Friends', 'Friends', 'Barátok', 'Friends', 'Priatelia', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(186, 'Followers', 'Followers', 'Followers', 'Követők', 'Followers', 'Sledujúci', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(187, 'Breeds for handling', 'Breeds for handling', 'Breeds for handling', 'Felvezetendő fajták', 'Breeds for handling', 'Plemená pre handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(188, 'Certificates', 'Certificates', 'Certificates', 'Bizonylatok', 'Certificates', 'Certifikáty', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(189, 'Show results', 'Show results', 'Show results', 'Kiállítási eredmények', 'Show results', 'Výstavné úspechy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(190, 'About us', 'About us', 'About us', 'Rólunk', 'About us', 'O nás', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(191, 'Terms & conditions', 'Terms & conditions', 'Terms & conditions', 'Felhasználási feltételek', 'Terms & conditions', 'Všobecné podmienky', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(192, 'Return policy', 'Return policy', 'Return policy', 'Visszatérési irányelv', 'Return policy', 'Reklamačné podmienky', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(193, 'Lists', 'Lists', 'Lists', 'Listák', 'Lists', 'Zoznamy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(194, 'Owners of purebred dogs', 'Owners of purebred dogs', 'Owners of purebred dogs', 'Törzskönyves kutyák tulajdonosai', 'Owners of purebred dogs', 'Majitelia psov s PP', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(195, 'Dogs for mating', 'Dogs for mating', 'Stud dogs', 'Tenyészkutyák', 'Dogs for mating', 'Chovní psy', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(196, 'Active profile', 'Active profile', 'Active profile', 'Aktív adatlap', 'Active profile', 'Aktívny profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(197, 'Create a clear profile of your kennel', 'Create a clear profile of your kennel', 'Create a clear profile of your kennel', 'Hozzon létre egy egyértelmű adatlapot a kenneléről', 'Create a clear profile of your kennel', 'Prehľadný profil chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(198, 'Create unique profiles of your dogs', 'Create unique profiles of your dogs', 'Create unique profiles of your dogs', 'Készítsen egyedi adatlapokat kutyáiról', 'Create unique profiles of your dogs', 'Unikátne profily psov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(199, 'Offer your dogs at stud', 'Offer your dogs at stud', 'Offer your stud dogs', 'Kínálja tenyészkutyáit', 'Offer your dogs at stud', 'Možnosť ponuky psa na krytie', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(200, 'Inform about planned litters', 'Inform about planned litters', 'Inform about planned litters', 'Informálja többieket a tervezett párosításairól', 'Inform about planned litters', 'Pridávanie plánovaných vrhov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(201, 'Offer puppies for sale from planned litters', 'Offer puppies for sale from planned litters', 'Offer puppies for sale from planned litters', 'Kínálja kiskutyáit a tervezett párosításaiból', 'Offer puppies for sale from planned litters', 'Ponuka šteniatok na predaj', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(202, 'Add awards and titles of your dogs', 'Add awards and titles of your dogs', 'Add awards and titles of your dogs', 'Tüntesse fel kutyái díjait és címeit', 'Add awards and titles of your dogs', 'Pridávanie ocenení a titulov ', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(203, 'Add dogshow successes and keep show history of your dog in one place', 'Add dogshow successes and keep show history of your dog in one place', 'Add dogshow successes and keep show history of your dog in one place', 'Tüntesse fel kutyakiállítási eredményeit és folyamatosan kövesse a kutya eredményeit, mindezt egy helyen', 'Add dogshow successes and keep show history of your dog in one place', 'Pridávanie výstavných úspechov s prehľadnou výstavnou históriou', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(204, 'Add working exams and health informations', 'Add working exams and health informations', 'Add working exams and health informations', 'Tüntesse fel kutyái munka vizsgáit és egészségügyi szűréseit', 'Add working exams and health informations', 'Pridávanie pracovných skúšok', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(205, 'Add pedigrees', 'Add pedigrees', 'Add pedigrees', 'Töltse ki kutyái törzskönyvét', 'Add pedigrees', 'Pridávanie interaktívnych rodokmeňov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(206, 'Add photos of your dogs', 'Add photos of your dogs', 'Add photos of your dogs', 'Töltse fel kutyái képeit', 'Add photos of your dogs', 'Pridávanie fotografií', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(207, 'Share your succeses on social networks', 'Share your succeses on social networks', 'Share your succeses on social networks', 'Osztja meg kutyái sikereit a többi közösségi hálón', 'Share your succeses on social networks', 'Zdieľanie vašich úspechov prostedníctvom sociálnych sietí', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(208, 'Communicate with other members of DOGFORSHOW', 'Communicate with other members of DOGFORSHOW', 'Communicate with other members of DOGFORSHOW', 'Kommunikáljon a többi DOGFORSHOW taggal', 'Communicate with other members of DOGFORSHOW', 'Komunikovanie s ostatnými členmi DOGFORSHOW', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(209, 'Owner of purebred dog', 'Owner of purebred dog', 'Owner of purebred dog', 'Törzskönyves kutya tulajdonosa', 'Owner of purebred dog', 'Majiteľ psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(210, 'Create profile', 'Create profile', 'Create profile', 'Hozzon létre egy adatlapot', 'Create profile', 'Vytvoriť profil', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(211, 'Create a clear owner profile', 'Create a clear owner profile', 'Create a clear owner''s profile', 'Hozzon létre egy egyértelmű kutya tulajdonosi adatlapot ', 'Create a clear owner profile', 'Prehľadný profil majiteľa psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(212, 'Possibility to migrate on kennel profile', 'Possibility to migrate on kennel profile', 'Possibility to migrate to kennel''s profile', 'Lehetőség migrálni tulajdonos adatlapról egy kennel adatlapra', 'Possibility to migrate on kennel profile', 'Možnosť zmeny profilu na chovateľskú stanicu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(213, 'Handler', 'Handler', 'Handler', 'Handler ', 'Handler', 'Handler', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(214, 'Create a clear handler profile', 'Create a clear handler profile', 'Create a clear handler''s profile', 'Hozzon létre egy egyértelmű handler adatlapot ', 'Create a clear handler profile', 'Prehľadný profil handlera', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(215, 'Add awards and certificates', 'Add awards and certificates', 'Add awards and certificates', 'Töltse fel díjait és bizonylatait', 'Add awards and certificates', 'Pridávanie ocenení a certifikátov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(216, 'Add your dogshow successes and titles', 'Add your dogshow successes and titles', 'Add your dogshow successes and titles', 'Töltse fel kutyakiállítási sikereit és címeit', 'Add your dogshow successes and titles', 'Pridávanie výstavných úspechov', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(217, 'Add breeds list for handling', 'Add breeds list for handling', 'Add your list of breeds for handling', 'Tüntesse fel az Ön által felvezetni kívánt fajtákat', 'Add breeds list for handling', 'Pridanie zoznamu plemien pre handling', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(218, 'Add photos', 'Add photos', 'Add photos', 'Töltse fel képeit', 'Add photos', 'Pridávanie fotografií', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(219, 'Offer your handling services', 'Offer your handling services', 'Offer your handling services', 'Kínálja handler szolgáltatásait', 'Offer your handling services', 'Možnosť ponuky Vašich služieb handlingu', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(220, 'Share successes via social networks', 'Share successes via social networks', 'Share successes via social networks', 'Osztja meg sikereit a többi közösségi hálón', 'Share successes via social networks', 'Zdieľanie úspechov prostedníctvom sociálnych sietí', 'en', 'http://dfs.fsofts.eu/switch-profile', NULL),
(221, 'Update cover photo', 'Update cover photo', 'Update cover photo', 'Töltse fel a borítóképét', 'Update cover photo', 'Aktualizovať titulnú fotku', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(222, 'Upload', 'Upload', 'Upload', 'Töltés', 'Upload', 'Nahrať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(223, 'Take picture', 'Take picture', 'Take picture', 'Készíts fotót', 'Take picture', 'Urobiť snímku', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(224, 'Save Image', 'Save Image', 'Save Image', 'Kép mentése', 'Save Image', 'Uložiť obrázok', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(225, 'New Snapshot', 'New Snapshot', 'New Snapshot', 'Új pillanatkép', 'New Snapshot', 'Nová snímka', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(226, 'Capture', 'Capture', 'Capture', 'Készítés', 'Capture', 'Odfotiť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(227, 'Cancel', 'Cancel', 'Cancel', 'Mégsem', 'Cancel', 'Zrušiť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(228, 'Close', 'Close', 'Close', 'Bezár', 'Close', 'Zavrieť', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(229, 'Select profile image', 'Select profile image', 'Select profile image', 'Profilkép kiválasztása', 'Select profile image', 'Zvoliť profilový obrázok', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(230, 'We have puppies', 'We have puppies', 'We have puppies', 'Vannak kiskutyáink', 'We have puppies', 'Máme šteniatka', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(231, 'Add friend', 'Add friend', 'Add friend', 'Ismerős hozzáadása', 'Add friend', 'Pridať priateľa', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(232, 'Follow', 'Follow', 'Follow', 'Követés', 'Follow', 'Sledovať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(233, 'FCI number', 'FCI number', 'FCI number', 'FCI szám', 'FCI number', 'FCI číslo', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(234, 'Breeds bred by our kennel', 'Breeds bred by our kennel', 'Breeds bred by our kennel', 'Fajták, amiket kennelük tenyészt', 'Breeds bred by our kennel', 'Plemená chované ', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(235, 'Add', 'Add', 'Add', 'Hozzáad', 'Add', 'Pridať', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(236, 'There are currently no added records', 'There are currently no added records', 'There are currently no added records', 'Jelenleg nincs hozzáadott bejegyzés', 'There are currently no added records', 'Momentálne nie sú pridané žiadne záznamy', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(237, 'Bitches', 'Bitches', 'Bitches', 'Szukák', 'Bitches', 'Feny', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(238, 'Timeline events', 'Timeline events', 'Timeline events', 'Idővonal események', 'Timeline events', 'Časová os', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(239, 'Write a comment', 'Write a comment', 'Write a comment', 'Írj egy megjegyzést', 'Write a comment', 'Napísať komentár', 'en', 'http://dfs.fsofts.eu/kennel-profile', NULL),
(240, 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'Simplicity, accessibility, clarity and beautiful graphics of the website have charmed me and I have added my kennel to it. Its overall reach and audience on the web is an excellent presentation of successful individuals and excellent support for real breeders.', 'Egyszerűség, hozzáférhetőség, egyértelműség és a gyönyörű grafika volt az, ami a honlapon elbűvölt, és e-miatt adtam hozzá a kennelemet. Az elérése és a látogatottsága kitűnő a sikeres tenyésztők bemutatására és kiváló támogatást nyújt a valódi tenyésztőknek.', 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'Jednoduchosť, dostupnosť, prehľadnosť a krásna grafika portálu ma oslovila a pridala som na ňu svoju chovateľskú stanicu. Jej celkový dosah a návštevnosť na webe sú výbornou prezentáciou úspešných jedincov a vynikajúcou podporou pre skutočných chovateľov.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(241, 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'I think it''s a great idea to create a large database of breeders, kennels, stud dogs and handlers. Good luck to you and wish that your database will grow each day and people from the whole world will know about it!', 'Azt hiszem, ez egy jó ötlet létrehozni egy nagy adatbázist a tenyésztőkkel, kennelekkel, tenyészkutyákkal és handlerekkel. Sok szerencsét nektek és azt kívánom, hogy az adatbázis növekedjen minden egyes nappal és az emberek az egész világból tudjanak róla!', 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'Myslím že je to skvelý nápad vytvoriť rozsiahlu databázu chovateľov, ich chovných staníc, krycích psov a handlerov. Držím palce aby sa Vaša databáza aj naďalej rozrastala a aby o nej vedeli ľudia z celého sveta!', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(242, 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'Nice and well organized website, user friendly with nice visuals. I enjoy it, it helps me to keep track of my attended dog shows and represent my dogs and kennel.', 'Szép, jól szervezett honlap, user friendly és szép látványt nyújt a felhasználóknak. Nagyon tetszik és segít nekem nyomon követni az eddigi kiállításaimat, képviseli a kutyáimat és kennelemet.', 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'Pekná a prehľadná stránka, user friendly s veľmi prijemným vizuálom. Teším sa z nej, pomôže mi mať prehľad v mojich absolvovaných vystavách ako aj odreprezentovať moje psy a chovnú stanicu.', 'en', 'http://dfs.fsofts.eu/index.php', NULL),
(243, 'Edit award', 'Edit award', 'Edit an award', 'Díj módosítása', 'Edit award', 'Upraviť ocenenie', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(244, 'Date of the award', 'Date of the award', 'Date of the award ', 'Díj időpontja', 'Date of the award', 'Dátum získania ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(245, 'Select date when award was obtained', 'Select date when award was obtained', 'Select the date when the award was obtained', 'Válassza ki az időpontot, amikor a díjat nyerte', 'Select date when award was obtained', 'Vyberte dátum, kedy bolo ecenenie získané', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(246, 'Name of the award', 'Name of the award', 'Name of the award', 'Díj neve', 'Name of the award', 'Názov ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(247, 'Picture', 'Picture', 'Picture', 'Fenykép', 'Picture', 'Obrázok', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(248, 'Picture of award in jpeg or jpg format', 'Picture of award in jpeg or jpg format', 'Picture of the award in jpeg or jpg format', 'Díj fenyképe jpeg vagy jpg formátumban', 'Picture of award in jpeg or jpg format', 'Obrázok ocenenia v jpeg alebo jpg formáte', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(249, 'Select picture', 'Select picture', 'Select a picture', 'Kép kiválasztása', 'Select picture', 'Zvoliť obrázok', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(250, 'Edit', 'Edit', 'Edit', 'Módosítás', 'Edit', 'Upraviť', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(251, 'Purebred dogs', 'Purebred dogs', 'Purebred dogs', 'Törzskönyves kutyák', 'Purebred dogs', 'Psy s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/list-of-dogs', NULL),
(252, 'Share', 'Share', 'Share', 'Megosztás', 'Share', 'Zdielať', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(253, 'Breed', 'Breed', 'Breed', 'Fajta', 'Breed', 'Plemeno', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(254, 'Gender', 'Gender', 'Gender', 'Nem', 'Gender', 'Pohlavie', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(255, 'Date of birth', 'Date of birth', 'Date of birth', 'Születési dátum', 'Date of birth', 'Dátum narodenia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(256, 'Pedigree registration number', 'Pedigree registration number', 'Pedigree registration number', 'Törzskönyvi szám', 'Pedigree registration number', 'Pedigree No', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(257, 'Height at the withers (cm)', 'Height at the withers (cm)', 'Height at the withers (cm)', 'Marmagasság (cm)', 'Height at the withers (cm)', 'Výška v kohútiku (cm)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(258, 'Weight (kg)', 'Weight (kg)', 'Weight (kg)', 'Súly (kg)', 'Weight (kg)', 'Váha (kg)', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(259, 'Country', 'Country', 'Country', 'Ország', 'Country', 'Krajina', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(260, 'Father', 'Father', 'Father (Sire)', 'Apa ', 'Father', 'Otec', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL);
INSERT INTO `tbl_translate` (`id`, `text_to_translate`, `translated_text_de`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(261, 'Mother', 'Mother', 'Mother (Dam)', 'Anya', 'Mother', 'Matka', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(262, 'Championships', 'Championships', 'Championships', 'Championátusok', 'Championships', 'Šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(263, 'Working exams', 'Working exams', 'Working exams', 'Munkavizsgák', 'Working exams', 'Pracovné skúšky', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(264, 'Health', 'Health', 'Health', 'Egészség', 'Health', 'Zdravotné záznamy', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(265, 'Pedigree', 'Pedigree', 'Pedigree ', 'Törzskönyv', 'Pedigree', 'Rodokmeň', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(266, 'Matings', 'Matings', 'Matings', 'Fedezések', 'Matings', 'Krytia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(267, 'Coowners', 'Coowners', 'Co-owners', 'Társtulajdonosok', 'Coowners', 'Spolumajitelia', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(268, 'Championchips', 'Championchips', 'Championships', 'Championátusok', 'Championchips', 'Šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile?id=2', NULL),
(269, 'Remove from friends', 'Remove from friends', 'Remove from friends', 'Ismerős törlése', 'Remove from friends', 'Odobrať z priateľov', 'en', 'http://dfs.fsofts.eu/list-of-kennels', NULL),
(270, 'Website', 'Website', 'Website', 'Weboldal', 'Website', 'Webstránka', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=2', NULL),
(271, 'Delete', 'Delete', 'Delete', 'Törlés', 'Delete', 'Odstrániť', 'en', 'http://dfs.fsofts.eu/kennel-awards-edit?id=1', NULL),
(272, 'Bitch', 'Bitch', 'Bitch', 'Szuka', 'Bitch', 'Fena', 'en', 'http://dfs.fsofts.eu/dog-profile?id=1', NULL),
(273, 'Class', 'Class', 'Class', 'Osztály', 'Class', 'Trieda', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(274, 'Champion', 'Champion', 'Champion', 'Champion', 'Champion', 'Šampión', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(275, 'Judge', 'Judge', 'Judge', 'Bíró', 'Judge', 'Rozhodca', 'en', 'http://dfs.fsofts.eu/dog-show-list?id=1&dog_id=1', NULL),
(276, 'This feature is unavailable to view on small screens', 'This feature is unavailable to view on small screens', 'This feature is unavailable to view on small screens', 'Ez a szolgáltatás nem elérhető megtekinteni kis képernyőn', 'This feature is unavailable to view on small screens', 'Táto funkcia nie je prístupná pre zariadenia s malým rozlíšením obrazovky', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(277, 'Name of the father', 'Name of the father', 'Name of the father (sire)', 'Apa neve', 'Name of the father', 'Meno otca', 'en', 'http://dfs.fsofts.eu/dog-pedigree?id=1&dog_id=1', NULL),
(278, 'Add championchip', 'Add championchip', 'Add championship', 'Championátus hozzáadása', 'Add championchip', 'Pridať šampionát', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(279, 'Date of Championship award', 'Date of Championship award', 'Date of the Championship award', 'Championátus időpontja', 'Date of Championship award', 'Dátum získania šampionátu', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(280, 'Select date when the championship was awarded', 'Select date when the championship was awarded', 'Select date when the championship was awarded', 'Válassza ki az időpontot, amikor a Championátust megszerezte', 'Select date when the championship was awarded', 'Vyberte dátum, kedy bolo šampionát získaný', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(281, 'Championship', 'Championship', 'Championship', 'Championátus', 'Championship', 'Šampionát', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(282, 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Enter the championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Írja be a championátust (pl. Junior Champion of Slovakia). Kérjük, írjon csak egy címet egy időben a jobb érthetőség végett.', 'Enter a championship (e.g. Junior Champion of Slovakia). For better clarity of your dog’s profile, please enter only one title at a time.', 'Zadajte názov šampionátu (napr. Junior šampión Slovenska). Pre lepšiu prehľadnosť zadávajte prosím naraz iba jeden šampionát ', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(283, 'Junior champion of Hungary', 'Junior champion of Hungary', 'Junior Champion of Hungary', 'Hungária Junior Champion', 'Junior champion of Hungary', 'Junior šampión Maďarska', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(284, 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Kép feltöltése (pl.a diplomáról, bizonyítványról - jpeg vagy jpg formátumban) Ez a mező nem kötelező', 'Upload the image (e.g. diploma received for each degree, or certificate – in jpg or jpeg format). This field is optional', 'Nahrajte obrázok (diplom alebo certifikát vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-championschip-add?dog_id=1', NULL),
(285, 'Edit championship', 'Edit championship', 'Edit the championship', 'Championátus módosítása', 'Edit championship', 'Úprava šampionátu', 'en', 'http://dfs.fsofts.eu/dog-championschip-edit?id=1&dog_id=1', NULL),
(286, 'Edit show result', 'Edit show result', 'Edit the show result', 'Kutyakiállítás eredmény módosítása', 'Edit show result', 'Úprava výstavného výsledku', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(287, 'Date of show', 'Date of show', 'Date of the show', 'Kutyakiállítás időpontja', 'Date of show', 'Dátum výstavy', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(288, 'Select the date on which the show was held', 'Select the date on which the show was held', 'Select the date on which the show was held', 'Válassza ki az időpontot, amikor a kutyakiállítás tartott', 'Select the date on which the show was held', 'Vyberte dátum, kedy sa výstava konala', 'en', 'http://dfs.fsofts.eu/dog-show-edit?dog_id=1', NULL),
(289, 'Add show result', 'Add show result', 'Add show result', 'Kutyakiállítási eredmény hozzáadása', 'Add show result', 'Pridanie výstavného výsledku', 'en', 'http://dfs.fsofts.eu/dog-show-add?dog_id=1', NULL),
(290, 'Edit working exam', 'Edit working exam', 'Edit the working exam', 'Munkavizsga módosítása', 'Edit working exam', 'Úprava pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(291, 'Date exam passed', 'Date exam passed', 'Date of passed exam', 'Munkavizsga időpontja', 'Date exam passed', 'Dátum absolvovania pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(292, 'Enter the date working exam completed', 'Enter the date working exam completed', 'Enter the date when working exam was completed', 'Válassza ki az időpontot, amikor a munkavizsgát megszerezte', 'Enter the date working exam completed', 'Vyberte dátum absolvovania pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(293, 'Type of exam', 'Type of exam', 'Type of the exam', 'Munkavizsga típusa', 'Type of exam', 'Typ pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(294, 'Enter the type of working exam (e.g. IPO 1)', 'Enter the type of working exam (e.g. IPO 1)', 'Enter the type of working exam (e.g. IPO 1)', 'Írja be a munkavizsga típusát (pl. IPO 1)', 'Enter the type of working exam (e.g. IPO 1)', 'Zadajte názov alebo typ pracovnej skúšky (napríklad IPO1)', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(295, 'For example IPO 1', 'For example IPO 1', 'For example IPO 1', 'Pl. IPO 1', 'For example IPO 1', 'napríklad IPO1', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(296, 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Upload the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Kép feltöltése (pl.a diplomaról, bizonylatról - jpeg vagy jpg formátumban) Ez a mező nem kötelező', 'Record the picture (e.g. diploma received in a working exam or a certificate – in jpg or jpeg format. This field is optional', 'Nahrajte obrázok (diplom alebo certifikát vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-workexam-edit?id=1&dog_id=1', NULL),
(297, 'Add working exam', 'Add working exam', 'Add working exam', 'Munkavizsga hozzáadása', 'Add working exam', 'Pridanie pracovnej skúšky', 'en', 'http://dfs.fsofts.eu/dog-workexam-add?dog_id=1', NULL),
(298, 'Add health record', 'Add health record', 'Add health record', 'Egészségügyi szűrés hozzáadása', 'Add health record', 'Pridanie zdravotného záznamu', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(299, 'Date of the health record', 'Date of the health record', 'Date of the health record', 'Egészségügyi szűrés időpontja', 'Date of the health record', 'Dátum zdravotného vyšetrenia', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(300, 'Enter the date the health record was issued', 'Enter the date the health record was issued', 'Enter the date when health record was issued', 'Válassza ki az időpontot, amikor az egészségügyi szűrést megcsináltatta', 'Enter the date the health record was issued', 'Vyberte dátum kedy bolo zdravotné vyšetrenie absolvované', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(301, 'Description of the health record', 'Description of the health record', 'Description of the health record', 'Egészségügyi szűrés leírása', 'Description of the health record', 'Typ zdravotného vyšetrenia', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(302, 'Enter a description or type of health record (e.g. HD, ED)', 'Enter a description or type of health record (e.g. HD, ED)', 'Enter a description or type of health record (e.g. HD, ED)', 'Írja be az egészségügyi szűrés típusát (pl. HD/csípő diszplázia, ED/könyök diszplázia)', 'Enter a description or type of health record (e.g. HD, ED)', 'Zadajte popis alebo ty zdravotného vyšetrenia (napríklad HD, ED)', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(303, 'Hip Dysplasia', 'Hip Dysplasia', 'Hip Dysplasia', 'Csípő diszplázia', 'Hip Dysplasia', 'napríklad HD A/A', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(304, 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Upload the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Kép feltöltése (pl.az egészségügyi szűrésről - jpeg vagy jpg formátumban) Ez a mező nem kötelező', 'Record the picture (e.g. health report – image in jpg or jpeg format). This field is optional', 'Nahrajte obrázok (zdravotný záznam vo formáte jpg alebo jpeg )', 'en', 'http://dfs.fsofts.eu/dog-health-add?dog_id=1', NULL),
(305, 'Add mating', 'Add mating', 'Add mating', 'Fedezés hozzáadása', 'Add mating', 'Pridanie krytia', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(306, 'Date of mating', 'Date of mating', 'Date of mating', 'Fedezés időpontja', 'Date of mating', 'Dátum krytia', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(307, 'Enter the date, when the mating was', 'Enter the date, when the mating was', 'Enter the date when mating was accomplished', 'Válassza ki az időpontot, amikor a fedezés megtörtént', 'Enter the date, when the mating was', 'Vyberte dátum, kedy prebehlo krytie', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(308, 'Name of the bitch', 'Name of the bitch', 'Name of the bitch', 'Szuka neve', 'Name of the bitch', 'Meno suky', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(309, 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'Please enter the bitch''s name or select the bitch from the DOGFORSHOW database for interactivity', 'Kérjük, adja meg a szuka nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', 'Please enter the bitch name or select bitch from the DOGFORSHOW database for interactivity', 'Zadajte meno suky alebo vyberte meno suky z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(310, 'Picture of the bitch', 'Picture of the bitch', 'Picture of the bitch', 'Szuka fenyképe', 'Picture of the bitch', 'Obrázok suky', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(311, 'Record the bitch picture in jpg or jpeg format. This field is optional', 'Record the bitch picture in jpg or jpeg format. This field is optional', 'Upload the bitch''s picture in jpg or jpeg format. This field is optional', 'Kép feltöltése a szukától jpeg vagy jpg formátumban. Ez a mező nem kötelező', 'Record the bitch picture in jpg or jpeg format. This field is optional', 'Nahrajte obrázok suky vo formáte jpg alebo jpeg. Obrázok nie je povinný', 'en', 'http://dfs.fsofts.eu/dog-mating-add?dog_id=1', NULL),
(312, 'Edit dog profile', 'Edit dog profile', 'Edit the dog''s profile', 'Kutya adatlapja módosítása', 'Edit dog profile', 'Upraviť profil psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(313, 'Informations', 'Informations', 'Informations', 'Információk', 'Informations', 'Informácie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(314, 'Pictures', 'Pictures', 'Pictures', 'Fenyképek', 'Pictures', 'Obrázky', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(315, 'Basic informations about your dog', 'Basic informations about your dog', 'Basic informations about your dog', 'Alapvető információk a kutyájáról', 'Basic informations about your dog', 'Základné informácie o vašom psovi', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(316, 'Select the dog’s gender', 'Select the dog’s gender', 'Select the dog’s gender', 'Válassza ki a kutya nemét', 'Select the dog’s gender', 'Vyberte pohlavie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(317, 'Dog', 'Dog', 'Dog', 'Kutya', 'Dog', 'Pes', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(318, 'Offer your dog for mating', 'Offer your dog for mating', 'Offer your dog as a stud dog', 'Kínálja kutyáját fedezésre', 'Offer your dog for mating', 'Ponúknuť psa na krytie', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(319, 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'This option is available only for males. After checking this option, your dog will be automatically added also to the list of stud dogs.', 'Ez a lehetőség csak a kanok számára elérhető. Ha él ezzel a lehetőséggel, akkor a tenyészkanja automatikusan bekerül a többi tenyészkan közé.', 'This option can by selected only for a male dog. After checking this option, your dog will be automatically also in the list of dogs for mating', 'Táto možnosť môže byť vybraná iba v prípade, že pohlavie jedinca je pes', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(320, 'Yes', 'Yes', 'Yes', 'Igen', 'Yes', 'Áno', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(321, 'Select breed', 'Select breed', 'Select breed', 'Fajta kiválasztása', 'Select breed', 'Vyberte plemeno', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(322, 'Choose a breed from the list.', 'Choose a breed from the list.', 'Choose the breed from the list.', 'Válasszon egy fajtát a listából.', 'Choose a breed from the list.', 'Vyberte plemeno zo zoznamu ', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(323, 'Please select', 'Please select', 'Please select', 'Kérem válasszon', 'Please select', 'Vyberte si', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(324, 'Dog name', 'Dog name', 'Dog''s name', 'Kutya neve', 'Dog name', 'Meno psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(325, 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'Enter your dog’s name which is shown in the pedigree certificate. Please don''t fill any championships before the name.', 'Adja meg a kutya nevét, ami a törzskönyvében szerepel. Kérjük, ne írjon semmi championátust a neve elé.', 'Enter your dog’s name as shown in the pedigree certificate. Please dont fill any championships before the name.', 'Zadajte meno psa tak, ako má uvedené v preukaze o pôvode psa. Pred menom nevypĺňajte žiadne dosiahnuté šampionáty', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(326, 'Dog name as shown in the pedigree', 'Dog name as shown in the pedigree', 'Dog name which is shown in the pedigree', 'Kutya neve ami a törzskönyvében szerepel.', 'Dog name as shown in the pedigree', 'Meno psa ako je uvedené v rodokmeni', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(327, 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number which is shown in the pedigree certificate', 'Írja be a törzskönyvi jelét (pl. LOSM, SPKP, CSHPK) és ezután írja be a törzskönyvi számát, ami látható a törzskönyvében', 'Enter the name of the breed registry at first (e.g. LOSM, SPKP, CSHPK) and then registration number shown in the pedigree certificate', 'Zadajte zápis v plemenej knihe v tvare (napríklad LOSM, SPKP, CMKU, CSHPK) a následne registračné číslo', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(328, 'For example SPKP 2667', 'For example SPKP 2667', 'For example SPKP 2667', 'Pl. SPKP 2667', 'For example SPKP 2667', 'napríklad SPKP 2667', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(329, 'Day, month and year of birth of your dog', 'Day, month and year of birth of your dog', 'Day, month and year of birth of your dog', 'Kutya születési dátuma (nap, hónap, év)', 'Day, month and year of birth of your dog', 'Deň, mesiac a rok narodenia psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(330, 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'Enter the height at withers in centimeters. This information is very useful for people who are using the searching of dogs for mating with some specific height in withers', 'Tüntesse fel a marmagasságot centiméterben. Ez az információ nagyon hasznos azok számára, akik használják a keresést és konkrét magasság érdekli őket.', 'Enter the height at withers in centimeters. This information is very good for people, which using the searching dogs for mating with some specific height in withers', 'Zadajte výšku v kohútiku v centimetroch. Táto informácia je veľmi užitočná pre ľudí, ktorí hľadajú napríklad psov na krytie so špecifickou výškou', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(331, 'Height at the withers in centimeters', 'Height at the withers in centimeters', 'Height at the withers in centimeters', 'Marmagasság centiméterben', 'Height at the withers in centimeters', 'Výsška v kohútiku v centimetroch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(332, 'Enter your dog’s weight in kilograms', 'Enter your dog’s weight in kilograms', 'Enter your dog’s weight in kilograms', 'Tüntesse fel a kutyája súlyát kilogramban', 'Enter your dog’s weight in kilograms', 'Zadajte váhu psa v kilogramoch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(333, 'Weight of dog in kilograms', 'Weight of dog in kilograms', 'Weight of the dog in kilograms', 'Kutya súlya kilogramban', 'Weight of dog in kilograms', 'Váha psa v kilogramoch', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(334, 'Country in which the dog is currently located', 'Country in which the dog is currently located', 'Country in which the dog is currently located', 'Ország ahol a kutya tartózkodik', 'Country in which the dog is currently located', 'Názov štátu v ktorom sa pes momentálne nachádza', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(335, 'Father of the dog', 'Father of the dog', 'Father (sire) of the dog', 'Kutya apja', 'Father of the dog', 'Otec psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(336, 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter the father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Kérjük, adja meg a kutya apja nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', 'Please enter father''s name or select father''s name from the DOGFORSHOW database for interactive pedigree', 'Zadajte meno otca psa alebo vyberte meno otca psa z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(337, 'Mother of the dog', 'Mother of the dog', 'Mother (dam) of the dog', 'Kutya anyja', 'Mother of the dog', 'Matka psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(338, 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Please enter the mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Kérjük, adja meg a kutya anyja nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából ', 'Please enter mother''s name or select mother''s name from the DOGFORSHOW database for interactive pedigree', 'Zadajte meno matky psa alebo vyberte meno matky psa z DOGFORSHOW databázy pre interaktivitu', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(339, 'Dog profile picture', 'Dog profile picture', 'Dog''s profile picture', 'Kutya profilképe', 'Dog profile picture', 'Profilový obrázok psa', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(340, 'Upload a profile image of your dog in JPG or PNG format', 'Upload a profile image of your dog in JPG or PNG format', 'Upload a profile image of your dog in JPG or PNG format', 'Profilkép feltöltése JPG vagy PNG formátumban', 'Upload a profile image of your dog in JPG or PNG format', 'Nahrajte profilový obrázok psa vo formáte jpg alebo jpeg', 'en', 'http://dfs.fsofts.eu/dog-profile-edit?id=1&dog_id=1', NULL),
(341, 'Please select state...', 'Please select state...', 'Please select the state...', 'Kérem válasszon országot', 'Please select state...', 'Prosím vyberte štát', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(342, 'Add coowner', 'Add coowner', 'Add co-owner', 'Társtulajdonos hozzáadása', 'Add coowner', 'Pridanie spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(343, 'Name of the coowner', 'Name of the coowner', 'Name of the co-owner', 'Társtulajdonos neve', 'Name of the coowner', 'Meno spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(344, 'Name and surname of co-owner', 'Name and surname of co-owner', 'Name and surname of the co-owner', 'Társtulajdonos keresztneve és vezetékneve', 'Name and surname of co-owner', 'Meno a priezvisko spolumajiteľa', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(345, 'Please select country, where are the co-owner situated', 'Please select country, where are the co-owner situated', 'Please select country where the co-owner lives', 'Kérem válasszon országot, ahol a társtulajdonos lakik', 'Please select country, where are the co-owner situated', 'Prosím vyberte štát, v ktorom sa spolumajiteľ nachádza', 'en', 'http://dfs.fsofts.eu/dog-coowner-add?dog_id=1', NULL),
(346, 'Add award', 'Add award', 'Add award', 'Díj hozzáadása', 'Add award', 'Pridanie ocenenia', 'en', 'http://dfs.fsofts.eu/kennel-awards-add', NULL),
(347, 'Password change', 'Password change', 'Password change', 'Jelszócsere', 'Password change', 'Zmeniť heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(348, 'Account informations', 'Account informations', 'Account informations', 'Fiók beállitások', 'Account informations', 'Informácie o účte', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(349, 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Információk jelöltek ezzel a jellel nem lesznek hozzáférhetők a nyilvánosságnak vagy nem lesznek kereskedelmi használatra felhasználva harmadik fél által', 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties', 'Informácie označené týmto symbolom nebudú sprístupnené verejnosti alebo zneužívané pre komerčné účely tretích strán', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(350, 'Your name without numeric signs', 'Your name without numeric signs', 'Your name without numeric signs', 'Az Ön neve numerikus jelek nélkül', 'Your name without numeric signs', 'Vaše meno bez číslic', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(351, 'Your surname without numeric signs', 'Your surname without numeric signs', 'Your surname without numeric signs', 'Az Ön vezetékneve numerikus jelek nélkül', 'Your surname without numeric signs', 'Vaše priezvisko bez číslic', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(352, 'Country where you live', 'Country where you live', 'Country where you live', 'Az ország, ahol él', 'Country where you live', 'Štát v ktorom žijete', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(353, 'Additional account informations', 'Additional account informations', 'Additional account informations', 'További fiók információk', 'Additional account informations', 'Doplnkové informácie o účte', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(354, 'Address', 'Address', 'Address', 'Cím', 'Address', 'Adresa', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(355, 'Your address', 'Your address', 'Your address', 'Az Ön címe', 'Your address', 'Vaša adresa', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(356, 'Town', 'Town', 'Town', 'Város', 'Town', 'Mesto', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(357, 'Town where you live', 'Town where you live', 'Town where you live', 'A város ahol él', 'Town where you live', 'Mesto v ktorom žijete', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(358, 'ZIP', 'ZIP', 'ZIP', 'Irányítószám', 'ZIP', 'PSČ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(359, 'Enter the zip code of the place where you live', 'Enter the zip code of the place where you live', 'Enter the zip code of the place where you live', 'Tüntesse fel a hely irányítószámát, ahol él', 'Enter the zip code of the place where you live', 'Zadajte poštové smerovacie číslo ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(360, 'Phone number', 'Phone number', 'Phone number', 'Telefonszám', 'Phone number', 'Telefónne číslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(361, 'Your phone number', 'Your phone number', 'Your phone number', 'Az Ön telefonszáma', 'Your phone number', 'Zadajte telefóne číslo v medzinárodnom tvare napríklad +42xxxxxxxxxx', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(362, 'Year of birth', 'Year of birth', 'Year of birth', 'Születési év', 'Year of birth', 'Rok narodenia', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(363, 'Your year of birth', 'Your year of birth', 'Your year of birth', 'Az Ön születési éve', 'Your year of birth', 'Váš rok narodenia', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(364, 'Save', 'Save', 'Save', 'Mentés', 'Save', 'Uložiť', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(365, 'Old password', 'Old password', 'Old password', 'Régi jelszó', 'Old password', 'Staré heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(366, 'Type your old password', 'Type your old password', 'Type your old password', 'Írja be a régi jelszavát', 'Type your old password', 'Zadajte vaše staré heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(367, 'New password', 'New password', 'New password', 'Új jelszó', 'New password', 'Nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(368, 'Type your new password', 'Type your new password', 'Type your new password', 'Írja be az új jelszavát', 'Type your new password', 'Zadajte vaše nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(369, 'Confirm new password', 'Confirm new password', 'Confirm new password', 'Erősítse meg az új jelszót', 'Confirm new password', 'Potvrďte vaše nové heslo', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(370, 'Confirm your new password', 'Confirm your new password', 'Confirm your new password', 'Erősítse meg az új jelszavát', 'Confirm your new password', 'Zadajte ešte raz vaše nové heslo ', 'en', 'http://dfs.fsofts.eu/edit-account', NULL),
(371, 'Basic informations about your kennel', 'Basic informations about your kennel', 'Basic informations about your kennel', 'Alapvető információk a kenneléről', 'Basic informations about your kennel', 'Základné informácie o vašej chovateľskej stanici', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(372, 'Kennel name', 'Kennel name', 'Kennel name', 'Kennel név', 'Kennel name', 'Názov chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(373, 'Name of your kennel', 'Name of your kennel', 'Name of your kennel', 'A kennel neve', 'Name of your kennel', 'Zadajte názov vašej chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(374, 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Írja be az FCI számot ebben a formátumban - 1580/2015. Ha nem FCI kennel, kérjük hagyja üresen a mezőt', 'Fill the FCI number in the form 1580/2015. If you are non FCI kennel, please leave this field empty', 'Zadajte FCI číslo chovateľskej stanice v tvare napríklad 1580/2015. Pokiaľ nie ste FCI chovateľská stanica, nevypĺňajte toto pole', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(375, 'Kennel website', 'Kennel website', 'Kennel''s website', 'Kennel weboldala', 'Kennel website', 'Webstránka vašej chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(376, 'Enter the website of your kennel', 'Enter the website of your kennel', 'Enter the website of your kennel', 'Tüntesse fel a kennel weboldalát', 'Enter the website of your kennel', 'Zadajte adresu webstránky vašej chovateľskej stanice v tvare www.vasastranka.com', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(377, 'www.yourwebsite.com', 'www.yourwebsite.com', 'www.yourwebsite.com', '', 'www.yourwebsite.com', '', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(378, 'Kennel description', 'Kennel description', 'Kennel''s description', 'Kennel leírása', 'Kennel description', 'Popis chovateľskej stanice', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(379, 'Enter information about your kennel', 'Enter information about your kennel', 'Enter some informations about your kennel', 'Tüntessen fel valami információt kenneléről', 'Enter information about your kennel', 'Zadajte informácie o vašej chovateľskej stanici', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(380, 'Select the breed bred by your kennel', 'Select the breed bred by your kennel', 'Select the breed(s) bred by your kennel', 'Válasszon fajtát (fajtákat) amiket kennelük tenyészt', 'Select the breed bred by your kennel', 'Vyberte plemeno, ktorého chovu sa venuje vaša chovateľská stanica', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(381, 'Choose one ore more breeds bred by your kennel', 'Choose one ore more breeds bred by your kennel', 'Choose one or more breeds bred by your kennel', 'Válasszon egy vagy több fajtát, amiket kennelük tenyészt', 'Choose one ore more breeds bred by your kennel', 'Vyberte zo zoznamu plemien jedno alebo viacej plemien ktorého chovu sa venuje vaša chovateľská stanica', 'en', 'http://dfs.fsofts.eu/kennel-edit-profile', NULL),
(382, 'Owner of purebred dog profile', 'Owner of purebred dog profile', 'Owner of purebred dog''s profile', 'Kutya tulajdonos adatlapja', 'Owner of purebred dog profile', 'Majiteľ psa s preukazom pôvodu', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(383, 'Basic informations about you', 'Basic informations about you', 'Basic informations about you', 'Alapvető információk Önről', 'Basic informations about you', 'Základné ifnormácie o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(384, 'Your profile picture', 'Your profile picture', 'Your profile picture', 'Az Ön profilképe', 'Your profile picture', 'Váš profilový obrázok', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(385, 'Your profile picture in jpeg or jpg format', 'Your profile picture in jpeg or jpg format', 'Your profile picture in jpeg or jpg format', 'Az Ön profilképe jpeg vagy jpg formátumban', 'Your profile picture in jpeg or jpg format', 'Nahrajte váš profilový obrázok vo formáte jpg alebo jpeg', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(386, 'Short description about you', 'Short description about you', 'Short description about you', 'Rövid leírás Önről', 'Short description about you', 'Krátky popis o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(387, 'Enter some informations about yourself', 'Enter some informations about yourself', 'Enter some informations about yourself', 'Tüntessen fel valami információt Önről', 'Enter some informations about yourself', 'Zadajte krátky popis o vás', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(388, 'Short description', 'Short description', 'Short description', 'Rövid leírás', 'Short description', 'Krátky popis', 'en', 'http://dfs.fsofts.eu/owner-create-profile', NULL),
(389, 'Add a dog', 'Add a dog', 'Add a dog', 'Kutya hozzáadása', 'Add a dog', 'Pridať psa', 'en', 'http://dfs.fsofts.eu/add-dog', NULL),
(390, 'Available for mating', 'Available for mating', 'Available for stud ', 'Fedezésre rendelkezésre álló', 'Available for mating', 'Ponuka na krytie', 'en', 'http://dfs.fsofts.eu/kennel-profile?id=1&_fid=mbbn', NULL),
(391, 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'Your user account has not been activated yet. Please confirm by clicking on the link in your email to fully activate your account. You can resend it by clicking on following link', 'Az Ön felhasználói fiókja nincs még aktiválva. Kérjük, erősítse meg egy kattintással az e-mail-ben szerepelő linkre, hogy teljes mértékben aktiválja fiókját. Úrja küldheti egy kattintással a linkre.', 'Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link', 'Váš užívateľský účet nie je aktivovaný. Aktivujte ho prosím kliknutím na odkaz, ktorý vám bol odoslaný v registračnom emaily. Váš registračný email si môžete znova preposlať kliknutím na nasledujúci odkaz.', 'en', 'http://localhost/dfs/index.php', NULL),
(392, 'Resend registration email', 'Resend registration email', 'Resend activation email', 'E-mail újraküldése', 'Resend registration email', 'Preposlať registračný email', 'en', 'http://localhost/dfs/index.php', NULL),
(393, 'Welcome to DOGFORSHOW', 'Welcome to DOGFORSHOW', 'Welcome to DOGFORSHOW', 'Üdvözöljük a DOGFORSHOW oldalon', 'Welcome to DOGFORSHOW', 'Vitajte na DOGFORSHOW', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(394, 'Hello', 'Hello', 'Hello', 'Szia', 'Hello', 'Ahoj', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(395, 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Köszönjük regisztrációját a DOGFORSHOW oldalon. Kérjük aktiválja fiókját egy kattintással a következő linkre.', 'Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link', 'Ďakujeme za registráciu na portáli DOGFORSHOW. Aktivujte si účet kliknutím na nasledujúci odkaz', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(396, 'Activate account', 'Activate account', 'Account activation', 'Fiók aktiválása', 'Activate account', 'Aktivovať účet', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(397, 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'This is an automatically generated email sent by the DOGFORSHOW system, please do not reply to this message.', 'Ez egy automatikusan generált e-mail a DOGFORSHOW-tól, kérjük, ne válaszoljon erre az üzenetre.', 'This email was automatically sent by DOGFORSHOW system. Please dont reply on this email', 'Tento email bol odoslaný automaticky systémom DOGFORSHOW. Prosíme Vás neodpovedajte na tento email', 'en', 'http://localhost/dfs/index.php?resend_al=2', NULL),
(398, 'Wrong username or password.', 'Wrong username or password.', 'Incorrect username or password', 'Hibás felhasználónév vagy jelszó', 'Wrong username or password.', 'Zle zadané užívateľské meno alebo heslo', 'en', 'http://www.dogshow.com/index.php', NULL),
(399, 'Your registration has been successfully completed', 'Your registration has been successfully completed', 'Your registration has been completed successfully.', 'A regisztráció sikeresen befejeződött.', 'Your registration has been successfully completed', 'Vaša registrácia bola úspešne ukončená', 'en', 'http://www.dogshow.com/index.php', NULL),
(400, 'Please check your Email for your user acccount activation', 'Please check your Email for your user acccount activation', 'Please check your email to activate your user account', 'Kérjük ellenőrizze, hogy regisztrációja során megadott e-mail címére érkezett levelét látta-e, és rákattintott-e az aktiváló linkre', 'Please check your Email for your user acccount activation', 'Skontrolujte si prosím email pre aktiváciu účtu', 'en', 'http://www.dogshow.com/index.php', NULL),
(401, 'If you have not received the Email yet, please also check your SPAM folder', 'If you have not received the Email yet, please also check your SPAM folder', 'If you have not received the email yet, please also check your SPAM folder', 'Ha még nem kapta meg az e-mail, kérjük, ellenőrizze a spam mappát is', 'If you have not received the Email yet, please also check your SPAM folder', 'Ak ste email ešte neobdržali, skontrolujte si prosím priečinok SPAM alebo nevyžiadanú poštu', 'en', 'http://www.dogshow.com/index.php', NULL),
(402, 'Kennel profile', 'Kennel profile', 'Kennel''s profile', 'Kennel adatlapja', 'Kennel profile', 'Profil chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(403, 'Kennel profile picture', 'Kennel profile picture', 'Kennel''s profile picture', 'Kennel profilképe', 'Kennel profile picture', 'Profilový obrázok chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(404, 'Profile picture of your kennel in jpeg or jpg format', 'Profile picture of your kennel in jpeg or jpg format', 'Profile picture of your kennel in jpeg or jpg format', 'Profilkép feltöltése jpeg vagy jpg formátumban', 'Profile picture of your kennel in jpeg or jpg format', 'Profilový obrázok chovateľskej stanice vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(405, 'Enter some informations about your kennel', 'Enter some informations about your kennel', 'Enter some informations about your kennel', 'Tüntessen fel valami információkat kenneléről', 'Enter some informations about your kennel', 'Zadajte informácie alebo stručný popis o vašej chovateľskej stanici', 'en', 'http://www.dogshow.com/kennel-create-profile', NULL),
(406, 'Owner', 'Owner', 'Owner', 'Tulajdonos', 'Owner', 'Majiteľ psa s preukazom pôvodu', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(407, 'About me', 'About me', 'About me', 'Rólam', 'About me', 'O mne', 'en', 'http://www.dogshow.com/owner-profile?_fid=oerz', NULL),
(408, 'Name of the kennel', 'Name of the kennel', 'Name of the kennel', 'Kennelnév', 'Name of the kennel', 'Názov chovateľskej stanice', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(409, 'Name of the planned litter', 'Name of the planned litter', 'Name of the planned litter', 'Tervezett alom neve', 'Name of the planned litter', 'Názov plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(410, 'Planned litter', 'Planned litter', 'Planned litter ', 'Tervezett alom', 'Planned litter', 'Plánovaný vrh', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(411, 'Scheduled date of birth of the puppies', 'Scheduled date of birth of the puppies', 'Scheduled date of birth of the puppies', 'Kiskutyák tervezett születési dátuma', 'Scheduled date of birth of the puppies', 'Plánovaný dátum narodenia šteniatok', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(412, 'Add puppies', 'Add puppies', 'Add puppies', 'Kiskutyák hozzáadása', 'Add puppies', 'Pridať šteňiatko', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(413, 'View detail', 'View detail', 'View details', 'Részletek megtekintése', 'View detail', 'Zobraziť detail', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(414, 'Puppies', 'Puppies', 'Puppies', 'Kiskutyák', 'Puppies', 'Šteniatká', 'en', 'http://www.dogshow.com/kennel-planned-litter-list?id=200000000', NULL),
(415, 'Edit awards', 'Edit awards', 'Edit awards ', 'Díjak szerkesztése', 'Edit awards', 'Upraviť ocenenia', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(416, 'Remove from timeline', 'Remove from timeline', 'Remove from timeline', 'Eltávolítás az idővonalról', 'Remove from timeline', 'Odstrániť z časovej osi', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(417, 'Like', 'Like', 'Like', 'Tetszik', 'Like', 'Páči sa mi', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(418, 'Profile updated', 'Profile updated', 'Profile updated', 'Adatlap frissítve', 'Profile updated', 'Profil aktualizovaný', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000&_fid=9dff', NULL),
(419, 'Add awards', 'Add awards', 'Add awards', 'Díj hozzáadása', 'Add awards', 'Pridať ocenenia', 'en', 'http://www.dogshow.com/kennel-profile?id=200000000', NULL),
(420, 'Add show', 'Add show', 'Add a show', 'Kutyakiállítás hozzáadása', 'Add show', 'Pridať výstavu', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(421, 'Add result', 'Add result', 'Add a result', 'Eredmény hozzáadása', 'Add result', 'Pridať výsledok', 'en', 'http://www.dogshow.com/handler-show-list?handler_id=0', NULL),
(422, 'Delete messages', 'Delete messages', 'Delete messages', 'Üzenetek törlése', 'Delete messages', 'Zmazať správy', 'en', 'http://www.dogshow.com/message-list', NULL),
(423, 'Type your message', 'Type your message', 'Type your message', 'Írja be az üzenetet', 'Type your message', 'Napísať správu', 'en', 'http://www.dogshow.com/message-compose', NULL),
(424, 'Breed list does not contain entered breed', 'Breed list does not contain entered breed', 'Breed list does not contain the entered breed', 'A lista nem tartalmazza a beírt fajtát', 'Breed list does not contain entered breed', 'Zoznam plemien neobsahuje zadané plemeno', 'en', 'http://www.dogshow.com/kennel-edit-profile', NULL),
(425, 'Respected breeder, judge, writer', 'Respected breeder, judge, writer', 'Respected breeder, judge, writer', 'Tisztelt tenyésztő, bíró, író', 'Respected breeder, judge, writer', 'Rešpetkovaný chovateľ, rozhodca, spisovateľ', 'en', 'http://www.dogshow.com/index.php', NULL),
(426, 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'Nagyon tetszik a minőség, amit eddig láttam a DOGFORSHOW oldalon. Sok aktív tagot kívánok a honlapnak, mivel biztos vagyok benne, hogy még sok jót fog hozni és nem csak a kutya tulajdonosoknak, vagy más kutyás embernek. ', 'I am very impressed with the quality of what I have seen so far on the DOGFORSHOW. I wish for website to have much circulation, as I am sure that it will benefit people, whether dog owners or others.', 'Som naozaj zaujatý kvalitou toho, čo som videl na portáli DOGFORSHOW. Želám stránke veľký úspech pretože som si istý, že je veľkým prínosom či už majiteľom psov alebo iným osobám.', 'en', 'http://www.dogshow.com/index.php', NULL),
(427, 'Unlike', 'Unlike', 'Dislike', 'Nem tetszik', 'Unlike', 'Nepáči sa mi', 'en', 'http://www.dogshow.com/timeline', NULL),
(428, 'For sale', 'For sale', 'For sale ', 'Eladó', 'For sale', 'Na predaj', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(429, 'Reserved', 'Reserved', 'Reserved', 'Foglalt', 'Reserved', 'Rezervované', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(430, 'Sold', 'Sold', 'Sold', 'Eladott', 'Sold', 'Predané', 'en', 'http://www.dogshow.com/kennel-puppy-list?id=200000000', NULL),
(431, 'Search', 'Search', 'Search', 'Keresés', 'Search', 'Hľadať', 'en', 'http://www.dogshow.com/list-of-owners', NULL),
(432, 'Edit a dog', 'Edit a dog', 'Edit a dog', 'Kutya szerkesztése', 'Edit a dog', 'Upraviť psa', 'en', 'http://www.dogshow.com/dog-profile-edit?id=500000000&dog_id=500000000', NULL),
(433, 'Show type', 'Show type', 'Show type', 'Kutykiállítás típusa', 'Show type', 'Druh výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL);
INSERT INTO `tbl_translate` (`id`, `text_to_translate`, `translated_text_de`, `translated_text_en`, `translated_text_hu`, `translated_text_cz`, `translated_text_sk`, `lang`, `url`, `uri`) VALUES
(434, 'Select type of exhibition', 'Select type of exhibition', 'Select the type of the exhibition', 'Válassza ki a kiállítás típusát', 'Select type of exhibition', 'Vyberte druh výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(435, 'Name of the show', 'Name of the show', 'Name of the show', 'Kiállítás neve', 'Name of the show', 'Názov výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(436, 'Enter the name of show (e.g. World dog show Budapest)', 'Enter the name of show (e.g. World dog show Budapest)', 'Enter the name of the show (e.g. World Dog Show Budapest)', 'Tüntesse fel a kiállítás nevét (pl. World Dog Show Budapest)', 'Enter the name of show (e.g. World dog show Budapest)', 'Zadajte názov výstavy (napr. Svetová výstava Budapešť)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(437, 'Enter the show name', 'Enter the show name', 'Enter the name of the show', 'Tüntesse fel a kiállítás nevét ', 'Enter the show name', 'Zadajte názov výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(438, 'Select country in which show was held', 'Select country in which show was held', 'Select the country in which the show was held', 'Válassza ki az országot, ahol a kiállítás meg volt rendezve', 'Select country in which show was held', 'Vyberte krajinu v ktorej sa výstava konala', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(439, 'Name of judge', 'Name of judge', 'Name of the judge', 'Bíró neve', 'Name of judge', 'Meno rozhodcu', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(440, 'Enter the judge’s name', 'Enter the judge’s name', 'Enter the judge’s name', 'Tüntesse fel a bíró nevét', 'Enter the judge’s name', 'Zadajte meno rozhodcu', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(441, 'Name of handler', 'Name of handler', 'Name of the handler', 'Handler neve', 'Name of handler', 'Meno handlera', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(442, 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'Enter the handler’s name or select the handler from the DOGFORSHOW database for interactivity. If you do not have any handler, please just leave this field empty', 'Tüntesse fel a handler nevét, vagy választja ki őt a DOGFORSHOW interaktív adatbázisából. Ha nem volt handler, csak hagyja üresen ezt a mezőt', 'Enter the handler’s name or select handler from DOGFORSHOW database for interactivity. If you dont have any handler, please just leave it empty', 'Zadajte meno handlera alebo vyberte handlera z databázy DOGFORSHOW pre možnosť prepojenia.Pokiaľ ste nemali handlera, nevyplňujte toto pole', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(443, 'Enter the handler’s name', 'Enter the handler’s name', 'Enter the handler’s name', 'Tüntesse fel a handler nevét', 'Enter the handler’s name', 'Zadajte meno handlera', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(444, 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'Choose the class: Minor Puppy (3-6 months), Puppy (6-9 months), Junior(9-18 months), Intermediate (15-24 months), Open (from 15 months), Working (from 15 months, with a working exam), Champions (from 15 months with ICH or CH title), Veteran (from 8 years), Honor (from 15 months with title ICH, CH, Club Winner, National Winner)', 'Válasszon az osztályt: Minor Puppy (3-6 hónapos korig), Kölyök (6-9 hónapos korig), Fiatal (9-18 hónapos korig), Növendék (15-24 hónapos korig), Nyílt (15 hónapos kortól), Munka (15 hónapos kortól, munkavizsga köteles), Champion (15 hónapos kortóI, CH vagy CH cím köteles), Veterán (8 éves kortól), Honor (15 hónapos kortól, ICH, CH, Klubgyőztes, vagy Országos győztes cím köteles)', 'Choose class Minor Puppy(3-6 months), Puppy(6-9 months), Junior(9-18 months), Intermediate(15-24 months), Open(from 15 months), Working(from 15 months, with working exam), Champions(from 15 months with ICH or CH title), Veteran(from 8 years), Honor(from 15 months with title ICH, CH, Club Winner, National Winner)', 'Vyberte si triedu Mladší dorast (3-6 mesiacov), Dorast (6-9 mesiacov), Mladí (9-18 mesiacov), Stredná (15-24 mesiacov), Otvorená (od 15 mesiacov), Pracovná (od 15 mesiacov so skúškou z výkonu), Šampióni (od 15 mesiacov s titulom ICH alebo CH), Veteráni (od 8 rokov), Čestná (od 15 mesiacov s titulom ICH,CH,Klubový víťaz,Národný víťaz)', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(445, 'Assesment', 'Assesment', 'The written critique', 'Szöveges leírás', 'Assesment', 'Hodnotenie', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(446, 'Best minor puppy', 'Best minor puppy', 'Best Minor Puppy', 'Legjobb Minor Puppy', 'Best minor puppy', 'Best minor puppy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(447, 'Best puppy male & female', 'Best puppy male & female', 'Best Puppy Male & Female', 'Legjobb Puppy Kan & Szuka', 'Best puppy male & female', 'Best puppy male & female', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(448, 'Titles', 'Titles', 'Titles', 'Címek', 'Titles', 'Tituly', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(449, 'Junior Best of Group', 'Junior Best of Group', 'Junior Best of Group', 'Fiatal Best of Group', 'Junior Best of Group', 'Junior Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(450, 'Junior Best in Show', 'Junior Best in Show', 'Junior Best in Show', 'Fiatal Best in Show ', 'Junior Best in Show', 'Junior Best in Show', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(451, 'Best of Group', 'Best of Group', 'Best of Group', 'Best of Group', 'Best of Group', 'Best of Group', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(452, 'Other titles and awards received at the show', 'Other titles and awards received at the show', 'Other titles and awards achieved at the show', 'Egyéb elért címek és díjak a kiállításon', 'Other titles and awards received at the show', 'Iné obdržané ocenenia v rámci výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(453, 'Enter other titles achieved at this show', 'Enter other titles achieved at this show', 'Enter other titles achieved at this show', 'Tüntesse fel az egyéb elért címeket a kiállításról', 'Enter other titles achieved at this show', 'Zadajte iné obdržané tituly a čakateľstvá v rámci zadanej výstavy ', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(454, 'e.g. National Winner', 'e.g. National Winner', 'e.g.National Winner', 'pl. Országos győztes', 'e.g. National Winner', 'napr. Národný víťaz', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(455, 'Image from show', 'Image from show', 'Image from the show', 'Fenykép a kiállításról', 'Image from show', 'Obrázok z výstavy', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(456, 'Record the picture from show in jpg or jpeg format. This field is optional', 'Record the picture from show in jpg or jpeg format. This field is optional', 'Add the picture from the show in jpg or jpeg format. This field is optional', 'Kiállítási fenykép feltöltése jpeg vagy jpg formátumban', 'Record the picture from show in jpg or jpeg format. This field is optional', 'Nahrajte obrázok z výstavy vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/dog-show-add?dog_id=500000000', NULL),
(457, 'Add planned litter', 'Add planned litter', 'Add planned litter', 'Tervezett alom hozzáadása', 'Add planned litter', 'Pridanie plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(458, 'Name of the litter or litter ranking', 'Name of the litter or litter ranking', 'Name of the litter or litter ranking', 'Az alom neve vagy az alom betűje', 'Name of the litter or litter ranking', 'Názov alebo písmeno plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(459, 'Enter the name of the litter or enter the letter of planned litter', 'Enter the name of the litter or enter the letter of planned litter', 'Enter the name of the litter or enter the letter of the planned litter', 'Tüntesse fel az alom nevét, vagy betűjét, amivel a tervezett alom fog kezdődni', 'Enter the name of the litter or enter the letter of planned litter', 'Zadajte názov alebo písmeno plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(460, 'Enter indicative month of birth of puppies as information for prospective buyers', 'Enter indicative month of birth of puppies as information for prospective buyers', 'Enter the planned month of birth of puppies as information for prospective buyers', 'Tüntesse fel kiskutyák tervezett születési hónapját, hogy tudja informálni a leendő vásárlókat', 'Enter indicative month of birth of puppies as information for prospective buyers', 'Zadajte orientačný dátum narodenia šteniatok ako informáciu pre potencionálnych záujemcov', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(461, 'Enter dog’s name', 'Enter dog’s name', 'Enter the dog’s name', 'Tüntesse fel a kutya nevét', 'Enter dog’s name', 'Zadajte meno psa', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(462, 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Enter the dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Tüntesse fel a kutya nevét, vagy válassza ki őt a DOGFORSHOW interaktív adatbázisából', 'Enter dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Zadajte meno psa alebo vyberte psa z databázy DOGFORSHOW pre možnosť prepojenia', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(463, 'Picture of the dog', 'Picture of the dog', 'Picture of the dog', 'Kutyáról készült fenykép', 'Picture of the dog', 'Obrázok psa', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(464, 'Upload or change profile picture of the dog in jpg or jpeg format', 'Upload or change profile picture of the dog in jpg or jpeg format', 'Upload or change the profile picture of the dog in jpg or jpeg format', 'Töltse fel vagy cserélje ki a kutya profilképét JPG vagy JPEG formátumban', 'Upload or change profile picture of the dog in jpg or jpeg format', 'Nahrajte alebo zmeňte obrázok psa vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(465, 'Please select the name of the bitch', 'Please select the name of the bitch', 'Please select the name of the bitch', 'Kérjük, válassza ki a szuka nevét', 'Please select the name of the bitch', 'Vyberte meno suky', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(466, 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'Please select one of your added bitches. If you do not have any bitch to select, you have to add the bitch to the list of your dogs first', 'Kérjük, válasszon egyet a hozzáadott szukákból. Ha nincs lehetősége választani, először hozzá kell adni a szukát a többi kutya közé.', 'Please select one of your added bitches. If you dont have any bitch to select, you must at first add your bitch in to your dogs', 'Vyberte meno suky zo zoznamu. Pokiaľ sa v zozname nenachádza meno suky, musíte si ju najprv pridať do zoznamu vašich psov', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(467, 'Upload or change profile picture of the bitch in jpg or jpeg format', 'Upload or change profile picture of the bitch in jpg or jpeg format', 'Upload or change the profile picture of the bitch in jpg or jpeg format', 'Töltse fel vagy cserélje ki a szuka profilképét JPG vagy JPEG formátumban', 'Upload or change profile picture of the bitch in jpg or jpeg format', 'Nahrajte alebo zmeňte obrázok suky vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(468, 'Name of planned litter can''t be empty', 'Name of planned litter can''t be empty', 'The field of the name of the planned litter cannot be empty', 'Mező a tervezett alom nevével nem maradhat üres', 'Name of planned litter can''t be empty', 'Názov plánovaného vrhu nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(469, 'Dog name can''t be empty', 'Dog name can''t be empty', 'The field of the dog''s name cannot be empty', 'Mező a kutya nevével nem maradhat üres', 'Dog name can''t be empty', 'Meno psa nemôže byť prázdne', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(470, 'Dog image can''t be empty', 'Dog image can''t be empty', 'The field of the dog''s image cannot be empty', 'Mező a kutya fenyképével nem maradhat üres', 'Dog image can''t be empty', 'Obrázok psa nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(471, 'Bitch name can''t be empty', 'Bitch name can''t be empty', 'The field of the bitch''s name cannot be empty', 'Mező a szuka nevével nem maradhat üres', 'Bitch name can''t be empty', 'Meno suky nemôže byť prázdne', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(472, 'Bitch image can''t be empty', 'Bitch image can''t be empty', 'The field of the bitch''s image cannot be empty', 'Mező a szuka fenyképével nem maradhat üres', 'Bitch image can''t be empty', 'Obrázok suky nemôže byť prázdny', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(473, 'Please select state', 'Please select state', 'Please select your state', 'Kérem válasszon országot', 'Please select state', 'Prosím vyberte štát', 'en', 'http://www.dogshow.com/index.php', NULL),
(474, 'Name and Surname cannot left blank', 'Name and Surname cannot left blank', 'The fields of the name and surname cannot be empty', 'Mezők a kereszt- és vezetéknevével nem maradhatnak üresek', 'Name and Surname cannot left blank', 'Meno a priezvisko nemôžu byť prázdne', 'en', 'http://www.dogshow.com/index.php', NULL),
(475, 'Password and confirm password does not match', 'Password and confirm password does not match', 'Password does not match the confirm password', 'A jelszó és a megerősítése nem egyezik', 'Password and confirm password does not match', 'Heslo a potvrdenie hesla sa musia zhodovať', 'en', 'http://www.dogshow.com/index.php', NULL),
(476, 'Fields Name and Surname cannot contains digits', 'Fields Name and Surname cannot contains digits', 'The fields of the name and surname cannot contain numeric signs', 'Mezők a kereszt- és vezetéknevével nem tartalmazhatnak numerikus jeleket', 'Fields Name and Surname cannot contains digits', 'Meno a priezvisko nesmú obsahovať číselné znaky', 'en', 'http://www.dogshow.com/index.php', NULL),
(477, 'Email cannot left blank', 'Email cannot left blank', 'The field of the email cannot be empty', 'Mező a email címmel nem maradhat üres', 'Email cannot left blank', 'Email nemôže byť prázdny', 'en', 'http://www.dogshow.com/index.php', NULL),
(478, 'Profile created', 'Profile created', 'Profile created', 'Adatlap létrehozva', 'Profile created', 'Profil vytvorený', 'en', 'http://www.dogshow.com/kennel-profile?id=1&_fid=hpgn', NULL),
(479, 'Select or enter the name of the dog', 'Select or enter the name of the dog', 'Select or enter the name of the dog', 'Válassza ki vagy írja be a kutya nevét', 'Select or enter the name of the dog', 'Vyberte alebo zadajte meno psa', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(480, 'Name of the dog', 'Name of the dog', 'Name of the dog', 'Kutya neve', 'Name of the dog', 'Meno psa', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(481, 'Name of the mother', 'Name of the mother', 'Name of the mother (dam)', 'Anya neve', 'Name of the mother', 'Meno matky', 'en', 'http://www.dogshow.com/dog-pedigree', NULL),
(482, 'No', 'No', 'No', 'Nem', 'No', 'Nie', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(483, 'Are you sure you want to delete this dog?', 'Are you sure you want to delete this dog?', 'Are you sure you want to delete this dog?', 'Biztosan törölni szeretné ezt a kutyát?', 'Are you sure you want to delete this dog?', 'Naozaj si želáte odstrániť tohto psa?', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(484, 'Question', 'Question', 'Question', 'Kérdés', 'Question', 'Otázka', 'en', 'http://www.dogshow.com/dog-profile?id=1', NULL),
(485, 'Are you sure you want to delete this profile?', 'Are you sure you want to delete this profile?', 'Are you sure you want to delete this profile?', 'Biztosan törölni szeretné ezt az adatlapot?', 'Are you sure you want to delete this profile?', 'Naozaj si želáte odstrániť tento profil?', 'en', 'http://www.dogshow.com/dog-profile?id=2', NULL),
(486, 'Are you sure you want to delete this record?', 'Are you sure you want to delete this record?', 'Are you sure you want to delete this record?', 'Biztosan törölni szeretné ezt az feljegyzést?', 'Are you sure you want to delete this record?', 'Naozaj si želáte odstrániť tento záznam?', 'en', 'http://www.dogshow.com/dog-profile?id=5&dog_id=5&_fid=yvc6', NULL),
(487, 'By clicking Register, you agree to our', 'By clicking Register, you agree to our', 'By clicking Register you agree to our', 'A Regisztráció gombra kattintva Ön elfogadja a', 'By clicking Register, you agree to our', 'Kliknutím na odkaz Registrovať, akceptujete naše', 'en', 'http://www.dogshow.com/index.php', NULL),
(488, 'General terms', 'General terms', 'General terms ', 'Általános feltételek', 'General terms', 'Všeobecné podmienky', 'en', 'http://www.dogshow.com/index.php', NULL),
(489, 'and you have read our', 'and you have read our', 'and you have read our ', 'és elolvasta a ', 'and you have read our', 'a taktiež akceptujete', 'en', 'http://www.dogshow.com/index.php', NULL),
(490, 'Cookie policy', 'Cookie policy', 'Cookie policy ', 'Cookie írányelv', 'Cookie policy', 'Politika Cookies', 'en', 'http://www.dogshow.com/index.php', NULL),
(491, 'Father of the planned litter', 'Father of the planned litter', 'Father (sire) of the planned litter', 'Tervezett alom apja', 'Father of the planned litter', 'Otec plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(492, 'Mother of the planned litter', 'Mother of the planned litter', 'Mother (dam) of the planned litter', 'Tervezett alom anyja', 'Mother of the planned litter', 'Matka plánovaného vrhu', 'en', 'http://www.dogshow.com/kennel-planned-litter-add', NULL),
(493, 'Please select planned litter...', 'Please select planned litter...', 'Please select the planned litter...', 'Kérem válasszon tervezett almot...', 'Please select planned litter...', 'Prosím vyberte plánovaný vrh ...', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(494, 'Add a puppy', 'Add a puppy', 'Add a puppy', 'Kiskutya hozzáadása', 'Add a puppy', 'Pridať šteniatko', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(495, 'Basic informations about puppy', 'Basic informations about puppy', 'Basic informations about the puppy', 'Alapvető információk a kiskutyáról', 'Basic informations about puppy', 'Základné informácie o šteniatku', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(496, 'Select your planned litter', 'Select your planned litter', 'Select your planned litter', 'Válassza ki a tervezett alomját', 'Select your planned litter', 'Vyberte plánovaný vrh', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(497, 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Válasszon hozzáadott tervezett almokból vagy tüntessen fel egy tervezett almot a menü segítségével', 'Choose your added planned litter or add your planned litter in the kennel menu, section planned litters', 'Vyberte plánovaný vrh zo zoznamu vašich pridaných plánovaných vrhov, alebo si pridajte plánovaný vrh v sekcii plánované vrhy', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(498, 'Select the puppy’s gender', 'Select the puppy’s gender', 'Select the puppy’s gender', 'Válassza ki a kiskutya nemét', 'Select the puppy’s gender', 'Vyberte pohlavie šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(499, 'Puppy''s name', 'Puppy''s name', 'The puppy''s name', 'Kiskutya neve', 'Puppy''s name', 'Meno šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(500, 'Enter the puppy’s name', 'Enter the puppy’s name', 'Enter the puppy’s name', 'Tüntesse fel a kiskutya nevét', 'Enter the puppy’s name', 'Zadajte meno šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(501, 'Picture of puppy', 'Picture of puppy', 'Picture of the puppy', 'Kiskutya fenyképe', 'Picture of puppy', 'Obrázok šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(502, 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'Upload the profile picture the puppy in PNG, JPG or GIF format', 'Töltse fel a kiskutya profilképét JPG vagy JPEG formátumban', 'Upload a profile picture of puppy in PNG, JPG or GIF format', 'Nahrajte profilový obrázok šteniatka vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(503, 'Day, month and year of puppy’s birth', 'Day, month and year of puppy’s birth', 'Day, month and year of the puppy’s birth', 'Kiskutya születési dátuma nap, hónap és év formátumban', 'Day, month and year of puppy’s birth', 'Deň, mesiac a rok narodenia šteniatka', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(504, 'Country in which the puppy is currently located', 'Country in which the puppy is currently located', 'Country in which the puppy is currently located', 'Ország, ahol a kiskutya jelenleg található', 'Country in which the puppy is currently located', 'Vyberte štát v ktorom sa šteniatko momentálne nachádza', 'en', 'http://www.dogshow.com/puppy-create-profile?plid=1', NULL),
(505, 'Share on Facebook', 'Share on Facebook', 'Share on Facebook', 'Megosztás Facebook-on', 'Share on Facebook', 'Zdieľať na Facebook', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(506, 'Share on Google+', 'Share on Google+', 'Share on Google+', 'Megosztás Google+-on', 'Share on Google+', 'Zdieľať na Google+', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(507, 'Share on Twitter', 'Share on Twitter', 'Share on Twitter', 'Megosztás Twitter-en', 'Share on Twitter', 'Zdieľať na Twitter', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(508, 'Share on Pinterest', 'Share on Pinterest', 'Share on Pinterest', 'Megosztás Pinterest-en', 'Share on Pinterest', 'Zdieľať na Pinterest', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(509, 'Share on Tumblr', 'Share on Tumblr', 'Share on Tumblr', 'Megosztám Tumblr-en', 'Share on Tumblr', 'Zdieľať na Tumblr', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(510, 'Post to a friend', 'Post to a friend', 'Post to a friend', 'Hozzászólás az ismerőséhez', 'Post to a friend', 'Poslať priateľovi', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(511, 'I am interested', 'I am interested', 'I am interested', 'Érdekel', 'I am interested', 'Mám záujem', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(512, 'Description', 'Description', 'Description', 'Leírás', 'Description', 'Popis', 'en', 'http://www.dogshow.com/puppy-profile', NULL),
(513, 'Edit puppy profile', 'Edit puppy profile', 'Edit the puppy''s profile', 'Kiskutya adatalpjának módosítása ', 'Edit puppy profile', 'Upraviť šteniatko', 'en', 'http://www.dogshow.com/puppy-edit-profile', NULL),
(514, 'Peoples who liked this', 'Peoples who liked this', 'People who liked this', 'Emberek, akik kedvelik ezt', 'Peoples who liked this', 'Ľudia, ktorým sa to páči', 'en', 'http://www.dogshow.com/kennel-profile', NULL),
(515, 'Required field', 'Required field', 'Required field', 'Kötelező mező', 'Required field', 'Potrebné vyplniť', 'en', 'http://www.dogshow.com/index.php', NULL),
(516, 'User with this e-mail, is not in our database', 'User with this e-mail, is not in our database', 'User with this e-mail is not in our database', 'Felhasználó ezzel az e-mailel nincs az adatbázisunkban', 'User with this e-mail, is not in our database', 'Užívateľ s týmto emailom sa nenachádza v našej databáze', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(517, 'Login to your account', 'Login to your account', 'Login to your account', 'Jelentkezzen be a fiókjába', 'Login to your account', 'Prihlásenie do vásho účtu', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(518, 'Your password has been successfully sent to your e-mail', 'Your password has been successfully sent to your e-mail', 'Your password has been successfully sent to your e-mail', 'A jelszavat sikeresen elküldtük az e-mail-re', 'Your password has been successfully sent to your e-mail', 'Vaše heslo bolo úspešne odoslané na váš email', 'en', 'http://172.16.46.5/dfs/index.php', NULL),
(519, 'Handler profile', 'Handler profile', 'The handler''s profile', 'Handler adatlapja', 'Handler profile', 'Profil handlera', 'en', 'http://www.dogshow.com/handler-create-profile', NULL),
(520, 'Select the breed that you can handle', 'Select the breed that you can handle', 'Select the breeds that you can show', 'Válassza ki az Ön által felvezetni kívánt fajtákat', 'Select the breed that you can handle', 'Vyberte plemená pre handling zo zoznamu plemien', 'en', 'http://www.dogshow.com/handler-create-profile', NULL),
(521, 'Select the breeds that you can handle', 'Select the breeds that you can handle', 'Select the breeds that you can show', 'Válassza ki az Ön által felvezetni kívánt fajtákat', 'Select the breeds that you can handle', 'Vyberte plemená pre handling zo zoznamu plemien', 'en', 'http://www.dogshow.com/handler-create-profile', NULL),
(522, 'Your cover photo', 'Your cover photo', 'Your cover photo', 'Borítóképe', 'Your cover photo', 'Váš profilový obrázok', 'en', 'http://www.dogshow.com/handler-edit-profile', NULL),
(523, 'Add breeds for handling', 'Add breeds for handling', 'Add breeds for handling', 'Felveztésre alkalmas fajta hozzáadása ', 'Add breeds for handling', 'Pridanie plemien pre handling', 'en', 'http://www.dogshow.com/handler-handling-breed-add', NULL),
(524, 'Record has been successfully added.', 'Record has been successfully added.', 'The record has been successfully added.', 'A feljegyzék sikeresen hozzáadva.', 'Record has been successfully added.', 'Záznam bol úspešne pridaný', 'en', 'http://www.dogshow.com/handler-awards-add?handler_id=400000000', NULL),
(525, 'Record has been successfully updated.', 'Record has been successfully updated.', 'The record has been successfully updated.', 'A feljegyzék sikeresen frissítve lett.', 'Record has been successfully updated.', 'Záznam bol úspešne upravený', 'en', 'http://www.dogshow.com/handler-awards-edit?id=7', NULL),
(526, 'Add certificate', 'Add certificate', 'Add the certificate', 'Bizonylat hozzáadása', 'Add certificate', 'Pridanie certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(527, 'Date of certificate passed', 'Date of certificate passed', 'Date of passed certificate ', 'Bizonylat megszerzésének az időpontja', 'Date of certificate passed', 'Dátum získania certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(528, 'Select date certificate was obtained', 'Select date certificate was obtained', 'Select the date when the certificate was obtained', 'Válassza ki bizonylat megszerzésének az időpontját', 'Select date certificate was obtained', 'Vyberte dátum kedy ste získali certifikát', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(529, 'Name of the certificate', 'Name of the certificate', 'Name of the certificate', 'Bizonylat neve', 'Name of the certificate', 'Názov certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(530, 'Picture of certificate in jpeg or jpg format', 'Picture of certificate in jpeg or jpg format', 'Picture of the certificate in jpeg or jpg format', 'Bizonylat fenyképe jpeg vagy jpg formátumban', 'Picture of certificate in jpeg or jpg format', 'Obrázok certifikátu vo formáte jpg alebo jpeg', 'en', 'http://www.dogshow.com/handler-certificates-add?handler_id=400000000', NULL),
(531, 'Edit certificate', 'Edit certificate', 'Edit the certificate', 'Bizonylat szerkesztése', 'Edit certificate', 'Úprava certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-edit?id=1', NULL),
(532, 'Date certificate passed', 'Date certificate passed', 'Date of passed certificate', 'Bizonylat megszerzésének az időpontja', 'Date certificate passed', 'Dátum získania certifikátu', 'en', 'http://www.dogshow.com/handler-certificates-edit?id=1', NULL),
(533, 'Name of the handled dog', 'Name of the handled dog', 'Name of the showed dog', 'Felvezetett kutya neve', 'Name of the handled dog', 'Meno psa ktorého ste handlovali', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(534, 'Enter the dog’s name or select dog from DOGFORSHOW database for interactivity', 'Enter the dog’s name or select dog from DOGFORSHOW database for interactivity', 'Enter the dog’s name or select the dog from the DOGFORSHOW database for interactivity', 'Tüntesse fel a kutya nevét, vagy válassza ki őt a DOGFORSHOW interaktív adatbázisából', 'Enter the dog’s name or select dog from DOGFORSHOW database for interactivity', 'Zadajte meno psa alebo vyberte psa z databázy DOGFORSHOW pre možnosť prepojenia', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(535, 'Enter other titles achieved at this show (e.g. National Winner)', 'Enter other titles achieved at this show (e.g. National Winner)', 'Enter other titles achieved at this show (e.g. National Winner)', 'Tüntesse fel a többi címeket, amit elért ezen a kiállításon (pl. Országos győztes)', 'Enter other titles achieved at this show (e.g. National Winner)', 'Zadajte iné obdržané tituly a čakateľstvá v rámci zadanej výstavy (napr. Narodný víťaz) ', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(536, 'Minor Puppy', 'Minor Puppy', 'Minor Puppy', 'Minor Puppy', 'Minor Puppy', 'Mladší dorast', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(537, 'Puppy', 'Puppy', 'Puppy', 'Puppy', 'Puppy', 'Dorast', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(538, 'Junior', 'Junior', 'Junior', 'Fiatal', 'Junior', 'Mladí', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(539, 'Intermediate', 'Intermediate', 'Intermediate', 'Növendék', 'Intermediate', 'Stredná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(540, 'Open', 'Open', 'Open', 'Nyílt', 'Open', 'Otvorená', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(541, 'Working', 'Working', 'Working', 'Munka', 'Working', 'Pracovná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(542, 'Champions', 'Champions', 'Champions', 'Champions', 'Champions', 'Šampióni', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(543, 'Veteran', 'Veteran', 'Veteran', 'Veterán', 'Veteran', 'Veteráni', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(544, 'Honor', 'Honor', 'Honor', 'Honor', 'Honor', 'Čestná', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(545, 'Please select...', 'Please select...', 'Please select…', 'Kérem válasszon...', 'Please select...', 'Prosím vyberte si ...', 'en', 'http://www.dogshow.com/handler-show-add', NULL),
(546, 'Language', 'Language', 'Language', 'Nyelv', 'Language', 'Jazyk', 'en', 'http://www.dogshow.com/edit-account', NULL),
(547, 'Language for current user', 'Language for current user', 'Language for current user', 'Aktuális felhasználó nyelve', 'Language for current user', 'Vyberte si prosím požadovaný jazyk zo zoznamu', 'en', 'http://www.dogshow.com/edit-account', NULL),
(548, 'Regional', 'Regional', 'Regional', 'Regional', 'Regional', 'Regional', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(549, 'Club', 'Club', 'Club', 'Club', 'Club', 'Club', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(550, 'Special CAC', 'Special CAC', 'Special CAC', 'Special CAC', 'Special CAC', 'Special CAC', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(551, 'National CAC', 'National CAC', 'National CAC', 'National CAC', 'National CAC', 'National CAC', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(552, 'National CAC, NW', 'National CAC, NW', 'National CAC, NW', 'National CAC, NW', 'National CAC, NW', 'National CAC, NW', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(553, 'International CACIB', 'International CACIB', 'International CACIB', 'International CACIB', 'International CACIB', 'International CACIB', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(554, 'European show', 'European show', 'European show', 'European show', 'European show', 'European show', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(555, 'World show', 'World show', 'World show', 'World show', 'World show', 'World show', 'en', 'http://www.dogshow.com/handler-show-add-name', NULL),
(556, 'MinorPuppy', 'MinorPuppy', 'MinorPuppy', 'MinorPuppy', 'MinorPuppy', 'MinorPuppy', 'en', 'http://www.dogshow.com/handler-show-list', NULL);

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
  `lang` varchar(4) NOT NULL DEFAULT 'en',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_usergroup`
--

INSERT INTO `tbl_usergroup` (`id`, `user_id`, `group_name`, `is_default`, `is_public`) VALUES
(1, 100000000, 'Public', b'1', b'1');

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
  `handler_background_image` blob NOT NULL,
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
-- Table structure for table `tbl_videos`
--

DROP TABLE IF EXISTS `tbl_videos`;
CREATE TABLE IF NOT EXISTS `tbl_videos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `profile_id` bigint(20) NOT NULL,
  `image` text NOT NULL,
  `video` text NOT NULL,
  `description` mediumtext NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3000000000 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tmp_0`
--

INSERT INTO `tmp_0` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(10, 400000003, 400000003, 1, 'Radoslav Mihalus', 'uploads/aFINB41EAy.jpg', '2015-09-15 12:06:32', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_1`
--

INSERT INTO `tmp_1` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_2`
--

INSERT INTO `tmp_2` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tmp_3`
--

INSERT INTO `tmp_3` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(11, 200000002, 200000002, 1, 'Labradors kennel', 'uploads/9X5JZvuiTz.jpg', '2015-09-15 12:11:57', 0x75706c6f6164732f3958354a5a767569547a2e6a7067, 'Labradors kennel');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_4`
--

INSERT INTO `tmp_4` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_5`
--

INSERT INTO `tmp_5` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_6`
--

INSERT INTO `tmp_6` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_7`
--

INSERT INTO `tmp_7` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_8`
--

INSERT INTO `tmp_8` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_9`
--

INSERT INTO `tmp_9` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tmp_10`
--

INSERT INTO `tmp_10` (`id`, `profile_id`, `event_id`, `event_type`, `event_description`, `event_image`, `date`, `timeline_profile_image`, `timeline_name`) VALUES
(13, 400000004, 400000004, 1, 'Radoslav Mihalus', 'uploads/3X5jKjfZUS.jpg', '2015-09-15 12:28:36', NULL, NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;