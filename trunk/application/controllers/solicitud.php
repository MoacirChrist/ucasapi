<?php

class Solicitud extends CI_Controller {

	function index() {
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
				
				$this->load->view("solicitudView", array("menu"=> $menu, "userName" => $userName, "roleName" => str_replace("%20", " ", $roleName)));//Se agrega el c�digo del men� y el nombre del usuario como variables al view
				
			}
			else{//Si el usuario no tiene permiso para acceder a la p�gina se redirige a la anterior				
				redirect($previousPage,"refresh");
			}						
		}
		else{//Si no existe usuario en sesi�n se redirige al login
			redirect("login", "refresh");
		}
	}

	function solicitudSave() {
		$this->load->model("solicitudModel");
		$retArray = array();

		$validationInfo = $this->solicitudModel->saveValidation();

		if($validationInfo["status"] == 0){//Los datos ingresados pasaron las validaciones
			$retArray = $this->solicitudModel->create();

		}
		else{//Los datos ingresados no pasaron las validaciones
			$retArray = $validationInfo;
		}

		echo json_encode($retArray);
	}

	function getSolicitud ($idSolicitud=NULL) {
		$this->load->model("solicitudModel");

		if(is_null($idSolicitud))
			echo json_encode($this->solicitudModel->getSolicitud());
		else {
			$this->load->helper(array('form', 'url'));
			$dataSolicitud = $this->solicitudModel->getSolicitud($idSolicitud);
			$this->load->view("solicitudUnicaView", $dataSolicitud);
		}
	}

	function getSolicitudCliente () {
		$this->load->model("solicitudModel");

		echo json_encode($this->solicitudModel->getSolicitudCliente());

	}

	function gridRead($id){
		$this->load->model("solicitudModel");
		echo json_encode($this->solicitudModel->gridSolicitudRead($id));
	}

	function misSolicitudes($esAutor) {
		$this->load->model("solicitudModel");
		echo json_encode($this->solicitudModel->misSolicitudes($esAutor));
	}

	// ***********************************************************************************
	// METODOS TEMPORALES

	// Hay que cambiar el model a 'prioridad' cuando esté listo
	function cargarPrioridades() {
		$this->load->model("solicitudModel");
		echo json_encode($this->solicitudModel->getPrioridades());
	}

	function empleadoAutocompleteRead() {
		$this->load->model("solicitudModel");
		echo json_encode($this->solicitudModel->empleadoAutocomplete());
	}

	function transferirSolicitud() {
		$this->load->model("solicitudModel");
		echo json_encode($this->solicitudModel->transferirSolicitud());
	}
}