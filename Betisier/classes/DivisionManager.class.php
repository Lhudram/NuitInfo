<?php
	Class DivisionManager{
		public function __construct($db){
			$this->db = $db;
		}

			public function listerDiv(){
						$liste = array();

			$sql = "SELECT div_num, div_nom FROM division";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($div = $req->fetch(PDO::FETCH_OBJ)){

				$liste[] = new Division($div);

			}

			return $liste;
		}

    //Inutile ?
		public function listerDivNum($val){

			$sql = "SELECT div_num FROM division WHERE div_nom = '".$val."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			$div = $req->fetch();

			return $div;
		}
	}
