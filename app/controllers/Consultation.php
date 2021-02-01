<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Consultation extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lang = 'id') {
		$this->set_lang($lang,'consultation');

		$this->_data['teams'] = $this->general->get_teams(100,'cs');

		$lists = $this->db->query("SELECT * FROM {$this->db->dbprefix('consultation_contact')} WHERE is_active = 1 AND lang_available LIKE '%".$lang."%' ORDER BY id ASC")->result_array();

		foreach ($lists as $key => $value) {
			$lists[$key]['label'] = get_lang('consult-contact','label',$value['id'],$lang,$value['label']);
			$lists[$key]['initial_text'] = get_lang('consult-contact','initial_text',$value['id'],$lang,$value['initial_text']);
		}

		$this->_data['contact'] = $lists;

		$this->_addContent($this->_data);
		$this->_render();
	}

}