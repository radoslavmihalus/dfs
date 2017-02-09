-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2016 at 07:53 AM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_forms`
--

DROP TABLE IF EXISTS `blueticket_forms`;
CREATE TABLE IF NOT EXISTS `blueticket_forms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `default_tab` varchar(255) DEFAULT NULL,
  `default_where` mediumtext,
  `default_order_by` mediumtext,
  `search_pattern_before` varchar(255) DEFAULT '%',
  `search_pattern_after` varchar(255) DEFAULT '%',
  `allow_view` tinyint(1) DEFAULT '1',
  `allow_add` tinyint(1) DEFAULT '1',
  `allow_edit` tinyint(1) DEFAULT '1',
  `allow_delete` tinyint(1) DEFAULT '1',
  `allow_print` tinyint(1) DEFAULT '1',
  `allow_xls` tinyint(1) DEFAULT '1',
  `allow_csv` tinyint(1) DEFAULT '1',
  `allow_list` tinyint(1) DEFAULT '1',
  `allow_limit_list` tinyint(1) DEFAULT '1',
  `allow_numbers` tinyint(1) DEFAULT '1',
  `allow_pagination` tinyint(1) DEFAULT '1',
  `allow_sort` tinyint(1) DEFAULT '1',
  `allow_title` tinyint(1) DEFAULT '1',
  `allow_search` tinyint(1) DEFAULT '1',
  `allow_duplicate` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_forms`
--

INSERT INTO `blueticket_forms` (`id`, `form_name`, `table_name`, `caption`, `default_tab`, `default_where`, `default_order_by`, `search_pattern_before`, `search_pattern_after`, `allow_view`, `allow_add`, `allow_edit`, `allow_delete`, `allow_print`, `allow_xls`, `allow_csv`, `allow_list`, `allow_limit_list`, `allow_numbers`, `allow_pagination`, `allow_sort`, `allow_title`, `allow_search`, `allow_duplicate`) VALUES
(1, 'blueticket_forms', 'blueticket_forms', 'Forms definitions', 'blueticket_forms', NULL, NULL, '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(2, 'blueticket_forms_fields', 'blueticket_forms_fields', 'Fields definitions', 'blueticket_forms_fields', NULL, NULL, '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(3, 'blueticket_forms_fields_meta', 'blueticket_forms_fields_meta', 'Field meta', 'Field meta', NULL, NULL, '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(4, 'blueticket_forms_fields_types', 'blueticket_forms_fields_types', 'Fields types', 'Fields types', NULL, NULL, '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(5, 'blueticket_forms_meta', 'blueticket_forms_meta', 'Form meta', 'Form meta', NULL, 'ordering', '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(6, 'blueticket_nested_forms', 'blueticket_nested_forms', 'Nested forms', 'Nested forms', NULL, NULL, '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(17, 'blueticket_menu', 'blueticket_menu', 'Menu', 'Menu', NULL, 'ordering', '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL),
(23, 'blueticket_translate', 'blueticket_translate', 'Translate', 'Translate', 'lang=\'{$lang}\'', 'text_to_translate', '%', '%', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_forms_fields`
--

DROP TABLE IF EXISTS `blueticket_forms_fields`;
CREATE TABLE IF NOT EXISTS `blueticket_forms_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) DEFAULT NULL,
  `field_order` bigint(20) DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `field_type` varchar(100) DEFAULT NULL,
  `field_size` varchar(100) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `field_list` tinyint(1) DEFAULT '1',
  `field_read` tinyint(1) DEFAULT '1',
  `field_update` tinyint(1) DEFAULT '1',
  `field_search` tinyint(1) DEFAULT '1',
  `field_noeditor` tinyint(1) DEFAULT '1',
  `field_sum` tinyint(1) DEFAULT '0',
  `field_style` mediumtext,
  `field_subselect` mediumtext,
  `relation_target_table` varchar(255) DEFAULT NULL,
  `relation_target_id` varchar(255) DEFAULT NULL,
  `relation_target_name` mediumtext,
  `relation_where` mediumtext,
  `relation_order_by` mediumtext,
  `relation_multi` tinyint(1) DEFAULT '0',
  `relation_concat_separator` varchar(50) DEFAULT NULL,
  `relation_tree` mediumtext,
  `relation_depend_field` varchar(255) DEFAULT NULL,
  `relation_depend_on` varchar(255) DEFAULT NULL,
  `fk_relation_label` varchar(255) DEFAULT NULL,
  `fk_relation_field` varchar(255) DEFAULT NULL,
  `fk_relation_fk_table` varchar(255) DEFAULT NULL,
  `fk_relation_in_fk_field` varchar(255) DEFAULT NULL,
  `fk_relation_out_fk_field` varchar(255) DEFAULT NULL,
  `fk_relation_rel_tbl` varchar(255) DEFAULT NULL,
  `fk_relation_rel_field` varchar(255) DEFAULT NULL,
  `fk_relation_rel_name` mediumtext,
  `fk_relation_rel_where` mediumtext,
  `fk_relation_rel_orderby` mediumtext,
  `fk_relation_rel_concat_separator` varchar(50) DEFAULT NULL,
  `fk_relation_before` varchar(50) DEFAULT NULL,
  `fk_relation_add_data` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_forms_fields`
--

INSERT INTO `blueticket_forms_fields` (`id`, `form_id`, `field_order`, `field_name`, `field_type`, `field_size`, `caption`, `field_list`, `field_read`, `field_update`, `field_search`, `field_noeditor`, `field_sum`, `field_style`, `field_subselect`, `relation_target_table`, `relation_target_id`, `relation_target_name`, `relation_where`, `relation_order_by`, `relation_multi`, `relation_concat_separator`, `relation_tree`, `relation_depend_field`, `relation_depend_on`, `fk_relation_label`, `fk_relation_field`, `fk_relation_fk_table`, `fk_relation_in_fk_field`, `fk_relation_out_fk_field`, `fk_relation_rel_tbl`, `fk_relation_rel_field`, `fk_relation_rel_name`, `fk_relation_rel_where`, `fk_relation_rel_orderby`, `fk_relation_rel_concat_separator`, `fk_relation_before`, `fk_relation_add_data`) VALUES
(1, 1, 1, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, 'form_name', 'VARCHAR', NULL, 'form_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, 'table_name', 'VARCHAR', NULL, 'table_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, 'caption', 'VARCHAR', NULL, 'caption', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, 'default_tab', 'VARCHAR', NULL, 'default_tab', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, 'default_where', 'MEDIUMTEXT', NULL, 'default_where', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 7, 'default_order_by', 'MEDIUMTEXT', NULL, 'default_order_by', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 8, 'search_pattern_before', 'VARCHAR', NULL, 'search_pattern_before', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, 'search_pattern_after', 'VARCHAR', NULL, 'search_pattern_after', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, 'allow_view', 'TINYINT', NULL, 'allow_view', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 11, 'allow_add', 'TINYINT', NULL, 'allow_add', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 12, 'allow_edit', 'TINYINT', NULL, 'allow_edit', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 13, 'allow_delete', 'TINYINT', NULL, 'allow_delete', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 14, 'allow_print', 'TINYINT', NULL, 'allow_print', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 15, 'allow_xls', 'TINYINT', NULL, 'allow_xls', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 16, 'allow_csv', 'TINYINT', NULL, 'allow_csv', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 17, 'allow_list', 'TINYINT', NULL, 'allow_list', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 18, 'allow_limit_list', 'TINYINT', NULL, 'allow_limit_list', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 19, 'allow_numbers', 'TINYINT', NULL, 'allow_numbers', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 20, 'allow_pagination', 'TINYINT', NULL, 'allow_pagination', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 21, 'allow_sort', 'TINYINT', NULL, 'allow_sort', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 22, 'allow_title', 'TINYINT', NULL, 'allow_title', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 23, 'allow_search', 'TINYINT', NULL, 'allow_search', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 24, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 2, 25, 'form_id', 'BIGINT', NULL, 'form_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 2, 26, 'field_order', 'BIGINT', NULL, 'field_order', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 2, 27, 'field_name', 'VARCHAR', NULL, 'field_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 2, 28, 'field_type', 'RELATION', NULL, 'field_type', 1, 1, 1, 1, 1, 0, NULL, NULL, 'blueticket_forms_fields_types', 'name', 'name', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 2, 29, 'field_size', 'VARCHAR', NULL, 'field_size', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 2, 30, 'caption', 'VARCHAR', NULL, 'caption', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 2, 31, 'field_list', 'TINYINT', NULL, 'field_list', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 2, 32, 'field_read', 'TINYINT', NULL, 'field_read', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 2, 33, 'field_update', 'TINYINT', NULL, 'field_update', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 2, 34, 'field_search', 'TINYINT', NULL, 'field_search', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 2, 35, 'field_noeditor', 'TINYINT', NULL, 'field_noeditor', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 2, 36, 'field_sum', 'TINYINT', NULL, 'field_sum', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 2, 37, 'field_style', 'MEDIUMTEXT', NULL, 'field_style', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 2, 38, 'field_subselect', 'MEDIUMTEXT', NULL, 'field_subselect', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 2, 39, 'relation_target_table', 'VARCHAR', NULL, 'relation_target_table', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 2, 40, 'relation_target_id', 'VARCHAR', NULL, 'relation_target_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 2, 41, 'relation_target_name', 'MEDIUMTEXT', NULL, 'relation_target_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 2, 42, 'relation_where', 'MEDIUMTEXT', NULL, 'relation_where', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 2, 43, 'relation_order_by', 'MEDIUMTEXT', NULL, 'relation_order_by', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 2, 44, 'relation_multi', 'TINYINT', NULL, 'relation_multi', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 2, 45, 'relation_concat_separator', 'VARCHAR', NULL, 'relation_concat_separator', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 2, 46, 'relation_tree', 'MEDIUMTEXT', NULL, 'relation_tree', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 2, 47, 'relation_depend_field', 'VARCHAR', NULL, 'relation_depend_field', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 2, 48, 'relation_depend_on', 'VARCHAR', NULL, 'relation_depend_on', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 2, 49, 'fk_relation_label', 'VARCHAR', NULL, 'fk_relation_label', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 2, 50, 'fk_relation_field', 'VARCHAR', NULL, 'fk_relation_field', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 2, 51, 'fk_relation_fk_table', 'VARCHAR', NULL, 'fk_relation_fk_table', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 2, 52, 'fk_relation_in_fk_field', 'VARCHAR', NULL, 'fk_relation_in_fk_field', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 2, 53, 'fk_relation_out_fk_field', 'VARCHAR', NULL, 'fk_relation_out_fk_field', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 2, 54, 'fk_relation_rel_tbl', 'VARCHAR', NULL, 'fk_relation_rel_tbl', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 2, 55, 'fk_relation_rel_field', 'VARCHAR', NULL, 'fk_relation_rel_field', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 2, 56, 'fk_relation_rel_name', 'MEDIUMTEXT', NULL, 'fk_relation_rel_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 2, 57, 'fk_relation_rel_where', 'MEDIUMTEXT', NULL, 'fk_relation_rel_where', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 2, 58, 'fk_relation_rel_orderby', 'MEDIUMTEXT', NULL, 'fk_relation_rel_orderby', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 2, 59, 'fk_relation_rel_concat_separator', 'VARCHAR', NULL, 'fk_relation_rel_concat_separator', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 2, 60, 'fk_relation_before', 'VARCHAR', NULL, 'fk_relation_before', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 2, 61, 'fk_relation_add_data', 'MEDIUMTEXT', NULL, 'fk_relation_add_data', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 3, 62, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 3, 63, 'field_id', 'BIGINT', NULL, 'field_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 3, 64, 'meta_key', 'VARCHAR', NULL, 'meta_key', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 3, 65, 'meta_value', 'MEDIUMTEXT', NULL, 'meta_value', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 4, 66, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 4, 67, 'name', 'VARCHAR', NULL, 'name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 4, 68, 'subtype', 'VARCHAR', NULL, 'subtype', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 5, 69, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 5, 70, 'form_id', 'BIGINT', NULL, 'form_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 5, 71, 'meta_key', 'VARCHAR', NULL, 'meta_key', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 5, 72, 'meta_value', 'MEDIUMTEXT', NULL, 'meta_value', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 6, 73, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 6, 74, 'form_id', 'BIGINT', NULL, 'form_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 6, 75, 'nested_form_id', 'RELATION', NULL, 'nested_form', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'blueticket_forms', 'id', 'form_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 6, 76, 'form_field_name', 'VARCHAR', NULL, 'form_field_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 6, 77, 'nested_form_field_name', 'VARCHAR', NULL, 'nested_form_field_name', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 8, 111, 'id', 'BIGINT', NULL, 'id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 8, 112, 'left_image', 'IMAGEUPLOAD', NULL, 'Banner', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 8, 113, 'right_image', 'IMAGEUPLOAD', NULL, 'right_image', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 8, 114, 'description', 'TEXT', NULL, 'Poznámka', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 8, 115, 'header', 'TEXT', NULL, 'Názov', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 8, 116, 'active', 'TINYINT', NULL, 'Aktívny', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 8, 117, 'lang', 'VARCHAR', NULL, 'Jazyk', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 9, 118, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 9, 119, 'page_id', 'BIGINT', NULL, 'page_id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 9, 120, 'item_id', 'BIGINT', NULL, 'item_id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 9, 121, 'type', 'RELATION', NULL, 'Typ obsahu', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'tbl_pages_types', 'id', 'description', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 9, 122, 'header', 'TEXT', NULL, 'Nadpis', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 9, 123, 'content', 'TEXT', NULL, 'Obsah', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 9, 124, 'image', 'IMAGEUPLOAD', NULL, 'Obrázok', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 9, 130, 'lang', 'VARCHAR', NULL, 'Jazyk', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 9, 131, 'active', 'TINYINT', NULL, 'Aktívny', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 9, 132, 'ordering', 'BIGINT', NULL, 'Poradie', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 10, 128, 'id', 'BIGINT', NULL, 'id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 10, 129, 'item_id', 'BIGINT', NULL, 'ID produktu', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 10, 130, 'image', 'IMAGEUPLOAD', NULL, 'Obrázok', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 10, 131, 'title', 'TEXT', NULL, 'Názov varianty', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 10, 132, 'active', 'TINYINT', NULL, 'Aktívny', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 10, 133, 'lang', 'VARCHAR', NULL, 'Jazyk', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 11, 134, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 11, 135, 'page_name', 'VARCHAR', NULL, 'Názov', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 11, 136, 'description', 'TEXT', NULL, 'Poznámka', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 12, 137, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 12, 138, 'description', 'VARCHAR', NULL, 'description', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 12, 139, 'data_form_id', 'BIGINT', NULL, 'data_form_id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 12, 140, 'content', 'TEXT', NULL, 'content', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 12, 141, 'active', 'TINYINT', NULL, 'active', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 13, 142, 'id', 'BIGINT', NULL, 'id', 1, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 13, 143, 'content_id', 'BIGINT', NULL, 'content_id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 13, 144, 'description', 'TEXT', NULL, 'Vlastnosť', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 13, 146, 'lang', 'VARCHAR', NULL, 'Jazyk', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 13, 147, 'active', 'TINYINT', NULL, 'Aktívny', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 9, 125, 'image_icon', 'IMAGEUPLOAD', '255', 'Ikona', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 9, 126, 'image_animation', 'IMAGEUPLOAD', '255', 'PNG animácia', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 9, 127, 'video', 'FILEUPLOAD', '255', 'Video', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 9, 128, 'hcolor', 'VARCHAR', '255', 'Farba nadpisu', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 9, 129, 'bcolor', 'VARCHAR', '255', 'Farba textu', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 8, 1, 'page_id', 'RELATION', '11', 'Stránka', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'tbl_pages', 'id', 'page_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 8, 2, 'product_id', 'RELATION', '11', 'Produkt', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'items', 'ID', 'Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 13, 145, 'image_icon', 'IMAGEUPLOAD', '255', 'Ikona vlastnosti', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 14, 20, 'text_to_translate', 'TEXT', NULL, 'Text na preklad', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 14, 40, 'translate_sk', 'TEXT', NULL, 'Preklad SK', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 14, 60, 'translate_cz', 'TEXT', NULL, 'Preklad CZ', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 14, 80, 'translate_en', 'TEXT', NULL, 'Preklad EN', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 14, 100, 'translate_de', 'TEXT', NULL, 'Preklad DE', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 14, 120, 'translate_hu', 'TEXT', NULL, 'Preklad HU', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 14, 140, 'translate_pl', 'TEXT', NULL, 'Preklad PL', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 14, 160, 'translate_sp', 'TEXT', NULL, 'Preklad SP', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 8, 118, 'ordering', 'INT', NULL, 'Poradie', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 9, 118, 'content_id', 'VARCHAR', '50', 'Kotva', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 13, 148, 'ordering', 'INT', NULL, 'Poradie', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 15, 10, 'content_id', 'BIGINT', NULL, 'content_id', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 15, 20, 'description', 'TEXT', NULL, 'Popis', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 15, 30, 'image_icon', 'IMAGEUPLOAD', NULL, 'Ikona', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 15, 40, 'lang', 'VARCHAR', NULL, 'Jazyk', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 15, 50, 'active', 'TINYINT', NULL, 'Aktívny', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 15, 60, 'ordering', 'INT', NULL, 'Poradie', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 9, 125, 'image_compare', 'IMAGEUPLOAD', NULL, 'Vedľajší obrazok (pre content compare)', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 17, 20, 'name', 'VARCHAR', NULL, 'name', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 17, 40, 'form_name', 'RELATION', NULL, 'form_name', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'blueticket_forms', 'form_name', 'form_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 17, 60, 'icon', 'VARCHAR', NULL, 'icon', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 17, 80, 'menu_id', 'RELATION', NULL, 'parent_menu', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'blueticket_menu', 'id', 'name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 17, 100, 'ordering', 'INT', NULL, 'ordering', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 1, 100, 'allow_duplicate', 'TINYINT', NULL, 'allow_duplicate', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 23, 20, 'text_to_translate', 'MEDIUMTEXT', NULL, 'Text to translate', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 23, 40, 'translated_text', 'MEDIUMTEXT', NULL, 'Translated text', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 23, 60, 'lang', 'VARCHAR', NULL, 'Lang', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 5, 100, 'ordering', 'BIGINT', NULL, 'ordering', 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_forms_fields_meta`
--

DROP TABLE IF EXISTS `blueticket_forms_fields_meta`;
CREATE TABLE IF NOT EXISTS `blueticket_forms_fields_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `field_id` bigint(20) DEFAULT NULL,
  `meta_key` varchar(50) DEFAULT NULL,
  `meta_value` mediumtext,
  PRIMARY KEY (`id`),
  KEY `meta_key_idx` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_forms_fields_types`
--

DROP TABLE IF EXISTS `blueticket_forms_fields_types`;
CREATE TABLE IF NOT EXISTS `blueticket_forms_fields_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `subtype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_forms_fields_types`
--

INSERT INTO `blueticket_forms_fields_types` (`id`, `name`, `subtype`) VALUES
(1, 'INT', 'NUMERIC'),
(2, 'TINYINT', 'NUMERIC'),
(3, 'SMALLINT', 'NUMERIC'),
(4, 'MEDIUMINT', 'NUMERIC'),
(5, 'BIGINT', 'NUMERIC'),
(6, 'FLOAT', 'NUMERIC'),
(7, 'DOUBLE', 'NUMERIC'),
(8, 'DECIMAL', 'NUMERIC'),
(9, 'DATE', 'DATES'),
(10, 'DATETIME', 'DATES'),
(11, 'TIMESTAMP', 'DATES'),
(12, 'TIME', 'DATES'),
(13, 'YEAR', 'DATES'),
(14, 'CHAR', 'STRINGS'),
(15, 'VARCHAR', 'STRINGS'),
(16, 'BLOB', 'STRINGS'),
(17, 'TEXT', 'STRINGS'),
(18, 'TINYBLOB', 'STRINGS'),
(19, 'TINYTEXT', 'STRINGS'),
(20, 'MEDIUMBLOB', 'STRINGS'),
(21, 'MEDIUMTEXT', 'STRINGS'),
(22, 'LONGBLOB', 'STRINGS'),
(23, 'LONGTEXT', 'STRINGS'),
(24, 'ENUM', 'STRINGS'),
(25, 'FILEUPLOAD', 'CUSTOM'),
(26, 'FK_RELATION', 'CUSTOM'),
(27, 'IMAGEUPLOAD', 'CUSTOM'),
(28, 'RELATION', 'CUSTOM'),
(29, 'SUBSELECT', 'CUSTOM');

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_forms_meta`
--

DROP TABLE IF EXISTS `blueticket_forms_meta`;
CREATE TABLE IF NOT EXISTS `blueticket_forms_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) DEFAULT NULL,
  `meta_key` varchar(50) DEFAULT NULL,
  `meta_value` mediumtext,
  `ordering` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `meta_key_idx` (`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_forms_meta`
--

INSERT INTO `blueticket_forms_meta` (`id`, `form_id`, `meta_key`, `meta_value`, `ordering`) VALUES
(3, 1, 'highlight_row', 'form_name|^=|blueticket_|lightgreen', 20),
(6, 1, 'highlight_row', 'form_name|^=|blueticket_forms|orange', 40),
(7, 17, 'column_class', 'ordering|align-right', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_menu`
--

DROP TABLE IF EXISTS `blueticket_menu`;
CREATE TABLE IF NOT EXISTS `blueticket_menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `form_name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `menu_id` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_menu`
--

INSERT INTO `blueticket_menu` (`id`, `name`, `form_name`, `icon`, `ordering`, `menu_id`) VALUES
(1, 'Settings', NULL, 'fa fa-gear', 2000, NULL),
(3, 'Forms definitions', 'blueticket_forms', 'fa fa-folder-open-o', 2020, 1),
(4, 'Menu', 'blueticket_menu', 'fa fa-list', 2040, 1),
(12, 'Translate', 'blueticket_translate', 'fa fa-cc', 2060, 1),
(13, 'Fields types', 'blueticket_forms_fields_types', 'fa fa-gear', 2030, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_nested_forms`
--

DROP TABLE IF EXISTS `blueticket_nested_forms`;
CREATE TABLE IF NOT EXISTS `blueticket_nested_forms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) DEFAULT NULL,
  `nested_form_id` bigint(20) DEFAULT NULL,
  `form_field_name` varchar(100) DEFAULT NULL,
  `nested_form_field_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_nested_forms`
--

INSERT INTO `blueticket_nested_forms` (`id`, `form_id`, `nested_form_id`, `form_field_name`, `nested_form_field_name`) VALUES
(1, 1, 2, 'id', 'form_id'),
(2, 1, 5, 'id', 'form_id'),
(3, 1, 6, 'id', 'form_id'),
(4, 2, 3, 'id', 'field_id'),
(6, 9, 13, 'id', 'content_id'),
(7, 11, 9, 'id', 'page_id'),
(9, 9, 15, 'id', 'content_id');

-- --------------------------------------------------------

--
-- Table structure for table `blueticket_translate`
--

DROP TABLE IF EXISTS `blueticket_translate`;
CREATE TABLE IF NOT EXISTS `blueticket_translate` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `text_to_translate` mediumtext,
  `translated_text` mediumtext,
  `lang` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blueticket_translate`
--

INSERT INTO `blueticket_translate` (`id`, `text_to_translate`, `translated_text`, `lang`) VALUES
(1, 'Settings', 'Settings', 'en'),
(2, 'Forms definitions', 'Forms definitions', 'en'),
(3, 'Fields types', 'Fields types', 'en'),
(4, 'Menu', 'Menu', 'en'),
(5, 'Translate', 'Translate', 'en'),
(6, 'Adminer', 'Adminer', 'en'),
(7, 'Logout', 'Logout', 'en'),
(8, 'Email', 'Email', 'en'),
(9, 'Password', 'Password', 'en'),
(10, 'LogIn', 'LogIn', 'en'),
(11, 'id', 'id', 'en'),
(12, 'form_name', 'form_name', 'en'),
(13, 'table_name', 'table_name', 'en'),
(14, 'caption', 'caption', 'en'),
(15, 'default_tab', 'default_tab', 'en'),
(16, 'default_where', 'default_where', 'en'),
(17, 'default_order_by', 'default_order_by', 'en'),
(18, 'search_pattern_before', 'search_pattern_before', 'en'),
(19, 'search_pattern_after', 'search_pattern_after', 'en'),
(20, 'allow_view', 'allow_view', 'en'),
(21, 'allow_add', 'allow_add', 'en'),
(22, 'allow_edit', 'allow_edit', 'en'),
(23, 'allow_delete', 'allow_delete', 'en'),
(24, 'allow_print', 'allow_print', 'en'),
(25, 'allow_xls', 'allow_xls', 'en'),
(26, 'allow_csv', 'allow_csv', 'en'),
(27, 'allow_list', 'allow_list', 'en'),
(28, 'allow_limit_list', 'allow_limit_list', 'en'),
(29, 'allow_numbers', 'allow_numbers', 'en'),
(30, 'allow_pagination', 'allow_pagination', 'en'),
(31, 'allow_sort', 'allow_sort', 'en'),
(32, 'allow_title', 'allow_title', 'en'),
(33, 'allow_search', 'allow_search', 'en'),
(34, 'allow_duplicate', 'allow_duplicate', 'en'),
(35, 'Fields definitions', 'Fields definitions', 'en'),
(36, 'form_id', 'form_id', 'en'),
(37, 'field_order', 'field_order', 'en'),
(38, 'field_name', 'field_name', 'en'),
(39, 'field_type', 'field_type', 'en'),
(40, 'field_size', 'field_size', 'en'),
(41, 'field_list', 'field_list', 'en'),
(42, 'field_read', 'field_read', 'en'),
(43, 'field_update', 'field_update', 'en'),
(44, 'field_search', 'field_search', 'en'),
(45, 'field_noeditor', 'field_noeditor', 'en'),
(46, 'field_sum', 'field_sum', 'en'),
(47, 'field_style', 'field_style', 'en'),
(48, 'field_subselect', 'field_subselect', 'en'),
(49, 'relation_target_table', 'relation_target_table', 'en'),
(50, 'relation_target_id', 'relation_target_id', 'en'),
(51, 'relation_target_name', 'relation_target_name', 'en'),
(52, 'relation_where', 'relation_where', 'en'),
(53, 'relation_order_by', 'relation_order_by', 'en'),
(54, 'relation_multi', 'relation_multi', 'en'),
(55, 'relation_concat_separator', 'relation_concat_separator', 'en'),
(56, 'relation_tree', 'relation_tree', 'en'),
(57, 'relation_depend_field', 'relation_depend_field', 'en'),
(58, 'relation_depend_on', 'relation_depend_on', 'en'),
(59, 'fk_relation_label', 'fk_relation_label', 'en'),
(60, 'fk_relation_field', 'fk_relation_field', 'en'),
(61, 'fk_relation_fk_table', 'fk_relation_fk_table', 'en'),
(62, 'fk_relation_in_fk_field', 'fk_relation_in_fk_field', 'en'),
(63, 'fk_relation_out_fk_field', 'fk_relation_out_fk_field', 'en'),
(64, 'fk_relation_rel_tbl', 'fk_relation_rel_tbl', 'en'),
(65, 'fk_relation_rel_field', 'fk_relation_rel_field', 'en'),
(66, 'fk_relation_rel_name', 'fk_relation_rel_name', 'en'),
(67, 'fk_relation_rel_where', 'fk_relation_rel_where', 'en'),
(68, 'fk_relation_rel_orderby', 'fk_relation_rel_orderby', 'en'),
(69, 'fk_relation_rel_concat_separator', 'fk_relation_rel_concat_separator', 'en'),
(70, 'fk_relation_before', 'fk_relation_before', 'en'),
(71, 'fk_relation_add_data', 'fk_relation_add_data', 'en'),
(72, 'blueticket_forms_fields_meta', 'blueticket_forms_fields_meta', 'en'),
(73, 'field_id', 'field_id', 'en'),
(74, 'meta_key', 'meta_key', 'en'),
(75, 'meta_value', 'meta_value', 'en'),
(76, 'blueticket_forms_meta', 'blueticket_forms_meta', 'en'),
(77, 'ordering', 'ordering', 'en'),
(78, 'blueticket_nested_forms', 'blueticket_nested_forms', 'en'),
(79, 'nested_form', 'nested_form', 'en'),
(80, 'form_field_name', 'form_field_name', 'en'),
(81, 'nested_form_field_name', 'nested_form_field_name', 'en'),
(82, 'blueticket_forms_fields_types', 'blueticket_forms_fields_types', 'en'),
(83, 'name', 'name', 'en'),
(84, 'subtype', 'subtype', 'en'),
(85, 'icon', 'icon', 'en'),
(86, 'parent_menu', 'parent_menu', 'en'),
(87, 'Text to translate', 'Text to translate', 'en'),
(88, 'Translated text', 'Translated text', 'en'),
(89, 'Lang', 'Lang', 'en'),
(90, 'Field meta', 'Field meta', 'en'),
(91, 'Form meta', 'Form meta', 'en'),
(92, 'Nested forms', 'Nested forms', 'en'),
(93, 'My settings', 'My settings', 'en');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
