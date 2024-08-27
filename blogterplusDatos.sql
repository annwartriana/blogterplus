USE blogterplus;
-- -------------------------------VOLCADO DE DATOS

--
-- Volcado de datos para la tabla users
--
INSERT INTO users (usuario_id, nombre, apellido, password, email, nickname, birthday, sexo, fecha_registro, foto)

VALUES  

(1,'Arthur', 'Doyle', '1234', 'arthur@prueba.com', 'ConanDoyle', '2022-06-08', 'H', '2022-06-14 23:01:23.000000', 'doyle.jpg'),
(2,'Bram', 'Stoker', '1234', 'bram@prueba.com', 'BramStoker', '2022-06-08', 'H', '2022-06-14 23:01:23.000000', 'stoker.jpg'),
(3,'Oscar', 'Wilde', '1234', 'oscarwilde@prueba.com', 'OscarWilde', '2022-06-08', 'H', '2022-06-14 23:01:23.000000', '6107.jpg')
;


--
-- Volcado de datos para la tabla Obras
--
INSERT INTO obras (titulo, usuario_id, calificacion, sinopsis, fecha_creacion, fecha_actualizacion, genero, portada)

VALUES  

('Las Aventuras de Sherlock Holmes', 1, 10, 'En este libro las pistas, los malos, la sospecha y la intriga se multiplican, y no solo eso, también las conversaciones entre Holmes y Watson cargadas de reflexiones coherentemente delirantes se multiplican, y el pensamiento profundo: «Voy a fumar. Este es un problema de tres pipas, así que le ruego que no me dirija la palabra durante cincuenta minutos», y los disfraces del detective, y los escenarios londinenses… Y no se multiplica, pero aparece, la única mujer a la que el misógino de Sherlock regala su admiración. Y todo, porque Las aventuras de Sherlock Holmes reúne un grupo de casos nada «elemental» que, sin duda, y como le dice el Dr. Watson a Holmes: «Querido amigo, no me lo perdería por nada del mundo».',
'2022-04-14 23:01:23.000000', '2022-04-14 23:01:23.000000', 'Misterio', 'portadaSherlock.jpg'),

('Drácula', '2', '9', 'Jonathan Harker viaja a Transilvania para cerrar un negocio inmobiliario con un misterioso conde que acaba de comprar varias propiedades en Londres. Despues de un viaje plagado de ominosas señales, Harker es recogido en el paso de Borgo por un siniestro carruaje que lo llevará, acunado por el canto de los lobos, a un castillo en ruinas. Tal es el inquietante principio de una novela magistral que alumbró uno de los mitos más populares y poderosos de todos los tiempos: Drácula.',
'2022-05-14 23:01:23.000000', '2022-05-14 23:01:23.000000', 'Misterio', 'dracula.jpg'), 

('El Retrato de Dorian Gray', 3, 8.5, 'Dorian Gray es un joven aristócrata muy atractivo. Después de haber pasado una solitaria adolescencia en el campo regresa a Londres, donde ha heredado una mansión. Atraído por la vida nocturna, se sumerge en ella de la mano de Lord Henry Wottom.',
'2022-06-14 23:01:23.000000', '2022-06-14 23:01:23.000000', 'Drama', 'dorianGrey.jpg')
;


--
-- Volcado de datos para la tabla calificacion
--

INSERT INTO calificaciones (obra_id, usuario_id, calificacion) 

VALUES  (1,2,8), (2,3,9),(3,1,7),(1,3,10);

