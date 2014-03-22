SET AUTOCOMMIT = 0;
START TRANSACTION;

insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('davidnick', 'davidnombre', 'davidapellido', 'davidemail@hotmail.com', 'descripcion david', 'oretaniadavid',1);
insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('pepenick', 'pepenombre', 'pepeapellido', 'pepeemail@hotmail.com', 'descripcion pepe', 'oretaniapepe',0);
insert into usuario (nick, email, descripcion, clave, es_admin) 
		values ('lauranick','lauraemail@hotmail.com', 'descripcion laura', 'oretanialaura',0);
insert into usuario (nick, nombre, apellido, email, descripcion, clave, es_admin) 
		values ('alvaronick', 'alvaronombre', 'alvaroapellido', 'alvaroemail@hotmail.com', 'descripcion alvaro', 'oretaniaalvaro',0);
insert into usuario (nick, nombre, apellido, email, clave, es_admin) 
		values ('danielnick', 'danielnombre', 'danielapellido', 'danielemail@hotmail.com', 'oretania daniel',0);
		
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (1,'Arrow',1,'Sinopsis de la serie Arrow','2009');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (2,'The Following', 1,'Sinopsis de la serie The Following','2010'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (3,'The Big Bang Theory',1,'Sinopsis de la serie The Big Bang Theory','2006'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (4,'Como conoci a vuestra madre',1,'Sinopsis de la serie CCAVM','2004'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (5,'Lost',1,'Sinopsis de la serie Lost','2006'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (6,'Vampire Diaries',1,'Sinopsis de la serie Vampire Diaries','2004'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (7,'Juego de tronos',1,'Sinopsis de la serie Juego de tronos','2006'); 
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (8,'American Horror Story',1,'Sinopsis de la serie American Horror Story','2010'); 
		
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (9,'Durarara',2,'Sinopsis del anime Durarara','2009');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (10,'Ef a tale of memories',2,'Sinopsis del anime Ef a tale of memories','2009');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (11,'Bleach',2,'Sinopsis del anime bleach','2010');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (12,'One Piece',2,'Sinopsis del anime One Piece','2004');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (13,'Dragon Ball',2,'Sinopsis del anime Dragon Ball','2006');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (14,'Naruto',2,'Sinopsis del anime Naruto','2006');	
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (15,'Ranma',2,'Sinopsis del anime Ranma','2004');	

insert into material (id, nombre, tipo, sinopsis, anio) 
		values (16, 'A todo gas',3,'Sinopsis de la pelicula a todo gas','2009');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (17, 'Resacon en las vegas',3,'Sinopsis de la pelicula resacon en las vegas','2009');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (18, 'Avatar',3,'Sinopsis de la pelicula avatar','2010');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (19, 'Harry Potter',3,'Sinopsis de la pelicula Harry Potter','2010');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (20, 'El señor de los anillos',3,'Sinopsis de la pelicula el señor de los anillos','2004');
insert into material (id, nombre, tipo, sinopsis, anio) 
		values (21, 'El rey leon',3,'Sinopsis de la pelicula El rey leon','2004');
		
insert into capitulo (material_id, titulo) 
		values (1, 'Capitulo 1 Titulo Arrow');
insert into capitulo (material_id, titulo) 
		values (1, 'Capitulo 2 Titulo Arrow');
insert into capitulo (material_id, titulo) 
		values (1, 'Capitulo 3 Titulo Arrow');

insert into capitulo (material_id, titulo) 
		values (2, 'Capitulo 1 Titulo The Following');
insert into capitulo (material_id, titulo) 
		values (2, 'Capitulo 2 Titulo The Following');
insert into capitulo (material_id, titulo) 
		values (2, 'Capitulo 3 Titulo The Following');

insert into capitulo (material_id, titulo) 
		values (3, 'Capitulo 1 Titulo The Big Bang Theory');
insert into capitulo (material_id, titulo) 
		values (3, 'Capitulo 2 Titulo The Big Bang Theory');

insert into capitulo (material_id, titulo) 
		values (4, 'Capitulo 1 Titulo CCAVM');
insert into capitulo (material_id, titulo) 
		values (4, 'Capitulo 2 Titulo CCAVM');
insert into capitulo (material_id, titulo) 
		values (4, 'Capitulo 3 Titulo CCAVM');
insert into capitulo (material_id, titulo) 
		values (4, 'Capitulo 4 Titulo CCAVM');

insert into capitulo (material_id, titulo) 
		values (5, 'Capitulo 1 Titulo LOST');
insert into capitulo (material_id, titulo) 
		values (5, 'Capitulo 2 Titulo LOST');
insert into capitulo (material_id, titulo) 
		values (5, 'Capitulo 3 Titulo LOST');

insert into capitulo (material_id, titulo) 
		values (6, 'Capitulo 1 Titulo Vampire Diaries');
insert into capitulo (material_id, titulo) 
		values (6, 'Capitulo 2 Titulo Vampire Diaries');
insert into capitulo (material_id, titulo) 
		values (6, 'Capitulo 3 Titulo Vampire Diaries');

insert into capitulo (material_id, titulo) 
		values (7, 'Capitulo 1 Titulo Juego de Tronos');
insert into capitulo (material_id, titulo) 
		values (7, 'Capitulo 2 Titulo Juego de Tronos');
insert into capitulo (material_id, titulo) 
		values (7, 'Capitulo 3 Titulo Juego de Tronos');
insert into capitulo (material_id, titulo) 
		values (7, 'Capitulo 4 Titulo Juego de Tronos');
insert into capitulo (material_id, titulo) 
		values (7, 'Capitulo 5 Titulo Juego de Tronos');
		
insert into capitulo (material_id, titulo) 
		values (8, 'Capitulo 1 Titulo American Horror Story');
insert into capitulo (material_id, titulo) 
		values (8, 'Capitulo 2 Titulo American Horror Story');
insert into capitulo (material_id, titulo) 
		values (8, 'Capitulo 3 Titulo American Horror Story');
insert into capitulo (material_id, titulo) 
		values (8, 'Capitulo 4 Titulo American Horror Story');
		
insert into capitulo (material_id, titulo) 
		values (9, 'Capitulo 1 Titulo Durarara');
insert into capitulo (material_id, titulo) 
		values (9, 'Capitulo 2 Titulo Durarara');
insert into capitulo (material_id, titulo) 
		values (9, 'Capitulo 3 Titulo Durarara');

insert into capitulo (material_id, titulo) 
		values (10, 'Capitulo 1 Titulo Ef a tale of memories');
insert into capitulo (material_id, titulo) 
		values (10, 'Capitulo 2 Titulo Ef a tale of memories');
insert into capitulo (material_id, titulo) 
		values (10, 'Capitulo 3 Titulo Ef a tale of memories');
insert into capitulo (material_id, titulo) 
		values (10, 'Capitulo 4 Titulo Ef a tale of memories');
insert into capitulo (material_id, titulo) 
		values (10, 'Capitulo 5 Titulo Ef a tale of memories');
		
insert into capitulo (material_id, titulo) 
		values (11, 'Capitulo 1 Titulo Bleach');
insert into capitulo (material_id, titulo) 
		values (11, 'Capitulo 2 Titulo Bleach');
insert into capitulo (material_id, titulo) 
		values (11, 'Capitulo 3 Titulo Bleach');
insert into capitulo (material_id, titulo) 
		values (11, 'Capitulo 4 Titulo Bleach');
		
insert into capitulo (material_id, titulo) 
		values (12, 'Capitulo 1 Titulo One Piece');
insert into capitulo (material_id, titulo) 
		values (12, 'Capitulo 2 Titulo One Piece');
insert into capitulo (material_id, titulo) 
		values (12, 'Capitulo 3 Titulo One Piece');
insert into capitulo (material_id, titulo) 
		values (12, 'Capitulo 4 Titulo One Piece');

		
insert into capitulo (material_id, titulo) 
		values (13, 'Capitulo 1 Titulo Dragon Ball');
insert into capitulo (material_id, titulo) 
		values (13, 'Capitulo 2 Titulo Dragon Ball');
insert into capitulo (material_id, titulo) 
		values (13, 'Capitulo 3 Titulo Dragon Ball');
insert into capitulo (material_id, titulo) 
		values (13, 'Capitulo 4 Titulo Dragon Ball');
insert into capitulo (material_id, titulo) 
		values (13, 'Capitulo 5 Titulo Dragon Ball');	

insert into capitulo (material_id, titulo) 
		values (14, 'Capitulo 1 Titulo Naruto');
insert into capitulo (material_id, titulo) 
		values (14, 'Capitulo 2 Titulo Naruto');
insert into capitulo (material_id, titulo) 
		values (14, 'Capitulo 3 Titulo Naruto');
insert into capitulo (material_id, titulo) 
		values (14, 'Capitulo 4 Titulo Naruto');	

insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 1 Titulo Ranma');
insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 2 Titulo Ranma');
insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 3 Titulo Ranma');
insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 4 Titulo Ranma');
insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 5 Titulo Ranma');
insert into capitulo (material_id, titulo) 
		values (15, 'Capitulo 6 Titulo Ranma');

insert into capitulo (material_id, titulo) 
		values (16, 'Capitulo 1 Titulo A todo gas');
insert into capitulo (material_id, titulo) 
		values (16, 'Capitulo 2 Titulo A todo gas');
insert into capitulo (material_id, titulo) 
		values (16, 'Capitulo 3 Titulo A todo gas');
insert into capitulo (material_id, titulo) 
		values (16, 'Capitulo 4 Titulo A todo gas');
insert into capitulo (material_id, titulo) 
		values (16, 'Capitulo 5 Titulo A todo gas');

insert into capitulo (material_id, titulo) 
		values (17, 'Capitulo 1 Titulo Resacon en las vegas');
insert into capitulo (material_id, titulo) 
		values (17, 'Capitulo 2 Titulo Resacon en las vegas');
insert into capitulo (material_id, titulo) 
		values (17, 'Capitulo 3 Titulo Resacon en las vegas');

insert into capitulo (material_id, titulo) 
		values (18, 'Capitulo 1 Titulo Avatar');
insert into capitulo (material_id, titulo) 
		values (18, 'Capitulo 2 Titulo Avatar');
insert into capitulo (material_id, titulo) 
		values (18, 'Capitulo 3 Titulo Avatar');
insert into capitulo (material_id, titulo) 
		values (18, 'Capitulo 4 Titulo Avatar');

insert into capitulo (material_id, titulo) 
		values (19, 'Capitulo 1 Titulo Harry Potter');
insert into capitulo (material_id, titulo) 
		values (19, 'Capitulo 2 Titulo Harry Potter');
insert into capitulo (material_id, titulo) 
		values (19, 'Capitulo 3 Titulo Harry Potter');
insert into capitulo (material_id, titulo) 
		values (19, 'Capitulo 4 Titulo Harry Potter');
insert into capitulo (material_id, titulo) 
		values (19, 'Capitulo 5 Titulo Harry Potter');		

insert into capitulo (material_id, titulo) 
		values (20, 'Capitulo 1 Titulo El señor de los anillos');
insert into capitulo (material_id, titulo) 
		values (20, 'Capitulo 2 Titulo El señor de los anillos');
insert into capitulo (material_id, titulo) 
		values (20, 'Capitulo 3 Titulo El señor de los anillos');

insert into capitulo (material_id, titulo) 
		values (21, 'Capitulo 1 Titulo El rey leon');
insert into capitulo (material_id, titulo) 
		values (21, 'Capitulo 2 Titulo El rey leon');
insert into capitulo (material_id, titulo) 
		values (21, 'Capitulo 3 Titulo El rey leon');
insert into capitulo (material_id, titulo) 
		values (21, 'Capitulo 4 Titulo El rey leon');
		
commit;
