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
            // 'id'=>$this->input->post('id'),
            'imageFile'=>$this->input->post('imageFile')
        ];

        $this->Emp->uploadImage($data);
		echo "Saved";
    }


	public function do_upload()
	{       
			// $data = array('upload_data' => $this->upload->data());
			
			$config['upload_path']          = './upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			// $config['max_size']             = 100;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);
			$imgFile = $this ->input->post('imageFile');
			if ( ! $this->upload->do_upload('imageFile'))
			{     
					echo $imgFile;
					$error = array('error' => $this->upload->display_errors());
					echo "not uploded";
			}
			else
			{
					$data = array('upload_data' => $this->upload->data());
					$jsonData = json_encode($data);
					$fileName = $data['upload_data']['file_name'];


					$mainData['mainData'] = array("id"=>null,"name"=>$data['upload_data']['file_name'],"location"=> $data['upload_data']['file_path']);
					// print_r($mainData);
					$this->Emp->addImgNameLoc($mainData['mainData']);

					// echo "Saved Img" ;
					$string_version = explode(',', $mainData['mainData']);
					// echo( json_encode($mainData));
					echo ($string_version);
			}
	}

}
