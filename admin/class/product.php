<?php 

class Product extends Database{
	public function Product(){
		$this->table('products');
		Database::Database();
	}

	public function addProduct($data, $is_die = false){
		$product_id = $this->insert($data, $is_die);
		return $product_id;
	}

	public function updateProduct($data,$id, $is_die = false){
		$this->where(' id = '.$id);
		$product_id = $this->update($data, $is_die);
		return $product_id;
	}

	public function getAllProduct($is_die=false){
		$this->fields('products.id, products.product_title, products.category_id, products.price, products.discount, products.status, categories.title AS category, product_images.image_name');
		$this->join('LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN product_images ON product_images.product_id = products.id ');
		$this->groupBy('products.id');
		$this->orderBy(' products.id');

		$data = $this->select($is_die);
		return $data;
	}

	public function getProductByCategory($cat_id, $child_cat = null, $is_die = false){
		$where = " products.status= 1 AND products.category_id = ".$cat_id;

		if($child_cat){
			$where .= " AND products.child_cat_id = ".$child_cat;
		}
		$this->fields('products.id, products.product_title, products.category_id, products.price, products.discount, products.is_negotiable, products.negotiation_border, products.status, categories.title AS category, product_images.image_name');
		$this->where($where);
		$this->join('LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN product_images ON product_images.product_id = products.id ');
		$this->groupBy('products.id');
		$this->orderBy(' products.id');

		$data = $this->select($is_die);
		return $data;	
	}

	public function getTopProducts($is_die = false)
	{
		$where = " products.status= 1 ";
		$fifteen_days_ago = date('Y-m-d', strtotime(date('Y-m-d').' -15 days'));

		$where .= " AND DATE(products.added_date) >= DATE('".$fifteen_days_ago."') AND products.discount > 0";


		$this->fields('products.id, products.product_title, products.category_id, products.is_negotiable , products.negotiation_border, products.price, products.discount, products.status, categories.title AS category, product_images.image_name');
		$this->where($where);
		$this->join('LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN product_images ON product_images.product_id = products.id ');
		$this->groupBy('products.id');
		$this->orderBy(' products.discount DESC');

		$data = $this->select($is_die);
		return $data;	
	}

	public function getBrandedProducts($is_die = false)
	{
		$where = " products.status= 1 AND products.is_branded = 1 AND  ";
		$fifteen_days_ago = date('Y-m-d', strtotime(date('Y-m-d').' -15 days'));

		$where .= " DATE(products.added_date) >= DATE('".$fifteen_days_ago."') ";


		$this->fields('products.id, products.product_title, products.category_id, products.price, products.is_branded, products.discount, products.is_negotiable, products.negotiation_border, products.status, categories.title AS category, product_images.image_name');
		$this->where($where);
		$this->join('LEFT JOIN categories ON categories.id = products.category_id LEFT JOIN product_images ON product_images.product_id = products.id ');
		$this->groupBy('products.id');
		$this->orderBy(' products.discount DESC');

		$data = $this->select($is_die);
		return $data;	
	}

	public function getProductById($id, $is_die=false){
		$this->where(' id = '.$id);
		$data = $this->select($is_die);
		return $data;
	}
	

	public function deleteProduct($id, $is_die = false){
		$this->where(' id = '.$id);
		$del = $this->delete($is_die);
		return $del;
	}
}