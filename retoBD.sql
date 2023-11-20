CREATE DATABASE IF NOT EXISTS OnePieceCartas;
use OnePieceCartas;

drop table tipoCarta;
CREATE TABLE IF NOT EXISTS tipoCarta (
	id_tipo int auto_increment,
    tipo varchar(255) not null,
    PRIMARY KEY (id_tipo)
    );
    
INSERT INTO tipoCarta (tipo) VALUES ('Character'), ('Leader');
    
drop table atributos;
CREATE TABLE IF NOT EXISTS atributos (
	id_atributo int auto_increment,
    atributo varchar (255) not null,
    imagen varchar (255) not null,
    PRIMARY KEY (id_atributo)
    );
    
    INSERT INTO atributos (atributo, imagen) VALUES ('Ranged', 'img/rangedLogo.PNG') , ('Slash', 'img/slashLogo.PNG'), ('Special', 'img/specialLogo.PNG'), 
    ('Strike', 'img/strikeLogo.PNG'), ('Wisdom', 'img/wisdomLogo.PNG');
    
drop table grupos;
CREATE TABLE IF NOT EXISTS grupos (
		id_grupo int auto_increment,
        grupo varchar (255) not null,
        PRIMARY KEY (id_grupo)
    );
    
INSERT INTO grupos (grupo) VALUES ('Straw Hat Crew'), ('Heart Pirates') , ('Shichibukai'), ('Kuja Pirates'), ('Four Emperors'), ('Red-Haired Pirates'),
    ('Whitebeard Pirates'), ('Roger Pirates'), ('Navy'), ('Blackbeard Pirates'), ('Beast Pirates') , ('Big Mom Pirates'), ('Bonney Pirates'),
    ('Worst Generation'), ('Baroque Works')
    ;

UPDATE GRUPOS SET grupo = 'Straw Hat Crew' WHERE id_grupo = 1;

drop table cartas;
CREATE TABLE if not exists cartas (
	id_carta int auto_increment,
    nombre varchar (255) not null,	
    poder int not null,
    atributo int not null,
    tipo_carta int not null,
    grupo int not null,
    grupo_secundario int,
    imagen varchar (255) not null,
    PRIMARY KEY (id_carta),
    FOREIGN KEY (atributo) REFERENCES atributos (id_atributo),
    FOREIGN KEY (tipo_carta) REFERENCES tipoCarta (id_tipo),
    FOREIGN KEY (grupo) REFERENCES grupos (id_grupo),
    FOREIGN KEY (grupo_secundario) REFERENCES grupos (id_grupo)
    );
    
    INSERT INTO cartas (nombre, poder, atributo, tipo_carta, grupo, grupo_secundario, imagen) VALUES ('Monkey D. Luffy', 9000, 4, 2, 1, 14, 'img/luffyLeader.jpg'),
    ('Roronoa Zoro', 6000, 2, 2, 1, 14, 'img/zoroLeader.jpg'), ('Sanji', 5000, 4, 2, 1, NULL,'img/sanjiLeader.jpg'), ('Trafalgar Law', 7000, 2, 2, 2, 14, 'img/lawLeader.png'),
    ('Boa Hancock', 5000, 3, 1, 3, 4, 'img/hancock.webp'), ('Robin-Chwan', 4000, 5, 1, 1, NULL,'img/robinChwan.jpg'), ('Nami-Swan', 3000, 3, 1, 1, NULL,'img/namiSwan.jpg'),
    ('Jewelry Bonney', 1000, 3, 1, 13, 14, 'img/bonney.jpeg'), ('Shanks', 10000, 2, 2, 5, 6, 'img/shanksLeader.jpg'), ('Edward Newgate', 10000, 3, 2, 5, 7, 'img/barbablancaLeader.jpg'),
    ('Gol D. Roger', 10000, 2, 2, 8, NULL,'img/rogerLeader.jpg'), ('Monkey D. Garp', 7000, 4, 2, 9, NULL,'img/garpLeader.jpg'), ('Marshal D. Teach', 6000, 3, 2, 5, 10, 'img/barbanegraLeader.jpg'),
    ('Kaido', 12000, 4, 2, 5, 11, 'img/kaidoLeader.jpg'), ('Akainu', 7000, 3, 2, 9, NULL, 'img/akainuLeader.jpg'), ('Big Mom', 5000, 3, 2, 5, 12, 'img/bigmomLeader.jpg')
    ;
    
UPDATE cartas SET nombre = 'Nami' Where id_carta = 7;
    
    SELECT atributos.imagen FROM atributos JOIN cartas ON atributos.id_atributo = cartas.atributo WHERE cartas.id_carta = '4';
    SELECT id_carta FROM cartas order by id_carta;
    SELECT tipocarta.tipo FROM tipocarta JOIN cartas on tipocarta.id_tipo = cartas.tipo_carta WHERE cartas.id_carta = '5';
    SELECT grupos.grupo FROM grupos JOIN cartas on grupos.id_grupo = cartas.grupo WHERE cartas.id_carta = '1';
	SELECT grupos.grupo FROM grupos JOIN cartas on grupos.id_grupo = cartas.grupo_secundario WHERE cartas.id_carta = '1';
	DELETE FROM CARTAS WHERE ID_CARTA = '17';

    