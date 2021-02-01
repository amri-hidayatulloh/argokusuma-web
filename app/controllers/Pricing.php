<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Pricing extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lang = 'id') {
		$this->set_lang($lang,'pricing');

		$this->_data['pricing'] = $this->pricing->get_pricing();
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function detail($lang = 'id', $slug = 'digital-products') {
		$this->set_lang($lang,'pricing/detail/'.$slug);

		$data = $this->pricing->get_detail_pricing($slug);

		if($data == FALSE) {
			redirect($lang.'/pricing');
		}

		$this->_data['data'] = $data;
		$this->_data['pricing'] = $this->pricing->get_pricing($data->id);
		$this->_data['features'] = $this->pricing->get_features($data->id);

		$this->_addContent($this->_data);
		$this->_render();
	}

}