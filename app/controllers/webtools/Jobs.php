<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Jobs extends APP_Webtools {

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
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('jobs')} s WHERE s.is_active = 1")->result_array();

		$this->_template_master_data['page_title'] = 'Job Vacancy';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function action($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Job Vacancy';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('jobs')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['slide'] = $check;
			}
		}


		$this->_addContent($this->_data);
		$this->_render();
	}


	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$location = $this->input->post('location');
		$email = $this->input->post('email');

		$job_position = $this->get_input_lang('job_position');
		$description = $this->get_input_lang('description');
		$requirement = $this->get_input_lang('requirement');

		if(!empty($email)) {
			$datas = array(
						'job_position' => $job_position['maintext'],
					 	'description' => $description['maintext'],
					 	'requirement' => $requirement['maintext'],
					 	'email' => $email,
					 	'location' => $location
					 );

			$save = NULL;

			if(empty($id)) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');
	  			
				$save = $this->db->insert('jobs',$datas);
	  			$id = $this->db->insert_id();
			} else {
				$save = $this->db->update('jobs',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$this->save_text('jobs','job_position',$id,$job_position['lists']);
				$this->save_text('jobs','description',$id,$description['lists']);
				$this->save_text('jobs','requirement',$id,$requirement['lists']);

				$return = array('code'=>200,'msg'=>'Job vacancy has been saved, thank you');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Job vacancy, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}

}