
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
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `File_Id` int(11) NOT NULL,
  `File_Link` varchar(255) NOT NULL,
  `File_Type` varchar(255) NOT NULL,
  `Lecturer_Id` int(11) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `Group_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(47, 1, 2);

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
(1, 1, 'Lecturer', 'Lecturer', 'Lecturer 1', 'Lecturer@gmail.com'),
(2, 1, 'Lecturer2', '$2y$10$BFTYhGbcBsygnQ8PJpJ3den.yCn/TvsmsBf7BhBBctAdCjUtghs7.', 'Lecturer2', 'Lecturer2@gmail.com'),
(3, 2, 'Lecturer3', '$2y$10$4tcOJKJmrvj3jVHaVXoYb.rXb5pY7gOdAWAAV8BPGTYtJiPU22Kw2', 'Lecturer3', 'Lecturer3@gmail.com'),
(4, 2, 'Lecturer5', '$2y$10$suzXufCM3/wwjXeBqCt2b.H5MZxbdrHhRC3.LcHc4CQdCq3qHTwBm', 'Lecturer5', 'Lecturer5@gmail.com'),
(5, 1, 'Lecturer6', '$2y$10$/IrhBCw6ZaZSpFL/YWFw8uzQJLUMuKz9yC0fXvkLbqlgEFzCpZ7Ce', 'Lecturer6', 'Lecturer6@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `Meeting_Id` int(11) NOT NULL,
  `Student_Id` int(11) NOT NULL,
  `Lecturer_Id` int(11) NOT NULL,
  `Meeting_Start` time NOT NULL,
  `Meeting_End` time NOT NULL,
  `Date` datetime NOT NULL,
  `Meetin_Link` varchar(255) NOT NULL,
  `Meeting_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, 'Student1', '$2y$10$.a9mc9Tp/ULMFGvGOJiJGORxL8JBagce59i.bAaYprEjTtpMQXNiG', 'Student1', 'Student1@gmail.com'),
(2, 1, 'Student2', '$2y$10$pPNOueFRrMExzVvE.h9TneOFAbYhR6LICrhr3eQWRxDtVm1zE48kO', 'Student2', 'Student2@gmail.com');

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
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD KEY `File_Lecturer_Id` (`Lecturer_Id`),
  ADD KEY `File_Student_Id` (`Student_Id`),
  ADD KEY `File_Group_Id` (`Group_Id`);

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
  ADD PRIMARY KEY (`Meeting_Id`),
  ADD KEY `FK_Meeting_Student_Id` (`Student_Id`),
  ADD KEY `FK_Meeting_Lecturer_Id` (`Lecturer_Id`);

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
-- AUTO_INCREMENT for table `group_student_lecturer`
--
ALTER TABLE `group_student_lecturer`
  MODIFY `Group_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `Lecturer_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `Meeting_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `Program_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
