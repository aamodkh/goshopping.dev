<?php 
class Orders extends Database{
	public function __construct(){
		Database::Database();
		$this->table('orders');
	}

	public function addCart($data){
		$insert_id = $this->insert($data);
		return $insert_id;
	}
	 public function getAllOrders($is_die = false)
	 {
	 	$this->where( 'status < 3 ' );
	 	$this->orderBy(' buying_time DESC ');
	 	$this -> groupby( ' id ' );
		$data = $this->select();
		return $data;
	 }

	 public function updateStatus($id,$status, $is_die= false)
	 {
		//$this->field(' status ');
		$this->where(' id = '.$id);
		
		$id = $this->update($status,$is_die);
		return $id;
	}
}