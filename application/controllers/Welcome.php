<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->helper(array('form', 'url'));
	$this->load->model('Emp');
	}

	public function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
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
		echo "Saved";
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
	
	//img check 
	public function imgUploaded(){

        $data=[
            'id'=>$this->input->post('id'),
            'imageFile'=>$this->input->post('imageFile')
        ];

        $this->Emp->uploadImage($data);
		echo "Saved";
    }


	public function do_upload()
	{
			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			// $config['max_size']             = 100;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
					$error = array('error' => $this->upload->display_errors());

					$this->load->view('upload_form', $error);
					echo "No Saved Img";
			}	
			else	
			{
					$data = array('upload_data' => $this->upload->data());
					print_r($data['file_name']);
					$this->Emp->uploadImage($data['file_name']);
					
					echo "Saved".$data['file_name'];
			}
		
	}
}
