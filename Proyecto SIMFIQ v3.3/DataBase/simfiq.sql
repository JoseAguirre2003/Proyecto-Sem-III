-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2023 a las 04:57:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simfiq`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestrasuelo`
--

CREATE TABLE `muestrasuelo` (
  `ID_Muestra` int(11) NOT NULL,
  `ID_Productor` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Cultivo_A_Sembrar` varchar(50) NOT NULL,
  `Ha_Total` varchar(11) NOT NULL,
  `Numero_Plantilla` int(11) NOT NULL,
  `Cultivo_Anterior` varchar(50) NOT NULL,
  `Variedad_Hibrido_Cultivos_Anterior` varchar(30) NOT NULL,
  `Densidad_Siembra_Cultivos_Anterior` varchar(30) NOT NULL,
  `Rendimiento` decimal(10,2) NOT NULL,
  `Rotacion_Cultivos` varchar(8) NOT NULL,
  `Cuales` text NOT NULL,
  `Edad_Cultivo` int(11) NOT NULL,
  `Variedad_Hibrido_Perennes` varchar(30) NOT NULL,
  `Densidad_Siembra_Perennes` varchar(30) NOT NULL,
  `Rendimiento_Perennes` varchar(30) NOT NULL,
  `Estado_Cultivo` varchar(45) NOT NULL,
  `Formulas_Completas_Cantidad_Aplicadas` decimal(10,2) NOT NULL,
  `Fertilizante_Simple_Nutriente` decimal(10,2) NOT NULL,
  `Formulas_Hidrosolubles` decimal(10,2) NOT NULL,
  `FertilizanteMicronutrientes` varchar(30) NOT NULL,
  `Momento_De_Aplicaciones` varchar(30) NOT NULL,
  `Forma_De_Aplicacion_P` varchar(30) NOT NULL,
  `Fecha_Ultima_Aplicacion` date NOT NULL,
  `Forma_De_Aplicacion` varchar(10) NOT NULL,
  `Observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra_agua`
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
-- Volcado de datos para la tabla `muestra_agua`
--

INSERT INTO `muestra_agua` (`ID_Muestra`, `ID_Productor`, `Fecha_Ingreso`, `Fuente_Agua`, `Recibido_Por`, `Recolectada_Por`, `Cultivo_A_Regar`, `Problemas_De_Sales`, `Tratamiento_pH`, `Sistema_Riego`, `Cantidad_Usada`, `pH_Metro`, `Conductimetro`, `Ubicacion`, `Observaciones_Generales`) VALUES
(1, 1, '2023-09-09', 'Rio Turbio', 'Jesus Jose Julian', 'Panchito', 'Cafe', 'Nose', 'si, HLC 10% 1lt', 'goteo', 1000.0000, 4.5, 3.2000, 'guanajuato', 'Agua sacada y almacenada en tanques australianos'),
(2, 1, '2023-09-09', 'un rio ahi', 'juanito', 'juanito', 'marihuana', 'si', 'algo ahi con hc', 'goteo', 1000.0000, 3.4, 3.2000, 'no se', 'tampoco se'),
(3, 3, '2023-09-10', 'Un rio por ahi', 'Juanpi', 'Juanpi', 'Marihuana', 'No', 'no lo se jajaj algo con hcl', 'goteo', 1000.0000, 7.1, 20.0009, 'Por ahi', 'no se que mas decir'),
(5, 4, '2023-09-11', 'Un pozo', 'Markus', 'Kyle', 'Amapolas', 'Si', 'no se', 'Goteo', 700.0000, 7, 0.0185, 'Por ahi en el monte', 'Nada que decir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra_agua_a_procesar`
--

CREATE TABLE `muestra_agua_a_procesar` (
  `IDMuestra_A_Procesar` int(11) NOT NULL,
  `IDMuestra` int(11) NOT NULL,
  `Identificador` varchar(25) NOT NULL,
  `Analisis_A_Realizar` varchar(30) NOT NULL,
  `Fecha_De_Toma` date NOT NULL,
  `Observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `muestra_agua_a_procesar`
--

INSERT INTO `muestra_agua_a_procesar` (`IDMuestra_A_Procesar`, `IDMuestra`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`) VALUES
(1, 1, 'A-0012', 'Rutina Competa', '2023-07-05', 'Agregar Cafe Amanecer q usuarios premium'),
(2, 3, 'A12-FGLS', 'Rutina completa', '2023-09-10', 'No se, cosas raras se hacen ahi'),
(3, 2, 'absdfghijklm', 'Rutina completa', '2023-09-10', 'Meado'),
(4, 2, 'Memento', 'lo que quiera', '2023-08-28', 'awa'),
(5, 5, 'KBB34L', 'Rutina completa', '2023-09-08', 'Nada que decir jajaj tengo mucha hambre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra_suelo_a_procesar`
--

CREATE TABLE `muestra_suelo_a_procesar` (
  `IDMuestra_S_Procesar` int(11) NOT NULL,
  `IDMuestra` int(11) NOT NULL,
  `Identificador` varchar(45) NOT NULL,
  `Ha_muestreo` varchar(30) NOT NULL,
  `Analisis_A_Realizar` varchar(50) NOT NULL,
  `Recomendaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productor`
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
-- Volcado de datos para la tabla `productor`
--

INSERT INTO `productor` (`ID_Productor`, `Nombre`, `Cedula_RIF`, `Direccion`, `Localidad`, `Municipio`, `Contacto`, `Traido_Por`, `Correo`, `Asesor_Tecnico`) VALUES
(1, 'Cafe Amanecer', '123456789', 'Calle 1 Vereda 6', 'Portuguesa', 'nocelosmunicioios', '0251123456', 'Pablo Perez', 'cafeamacener@gmail.com', 'Ing Jose Jose'),
(2, 'unosNarcosAhi', '12345678', 'su platacion', 'Apure', 'Algo en apure', '04121234567', 'Miguel', 'mugue@gmail.com', 'Miguel tambien'),
(3, 'El Rancho de Juan', '123456789', 'por ahi', 'por ahi dije', 'noC', '04121234567', 'Juan', 'juan@gmail.com', 'Ramses'),
(4, 'Cafe la Pastora', '987654321', 'Calle 17 Carrera 20', 'Kamanawakista', 'Nose', '04128952280', 'Miguel', 'cafePastora@gmail.com', 'Veronica Ross');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `muestrasuelo`
--
ALTER TABLE `muestrasuelo`
  ADD PRIMARY KEY (`ID_Muestra`),
  ADD KEY `ID_Productor` (`ID_Productor`);

--
-- Indices de la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD PRIMARY KEY (`ID_Muestra`),
  ADD KEY `IDProductor` (`ID_Productor`);

--
-- Indices de la tabla `muestra_agua_a_procesar`
--
ALTER TABLE `muestra_agua_a_procesar`
  ADD PRIMARY KEY (`IDMuestra_A_Procesar`),
  ADD KEY `IDMuestra` (`IDMuestra`);

--
-- Indices de la tabla `muestra_suelo_a_procesar`
--
ALTER TABLE `muestra_suelo_a_procesar`
  ADD PRIMARY KEY (`IDMuestra_S_Procesar`),
  ADD KEY `IDMuestra` (`IDMuestra`);

--
-- Indices de la tabla `productor`
--
ALTER TABLE `productor`
  ADD PRIMARY KEY (`ID_Productor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `muestrasuelo`
--
ALTER TABLE `muestrasuelo`
  MODIFY `ID_Muestra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  MODIFY `ID_Muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `muestra_agua_a_procesar`
--
ALTER TABLE `muestra_agua_a_procesar`
  MODIFY `IDMuestra_A_Procesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `muestra_suelo_a_procesar`
--
ALTER TABLE `muestra_suelo_a_procesar`
  MODIFY `IDMuestra_S_Procesar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productor`
--
ALTER TABLE `productor`
  MODIFY `ID_Productor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `muestrasuelo`
--
ALTER TABLE `muestrasuelo`
  ADD CONSTRAINT `muestrasuelo_ibfk_1` FOREIGN KEY (`ID_Productor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD CONSTRAINT `muestra_agua_ibfk_1` FOREIGN KEY (`ID_Productor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestra_agua_a_procesar`
--
ALTER TABLE `muestra_agua_a_procesar`
  ADD CONSTRAINT `muestra_agua_a_procesar_ibfk_1` FOREIGN KEY (`IDMuestra`) REFERENCES `muestra_agua` (`ID_Muestra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestra_suelo_a_procesar`
--
ALTER TABLE `muestra_suelo_a_procesar`
  ADD CONSTRAINT `muestra_suelo_a_procesar_ibfk_1` FOREIGN KEY (`IDMuestra`) REFERENCES `muestrasuelo` (`ID_Muestra`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
