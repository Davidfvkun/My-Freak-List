SET AUTOCOMMIT = 0;
START TRANSACTION;
	
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

commit;