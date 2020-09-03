<?php

class Reply extends CI_Controller {

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

    public function put_func($url,$passData,$token){
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Admin_trv/login','refresh');
        // }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($passData));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        curl_close($ch);
        // print_r($content);
        return $content;  
    }


    public function index()
    {
        if( $this->session->userdata('save_token') ==TRUE) { 

            
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $data['token'] = $use_token;
            $token['use_token']='Authorization: Bearer '.$use_token;

            // status history
            $url = 'https://simpanah.com:3000/v1/complaint/list?status=history';
            $output = $this->get_func($url, $token);

            
            $data['reply'] =$output->data;
            // var_dump( $data['reply']);

            // get notif
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $data['token'] = $use_token;
            $token['use_token']='Authorization: Bearer '.$use_token;
   
            $url = 'https://simpanah.com:3000/v1/user/notification';
            $result = $this->get_func($url, $token);
            
           //  session notif
            $notif =$result->data;
            // print_r($notif);
            $sess_data_notif = array('data_notif' => $notif);
            $this->session->set_userdata($sess_data_notif); 
            $data['notification'] = $this->session->userdata('data_notif');


            $name = '';
            $role = 0;
            $name = $this->session->userdata('name');
            $role = $this->session->userdata('role');
            $data['photo'] = $this->session->userdata('photo');
            $data['notification'] = $this->session->userdata('data_notif');
            $count_notif = $this->session->userdata('count_notif');
            $data['count_notif'] = $count_notif;
            $data['name'] = $name;
            $data['role'] = $role;


            
        //konfigurasi pagination
        $config['base_url'] = base_url('Reply/index'); //site url
        $config['total_rows'] = count($data['reply']); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = $this->uri->segment(3);  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        $data['reply'] = array_slice($output->data, $config["uri_segment"],$config['per_page']);

 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '&raquo;';
        $config['prev_link']        = '&laquo;';
        $config['full_tag_open']    = '<div class="pagination justify-content-end mt-reply-pag"><nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item" ><span class="page-link"> ';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active" ><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li class="page-item" ><span class="page-link">';
        $config['next_tagl_close']  = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item" ><span class="page-link">';
        $config['prev_tagl_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item" ><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item" ><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        $data['pagination'] = $this->pagination->create_links();


        
            $this->load->view('templates/header', $data);
            $this->load->view('reply/index', $data);
            $this->load->view('templates/footer');

        }

        else {
            redirect('Auth/login','refresh');
        } 

    }
}