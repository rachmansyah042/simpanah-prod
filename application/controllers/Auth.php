<?php

class Auth extends CI_Controller {
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
        // $this->_module = 'Auth';
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
    
    // post function
    public function post_func($url,$passData){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($passData));
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
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

    public function put_func_wotoken($url,$passData){
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Admin_trv/login','refresh');
        // }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($passData));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        curl_close($ch);
        // print_r($content);
        return $content;  
    }

    public function put_func_activated($url){
        // if ($this->session->userdata('logged_in')!=TRUE) {
        //     redirect('Admin_trv/login','refresh');
        // }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        $content =curl_exec($ch);
        curl_close($ch);
        // print_r($content);
        return $content;  
    }

    public function login() 
    {

        // form validation

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email Tidak Boleh Kosong', 'valid_email' => 'Email Tidak Valid'
        ]);
      
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'Password Tidak Boleh Kosong', 'min_length' => 'Password Minimal 8 Karakter'
        ]);

        if($this->form_validation->run() == false) {
             
        $name = ''; 
        $role = 0;
        // $name = $this->session->userdata('name');
        $data['name'] = $name;
        $data['role'] = $role;
            
        $this->load->view('templates/header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/footer'); 
        } else {
  
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $fcmtoken = 'false';
            $passData=array('email'=>$email,'password'=>$password, 'fcmtoken'=>$fcmtoken );
            $url = 'https://simpanah.com:3000/v1/user/login';

            $response = json_decode($this->post_func($url, $passData));

            // var_dump($response->data->notif);
            if($response->status == 200) {
                
                $token = $response->data->token;
                $name = $response->data->name;
                $role = $response->data->role;
                $count_notif = $response->data->notif;
                $sess_data = array('save_token' => $token, 'name' => $name, 'role'=> $role, 'count_notif' =>$count_notif);
                $this->session->set_userdata($sess_data); 
                // var_dump($this->session->userdata());

                // print_r($role);
                // $this->session->set_flashdata('success','Login Berhasil');
                if ($role == 1) {
                    redirect('Subsie','refresh');
                } else {
                    redirect('Home','refresh');
                }

            } 
            
            else if ($response->status == 403) { 


                $this->session->set_flashdata('aktivasi','<div class="alert alert-success" role="alert">
                Silahkan cek Email dan Aktivasi Akun Anda !
                </div>');

                redirect('Auth/login','refresh');


            }
            
            else {
                
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Email / Password Salah !
                </div>');
                redirect('Auth/login','refresh');
            }
        }
        
    }

    public function activate_account($tkn) 
    {

        $data['params'] = $tkn;
        $url = 'https://simpanah.com:3000/v1/user/active/'.$tkn;

        $active = json_decode($this->put_func_activated($url));

        // print_r($active);

        if ($active->status == 200 || $active->status == 201) {

            $this->session->set_flashdata('active_account','<div class="alert alert-success" role="alert">
            Akun Anda Sudah Aktif, Silahkan Login !
            </div>');

        }
        
        else if ($active->status == 400) {
            
            $this->session->set_flashdata('expired','<div class="alert alert-danger" role="alert">
            Link Sudah Kadaluarsa !
            </div>');
        }

        // form validation

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email Tidak Boleh Kosong', 'valid_email' => 'Email Tidak Valid'
        ]);
      
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'Password Tidak Boleh Kosong', 'min_length' => 'Password Minimal 8 Karakter'
        ]);

        if($this->form_validation->run() == false) {
             
        $name = '';
        $role = 0;
        // $name = $this->session->userdata('name');
        $data['name'] = $name;
        $data['role'] = $role;
            
        $this->load->view('templates/header', $data);
        $this->load->view('auth/activate_account', $data);
        $this->load->view('templates/footer');
        } else {
  
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $passData=array('email'=>$email,'password'=>$password );
            $url = 'https://simpanah.com:3000/v1/user/login';

            $response = json_decode($this->post_func($url, $passData));

            // var_dump($response->status);
            if($response->status == 200) {
                
                $token = $response->data->token;
                $name = $response->data->name;
                $role = $response->data->role;
                $sess_data = array('save_token' => $token, 'name' => $name, 'role'=> $role);
                $this->session->set_userdata($sess_data); 
                // var_dump($this->session->userdata());

                // print_r($role);
                // $this->session->set_flashdata('success','Login Berhasil');
                if ($role == 1) {
                    redirect('Subsie','refresh');
                } else {
                    redirect('Home','refresh');
                }

            } 
            
            else if ($response->status == 403) {


                $this->session->set_flashdata('aktivasi','<div class="alert alert-success" role="alert">
                Silahkan cek Email dan Aktivasi Akun Anda !
                </div>');
                
                redirect('Auth/activate_account','refresh');


            }
            
            else {
                
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Email / Password Salah !
                </div>');
                redirect('Auth/login','refresh');
            }
        }
        
    }

    public function register() 
    {
        // form validation

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email Tidak Boleh Kosong', 'valid_email' => 'Email Tidak Valid'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'Password Tidak Boleh Kosong', 'min_length' => 'Password Minimal 8 Karakter'
        ]);

        if($this->form_validation->run() == false) {
            
            $name = '';
            $data['role'] = 0;
            // $name = $this->session->userdata('name');
            $data['name'] = $name;

            $this->load->view('templates/header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('templates/footer');
        } else {

            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $passData=array('name'=>$name,'email'=>$email, 'username'=>$username,'password'=>$password );
            $url = 'https://simpanah.com:3000/v1/user/register';

            $response = json_decode($this->post_func($url, $passData));

            // var_dump($response->status);
            
            if ($response->status == 200) 
            {

                $this->session->set_flashdata('done','<div class="alert alert-success" role="alert">
                Silahkan Cek Email Untuk Aktivasi Akun !
                </div>');
                redirect('Auth/Register','refresh');
                print_r($response);

            } 
            
            else if($response->status == 400)
            
            {

                $this->session->set_flashdata('sudahdaftar','<div class="alert alert-danger" role="alert">
                Email / Password Sudah Terdaftar !
                </div>');

                redirect('Auth/Register','refresh');
                print_r($response);

            }

            else 
            {

                $this->session->set_flashdata('salah','<div class="alert alert-danger" role="alert">
                Email / Password Salah !
                </div>');

                redirect('Auth/Register','refresh');
                 print_r($response);

            }
        }

    }

    public function change_password() 
    {

        // form validation

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Tidak Boleh Kosong'
        ]);
      
        $this->form_validation->set_rules('new_password', 'New_Password', 'required|trim|min_length[8]', [
            'required' => 'Password Tidak Boleh Kosong', 'min_length' => 'Password Minimal 8 Karakter'
        ]);

        if($this->form_validation->run() == false) {
             
        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;
            
        $this->load->view('templates/header', $data);
        $this->load->view('auth/change_password');
        $this->load->view('templates/footer');
        } else {
  
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $token['use_token']='Authorization: Bearer '.$use_token;

            $password=$this->input->post('password');
            $new_password=$this->input->post('new_password');
            $passData=array('password'=>$password,'new_password'=>$new_password );
            $url = 'https://simpanah.com:3000/v1/user/change_password';

            // var_dump($passData);
            $response = json_decode($this->put_func($url, $passData, $token));

            // var_dump($response);
            if($response->iserror == false) {
                
                // $token = $response->data->token;
                // $name = $response->data->name;
                // $role = $response->data->role;
                // $sess_data = array('save_token' => $token, 'name' => $name, 'role'=> $role);
                // $this->session->set_userdata($sess_data); 
                
                redirect('Auth/login','refresh');

            } else {
                
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Email / Password Salah !
                </div>');
                redirect('Auth/change_password','refresh');
            }
        }
        
    }

    public function forgot_password() 
    {

        // form validation

        $this->form_validation->set_rules('email', 'Email', 'required|trim', [
            'required' => 'Email Tidak Boleh Kosong'
        ]);
      

        if($this->form_validation->run() == false) {
             
        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;
            
        $this->load->view('templates/header', $data);
        $this->load->view('auth/forgot_password');
        $this->load->view('templates/footer');
        } else {
  
            header("Access-Control-Allow-Origin: *");
            $use_token 	= $this->session->userdata('save_token');
            $token['use_token']='Authorization: Bearer '.$use_token;

            $email=$this->input->post('email');
            $passData=array('email'=>$email);
            $url = 'https://simpanah.com:3000/v1/user/forgot_password';

            // var_dump($passData);
            $response = json_decode($this->put_func($url, $passData, $token));

            // var_dump($response);
            if($response->iserror == false) {
                
                // $token = $response->data->token;
                // $name = $response->data->name;
                // $role = $response->data->role;
                // $sess_data = array('save_token' => $token, 'name' => $name, 'role'=> $role);
                // $this->session->set_userdata($sess_data); 

                $this->session->set_flashdata('success','<div class="alert alert-success" role="alert">
                Silahkan Cek Email Anda untuk Mendapatkan Link Ganti Password
                </div>');
                
                redirect('Auth/forgot_password','refresh');

            } else {
                
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Email Salah !
                </div>');
                redirect('Auth/forgot_password','refresh');
            }
        }

    }

    public function lupa_password($x) 
    {
        $data['params'] = $x;
        // get email and token

         $url = 'https://simpanah.com:3000/v1/user/reset/'.$x;
         $output = $this->get_func_wotoken($url);

         $data['email'] = $output->data->email;
         $data['new_token'] = $output->data->token;

        // form validation

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required' => 'Password Tidak Boleh Kosong', 'min_length' => 'Password Minimal 8 Karakter'
        ]);
      

        if($this->form_validation->run() == false) {
             
        $name = '';
        $role = 0;
        $name = $this->session->userdata('name');
        $count_notif = $this->session->userdata('count_notif');
        $data['count_notif'] = $count_notif;
        $data['name'] = $name;
        $data['role'] = $role;
            
        $this->load->view('templates/header', $data);
        $this->load->view('auth/lupa_password', $data);
        $this->load->view('templates/footer');
        } else {
  
            $password=$this->input->post('password');
            $passData=array('email'=>$data['email'], 'token'=>$data['new_token'], 'password'=>$password);
            $url = 'https://simpanah.com:3000/v1/user/save_reset_password';

            // var_dump($passData);
            $response = json_decode($this->put_func_wotoken($url, $passData));

            // var_dump($response);
            if($response->iserror == false) {
                
                // $token = $response->data->token;
                // $name = $response->data->name;
                // $role = $response->data->role;
                // $sess_data = array('save_token' => $token, 'name' => $name, 'role'=> $role);
                // $this->session->set_userdata($sess_data); 

                redirect('Auth/login','refresh');

            } else {
                
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Email Salah !
                </div>');
                redirect('Auth/lupa_password','refresh');
            }
        }

    }

    public function logout()
    {
        $sess_data = array('name','save_token','role');
        $this->session->unset_userdata($sess_data);
        redirect('Home', 'refresh');
    }
}