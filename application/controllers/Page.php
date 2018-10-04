<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('page_model');
    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
        $url=base_url();
        redirect($url);
    }
  }

  function index(){
    $this->load->view('page/v_dashboard');
  }

  function data_pegawai(){
    // function ini hanya boleh diakses oleh admin
    if($this->session->userdata('ses_roles')=='99' || $this->session->userdata('ses_roles')=='4'){
        $data['query'] = $this->page_model->getAllUser();
        $this->load->view('page/v_pegawai',$data);
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }

  function pending(){
      $data['query'] = $this->page_model->getAllPending();
      $this->load->view('page/v_pending',$data);
  }
}
