-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 09:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etutoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `Admin_Id` int(11) NOT NULL,
  `Admin_Login_Id` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`Admin_Id`, `Admin_Login_Id`, `Admin_Password`, `Admin_Name`) VALUES
(1, 'Admin', 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `Blog_Id` int(11) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `Lecturer_Id` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Blog_Post` varchar(255) NOT NULL,
  `Post_Image` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment_Id` int(11) NOT NULL,
  `Blog_Id` int(11) NOT NULL,
  `Comment_Detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_management`
--

CREATE TABLE `file_management` (
  `File_Id` int(11) NOT NULL,
  `File_Link` varchar(255) NOT NULL,
  `File_Title` varchar(255) NOT NULL,
  `Uploaded_Date` datetime NOT NULL,
  `Upload_Id` varchar(255) NOT NULL,
  `Received_Id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_management`
--

INSERT INTO `file_management` (`File_Id`, `File_Link`, `File_Title`, `Uploaded_Date`, `Upload_Id`, `Received_Id`) VALUES
(1, 'ProductBacklogNote.txt', 'This is the BackLog', '2024-03-27 12:12:10', 'XXXX 1900584', 'XXXX-1900584');

-- --------------------------------------------------------

--
-- Table structure for table `group_student_lecturer`
--

CREATE TABLE `group_student_lecturer` (
  `Group_Id` int(11) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `Lecturer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_student_lecturer`
--

INSERT INTO `group_student_lecturer` (`Group_Id`, `Student_Id`, `Lecturer_Id`) VALUES
(3, 2, 1),
(9, 4, 2),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `Lecturer_Id` int(11) NOT NULL,
  `Program_Id` int(11) NOT NULL,
  `Lecturer_Login_Id` varchar(255) NOT NULL,
  `Lecturer_Password` varchar(255) NOT NULL,
  `Lecturer_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`Lecturer_Id`, `Program_Id`, `Lecturer_Login_Id`, `Lecturer_Password`, `Lecturer_Name`, `Email`) VALUES
(1, 1, 'XXXX-1900584', '$2y$10$SonMoi9/aivUYj40aTRaQePyeglLvtsbEq0OFOmgMBHiYLwEbU3qS', 'MR Lim', 'MRLim@gmail.com'),
(2, 2, 'SCPG-1800141', '$2y$10$nyxfQP3jYVevU2Ph048j5OZBAH5/rIQp5yXSA3vY5ZqrMn4I0mTJC', 'Muffin Lim', 'limyongkhang@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `meeting_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `recorded_meeting_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `student_id`, `time_slot_id`, `meeting_link`, `created_at`, `recorded_meeting_link`) VALUES
(10, 3, 4, 'https://meet.google.com/kyx-spzi-drj', '2024-04-01 06:17:46', NULL),
(11, 3, 5, 'https://meet.google.com/kyx-spzi-drj', '2024-04-01 06:17:50', 'https://www.youtube.com/watch?v=ImtZ5yENzgE');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `Program_Id` int(11) NOT NULL,
  `Program_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`Program_Id`, `Program_name`) VALUES
(1, 'Business'),
(2, 'Computing'),
(3, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_Id` int(11) NOT NULL,
  `Program_Id` int(11) NOT NULL,
  `Student_Login_Id` varchar(255) NOT NULL,
  `Student_Password` varchar(255) NOT NULL,
  `Student_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_Id`, `Program_Id`, `Student_Login_Id`, `Student_Password`, `Student_Name`, `Email`) VALUES
(2, 1, 'XXXX-1900584', '$2y$10$meAnr35Ba8X.xlpR1EiXkOsi0IolimoaBeXENGheeDlKAcRFVCf12', 'Muffim', 'Muffim2@gmail.com'),
(3, 2, 'SCPG-1314520', '$2y$10$1y9ZxFM04qc6goASLw/KpegBZwX/TbENTcLz/VE7zSYpKuTgJab.C', 'Clover0510', 'clover0510love@gmail.com'),
(4, 2, 'SCPG-1900714', '$2y$10$PNmJJXK6y613eTv.E3ZseeQBPgSXeFaCTDtwZ.//IypuXd9ne8fdS', 'Hakimi', 'limmuffin0510@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `lecture_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `lecture_id`, `start_time`, `end_time`) VALUES
(4, 2, '2024-04-01 17:00:00', '2024-04-01 17:30:00'),
(5, 2, '2024-04-01 19:00:00', '2024-04-01 19:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Blog_Id`),
  ADD KEY `FK_Blog_Student_Id` (`Student_Id`),
  ADD KEY `FK_Blog_Lecturer_Id` (`Lecturer_Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment_Id`),
  ADD KEY `FK_Comment_Blog_Id` (`Blog_Id`);

--
-- Indexes for table `file_management`
--
ALTER TABLE `file_management`
  ADD PRIMARY KEY (`File_Id`),
  ADD KEY `File_Lecturer_Id` (`Upload_Id`),
  ADD KEY `File_Student_Id` (`Received_Id`);

--
-- Indexes for table `group_student_lecturer`
--
ALTER TABLE `group_student_lecturer`
  ADD PRIMARY KEY (`Group_Id`),
  ADD KEY `FK_Group_Student_Id` (`Student_Id`),
  ADD KEY `FK_Group_Lecturer_Id` (`Lecturer_Id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`Lecturer_Id`),
  ADD KEY `FK_Lecturer_Program_Id` (`Program_Id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `time_slot_id` (`time_slot_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`Program_Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_Id`),
  ADD KEY `FK_Student_Program_Id` (`Program_Id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`),
  ADD KEY `lecture_id` (`lecture_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `Blog_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Comment_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_management`
--
ALTER TABLE `file_management`
  MODIFY `File_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_student_lecturer`
--
ALTER TABLE `group_student_lecturer`
  MODIFY `Group_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `Lecturer_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `Program_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_Blog_Lecturer_Id` FOREIGN KEY (`Lecturer_Id`) REFERENCES `lecturer` (`Lecturer_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Blog_Student_Id` FOREIGN KEY (`Student_Id`) REFERENCES `student` (`Student_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Comment_Blog_Id` FOREIGN KEY (`Blog_Id`) REFERENCES `blog` (`Blog_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_student_lecturer`
--
ALTER TABLE `group_student_lecturer`
  ADD CONSTRAINT `FK_Group_Lecturer_Id` FOREIGN KEY (`Lecturer_Id`) REFERENCES `lecturer` (`Lecturer_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Group_Student_Id` FOREIGN KEY (`Student_Id`) REFERENCES `student` (`Student_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `FK_Lecturer_Program_Id` FOREIGN KEY (`Program_Id`) REFERENCES `program` (`Program_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`Student_Id`),
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_Student_Program_Id` FOREIGN KEY (`Program_Id`) REFERENCES `program` (`Program_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD CONSTRAINT `time_slot_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecturer` (`Lecturer_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
