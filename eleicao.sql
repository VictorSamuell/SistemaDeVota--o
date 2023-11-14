drop database eleicao;
Create database eleicao;
use eleicao;

create table candidatos(

id_candidatos int not null auto_increment,
numero_candidato int not null,
nome_candidato varchar(30) not null,
votos int not null,
primary key(id_candidatos)
	
);

create table votantes(

id_votantes int not null auto_increment,
email varchar(30) not null,
primary key(id_votantes)

);

create table estudantes(

id_estudantes int not null auto_increment,
nome_estudante varchar(30) not null,
email varchar(30) not null,
senha varchar(30) not null,
primary key(id_estudantes)

);

INSERT INTO candidatos (numero_candidato, nome_candidato, votos)
VALUES
(1,'França',0),
(2,'Itália',0),
(3,'Portugal',0),
(4,'Espanha',0);

INSERT INTO votantes (email)
VALUES
('joao@gmail.com'),
('maria@gmail.com'),
('teste@gmail.com'),
('victor@gmail.com');


INSERT INTO estudantes (nome_estudante, email, senha) VALUES
('admin', 'admin@gmail.com', 'admin');