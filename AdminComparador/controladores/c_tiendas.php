<?php

class Tiendas
{
    private $idEmpresa;
    private $idUsuario;
    private $nombreEmpresa;
    private $Direccion;
    private $nitEmpresa;
    private $idCategoria;
 
    public function __construct()
    {

    }
 
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }
 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
 
    public function getNombreEmpresa()
    {
       return $this->nombreEmpresa;
    }
    public function getDireccion()
    {
       return $this->Direccion;
    }
    public function getNitEmpresa()
    {
       return $this->nitEmpresa;
    }
    public function getIdCategoria()
    {
       return $this->idCategoria;
    }
//--------------------------------------------------
    public function setIdEmpresa($id_empresa){
        $this->idEmpresa = $id_empresa;
	}
    public function setIdUsuario($id_usuario){
        $this->idUsuario = $id_usuario;
	}
    public function setNombreEmpresa($nombre_empresa){
        $this->nombreEmpresa = $nombre_empresa;
	}
    public function setDireccion($direccion_empresa){
        $this->Direccion = $direccion_empresa;
	}
    public function setNitEmpresa($nit_empresa){
        $this->nitEmpresa = $nit_empresa;
	}
    public function setIdCategoria($id_Categoria)
    {
        $this->idCategoria = $id_Categoria;
    }
}