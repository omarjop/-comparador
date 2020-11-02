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

    //--------Registro de producto---------------------------
    public function agregarProducto($rutaImagen){
          if(isset($_POST["btnaddproducto"])){

                 $this->validarDatosProducto($rutaImagen); 
		  }
	}

    private function validarDatosProducto($rutaImagen){
          $unit = $_POST["unitt1"];          
          $unit2 = $_POST["unitt1"];
          $precio="";
          $objLog =  new ControladorWorkLogs();
         // $objLog->escribirEnLogAdmin("Administracion","INFO","Valor del campo Sub categoria: ".$_POST["Category1"]);
          $objLog->escribirEnLogAdmin("Administracion","INFO","Valor del campo Sub categoria: ".$_POST["subCategory1"]);

         /* $datosDelProducto = array($_POST["nameProducto"],$precio,$this->returnPesoVolumen($unit),$this->returnUnidadMedida($unit2,$_POST["grams"],$_POST["kilograms"]
                                       ,$_POST["milliliters"],$_POST["centimeters"]),$_POST["Reference"],$_POST["marca"],$this->returnCategoria($_POST["Category"]),$_POST["description"]);
              
             $this->registrarProducto($datosDelProducto,$rutaImagen);   */
	}

    private function registrarProducto($datosDelProducto,$rutaImagen){
      
       $ruta = "../AdminComparador/imagenes_productos/".$_FILES[$rutaImagen]["name"];
       $objAdminAgregar  = new ControladorInserttAllTables();
       $into = "unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";      
       $value ="'$datosDelProducto[2]'".","."'$datosDelProducto[6]'".","."'$datosDelProducto[5]'".","."'$datosDelProducto[0]'".","."'$datosDelProducto[4]'".","."'$datosDelProducto[7]'".","."'$ruta'".","."'$datosDelProducto[3]'";
       $this->SubirArchivoImagen($rutaImagen);
       $resultado= $objAdminAgregar->insertInTable("producto",$into, $value);

       if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego el producto correctamente');</script>";             
            }else{
                echo "<script>toastr.error('Error al agregar el producto Error: '+".$resultado.");</script>";                             
              }
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

}