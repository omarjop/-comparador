CREATE TABLE Caracteristica (
  idCaracteristica INT(10) NOT NULL AUTO_INCREMENT,
  Producto_idProducto INT(10) NOT NULL,
  Alto FLOAT(3) NULL,
  Ancho FLOAT(3) NULL,
  Fondo FLOAT(3) NULL,
  Capacidad FLOAT(3) NULL,
  Color VARCHAR(20) NULL,
  Voltaje FLOAT(3) NULL,
  Modelo VARCHAR(20) NULL,
  PRIMARY KEY(idCaracteristica),
  INDEX Caracteristica_FKIndex1(Producto_idProducto)
);

CREATE TABLE Categoria (
  idCategoria INT(10) NOT NULL AUTO_INCREMENT,
  Descripcion VARCHAR(30) NOT NULL,
  control INT(1) NOT NULL,
  PRIMARY KEY(idCategoria)
);

CREATE TABLE ciudad (
  idciudad INT(10) NOT NULL AUTO_INCREMENT,
  pais_idpais INT(10) NOT NULL,
  nombreCiudad VARCHAR(20) NULL,
  PRIMARY KEY(idciudad),
  INDEX ciudad_FKIndex1(pais_idpais)
);

CREATE TABLE Devolucion (
  idDevolucion INT(10) NOT NULL AUTO_INCREMENT,
  Factura_idFactura INT(10) NOT NULL,
  Canidad_producto INT(3) NOT NULL,
  Precio_producto FLOAT(10) NOT NULL,
  Fecha_devolucion  DATE NOT NULL,
  CambioDevolucion VARCHAR(10) NOT NULL,
  PRIMARY KEY(idDevolucion),
  INDEX Devolucion_FKIndex1(Factura_idFactura)
);

CREATE TABLE Dia (
  idDia INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Descripcion INTEGER UNSIGNED NULL,
  PRIMARY KEY(idDia)
);

CREATE TABLE Empresa (
  idEmpresa INT(10) NOT NULL AUTO_INCREMENT,
  Usuario_idUsuario INT(10) NOT NULL,
  Categoria_idCategoria INT(10) NOT NULL,
  Nombre_empresa VARCHAR(100) NOT NULL,
  Direccion VARCHAR(100) NOT NULL,
  telefono INT(10) NOT NULL,
  Descripcion VARCHAR(200) NOT NULL,
  Logo_ruta VARCHAR(100) NULL,
  Nit_tienda VARCHAR(15) NULL,
  Correo INTEGER UNSIGNED NULL,
  PRIMARY KEY(idEmpresa),
  INDEX Empresa_FKIndex1(Categoria_idCategoria),
  INDEX Empresa_FKIndex2(Usuario_idUsuario)
);

CREATE TABLE Empresa_has_Horario (
  Empresa_idEmpresa INT(10) NOT NULL,
  Horario_idHorario INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Empresa_idEmpresa, Horario_idHorario),
  INDEX Empresa_has_Horario_FKIndex1(Empresa_idEmpresa),
  INDEX Empresa_has_Horario_FKIndex2(Horario_idHorario)
);

CREATE TABLE Factura (
  idFactura INT(10) NOT NULL AUTO_INCREMENT,
  Tipo_pago_idTipo_pago INT(10) NOT NULL,
  Programacion_idProgramacion INT(10) NOT NULL,
  Persona_idPersona INT(10) NOT NULL,
  MontoTotal FLOAT(10) NOT NULL,
  PRIMARY KEY(idFactura),
  INDEX Detalle_compra_FKIndex3(Persona_idPersona),
  INDEX Detalle_compra_FKIndex2(Programacion_idProgramacion),
  INDEX Factura_FKIndex3(Tipo_pago_idTipo_pago)
);

CREATE TABLE fotos (
  idfotos INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  publicidad_idpublicidad INT(10) NOT NULL,
  Producto_idProducto INT(10) NOT NULL,
  ruta_img VARCHAR(100) NULL,
  Descripcion VARCHAR(100) NULL,
  PRIMARY KEY(idfotos),
  INDEX fotos_FKIndex1(Producto_idProducto),
  INDEX fotos_FKIndex2(publicidad_idpublicidad)
);

CREATE TABLE Horario (
  idHorario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Dia_idDia INTEGER UNSIGNED NOT NULL,
  hora_ini_up TIME NULL,
  hora_fin_up TIME NULL,
  Hora_ini_down TIME NULL,
  Hora_fin_down DATE NULL,
  Horario_corrido INTEGER UNSIGNED NULL,
  PRIMARY KEY(idHorario),
  INDEX Horario_FKIndex1(Dia_idDia)
);

CREATE TABLE ListaCompra (
  idListaCompra INT(10) NOT NULL AUTO_INCREMENT,
  Persona_idPersona INT(10) NOT NULL,
  Nombre_lista VARCHAR(100) NOT NULL,
  PRIMARY KEY(idListaCompra),
  INDEX ListaCompra_FKIndex1(Persona_idPersona)
);

CREATE TABLE listaSugerida (
  idlistaSugerida INT(10) NOT NULL AUTO_INCREMENT,
  Categoria_idCategoria INT(10) NOT NULL,
  Persona_idPersona INT(10) NOT NULL,
  nombreLista VARCHAR(50) NULL,
  PRIMARY KEY(idlistaSugerida),
  INDEX listaSugerida_FKIndex1(Persona_idPersona),
  INDEX listaSugerida_FKIndex2(Categoria_idCategoria)
);

CREATE TABLE Marca (
  idMarca INT(10) NOT NULL AUTO_INCREMENT,
  Descripcion VARCHAR(20) NOT NULL,
  PRIMARY KEY(idMarca)
);

CREATE TABLE Menu (
  idMenu INT(10) NOT NULL AUTO_INCREMENT,
  Perfil_idPerfil INT(10) NOT NULL,
  Nombre_Menu VARCHAR(20) NOT NULL,
  PRIMARY KEY(idMenu),
  INDEX Menu_FKIndex1(Perfil_idPerfil)
);

CREATE TABLE Menu_item (
  idMenu_item INT(10) NOT NULL AUTO_INCREMENT,
  Menu_idMenu INT(10) NOT NULL,
  Nombre_item VARCHAR(20) NOT NULL,
  Url VARCHAR(100) NOT NULL,
  PRIMARY KEY(idMenu_item),
  INDEX Menu_item_FKIndex1(Menu_idMenu)
);

CREATE TABLE pais (
  idpais INT(10) NOT NULL AUTO_INCREMENT,
  nombrePais VARCHAR(20) NULL,
  PRIMARY KEY(idpais)
);

CREATE TABLE Perfil (
  idPerfil INT(10) NOT NULL AUTO_INCREMENT,
  Descripcion VARCHAR(50) NOT NULL,
  PRIMARY KEY(idPerfil)
);

CREATE TABLE Persona (
  idPersona INT(10) NOT NULL AUTO_INCREMENT,
  ciudad_idciudad INT(10) NOT NULL,
  Usuario_idUsuario INT(10) NOT NULL,
  Nombres VARCHAR(50) NOT NULL,
  Apellidos VARCHAR(50) NOT NULL,
  NumeroTelefono INT(10) NULL,
  sexo INTEGER UNSIGNED NULL,
  direccion VARCHAR(100) NULL,
  PRIMARY KEY(idPersona),
  INDEX Persona_FKIndex1(Usuario_idUsuario),
  INDEX Persona_FKIndex2(ciudad_idciudad)
);

CREATE TABLE Persona_has_Producto_has_ListaCompra (
  Persona_idPersona INT(10) NOT NULL,
  Producto_has_ListaCompra_ListaCompra_idListaCompra INT(10) NOT NULL,
  Producto_has_ListaCompra_Producto_idProducto INT(10) NOT NULL,
  PRIMARY KEY(Persona_idPersona, Producto_has_ListaCompra_ListaCompra_idListaCompra, Producto_has_ListaCompra_Producto_idProducto),
  INDEX Persona_has_Producto_has_ListaCompra_FKIndex1(Persona_idPersona),
  INDEX Persona_has_Producto_has_ListaCompra_FKIndex2(Producto_has_ListaCompra_Producto_idProducto, Producto_has_ListaCompra_ListaCompra_idListaCompra)
);

CREATE TABLE Producto (
  idProducto INT(10) NOT NULL AUTO_INCREMENT,
  subCategoria_idsubCategoria INT(10) NOT NULL,
  Marca_idMarca INT(10) NOT NULL,
  Nombre VARCHAR(50) NOT NULL,
  Referencia VARCHAR(20) NOT NULL,
  Descripcion VARCHAR(300) NOT NULL,
  FotoPrincipal VARCHAR(100) NOT NULL,
  pesoVolumen FLOAT NULL,
  unidadMedida VARCHAR(20) NULL,
  PRIMARY KEY(idProducto),
  INDEX Producto_FKIndex1(Marca_idMarca),
  INDEX Producto_FKIndex2(subCategoria_idsubCategoria)
);

CREATE TABLE Producto_has_Empresa (
  Producto_idProducto INT(10) NOT NULL,
  Empresa_idEmpresa INT(10) NOT NULL,
  precioReal FLOAT NULL,
  stock INT(10) NULL,
  PRIMARY KEY(Producto_idProducto, Empresa_idEmpresa),
  INDEX Producto_has_Empresa_FKIndex1(Producto_idProducto),
  INDEX Producto_has_Empresa_FKIndex2(Empresa_idEmpresa)
);

CREATE TABLE Producto_has_ListaCompra (
  Producto_idProducto INT(10) NOT NULL,
  ListaCompra_idListaCompra INT(10) NOT NULL,
  Cantidad INT(3) NOT NULL,
  PRIMARY KEY(Producto_idProducto, ListaCompra_idListaCompra),
  INDEX Producto_has_ListaCompra_FKIndex1(Producto_idProducto),
  INDEX Producto_has_ListaCompra_FKIndex2(ListaCompra_idListaCompra)
);

CREATE TABLE Producto_has_listaSugerida (
  Producto_idProducto INT(10) NOT NULL,
  listaSugerida_idlistaSugerida INT(10) NOT NULL,
  cantidad FLOAT(5) NULL,
  PRIMARY KEY(Producto_idProducto, listaSugerida_idlistaSugerida),
  INDEX Producto_has_listaSugerida_FKIndex1(Producto_idProducto),
  INDEX Producto_has_listaSugerida_FKIndex2(listaSugerida_idlistaSugerida)
);

CREATE TABLE Programacion (
  idProgramacion INT(10) NOT NULL AUTO_INCREMENT,
  ListaCompra_idListaCompra INT(10) NOT NULL,
  Fecha_Hora_envio DATETIME NOT NULL,
  Direccion VARCHAR(50) NOT NULL,
  Drescripcion VARCHAR(200) NULL,
  PRIMARY KEY(idProgramacion),
  INDEX Programada_FKIndex1(ListaCompra_idListaCompra)
);

CREATE TABLE Promocion (
  idPromocion INT NOT NULL AUTO_INCREMENT,
  Producto_has_Empresa_Empresa_idEmpresa INT(10) NOT NULL,
  Producto_has_Empresa_Producto_idProducto INT(10) NOT NULL,
  fechaInicio DATE NULL,
  fechaFin DATE NULL,
  PrecioPromo FLOAT NULL,
  PRIMARY KEY(idPromocion),
  INDEX Promocion_FKIndex1(Producto_has_Empresa_Producto_idProducto, Producto_has_Empresa_Empresa_idEmpresa)
);

CREATE TABLE publicidad (
  idpublicidad INT(10) NOT NULL AUTO_INCREMENT,
  Empresa_idEmpresa INT(10) NOT NULL,
  imagem VARCHAR(50) NULL,
  Descripcion VARCHAR(50) NULL,
  PRIMARY KEY(idpublicidad),
  INDEX publicidad_FKIndex1(Empresa_idEmpresa)
);

CREATE TABLE subCategoria (
  idsubCategoria INT(10) NOT NULL AUTO_INCREMENT,
  Categoria_idCategoria INT(10) NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  PRIMARY KEY(idsubCategoria),
  INDEX subCategoria_FKIndex1(Categoria_idCategoria)
);

CREATE TABLE Tipo_pago (
  idTipo_pago INT(10) NOT NULL AUTO_INCREMENT,
  Tipo_pago VARCHAR(20) NOT NULL,
  Descripcion_pago VARCHAR(30) NOT NULL,
  PRIMARY KEY(idTipo_pago)
);

CREATE TABLE Usuario (
  idUsuario INT(10) NOT NULL AUTO_INCREMENT,
  Perfil_idPerfil INT(10) NOT NULL,
  correo VARCHAR(40) NOT NULL,
  Clave VARCHAR(20) NOT NULL,
  verificar INT(2) NULL,
  modoAcceso VARCHAR(20) NULL,
  fechaRegistro TIME NULL,
  PRIMARY KEY(idUsuario),
  INDEX Usuario_FKIndex1(Perfil_idPerfil)
);


