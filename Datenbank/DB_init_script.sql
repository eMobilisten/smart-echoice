--
-- Database: `smartechoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `Autoklasse`
--

DROP TABLE IF EXISTS `Autoklasse`;
CREATE TABLE IF NOT EXISTS `Autoklasse` (
  `Autoklasse_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Autoklasse` varchar(300) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`Autoklasse_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `Autoklasse`
--

INSERT INTO `Autoklasse` (`Autoklasse_ID`, `Autoklasse`) VALUES
(1, 'Minis'),
(2, 'Kleinwagen'),
(3, 'Kompaktklasse'),
(4, 'Mittelklasse'),
(5, 'Obere Mittelklasse'),
(6, 'Oberklasse'),
(7, 'SUV'),
(8, 'Gelaendewagen'),
(9, 'Sportwagen'),
(10, 'Mini-Vans'),
(11, 'Großraum-Vans'),
(12, 'Utilities'),
(13, 'Wohnmobile'),
(14, 'Sonstiges');

-- --------------------------------------------------------

--
-- Table structure for table `Automarke`
--

DROP TABLE IF EXISTS `Automarke`;
CREATE TABLE IF NOT EXISTS `Automarke` (
  `Automarke_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Automarke` varchar(300) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`Automarke_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `Automarke`
--

INSERT INTO `Automarke` (`Automarke_ID`, `Automarke`) VALUES
(1, 'Volkswagen'),
(2, 'Opel'),
(3, 'Mercedes-Benz'),
(4, 'Ford'),
(5, 'BMW'),
(6, 'Audi'),
(7, 'Renault'),
(8, 'Skoda'),
(9, 'Toyota'),
(10, 'Peugot'),
(11, 'Fiat'),
(12, 'Nissan'),
(13, 'Hyundai'),
(14, 'Seat'),
(15, 'Citroen'),
(16, 'Mazda'),
(17, 'Kia'),
(18, 'Honda'),
(19, 'Volvo'),
(20, 'Dacia'),
(21, 'Mitsubishi'),
(22, 'Suzuki'),
(23, 'Smart'),
(24, 'Chevrolet'),
(25, 'Mini'),
(26, 'Subaru'),
(27, 'Porsche'),
(28, 'Landrover'),
(29, 'Daihatsu'),
(30, 'Rover'),
(31, 'Lancia'),
(32, 'Saab'),
(33, 'Chrysler'),
(34, 'Alfa'),
(35, 'Daewoo'),
(36, 'Jeep'),
(37, 'Lada'),
(38, 'Jaguar'),
(39, 'Lexus'),
(40, 'Maderati'),
(41, 'Trabant'),
(42, 'Wartburg'),
(43, 'Lamborghini'),
(44, 'Tesla'),
(45, 'BYD');

-- --------------------------------------------------------

--
-- Table structure for table `Car`
--

DROP TABLE IF EXISTS `Car`;
CREATE TABLE IF NOT EXISTS `Car` (
  `Car_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Automarke_ID` int(11) NOT NULL,
  `Modell` varchar(300) COLLATE latin1_german1_ci DEFAULT NULL,
  `Autoklasse_ID` int(11) NOT NULL,
  `Hybrid` double DEFAULT NULL,
  `Reichweite` double DEFAULT NULL,
  `Reichweite_e` double DEFAULT NULL,
  `Leistung` double DEFAULT NULL,
  `Leistung_e` double DEFAULT NULL,
  `Verbrauch` double DEFAULT NULL,
  `Verbrauch_e` int(11) DEFAULT NULL,
  `Emissionsklasse` varchar(300) COLLATE latin1_german1_ci DEFAULT NULL,
  `Kapazität_kwh` double DEFAULT NULL,
  `Ladestecker` varchar(300) COLLATE latin1_german1_ci DEFAULT NULL,
  `Ladezeit_schnell` double DEFAULT NULL,
  `Ladezeit_normal` double DEFAULT NULL,
  `CO2` double DEFAULT NULL,
  `Preis_min` double DEFAULT NULL,
  `Kosten_Laufend` double DEFAULT NULL,
  `Beschleunigung` double DEFAULT NULL,
  `Geschwindigkeit_max` double DEFAULT NULL,
  `Kofferraum_min` double DEFAULT NULL,
  `Kofferraum_max` double DEFAULT NULL,
  `Sitzplaetze` int(11) DEFAULT NULL,
  `image_path` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `image_stecker` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `Cluster` varchar(255) COLLATE latin1_german1_ci DEFAULT NULL,
  PRIMARY KEY (`Car_ID`),
  KEY `fk_car_autoklasse` (`Autoklasse_ID`),
  KEY `fk_car_automarke` (`Automarke_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `Car`
--

INSERT INTO `Car` (`Car_ID`, `Automarke_ID`, `Modell`, `Autoklasse_ID`, `Hybrid`, `Reichweite`, `Reichweite_e`, `Leistung`, `Leistung_e`, `Verbrauch`, `Verbrauch_e`, `Emissionsklasse`, `Kapazität_kwh`, `Ladestecker`, `Ladezeit_schnell`, `Ladezeit_normal`, `CO2`, `Preis_min`, `Kosten_Laufend`, `Beschleunigung`, `Geschwindigkeit_max`, `Kofferraum_min`, `Kofferraum_max`, `Sitzplaetze`, `image_path`, `image_stecker`, `Cluster`) VALUES
(1, 5, '330e iPerformance', 5, 1, 700, 40, 182, 0, 2.1, 11, '6', 7.6, 'Haushaltssteckdose', 0.5, 4, 44, 43600, 0, 6.1, 225, 370, 370, 5, 'assets/img/cars/BMW-330e_CC BY-SA 4.0_Tokumeigakarinoaoshima.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(2, 5, 'i3 22 kWh', 2, 0, 190, 190, 170, 170, 0, 13, '6', 18.8, 'Typ 2 AC', 0.4, 3, 0, 34950, 0, 7.2, 150, 260, 260, 4, 'assets/img/cars/BMW-i3_CC0.jpg', 'assets/img/stecker/icon-typ-2-stecker.png', 'cluster_3'),
(3, 5, 'i3 33 kWh', 2, 0, 312, 312, 170, 170, 0, 13, '6', 33, 'Typ 2 AC', 0.65, 3, 0, 40650, 0, 7.3, 150, 260, 260, 4, 'assets/img/cars/BMW-i3_CC0.jpg', 'assets/img/stecker/icon-typ-2-stecker.png', 'cluster_3'),
(4, 45, 'e 6', 4, 0, 400, 400, 122, 122, 0, 12, '6', 80, 'VTOG 30kW AC', 2, 8, 0, 59500, 0, 8, 140, 450, 450, 5, 'assets/img/cars/Byd-e6_CC2.0_anthonares.jpg', 'assets/img/stecker/icon-generic.png', 'cluster_3'),
(5, 24, 'Volt', 5, 1, 83, 60, 151, 0, 1.2, 17, '6', 16, 'Haushaltssteckdose', 0, 10, 27, 33000, 0, 0, 160, 300, 300, 5, 'assets/img/cars/Chevrolet-Volt_CC3.0_Mariordo.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(6, 15, 'Berlingo Electric', 12, 0, 170, 170, 68, 68, 0, 18, '6', 22.5, 'Haushaltssteckdose', 0.5, 9, 0, 15690, 0, 0, 110, 3300, 3300, 2, 'assets/img/cars/Citroen-Berlingo-Electric_CC3.0_Thilo_Parg-Wikimedia-Commons.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(7, 15, 'C-Zero', 2, 0, 150, 150, 68, 68, 0, 13, '6', 14.5, 'Haushaltssteckdose', 0.5, 6, 0, 19800, 0, 15.9, 130, 166, 860, 4, 'assets/img/cars/Citroen-C-Zero_CC3.0_Thomas doerfer.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(8, 15, 'E-Mehari', 2, 0, 200, 200, 68, 68, 0, 15, '6', 30, 'Haushaltssteckdose', 0, 8, 0, 24790, 0, 0, 110, 200, 800, 4, 'assets/img/cars/Citroen-e-Mehari_CC4.0_Mariordo (Mario Roberto Duran Ortiz).jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(9, 4, 'Focus Electric', 6, 0, 162, 162, 146, 146, 0, 15, '6', 33.5, 'Typ 1', 0, 6, 0, 34900, 0, 11.4, 137, 237, 1125, 5, 'assets/img/cars/Ford-Focus-Electric_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-typ-1-stecker.png', 'cluster_3'),
(10, 13, 'Ioniq Elektro', 2, 0, 280, 280, 120, 20, 0, 12, '6', 28, 'Typ 2 AC', 0, 7, 0, 33300, 0, 9.9, 150, 443, 1505, 5, 'assets/img/cars/Hyundai-Ioniq-Hybrid_CC4.0_Mariordo (Mario Roberto Duran Ortiz).jpg', 'assets/img/stecker/icon-typ-2-stecker.png', 'cluster_3'),
(11, 17, 'Soul EV', 4, 0, 165, 165, 109, 109, 0, 15, '6', 27, 'Typ 2 AC', 0, 5, 0, 28890, 0, 11.2, 145, 281, 891, 5, 'assets/img/cars/Kia-Soul-E.V._PD.jpg', 'assets/img/stecker/icon-typ-2-stecker.png', 'cluster_3'),
(12, 23, 'Fortwo Brabus Cabrio ED', 2, 0, 145, 145, 82, 82, 0, 16, '6', 17.6, 'Haushaltssteckdose', 1, 7, 0, 33080, 0, 10.2, 130, 220, 220, 2, 'assets/img/cars/Smart-Brabus-Fortwo-Cabrio_CC3.0_M93.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(13, 23, 'Fortwo Cabrio ED', 2, 0, 145, 145, 82, 82, 0, 15, '6', 17.6, 'Haushaltssteckdose', 1, 7, 0, 26770, 0, 11, 125, 220, 220, 2, 'assets/img/cars/Smart-Fortwo-Cabrio_CC3.0_M93.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(14, 23, 'Fortwo ED', 2, 0, 145, 145, 82, 82, 0, 13, '6', 17.6, 'Haushaltssteckdose', 1, 7, 0, 29990, 0, 11, 125, 220, 220, 2, 'assets/img/cars/Smart-Fortwo-Coupe-Prime_CC3.0_M93.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(15, 44, 'S60', 6, 0, 400, 400, 320, 320, 0, 22, '6', 60, 'Chademo', 0.5, 4, 0, 81419, 0, 5.8, 210, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_2'),
(16, 44, 'S60D', 6, 0, 408, 408, 332, 332, 0, 22, '6', 60, 'Chademo', 0.5, 4, 0, 87119, 0, 5.4, 210, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_2'),
(17, 44, 'S75', 6, 0, 450, 450, 320, 320, 0, 0, '6', 75, 'Chademo', 0.5, 4, 0, 91020, 0, 5.8, 225, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_2'),
(18, 44, 'S75D', 6, 0, 490, 490, 332, 332, 0, 0, '6', 75, 'Chademo', 0.5, 4, 0, 96720, 0, 5.4, 225, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_2'),
(19, 44, 'S90D', 6, 0, 557, 557, 422, 422, 0, 18, '6', 90, 'Chademo', 0.5, 4, 0, 107720, 0, 4.4, 250, 745, 745, 5, 'assets/img/cars/Tesla-Model-S90D_CC4.0_Peteratkins.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_0'),
(20, 44, 'S100D', 6, 0, 632, 632, 574, 574, 0, 0, '6', 100, 'Chademo', 0.5, 4, 0, 111120, 0, 4.4, 250, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_0'),
(21, 44, 'SP100D', 6, 0, 613, 613, 612, 612, 0, 0, '6', 100, 'Chademo', 0.5, 4, 0, 159220, 0, 2.7, 250, 745, 745, 5, 'assets/img/cars/Tesla-Model-S_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_4'),
(22, 44, 'X75D', 7, 0, 417, 417, 332, 332, 0, 0, '6', 75, 'Chademo', 0.5, 4, 0, 111400, 0, 6.2, 210, 745, 1645, 7, 'assets/img/cars/Tesla-Model-X_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_0'),
(23, 44, 'X90D', 7, 0, 489, 489, 422, 422, 0, 0, '6', 90, 'Chademo', 0.5, 4, 0, 122300, 0, 5, 250, 745, 1645, 7, 'assets/img/cars/Tesla-Model-X_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_1'),
(24, 44, 'X100D', 7, 0, 565, 565, 525, 525, 0, 0, '6', 100, 'Chademo', 0.5, 4, 0, 125700, 0, 5, 250, 745, 1645, 7, 'assets/img/cars/Tesla-Model-X_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_1'),
(25, 44, 'XP100D', 7, 0, 542, 542, 732, 732, 0, 0, '6', 100, 'Chademo', 0.5, 4, 0, 167800, 0, 3.1, 250, 745, 1645, 7, 'assets/img/cars/Tesla-Model-X_CC2.0_Mariordo.jpg', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_4'),
(26, 44, 'Model 3', 5, 0, 350, 350, 320, 320, 0, 17, '6', 60, 'Chademo', 0.5, 4, 0, 30000, 0, 5.8, 209, 400, 1000, 5, 'assets/img/cars/Tesla-Model-3_CC2.0_Peter-Stevens.JPG', 'assets/img/stecker/icon-chademo-stecker.png', 'cluster_3'),
(27, 1, 'E-Golf', 3, 0, 190, 190, 115, 85, 0, 13, '6', 24.2, 'CCS Netzladekabel Typ2', 0.5, 9, 0, 35900, 0, 10.4, 140, 305, 425, 4, 'assets/img/cars/VW-e-Golf_C3.0_M93.jpg', 'assets/img/stecker/icon-typ-2-css-combo-stecker.png', 'cluster_3'),
(28, 1, 'E-Up!', 2, 0, 160, 160, 81, 60, 0, 12, '6', 24.2, 'CCS Netzladekabel Typ2', 0.5, 9, 0, 22520, 0, 12.4, 130, 305, 425, 4, 'assets/img/cars/VW-e-up!_CC2.0_MotorBlog.jpg', 'assets/img/stecker/icon-typ-2-css-combo-stecker.png', 'cluster_3'),
(29, 3, 'C 350 e Limousine', 4, 1, 700, 31, 292, 60, 2.1, 12, '6', 6.4, 'n/a', 120, 210, 55, 50961, 960, 5.9, 250, 335, 335, 5, 'assets/img/cars/Mercedes-Benz_C350e_CC BY-SA 4.0_Tokumeigakarinoaoshima.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(30, 3, 'C 350 e T-Modell', 4, 1, 700, 31, 292, 60, 2.1, 12, '6', 6.4, 'n/a', 120, 210, 55, 52627, 960, 6.2, 250, 450, 1470, 5, 'assets/img/cars/Mercedes-Benz_C350e_CC BY-SA 4.0_Tokumeigakarinoaoshima.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(31, 3, 'S 500 e lang', 6, 1, 700, 33, 450, 85, 2.8, 16, '6', 8.7, 'n/a', 120, 246, 65, 110250, 0, 5.2, 250, 395, 385, 5, 'assets/img/cars/Mercedes-Benz_S_500_CC3.0_M93.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_0'),
(32, 3, 'E 350 e Limousine', 5, 1, 700, 33, 292, 60, 2.5, 14, '6', 6.4, 'n/a', 90, 186, 57, 59440, 0, 6.2, 250, 450, 1470, 5, 'assets/img/cars/Mercedes-Benz-E350_CC0.JPG', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(33, 21, 'Outlander Plug-in Hybrid', 4, 1, 800, 54, 285, 120, 1.7, 13, '6', 12, 'n/a', 25, 300, 41, 39900, 0, 11, 170, 450, 1600, 5, 'assets/img/cars/Mitsubishi-Hybrid-Outlander_CC4.0_Mitsubishi-Motors.jpg', 'assets/img/stecker/icon-typ-1-stecker.png', 'cluster_3'),
(34, 12, 'Leaf', 2, 0, 250, 250, 110, 80, 0, 15, '6', 30, 'n/a', 240, 600, 0, 23365, 0, 11.5, 144, 370, 720, 5, 'assets/img/cars/Nissan-Leaf_CC3.0_M93.jpg', '', 'cluster_3'),
(35, 12, 'E-NV200 Evalia', 10, 0, 170, 170, 110, 80, 0, 17, '6', 24, 'n/a', 30, 348, 0, 31706, 0, 0, 123, 900, 2900, 7, 'assets/img/cars/Nissan-e-NV200-Evalia_Karlis Dambrans.jpg', '', 'cluster_3'),
(36, 27, 'Panamera 4 E-Hybrid', 6, 1, 51, 51, 466, 100, 2.5, 16, '6', 14, 'n/a', 138, 240, 56, 109219, 0, 4.6, 278, 405, 1245, 5, 'assets/img/cars/Porsche-Panamera-sport-Turismo-e-hybrid_CC2.0_Ben.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_0'),
(37, 27, 'Cayenne S E-Hybrid', 6, 1, 38, 38, 430, 70, 3.4, 19, '6', 10.8, 'n/a', 78, 162, 79, 86966, 0, 5.9, 243, 580, 1690, 5, 'assets/img/cars/Porsche-Cayenne-S-e-hybrid_CC3.0_Thesupermat.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_2'),
(38, 7, 'Twizy', 1, 0, 100, 100, 18, 13, 0, 0, '6', 6.1, 'n/a', 0, 210, 0, 7690, 0, 0, 80, 31, 31, 2, 'assets/img/cars/Renault-Twizy-ZE_CC3.0_Jwh.jpg', 'assets/img/stecker/icon-schuko.png', 'cluster_3'),
(39, 7, 'Zoe', 2, 0, 403, 403, 92, 68, 0, 13, '6', 41, 'n/a', 65, 870, 0, 0, 0, 13.2, 135, 340, 1225, 5, 'assets/img/cars/zoe.jpg', '', 'cluster_3');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
CREATE TABLE IF NOT EXISTS `Comments` (
  `Comment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Car_ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE latin1_german1_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE latin1_german1_ci DEFAULT NULL,
  `Kommentar` varchar(500) COLLATE latin1_german1_ci DEFAULT NULL,
  `Datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Comment_ID`),
  KEY `fk_car_comments` (`Car_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Car`
--
ALTER TABLE `Car`
  ADD CONSTRAINT `fk_car_autoklasse` FOREIGN KEY (`Autoklasse_ID`) REFERENCES `Autoklasse` (`Autoklasse_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_car_automarke` FOREIGN KEY (`Automarke_ID`) REFERENCES `Automarke` (`Automarke_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `fk_car_comments` FOREIGN KEY (`Car_ID`) REFERENCES `Car` (`Car_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
