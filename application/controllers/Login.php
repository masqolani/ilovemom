<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('user_model');
	}

	public function index()
	{
		$this->data['form_action'] = site_url('login/check_login');

		$this->load->view('login_view', $this->data);
	}

	public function check_login()
	{
		$post = $this->input->post();

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
			{
				log_message('debug','masuk logged_in');
				redirect('home');
			}
			else
			{
				log_message('debug','masuk else logged_in');
				redirect('login');
			}
		}
		else
		{
			$login = $this->user_model->login($post);

			if ($login) {
				$session_data = array(
					'user_id' => $login[0]['user_id'],
					'username' => $login[0]['username'],
					'email' => $login[0]['password'],
					'user_status_id' => $login[0]['user_status_id'],
					'first_name' => $login[0]['first_name'],
					'last_name' => $login[0]['last_name']
				);

				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);

				log_message('debug','masuk login');
				redirect('home');
			} else {
				$this->session->set_flashdata('error', 'Username or password is wrong');
				redirect('login');
			}
		}
	}


	public function destroy()
	{
		$get = $this->input->get();

		// Removing session data
		$sess_array = array(
			'username' => $get['username']
		);

		$this->session->unset_userdata('logged_in', $sess_array);

		redirect('login');
	}

	public function get_user()
	{
		echo json_encode($this->session->user_data['logged_in']);
	}

}
