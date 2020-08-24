<?php
	date_default_timezone_set('Asia/Phnom_Penh');

	include('db.php');
	class Action extends Database{
		public function insert_data($tbl,$val){
			return $this->save_data($tbl,$val);
		}
		public function del_data($tbl,$con){
			return $this->delData($tbl,$con);

		}
		public function upd_data($tbl,$fld,$con){
			return $this->edit_data($tbl,$fld,$con);
		}
		public function dpl_data($fld,$tbl,$con){
			return $this->dplData($fld,$tbl,$con);
		}
		public function select_data($fld,$tbl,$con,$od,$limit){
			return $this->selectData($fld,$tbl,$con,$od,$limit);
		}	
		public function get_auto_id($fld,$tbl,$con,$od){
			return $this->getAutoId($fld,$tbl,$con,$od);
		}
		public function get_cur_data($fld,$tbl,$con){
			return $this->select_cur_data($fld,$tbl,$con);
		}
		public function count_data($tbl,$con){
			return $this->countData($tbl,$con);
		}
	}
?>