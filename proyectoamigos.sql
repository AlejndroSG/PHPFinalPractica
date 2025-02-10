-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2025 a las 13:10:33
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
-- Base de datos: `proyectoamigos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id_Usuario` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `fNac` date NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id_Usuario`, `nombre`, `apellidos`, `fNac`, `id`) VALUES
(12, 'María Pedra', 'Luisa', '2025-01-28', 1),
(1, 'Luis Pérez', 'Martínez', '2028-10-26', 2),
(1, 'Carmen Sánchez', 'Rodríguez', '2024-12-31', 3),
(1, 'Diego Torres', 'López', '1991-07-12', 4),
(5, 'Paula Vega', 'Morales', '1993-02-25', 5),
(6, 'Javier Castillo', 'Pérez', '1989-04-16', 6),
(7, 'Natalia Romero', 'Fernández', '1994-06-30', 7),
(8, 'Andrés Muñoz', 'Ruiz', '1990-09-28', 8),
(9, 'Silvia Martín', 'Ortiz', '1995-12-30', 9),
(10, 'Francisco Navarro', 'Cruz', '1987-03-22', 10),
(1, 'Juan Carlos', 'Martin', '2025-01-08', 42),
(1, 'Juan Carlos', 'Martin', '2025-01-08', 43),
(1, 'Juan', 'Perez', '2025-01-01', 44),
(6, 'Angie', 'Maritoni', '2024-09-09', 68),
(9, 'Angie', 'Perez', '2024-09-09', 69),
(9, 'Angie', 'Gonzalez', '2024-09-09', 70),
(12, 'Angie', 'Manuel', '2025-01-17', 71);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(500) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `plataforma` varchar(100) NOT NULL,
  `lanzamiento` int(4) NOT NULL,
  `id_Usu` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `url`, `titulo`, `plataforma`, `lanzamiento`, `id_Usu`) VALUES
(11, '../img/Juan/cervezas_alhambra-logo_brandlogos.net_7pdmi.png', 'Fortnite', 'PS4', 2018, 1),
(12, '../img/Juan/826040fc-ef8d-42b4-8f30-0ddb4bca4332_source-aspect-ratio_default_0.jpg', 'Montoyita', 'illo', 2018, 1),
(13, '../img/Juan/826040fc-ef8d-42b4-8f30-0ddb4bca4332_source-aspect-ratio_default_0.jpg', 'Montoya Desatao', 'Villa Polla', 2018, 1),
(14, '../img/Juan/Anotación 2025-01-28 121146.png', 'Fortnite', 'PS4', 2018, 1),
(15, '../img/Juan/Anotación 2025-01-28 121146.png', 'Fortnite', 'PS4', 2018, 1),
(16, '../img/Juan/Anotación 2025-01-28 121146.png', 'Fortnite', 'PS4', 2018, 1),
(17, '../img/Sofia/Escudo_Granada_club_de_fútbol.png', 'La guarrasofia', 'Disney', 2000, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_Usu` bigint(11) UNSIGNED NOT NULL,
  `id_Amigo` bigint(11) UNSIGNED NOT NULL,
  `id_Juego` bigint(11) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `devuelto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `id_Usu`, `id_Amigo`, `id_Juego`, `fecha_inicio`, `devuelto`) VALUES
(11, 1, 1, 11, '2025-01-14', 1),
(12, 1, 1, 11, '2025-01-14', 1),
(15, 1, 4, 13, '2025-01-10', 1),
(16, 1, 1, 13, '0000-00-00', 1),
(17, 6, 6, 17, '2025-02-01', 1),
(18, 6, 6, 17, '2025-02-01', 1),
(19, 6, 6, 17, '2025-02-01', 1),
(20, 6, 6, 17, '2026-01-01', 0),
(21, 6, 6, 17, '2026-01-01', 0),
(22, 6, 6, 17, '2026-01-01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `pswd` varchar(200) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `pswd`, `tipo`) VALUES
(1, 'Juan', '1234', 1),
(2, 'Ana', 'abcd', 1),
(3, 'Carlos', 'pass123', 1),
(4, 'Laura', 'lm2025', 1),
(5, 'Pedro', 'pedro2025', 1),
(6, 'Sofía', 'sofia123', 1),
(7, 'Jorge', 'jorgepass', 1),
(8, 'Marta', 'marta2025', 1),
(9, 'Luis', 'luisgomez', 1),
(10, 'Elena', 'elena2025', 1),
(11, 'admin', 'admin', 0),
(12, 'Angie', 'angie', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_us_am` (`id_Usuario`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_us_ju` (`id_Usu`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_us_pr` (`id_Usu`),
  ADD KEY `fk_am_pr` (`id_Amigo`),
  ADD KEY `fk_ju_pr` (`id_Juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `fk_us_am` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_us_ju` FOREIGN KEY (`id_Usu`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_am_pr` FOREIGN KEY (`id_Amigo`) REFERENCES `amigos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ju_pr` FOREIGN KEY (`id_Juego`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_us_pr` FOREIGN KEY (`id_Usu`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
