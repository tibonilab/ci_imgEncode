<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	private $_authorized_domains = [];
	
	public function __construct() {
		parent::__construct();
		
		$this->_authorized_domains[] = $this->input->server('SERVER_NAME');
		
		$this->_auth();
	}

	private function _auth() 
	{
		if( ! ($this->input->is_ajax_request() && $this->_check_FQDN()))
		{
			http_response_code(401);
			exit('Unauthorized');
		}
	}
	
	private function _check_FQDN()
	{
		return in_array($this->input->server('SERVER_NAME'), $this->_authorized_domains);
	}
	
	public function img() 
	{	
		$path = base64_decode($this->input->post('rel'));
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		echo 'data:image/' . $type . ';base64,' . base64_encode($data);
	}
}
