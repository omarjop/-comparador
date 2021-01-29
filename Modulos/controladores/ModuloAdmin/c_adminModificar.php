<?php


class ControladorAdminModificar{

    public function modificarCampo($tabla,$columnaCompara,$columnaModificar,$valor,$id){
         
        $objUpdate = new ControladorUpdateDeleteInTables();//UpdateInTable
        //$sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id;
        $valor = "'$valor'";
        $sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id; 
        $resultado = $objUpdate->UpdateInTable($sql);
        if($resultado=="Exitoso"){
           echo "<script>toastr.info('Registro modificado exitosamente');</script>";                              
	    }else{
           echo "<script>toastr.error('Error al modificar, por favor intente nuevamente.');</script>";                             
		}
         echo "<script>toastr.info('$sql');</script>"; 
    }

        public function modifDosCampos($tabla,$columnaCompara,$columnaModificar1,$valor1,$id,$columnaModificar2,$valor2){
         
        $objUpdate = new ControladorUpdateDeleteInTables();//UpdateInTable
        //$sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id;
        $valor1 = "'$valor1'";
        $valor2 = "'$valor2'";
        $sql ="update ".$tabla." set ".$columnaModificar1." = ".$valor1."," .$columnaModificar2. "=" .$valor2. " where ".$columnaCompara." = ".$id; 
         echo "<script>toastr.info('$sql');</script>";
        $resultado = $objUpdate->UpdateInTable($sql);
        if($resultado=="Exitoso"){
           echo "<script>toastr.info('Registro modificado exitosamente');</script>";                              
        }else{
           echo "<script>toastr.error('Error al modificar, por favor intente nuevamente.');</script>";                             
        }
         echo "<script>toastr.info('$sql');</script>"; 
    }

    //-----------------------Inicia la modificacion de la data de producto------------------------
    public function modificarProductoAdmin($rutaImagen){
        $objLog =  new ControladorWorkLogs();
        $this->validarDatosProducto($rutaImagen,$objLog); 	     
	}

    private function validarDatosProducto($rutaImagen,$objLog){
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (validarDatosProducto) para la validacion de los datos de actualizar de producto con id ".$_POST["idProductValueAdmin"]);
          $objLog =  new ControladorWorkLogs();

         try{ 
               $datosDelProducto = array($_POST["nameProductoAdminEdit"],$_POST["tipoProductAdminEdit"],$_POST["unitt1AdminEdit"],$_POST["unidadNumericaAddAdminEdit"],$_POST["Reference1AdminEdit"],$_POST["marca1AdminEdit"],$_POST["CategoryAddAdminEdit"],$_POST["subCategoryAddAdminEdit"],$_POST["description1AdminEdit"],$_POST["idProductValueAdmin"]);              
               $this->actualizarProducto($datosDelProducto,$rutaImagen,$objLog);   
           }catch(Exception $e){
              $objLog->escribirEnLogAdmin("AdminProducto","ERROR",$e->getMessage());
		   }
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se finaliza el metodo (validarDatosProducto) "); 
	}


     private function actualizarProducto($datosDelProducto,$rutaImagen,$objLog){
           
           $objAdminAgregar  = new ControladorInserttAllTables(); 
           $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (actualizarProducto) para la actualización de producto con id ".$datosDelProducto[9]);
           
           $objUpdate = new ControladorUpdateDeleteInTables();
           $sql ="update producto set Marca_idMarca = "."'$datosDelProducto[5]'".",tipoProducto_idtipoProducto =" ."'$datosDelProducto[1]'"
           .",clasificacion_idclasificacion ="."'$datosDelProducto[3]'".",subCategoria_idsubCategoria ="."'$datosDelProducto[7]'".",Nombre ="."'$datosDelProducto[0]'"
           .",Referencia ="."'$datosDelProducto[4]'".",Descripcion ="."'$datosDelProducto[8]'"; 

           
            if($_FILES[$rutaImagen]["name"]!=""&&$_FILES[$rutaImagen]["name"]!=null){ 
                    $ruta = "../AdminComparador/imagenes_productos/".$_FILES[$rutaImagen]["name"];
                    $this->SubirArchivoImagen($rutaImagen);
                    $sql = $sql.",FotoPrincipal ="."'$ruta'";
                }
                $sql = $sql." where idProducto = ".$datosDelProducto[9];
                
           $resultado = $objUpdate->UpdateInTable($sql);

           if ($resultado=='Exitoso') {
                    $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se Actualiza correctamente el producto con id ".$datosDelProducto[9]);
                    echo "<script>toastr.info('Se Actualiza el producto correctamente');</script>";             
                }else{
                    $objLog->escribirEnLogAdmin("AdminProducto","ERROR","No se puede Actualizar el producto por el siguiente inconveniente ".$resultado);
                    echo "<script>toastr.error('Error al agregar el producto Error: '+".$resultado.");</script>";                             
                }
           $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se finaliza el metodo (actualizarProducto) "); 
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
    //-----------------------Finaliza la modificacion de la data de producto------------------------
}