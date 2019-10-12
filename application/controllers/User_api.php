<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}


	public function user_get() {
	    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		    $data = $this->User_model->getAll();
		    $output = $this->jsonResponse([
		    	'users'  => $data,
		    	'status' => 200 
		    ], 200);
		} else {
			$output = $this->jsonResponse([
		    	'message' => 'Unauthorized',
		    	'status'  => 401
		    ], 200);
		}
		return $output;
	}


	public function user_post() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if($this->User_model->create()) {
				$message = 'Successfully create the user';
			    $status = 200;
			} else {
				$message = 'Unable to create the user';
			    $status = 200;
			}
		} else {
			$message = 'Unauthorized';
		    $status = 401;
		}
		return $this->jsonResponse([
	    	'message' => $message,
	    	'status'  => $status
	    ], 200);
	}


	public function user_put($id) {
		if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if($this->User_model->get($id) !== NULL) {
				if($this->User_model->update($id)) {
					$message = 'Successfully updated the user';
			    	$status = 200;
				} else {
					$message = 'Unable to update the user';
			    	$status = 200;
				}
			} else {
				$message = 'No Such User Found';
			    $status = 404;
			}
		} else {
			$message = 'Unauthorized';
		    $status = 401;
		}
		return $this->jsonResponse([
	    	'message' => $message,
	    	'status'  => $status
	    ], 200);
	}


	public function user_delete($id) {
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if($this->User_model->get($id) !== NULL) {
				if($this->User_model->delete($id)) {
					$message = 'Successfully deleted the user';
			    	$status = 200;
				} else {
					$message = 'Unable to delete the user';
			    	$status = 200;
				}
			} else {
				$message = 'No Such User Found';
			    $status = 404;
			}
		} else {
			$message = 'Unauthorized';
		    $status = 401;
		}
		return $this->jsonResponse([
	    	'message' => $message,
	    	'status'  => $status
	    ], 200);
	}


	private function jsonResponse($data=[], $status=200) {
		return	$this->output
		->set_content_type('application/json')
        ->set_status_header($status)
        ->set_output(json_encode($data));
	}

}