                            
                    <?php
                    ORM::configure('mysql:host=localhost;dbname=myfreakzone; charset=utf8');
                    ORM::configure('username','root');
                    ORM::configure('password','');
                    
                    $GLOBALS['generos'] = array('No filtrar',
                        'lucha','accion','misterio',
                        'apocaliptico','shonen','shojo',
                        'drama','amor','infantil');