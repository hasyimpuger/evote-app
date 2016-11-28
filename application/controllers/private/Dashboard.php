<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $data = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('evoting_lib');

        if(!$this->evoting_lib->logged_in() || !$this->evoting_lib->is_admin())
        {
            return show_error('Anda tidak memiliki akses untuk melihat halaman ini.');
        }

        $this->data['title'] = 'Dashboard';
        $this->data['user'] = $this->evoting_lib->user();
        $this->data['message'] = $this->session->flashdata('message');
    }

    public function index()
    {
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $update = array(
                'class_id' => $this->input->post('kelas')
                );
            $update = $this->db->update('temp', $update);
            redirect('private/dashboard', 'refresh');
        } else {
            $kelas = [];
            $a_kelas  = $this->db->get('classes')->result();
            foreach ($a_kelas as $k) {
                $kelas[$k->class_id] = $k->class_name;    
            }

            $data['kelas'] = $kelas;
            $data['temp'] = $this->db->where('id', '1')->get('temp')->row();
            $this->_render('dashboard/index', $data);
        }
    }

    public function create()
    {
        
    }

    public function view()
    {
        
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }

    private function _set_flash_message($title, $body, $type)
    {
        return $this->session->set_flashdata('message', (object) array('type' => $type, 'title' => $title, 'body' => $body));
    }

    private function _render($view, $data = NULL)
    {
        $data = ($data) ? array_merge($data, $this->data) : $this->data;
        $this->load->view('private/required/header', $data);
        $this->load->view('private/' . $view, $data);
        $this->load->view('private/required/footer', $data);
    }

}