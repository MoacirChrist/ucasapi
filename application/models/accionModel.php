<?php
class accionModel extends CI_Model{
	
	
	function create(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$nombreAccion = $this->input->post("nombreAccion");				
		
		$sql = "INSERT INTO ACCION (nombreAccion) 
   				VALUES (".$this->db->escape($nombreAccion).")";
		
		$query = $this->db->query($sql);
		
		if (!$query){
	     	$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    }	    
		return $retArray;		
	}
	
	
	function read(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());
		
		$idAccion = $this->input->post("idAccion");		
		
		$sql = "SELECT nombreAccion
				FROM ACCION WHERE idAccion = ".$idAccion;
		
		$query = $this->db->query($sql);
		
		if ($query) {
			$row = $query->row_array();
	    	$retArray["data"] = $row;	     	
	    }
	    else{
	    	$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    	
	    }
	    
	    return $retArray;
	}
	

	function update(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$idAccion = $this->input->post("idAccion");
		$nombreAccion = $this->input->post("nombreAccion");				
		
		$sql = "UPDATE ACCION 
				SET nombreAccion = ".$this->db->escape($nombreAccion)."				    
				WHERE idAccion = ". $idAccion; 
		
		$query = $this->db->query($sql);
		
		if (!$query) {
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    }
		
		return $retArray;		
	}
	

	function delete(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$idAccion = $this->input->post("idAccion");
		
		$sql = "DELETE FROM ACCION 
				WHERE idAccion = ". $idAccion;
   				
		$query = $this->db->query($sql);
		
		if (!$query) {
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    }
		
		return $retArray;	
	}
	
	
	function autocompleteRead(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());
		
		$sql = "SELECT idAccion, nombreAccion FROM ACCION";
		$query = $this->db->query($sql);		
	
		if($query){
			if($query->num_rows > 0){			
				foreach ($query->result() as $row){		
					$rowArray = array();
					$rowArray["id"] = $row->idAccion;
					$rowArray["value"] = $row->nombreAccion;
					
					$retArray["data"][] = $rowArray;				
				}							
			}
		}
		else{
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
		}
		
		return $retArray;
	}
	
	
	//Devuelve en la variable $msg, los mensajes para los errores detectados por no cumplir las validaciones aplicadas usando la librer�a form_validation
	function saveValidation(){
		$this->load->library('form_validation');
		//print_r($_POST);
		
		$retArray = array("status"=> 0, "msg" => "");
		
		//Colocando las reglas para los campos, el segundo par�metro es el nombre del campo que aparecer� en el mensaje
		//Habr� que reemplazar los mensajes, pues por el momento est�n en ingl�s
		$this->form_validation->set_rules("nombreAccion", "Nombre de accion", 'required|alpha');	
			
		
		if ($this->form_validation->run() == false){//Si al menos una de las reglas no se cumpli�...
			//Concatenamos en $msg los mensajes de errores generados para cada campo, lo tenga o no
			$retArray["status"] = 1;
			
			$retArray["msg"] .= form_error("nombreAccion");						
		}		
		return $retArray;
	}	
		
}