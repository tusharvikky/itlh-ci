<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {



	public function store_form()
	{	
		// localhost:8080/user/register/css/bootstrap/bootstrap.min.css
		//linl... href="/css/bootstrap/bootstrap.min.css"
		// var_dump("in store_form");
		$this->load->model('User_model');
		$data['errors'] = $this->session->flashdata('errors');
		$data['users'] = $this->User_model->show_all();
		// var_dump($data);
		$this->load->view('user/store_form', $data);
	}

	public function store()
	{
		// Input Validation????????
		$errors = [];
		if($_POST['email'] == '') // if(empty($email))
		{
			$errors['email'] = "Email is required.";
		}else{
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$errors['email'] = "Please enter a valid email.";
			}else{
				$email = $this->test_inputs($_POST['email']);
			}			
		}
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// var_dump($this->form_validation->run());
		// die();
	 //    if ($this->form_validation->run() == FALSE)
	 //    {
	 //    	var_dump("in error");
	 //            $this->load->view('user/store_form');
	 //    }
		// Check if errors is empty, else show them an error
		if(!empty($errors))
		{
			// var_dump($errors);
			// die();
			$this->session->set_flashdata('errors',$errors);
			redirect('/user/register');
			// $this->store_form($errors);
		}
		
		$data = [
			'email' => $email,
			'pass' => 'some-random-pass'
		];
		// Store values in DB
		$this->load->model('User_model');
		$isCreated = $this->User_model->store_user($data);
		if($isCreated){
			redirect('/user/register');
		}
		// Show Welcome page (You have successfully registered)
		// var_dump($_POST);
	}

	public function delete($id)
	{
		if(!is_numeric($id))
		{
			$errors = ['id' => "ID should be an integer."];
			$this->session->set_flashdata('errors',$errors);
			redirect('/user/register');			
		}
		// Delete user form user table by calling model.
		$this->load->model('User_model');
		$isDeleted = $this->User_model->delete_user($id);

		if($isDeleted){
			redirect('/user/register');
		}	

	}

	public function update_form($id)
	{
		$this->load->model('User_model');
		$record = $this->User_model->show_one($id);
		var_dump($record);
	}

	public function test_inputs($value='')
	{
		return $value;
	}

}
