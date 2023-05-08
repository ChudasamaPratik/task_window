-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 09:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_window`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(5) NOT NULL,
  `DepartmentName` varchar(250) DEFAULT NULL,
  `HOD_id` int(11) DEFAULT NULL,
  `CreateAt` timestamp NULL DEFAULT current_timestamp(),
  `UpdateAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `DepartmentName`, `HOD_id`, `CreateAt`, `UpdateAt`) VALUES
(1, 'Coding ', 3, '2023-02-19 06:48:55', NULL),
(2, 'Testing', 6, '2023-02-19 07:42:25', NULL),
(3, 'Design', 5, '2023-02-19 07:42:31', NULL),
(4, 'Human Resource', NULL, '2023-03-08 06:14:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Id` int(11) NOT NULL,
  `EmployeeUsername` varchar(255) NOT NULL,
  `EmployeeName` varchar(255) NOT NULL,
  `EmployeeEmail` varchar(255) NOT NULL,
  `EmployeeBirth` date NOT NULL,
  `EmployeeDept` varchar(255) NOT NULL,
  `EmployeeGender` varchar(255) NOT NULL,
  `EmployeeMobile` bigint(255) NOT NULL,
  `EmployeeJoin` date NOT NULL,
  `EmployeeDesc` varchar(255) NOT NULL,
  `EmployeePassword` varchar(255) NOT NULL,
  `EmployeeAddress` varchar(255) NOT NULL,
  `EmployeeRole` tinyint(2) NOT NULL,
  `EmployeeImage` varchar(255) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT 0,
  `Createat` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updateat` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Id`, `EmployeeUsername`, `EmployeeName`, `EmployeeEmail`, `EmployeeBirth`, `EmployeeDept`, `EmployeeGender`, `EmployeeMobile`, `EmployeeJoin`, `EmployeeDesc`, `EmployeePassword`, `EmployeeAddress`, `EmployeeRole`, `EmployeeImage`, `flag`, `Createat`, `Updateat`) VALUES
(1, 'Admin', '', 'admin@gmail.com', '0000-00-00', '', '', 0, '0000-00-00', '', '202cb962ac59075b964b07152d234b70', '', 1, '', 0, '2023-02-19 05:45:34', '2023-02-19 06:42:05'),
(2, 'EMP_1', 'Ridham ', 'ridham@gmail.com', '2000-02-11', '1', 'Male', 8523697415, '2023-02-19', 'Good', '202cb962ac59075b964b07152d234b70', 'Rajkot ', 3, '1676792645.png', 0, '2023-02-19 07:13:18', '2023-02-19 08:42:26'),
(3, 'HOD_1', 'ram', 'ram@gmail.com', '2000-02-01', '1', 'Male', 9871236547, '2023-01-02', 'good', '202cb962ac59075b964b07152d234b70', 'rajkot', 2, '1676792717.png', 0, '2023-02-19 07:45:17', '2023-02-19 07:48:31'),
(4, 'EMP_2', 'Mitali', 'mitali@gmail.com', '2004-02-03', '2', 'Female', 9872583649, '2023-02-07', '', '202cb962ac59075b964b07152d234b70', 'rajkot', 3, '1676800845.png', 0, '2023-02-19 10:00:45', '2023-02-19 10:01:02'),
(5, 'HOD_2', 'mahesh', 'mahesh@gmail.com', '1968-02-02', '3', 'Male', 6549873218, '2023-02-19', '', '202cb962ac59075b964b07152d234b70', 'goa', 2, '1676801017.png', 0, '2023-02-19 10:03:37', NULL),
(6, 'HOD_3', 'raj', 'raj@gmail.com', '2003-09-09', '2', 'Male', 8855667456, '2023-02-24', '', '202cb962ac59075b964b07152d234b70', 'jamanagar', 2, '1676801117.png', 0, '2023-02-19 10:05:17', NULL),
(7, 'EMP_3', 'Rajveer', 'rajveer@gmail.com', '1999-05-08', '3', 'Male', 9963258745, '2023-02-15', '', '202cb962ac59075b964b07152d234b70', 'chuda', 3, '1676801232.png', 0, '2023-02-19 10:07:12', '2023-02-19 11:24:40'),
(8, 'EMP_4', 'Mahesh1 ', 'mahesh1@gmail.com', '1980-03-04', '4', 'Male', 9874563218, '2021-03-08', '', '202cb962ac59075b964b07152d234b70', 'Rajkot', 3, '1678256594.png', 0, '2023-03-08 06:23:14', '2023-03-08 06:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Createat` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updateat` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ID`, `ProjectName`, `Status`, `Createat`, `Updateat`) VALUES
(1, 'Task Management System', 0, '2023-02-19 07:39:37', '2023-03-08 08:08:24'),
(2, 'Human Resource Management ', 0, '2023-02-19 07:42:01', NULL),
(3, 'Dairy Management System', 0, '2023-02-19 10:01:57', NULL),
(4, 'Hostel Management System', 0, '2023-03-07 14:10:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Id` int(11) NOT NULL,
  `DeptId` int(10) NOT NULL,
  `AssignTaskto` int(10) NOT NULL,
  `TaskPriority` varchar(150) NOT NULL,
  `ProjectId` int(10) NOT NULL,
  `TaskTitle` varchar(255) NOT NULL,
  `TaskDescription` varchar(255) NOT NULL,
  `TaskEnddate` date NOT NULL,
  `TaskAssigndate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(255) NOT NULL DEFAULT 'pending',
  `WorkCompleted` varchar(250) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `Createat` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updateat` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`Id`, `DeptId`, `AssignTaskto`, `TaskPriority`, `ProjectId`, `TaskTitle`, `TaskDescription`, `TaskEnddate`, `TaskAssigndate`, `Status`, `WorkCompleted`, `Remark`, `Createat`, `Updateat`) VALUES
(1, 1, 2, 'Most Urgent', 1, 'Research in employee task.', 'give me full details.', '2023-02-25', '2023-02-19 08:13:19', 'Completed', '100', 'ok', '2023-02-26 09:36:44', '2023-03-08 08:23:11'),
(2, 4, 8, 'Medium', 4, 'get new employee', 'on LinkedIn', '2023-04-08', '2023-03-08 06:25:28', 'Completed', '100', 'select 10 employees\r\nfor interview', '2023-03-08 06:25:28', '2023-03-08 06:48:02'),
(3, 2, 4, 'Urgent', 2, 'Give me all Details ', 'file structure ', '2023-03-08', '2023-03-08 06:26:54', 'Completed', '100', 'Done', '2023-03-08 06:26:54', '2023-03-08 06:27:24'),
(4, 1, 2, 'Normal', 2, 'Give final Report', 'with screenshot ', '2023-03-08', '2023-03-08 06:32:32', 'Completed', '100', 'done.\r\nsend in email', '2023-03-08 06:32:32', '2023-03-08 08:10:46'),
(5, 3, 7, 'Most Urgent', 4, 'Give me Design for front end ', 'given as demo', '2023-03-18', '2023-03-08 08:08:13', 'Inprogress', '20', 'i will check', '2023-03-08 08:08:13', '2023-03-08 08:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `tasktracking`
--

CREATE TABLE `tasktracking` (
  `ID` int(10) NOT NULL,
  `TaskID` int(10) DEFAULT NULL,
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `WorkCompleted` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tasktracking`
--

INSERT INTO `tasktracking` (`ID`, `TaskID`, `Remark`, `Status`, `WorkCompleted`, `UpdationDate`) VALUES
(1, 1, 'I will work on it', 'Inprogress', '1', '2023-02-19 08:31:16'),
(2, 3, 'Done', 'Completed', '100', '2023-03-08 06:27:24'),
(3, 4, 'done.\r\nsend in email', 'Completed', '100', '2023-03-08 06:33:06'),
(4, 2, 'ok I will check it', 'Inprogress', '50', '2023-03-08 06:46:48'),
(5, 2, 'select 10 employees\r\nfor interview', 'Completed', '100', '2023-03-08 06:48:02'),
(6, 5, 'i will check', 'Inprogress', '20', '2023-03-08 08:12:29'),
(7, 1, 'ok', 'Completed', '100', '2023-03-08 08:23:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `EmployeeUsername` (`EmployeeUsername`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tasktracking`
--
ALTER TABLE `tasktracking`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasktracking`
--
ALTER TABLE `tasktracking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
