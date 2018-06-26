<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function add_user($data) {

		unset($data['retype_password']);
		$data['password'] = md5($data['password']);

		$this->db->insert('user', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function login($data) {
		$username = $data['username'];
		$password = md5($data['password']);

		$condition = "username = '$username' AND password = '$password'";

		// print_r($condition);die;

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		$query = $query->result_array();

		// print_r($query);die;

		if (!empty($query)) {
			return $query;
		} else {
			return false;
		}
	}

	public function check_duplicated($data)
	{
		$username = $data['username'];
		$email = $data['email'];
		$user_id = $data['user_id'];

		$query = "SELECT * FROM user WHERE user_id <> '$user_id' AND";

		if(!empty($username) || !empty($email)) {
			$query .= " (username = '$username' OR email = '$email')";
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

		if($query)
			return TRUE;
		else
			return FALSE;
	}

	public function get_user($user_id = '') {
  	$query = 'SELECT u.user_id, u.username, u.first_name, u.last_name, u.email,
											us.user_status_name, us.user_status_id, u.password
			  			 FROM user AS u
			  			 LEFT JOIN user_status AS us ON u.user_status_id = us.user_status_id';

		if(!empty($user_id)) {
			$query .= ' WHERE u.user_id = '.$user_id;
		}

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	if($query)
  		return $query;
  	else
  		return FALSE;
  }

	public function get_user_status() {
  	$query = 'SELECT *
			  			 FROM user_status';

    $query = $this->db->query($query);
  	$query = $query->result_array();

  	return $query;
  }

	public function update_user($post)
  {
  	$data['username'] = $post['username'];
  	$data['first_name'] = $post['first_name'];
  	$data['last_name'] = $post['last_name'];
  	$data['email'] = $post['email'];
    $data['password'] = $post['password'];
    $data['user_status_id'] = $post['user_status_id'];

		$this->db->where('user_id', $post['user_id']);
		$query = $this->db->update('user', $data);

		if($query)
			return TRUE;
		else
			return FALSE;
  }

	public function delete_user($id)
  {
    $this->db->where('user_id', $id);
		$delete_user = $this->db->delete('user');

		if($delete_user)
			return TRUE;
		else
			return FALSE;
  }

}
