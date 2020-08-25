
/*Categoria y sub categoria*/
INSERT INTO `categoria` (`idCategoria`, `Descripcion`, `control`) VALUES (NULL, 'Super mercado', '1');
INSERT INTO `subcategoria` (`idsubCategoria`, `Categoria_idCategoria`, `nombre`) VALUES (NULL, '1', 'Despensa'), (NULL, '1', 'Bebidas'), (NULL, '1', 'Vinos y Licores'), (NULL, '1', 'Pollo, carnes y pescado'), (NULL, '1', 'Pasabocas y dulces'), (NULL, '1', 'Lacteos, huevos y refrigerados'), (NULL, '1', 'Limpieza del hogar'), (NULL, '1', 'Salud y belleza'), (NULL, '1', 'Mascotas'), (NULL, '1', 'Hogar'), (NULL, '1', 'Otros');

UPDATE `subcategoria` SET `ruta` = 'Despensa' WHERE `subcategoria`.`idsubCategoria` = 9; UPDATE `subcategoria` SET `ruta` = 'Bebidas' WHERE `subcategoria`.`idsubCategoria` = 10; UPDATE `subcategoria` SET `ruta` = 'Vinos y Licores' WHERE `subcategoria`.`idsubCategoria` = 11; UPDATE `subcategoria` SET `ruta` = 'Pollo, carnes y pescado' WHERE `subcategoria`.`idsubCategoria` = 12; UPDATE `subcategoria` SET `ruta` = 'Pasabocas y dulces' WHERE `subcategoria`.`idsubCategoria` = 13; UPDATE `subcategoria` SET `ruta` = 'Lacteos, huevos y refrigerados' WHERE `subcategoria`.`idsubCategoria` = 14; UPDATE `subcategoria` SET `ruta` = 'Limpieza del hogar' WHERE `subcategoria`.`idsubCategoria` = 15; UPDATE `subcategoria` SET `ruta` = 'Salud y belleza' WHERE `subcategoria`.`idsubCategoria` = 16; UPDATE `subcategoria` SET `ruta` = 'Mascotas' WHERE `subcategoria`.`idsubCategoria` = 17; UPDATE `subcategoria` SET `ruta` = 'Hogar' WHERE `subcategoria`.`idsubCategoria` = 18; UPDATE `subcategoria` SET `ruta` =[...]




/*Alter table*/

ALTER TABLE `unidadmedida` CHANGE `nombreMedida` `nombreMedida` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;