/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50534
Source Host           : localhost:3306
Source Database       : tiamv_pncdb

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2014-03-14 12:02:36
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
INSERT INTO `acceso` VALUES ('2', '1');
INSERT INTO `acceso` VALUES ('3', '1');
INSERT INTO `acceso` VALUES ('4', '1');
INSERT INTO `acceso` VALUES ('5', '1');
INSERT INTO `acceso` VALUES ('5', '2');
INSERT INTO `acceso` VALUES ('6', '1');
INSERT INTO `acceso` VALUES ('7', '1');
INSERT INTO `acceso` VALUES ('8', '1');
INSERT INTO `acceso` VALUES ('9', '1');
INSERT INTO `acceso` VALUES ('10', '1');
INSERT INTO `acceso` VALUES ('11', '1');
INSERT INTO `acceso` VALUES ('12', '1');
INSERT INTO `acceso` VALUES ('13', '1');
INSERT INTO `acceso` VALUES ('14', '1');
INSERT INTO `acceso` VALUES ('15', '1');
INSERT INTO `acceso` VALUES ('16', '1');
INSERT INTO `acceso` VALUES ('17', '1');
INSERT INTO `acceso` VALUES ('18', '1');
INSERT INTO `acceso` VALUES ('19', '1');
INSERT INTO `acceso` VALUES ('19', '2');
INSERT INTO `acceso` VALUES ('20', '1');
INSERT INTO `acceso` VALUES ('20', '2');
INSERT INTO `acceso` VALUES ('21', '1');
INSERT INTO `acceso` VALUES ('21', '2');
INSERT INTO `acceso` VALUES ('22', '1');
INSERT INTO `acceso` VALUES ('22', '2');
INSERT INTO `acceso` VALUES ('23', '1');
INSERT INTO `acceso` VALUES ('23', '2');
INSERT INTO `acceso` VALUES ('24', '1');
INSERT INTO `acceso` VALUES ('24', '2');
INSERT INTO `acceso` VALUES ('25', '1');
INSERT INTO `acceso` VALUES ('25', '2');
INSERT INTO `acceso` VALUES ('26', '1');
INSERT INTO `acceso` VALUES ('27', '1');
INSERT INTO `acceso` VALUES ('28', '1');
INSERT INTO `acceso` VALUES ('29', '1');
INSERT INTO `acceso` VALUES ('30', '1');
INSERT INTO `acceso` VALUES ('31', '1');
INSERT INTO `acceso` VALUES ('32', '1');
INSERT INTO `acceso` VALUES ('32', '3');

-- ----------------------------
-- Table structure for `aspectoclave`
-- ----------------------------
DROP TABLE IF EXISTS `aspectoclave`;
CREATE TABLE `aspectoclave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `inscripcion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5274D2F0505FF319` (`concursocriterio_id`),
  KEY `IDX_5274D2F040815979` (`evaluador_id`),
  KEY `IDX_5274D2F0FFD5FBD3` (`inscripcion_id`),
  CONSTRAINT `FK_5274D2F0FFD5FBD3` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`),
  CONSTRAINT `FK_5274D2F040815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_5274D2F0505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of aspectoclave
-- ----------------------------
INSERT INTO `aspectoclave` VALUES ('1', '7', 'nuevo aspecto clave', '17', '2014-03-13 15:01:20', '2014-03-13 15:01:20', '1');
INSERT INTO `aspectoclave` VALUES ('2', '7', 'aspecto clave de rocio', '18', '2014-03-13 15:35:56', '2014-03-13 15:35:56', '1');
INSERT INTO `aspectoclave` VALUES ('3', '9', 'sdfsdfsd fsd fsf sdfsd fsd', '18', '2014-03-13 20:09:09', '2014-03-13 20:09:09', '1');
INSERT INTO `aspectoclave` VALUES ('4', '7', 'este siiiiii', '17', '2014-03-14 07:29:47', '2014-03-14 07:29:47', '1');
INSERT INTO `aspectoclave` VALUES ('5', '7', 'fsdfsdfdsf  dfsd sds', '17', '2014-03-14 07:30:41', '2014-03-14 07:30:41', '1');
INSERT INTO `aspectoclave` VALUES ('6', '8', 'xxxxxxx', '17', '2014-03-14 07:42:10', '2014-03-14 07:42:10', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalogo
-- ----------------------------
INSERT INTO `catalogo` VALUES ('1', 'TDI', 'DNI', 'DOCUMENTO NACIONAL DE IDENTIDAD', 'DNI', '1', null);
INSERT INTO `catalogo` VALUES ('2', 'TDI', 'RUC', 'RUC', 'RUC', '1', null);
INSERT INTO `catalogo` VALUES ('3', 'TCP', 'Ejecutivo', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('4', 'TCP', 'Representante Legal', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('5', 'TCP', 'Representante Alterno', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('6', 'TIPOCRITERIO', 'Criterio', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('7', 'TIPOCRITERIO', 'Factor/Aspecto Clave', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('8', 'TIPOCRITERIO', 'Temas Clave', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('9', 'TIPOARBOLCRITERIO', 'Criterio', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('10', 'TIPOARBOLCRITERIO', 'Subcriterio', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('11', 'TIPOARBOLCRITERIO', 'Area Analisis', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('12', 'TIPOARBOLCRITERIO', 'Pregunta', null, null, '1', '4');
INSERT INTO `catalogo` VALUES ('13', 'TIPOCONCURSO', 'Premio Nacional a la Calidad', 'PNC', null, '1', '1');
INSERT INTO `catalogo` VALUES ('14', 'TIPOCONCURSO', 'Reconocimiento a la Mejora', 'RM', null, '1', '2');
INSERT INTO `catalogo` VALUES ('15', 'TIPOETAPA', 'Etapa Individual', null, null, '0', '1');
INSERT INTO `catalogo` VALUES ('16', 'TIPOETAPA', 'Etapa Concenso', null, null, '0', '2');
INSERT INTO `catalogo` VALUES ('17', 'TIPOETAPA', 'Etapa Visita', null, null, '0', '3');
INSERT INTO `catalogo` VALUES ('18', 'TIPOETAPA', 'Informe Retroalimentación', null, null, '0', '4');
INSERT INTO `catalogo` VALUES ('19', 'CATEGORIAPOSTULANTE', 'Produccion de Bienes', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('20', 'CATEGORIAPOSTULANTE', 'Comercio y Servicios', null, null, '1', '2');
INSERT INTO `catalogo` VALUES ('21', 'CATEGORIAPOSTULANTE', 'Sector Público', null, null, '1', '3');
INSERT INTO `catalogo` VALUES ('22', 'SEXO', 'Hombre', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('23', 'SEXO', 'Mujer', null, null, '1', '0');
INSERT INTO `catalogo` VALUES ('24', 'TVI', 'Empleadores ultimos 3 años', 'Detalle su(s) empleador(es) de LOS ÚLTIMOS 3 AÑOS cuyos intereses podrían verse afectados de manera favorable o desfavorable por sus acciones como Evaluador. Mencione también, el período en el cual trabajó. Adicionalmente si fuera el caso mencione el nombre de la compañía matriz de cada una de ellos.', null, '1', null);
INSERT INTO `catalogo` VALUES ('25', 'TVI', 'Servicio Consultoria', 'En caso de prestar servicios de consultoría detalle la relación de sus clientes. Incluya también la compañía matriz del cliente; y si la compañía matriz es propiedad de otra compañía, enumere todas.', null, '1', null);
INSERT INTO `catalogo` VALUES ('26', 'DIA', 'Lunes', null, null, '1', '1');
INSERT INTO `catalogo` VALUES ('27', 'DIA', 'Martes', null, null, '2', '2');
INSERT INTO `catalogo` VALUES ('28', 'DIA', 'Miercoles', null, null, '3', '3');
INSERT INTO `catalogo` VALUES ('29', 'DIA', 'Jueves', null, null, '4', '4');
INSERT INTO `catalogo` VALUES ('30', 'DIA', 'Viernes', null, null, '5', '5');
INSERT INTO `catalogo` VALUES ('31', 'DIA', 'Sabado', null, null, '6', '6');
INSERT INTO `catalogo` VALUES ('32', 'DIA', 'Domingo', null, null, '7', '7');
INSERT INTO `catalogo` VALUES ('33', 'TVI', 'Principales Clientes', 'Enumere los principales clientes de su empleador actual.', null, '1', null);
INSERT INTO `catalogo` VALUES ('34', 'TVI', 'Principales Proveedores', 'Enumere los principales proveedores de su empleador actual.', null, '1', null);
INSERT INTO `catalogo` VALUES ('35', 'TVI', 'Principales Competidores', 'Enumere los principales competidores de su empleador actual o como consultor.', null, '1', null);
INSERT INTO `catalogo` VALUES ('36', 'TVI', 'Asesoría en PNC o RGPM', 'Mencione la(s) organización(es) a la(s) que usted ha asesorado para la postulación al Premio Nacional a la Calidad y/o al Reconocimiento a la Gestión de Proyectos de Mejora, mencione también la(s) fecha(s) en que realizó dicho trabajo.', null, '1', null);
INSERT INTO `catalogo` VALUES ('37', 'TVI', 'Interés Financiero', 'Enumere las compañías en las que usted tiene un interés financiero, es decir, acciones, etc.', null, '1', null);
INSERT INTO `catalogo` VALUES ('38', 'TVI', 'Afiliaciones', 'Enumere otras afiliaciones que puedan o parezcan representar un conflicto de interés directo en el cumplimiento de sus deberes, durante el proceso de evaluación y describa brevemente por qué. Los ejemplos pueden incluir compañías que usted conoce gracias a sus relaciones interpersonales (remuneradas o no remuneradas), familiares o amicales; las relaciones empresariales o con asociaciones.', null, '1', null);
INSERT INTO `catalogo` VALUES ('39', 'BLE', 'Términos de Aceptación del Evaluador', 'Términos de Aceptación del Evaluador. Me comprometo formalmente, en caso de ser designado Evaluador a presentar una declaración ampliatoria en caso de que existiera conflicto de interés con el postulante cuyo Informe de Postulación me fuera encomendado. Solicito ser incluido en el Proceso de Evaluación del presente año para lo cual declaro conocer las Bases y el Cronograma y acepto formalmente cumplir todos los compromisos que se establecen en las Condiciones de Participación de Evaluadores del Premio Nacional a la Calidad y del Reconocimiento a la Gestión de Proyectos de Mejora y declaro bajo juramento que es verdadera la información que proporciono sobre mis datos personales, conflictos de interés y curriculum vitae.', null, '1', '1');
INSERT INTO `catalogo` VALUES ('40', 'BLE', 'Condiciones de Evaluación', 'ONDICIONES DE PARTICIPACION DE EVALUADORES \r\nDEL PREMIO NACIONAL A LA CALIDAD Y \r\nDEL RECONOCIMIENTO A LA GESTION DE PROYECTOS DE MEJORA\r\n\r\n1.Tarea del Evaluador\r\nEl Evaluador realizará su tarea con arreglo, según corresponda, a las Bases del Premio Nacional a la Calidad, a las Bases de Reconocimiento a la Gestión de Proyectos de Mejora y al Manual del Evaluador en los términos y plazos establecidos, mediante el uso del Software de Evaluación del Premio Nacional a la Calidad y del Reconocimiento a la Gestión de Proyectos de Mejora.\r\nEl Evaluador deberá realizar en el mencionado Software:\r\n- Actualización de Datos:\r\nRevisar y actualizar sus datos personales.\r\n- Postulación Evaluadores\r\nLeer las Condiciones de Participación de Evaluadores del Premio Nacional a la Calidad y del Reconocimiento a la Gestión de Proyectos de Mejora, indicar los conflictos de interés, disponibilidad de tiempo y compromiso de viaje y aceptarlos.\r\n- Evaluación Individual: \r\nEstudiar exhaustivamente el Informe de Postulación, en forma reservada y garantizando que la información será solo de su conocimiento.\r\nElaborar sugerencias de fortalezas, oportunidades de mejora, aspectos para la visita y puntaje correspondientes a cada criterio y subcriterio, dentro de las fechas establecidas según el cronograma.\r\n- Evaluación de Consenso:\r\nParticipar puntualmente y de manera proactiva en las reuniones de consenso, en un diálogo orientado a generar una evaluación justa y retroalimentación de alto valor para la organización postulante, cumpliendo con realizar las tareas en los plazos y la forma establecida.\r\n- Visita en Terreno:\r\nObservar cuidadosamente las normas de comportamiento que especifica el Manual del Evaluador y participar como grupo en la visita, teniendo presente que actúa como representante del Comité de Gestión de la Calidad.\r\nUna vez concluida la visita deberá actualizar en el Software la información y puntuación necesaria según las evidencias encontradas.\r\n- Informe de Retroalimentación:\r\nParticipar puntualmente y de manera proactiva en las reuniones para contribuir en la elaboración del Informe teniendo en cuenta la importancia que tiene para la organización postulante.\r\n\r\n2. Términos y Condiciones para el Nombramiento\r\n2.1. Código de Normas Éticas\r\nTodas las personas que participen en el Proceso de Evaluación del Premio Nacional a la Calidad y del Reconocimiento a la Gestión de Proyectos de Mejora se comprometen a cumplir el siguiente Código de Normas Éticas:\r\n\r\n- Comportarse de manera profesional, con respeto a la verdad, esmero, exactitud, justicia y responsabilidad.\r\n- No tener intereses en conflicto, ni actuar de tal manera que sus intereses estén o aparenten estar en conflicto con los propósitos y la administración del Premio y del Reconocimiento. \r\n- Salvaguardar la confidencialidad de todas las partes involucradas.\r\n- No proporcionar o revelar ningún tipo de información relacionada con su participación en el proceso.\r\n- No aceptar contratos, comisiones o consideraciones económicas de candidatos pasados o presentes, o de personas interesadas en intercambiar o divulgar información.\r\n- No representar intereses, propios o ajenos, directa o indirectamente, que se contrapongan o pudieran estar en conflicto con los propósitos y objetivos del proceso, descartando la evaluación de cualquier organización en la que se encuentren empleados o con las cuales exista un acuerdo de asesoría o consultoría vigente o pendiente u organización que sea competidor directo de aquella con la cual está vinculado. \r\n- No proporcionar información falsa o engañosa que pueda comprometer la integridad de los procedimientos del Premio y/o Reconocimiento o las decisiones involucradas en el mismo.\r\n- Abstenerse de establecer comunicaciones con postulantes para obtener o entregar información adicional. Toda comunicación debe ser canalizada a través de la Secretaría Técnica del Comité de Gestión de la Calidad.\r\n- Abstenerse de cualquier tipo de relación laboral con organizaciones respecto de las cuales ha actuado como evaluador por lo menos por un año después de concluido el periodo de actuación.\r\nLos Evaluadores deben esforzarse por mejorar y promover el Premio Nacional a la Calidad y el Reconocimiento a la Gestión de Proyectos de Mejora, guardando un comportamiento íntegro y proporcionando retroalimentación a la Secretaría Técnica sobre oportunidades de mejora.\r\n2.2. Divulgación de Conflictos de Interés\r\nLos interesados en participar como Evaluador, deben proporcionar información sobre sus Conflictos de Interés. La divulgación incluye, aunque no es limitativa, empleadores, intereses financieros y relaciones con clientes. Dicha información será utilizada sólo para seleccionar los equipos de evaluación y será de carácter confidencial.\r\nAl recibir el material correspondiente a una postulación el evaluador deberá verificar que no existe conflicto de interés. Si existiera conflicto deberá informarlo a la Secretaría Técnica y devolver de inmediato la documentación recibida.\r\n2.3. Compromiso de dedicación de tiempo\r\nLos Evaluadores se comprometen a destinar el tiempo que se requiera para realizar la evaluación asignada y deben reservar su tiempo según el cronograma que se presenta a continuación:\r\n25 de Abril ........................................................................................  Recepción de Informes de Postulación\r\n2 al 3 Mayo ....................................................................................................  Revisión y Selección Previa\r\n6 al 31 Mayo ...............................................................................................  Evaluación Individual\r\n5 al 28 Junio ..................................................................................................  Evaluación de Consenso\r\n1 al 24 Julio ................................................................................................  Visitas a organizaciones\r\n9 de Agosto ...............................................  Entrega de Informes de Retroalimentación a la Secretaría Técnica\r\n22 de Agosto ..........................................................................................  Determinación de Ganadores\r\n26 de Agosto ........................................................................................................  Notificación a Ganadores\r\nSemana de la Calidad (30 setiembre al 4 de Octubre) ....................................................................Premiación\r\nOctubre .......................................................... Entrega de Informes de Retroalimentación a las organizaciones\r\nTiempos estimados que deberá dedicar el Evaluador\r\nEvaluación Individual                          50 Horas\r\nEvaluación de Consenso                     20 Horas\r\nVisita a Empresa                                 8 Horas\r\nInforme de Retroalimientación            10 Horas\r\nViajar 2 ó 3 días fuera de Lima en caso tuviera a su cargo la evaluación de una empresa del interior del país o con sucursales.\r\nLos tiempos son estimados y en cualquier caso el compromiso abarca el cumplimiento de la tarea encomendada hasta la entrega del Informe de Retroalimentación a satisfacción de la Oficina de la Secretaría Técnica del Comité de Gestión de la Calidad.\r\n\r\n2.4. Confidencialidad de la Información\r\n- Mantener absoluta confidencialidad sobre la información que reciba de las organizaciones postulantes, de la Oficina del Premio y de las discusiones o actividades relacionadas con su participación como Evaluador.\r\n- Mantener absoluta reserva sobre la identidad de las organizaciones postulantes.\r\n- Abstenerse de tomar copias, usar o guardar cualquier información de las organizaciones postulantes a las que tengan acceso como consecuencia de su participación como Evaluador.\r\n- La información y el acceso al Software será únicamente para uso personal siendo intransferible.\r\n \r\n3. Términos y condiciones de permanencia y exclusión en el Proceso de Evaluación\r\nLa participación de un Evaluador en las próximas actividades del Premio Nacional a la Calidad y del Reconocimiento a la Gestión de Proyectos de Mejora dependerá:\r\n- Del fiel cumplimiento de los compromisos asumidos en el presente documento\r\n- De la labor realizada como evaluador, sus aportes y puntual participación\r\n- Se valorará también las sugerencias de mejora que formule para las Bases, los documentos y los procesos del Premio Nacional a la Calidad, además las labores en que participe para divulgar el Modelo y promover postulaciones\r\n- La participación en las actividades de actualización que realice el Comité de Gestión de la Calidad\r\nQuedarán excluidos de un posterior proceso los Evaluadores que incurran en el caso previsto en el punto 1 o en 2 o más de los casos previstos en los puntos 2 al 4:\r\n1.No cumplan con entregar su evaluación individual a la Secretaría Técnica en el plazo establecido\r\n2.No asistan a las reuniones de consenso\r\n3.No asistan a la visita\r\n4.No entregan el formato de evaluación de líderes o evaluadores (según sea el caso)\r\n\r\n4. Reconocimiento al Evaluador\r\nLa labor de los Evaluadores es un servicio de voluntariado, que el Comité de Gestión de la Calidad reconoce con la entrega de un Diploma que acredite su participación en el proceso. Adicionalmente se dará un reconocimiento a aquellos evaluadores destacados durante el presente proceso.', null, '1', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concurso
-- ----------------------------
INSERT INTO `concurso` VALUES ('10', 'Reconocimiento a la Mejora de Procesos 2014', '2014-02-28', '2014-09-01', 'Declaramos que conocemos las Bases del Premio Nacional a la Calidad, correspondientes al año 2013 y al presentar nuestra postulación nos sometemos a ellas de manera irrevocable. Asimismo aceptamos el carácter inapelable de las decisiones del Consejo Evaluador.\r\n\r\nDeclaramos que es cierta la información y los datos proporcionados en el Informe de Postulación.\r\n\r\nEntendemos que la postulación será revisada por los equipos evaluadores. Si nuestra organización fuera seleccionada para ser visitada, aceptamos recibir dicha visita y otorgar facilidades para que los evaluadores realicen una evaluación prolija  e imparcial.  \r\n\r\nAceptamos pagar las cuotas y los gastos que nos corresponden con arreglo a lo estipulado en las Bases.\r\n\r\nSi nuestra organización resulta ganadora aceptamos cumplir el compromiso de los ganadores en la forma establecida por las Bases.', null, null, null, null, null, null, null, null, null, '2014', '1', '0', '0', 'Declaramos que conocemos las Bases del Premio Nacional a la Calidad, correspondientes al año 2013 y al presentar nuestra postulación nos sometemos a ellas de manera irrevocable. Asimismo aceptamos el carácter inapelable de las decisiones del Consejo Evaluador.\r\n\r\nDeclaramos que es cierta la información y los datos proporcionados en el Informe de Postulación.\r\n\r\nEntendemos que la postulación será revisada por los equipos evaluadores. Si nuestra organización fuera seleccionada para ser visitada, aceptamos recibir dicha visita y otorgar facilidades para que los evaluadores realicen una evaluación prolija  e imparcial.  \r\n\r\nAceptamos pagar las cuotas y los gastos que nos corresponden con arreglo a lo estipulado en las Bases.\r\n\r\nSi nuestra organización resulta ganadora aceptamos cumplir el compromiso de los ganadores en la forma establecida por las Bases.', '5', '1', 'El Informe de Retroalimentación se genera durante las siguientes etapas del proceso de evaluación: \r\nEvaluación por el Jurado Calificador\r\n- Evaluación individual\r\nLos equipos de evaluadores son conformados, atendiendo criterios de conocimientos, experiencias, habilidades y a la no existencia de conflictos de interés.\r\nLos evaluadores de manera individual y a través de la lectura y estudio detallado del trabajo de aplicación, proceden a llenar el Cuaderno de Evaluación junto a los primeros hallazgos de fortalezas, áreas de mejora y temas para la visita en terreno.\r\n- Evaluación en consenso\r\nCon el objeto de enriquecer la evaluación individual con los conocimientos y experiencias de los evaluadores, se busca construir una percepción de equipo, enriquecida con los aportes individuales, realizándose para ello diversas reuniones de revisión y consenso. Luego de aclarar las diferencias de interpretación, se obtiene el Informe de Consenso.\r\nEl Consejo Evaluador reúne los Informes de Consenso, correspondientes a todas las postulaciones objeto de evaluación, y define qué trabajos recibirán visitas en terreno.\r\nEvaluación en terreno\r\nEn esta etapa se realizan visitas a las empresas con el propósito de verificar la información presentada en los trabajos. \r\nDurante la visita se llevan a cabo entrevistas con directivos, ejecutivos y responsables de la información contenida en el documento de postulación.  Se tratan con prioridad los temas identificados como poco claros en el informe o los aspectos relacionados con el despliegue.\r\nLos hallazgos en la visita pueden aumentar o disminuir la evaluación realizada  previamente y modificar en cierta medida las fortalezas y áreas de mejora identificadas en el Informe de Consenso.\r\nLuego de la visita, el equipo evaluador se reúne nuevamente y prepara el Informe de Visita en Terreno, documento que es revisado por la Secretaría Técnica para determinar si continúa hacia la fase final de evaluación.\r\nSustentación ante el Consejo Evaluador\r\nAnte la presencia de los miembros del Consejo Evaluador, se realiza la evaluación final. En la sustentación ante el Consejo, conformado por personalidades de las instituciones del Comité de Gestión de la Calidad y líderes de los equipos sin conflictos de interés, se analiza la postulación en sus aspectos esenciales. Además de los criterios técnicos, son considerados como determinantes el compromiso de la Alta Dirección de la empresa,  la responsabilidad social y los valores éticos sobre los cuáles se construye la organización. Es decir, se analiza la capacidad de la empresa para convertirse en un ejemplo para las demás organizaciones del país.', 'Los métodos de evaluación de los Premios Nacionales a la Calidad son prácticamente universales. El objetivo fundamental de tales métodos es lograr una evaluación técnicamente sólida y exenta, en la medida de lo posible, de subjetividad.\r\nEl proceso de calificación se encuentra detallado en las Bases del Premio Nacional a la Calidad. No obstante, consideramos oportuno para la mayor comprensión de este informe hacer algunas precisiones relacionadas con aspectos fundamentales tomados en cuenta en la evaluación.\r\nRelevancia y pertinencia como un factor de puntuación \r\nEn el proceso de evaluación no todos los aspectos son considerados por igual.  Aquellos más importantes para el éxito de la organización, es decir relacionados con las necesidades clave del cliente y los factores clave de la organización, constituyen lo que es “relevante”.\r\nPor otro lado, aquello que la organización necesita afrontar con mayor énfasis debido a que está estrechamente relacionado con su negocio o ámbito de acción, se convierte en algo “pertinente”.\r\nLo que es relevante y pertinente en una organización puede no serlo en otras, por ello es importante identificar estos aspectos y tenerlos en cuenta en el momento de la evaluación.\r\nPara la evaluación de Modelos de Excelencia las tres dimensiones de la evaluación: enfoque (métodos de la empresa para alcanzar los objetivos señalados en cada sub-criterio), despliegue (extensión en que los enfoques son aplicados en todas las áreas relevantes de la empresa) y resultados (los efectos obtenidos en los subcriterios evaluados), son analizadas con base en la tabla de evaluación y considerando los criterios de relevancia y pertinencia. \r\nSímbolos “+”, “++”, “-” y “- -”  \r\nLas fortalezas se designan con el prefijo “+” y las áreas para mejora con “-”. Las fortalezas o áreas de mejora importantes se representan con “++” o “- -”, respectivamente.\r\nDocumento final\r\nCon el aporte de los comentarios realizados por el Consejo y el Proceso de Calificación, los equipos de evaluadores se vuelven a reunir para elaborar el Informe de Retroalimentación que será entregado a los postulantes.', null, '14');

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
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concursocriterio
-- ----------------------------
INSERT INTO `concursocriterio` VALUES ('6', '7', '9', '0', 'AC', 'Aspectos Clave', '0', 'Aspectos Clave', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('7', null, '10', '6', '1', 'Vinculo del Proyecto con la estrategia del negocio', '0', 'Vinculo del Proyecto con la estrategia del negocio', null, 'Vinculo del Proyecto con la estrategia del negocio', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('8', null, '10', '6', '2', 'Metodología empleada para la solución del problema', '0', null, null, 'Metodología empleada para la solución del problema', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('9', null, '10', '6', '3', 'Soporte de la Alta Dirección al Proyecto', '0', 'Soporte de la Alta Dirección al Proyecto', null, 'Soporte de la Alta Dirección al Proyecto', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('10', null, '10', '6', '4', 'Resultados Obtenidos', '0', 'Resultados Obtenidos', null, 'Resultados Obtenidos', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('11', '6', '9', '0', '1', 'Liderazgo y Compromiso de la Alta Dirección', '120', 'Liderazgo y Compromiso de la Alta Dirección', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('12', null, '10', '11', '1.1', 'Organización de Soporte para Promover el Trabajo en Equipo', '20', 'Organización de Soporte para Promover el Trabajo en Equipo', null, 'Organización de Soporte para Promover el Trabajo en Equipo', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('13', null, '11', '12', '1.1.a', 'Organización de Soporte para Promover el Trabajo en Equipo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('14', null, '12', '13', '1.1.a.1', '¿Con qué políticas o normas se promueve el trabajo en equipo al interior de la organización?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('15', null, '12', '13', '1.1.a.2', '¿Cómo hace efectiva o pone en práctica tales políticas?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('16', null, '12', '13', '1.1.a.3', '¿Cómo participa la alta dirección y el personal en las actividades relacionadas?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('20', null, '10', '11', '1.2', 'Facilidades Otorgadas a los Equipos de Proyectos de Mejora', '20', 'Facilidades Otorgadas a los Equipos de Proyectos de Mejora', null, 'Facilidades Otorgadas a los Equipos de Proyectos de Mejora', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('21', null, '11', '20', '1.2.a', 'Facilidades Otorgadas a los Equipos de Proyectos de Mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('22', null, '12', '20', '1.2.a.1', '¿Qué facilidades otorgó la alta dirección para promover y hacer viable el trabajo del equipo del proyecto de mejora? Ello puede incluir la asignación de una partida en el presupuesto de gastos, de personal y de recursos tales como entrenamiento, útil', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('23', null, '12', '20', '1.2.a.2', '¿Cómo se garantiza la comunicación de los miembros del equipo con la alta dirección a efectos de facilitar el desempeño del equipo? Comente el nivel de autoridad otorgado al equipo, para su actuación.', null, null, null, null, null, null, null);
INSERT INTO `concursocriterio` VALUES ('24', null, '10', '11', '1.3', 'Apoyo de la Alta Dirección en la Implantación de las Propuestas de Solución.', '30', 'Apoyo de la Alta Dirección en la Implantación de las Propuestas de Solución.', null, 'Apoyo de la Alta Dirección en la Implantación de las Propuestas de Solución.', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('25', null, '11', '24', '1.3.a', 'Apoyo de la Alta Dirección en la Implantación de las Propuestas de Solución', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('26', null, '12', '25', '1.3.a.1', '¿Qué medios utilizó la alta dirección para dar soporte a la implantación de las mejoras propuestas? Ello comprende la forma en que las nuevas prácticas provenientes del proyecto de mejora son aprobadas, difundidas e implantadas; considerar también lo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('27', null, '10', '11', '1.4', 'Reconocimiento a los Equipos de Proyectos de Mejora', '50', 'Reconocimiento a los Equipos de Proyectos de Mejora', null, 'Reconocimiento a los Equipos de Proyectos de Mejora', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('28', null, '11', '27', '1.4.a', 'Reconocimiento a los Equipos de Proyectos de Mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('29', null, '12', '28', '1.4.1.a', '¿Qué reconocimientos se otorga a los integrantes de los equipos de proyectos de mejora que logran resultados destacados? Los reconocimientos, independiente de su naturaleza, deben estimular y promover el trabajo en equipo, la mejora continua y la ori', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('30', null, '12', '28', '1.4.a.2', 'Informe cómo el reconocimiento forma parte de las políticas de la organización.', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('31', '6', '9', '0', '2', 'Identificación y Selección del Proyecto de Mejora', '120', 'Identificación y Selección del Proyecto de Mejora', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('32', null, '10', '31', '2.1', 'Análisis de la Estrategia de la Organización y de Oportunidades de Mejora', '60', 'Análisis de la Estrategia de la Organización y de Oportunidades de Mejora', null, 'Análisis de la Estrategia de la Organización y de Oportunidades de Mejora', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('33', null, '10', '31', '2.2', 'Estimación del Impacto en los Resultados de la Organización', '60', 'Estimación del Impacto en los Resultados de la Organización', null, 'Estimación del Impacto en los Resultados de la Organización', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('34', null, '11', '32', '2.1.a', 'Análisis de la Estrategia de la Organización y de Oportunidades de Mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('35', null, '12', '34', '2.1.a.1', '¿Cuáles son las principales estrategias del negocio?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('36', null, '12', '34', '2.1.a.2', '¿Cómo consideró el equipo los principales lineamientos estratégicos de la organización en la selección del proyecto de mejora a trabajar?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('37', null, '12', '34', '2.1.a.3', '¿Qué relación existe entre el proyecto de mejora y la estrategia del negocio en lo relativo a resultados financieros, a la mejora de procesos internos, al desempeño del personal y/o a los resultados de la satisfacción del cliente externo o interno?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('38', null, '11', '33', '2.2.a', 'Estimación del Impacto en los Resultados de la Organización', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('39', null, '12', '38', '2.2.a.1', '¿Qué método o procedimiento utilizaron para estimar el impacto de las alternativas de los proyectos de mejora en el desempeño de la organización? Ello incluye analizar el impacto en costos, calidad, entrega, participación en el mercado, clima laboral', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('40', null, '12', '38', '2.2.a.2', '¿Por qué razón el grupo escogió el proyecto de mejora seleccionado?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('41', '6', '9', '0', '3', 'Método de Solución de Problemas y Herramientas de la Calidad', '220', 'Método de Solución de Problemas y Herramientas de la Calidad', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('42', null, '10', '41', '3.1', 'Método de Solución de Problemas y Herramientas de la Calidad', '60', 'Método de Solución de Problemas y Herramientas de la Calidad', null, 'Método de Solución de Problemas y Herramientas de la Calidad', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('43', null, '10', '41', '3.2', 'Recolección y Análisis de la Información', '60', 'Recolección y Análisis de la Información', null, 'Recolección y Análisis de la Información', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('44', null, '10', '41', '3.3', 'Herramientas de la Calidad', '60', 'Herramientas de la Calidad', null, 'Herramientas de la Calidad', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('45', null, '10', '41', '4.3', 'Concordancia entre el Método y las Herramientas', '40', 'Concordancia entre el Método y las Herramientas', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('46', null, '11', '42', '3.1.a', 'Método de Solución de Problemas y Herramientas de la Calidad', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('47', null, '12', '46', '3.1.a.1', '¿Cuál fue el método de solución de problemas que empleó el equipo?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('48', null, '12', '46', '3.1.a.2', '¿Cuáles fueron los pasos o etapas desarrollados? Explíquelos en detalle. La explicación debe cubrir como mínimo las fases de definición de la situación inicial, el levantamiento y análisis de información, el desarrollo de alternativas de solución, la', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('49', null, '11', '43', '3.2.a', 'Recolección y Análisis de la Información', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('50', null, '12', '49', '3.2.a.1', '¿Cómo obtuvo el equipo la información necesaria para la ejecución del proyecto de mejora?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('51', null, '12', '49', '3.2.a.2', '¿Cómo determinaron el tipo y tamaño de información a recolectar?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('52', null, '12', '49', '3.2.a.3', '¿Cómo seleccionaron las fuentes de datos?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('53', null, '12', '49', '3.2.a.4', '¿Cómo verificaron que la información no tuviera errores y cómo resolvieron la falta o deficiencia de la información?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('54', null, '12', '49', '3.2.a.5', 'Explicar cómo analizaron la información recolectada para la selección del proyecto de mejora. Incluya el análisis de la situación actual contra las expectativas de clientes tanto internos como externos, de la magnitud de la brecha existente entre la ', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('55', null, '11', '44', '3.3.a', 'Herramientas de la Calidad', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('56', null, '12', '55', '3.3.a.1', '¿Cómo analizó el grupo la pertinencia de utilizar determinadas herramientas para la gestión del proyecto de mejora?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('57', null, '12', '55', '3.3.a.2', '¿Qué ventajas y desventajas encontró el grupo de usar las herramientas escogidas?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('58', null, '11', '45', '3.4.a', 'Concordancia entre el Método y las Herramientas', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('59', null, '12', '58', '3.4.a.1', '¿Cómo asegura el uso adecuado en el proyecto de cada una de las herramientas empleadas a lo largo de las diferentes etapas del método de solución de problemas?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('60', '6', '9', '0', '4', 'Gestión del Proyecto y Trabajo en Equipo', '180', 'Gestión del Proyecto y Trabajo en Equipo', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('61', null, '10', '60', '4.1', 'Criterios para la Conformación del Equipo de Proyecto', '20', 'Criterios para la Conformación del Equipo de Proyecto', null, 'Criterios para la Conformación del Equipo de Proyecto', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('62', null, '10', '60', '4.2', 'Planificación del Proyecto', '40', 'Planificación del Proyecto', null, 'Planificación del Proyecto', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('63', null, '10', '60', '4.3', 'Gestión del Tiempo', '40', 'Gestión del Tiempo', null, 'Gestión del Tiempo', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('64', null, '10', '60', '4.4', 'Gestión de la Relación con Personas y Áreas Clave de la Organización', '20', 'Gestión de la Relación con Personas y Áreas Clave de la Organización', null, 'Gestión de la Relación con Personas y Áreas Clave de la Organización', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('65', null, '10', '60', '4.5', 'Documentación', '20', 'Documentación', null, 'Documentación', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('66', null, '11', '61', '4.1.a', 'Criterios para la Conformación del Equipo de Proyecto', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('67', null, '12', '66', '4.1.a.1', '¿Cómo y cuáles fueron los criterios de selección de los integrantes del equipo?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('68', null, '12', '66', '4.1.a.2', '¿Tuvieron en cuenta la temática a tratar, las experiencias y conocimientos de los potenciales miembros y los objetivos de la organización, entre otros criterios? Explique cómo.?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('69', null, '12', '66', '4.1.a.3', '¿Cómo se aseguró, una conformación balanceada del equipo para el mejor aprovechamiento de los conocimientos y experiencia de cada miembro?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('70', null, '11', '62', '4.2.a', 'Planificación del Proyecto', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('71', null, '12', '70', '4.2.a.1', '¿Cómo definió el equipo el objetivo del proyecto?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('72', null, '12', '70', '4.2.a.2', '¿Cómo desplegó las actividades necesarias para alcanzar el objetivo?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('73', null, '12', '70', '4.2.a.3', '¿Cómo planificó dichas actividades?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('74', null, '12', '70', '4.2.a.4', '¿Cómo definió los plazos de ejecución y asignó responsabilidades y recursos?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('75', null, '11', '63', '4.3.a', 'Gestión del Tiempo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('76', null, '12', '75', '4.3.a.1', '¿Cómo aseguró el grupo el cumplimiento de los plazos previstos en el proyecto?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('77', null, '12', '75', '4.3.a.2', 'Explique la planificación detallada con las metas de equipo y por miembro, la preparación de agendas, el manejo de las comunicaciones previas y posteriores a cada reunión, el seguimiento a los acuerdos y los mecanismos de retroalimentación en relació', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('78', null, '11', '64', '4.4.a', 'Gestión de la Relación con Personas y Áreas Clave de la Organización', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('79', null, '12', '78', '4.4.a.1', '¿De qué manera el equipo logró la colaboración y apoyo de personas y áreas clave de la organización con el objetivo de facilitar el desarrollo y éxito del proyecto?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('80', null, '11', '65', '4.5.a', 'Documentación', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('81', null, '12', '80', '4.5.a.1', '¿Qué documentos utilizaron para gestionar el proyecto? Tales como actas de reuniones, informes, estudios y registros de la labor del equipo.?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('82', null, '12', '80', '4.5.a.2', '¿Cuáles fueron los criterios para el manejo de la documentación?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('83', null, '12', '80', '4.5.a.3', '¿Cómo definieron responsabilidades en materia de redacción y mantenimiento de la documentación, la existencia de formatos adecuados para los registros, el control y distribución de la documentación? Refiérase además a toda la documentación de soporte', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('84', '6', '9', '0', '5', 'Capacitación', '80', 'Capacitación', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('85', null, '10', '84', '5.1', 'Programa de Capacitación del Equipo', '50', 'Programa de Capacitación del Equipo', null, 'Programa de Capacitación del Equipo', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('86', null, '10', '84', '5.2', 'Evaluación e Impacto de las Actividades de Capacitación', '30', 'Evaluación e Impacto de las Actividades de Capacitación', null, 'Evaluación e Impacto de las Actividades de Capacitación', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('87', null, '11', '85', '5.1.a', 'Programa de Capacitación del Equipo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('88', null, '12', '87', '5.1.a.1', '¿Cómo identificaron las necesidades de capacitación de los miembros del equipo?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('89', null, '12', '87', '5.1.a.2', 'Explique cómo se prepararon para abordar el proyecto. Se debe de tener en cuenta capacitaciones en el tratamiento de la formación en técnicas de solución de problemas, herramientas de la calidad, trabajo en equipo, liderazgo, así como en los aspectos', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('90', null, '12', '87', '5.1.a.3', 'Explique cómo se desarrolló el análisis de la brecha existente entre los conocimientos, experiencia y/o habilidades necesarias para la ejecución del proyecto y el nivel actual de cada uno de los miembros del equipo.', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('91', null, '11', '86', '5.2.a', 'Evaluación e Impacto de las Actividades de Capacitación', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('92', null, '12', '91', '5.2.a.1', '¿Qué procedimiento utilizaron para evaluar el impacto de la capacitación realizada para la mejora del desempeño del equipo?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('93', null, '12', '91', '5.2.a.2', '¿De qué manera la información de la evaluación del impacto de la capacitación es utilizada para retroalimentar el diseño de futuras actividades de capacitación?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('94', '6', '9', '0', '6', 'Innovación', '90', 'Innovación', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('96', null, '10', '94', '6.1', 'Amplitud en la Búsqueda de Opciones y Desarrollo de Alternativas', '20', 'Amplitud en la Búsqueda de Opciones y Desarrollo de Alternativas', null, 'Amplitud en la Búsqueda de Opciones y Desarrollo de Alternativas', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('97', null, '10', '94', '6.2', 'Originalidad de la Solución Propuesta', '20', 'Originalidad de la Solución Propuesta', null, 'Originalidad de la Solución Propuesta', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('98', null, '10', '94', '6.3', 'Habilidad para Implantar Soluciones de Bajo Costo y Alto Impacto', '50', 'Habilidad para Implantar Soluciones de Bajo Costo y Alto Impacto', null, 'Habilidad para Implantar Soluciones de Bajo Costo y Alto Impacto', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('99', null, '11', '96', '6.1.a', 'Amplitud en la Búsqueda de Opciones y Desarrollo de Alternativas', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('100', null, '12', '99', '6.1.a.1', '¿Cómo el equipo recopiló y analizó información relacionada con los objetivos del proyecto?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('101', null, '12', '99', '6.1.a.2', '¿Cómo el equipo desarrolló alternativas de solución de bajo costo, comparadas con otras soluciones convencionales o de menor beneficio? Presente un listado de las alternativas de solución identificadas y expliquelas.?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('102', null, '11', '97', '6.2.a', 'Originalidad de la Solución Propuesta', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('103', null, '12', '102', '6.2.a.1', '¿De qué manera el equipo buscó y analizó soluciones no convencionales, para romper paradigmas, usando la creatividad de sus integrantes?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('104', null, '12', '102', '6.2.a.2', '¿Cómo comparó y verificó la validez y los beneficios que reportaría la solución propuesta comparada con las otras opciones?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('105', null, '11', '98', '6.3.a', 'Habilidad para Implantar Soluciones de Bajo Costo y Alto Impacto', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('106', null, '12', '105', '6.3.a.1', '¿Cómo el equipo aseguró una adecuada implantación de la solución?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('107', null, '12', '105', '6.3.a.2', '¿Cómo el equipo garantiza que la solución implementada es de bajo costo y alto impacto?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('108', '6', '9', '0', '7', 'Resultados', '200', 'Resultados', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('109', null, '10', '108', '7.1', 'Resultados de Orientación hacia el Cliente Interno/Externo', '70', 'Resultados de Orientación hacia el Cliente Interno/Externo', null, 'Resultados de Orientación hacia el Cliente Interno/Externo', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('110', null, '10', '108', '7.2', 'Resultados Financieros', '70', 'Resultados Financieros', null, 'Resultados Financieros', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('111', null, '10', '108', '7.3', 'Resultados de la Eficiencia Organizacional', '60', 'Resultados de la Eficiencia Organizacional', null, 'Resultados de la Eficiencia Organizacional', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('112', null, '11', '109', '7.1.a', 'Resultados de Orientación hacia el Cliente Interno/Externo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('113', null, '12', '112', '7.1.a.1', '¿Cuáles son los resultados obtenidos que beneficien al cliente interno/externo, atribuibles al proyecto de mejora? Proporcione datos e información incluyendo satisfacción del cliente y resultados de desempeño de los productos y servicios internos/ext', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('114', null, '11', '110', '7.2.a', 'Resultados Financieros', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('115', null, '12', '114', '7.2.a.1', '¿Qué beneficios económicos ha obtenido su organización como consecuencia de la ejecución del proyecto de mejora? Se requiere información e indicadores relevantes para aspectos como incrementos en los ingresos, reducciones de costos, mejora del margen', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('116', null, '11', '111', '7.3.a', 'Resultados de la Eficiencia Organizacional', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('117', null, '12', '116', '7.3.a.1', '¿Cómo mejoró la eficiencia del proceso, actividad, área o productos mejorados, como consecuencia de la ejecución del proyecto? Proporcione datos e información sobre los resultados de la eficiencia organizacional. Los indicadores pueden comprender: in', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('118', '6', '9', '0', '8', 'Sostenibilidad y Mejora', '70', 'Sostenibilidad y Mejora', null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('119', null, '10', '118', '8.1.a', 'Sostenibilidad y Mejora', '70', 'Sostenibilidad y Mejora', null, 'Sostenibilidad y Mejora', null, null, '10');
INSERT INTO `concursocriterio` VALUES ('120', null, '11', '119', '8.1.a', 'Sostenibilidad y Mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('121', null, '12', '120', '8.1.a.1', '¿Qué análisis realizó el equipo para identificar peligros en el mantenimiento de la mejora alcanzada?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('122', null, '12', '120', '8.1.a.2', '¿Qué actividades ha previsto el equipo para garantizar la sostenibilidad, la estandarización y la mejora del proyecto implementado?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('123', null, '12', '120', '8.1.a.3', '¿Qué metas e indicadores han establecido para evaluar el desempeño futuro y asegurar la continuidad de la mejora?', null, null, null, null, null, null, '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conflictointeresevaluador
-- ----------------------------
INSERT INTO `conflictointeresevaluador` VALUES ('16', '25', 'A&B Consultant', '20393343891', '2010-01-01', '2010-07-30', 'Consultoria de Sistemas.', '17');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conversacion
-- ----------------------------

-- ----------------------------
-- Table structure for `criterioaspectoclave`
-- ----------------------------
DROP TABLE IF EXISTS `criterioaspectoclave`;
CREATE TABLE `criterioaspectoclave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `aspectoclave_id` int(11) DEFAULT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `inscripcion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_87114C5A505FF319` (`concursocriterio_id`),
  KEY `IDX_441DE8AD37E3A40A` (`aspectoclave_id`),
  KEY `IDX_441DE8AD40815979` (`evaluador_id`),
  KEY `IDX_441DE8ADFFD5FBD3` (`inscripcion_id`),
  CONSTRAINT `FK_441DE8ADFFD5FBD3` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`),
  CONSTRAINT `FK_441DE8AD37E3A40A` FOREIGN KEY (`aspectoclave_id`) REFERENCES `aspectoclave` (`id`),
  CONSTRAINT `FK_441DE8AD40815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_441DE8AD505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of criterioaspectoclave
-- ----------------------------
INSERT INTO `criterioaspectoclave` VALUES ('1', '12', '1', '17', '2014-03-13 15:08:53', '2014-03-13 15:08:53', '1');
INSERT INTO `criterioaspectoclave` VALUES ('2', '12', '2', '18', '2014-03-13 15:36:11', '2014-03-13 15:36:11', '1');
INSERT INTO `criterioaspectoclave` VALUES ('3', '12', '4', '17', '2014-03-14 07:44:11', '2014-03-14 07:44:11', '1');

-- ----------------------------
-- Table structure for `criteriovisita`
-- ----------------------------
DROP TABLE IF EXISTS `criteriovisita`;
CREATE TABLE `criteriovisita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `inscripcion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D5D27E8505FF319` (`concursocriterio_id`),
  KEY `IDX_5D5D27E840815979` (`evaluador_id`),
  KEY `IDX_5D5D27E8FFD5FBD3` (`inscripcion_id`),
  CONSTRAINT `FK_5D5D27E8FFD5FBD3` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`),
  CONSTRAINT `FK_5D5D27E840815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_5D5D27E8505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of criteriovisita
-- ----------------------------
INSERT INTO `criteriovisita` VALUES ('1', '12', 'visita por yumi', '17', '2014-03-13 15:51:29', '2014-03-13 15:51:29', '1');
INSERT INTO `criteriovisita` VALUES ('2', '20', 'visita2 por yumi2', '17', '2014-03-13 15:55:11', '2014-03-13 15:55:11', '1');
INSERT INTO `criteriovisita` VALUES ('3', '12', 'visita por rocio', '18', '2014-03-13 20:02:53', '2014-03-13 20:02:53', '1');

-- ----------------------------
-- Table structure for `etapa`
-- ----------------------------
DROP TABLE IF EXISTS `etapa`;
CREATE TABLE `etapa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoetapa_id` int(11) DEFAULT NULL,
  `tipoconcurso_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  `estado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F32B1C4A25FF527` (`tipoetapa_id`),
  KEY `IDX_2F32B1C46D82338` (`tipoconcurso_id`),
  CONSTRAINT `FK_2F32B1C46D82338` FOREIGN KEY (`tipoconcurso_id`) REFERENCES `catalogo` (`id`),
  CONSTRAINT `FK_2F32B1C4A25FF527` FOREIGN KEY (`tipoetapa_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of etapa
-- ----------------------------
INSERT INTO `etapa` VALUES ('1', '15', '13', 'Etapa Individual', '2013-10-04 00:43:20', '2014-03-04 11:26:56', '1', '0');
INSERT INTO `etapa` VALUES ('2', '16', '13', 'Etapa Consenso', '2013-10-04 08:31:14', '2014-03-04 11:27:08', '1', '0');
INSERT INTO `etapa` VALUES ('3', '17', '13', 'Etapa Visita', '2013-10-04 08:31:28', '2014-03-04 11:27:46', '1', '0');
INSERT INTO `etapa` VALUES ('4', '18', '13', 'Informe Retroalimentación', '2013-10-04 08:32:31', '2014-03-04 11:28:05', '1', '0');

-- ----------------------------
-- Table structure for `etapaconcurso`
-- ----------------------------
DROP TABLE IF EXISTS `etapaconcurso`;
CREATE TABLE `etapaconcurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `extendido` tinyint(1) NOT NULL,
  `fechaExtension` date NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  `etapa_id` int(11) DEFAULT NULL,
  `concurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_409AA7EFC5EE35FA` (`etapa_id`),
  KEY `IDX_409AA7EFF415D168` (`concurso_id`),
  CONSTRAINT `FK_409AA7EFC5EE35FA` FOREIGN KEY (`etapa_id`) REFERENCES `etapa` (`id`),
  CONSTRAINT `FK_409AA7EFF415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of etapaconcurso
-- ----------------------------
INSERT INTO `etapaconcurso` VALUES ('12', '2014-03-21', '2014-03-24', '1', '2013-11-29', '2013-11-29 05:11:54', '2014-03-04 12:14:37', '4', '10');
INSERT INTO `etapaconcurso` VALUES ('13', '2014-03-10', '2014-03-18', '1', '2014-03-04', '2014-03-04 12:10:36', '2014-03-04 12:10:36', '2', '10');
INSERT INTO `etapaconcurso` VALUES ('14', '2014-03-04', '2014-03-08', '1', '2014-03-09', '2014-03-04 12:13:00', '2014-03-04 12:13:00', '1', '10');
INSERT INTO `etapaconcurso` VALUES ('15', '2014-03-19', '2014-03-20', '1', '2014-03-04', '2014-03-04 12:13:26', '2014-03-04 12:13:26', '3', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluador
-- ----------------------------
INSERT INTO `evaluador` VALUES ('17', 'Yumi', 'Tominaga García', 'Av. San Martin S/N Edificio J-204', '41792179', null, 'Intuitive Systems SAC', 'Consultor', 'Calle Pedro Salazar #108', 'Barranco', '4321211', '212332', 'yominagag@sdgperu.com', 'Ate Vitarte', '3589011', '989123417', null, 'Ingeniero de Sistemas', 'Ingeniería de Software', 'ytominagag@gmail.com', null, '0', '0', '0', '2014-03-04 12:41:10', '2014-03-13 09:13:48', '62', '22');
INSERT INTO `evaluador` VALUES ('18', 'Rocio del Pilar', 'Alvan Perez', null, '40953078', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '2014-03-13 10:27:52', '2014-03-13 15:28:30', '63', '23');

-- ----------------------------
-- Table structure for `evaluadordisponibilidad`
-- ----------------------------
DROP TABLE IF EXISTS `evaluadordisponibilidad`;
CREATE TABLE `evaluadordisponibilidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia_id` int(11) DEFAULT NULL,
  `manana` tinyint(1) NOT NULL,
  `tarde` tinyint(1) NOT NULL,
  `noche` tinyint(1) NOT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75A7F8FBAC1F7597` (`dia_id`),
  KEY `IDX_75A7F8FB40815979` (`evaluador_id`),
  CONSTRAINT `FK_75A7F8FB40815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_75A7F8FBAC1F7597` FOREIGN KEY (`dia_id`) REFERENCES `catalogo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluadordisponibilidad
-- ----------------------------
INSERT INTO `evaluadordisponibilidad` VALUES ('35', '26', '0', '0', '1', '17');
INSERT INTO `evaluadordisponibilidad` VALUES ('36', '28', '0', '0', '1', '17');
INSERT INTO `evaluadordisponibilidad` VALUES ('37', '30', '0', '0', '1', '17');

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
  `concurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7837B04EF415D168` (`concurso_id`),
  CONSTRAINT `FK_7837B04EF415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacion
-- ----------------------------
INSERT INTO `grupoevaluacion` VALUES ('1', 'Grupo A1', 'Grupo A1', '1', '2014-03-13 10:49:48', '2014-03-13 10:49:48', '10');

-- ----------------------------
-- Table structure for `grupoevaluacionevaluador`
-- ----------------------------
DROP TABLE IF EXISTS `grupoevaluacionevaluador`;
CREATE TABLE `grupoevaluacionevaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupoevaluacion_id` int(11) DEFAULT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  `lider` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_233E213D403D6E35` (`grupoevaluacion_id`),
  KEY `IDX_233E213D40815979` (`evaluador_id`),
  CONSTRAINT `FK_233E213D403D6E35` FOREIGN KEY (`grupoevaluacion_id`) REFERENCES `grupoevaluacion` (`id`),
  CONSTRAINT `FK_233E213D40815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacionevaluador
-- ----------------------------
INSERT INTO `grupoevaluacionevaluador` VALUES ('1', '1', '17', '2014-03-13 11:06:02', '2014-03-13 11:06:02', '0');
INSERT INTO `grupoevaluacionevaluador` VALUES ('2', '1', '18', '2014-03-13 15:35:16', '2014-03-13 15:35:16', '0');

-- ----------------------------
-- Table structure for `grupoevaluacionpostulante`
-- ----------------------------
DROP TABLE IF EXISTS `grupoevaluacionpostulante`;
CREATE TABLE `grupoevaluacionpostulante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupoevaluacion_id` int(11) DEFAULT NULL,
  `postulante_id` int(11) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_840CAB21403D6E35` (`grupoevaluacion_id`),
  KEY `IDX_840CAB21CCC19F66` (`postulante_id`),
  CONSTRAINT `FK_840CAB21403D6E35` FOREIGN KEY (`grupoevaluacion_id`) REFERENCES `grupoevaluacion` (`id`),
  CONSTRAINT `FK_840CAB21CCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacionpostulante
-- ----------------------------
INSERT INTO `grupoevaluacionpostulante` VALUES ('1', '1', '1', '2014-03-13 11:05:38', '2014-03-13 11:05:38');

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
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_935E99F0F415D168` (`concurso_id`),
  KEY `IDX_935E99F0CCC19F66` (`postulante_id`),
  CONSTRAINT `FK_935E99F0CCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`),
  CONSTRAINT `FK_935E99F0F415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of inscripcion
-- ----------------------------
INSERT INTO `inscripcion` VALUES ('1', 'Mejora de Procesos CRM', 'CRM 2014', 'Edinson NUñez, Juan Tovar, Lino Torres.', null, '2014-02-01', '2014-03-31', null, null, null, '10', 'Procesos de Mejora CRM', '1', '2014-03-13 10:37:32', '2014-03-13 10:37:32');

-- ----------------------------
-- Table structure for `inscripcionevaluador`
-- ----------------------------
DROP TABLE IF EXISTS `inscripcionevaluador`;
CREATE TABLE `inscripcionevaluador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concurso_id` int(11) DEFAULT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_270CA138F415D168` (`concurso_id`),
  KEY `IDX_270CA13840815979` (`evaluador_id`),
  CONSTRAINT `FK_270CA13840815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_270CA138F415D168` FOREIGN KEY (`concurso_id`) REFERENCES `concurso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of inscripcionevaluador
-- ----------------------------
INSERT INTO `inscripcionevaluador` VALUES ('1', '10', '17', '2014-03-13 11:04:46', '2014-03-13 11:04:46');
INSERT INTO `inscripcionevaluador` VALUES ('2', '10', '18', '2014-03-13 15:28:54', '2014-03-13 15:28:54');

-- ----------------------------
-- Table structure for `mensaje`
-- ----------------------------
DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversacion_id` int(11) DEFAULT NULL,
  `mensaje` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_54DE249DABD5A1D6` (`conversacion_id`),
  KEY `IDX_9B631D01DB38439E` (`usuario_id`),
  CONSTRAINT `FK_54DE249DABD5A1D6` FOREIGN KEY (`conversacion_id`) REFERENCES `conversacion` (`id`),
  CONSTRAINT `FK_9B631D01DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mensaje
-- ----------------------------

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
INSERT INTO `menu` VALUES ('16', '3', 'Lista de Postulantes', '', '_admin_postulante', '0', '');
INSERT INTO `menu` VALUES ('17', '4', 'Ficha de Inscripción', '', '', '0', '');
INSERT INTO `menu` VALUES ('18', '4', 'Lista de Evaluadores', '', '_admin_evaluador', '0', '');
INSERT INTO `menu` VALUES ('19', '5', 'Evaluación Individual', '', '_admin_evaluacionindividual', '0', '');
INSERT INTO `menu` VALUES ('20', '5', 'Evaluación de Concenso', '', '_admin_evaluacionconcenso ', '0', '');
INSERT INTO `menu` VALUES ('21', '5', 'Etapa de Visita', '', '', '0', '');
INSERT INTO `menu` VALUES ('22', '5', 'Informe de Retroalimentación', '', '', '0', '');
INSERT INTO `menu` VALUES ('23', '5', 'Asignar Visita', '', '', '0', '');
INSERT INTO `menu` VALUES ('24', '5', 'Encuesta', '', '', '0', '');
INSERT INTO `menu` VALUES ('25', '5', 'Asignar Ganador', '', '', '0', '');
INSERT INTO `menu` VALUES ('26', '7', 'Mantenimiento Conflictos Interes', '', '_admin_tvi_list', '0', '');
INSERT INTO `menu` VALUES ('27', '7', 'Mantenimiento Bases Legales', '', '_admin_ble_list', '0', '');
INSERT INTO `menu` VALUES ('28', '7', 'Mantenimiento Etapas de Evaluación', '', '_admin_etapa', '0', '');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('19', '1', 'revisar documentacion coca cola', '0', '0', '2014-01-25 06:51:58', '2014-01-25 06:51:58');

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
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador', '', '1');
INSERT INTO `perfil` VALUES ('2', 'Evaluador', '', '1');
INSERT INTO `perfil` VALUES ('3', 'Postulante', '', '1');

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
INSERT INTO `postulante` VALUES ('1', 'Coca Cola Company Peru SAC', 'Av. Carretera Central Km34', '20438921121', '4454332', 'www.cocalacompanyperu.com.pe', '214332', '64', '2014-03-13 10:32:33', '2014-03-13 10:34:49');

-- ----------------------------
-- Table structure for `postulantecategoria`
-- ----------------------------
DROP TABLE IF EXISTS `postulantecategoria`;
CREATE TABLE `postulantecategoria` (
  `postulante_id` int(11) NOT NULL,
  `catalogo_id` int(11) NOT NULL,
  PRIMARY KEY (`postulante_id`,`catalogo_id`),
  KEY `IDX_DFD24020CCC19F66` (`postulante_id`),
  KEY `IDX_DFD240204979D753` (`catalogo_id`),
  CONSTRAINT `FK_DFD240204979D753` FOREIGN KEY (`catalogo_id`) REFERENCES `catalogo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DFD24020CCC19F66` FOREIGN KEY (`postulante_id`) REFERENCES `postulante` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulantecategoria
-- ----------------------------
INSERT INTO `postulantecategoria` VALUES ('1', '20');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulantecontacto
-- ----------------------------
INSERT INTO `postulantecontacto` VALUES ('1', '3', '1', 'Carlos Echegaray Ramirez', 'Gerente Comercial', '989123417', '7238134', 'c.echegaray@cocacola');

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
-- Table structure for `respuesta`
-- ----------------------------
DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `respuesta` longtext COLLATE utf8_unicode_ci NOT NULL,
  `puntaje` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `aspectoclave_id` int(11) DEFAULT NULL,
  `evaluador_id` int(11) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaActualizacion` datetime DEFAULT NULL,
  `inscripcion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EE9F474D505FF319` (`concursocriterio_id`),
  KEY `IDX_6C6EC5EE37E3A40A` (`aspectoclave_id`),
  KEY `IDX_6C6EC5EE40815979` (`evaluador_id`),
  KEY `IDX_6C6EC5EEFFD5FBD3` (`inscripcion_id`),
  CONSTRAINT `FK_6C6EC5EEFFD5FBD3` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`),
  CONSTRAINT `FK_6C6EC5EE37E3A40A` FOREIGN KEY (`aspectoclave_id`) REFERENCES `aspectoclave` (`id`),
  CONSTRAINT `FK_6C6EC5EE40815979` FOREIGN KEY (`evaluador_id`) REFERENCES `evaluador` (`id`),
  CONSTRAINT `FK_EE9F474D505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of respuesta
-- ----------------------------
INSERT INTO `respuesta` VALUES ('1', '11', 'respuesta de prueba...', '+', null, '17', '2014-03-13 15:08:38', '2014-03-13 15:08:38', '1');
INSERT INTO `respuesta` VALUES ('2', '14', 'sdasdadasds', '+', '1', '17', '2014-03-13 15:08:53', '2014-03-13 15:08:53', '1');
INSERT INTO `respuesta` VALUES ('3', '14', 'respuesta de rocio', '++', '2', '18', '2014-03-13 15:36:11', '2014-03-13 15:36:11', '1');
INSERT INTO `respuesta` VALUES ('4', '11', 'prueba con inscripcion anexada', '+', null, '17', '2014-03-14 07:37:57', '2014-03-14 07:37:57', '1');
INSERT INTO `respuesta` VALUES ('5', '14', 'lo que sea', '+', '1', '17', '2014-03-14 07:40:05', '2014-03-14 07:40:05', '1');
INSERT INTO `respuesta` VALUES ('6', '14', 'ddddddd', '+', '4', '17', '2014-03-14 07:44:11', '2014-03-14 07:44:11', '1');

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
  `imagen` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `validaregistro` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C192FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_EDD889C1A0D96FBF` (`email_canonical`),
  KEY `IDX_2265B05D57291544` (`perfil_id`),
  KEY `IDX_2265B05D2E595373` (`tipodocumento_id`),
  CONSTRAINT `FK_2265B05D2E595373` FOREIGN KEY (`tipodocumento_id`) REFERENCES `catalogo` (`id`),
  CONSTRAINT `FK_2265B05D57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'admin', 'admin', 'ytominaga@systemsfactoryperu.com', 'ytominaga@systemsfactoryperu.com', '1', '4v46vxp39qm84cskcso4oko8kkw84wo', 'C0hjxcJW5cQqQpV6puRG07fQ9AOpYVYucWkDWNwGi/Ts+1YPTaqmT77j6Iv0ThMGdXY06dfWCBFYZSoF85FPeg==', '2014-03-13 20:02:24', '0', '0', null, null, null, 'a:0:{}', '0', null, '1', 'System Administrator', '', '1', '', '', '1');
INSERT INTO `usuario` VALUES ('62', 'yumi2014', 'yumi2014', 'ytominagag@gmail.com', 'ytominagag@gmail.com', '1', 'j28165zce1c8cgcogk8cckskwwsskk0', 'GiRsbCwK0xaxsfGgJfTLds9avCbF+5gvXChJ8ujQngh9AfQ4OH/Iy/FrcdgD0OUkV3VvWPscPWtpd1zfrhauBQ==', '2014-03-13 11:04:20', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Yumi', 'Tominaga García', '1', '41792179', '62.jpg', '1');
INSERT INTO `usuario` VALUES ('63', 'rocio', 'rocio', 'rocioalvan@gmail.com', 'rocioalvan@gmail.com', '1', 't4bm2axflfkw8k0ksw44k04wgw0wggk', 'h17zr/aMd5d3xyu0RWUw84L/llvhhnWkHx3DjDIgKXETQznJiDFnrGNAW4L7MlnMRnbHz945e6q/g6SkPgYjig==', '2014-03-13 15:24:26', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Rocio del Pilar', 'Alvan Perez', '1', '40953078', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('64', 'carlos100', 'carlos100', 'yumitominaga300383@hotmail.com', 'yumitominaga300383@hotmail.com', '1', 'ayyyt05c76044oc8wc4so8k0wggg8gk', 'W2tfF224GccVymQBfatB7nxf5AhjAuIu0h4YASHclXs/atwlQx5+Buhok+8VSESP/Tg0AjxjrOwUI5dCWZFUNw==', '2014-03-13 10:58:27', '0', '0', null, null, null, 'a:0:{}', '0', null, '3', 'Carlos', 'Cisneros Echegaray', '1', '00043211', 'default.jpg', '1');
