<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    private $data = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('evoting_lib');

        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

        if(!$this->evoting_lib->logged_in() || !$this->evoting_lib->is_admin())
        {
            return show_error('Anda tidak memiliki akses untuk melihat halaman ini.');
        }

        $this->data['title'] = 'Users';
        $this->data['user'] = $this->evoting_lib->user();
        $this->data['message'] = $this->session->flashdata('message');
    }

    public function index($offset = NULL)
    {
        $this->load->library('pagination');
        
        $data['query'] = urldecode($this->input->get('username'));

        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $offset = ($this->uri->segment(4)  == NULL) ? 0 : ($this->uri->segment(4) * $config['per_page']) - $config['per_page'];

        if($data['query'])
        {
            $config['base_url'] = site_url('private/user/index?username=' . urlencode($data['query']));
            $config['total_rows'] = $this->user_model->where(array('username', $data['query']))->count_rows();
            $data['users'] = $this->user_model->where('username', $data['query'])->limit($config['per_page'], $offset)->get_all();
        } else {
            $config['base_url'] = site_url('private/user/index');
            $config['total_rows'] = $this->user_model->count_rows();
            $data['users'] = $this->user_model->limit($config['per_page'], $offset)->get_all();
        }
        

        $this->pagination->initialize($config);
        $this->_render('user/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $insert_data = array(
                'role_id' => $this->input->post('role'),
                'username' => $this->input->post('username'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'password' => $this->user_model->hash_password($this->input->post('password')),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'active' => $this->input->post('status')
                );
            $insert = $this->user_model->insert($insert_data);
            echo json_encode(array('error' => false));
            $this->_set_flash_message('Success', 'User created.', 'success');
        } else {
            echo json_encode(array('error' => true, 'message' => $this->form_validation->error_array()));
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
        $check = $this->user_model->get($id);
        if(!$check || !$id || !is_numeric($id))
        {
            show_404();
            return false;
        }

        $delete = $this->user_model->delete($id);
        $this->_set_flash_message('Success', 'User deleted', 'success');
        redirect(site_url('private/user'), 'refresh');
    }

    public function upload_excel()
    {
        $fileName = time().$_FILES['file']['name'];
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = $fileName;
        $config['max_size']  = '10000';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else{
            $media = $this->upload->data();
            $inputFileName = './uploads/'.$media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++){
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);

                $data = array(
                    "role_id"=> $rowData[0][0],
                    "username"=> $rowData[0][1],
                    "password"=> $this->user_model->hash_password($rowData[0][2]),
                    "firstname"=> $rowData[0][3],
                    "lastname"=> $rowData[0][4],
                    "email"=> $rowData[0][5],
                    "phone"=> $rowData[0][6],
                    "active"=> $rowData[0][7],
                    "created_at" => date('Y-m-d H:i:s')
                    );

                $insert = $this->user_model->insert($data);

            }
            redirect(site_url('private/user'));
        }
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