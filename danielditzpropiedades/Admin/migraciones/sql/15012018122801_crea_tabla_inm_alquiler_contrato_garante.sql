CREATE TABLE IF NOT EXISTS `inm_alquiler_contrato_garante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_inm_alquiler_contrato` int(11) NOT NULL,
  `id_garante` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `inm_alquiler_propietario`
  ADD CONSTRAINT `inm_alquiler_contrato_garante_inm_alquiler_contrato_id` FOREIGN KEY (`id_inm_alquiler_contrato`) REFERENCES `inm_alquiler_contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inm_alquiler_contrato_garante_person_id` FOREIGN KEY (`id_propietario`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


INSERT INTO inm_alquiler_contrato_garante (id_inm_alquiler_contrato, id_garante)
  SELECT imac.id, imac.id_garante
  FROM inm_alquiler_contrato imac;

ALTER TABLE inm_alquiler_contrato DROP COLUMN id_garante;