<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Pricing extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_addStyle('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.css');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/jquery.dataTables.min.js');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.min.js');

		$js = '
			var table = $(".datatable").DataTable({
				"initComplete": function( settings, json ) {
			    	deleteListener(table,false);
			    },
			    "drawCallback": function( settings ) {
			    	deleteListener(table,false);
			    }
			});
		';
		
		$this->_addScript($js,'embed');
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('pricings')} s WHERE s.is_active = 1")->result_array();

		$this->_template_master_data['page_title'] = 'Pricing';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function action($action = 'add', $id = 0, $tab = '') {
		$this->_template_master_data['page_title'] = 'Pricing';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		$this->_data['action'] = $action;
		$this->_data['tab'] = ($action == 'edit') ? $tab : '';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('pricings')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row_array();
			if(isset($check['id'])) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;

				if($tab == 'quote') {
					$features = $this->db->get_where('pricing_feature',['is_active'=>1,'pricing_id'=>$check['id']])->result_array();

					foreach ($features as $key => $value) {
						$features[$key]['rows'] = $this->db->get_where('pricing_feature_table',['feature_id'=>$value['id']])->result_array();
					}

					$this->_data['features'] = $features;
				}
			}
		}

	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$pricing_name = $this->get_input_lang('pricing_name');
		$payment_term = $this->get_input_lang('payment_term');
		$description = $this->get_input_lang('description');
		$state = $this->input->post('state');
		$timestamp = $this->input->post('timestamp');

		if(!empty($pricing_name['maintext'])) {
			$datas = array(
						'pricing_name' => $pricing_name['maintext'],
						'slug' => slugify($pricing_name['maintext']),
						'payment_term' => $payment_term['maintext'],
						'description' => $description['maintext'],
						'is_active' => $state,
						'created_date' => (!empty($timestamp)) ? $timestamp : date('Y-m-d H:i:s')
					 );

			$thumbnail_image = (isset($_FILES['thumbnail_image'])) ? $_FILES['thumbnail_image']: NULL;
			$cover = (isset($_FILES['cover'])) ? $_FILES['cover']: NULL;

			if(isset($thumbnail_image)) {
				$up_desktop = $this->upload_file($thumbnail_image,'thumb-pricing-','./medias/services/');
				if($up_desktop['uploaded'] == TRUE) {
					$datas['thumbnail_image'] = $up_desktop['filename'];
				}
			}

			if(isset($cover)) {
				$up_mobile = $this->upload_file($cover,'cover-pricing-','./medias/services/');
				if($up_mobile['uploaded'] == TRUE) {
					$datas['cover_image'] = $up_mobile['filename'];
				}
			}

			$save = NULL;

			if(empty($id)) {
				$save = $this->db->insert('pricings',$datas);
	 			$id = $this->db->insert_id();
			} else {
				$save = $this->db->update('pricings',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$this->save_text('pricing','pricing_name', $id, $pricing_name['lists']);
				$this->save_text('pricing','payment_term', $id, $payment_term['lists']);
				$this->save_text('pricing','description', $id, $description['lists']);
				

				$return = array('code'=>200,'msg'=>'Pricing info has been saved, thank you','directurl'=>site_url('webtools/pricing/action/edit/'.$id.'/quote'));
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Pricing info, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}

	public function savequote() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');

		$id = $this->input->post('id');
		$pricingid = $this->input->post('pricingid');
		$feature_title = $this->get_input_lang('feature_title');
		$featurekeycaption = $this->input->post('featurekeycaption');
		$featurevaluecaption = $this->input->post('featurevaluecaption');
		$featurekeycol = $this->input->post('featurekeycol');
		$featurevalcol = $this->input->post('featurevalcol');

		if(!empty($pricingid) and !empty($feature_title['maintext']) and !empty($featurekeycaption) and !empty($featurevaluecaption)) {
			$datas = [
				'pricing_id' => $pricingid,
				'caption' => $feature_title['maintext'],
				'key_heading_label' => $featurekeycaption,
				'value_heading_label' => $featurevaluecaption
			];

			$setquote = null;

			if(empty($id)) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');

				$setquote = $this->db->insert('pricing_feature', $datas);
				$id = $this->db->insert_id();
			} else {
				$setquote = $this->db->update('pricing_feature', $datas, ['id'=>$id]);
			}

			if(isset($setquote) and $setquote != false) {
				$this->save_text('pricing-quote','feature-title', $id, $feature_title['lists']);
				$this->db->delete('pricing_feature_table',['feature_id'=>$id]);

				foreach ($featurekeycol as $key => $value) {
					$this->db->insert('pricing_feature_table',[
						'feature_id' => $id,
						'is_active' => 1,
						'key_value' => $value,
						'value_value' => (isset($featurevalcol[$key])) ? $featurevalcol[$key] : ''
					]);
				}

				$return = array('code'=>200,'msg'=>'Your change has been saved');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save your quote, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}

	public function deletequote($id = null) {
		$return = array('code'=>500,'msg'=>'Missing parameter');

		if(isset($id)) {
			$set = $this->db->update('pricing_feature',['is_active'=>0],['id'=>$id]);

			if(isset($set) and $set != false) {
				$return = array('code'=>200,'msg'=>'Quote has been removed');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to remove quote, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}
}