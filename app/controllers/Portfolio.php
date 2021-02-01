<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Portfolio extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lang = 'id', $category = 'all') {
		$this->set_lang($lang,'portfolio/'.$category);
		$this->_data['categories'] = $this->project->get_categories();
		$this->_data['active_category'] = $category;

		$this->_data['projects'] = $this->get_data(1,$category,$lang,FALSE);

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function get_data($page = 1,$category_slugs = 'all', $lang = 'id', $json = TRUE) {
		$offset = 0;
		$limit = 6;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$rows = $this->project->get_project_lists($category_slugs,$offset,$limit);
		$total_page = ($rows['total'] > 0) ?  ceil($rows['total'] / $limit) : 0;
		$next_page = ($page < $total_page) ? $page + 1 : 0;
		$next_url = ($next_page > 0) ? site_url('portfolio/get_data/'.$next_page.'/'.$category_slugs.'/'.$lang) : '';

		$return = [
			'page' => $page,
			'nexturl' => $next_url,
			'total_page' => $total_page,
			'total_row' => $rows['total'],
			'rows' => $rows['rows']
		];

		if(!$json) {
			return $return;
		} else {
			echo json_encode($return);
			exit;
		}
	}

	public function detail($lang = 'id', $slug = 'branding') {
		$this->set_lang($lang,'portfolio/'.$slug);
		$data = $this->project->get_detail($slug);

		if($data == FALSE) {
			redirect('portfolio');
		}

		$this->_data['data'] = $data;
		$this->_data['related'] = $this->project->get_related_projects($data->categories['ids']);
		$this->_addContent($this->_data);
		$this->_render();
	}

}