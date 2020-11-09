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
        $this->validarDatosProducto($rutaImagen,$objLog); 	     
	}

    private function validarDatosProducto($rutaImagen,$objLog){
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (validarDatosProducto) para la validacion de los datos de actualizar de producto");
          $objLog =  new ControladorWorkLogs();

         try{ 
               $datosDelProducto = array($_POST["nameProductoAdminEdit"],$_POST["tipoProductAdminEdit"],$_POST["unitt1AdminEdit"],$_POST["unidadNumericaAddAdminEdit"],$_POST["Reference1AdminEdit"],$_POST["marca1AdminEdit"],$_POST["CategoryAddAdminEdit"],$_POST["subCategoryAddAdminEdit"],$_POST["description1AdminEdit"]);              
               $this->actualizarProducto($datosDelProducto,$rutaImagen,$objLog);   
           }catch(Exception $e){
              $objLog->escribirEnLogAdmin("AdminProducto","ERROR",$e->getMessage());
		   }
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se finaliza el metodo (validarDatosProducto) "); 
	}


     private function actualizarProducto($datosDelProducto,$rutaImagen,$objLog){
           
           $objAdminAgregar  = new ControladorInserttAllTables(); 
           $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia el metodo (actualizarProducto) para el registro de producto");
           $ruta = "../AdminComparador/imagenes_productos/".$_FILES[$rutaImagen]["name"];

           $into = "Marca_idMarca,tipoProducto_idtipoProducto,unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Nombre,Referencia,	Descripcion,FotoPrincipal,pesoVolumen";      
           $value ="'$datosDelProducto[5]'".","."'$datosDelProducto[1]'".","."'$datosDelProducto[2]'".","."'$datosDelProducto[7]'".","."'$datosDelProducto[0]'".","."'$datosDelProducto[4]'".","."'$datosDelProducto[8]'".","."'$ruta'".","."'$datosDelProducto[3]'";
             
            if($rutaImagen!=""&&$rutaImagen!=null){ 
                    $this->SubirArchivoImagen($rutaImagen);
                }
           //$resultado= $objAdminAgregar->insertInTable("producto",$into, $value);*/

          /* if ($resultado!='Fallo') {
                    $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se registra correctamente el producto con id ".$resultado);
                    echo "<script>toastr.info('Se agrego el producto correctamente');</script>";             
                }else{
                    $objLog->escribirEnLogAdmin("AdminProducto","INFO","No se puede registrar el producto por el siguiente inconveniente ".$resultado);
                    echo "<script>toastr.error('Error al agregar el producto Error: '+".$resultado.");</script>";                             
                }*/
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