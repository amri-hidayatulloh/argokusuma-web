<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Jobs extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lang = 'id', $page = 1) {
		$this->set_lang($lang,'job-vacancy/'.$page);

		$offset = 0;
		$limit = 10;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}
		
		$total = $this->db->query("SELECT count(id) AS total FROM {$this->db->dbprefix('jobs')} WHERE is_active = 1")->row()->total;
		$jobs = $this->db->query("SELECT * FROM {$this->db->dbprefix('jobs')} WHERE is_active = 1 ORDER BY created_date DESC")->result_array();

		foreach ($jobs as $key => $value) {
			$jobs[$key]['job_position'] = get_lang('jobs','job_position',$value['id'],$lang,$value['job_position']);
			$jobs[$key]['description'] = get_lang('jobs','description',$value['id'],$lang,$value['description']);
			$jobs[$key]['requirement'] = get_lang('jobs','requirement',$value['id'],$lang,$value['requirement']);
		}

		$total_page = ($total == 0) ? 0 : ceil($total/$limit);

		$this->_data['total_page'] = $total_page;
		$this->_data['current_page'] = $page;
		$this->_data['jobs'] = $jobs;

		$this->_addContent($this->_data);
		$this->_render();
	}

}