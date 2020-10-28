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


    //--------Registro de producto---------------------------
    public function agregarProducto(){
          if(isset($_POST["btnaddproducto"])){

                 $this->validarDatosProducto(); 
		  }
	}

    private function validarDatosProducto(){
          $unit = $_POST["unitt"];          
          $unit2 = $_POST["unitt"];
          $datosDelProducto = array($_POST["nameProducto"],$_POST["price"],$this->returnPesoVolumen($unit),$this->returnUnidadMedida($unit2,$_POST["grams"],$_POST["kilograms"]
                                       ,$_POST["milliliters"],$_POST["centimeters"]),$_POST["Reference"],$_POST["marca"],$this->returnCategoria($_POST["Category"]),$_POST["description"]);
              
             $this->registrarProducto($datosDelProducto);   
	}

    private function registrarProducto($datosDelProducto){
      
       $ruta ="";
       $objAdminAgregar  = new ControladorInserttAllTables();
       $into = "unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";      
       $value ="'$datosDelProducto[2]'".","."'$datosDelProducto[6]'".","."'$datosDelProducto[5]'".","."'$datosDelProducto[0]'".","."'$datosDelProducto[4]'".","."'$datosDelProducto[7]'".","."'$ruta'".","."'$datosDelProducto[3]'";
     //  echo "<script>toastr.info($value);</script>";  
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

}