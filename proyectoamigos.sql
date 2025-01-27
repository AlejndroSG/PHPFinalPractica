-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2025 a las 13:03:44
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
(1, 'María Pedra', 'Gómez', '0000-00-00', 1),
(1, 'Luis Pérez', 'Martínez', '0000-00-00', 2),
(1, 'Carmen Sánchez', 'Rodríguez', '1992-03-08', 3),
(1, 'Diego Torres', 'López', '1991-07-12', 4),
(5, 'Paula Vega', 'Morales', '1993-02-25', 5),
(6, 'Javier Castillo', 'Pérez', '1989-04-16', 6),
(7, 'Natalia Romero', 'Fernández', '1994-06-30', 7),
(8, 'Andrés Muñoz', 'Ruiz', '1990-09-15', 8),
(9, 'Silvia Martín', 'Ortiz', '1995-12-10', 9),
(10, 'Francisco Navarro', 'Cruz', '1987-03-22', 10),
(1, 'Alejandro', 'Sanchez', '0000-00-00', 12),
(1, 'Alejandro', 'Luis', '0000-00-00', 13),
(1, 'Juan Carlos', 'Carlos Juan', '2000-10-10', 14),
(1, '12', '12', '0000-00-00', 15),
(1, 'Pedro', 'Martin', '0000-00-00', 16);

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
(1, 'http://juego1.com', 'Aventura Épica', 'PC', 2021, 1),
(2, 'http://juego2.com', 'Carreras Extremas', 'Xbox', 2020, 2),
(3, 'http://juego3.com', 'Mundo Fantástico', 'PlayStation', 2022, 3),
(4, 'http://juego4.com', 'Estrategia Total', 'PC', 2019, 4),
(5, 'http://juego5.com', 'Héroes de la Galaxia', 'Switch', 2023, 5),
(6, 'http://juego6.com', 'Deportes Pro', 'Xbox', 2021, 6),
(7, 'http://juego7.com', 'La Gran Aventura', 'PlayStation', 2020, 7),
(8, 'http://juego8.com', 'Exploradores', 'PC', 2022, 8),
(9, 'http://juego9.com', 'Velocidad Máxima', 'Xbox', 2018, 9),
(10, 'http://juego10.com', 'Batalla Épica', 'Switch', 2021, 10);

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
(1, 1, 2, 1, '2025-01-01', 0),
(2, 2, 3, 2, '2025-01-05', 1),
(3, 3, 1, 3, '2025-01-10', 0),
(4, 4, 5, 4, '2025-01-15', 1),
(5, 5, 6, 5, '2025-01-20', 0),
(6, 6, 7, 6, '2025-01-25', 1),
(7, 7, 8, 7, '2025-01-30', 0),
(8, 8, 9, 8, '2025-02-05', 1),
(9, 9, 10, 9, '2025-02-10', 0),
(10, 10, 4, 10, '2025-02-15', 1);

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
(1, 'Juan', '1234', 0),
(2, 'Ana', 'abcd', 1),
(3, 'Carlos', 'pass123', 0),
(4, 'Laura', 'lm2025', 0),
(5, 'Pedro', 'pedro2025', 1),
(6, 'Sofía', 'sofia123', 0),
(7, 'Jorge', 'jorgepass', 1),
(8, 'Marta', 'marta2025', 0),
(9, 'Luis', 'luisgomez', 0),
(10, 'Elena', 'elena2025', 1);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
