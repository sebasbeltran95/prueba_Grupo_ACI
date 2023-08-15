-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla proyecto-laravel.produccion
CREATE TABLE IF NOT EXISTS `produccion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) DEFAULT NULL,
  `operario` varchar(255) DEFAULT NULL,
  `piezas_buenas` int DEFAULT NULL,
  `piezas_malas` int DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `gastos_adicionales` int DEFAULT NULL,
  `observaciones` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla proyecto-laravel.produccion: ~0 rows (aproximadamente)
INSERT INTO `produccion` (`id`, `ref`, `operario`, `piezas_buenas`, `piezas_malas`, `fecha_inicio`, `fecha_fin`, `gastos_adicionales`, `observaciones`, `created_at`, `updated_at`) VALUES
	(1, '1', 'prueba', NULL, 5, '2023-08-07', '2023-08-14', 5000, 'aaaaa', '2023-08-15 05:56:09', '2023-08-15 05:56:09'),
	(2, '001', 'prueba', NULL, 30, '2023-08-02', '2023-08-25', 2000, 'bbbb', '2023-08-15 05:59:24', '2023-08-15 05:59:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
