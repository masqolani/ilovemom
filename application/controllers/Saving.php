<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saving extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('saving_model');
		$this->load->model('user_model');
  }

	public function index() {
		$data['title'] = 'Saving List';
    $this->load->view('saving/saving_view', $data);
	}

	public function get_saving_json($saving_id = ''){

		$get_saving = $this->saving_model->get_saving($saving_id);

		if(!empty($get_saving)) {
			foreach ($get_saving as $key => $value) {
				// $actions = anchor(base_url('saving/update_saving/').$value['user_id'],
				// 						'<i class="fa fa-pencil"></i> Update',
										// array('class' => 'btn btn-xs btn-success', 'style' => 'margin-top:2px'));
				$actions = ' '.anchor(base_url('saving/#'), '<i class="fa fa-info"></i> Detail',
										array('id' => "detail_saving", 'class' => 'btn btn-xs btn-info',
										'user_id' => $value['user_id'], 'style' => 'margin-top:2px',
										'onclick' => "return false"));

				$get_saving[$key]['actions'] = $actions;
				$get_saving[$key]['name'] = $value['first_name'].' '.$value['last_name'];
				$get_saving[$key]['total_saving'] = 'Rp. '.$value['total_saving'];
			}
		} else {
			$get_saving = [];
		}

		$data['data'] = $get_saving;
		echo json_encode($data);
	}

	public function get_saving_by_user_id() {
		$user_id = $this->input->post('user_id');
		$get_saving_detail = $this->saving_model->get_saving_detail($user_id);

		if(!empty($get_saving_detail)) {
			echo json_encode($get_saving_detail);
		} else {
			echo 'false';
		}
	}

	public function create_saving() {
		if($this->session->userdata['logged_in']['user_status_id'] == "1") {
			$post = $this->input->post();

			if($post)
			{
				$saving = $this->session->savingdata['logged_in'];

				$this->form_validation->set_rules('user_id', 'Name', 'trim|required');
				$this->form_validation->set_rules('amount', 'Saving', 'trim|required');

	      if ($this->form_validation->run() === TRUE) {
						//file upload code
						//set file upload settings
						$config['upload_path']        = realpath(APPPATH. '../assets/uploads/');
						$config['allowed_types']      = 'jpg|png|jpeg';
						$config['max_size'] 					= '2048000';
						// $config['max_width'] 					= '1024';
						// $config['max_height'] 				= '768';

						// print_r($config);die;

						// $this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('transfer_picture')){
							$error = array('error' => $this->upload->display_errors());

							$this->load->view('saving/create_saving', $error);
						} else {

							//file is uploaded successfully
							//now get the file uploaded data
							$upload_data = $this->upload->data();

							//get the uploaded file name
							$post['transfer_picture'] = $upload_data['file_name'];
							$post['saving_date'] = date('Y-m-d');

							//store pic data to the db
							$this->saving_model->add_saving($post);

							$this->session->set_flashdata('success', 'Saving has been created successfully');
		          redirect('saving');
						}
	      } else {
	          $this->session->set_flashdata('error', validation_errors());
	          redirect('saving/create_saving');
	      }
			}
			else
			{
	 			$data['form_title'] = 'Add New Saving';
				$data['form_action'] = base_url('saving/create_saving');
				$data['user'] = $this->user_model->get_user();

				$this->load->view('saving/saving_form_view', $data);
			}
		} else {
				redirect('saving');
		}
	}

	public function update_saving($saving_id='')
	{
		$post = $this->input->post();

		if($post) {
			$this->form_validation->set_rules('saving_name', 'Saving Name', 'trim|required');

      if ($this->form_validation->run() === TRUE) {
      		$this->saving_model->update_saving($post);
          $this->session->set_flashdata('success', 'Saving ID '.$post['saving_id'].' has been updated successfully');
          redirect('saving');
      }
      else {
          $this->session->set_flashdata('error', validation_errors());
          redirect('saving/update_saving/'.$saving_id);
      }
		}
		else {
			$get_saving = $this->saving_model->get_saving($saving_id);
			$data['form_title'] = 'Update Saving';
			$data['form_action'] = base_url('saving/update_saving/'.$saving_id);
			$data['data'] = $get_saving[0];

			$this->load->view('saving/saving_form_view', $data);
		}
	}

	public function delete_saving($id='')
	{
    $delete_saving = $this->saving_model->delete_saving($id);

    if($delete_saving) {
      $this->session->set_flashdata('success', 'Saving ID '.$id.' has been deleted');
      redirect('saving');
    }
    else {
    	$this->session->set_flashdata('error', 'Cannot delete Saving ID '.$id);
      redirect('saving');
    }
  }

	public function check_saving()
	{
		$data['saving_id'] = $this->input->post('saving_id');
		$data['saving_name'] = $this->input->post('saving_name');

    $check_duplicated = $this->saving_model->check_duplicated($data);

		if($check_duplicated)
        echo 'false';
    else
        echo 'true';
	}

	public function get_saving_status()
	{
    $get_saving_status = $this->saving_model->get_saving_status();
    return $get_saving_status;
	}

}
