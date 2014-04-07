                            
                    <?php/*  My Freak Zone - My Freak List - Web application for films, series and animes (Japanase Animation)
						  Copyright (C) 2014: David Femenía Vázquez

						  This program is free software: you can redistribute it and/or modify
						  it under the terms of the GNU Affero General Public License as published by
						  the Free Software Foundation, either version 3 of the License, or
						  (at your option) any later version.

						  This program is distributed in the hope that it will be useful,
						  but WITHOUT ANY WARRANTY; without even the implied warranty of
						  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
						  GNU Affero General Public License for more details.

						  You should have received a copy of the GNU Affero General Public License
						  along with this program.  If not, see [http://www.gnu.org/licenses/]. */
						                    /*  My Freak Zone - My Freak List - Web application for films, series and animes (Japanase Animation)
						  Copyright (C) 2014: David Femenía Vázquez

						  This program is free software: you can redistribute it and/or modify
						  it under the terms of the GNU Affero General Public License as published by
						  the Free Software Foundation, either version 3 of the License, or
						  (at your option) any later version.

						  This program is distributed in the hope that it will be useful,
						  but WITHOUT ANY WARRANTY; without even the implied warranty of
						  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
						  GNU Affero General Public License for more details.

						  You should have received a copy of the GNU Affero General Public License
						  along with this program.  If not, see [http://www.gnu.org/licenses/]. */
                    ORM::configure('mysql:host=localhost;dbname=myfreakzone; charset=utf8');
                    ORM::configure('username','root');
                    ORM::configure('password','');
                    
                    $GLOBALS['generos'] = array('No filtrar',
                        'lucha','accion','misterio',
                        'apocaliptico','shonen','shojo',
                        'drama','amor','infantil');