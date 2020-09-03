<?php

class Home extends CI_Controller {

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

    public function get_func_wotoken($url){
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Admin_trv/login','refresh');
        // }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        $gets = json_decode($content);
        return $gets;
    
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

    public function post_nodata_func($url,$token){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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

        // get timeline
        $url = 'https://simpanah.com:3000/v1/get/timeline';
        $ress = $this->get_func_wotoken($url);
        $data['timeline'] = $ress->data;
        // print_r($ress);

        // get notif
        if($this->session->userdata('save_token') ==TRUE) {

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

            // get profile

            $url = 'https://simpanah.com:3000/v1/user/profile';
            $output = $this->get_func($url, $token);

            // print_r($output);
            $data['photo'] = $output->data->photo;

            $sess_data = array('photo' => $data['photo']);
            $this->session->set_userdata($sess_data);

            // print_r($this->session->userdata('photo'));

        }


        // header change
        $name = '';
        $name = $this->session->userdata('name');
        $role = $this->session->userdata('role');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function post_complaint() {

        if( $this->session->userdata('save_token') ==TRUE) {
            
            // post complaint
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $token['use_token']='Authorization: Bearer '.$use_token;

            $title=$this->input->post('title');
            $complaint=$this->input->post('complaint');
            // $category=$this->input->post('category'); 
            $complaint_from=0;

            $passData=array('title'=>$title,'complaint'=>$complaint, 'complaint_from'=>$complaint_from);
            // print_r($passData);
            $url = 'https://simpanah.com:3000/v1/complaint/add';

            $response = json_decode($this->post_func($url, $passData, $token));
            // redirect('Home','refresh');
            // print_r($response);

            if($response->status == 200) {
                
                $this->session->set_flashdata('success','<div class="bg-popup modal-exit"> </div>
                <div class="popup-coba modal-exit"> 
                    <p class="tittle-modal-aduan"> Pengaduan Terkirim ! </p>
                    <div class="text-modal-aduan"> Silahkan pantau selalu perkembangan pengaduan melalui menu
                            akun Anda pada bagian “Balasan Pengaduan” 
                    </div>
                    <button class="btn-modal-aduan" id="close-modal-aduan">Oke</button>
                </div>');

                redirect('Home','refresh');

            } else {
                redirect('Home','refresh');
            }

        }
        
        else {
            redirect('Auth/login','refresh');
        }
    }

    public function read_notification() {

        if( $this->session->userdata('save_token') ==TRUE) {
            
            // post complaint
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $token['use_token']='Authorization: Bearer '.$use_token;

            $id_notification=$this->input->post('id_notif');
            $direction_notif=$this->input->post('direction_notif');

            $passData=array('id_notification'=>$id_notification);
            // print_r($direction_notif);
            // redirect($direction_notif);
            $url = 'https://simpanah.com:3000/v1/user/read_notification ';

            $response = json_decode($this->put_func($url, $passData, $token));
            // print_r($response);

            if($response->status == 200) {

                header("Access-Control-Allow-Origin: *");
                $use_token 	= $this->session->userdata('save_token');
                $data['token'] = $use_token;
                $token['use_token']='Authorization: Bearer '.$use_token;
    
                $url = 'https://simpanah.com:3000/v1/user/notification_count';
                $result = $this->get_func($url, $token);

                $count_notif = $result->data->notification;;
                $sess_data = array('count_notif' =>$count_notif);
                $this->session->set_userdata($sess_data); 

                
                // redirect('Home','refresh');
                redirect($direction_notif);

                // print_r($result);

            }

        }
        
        else {
            redirect('Auth/login','refresh');
        }
    }

    public function del_all() {

        if( $this->session->userdata('save_token') ==TRUE) {
            
            // post complaint
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $token['use_token']='Authorization: Bearer '.$use_token;

            $url = 'https://simpanah.com:3000/v1/user/delete_all_notification';

            $response = json_decode($this->post_nodata_func($url, $token));
            
            
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $data['token'] = $use_token;
            $token['use_token']='Authorization: Bearer '.$use_token;

            $url = 'https://simpanah.com:3000/v1/user/notification_count';
            $result = $this->get_func($url, $token);

            $count_notif = $result->data->notification;;
            $sess_data = array('count_notif' =>$count_notif);
            $this->session->set_userdata($sess_data); 

            redirect('Home','refresh');

        }
        
        else {
            redirect('Auth/login','refresh');
        }
    }

}