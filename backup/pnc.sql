/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : pnc

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2013-10-03 08:26:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acceso`
-- ----------------------------
DROP TABLE IF EXISTS `acceso`;
CREATE TABLE `acceso` (
  `menu_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`perfil_id`),
  KEY `IDX_1268771BCCD7E912` (`menu_id`),
  KEY `IDX_1268771B57291544` (`perfil_id`),
  CONSTRAINT `FK_1268771B57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1268771BCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of acceso
-- ----------------------------
INSERT INTO `acceso` VALUES ('1', '1');
INSERT INTO `acceso` VALUES ('1', '3');
INSERT INTO `acceso` VALUES ('2', '1');
INSERT INTO `acceso` VALUES ('2', '3');
INSERT INTO `acceso` VALUES ('3', '1');
INSERT INTO `acceso` VALUES ('3', '3');
INSERT INTO `acceso` VALUES ('4', '1');
INSERT INTO `acceso` VALUES ('4', '3');
INSERT INTO `acceso` VALUES ('5', '1');
INSERT INTO `acceso` VALUES ('5', '3');
INSERT INTO `acceso` VALUES ('6', '1');
INSERT INTO `acceso` VALUES ('6', '3');
INSERT INTO `acceso` VALUES ('7', '1');
INSERT INTO `acceso` VALUES ('7', '3');
INSERT INTO `acceso` VALUES ('8', '1');
INSERT INTO `acceso` VALUES ('8', '3');
INSERT INTO `acceso` VALUES ('9', '1');
INSERT INTO `acceso` VALUES ('9', '3');
INSERT INTO `acceso` VALUES ('10', '1');
INSERT INTO `acceso` VALUES ('10', '3');
INSERT INTO `acceso` VALUES ('11', '1');
INSERT INTO `acceso` VALUES ('11', '3');
INSERT INTO `acceso` VALUES ('12', '1');
INSERT INTO `acceso` VALUES ('12', '3');
INSERT INTO `acceso` VALUES ('13', '1');
INSERT INTO `acceso` VALUES ('13', '3');
INSERT INTO `acceso` VALUES ('14', '1');
INSERT INTO `acceso` VALUES ('14', '3');
INSERT INTO `acceso` VALUES ('15', '1');
INSERT INTO `acceso` VALUES ('15', '3');
INSERT INTO `acceso` VALUES ('16', '1');
INSERT INTO `acceso` VALUES ('16', '3');
INSERT INTO `acceso` VALUES ('17', '1');
INSERT INTO `acceso` VALUES ('17', '3');
INSERT INTO `acceso` VALUES ('18', '1');
INSERT INTO `acceso` VALUES ('18', '3');
INSERT INTO `acceso` VALUES ('19', '1');
INSERT INTO `acceso` VALUES ('19', '3');
INSERT INTO `acceso` VALUES ('20', '1');
INSERT INTO `acceso` VALUES ('20', '3');
INSERT INTO `acceso` VALUES ('21', '1');
INSERT INTO `acceso` VALUES ('21', '3');
INSERT INTO `acceso` VALUES ('22', '1');
INSERT INTO `acceso` VALUES ('22', '3');
INSERT INTO `acceso` VALUES ('23', '1');
INSERT INTO `acceso` VALUES ('23', '3');
INSERT INTO `acceso` VALUES ('24', '1');
INSERT INTO `acceso` VALUES ('24', '3');
INSERT INTO `acceso` VALUES ('25', '1');
INSERT INTO `acceso` VALUES ('25', '3');
INSERT INTO `acceso` VALUES ('26', '1');
INSERT INTO `acceso` VALUES ('26', '3');
INSERT INTO `acceso` VALUES ('27', '1');
INSERT INTO `acceso` VALUES ('27', '3');
INSERT INTO `acceso` VALUES ('28', '1');
INSERT INTO `acceso` VALUES ('28', '3');
INSERT INTO `acceso` VALUES ('29', '1');
INSERT INTO `acceso` VALUES ('29', '3');
INSERT INTO `acceso` VALUES ('30', '1');
INSERT INTO `acceso` VALUES ('30', '3');
INSERT INTO `acceso` VALUES ('31', '1');
INSERT INTO `acceso` VALUES ('31', '3');
INSERT INTO `acceso` VALUES ('32', '1');
INSERT INTO `acceso` VALUES ('32', '3');

-- ----------------------------
-- Table structure for `catalogo`
-- ----------------------------
DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE `catalogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codcatalogo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `abreviatura` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalogo
-- ----------------------------
INSERT INTO `catalogo` VALUES ('1', 'TDI', 'DNI', 'DOCUMENTO NACIONAL DE IDENTIDAD', 'DNI', '1', null);
INSERT INTO `catalogo` VALUES ('2', 'TDI', 'RUC', 'RUC', 'RUC', '1', null);
INSERT INTO `catalogo` VALUES ('3', 'TCP', 'Ejecutivo', null, null, '1', null);
INSERT INTO `catalogo` VALUES ('4', 'TCP', 'Representante Legal', null, null, '1', null);
INSERT INTO `catalogo` VALUES ('5', 'TCP', 'Representante Alterno', null, null, '1', null);
INSERT INTO `catalogo` VALUES ('6', 'TIPOCRITERIO', 'Criterio', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('7', 'TIPOCRITERIO', 'Factor/Aspecto Clave', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('8', 'TIPOCRITERIO', 'Temas Clave', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('9', 'TIPOARBOLCRITERIO', 'Criterio', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('10', 'TIPOARBOLCRITERIO', 'Subcriterio', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('11', 'TIPOARBOLCRITERIO', 'Area Analisis', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('12', 'TIPOARBOLCRITERIO', 'Pregunta', null, null, '1', '4');
INSERT INTO `catalogo` VALUES ('13', 'TIPOCONCURSO', 'Premio Nacional a la Calidad', 'PNC', null, '1', '1');
INSERT INTO `catalogo` VALUES ('14', 'TIPOCONCURSO', 'Reconocimiento a la Mejora', 'RM', null, '1', '2');

-- ----------------------------
-- Table structure for `concurso`
-- ----------------------------
DROP TABLE IF EXISTS `concurso`;
CREATE TABLE `concurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreconcurso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `presentacion` longtext COLLATE utf8_unicode_ci,
  `objetivos` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requisitos` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `participantes` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beneficios` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorias` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `premiootorgar` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medallas` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuotaparticipacion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `infocomplementaria` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anio` decimal(10,0) NOT NULL,
  `estado_empresa` tinyint(1) NOT NULL,
  `estado_proyecto` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `termino_aceptacion` longtext COLLATE utf8_unicode_ci,
  `incrementopuntaje` int(11) NOT NULL,
  `evalua_criterio` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `informe_retro` longtext COLLATE utf8_unicode_ci,
  `calificacion` longtext COLLATE utf8_unicode_ci,
  `prefijo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipoconcurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_785F9DE66D82338` (`tipoconcurso_id`),
  CONSTRAINT `FK_785F9DE66D82338` FOREIGN KEY (`tipoconcurso_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concurso
-- ----------------------------
INSERT INTO `concurso` VALUES ('1', 'Premio Nacional a la Calidad 2012 -.-', '2012-12-01', '2013-09-28', '<p>El Premio Nacional a la Calidad del Per&uacute; constituye uno de los esfuerzos m&aacute;s importantes que se realizan para difundir y promover en las empresas la Excelencia en la Gesti&oacute;n en base a la Calidad. Al igual que los Premios Nacionales a la Calidad de otros pa&iacute;ses, est&aacute; orientado hacia la mejora de la competitividad y la econom&iacute;a en el pa&iacute;s.</p>', 'asdasdasd', 'dsad', 'sadasdsa', 'dasdsa', 'dasdas', 'dasd', 'dasdda', 'dasd', 'ads', '2012', '1', '1', '0', 'fsfsdfs', '0', '1', null, null, null, '13');
INSERT INTO `concurso` VALUES ('4', 'registro concurso', '2013-08-07', '2013-08-15', '<p>El Premio Nacional a la Calidad del Per&uacute; constituye uno de los esfuerzos m&aacute;s importantes que se realizan para difundir y promover en las empresas la Excelencia en la Gesti&oacute;n en base a la Calidad. Al igual que los Premios Nacionales a la Calidad de otros pa&iacute;ses, est&aacute; orientado hacia la mejora de la competitividad y la econom&iacute;a en el pa&iacute;s.</p>', null, null, null, null, null, null, null, null, null, '2013', '1', '1', '0', 'f dsfsdfsdf sdf sdfsf sdfs', '1', '1', 'dgdg fdgfg dgdf gdfdf', 'dfg dfgdfg dfgdfgdgfdf', null, '14');
INSERT INTO `concurso` VALUES ('6', 'registro exitoso', '2013-05-04', '2013-07-06', '<p>El Premio Nacional a la Calidad del Per&uacute; constituye uno de los esfuerzos m&aacute;s importantes que se realizan para difundir y promover en las empresas la Excelencia en la Gesti&oacute;n en base a la Calidad. Al igual que los Premios Nacionales a la Calidad de otros pa&iacute;ses, est&aacute; orientado hacia la mejora de la competitividad y la econom&iacute;a en el pa&iacute;s.</p>', null, null, null, null, null, null, null, null, null, '2013', '1', '0', '0', 'ter ac', '2', '1', 'retro', 'calificación', null, '13');
INSERT INTO `concurso` VALUES ('7', 'concurso prueba', '2013-09-06', '2013-09-05', '<p>El Premio Nacional a la Calidad del Per&uacute; constituye uno de los esfuerzos m&aacute;s importantes que se realizan para difundir y promover en las empresas la Excelencia en la Gesti&oacute;n en base a la Calidad. Al igual que los Premios Nacionales a la Calidad de otros pa&iacute;ses, est&aacute; orientado hacia la mejora de la competitividad y la econom&iacute;a en el pa&iacute;s.</p>', null, null, null, null, null, null, null, null, null, '2013', '1', '1', '1', 'fsdfsfs', '32', '1', 'fsdfsd', 'fsdfsdfds', null, '14');
INSERT INTO `concurso` VALUES ('8', 'concurso Premio Nacional a la calidad 2013', '2013-09-06', '2013-09-13', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', null, null, null, null, null, null, null, null, null, '2013', '1', '1', '0', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '43', '1', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', null, '14');
INSERT INTO `concurso` VALUES ('9', 'Premio 2014', '2013-09-01', '2013-09-28', 'fsdfsdf', null, null, null, null, null, null, null, null, null, '2014', '1', '1', '1', 'sdfsdfsd', '3', '1', 'dsfdsfds', 'fsdfsdf', null, '14');

-- ----------------------------
-- Table structure for `concursocriterio`
-- ----------------------------
DROP TABLE IF EXISTS `concursocriterio`;
CREATE TABLE `concursocriterio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipocriterio_id` int(11) DEFAULT NULL,
  `tipoarbol_id` int(11) DEFAULT NULL,
  `idpadre` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `glosa` longtext COLLATE utf8_unicode_ci,
  `comentario` longtext COLLATE utf8_unicode_ci,
  `detalle` longtext COLLATE utf8_unicode_ci,
  `proposito` longtext COLLATE utf8_unicode_ci,
  `nota` longtext COLLATE utf8_unicode_ci,
  `concurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AE7D9CB08B196F76` (`tipocriterio_id`),
  KEY `IDX_AE7D9CB0D38B64C7` (`tipoarbol_id`),
  KEY `IDX_AE7D9CB0F415D168` (`concurso_id`),
  CONSTRAINT `FK_AE7D9CB08B196F76` FOREIGN KEY (`tipocriterio_id`) REFERENCES `catalogo` (`id`),
  CONSTRAINT `FK_AE7D9CB0D38B64C7` FOREIGN KEY (`tipoarbol_id`) REFERENCES `catalogo` (`id`),
  CONSTRAINT `FK_AE7D9CB0F415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concursocriterio
-- ----------------------------
INSERT INTO `concursocriterio` VALUES ('1', '8', '9', '0', '1', 'Liderazgo y Compromiso de la Alta Direcciónxxxx', '0', null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('2', '8', '9', '0', '2', 'Identificación y Selección del Proyecto de Mejora', '0', null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('3', null, '10', '1', '1', 'subcriterio', '0', null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('4', null, '11', '3', '1', 'Area de Analisis', '0', null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('6', null, '11', '3', '2', 'area analisis 2', '0', null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('7', '6', '9', '0', '1', 'ferwefsdfsfsd', '1', 'ffsdfsd', 'fsdfsdfsdfs', null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('9', '6', '9', '0', '3', 'fs fsdfsdf xxxweeee', '32', 'dsdsds', 'dsdsds', null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('10', '6', '9', '0', '2', 'este si', '3', 'dsds', 'dsdsd', null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('16', null, '11', '3', '99', 'area de analisis 3', null, null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('17', null, '12', '16', '55', 'pregunta 1', null, null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('18', null, '12', '16', '23', 'pregunta que no conozco', null, null, null, null, null, null, '1');
INSERT INTO `concursocriterio` VALUES ('19', null, '10', '2', '43', 'wrrw werwerwer', '43', 'rwerwerwer', 'rwer werwe', 'rwrwerw', 'rwe rwerwe', 'rwerwerwe', '1');
INSERT INTO `concursocriterio` VALUES ('20', null, '10', '10', '3', 'sdsad das', '2', 'sa sd ads', 'fsdfs s', 'dasdasd', 'fsdfsdfs f', 'fsdfsf ssf sd', '1');

-- ----------------------------
-- Table structure for `conflictointeresevaluador`
-- ----------------------------
DROP TABLE IF EXISTS `conflictointeresevaluador`;
CREATE TABLE `conflictointeresevaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipovinculointeres_id` int(11) DEFAULT NULL,
  `razonsocial` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ruc` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `fecini` date NOT NULL,
  `fecfin` date NOT NULL,
  `detalle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DA6551054B6324B7` (`tipovinculointeres_id`),
  KEY `IDX_DA65510540815979` (`evaluador_id`),
  CONSTRAINT `FK_DA65510540815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_DA6551054B6324B7` FOREIGN KEY (`tipovinculointeres_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conflictointeresevaluador
-- ----------------------------

-- ----------------------------
-- Table structure for `conversacion`
-- ----------------------------
DROP TABLE IF EXISTS `conversacion`;
CREATE TABLE `conversacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conversacion
-- ----------------------------
INSERT INTO `conversacion` VALUES ('1', 'Grupo 11', 'Juan Perez, Miguel Perez', '0000-00-00 00:00:00', '2013-08-10 19:55:59');
INSERT INTO `conversacion` VALUES ('2', 'Privado', 'Edinson Nuñez', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `conversacion` VALUES ('3', 'Pedro,Miguel', 'Pedro Nuñez, Juan Garcia', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `conversacion` VALUES ('4', 'Grupo 2', 'Edinson,Sebastian,Alvita', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `conversacion` VALUES ('5', 'Grupo 3', 'Edinson, Alvita, Sebas', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `conversacion` VALUES ('8', 'grupo 25', 'Alvita y mi sebas', '2013-08-10 19:55:44', '2013-08-10 20:04:35');
INSERT INTO `conversacion` VALUES ('9', 'administrador', 'juan perez', '2013-08-10 20:50:34', '2013-08-10 20:50:34');

-- ----------------------------
-- Table structure for `evaluador`
-- ----------------------------
DROP TABLE IF EXISTS `evaluador`;
CREATE TABLE `evaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numdoc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `curriculum` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionempresa` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distritoemp` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoemp` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faxemp` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailemp` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profesion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `especializacion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `disponibleviaje` tinyint(1) DEFAULT NULL,
  `disponiblereunion` tinyint(1) DEFAULT NULL,
  `estadotermino` tinyint(1) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `catalogo_tsx_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_692D3B7FDB38439E` (`usuario_id`),
  KEY `IDX_692D3B7FDBC4A9E8` (`catalogo_tsx_id`),
  CONSTRAINT `FK_692D3B7FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_692D3B7FDBC4A9E8` FOREIGN KEY (`catalogo_tsx_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluador
-- ----------------------------

-- ----------------------------
-- Table structure for `evaluadorgrupo`
-- ----------------------------
DROP TABLE IF EXISTS `evaluadorgrupo`;
CREATE TABLE `evaluadorgrupo` (
  `evaluador_id` int(11) NOT NULL,
  `grupoevaluacion_id` int(11) NOT NULL,
  PRIMARY KEY (`evaluador_id`,`grupoevaluacion_id`),
  KEY `IDX_540C963040815979` (`evaluador_id`),
  KEY `IDX_540C9630403D6E35` (`grupoevaluacion_id`),
  CONSTRAINT `FK_540C9630403D6E35` FOREIGN KEY (`grupoevaluacion_id`) REFERENCES `grupoevaluacion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_540C963040815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluadorgrupo
-- ----------------------------

-- ----------------------------
-- Table structure for `grupoevaluacion`
-- ----------------------------
DROP TABLE IF EXISTS `grupoevaluacion`;
CREATE TABLE `grupoevaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacion
-- ----------------------------
INSERT INTO `grupoevaluacion` VALUES ('1', 'grupo 5', 'grupo de evaluacion para coca cola', '1', '2013-08-04 17:16:45', '2013-08-04 17:16:53');
INSERT INTO `grupoevaluacion` VALUES ('2', 'grupo 2', 'grupo de evaluacion para empresa ABC', '1', '2013-08-04 17:31:56', '2013-08-04 17:32:00');

-- ----------------------------
-- Table structure for `inscripcion`
-- ----------------------------
DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreproyecto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecorto` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `integrantes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objetivoproyecto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechainiciopy` date DEFAULT NULL,
  `fechafinpy` date DEFAULT NULL,
  `informepostulacionc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `informepostulacionsic` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terminoaceptacion` int(11) DEFAULT NULL,
  `concurso_id` int(11) DEFAULT NULL,
  `nombreequipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postulante_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_935E99F0F415D168` (`concurso_id`),
  KEY `IDX_935E99F0CCC19F66` (`postulante_id`),
  CONSTRAINT `FK_935E99F0CCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`),
  CONSTRAINT `FK_935E99F0F415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of inscripcion
-- ----------------------------
INSERT INTO `inscripcion` VALUES ('2', 'pruebaaaa', 'fsfsd', 'fsfs f fsfsdfsdf', null, '2013-09-01', '2013-09-26', null, null, null, '8', 'fsdfsd', '1');
INSERT INTO `inscripcion` VALUES ('35', 'proyecto de prueba 1 2 3', 'fsd', 'fsdfsdfsd', null, '2013-09-03', '2013-09-19', null, null, null, '4', 'fsd', '1');

-- ----------------------------
-- Table structure for `mensaje`
-- ----------------------------
DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversacion_id` int(11) DEFAULT NULL,
  `mensaje` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_54DE249DABD5A1D6` (`conversacion_id`),
  CONSTRAINT `FK_54DE249DABD5A1D6` FOREIGN KEY (`conversacion_id`) REFERENCES `conversacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mensaje
-- ----------------------------
INSERT INTO `mensaje` VALUES ('1', '1', 'Hola Mundo', '2013-08-10 20:40:06');
INSERT INTO `mensaje` VALUES ('2', '1', 'como estas tu?', '2013-08-10 20:42:17');
INSERT INTO `mensaje` VALUES ('3', '4', 'que tal edi como estas?', '2013-08-10 23:37:17');
INSERT INTO `mensaje` VALUES ('4', '4', 'yo aqui bien y tu como estas?', '2013-08-10 23:37:38');
INSERT INTO `mensaje` VALUES ('5', '2', 'holaaa :)', '2013-08-10 23:38:58');
INSERT INTO `mensaje` VALUES ('6', '1', 'rwerwerw', '2013-08-11 22:07:54');
INSERT INTO `mensaje` VALUES ('7', '1', 'probando', '2013-08-11 22:08:16');
INSERT INTO `mensaje` VALUES ('8', '1', 'rwerwe', '2013-08-11 22:38:12');
INSERT INTO `mensaje` VALUES ('9', '1', 'XD', '2013-08-11 22:39:23');
INSERT INTO `mensaje` VALUES ('10', '1', 'jejejejejejejeje', '2013-08-11 22:39:32');
INSERT INTO `mensaje` VALUES ('11', '1', ':O', '2013-08-11 22:39:54');
INSERT INTO `mensaje` VALUES ('12', '1', '-.-', '2013-08-11 22:40:00');
INSERT INTO `mensaje` VALUES ('13', '1', '>OOOOOO', '2013-08-11 22:40:07');
INSERT INTO `mensaje` VALUES ('14', '1', 'pronandoooooooooooo', '2013-08-11 22:40:12');
INSERT INTO `mensaje` VALUES ('15', '1', 'algo esta pasando', '2013-08-11 22:42:10');
INSERT INTO `mensaje` VALUES ('16', '2', 'creo que ya funciona', '2013-08-12 01:13:24');
INSERT INTO `mensaje` VALUES ('17', '2', 'jejejejej si si fgunciona', '2013-08-12 01:13:39');
INSERT INTO `mensaje` VALUES ('18', '2', 'digo funciona', '2013-08-12 01:13:42');
INSERT INTO `mensaje` VALUES ('19', '2', 'q tal', '2013-08-12 03:04:41');
INSERT INTO `mensaje` VALUES ('20', '2', 'XD', '2013-08-12 03:05:05');
INSERT INTO `mensaje` VALUES ('21', '2', '>O', '2013-08-12 03:06:53');
INSERT INTO `mensaje` VALUES ('22', '2', 'ok ya funciona esto', '2013-08-12 03:07:05');
INSERT INTO `mensaje` VALUES ('23', '2', 'jejejeje', '2013-08-12 03:07:25');
INSERT INTO `mensaje` VALUES ('24', '2', 'probando', '2013-08-12 03:10:20');
INSERT INTO `mensaje` VALUES ('25', '2', 'se esta colgando es normal o es mi maquina??', '2013-08-12 03:10:47');
INSERT INTO `mensaje` VALUES ('26', '2', 'uhmm no estoy seguro', '2013-08-12 03:11:00');
INSERT INTO `mensaje` VALUES ('27', '4', 'probando', '2013-08-12 03:16:26');
INSERT INTO `mensaje` VALUES ('28', '4', 'XD', '2013-08-12 03:16:40');
INSERT INTO `mensaje` VALUES ('29', '4', 'jajajajaja', '2013-08-12 03:16:47');
INSERT INTO `mensaje` VALUES ('30', '4', 'oeeee', '2013-08-12 03:16:53');
INSERT INTO `mensaje` VALUES ('31', '4', ':D', '2013-08-12 03:17:07');
INSERT INTO `mensaje` VALUES ('32', '4', 'plop', '2013-08-12 03:17:13');
INSERT INTO `mensaje` VALUES ('33', '4', 'uhmmm no carga', '2013-08-12 03:18:26');
INSERT INTO `mensaje` VALUES ('34', '4', 'pero aqui si', '2013-08-12 03:18:32');
INSERT INTO `mensaje` VALUES ('35', '5', 'aqui escribo algo', '2013-08-12 08:31:31');
INSERT INTO `mensaje` VALUES ('36', '5', 'aqui actualiza', '2013-08-12 08:31:47');
INSERT INTO `mensaje` VALUES ('37', '1', 'klk;l', '2013-08-12 09:32:55');
INSERT INTO `mensaje` VALUES ('38', '1', 'fsfsd', '2013-08-15 09:18:42');
INSERT INTO `mensaje` VALUES ('39', '8', 'rwer', '2013-08-20 08:50:33');
INSERT INTO `mensaje` VALUES ('40', '1', 'ewew', '2013-08-20 08:53:10');
INSERT INTO `mensaje` VALUES ('41', '1', 'wewetwrtre', '2013-08-20 08:53:12');
INSERT INTO `mensaje` VALUES ('42', '2', 'kjlkj', '2013-08-24 11:11:49');
INSERT INTO `mensaje` VALUES ('43', '2', 'bn', '2013-08-24 22:15:30');
INSERT INTO `mensaje` VALUES ('44', '2', 'kjh', '2013-08-24 22:15:34');
INSERT INTO `mensaje` VALUES ('45', '2', 'kjkljkljlkj', '2013-08-25 21:22:13');
INSERT INTO `mensaje` VALUES ('46', '9', 'uhmmmm', '2013-09-12 07:59:49');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpadre` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `icono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '0', 'Principal', '', '', '0', '');
INSERT INTO `menu` VALUES ('2', '0', 'Concurso', '', '', '0', '');
INSERT INTO `menu` VALUES ('3', '0', 'Postulantes', '', '', '0', '');
INSERT INTO `menu` VALUES ('4', '0', 'Evaluador', '', '', '0', '');
INSERT INTO `menu` VALUES ('5', '0', 'Proceso  Evaluación', '', '', '0', '');
INSERT INTO `menu` VALUES ('6', '0', 'Reportes', '', '', '0', '');
INSERT INTO `menu` VALUES ('7', '0', 'Catalogos', '', '', '0', '');
INSERT INTO `menu` VALUES ('8', '1', 'Inicio', '', '_admin_inicio', '0', '');
INSERT INTO `menu` VALUES ('9', '1', 'Mantenimiento de Usuarios', '', '_admin_usuario', '0', '');
INSERT INTO `menu` VALUES ('10', '1', 'Mantenimiento Perfiles', '', '_admin_perfil', '0', '');
INSERT INTO `menu` VALUES ('11', '1', 'Grupo de Evaluación', '', '_admin_grupoevaluacion', '0', '');
INSERT INTO `menu` VALUES ('12', '1', 'Mantenimiento de Encuesta', '', '', '0', '');
INSERT INTO `menu` VALUES ('13', '1', 'Cierre de Evaluación', '', '', '0', '');
INSERT INTO `menu` VALUES ('14', '2', 'Mantenimiento de Concurso', '', '_admin_concurso', '0', '');
INSERT INTO `menu` VALUES ('15', '3', 'Ficha de Inscripción', '', '', '0', '');
INSERT INTO `menu` VALUES ('16', '3', 'Lista de Postulantes', '', '', '0', '');
INSERT INTO `menu` VALUES ('17', '4', 'Ficha de Inscripción', '', '', '0', '');
INSERT INTO `menu` VALUES ('18', '4', 'Lista de Evaluadores', '', '', '0', '');
INSERT INTO `menu` VALUES ('19', '5', 'Evaluación Individual', '', '', '0', '');
INSERT INTO `menu` VALUES ('20', '5', 'Evaluación de Concenso', '', '', '0', '');
INSERT INTO `menu` VALUES ('21', '5', 'Etapa de Visita', '', '', '0', '');
INSERT INTO `menu` VALUES ('22', '5', 'Informe de Retroalimentación', '', '', '0', '');
INSERT INTO `menu` VALUES ('23', '5', 'Asignar Visita', '', '', '0', '');
INSERT INTO `menu` VALUES ('24', '5', 'Encuesta', '', '', '0', '');
INSERT INTO `menu` VALUES ('25', '5', 'Asignar Ganador', '', '', '0', '');
INSERT INTO `menu` VALUES ('26', '7', 'Mantenimiento Conflictos Interes', '', '_admin_tvi_list', '0', '');
INSERT INTO `menu` VALUES ('27', '7', 'Mantenimiento Bases Legales', '', '_admin_ble_list', '0', '');
INSERT INTO `menu` VALUES ('28', '7', 'Mantenimiento Etapas de Evaluación', '', 'etapaevaluacion', '0', '');
INSERT INTO `menu` VALUES ('29', '7', 'Mantenimiento Grupo Preguntas', '', 'grupopregunta', '0', '');
INSERT INTO `menu` VALUES ('30', '7', 'Tipo Documento', ' ', '_admin_tdi_list', '0', ' ');
INSERT INTO `menu` VALUES ('31', '7', 'Tipo Contacto Postulante', '', '_admin_tcp_list', '0', '');
INSERT INTO `menu` VALUES ('32', '0', 'Inicio Postulante', '', '_admin_inicio_postulante', '0', '');

-- ----------------------------
-- Table structure for `nota`
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `completada` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `archivada` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_68E29133DB38439E` (`usuario_id`),
  CONSTRAINT `FK_68E29133DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('23', '1', 'revision incacola pendiente', '0', '0', '2013-08-26 01:13:57', '2013-08-26 01:13:57');
INSERT INTO `nota` VALUES ('24', '1', ':O', '0', '0', '2013-08-26 01:14:01', '2013-08-26 01:14:01');
INSERT INTO `nota` VALUES ('25', '1', 'esto si funciona y ahora que hago???', '0', '0', '2013-08-26 01:14:08', '2013-08-26 01:14:08');
INSERT INTO `nota` VALUES ('26', '1', 'jajajajajajaa', '0', '0', '2013-08-26 01:14:11', '2013-08-26 01:14:11');
INSERT INTO `nota` VALUES ('27', '1', 'valeleleleleelel', '0', '0', '2013-08-26 01:14:15', '2013-08-26 01:14:15');
INSERT INTO `nota` VALUES ('28', '1', 'valeeeee', '0', '0', '2013-08-26 01:14:17', '2013-08-26 01:14:17');
INSERT INTO `nota` VALUES ('29', '1', 'increible sigamos', '0', '0', '2013-08-26 01:14:21', '2013-08-26 01:14:21');
INSERT INTO `nota` VALUES ('30', '2', 'nueva nota', '0', '0', '2013-09-12 07:59:55', '2013-09-12 07:59:55');
INSERT INTO `nota` VALUES ('31', '2', 'gdsfg dsgdfgdfs', '0', '0', '2013-09-23 03:36:47', '2013-09-23 03:36:47');

-- ----------------------------
-- Table structure for `participante`
-- ----------------------------
DROP TABLE IF EXISTS `participante`;
CREATE TABLE `participante` (
  `usuario_id` int(11) NOT NULL,
  `conversacion_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`conversacion_id`),
  KEY `IDX_85BDC5C3DB38439E` (`usuario_id`),
  KEY `IDX_85BDC5C3ABD5A1D6` (`conversacion_id`),
  CONSTRAINT `FK_85BDC5C3ABD5A1D6` FOREIGN KEY (`conversacion_id`) REFERENCES `conversacion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_85BDC5C3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of participante
-- ----------------------------

-- ----------------------------
-- Table structure for `participanteconversacion`
-- ----------------------------
DROP TABLE IF EXISTS `participanteconversacion`;
CREATE TABLE `participanteconversacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of participanteconversacion
-- ----------------------------

-- ----------------------------
-- Table structure for `perfil`
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador', '', '1');
INSERT INTO `perfil` VALUES ('2', 'Evaluador', '', '1');
INSERT INTO `perfil` VALUES ('3', 'Postulante', '', '1');
INSERT INTO `perfil` VALUES ('54', 'eqweqw', 'eqweqwqeqweqw', '1');
INSERT INTO `perfil` VALUES ('55', 'dasdasd', 'dasdasdas', '1');
INSERT INTO `perfil` VALUES ('58', 'rwrwer', 'fsfsdfdfsdf', '1');
INSERT INTO `perfil` VALUES ('59', 'fsdfds', 'fsdfdsf', '1');
INSERT INTO `perfil` VALUES ('60', 'dasdas', 'dadadasdasdasda', '1');

-- ----------------------------
-- Table structure for `postulante`
-- ----------------------------
DROP TABLE IF EXISTS `postulante`;
CREATE TABLE `postulante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruc` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1C949887DB38439E` (`usuario_id`),
  CONSTRAINT `FK_1C949887DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulante
-- ----------------------------
INSERT INTO `postulante` VALUES ('1', 'Sebastian', 'Av Dalias 133', '45784589564', '489478979', 'www.google.com', 'www.google.com', '2', '2013-09-10 06:19:30', '2013-09-30 06:56:14');

-- ----------------------------
-- Table structure for `postulantecontacto`
-- ----------------------------
DROP TABLE IF EXISTS `postulantecontacto`;
CREATE TABLE `postulantecontacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogo_tc_id` int(11) DEFAULT NULL,
  `postulante_id` int(11) DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_817FD372EABCA45A` (`catalogo_tc_id`),
  KEY `IDX_817FD372CCC19F66` (`postulante_id`),
  CONSTRAINT `FK_817FD372CCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`),
  CONSTRAINT `FK_817FD372EABCA45A` FOREIGN KEY (`catalogo_tc_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulantecontacto
-- ----------------------------
INSERT INTO `postulantecontacto` VALUES ('1', '4', '1', 'Juan Perez', 'Ing Sistemassss', '545466461111', '465455456333', 'nm@sdsd.dssss');
INSERT INTO `postulantecontacto` VALUES ('4', '3', '1', 'ahora si ya esta grabando', 'Ing. Informático', '54541563', '1321321321', 'edi@gmail.com');
INSERT INTO `postulantecontacto` VALUES ('6', '3', '1', 'ahora si', 'fsfsf', '2343243', '423432', 'fsdf@gfdfsd.fd');

-- ----------------------------
-- Table structure for `postulantegrupo`
-- ----------------------------
DROP TABLE IF EXISTS `postulantegrupo`;
CREATE TABLE `postulantegrupo` (
  `postulante_id` int(11) NOT NULL,
  `grupoevaluacion_id` int(11) NOT NULL,
  PRIMARY KEY (`postulante_id`,`grupoevaluacion_id`),
  KEY `IDX_EB51736BCCC19F66` (`postulante_id`),
  KEY `IDX_EB51736B403D6E35` (`grupoevaluacion_id`),
  CONSTRAINT `FK_EB51736B403D6E35` FOREIGN KEY (`grupoevaluacion_id`) REFERENCES `grupoevaluacion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_EB51736BCCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulantegrupo
-- ----------------------------

-- ----------------------------
-- Table structure for `tipodocumento`
-- ----------------------------
DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `abreviatura` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipodocumento
-- ----------------------------
INSERT INTO `tipodocumento` VALUES ('1', 'DNI', 'DNI');
INSERT INTO `tipodocumento` VALUES ('2', 'RUC', 'RUC');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `nombres` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `nrodocumento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C192FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_EDD889C1A0D96FBF` (`email_canonical`),
  KEY `IDX_2265B05D57291544` (`perfil_id`),
  KEY `IDX_2265B05D2E595373` (`tipodocumento_id`),
  CONSTRAINT `FK_2265B05D2E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `tipodocumento` (`id`),
  CONSTRAINT `FK_2265B05D57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'admin', 'admin', 'admin@gmail.com', 'admin@gmail.com', '1', '4v46vxp39qm84cskcso4oko8kkw84wo', 'C0hjxcJW5cQqQpV6puRG07fQ9AOpYVYucWkDWNwGi/Ts+1YPTaqmT77j6Iv0ThMGdXY06dfWCBFYZSoF85FPeg==', '2013-09-21 20:33:01', '0', '0', null, null, null, 'a:0:{}', '0', null, '1', '', '', null, '');
INSERT INTO `usuario` VALUES ('2', 'sebastian', 'sebastian', 'sebas@gmail.com', 'sebas@gmail.com', '1', 'r0by3s2kmhw4s8kcwkcw4088c8wk8ko', 'hi0GS5Q8NFj2t3JJTl9vmTdtWovCmqJmBZP1i5s8MlDC51aUnFgvXDyVkOyCY71+netN6J1iouzMNtr6aJGz+Q==', '2013-09-30 04:03:17', '0', '0', null, null, null, 'a:1:{i:0;s:20:\"ROLE_USERNOVALIDATED\";}', '0', null, '3', 'Sebastian', 'Nuñez Carbajal', '2', '42853598');
