<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller
{
    private $data = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('evoting_lib');

        $this->load->model('candidate_model');

        if(!$this->evoting_lib->logged_in() || !$this->evoting_lib->is_admin())
        {
            return show_error('Anda tidak memiliki akses untuk melihat halaman ini.');
        }

        $this->data['title'] = 'Candidates';
        $this->data['user'] = $this->evoting_lib->user();
        $this->data['message'] = $this->session->flashdata('message');
    }

    public function index($offset = NULL)
    {
        $this->load->library('pagination');
        
        $data['query'] = urldecode($this->input->get('name'));

        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $offset = ($this->uri->segment(4)  == NULL) ? 0 : ($this->uri->segment(4) * $config['per_page']) - $config['per_page'];

        if($data['query'])
        {
            $config['base_url'] = site_url('private/candidate/index?username=' . urlencode($data['query']));
            $config['total_rows'] = $this->candidate_model->where(array('name', $data['query']))->count_rows();
            $data['candidates'] = $this->candidate_model->where('name', $data['query'])->limit($config['per_page'], $offset)->get_all();
        } else {
            $config['base_url'] = site_url('private/candidate/index');
            $config['total_rows'] = $this->candidate_model->count_rows();
            $data['candidates'] = $this->candidate_model->limit($config['per_page'], $offset)->get_all();
        }

        $this->pagination->initialize($config);
        $this->_render('candidate/index', $data);
    }

    public function create()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('vission', 'Vission', 'trim|required');
        $this->form_validation->set_rules('mission', 'Mission', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $fileName = time(). '_' .$_FILES['photo']['name'];
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']  = '500';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['file_name'] = $fileName;
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('photo')){
                $error = array('error' => $this->upload->display_errors());
                echo json_encode(array('error' => true, 'message' => $error));
            } else{
                $media = $this->upload->data();

                $insert_data = array(
                    'name' => $this->input->post('name'),
                    'photo' => $media['file_name'],
                    'vission' => $this->input->post('vission'),
                    'mission' => $this->input->post('mission')
                    );
                $insert = $this->candidate_model->insert($insert_data);
                $this->_set_flash_message('Success', 'Candidate created.', 'success');
                redirect(site_url('private/candidate'), 'refresh');
            }
        } else {
            $this->_set_flash_message('Ops', validation_errors(), 'danger');
            redirect(site_url('private/candidate'), 'refresh');
        }
    }

    public function view()
    {
        
    }

    public function update()
    {
        
    }

    public function delete($id = NULL)
    {
        $check = $this->candidate_model->get($id);
        if(!$check || !$id || !is_numeric($id))
        {
            show_404();
            return false;
        }

        unlink('./uploads/images/' . $check->photo);

        $delete = $this->candidate_model->delete($id);
        $this->_set_flash_message('Success', 'Candidate deleted', 'success');
        redirect(site_url('private/candidate'), 'refresh');
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