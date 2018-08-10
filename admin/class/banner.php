<?php 
class Banner extends Database{

	public function Banner(){
		$this->table('banners');
		Database::Database();
	}

	public function addBanner($data){
		$banner_id = $this->insert($data);
		return $banner_id;
	}

	public function getAllBanner($status = null, $is_die = false){
		
		if($status){
			$this->where(' status = '.(int)$status);
			$this->limit(0,3);
		}
		$this->orderBy();
		$data = $this->select($is_die);
		return $data;
	}

	public function getBannerById($id, $is_die=false){
		$this->where('id = '.$id);
		$data = $this->select($is_die);
		return $data;
	}

	public function deleteBanner($banner_id, $is_die=false){
		$this->where(' id = '.$banner_id);
		$del = $this->delete($is_die);
		return $del;
	}


	public function updateBanner($data, $id, $is_die = false){
		$this->where(' id = '.$id);
		$update = $this->update($data, $is_die);
		return $update;
	}
}