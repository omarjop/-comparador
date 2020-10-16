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
    public function ajaxBuscarProductoLista(){
        $valor = $this->idList;
        $respuesta = ControladorListas::ctrlMostrarProductosListas($valor);
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
    $buscaProductosList ->ajaxBuscarProductoLista();
}
//funcion para cambiar el nombre de la lista 
if(isset($_POST["nameChange"])){  
    $cambiarNombreLista = new AjaxListas();
    $cambiarNombreLista  -> nameChange = $_POST["nameChange"];
    $cambiarNombreLista  -> idChange = $_POST["idChange"];
    $cambiarNombreLista  ->ajaxCambiarNombreLista();
}