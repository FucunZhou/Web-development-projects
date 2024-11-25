SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cst8257lab5`
--

USE cst8257lab5;
-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS Course (
  CourseCode varchar(10) NOT NULL,
  Title varchar(256) NOT NULL,
  WeeklyHours int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Course`
--

INSERT INTO Course (CourseCode, Title, WeeklyHours) VALUES
('CAD8400', 'AutoCAD I', 3),
('CAD8405', 'AutoCAD II', 4),
('CON8101', 'Residential Building/Estimating', 5),
('CON8102', 'Commercial Building/Estimating', 5),
('CON8404', 'Civil Estimating', 3),
('CON8406', 'Project Scheduling and Cost Control', 3),
('CON8411', 'Construction Materials I', 3),
('CON8416', 'GIS for Civil Engineering', 3),
('CON8417', 'Construction Materials II', 5),
('CON8418', 'Construction Building Code', 3),
('CON8425', ' Design of Steel Structures', 3),
('CON8430', 'Computers and You', 3),
('CON8436', 'Building Systems', 5),
('CON8445', 'Soils Analysis', 3),
('CON8447', 'Foundations', 3),
('CON8466', 'Highway Engineering', 3),
('CON8476', 'Business Principles', 3),
('CST8110', 'Introduction to Computer Programming', 4),
('CST8209', 'Web Programming I', 4),
('CST8250', 'Database Design and Administration', 4),
('CST8253', 'Web Programming II', 3),
('CST8254', 'Network Operating Systems', 4),
('CST8255', 'Web Imaging and Animations', 3),
('CST8256', 'Web Programming Languages I', 4),
('CST8257', 'Web Applications Development', 4),
('CST8258', 'Web Project Management', 3),
('CST8259', 'Web Programming Languages II', 4),
('CST8260', 'Database System and Concepts', 3),
('CST8265', 'Web Security Basics', 4),
('CST8267', 'Ecommerce', 3),
('ENG8101', 'Statics', 5),
('ENG8102', 'Strength of Materials', 3),
('ENG8328', 'Hydraulics', 3),
('ENG8404', 'Introduction to Structural Design', 3),
('ENG8411', 'Structural Analysis', 3),
('ENG8435', 'Reinforced Concrete Design', 3),
('ENG8451', 'Water and Waste Water Technology', 3),
('ENG8454', 'Geotechnical Materials', 3),
('ENL1818M', 'Communications II', 6),
('ENL1818T', 'Communications I', 3),
('ENL1819Q', 'Reporting Technical Information II', 5),
('ENL1819T', 'Reporting Technical Information', 3),
('ENL4004', 'Orientation to Report Writing', 4),
('ENL8420', 'Project Report', 3),
('ENV8400', 'Environmental Engineering', 3),
('GED0192', 'General Education Elective', 3),
('MAT8001', 'Math Fundamentals', 3),
('MAT8050', 'Geometry and Trigonometry', 3),
('MAT8051', 'Algebra', 3),
('MAT8201', 'Calculus 1', 3),
('MGT8100', 'Career and College Success Skills', 3),
('MGT8400', 'Project Administration', 4),
('SAF8408', 'Health and Safety', 4),
('SUR8400', 'Civil Surveying III', 3),
('SUR8411', 'Construction Surveying I', 5),
('SUR8417', 'Construction Surveying II', 3),
('WKT8100', 'Cooperative Education Work Term Preparation', 5);

-- --------------------------------------------------------

--
-- Table structure for table `CourseOffer`
--

CREATE TABLE IF NOT EXISTS `CourseOffer` (
  `CourseCode` varchar(10) NOT NULL,
  `SemesterCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CourseOffer`
--

INSERT INTO `CourseOffer` (`CourseCode`, `SemesterCode`) VALUES
('CAD8405', '17F'),
('CON8418', '17F'),
('ENG8328', '17F'),
('ENG8404', '17F'),
('ENG8411', '17F'),
('ENG8454', '17F'),
('MGT8400', '17F'),
('CAD8400', '17S'),
('CON8404', '17S'),
('CON8436', '17S'),
('CST8253', '17S'),
('CST8254', '17S'),
('CST8255', '17S'),
('ENG8102', '17S'),
('GED0192', '17S'),
('MAT8051', '17S'),
('SUR8417', '17S'),
('CON8102', '17W'),
('CON8417', '17W'),
('CST8250', '17W'),
('ENG8101', '17W'),
('ENL1818M', '17W'),
('ENL1818T', '17W'),
('MAT8001', '17W'),
('MAT8050', '17W'),
('MGT8100', '17W'),
('SAF8408', '17W'),
('SUR8411', '17W'),
('CON8447', '18F'),
('CON8476', '18F'),
('CST8110', '18F'),
('CST8209', '18F'),
('CST8260', '18F'),
('ENG8435', '18F'),
('ENG8451', '18F'),
('ENL8420', '18F'),
('CON8416', '18S'),
('ENG8404', '18S'),
('ENG8454', '18S'),
('ENL4004', '18S'),
('MAT8201', '18S'),
('SUR8400', '18S'),
('CAD8405', '18W'),
('CON8406', '18W'),
('CON8418', '18W'),
('CON8425', '18W'),
('CON8445', '18W'),
('CON8466', '18W'),
('ENG8328', '18W'),
('ENG8411', '18W'),
('ENL1819Q', '18W'),
('ENV8400', '18W'),
('MGT8400', '18W'),
('CON8101', '19F'),
('CON8411', '19F'),
('CON8430', '19F'),
('CST8258', '19F'),
('CST8259', '19F'),
('CST8265', '19F'),
('CST8267', '19F'),
('ENL1819T', '19F'),
('WKT8100', '19F'),
('CST8253', '19S'),
('CST8254', '19S'),
('CST8255', '19S'),
('CST8256', '19S'),
('CST8257', '19S'),
('CST8110', '19W'),
('CST8209', '19W'),
('CST8250', '19W'),
('CST8260', '19W'),
('ENL1818T', '19W'),
('MAT8001', '19W'),
('MGT8100', '19W');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE IF NOT EXISTS `Registration` (
  `StudentId` varchar(16) NOT NULL,
  `CourseCode` varchar(10) NOT NULL,
  `SemesterCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Semester`
--

CREATE TABLE IF NOT EXISTS `Semester` (
  `SemesterCode` varchar(10) NOT NULL,
  `Term` varchar(10) NOT NULL,
  `Year` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Semester`
--

INSERT INTO `Semester` (`SemesterCode`, `Term`, `Year`) VALUES
('17F', 'Fall', 2017),
('17S', 'Summer', 2017),
('17W', 'Winter', 2017),
('18F', 'Fall', 2018),
('18S', 'Summer', 2018),
('18W', 'Winter', 2018),
('19F', 'Fall', 2019),
('19S', 'Summer', 2019),
('19W', 'Winter', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `StudentId` varchar(16) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`CourseCode`);

--
-- Indexes for table `CourseOffer`
--
ALTER TABLE `CourseOffer`
  ADD PRIMARY KEY (`CourseCode`,`SemesterCode`),
  ADD KEY `CourseOffer_Semester` (`SemesterCode`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`StudentId`,`CourseCode`,`SemesterCode`),
  ADD KEY `Registration_CourseOffer_FK1` (`CourseCode`),
  ADD KEY `Registration_CourseOffer_FK2` (`SemesterCode`);

--
-- Indexes for table `Semester`
--
ALTER TABLE `Semester`
  ADD PRIMARY KEY (`SemesterCode`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`StudentId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CourseOffer`
--
ALTER TABLE `CourseOffer`
  ADD CONSTRAINT `CourseOffer_Course_FK` FOREIGN KEY (`CourseCode`) REFERENCES `Course` (`CourseCode`),
  ADD CONSTRAINT `CourseOffer_Semester` FOREIGN KEY (`SemesterCode`) REFERENCES `Semester` (`SemesterCode`);

--
-- Constraints for table `Registration`
--
ALTER TABLE `Registration`
  ADD CONSTRAINT `Registration_CourseOffer_FK1` FOREIGN KEY (`CourseCode`) REFERENCES `CourseOffer` (`CourseCode`),
  ADD CONSTRAINT `Registration_CourseOffer_FK2` FOREIGN KEY (`SemesterCode`) REFERENCES `CourseOffer` (`SemesterCode`),
  ADD CONSTRAINT `Registration_Student_FK` FOREIGN KEY (`StudentId`) REFERENCES `Student` (`StudentId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
