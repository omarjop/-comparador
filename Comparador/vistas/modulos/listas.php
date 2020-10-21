<?php
    $url = Ruta::ctrlRuta();    
    if(isset($_SESSION["id"])){
        $idUsu = $_SESSION["id"];
    }else{
        $idUsu = 10;
    }
?>
<div class="container-fluid" >
    <div class="container">
    
        
        <div class=" colorFondo col-lg-3 col-md-3 col-sm-2 col-xs-12" >   
        
            <div class=" mt-3 pb-3 mb-3 d-flex text-center">
                <img src="<?php echo $url ?>vistas/img/usuario/listas-de-verificacion.png" class="img-rounded elevation-2" alt="">
            </div>
            <ul class="nav flex-column ">
                <li class="nav-item">
                    <a class="nav-link " href="#modalListaCompra" data-toggle="modal"> <i class="fa fa-plus-circle"></i> Crear nueva lista</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link listasFull" href="#"> <i class="fa fa-list"></i>Mis listas creadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link listasComp" href="#"> <i class="fa fa-share-alt"></i> Listas compartidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link listasRecetas" href="#"> <i class="fa fa-cutlery"></i> Listas de recetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link listasBorradas" href="#"> <i class="fa fa-trash"></i> Papelera</a>
                </li>
                <h3> Mis Listas</h3>
                
                <div class="scrollLista">
                    <?php  
                        if(isset($_SESSION["id"])){
                            $item1 = "Persona_idPersona";
                            $item2 = "listaCompra_idListaCompra";
                            $valor1 = strval($idUsu);
                            $valor2 = "1";
                            $mostrarListas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                            $cantidadLista = sizeof($mostrarListas);
                            foreach ($mostrarListas as $key => $value) {
                                echo '
                                    <li class="nav-item">
                                        <a class="listEditView" href="#" id="'.$value["idListaCompra"].'"> <img src="'.$url.'vistas/img/usuario/memorandum.png">'.$value["nombreLista"].'</a>
                                    </li>
                                ';
                           }
                        }else{/*.$_COOKIE['lista-compra'].*/
                            echo' 
                            <li class="nav-item">
                                <a class="nav-link " href="#"> <img src="'.$url.'vistas/img/usuario/memorandum.png" class="img-rounded" alt="">Preubas</a>
                            </li>
                            
                            ';

                        }
                    ?>
                </div>
            </ul>
        </div>
        <!---========================================  
        TODAS MIS LISTAS style="display:none"
        ===========================================-->
        <ul class="listasfullC" id="RecargarListas">
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas"> 
            
                <?php  
                    if(isset($_SESSION["id"])){
                        if($cantidadLista > 0){
                            echo '
                            <div class="p-3 mb-2 titiloInf"><i class="fa fa-list"></i> Mis listas creadas</div>
                            <div class="row">';
                            foreach ($mostrarListas as $key => $value) {
                                echo' <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                              
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3 id="nameListCCC">'.$value["nombreLista"].'</h3>
                                            <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Comparar lista"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a> </span></li>
                                                <li><span data-toggle="tooltip" title="Ver y editar lista"><a class="listEditView" href="#" id="'.$value["idListaCompra"].'"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Compartir lista"><a href="#" value="'.$value["nombreLista"].'"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Elimirar lista"><a class="listDelete" href="#"  id="'.$value["idListaCompra"].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Programar lista"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i></a> </span></li>
                                            </ul>
                                        </div>
                        
                                    </div>';
                            }
                        }else{
                            echo '
                                <li>
                                    <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                                    <div class="h-30"></div>
                                    <p> Crea tu primera lista. Haga <br> sus compras más 
                                    rápidas y convenientes.</p>
                                    <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                                </li>';
                        }               
                    }else{

                        echo '
                        <li>
                            <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                            <div class="h-30"></div>
                            <p> Crea tu primera lista. Haga <br> sus compras más 
                            rápidas y convenientes.</p>
                            <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                        </li>';
                    }
                ?>
            </div>
        </ul>
        <!---========================================  
        LISTAS COMPARTIDAS style="display:none"
        ===========================================-->
        <ul class="listasCompartidasD" style="display:none">
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas">
                <?php  
                    if(isset($_SESSION["id"])){
                        $item1 = "Persona_idPersona";
                        $item2 = "listaCompra_idListaCompra";
                        $valor1 = strval($idUsu);
                        $valor2 = "3";
                        $listasCompartidas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                        $cantidadListaCom = sizeof($listasCompartidas);
                        
                        if($cantidadListaCom > 0){
                            echo '
                            <div class="p-3 mb-2 titiloInf"><i class="fa fa-share-alt"></i> Tus listas compartidas</div>
                            <div class="row">';
                            foreach ($listasCompartidas as $key => $value) {
                                echo' <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                                        
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                       
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3><a href="http://www.webcoderskull.com/">'.$value["nombreLista"].'</a></h3>
                                                <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Comparar lista"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a> </span></li>
                                                <li><span data-toggle="tooltip" title="Ver y editar lista"><a href="#" id="'.$value["idListaCompra"].'"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Compartir lista"><a href="#" value="'.$value["nombreLista"].'"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Elimirar lista"><a href="#modalEliminarLista" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Programar lista"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i></a> </span></li>
                                            </ul>
                                        </div>
                        
                                    </div>';
                            }
                        }else{
                            echo '
                                <li>
                                    <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                                    <div class="h-30"></div>
                                    <p> No tienes listas compartidas. <br> crea una lista y compártela con tus amigos. </p>
                                    <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                                </li>';
                        }               
                    }else{

                        echo '
                        <li>
                            <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                            <div class="h-30"></div>
                            <p> No tienes listas compartidas.</p>
                            <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                        </li>';
                    }
                ?>
            </div>
        </ul>
        <!---========================================  
        LISTAS COMPARTIDAS style="display:none"
        ===========================================-->
        <ul class="listasRecetasR" style="display:none">
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas">
                <?php  
                    if(isset($_SESSION["id"])){
                        $item1 = "Persona_idPersona";
                        $item2 = "listaCompra_idListaCompra";
                        $valor1 = strval($idUsu);
                        $valor2 = "4";
                        $mostrarListasCompar = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                        $cantidadListaCompar = sizeof($mostrarListasCompar);
                        
                        if($cantidadListaCompar > 0){
                            echo '
                            <div class="p-3 mb-2 titiloInf"><i class="fa fa-cutlery"></i> Tus de Recetas </div>
                            <div class="row">';
                            foreach ($mostrarListasCompar as $key => $value) {
                                echo' <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                                        
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3><a href="http://www.webcoderskull.com/">'.$value["nombreLista"].'</a></h3>
                                                <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Comparar lista"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a> </span></li>
                                                <li><span data-toggle="tooltip" title="Ver y editar lista"><a href="#" id="'.$value["idListaCompra"].'"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Compartir lista"><a href="#" value="'.$value["nombreLista"].'"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Elimirar lista"><a href="#modalEliminarLista" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Programar lista"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i></a> </span></li>
                                            </ul>
                                        </div>
                        
                                    </div>';
                            }
                        }else{
                            echo '
                                <li>
                                    <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                                    <div class="h-30"></div>
                                    <p> No tienes listas de recetas, <br>busca una receta y hazla parte de ti. </p>
                                    <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Ir a recetas</button>

                                </li>';
                        }               
                    }else{

                        echo '
                        <li>
                            <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                            <div class="h-30"></div>
                            <p> No tienes listas compartidas.</p>
                            <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                        </li>';
                    }
                ?>
            </div>
        </ul>
         <!---========================================  
        LISTAS BORRADAS style="display:none"
        ===========================================-->
        <ul class="listasborradasC" style="display:none">
       
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas"> 
            
                <?php  
                    if(isset($_SESSION["id"])){
                        
                        $item1 = "Persona_idPersona";
                        $item2 = "listaCompra_idListaCompra";
                        $valor1 = strval($idUsu);
                        $valor2 = "2";
                        $mostrarListasBorradas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                        $cantidadLista = sizeof($mostrarListasBorradas);
                       if($cantidadLista > 0){
                            echo '<div class="p-3 mb-2 titiloInf"><i class="fa fa-trash"></i> Tus Listas Borradas</div>';
                            foreach ($mostrarListasBorradas as $key => $value) {
                                echo '
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                                            
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3><a href="http://www.webcoderskull.com/">'.$value["nombreLista"].'</a></h3>
                                            <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Recuperar lista"><a class="recuperarlista" href="#"  id="'.$value["idListaCompra"].'"><i class="fa fa-recycle" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Borrado total"><a href="#modalEliminarLista" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                
                                    </div>
                                    ';
                            }
                       }else{
                            echo' 
                            <li>
                                <img src="'.$url.'vistas/img/usuario/basura.png" class="img-rounded elevation-2" alt=""> 
                                <div class="h-30"></div>
                                <p> La lista eliminada va a la papelera. Si necesita <br> la lista de la papelera, puedes recuperarla. </p>
                            </li>
                            ';
                       }
                    }else{/*.$_COOKIE['lista-compra'].*/
                        echo' 
                        <li>
                            <img src="'.$url.'vistas/img/usuario/basura.png" class="img-rounded elevation-2" alt=""> 
                            <div class="h-30"></div>
                            <p> La lista eliminada va a la papelera. Si necesita <br> la lista de la papelera, puedes recuperarla. </p>
                        </li>
                        ';
                    }
                ?>
            </div>
        </ul>
       
        
        <!---========================================  
        DIV PARA VER Y EDITAR LISTAS
        ===========================================-->
        <ul class="listaEditViewC" style="display:none">
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12" id="infoListas"> 
                <div class="table-responsive">
                    <div class="table-wrapper table-striped  table-hover">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                                    <div id="nameList"></div>
                               </div> 
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div id="botonesCabecera"></div>		
                                </div>
                            </div>
                        </div>

                        <!-- aca se debe colocar una clase para ocultarla  style="display:none;"-->
                        <div class="agragaProduct" style="display:none;">
                            <div class="row">  
                               <div class="AgregaProducto" id="AgregaProducto"></div>
                             <!--    <select id="mibuscador" class="form-control" style="width:40%;">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>  -->
                            </div>
                        </div>
                        <!-- ------ -->

                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </span>
                                </th>
                                <th scope="col">Nombre del producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="productos"></tbody>
                        </table>
                     <!--   <div class="clearfix">
                            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

<!-- =======================================
VENTANA MODAL PARA CREAR LISTAS DE COMPRA
============================================-->
<div class="modal fade modalFormulario" id="modalListaCompra" tabindex="-1" role="dialog" aria-labelledby="modalListaCompra" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalTitulo">

            <h3 class="colorbarra"><i class="fa fa-list" aria-hidden="true"></i> CREAR LISTA</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="controlar">
            <div class="col-xs-12 espacio">
                <div class="col-md-12 espacio">
                    <form method="post" class="form-signin">
                        <div id="logreg-forms">     
                        
                            <div class="form-group">
                                <label for="validation01">Como quieres llamar a tu lista. </label>
                                <input type="text" class="form-control is-valid" id="nombreLista" name="nombreLista"
                                        placeholder="Nombre de tu lista" value="" required>
                            </div>
                            <?php  
                            /**AQUI PUEDO COLOCAR UNA CONDISION PARA VALIDAR LA VARIABLE DE SESION 
                                * DEL USUARIO SI EXISTE LLAMO AL CONTROLADOR 
                                */
                                $crearLista = new ControladorListas();
                                $crearLista->ctrlCrearLista($idUsu); 
                            ?>
                            <button type="submit" class="btn backColor btn-block" ><i class="fa fa-sign-in"></i> CREAR LISTA</button>
                        </div>
                    </form>  
                </div>
            </div>
            </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>