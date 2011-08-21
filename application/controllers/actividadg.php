<?php

class Actividadg extends CI_Controller{
	
	function index(){
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model("roleOptionsModel");	
		
		$controllerName = strtolower(get_class($this));
		
		$previousPage = $this->session->userdata("currentPage");
		$previousPage = ($previousPage!="")?$previousPage:"buzon";
						
		$idRol = $this->session->userdata("idRol");//Se agrega en $idRol el dato correspondiente de la sesi�n
		
		if($idRol != ""){//Si est� en sesi�n
			$allowedPage = $this->roleOptionsModel->validatePage($idRol, $controllerName); 
			
			if($allowedPage){//Si el usuario seg�n rol tiene permiso para acceder a la p�gina
				$this->session->set_userdata("previousPage", $previousPage);
				$this->session->set_userdata("currentPage", $controllerName);
				
				$menu = $this->roleOptionsModel->showMenu($idRol);//Se genera el men�
				$userName = $this->session->userdata("username");//Se obtiene el nombre de usuario de la sesi�n
				$roleName = $this->session->userdata("roleName");
				$idUsuario = $this->session->userdata("idUsuario");
				
				$this->load->view("actividadgView", array("idUsuario" =>$idUsuario, "menu"=> $menu, "userName" => $userName, "roleName" => str_replace("%20", " ", $roleName)));//Se agrega el c�digo del men� y el nombre del usuario como variables al view
				
			}
			else{//Si el usuario no tiene permiso para acceder a la p�gina se redirige a la anterior				
				redirect($previousPage,"refresh");
			}
						
		}
		else{//Si no existe usuario en sesi�n se redirige al login
			redirect("login", "refresh");
		}
	}
	
	function actividadgRead(){
		// este metodo recibia $idUsuario
		$this->load->library('session');
		$this->load->model("actividadgModel");
		$idUsuario = $this->session->userdata("idUsuario");
		echo json_encode($this->actividadgModel->actividadRead($idUsuario));
	}
	
	function actividad($idActividad, $idProyecto){
		$this->load->library('session');
		$this->load->helper(array('url'));
		
		//$this->session->set_userdata("idActividad", $idActividad);
		//$this->session->set_userdata("idProyecto", $idProyecto);
		
		//redirect("actividad","refresh");
		$data = array();
		$data["idActividad"] = $idActividad;
		$data["idProyecto"] = $idProyecto;
		$data["idUsuario"] = $this->session->userdata("idUsuario");
		
		$this->load->view("actividadView", $data);
		
	}
	
}