-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2020 a las 23:21:49
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comparador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristica`
--

CREATE TABLE `caracteristica` (
  `idCaracteristica` int(10) NOT NULL,
  `Producto_idProducto` int(10) NOT NULL,
  `Alto` float DEFAULT NULL,
  `Ancho` float DEFAULT NULL,
  `Fondo` float DEFAULT NULL,
  `Capacidad` float DEFAULT NULL,
  `Color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Voltaje` float DEFAULT NULL,
  `Modelo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(10) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `control` int(1) NOT NULL,
  `ruta` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `control`, `ruta`) VALUES
(1, 'Supermercado', 1, 'supermercado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idciudad` int(10) NOT NULL,
  `pais_idpais` int(10) NOT NULL,
  `nombreCiudad` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `idDevolucion` int(10) NOT NULL,
  `Factura_idFactura` int(10) NOT NULL,
  `Canidad_producto` int(3) NOT NULL,
  `Precio_producto` float NOT NULL,
  `Fecha_devolucion` date NOT NULL,
  `CambioDevolucion` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `idDia` int(10) UNSIGNED NOT NULL,
  `Descripcion` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(10) NOT NULL,
  `Usuario_idUsuario` int(10) NOT NULL,
  `Categoria_idCategoria` int(10) NOT NULL,
  `Nombre_empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `Descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Logo_ruta` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nit_tienda` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Correo` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_has_horario`
--

CREATE TABLE `empresa_has_horario` (
  `Empresa_idEmpresa` int(10) NOT NULL,
  `Horario_idHorario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(10) NOT NULL,
  `Tipo_pago_idTipo_pago` int(10) NOT NULL,
  `Programacion_idProgramacion` int(10) NOT NULL,
  `Persona_idPersona` int(10) NOT NULL,
  `MontoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idfotos` int(10) UNSIGNED NOT NULL,
  `publicidad_idpublicidad` int(10) NOT NULL,
  `Producto_idProducto` int(10) NOT NULL,
  `ruta_img` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(10) UNSIGNED NOT NULL,
  `Dia_idDia` int(10) UNSIGNED NOT NULL,
  `hora_ini_up` time DEFAULT NULL,
  `hora_fin_up` time DEFAULT NULL,
  `Hora_ini_down` time DEFAULT NULL,
  `Hora_fin_down` date DEFAULT NULL,
  `Horario_corrido` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacompra`
--

CREATE TABLE `listacompra` (
  `idListaCompra` int(10) NOT NULL,
  `Persona_idPersona` int(10) NOT NULL,
  `Nombre_lista` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listasugerida`
--

CREATE TABLE `listasugerida` (
  `idlistaSugerida` int(10) NOT NULL,
  `Categoria_idCategoria` int(10) NOT NULL,
  `Persona_idPersona` int(10) NOT NULL,
  `nombreLista` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(10) NOT NULL,
  `Descripcion` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(10) NOT NULL,
  `Perfil_idPerfil` int(10) NOT NULL,
  `Nombre_Menu` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_item`
--

CREATE TABLE `menu_item` (
  `idMenu_item` int(10) NOT NULL,
  `Menu_idMenu` int(10) NOT NULL,
  `Nombre_item` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Url` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idpais` int(10) NOT NULL,
  `nombrePais` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idPerfil` int(10) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(10) NOT NULL,
  `ciudad_idciudad` int(10) NOT NULL,
  `Usuario_idUsuario` int(10) NOT NULL,
  `Nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `NumeroTelefono` int(10) DEFAULT NULL,
  `sexo` int(10) UNSIGNED DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_has_producto_has_listacompra`
--

CREATE TABLE `persona_has_producto_has_listacompra` (
  `Persona_idPersona` int(10) NOT NULL,
  `Producto_has_ListaCompra_ListaCompra_idListaCompra` int(10) NOT NULL,
  `Producto_has_ListaCompra_Producto_idProducto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(10) NOT NULL,
  `subCategoria_idsubCategoria` int(10) NOT NULL,
  `Marca_idMarca` int(10) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Referencia` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `FotoPrincipal` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pesoVolumen` float DEFAULT NULL,
  `unidadMedida` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_empresa`
--

CREATE TABLE `producto_has_empresa` (
  `Producto_idProducto` int(10) NOT NULL,
  `Empresa_idEmpresa` int(10) NOT NULL,
  `precioReal` float DEFAULT NULL,
  `stock` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_listacompra`
--

CREATE TABLE `producto_has_listacompra` (
  `Producto_idProducto` int(10) NOT NULL,
  `ListaCompra_idListaCompra` int(10) NOT NULL,
  `Cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_listasugerida`
--

CREATE TABLE `producto_has_listasugerida` (
  `Producto_idProducto` int(10) NOT NULL,
  `listaSugerida_idlistaSugerida` int(10) NOT NULL,
  `cantidad` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `idProgramacion` int(10) NOT NULL,
  `ListaCompra_idListaCompra` int(10) NOT NULL,
  `Fecha_Hora_envio` datetime NOT NULL,
  `Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Drescripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `idPromocion` int(11) NOT NULL,
  `Producto_has_Empresa_Empresa_idEmpresa` int(10) NOT NULL,
  `Producto_has_Empresa_Producto_idProducto` int(10) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `PrecioPromo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `idpublicidad` int(10) NOT NULL,
  `Empresa_idEmpresa` int(10) NOT NULL,
  `imagem` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idsubCategoria` int(10) NOT NULL,
  `Categoria_idCategoria` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `idTipo_pago` int(10) NOT NULL,
  `Tipo_pago` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion_pago` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(10) NOT NULL,
  `Perfil_idPerfil` int(10) NOT NULL,
  `correo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `verificar` int(2) DEFAULT NULL,
  `modoAcceso` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaRegistro` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`idCaracteristica`),
  ADD KEY `Caracteristica_FKIndex1` (`Producto_idProducto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idciudad`),
  ADD KEY `ciudad_FKIndex1` (`pais_idpais`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`idDevolucion`),
  ADD KEY `Devolucion_FKIndex1` (`Factura_idFactura`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`idDia`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`),
  ADD KEY `Empresa_FKIndex1` (`Categoria_idCategoria`),
  ADD KEY `Empresa_FKIndex2` (`Usuario_idUsuario`);

--
-- Indices de la tabla `empresa_has_horario`
--
ALTER TABLE `empresa_has_horario`
  ADD PRIMARY KEY (`Empresa_idEmpresa`,`Horario_idHorario`),
  ADD KEY `Empresa_has_Horario_FKIndex1` (`Empresa_idEmpresa`),
  ADD KEY `Empresa_has_Horario_FKIndex2` (`Horario_idHorario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `Detalle_compra_FKIndex3` (`Persona_idPersona`),
  ADD KEY `Detalle_compra_FKIndex2` (`Programacion_idProgramacion`),
  ADD KEY `Factura_FKIndex3` (`Tipo_pago_idTipo_pago`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idfotos`),
  ADD KEY `fotos_FKIndex1` (`Producto_idProducto`),
  ADD KEY `fotos_FKIndex2` (`publicidad_idpublicidad`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `Horario_FKIndex1` (`Dia_idDia`);

--
-- Indices de la tabla `listacompra`
--
ALTER TABLE `listacompra`
  ADD PRIMARY KEY (`idListaCompra`),
  ADD KEY `ListaCompra_FKIndex1` (`Persona_idPersona`);

--
-- Indices de la tabla `listasugerida`
--
ALTER TABLE `listasugerida`
  ADD PRIMARY KEY (`idlistaSugerida`),
  ADD KEY `listaSugerida_FKIndex1` (`Persona_idPersona`),
  ADD KEY `listaSugerida_FKIndex2` (`Categoria_idCategoria`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`),
  ADD KEY `Menu_FKIndex1` (`Perfil_idPerfil`);

--
-- Indices de la tabla `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`idMenu_item`),
  ADD KEY `Menu_item_FKIndex1` (`Menu_idMenu`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idpais`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idPerfil`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `Persona_FKIndex1` (`Usuario_idUsuario`),
  ADD KEY `Persona_FKIndex2` (`ciudad_idciudad`);

--
-- Indices de la tabla `persona_has_producto_has_listacompra`
--
ALTER TABLE `persona_has_producto_has_listacompra`
  ADD PRIMARY KEY (`Persona_idPersona`,`Producto_has_ListaCompra_ListaCompra_idListaCompra`,`Producto_has_ListaCompra_Producto_idProducto`),
  ADD KEY `Persona_has_Producto_has_ListaCompra_FKIndex1` (`Persona_idPersona`),
  ADD KEY `Persona_has_Producto_has_ListaCompra_FKIndex2` (`Producto_has_ListaCompra_Producto_idProducto`,`Producto_has_ListaCompra_ListaCompra_idListaCompra`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `Producto_FKIndex1` (`Marca_idMarca`),
  ADD KEY `Producto_FKIndex2` (`subCategoria_idsubCategoria`);

--
-- Indices de la tabla `producto_has_empresa`
--
ALTER TABLE `producto_has_empresa`
  ADD PRIMARY KEY (`Producto_idProducto`,`Empresa_idEmpresa`),
  ADD KEY `Producto_has_Empresa_FKIndex1` (`Producto_idProducto`),
  ADD KEY `Producto_has_Empresa_FKIndex2` (`Empresa_idEmpresa`);

--
-- Indices de la tabla `producto_has_listacompra`
--
ALTER TABLE `producto_has_listacompra`
  ADD PRIMARY KEY (`Producto_idProducto`,`ListaCompra_idListaCompra`),
  ADD KEY `Producto_has_ListaCompra_FKIndex1` (`Producto_idProducto`),
  ADD KEY `Producto_has_ListaCompra_FKIndex2` (`ListaCompra_idListaCompra`);

--
-- Indices de la tabla `producto_has_listasugerida`
--
ALTER TABLE `producto_has_listasugerida`
  ADD PRIMARY KEY (`Producto_idProducto`,`listaSugerida_idlistaSugerida`),
  ADD KEY `Producto_has_listaSugerida_FKIndex1` (`Producto_idProducto`),
  ADD KEY `Producto_has_listaSugerida_FKIndex2` (`listaSugerida_idlistaSugerida`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`idProgramacion`),
  ADD KEY `Programada_FKIndex1` (`ListaCompra_idListaCompra`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`idPromocion`),
  ADD KEY `Promocion_FKIndex1` (`Producto_has_Empresa_Producto_idProducto`,`Producto_has_Empresa_Empresa_idEmpresa`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`idpublicidad`),
  ADD KEY `publicidad_FKIndex1` (`Empresa_idEmpresa`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idsubCategoria`),
  ADD KEY `subCategoria_FKIndex1` (`Categoria_idCategoria`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`idTipo_pago`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `Usuario_FKIndex1` (`Perfil_idPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `idCaracteristica` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idciudad` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `idDevolucion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `idDia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idfotos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `listacompra`
--
ALTER TABLE `listacompra`
  MODIFY `idListaCompra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `listasugerida`
--
ALTER TABLE `listasugerida`
  MODIFY `idlistaSugerida` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `idMenu_item` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idpais` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `idProgramacion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `idPromocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `idpublicidad` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idsubCategoria` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `idTipo_pago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
