-- Base de datos: `blogterplus`
CREATE DATABASE blogterplus;
USE blogterplus;

-- --------------------------------------------------------
--
-- Estructura para la tabla users
--

CREATE TABLE users( 
usuario_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre varchar(30), 
apellido varchar(30), 
nickname varchar(30), 
email varchar(50), 
password varchar(100), 
sexo char(1), 
birthday date,
fecha_registro datetime,
foto varchar(50) );

-- --------------------------------------------------------
--
-- Estructura  para la tabla obras
--
CREATE TABLE obras( 
obra_id int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
titulo varchar(50), 
usuario_id int NOT NULL, 
calificacion int(2) DEFAULT 0, 
sinopsis text, 
fecha_creacion datetime, 
fecha_actualizacion datetime, 
genero ENUM ('Acción','Aventura','Drama', 'Erótico', 'Espiritual', 'Fantasía','Misterio', 'Romance', 'Thriller', 'Sci-Fi','Terror','Otro'),
portada varchar(50), 
FOREIGN KEY (usuario_id) references users(usuario_id) 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla capitulos
--
CREATE TABLE capitulos( 
capitulo_id int NOT NULL,
usuario_id int NOT NULL,
obra_id int NOT NULL,
titulo_obra varchar(50),
titulo_cap varchar(50),
numero_cap int DEFAULT 0,
contenido text, 
fecha_creacion datetime,
fecha_actualizacion datetime,
publicado tinyint DEFAULT 0,
FOREIGN KEY (usuario_id) references users(usuario_id),
FOREIGN KEY (obra_id) references obras(obra_id),
PRIMARY KEY (capitulo_id) );


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla comentarios para obras
--

CREATE TABLE comentsObras(
comentObra_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
usuario_id int NOT NULL,
obra_id int NOT NULL,
comentario text,
fecha_creacion datetime,
nick varchar(30),
foto varchar(50));


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla comentarios para capitulos
--


CREATE TABLE comentsCaps(
comentCap_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
usuario_id int NOT NULL,
capitulo_id int NOT NULL,
comentario_cap text,
fecha_creacion datetime,
nick varchar(30),
foto varchar(50));;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla follow
--

CREATE TABLE follow(
seguidor_id int NOT NULL,
seguido_id int NOT NULL,
siguiendo boolean DEFAULT FALSE,
PRIMARY KEY(seguidor_id, seguido_id));

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla calificacion
--

CREATE TABLE calificaciones(
obra_id int NOT NULL,
usuario_id int NOT NULL,
calificacion int(11) NOT NULL DEFAULT 0,
PRIMARY KEY(obra_id, usuario_id ));

