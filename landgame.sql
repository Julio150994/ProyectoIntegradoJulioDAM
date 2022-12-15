-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2022 a las 21:55:07
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `landgame`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(6,2) NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `juego_id` bigint(20) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `cantidad`, `precioUnitario`, `pedido_id`, `juego_id`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, '29.55', 1, 7, 0, NULL, NULL, NULL),
(2, 1, '34.56', 1, 1, 0, NULL, NULL, NULL),
(3, 3, '29.55', 2, 7, 0, NULL, NULL, NULL),
(4, 1, '37.91', 2, 12, 0, NULL, NULL, NULL),
(5, 2, '29.90', 3, 6, 0, NULL, NULL, NULL),
(6, 2, '62.68', 3, 8, 0, NULL, NULL, NULL),
(11, 3, '76.47', 19, 2, 0, NULL, '2022-12-13 15:59:03', '2022-12-13 15:59:03'),
(12, 2, '29.90', 19, 6, 0, NULL, '2022-12-13 15:59:04', '2022-12-13 15:59:04'),
(13, 1, '8.19', 19, 4, 0, NULL, '2022-12-13 15:59:05', '2022-12-13 15:59:05'),
(16, 2, '50.98', 21, 2, 0, NULL, '2022-12-14 15:57:13', '2022-12-14 15:57:13'),
(17, 2, '69.12', 21, 1, 0, NULL, '2022-12-14 15:57:14', '2022-12-14 15:57:14'),
(18, 2, '50.98', 22, 2, 0, NULL, NULL, NULL),
(19, 3, '24.57', 22, 4, 0, NULL, NULL, NULL),
(20, 3, '54.75', 23, 3, 0, NULL, NULL, NULL),
(21, 2, '50.98', 23, 2, 0, NULL, NULL, NULL),
(22, 1, '8.19', 24, 4, 0, NULL, NULL, NULL),
(26, 2, '50.98', 26, 2, 0, NULL, '2022-12-15 20:26:24', '2022-12-15 20:26:24'),
(27, 2, '36.50', 26, 3, 0, NULL, '2022-12-15 20:26:26', '2022-12-15 20:26:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_envios`
--

CREATE TABLE `direcciones_envios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreCalle` varchar(85) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portal` int(11) NOT NULL,
  `piso` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoPostal` int(11) NOT NULL,
  `ciudad` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_reparto_id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones_envios`
--

INSERT INTO `direcciones_envios` (`id`, `direccion`, `nombreCalle`, `portal`, `piso`, `codigoPostal`, `ciudad`, `provincia`, `pais`, `telefono`, `observaciones`, `empresa_reparto_id`, `cliente_id`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Calle Luna, Callejero', 'Luna', 13, '2º C', 11510, 'Puerto Real', 'Cádiz', 'España', '678113245', 'Estos juegos son muy divertidos', 1, 5, 0, NULL, NULL, NULL),
(2, 'AV. Ana de Viya', 'Ana de Viya', 34, '4º B', 11003, 'Cádiz', 'Cádiz', 'España', '678901122', 'Me ha gustado sobre todo el juego del Dixit', 3, 8, 0, NULL, NULL, NULL),
(3, 'C/Argentina, 67', 'Luna', 1, '2º C', 11012, 'Puerto Real', 'Cádiz', 'España', '956956009', 'pruebaaa', 2, 8, 0, NULL, NULL, NULL),
(5, 'C/Marruecos, 68', 'Calle Marruecos', 11, '2º D', 11678, 'Tánger', 'Tánger', 'Marruecos', '946466112', 'Juegos impresionantes', 2, 5, 0, NULL, NULL, NULL),
(6, 'C/Salinas, 122', 'Calle Salinas', 34, '3º E', 11510, 'Puerto Real', 'Cádiz', 'España', '956966229', 'Juegos interesantes', 2, 8, 0, NULL, NULL, NULL),
(7, 'C/Marcos, 46', 'Marcos', 11, '2º D', 11456, 'Madrid', 'Madrid', 'España', '956956712', 'Pruebaasss', 3, 8, 0, NULL, NULL, NULL),
(8, 'C/Marquesa', 'Marquesa', 12, '4º B', 11789, 'Tánger', 'Tánger', 'Marruecos', '956785673', 'Pruebaaaaa', 1, 8, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_repartos`
--

CREATE TABLE `empresas_repartos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coste_pedido_normal` decimal(6,2) NOT NULL,
  `coste_pedido_urgente` decimal(6,2) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas_repartos`
--

INSERT INTO `empresas_repartos` (`id`, `nombre`, `direccion`, `email`, `email_verified_at`, `telefono`, `imagen`, `coste_pedido_normal`, `coste_pedido_urgente`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tipsa Puerto Real', 'Calle Ancha, nº 12, Puerto Real, España', 'ramon.tipsa@gmail.com', NULL, '956922815', 'images/logos_empresa/tipsa.png', '3.55', '4.78', 0, NULL, NULL, NULL),
(2, 'Nacex', 'C/ Pablo Iglesias, 112-122\r\n            08908 - Hospitalet de Llobregat (Barcelona)', 'atencion.cliente@nacex.com', NULL, '900100100', 'images/logos_empresa/nacex.png', '3.86', '5.00', 0, NULL, NULL, NULL),
(3, 'Rapid Express', 'C/Uruguay 4 CP. 28016 Madrid', 'atencionalcliente@rapidexpress.es', NULL, ' 915103360', 'images/logos_empresa/rapid_express.png', '3.95', '4.36', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_juegos`
--

CREATE TABLE `imagenes_juegos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juego_id` bigint(20) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes_juegos`
--

INSERT INTO `imagenes_juegos` (`id`, `url`, `juego_id`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'images/juegos_mesa/trivial_pursuit_familia.png', 1, 0, NULL, NULL, NULL),
(2, 'images/juegos_mesa/pursuit_family.png', 1, 0, NULL, NULL, NULL),
(3, 'images/juegos_mesa/monopoly_clasico_caja_roja.png', 2, 0, NULL, NULL, NULL),
(4, 'images/juegos_mesa/monopoly_clasico_tablero.png', 2, 0, NULL, NULL, NULL),
(5, 'images/juegos_mesa/scrabble_original.png', 3, 0, NULL, NULL, NULL),
(6, 'images/juegos_mesa/scrabble_original_castellano.png', 3, 0, NULL, NULL, NULL),
(7, 'images/juegos_mesa/imagicbox_caja_cartomagia.png', 4, 0, NULL, NULL, NULL),
(8, 'images/juegos_mesa/imagicbox_juego_magia_poker.png', 4, 0, NULL, NULL, NULL),
(9, 'images/juegos_mesa/catan_version_plus.png', 5, 0, NULL, NULL, NULL),
(10, 'images/juegos_mesa/catan_plus_posterior.png', 5, 0, NULL, NULL, NULL),
(11, 'images/juegos_mesa/virus_juego.png', 6, 0, NULL, NULL, NULL),
(12, 'images/juegos_mesa/virus_cartas_basicas.png', 6, 0, NULL, NULL, NULL),
(13, 'images/juegos_mesa/uno_juego_logo.png', 7, 0, NULL, NULL, NULL),
(14, 'images/juegos_mesa/uno_juego_cartas.png', 7, 0, NULL, NULL, NULL),
(15, 'images/juegos_mesa/dixit_normal.png', 8, 0, NULL, NULL, NULL),
(16, 'images/juegos_mesa/dixit_tablero.png', 8, 0, NULL, NULL, NULL),
(17, 'images/juegos_mesa/exploding_kittens_caja.png', 9, 0, NULL, NULL, NULL),
(18, 'images/juegos_mesa/exploding_kittens_cartas.png', 9, 0, NULL, NULL, NULL),
(19, 'images/juegos_mesa/times_up_party.png', 10, 0, NULL, NULL, NULL),
(20, 'images/juegos_mesa/times_up_party_elementos_juego.png', 10, 0, NULL, NULL, NULL),
(21, 'images/juegos_mesa/risk_star_wars_vii.png', 11, 0, NULL, NULL, NULL),
(22, 'images/juegos_mesa/risk_star_wars_vii_tablero.png', 11, 0, NULL, NULL, NULL),
(23, 'images/juegos_mesa/bang_bala_juego.png', 12, 0, NULL, NULL, NULL),
(24, 'images/juegos_mesa/bang_bala_cartas.png', 12, 0, NULL, NULL, NULL),
(25, 'images/juegos_mesa/twister_a_ciegas_caja.png', 13, 0, NULL, NULL, NULL),
(26, 'images/juegos_mesa/twister_a_ciegas_tablero.png', 13, 0, NULL, NULL, NULL),
(27, 'images/juegos_mesa/valle_de_los_vikingos_caja.png', 14, 0, NULL, NULL, NULL),
(28, 'images/juegos_mesa/valle_de_los_vikingos_tablero.png', 14, 0, NULL, NULL, NULL),
(29, 'images/juegos_mesa/preguntados_juego.png', 15, 0, NULL, NULL, NULL),
(30, 'images/juegos_mesa/preguntados_juego_tablero.png', 15, 0, NULL, NULL, NULL),
(31, 'images/juegos_mesa/sandwich_juego.png', 16, 0, NULL, NULL, NULL),
(32, 'images/juegos_mesa/sandwich_juego_cartas.png', 16, 0, NULL, NULL, NULL),
(33, 'images/juegos_mesa/mal_trago_juego_caja.png', 17, 0, NULL, NULL, NULL),
(34, 'images/juegos_mesa/mal_trago_juego_cartas.png', 17, 0, NULL, NULL, NULL),
(35, 'images/juegos_mesa/ajedrez_harry_potter_caja.png', 18, 0, NULL, NULL, NULL),
(36, 'images/juegos_mesa/ajedrez_harry_potter_tablero.png', 18, 0, NULL, NULL, NULL),
(37, 'images/juegos_mesa/cluedo_edicion_sevilla.png', 19, 0, NULL, NULL, NULL),
(38, 'images/juegos_mesa/cluedo_edicion_sevilla_tablero.png', 19, 0, NULL, NULL, NULL),
(39, 'images/juegos_mesa/black_stories_juego_caja.png', 20, 0, NULL, NULL, NULL),
(40, 'images/juegos_mesa/black_stories_juego_cartas.png', 20, 0, NULL, NULL, NULL),
(41, 'images/juegos_mesa/log_prueba.png', 21, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `stock` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trivial Pursuit Familia', 'Juego de preguntas', '34.56', '1', 0, NULL, NULL, NULL),
(2, 'Monopoly Clásico', 'Juego basado en el intercambio y compraventa', '25.49', '1', 0, NULL, NULL, NULL),
(3, 'Scrabble Original', 'Juego de palabras cruzadas para 2, 3 ó 4 jugadores', '18.25', '1', 0, NULL, NULL, NULL),
(4, 'IMagicBox Cife', 'Juego de cartomagia de póker', '8.19', '1', 0, NULL, NULL, NULL),
(5, 'Catán Plus', 'Nueva edición de la versión Plus del popular juego, entre 2 y 6 jugadores', '62.99', '1', 0, NULL, NULL, NULL),
(6, 'Virus', 'El juego de cartas ágil y rápido más contagioso', '14.95', '1', 0, NULL, NULL, NULL),
(7, 'Uno', 'Juego de cartas clásico del Uno', '9.85', '1', 0, NULL, NULL, NULL),
(8, 'Dixit Normal', ' Juego de cartas para adivinar la tarjeta del otro', '31.34', '1', 0, NULL, NULL, NULL),
(9, 'Exploding Kittens', 'Juego de cartas donde debes sobrevivir ante gatos explosivos', '19.95', '1', 0, NULL, NULL, NULL),
(10, 'Times Up Party', 'Edición party del Times Up', '19.90', '1', 0, NULL, NULL, NULL),
(11, 'Risk Star Wars VII', 'El risk de la película Star Wars VII', '57.33', '1', 0, NULL, NULL, NULL),
(12, 'Bang ¡La Bala!', 'Expansión del juego Bang original', '37.91', '1', 0, NULL, NULL, NULL),
(13, 'Twister a ciegas', 'Como el Twister normal, pero con los ojos vendados', '20.59', '1', 0, NULL, NULL, NULL),
(14, 'El Valle de los Vikingos', 'Juego donde lanzamos toneles a otros jugadores', '24.86', '1', 0, NULL, NULL, NULL),
(15, 'Preguntados', 'El juego de aplicación móvil, pero en tablero de mesa', '27.22', '1', 0, NULL, NULL, NULL),
(16, 'Sándwich', 'Juego donde tienes que hacer el mejor sándwich', '14.95', '1', 0, NULL, NULL, NULL),
(17, 'Mal trago', 'El juego de los goblins kamikazes', '13.73', '0', 0, NULL, NULL, NULL),
(18, 'Ajedrez de Harry Potter', 'El ajedrez clásico de la película', '54.43', '0', 0, NULL, NULL, NULL),
(19, 'Cluedo Ed. Sevilla', 'Sobre el asesinato de una cantautora', '30.20', '0', 0, NULL, NULL, NULL),
(20, 'Black Stories', 'Juego de cartas para resolver diferentes situaciones oscuras', '15.95', '0', 0, NULL, NULL, NULL),
(21, 'Prueba', 'Demo', '7.89', '0', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_09_22_162422_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2022_10_06_162941_create_juegos_table', 1),
(11, '2022_10_06_164121_create_empresas_repartos_table', 1),
(12, '2022_10_08_092659_create_imagenes_juegos_table', 1),
(13, '2022_11_08_202135_create_pedidos_table', 1),
(14, '2022_11_15_184919_create_detalle_pedidos_table', 1),
(15, '2022_11_17_181517_create_direcciones_envios_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('236ee80883b36eeadbd040b8da2f8150b1ee7bd63aa7349849e76d6b074848e31ffae0dd1343e47d', 8, 3, 'Landgame', '[]', 0, '2022-12-15 17:06:11', '2022-12-15 17:06:11', '2023-12-15 18:06:11'),
('29d081220f8a44daf93a66ab33e5f676bb19354504e2ee24e762b19b1b82db5ac4767b60ab01f836', 8, 3, 'Landgame', '[]', 0, '2022-12-15 18:31:28', '2022-12-15 18:31:28', '2023-12-15 19:31:28'),
('42eafd9e13baf76ef7b9bca53b9dd926388bff978d2dc9ec1cd73c2046fccd2fdff1eb76d6406205', 8, 3, 'Landgame', '[]', 0, '2022-12-15 16:36:45', '2022-12-15 16:36:45', '2023-12-15 17:36:45'),
('44155b54a40175b8f544b0d9689a48c781bd80f7e235464efd6118d8b49f3eeb018d23306ad123b1', 8, 3, 'Landgame', '[]', 0, '2022-12-15 17:29:02', '2022-12-15 17:29:02', '2023-12-15 18:29:02'),
('48041d3cf6d66b0c00553f12c1592261047bcdcec0ce079c99967a794c27f63cb1f27b0b2c7a7b39', 8, 3, 'Landgame', '[]', 0, '2022-12-15 17:03:59', '2022-12-15 17:03:59', '2023-12-15 18:03:59'),
('4ac0c482ed4ba5b25c0ac3fb17c18a3576ddd83db7318cb268084bf843fed19662a1db0f7d5c87c5', 8, 3, 'Landgame', '[]', 0, '2022-12-15 19:45:05', '2022-12-15 19:45:05', '2023-12-15 20:45:05'),
('588c8652b1ef0e0705c0c8d57e6cbdad746bff39fb17b276b325a8df3bf4c2574b5079c5ef49a7f3', 8, 3, 'Landgame', '[]', 0, '2022-12-15 16:58:20', '2022-12-15 16:58:20', '2023-12-15 17:58:20'),
('7f6589df60d910266a8080f27b204981bb52dc5b8f585bca053b437ce05281b5cf4441a606866230', 8, 3, 'Landgame', '[]', 0, '2022-12-15 16:45:10', '2022-12-15 16:45:10', '2023-12-15 17:45:10'),
('c5a23849c9b11e325c17fd7a560dcfb39c376767c5315b73798310a3ed3048f4cedebb7e135de686', 8, 3, 'Landgame', '[]', 0, '2022-12-15 17:17:29', '2022-12-15 17:17:29', '2023-12-15 18:17:29'),
('e1e3eb34b8c587b8bc18f25d27f75f985701245c29cd17ee5e1eeea1c75a6731e4d1f225121be40e', 8, 3, 'Landgame', '[]', 0, '2022-12-15 20:25:43', '2022-12-15 20:25:43', '2023-12-15 21:25:43'),
('fd01f34a3fe8b143fada7e39ddefa645a910525cbd5d6dffa36015037186d3d817aea61a8de5916a', 8, 3, 'Landgame', '[]', 0, '2022-12-15 16:34:32', '2022-12-15 16:34:32', '2023-12-15 17:34:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '9wFlIBZFCrpdzPF8jkNzHUosMZtudhL8qN2HJFQ7', NULL, 'http://localhost', 1, 0, 0, '2022-12-15 15:45:27', '2022-12-15 15:45:27'),
(2, NULL, 'Laravel Password Grant Client', 'yhNoMSEZUzqSkOOs7JIxnZ2s51ce8bhqnDrgDQWp', 'users', 'http://localhost', 0, 1, 0, '2022-12-15 15:45:27', '2022-12-15 15:45:27'),
(3, NULL, 'Landgame', '1wgZlcnsQjNSV1b5VELiPGPAfzQjVBkCTku9zArQ', NULL, 'http://localhost', 1, 0, 0, '2022-12-15 15:45:38', '2022-12-15 15:45:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12-15 15:45:27', '2022-12-15 15:45:27'),
(2, 3, '2022-12-15 15:45:38', '2022-12-15 15:45:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `precioTotal` decimal(6,2) NOT NULL,
  `fechaCompra` date NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `estado` enum('Pagado','En trámite','Preparado','Enviado','Incidencia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `precioTotal`, `fechaCompra`, `cliente_id`, `estado`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '64.11', '2022-11-17', 5, 'Enviado', 0, NULL, NULL, NULL),
(2, '67.46', '2022-11-18', 8, 'Enviado', 0, NULL, NULL, NULL),
(3, '92.58', '2022-11-21', 8, 'Preparado', 0, NULL, NULL, NULL),
(19, '114.56', '2022-12-13', 8, 'Pagado', 0, NULL, '2022-12-13 15:59:02', '2022-12-13 15:59:02'),
(20, '87.48', '2022-12-14', 6, 'Pagado', 0, NULL, NULL, NULL),
(21, '120.10', '2022-12-14', 8, 'Pagado', 0, NULL, '2022-12-14 15:57:12', '2022-12-14 15:57:12'),
(22, '75.55', '2022-12-15', 8, 'Pagado', 0, NULL, NULL, NULL),
(23, '105.73', '2022-12-15', 8, 'Pagado', 0, NULL, NULL, NULL),
(24, '8.19', '2022-12-15', 8, 'Pagado', 0, NULL, NULL, NULL),
(26, '87.48', '2022-12-15', 8, 'Pagado', 0, NULL, '2022-12-15 20:26:23', '2022-12-15 20:26:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 0, NULL, NULL, NULL),
(2, 'Contable', 0, NULL, NULL, NULL),
(3, 'Mozo', 0, NULL, NULL, NULL),
(4, 'Cliente', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_logged` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `email`, `email_verified_at`, `username`, `password`, `role_id`, `is_logged`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', NULL, 'admin', '$2y$10$V7HU.oyMZrs4ydcBNz04QO7nFWv.4dK/Xt1xfE5DSCTZlFa6sgV0a', 1, 0, 0, NULL, NULL, '2022-12-15 19:43:24'),
(2, 'Julio', 'Muñoz Chozas', 'julio@gmail.com', NULL, 'julio94', '$2y$10$83t9EapB/.bIW7OnzSl/Ku0W2ViCslkieVFH9MBsU2vD1HpqRTadm', 3, 0, 0, NULL, NULL, '2022-12-15 18:38:43'),
(3, 'Adrián', 'Reyes López', 'adrian@gmail.com', NULL, 'adri65', '$2y$10$H4cRtycBdYU7GT6I4ZLIKe/LAZzaL.lmzkq6VZYOnDKGxIM850/iK', 2, 0, 0, NULL, NULL, '2022-12-15 18:54:38'),
(4, 'Laura', 'Gómez Sánchez', 'lausanchez@gmail.com', NULL, 'lau96', '$2y$10$MKkrHaUUxiM5m4rMkibWs.rORHXPfIFgPSXn5WQdyOgdePSlHxhPG', 2, 0, 0, NULL, NULL, NULL),
(5, 'Guillermo', 'Álvarez Chozas', 'guilleal@gmail.com', NULL, 'guillalv43', '$2y$10$nnOWaRJjr4/AFGw5ntXySOlcXick44s7NILgUU3.DD/H8WbkPLSlm', 4, 0, 0, NULL, NULL, NULL),
(6, 'Francisco', 'Jimenez Lara', 'franjila@gmail.com', NULL, 'franji1992', '$2y$10$UjyqB7qohqX5zUu6MgHQl.FD7YhGSz22DO.5YmZMSUUAvafDxQuKK', 4, 0, 0, NULL, NULL, NULL),
(7, 'Paula', 'García Gutiérrez', 'paulagarcia@gmail.com', NULL, 'paula76', '$2y$10$2Gu5YENLTKi97Aqvk6qPe.FXdpvzwhsSJD5jHuX0CT8oD94bMO7kO', 3, 0, 0, NULL, NULL, NULL),
(8, 'Félix', 'Reyes Fernández', 'felixreyes@gmail.com', NULL, 'felixreyes', '$2y$10$2.yw99WK7xXm.crcv9kx1ujYIkLm1CRJEbwQvBJzIyn4ehQwgPMuu', 4, 0, 0, NULL, NULL, '2022-12-15 18:28:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `detalle_pedidos_juego_id_foreign` (`juego_id`);

--
-- Indices de la tabla `direcciones_envios`
--
ALTER TABLE `direcciones_envios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `direcciones_envios_telefono_unique` (`telefono`),
  ADD KEY `direcciones_envios_empresa_reparto_id_foreign` (`empresa_reparto_id`),
  ADD KEY `direcciones_envios_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `empresas_repartos`
--
ALTER TABLE `empresas_repartos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresas_repartos_nombre_unique` (`nombre`),
  ADD UNIQUE KEY `empresas_repartos_email_unique` (`email`),
  ADD UNIQUE KEY `empresas_repartos_telefono_unique` (`telefono`),
  ADD UNIQUE KEY `empresas_repartos_imagen_unique` (`imagen`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imagenes_juegos_url_unique` (`url`),
  ADD KEY `imagenes_juegos_juego_id_foreign` (`juego_id`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `juegos_nombre_unique` (`nombre`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `direcciones_envios`
--
ALTER TABLE `direcciones_envios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empresas_repartos`
--
ALTER TABLE `empresas_repartos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_juego_id_foreign` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direcciones_envios`
--
ALTER TABLE `direcciones_envios`
  ADD CONSTRAINT `direcciones_envios_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `direcciones_envios_empresa_reparto_id_foreign` FOREIGN KEY (`empresa_reparto_id`) REFERENCES `empresas_repartos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  ADD CONSTRAINT `imagenes_juegos_juego_id_foreign` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
