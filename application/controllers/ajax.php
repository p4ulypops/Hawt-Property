<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller {
		public function __CONSTRUCT() {
			parent::__construct();
			$this->load->model('myobject');
			$this->load->model('voter');	
		}
		
		public function index() {
			$data = array();
			$data['error'] = 'no';
			$data['post_input'] = $this->input->post();
			
			$this->session->set_userdata('searchterms', $data['post_input']);		
			
			echo json_encode($data);
		}
	
}

?>