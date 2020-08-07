  

  <div class="container" >
       <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="btn-center" >
                        <div class="row" class="bordes">
                        
                             <div class="col-md-12 bordesdivattach">
                                  
                                  <div class="bordesdivattach1">
                                    <p class="colortexto">Adjuntar Archivo plano</p>
                                  </div>
                                  
                                    <div class="well well-sm">
                                            <p></p>
                                            <form class="form" method="post" enctype="multipart/form-data">
                                                  <div class="form-group">   
                                                  
                                                              <input type="file" class="form-control-file" id="attachmentPlano"  name="attachmentPlano" accept="text/plain" action="addNewProduct">
                                                              <p></p>
                                                                 <div class="centrado">
                                                                    <button type="submit" class="btn btn-warning colorbotonamarillo" name="CargarPlano" action ="buttonAttach" >Cargar</button>
                                                                    <button type="button" class="btn btn-warning colorbotonamarillo" data-toggle="modal" data-target="#exampleModal">Cancelar</button>
                                                                 </div>
                                                  </div>
                                            </form>
                                     </div>
                                   
                             </div>
                       </div>
                  </div>
              </div>



                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="btn-center" >
                        <div class="row" class="bordes">
                        
                             <div class="col-md-12 bordesdivattach">
                                  
                                  <div class="bordesdivattach1">
                                     <p class="colortexto">Adjuntar Archivo Excel</p>
                                  </div>
                                  
                                    <div class="well well-sm">
                                            <p></p>
                                            <form class="form" method="post" enctype="multipart/form-data">
                                                  <div class="form-group">   
                                                  
                                                              <input type="file" class="form-control-file" id="attachmentExcel" name="attachmentExcel" accept="application/vnd.ms-Excel">
                                                              <p></p>
                                                                <div class="centrado">
                                                                    <button type="submit" class="btn btn-warning colorbotonamarillo" name="Cargarexcel" action ="">Cargar</button>
                                                                    <button type="submit" class="btn btn-warning colorbotonamarillo">Cancelar</button>
                                                                 </div>



                                                  </div>
                                            </form>
                                     </div>
                                   
                             </div>
                       </div>
                  </div>

              </div>


       </div>

</div>



  <?php


 //-----------------------Valida las acciones del boton de adjuntar---------------------------------------------    

      if(isset($_POST['CargarPlano'])){               
              validarAccionBoton('attachmentPlano',"text/plain");
       }

      if(isset($_POST['Cargarexcel'])){               
              validarAccionBoton('attachmentExcel',"application/vnd.ms-excel");
      }



//-----------------------Funciones del desarrollo-----------------------------------------------------------------


     function validarAccionBoton($archivo,$extension){
           $objRutas =  new ControladorRutasGenerales();
           $objAdjuntar =  new ControladorAdjuntos();
           $objLog =  new ControladorWorkLogs();
           $objLog-> escribirEnLog("Adjuntar Archivo","INFO","1234567","Se inicia el proceso de adjuntar el archivo: ".$_FILES[$archivo]["name"]);
           $ruta = $objRutas -> rutaArchivoAdjuntos();
           $resultado = $objAdjuntar ->validasiExtensionArchivo($archivo,$extension);
           if($extension=="text/plain"){
                   validasiExtensionArchivo($archivo,$resultado,$ruta,$objAdjuntar,$objLog,/*este campo es el nit*/"1234567",/*tipo de archivo plano o excel*/"Plano");
            }else{
                   validasiExtensionArchivo($archivo,$resultado,$ruta,$objAdjuntar,$objLog,/*este campo es el nit*/"1234567",/*tipo de archivo plano o excel*/"Excel");
			}
            $objLog-> escribirEnLog("Adjuntar Archivo","INFO","1234567","Se finaliza el proceso de adjuntar el archivo: ".$_FILES[$archivo]["name"]);
            

	 }

      function validasiExtensionArchivo($archivo,$resultadoValidaExt,$ruta,$objAdjuntar,$objLog,$nitUser,$tipoArchivo){
      $objModel =  new modelosWork();
            try{
                    if($resultadoValidaExt == 1){                  
                          $resultado = $objAdjuntar -> SubirArchivoPlano($archivo,$ruta,$nitUser);
                          $objLog-> escribirEnLog("Adjuntar Archivo","INFO",$nitUser,"La extension de el archivo es correcta");
                          cargarArchivo($resultado,$ruta,$_FILES[$archivo]["name"],$objAdjuntar,$objLog,$nitUser,$tipoArchivo);                          
			        }else{
                          $objLog-> escribirEnLog("Adjuntar Archivo","WARN",$nitUser,"La extension del archivo es erronea");
                          $objModel -> modelVacio("Tipo de archivo incorrecto, por favor seleccione un archivo ".$tipoArchivo); 
			        } 
             }catch(Exception $e){
                echo "Se presenta el siguiente error validando la extension del archivo: ",$e->getMessage();
                $objLog-> escribirEnLog("Adjuntar Archivo","WARN",$nitUser,"No se pudo subir el archivo Se presenta el siguiente error validando la extension del archivo: ".$e->getMessage()." En el metodo validasiExtensionArchivo");
                
			 }       
     }

     function cargarArchivo($resultado,$ruta,$archivo,$objetoAdjuntarArchivo,$objLog,$nitUser,$tipoArchivo){
         try{
                if($resultado == 1){
                          cargarArchivPlanoPExcel($ruta,$archivo,$objetoAdjuntarArchivo,$objLog,$nitUser,$tipoArchivo);             
		        }else{
                    echo "No se pudo subir el archivo";  
                    $objLog-> escribirEnLog("Adjuntar Archivo","WARN",$nitUser,"No es posible procesar los registros del archivo");
		        }
            }catch(Exception $e){
                echo "Se presenta el siguiente error subiendo el archivo: ",$e->getMessage();
                $objLog-> escribirEnLog("Adjuntar Archivo","WARN",$nitUser,"Se presenta el siguiente error en el metodo validarResultado".$e->getMessage()." En el metodo validarResultado");
            }    
	 }

     function cargarArchivPlanoPExcel($ruta,$archivo,$objetoAdjuntarArchivo,$objLog,$nitUser,$tipoArchivo){
           try{
                if($tipoArchivo == "Plano"){
                        $valor =  $objetoAdjuntarArchivo ->validarSubirArchivoPlano($ruta.$nitUser."folder/".$archivo);
                      
		        }
            }catch(Exception $e){
                echo "Se presenta el siguiente error subiendo el archivo: ",$e->getMessage();
                $objLog-> escribirEnLog("Adjuntar Archivo","WARN",$nitUser,"Se presenta el siguiente error en el metodo cargarArchivPlanoPExcel".$e->getMessage()." En el metodo validarResultado");                
			}
	 }



  ?>