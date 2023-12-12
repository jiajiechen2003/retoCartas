-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema onepiececartas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema onepiececartas
-- -----------------------------------------------------
/* drop database if exists onepiececartas; */
CREATE SCHEMA IF NOT EXISTS `onepiececartas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `onepiececartas` ;

-- -----------------------------------------------------
-- Table `onepiececartas`.`atributos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onepiececartas`.`atributos` (
  `id_atributo` INT NOT NULL AUTO_INCREMENT,
  `atributo` VARCHAR(255) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_atributo`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `onepiececartas`.`tipocarta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onepiececartas`.`tipocarta` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `onepiececartas`.`cartas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onepiececartas`.`cartas` (
  `id_carta` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `poder` INT NOT NULL,
  `atributo` INT NOT NULL,
  `tipo_carta` INT NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_carta`),
  INDEX `atributo` (`atributo` ASC) VISIBLE,
  INDEX `tipo_carta` (`tipo_carta` ASC) VISIBLE,
  CONSTRAINT `cartas_ibfk_1`
    FOREIGN KEY (`atributo`)
    REFERENCES `onepiececartas`.`atributos` (`id_atributo`),
  CONSTRAINT `cartas_ibfk_2`
    FOREIGN KEY (`tipo_carta`)
    REFERENCES `onepiececartas`.`tipocarta` (`id_tipo`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `onepiececartas`.`grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onepiececartas`.`grupos` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT,
  `grupo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_grupo`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `onepiececartas`.`cartas_has_grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onepiececartas`.`cartas_has_grupos` (
  `cartas_id_carta` INT NOT NULL,
  `grupos_id_grupo` INT NOT NULL,
  PRIMARY KEY (`cartas_id_carta`, `grupos_id_grupo`),
  INDEX `fk_cartas_has_grupos_grupos1_idx` (`grupos_id_grupo` ASC) VISIBLE,
  INDEX `fk_cartas_has_grupos_cartas1_idx` (`cartas_id_carta` ASC) VISIBLE,
  CONSTRAINT `fk_cartas_has_grupos_cartas1`
    FOREIGN KEY (`cartas_id_carta`)
    REFERENCES `onepiececartas`.`cartas` (`id_carta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartas_has_grupos_grupos1`
    FOREIGN KEY (`grupos_id_grupo`)
    REFERENCES `onepiececartas`.`grupos` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO tipoCarta (tipo) VALUES ('Character'), ('Leader');

INSERT INTO atributos (atributo, imagen) VALUES ('Ranged', 'img/rangedLogo.PNG') , ('Slash', 'img/slashLogo.PNG'), ('Special', 'img/specialLogo.PNG'), 
    ('Strike', 'img/strikeLogo.PNG'), ('Wisdom', 'img/wisdomLogo.PNG');
    
INSERT INTO grupos (grupo) VALUES ('Straw Hat Crew'), ('Heart Pirates') , ('Shichibukai'), ('Kuja Pirates'), ('Four Emperors'), ('Red-Haired Pirates'),
    ('Whitebeard Pirates'), ('Roger Pirates'), ('Navy'), ('Blackbeard Pirates'), ('Beast Pirates') , ('Big Mom Pirates'), ('Bonney Pirates'),
    ('Worst Generation'), ('Baroque Works')
    ;
    
INSERT INTO cartas (nombre, poder, atributo, tipo_carta,imagen) VALUES ('Monkey D. Luffy', 9000, 4, 2,'img/luffyLeader.jpg'),
    ('Roronoa Zoro', 6000, 2, 2,'img/zoroLeader.jpg'), ('Sanji', 5000, 4, 2,'img/sanjiLeader.jpg'), ('Trafalgar Law', 7000, 2, 2,'img/lawLeader.png'),
    ('Boa Hancock', 5000, 3, 1,'img/hancock.webp'), ('Robin-Chwan', 4000, 5, 1,'img/robinChwan.jpg'), ('Nami-Swan', 3000, 3, 1,'img/namiSwan.jpg'),
    ('Jewelry Bonney', 1000, 3, 1,'img/bonney.jpeg'), ('Shanks', 10000, 2, 2,'img/shanksLeader.jpg'), ('Edward Newgate', 10000, 3, 2,'img/barbablancaLeader.jpg'),
    ('Gol D. Roger', 10000, 2, 2,'img/rogerLeader.jpg'), ('Monkey D. Garp', 7000, 4, 2,'img/garpLeader.jpg'), ('Marshal D. Teach', 6000, 3, 2,'img/barbanegraLeader.jpg'),
    ('Kaido', 12000, 4, 2,'img/kaidoLeader.jpg'), ('Akainu', 7000, 3, 2,'img/akainuLeader.jpg'), ('Big Mom', 5000, 3, 2,'img/bigmomLeader.jpg')
    ;
    
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('1', '1');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('1', '14');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('2', '1');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('2', '14');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('3', '1');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('4', '2');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('4', '14');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('5', '3');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('5', '4');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('6', '1');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('7', '1');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('8', '13');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('8', '14');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('9', '5');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('9', '6');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('10', '5');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('10', '7');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('11', '8');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('12', '9');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('13', '5');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('13', '10');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('14', '5');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('14', '11');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('15', '9');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('16', '5');
INSERT INTO `onepiececartas`.`cartas_has_grupos` (`cartas_id_carta`, `grupos_id_grupo`) VALUES ('16', '12');

SELECT grupos.grupo FROM grupos JOIN cartas_has_grupos ON  cartas_has_grupos.grupos_id_grupo = grupos.id_grupo JOIN cartas ON cartas.id_carta = cartas_has_grupos.cartas_id_carta WHERE cartas.id_carta = 1;