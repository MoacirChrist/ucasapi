<?php
class Cliente extends CI_Controller {

	function index() {
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));

		$idUsuario = $this->session->userdata("idUsuario");//Se agrega en $idRol el dato correspondiente de la sesi�n

		if($idUsuario == ""){//Si el dato no est� en sesi�n, se redirige a la p�gina de login
			redirect("login", "refresh");
		}
		else{
			$this->load->view("clienteView");
		}
	}

	function listaSolicitudes(){
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model("roleOptionsModel");	
		
		$controllerName = "cliente/listaSolicitudes";
		$filePath = base_url()."uploads/";
		
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
				
				$this->load->view("listaSolicitudesView", array("menu"=> $menu, "idUsuario" => $idUsuario,"userName" => $userName, "roleName" => str_replace("%20", " ", $roleName), "filePath" => $filePath));//Se agrega el c�digo del men� y el nombre del usuario como variables al view
				
			}
			else{//Si el usuario no tiene permiso para acceder a la p�gina se redirige a la anterior				
				redirect($previousPage,"refresh");
			}						
		}
		else{//Si no existe usuario en sesi�n se redirige al login
			redirect("login", "refresh");
		}		
	}

	function resumenProyectos() {
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model("roleOptionsModel");	
		
		$controllerName = "cliente/resumenProyectos";
		$filePath = base_url()."uploads/";
		
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
				
				$this->load->view("resumenProyectosView", array("menu"=> $menu, "idUsuario" => $idUsuario,"userName" => $userName, "roleName" => str_replace("%20", " ", $roleName), "filePath" => $filePath));//Se agrega el c�digo del men� y el nombre del usuario como variables al view
				
			}
			else{//Si el usuario no tiene permiso para acceder a la p�gina se redirige a la anterior				
				redirect($previousPage,"refresh");
			}						
		}
		else{//Si no existe usuario en sesi�n se redirige al login
			redirect("login", "refresh");
		}	
	}

	function gridProyectosUsuario($idUsuario) {
		$this->load->model("proyectoModel");
		echo json_encode($this->proyectoModel->gridProyectosUsuario($idUsuario));
	}

	function faseProyectoRead(){
		$this->load->model("proyectoModel");
		echo json_encode($this->proyectoModel->faseProyectoRead());
	}
}