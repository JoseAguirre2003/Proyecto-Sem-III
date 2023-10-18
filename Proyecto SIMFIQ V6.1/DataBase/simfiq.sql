-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 04:48:20
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
-- Estructura de tabla para la tabla `analisis`
--

CREATE TABLE `analisis` (
  `ID_Resultados` int(11) NOT NULL,
  `ID_Precios` int(11) NOT NULL,
  `Suelo_PH` decimal(11,0) NOT NULL,
  `Suelo_Ce` decimal(11,0) NOT NULL,
  `Suelo_CIC` decimal(11,0) NOT NULL,
  `Suelo_Textura` varchar(25) NOT NULL,
  `Agua_pH` decimal(11,0) NOT NULL,
  `Agua_Ce` decimal(11,0) NOT NULL,
  `Agua_ParticulasSuspension` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `ID_Precios` int(11) NOT NULL,
  `Precio_Suelo` int(11) NOT NULL,
  `Precio_Agua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maguaxmap`
--

CREATE TABLE `maguaxmap` (
  `IDRegistro` int(11) NOT NULL,
  `IDMuestraAgua` int(11) NOT NULL,
  `IDMuestraAProcesar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `maguaxmap`
--

INSERT INTO `maguaxmap` (`IDRegistro`, `IDMuestraAgua`, `IDMuestraAProcesar`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msueloxmap`
--

CREATE TABLE `msueloxmap` (
  `IDRegistro` int(11) NOT NULL,
  `IDMuestraSuelo` int(11) NOT NULL,
  `IDMuestraAProcesar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `msueloxmap`
--

INSERT INTO `msueloxmap` (`IDRegistro`, `IDMuestraSuelo`, `IDMuestraAProcesar`) VALUES
(1, 1, 4);

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
(1, 3, '2023-10-15', 'Un pozo', 'Silvia', 'Mannolo', 'Marijuana', 'Si', 'algo hlcl', 'goteo', 1000.0000, 7, 0.0108, 'mi casa', 'Nada que decir, yo no se');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra_a_procesar`
--

CREATE TABLE `muestra_a_procesar` (
  `IDMuestra_A_Procesar` int(11) NOT NULL,
  `Identificador` varchar(25) NOT NULL,
  `Analisis_A_Realizar` varchar(30) NOT NULL,
  `Fecha_De_Toma` date NOT NULL,
  `Observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `muestra_a_procesar`
--

INSERT INTO `muestra_a_procesar` (`IDMuestra_A_Procesar`, `Identificador`, `Analisis_A_Realizar`, `Fecha_De_Toma`, `Observaciones`) VALUES
(1, 'AA1', 'Conductividad', '2023-10-15', 'Nada que decir'),
(2, 'AA2', 'Conductividad', '2023-10-15', 'ndax2'),
(3, 'carlito manguito', 'particulasFlotantes', '2023-09-14', 'ERA VERDE'),
(4, 'chancho', 'pH', '2023-10-29', 'era el diablo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra_suelo`
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
-- Volcado de datos para la tabla `muestra_suelo`
--

INSERT INTO `muestra_suelo` (`IDMuestraSuelo`, `IDProductor`, `Fecha_Recepcion`, `Localidad`, `Municipio`, `Traido_Por`, `Profundidad`, `Uso_Anterior`, `Hectaria`) VALUES
(1, 9, '2023-10-20', 'Centro', 'irribare', 'carlitos', 6, 'pieles', '20');

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
(1, 'Cafe Amanecer', '123456789', 'Calle 1 Vereda 6', 'Portuguesa', 'nocelosmunicioios', '0251123456', 'Pablo Perez Bolanez', 'cafeamacener@gmail.com', 'Ing Jose Jose'),
(2, 'unosNarcosAhi', '12345678', 'su platacion', 'Apure', 'Algo en apure', '04121234567', 'Miguel', 'mugue@gmail.com', 'Miguel tambien'),
(3, 'El Rancho de Juan Carlos', '123456789', 'por ahi', 'por ahi dije', 'noC', '04121234567', 'Juan', 'juan@gmail.com', 'Ramses'),
(8, 'Jhonny', '30161797', 'mah', 'meh', 'mih', '04125433322', 'Kyle', 'jhnny@gmail.com', 'Sutano'),
(9, 'Eurick', '12345', 'leon', 'Centro', 'irribare', '04264557584', 'carlitos', 'pedritosola@gmail.com', 'jaun perez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `idRol`) VALUES
(3, 'Jose Aguirre', 'jose@gmail.com', 'KavuDare', '85a1ff510148349760baee8e88b1f0c4', 1),
(4, 'pepe', 'pepe@gmail.com', 'pepe1', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(5, 'Yannelly', 'yan@gmail.com', 'yannita', '25f9e794323b453885f5181f1b624d0b', 0),
(6, 'eurick', 'eurickramiro.ospinovelasquez@gmail.com', 'Eurick', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userxprod`
--

CREATE TABLE `userxprod` (
  `idRegist` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdProductor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `userxprod`
--

INSERT INTO `userxprod` (`idRegist`, `IdUser`, `IdProductor`) VALUES
(4, 4, 1),
(5, 4, 2),
(10, 3, 8),
(11, 6, 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `maguaxmap`
--
ALTER TABLE `maguaxmap`
  ADD PRIMARY KEY (`IDRegistro`),
  ADD KEY `IDMuestraAgua` (`IDMuestraAgua`),
  ADD KEY `IDMuestraAProcesar` (`IDMuestraAProcesar`);

--
-- Indices de la tabla `msueloxmap`
--
ALTER TABLE `msueloxmap`
  ADD PRIMARY KEY (`IDRegistro`),
  ADD KEY `IDMuestraSuelo` (`IDMuestraSuelo`),
  ADD KEY `IDMuestraAProcesar` (`IDMuestraAProcesar`);

--
-- Indices de la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD PRIMARY KEY (`ID_Muestra`),
  ADD KEY `IDProductor` (`ID_Productor`);

--
-- Indices de la tabla `muestra_a_procesar`
--
ALTER TABLE `muestra_a_procesar`
  ADD PRIMARY KEY (`IDMuestra_A_Procesar`);

--
-- Indices de la tabla `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  ADD PRIMARY KEY (`IDMuestraSuelo`),
  ADD KEY `IDProductor` (`IDProductor`);

--
-- Indices de la tabla `productor`
--
ALTER TABLE `productor`
  ADD PRIMARY KEY (`ID_Productor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userxprod`
--
ALTER TABLE `userxprod`
  ADD PRIMARY KEY (`idRegist`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdProductor` (`IdProductor`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `maguaxmap`
--
ALTER TABLE `maguaxmap`
  MODIFY `IDRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `msueloxmap`
--
ALTER TABLE `msueloxmap`
  MODIFY `IDRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  MODIFY `ID_Muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `muestra_a_procesar`
--
ALTER TABLE `muestra_a_procesar`
  MODIFY `IDMuestra_A_Procesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  MODIFY `IDMuestraSuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productor`
--
ALTER TABLE `productor`
  MODIFY `ID_Productor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `userxprod`
--
ALTER TABLE `userxprod`
  MODIFY `idRegist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `maguaxmap`
--
ALTER TABLE `maguaxmap`
  ADD CONSTRAINT `maguaxmap_ibfk_1` FOREIGN KEY (`IDMuestraAgua`) REFERENCES `muestra_agua` (`ID_Muestra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maguaxmap_ibfk_2` FOREIGN KEY (`IDMuestraAProcesar`) REFERENCES `muestra_a_procesar` (`IDMuestra_A_Procesar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `msueloxmap`
--
ALTER TABLE `msueloxmap`
  ADD CONSTRAINT `msueloxmap_ibfk_1` FOREIGN KEY (`IDMuestraSuelo`) REFERENCES `muestra_suelo` (`IDMuestraSuelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msueloxmap_ibfk_2` FOREIGN KEY (`IDMuestraAProcesar`) REFERENCES `muestra_a_procesar` (`IDMuestra_A_Procesar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestra_agua`
--
ALTER TABLE `muestra_agua`
  ADD CONSTRAINT `muestra_agua_ibfk_1` FOREIGN KEY (`ID_Productor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestra_suelo`
--
ALTER TABLE `muestra_suelo`
  ADD CONSTRAINT `muestra_suelo_ibfk_1` FOREIGN KEY (`IDProductor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `userxprod`
--
ALTER TABLE `userxprod`
  ADD CONSTRAINT `userxprod_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userxprod_ibfk_2` FOREIGN KEY (`IdProductor`) REFERENCES `productor` (`ID_Productor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
