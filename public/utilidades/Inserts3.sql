SET AUTOCOMMIT = 0;
START TRANSACTION;

insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 2', '2014/02/03', 'fuente numero 1', 1, 'pepito, coso, otro', 'Titulo 2');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 3', '2014/02/03', 'fuente numero 2', 1, 'pepito, cosa, otro', 'Titulo 3');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 4', '2014/02/03', 'fuente numero 3', 1, 'pepita, coso, otro', 'Titulo 4');
insert into noticia(noticia, fecha_publicado, fuente, usuario_id, etiquetas, titulo)
		values ('Noticia numero 5', '2014/02/03', 'fuente numero 4', 1, 'pepe, cosita, otroscosos', 'Titulo 5');
		
commit;