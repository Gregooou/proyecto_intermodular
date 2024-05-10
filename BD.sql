-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2024 a las 19:09:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intermodular definitivo2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturastabla`
--

CREATE TABLE `asignaturastabla` (
  `asignaturaID` int(11) NOT NULL,
  `programaID` int(11) NOT NULL,
  `nombreAs` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `documentoID` int(11) NOT NULL,
  `usuarioID` int(11) NOT NULL,
  `rutaArchivo` varchar(40) NOT NULL,
  `NombreProg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`documentoID`, `usuarioID`, `rutaArchivo`, `NombreProg`) VALUES
(1, 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `programaID` int(11) NOT NULL,
  `nombreProg` varchar(100) NOT NULL,
  `tipoEstudioID` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`programaID`, `nombreProg`, `tipoEstudioID`) VALUES
(1, 'Técnico superior de Desarrollo de Aplicaciones Multiplataforma', '1'),
(2, 'Técnico Superior Online en Animaciones 3D, Juegos y entornos interactivos', '1'),
(3, 'Técnico Superior Online en Administración y Finanzas', '1'),
(4, 'Técnico Superior Online en Educación Infantil', '1'),
(5, 'Técnico Superior Online en Automatización y Robótica Industrial', '1'),
(6, 'Técnico Superior Online en Administración de Sistemas Informáticos en Red', '1'),
(7, 'Técnico Superior Online en Administración de Sistemas Informáticos en Red', '1'),
(8, 'Técnico Superior Online en Animaciones 3D, Juegos y entornos interactivos', '1'),
(9, 'Técnico Superior en Administración de Sistemas Informáticos en Red', '1'),
(10, 'Técnico Superior en Acondicionamiento Físico', '1'),
(11, 'Técnico Superior Online en Desarrollo de Aplicaciones Web', '1'),
(12, 'Técnico Superior Online en Marketing y Publicidad', '1'),
(13, 'Técnico Superior Online en Imagen para el Diagnóstico y Medicina Nuclear', '1'),
(14, 'Técnico Superior Online en Audiología Protésica', '1'),
(15, 'Técnico Superior en Administración y Finanzas', '1'),
(16, 'Técnico Superior en Acondicionamiento Físico y Certificado de Entrenador', '1'),
(17, 'Técnico Superior en Marketing y Publicidad', '1'),
(18, 'Técnico Superior Online en Higiene Bucodental', '1'),
(19, 'Técnico Superior Online en Documentación y Administración Sanitarias', '1'),
(20, 'Técnico Superior Online en Laboratorio de Análisis y Control de Calidad', '1'),
(21, 'Técnico Superior Online en Dirección de Cocina', '1'),
(22, 'Técnico Superior Online en Transporte y Logística', '1'),
(23, 'Grado en Enfermería+Diploma de Experto en Urgencias, Emergencias y Cuidados Críticos', '2'),
(24, 'Grado en Ingeniería de Sistemas Industriales', '2'),
(25, 'Grado en Farmacia+Certificado en Dirección Estratégica y Gerencia de Oficina de Farmacia:Farmacia Di', '2'),
(26, 'Grado en Biotecnología', '2'),
(27, 'Grado en Ciencias de la Actividad Física y del Deporte(CAFYD)+Grado en Nutrición Humana y Dietética', '2'),
(28, 'Grado en Ciencias de la Actividad Física y del Deporte (CAFYD)+Grado en Fisioterapia', '2'),
(29, 'Grado en Marketing', '2'),
(30, 'Grado en Ciencias de la Actividad Física y del Deporte(CAFYD)', '2'),
(31, 'Grado en Ingeniería Informática', '2'),
(32, 'Grado en Administracíon y Dirección de Empresas', '2'),
(33, 'Grado en Odontología', '2'),
(34, 'Grado en Medicina', '2'),
(35, 'Grado en Veterinaria', '2'),
(36, 'Grado de Biomedicina', '2'),
(37, 'Grado en Nutrición Humana y Dietética', '2'),
(38, 'Grado en Fisioterapia', '2'),
(39, 'Grado en Ingeniería Civil en Construcciones Civiles', '2'),
(40, 'Grados en Business Analytics', '2'),
(41, 'Grado en Inteligencia Artificial y Computación', '2'),
(42, 'Grado en Ingeniería Informática+Administración y Dirección de Empresas', '2'),
(43, 'Grado en Marketing Online', '2'),
(44, 'Grado en Ingeniería Matemática', '2'),
(45, 'Grado en Física', '2'),
(46, 'Grado en Psicología', '2'),
(47, 'Doble Grado en Business Analytics+Grado en Administración y Dirección de Empresas', '2'),
(48, 'Grado en Administración y Dirección de Empresas+Marketing', '2'),
(49, 'Doble Grado en Ingeniería Informatica', '2'),
(50, 'Grado en Derecho+Relaciones Internacionasles', '2'),
(51, 'Doble grado en ADE+Derecho', '2'),
(52, 'Grado en Derecho', '2'),
(53, 'Grado en Relaciones Internacionales', '2'),
(54, 'Grado en Administración y Dirección de empresas+Grado en Relaciones Internacionales', '2'),
(55, 'Grado en Ingeniería Biomédica', '2'),
(56, 'Grado en Farmacia+Grado en Nutrición Humana y Dietética', '2'),
(57, 'Grado online en Psicología', '2'),
(58, 'Grado Online en Inteligencia Artificial y Computación', '2'),
(59, 'Grado Semipresencial en Nutrición Humana y Dietética', '2'),
(60, 'Grado en Ingeniería en Diseño Industrial y Desarrollo de Producto', '2'),
(61, 'Grado en Interpretación Musical', '2'),
(62, 'Grado en Interpretación de Musica Moderna', '2'),
(63, 'Grado en Ingeniería Aeroespacial', '2'),
(64, 'Grado en Ingeniería Mecánica', '2'),
(65, 'Grado Online en Maestro de Educación Primaria', '2'),
(66, 'Grado en Ingeniería en Diseño Industrial y Desarrollo de Producto+Ingeniería Mecánica', '2'),
(67, 'Grado en Ingeniería Electronica Industrial y Automática', '2'),
(68, 'Grado Semipresencial en Farmacia', '2'),
(69, 'Grado Online en Administración y Dirección de Empresas', '2'),
(70, 'Grado Online en Musicología', '2'),
(71, 'Grado Online en Educación Infantil', '2'),
(72, 'Grado Online en Derecho', '2'),
(73, 'Grado Online en Ingeniería Informática+Bootcamp Ironhack', '2'),
(74, 'Grado en Arquitectura', '2'),
(75, 'Menciones del Grado Online en Maestros de Educación Primaria', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estudio`
--

CREATE TABLE `tipo_estudio` (
  `tipoestudio` varchar(30) NOT NULL,
  `tipoestudioID` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_estudio`
--

INSERT INTO `tipo_estudio` (`tipoestudio`, `tipoestudioID`) VALUES
('Grado Superior', '1'),
('Carrera', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombreUsu` varchar(30) NOT NULL,
  `usuarioID` int(11) NOT NULL,
  `apellidoUsu` varchar(30) NOT NULL,
  `correoUsu` varchar(30) NOT NULL,
  `contraseña_cifrada` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombreUsu`, `usuarioID`, `apellidoUsu`, `correoUsu`, `contraseña_cifrada`) VALUES
('pablo', 1, '', 'pablo@myuax.com', 'pablo'),
('pepita5', 2, '', 'pepita@myuax.com', '123pepita4'),
('toti', 3, '', 'micasa22@myuax.com', 'micasa22'),
('grecanon', 4, '', 'grecanon@myuax.com', 'grecanon'),
('pa', 5, '', 'pa@myuax.com', 'pa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturastabla`
--
ALTER TABLE `asignaturastabla`
  ADD PRIMARY KEY (`asignaturaID`),
  ADD UNIQUE KEY `nombreAs_unique` (`nombreAs`),
  ADD KEY `programaID` (`programaID`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`documentoID`),
  ADD KEY `usuarioID` (`usuarioID`),
  ADD KEY `NombreProg` (`NombreProg`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`programaID`),
  ADD KEY `tipoEstudioID` (`tipoEstudioID`),
  ADD KEY `nombreProg` (`nombreProg`);

--
-- Indices de la tabla `tipo_estudio`
--
ALTER TABLE `tipo_estudio`
  ADD PRIMARY KEY (`tipoestudioID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioID`),
  ADD UNIQUE KEY `nombre_usuario_unico` (`nombreUsu`),
  ADD UNIQUE KEY `correo_unico` (`correoUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturastabla`
--
ALTER TABLE `asignaturastabla`
  MODIFY `asignaturaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `documentoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `programaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturastabla`
--
ALTER TABLE `asignaturastabla`
  ADD CONSTRAINT `asignaturastabla_ibfk_1` FOREIGN KEY (`programaID`) REFERENCES `programas` (`programaID`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuarioID`) REFERENCES `usuario` (`usuarioID`);

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_ibfk_1` FOREIGN KEY (`tipoEstudioID`) REFERENCES `tipo_estudio` (`tipoestudioID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
