<?php
class procesoModel extends CI_Model{
	
	
	function create(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$nombreProceso = $this->input->post("nombreProceso");	
		$descripcion = $this->input->post("descripcion");
		$idProyecto = $this->input->post("idProyecto");
		$idFase = $this->input->post("idFase");
		$idEstado = $this->input->post("idEstado");
		
		$sql = "INSERT INTO PROCESO (nombreProceso,descripcion,idProyecto,idFase,idEstado,activo) 
   				VALUES (".$this->db->escape($nombreProceso).", ".$this->db->escape($descripcion).",".'NULL'.",".$this->db->escape($idFase).",".$this->db->escape($idEstado).","."1".")";
		
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
		
		$idProceso = $this->input->post("idProceso");		
		
		$sql = "SELECT e.idEstado, p.nombreProceso, p.descripcion, e.estado, pr.nombreProyecto
				FROM PROCESO p INNER JOIN Proyecto pr ON p.idProyecto = pr.idProyecto 
					INNER JOIN ESTADO e ON p.idEstado = e.idEstado
				WHERE p.idProceso = " .$idProceso;
		
		$query = $this->db->query($sql);
		
		if($query) {
			$row = $query->row_array();
	    	$retArray["data"] = $row;	     	
	    }
	    else{
	    	$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    	
	    }
	    
	    return $retArray;
	}
	
	function faseRead(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());		
		
		$sql = "SELECT idFase, nombreFase FROM FASE";
		
		$query = $this->db->query($sql);
		
		if($query){
			if($query->num_rows > 0){			
				foreach ($query->result() as $row){		
					$rowArray = array();
					$rowArray["id"] = $row->idFase;
					$rowArray["value"] = $row->nombreFase;
										
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
	
	function readGrid($idProceso){
		$this->load->database();
		
		$page = $this->input->post("page");
		$limit = $this->input->post("rows");
		$sidx = $this->input->post("sidx");
		$sord = $this->input->post("sord");
		$count = 0;
		if(!$sidx) $sidx =1;
		
		$sql = "SELECT COUNT(*) FROM Fase";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0){
			$row = $query->row();
			$count  = $row->count;
		}

		if( $count >0 ){
			$total_pages = ceil($count/$limit);
		}
		else{
			$total_pages = 0;
		}

		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;

		$response->page = $page;
		$response->total = $total_pages;
		$response->records = $count;
		
		//------------------------------------------------------------------------------------------------------
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());	
		
		$sql = 	"SELECT fxp.idFase, f.nombreFase, fxp.fechaIniPlan, fxp.fechaFinPlan, fxp.fechaIniReal, fxp.fechaFinReal " .
			   	"FROM FASE f INNER JOIN FASE_PROCESO fxp ON f.idFase = fxp.idFase INNER JOIN PROCESO p " . 
				"ON fxp.idProceso = p.idProceso WHERE p.idProceso = ".$idProceso;
		
		$query = $this->db->query($sql);

		$i = 0;
		if($query){
			if($query->num_rows > 0){
				foreach ($query->result() as $row){
					$response->rows[$i]["id"] = $row->idFase;
					$response->rows[$i]["cell"] = array($row->idFase, $row->nombreFase, $row->fechaIniPlan, $row->fechaFinPlan, $row->fechaIniReal, $row->fechaFinReal);
					$i++;
				}
			}
		}

		return $response;
	}

	function update(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$idEstado = $this->input->post("idEstado");
		$idProceso = $this->input->post("idProceso");
		$nombreProceso = $this->input->post("nombreProceso");
		$descripcion = $this->input->post("descripcion");
		$proc_data = $this->input->post("proc_data");
		
		$data_array = explode("|",$proc_data);

		$this->db->trans_begin();
		
		$insert_statements = $this->getFPInsert($data_array, $idProceso);
		foreach ($insert_statements as $queryRoles) {
			$this->db->query($queryRoles);
		}
		
		$sql = "UPDATE PROCESO  
				SET idEstado = ".$idEstado.", nombreProceso = ".$this->db->escape($nombreProceso).", descripcion = ".$this->db->escape($descripcion)." 
				 WHERE idProceso = " .$idProceso; 
		
		echo "QUERY 3: "  .$sql;
		
		$query = $this->db->query($sql);
		
		if (!$query) {
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    }
		if($this->db->trans_status() == FALSE) {
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		
		return $retArray;		
	}
	
	function getFPInsert($data_array, $idProceso){
		$counter = 1;
		$nombreFase;
		$idFase;
		$fechaIniPlan;
		$fechaFinPlan;
		$fechaIniReal;
		$fechaFinReal;
		$index = 0;
		$indexTrippin = 0;
		$trippin;

		foreach ($data_array as $value) {
			$this->load->database();
			if($counter == 1){ //Estoy en nombreFase, preparo borrando las fases antiguas
				$nombreFase = $value;
			
				$this->db->trans_begin();
				
				$sql = "SELECT idFase FROM FASE WHERE nombreFase = '" .$nombreFase. "'";
				echo "QUERY 1: "  .$sql;
				$query = $this->db->query($sql);
				foreach ($query->result() as $row){
					$idFase = $row->idFase;
				}

				$sql = "DELETE FROM FASE_PROCESO WHERE idProceso = " .$idProceso ." AND idFase = " .$idFase;
				echo "QUERY 2: "  .$sql;
				$this->db->query($sql); 
				
				
				if($this->db->trans_status() == FALSE) {
					$this->db->trans_rollback();
				} else {
					$this->db->trans_commit();
				}
				$counter++;
				continue;
			}
			if($counter == 2){ //Estoy en fechaIniPlan
				$fechaIniPlan = $value;
				$counter++;
				continue;
			}
			if($counter == 3){ //Estoy en fechaFinPlan
				$fechaFinPlan = $value;
				$counter++;
				continue;
			}
			if($counter == 4){ //Estoy en fechaIniReal
				$fechaIniReal = $value;
				$counter++;
				continue;
			}
			if($counter == 5){ //Estoy en fechaFinReal
				$fechaFinReal = $value;
				$counter = 1;
				$trippin[$indexTrippin++] = "INSERT INTO FASE_PROCESO (idProceso,idFase,fechaIniPlan,fechaFinPlan,fechaIniReal,fechaFinReal) VALUES(" .$idProceso. "," .$idFase. ",'" .$fechaIniPlan."','" .$fechaFinPlan. "','" .$fechaIniReal. "','" .$fechaFinReal. "')";
				continue;
			}
		}

		return  $trippin;
	}
	

	function delete(){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "");
		
		$idEstado = $this->input->post("idEstado");
		
		$sql = "DELETE FROM ESTADO
				WHERE idEstado = ". $idEstado;
   				
		$query = $this->db->query($sql);
		
		if (!$query) {
			$retArray["status"] = $this->db->_error_number();
			$retArray["msg"] = $this->db->_error_message();
	    }
		
		return $retArray;	
	}
	
	
	function autocompleteRead($idProyecto){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());
		
		$sql = "SELECT p.nombreProceso, p.idProceso 
				FROM Proceso p INNER JOIN Proyecto pr ON p.idProyecto = pr.idProyecto
				WHERE p.idProyecto = " .$idProyecto;
		$query = $this->db->query($sql);		
	
		if($query){
			if($query->num_rows > 0){			
				foreach ($query->result() as $row){		
					$rowArray = array();
					$rowArray["id"] = $row->idProceso;
					$rowArray["value"] = $row->nombreProceso;
										
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
		
		$retArray = array("status"=> 0, "msg" => "");
		
		//Colocando las reglas para los campos, el segundo par�metro es el nombre del campo que aparecer� en el mensaje
		//Habr� que reemplazar los mensajes, pues por el momento est�n en ingl�s
		$this->form_validation->set_rules("nombreProceso", "Nombre", 'required|alpha');
		$this->form_validation->set_rules("descripcion", "Descripcion", 'alpha');

		if ($this->form_validation->run() == false){//Si al menos una de las reglas no se cumpli�...
			//Concatenamos en $msg los mensajes de errores generados para cada campo, lo tenga o no
			$retArray["status"] = 1;
			
			$retArray["msg"] .= form_error("nombreProceso");
			$retArray["msg"] .= form_error("descripcion");			
		}
		
		return $retArray;
	}
	
	function estadoAutocomplete($idTipo){
		$this->load->database();
		
		$retArray = array("status"=> 0, "msg" => "", "data"=>array());
		
		$sql = "select e.idEstado, e.estado
				from ESTADO e INNER JOIN TIPO_ESTADO tp ON e.idTipoEstado = tp.idTipoEstado
				WHERE e.idTipoEstado = " .$idTipo;
		
		$query = $this->db->query($sql);		
	
		if($query){
			if($query->num_rows > 0){			
				foreach ($query->result() as $row){		
					$rowArray = array();
					$rowArray["id"] = $row->idEstado;
					$rowArray["value"] = $row->estado;
										
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
	
	
}
