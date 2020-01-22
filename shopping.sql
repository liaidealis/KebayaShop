-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 21, 2020 at 10:59 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `shoping`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_produk`
-- 

CREATE TABLE `tbl_produk` (
  `id` int(11) NOT NULL auto_increment,
  `nama_produk` varchar(20) character set latin1 NOT NULL,
  `bahan_produk` varchar(20) character set latin1 NOT NULL,
  `code_produk` varchar(20) character set latin1 NOT NULL,
  `image_produk` varchar(20) character set latin1 NOT NULL,
  `price_produk` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `tbl_produk`
-- 

INSERT INTO `tbl_produk` VALUES (1, 'Kebaya Modis', 'Katun', 'K001', 'kebaya1.jpg', 700000);
INSERT INTO `tbl_produk` VALUES (2, 'Terserah', 'Bahan', 'K002', 'kebaya2.jpg', 12312);
