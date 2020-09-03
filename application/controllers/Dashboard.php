<?php

class Dashboard extends CI_Controller {

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

    
    public function post_func($url,$passData,$token){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($passData));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    public function index()
    {

        if( $this->session->userdata('save_token') ==TRUE) {

            // get wait complaint
         header("Access-Control-Allow-Origin: *");
         $use_token 	= $this->session->userdata('save_token');
         $data['token'] = $use_token;
         $token['use_token']='Authorization: Bearer '.$use_token;

         // $status = 'wait'
         $url = 'https://simpanah.com:3000/v1/complaint/list?status=wait';
         $output = $this->get_func($url, $token);
         $data['wait'] = $output->data;

         // status history
         $urls = 'https://simpanah.com:3000/v1/complaint/list?status=history';
         $output_his = $this->get_func($urls, $token);
         $data['history'] = $output_his->data;
            

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


        //konfigurasi pagination wait
        $config['base_url'] = base_url('Dashboard/index'); //site url
        $config['total_rows'] = count($data['wait']); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = $this->uri->segment(3);  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        // data pagination wait
        $data['wait'] = array_slice($output->data, $config["uri_segment"],$config['per_page']);
 
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

        // history pagination

         //konfigurasi pagination history
         $config_pageination['base_url'] = base_url('Dashboard/index'); //site url
         $config_pageination['total_rows'] = count($data['history']); //total row
         $config_pageination['per_page'] = 3;  //show record per halaman
         $config_pageination["uri_segment"] = $this->uri->segment(3);  // uri parameter
         $choice = $config_pageination["total_rows"] / $config_pageination["per_page"];
         $config_pageination["num_links"] = 3;
 
         // data pagination history
         $data['history'] = array_slice($output_his->data, $config_pageination["uri_segment"],$config_pageination['per_page']);
  
         // Membuat Style pagination untuk BootStrap v4
         $config_pageination['first_link']       = 'First';
         $config_pageination['last_link']        = 'Last';
         $config_pageination['next_link']        = '&raquo;';
         $config_pageination['prev_link']        = '&laquo;';
         $config_pageination['full_tag_open']    = '<div class="pagination justify-content-end mt-reply-pag"><nav aria-label="Page navigation example"><ul class="pagination">';
         $config_pageination['full_tag_close']   = '</ul></nav></div>';
         $config_pageination['num_tag_open']     = '<li class="page-item" ><span class="page-link"> ';
         $config_pageination['num_tag_close']    = '</span></li>';
         $config_pageination['cur_tag_open']     = '<li class="page-item active" ><span class="page-link">';
         $config_pageination['cur_tag_close']    = '</span></li>';
         $config_pageination['next_tag_open']    = '<li class="page-item" ><span class="page-link">';
         $config_pageination['next_tagl_close']  = '</span></li>';
         $config_pageination['prev_tag_open']    = '<li class="page-item" ><span class="page-link">';
         $config_pageination['prev_tagl_close']  = '</span></li>';
         $config_pageination['first_tag_open']   = '<li class="page-item" ><span class="page-link">';
         $config_pageination['first_tagl_close'] = '</span></li>';
         $config_pageination['last_tag_open']    = '<li class="page-item" ><span class="page-link">';
         $config_pageination['last_tagl_close']  = '</span></li>';
  
         $this->pagination->initialize($config_pageination);
         $data['page_history'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['pagination_history'] = $this->pagination->create_links();

     
         $this->load->view('templates/header', $data);
         $this->load->view('dashboard/index', $data);
         $this->load->view('templates/footer');

        } else {
            redirect('Auth/login','refresh');
        }

    }
}