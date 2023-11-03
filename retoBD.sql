CREATE DATABASE IF NOT EXISTS OnePieceCartas;
use OnePieceCartas;

CREATE TABLE IF NOT EXISTS tipoCarta (
	id_tipo int auto_increment,
    tipo varchar(255) not null,
    PRIMARY KEY (id_tipo)
    );
    
	INSERT INTO tipoCarta (tipo) VALUES ('character'), ('leader');
    
CREATE TABLE IF NOT EXISTS atributos (
	id_atributo int auto_increment,
    atributo varchar (255) not null,
    imagen varchar (255) not null,
    PRIMARY KEY (id_atributo)
    );
    
    INSERT INTO atributos (atributo, imagen) VALUES ('ranged', 'img/rangedLogo.PNG') , ('slash', 'img/slashLogo.PNG'), ('special', 'img/specialLogo.PNG'), 
    ('strike', 'img/strikeLogo.PNG'), ('wisdom', 'img/wisdomLogo.PNG');
    
    drop table grupos;
CREATE TABLE IF NOT EXISTS grupos (
		id_grupo int auto_increment,
        grupo varchar (255) not null,
        PRIMARY KEY (id_grupo)
    );
    
	INSERT INTO grupos (grupo) VALUES ('Straw Hat Crew'), ('Heart Pirates') , ('Shichibukai'), ('Kuja Pirates'), ('Four Emperors'), ('Red-Haired Pirates'),
    ('Whitebeard Pirates'), ('Roger Pirates'), ('Navy'), ('Blackbeard Pirates'), ('Beast Pirates'), ('Navy'), ('Big Mom Pirates'), ('Bonney Pirates'),
    ('Worst Generation')
    ;

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
    
    INSERT INTO cartas (nombre, poder, atributo, tipo_carta, grupo, grupo_secundario, imagen) VALUES ('Monkey D. Luffy', 9000, 4, 2, 1, 15, 'img/luffyLeader.jpg'),
    ('Roronoa Zoro', 6000, 2, 2, 1, 15, 'img/zoroLeader.jpg'), ('Sanji', 5000, 4, 2, 1, NULL,'img/sanjiLeader.jpg'), ('Trafalgar Law', 7000, 2, 2, 2, 15, 'img/lawLeader.jpg'),
    ('Boa Hancock', 5000, 3, 1, 3, 4, 'img/hancock.webp'), ('Robin-Chwan', 4000, 5, 1, 1, NULL,'img/robinChwan.jpg'), ('Nami-Swan', 3000, 3, 1, 1, NULL,'img/namiSwan.jpg'),
    ('Jewelry Bonney', 1000, 3, 1, 14, 15, 'img/bonney.jpeg'), ('Shanks', 10000, 2, 2, 5, 6, 'img/shanksLeader.jpg'), ('Edward Newgate', 10000, 3, 2, 5, 7, 'barbablancaLeader.jpg'),
    ('Gol D. Roger', 10000, 2, 2, 8, NULL,'img/rogerLeader.jpg'), ('Monkey D. Garp', 7000, 2, 2, 9, NULL,'img/garpLeader.jpg'), ('Marshal D. Teach', 6000, 3, 2, 5, 8, 'img/barbanegraLeader.jpg'),
    ('Kaido', 12000, 4, 2, 5, 11, 'img/kaidoLeader.jpg'), ('Akainu', 7000, 3, 2, 9, NULL, 'img/akainuLeader.jpg'), ('Big Mom', 5000, 3, 2, 5, 13, 'img/bigmomLeader.jpg')
    ;

    