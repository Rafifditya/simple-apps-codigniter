<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

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
      $this->load->model('model_employee','',TRUE);
   }

function index()
 {
   //Aksi untuk melakukan validasi
   $this->load->library('form_validation');

   $this->form_validation->set_rules('empid', 'Employee id', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
   if($this->form_validation->run() == FALSE)
   {
     //Jika validasi gagal user akan diarahkan kembali ke halaman login
     $this->load->view('v_login');
   }
   else
   {
     //Jika berhasil user akan di arahkan ke private area
      redirect('home', 'refresh');
   }
 }


 function check_database($password)
 {
   //validasi field terhadap database
   $empid = $this->input->post('empid');
   $password = $this->input->post('password');
   //query ke database
   // $result = $this->model_employee->login($empid, $password);
   if($empid == "admin" && $password == "admin")
   {
     $sess_array = array();
     // foreach($result as $row)
     // {
       $sess_array = array(
          'no' => 1,
         'name' => "admin",
         'unit' => "admin",
         'empid' => "admin",
         'position' => "admin",
         'image' => site_url().'assets/images/default.png'
       );
       $this->session->set_userdata('logged_in', $sess_array);
     // }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid employee id or password');
     return false;
   }
 }
}
?>
