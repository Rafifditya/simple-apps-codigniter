<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 /**
		* Index Page for this controller.
		*
		* Maps to the following URL
		*       http://example.com/index.php/welcome
		* - or -
		*       http://example.com/index.php/welcome/index
		* - or -
		* Since this controller is set as the default controller in
		* config/routes.php, it's displayed at http://example.com/
		*
		* So any other public methods not prefixed with an underscore will
		* map to /index.php/welcome/<method_name>
		* @see https://codeigniter.com/user_guide/general/urls.html
		*/

		public function __construct()
		{
			parent::__construct();
			$this->load->model('model_topnav','',TRUE);
			$this->load->model('model_home_auditor','',TRUE);
		}

		function index()
		{
			if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				// var_dump($session_data);
				$data['sess_name'] = $session_data['name'];
				$data['sess_unit'] = $session_data['unit'];
				$data['sess_position'] = $session_data['position'];
				$data['sess_image'] = $session_data['image'];


				// $data['total_audit'] = $this->model_home_auditor->select_count_audit_plan();
				// $data['total_audit_on_progress'] = $this->model_home_auditor->select_count_audit_plan_on_progress();
				// $data['total_ncr'] = $this->model_home_auditor->select_count_ncr();
				//
				// $data['upcoming_audit_plan'] = $this->model_home_auditor->select_3_upcoming_audit_plan();
				//
				// $data['max_count_tpm'] = $this->model_home_auditor->select_5_max_count_tpm(date("Y"));
				// $data['count_tpm'] = $this->model_home_auditor->select_count_all_tpm(date("Y"));
				//
				// $data['max_keyword'] = $this->model_home_auditor->select_max_keyword(date("Y"));
				// $data['count_keyword'] = $this->model_home_auditor->select_count_keyword(date("Y"));
				//
				// $data['all_year'] = $this->model_home_auditor->select_year();
				// $data['all_unit'] = $this->model_home_auditor->select_all_auditee_remain();
				// $data['newest_noticeboard'] = $this->model_home_auditor->select_newest_noticeboard();
				$this->load->view('v_home', $data);
			}
			else
			{
		 	//Jika tidak ada session di kembalikan ke halaman login
				redirect('login', 'refresh');

					// $session_data = $this->session->userdata('logged_in');
					// var_dump($this->session->userdata('logged_in'));
			}
		}

		function logout()
		{
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('home', 'refresh');
		}

	}
	?>
