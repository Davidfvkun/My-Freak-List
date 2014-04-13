SET AUTOCOMMIT = 0;
START TRANSACTION;

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

commit;