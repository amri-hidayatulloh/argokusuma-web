<?php
class General_model extends CI_Model
{

	private $lang = 'id';

	function __construct() {
		parent::__construct();
	}

	public function set_lang($lang = 'id') {
		$this->lang = $lang;
	}

	public function get_slider() {
		$now = date('Y-m-d H:i:s');
		$slides = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('sliders')} s WHERE s.start_date <= '".$now."' AND s.end_date >= '".$now."' AND s.is_active = 1")->result_array();
			
		foreach ($slides as $key => $value) {
			$slides[$key]['title'] = get_lang('slider','title',$value['id'],$this->lang,$value['title']);
			$slides[$key]['caption'] = get_lang('slider','caption',$value['id'],$this->lang,$value['caption']);
			$slides[$key]['link_text'] = get_lang('slider','linktext',$value['id'],$this->lang,$value['link_text']);
		}

		return $slides;
	}

	public function get_newest_testimony($max = 3) {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('testimonials')} WHERE is_active = 1 ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function get_teams($max = 3, $group = 'team') {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('teams')} WHERE is_active = 1 AND group_type = '".$group."' ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function is_exist_subscription($email) {
		$check = $this->db->get_where('subscription',['email'=>$email,'is_active'=>1]);
		return ($check->num_rows() > 0) ? TRUE : FALSE;
	}

	public function save_subscription($email) {
		$this->load->library('user_agent');

		$user_agent = $this->agent->browser()." ".$this->agent->version()." ".$this->agent->mobile();
		$ip_address = $this->input->ip_address();

		return $this->db->insert('subscription',[
									'email' => $email,
									'ip_address' => $ip_address,
									'user_agent' => $user_agent,
									'is_active' => 1,
									'created_date' => date('Y-m-d H:i:s')
								]);
	}

	public function save_contact_submission($firstname,$lastname,$email,$message) {
		return $this->db->insert('contact_submission',[
									'first_name' => $firstname,
									'last_name' => $lastname,
									'email' => $email,
									'comment' => $message,
									'created_date' => date('Y-m-d H:i:s')
								]);
	}

	public function save_suggest_submission($name,$phone,$email,$message) {
		$this->load->library('user_agent');

		return $this->db->insert('suggest_submission',[
									'name' => $name,
									'phone' => $phone,
									'email' => $email,
									'suggestion' => $message,
									'ip_address' => $this->input->ip_address(),
									'user_agent' => $this->agent->browser().", ".$this->agent->version().", ".$this->agent->mobile(),
									'created_date' => date('Y-m-d H:i:s')
								]);
	}

	public function get_services() {
		$services = $this->db->get_where('services',['is_active'=>1])->result_array();

		foreach ($services as $key => $value) {
			$services[$key]['title'] = get_lang('services','title',$value['id'],$this->lang,$value['title']);
			$services[$key]['description'] = get_lang('services','description',$value['id'],$this->lang,$value['description']);
		}

		return $services;
	}

	public function get_detail_service($slug) {
		$detail = $this->db->get_where('services',['is_active'=>1,'slug'=>$slug])->row_array();

		if(!isset($detail['id'])) {
			return FALSE;
		}

		$detail['title'] = get_lang('services','title',$detail['id'],$this->lang,$detail['title']);
		$detail['description'] = get_lang('services','description',$detail['id'],$this->lang,$detail['description']);
		$detail['caption'] = get_lang('services','caption',$detail['id'],$this->lang,$detail['caption']);

		$extends = $this->db->get_where('services_extends',['service_id'=>$detail['id']])->result_array();

		foreach ($extends as $key => $value) {
			$extends[$key]['title'] = get_lang('services-segment','title',$value['id'],$this->lang,$value['title']);
			$extends[$key]['description'] = get_lang('services-segment','description',$value['id'],$this->lang,$value['description']);
		}

		$detail['extends'] = $extends;

		return $detail;
	}

}