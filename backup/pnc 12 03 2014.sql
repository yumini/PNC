/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50534
Source Host           : localhost:3306
Source Database       : pnc

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2014-03-12 12:48:13
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
  PRIMARY KEY (`id`),
  KEY `IDX_5274D2F0505FF319` (`concursocriterio_id`),
  CONSTRAINT `FK_5274D2F0505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of aspectoclave
-- ----------------------------
INSERT INTO `aspectoclave` VALUES ('1', '6', 'El proyecto tiene que estar totalmente relacionado con las estrategias del negocio ya que de esta...');
INSERT INTO `aspectoclave` VALUES ('2', '6', 'La metodología empleada para la solución de problemas deben ser las relacionadas a las herramient...');
INSERT INTO `aspectoclave` VALUES ('3', '8', 'La alta dirección debe tener estrecha relación con el personal del negocio de tal manera que esto...');
INSERT INTO `aspectoclave` VALUES ('4', '8', 'La metodología empleada para la solución de problemas deben ser las relacionadas a las herramient...	\r\n');
INSERT INTO `aspectoclave` VALUES ('5', '6', 'probandoooo...:D     ');
INSERT INTO `aspectoclave` VALUES ('6', '8', 'jojojjojjoj');
INSERT INTO `aspectoclave` VALUES ('7', '6', ':D');
INSERT INTO `aspectoclave` VALUES ('8', '6', 'este si');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concurso
-- ----------------------------
INSERT INTO `concurso` VALUES ('10', 'Premio Nacional a la Calidad 2013', '2013-01-01', '2013-11-30', 'Declaramos que conocemos las Bases del Premio Nacional a la Calidad, correspondientes al año 2013 y al presentar nuestra postulación nos sometemos a ellas de manera irrevocable. Asimismo aceptamos el carácter inapelable de las decisiones del Consejo Evaluador.\r\n\r\nDeclaramos que es cierta la información y los datos proporcionados en el Informe de Postulación.\r\n\r\nEntendemos que la postulación será revisada por los equipos evaluadores. Si nuestra organización fuera seleccionada para ser visitada, aceptamos recibir dicha visita y otorgar facilidades para que los evaluadores realicen una evaluación prolija  e imparcial.  \r\n\r\nAceptamos pagar las cuotas y los gastos que nos corresponden con arreglo a lo estipulado en las Bases.\r\n\r\nSi nuestra organización resulta ganadora aceptamos cumplir el compromiso de los ganadores en la forma establecida por las Bases.', 'das', 'dsa', 'dsa', 'das', 'dsadsa', 'dasd', 'dasd', 'dasd', 'das', '2013', '1', '0', '1', 'Declaramos que conocemos las Bases del Premio Nacional a la Calidad, correspondientes al año 2013 y al presentar nuestra postulación nos sometemos a ellas de manera irrevocable. Asimismo aceptamos el carácter inapelable de las decisiones del Consejo Evaluador.\r\n\r\nDeclaramos que es cierta la información y los datos proporcionados en el Informe de Postulación.\r\n\r\nEntendemos que la postulación será revisada por los equipos evaluadores. Si nuestra organización fuera seleccionada para ser visitada, aceptamos recibir dicha visita y otorgar facilidades para que los evaluadores realicen una evaluación prolija  e imparcial.  \r\n\r\nAceptamos pagar las cuotas y los gastos que nos corresponden con arreglo a lo estipulado en las Bases.\r\n\r\nSi nuestra organización resulta ganadora aceptamos cumplir el compromiso de los ganadores en la forma establecida por las Bases.', '5', '1', 'El Informe de Retroalimentación se genera durante las siguientes etapas del proceso de evaluación: \r\nEvaluación por el Jurado Calificador\r\n- Evaluación individual\r\nLos equipos de evaluadores son conformados, atendiendo criterios de conocimientos, experiencias, habilidades y a la no existencia de conflictos de interés.\r\nLos evaluadores de manera individual y a través de la lectura y estudio detallado del trabajo de aplicación, proceden a llenar el Cuaderno de Evaluación junto a los primeros hallazgos de fortalezas, áreas de mejora y temas para la visita en terreno.\r\n- Evaluación en consenso\r\nCon el objeto de enriquecer la evaluación individual con los conocimientos y experiencias de los evaluadores, se busca construir una percepción de equipo, enriquecida con los aportes individuales, realizándose para ello diversas reuniones de revisión y consenso. Luego de aclarar las diferencias de interpretación, se obtiene el Informe de Consenso.\r\nEl Consejo Evaluador reúne los Informes de Consenso, correspondientes a todas las postulaciones objeto de evaluación, y define qué trabajos recibirán visitas en terreno.\r\nEvaluación en terreno\r\nEn esta etapa se realizan visitas a las empresas con el propósito de verificar la información presentada en los trabajos. \r\nDurante la visita se llevan a cabo entrevistas con directivos, ejecutivos y responsables de la información contenida en el documento de postulación.  Se tratan con prioridad los temas identificados como poco claros en el informe o los aspectos relacionados con el despliegue.\r\nLos hallazgos en la visita pueden aumentar o disminuir la evaluación realizada  previamente y modificar en cierta medida las fortalezas y áreas de mejora identificadas en el Informe de Consenso.\r\nLuego de la visita, el equipo evaluador se reúne nuevamente y prepara el Informe de Visita en Terreno, documento que es revisado por la Secretaría Técnica para determinar si continúa hacia la fase final de evaluación.\r\nSustentación ante el Consejo Evaluador\r\nAnte la presencia de los miembros del Consejo Evaluador, se realiza la evaluación final. En la sustentación ante el Consejo, conformado por personalidades de las instituciones del Comité de Gestión de la Calidad y líderes de los equipos sin conflictos de interés, se analiza la postulación en sus aspectos esenciales. Además de los criterios técnicos, son considerados como determinantes el compromiso de la Alta Dirección de la empresa,  la responsabilidad social y los valores éticos sobre los cuáles se construye la organización. Es decir, se analiza la capacidad de la empresa para convertirse en un ejemplo para las demás organizaciones del país.', 'Los métodos de evaluación de los Premios Nacionales a la Calidad son prácticamente universales. El objetivo fundamental de tales métodos es lograr una evaluación técnicamente sólida y exenta, en la medida de lo posible, de subjetividad.\r\nEl proceso de calificación se encuentra detallado en las Bases del Premio Nacional a la Calidad. No obstante, consideramos oportuno para la mayor comprensión de este informe hacer algunas precisiones relacionadas con aspectos fundamentales tomados en cuenta en la evaluación.\r\nRelevancia y pertinencia como un factor de puntuación \r\nEn el proceso de evaluación no todos los aspectos son considerados por igual.  Aquellos más importantes para el éxito de la organización, es decir relacionados con las necesidades clave del cliente y los factores clave de la organización, constituyen lo que es “relevante”.\r\nPor otro lado, aquello que la organización necesita afrontar con mayor énfasis debido a que está estrechamente relacionado con su negocio o ámbito de acción, se convierte en algo “pertinente”.\r\nLo que es relevante y pertinente en una organización puede no serlo en otras, por ello es importante identificar estos aspectos y tenerlos en cuenta en el momento de la evaluación.\r\nPara la evaluación de Modelos de Excelencia las tres dimensiones de la evaluación: enfoque (métodos de la empresa para alcanzar los objetivos señalados en cada sub-criterio), despliegue (extensión en que los enfoques son aplicados en todas las áreas relevantes de la empresa) y resultados (los efectos obtenidos en los subcriterios evaluados), son analizadas con base en la tabla de evaluación y considerando los criterios de relevancia y pertinencia. \r\nSímbolos “+”, “++”, “-” y “- -”  \r\nLas fortalezas se designan con el prefijo “+” y las áreas para mejora con “-”. Las fortalezas o áreas de mejora importantes se representan con “++” o “- -”, respectivamente.\r\nDocumento final\r\nCon el aporte de los comentarios realizados por el Consejo y el Proceso de Calificación, los equipos de evaluadores se vuelven a reunir para elaborar el Informe de Retroalimentación que será entregado a los postulantes.', 'dsa', '13');
INSERT INTO `concurso` VALUES ('11', 'prueba', '2013-11-07', '2013-11-14', 'fsfsdfsdfds', 'fsd', 'dsdas', 'dsad', 'dass', 'dasda', 'dsad', 'dasd', 'dsa', 'dasd', '2013', '0', '0', '0', 'fsdfsdfsdfs', '1', '1', 'das', 'das', 'dsa', '13');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of concursocriterio
-- ----------------------------
INSERT INTO `concursocriterio` VALUES ('1', '7', '9', '0', 'AC', 'Aspectos Claves', '20', 'prueba', 'prueba', null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('6', null, '10', '1', '1', 'Vinculo del proyecto con la estratega del negocio', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('8', null, '10', '1', '2', 'Metodología empleada para la solución del problema', '1', null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('9', '6', '9', '0', '1', 'Liderazgo y Compromiso de Alta Dirección', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('10', null, '10', '9', '1.1', 'Organización de Soporte para promover el trbajo en equipo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('11', null, '10', '9', '1.2', 'Facilidades Otorgadas a los equipos de proyectos  de mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('12', null, '10', '1', '3', 'Soporte de la alta dirección  al proyecto', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('13', null, '10', '1', '4', 'Resultados Obtenidos', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('14', '6', '9', '0', '2', 'Identificacion y seleccion del proyecto de mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('15', null, '10', '14', '3.1', 'Analisis de la estrategia d la organizacion y oportunidades de mejora', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('16', null, '11', '10', '1.1.1', 'Organización de Soporte para promover el trbajo en equipo', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('17', null, '12', '16', '1.1.1.a', '¿Cómo hace efectiva o pone en práctica tales políticas?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('18', null, '12', '16', '1.1.1.b', '¿Con qué políticas o normas se promueve el trabajo en equipo al interior de la organización?', null, null, null, null, null, null, '10');
INSERT INTO `concursocriterio` VALUES ('19', null, '11', '10', '', 's fdfs fdgdfgdfgdfgdf ', null, null, null, null, null, null, '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conflictointeresevaluador
-- ----------------------------
INSERT INTO `conflictointeresevaluador` VALUES ('5', '24', 'everis Perú SAC', '20393353487', '2012-07-01', '2013-06-28', 'Consultor en everis', '4');
INSERT INTO `conflictointeresevaluador` VALUES ('6', '25', 'GMD', '2045678988', '2010-01-02', '2011-10-30', 'Consultor externo para el cliente Petro Perú.', '4');
INSERT INTO `conflictointeresevaluador` VALUES ('7', '25', 'INDRA', '2056301242', '2012-04-15', '2012-09-20', 'Consultor Externo', '4');
INSERT INTO `conflictointeresevaluador` VALUES ('8', '24', 'Industrias ABC', '12345678901', '2013-10-01', '2013-10-26', 'ninguno', '5');
INSERT INTO `conflictointeresevaluador` VALUES ('9', '24', 'sdadsadasd', '3213123123', '2013-10-01', '2013-10-12', 'dsad', '5');
INSERT INTO `conflictointeresevaluador` VALUES ('10', '24', 'sda  dadsa das', '32323123321', '2013-10-01', '2013-10-05', 'fsfsdfsd', '5');
INSERT INTO `conflictointeresevaluador` VALUES ('11', '24', 'e vqeqweqeqwe', '32314423424', '2013-10-01', '2013-10-05', 'eqw eqweqweqweqweqweqwqwe', '5');
INSERT INTO `conflictointeresevaluador` VALUES ('12', '24', 'dasdasd', '31231313232', '2013-10-01', '2013-10-05', 'sdfdsfdsfsd', null);
INSERT INTO `conflictointeresevaluador` VALUES ('13', '24', 'dasdas', 'dasda', '2013-10-04', '2013-10-18', 'dasdas', null);
INSERT INTO `conflictointeresevaluador` VALUES ('14', '24', 'fsdfsfsd', 'fsdfsdfs', '2013-10-01', '2013-10-11', 'fsdfsdfsf', '4');
INSERT INTO `conflictointeresevaluador` VALUES ('15', '24', 'jkkhk', '45456464', '2013-10-03', '2013-10-17', 'kjhkhkh', '13');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conversacion
-- ----------------------------
INSERT INTO `conversacion` VALUES ('1', 'Con:', 'Yumi Tominaga García,Rocio del Pilar Alvan Perez,', '2014-03-08 16:17:51', '2014-03-08 16:17:51');

-- ----------------------------
-- Table structure for `criterioaspectoclave`
-- ----------------------------
DROP TABLE IF EXISTS `criterioaspectoclave`;
CREATE TABLE `criterioaspectoclave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `aspectoclave_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_87114C5A505FF319` (`concursocriterio_id`),
  KEY `IDX_441DE8AD37E3A40A` (`aspectoclave_id`),
  CONSTRAINT `FK_441DE8AD37E3A40A` FOREIGN KEY (`aspectoclave_id`) REFERENCES `aspectoclave` (`id`),
  CONSTRAINT `FK_441DE8AD505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of criterioaspectoclave
-- ----------------------------
INSERT INTO `criterioaspectoclave` VALUES ('1', '10', '1');
INSERT INTO `criterioaspectoclave` VALUES ('2', '10', '2');

-- ----------------------------
-- Table structure for `criteriovisita`
-- ----------------------------
DROP TABLE IF EXISTS `criteriovisita`;
CREATE TABLE `criteriovisita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concursocriterio_id` int(11) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D5D27E8505FF319` (`concursocriterio_id`),
  CONSTRAINT `FK_5D5D27E8505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of criteriovisita
-- ----------------------------
INSERT INTO `criteriovisita` VALUES ('19', '10', 'visita requerida....');
INSERT INTO `criteriovisita` VALUES ('20', '10', 'O');
INSERT INTO `criteriovisita` VALUES ('21', '11', 'ahora si funciona XD');

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
INSERT INTO `etapa` VALUES ('1', '16', '14', 'Etapa indidual fsdfdsdsffs', '2013-10-04 00:43:20', '2014-02-02 07:33:10', '1', '0');
INSERT INTO `etapa` VALUES ('2', '15', '13', 'gfdgdfgdfgd', '2013-10-04 08:31:14', '2013-10-04 08:31:14', '1', '0');
INSERT INTO `etapa` VALUES ('3', '15', '13', 'ajaaaa', '2013-10-04 08:31:28', '2013-10-04 08:31:28', '1', '0');
INSERT INTO `etapa` VALUES ('4', '17', '14', 'jojojojojo', '2013-10-04 08:32:31', '2013-10-04 08:32:31', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of etapaconcurso
-- ----------------------------
INSERT INTO `etapaconcurso` VALUES ('9', '2013-11-01', '2013-11-20', '1', '2013-11-27', '2013-11-28 03:18:31', '2013-11-28 05:16:05', '1', '10');
INSERT INTO `etapaconcurso` VALUES ('10', '2013-11-11', '2013-11-13', '1', '2013-11-19', '2013-11-28 05:15:05', '2013-11-28 05:15:16', '2', '10');
INSERT INTO `etapaconcurso` VALUES ('11', '2013-11-07', '2013-11-09', '1', '2013-11-28', '2013-11-28 05:16:13', '2013-11-28 05:16:23', '3', '10');
INSERT INTO `etapaconcurso` VALUES ('12', '2013-11-01', '2013-11-30', '1', '2013-11-29', '2013-11-29 05:11:54', '2013-11-29 05:11:54', '4', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluador
-- ----------------------------
INSERT INTO `evaluador` VALUES ('4', 'Yumi', 'Tominaga García', 'Av. San Martin Edificio J-204', '41792176', null, 'Consorcio Fabrica de Software para SUNAT', 'Analista de Software', 'Pasaje Acuña 176', 'Cercado de Lima', '4565221', '4565221', 'ytominagag@gmail.com', 'Ate Vitarte', '3582533', '943893341', null, 'Ingeniero de Sistemas', 'Ingeniería de Software', 'ytominagag@gmail.com', 'yumitominaga300383@hotmail.com', '0', '0', '0', '2013-10-25 03:26:42', '2013-10-31 08:49:05', '17', '22');
INSERT INTO `evaluador` VALUES ('5', 'Edinson', 'Nuñez More', 'Las Dalias 133', '788956451278', null, null, null, 'Las Dalias 133', null, null, null, null, null, null, null, null, 'Ing. Informatico', 'Developer', null, null, '0', '0', '0', '2013-10-25 06:27:54', '2014-03-07 15:42:16', '19', '22');
INSERT INTO `evaluador` VALUES ('12', 'Rocio del Pilar', 'Alvan Perez', null, '40953578', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2013-10-25 06:57:20', '2013-10-25 06:57:20', '18', null);
INSERT INTO `evaluador` VALUES ('13', 'Alvia', 'Carbajal Camposano', null, '457889456', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2013-10-28 05:38:21', '2013-10-28 05:38:21', '22', null);
INSERT INTO `evaluador` VALUES ('14', 'ssss', 'sss', null, '9876543211', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2013-10-31 05:46:56', '2013-10-31 05:46:56', '25', null);
INSERT INTO `evaluador` VALUES ('15', 'prueba', 'prueba', null, '12345678911', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2013-10-31 07:31:45', '2013-10-31 07:31:45', '24', null);
INSERT INTO `evaluador` VALUES ('16', 'olivia', 'de popeye', null, '7845128945', null, null, null, null, null, null, null, null, null, null, null, null, 'ninguna', null, null, null, '0', '0', '0', '2013-11-10 23:23:49', '2013-11-10 23:27:13', '59', '23');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of evaluadordisponibilidad
-- ----------------------------
INSERT INTO `evaluadordisponibilidad` VALUES ('16', '26', '0', '0', '1', '4');
INSERT INTO `evaluadordisponibilidad` VALUES ('17', '27', '1', '0', '0', '4');
INSERT INTO `evaluadordisponibilidad` VALUES ('18', '28', '0', '0', '1', '4');
INSERT INTO `evaluadordisponibilidad` VALUES ('20', '26', '1', '1', '1', '5');
INSERT INTO `evaluadordisponibilidad` VALUES ('22', '28', '1', '1', '0', '5');
INSERT INTO `evaluadordisponibilidad` VALUES ('27', '27', '0', '1', '0', '5');
INSERT INTO `evaluadordisponibilidad` VALUES ('28', '31', '0', '1', '0', null);
INSERT INTO `evaluadordisponibilidad` VALUES ('29', '30', '0', '1', '0', null);
INSERT INTO `evaluadordisponibilidad` VALUES ('32', '26', '0', '1', '0', '15');
INSERT INTO `evaluadordisponibilidad` VALUES ('34', '31', '0', '1', '0', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacion
-- ----------------------------
INSERT INTO `grupoevaluacion` VALUES ('2', 'Grupo ABC', 'probando nuevo grupo de evaluación', '1', '2013-10-28 01:04:58', '2013-10-28 01:11:06', '10');
INSERT INTO `grupoevaluacion` VALUES ('3', 'wfsdfsdfsdfsdfs', 'fsdfsdfsdds', '1', '2014-02-02 07:39:45', '2014-02-02 07:39:45', '10');
INSERT INTO `grupoevaluacion` VALUES ('4', 'zczfzdfsd', 'fdsfsdfds', '1', '2014-03-07 15:51:44', '2014-03-07 15:51:44', '10');
INSERT INTO `grupoevaluacion` VALUES ('5', 'Grupo 2', 'dsfsdfsdfdsfdsfsdf dsfsdf', '1', '2014-03-07 15:52:08', '2014-03-08 18:30:41', '11');
INSERT INTO `grupoevaluacion` VALUES ('6', 'fsdfdsf', 'dsfsdfsdfdsfdsfsd', '1', '2014-03-07 15:52:21', '2014-03-07 15:52:21', '10');
INSERT INTO `grupoevaluacion` VALUES ('7', 'fdsfdsfds', 'fsdfsdfsdfsdfds', '1', '2014-03-07 15:52:37', '2014-03-07 15:52:37', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacionevaluador
-- ----------------------------
INSERT INTO `grupoevaluacionevaluador` VALUES ('9', '2', '5', '2013-11-11 04:44:16', '2013-11-11 04:44:16', '1');
INSERT INTO `grupoevaluacionevaluador` VALUES ('10', '5', '4', '2014-03-08 18:40:42', '2014-03-08 18:40:42', '0');
INSERT INTO `grupoevaluacionevaluador` VALUES ('11', '2', '4', '2014-03-08 18:41:04', '2014-03-08 18:41:04', '0');
INSERT INTO `grupoevaluacionevaluador` VALUES ('12', '2', '16', '2014-03-08 18:41:12', '2014-03-08 18:41:12', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grupoevaluacionpostulante
-- ----------------------------
INSERT INTO `grupoevaluacionpostulante` VALUES ('8', '2', '3', '2013-11-11 04:42:19', '2013-11-11 04:42:19');
INSERT INTO `grupoevaluacionpostulante` VALUES ('10', '5', '1', '2014-03-08 18:40:32', '2014-03-08 18:40:32');
INSERT INTO `grupoevaluacionpostulante` VALUES ('11', '3', '1', '2014-03-08 18:41:46', '2014-03-08 18:41:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of inscripcion
-- ----------------------------
INSERT INTO `inscripcion` VALUES ('1', 'proyecto ABC', null, 'ninguno', null, '2013-10-01', '2013-10-28', null, null, null, '10', 'ninguno', '1', '2013-10-27 23:58:39', '2013-10-27 23:58:39');
INSERT INTO `inscripcion` VALUES ('2', 'proyecto 1', 'pr1', 'ninguno', null, '2013-11-21', '2013-11-22', null, null, null, '10', 'ninguno', '3', '2013-11-10 20:31:08', '2013-11-10 20:31:08');
INSERT INTO `inscripcion` VALUES ('3', 'Proyecto Mejora Envasado', 'Envasado', null, null, '2014-03-01', '2014-03-09', null, null, null, '11', null, '1', '2014-03-08 18:36:14', '2014-03-08 18:36:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of inscripcionevaluador
-- ----------------------------
INSERT INTO `inscripcionevaluador` VALUES ('8', '10', '5', '2013-10-29 07:45:33', '2013-10-29 07:45:33');
INSERT INTO `inscripcionevaluador` VALUES ('9', '10', '16', '2013-11-10 23:29:58', '2013-11-10 23:29:58');
INSERT INTO `inscripcionevaluador` VALUES ('10', '10', '4', '2014-03-08 18:32:37', '2014-03-08 18:32:37');
INSERT INTO `inscripcionevaluador` VALUES ('11', '11', '4', '2014-03-08 18:33:05', '2014-03-08 18:33:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mensaje
-- ----------------------------
INSERT INTO `mensaje` VALUES ('1', '1', 'probando conversacion', '2014-03-08 16:17:58', '19');
INSERT INTO `mensaje` VALUES ('2', '1', 'jajajaja', '2014-03-08 16:18:01', '19');
INSERT INTO `mensaje` VALUES ('3', '1', 'si parece que si funciona', '2014-03-08 16:18:04', '19');
INSERT INTO `mensaje` VALUES ('4', '1', 'habla man que tal como vas??', '2014-03-08 19:23:33', '19');
INSERT INTO `mensaje` VALUES ('5', '1', 'creo que esto si funciona', '2014-03-08 19:23:59', '19');
INSERT INTO `mensaje` VALUES ('6', '1', 'probando', '2014-03-08 19:32:02', '19');
INSERT INTO `mensaje` VALUES ('7', '1', 'espero te llegue el chat\'', '2014-03-08 19:32:12', '19');
INSERT INTO `mensaje` VALUES ('8', '1', 'probando el chat', '2014-03-08 19:38:17', '19');
INSERT INTO `mensaje` VALUES ('9', '1', 'ahora si esta bien', '2014-03-08 19:38:20', '19');
INSERT INTO `mensaje` VALUES ('10', '1', 'y no esta el  como andaba hace ratoquipo medio lag', '2014-03-08 19:38:30', '19');
INSERT INTO `mensaje` VALUES ('11', '1', 'queria su reiniciada', '2014-03-08 19:38:36', '19');
INSERT INTO `mensaje` VALUES ('12', '1', 'XD', '2014-03-08 19:38:37', '19');
INSERT INTO `mensaje` VALUES ('13', '1', ':O', '2014-03-08 21:27:41', '19');
INSERT INTO `mensaje` VALUES ('14', '1', '-.-', '2014-03-09 12:02:11', '19');
INSERT INTO `mensaje` VALUES ('15', '1', ':D', '2014-03-09 13:34:39', '19');
INSERT INTO `mensaje` VALUES ('16', '1', 'probando el chat', '2014-03-10 16:02:16', '19');
INSERT INTO `mensaje` VALUES ('17', '1', 'en su nueva posicion ', '2014-03-10 16:02:26', '19');

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
INSERT INTO `menu` VALUES ('19', '5', 'Evaluación Individual', '', '_admin_evaluacionindividual_page', '0', '');
INSERT INTO `menu` VALUES ('20', '5', 'Evaluación de Concenso', '', '', '0', '');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('18', '1', 'edinson', '0', '0', '2014-01-25 06:51:36', '2014-01-25 06:51:36');
INSERT INTO `nota` VALUES ('19', '1', 'revisar documentacion coca cola', '0', '0', '2014-01-25 06:51:58', '2014-01-25 06:51:58');
INSERT INTO `nota` VALUES ('22', '1', 'fdsfsdfsdfd', '0', '0', '2014-01-25 07:10:48', '2014-01-25 07:10:48');
INSERT INTO `nota` VALUES ('23', '1', 'fdsfdsdsfdsfsdfs', '0', '0', '2014-01-25 07:10:52', '2014-01-25 07:10:52');
INSERT INTO `nota` VALUES ('25', '1', 'fsdfdsfsdfdsfdsff', '0', '0', '2014-01-25 07:11:06', '2014-01-25 07:11:06');
INSERT INTO `nota` VALUES ('26', '1', 'hfghfgh', '0', '0', '2014-03-07 17:30:14', '2014-03-07 17:30:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador', '', '1');
INSERT INTO `perfil` VALUES ('2', 'Evaluador', '', '1');
INSERT INTO `perfil` VALUES ('3', 'Postulante', '', '1');
INSERT INTO `perfil` VALUES ('4', 'prueba', null, '1');
INSERT INTO `perfil` VALUES ('5', 'rwerwrwer', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulante
-- ----------------------------
INSERT INTO `postulante` VALUES ('1', 'Lindley Cocacoloa', 'Dalias 133', '12345678901', '44324342', 'fdffdf', 'fgfgf', '21', '2013-10-27 02:04:47', '2013-11-10 19:26:45');
INSERT INTO `postulante` VALUES ('2', 'test razon social', 'sdsd', '434343', '434434343', 'dsd', 'dsdsdsd', '28', '2013-10-31 07:33:22', '2013-10-31 08:22:11');
INSERT INTO `postulante` VALUES ('3', 'Empresa ABC', 'nose', '11111111111', '333', 'aaa', 'aa', '57', '2013-11-10 20:23:25', '2013-11-10 20:30:27');

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
INSERT INTO `postulantecategoria` VALUES ('1', '19');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of postulantecontacto
-- ----------------------------
INSERT INTO `postulantecontacto` VALUES ('1', '3', '1', 'fsfsdf', 'fsdfds', 'fsdfsd', 'fsdfsdf', 'fsdfsd@dds.ds');
INSERT INTO `postulantecontacto` VALUES ('2', '3', '1', 'kjlkj', 'gfgdfg', '534534', 'gfdgd', 'gfgdf');

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
  PRIMARY KEY (`id`),
  KEY `IDX_EE9F474D505FF319` (`concursocriterio_id`),
  CONSTRAINT `FK_EE9F474D505FF319` FOREIGN KEY (`concursocriterio_id`) REFERENCES `concursocriterio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of respuesta
-- ----------------------------
INSERT INTO `respuesta` VALUES ('1', '17', 'fortaleza subcriterios', '++');
INSERT INTO `respuesta` VALUES ('2', '17', 'fortaleza subcriterio', '+');
INSERT INTO `respuesta` VALUES ('3', '17', 'area mejora subcriterio', '--');
INSERT INTO `respuesta` VALUES ('4', '9', 'Area de mejora criterio', '--');
INSERT INTO `respuesta` VALUES ('5', '9', 'fortaleza del criteriok', '++');
INSERT INTO `respuesta` VALUES ('6', '18', 'jhjk hkjhkj h', '++');
INSERT INTO `respuesta` VALUES ('7', '18', 'jkjkl jklj kl jklj', '+');
INSERT INTO `respuesta` VALUES ('10', '9', 'pruebaaaa', '+');
INSERT INTO `respuesta` VALUES ('11', '9', ':O eso fue rapido... XD', '++');
INSERT INTO `respuesta` VALUES ('12', '9', 'negativo positivo :D', '--');
INSERT INTO `respuesta` VALUES ('13', '17', ':OOOOOO', '++');
INSERT INTO `respuesta` VALUES ('14', '14', 'uyuiybuiyuyui uui uiyiuoy oui uioyi', '+');
INSERT INTO `respuesta` VALUES ('15', '17', ':P', '+');
INSERT INTO `respuesta` VALUES ('16', '17', 'iu yuiy i uiy ui y', '--');

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'admin', 'admin', 'chrisv@tiam-v.com', 'chrisv@tiam-v.com', '1', '4v46vxp39qm84cskcso4oko8kkw84wo', 'C0hjxcJW5cQqQpV6puRG07fQ9AOpYVYucWkDWNwGi/Ts+1YPTaqmT77j6Iv0ThMGdXY06dfWCBFYZSoF85FPeg==', '2014-03-12 18:40:36', '0', '0', null, null, null, 'a:0:{}', '0', null, '1', '', '', null, '', '', '1');
INSERT INTO `usuario` VALUES ('17', 'yumi2013', 'yumi2013', 'ytominagag@gmail.com', 'ytominagag@gmail.com', '1', '1hwxl2bivpokoscw04g0k04w0swo88c', '5rAqc8Bb9F6uU6zWWjg8i7Ko7LYfGN2HOGtpJIIeKxs44qFcF5Ga9lVuf+7DZ/8NG3jvN0LsjgaMicnpDi0BsQ==', '2014-03-08 18:32:07', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Yumi', 'Tominaga García', '1', '41792179', '17.png', '1');
INSERT INTO `usuario` VALUES ('18', 'rocio2013', 'rocio2013', 'rocioalvan@gmail.com', 'rocioalvan@gmail.com', '1', '65kqfj6yhx0c8s884s8wookk80ks080', '0TAiN3rBF58DgVTiFVpcNTbUilx3jIH163yA0lqPSR0fzVFABw5s3fdlZUJJf20Buc2yE0NmWccg+KvpSiPBig==', '2013-10-25 03:03:52', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Rocio del Pilar', 'Alvan Perez', '1', '40953578', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('19', 'nmedinson', 'nmedinson', 'nmedinson@gmail.com', 'nmedinson@gmail.com', '1', 'eg9ju950at4wwo0ckk44ow4ks044gk4', 'f4+2XSK2+mXPoXI8BB3DY3c5gZSB2B2lks9oUHwd5xXqySsCb6J6aU2ZP+SaGvuIBVjJSK4/R9bjtMjReXkzpA==', '2014-03-12 18:42:00', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Edinson', 'Nuñez More', '1', '788956451278', '19.jpg', '1');
INSERT INTO `usuario` VALUES ('20', 'test', 'test', 'nmedinson@hotmail.com', 'nmedinson@hotmail.com', '1', '3z5fo8p8xoisw88swwkgw00swcws44', 'QdEgmmSJliJxYtW6+Y97zzIJ7o0+0m7QQsZW4vY3O20HEh4JxxPzkNoVjxIvjTpVes03lKtKa798rJj7DBB1WA==', '2014-03-08 18:37:12', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'test', 'test', '1', '45125645785', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('21', 'enunemor', 'enunemor', 'enunemor@everis.com', 'enunemor@everis.com', '1', 'fmgnmknnme8g80gko084ock8kcwcso8', 'I659D/OH0xT9xEYSPA8myW/O/IyiLTDbufoigyLjs4rcFxEn5WBvN+SXoBwt5VPXXbGOzE8YSkxKvNgzMATclQ==', '2014-03-12 18:41:26', '0', '0', null, null, null, 'a:0:{}', '0', null, '3', 'Edi', 'Nuñez', '1', '32893289382', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('22', 'misha', 'misha', 'newkey_18@hotmail.com', 'newkey_18@hotmail.com', '1', 'mq9jubm6w6osk8swswko4wck4g048s8', 'AFNnyZqzsr98QFxCMlblTTsupoA2wIPkJ6pc/gSnxGm5eCT46aR32Wyi+J2K8EwKulGEYm015YB0W5iyA2u4Kg==', '2013-10-28 05:38:52', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'Alvia', 'Carbajal Camposano', '1', '457889456', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('23', 'aaa', 'aaa', 'eeqweqw@dsdsd.ds', 'eeqweqw@dsdsd.ds', '1', 'pxhmipeqy2sk04sggggowggg04s4k80', 'Uz/ZGV9WvqmWctMffCPvHSMSR05bbIkFwAEEHFmJwi77f0MhvHTfeFcmY+PuhB2jPjLUvoKbKHbMsw1axCKoyg==', null, '0', '0', null, null, null, 'a:0:{}', '0', null, '1', 'eqweq', 'eqweq', '1', '423423432', 'default.jpg', '0');
INSERT INTO `usuario` VALUES ('24', 'prueba', 'prueba', 'prueba@prueba.com', 'prueba@prueba.com', '1', '1fgwu6jpyu808sgkcs8c880csc8o0ck', 'HANi+AWTeU2tl35P+QkPDCT+0fZExNwaWmiK6JO/vSibKxQRPbeb8ShPg3y1c6Mm5lL1280KYMpOEoMqbt4JVQ==', null, '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'prueba', 'prueba', '1', '12345678911', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('25', 'xxxxx', 'xxxxx', 'aaa@ss.zz', 'aaa@ss.zz', '0', 'nbnfrge2xm8okockcc4c0woscckcg4c', 'itY8gZbKOv41L4mGnLWLTdgQrE+qsmNFGmTtTSvK/jj5u0CykbfT/wHFwIsbKkqWp8rrFSgjjyKDwUKL/FzE/Q==', null, '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'AAAA', 'BBBB', '1', '9876543211', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('28', 'testt', 'testt', 'test@dsd.ds', 'test@dsd.ds', '1', '51o1lbock680s4kwokg8cwkcoks44o8', '/4mYAUjquQEoIEeEt8lajOVjMVJX8uUQii86eheabFBqKh4XE0wQyhnqVHZZ1ksGwUWgTCfaqUgSXSJp/zID5w==', null, '0', '0', null, null, null, 'a:0:{}', '0', null, '3', 'testt', 'testt', '1', '43654333333', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('57', 'prueba1', 'prueba1', 'prueba1@prueba1.com', 'prueba1@prueba1.com', '1', 'i9fwgg3ci6o8o8o884sc00g8oso08kg', 'BpHCGPGvkUVszACmIk0ie7T2wkdikIL5rV+W+tBxZy1/s5wOyHExIpopKgpW4F1hAJXOvXKJ5FWLkn70PomWng==', '2013-11-10 20:24:02', '0', '0', null, null, null, 'a:0:{}', '0', null, '3', 'prueba', 'prueba', '1', '788956451223', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('58', 'popeye', 'popeye', 'popeye@ddd.dd', 'popeye@ddd.dd', '1', 'ecy7c8ftktkosk4cowk80s8kw08cso0', 'yKDEMoSPtFrOC9ZEXVRzc7MW3Eheb+NZy5SyZft0rQjl7taLigW3vnErT8PkEAPXkp67XGlC91pf3mAmXouk8g==', '2014-03-08 18:39:02', '0', '0', null, null, null, 'a:0:{}', '0', null, '1', 'popeye', 'el marino', '1', '786544545', 'default.jpg', '1');
INSERT INTO `usuario` VALUES ('59', 'oli', 'oli', 'olivia@dsds.com', 'olivia@dsds.com', '1', 'lr3cpgtghe88cgw0w4s8ogwc4ko88wg', '53DhPHGYDHT+1bdwcDS6pZtrrjYSNUn6W5jZNGSGJOfkXA2hmMEv5aKGJ4mI8Dcry/W0fego+0yWXQeiLH0xog==', '2013-11-10 23:29:32', '0', '0', null, null, null, 'a:0:{}', '0', null, '2', 'olivia', 'de popeye', '1', '7845128945', 'default.jpg', '1');
