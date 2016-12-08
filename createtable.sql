DROP TABLE IF EXISTS tbcomando;
DROP TABLE IF EXISTS tbbotresposta;
	  create table tbcomando(
id_comando int not null auto_increment,
nm_comando varchar(255) not null,
primary key (id_comando),
CONSTRAINT uk_tbcomando_nm_comando UNIQUE (nm_comando) );


	  CREATE TABLE 'tbbotresposta' (
id_resposta int NOT NULL AUTO_INCREMENT,
	id_comando INT NOT NULL,
first_name varchar(255) NOT NULL,
resposta varchar(255) DEFAULT NULL, update_id varchar(255) NOT NULL,
PRIMARY KEY (id_resposta),
CONSTRAINT uk_tbresposta_update_id UNIQUE (update_id),
FOREIGN KEY (id_comando) references tbcomando(id_comando));
