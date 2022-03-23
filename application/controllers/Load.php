<?php

class Load extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_kios');
    $this->load->model('M_admin');
    $this->load->model('M_mobilepulsa');

    $this->load->library('form_validation');
    if (!$this->session->userdata('username')) {
      redirect('Welcome/not_found');
    } elseif ($this->session->userdata('akses') == '1') {
      redirect('Welcome/not_found');
    }
  }

  public function index()
  {
    
  }
}
