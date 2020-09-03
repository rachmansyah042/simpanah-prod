<?php

class Subsie extends CI_Controller {

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
        // $this->_module = 'Home  ';
        $this->load->helper('path');
    }

    public function get_func($url,$token){
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Admin_trv/login','refresh');
        // }
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
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Auth/register','refresh');
        // }
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

    public function index() {

        if( $this->session->userdata('role') == 1) {  


        // get list unanswered
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['token'] = $use_token;
        $token['use_token']='Authorization: Bearer '.$use_token;
        $url = 'https://simpanah.com:3000/v1/subsie/list_complaint?status=unanswered';

        $output_unanswered = $this->get_func($url, $token);
        $data['subsie_list'] = $output_unanswered->data;
        // print_r($data['subsie_list']);


        // unanswered pagination

         //konfigurasi pagination unanswered
         $config_pageination['base_url'] = base_url('Subsie/index'); //site url
         $config_pageination['total_rows'] = count($data['subsie_list']); //total row
         $config_pageination['per_page'] = 3;  //show record per halaman
         $config_pageination["uri_segment"] = $this->uri->segment(3);  // uri parameter
         $choice = $config_pageination["total_rows"] / $config_pageination["per_page"];
         $config_pageination["num_links"] = 3;
 
         // data pagination history
         $data['subsie_list'] = array_slice($output_unanswered->data, $config_pageination["uri_segment"],$config_pageination['per_page']);
  
        //  Membuat Style pagination untuk BootStrap v4
         $config_pageination['first_link']       = 'First';
         $config_pageination['last_link']        = 'Last';
         $config_pageination['next_link']        = '&raquo;';
         $config_pageination['prev_link']        = '&laquo;';
         $config_pageination['full_tag_open']    = '<div class="pagination justify-content-end mt-reply-pag"><nav aria-label="Page navigation example"><ul class="pagination">';
         $config_pageination['full_tag_close']   = '</ul></nav></div>';
         $config_pageination['num_tag_open']     = '<li class="page-item sub" ><span class="page-link"> ';
         $config_pageination['num_tag_close']    = '</span></li>';
         $config_pageination['cur_tag_open']     = '<li class="page-item sub active" ><span class="page-link">';
         $config_pageination['cur_tag_close']    = '</span></li>';
         $config_pageination['next_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config_pageination['next_tagl_close']  = '</span></li>';
         $config_pageination['prev_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config_pageination['prev_tagl_close']  = '</span></li>';
         $config_pageination['first_tag_open']   = '<li class="page-item sub" ><span class="page-link">';
         $config_pageination['first_tagl_close'] = '</span></li>';
         $config_pageination['last_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config_pageination['last_tagl_close']  = '</span></li>';
  
         $this->pagination->initialize($config_pageination);
         $data['page_history'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['pagination_unanswered'] = $this->pagination->create_links();


        // get list answered
        $url = 'https://simpanah.com:3000/v1/subsie/list_complaint?status=answered';

        $output = $this->get_func($url, $token);
        $data['subsie_list_answered'] = $output->data;
        // print_r($data['subsie_list_answered']);

        $url = 'https://simpanah.com:3000/v1/user/notification';
        $result = $this->get_func($url, $token);
        
        //  session notif
        $notif = $result->data;
        $sess_data_notif = array('data_notif' => $notif);
        $this->session->set_userdata($sess_data_notif); 
        $data['notification'] = $this->session->userdata('data_notif');
        // print_r($data['notification']);


        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;


         //konfigurasi pagination get list answered subsie
         $config['base_url'] = base_url('Subsie/index'); //site url
         $config['total_rows'] = count($data['subsie_list_answered']); //total row
         $config['per_page'] = 3;  //show record per halaman
         $config["uri_segment"] = $this->uri->segment(3);  // uri parameter
         $choice = $config["total_rows"] / $config["per_page"];
        //  $config["num_links"] = floor($choice);
         $config["num_links"] = 3;
 
         // data pagination get list answered subsie
         $data['subsie_list_answered'] = array_slice($output->data, $config["uri_segment"],$config['per_page']);
  
         // Membuat Style pagination untuk BootStrap v4
         $config['first_link']       = 'First';
         $config['last_link']        = 'Last';
         $config['next_link']        = '&raquo;';
         $config['prev_link']        = '&laquo;';
         $config['full_tag_open']    = '<div class="pagination justify-content-end mt-reply-pag"><nav aria-label="Page navigation example"><ul class="pagination">';
         $config['full_tag_close']   = '</ul></nav></div>';
         $config['num_tag_open']     = '<li class="page-item sub" ><span class="page-link"> ';
         $config['num_tag_close']    = '</span></li>';
         $config['cur_tag_open']     = '<li class="page-item sub active" ><span class="page-link">';
         $config['cur_tag_close']    = '</span></li>';
         $config['next_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config['next_tagl_close']  = '</span></li>';
         $config['prev_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config['prev_tagl_close']  = '</span></li>';
         $config['first_tag_open']   = '<li class="page-item sub" ><span class="page-link">';
         $config['first_tagl_close'] = '</span></li>';
         $config['last_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
         $config['last_tagl_close']  = '</span></li>';
  
         $this->pagination->initialize($config);
         $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['pagination'] = $this->pagination->create_links();

        

        $this->load->view('templates/header', $data);
        $this->load->view('subsie/index', $data);
        $this->load->view('templates/footer');
        
        };
    }

    public function reply() {

        if( $this->session->userdata('role') == 1) { 

        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $token['use_token']='Authorization: Bearer '.$use_token;
        $data['token'] = $use_token;

        // get list answered
        $url = 'https://simpanah.com:3000/v1/subsie/list_complaint?status=answered';

        $output = $this->get_func($url, $token);
        $data['subsie_reply_answered'] = $output->data;
        // print_r($data['subsie_reply_answered']);


        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;


        //konfigurasi pagination reply subsie
        $config['base_url'] = base_url('Subsie/reply'); //site url
        $config['total_rows'] = count($data['subsie_reply_answered']); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = $this->uri->segment(3);  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;

        // data pagination subsie_reply_answered
        $data['subsie_reply_answered'] = array_slice($output->data, $config["uri_segment"],$config['per_page']);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '&raquo;';
        $config['prev_link']        = '&laquo;';
        $config['full_tag_open']    = '<div class="pagination justify-content-end mt-reply-pag"><nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item sub" ><span class="page-link"> ';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item sub active" ><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
        $config['next_tagl_close']  = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
        $config['prev_tagl_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item sub" ><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item sub" ><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->pagination->create_links();


        $this->load->view('templates/header', $data);
        $this->load->view('subsie/reply',$data);
        $this->load->view('templates/footer');
        
        }
    }

    public function profile() {

        if( $this->session->userdata('role') == 1) { 

        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $data['notification'] = $this->session->userdata('data_notif');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;

        // get profile
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $token['use_token']='Authorization: Bearer '.$use_token;
        $url = 'https://simpanah.com:3000/v1/subsie/profile';

        $output = $this->get_func($url, $token);
        // print_r($output->data);
        $data['nama'] = $output->data->name;
        $data['email'] = $output->data->email; 
        $data['username'] = $output->data->username;

        // print_r($data['nama']);

        $this->load->view('templates/header', $data);
        $this->load->view('subsie/profile', $data);
        $this->load->view('templates/footer');

        }
    }

    public function changeProfileSubsie () {

        // put profile
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['use_token']='Authorization: Bearer '.$use_token;
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $urlPut = 'https://simpanah.com:3000/v1/subsie/profile';
        $passData=array('name'=>$name, 'email'=>$email, 'username'=>$username);
        
        // print_r($passData);

        $ubah = json_decode($this->put_func($urlPut, $passData, $data));
        $status = $ubah->status;
        // print_r($ubah);

        // change name of session
        $sess_data = array('name' => $name);
        $this->session->set_userdata($sess_data);

        if($status == 200) {
            redirect('Subsie/profile','refresh');
        }

    }

}