-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2017 at 05:28 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET FOREIGN_KEY_CHECKS = 0;
drop table if exists servicios;
drop table if exists direccion;
drop table if exists foto_inmueble;
drop table if exists inmueble;
drop table if exists inm_alquiler;
drop table if exists inm_alquiler_contrato;
drop table if exists inm_alquiler_seniado;
drop table if exists periodos_contrato;
drop table if exists servicios_contrato;
drop table if exists persona;
drop table if exists rol;
drop table if exists telefono;
drop table if exists tipo_telefono;
drop table if exists usuario;
drop table if exists disponibilidad;
SET FOREIGN_KEY_CHECKS = 1;

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `sftp_inmoba`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sftp_inmoba`;

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
INSERT INTO `servicios` (`id`, `nombre`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'Expensas',NULL, NULL, NULL, NULL);
INSERT INTO `servicios` (`id`, `nombre`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(2, 'Municipal',NULL, NULL, NULL, NULL);
INSERT INTO `servicios` (`id`, `nombre`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(3, 'Agua',NULL, NULL, NULL, NULL);
INSERT INTO `servicios` (`id`, `nombre`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(4, 'Gas',NULL, NULL, NULL, NULL);
INSERT INTO `servicios` (`id`, `nombre`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(5, 'Luz',NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE `direccion` (
  `id` int(11) NOT NULL,
  `calle` varchar(45) NOT NULL,
  `nro` int(11) NOT NULL,
  `piso` varchar(45) DEFAULT NULL,
  `dpto` varchar(45) DEFAULT NULL,
  `entre_calles` varchar(200) DEFAULT NULL,
  `zona` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `cod_postal` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `direccion`
--

INSERT INTO `direccion` (`id`, `calle`, `nro`, `piso`, `dpto`, `entre_calles`, `zona`, `ciudad`, `provincia`, `cod_postal`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'Lamadrid', 2715, '5', 'A', '', '', 'Olavarría', 'Buenos Aires', '', NULL , NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disponibilidad`
--

DROP TABLE IF EXISTS `disponibilidad`;
CREATE TABLE `disponibilidad` (
  `id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `disponibilidad`
--

INSERT INTO `disponibilidad` (`id`, `tipo`, `descripcion`) VALUES(0, 0, 'Contrato vigente');
INSERT INTO `disponibilidad` (`id`, `tipo`, `descripcion`) VALUES(1, 1, 'Disponible');
INSERT INTO `disponibilidad` (`id`, `tipo`, `descripcion`) VALUES(2, 2, 'Señada');
INSERT INTO `disponibilidad` (`id`, `tipo`, `descripcion`) VALUES(3, 3, 'Contrato vencido');

-- --------------------------------------------------------

--
-- Table structure for table `foto_inmueble`
--

DROP TABLE IF EXISTS `foto_inmueble`;
CREATE TABLE `foto_inmueble` (
  `id` int(11) NOT NULL,
  `id_inmueble` int(11) DEFAULT NULL,
  `id_foto` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inmueble`
--

DROP TABLE IF EXISTS `inmueble`;
CREATE TABLE `inmueble` (
  `id` int(11) NOT NULL,
  `id_foto` varchar(200) DEFAULT NULL,
  `medidas_lote` varchar(45) DEFAULT NULL,
  `mts2` varchar(45) DEFAULT NULL,
  `comodidades` varchar(200) DEFAULT NULL,
  `papeles` varchar(45) DEFAULT NULL,
  `id_direccion` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `inmueble`
--

-- --------------------------------------------------------

--
-- Table structure for table `inm_alquiler`
--

DROP TABLE IF EXISTS `inm_alquiler`;
CREATE TABLE `inm_alquiler` (
  `id` int(11) NOT NULL,
  `id_inmueble` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `valor` Double NOT NULL,
  `disponibilidad` int(11) DEFAULT 1,
  `removed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `inm_alquiler`
--

-- --------------------------------------------------------

--
-- Table structure for table `inm_alquiler_contrato`
--

DROP TABLE IF EXISTS `inm_alquiler_contrato`;
CREATE TABLE `inm_alquiler_contrato` (
  `id` int(11) NOT NULL,
  `id_inm_alquiler` int(11) NOT NULL,
  `deposito` float DEFAULT NULL,
  `honorarios` float DEFAULT NULL,
  `id_inquilino` int(11) NOT NULL,
  `id_garante` int(11) DEFAULT NULL,
  `removed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inm_alquiler_seniado`
--

DROP TABLE IF EXISTS `inm_alquiler_seniado`;
CREATE TABLE `inm_alquiler_seniado` (
  `id` int(11) NOT NULL,
  `id_inmueble` int(11) NOT NULL,
  `senia` float DEFAULT NULL,
  `id_inquilino` int(11) NOT NULL,
  `removed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periodos_contrato`
--

DROP TABLE IF EXISTS `periodos_contrato`;
CREATE TABLE `periodos_contrato` (
  `id` int(11) NOT NULL,
  `id_inm_alquiler_contrato` int(11) NOT NULL,
  `fecha_inicio` Date NOT NULL,
  `fecha_fin` Date NOT NULL,
  `valor` Double NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

  -- --------------------------------------------------------

--
-- Table structure for table `periodos_contrato`
--

DROP TABLE IF EXISTS `servicios_contrato`;
CREATE TABLE `servicios_contrato` (
  `id` int(11) NOT NULL,
  `id_inm_alquiler_contrato` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` int(11) DEFAULT NULL,
  `id_direccion` int(11) NOT NULL,
  `id_celular` int(11) DEFAULT NULL,
  `id_telefono` int(11) DEFAULT NULL,
  `removed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `dni`, `fecha_nac`, `sexo`, `id_direccion`, `id_celular`, `id_telefono`, `removed`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'Elisa Carolina', 'Arillo', '5.614.078', '1949-05-14', NULL, 1, 2, 1, 0, '2016-11-01', '2016-11-22', 1, 1);

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `dni`, `fecha_nac`, `sexo`, `id_direccion`, `id_celular`, `id_telefono`, `removed`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(2, 'Atilio Horacio', 'Ditz', '5.504.465', '1945-07-07', NULL, 1, 2, 1, 0, '2016-11-01', '2016-11-22', 1, 1);
-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre_rol`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'ROLE_ADMIN', NULL, NULL, NULL, NULL);
INSERT INTO `rol` (`id`, `nombre_rol`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(2, 'ROLE_MANAGER', NULL, NULL, NULL, NULL);
INSERT INTO `rol` (`id`, `nombre_rol`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(3, 'ROLE_EMPLOYEE', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_telefono`
--
DROP TABLE IF EXISTS `tipo_telefono`;
CREATE TABLE `tipo_telefono` (
  `id` int(11) NOT NULL,
  `tipo` VARCHAR(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
INSERT INTO `tipo_telefono` (`id`, `tipo`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(0, 'FIJO', NULL, NULL, NULL, NULL);
INSERT INTO `tipo_telefono` (`id`, `tipo`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'CELULAR', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------
  
--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
CREATE TABLE `telefono` (
  `id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `nro` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

INSERT INTO `telefono` (`id`, `tipo`, `nro`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 0, '2284441919', NULL, NULL, NULL, NULL);
INSERT INTO `telefono` (`id`, `tipo`, `nro`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(2, 1, '2284673257', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(200) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `temp_pass` varchar(200) DEFAULT NULL,
  `id_foto` varchar(200) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_telefono` int(11) DEFAULT NULL,
  `id_domicilio` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `id_user_creation` int(11) DEFAULT NULL,
  `id_user_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `token`, `token_expire`, `password`, `temp_pass`, `id_foto`, `id_rol`, `nombre`, `apellido`, `email`, `estado`, `id_telefono`, `id_domicilio`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(1, 'matiasDitz', '97e60b95ee48dc893e76a2a4163ee679', '2018-08-10 00:00:00', '$2y$10$4reYxOxWC0qTom.p6mNeHeCZxGwEydLWCjFKDmVsTohXLSGXiR1nS', NULL, NULL, 1, 'Matias', 'Ditz', 'matyditz@hotmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `usuario` (`id`, `nombre_usuario`, `token`, `token_expire`, `password`, `temp_pass`, `id_foto`, `id_rol`, `nombre`, `apellido`, `email`, `estado`, `id_telefono`, `id_domicilio`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(2, 'andreaMuller', '97e60b95ee48dc893e76a2a4163ee679', '2018-08-10 00:00:00', '$2y$10$KqxcfG00YxvFoQmwVK3a..tYG.QGGNYWfEZf3iMTGlDfHBpkOxny.', NULL, NULL, 1, 'Andrea', 'Muller', 'andremullerola@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `usuario` (`id`, `nombre_usuario`, `token`, `token_expire`, `password`, `temp_pass`, `id_foto`, `id_rol`, `nombre`, `apellido`, `email`, `estado`, `id_telefono`, `id_domicilio`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(3, 'danielDitz', '97e60b95ee48dc893e76a2a4163ee679', '2018-08-10 00:00:00', '$2y$10$gEFo4gAkNnojgSvrpjVr3uF1eJUZ0p5P8a0Jjf6lVgY9jHhOvruyC', NULL, NULL, 1, 'Daniel', 'Ditz', 'danielditzpropiedades@gmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `usuario` (`id`, `nombre_usuario`, `token`, `token_expire`, `password`, `temp_pass`, `id_foto`, `id_rol`, `nombre`, `apellido`, `email`, `estado`, `id_telefono`, `id_domicilio`, `created`, `modified`, `id_user_creation`, `id_user_modified`) VALUES(4, 'gianCanovi', '97e60b95ee48dc893e76a2a4163ee679', '2018-08-10 00:00:00', '$2y$10$abW2W2f9uPO2Kb7DJpgrduCEd8XcFJIHRSjGArYK/L/cuy2oDhrs.', NULL, NULL, 1, 'Gianfranco', 'Canovi', 'giany_02@hotmail.com', 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicios_user_creation` (`id_user_creation`),
  ADD KEY `servicios_user_modification` (`id_user_modified`);
  
--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direccion_user_creation` (`id_user_creation`),
  ADD KEY `direccion_user_modification` (`id_user_modified`);

--
-- Indexes for table `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_inmueble`
--
ALTER TABLE `foto_inmueble`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_inmueble_inmueble_id` (`id_inmueble`),
  ADD KEY `foto_inmueble_user_creation` (`id_user_creation`),
  ADD KEY `foto_inmueble_user_modification` (`id_user_modified`);

--
-- Indexes for table `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inmueble_direccion` (`id_direccion`),
  ADD KEY `inmueble_user_creation` (`id_user_creation`),
  ADD KEY `inmueble_user_modification` (`id_user_modified`);

--
-- Indexes for table `inm_alquiler`
--
ALTER TABLE `inm_alquiler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inm_alquiler_inmueble_id` (`id_inmueble`),
  ADD KEY `inm_alquiler_disponibilidad` (`disponibilidad`),
  ADD KEY `inm_alquiler_user_creation` (`id_user_creation`),
  ADD KEY `inm_alquiler_user_modification` (`id_user_modified`),
  ADD KEY `inm_alquiler_propietario_id` (`id_propietario`);

--
-- Indexes for table `inm_alquiler_contrato`
--
ALTER TABLE `inm_alquiler_contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inm_alquiler_contrato_inquilino_id` (`id_inquilino`),
  ADD KEY `inm_alquiler_contrato_inm_alquiler_id` (`id_inm_alquiler`),
  ADD KEY `inm_alquiler_contrato_garante_id` (`id_garante`),
  ADD KEY `inm_alquiler_contrato_user_creation` (`id_user_creation`),
  ADD KEY `inm_alquiler_contrato_user_modification` (`id_user_modified`);

--
-- Indexes for table `inm_alquiler_seniado`
--
ALTER TABLE `inm_alquiler_seniado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inm_alquiler_seniado_inquilino_id` (`id_inquilino`),
  ADD KEY `inm_alquiler_seniado_inm_alquiler_id` (`id_inmueble`),
  ADD KEY `inm_alquiler_seniado_user_creation` (`id_user_creation`),
  ADD KEY `inm_alquiler_seniado_user_modification` (`id_user_modified`);

--
-- Indexes for table `periodos_contrato`
--
ALTER TABLE `periodos_contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodos_contrato_user_creation` (`id_user_creation`),
  ADD KEY `periodos_contrato_user_modification` (`id_user_modified`);
  
--
-- Indexes for table `servicios_contrato`
--
ALTER TABLE `servicios_contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodos_contrato_user_creation` (`id_user_creation`),
  ADD KEY `periodos_contrato_user_modification` (`id_user_modified`);
  
--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_telefono_id` (`id_telefono`),
  ADD KEY `persona_celular_id` (`id_celular`),
  ADD KEY `persona_direccion_id` (`id_direccion`),
  ADD KEY `persona_user_creation` (`id_user_creation`),
  ADD KEY `persona_user_modification` (`id_user_modified`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_user_creation` (`id_user_creation`),
  ADD KEY `rol_user_modification` (`id_user_modified`);

  --
-- Indexes for table `tipo_telefono`
--
ALTER TABLE `tipo_telefono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefono_user_creation` (`id_user_creation`),
  ADD KEY `telefono_user_modification` (`id_user_modified`);
  
--
-- Indexes for table `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telefono_tipo` (`tipo`),
  ADD KEY `telefono_user_creation` (`id_user_creation`),
  ADD KEY `telefono_user_modification` (`id_user_modified`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_rol` (`id_rol`),
  ADD KEY `usuario_telefono` (`id_telefono`),
  ADD KEY `usuario_direccion` (`id_domicilio`),
  ADD KEY `usuario_user_creation` (`id_user_creation`),
  ADD KEY `usuario_user_modification` (`id_user_modified`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
  
--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `foto_inmueble`
--
ALTER TABLE `foto_inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `inm_alquiler`
--
ALTER TABLE `inm_alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `inm_alquiler_contrato`
--
ALTER TABLE `inm_alquiler_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `inm_alquiler_seniado`
--
ALTER TABLE `inm_alquiler_seniado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `periodos_contrato`
--
ALTER TABLE `periodos_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
 --
-- AUTO_INCREMENT for table `periodos_contrato`
--
ALTER TABLE `servicios_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4; 
--
-- AUTO_INCREMENT for table `telefono`
--
ALTER TABLE `tipo_telefono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `telefono`
--
ALTER TABLE `telefono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicios_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
--
-- Constraints for table `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `direccion_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `foto_inmueble`
--
ALTER TABLE `foto_inmueble`
  ADD CONSTRAINT `foto_inmueble_inmueble_id` FOREIGN KEY (`id_inmueble`) REFERENCES `inmueble` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `foto_inmueble_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `foto_inmueble_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `id_inmueble_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inmueble_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inmueble_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inm_alquiler`
--
ALTER TABLE `inm_alquiler`
  ADD CONSTRAINT `inm_alquiler_propietario_id` FOREIGN KEY (`id_propietario`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_disponibilidad` FOREIGN KEY (`disponibilidad`) REFERENCES `disponibilidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_inmueble_id` FOREIGN KEY (`id_inmueble`) REFERENCES `inmueble` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inm_alquiler_contrato`
--
ALTER TABLE `inm_alquiler_contrato`
  ADD CONSTRAINT `inm_alquiler_contrato_garante_id` FOREIGN KEY (`id_garante`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_contrato_inm_alquiler_id` FOREIGN KEY (`id_inm_alquiler`) REFERENCES `inm_alquiler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_contrato_inquilino_id` FOREIGN KEY (`id_inquilino`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_contrato_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_contrato_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inm_alquiler_seniado`
--
ALTER TABLE `inm_alquiler_seniado`
  ADD CONSTRAINT `inm_alquiler_seniado_inm_alquiler_id` FOREIGN KEY (`id_inmueble`) REFERENCES `inm_alquiler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_seniado_inquilino_id` FOREIGN KEY (`id_inquilino`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_seniado_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_seniado_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
--
-- Constraints for table `periodos_contrato`
--
ALTER TABLE `periodos_contrato`
  ADD CONSTRAINT `id_inm_alquiler_contrato_periodos` FOREIGN KEY (`id_inm_alquiler_contrato`) REFERENCES `inm_alquiler_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `periodos_contrato_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `periodos_contrato_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
 
--
-- Constraints for table `periodos_contrato`
--
ALTER TABLE `servicios_contrato`
  ADD CONSTRAINT `id_inm_alquiler_contrato_servicios` FOREIGN KEY (`id_inm_alquiler_contrato`) REFERENCES `inm_alquiler_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_servicios_contrato` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicios_contrato_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `servicios_contrato_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
  
--
-- Constraints for table `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_celular_id` FOREIGN KEY (`id_celular`) REFERENCES `telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `persona_direccion_id` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `persona_telefono_id` FOREIGN KEY (`id_telefono`) REFERENCES `telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `persona_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `persona_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `rol_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rol_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `telefono`
--
ALTER TABLE `telefono`
ADD CONSTRAINT `telefono_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `telefono_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `telefono_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_direccion` FOREIGN KEY (`id_domicilio`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_telefono` FOREIGN KEY (`id_telefono`) REFERENCES `telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_user_creation` FOREIGN KEY (`id_user_creation`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_user_modification` FOREIGN KEY (`id_user_modified`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
