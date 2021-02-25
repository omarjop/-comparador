<?php
require_once "../controladores/c_blogs.php";
require_once "../modelos/m_blogs.php";


class   AjaxBlogs{

    public function ajaxConsultarBlog($idBlog){
           $item = "idblog";
           $respuesta = ControladorBlogs::CtrlMostrarBlogsForRuta($item, $idBlog);
           echo  json_encode ($respuesta);
	}

    public function ajaxAddComentario($comentario,$idRecetaComment,$idPersona){
           $respuesta = ControladorBlogs::ctrlRegistroComentarios($comentario,$idRecetaComment,$idPersona);
           echo ($respuesta);
	}

    public function ajaxValidarPalabraObcena($comentario){
        $respuesta = ControladorBlogs::ajaxValidarPalabraObcena($comentario);
        echo  json_encode ($respuesta);
	}

    public function ajaxConsultarComentariosXBlog($idBlogValue){
           $item3 = "blog_idblog";
           $respuesta = ControladorBlogs::ajaxConsultarComentariosXBlog($item3,$idBlogValue);
           echo  json_encode ($respuesta);
	}

}


if(isset($_POST["idBlogFind"])){  
    $idBlog = new AjaxBlogs();
    $idBlogValue = $_POST["idBlogFind"];
    $idBlog ->ajaxConsultarBlog($idBlogValue);
}

if(isset($_POST["addComentario"])){  
    $idReceta = new AjaxBlogs();
    $comentario = $_POST["addComentario"];
    $idRecetaComment = $_POST["idBlogComment"];
    $idPersona = $_POST["idPersona"];
    $idReceta ->ajaxAddComentario($comentario,$idRecetaComment,$idPersona);
}
if(isset($_POST["palabraObcena"])){
    $objBlog = new AjaxBlogs();
    $comentario = $_POST["palabraObcena"];
    $objBlog ->ajaxValidarPalabraObcena($comentario);
}
if(isset($_POST["comentariosXBlog"])){  
    $objBlog = new AjaxBlogs();
    $idBlogValue = $_POST["comentariosXBlog"];
    $objBlog ->ajaxConsultarComentariosXBlog($idBlogValue);
}