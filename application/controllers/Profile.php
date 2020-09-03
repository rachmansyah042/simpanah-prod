<?php

class Profile extends CI_Controller {
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

        // get profile
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['use_token']='Authorization: Bearer '.$use_token;
        $url = 'https://simpanah.com:3000/v1/user/profile';

        $output = $this->get_func($url, $data);
        $data['nama'] = $output->data->name;
        $data['email'] = $output->data->email;
        $data['username'] = $output->data->username;
        $data['photo'] = $output->data->photo;

        $sess_data = array('photo' => $data['photo']);
        $this->session->set_userdata($sess_data);
        
        // print_r($this->session->userdata('photo'));

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
        $this->load->view('profile-user/index', $data);
        $this->load->view('templates/footer');
    }

    public function changeProfile () {

        // put profile
        header("Access-Control-Allow-Origin: *");
        $use_token 	= $this->session->userdata('save_token');
        $data['use_token']='Authorization: Bearer '.$use_token;
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $urlPut = 'https://simpanah.com:3000/v1/user/profile';
        $passData=array('name'=>$name, 'email'=>$email, 'username'=>$username);
        

        // put photo profile
        $urlPut = 'https://simpanah.com:3000/v1/user/edit_photo_profile';
        $photo = $_FILES['image']['tmp_name'];
        $type = pathinfo($photo, PATHINFO_EXTENSION);
        $datas = file_get_contents($photo); 
        $base64 = base64_encode($datas);

        $photoData=array('photo'=>$base64);
        $ubahPhoto = json_decode($this->put_func($urlPut, $photoData, $data));

        // print_r($photoData);
        // print_r($ubahPhoto);

        $ubah = json_decode($this->put_func($urlPut, $passData, $data));
        $status = $ubah->status; 


        // change name of session
        $sess_data = array('name' => $name);
        $this->session->set_userdata($sess_data);
        

        if($status == 200) {
            redirect('Profile','refresh');
        }

    }

}