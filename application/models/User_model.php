<?php

/**
* User Model
*/
class User_model extends CI_Model	
{
	
	public function store_user($data)
	{
		// Insert data in users table.
		// INSERT INTO 'users' ('email', 'pass') VALUES ($data['email'], $data['pass']);
		$insert = $this->db->insert('users', $data);
		return $insert;
	}

	public function show_all()
	{
		$query = $this->db->select('*')->from('users')->get();
		return $query->result();
		// var_dump($query->result());
		// die();
		// $this->db->get('users');
	}

	public function show_one($id)
	{
		$query = $this->db->select('*')->from('users')->where('id', $id)->get();
		return $query->row();
	}

	public function delete_user($id)
	{
		return $this->db->delete('users', array('id' => $id));
	}
}