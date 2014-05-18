SET AUTOCOMMIT = 0;
START TRANSACTION;

/* Previamente crear el usuario numero uno desde el registro del programa */

insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (1,'Arrow',1,'Sinopsis de la serie Arrow','2009',3);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (2,'The Following', 1,'Sinopsis de la serie The Following','2010',3);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (3,'The Big Bang Theory',1,'Sinopsis de la serie The Big Bang Theory','2006',2); 
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (4,'Como conoci a vuestra madre',1,'Sinopsis de la serie CCAVM','2004',4); 
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (5,'Lost',1,'Sinopsis de la serie Lost','2006',3); 
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (6,'Vampire Diaries',1,'Sinopsis de la serie Vampire Diaries','2004',3); 
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (7,'Juego de tronos',1,'Sinopsis de la serie Juego de tronos','2006',5); 
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (8,'American Horror Story',1,'Sinopsis de la serie American Horror Story','2010',4); 
		
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (9,'Durarara',2,'Sinopsis del anime Durarara','2009',3);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (10,'Ef a tale of memories',2,'Sinopsis del anime Ef a tale of memories','2009',5);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (11,'Bleach',2,'Sinopsis del anime bleach','2010',4);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (12,'One Piece',2,'Sinopsis del anime One Piece','2004',4);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (13,'Dragon Ball',2,'Sinopsis del anime Dragon Ball','2006',5);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (14,'Naruto',2,'Sinopsis del anime Naruto','2006',4);	
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (15,'Ranma',2,'Sinopsis del anime Ranma','2004',6);	

insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (16, 'A todo gas',3,'Sinopsis de la pelicula a todo gas','2009',5);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (17, 'Resacon en las vegas',3,'Sinopsis de la pelicula resacon en las vegas','2009',3);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (18, 'Avatar',3,'Sinopsis de la pelicula avatar','2010',4);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (19, 'Harry Potter',3,'Sinopsis de la pelicula Harry Potter','2010',5);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (20, 'El señor de los anillos',3,'Sinopsis de la pelicula el señor de los anillos','2004',3);
insert into material (id, nombre, tipo, sinopsis, anio,n_capitulos)
		values (21, 'El rey leon',3,'Sinopsis de la pelicula El rey leon','2004',4);
		
		/* ,2013-07-01*/
insert into capitulo (material_id, titulo, fecha_salida) 
		values (1, 'Capitulo 1 Titulo Arrow', '2013-07-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (1, 'Capitulo 2 Titulo Arrow', '2013-07-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (1, 'Capitulo 3 Titulo Arrow', '2013-07-03');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (2, 'Capitulo 1 Titulo The Following','2013-08-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (2, 'Capitulo 2 Titulo The Following','2013-08-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (2, 'Capitulo 3 Titulo The Following','2013-08-02');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (3, 'Capitulo 1 Titulo The Big Bang Theory','2013-09-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (3, 'Capitulo 2 Titulo The Big Bang Theory','2013-09-02');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (4, 'Capitulo 1 Titulo CCAVM','2013-10-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (4, 'Capitulo 2 Titulo CCAVM','2013-10-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (4, 'Capitulo 3 Titulo CCAVM','2013-10-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (4, 'Capitulo 4 Titulo CCAVM','2013-10-04');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (5, 'Capitulo 1 Titulo LOST','2013-11-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (5, 'Capitulo 2 Titulo LOST','2013-11-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (5, 'Capitulo 3 Titulo LOST','2013-11-03');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (6, 'Capitulo 1 Titulo Vampire Diaries','2013-12-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (6, 'Capitulo 2 Titulo Vampire Diaries','2013-12-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (6, 'Capitulo 3 Titulo Vampire Diaries','2013-12-03');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (7, 'Capitulo 1 Titulo Juego de Tronos','2012-01-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (7, 'Capitulo 2 Titulo Juego de Tronos','2012-01-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (7, 'Capitulo 3 Titulo Juego de Tronos','2012-01-03');
insert into capitulo (material_id, titulo, fecha_salida)
		values (7, 'Capitulo 4 Titulo Juego de Tronos','2012-01-05');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (7, 'Capitulo 5 Titulo Juego de Tronos','2012-01-06');
		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (8, 'Capitulo 1 Titulo American Horror Story','2012-02-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (8, 'Capitulo 2 Titulo American Horror Story','2012-02-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (8, 'Capitulo 3 Titulo American Horror Story','2012-02-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (8, 'Capitulo 4 Titulo American Horror Story','2012-02-04');
		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (9, 'Capitulo 1 Titulo Durarara','2012-03-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (9, 'Capitulo 2 Titulo Durarara','2012-03-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (9, 'Capitulo 3 Titulo Durarara','2012-03-03');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (10, 'Capitulo 1 Titulo Ef a tale of memories','2012-04-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (10, 'Capitulo 2 Titulo Ef a tale of memories','2012-04-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (10, 'Capitulo 3 Titulo Ef a tale of memories','2012-04-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (10, 'Capitulo 4 Titulo Ef a tale of memories','2012-04-04');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (10, 'Capitulo 5 Titulo Ef a tale of memories','2012-04-05');
		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (11, 'Capitulo 1 Titulo Bleach','2012-05-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (11, 'Capitulo 2 Titulo Bleach','2012-05-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (11, 'Capitulo 3 Titulo Bleach','2012-05-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (11, 'Capitulo 4 Titulo Bleach','2012-05-04');
		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (12, 'Capitulo 1 Titulo One Piece','2012-06-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (12, 'Capitulo 2 Titulo One Piece','2012-06-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (12, 'Capitulo 3 Titulo One Piece','2012-06-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (12, 'Capitulo 4 Titulo One Piece','2012-06-04');

		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (13, 'Capitulo 1 Titulo Dragon Ball','2012-07-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (13, 'Capitulo 2 Titulo Dragon Ball','2012-07-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (13, 'Capitulo 3 Titulo Dragon Ball','2012-07-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (13, 'Capitulo 4 Titulo Dragon Ball','2012-07-04');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (13, 'Capitulo 5 Titulo Dragon Ball','2012-07-05');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (14, 'Capitulo 1 Titulo Naruto','2012-08-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (14, 'Capitulo 2 Titulo Naruto','2012-08-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (14, 'Capitulo 3 Titulo Naruto','2012-08-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (14, 'Capitulo 4 Titulo Naruto','2012-08-04');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 1 Titulo Ranma','2012-09-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 2 Titulo Ranma','2012-09-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 3 Titulo Ranma','2012-09-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 4 Titulo Ranma','2012-09-04');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 5 Titulo Ranma','2012-09-05');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (15, 'Capitulo 6 Titulo Ranma','2012-09-06');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (16, 'Capitulo 1 Titulo A todo gas','2012-10-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (16, 'Capitulo 2 Titulo A todo gas','2012-10-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (16, 'Capitulo 3 Titulo A todo gas','2012-10-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (16, 'Capitulo 4 Titulo A todo gas','2012-10-04');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (16, 'Capitulo 5 Titulo A todo gas','2012-10-05');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (17, 'Capitulo 1 Titulo Resacon en las vegas','2012-11-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (17, 'Capitulo 2 Titulo Resacon en las vegas','2012-11-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (17, 'Capitulo 3 Titulo Resacon en las vegas','2012-11-03');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (18, 'Capitulo 1 Titulo Avatar','2009-01-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (18, 'Capitulo 2 Titulo Avatar','2009-01-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (18, 'Capitulo 3 Titulo Avatar','2009-01-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (18, 'Capitulo 4 Titulo Avatar','2009-01-04');

insert into capitulo (material_id, titulo, fecha_salida) 
		values (19, 'Capitulo 1 Titulo Harry Potter','2009-02-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (19, 'Capitulo 2 Titulo Harry Potter','2009-02-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (19, 'Capitulo 3 Titulo Harry Potter','2009-02-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (19, 'Capitulo 4 Titulo Harry Potter','2009-02-04');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (19, 'Capitulo 5 Titulo Harry Potter','2009-02-05');		

insert into capitulo (material_id, titulo, fecha_salida) 
		values (20, 'Capitulo 1 Titulo El señor de los anillos','2009-03-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (20, 'Capitulo 2 Titulo El señor de los anillos','2009-03-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (20, 'Capitulo 3 Titulo El señor de los anillos','2009-03-03');
		
insert into capitulo (material_id, titulo, fecha_salida) 
		values (21, 'Capitulo 1 Titulo El rey leon','2009-04-01');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (21, 'Capitulo 2 Titulo El rey leon','2009-04-02');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (21, 'Capitulo 3 Titulo El rey leon','2009-04-03');
insert into capitulo (material_id, titulo, fecha_salida) 
		values (21, 'Capitulo 4 Titulo El rey leon','2009-04-04');
		

insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('davidnick2', 'davidnombre', 'davidapellido', 'davidemail@hotmail.com', 'descripcion david', 'oretaniadavid',1);
insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('pepenick', 'pepenombre', 'pepeapellido', 'pepeemail@hotmail.com', 'descripcion pepe', 'oretaniapepe',0);
insert into usuario (nick, email, descripcion, clave, es_admin) 
		values ('lauranick','lauraemail@hotmail.com', 'descripcion laura', 'oretanialaura',0);
insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('alvaronick', 'alvaronombre', 'alvaroapellido', 'alvaroemail@hotmail.com', 'descripcion alvaro', 'oretaniaalvaro',0);
insert into usuario (nick, nombre, apellido, email, clave, es_admin) 
		values ('danielnick', 'danielnombre', 'danielapellido', 'danielemail@hotmail.com', 'oretania daniel',0);
		
		

	
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, favorito) 
		values (1,1,1, 6, 'Vista en Random David 1', 'Comentario random David 1', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas, favorito) 
		values (1,2,2, 8, 'Vista en Random David 2', 'Comentario random David 2', 1, 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,3,3, 7, 'Vista en Random David 3', 'Comentario random David 3', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas, favorito) 
		values (1,4,2, 4, 'Vista en Random David 4', 'Comentario random David 4', 2, 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,5,3, 2, 'Vista en Random David 5', 'Comentario random David 5', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas, favorito) 
		values (1,6,1, 8, 'Vista en Random David 6', 'Comentario random David 6', 1, 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,7,2, 7, 'Vista en Random David 7', 'Comentario random David 7', 2);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,8,1, 3, 'Vista en Random David 8', 'Comentario random David 8', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,9,3, 2, 'Vista en Random David 9', 'Comentario random David 9', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,10,3, 8, 'Vista en Random David 10', 'Comentario random David 10', 2);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,11,2, 9, 'Vista en Random David 11', 'Comentario random David 11', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,12,1, 8, 'Vista en Random David 12', 'Comentario random David 12', 2);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,13,2, 7, 'Vista en Random David 13', 'Comentario random David 13', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,14,1, 8, 'Vista en Random David 14', 'Comentario random David 14', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,15,3, 6, 'Vista en Random David 15', 'Comentario random David 15', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,16,1, 5, 'Vista en Random David 16', 'Comentario random David 16', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,17,2, 7, 'Vista en Random David 17', 'Comentario random David 17', 1);
insert into material_usuario(usuario_id, material_id, estado, puntuacion, vista_en, comentario, capitulo_por_el_que_vas) 
		values (1,18,1, 8, 'Vista en Random David 18', 'Comentario random David 18', 1);
		

insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 2 Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', '2014/02/03', 'fuente numero 1', 1, 'pepito, coso, otro', 'Titulo 2');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 3 Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, "consecteur", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de "de Finnibus Bonorum et Malorum" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", viene de una linea en la sección 1.10.32

El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.', '2014/02/03', 'fuente numero 2', 1, 'pepito, cosa, otro', 'Titulo 3');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 4', '2014/02/03', 'fuente numero 3', 1, 'pepita, coso, otro', 'Titulo 4');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 5', '2014/02/03', 'fuente numero 4', 1, 'pepe, cosita, otroscosos', 'Titulo 5');

insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1 Comentario 1 de noticia 1', '2014/02/03',1,1);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 2 de noticia 1', '2013/01/03',3,1);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 3 de noticia 1', '2014/01/03',1,1);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 1 de noticia 2', '2014/02/03',4,2);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 2 de noticia 2', '2014/02/03',1,2);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 3 de noticia 2', '2014/02/03',2,2);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 4 de noticia 2', '2014/02/03',1,2);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 1 de noticia 3', '2014/02/03',3,3);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 2 de noticia 3', '2014/02/03',1,3);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 3 de noticia 3', '2011/02/03',2,3);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 1 de noticia 4', '2013/02/01',1,4);
insert into comentario(comentario,fecha_publicad,usuario_id,noticias_id) values
            ('Comentario 2 de noticia 4', '2012/02/03',2,4);
			
insert into mensaje(mensaje,usuario_e,usuario_r,fecha_enviado) values ('mensaje1',1,2,'2012/02/03');
insert into mensaje(mensaje,usuario_e,usuario_r,fecha_enviado) values ('mensaje2',2,1,'2013/02/03');
insert into mensaje(mensaje,usuario_e,usuario_r,fecha_enviado) values ('mensaje3',1,3,'2014/02/03');
insert into mensaje(mensaje,usuario_e,usuario_r,fecha_enviado) values ('mensaje4',2,1,'2016/02/03');
insert into mensaje(mensaje,usuario_e,usuario_r,fecha_enviado) values ('mensaje',2,1,'201/02/03');


commit;
