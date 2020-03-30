-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2019 at 02:21 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstname`, `lastname`, `email`, `password`) VALUES
('Anuj', 'Kumar', 'admin@examsystem.com', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `uid` varchar(255) NOT NULL,
  `quizid` int(10) NOT NULL,
  `attemptid` int(10) NOT NULL,
  `score` int(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`uid`, `quizid`, `attemptid`, `score`, `date`) VALUES
('prasher.neeraj99@gmail.com', 1, 10, 0, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 11, 0, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 12, 0, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 13, 0, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 14, 0, '2019-10-09'),
('kaurmanpreet@gmail.com', 2, 20, 8, '2019-10-09'),
('kaurmanpreet@gmail.com', 1, 21, 3, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 22, 1, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 23, 3, '2019-10-09'),
('prasher.neeraj99@gmail.com', 1, 24, 3, '2019-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryid` int(10) NOT NULL,
  `categoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`) VALUES
(1, 'Programming'),
(2, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `quizid` int(10) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `questionid` int(10) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`quizid`, `question`, `answer`, `questionid`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, 'What is the correct JavaScript syntax to write \"Hello World\"?', 'option3', 1, 'System.out.println(\"Hello World\")', 'println (\"Hello World\")', 'document.write(\"Hello World\")', 'response.write(\"Hello World\")'),
(1, 'Inside which HTML element do we put the JavaScript?', 'option3', 2, '<js>', '<scripting>', '<script>', '<javascript>'),
(1, 'What is the correct syntax for referring to an external script called \" abc.js\"?', 'option3', 3, '<script href=\" abc.js\">', '<script name=\" abc.js\">', '<script src=\" abc.js\">', 'None of the above'),
(1, ' Which types of image maps can be used with JavaScript?', 'option2', 4, 'Server-side image maps', 'Client-side image maps', 'Server-side image maps and Client-side image maps', 'None of the above'),
(1, 'What does the <noscript> tag do?', 'option1', 5, 'Enclose text to be displayed by non-JavaScript browsers.', 'Prevents scripts on the page from executing.', 'Describes certain low-budget movies.', 'None of the above'),
(1, 'Which of the following best describes JavaScript?', 'option4', 6, ' a low-level programming language.', 'a scripting language precompiled in the browser.', 'a compiled scripting language.', 'an object-oriented scripting language.'),
(1, 'Choose the server-side JavaScript object?', 'option3', 7, 'FileUpLoad', 'Function', 'File', 'Date'),
(1, 'Choose the client-side JavaScript object?', 'option4', 8, 'Database', 'Cursor', 'Client', 'FileUpLoad'),
(1, 'Which of the following is not considered a JavaScript operator?', 'option2', 9, 'new', 'this', 'delete', 'typeof'),
(1, '______method evaluates a string of JavaScript code in the context of the specified', 'option1', 10, 'Eval', 'ParseInt', 'ParseFloat', 'Efloat'),
(1, 'JavaScript is interpreted by _________', 'option1', 11, 'Client', 'Server', 'Object', 'None of the above'),
(1, 'Using _______ statement is how you test for a specific condition.', 'option2', 12, 'Select', 'If', 'Switch', 'For'),
(1, 'The _______ method of an Array object adds and/or removes elements from an array.', 'option4', 13, 'Reverse', 'Shift', 'Slice', 'Splice'),
(1, 'In JavaScript, _________ is an object of the target language data type that encloses an object of the source language.', 'option1', 14, 'wrapper', 'link', 'cursor', 'form'),
(1, ' When a JavaScript object is sent to Java, the runtime engine creates a Java wrapper of type ___________', 'option2', 15, 'ScriptObject', 'JSObject', 'JavaObject', 'Jobject'),
(1, '_______ class provides an interface for invoking JavaScript methods and examining JavaScript properties.', 'option2', 16, 'ScriptObject', 'JSObject', 'JavaObject', 'Jobject'),
(1, '_________ is a wrapped Java array, accessed from within JavaScript code.', 'option1', 17, 'JavaArray', 'JavaClass', 'JavaObject', 'JavaPackage'),
(1, 'The syntax of a blur method in a button object is ______________', 'option1', 18, 'Blur()', 'Blur(contrast)', 'Blur(value)', 'Blur(depth)'),
(1, 'The syntax of close method for document object is ______________', 'option4', 19, 'Close(doC.', 'Close(object)', 'Close(val)', 'Close()'),
(1, 'What will be the result of:\r\n<script language=\"javascript\">\r\nfunction x()\r\n{\r\ndocument.write(2+5+\"8\");\r\n}\r\n</script>', 'option4', 20, '258', 'Error', '7', '78'),
(2, ' What is the order of swim strokes in the Individual Medley?', 'option2', 21, 'Backstroke, Breaststroke, Freestyle, Butterfly', ' Butterfly, Backstroke, Breaststroke, Freestyle', 'Breaststroke, Freestyle, Butterfly, Backstroke', 'Freestyle, Backstroke, Butterfly, Breaststroke'),
(2, 'For which swimming stroke is diving not recommended to start a race?', 'option1', 22, 'Backstroke', 'Freestyle', 'Breaststroke', 'Butterfly'),
(2, 'What is the name of the piece of equipment often used to assist in training when swimming arms only?', 'option1', 23, 'Pull Buoy', 'Goggles', 'Kickboard', 'Arm Bands'),
(2, 'Which events combine with swimming to form a triathlon?', 'option2', 24, 'Rowing and Running', 'Running and Cycling', 'Long Jump and Pole Vault', 'Cycling and Rifle Shooting'),
(2, 'Many children learning to swim do so with foam discs on their arms. What are these otherwise known as?', 'option2', 25, 'Cakes', 'Biscuits', 'Cookies', 'Crackers'),
(2, 'Is swimming recognised as an event in the Winter Olympic Games?', 'No', 26, 'Yes', 'No', '', ''),
(2, 'Which strokes require a \"two-hand-touch\" in competitive swimming?', 'Breaststroke and Butterfly', 27, 'Frontcrawl and Backstroke', 'Butterfly and Backstroke', 'Breaststroke and Freestyle', 'Breaststroke and Butterfly'),
(2, 'Which of these is a simple swimming stroke, often the first taught to young children?', 'Dog Paddle', 28, 'Monkey Paddle', 'Cat Paddle', 'Dog Paddle', 'Rabbit Paddle'),
(2, 'Which of these strokes is not a lifesaving stroke?', 'Sculling', 29, 'Sculling', 'Vice Grip and Trawl', 'Extended Arm Tow', 'Lifesaving Breaststroke'),
(2, 'In which year did swimming in the Olympics first happen in a pool rather than in open water?', '1908', 30, '1924', '1900', '1908', '1912'),
(2, 'What is the kick that you do with freestyle/front crawl and backstroke called?', 'option3', 31, 'Backstroke Kick', 'Flutter Kick', 'Scissors Kick', 'Front Crawl Kick'),
(2, 'What do you call the kick that you do with breastroke?', 'option4', 32, '\r\nFrog kick', 'Circle kick', 'Front crawl kick', 'Breastoke kick'),
(2, 'What does IM stand for', 'option3', 33, 'Interesting Meets', '\r\nI\'m a Master', 'Individual Medley', 'none'),
(2, 'What is the order of an IM?', 'option3', 34, '\r\nFly, Back, Breast, Free', '\r\nBack, Breast, Free, Fly', 'Free, Fly, Back, Breast', 'Breast, Fly, Back, Free'),
(2, 'In a IM relay, the IM order goes:', 'option4', 35, 'Free, Back, Fly, Breast', 'Free, Fly, Back, Breast', 'Back, Fly, Breast, Free', 'Fly, Breast, Free, Back'),
(2, 'Which of the four strokes is considered the universal stroke, and is also the fastest?', 'option2', 36, 'Butterfly', 'Breaststroke', 'Backstroke', 'Freestyle'),
(2, 'The length of swimming pools is measured in two increments. What are the increments?', 'option3', 37, 'feet and hands', 'meters and feet', 'meters and yards', 'feet and yards'),
(2, 'How many lanes are used in a full heat of swimming in a regulation Olympic-sized pool?', 'option2', 38, '6', '8', '7', '5'),
(2, 'The flip turn is only used in two of the four strokes in swimming. Which ones are they?', 'option4', 39, 'butterfly and backstroke', 'butterfly and freestyle', 'freestyle and backstroke', 'freestyle and breaststroke'),
(2, 'Which of these countries won at least one medal in swimming at the Sydney 2000 Olympics?', 'option1', 40, 'South Africa, Costa Rica, and Ukraine', 'New Zealand, Italy, and Canada', 'South Africa, China, and Ukraine', 'Russia, Costa Rica, and South Korea');

-- --------------------------------------------------------

--
-- Table structure for table `quizs`
--

CREATE TABLE `quizs` (
  `quizid` int(10) NOT NULL,
  `quizname` varchar(255) NOT NULL,
  `categoryid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizs`
--

INSERT INTO `quizs` (`quizid`, `quizname`, `categoryid`) VALUES
(1, 'JavaScript', 1),
(2, 'Swimming', 2);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Mobile` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`First_name`, `Last_name`, `Mobile`, `Email`, `Address`, `Password`) VALUES
('Neeraj', 'Prasher', 12345, 'prasher.neeraj99@gmail.com', 'brampton', '12345'),
('anuj', 'kumar', 898989, 'anujkumar@gmail.com', 'toronto', '12345'),
('example', 'example', 1234, 'example@gmail.com', 'toronto', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`attemptid`),
  ADD KEY `quizid` (`quizid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `quizid` (`quizid`),
  ADD KEY `optionsid` (`questionid`);

--
-- Indexes for table `quizs`
--
ALTER TABLE `quizs`
  ADD PRIMARY KEY (`quizid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `attemptid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`quizid`) REFERENCES `quizs` (`quizid`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quizid`) REFERENCES `quizs` (`quizid`);

--
-- Constraints for table `quizs`
--
ALTER TABLE `quizs`
  ADD CONSTRAINT `quizs_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
