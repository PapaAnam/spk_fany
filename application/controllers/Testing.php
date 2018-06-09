<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

	public function dummy()
	{
		$this->load->model('dummy_model');
		$this->dummy_model->start();
	}

	public function reset()
	{
		$this->load->model('dummy_model');
		$this->dummy_model->reset();
	}

}
