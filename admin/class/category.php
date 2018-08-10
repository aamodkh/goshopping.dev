<?php
class Category extends Database{
	public function Category(){
		$this->table('categories');
		Database::Database();
	}

	public function getParentCategory(){
		$this->where(' is_parent = 1 AND status = 1');
		$this->orderBy(' title ASC ');
		$data = $this->select();
		return $data;
	}

	public function addCategory($data, $is_die= false){
		$id = $this->insert($data, $is_die);
		return $id;
	}


	public function updateCategory($data,$cat_id, $is_die= false){
		$this->where('id = '.$cat_id);
		$id = $this->update($data, $is_die);
		return $id;
	}

	public function getAllCategory($is_die = false){
		$this->orderBy(' id DESC ');
		$data = $this->select($is_die);
		return $data;
	}

	public function getCategoryInfo($field='*', $id, $is_die=false){
		$this->fields($field);
		$this->where(' id = '.$id);
		$data = $this->select($is_die);
		return $data;
	}

	public function deleteCategory($id, $is_die = false){
		$this->where(' id = '.$id);
		$del = $this->delete($is_die);
		return $del;
	}

	public function shiftChild($parent_id, $is_die = false){
		/*UPDATE categories SET is_parent = 1, parent_cat_id =0 WHERE parent_cat_id = 5*/
		$data = array();
		$data['is_parent'] = 1;
		$data['parent_cat_id'] = 0;

		$this->where(' parent_cat_id = '.$parent_id);
		$update = $this->update($data);
		return $update;
	}

	public function getChildCat($parent_id, $status = null, $is_die=false){
		if($status){
			$this->where(' parent_cat_id = '.$parent_id." AND status = ".(int)$status);
		} else {
			$this->where(' parent_cat_id = '.$parent_id);
		}
		$data = $this->select($is_die);
		return $data;
	}

	public function getCatForMenu($is_die = false){
		$this->where(' is_parent = 1 AND show_in_menu = 1 AND status = 1');
		$this->orderBy(' title ASC');
		$data = $this->select($is_die = false);
		return $data;

	}
}
