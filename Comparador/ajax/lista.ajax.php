<?php
require_once "../controladores/c_listas.php";
require_once "../modelos/m_listas.php";

class   AjaxListas{

    public $idLista;

    public function ajaxEditarLista(){
        $valor = $this->idLista;
        $response = ControladorListas::ctrlConsultarListas($valor);
        echo  json_encode($response);
    }

    public $idEliminar;
    public $estado;
    public function ajaxEliminarLista(){
        $datos = array("idLista"=>$this->idEliminar,
                        "estado"=>$this->estado, 
                        "control"=>0);
        $respuesta = ControladorListas::ctrlCambiarEstadoLista($datos);
        echo $respuesta;
        
    }
    public function ajaxActualizarListasUsuario(){
        $response = ControladorListas::ctrlMostrarListas( $_POST["item1"],  $_POST["item2"], $_POST["valor1"], $_POST["valor2"]);
        echo  json_encode($response);
    }

    public $idList;
    public $estadoProducto;
    public function ajaxBuscarProductoLista(){
        $datos = array( "idList"=>$this->idList,
                        "estadoProducto"=>$this->estadoProducto
                        );
        $respuesta = ControladorListas::ctrlMostrarProductosListas($datos);
        echo  json_encode ($respuesta);
    }

    public $idChange;
    public $nameChange;
    public function ajaxCambiarNombreLista(){
        $datos = array("idLista"=>$this->idChange,
                        "estado"=>$this->nameChange, 
                        "control"=>1);
        $respuesta = ControladorListas::ctrlCambiarNombreLista($datos);
        echo $respuesta;
        
    }
    public function ajaxConsultaP(){
        $respuesta = ControladorListas::ctrlConsultarPrpduct();
        echo  json_encode ($respuesta);
    }

    public $idListaP, $namePrdouct, $idProducto, $cantidadProduct;
    public function ajaxAgregaProductoLista(){
        $datos = array("idListaP"=>$this->idListaP,
                        "namePrdouct"=>$this->namePrdouct, 
                        "idProducto"=>$this->idProducto, 
                        "cantidadProduct"=>$this->cantidadProduct);
        $respuesta = ControladorListas::ctrlAgregarProductosLista($datos);
        echo ($respuesta);
    }
}

//para consultar una lista segun su ID
if(isset($_POST["idLista"])){  
    $idLista = new AjaxListas();
    $idLista -> idLista = $_POST["idLista"];
    $idLista ->ajaxEditarLista();
}

if(isset($_POST["idListaDelete"])){  
    $idListaDelete = new AjaxListas();
    $idListaDelete -> idEliminar = $_POST["idListaDelete"];
    $idListaDelete -> estado = $_POST["estado"];
    $idListaDelete ->ajaxEliminarLista();
}

if(isset($_POST["item1"])){  
    $idActualizar = new AjaxListas();
    $idActualizar ->ajaxActualizarListasUsuario();
}
if(isset($_POST["idLista2"])){  
    $buscaProductosList = new AjaxListas();
    $buscaProductosList -> idList = $_POST["idLista2"];
    $buscaProductosList -> estadoProducto= $_POST["estadoProducto"];
    $buscaProductosList ->ajaxBuscarProductoLista();
}
//funcion para cambiar el nombre de la lista 
if(isset($_POST["nameChange"])){  
    $cambiarNombreLista = new AjaxListas();
    $cambiarNombreLista  -> nameChange = $_POST["nameChange"];
    $cambiarNombreLista  -> idChange = $_POST["idChange"];
    $cambiarNombreLista  ->ajaxCambiarNombreLista();
}

//funcion para consultar los productos existentes. 
if(isset($_POST["consultaProduct"])){  
    $consultaP = new AjaxListas();
    $consultaP  ->ajaxConsultaP();
}

//Metodo para agragar productos a una lista
if(isset($_POST["cantidadProduct"])){  
    $agregaProducto = new AjaxListas();
    $agregaProducto  -> idListaP = $_POST["idListaP"];
    $agregaProducto  -> namePrdouct = $_POST["nameProducto"];
    $agregaProducto  -> idProducto = $_POST["idProcduto"];
    $agregaProducto  -> cantidadProduct = $_POST["cantidadProduct"];
    $agregaProducto  ->ajaxAgregaProductoLista();
}