<?php 

class Event extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('curl');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('upload');	
        $this->load->library('form_validation');	
	    $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('path');
             
    }

    public function get_func($url,$token){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        $gets = json_decode($content);
        return $gets;
    
    }

    public function index () 
    
    {

    if($this->session->userdata('save_token') ==TRUE) {

        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['token'] = $use_token;
        $token['use_token']='Authorization: Bearer '.$use_token;

        $url = 'https://simpanah.com:3000/v1/user/get_event';
        $result = $this->get_func($url, $token);
        $data['event'] = $result->data;
        // print_r($result);

        // get notif
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['token'] = $use_token;
        $token['use_token']='Authorization: Bearer '.$use_token;

        $url = 'https://simpanah.com:3000/v1/user/notification';
        $output = $this->get_func($url, $token);
        
       //  session notif
        $notif =$output->data;
        // print_r($notif);
        $sess_data_notif = array('data_notif' => $notif);
        $this->session->set_userdata($sess_data_notif); 
        $data['notification'] = $this->session->userdata('data_notif');

        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $data['photo'] = $this->session->userdata('photo');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;

        $this->load->view('templates/header', $data);
        $this->load->view('event/index');
        $this->load->view('templates/footer');

        }

    }

    public function detail_event () 
    {
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['token'] = $use_token;
        $token['use_token']='Authorization: Bearer '.$use_token;

        $id_event = $this->input->post('id_event'); 

        $url = 'https://simpanah.com:3000/v1/user/detail_event/' .$id_event;
        $result = $this->get_func($url, $token);
        $data['detail_event'] = $result->data;

        // print_r($result );

        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $data['photo'] = $this->session->userdata('photo');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;

        $this->load->view('templates/header', $data);
        $this->load->view('event/detail_event', $data);
        $this->load->view('templates/footer');
    }

}