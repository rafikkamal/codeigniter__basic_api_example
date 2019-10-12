<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	private $table;

	public function __construct() {
		$this->table = "users";
	} 

	function getAll() {
		$response = array();
		$this->db->select('*');
		$q = $this->db->get($this->table);
		$response = $q->result_array();

		return $response;
	}


	public function get($id) {
		$data = $this->db->get_where($this->table, ['id' => $id])->row_array();
		// var_dump($data);
		// die();
		return $data;
	}


	public function create() {
		/**
		 * https://knowledgebase.foryou.ninja/creating-api-using-codeigniter-rest-keep-mind
		 */
		$api_data = json_decode($this->input->raw_input_stream);

		$data = [
			'firstname' => $api_data->firstname,
			'lastname' 	=> $api_data->lastname,
			'email' 	=> $api_data->email,
			'username' 	=> $api_data->username,
			'created_at'=> date('Y-m-d H:i:s'),
			'updated_at'=> date('Y-m-d H:i:s')
		];

		/**
		 * The following is for form inputs
		 */
		// $data = [
		// 	'firstname' => $this->input->post('firstname'),
		// 	'lastname' 	=> $this->input->post('lastname'),
		// 	'email' 	=> $this->input->post('email'),
		// 	'username' 	=> $this->input->post('username')
		// ];

		$this->db->insert($this->table, $data);
    	return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function update($id) {
		$api_data = json_decode($this->input->raw_input_stream);
		$this->db->update($this->table, $api_data, array('id'=>$id));
    	return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function delete($id) {
		$this->db->delete($this->table, array('id'=>$id));
    	return ($this->db->affected_rows() != 1) ? false : true;
	}

}
