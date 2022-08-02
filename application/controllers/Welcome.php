<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
	parent::__construct();

	$this->load->model('Emp');
	}

	public function index()
	{
    $data['rows'] = $this->Emp->getAll();
		print_r($data);
    $this->load->view('home', $data);
	}
	
	public function save(){
        $data=[
            'name'=>$this->input->post('name'),
            'password'=>$this->input->post('password')
        ];

        $this->Emp->addrecord($data);
    }
	public function delete()
	{	
		$id=$this->input->post('id');
		$item = $this->Emp->deleteRecord($id);
			echo 'Deleted';
	}
	public function update()
	{	$id=$this->input->post('id');
		$username=$this->input->post('name');
		$password=$this->input->post('password');

		
        $this->Emp->updateRecord($username,$password,$id);
	
			echo 'Updated';
	}
}
