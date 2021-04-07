/* CREA LA BDD PARA EL ALMACENAMIENTO DE USUARIOS DE LA WEB */

DROP DATABASE IF EXISTS usuarios;
CREATE DATABASE usuarios;

use usuarios;

create table t_usuarios (
        id          INT NOT NULL AUTO_INCREMENT,
        nombre      VARCHAR(50) NOT NULL,
        contrasena  VARCHAR(255) NOT NULL,
        email       VARCHAR(255) NOT NULL,
        ape1        CHAR(50),
        ape2        CHAR(50),
        FchIngreso DATETIME DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id)

) engine = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;