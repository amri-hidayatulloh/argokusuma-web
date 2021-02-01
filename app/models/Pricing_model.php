<?php
class Pricing_model extends CI_Model
{
	private $lang = 'id';

	function __construct() {
		parent::__construct();
	}

	public function set_lang($lang = 'id') {
		$this->lang = $lang;
	}

	public function get_pricing($exclude = 0) {
		$rows = [];

		if($exclude == 0) {
			$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('pricings')} WHERE is_active = 1 ORDER BY created_date DESC")->result_array();
		} else {
			$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('pricings')} WHERE is_active = 1 AND id != ".$exclude." ORDER BY created_date DESC")->result_array();
		}

		foreach ($rows as $key => $value) {
			$rows[$key]['pricing_name'] = get_lang('pricing','pricing_name',$value['id'],$this->lang,$value['pricing_name']);
			$rows[$key]['description'] = get_lang('pricing','description',$value['id'],$this->lang,$value['description']);
			$rows[$key]['payment_term'] = get_lang('pricing','payment_term',$value['id'],$this->lang,$value['payment_term']);

			$rows[$key]['thumb'] = site_url('medias/services/'.$value['thumbnail_image']);
			$rows[$key]['cover'] = site_url('medias/services/'.$value['cover_image']);
			$rows[$key]['url'] = site_url($this->lang.'/pricing/detail/'.$value['slug']);
			$rows[$key]['snippet'] = substr(strip_tags($rows[$key]['description']), 0, 100);
		}

		return $rows;
	}


	public function get_detail_pricing($slug = '') {
		$get = $this->db->query("SELECT p.* FROM {$this->db->dbprefix('pricings')} p  WHERE p.is_active = 1 AND p.slug = '".$slug."'")->row();
		
		if(!isset($get->id)) {
			return FALSE;
		}	

		$get->pricing_name = get_lang('pricing','pricing_name',$get->id,$this->lang,$get->pricing_name);
		$get->description = get_lang('pricing','description',$get->id,$this->lang,$get->description);
		$get->payment_term = get_lang('pricing','payment_term',$get->id,$this->lang,$get->payment_term);

		$get->thumb = site_url('medias/services/'.$get->thumbnail_image);
		$get->cover = site_url('medias/services/'.$get->cover_image);

		return $get;
	}

	public function get_features($id) {
		$features = $this->db->get_where('pricing_feature',['pricing_id'=>$id,'is_active'=>1])->result_array();

		foreach ($features as $key => $value) {
			$features[$key]['caption'] = get_lang('pricing-quote', 'feature-title', $value['id'], $this->lang, $value['caption']);
			$features[$key]['tables'] = $this->db->get_where('pricing_feature_table',['feature_id'=>$value['id'],'is_active'=>1])->result_array();
		}

		return $features;
	}


}