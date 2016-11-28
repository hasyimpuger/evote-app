<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller
{

    private $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('evoting_lib');
        $this->load->model('vote_model');
        $this->data['user'] = $this->evoting_lib->user();
    }

    public function index()
    {
        if(!$this->evoting_lib->logged_in())
        {
            $this->session->set_flashdata('message', 'Silahkan login terlebih dahulu');
            redirect('login', 'refresh');
        }

        $votes = $this->db->where('user_id', $this->data['user']->id)->get('votes')->num_rows();
        if($votes > 0)
        {
            $data['title'] = 'Anda telah memilih';
            $data['redirect_5_seconds'] = TRUE;
            $this->_render('vote/already_voted', $data);
            return false;
        }

        $data['title'] = 'Vote';
        $data['kandidat_page'] = TRUE;
        $data['candidates'] = $this->db->get('candidates')->result();
        $this->_render('vote/vote', $data);
    }

    public function selected($uuid = null)
    {
                if(!$this->evoting_lib->logged_in())
        {
            $this->session->set_flashdata('message', 'Silahkan login terlebih dahulu');
            redirect('login', 'refresh');
        }

        $data['title'] = 'Select';
        $data['selectedPage'] = TRUE;
        $votes = $this->db->where('user_id', $this->data['user']->id)->get('votes')->num_rows();
        if($votes > 0)
        {
            $data['redirect_5_seconds'] = TRUE;
            $this->_render('vote/already_voted', $data);
            return false;
        }

        $data['candidate'] = $this->db->where(array('uuid' => $uuid))->get('candidates')->row();

        $this->form_validation->set_rules('uuid', 'uuid', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $insert = array(
                'nominee_id' => $data['candidate']->id,
                'user_id' => $this->data['user']->id,
                'saran' => $this->input->post('saran'),
                );

            $insert = $this->vote_model->insert($insert);
            redirect('vote/finish', 'refresh');
        } else {
            $this->_render('vote/select', $data);
        }
    }

    public function finish()
    {
                if(!$this->evoting_lib->logged_in())
        {
            $this->session->set_flashdata('message', 'Silahkan login terlebih dahulu');
            redirect('login', 'refresh');
        }
        
        $data['redirect_5_seconds'] = TRUE;
        $data['title'] = 'Finish';
        $this->_render('vote/finish', $data);
    }

    public function nominees()
    {
        
    }

    public function live_count()
    {
        $data['title'] = 'Live Count';
        $data['candidates'] = $this->db->get('candidates')->result();
        $data['votes_count'] = $this->db->get('votes')->num_rows();
        $data['siswa_count'] = $this->db->get('users')->num_rows();
        $data['live_count'] = TRUE;
        $data['votes'] = $this->db->where('saran != ""')->order_by('id', 'desc')->limit(10)->get('votes')->result();
        $this->_render('vote/live_count', $data);
    }


    public function table_count()
    {
        $data['title'] = 'Perolehan';
        $data['candidates'] = $this->db->get('candidates')->result();
        $data['votes_count'] = $this->db->get('votes')->num_rows();
        $data['siswa_count'] = $this->db->where('role_id !=  1 OR role_id = ')->get('users')->num_rows();
        $data['votes'] = $this->db->where('saran != ""')->order_by('id', 'desc')->limit(10)->get('votes')->result();
        $this->load->view('public/vote/table', $data);
    }

    public function comment_live()
    {
        $data['title'] = 'Komen';
        $data['votes'] = $this->db->where('saran != ""')->order_by('id', 'desc')->limit(10)->get('votes')->result();
        $this->load->view('public/vote/komen_live', $data);
    }

    public function ajax_count()
    {
        $tempData = [];
        $row = $this->db->get('candidates')->result();
        foreach ($row as $candidate) {
            $count = $this->db->where(array('nominee_id' => $candidate->id))->get('votes')->num_rows();
            $candidate = array('labels' => $candidate->name, 'data' => $count);
            array_push($tempData, $candidate);
        }

        // Suara Putih
        $count = $this->db->get('users')->num_rows();
        $total_vote_count = $this->db->get('votes')->num_rows();

        array_push($tempData, array('labels' => 'Belum / Tidak Memilih', 'data' => $count - $total_vote_count));

        echo json_encode(array('result' => $tempData));
    }

    private function _render($view, $data = NULL)
    {
        $data = ($data) ? array_merge($data, $this->data) : $this->data;
        $this->load->view('public/required/header', $data);
        $this->load->view('public/' . $view, $data);
        $this->load->view('public/required/footer', $data);
    }
}