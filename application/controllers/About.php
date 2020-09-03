<?php

class About extends CI_Controller {

    public function index() 
    {
        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;

        $this->load->view('templates/header', $data);
        $this->load->view('about/index');
        $this->load->view('templates/footer');
    }
}