<?php
class shop extends CI_Model {

	/*This function is for searching if user account is exist*/
	public function check_customer_account($data){
		$query = "SELECT id, user_level FROM customers WHERE email =? AND password =?";
		$value = array($data['email'], md5($data['password']));
		$result = $this->db->query($query, $value)->row_array();
		if($result){
			$this->session->set_userdata('user_id', intval($result['id']));
			$this->session->set_userdata('user_login', $result['user_level']);
			return $result['user_level'];
		}
		else{
			
		}
	}
	/*This function is responsible for saving user account*/
	public function save_customer_account($data){
		$query = "INSERT INTO customers (first_name, last_name, email, password, user_level, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
		$value = array($data['first_name'], $data['last_name'], $data['email'], md5($data['password']),'customer', date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		return $this->db->query($query,$value);
	}

	/* This function is responsible for deleting item on cart */
	public function delete_item_on_cart($cart_id){
		return $this->db->query("DELETE FROM carts WHERE id = $cart_id");
	}
	/*This function will ge the image path of the file*/
	public function image_path($id){
		$path = $this->db->query("SELECT image1, image2, image3, image4, image5 FROM products WHERE id = $id")->row_array();
		return $path;
	} 

	/*This Function will delete the product */
	public function delete_product($id){
		$path = $this->shop->image_path($id);
		foreach ($path as $value) {
			unlink($value);
		}
		$this->db->query("DELETE FROM products WHERE id = $id");
		return $this->db->query("DELETE FROM categories WHERE product_id = $id");

	}
	/*This function will get all shipping info by order */
	public function get_shipping_info_by_order_id($order_id){
		return $this->db->query("SELECT * FROM shipping_info WHERE order_id = $order_id")->result_array();
	}
	/*This function will get all the billing info by order*/


	public function get_billing_info_by_order_id($order_id){
		return $this->db->query("SELECT * FROM billing_info WHERE order_id = $order_id")->result_array();
	}
	public function search_order($keyword){
		return $this->db->query("SELECT orders.id, CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name, orders.created_at AS order_date, billing_info.address, SUM(carts.order_price*carts.order_quantity) AS total, orders.status FROM orders INNER JOIN customers ON customers.id = orders.user_id INNER JOIN billing_info ON billing_info.order_id = orders.id INNER JOIN carts ON carts.order_id = orders.id WHERE customers.first_name LIKE '%$keyword%' OR customers.last_name LIKE '%$keyword%' OR orders.id LIKE '%$keyword%' GROUP BY orders.id")->result_array();
	}

	/*This function is for retrieving the summary orders*/
	public function get_summary_orders($order_id){
		return $this->db->query("SELECT carts.id AS cart_id, carts.order_name, carts.order_price, carts.order_quantity, (carts.order_price * carts.order_quantity) AS total, orders.status, orders.id AS order_id FROM orders INNER JOIN carts ON carts.order_id = orders.id INNER JOIN billing_info ON billing_info.order_id = orders.id INNER JOIN shipping_info ON shipping_info.order_id = orders.id WHERE orders.id =$order_id GROUP BY carts.id")->result_array();
	}

	/*This function is for retrieving all paid orders */
	public function get_all_orders(){
		return $this->db->query("SELECT orders.id, CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name, orders.created_at AS order_date, billing_info.address, SUM(carts.order_price*carts.order_quantity) AS total, orders.status FROM orders INNER JOIN customers ON customers.id = orders.user_id INNER JOIN billing_info ON billing_info.order_id = orders.id INNER JOIN carts ON carts.order_id = orders.id GROUP BY orders.id")->result_array();
	}

	/*This function will update the order status to paid once the payment is confirmed */
	public function update_orders($order_id){
		$this->db->query("UPDATE orders SET status='paid', updated_at = NOW() WHERE id = $order_id");
	}


	/*This function will update the product quantity from the products table when the bill is processed */
	public function update_product_qty($order_id){
		$this->db->query("UPDATE products INNER JOIN carts ON products.id = carts.product_id INNER JOIN orders ON orders.id = carts.order_id SET products.quantity = (products.quantity-carts.order_quantity) WHERE orders.status = 'paid' AND orders.id =  $order_id");
	}

	/*This function will delete the products with zero quantity*/
	public function delete_product_with_zero_qty(){
		$product_id = $this->db->query("SELECT id FROM products WHERE quantity <=0")->row_array();
		$this->delete_product($product_id['id']);

	}

	/*This function will save the billing details of the user*/
	public function save_billing_details($input_data){
		$query ="INSERT INTO billing_info (shipping_id,order_id, customer_id, first_name, last_name, address, address2, city, state, zipcode, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$value = array($input_data['shipping_id'], $input_data['order_id'], $input_data['user_id'], $input_data['first_name'], $input_data['last_name'], $input_data['address'], $input_data['address2'],$input_data['city'], $input_data['state'], $input_data['zip_code'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
		$this->db->query($query, $value);
		$this->update_orders($input_data['order_id']);
		$this->update_product_qty($input_data['order_id']);
		$this->delete_product_with_zero_qty();
		
	}

	/*This function will save the shipping detials on the shipping_info table */
	public function save_shipping_details($input_data){
		$query ="INSERT INTO shipping_info (order_id, customer_id, first_name, last_name, address, address2, city, state, zipcode, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$value = array($input_data['order_id'], $input_data['user_id'], $input_data['first_name'], $input_data['last_name'], $input_data['address'], $input_data['address2'],$input_data['city'], $input_data['state'], $input_data['zip_code'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
		$this->db->query($query, $value);
		return $this->db->insert_id(); 
	}

	/*This function will check if the user has existing unpaid orders */
	public function check_order($user_id){
		return $this->db->query("SELECT id FROM orders WHERE user_id = $user_id AND status = 'unpaid'")->row_array();
	}
	/* This function is responsible for adding orders */
	public function add_orders($user_id){
		if($this->check_order($user_id)){
			return $this->check_order($user_id);
		}
		else{
			$query ="INSERT INTO orders(user_id, status, created_at, updated_at) VALUES (?,?,?,?)";
			$value = array($user_id,'unpaid',date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
			$this->db->query($query, $value);
			return $this->check_order($user_id);
		}
	}

	/* This Function is responsible for computing the total amount of the item in the user cart */
	public function compute_total($data)
	{	$total =0;
		foreach($data as $value){
			 $total+=$value['sub_total'];
		}
		return $total;
	}

	/*This function is for retrieving order details by user */
	public function get_cart_details_by_id($user_id){
		return $this->db->query("SELECT carts.*,(carts.order_price*carts.order_quantity) AS sub_total, orders.status FROM carts INNER JOIN orders ON carts.order_id = orders.id WHERE carts.user_id = $user_id AND orders.status='unpaid'")->result_array();
	}

	/* This function is for counting the number carts by user */
	public function count_order_by_user_id($user_id){
		return $this->db->query("SELECT COUNT(carts.id) AS order_number FROM carts INNER JOIN orders ON carts.order_id = orders.id WHERE carts.user_id = $user_id AND orders.status='unpaid'")->row_array();
	}
	/* This fucnction is resonsible for saving on cart */
	public function save_on_cart($user_id, $product_id, $order_qty){
		$product_data = $this->get_product_by_id($product_id);	
		$order_id = $this->add_orders($user_id);
		var_dump($product_data[0]['name']);
		$query = "INSERT INTO carts (user_id, product_id, order_name, order_price, order_quantity, order_id, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
		$value = array($user_id, $product_id, $product_data[0]['name'],$product_data[0]['price'],$order_qty,$order_id,date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
		$this->db->query($query, $value);
	}

	/* This function is for the search the category by product ID */
	public function search_the_category_product($product_id){
		return $this->db->query("SELECT category FROM categories WHERE product_id = $product_id")->result_array();
	}

	/*This function will get the product by category*/
	public function get_product_by_category($category){
		$query = "SELECT products.* FROM products INNER JOIN categories ON categories.product_id = products.id WHERE categories.category = ? LIMIT 0, 6";
		$value = $category;
		return $this->db->query($query, $value)->result_array();
	}

	/* This function is for getting the product details based on the product id*/
	public function get_product_by_id($product_id){
		$query = "SELECT products.*, categories.category FROM products INNER JOIN categories ON categories.product_id = products.id WHERE products.id = ?";
		$value = $product_id;
		return $this->db->query($query, $value)->result_array();
	}


	/* This function is retrieving data from the database base from user sort selected and on product category on the show area*/
	public function product_sort($product_category, $sort_selection, $start){
		if($product_category == 'all'){
			return $this->db->query("SELECT * FROM products ORDER BY $sort_selection ASC LIMIT $start, 12")->result_array();
		}
		else{
			return $this->db->query("SELECT products.id,products.name,products.image1,products.price, categories.category from products INNER JOIN categories ON categories.product_id = products.id WHERE categories.category ='$product_category' ORDER BY products.$sort_selection ASC LIMIT $start, 12 ")->result_array();
		}
	}

	/* This function is for retrieving all products data*/
	public function get_all(){
		return $this->db->query("SELECT * FROM products")->result_array();
	}

	/*This function will count the number of rows in product table*/
	public function count_products(){
		$data = $this->db->query("SELECT * FROM products")->result_array();
		return count($data);
	}

	/*This function will search all catgeory and count the number of products by category*/

	public function search_product_by_category($category,$start){
		return $this->db->query("SELECT products.id,products.name,products.image1,products.price, categories.category from products INNER JOIN categories ON categories.product_id = products.id WHERE categories.category ='$category' LIMIT $start, 12 ")->result_array();

	}
	/*This fucntion will get the number of products on the specific catgeory */
	public function count_product_category($category){
		return $this->db->query("SELECT COUNT(product_id) AS product_count FROM categories WHERE category = '$category'")->result_array();
	}

	/* This fucntion will get all the category info from database and will send on AJAX response */
	public function get_category(){
		return $this->db->query("SELECT COUNT(product_id) AS product_count, category FROM categories GROUP BY category")->result_array();
	}

	/* This function is for retrieving all products data with LIMIT for pagination */
	public function get_all_product_limit($start, $limit){
		return $this->db->query("SELECT * FROM products LIMIT $start, $limit")->result_array();
	}

	/* This function will get the id of the item */
	public function get_product_id($product_name){
		$query = "SELECT id FROM products WHERE name=?";
		$value = $product_name;
		return $this->db->query($query, $value)->row_array();
	}

	/* This function is for saving product into the database */
	public function save_product($data){
		$query ="INSERT INTO products (name, price, description,quantity, image1, image2, image3, image4, image5, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$values =array($data['text']['product_name'], $data['text']['product_price'], $data['text']['product_description'],$data['text']['product_qty'], $data['images'][0], $data['images'][1], $data['images'][2], $data['images'][3], $data['images'][4],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
		$this->db->query($query, $values);

		/*saving the category into categories table*/
		$product_id = $this->shop->get_product_id($data['text']['product_name']);
		$query = "INSERT INTO categories(product_id, category, created_at, updated_at) VALUES (?,?,?,?)";
		$values = array(intval($product_id['id']), $data['text']['product_category'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s")); 
		return $this->db->query($query, $values);
	}

	/* This function is responsibe for searching products from the database*/
	public function search_product($input_data, $start, $limit){
		return $this->db->query("SELECT * from products WHERE name LIKE '%$input_data%' OR id LIKE '%$input_data%' LIMIT $start, $limit ")->result_array();
	}
	   
    


}
?>

