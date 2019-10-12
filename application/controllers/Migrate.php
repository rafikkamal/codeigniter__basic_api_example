<?php

class Migrate extends CI_Controller
{

	public function index()
	{
		$this->load->library('migration');
		
		// var_dump(
		// 	$this->migration->latest(),
		// 	$this->migration->version(20191012160001)
		// );
		// die();

		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		}
	}

}