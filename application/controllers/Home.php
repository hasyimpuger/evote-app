<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('evoting_lib');
        $this->data['user'] = $this->evoting_lib->user();
    }

    public function index()
    {
        /*if(!$this->evoting_lib->logged_in())
        {
            return show_error('Silahkan login untuk melihat halaman ini.');
        }*/

        $data['homeStart'] = TRUE;
        $data['title'] = 'OSIS 2016 Election System';
        $this->_render('home/index', $data);
    }

    private function _render($view, $data)
    {
        $data = ($data) ? array_merge($data, $this->data) : $this->data;
        $this->load->view('public/required/header', $data);
        $this->load->view('public/' . $view, $data);
        $this->load->view('public/required/footer', $data);
    }

}