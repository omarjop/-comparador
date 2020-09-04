
<?php 


class modelosWork{

   //public  $globall = array();

    public function modelVacio($mensaje){
        echo '    
             <script>
                          $(document).ready(function()
                          {
                             $("#staticBackdrop").modal("show");
                             document.getElementById("codigo").innerHTML="'.$mensaje.'";  

                          });
            </script>'; 
           
	}

     public function modelInformativo($mensaje){
        echo '    
             <script>
                          $(document).ready(function()
                          {
                             $("#textoGeneral2").modal("show");
                             document.getElementById("textoGeneral").innerHTML="'.$mensaje.'";  

                          });
            </script>'; 
           
	}
    
     public function modelRegistrosErroneo($returnMensaje){  
     
     $registro = $returnMensaje[0];
     $resultado = $returnMensaje[1];

     $final = "";
     $final1 = "";
     $cantidadExitosos = $resultado[count($resultado)-1];
     $cantidadExitosos = preg_replace("/[\r\n|\n|\r]+/", " ", $cantidadExitosos);
    

     $totalRegistros = $registro[count($registro)-1];
     $totalRegistros = preg_replace("/[\r\n|\n|\r]+/", " ", $totalRegistros);

     $erroneos = intval($totalRegistros)-intval($cantidadExitosos);

     $cantidadExitosos = "Productos cargados exitosamente: ".$cantidadExitosos. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registros con errores (No Cargados): ".$erroneos;;
     $totalRegistros = "Total de productos en el archivo: ".$totalRegistros;
     //$erroneos = "Registros erroneos: ".$erroneos;

     




        for($i=0;$i<count($resultado)-1;$i++){
             $aux = $resultado[$i];
             $aux = preg_replace("/[\r\n|\n|\r]+/", " ", $aux);
             $final.=$aux."<br>";
		}

         for($j=0;$j<count($registro)-1;$j++){
             $aux1 = $registro[$j];
             //echo $aux1;
             $aux1 = preg_replace("/[\r\n|\n|\r]+/", " ", $aux1);
             $final1.=$aux1."<br>";
		}


             $tabla="";
               echo '    
                     <script>
                                  $(document).ready(function()
                                  {
                                     $("#extra").modal("show");                 
                                     document.getElementById("registros").innerHTML= "'.$final1.'"; 
                                     document.getElementById("resultado").innerHTML= "'.$final.'"; 
                                     document.getElementById("totalRegistro").innerHTML= "'.$totalRegistros.'"; 
                                     document.getElementById("cantidadExito").innerHTML= "'.$cantidadExitosos.'";    
                                     document.getElementById("cantidadErroneoso").innerHTML= "'.$erroneos.'";    
                                     
                                     
                                  });
                    </script>';

	}


    
}
   
?>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modaltitulo" >
        <h5 class="modaltitulo" id="staticBackdropLabel">Informacion del archivo excel cargado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- aqui va el mensaje que se pasa por parametro-->
                             <p id="codigo"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary colorbotonamarillo" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="textoGeneral2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modaltitulo">
        <h5 class="modaltitulo" id="staticBackdropLabel">Informacion general</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- aqui va el mensaje que se pasa por parametro-->
                             <p id="textoGeneral"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary colorbotonamarillo" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="extra" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       
            
            <div class="container">
              <h2 class= " modaltitulo ">Informacion del archivo excel cargado</h2>

              <table class="table">
                  <tr>
                    <td id="totalRegistro"></td><td id="cantidadExito"></td>
                  </tr>
              </table>
                            
              <table class="table">

                  <tr class="colormenuprincipal colortexto">
                    <th>Producto</th><th>Descripcion del error</th>
                  </tr>
               
                <tbody>                    
                  <tr>
                    <td id="registros" style="background-color: #E1FBFD;" ></td><td id="resultado" style="background-color: #E1FBFD;"></td>
                  </tr>
                       
                </tbody>
              </table>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary colorbotonamarillo" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div> 


