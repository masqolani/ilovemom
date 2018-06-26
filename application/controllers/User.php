<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('user_model');
  }

	public function index() {
		$get_user = $this->user_model->get_user();

		$data['title'] = 'User List';
		$data['user_data'] = $get_user;

    $this->load->view('user/user_view', $data);
	}

	public function create_user() {
		$post = $this->input->post();

		if($post)
		{
			$user = $this->session->userdata['logged_in'];

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
					// $check_duplicated = $this->check_user();
					// print_r($check_duplicated);die;
					// if($check_duplicated == 'false') {
					// 	$this->session->set_flashdata('error', 'User already exist.');
					// 	redirect('user/create_user');
					// } else {
					// 	print_r('masuk else');die;
					// }

          $this->user_model->add_user($post);
          $this->session->set_flashdata('success', 'User has been created successfully');
          redirect('user');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('user/create_user');
      }
		}
		else
		{
 			$data['form_title'] = 'Add New User';
			$data['form_action'] = base_url('user/create_user');
			$data['user_status'] = $this->user_model->get_user_status();

			$this->load->view('user/user_form_view', $data);
		}
	}

	public function update_user($user_id='')
	{
		$post = $this->input->post();

		if($post) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
					// print_r($this->check_user());die;
					// if($this->check_user() == 'false') {
					// 	$this->session->set_flashdata('error', 'User already exist.');
	        //   redirect('user/update_user');
					// }

      		$this->user_model->update_user($post);
          $this->session->set_flashdata('success', 'User ID '.$post['user_id'].' has been updated successfully');
          redirect('user');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('user/update_user/'.$user_id);
      }
		}
		else {
			$get_user = $this->user_model->get_user($user_id);
			$data['form_title'] = 'Update User';
			$data['form_action'] = base_url('user/update_user/'.$user_id);
			$data['data'] = $get_user[0];
			$data['user_status'] = $this->user_model->get_user_status();

			$this->load->view('user/user_form_view', $data);
		}
	}

	public function delete_user($id='')
	{
    $delete_user = $this->user_model->delete_user($id);

    if($delete_user) {
      $this->session->set_flashdata('success', 'User ID '.$id.' has been deleted');
      redirect('user');
    }
    else {
    	$this->session->set_flashdata('error', 'Cannot delete User ID '.$id);
      redirect('user');
    }
  }

	public function check_user()
	{
		$data['username'] = $this->input->post('username');
		$data['email'] = $this->input->post('email');
		$data['user_id'] = $this->input->post('user_id');

    $check_duplicated = $this->user_model->check_duplicated($data);

		if($check_duplicated)
        echo 'false';
    else
        echo 'true';
	}

	public function get_user_status()
	{
    $get_user_status = $this->user_model->get_user_status();
    return $get_user_status;
	}

}
