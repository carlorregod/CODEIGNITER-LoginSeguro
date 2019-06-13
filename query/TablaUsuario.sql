--CREATE SCHEMA codeigniter;

SET search_path TO codeigniter,public;
DROP TABLE IF EXISTS Usuarios;
CREATE TABLE Usuarios(
idusuarios SERIAL PRIMARY KEY,
nombre VARCHAR(150) NOT NULL,
correo VARCHAR(50) NOT NULL UNIQUE,
usuario VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(256) NOT NULL,
rol INT NOT NULL,
date TIMESTAMP
);

/*Roles
1:Admin
2:Usuario normal
...
n: los que definan.
Importante que por defecto el sistema asociada un 1 a los nuevos que se enliste. */

