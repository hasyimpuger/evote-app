<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('evoting_lib');
        
    }

    public function login()
    {

        if($this->evoting_lib->logged_in())
        {
            redirect(site_url('vote'), 'refresh');
        }

        $data['title'] = 'Login to Election System';

        $this->form_validation->set_rules('nis', 'NIS', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if($this->token_login($this->input->post('nis')))
            {
                redirect(site_url('vote'), 'refresh');
            } else {
                $this->session->set_flashdata('message', '<p>NIS Anda Salah</p>');
                redirect(site_url('login'), 'refresh');
            }
        } else {
            $id_class = $this->db->get('temp')->row();
            $data['nama_kelas'] = $this->db->where('class_id', $id_class->class_id)->get('classes')->row();
            $data['loginPage'] = TRUE;
            $this->load->view('public/required/header', $data);
            $this->load->view('public/auth/login', $data);
            $this->load->view('public/required/footer', $data);
        }
    }

    public function admin_login()
    {
        
        if($this->evoting_lib->logged_in())
        {
            redirect(site_url('vote'), 'refresh');
        }

        $data['title'] = 'Login to Election System';

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if($this->user_model->login($this->input->post('username'), $this->input->post('password')))
            {
                redirect(site_url('private/dashboard'), 'refresh');
            } else {
                $this->session->set_flashdata('message', '<p>Bruteforce Plz</p>');
                redirect(site_url('backdoor'), 'refresh');
            }
        } else {
            $this->load->view('public/required/header', $data);
            $this->load->view('public/auth/admin_login', $data);
            $this->load->view('public/required/footer', $data);
        }
    }

    private function token_login($username = null)
    {
        $user = $this->db->where('nis', $username)->get('users')->row();
        $kelas = $this->db->where(array('id' => 1))->get('temp')->row();
        if($user) {
            if($user->class_id == $kelas->class_id){
                // if ($user->active == 0)
                // {
                //     return FALSE;
                // }

                $this->user_model->set_session($user);
                return TRUE;
            }
        }
    }

    public function logout()
    {
        if(!$this->evoting_lib->logged_in())
        {
            redirect(site_url('login'), 'refresh');
        }

        $this->session->unset_userdata(array('username', 'id', 'user_id'));
        $this->session->sess_destroy();
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            session_start();
        }

        $this->session->sess_regenerate(TRUE);
        redirect(site_url('home'), 'refresh');
    }
}