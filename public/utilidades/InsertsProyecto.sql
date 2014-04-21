SET AUTOCOMMIT = 0;
START TRANSACTION;

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


commit;
