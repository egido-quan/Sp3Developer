-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-10-2024 a las 14:03:07
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
-- Base de datos: `To_do_list`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tareas`
--

CREATE TABLE `Tareas` (
  `id` int(11) UNSIGNED NOT NULL,
  `tarea` varchar(50) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `estado` enum('en ejecucion','pendiente','finalizado','') NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tareas`
--

INSERT INTO `Tareas` (`id`, `tarea`, `responsable`, `estado`, `inicio`, `fin`) VALUES
(1, 'Hacer la compra', 'Javier', 'en ejecucion', '2024-10-17 22:59:00', '2024-10-18 22:59:00'),
(2, 'Invitar a la suegra a casa unos días', 'Javier', 'pendiente', '2099-10-17 22:59:00', '2099-10-18 22:59:00'),
(3, 'Organizar las vacaciones', 'Mónica', 'finalizado', '2024-10-17 22:59:00', '2024-10-18 22:59:00'),
(4, 'Buscar colegios para los niños', 'Javier', 'en ejecucion', '2025-10-17 21:59:00', '2025-10-18 22:59:00'),
(5, 'Pintar el dormitorio', 'Gerònim', 'en ejecucion', '2024-10-17 22:00:00', '2024-11-18 22:00:00'),
(6, 'Vender el reloj del abuelo', 'Mónica', 'finalizado', '2024-10-17 22:59:00', '2024-10-18 22:59:00'),
(7, 'Atracar el banco de la esquina', 'Mónica', 'pendiente', '2024-10-17 22:59:00', '2024-10-18 22:59:00'),
(8, 'Visitar Lourdes', 'Mónica', 'pendiente', '2025-10-18 22:59:00', '2025-10-18 22:59:00'),
(9, 'Arreglar la cocina', 'Pedro', 'pendiente', '2024-09-17 22:59:00', '2024-10-18 22:59:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Tareas`
--
ALTER TABLE `Tareas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
