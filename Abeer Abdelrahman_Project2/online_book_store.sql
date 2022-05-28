-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 10:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

 -- Database: `online_book_store` 
 --

 -- --------------------------------------------------------

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Abeer Bashir', 'abeer@gmail.com', '$2y$10$nO/YODGAiyHH72N404YegusC8Zfj5v7xPxJOpfGa.w6DtjatKIblG');



CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/* Indexes for table `admin` */

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);


/* Indexes for table `authors` */

ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);


/* Indexes for table `books`*/

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

/* Indexes for table `categories`*/

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);


/* Indexes for table `users` */

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

/* AUTO_INCREMENT for dumped tables

 AUTO_INCREMENT for table `admin`
*/

ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/* AUTO_INCREMENT for table `authors` */

ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/* AUTO_INCREMENT for table `books` */

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/* AUTO_INCREMENT for table `categories` */

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


 /*AUTO_INCREMENT for table `admin`*/

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;





