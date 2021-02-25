<?php


class ControladorBlogs{ 

  /**==========================================================
     METODO que retorna los blogs en base de datos
  *==========================================================*/

  static public function ctrlMostrarBlogs(){

        $tabla1 = "blog";
        $tabla2 = "persona";
        $respuesta = ModeloBlog::ctrlMostrarBlogs($tabla1,$tabla2);
        return $respuesta;

    }

    static function ctrlReturnFechaForm($fecha){
        $array = explode(" ", $fecha);
        $arrayFinal = explode("-",$array[0]);
        $varReturn = null;
        switch ($arrayFinal[1]) {
                case "01":
                    $varReturn = "EN. ".$arrayFinal[0];
                    break;
                case "02":
                    $varReturn = "FEBR. ".$arrayFinal[0];
                    break;
                case "03":
                    $varReturn = "MZO. ".$arrayFinal[0];
                    break;
                case "04":
                    $varReturn = "ABR. ".$arrayFinal[0];
                    break;
                case "05":
                    $varReturn = "MY. ".$arrayFinal[0];
                    break;
                case "06":
                    $varReturn = "JUN. ".$arrayFinal[0];
                    break;
                case "07":
                    $varReturn = "JUL. ".$arrayFinal[0];
                    break;
                case "08":
                    $varReturn = "AGT. ".$arrayFinal[0];
                    break;
                case "09":
                    $varReturn = "SEPT. ".$arrayFinal[0];
                    break;
                case "10":
                    $varReturn = "OCT. ".$arrayFinal[0];
                    break;
                case "11":
                    $varReturn = "NOV. ".$arrayFinal[0];
                    break;
                case "12":
                    $varReturn = "DIC. ".$arrayFinal[0];
                    break;
            }
            return $varReturn;
	}

    static public function CtrlMostrarBlogsForRuta($item, $valor){
        $tabla = "blog";
        $respuesta = ModeloBlog::mdlMostrarBlogsForRuta($tabla,$item, $valor);
        return $respuesta;
	}


    // metodos para rgistro y consulta de comentarios por blog
    static public function ctrlRegistroComentarios($comentario,$idRecetaComment,$idPersona){

          $datos = array(
             "idPersona"=>$idPersona,
             "idBlog"=>$idRecetaComment,
             "comentario"=>'<ul>'.$comentario.'</ul>');

          $tabla= "comentarios";
          $respuesta = ModeloBlog::mdlRegistroComentarios($tabla , $datos);
          return $respuesta;
    }

    //Metodo que valida las palabras obcenas en el comentario antes de registrar

    static public function ajaxValidarPalabraObcena($comentario){
      
      
     $palabraobcenaReturn;
      if(strpos($comentario, ' ') !== false){
          $palabrasComentario = explode(' ', $comentario);
           foreach ($palabrasComentario as $valor) {
                $palabrasObcenas = ModeloBlog::mdlValidarPalabraObcena("Descripcion",$valor);
                if($palabrasObcenas){
                   $palabraobcenaReturn = $valor;
                   break;
				}
           }           
      }else{
          $palabras = $comentario;
          $palabrasObcenas = ModeloBlog::mdlValidarPalabraObcena("Descripcion",$palabras);
                 if($palabrasObcenas){
                   $palabraobcenaReturn = $palabras;
				}
	  }
      

      if($palabrasObcenas){
         return $palabraobcenaReturn;
	  }else{
          return "Correcto";
       }
	}

    static public function ajaxConsultarComentariosXBlog($item3,$idReceta){
        $tabla1 = "comentarios";
        $respuesta = ModeloBlog::mdlConsultarComentariosXBlog($tabla1,$item3,$idReceta);
        return $respuesta;
	}

   
}