<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
        $this->load->model('model_audit_plan','',TRUE);
        $this->load->model('model_audit_checklist','',TRUE);
        $this->load->model('model_audit_code','',TRUE);
        $this->load->model('model_audit_requirement','',TRUE);
        $this->load->model('model_auditee','',TRUE);
        $this->load->model('model_employee','',TRUE);
   }

    function index()
    {
        $session_data = $this->session->userdata('logged_in');
        if($session_data && $session_data['position'] == "Quality Manager")
        {
            redirect(base_url().'report/manage_audit_plan', 'refresh');
        }
        else
        {
         //Jika tidak ada session di kembalikan ke halaman login
            $this->logout();
            redirect(base_url().'login', 'refresh');
        }
    }

    function manage_audit_plan($param1='', $param2='',$param3=''){

        $session_data = $this->session->userdata('logged_in');

        if(!$this->session->userdata('logged_in'))
            redirect(base_url().'login', 'refresh');

        if ($param1 == 'create') {
            $this->model_audit_plan->insert_audit_plan();
            $no = $this->model_audit_plan->select_max_no_audit_plan();
            $this->create_pdf_plan($no);


            $flash_data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info-circle fa-lg"></i> &nbsp;Audit Plan Succesfully Created!</h4>
                </div>';

            $this->session->set_flashdata('notif',$flash_data);

            redirect(base_url().'report/manage_audit_plan', 'refresh');
        }
        if ($param1 == 'approve') {

            $this->model_audit_plan->approve_audit_plan_where($param2, $session_data['name']);
            $this->create_pdf_checklist($param2);
            // $this->send_email_plan($param2);
            $flash_data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info-circle fa-lg"></i> &nbsp;Audit Plan Succesfully Approved!</h4>
                </div>';

            $this->session->set_flashdata('notif',$flash_data);
            redirect(base_url().'report/manage_audit_plan', 'refresh');
        }
        if ($param1 == 'revisi' && $param2 == 'do_update') {
            $this->model_audit_plan->revisi_audit_plan();
            $no = $this->input->post('no');
            $this->create_pdf_plan($no);
            $flash_data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info-circle fa-lg"></i> &nbsp;Audit Plan Succesfully Edited!</h4></div>';

            $this->session->set_flashdata('notif',$flash_data);
            redirect(base_url().'report/manage_audit_plan', 'refresh');
        } else if ($param1 == 'revisi') {
            $data['revisi_data'] = $this->model_audit_plan->select_all_audit_plan_where_no($param2);
            $data['revisi_data_req'] = $this->model_audit_plan->select_requirement_audit_plan_where_no($param2);
            $data['count_revisi_req'] = $this->model_audit_plan->select_count_requirement_audit_plan_where_no($param2);
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $this->model_audit_plan->update_audit_plan();

            $no = $this->input->post('no');
            $year  = $this->input->post('year');
            $auditee_unit = $this->input->post('auditee_unit');
            $audit_code = $this->input->post('audit_code');

            $kunjungan = $this->model_audit_plan->select_count_kunjungan($year, $auditee_unit, $audit_code);
            if(count($kunjungan)>0)
                $kunjungan = $kunjungan->count_kunjungan+1;
            else
                $kunjungan = 1;

            $revisi_no = $this->input->post('revisi_no');


            $audit_plan_no = $auditee_unit.'/'.$audit_code.$kunjungan.'/'.$year.'/R'.$revisi_no;
            $this->create_pdf_plan($no);

            $flash_data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info-circle fa-lg"></i> &nbsp;Audit Plan Succesfully Edited!</h4>
                </div>';

            $this->session->set_flashdata('notif',$flash_data);

            redirect(base_url().'report/manage_audit_plan', 'refresh');
        } else if ($param1 == 'edit') {
            $data['edit_data'] = $this->model_audit_plan->select_all_audit_plan_where_no($param2);
            $data['edit_data_req'] = $this->model_audit_plan->select_requirement_audit_plan_where_no($param2);
            $data['count_edit_req'] = $this->model_audit_plan->select_count_requirement_audit_plan_where_no($param2);
        }
        if ($param1 == 'delete') {
            $this->model_audit_plan->delete_audit_plan_where($param2);
            $flash_data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info-circle fa-lg"></i> &nbsp;Audit plan succesfully deleted!</h4>
                </div>';

            $this->session->set_flashdata('notif',$flash_data);
            redirect(base_url().'report/manage_audit_plan', 'refresh');
        }
        if ($param1 == 'view'){

            $this->create_pdf_plan($param2);


            $data = $this->model_audit_plan->select_all_audit_plan_where_no($param2);
            $filename = str_replace("/", "-", "PLAN-".$data->audit_plan_no);
            redirect(site_url().'/pdf/'.$filename.'.pdf', 'refresh');
        }


        $data['sess_name'] = $session_data['name'];
        $data['sess_unit'] = $session_data['unit'];
        $data['sess_position'] = $session_data['position'];
        $data['sess_image'] = $session_data['image'];
        //
        // $data['no'] =$this->model_audit_plan->select_max_no_audit_plan()+1;
        // $data['code'] = $this->model_audit_code->select_all_audit_code();
        // $data['auditee_unit'] = $this->model_auditee->select_all_auditee();
        // $data['issued_by'] = $this->model_employee->select_all_employee();
        // $data['approved_by'] = $this->model_employee->select_all_employee();
        // $data['requirement'] = $this->model_audit_requirement->select_all_audit_requirement();
        //
        // $data['query'] = $this->model_audit_plan->select_all_audit_plan();

        $this->load->view('v_mileage_report', $data);

    }

    function calendar(){
        if(!$this->session->userdata('logged_in'))
            redirect(base_url().'login', 'refresh');

        $session_data = $this->session->userdata('logged_in');
        $data['sess_name'] = $session_data['name'];
        $data['sess_unit'] = $session_data['unit'];
        $data['sess_position'] = $session_data['position'];
        $data['sess_image'] = $session_data['image'];

        $data['date_auditplan'] = $this->model_audit_plan->select_all_audit_plan_calendar();
        $data['view'] = 'v_audit_plan_calendar';
        $this->load->view('v_audit_plan_calendar', $data);

    }

    public function create_pdf_plan($no){

        $this->load->library('fpdf_plan','',TRUE);
        $data = $this->model_audit_plan->select_all_audit_plan_where_no($no);
        $data_req = $this->model_audit_plan->select_requirement_audit_plan_where_no($no);

        $pdf = new fpdf_plan($data, $data_req);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->auditplan();
    }

    public function create_pdf_checklist($no){
        $this->load->library('fpdf_checklist','',TRUE);
        $data = $this->model_audit_checklist->select_audit_checklist_where_auditplanno($no);
        $data_req = $this->model_audit_checklist->select_requirement_audit_checklist_where_auditplanno($no);
        $req_list = $this->model_audit_checklist->select_requirement_all();

        $pdf = new fpdf_checklist($data, $data_req, $req_list);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->auditchecklist();
    }

    public function send_email_plan($no){


        $sendto = $this->model_audit_plan->select_all_audit_plan_where_no($no);
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'akunboongan12@gmail.com', // change it to yours
            'smtp_pass' => 'aps121110', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('akunboongan12@gmail.com'); // change it to yours
        $this->email->to($sendto->auditee_email);// change it to yours
        $today = new DateTime();
        $dt_end = new DateTime($sendto->date_approved);
        $remain = $today->diff($dt_end);
        $daysleft = $remain->format("%r%a")+1;

        $this->email->subject('D-'.$daysleft.' to Audit Plan '.$sendto->audit_plan_no);
        $visit_date = date("Y-m-d", strtotime($sendto->date_approved));
        $this->email->message('Hello... <br> I reminde you for schedule of Audit 147 with number '.$sendto->audit_plan_no.', its been planned on <b>'.$visit_date.'</b>. Please be prepared and beg concern for it.<br><br>Note: This applies email as formal notification and please do not reply this email.<br><br>Regards,<br>Admin Audit 147');
        $filename_plan = str_replace("/", "-", "PLAN-".$sendto->audit_plan_no);
        $filename_checklist = str_replace("/", "-", "CHECKLIST-".$sendto->audit_plan_no);
        $this->email->attach(site_url().'pdf/'.$filename_plan.'.pdf');
        $this->email->attach(site_url().'pdf/'.$filename_checklist.'.pdf');


        if($this->email->send())
        {
            $data =
                '<div class="alert alert-success">
                <h4><i class="fa fa-info"></i> Well Done!</h4>
                Suksess bray, email sent to :
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>';
        }
        else
        {
            //$data =
            //  '<div class="alert alert-warning">
            //  <h4><i class="fa fa-warning"></i> Oh Snap!</h4>
            //  Gagal bray, email nggak kekirim.
            //  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            //  </div>';
             show_error($this->email->print_debugger());
        }
        $this->session->set_flashdata('gagal',$data);

    }

    public function check_reminder_audit_plan(){
        foreach($this->audit_plan->select_all_audit_plan() As $row){
            $this->email->to($row->auditee_email);// change it to yours
            $today = new DateTime();
            $dt_end = new DateTime($row->date_approved);
            $remain = $today->diff($dt_end);
            $daysleft = $remain->format("%r%a")+1;
            if($daysleft == 3 OR $daysleft == 7 OR $daysleft == 14 OR $daysleft == 30){
                // $this->audit_plan->send_email_plan($row->no);
            }
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
