<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saving_model extends CI_Model {

	public function add_saving($data) {

		$this->db->insert('saving', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function check_duplicated($data)
	{
		$saving_id = $data['saving_id'];
		$saving_name = $data['saving_name'];

		$query = "SELECT * FROM saving WHERE saving_id <> '$saving_id' AND";

		if(!empty($saving_name)) {
			$query .= " saving_name = '$saving_name'";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

		if($query)
			return TRUE;
		else
			return FALSE;
	}

	public function get_saving_detail($user_id = '') {
  	$query = 'SELECT s.amount, s.saving_date, u.first_name,
								u.last_name, s.saving_id, s.user_id, s.transfer_picture
							FROM saving AS s
							LEFT JOIN user AS u ON s.user_id = u.user_id
							WHERE 1=1 ';

		if(!empty($user_id)) {
			$query .= ' AND s.user_id = '.$user_id;
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function get_saving($saving_id = '') {
  	$query = 'SELECT SUM(s.amount) AS total_saving, s.saving_date, u.first_name,
								u.last_name, s.saving_id, s.user_id
							FROM saving AS s
							LEFT JOIN user AS u ON s.user_id = u.user_id
							GROUP BY u.username';

		// print_r($query);die;

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function update_saving($post)
  {
  	$data['saving_name'] = $post['saving_name'];

		$this->db->where('saving_id', $post['saving_id']);
		$query = $this->db->update('saving', $data);

		if($query)
			return TRUE;
		else
			return FALSE;
  }

	public function delete_saving($id)
  {
    $this->db->where('saving_id', $id);
		$delete_saving = $this->db->delete('saving');

		if($delete_saving)
			return TRUE;
		else
			return FALSE;
  }

}
