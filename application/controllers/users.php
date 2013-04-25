<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

	public function index($id=null)
	{
		$this->load->model('User_model' , 'user');

		if ($id == null) {
			$data['users'] = $this->user->all() ;
		}else{
			$data['users'] = $this->user->get_user($id) ;
		}

		$data['id'] = $id ;
		$this->data["content"] =   $this->load->view("users/index" , $data  ,true  );

		$this->load->view("layout/index" , $this->data );
	}
	
	public function add($id=null)
	{
	$this->data["content"] =   $this->load->view("users/add" , null ,true  );
	$this->load->view("layout/index" , $this->data );
	}
	
	public function create($id=null)
	{
	
	$data = $this->input->post();
	$this->load->model('User_model' , 'user');
	$res = $this->user->create($data);
	if ($res) {
	redirect("users/index");
	}
	}
	public function delete($id=null)
	{
	$this->data["content"] =   $this->load->view("users/delete" , null ,true  );
	$this->load->view("layout/index" , $this->data );
	}
	
	
	
}
?>