<?php 
class ProductImages extends Database{
	public function __construct(){
		$this->table('product_images');
		Database::Database();
	}

	public function addImages($data){
		$insert_id = $this->insert($data);
		return $insert_id;
	}

	public function getImagesByProduct($prod_id, $is_die=false){
		$this->where(' product_id = '.$prod_id);
		$data = $this->select($is_die);
		return $data;
	}

	public function deleteImageByParent($product_id, $is_die = false){
		$this->where(' product_id = '.$product_id);
		$del = $this->delete($is_die);
		return $del;
	}

	public function deleteImage($id, $is_die= false){
		$this->where(' id = '.$id);
		$del = $this->delete($is_die);
		return $del;
	}

	public function getImageById($id, $is_die = false){
		$this->where(' id = '.$id);
		$data = $this->select($is_die);
		return $data;
	}

	public function getImageByProductId($id, $is_die = false){
		$this->where(' product_id = '.$id);
		$data = $this->select($is_die);
		return $data;
	}
}