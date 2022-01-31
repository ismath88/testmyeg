-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 06:56 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoom_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `access_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `access_token`) VALUES
(13, '{\"access_token\":\"eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiI1ODM5ZmJhMi1kNzI0LTRmMzQtOGUyMi03ODMxZDFmN2ZkMGYifQ.eyJ2ZXIiOjcsImF1aWQiOiJmODczYTI3OTllMTQ4MGNiZDE2ZGFhMDFjYTYwZTZjMyIsImNvZGUiOiJrR3VmeFhld1lyX2xlTHh5S3BDUjdlU0cybzhSVjFURmciLCJpc3MiOiJ6bTpjaWQ6WVZNTG1SNG5TWUtVNGl5czMwYkJHQSIsImdubyI6MCwidHlwZSI6MCwidGlkIjozLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJsZUx4eUtwQ1I3ZVNHMm84UlYxVEZnIiwibmJmIjoxNjA3MTA0MTM5LCJleHAiOjE2MDcxMDc3MzksImlhdCI6MTYwNzEwNDEzOSwiYWlkIjoiWXU0bE0zZG9TYjZ5Ums4U0xYMDdVdyIsImp0aSI6IjQ3MDUzNjVjLTAzZDEtNGEzZS1iY2U0LTNiNzk4NmQ5YjBiZCJ9.P87UfS5htONzWpoYQ8wCNdjUAW5t0Goar0rGVzIRpzj1gN3-7_xg_B_-NyzB1rtK4Tt-79lprkPS8vQ339DmSw\",\"token_type\":\"bearer\",\"refresh_token\":\"eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiIyNDNkMjA3Yy0zOGM3LTQ4ZWQtOTBmOS1jYzQzOWZhMjgxN2EifQ.eyJ2ZXIiOjcsImF1aWQiOiJmODczYTI3OTllMTQ4MGNiZDE2ZGFhMDFjYTYwZTZjMyIsImNvZGUiOiJrR3VmeFhld1lyX2xlTHh5S3BDUjdlU0cybzhSVjFURmciLCJpc3MiOiJ6bTpjaWQ6WVZNTG1SNG5TWUtVNGl5czMwYkJHQSIsImdubyI6MCwidHlwZSI6MSwidGlkIjozLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJsZUx4eUtwQ1I3ZVNHMm84UlYxVEZnIiwibmJmIjoxNjA3MTA0MTM5LCJleHAiOjIwODAxNDQxMzksImlhdCI6MTYwNzEwNDEzOSwiYWlkIjoiWXU0bE0zZG9TYjZ5Ums4U0xYMDdVdyIsImp0aSI6ImZlNTA3Y2ZmLTJhOWMtNGU3YS04YTBmLTlmMDc3ODQ4NDdmZiJ9.ion5WKTfB1XK9ZgCHTsI1_TRnJtrzqTcoDFTAOYWuAMzsNrEBlUrFv6zZNh4XXEgKHFyy1hivLtWSi-wB5Bsdw\",\"expires_in\":3599,\"scope\":\"meeting:read meeting:write\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
