<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller
{
    private $data = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('evoting_lib');

        $this->load->model('vote_model');

        if(!$this->evoting_lib->logged_in() || !$this->evoting_lib->is_admin())
        {
            return show_error('Anda tidak memiliki akses untuk melihat halaman ini.');
        }

        $this->data['title'] = 'Votes';
        $this->data['user'] = $this->evoting_lib->user();
        $this->data['message'] = $this->session->flashdata('message');
    }

    public function index($offset = NULL)
    {
        $this->load->library('pagination');
        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $offset = ($this->uri->segment(4)  == NULL) ? 0 : ($this->uri->segment(4) * $config['per_page']) - $config['per_page'];
        $config['base_url'] = site_url('private/vote/index');
        $config['total_rows'] = $this->vote_model->count_rows();
        $data['votes'] = $this->vote_model->with_user()->with_candidate()->limit($config['per_page'], $offset)->get_all();
    
        $this->pagination->initialize($config);
        $this->_render('vote/index', $data);
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