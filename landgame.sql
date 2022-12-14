-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2022 a las 21:20:06
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
(11, 3, '76.47', 19, 2, 0, NULL, '2022-12-13 16:59:03', '2022-12-13 16:59:03'),
(12, 2, '29.90', 19, 6, 0, NULL, '2022-12-13 16:59:04', '2022-12-13 16:59:04'),
(13, 1, '8.19', 19, 4, 0, NULL, '2022-12-13 16:59:05', '2022-12-13 16:59:05'),
(16, 2, '50.98', 21, 2, 0, NULL, '2022-12-14 16:57:13', '2022-12-14 16:57:13'),
(17, 2, '69.12', 21, 1, 0, NULL, '2022-12-14 16:57:14', '2022-12-14 16:57:14');

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
(5, 'C/Marruecos, 68', 'Calle Marruecos', 11, '2º D', 11678, 'Tánger', 'Tánger', 'Marruecos', '946466112', 'Juegos impresionantes', 2, 5, 0, NULL, NULL, NULL);

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
(2, 'Nacex', 'C/ Pablo Iglesias, 112-122\n            08908 - Hospitalet de Llobregat (Barcelona)', 'atencion.cliente@nacex.com', NULL, '900100100', 'images/logos_empresa/nacex.png', '3.86', '5.00', 0, NULL, NULL, NULL),
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
(41, 'images/juegos_mesa/log_prueba.png', 21, 0, NULL, NULL, NULL),
(42, 'images/juegos_mesa/403.png', 22, 0, NULL, '2022-12-14 16:38:06', '2022-12-14 16:38:06'),
(43, 'images/juegos_mesa/cocinera.png', 22, 0, NULL, '2022-12-14 16:38:06', '2022-12-14 16:38:06');

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
(21, 'Prueba', 'Demo', '7.89', '0', 0, NULL, NULL, NULL),
(22, 'Oca', 'Juego de 62 casillas', '23.56', '1', 0, NULL, NULL, NULL);

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
('006588dfbaca43429b2b2d5b4f53cfecfb46faa5e002c7d4350db91dbc89e9298e45e712708c3a30', 8, 4, 'Landgame', '[]', 0, '2022-12-12 18:48:50', '2022-12-12 18:48:50', '2023-12-12 19:48:50'),
('03ec1ffb321e0a2b9fa3e64abbb4aa9cf4b40e781c4debba6c9733bd026e78f6659e6cab408e91ec', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:05:41', '2022-12-11 20:05:41', '2023-12-11 21:05:41'),
('0425d1a9f7169dc62c195fe723c66c524f9ddb4331ab58a6e89ef5206257213cf777351bc7851b24', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:43:13', '2022-12-11 22:43:13', '2023-12-11 23:43:13'),
('09974a574f580571ee9428d666e5b34539622d7a946fdd25f2987f7b8a8928f43a3dc678c869b450', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:17:44', '2022-12-13 16:17:44', '2023-12-13 17:17:44'),
('0a288ff394f1f5b4f85a40499bc66d95e5bf20707aa24cda3565c0f6361468b20f190d4ae55c69cf', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:13:44', '2022-12-11 20:13:44', '2023-12-11 21:13:44'),
('0d4bd5a8f3af1e5a9d69d6e5412c48be14e5a4228ec01aabadab1cafd3ae134c8ef40a8dcc21b48d', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:28:35', '2022-12-11 22:28:35', '2023-12-11 23:28:35'),
('12965f66893ec1bc41e6a7485a40a455a2fff71e3ad3a1d501b4ab2b61d8c81348c7008f5559ed89', 8, 4, 'Landgame', '[]', 0, '2022-12-12 00:04:34', '2022-12-12 00:04:34', '2023-12-12 01:04:34'),
('14e4c855efc7df5e31cae218570de7ad7c40b819f0e7ca49da8b1ec671dae1b24de995668d3119d4', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:07:23', '2022-12-13 16:07:23', '2023-12-13 17:07:23'),
('1828492e3590fbb6e04b0fab4d1ed8b23c3fd65c702026c764e0b717d2708fa5281aff3efcbaa5a0', 8, 4, 'Landgame', '[]', 0, '2022-12-11 23:03:37', '2022-12-11 23:03:37', '2023-12-12 00:03:37'),
('1e65735ce62bfa7e5effbcca0f77a461e29f085b8fd4b11ce59fb4aa15a62d025366de1cdaac405e', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:24:17', '2022-12-11 22:24:17', '2023-12-11 23:24:17'),
('22921735b9dabd1e753fb825c6a33651adc7120fc068a51a6f2ab0d30b0d1a3f16bf1256931062af', 8, 4, 'Landgame', '[]', 0, '2022-12-13 15:36:48', '2022-12-13 15:36:48', '2023-12-13 16:36:48'),
('2454a94a544c73c8dc0004fb9580e889936e1c1f5eebc5c41159109d088cb8aee199491a611b20da', 1, 4, 'Landgame', '[]', 0, '2022-12-11 13:47:35', '2022-12-11 13:47:35', '2023-12-11 14:47:35'),
('26ee561c6a6498a84389bc610a0b1a55eba63ff88ca21ebdd42f3af2b26d14771a30a402120e98f9', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:41:13', '2022-12-11 14:41:13', '2023-12-11 15:41:13'),
('3278a6cea38f723a3b49c887404a90810ce7a31106243fdc43cfe9733a6b79fced0d1fdf1c5b1c6e', 8, 4, 'Landgame', '[]', 0, '2022-12-11 14:29:00', '2022-12-11 14:29:00', '2023-12-11 15:29:00'),
('32fd7a777e9963ed4bec17843bc3efc5a4c480cd1312d1034e752391d7cf388f3df3ad9cf12561ba', 8, 4, 'Landgame', '[]', 0, '2022-12-13 15:54:38', '2022-12-13 15:54:38', '2023-12-13 16:54:38'),
('39f19eb422ca3914cad4ba4badabbd52035503bd2c1dd11e01fb2e84b116ec9064c1fe7c54e3461e', 8, 4, 'Landgame', '[]', 0, '2022-12-11 11:35:03', '2022-12-11 11:35:03', '2023-12-11 12:35:03'),
('3d3ec5023e553526ec2bb807e72d1ca21c33a9c403a6dfd4a469914b94b2f825cc2f0a161db1bdfa', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:11:54', '2022-12-13 16:11:54', '2023-12-13 17:11:54'),
('40916a962efb17a4bf8fe3a98428a775b3b80a1b7b0eb017ea1f259633b563f528685a7e71f98e3a', 8, 4, 'Landgame', '[]', 0, '2022-12-11 23:35:03', '2022-12-11 23:35:03', '2023-12-12 00:35:03'),
('4256ed6d90f329c347ea5b3338280ab0f89d7a49ffbdde3aa35fbb6085ecd4737975ae57b27081b6', 8, 4, 'Landgame', '[]', 0, '2022-12-14 16:56:06', '2022-12-14 16:56:06', '2023-12-14 17:56:06'),
('4385fcca01d7223cb00793b147056dc3b09ef53eea62e1278623bbb53cb2b53f014aa0fd29bcccc9', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:25:30', '2022-12-11 22:25:30', '2023-12-11 23:25:30'),
('46b24e732feb5315ceb338a5bd4749bc9b50b84d0663e7f3a666bbcb6cad53ef6582d6470dc21fd9', 8, 4, 'Landgame', '[]', 0, '2022-12-11 19:07:51', '2022-12-11 19:07:51', '2023-12-11 20:07:51'),
('4c8544f1d2315acb2858c70b508bf91b838eb51ef1da5dc76b256d6424379171f9ddfc9503405c9d', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:25:54', '2022-12-11 20:25:54', '2023-12-11 21:25:54'),
('4cd699c491135027f0a8838d932752f95e70db48ca3d4e449680cc8b997179664c9bb356c3b0eac8', 8, 4, 'Landgame', '[]', 0, '2022-12-13 17:22:40', '2022-12-13 17:22:40', '2023-12-13 18:22:40'),
('4d06fe7637dc407f972bd4ab5ba655e6a2a85789f61794b211fcf9083977e4d9bf970cd7a0e48c02', 8, 4, 'Landgame', '[]', 0, '2022-12-11 11:56:25', '2022-12-11 11:56:25', '2023-12-11 12:56:25'),
('548f22936c934d59e9186f17a644ac19e87f455b463aac8e5d1264f84582516fdd195bcd9f510bad', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:11:26', '2022-12-11 22:11:26', '2023-12-11 23:11:26'),
('565e6e3a962c7eae98fc641efe383d40e4b5da4d7efecda62919caff8ee46a87405c5df3ae66530e', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:58:02', '2022-12-13 16:58:02', '2023-12-13 17:58:02'),
('6467448919b14b5854c5c748725d47aa66449c7992ece5003fac2b6acdaa3a1a59dff3be715d652b', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:14:56', '2022-12-11 14:14:56', '2023-12-11 15:14:56'),
('72d20b00f0c9690cf22354a7f3300c42552d916f13379cd79009aae4b805fe60892b61b5b979cbad', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:16:12', '2022-12-11 14:16:12', '2023-12-11 15:16:12'),
('733b82921ae1b16c30346ade87541d922e9d4b74e3f4eeb96d66efbe926ed4d089f5181f1c821a27', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:18:34', '2022-12-13 16:18:34', '2023-12-13 17:18:34'),
('794bff1b6b503cfee6a4c62edab7d3fac63db480f3d7019572e22ec12104980a2163a7f8c0d75153', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:17:27', '2022-12-11 22:17:27', '2023-12-11 23:17:27'),
('7a24f62ad18ddfc8f480ee65d25e79d9e6f51aca10bcb743d3828f4187ee8e36d26ccb0b78b0c9a8', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:21:56', '2022-12-11 20:21:56', '2023-12-11 21:21:56'),
('7ccffde5de5a7240853db5a8491be88694b8159ecba4ac596365f788851c92913a13248424d69bc0', 8, 4, 'Landgame', '[]', 0, '2022-12-11 14:16:47', '2022-12-11 14:16:47', '2023-12-11 15:16:47'),
('7e6f334e89710c0d3f999d1e823eb5b3447a7af877c0746a78882ff67ead6dcdb7fca76588fcf13e', 8, 4, 'Landgame', '[]', 0, '2022-12-12 00:19:13', '2022-12-12 00:19:13', '2023-12-12 01:19:13'),
('80fbbcf9597c19846a15926f27feaa760a85115838775f7c352d1b641f1114fb0632b635d18fbe6e', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:27:24', '2022-12-11 14:27:24', '2023-12-11 15:27:24'),
('871d5f349fbcd4627389025beebd453af44fb5a8f96bbf403085ba36142d363df3e62b409d6220cb', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:50:27', '2022-12-11 22:50:27', '2023-12-11 23:50:27'),
('87791447c5b86b197544092a498e87e9a7c3bce33dc140dbd30e4ba7df3948bc0503cbae456d7225', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:13:10', '2022-12-11 22:13:10', '2023-12-11 23:13:10'),
('8bc5c456dc150e68d7f60978190d6a58d5c247c22876145d2a2e74c2c5a3838c38342612248e0fcf', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:27:16', '2022-12-11 22:27:16', '2023-12-11 23:27:16'),
('8c535a23532fc836f85a1fc2e9c0389ed49d41b974eb3efb43f3f8dd41bde904e0a1714f09c439c3', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:00:55', '2022-12-13 16:00:55', '2023-12-13 17:00:55'),
('8fb5f597fc3989650a6b57a9264def2d5a7cd097565f74b3ddf34d3c56811375e893e4d088d56d59', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:32:34', '2022-12-11 22:32:34', '2023-12-11 23:32:34'),
('9314d21e0f9e53ce00a78fb180da2ca2b1773c84374f6631ba086f4e9e77b397446858ce10c13397', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:21:36', '2022-12-11 22:21:36', '2023-12-11 23:21:36'),
('963d564918f5948c44f218737d994e0b7ea9dd8261310c8f8f4fbfba78a3b111a40ab4ba8c89b407', 8, 4, 'Landgame', '[]', 0, '2022-12-13 16:53:51', '2022-12-13 16:53:51', '2023-12-13 17:53:51'),
('994c4f5dd01f62df71d3099596af48189e7e99085ae86dcc9e50e8c470e50d3e773d7e2bfc521a79', 8, 4, 'Landgame', '[]', 0, '2022-12-11 14:41:44', '2022-12-11 14:41:44', '2023-12-11 15:41:44'),
('9e5ec1b43d34d622f12ad85335916e76720b49f1d826beb528a2dab568ee89b5f8b92ac3539198dd', 8, 4, 'Landgame', '[]', 0, '2022-12-11 16:50:15', '2022-12-11 16:50:15', '2023-12-11 17:50:15'),
('a78e675b439a3b046aca89bed79ff5c7f5e39fc63e67568686b9c3c6f977572ab951bf906ca8fdfc', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:31:57', '2022-12-11 20:31:57', '2023-12-11 21:31:57'),
('a950f62a9f1b3f17e5180d9ac7127e32b90b0674fa33062fbeb4ae4bfce7b7f86a9cca838190991c', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:23:12', '2022-12-11 22:23:12', '2023-12-11 23:23:12'),
('b0e3f8f40ab694323c3e3c6e85cca3925586a7791630305f8877334bfa1a500773bc37bf976b4aca', 8, 4, 'Landgame', '[]', 0, '2022-12-11 12:26:50', '2022-12-11 12:26:50', '2023-12-11 13:26:50'),
('babc20ead0468db5094491dbe5786ace04f4f6c2e17c137c3d161c0515f3c3a8d531e9724484505b', 8, 4, 'Landgame', '[]', 0, '2022-12-11 12:13:47', '2022-12-11 12:13:47', '2023-12-11 13:13:47'),
('bb8f2a1cd47356d18b5dd49b1b279589acf912b44d54159d880b4a5efbc75aea75abb609c538021b', 8, 4, 'Landgame', '[]', 0, '2022-12-11 11:35:54', '2022-12-11 11:35:54', '2023-12-11 12:35:54'),
('c30892772a87e7e50137f8399ed81097310b2d84c7c260e371debd1f8fd942660a65762859f23b30', 8, 4, 'Landgame', '[]', 0, '2022-12-11 23:56:03', '2022-12-11 23:56:03', '2023-12-12 00:56:03'),
('c657c669c852e2c5c7c68d9b13d74018aefbb4b0f6a4a10f423e9531e3e754f32ac89d250203545b', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:07:25', '2022-12-11 20:07:25', '2023-12-11 21:07:25'),
('d330d512af77836f8ca5cd63886b5379f5d6a6d7fff6a35054e601dd54b1de55db674a082ad882cb', 8, 4, 'Landgame', '[]', 0, '2022-12-12 00:03:33', '2022-12-12 00:03:33', '2023-12-12 01:03:33'),
('d51524bd012070c67f23f4907d552bdec5a17efec4cf39a2416c0f367ac39897d9af31d00c2c192f', 1, 4, 'Landgame', '[]', 0, '2022-12-11 13:47:56', '2022-12-11 13:47:56', '2023-12-11 14:47:56'),
('dccf0dd66549042ee50049b4c25d9d0510b4d274b2891b23bf446fe0cce71abc94d31effdb3b9241', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:40:20', '2022-12-11 20:40:20', '2023-12-11 21:40:20'),
('dfb9c2dd00537f0541f38c5a6ffbb33951e9a8dc8cae8b05118e57e9b601de2ff416103cb31b8b7b', 8, 4, 'Landgame', '[]', 0, '2022-12-11 20:42:42', '2022-12-11 20:42:42', '2023-12-11 21:42:42'),
('e46b45165e8f381b10b78f140a7959bd3431c655d9a10982b66def577bb8f122231b8c9fbaf562d7', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:08:55', '2022-12-11 22:08:55', '2023-12-11 23:08:55'),
('e5b1eada44e899facf5bd8175b882a9295ed9ff7b32e4e54919500ee4ec9450e879243d905542820', 8, 4, 'Landgame', '[]', 0, '2022-12-11 23:58:38', '2022-12-11 23:58:38', '2023-12-12 00:58:38'),
('e5fc20fea4396fa0051cef4d2dab6778c47d89ad1f526895524ec0406e3ee560636a37deabbe8505', 8, 4, 'Landgame', '[]', 0, '2022-12-13 15:48:01', '2022-12-13 15:48:01', '2023-12-13 16:48:01'),
('e67d63a4e9fc19273a5399c4243a319ae400345c83957ce4e846217d6713a5a073fc40752ca86dfe', 8, 4, 'Landgame', '[]', 0, '2022-12-12 00:08:45', '2022-12-12 00:08:45', '2023-12-12 01:08:45'),
('e6ed163f60565c6b6eb525943c25f00b032c8c93736d07720c7a29fc3b815c323668886128d9e113', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:28:36', '2022-12-11 14:28:36', '2023-12-11 15:28:36'),
('f04ec49f04586b5f656ab73bbe200c8affa52e446f8a8ba796b54ce0cffd8496d608ff5576da5da6', 8, 4, 'Landgame', '[]', 0, '2022-12-11 18:47:23', '2022-12-11 18:47:23', '2023-12-11 19:47:23'),
('f1c93f4fb7fabf457dac96f25c12dafa35cbd80cd5bb5e3566a4c19c0b047fccbc5ffaa714d9f385', 8, 4, 'Landgame', '[]', 0, '2022-12-11 23:39:16', '2022-12-11 23:39:16', '2023-12-12 00:39:16'),
('f89fc959c69768494c99726358a80c86cede05fde129c74fafbd56288a12f4573f3c74120d34c4fd', 1, 4, 'Landgame', '[]', 0, '2022-12-11 14:38:02', '2022-12-11 14:38:02', '2023-12-11 15:38:02'),
('fcac45bc1a8988ef4d37d6a131b13251fae2044421d95460056d504c075d2c5c22d780f2590036f5', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:15:04', '2022-12-11 22:15:04', '2023-12-11 23:15:04'),
('fd3837e0af750adaf728ffd7901ea68a6ccf40e4ec342834d55a12575143de945797bd8c12c0bfc5', 8, 4, 'Landgame', '[]', 0, '2022-12-11 22:19:47', '2022-12-11 22:19:47', '2023-12-11 23:19:47');

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
(1, NULL, 'landgame Personal Access Client', 'p3m04mfgrupoAfwZaFMO5Tue4vDUnIS5IshfnTjp', NULL, 'http://localhost', 1, 0, 0, '2022-12-11 11:33:24', '2022-12-11 11:33:24'),
(2, NULL, 'landgame Password Grant Client', '9WSbaNC2PLWFyWoDNFiwhv4opvpd8JIuAxQW3Sy0', 'users', 'http://localhost', 0, 1, 0, '2022-12-11 11:33:24', '2022-12-11 11:33:24'),
(4, NULL, 'Landgame', 'g1PWm3V9BCUGim7tufagmyV8bbkUXkUO6RRf77b4', NULL, 'http://localhost', 1, 0, 0, '2022-12-11 11:34:43', '2022-12-11 11:34:43');

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
(1, 1, '2022-12-11 11:33:24', '2022-12-11 11:33:24'),
(2, 3, '2022-12-11 11:33:44', '2022-12-11 11:33:44'),
(3, 4, '2022-12-11 11:34:43', '2022-12-11 11:34:43');

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
(19, '114.56', '2022-12-13', 8, 'Pagado', 0, NULL, '2022-12-13 16:59:02', '2022-12-13 16:59:02'),
(20, '87.48', '2022-12-14', 6, 'Pagado', 0, NULL, NULL, NULL),
(21, '120.10', '2022-12-14', 8, 'Pagado', 0, NULL, '2022-12-14 16:57:12', '2022-12-14 16:57:12');

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
(1, 'Admin', 'Admin', 'admin@admin.com', NULL, 'admin', '$2y$10$XtPQyAK29bKb6NpuVakAVe96nCB3cwyFG0BRG6S0hRBVaymQk8laC', 1, 0, 0, NULL, NULL, '2022-12-14 17:22:12'),
(2, 'Julio', 'Muñoz Chozas', 'julio@gmail.com', NULL, 'julio94', '$2y$10$7Xk4STa1vh1bkMxY4OoBAOoePGigI1SV7oo4U0FvgVHHCIzJ/NhdG', 3, 0, 0, NULL, NULL, '2022-12-14 17:16:42'),
(3, 'Adrián', 'Reyes López', 'adrian@gmail.com', NULL, 'adri65', '$2y$10$KB78Kh4HbhR36Dj/696CouJL45O4XaBofIQO5Qt3kSD11qZN2Qoyi', 2, 0, 0, NULL, NULL, '2022-12-14 16:44:57'),
(4, 'Laura', 'Gómez Sánchez', 'lausanchez@gmail.com', NULL, 'lau96', '$2y$10$q0yEoD02KUZ05FKlcPEfiuc4CuePTZCXwjIBcE/BfEt8QhFEzazWW', 2, 0, 0, NULL, NULL, NULL),
(5, 'Guillermo', 'Álvarez Chozas', 'guilleal@gmail.com', NULL, 'guillalv43', '$2y$10$bA95oZpm.aCTr1BDXmZjdeHUZQOXvv.h3W209vZ5.by3liU0rpEYe', 4, 0, 0, NULL, NULL, '2022-12-14 20:19:46'),
(6, 'Francisco', 'Jimenez Lara', 'franjila@gmail.com', NULL, 'franji1992', '$2y$10$WfCPceMK.rfguJLMIwTdteoXH8s6UXWI5t.vdJq/P9i/8K5XLqmci', 4, 0, 0, NULL, NULL, '2022-12-14 17:15:14'),
(7, 'Paula', 'García Gutiérrez', 'paulagarcia@gmail.com', NULL, 'paula76', '$2y$10$/HxwarCL5l0a9Bj2fmnV/eCPAqrjti558pKWjsLbgMiLljByUb2yC', 3, 0, 0, NULL, NULL, NULL),
(8, 'Félix', 'Reyes Fernández', 'felixreyes@gmail.com', NULL, 'felixreyes', '$2y$10$gUgGE6E.B.FQRoTnuzWnf.2cCl7BkNiStBSlJHQ8JytwAst./JGKW', 4, 0, 0, NULL, NULL, '2022-12-14 17:33:55');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `direcciones_envios`
--
ALTER TABLE `direcciones_envios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
