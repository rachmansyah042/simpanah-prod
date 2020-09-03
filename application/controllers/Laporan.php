<?php

class Laporan extends CI_Controller {

    public function index() 
    {
        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $data['name'] = $name;
        $data['role'] = $role;
        $data['judul'] = 'Halaman Laporan';
        
        $this->load->view('templates/header', $data);
        $this->load->view('laporan/index');
        $this->load->view('templates/footer');
    }

}