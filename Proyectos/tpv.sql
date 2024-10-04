-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-10-2024 a las 17:50:55
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpv`
--

--Eliminar la BD si existe
DROP DATABASE IF EXISTS tpv;
--Crear BD tpv
CREATE DATABASE tpv CHARACTER SET utf8mb4;
--Seleccionar BD tpv como activa
USE tpv;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL COMMENT 'Clave primaria',
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(9) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `color`) VALUES
(2, 'Congelados', 'Productos de alimentación que se distribuyen en formato congelado.', '#ffff00'),
(4, 'Desayuno', 'Productos directamente relacionados con el desayuno', '#808000'),
(5, 'Higiene personal', 'Productos de higiene personal', '#ff80ff'),
(6, 'Bebidas', 'Bebidas no alcohólicas', '#408080'),
(7, 'Alimentos', 'Productos alimenticios en general.', '#8080ff'),
(8, 'Frescos', 'Productos no procesados y con caducidad reducida.', '#ff8040'),
(9, 'Belleza', 'Productos relacionados con el cuidado de la estética.', '#2c9492'),
(10, 'Parafarmacia', 'Productos que suele comercializarse en farmacias pero que no son medicamentos.', '#84cc33'),
(11, 'Limpieza', 'Productos para la limpieza de superficies en general.', '#cce3ff'),
(12, 'Textil', 'Productos textiles para vestir o de uso como complemento.', '#e9d085'),
(13, 'Mercería', 'Productos para la reparación de textiles', '#956b60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modo_pago`
--

CREATE TABLE `modo_pago` (
  `id` int NOT NULL COMMENT 'Clave Primaria',
  `codigo` varchar(3) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Abreviatura del método de pago',
  `nombre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre del método del pago',
  `disponible` tinyint(1) DEFAULT NULL COMMENT 'Si está disponible es método'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modo_pago`
--

INSERT INTO `modo_pago` (`id`, `codigo`, `nombre`, `disponible`) VALUES
(1, 'EF', 'Efectivo', 1),
(2, 'TJ', 'Tarjeta', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL COMMENT 'Clave Primaria',
  `codigo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` int NOT NULL COMMENT 'FK id categoria',
  `precioBruto` double DEFAULT NULL,
  `iva` int NOT NULL COMMENT 'FK id tipos_iva',
  `precioUlCom` double UNSIGNED DEFAULT NULL COMMENT 'Precio de última compra',
  `imagenProd` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Nombre del archivo la imagen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `categoria`, `precioBruto`, `iva`, `precioUlCom`, `imagenProd`) VALUES
(4, 'ALI00001', 'Aceite de oliva 0,4º CARBONELL, botella 1 litro', 'Aceite de Oliva Virgen Refinado (0,04º) botella 1 litro (Original).', 7, 11.48, 1, 9.85, '4_ImgProducto.jpg'),
(5, 'FRE00001', 'Huevo campero Natur, cartón 6 uds', 'Huevo campero País Vasco M/L EROSKI Natur, cartón 6 uds', 8, 1.41, 1, 1.12, '5_ImgProducto.jpg'),
(6, 'HIG00001', 'Gel de afeitar GILLETTE, spray 200 ml', 'Crema de afeitar en gel GILLETTE Spray 200ml', 5, 3.18, 1, 2.54, '6_ImgProducto.jpg'),
(7, 'HIG00002', 'Gel de ducha SANEX, 600 ml', 'Gel de ducha cuidado SANEX, bote 600 ml.', 5, 3.22, 1, 2.36, '7_ImgProducto.jpg'),
(8, 'HIG00003', 'Gel de ducha classic MAGNO, 800 ml', 'Gel de ducha classic MAGNO, bote 800 ml.', 5, 3.79, 1, 3.12, '8_ImgProducto.jpg'),
(9, 'BEB00001', 'Agua mineral LANJARON, botella 1,5L', 'Agua mineral LANJARON, botella 1,5 litros.', 6, 0.6, 3, 0.48, '9_ImgProducto.jpg'),
(10, 'BEB00002', 'Agua mineral BEZOYA, ecobox 8L', 'Agua mineral natural BEZOYA, ecobox 8 litros', 6, 2.87, 3, 2.31, '10_ImgProducto.jpg'),
(11, 'BEB00003', 'Refresco COCA COLA, lata 33 cl', 'Refresco de cola COCA COLA, lata 33 cl', 6, 0.74, 1, 0.58, '11_ImgProducto.jpg'),
(12, 'BEB00004', 'Refresco FANTA naranja Zero, lata 33 cl', 'Refresco de naranja FANTA Zero, lata 33 cl', 6, 0.62, 1, 0.38, '12_ImgProducto.jpg'),
(13, 'BEB00005', 'Bebida AQUARIUS limón, lata 33 cl', 'Bebida isotónica sabor limón AQUARIUS, lata 33 cl', 6, 0.74, 1, 0.52, '13_ImgProducto.jpg'),
(14, 'DES00001', 'Cacao soluble COLA CAO, bote 760 g', 'Cacao soluble COLA CAO, bote 760 g', 4, 5.36, 1, 4.89, '14_ImgProducto.jpg'),
(15, 'DES00002', 'Cereales KELLOGG`S Corn Flakes, caja 500 g', 'Cereales de maíz KELLOGG`S Corn Flakes, caja 500 g', 4, 2.48, 1, 2.15, '15_ImgProducto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prod_ticket`
--

CREATE TABLE `prod_ticket` (
  `id` int NOT NULL COMMENT 'Clave Primaria',
  `ticket` int NOT NULL COMMENT 'FK id tickets',
  `producto` int NOT NULL COMMENT 'FK id productos',
  `cantidad` double DEFAULT NULL COMMENT 'Cantidad de producto vendido',
  `descX100` double DEFAULT NULL COMMENT 'Descuento según porcentaje',
  `descVal` double DEFAULT NULL COMMENT 'Descuento según valor directo',
  `precio` double DEFAULT NULL COMMENT 'Precio unidad producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prod_ticket`
--

INSERT INTO `prod_ticket` (`id`, `ticket`, `producto`, `cantidad`, `descX100`, `descVal`, `precio`) VALUES
(1, 6, 5, 2, 0, 0, 1.7061),
(2, 6, 4, 1, 0, 0, 13.8908),
(3, 6, 11, 1, 0, 0, 0.8954),
(4, 7, 15, 1, 0, 0, 3.0008),
(5, 7, 4, 1, 0, 0, 13.8908),
(6, 7, 11, 2, 0, 0, 0.8954),
(7, 7, 8, 1, 0, 0, 4.5859);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL COMMENT 'Clave Primaria',
  `fecha` datetime NOT NULL COMMENT 'Fecha de emisión del ticket',
  `tienda` int NOT NULL COMMENT 'FK id tienda',
  `vendedor` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` int NOT NULL COMMENT 'FK id tipo_movimiento',
  `entregado` double UNSIGNED DEFAULT NULL COMMENT 'Importe entregado',
  `modoPago` int NOT NULL COMMENT 'FK id modo_pago'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `fecha`, `tienda`, `vendedor`, `tipo`, `entregado`, `modoPago`) VALUES
(1, '2024-10-03 13:10:57', 1, 'Caja 1', 3, 10, 1),
(2, '2024-10-03 13:10:47', 1, 'Caja 1', 3, 10, 1),
(3, '2024-10-03 17:10:31', 1, 'Caja 1', 3, 20, 1),
(4, '2024-10-03 17:10:47', 1, 'Caja 1', 3, 20, 1),
(5, '2024-10-03 17:10:15', 1, 'Caja 1', 3, 20, 1),
(6, '2024-10-03 17:10:29', 1, 'Caja 1', 3, 20, 1),
(7, '2024-10-03 17:10:08', 1, 'Caja 1', 3, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` int NOT NULL COMMENT 'Clave primaria',
  `cif_nif` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_Fis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre Fiscal',
  `nombre_Com` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre Comercial',
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cp` varchar(5) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Código Postal',
  `provincia` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `logoTienda` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre del archivo',
  `logoTicket` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre del archivo',
  `telef` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `movil` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `cif_nif`, `nombre_Fis`, `nombre_Com`, `direccion`, `poblacion`, `cp`, `provincia`, `logoTienda`, `logoTicket`, `telef`, `movil`, `email`) VALUES
(1, '12345678Z', 'Tiend-On', 'Tiendon', 'Bo. Venta, 18', 'Compro Vendo', '12345', 'Lo tengo todo', '1_LogoTienda.png', '1_LogoTicket.png', '55523456', '55512345', 'contacto@tiendon.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_iva`
--

CREATE TABLE `tipos_iva` (
  `id` int NOT NULL COMMENT 'Clave primaria',
  `tipo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `valor_IVA` int UNSIGNED DEFAULT NULL COMMENT 'Valor correspondiente al tipo de IVA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_iva`
--

INSERT INTO `tipos_iva` (`id`, `tipo`, `valor_IVA`) VALUES
(1, 'Tipo General', 21),
(2, 'Tipo recucido 1', 10),
(3, 'Tipo recucido 2', 4),
(4, 'Tipo recucido 3', 5),
(5, 'Tipo recucido 4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id` int NOT NULL COMMENT 'Clave Primaria',
  `codigo` varchar(3) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Abreviatura del tipo (E, AP, S, CI, AR)',
  `nombre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre del tiipo com Entrada, etc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id`, `codigo`, `nombre`) VALUES
(1, 'AP', 'Apertura'),
(2, 'CI', 'Cierre'),
(3, 'E', 'Entrada'),
(4, 'S', 'Salida'),
(5, 'AR', 'Arqueo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modo_pago`
--
ALTER TABLE `modo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_ibfk_1` (`categoria`),
  ADD KEY `productos_ibfk_2` (`iva`);

--
-- Indices de la tabla `prod_ticket`
--
ALTER TABLE `prod_ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket` (`ticket`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda` (`tienda`),
  ADD KEY `tipo` (`tipo`),
  ADD KEY `modoPago` (`modoPago`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_iva`
--
ALTER TABLE `tipos_iva`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modo_pago`
--
ALTER TABLE `modo_pago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave Primaria', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave Primaria', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `prod_ticket`
--
ALTER TABLE `prod_ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave Primaria', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave Primaria', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipos_iva`
--
ALTER TABLE `tipos_iva`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Clave Primaria', AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`iva`) REFERENCES `tipos_iva` (`id`);

--
-- Filtros para la tabla `prod_ticket`
--
ALTER TABLE `prod_ticket`
  ADD CONSTRAINT `prod_ticket_ibfk_1` FOREIGN KEY (`ticket`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_ticket_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`tienda`) REFERENCES `tienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipo_movimiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`modoPago`) REFERENCES `modo_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
