<?php

/* Codigo basura que puedo incluir o no mas adelante
 * Para las busquedas de material*/
/*else if (isset($_POST['buscarma'])) {
                            if (isset($_POST['incluir'])) {
                                if (strlen($_POST['buscaanime']) > 0) { // Comprobación de que introduces al menos una letra
                                    $busqueda = buscar_material($_POST['buscaanime'], $V);
                                    if (isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar") {
                                        $datosQueGuardar[1] = $_POST['geneross'];
                                        $busqueda = $busqueda->where_like('genero', '%' . $_POST['geneross'] . '%');
                                    }
                                    if (isset($_POST['fech']) && $_POST['fech'] != "") {
                                        // echo "Holi";
                                        $busqueda = $busqueda->where('anio', $_POST['fech']);
                                        $datosQueGuardar[2] = $_POST['fech'];
                                    }

                                    $busqueda = $busqueda->limit(3)->offset(1)->find_many();
                                }
                                else
                                    $busqueda = null;
                            } else {
                                /*$busqueda = ORM::for_table('material');
                                if (isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar") {
                                    $busqueda = $busqueda->where_like('genero', '%' . $_POST['geneross'] . '%');
                                }
                                if (isset($_POST['fech']) && $_POST['fech'] != "") {
                                    $busqueda = $busqueda->where('anio', $_POST['fech']);
                                }

                                $busqueda = $busqueda->limit(3)->offset(1)->find_many();
                            }
                        }*/
 
?>
