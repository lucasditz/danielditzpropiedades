CREATE TABLE IF NOT EXISTS `inm_alquiler_propietario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_inm_alquiler` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `inm_alquiler_propietario`
  ADD CONSTRAINT `inm_alquiler_propietario_inm_alquiler_id` FOREIGN KEY (`id_inm_alquiler`) REFERENCES `inm_alquiler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_propietario_person_id` FOREIGN KEY (`id_propietario`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


INSERT INTO inm_alquiler_propietario (id_inm_alquiler, id_propietario)
  SELECT ima.id, ima.id_propietario
  FROM inm_alquiler ima;

ALTER TABLE inm_alquiler DROP COLUMN id_propietario;