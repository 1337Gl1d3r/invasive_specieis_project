-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2018 at 05:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_admin`
--

CREATE TABLE `e_admin` (
  `admin_id` varchar(255) NOT NULL,
  `admin_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_agency`
--

CREATE TABLE `e_agency` (
  `agency_name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `jurisdiction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_agency`
--

INSERT INTO `e_agency` (`agency_name`, `website`, `jurisdiction`) VALUES
('Alberta Invasive Species Council', 'abinvasives.ca', 'Provincial');

-- --------------------------------------------------------

--
-- Table structure for table `e_animals`
--

CREATE TABLE `e_animals` (
  `inv_sci_name` varchar(255) NOT NULL,
  `subphylum` varchar(255) DEFAULT NULL,
  `reproduction` varchar(255) DEFAULT NULL,
  `life_span` varchar(255) DEFAULT NULL,
  `habitat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_distribution_method`
--

CREATE TABLE `e_distribution_method` (
  `dist_type` varchar(255) NOT NULL,
  `prev_measures` varchar(255) DEFAULT NULL,
  `dist_desc` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_distribution_method`
--

INSERT INTO `e_distribution_method` (`dist_type`, `prev_measures`, `dist_desc`) VALUES
('Animals and Humans', NULL, NULL),
('Underground rhizomes', NULL, NULL),
('Wind', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_family`
--

CREATE TABLE `e_family` (
  `family_name` varchar(255) NOT NULL,
  `family_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_family`
--

INSERT INTO `e_family` (`family_name`, `family_desc`) VALUES
('Sunflower', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_impacted_species`
--

CREATE TABLE `e_impacted_species` (
  `imp_sci_name` varchar(255) NOT NULL,
  `imp_com_name` varchar(255) DEFAULT NULL,
  `imp_desc` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_impacted_species`
--

INSERT INTO `e_impacted_species` (`imp_sci_name`, `imp_com_name`, `imp_desc`) VALUES
('Brassica napus', 'Rapeseed (Canola)', 0x3c68746d6c3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a0d0a4c617267652c20636c75622d7368617065642067616c6c7320666f726d206f6e2074686520726f6f7473206f66200d0a686f737420706c616e74732c20776869636820696e697469616c6c792061726520936669726d20616e642068617665200d0a6120776869746973682d636f6c6f7572656420617070656172616e63652c20627574206265636f6d65200d0a736f66742c2073706f6e677920616e642074616b65206f6e20612062726f776e69736820636f6c6f7572200d0a61732074686579206d617475726520616e64206465636f6d706f7365206c6174657220696e20746865200d0a736561736f6e2e940d0a2054686520657874656e74206f662067616c6c696e672076617269657320616e64200d0a646570656e6473206f6e3b20616d6f756e74206f6620502e2062726173736963616520696e6f63756c756d200d0a696e2074686520736f696c2c20656e7669726f6e6d656e74616c20636f6e646974696f6e7320617420746865200d0a74696d652c20616e64207468652070726573656e6365206f6620616e7920726573697374616e636520696e200d0a74686520686f737420706c616e742e);

-- --------------------------------------------------------

--
-- Table structure for table `e_invasive_species`
--

CREATE TABLE `e_invasive_species` (
  `inv_sci_name` varchar(255) NOT NULL,
  `inv_com_name` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `aquatic` varchar(255) DEFAULT NULL,
  `inv_desc` blob,
  `concern` varchar(255) DEFAULT NULL,
  `management` varchar(255) DEFAULT NULL,
  `inv_ref` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_invasive_species`
--

INSERT INTO `e_invasive_species` (`inv_sci_name`, `inv_com_name`, `thumbnail`, `aquatic`, `inv_desc`, `concern`, `management`, `inv_ref`) VALUES
('Campanula rapunculoides', 'Creeping Bellflower', 'Campanula-rapunculoides-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f43616d70616e756c612d726170756e63756c6f696465732e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a4372656570696e672042656c6c666c6f7765722069732061206d656d626572206f662074686520426f726167696e61636561652028426f72616765292066616d696c792c206974207761730d0a696e74726f647563656420617320616e206f726e616d656e74616c2066726f6d204575726f70652c0d0a6f74686572206e616d657320696e636c756465204372656570696e672042656c6c666c6f7765722c206f72204372656570696e6720426c756562656c6c2e20, 'Aggressive root system, extremely difficult to control. ', 'Long term, hand pull before seed set (although its difficult to get the entire root), resistant to some chemicals, mowing will not kill this plant, but will prevent flowering. ', 'Wheatland County'),
('Centaurea x psammogena', 'Hybrid Knapweed', 'Centaurea-x-psammogena-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f43656e7461757265612d782d7073616d6d6f67656e612e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a487962726964204b6e6170776565642069732061206d656d626572206f66207468652041737465726163656165202853756e666c6f77657229200d0a46616d696c7920616e64206973206120687962726964206f662053706f7474656420616e642044696666757365206b6e617077656564732e0d0a54726169747320617265207661726961626c6520616e642077696c6c207368617265207472616974732066726f6d20626f74682053706f7474656420616e642044696666757365204b6e617077656564732e, 'Poses a threat to native areas in Alberta pastureland.', 'Long term monitoring, hand pick, chemical, and biological agents. ', 'Wheatland County'),
('Hieracium aurantiacum', 'Orange Hawkweed', 'Hieracium-aurantiacum-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f48696572616369756d2d617572616e74696163756d2e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a4f72616e6765204861776b776565642069732061206d656d626572206f66207468652041737465726163656165202853756e666c6f776572292046616d696c7920616e642077617320696e74726f64756365642066726f6d204575726f706520617320616e206f726e616d656e74616c2e20416c736f206b6e6f776e20617320646576696c9273207061696e7462727573682e20556e70616c617461626c652e20, 'Highly invasive.', 'Chemical.', 'Wheatland County'),
('Leucanthemum vulgare', 'Oxeye Daisy', 'Leucanthemum-vulgare-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f4c657563616e7468656d756d2d76756c676172652e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a4f786579652044616973792069732061206d656d626572206f66207468652020202020202041737465726163656165202853756e666c6f776572292066616d696c7920616e642077617320696e74726f64756365642066726f6d204575726f706520617320616e206f726e616d656e74616c2e204974206973206f6674656e20666f756e642067726f77696e6720617320616e206f726e616d656e74616c20616e6420616c6f6e6720726f6164776179732e, 'Can outcompete native vegetation.', 'Chemical, mowing or  deadhead (pull the flower off when bloom is finished) to prevent seed set, don\'t share daisies with your friends and neighbors! Be wary of wildflower seed mixes.', 'Wheatland County'),
('Plasmodiophora brassicae', 'Clubroot', 'Plasmodiophora-brassicae-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f506c61736d6f64696f70686f72612d6272617373696361652e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a0d0a436c7562726f6f74206973206361757365642062792074686520736f696c2d626f726e652064697365617365200d0a506c61736d6f64696f70686f7261206272617373696361652e20496e66656374696f6e206279200d0a7468697320706174686f67656e20636175736573206c617267652067616c6c7320746f20666f726d206f6e200d0a726f6f74732c20776869636820696e7465726665726573207769746820776174657220616e64206e750d0a2d0d0a747269656e7420757074616b652e0d0a0d0a5468697320706174686f67656e206166666563747320706c616e7473200d0a696e20746865204272617373696361636561652066616d696c7920776869636820696e636c75646573200d0a766567657461626c652063726f7073206c696b652063616262616765732c206361756c69666c6f776572732c200d0a7261646973682c20616e642063616e6f6c612c20616e642063616e20726564756365207969656c6473200d0a7369676e69666963616e746c792e0d0a496e20746865206c6174652031383030732061206c6172676520706f7274696f6e206f6620746865206361620d0a2d0d0a626167652063726f70206661696c656420696e205275737369612064756520746f20696e66656374696f6e206279200d0a502e206272617373696361652e20546865205275737369616e20736369656e7469737420576f726f6e696e200d0a6964656e7469666965642074686520706174686f67656e20616e64206e616d65642069742e0d0a20496e20746865200d0a552e532e2c206669727374207265706f727473206f6620636c7562726f6f74206f6363757272656420696e20746865200d0a31383530730d0a20616e6420757020756e74696c203230303320697420776173206f6e6c792073706f726164690d0a2d0d0a63616c6c79207265706f72746564206f6e207468652043616e616469616e20707261726965732e0d0a204174200d0a746869732074696d6520697420776173206669727374206964656e746966696564206f6e2063616e6f6c6120696e200d0a416c62657274612e0d0a0d0a53696e636520696e66656374696f6e20627920502e206272617373696361652072656475636573200d0a74686520686f737420706c616e749273206162696c69747920746f206f627461696e207265736f75726365732c200d0a73796d70746f6d73206f6620696e66656374696f6e20617265207374756e74696e672c2079656c6c6f770d0a2d0d0a696e6720616e642077696c74696e672e0d0a204578616d696e6174696f6e206f662074686520706c616e749273200d0a726f6f747320666f722067616c6c7320697320746865206f6e6c792077617920746f20636f6e6669726d20696e0d0a2d0d0a66656374696f6e2e20536f6d65206f7468657220666163746f72732063616e20636175736520726f6f74200d0a7377656c6c696e672c20736f20696620636c7562726f6f74206973207375737065637465642069742073686f756c64200d0a626520636f6e6669726d6564206279207175616c696669656420696e646976696475616c732e, 'Clubroot galls release spores into the soil\r\nwhich may remain viable for up to 20 years.\r\nGermination of the spores produces a life \r\nstage of the disease which infect root hairs \r\nof the host plant.', 'Once a field is infested with \r\nclubroot, a strict sanitation program is re-quired to prevent spread. This protocol will\r\napply to ANY vehicle, machinery and even \r\nfoot traffic that enter and leave the field.', 'Alberta Invasive Species Council'),
('Ranunculus acris', 'Tall Buttercup', 'Ranunculus-acris-thumb.jpg', 'No', 0x3c68746d6c3e0d0a3c696d67207372633d22696d616765732f52616e756e63756c75732d61637269732e6a7067222077696474683d223130303022202f3e0d0a3c703e0d0a3c7374726f6e673e47656e6572616c204465736372697074696f6e3a203c2f7374726f6e673e0d0a54616c6c204275747465726375702069732061206d656d626572206f66207468652052616e756e63756c616365616520284275747465726375702f2043726f77666f6f74292066616d696c792c2069742077617320696e74726f64756365642066726f6d204575726f70652c20616e64206974206f6674656e20666f756e6420696e206d6f6973742070617374757265732e, 'Contains a bitter, irritating oil called protoanemonin that is toxic to livestock.', 'Chemical control can be   effective, for prevention maintain pasture health.', 'Wheatland County');

-- --------------------------------------------------------

--
-- Table structure for table `e_invasive_status`
--

CREATE TABLE `e_invasive_status` (
  `inv_status` varchar(255) NOT NULL,
  `legal_act_num` varchar(255) NOT NULL,
  `status_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_invasive_status`
--

INSERT INTO `e_invasive_status` (`inv_status`, `legal_act_num`, `status_desc`) VALUES
('AB - Noxious', 'Alberta Regulation 19/2010', NULL),
('AB - Noxious Prohibited', 'Alberta Regulation 19/2010 ', NULL),
('AB - Pests', 'Alberta Regulation 184/2001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_life_cycle`
--

CREATE TABLE `e_life_cycle` (
  `lc_type` varchar(255) NOT NULL,
  `implication` varchar(255) DEFAULT NULL,
  `lc_desc` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_life_cycle`
--

INSERT INTO `e_life_cycle` (`lc_type`, `implication`, `lc_desc`) VALUES
('Biennial', NULL, NULL),
('Perennial', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_pathogens`
--

CREATE TABLE `e_pathogens` (
  `inv_sci_name` varchar(255) NOT NULL,
  `path_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_pathogens`
--

INSERT INTO `e_pathogens` (`inv_sci_name`, `path_type`) VALUES
('Plasmodiophora brassicae', 'Phytomyxea Parasite');

-- --------------------------------------------------------

--
-- Table structure for table `e_plants`
--

CREATE TABLE `e_plants` (
  `inv_sci_name` varchar(255) NOT NULL,
  `root_desc` varchar(255) DEFAULT NULL,
  `seed_desc` varchar(255) DEFAULT NULL,
  `leaf_desc` varchar(255) DEFAULT NULL,
  `flower_desc` varchar(255) DEFAULT NULL,
  `stem_desc` varchar(255) DEFAULT NULL,
  `similar_species` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_plants`
--

INSERT INTO `e_plants` (`inv_sci_name`, `root_desc`, `seed_desc`, `leaf_desc`, `flower_desc`, `stem_desc`, `similar_species`) VALUES
('Campanula rapunculoides', 'Thick creeping rhizomes make this plant very aggressive and difficult to control. ', 'One plant can produce thousands of seeds per year, seeds are small and light brown. ', 'Alternately arranged on the stem, heart shaped with jagged edges (variable), lower leaves have longer stems (petiole), upper leaves have little to no stem. ', 'Purple, bell shaped, 5 lobes.', 'No branching, 20 - 60cm tall. ', 'Native bluebells.'),
('Centaurea x psammogena', 'Woody taproot. ', 'Prolific seed producer.', 'Finely divided, covered with  fine hairs.', 'Purple or white, Bracts have a dark tip (similar to Spotted Knapweed) and long bristles on the margins (similar to Diffuse Knapweed).', '20-80cm tall, branched. ', 'Spotted Knapweed, Diffuse Knapweed'),
('Hieracium aurantiacum', 'Shallow, fibrous, creeping. Differs from natives in that it produces stolons', 'Dark brown or black with ridges and bristly plumes. ', 'Rosette leaves are narrow, spatula-shaped, hairy, 10-15cm long ', '5 to 30 brilliant orange flowers form a compact umbrella-like inflorescence at top of the stem, petals have notched tips.', '30-90cm tall with bristly hairs and 0 - 3 small leaves. The entire plant contains a milky juice. ', 'Meadow Hawkweed, Mouse-ear Hawkweed and native hawkweeds'),
('Leucanthemum vulgare', 'Shallow, branched rhizomes (slightly creeping).', 'Numerous, small, black with ribs.', 'Variable. Basal and lower stem leaves have long narrow stalks, rounded teeth, spoon shaped. Upper stem leaves are smaller towards the top, no stalk, and are toothed. ', '2 - 5cm diameter flower head per,  one flower per stem, white outer  petals (ray florets) and a yellow center (disk florets). May have an unpleasant odour.', '20-80cm tall, simple or once branched, smooth, grooved, hairless. ', 'Scentless Chamomile.'),
('Ranunculus acris', 'Hairy, fibrous, rhizomatous.', 'Small, black  brown, each plant produces about 250 seeds, the seed clusters have a hook which can catch fur and clothing.', 'Hairy, leaves are deeply lobed (nearly to the base) into three to five   segments with each segment lobed again. Leaves decrease in size toward the top of the plant, uppermost leaves have three to four narrow segments.', 'Glossy yellow flowers in clusters, up to 3cm in diameter with greenish center, 5 petals, 10-14mm long. ', 'Up to 100cm tall, branched in the upper part of the plant, sometimes hairy.', 'Sulfur Cinquefoil and looks similar to native buttercup species. ');

-- --------------------------------------------------------

--
-- Table structure for table `m_flower_colour`
--

CREATE TABLE `m_flower_colour` (
  `inv_sci_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_flower_colour`
--

INSERT INTO `m_flower_colour` (`inv_sci_name`, `color`) VALUES
('Campanula rapunculoides', 'purple'),
('Centaurea x psammogena', 'pink'),
('Centaurea x psammogena', 'purple'),
('Centaurea x psammogena', 'white'),
('Hieracium aurantiacum', 'orange'),
('Leucanthemum vulgare', 'white'),
('Ranunculus acris', 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `r_has`
--

CREATE TABLE `r_has` (
  `lc_type` varchar(255) NOT NULL,
  `inv_sci_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_has`
--

INSERT INTO `r_has` (`lc_type`, `inv_sci_name`) VALUES
('Biennial', 'Centaurea x psammogena'),
('Perennial', 'Campanula rapunculoides'),
('Perennial', 'Hieracium aurantiacum'),
('Perennial', 'Leucanthemum vulgare'),
('Perennial', 'Ranunculus acris');

-- --------------------------------------------------------

--
-- Table structure for table `r_impacts`
--

CREATE TABLE `r_impacts` (
  `inv_sci_name` varchar(255) NOT NULL,
  `imp_sci_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_impacts`
--

INSERT INTO `r_impacts` (`inv_sci_name`, `imp_sci_name`) VALUES
('Plasmodiophora brassicae', 'Brassica napus');

-- --------------------------------------------------------

--
-- Table structure for table `r_legal_status`
--

CREATE TABLE `r_legal_status` (
  `inv_sci_name` varchar(255) NOT NULL,
  `inv_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_legal_status`
--

INSERT INTO `r_legal_status` (`inv_sci_name`, `inv_status`) VALUES
('Campanula rapunculoides', 'AB - Noxious'),
('Centaurea x psammogena', 'AB - Noxious Prohibited'),
('Hieracium aurantiacum', 'AB - Noxious Prohibited'),
('Leucanthemum vulgare', 'AB - Noxious'),
('Plasmodiophora brassicae', 'AB - Pests'),
('Ranunculus acris', 'AB - Noxious');

-- --------------------------------------------------------

--
-- Table structure for table `r_maintains`
--

CREATE TABLE `r_maintains` (
  `admin_id` varchar(255) DEFAULT NULL,
  `inv_sci_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_member_of`
--

CREATE TABLE `r_member_of` (
  `inv_sci_name` varchar(255) NOT NULL,
  `family_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_member_of`
--

INSERT INTO `r_member_of` (`inv_sci_name`, `family_name`) VALUES
('Centaurea x psammogena', 'Sunflower'),
('Hieracium aurantiacum', 'Sunflower'),
('Leucanthemum vulgare', 'Sunflower');

-- --------------------------------------------------------

--
-- Table structure for table `r_spread_by`
--

CREATE TABLE `r_spread_by` (
  `inv_sci_name` varchar(255) NOT NULL,
  `dist_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_spread_by`
--

INSERT INTO `r_spread_by` (`inv_sci_name`, `dist_type`) VALUES
('Plasmodiophora brassicae', 'Animals and Humans'),
('Ranunculus acris', 'Animals and Humans'),
('Campanula rapunculoides', 'Underground rhizomes'),
('Centaurea x psammogena', 'Wind'),
('Hieracium aurantiacum', 'Wind'),
('Leucanthemum vulgare', 'Wind');

-- --------------------------------------------------------

--
-- Table structure for table `r_who_can_help`
--

CREATE TABLE `r_who_can_help` (
  `inv_sci_name` varchar(255) NOT NULL,
  `agency_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_who_can_help`
--

INSERT INTO `r_who_can_help` (`inv_sci_name`, `agency_name`) VALUES
('Campanula rapunculoides', 'Alberta Invasive Species Council'),
('Centaurea x psammogena', 'Alberta Invasive Species Council'),
('Hieracium aurantiacum', 'Alberta Invasive Species Council'),
('Leucanthemum vulgare', 'Alberta Invasive Species Council'),
('Plasmodiophora brassicae', 'Alberta Invasive Species Council'),
('Ranunculus acris', 'Alberta Invasive Species Council');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_admin`
--
ALTER TABLE `e_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `e_agency`
--
ALTER TABLE `e_agency`
  ADD PRIMARY KEY (`agency_name`);

--
-- Indexes for table `e_animals`
--
ALTER TABLE `e_animals`
  ADD PRIMARY KEY (`inv_sci_name`);

--
-- Indexes for table `e_distribution_method`
--
ALTER TABLE `e_distribution_method`
  ADD PRIMARY KEY (`dist_type`);

--
-- Indexes for table `e_family`
--
ALTER TABLE `e_family`
  ADD PRIMARY KEY (`family_name`);

--
-- Indexes for table `e_impacted_species`
--
ALTER TABLE `e_impacted_species`
  ADD PRIMARY KEY (`imp_sci_name`);

--
-- Indexes for table `e_invasive_species`
--
ALTER TABLE `e_invasive_species`
  ADD PRIMARY KEY (`inv_sci_name`);

--
-- Indexes for table `e_invasive_status`
--
ALTER TABLE `e_invasive_status`
  ADD PRIMARY KEY (`inv_status`,`legal_act_num`) USING BTREE;

--
-- Indexes for table `e_life_cycle`
--
ALTER TABLE `e_life_cycle`
  ADD PRIMARY KEY (`lc_type`);

--
-- Indexes for table `e_pathogens`
--
ALTER TABLE `e_pathogens`
  ADD PRIMARY KEY (`inv_sci_name`);

--
-- Indexes for table `e_plants`
--
ALTER TABLE `e_plants`
  ADD PRIMARY KEY (`inv_sci_name`);

--
-- Indexes for table `m_flower_colour`
--
ALTER TABLE `m_flower_colour`
  ADD PRIMARY KEY (`inv_sci_name`,`color`);

--
-- Indexes for table `r_has`
--
ALTER TABLE `r_has`
  ADD PRIMARY KEY (`inv_sci_name`),
  ADD KEY `has_2` (`lc_type`);

--
-- Indexes for table `r_impacts`
--
ALTER TABLE `r_impacts`
  ADD PRIMARY KEY (`inv_sci_name`),
  ADD KEY `impact_2` (`imp_sci_name`);

--
-- Indexes for table `r_legal_status`
--
ALTER TABLE `r_legal_status`
  ADD PRIMARY KEY (`inv_sci_name`,`inv_status`),
  ADD KEY `legal_1` (`inv_status`);

--
-- Indexes for table `r_maintains`
--
ALTER TABLE `r_maintains`
  ADD KEY `maintain_1` (`admin_id`),
  ADD KEY `maintain_2` (`inv_sci_name`);

--
-- Indexes for table `r_member_of`
--
ALTER TABLE `r_member_of`
  ADD PRIMARY KEY (`inv_sci_name`),
  ADD KEY `member_2` (`family_name`);

--
-- Indexes for table `r_spread_by`
--
ALTER TABLE `r_spread_by`
  ADD PRIMARY KEY (`inv_sci_name`),
  ADD KEY `spread_2` (`dist_type`);

--
-- Indexes for table `r_who_can_help`
--
ALTER TABLE `r_who_can_help`
  ADD PRIMARY KEY (`inv_sci_name`),
  ADD KEY `who_1` (`agency_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `e_animals`
--
ALTER TABLE `e_animals`
  ADD CONSTRAINT `animal_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `e_pathogens`
--
ALTER TABLE `e_pathogens`
  ADD CONSTRAINT `path_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `e_plants`
--
ALTER TABLE `e_plants`
  ADD CONSTRAINT `plants_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_flower_colour`
--
ALTER TABLE `m_flower_colour`
  ADD CONSTRAINT `color_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_has`
--
ALTER TABLE `r_has`
  ADD CONSTRAINT `has_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `has_2` FOREIGN KEY (`lc_type`) REFERENCES `e_life_cycle` (`lc_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_impacts`
--
ALTER TABLE `r_impacts`
  ADD CONSTRAINT `impact_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impact_2` FOREIGN KEY (`imp_sci_name`) REFERENCES `e_impacted_species` (`imp_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_legal_status`
--
ALTER TABLE `r_legal_status`
  ADD CONSTRAINT `legal_1` FOREIGN KEY (`inv_status`) REFERENCES `e_invasive_status` (`inv_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `legal_2` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_maintains`
--
ALTER TABLE `r_maintains`
  ADD CONSTRAINT `maintain_1` FOREIGN KEY (`admin_id`) REFERENCES `e_admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintain_2` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_member_of`
--
ALTER TABLE `r_member_of`
  ADD CONSTRAINT `member_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_2` FOREIGN KEY (`family_name`) REFERENCES `e_family` (`family_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_spread_by`
--
ALTER TABLE `r_spread_by`
  ADD CONSTRAINT `spread_1` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spread_2` FOREIGN KEY (`dist_type`) REFERENCES `e_distribution_method` (`dist_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `r_who_can_help`
--
ALTER TABLE `r_who_can_help`
  ADD CONSTRAINT `who_1` FOREIGN KEY (`agency_name`) REFERENCES `e_agency` (`agency_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `who_2` FOREIGN KEY (`inv_sci_name`) REFERENCES `e_invasive_species` (`inv_sci_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
