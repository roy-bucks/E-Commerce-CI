<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shops extends CI_Controller {

	public function index(){
		$this->load->view('signin');		
	}
	public function view_orders(){
		$user = $this->session->userdata('user_login');
		if($user=='admin'){
			$this->load->view('admin_orders');		}
		else{
			redirect('/');
		}
	}

	public function check_out_page(){
		$this->load->view('check_out');
	}

	public function admin_view_products(){
		$user = $this->session->userdata('user_login');
		if($user=='admin'){
			$this->load->view('admin_products');
		}
		else{
			redirect('/');
		}
	}
	public function user_landing_page(){
		$this->load->view('store_home');
	}

	public function signin_process(){
		$data = $this->input->post();
		$this->load->model('shop');
		$result = $this->shop->check_customer_account($data);
		if($result){
			if($result == 'customer'){
				redirect('store_home');
			}
			else{
				redirect('orders');
			}
		}
		else{
			redirect('/');
		}
	}

	public function register(){
		$this->load->view('register');
	}
	public function save_account(){
		$data = $this->input->post();
		$this->load->model('shop');
		$this->shop->save_customer_account($data);
		redirect('/');
	}

	public function upload_section(){
		$this->load->view('upload_products');
	}
	public function summary($order_id){
		$recieve['order_id'] = $order_id;
		$this->load->view('admin_order_summary',$recieve);

	}
	/*This function is for searching orders on the admin area*/
	public function search_order($key_word){
		$this->load->model('shop');
		$result['data'] = $this->shop->search_order($key_word);
		$this->load->view('partials/orders_partial_data.php', $result);
	}
	/*This function is for dleeting product by id*/
	public function delete_product($id){
		$this->load->model('shop');
		$this->shop->delete_product($id);
	}
	/*This function iss responsible for dleteing item on cart */
	public function delete_order($cart_id){
		$this->load->model('shop');
		$this->shop->delete_item_on_cart($cart_id);	
	}

	/*This function is responsible for destroying the session */
	public function destroy(){
		session_destroy();
		redirect('/');
	}

	public function view_summary_order($order_id){
		$this->load->model('shop');
		$result['order'] = $this->shop->get_summary_orders($order_id);
		$result['shipping'] = $this->shop->get_shipping_info_by_order_id($order_id);
		$result['billing'] = $this->shop->get_billing_info_by_order_id($order_id);
		$this->load->view('partials/summary_order_partial.php', $result);
	}
	
	/*This function is responsible for sending data on partial view with all orders data*/
	public function order_summary($order_id){
		$this->load->model('shop');
		$result['data'] = $this->shop->get_all_orders();
		$this->load->view('partials/orders_partial_data.php', $result);
	} 
	/*This function is reponsible for sending data on partial view*/
	public function orders(){
		$this->load->model('shop');
		$result['data'] = $this->shop->get_all_orders();
		$this->load->view('partials/orders_partial_data.php', $result);
	}
	/*This function is for submitting billing details */
	public function submit_billing_details(){
		$this->load->model('shop');
		$data['input'] = $this->input->post();
		var_dump($data['input']);
		$this->shop->save_billing_details($data['input']);	
	}

	/*This function will save the shipping detials and it return the shipping id in json format*/
	public function submit_shipping_details(){
		$this->load->model('shop');
		$data['input'] = $this->input->post();
		$shipping_id = $this->shop->save_shipping_details($data['input']);
		echo json_encode($shipping_id);
	}

	/* This function is json data return shipping detials*/
	public function shipping_details_json()
	{
		$catch['data'] = $this->input->post();
		 echo json_encode($catch);
	}

	/*This function is for getting product details on the cart*/
	public function cart_details(){
		$user_id = $this->session->userdata('user_id');
		$this->load->model('shop');
		$result['data'] = $this->shop->get_cart_details_by_id($user_id); 
		$result['total'] =$this->shop->compute_total($result['data']);
		$result['user_id'] = $user_id;
		$this->load->view('partials/order_data.php', $result);
	}
	
	/* This function is for countring the number of item in the cart */
	public function number_of_product_in_cart(){
		$user_id = $this->session->userdata('user_id');
		$this->load->model('shop');
		$data = $this->shop->count_order_by_user_id($user_id);
		$number_order = intval($data['order_number']);
		echo "$number_order";
	}


	public function cart_save($product_id, $order_qty){
		$user_id = $this->session->userdata('user_id');
		$this->load->model('shop');
		$data = $this->shop->save_on_cart($user_id, $product_id, $order_qty);
	}

	/*This function is used as path from store_home to display_product and also to catch 
	the product id */
	public function product_display_path($product_id){
		$data['product_id'] = $product_id;
		$this->load->view('display_product', $data);
	}

	/*This fucntion is for viewing the selected item of teh user */
	public function product_display($product_id){
		$this->load->model('shop');
		$result['data'] = $this->shop->get_product_by_id($product_id);
		$category =$this->shop->search_the_category_product($product_id);
		$result['related_data'] = $this->shop->get_product_by_category($category);
		$this->load->view('partials/product_data_partial.php', $result);
	}


	/* This function is responsibe for displayoing data base the user prefer category
		all the data passed on this function are came from JQUERY data listening */
	public function product_sort($product_category, $sort_selection, $start){
		$this->load->model('shop');
		$result['data'] = $this->shop->product_sort($product_category, $sort_selection, $start);
		if($product_category == 'all'){
			$result['count'] = $this->shop->count_products();
		}
		else{
			$count_result = $this->shop->count_product_category($product_category);
			$result['count'] = intval($count_result[0]['product_count']);
		}
		$this->load->view('partials/home_product_display.php', $result);
	}

	/* This function is responsible for displaying data by category on user level*/
	public function display($category,$start){
		if($category == 'display_all'){
			redirect('shops/display_user_product_data/0');
		}
		else{
			$this->load->model('shop');
			$result['data'] = $this->shop->search_product_by_category($category,$start, 12);
			$count_result = $this->shop->count_product_category($category);
			$result['count'] = intval($count_result[0]['product_count']);
			$this->load->view('partials/home_product_display.php', $result);
		}
		
	}

	/* This function s responsible for searching product in user level */
	public function search_user_products($start){
		$data = $this->input->post();
		$this->load->model('shop');
		$result['data'] = $this->shop->search_product($data['search'], $start, 12);
		$this->load->view('partials/home_product_display.php', $result);
	}

	/* This fucntion is for creating AJAX response displaying all products data on the user page */
	public function display_user_product_data($start){
		$limit = 12;
		$this->load->model('shop');
		$products['data'] = $this->shop->get_all_product_limit($start,$limit);
		$products['count'] = $this->shop->count_products();
		$this->load->view('partials/home_product_display.php', $products);
	}

	/* This function is responsible for returning AJAX result for home navigation */
	public function home_navigation(){
		$this->load->model('shop');
		$category['data'] = $this->shop->get_category();
		$this->load->view('partials/home_navigation_display',$category);
	}

	/* This function is responsible for searching data from product database and return AJAX response 
	*/
	public function search_admin_products(){
		$data = $this->input->post();
		$this->load->model('shop');
		$result['data'] = $this->shop->search_product($data['search'], 0, 5);
		$this->load->view('partials/admin_product_display_partial', $result);
	}

	/* This fucntion is for creating AJAX response displaying all products data on the admin page */
	public function display_admin_product_data($start){
		$limit = 5;
		$this->load->model('shop');
		$products['count'] = $this->shop->count_products();
		$products['data'] = $this->shop->get_all_product_limit($start, $limit);
		$this->load->view('partials/admin_product_display_partial', $products);
	}


	/* This function is reponsible for uploading products deatils on teh database and the image on the asets upload.
	Note: Having only a simple validation on the image */
	public function upload_product()
	{       
		$data = array();
		$data['text'] = $this->input->post();
		var_dump($data);
	    $this->load->library('upload');

	    $files = $_FILES;
	    $cpt = count($_FILES['userfile']['name']);
	    for($i=0; $i<$cpt; $i++)
	    {           
	        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
	        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

	        $this->upload->initialize($this->set_upload_options());
	        $this->upload->do_upload();
	        $data['images'][]="/assets/uploads/".$this->upload->data('file_name');
		}
		$this->load->model('shop');
		$this->shop->save_product($data);
		redirect('upload_section');
		
	}

	/* This function is responsible for config of the photos upload */
	private function set_upload_options()
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}

}
