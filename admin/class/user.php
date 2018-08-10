<?php 
class User extends Database{

	public function User(){
		$this->table('users');
		Database::Database();
	}

	public function getUserByUsername($user_name)
	{
		/*SELECT * FROM users WHERE username = '$user_name'*/
		$this->where(' username = "'.$user_name.'" AND status = 1 ');
		$data = $this->select();

		if($data){
			return $data;
		} else {
			return false;
		}
	}

	public function getUserByRoleId($role_id){
		$this->where('role_id = '.$role_id.' AND status = 1');
		$data = $this->select();
		return $data;
	}

	public function addUser($data){
		$insert_id = $this->insert($data);
		return $insert_id;
	}

	public function getAllUser($is_die = false){
		$this->orderBy(' id ASC ');
		$data = $this->select($is_die);
		return $data;
	}

	public function getUserById($id,$is_die = false){
		$this->where(' id = '.$id);
		$this->orderBy(' id ASC ');
		$data = $this->select($is_die);
		return $data;
	}

	public function updateLogin($id ,$data, $is_die = false)
	{
		$this->where(' username = '.$id);
		$id = $this->update($data);
		return $id;
	}
}