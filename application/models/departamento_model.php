<?php
class Departamento_model extends CI_Model{
	
	
	//Create... devuelve el n�mero de filas afectadas
	function create(){
		$this->load->database();
		
		$nombreDepto = $this->input->post("nombreDepto");
		$descripcion = $this->input->post("descripcion");		
		
		$sql = "INSERT INTO DEPARTAMENTO (nombreDepto, descripcion) 
   				VALUES (".$this->db->escape($nombreDepto).", ".$this->db->escape($descripcion).")";
		
		$this->db->query($sql);
		
		return $this->db->affected_rows();		
	}
	
	//Read... devuelve la informaci�n a mostrar para un departamento
	function read(){
		$this->load->database();		
		$idDepto = $this->input->post("idDepto");		
		
		$sql = "SELECT nombreDepto, descripcion
				FROM DEPARTAMENTO WHERE idDepto = ".$idDepto;
		
		$query = $this->db->query($sql);		
		$row = $query->row_array();
		
		return $row;		
	}
	
	//Update... devuelve el n�mero de filas afectadas
	function update(){
		$this->load->database();
		
		$idDepto = $this->input->post("idDepto");
		$nombreDepto = $this->input->post("nombreDepto");
		$descripcion = $this->input->post("descripcion");		
		
		$sql = "UPDATE DEPARTAMENTO 
				SET nombreDepto = ".$this->db->escape($nombreDepto).",
				    descripcion = ".$this->db->escape($descripcion)."
				WHERE idDepto = ". $idDepto; 
		
		echo $sql;
   				
		$this->db->query($sql);
		
		return $this->db->affected_rows();		
	}
	
	//Delete... devuelve el n�mero de filas afectadas
	function delete(){
		$this->load->database();
		
		$idDepto = $this->input->post("idDepto");		
		
		$sql = "DELETE DEPARTAMENTO 
				WHERE idDepto = ". $idDepto; 
		
		echo $sql;
   				
		$this->db->query($sql);
		
		return $this->db->affected_rows();		
	}
	
	
	//Devuelve los id's y nombres de departamentos en un arreglo listo para ser parseado a json (Aunque lo dejar la estructura lista deber�a hacerse en el controller, habr�a que cambiarlo)
	function autocompleteRead(){
		$this->load->database();
		$resultSetArray = array();
		
		$sql = "SELECT idDepto, nombreDepto FROM DEPARTAMENTO WHERE 1=1";		
		$query = $this->db->query($sql);
	
		if($query->num_rows > 0){			
			foreach ($query->result() as $row){		
				$rowArray = array();
				$rowArray["id"] = $row->idDepto;
				$rowArray["value"] = $row->nombreDepto;
				
				$resultSetArray[] = $rowArray;				
			}
			return $resultSetArray; //Esto es un arreglo "X" de arreglos "Y", donde cada arreglo "Y" contiene el id y el nombre de un depto				
		}		
	}
	
	
	//Devuelve en la variable $msg, los mensajes para los errores detectados por no cumplir las validaciones aplicadas usando la librer�a form_validation
	function saveValidation(){
		$this->load->library('form_validation');
		//print_r($_POST);
		$msg ="";		
		
		//Colocando las reglas para los campos, el segundo par�metro es el nombre del campo que aparecer� en el mensaje
		//Habr� que reemplazar los mensajes, pues por el momento est�n en ingl�s
		$this->form_validation->set_rules("nombreDepto", "Nombre", 'required|alpha');
		$this->form_validation->set_rules("descripcion", "Descripcion", 'alpha');		
		
		if ($this->form_validation->run() == false){//Si al menos una de las reglas no se cumpli�...
			//Concatenamos en $msg los mensajes de errores generados para cada campo, lo tenga o no
			$msg .= form_error("nombreDepto");
			$msg .= form_error("descripcion");			
		}
		return $msg;
	}
	
	

	
	
}