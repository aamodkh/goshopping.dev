<?php 

abstract class Database{
	private $conn;
	private $table;

	private $sql;
	private $fields;
	private $where;
	private $join;
	private $groupBy;
	private $orderBy;
	private $limit;

	private $stmt;
	private $result;

	protected function Database(){
		try{
			$this->conn =  new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PASS);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			error_log($e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function table($table_name){
		try{
			$this->table = $table_name;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function fields($field = ' * '){
		try{
			$this->fields = $field;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}


	protected function where($where = 1){
		try{
			$this->where = $where;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function join($join){
		try{
			$this->join = $join;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function groupBy($groupby){
		try{
			$this->groupBy = $groupby;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function orderBy($condition = ' id DESC '){
		try{
			$this->orderBy = $condition;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}

	protected function limit($start, $count){
		try{
			$this->limit = $start.",".$count;
		} catch (Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}


	protected function select($is_die= false){
		try{
			/*
				select * from users where username = 'admin' and status = 1

				SELECT fields FROM table LEFT JOIN table_1 ON table_1.column_n =  table.column_m WHERE condition_n GROUP BY condition_n ORDER BY conditions_n LIMIT start, count
			*/
				$this->sql = "SELECT ";

				if(!isset($this->fields)){
					$this->fields();
				}

				$this->sql .= $this->fields;

				$this->sql .= " FROM ".$this->table;

				/*Join statement here*/
				if($this->join){
					$this->sql .= " ".$this->join;
				}

				if($this->where){
					$this->sql .= " WHERE ".$this->where;
				}

				/*GROUP BY here*/
				if($this->groupBy){
					$this->sql .= " GROUP BY ".$this->groupBy;
				}
				
				/*Order By here*/
				if($this->orderBy){
					$this->sql .= " ORDER BY ".$this->orderBy;
				}
				/*Limit*/
				if($this->limit){
					$this->sql .= " LIMIT ".$this->limit;
				}
				if($is_die){
					echo $this->sql;
					exit;
				}

				$this->stmt = $this->conn->prepare($this->sql);
				$this->stmt->execute();
				$data = array();

				while($row = $this->stmt->fetchObject()){
					$data[] = $row;
				}

				return $data;
			} catch(PDOException $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			} catch(Exception $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			}
	}

	protected function insert($data, $is_die = false){
		/*INSERT INTO banners SET column_name = value, column_name = value*/
		try{
			$this->sql = "INSERT INTO ";

			$this->sql .= $this->table;
			$this->sql .= " SET ";

			$_temp_arr = array();
			foreach($data as $column_name => $value){
				$str = $column_name." = ";
				if(is_string($value)){
					$str .= " '".$value."'";
				} else if(is_null($value)){
					$str .= 'null';
				} else {
					$str .= $value;
				}
				$_temp_arr[] = $str;
				$str = "";
			}

			$this->sql .= implode(", ", $_temp_arr);
			if($is_die){
				echo $this->sql;
				exit;
			}

			$stmt = $this->conn->prepare($this->sql);
			$this->result = $stmt->execute();
			if($this->result){
				return $this->conn->LastInsertId();
			} else {
				throw  Exception('Error while inserting data in database');
				return false;
			}
		} catch(PDOException $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			} catch(Exception $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			}


	}

	protected function delete($is_die=false){
		try{
			$this->sql = "DELETE FROM ";
			$this->sql .= $this->table;

			if(isset($this->where)){
				$this->sql .= " WHERE ".$this->where;
			}

			if($is_die){
				echo $this->sql;
				exit;
			}

			$stmt = $this->conn->prepare($this->sql);
			$this->result = $stmt->execute();
			if($this->result){
				return true;
			} else {
				throw  Exception('Error in deleting data.');
				return false;
			}
		} catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		} catch(Exception $e){
			error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
			return false;
		}
	}


	protected function update($data, $is_die = false){
		try{
			$this->sql = "UPDATE ";

			$this->sql .= $this->table;
			$this->sql .= " SET ";

			$_temp_arr = array();
			foreach($data as $column_name => $value){
				$str = $column_name." = ";
				if(is_string($value)){
					$str .= " '".$value."'";
				} else if(is_null($value)){
					$str .= 'null';
				} else {
					$str .= $value;
				}
				$_temp_arr[] = $str;
				$str = "";
			}

			$this->sql .= implode(", ", $_temp_arr);
			
			if(isset($this->where) && $this->where != ""){
				$this->sql .= " WHERE ".$this->where;
			}

			if($is_die){
				echo $this->sql;
				exit;
			}



			$stmt = $this->conn->prepare($this->sql);
			$this->result = $stmt->execute();
			if($this->result){
				return true;
			} else {
				throw  Exception('Error while inserting data in database');
				return false;
			}
		} catch(PDOException $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			} catch(Exception $e){
				error_log(date('Y-m-d h:i:s A').":".$e->getMessage(), 3, 'error.log');
				return false;
			}


	}

}