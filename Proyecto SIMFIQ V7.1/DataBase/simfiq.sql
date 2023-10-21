-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 09:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simfiq`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisis`
--

CREATE TABLE `analisis` (
  `IDAnalisis` int(11) NOT NULL,
  `IDMAP` int(11) NOT NULL,
  `pH` varchar(20) DEFAULT NULL,
  `Ce` varchar(20) DEFAULT NULL,
  `Suelo_CIC` varchar(20) DEFAULT NULL,
  `Suelo_Textura` varchar(25) DEFAULT NULL,
  `Agua_ParticulasSuspension` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analisis`
--

INSERT INTO `analisis` (`IDAnalisis`, `IDMAP`, `pH`, `Ce`, `Suelo_CIC`, `Suelo_Textura`, `Agua_ParticulasSuspension`) VALUES
(16, 16, '7', '', '', '', ''),
(17, 20, '7', '7', '', '', '500000'),
(18, 15, '', '', '', '', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `facturacion`
--

CREATE TABLE `facturacion` (
  `ID_Facture` int(11) NOT NULL,
  `IDAnalisis` int(11) NOT NULL,
  `Precio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturacion`
--

INSERT INTO `facturacion` (`ID_Facture`, `IDAnalisis`, `Precio`) VALUES
(11, 16, 5.00),
(12, 17, 15.00),
(13, 18, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `maguaxmap`
--

CREATE TABLE `maguaxmap` (
  `IDRegistro` int(11) NOT NULL,
  `IDMuestraAgua` int(11) NOT NULL,
  `IDMuestraAProcesar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `maguaxmap`
--

INSERT INTO `maguaxmap` (`IDRegistro`, `IDMuestraAgua`, `IDMuestraAProcesar`) VALUES
(5, 19, 13),
(6, 20, 14),
(7, 21, 15),
(8, 21, 16),
(9, 22, 20);

-- --------------------------------------------------------

--
-- Table structure for table `msueloxmap`
--

CREATE TABLE `msueloxmap` (
  `IDRegistro` int(11) NOT NULL,
  `IDMuestraSuelo` int(11) NOT NULL,
  `IDMuestraAProcesar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `msueloxmap`
--

INSERT INTO `msueloxmap` (`IDRegistro`, `IDMuestraSuelo`, `IDMuestraAProcesar`) VALUES
(7, 22, 11),
(8, 22, 12),
(9, 23, 17),
(10, 23, 18);

-- --------------------------------------------------------

--
-- Table structure for table `muestra_agua`
--

CREATE TABLE `muestra_agua` (
  `ID_Muestra` int(11) NOT NULL,
  `ID_Productor` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Fuente_Agua` varchar(25) NOT NULL,
  `Recibido_Por` varchar(30) NOT NULL,
  `Recolectada_Por` varchar(30) NOT NULL,
  `Cultivo_A_Regar` varchar(30) NOT NULL,
  `Problemas_De_Sales` varchar(10) NOT NULL,
  `Tratamiento_pH` varchar(35) NOT NULL,
  `Sistema_Riego` varchar(35) NOT NULL,
  `Cantidad_Usada` decimal(11,4) NOT NULL,
  `pH_Metro` float NOT NULL,
  `Conductimetro` decimal(11,4) NOT NULL,
  `Ubicacion` text NOT NULL,
  `Observaciones_Generales` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `muestra_agua`
--

INSERT INTO `muestra_agua` (`ID_Muestra`, `ID_Productor`, `Fecha_Ingreso`, `Fuente_Agua`, `Recibido_Por`, `Recolectada_Por`, `Cultivo_A_Regar`, `Problemas_De_Sales`, `Tratamiento_pH`, `Sistema_Riego`, `Cantidad_Usada`, `pH_Metro`, `Conductimetro`, `Ubicacion`, `Observaciones_Generales`) VALUES
(19, 12, '2023-10-18', 'Lago Toluka', 'James', 'Eddy', 'Amapolas', 'No', '7', 'Goteo', 222.0000, 7, 1.0000, 'Silent Hill', 'nada que comenta, agua mala'),
(20, 12, '2023-10-19', 'Nose', 'EL cono e la madre', 'awfwf', 'wfawfwfwf', 'Si', 'PPE', 'WFWAFWAF', 101.0000, 7, 1.0000, 'DAWDWDW', 'AWDFWDAWDW'),
(21, 12, '2023-10-19', 'PRUEBA 2', 'PRUEBA 2', 'PRUEBA 2', 'PRUEBA 2', 'Si', 'PRUEBA 2', 'PRUEBA 2', 122.0000, 7, 1.0000, 'PRUEBA 2', 'PRUEBA 2'),
(22, 12, '2023-10-20', 'Rio Orinoco', 'Papi Chavez', 'Luis Miguel', 'Regar?', 'No lo se', 'nada', 'no se', 1000.0000, 7, 1.0000, 'Pery', 'nada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentar');

-- --------------------------------------------------------

--
-- Table structure for table `muestra_a_procesar`
--

CREATE TABLE `muestra_a_procesar` (
  `IDMuestra_A_Procesar` int(11) NOT NULL,
  `Tipo` varchar(6) NOT NULL,
  `Identificador` varchar(25) NOT NULL,
  `Analisis_A_Realizar` varchar(30) NOT NULL,
  `Fecha_De_Toma` date NOT NULL,
  `Observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `muestra_a_procesar`
--

INSERT INTO `muestra_a_procesar` (`IDMuestra_A_Procesar`, `Tipo`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`) VALUES
(11, 'Suelo', 'SUELO1', 'pH', '2023-10-18', 'Aqui me intente quitar la vida'),
(12, 'Suelo', 'SUELO2', 'pH', '2023-10-18', 'Tambien aqui'),
(13, 'Agua', 'Agua sucia 1', 'ParticulasFlotantes', '2023-10-18', 'Agua rara, mmosca no te enfermas'),
(14, 'Agua', 'AAAA1', 'pH', '2023-10-19', 'DAWDAWDWD'),
(15, 'Agua', 'AAAAPRUEBA 2', 'ParticulasFlotantes', '2023-10-19', 'PRUEBA 2'),
(16, 'Agua', 'PRUEBA 2222', 'pH', '2023-10-19', 'PRUEBA 2'),
(17, 'Suelo', 'SUELO PRUEB 3 s1', 'CIC', '2023-10-19', 'SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3'),
(18, 'Suelo', 'SUELO PRUEB 3 s2', 'Todo', '2023-10-19', 'SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3SUELO PRUEB 3'),
(19, 'Agua', 'AWAINSTER', 'Conductividad', '2023-10-03', 'insertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsertinsert'),
(20, 'Agua', 'AWAPRUEBAFB1', 'Todo', '2023-10-20', 'nada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentarnada que comentar');

-- --------------------------------------------------------

--
-- Table structure for table `muestra_suelo`
--

CREATE TABLE `muestra_suelo` (
  `IDMuestraSuelo` int(11) NOT NULL,
  `IDProductor` int(11) NOT NULL,
  `Fecha_Recepcion` date NOT NULL,
  `Localidad` varchar(100) NOT NULL,
  `Municipio` varchar(55) NOT NULL,
  `Traido_Por` varchar(100) NOT NULL,
  `Profundidad` decimal(11,0) NOT NULL,
  `Uso_Anterior` varchar(100) NOT NULL,
  `Hectaria` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `muestra_suelo`
--

INSERT INTO `muestra_suelo` (`IDMuestraSuelo`, `IDProductor`, `Fecha_Recepcion`, `Localidad`, `Municipio`, `Traido_Por`, `Profundidad`, `Uso_Anterior`, `Hectaria`) VALUES
(22, 12, '2023-10-18', 'El sisal', 'Irribarren', 'Jose', 10, 'No habia', '8'),
(23, 12, '2023-10-19', 'SUELO PRUEB 3', 'SUELO PRUEB 3', 'SUELO PRUEB 3', 10, 'SUELO PRUEB 3', '12');

-- --------------------------------------------------------

--
-- Table structure for table `productor`
--

CREATE TABLE `productor` (
  `ID_Productor` int(11) NOT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Cedula_RIF` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Localidad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Municipio` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Contacto` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Traido_Por` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Correo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Asesor_Tecnico` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `productor`
--

INSERT INTO `productor` (`ID_Productor`, `Nombre`, `Cedula_RIF`, `Direccion`, `Localidad`, `Municipio`, `Contacto`, `Traido_Por`, `Correo`, `Asesor_Tecnico`) VALUES
(12, 'Joseph', '30161797', 'su casa', 'no se mierda', 'prueba', '12121', 'Silvia', 'jose@gmail.com', 'Kamila');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `idRol`) VALUES
(3, 'Jose Aguirre', 'jose@gmail.com', 'KavuDare', '85a1ff510148349760baee8e88b1f0c4', 1),
(4, 'pepe', 'pepe@gmail.com', 'pepe1', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(5, 'Yannelly', 'yan@gmail.com', 'yannita', '25f9e794323b453885f5181f1b624d0b', 0),
(7, 'Jhonny', 'jhonny@gmail.com', 'Jhonny', '81dc9bdb52d04dc20036dbd8313ed055', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userxprod`
--

CREATE TABLE `userxprod` (
  `idRegist` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `userxprod`
--

INSERT INTO `userxprod` (`idRegist`, `IdUser`, `IdProductor`) VALUES
(14, 3, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis`
--
ALTER TABLE `analisis`
  ADD PRIMARY KEY (`IDAnalisis`),
  ADD KEY `IDMAP` (`IDMAP`);

--
-- Indexes for table `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`ID_Facture`),
  ADD KEY `IDAnalisis` (`IDAnalisis`);

--
-- Indexes for table `maguaxmap`
--
ALTER TABLE `maguaxmap`
  ADD PRIMARY KEY (`IDRegistro`),
  ADD KEY `IDMuestraAgua` (`IDMuestraAgua`),
  ADD KEY `IDMuestraAProcesar` (`IDMuestraAProcesar`);

--
-- Indexes for table `msueloxmap`
--
ALTER TABLE `msueloxmap`
  ADD PRIMARY KEY (`IDRegistro`),
  ADD KEY `IDMuestraSuelo` (`IDMuestraSuelo`),
  ADD KEY `IDMuestraAProcesar` (`IDMuestraAProcesar`);

--
-- Indexes for table `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD PRIMARY KEY (`ID_Muestra`),
  ADD KEY `IDProductor` (`ID_Productor`);

--
-- Indexes for table `muestra_a_procesar`
--
ALTER TABLE `muestra_a_procesar`
  ADD PRIMARY KEY (`IDMuestra_A_Procesar`);

--
-- Indexes for table `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  ADD PRIMARY KEY (`IDMuestraSuelo`),
  ADD KEY `IDProductor` (`IDProductor`);

--
-- Indexes for table `productor`
--
ALTER TABLE `productor`
  ADD PRIMARY KEY (`ID_Productor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userxprod`
--
ALTER TABLE `userxprod`
  ADD PRIMARY KEY (`idRegist`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdProductor` (`IdProductor`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis`
--
ALTER TABLE `analisis`
  MODIFY `IDAnalisis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `ID_Facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `maguaxmap`
--
ALTER TABLE `maguaxmap`
  MODIFY `IDRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `msueloxmap`
--
ALTER TABLE `msueloxmap`
  MODIFY `IDRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `muestra_agua`
--
ALTER TABLE `muestra_agua`
  MODIFY `ID_Muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `muestra_a_procesar`
--
ALTER TABLE `muestra_a_procesar`
  MODIFY `IDMuestra_A_Procesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  MODIFY `IDMuestraSuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `productor`
--
ALTER TABLE `productor`
  MODIFY `ID_Productor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userxprod`
--
ALTER TABLE `userxprod`
  MODIFY `idRegist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analisis`
--
ALTER TABLE `analisis`
  ADD CONSTRAINT `analisis_ibfk_1` FOREIGN KEY (`IDMAP`) REFERENCES `muestra_a_procesar` (`IDMuestra_A_Procesar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`IDAnalisis`) REFERENCES `analisis` (`IDAnalisis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `maguaxmap`
--
ALTER TABLE `maguaxmap`
  ADD CONSTRAINT `maguaxmap_ibfk_1` FOREIGN KEY (`IDMuestraAgua`) REFERENCES `muestra_agua` (`ID_Muestra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maguaxmap_ibfk_2` FOREIGN KEY (`IDMuestraAProcesar`) REFERENCES `muestra_a_procesar` (`IDMuestra_A_Procesar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `msueloxmap`
--
ALTER TABLE `msueloxmap`
  ADD CONSTRAINT `msueloxmap_ibfk_1` FOREIGN KEY (`IDMuestraSuelo`) REFERENCES `muestra_suelo` (`IDMuestraSuelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msueloxmap_ibfk_2` FOREIGN KEY (`IDMuestraAProcesar`) REFERENCES `muestra_a_procesar` (`IDMuestra_A_Procesar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD CONSTRAINT `muestra_agua_ibfk_1` FOREIGN KEY (`ID_Productor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  ADD CONSTRAINT `muestra_suelo_ibfk_1` FOREIGN KEY (`IDProductor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userxprod`
--
ALTER TABLE `userxprod`
  ADD CONSTRAINT `userxprod_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userxprod_ibfk_2` FOREIGN KEY (`IdProductor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
