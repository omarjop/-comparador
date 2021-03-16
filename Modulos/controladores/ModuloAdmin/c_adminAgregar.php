<?php


class ControladorAdminInsert{


   /*Este metodo retorna resultado del insert hecho en tabla*/
    public function agregarCampos($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("marca","Descripcion","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la marca correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la marca.Codigo: '+".$resultado.");</script>";                             
			  }
                  

        
    }
    public function agregarCamposUnid($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2){
            $objAdminAgregar  = new ControladorInserttAllTables();

            $resultado= $objAdminAgregar->insertInTable("unidadmedida","nombreMedida,control","'$valorAgregar'".",".$valorAgregar2);
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la unidad correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la unidad.Codigo: '+".$resultado.");</script>";                             

              }    
    }
        public function agregarCamposTEmp($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("tipoempresa","descripcion","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }

        public function agregarCamposTProducto($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("tipoproducto","descripcion","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }

        public function agregarCamposPais($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("pais","nombrePais","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }
        public function agregarCamposPerfil($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("perfil","Descripcion","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }
        public function agregarCamposTipoPago($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2){
            $objAdminAgregar  = new ControladorInserttAllTables(); 
            $resultado= $objAdminAgregar->insertInTable("tipo_pago","Tipo_pago,Descripcion_pago","'$valorAgregar'".","."'$valorAgregar2'");
 
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }

        public function agregarCamposCiudad($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2){
            $objAdminAgregar  = new ControladorInserttAllTables();  
            $resultado= $objAdminAgregar->insertInTable("ciudad","nombreCiudad,pais_idpais","'$valorAgregar'".",".$valorAgregar2);
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la Ciudad correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la Ciudad.Codigo: '+".$resultado.");</script>";                             

              }    
    }

        public function agregarCampoDia($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();   
            $resultado= $objAdminAgregar->insertInTable("dia","Descripcion","'$valorAgregar'");
    
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }
      }
    public function agregarCampodificultad($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
             $resultado= $objAdminAgregar->insertInTable("dificultad","nombre","'$valorAgregar'");
    
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar .Codigo: '+".$resultado.");</script>";                             
        }    
    }

        public function agregarCamposCategoria($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2,$columna3,$valorAgregar3){
            $objAdminAgregar  = new ControladorInserttAllTables();

            $resultado= $objAdminAgregar->insertInTable("categoria","nombre,control,ruta","'$valorAgregar'".",".$valorAgregar2.","."'$valorAgregar3'");
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la categor&iacute;a correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la categor&iacute;.Codigo: '+".$resultado.");</script>";                             

              }    
    }
            public function agregarCampospesovolumen($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("pesovolumen","unidadMedida_idunidadMedida,medida",$valorAgregar2.",".$valorAgregar);
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar.Codigo: '+".$resultado.");</script>";                             

              }    
    }
      public function agregarCampossubcategoria($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2,$columna3,$valorAgregar3){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("subcategoria","categoria_idCategoria,nombre,ruta",$valorAgregar.","."'$valorAgregar2'".","."'$valorAgregar3'");
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar.Codigo: '+".$resultado.");</script>";                             

              }    
    }
    

 //--------inicia administraci+on de producto---------------------------
    public function agregarProducto($rutaImagen){   
                 $objLog =  new ControladorWorkLogs();
                 $this->validarDatosProducto($rutaImagen,$objLog); 		  
	}

    private function validarDatosProducto($rutaImagen,$objLog){
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (validarDatosProducto) para la validacion de los datos de registro de producto");
          $objLog =  new ControladorWorkLogs();

         try{ 
               $datosDelProducto = array($_POST["nameProducto1"],$_POST["tipoProduct"],$_POST["unitt1"],$_POST["unidadNumericaAdd"],$_POST["Reference1"],$_POST["marca1"],$_POST["CategoryAdd"],$_POST["subCategoryAdd"],$_POST["description1"]);              
               $this->registrarProducto($datosDelProducto,$rutaImagen,$objLog);   
           }catch(Exception $e){
              $objLog->escribirEnLogAdmin("AdminProducto","ERROR",$e->getMessage());
		   }
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se finaliza el metodo (validarDatosProducto) "); 
	}

    private function registrarProducto($datosDelProducto,$rutaImagen,$objLog){
           
           $objAdminAgregar  = new ControladorInserttAllTables(); 
           $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (registrarProducto) para el registro de producto");
           $ruta = "../AdminComparador/imagenes_productos/".$_FILES[$rutaImagen]["name"];

           $into = "Marca_idMarca,tipoProducto_idtipoProducto,clasificacion_idclasificacion,subCategoria_idsubCategoria,Nombre,Referencia,	Descripcion,FotoPrincipal";      
           $value ="'$datosDelProducto[5]'".","."'$datosDelProducto[1]'".","."'$datosDelProducto[3]'".","."'$datosDelProducto[7]'".","."'$datosDelProducto[0]'".","."'$datosDelProducto[4]'".","."'$datosDelProducto[8]'".","."'$ruta'";
           $this->SubirArchivoImagen($rutaImagen);
           $resultado= $objAdminAgregar->insertInTable("producto",$into, $value);

           if ($resultado!='Fallo') {
                    $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se registra correctamente el producto con id ".$resultado);
                    echo "<script>toastr.info('Se agrego el producto correctamente');</script>";             
                }else{
                    $objLog->escribirEnLogAdmin("AdminProducto","INFO","No se puede registrar el producto por el siguiente inconveniente ".$resultado);
                    echo "<script>toastr.error('Error al agregar el producto Error: '+".$resultado.");</script>";                             
                }
           $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se finaliza el metodo (registrarProducto) "); 
	}

    private function returnPesoVolumen($pesoVolumen){
        $valorReturn = null;  
          if($pesoVolumen!=null){
                $aux = explode("-",$pesoVolumen);
                $valorReturn = $aux[1];
		  }

          return $valorReturn ; 
	}
    private function returnCategoria($categoria){
        $valorReturn = null;  
          if($categoria!=null){
                $aux = explode("-",$categoria);
                $valorReturn = $aux[0];
		  }

          return $valorReturn ; 
	}
    private function returnUnidadMedida($unit,$gramos,$kilo,$mili,$centimetros){
 
         $valorReturn = null;         
         if($unit!=null){
                  $medida = explode("-",$unit);
                  switch ($medida[0]) {
                            case "gramos":
                            $valorReturn=$_POST["grams"];
                        
                            break;
                        case "kilogramos":
                            $valorReturn=$_POST["kilograms"];
                        
                            break;
                        case "mililitros":
                            $valorReturn= $_POST["milliliters"];
                        
                            break;
                        case "centimetros":
                            $valorReturn=$_POST["centimeters"];
                        
                            break;
                    }


            
          }
            
            return $valorReturn;
	}

    public function SubirArchivoImagen($archivo){
        
            $rutaFinal;
            $rutaFinal= "../AdminComparador/imagenes_productos";
            $path = $rutaFinal;

            if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                             $rutaFinal= $rutaFinal."/";
                            $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                            if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                              return true;
                             } else {
                                              return false;
                            }

            }else{
                        $rutaFinal= $rutaFinal."/";
                        $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                          return true;
                         } else {
                                          return false;
                        }
                       
			}


    }

    //----------------------Finaliza administración producto--------------------------------------------------

    //----------------------Inicio Administración Recetas-----------------------------------------------------
    static public function ctrlMostrarRecetas(){

        $tabla = "recetas";
        $respuesta = ModeloAdminReceta::mdlMostrarRecetas($tabla);
        return $respuesta;

    }
    //----------------------Fin Administración Recetas--------------------------------------------------------
}