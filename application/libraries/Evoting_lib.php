<?php

/*
  Auth library
  Author: katonsa
 */

class Evoting_lib
{
    
    function __construct()
    {
        $this->load->model('user_model');
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function logged_in()
    {
        return (bool) $this->session->userdata('username');
    }

    public function user()
    {
        $user = $this->user_model->get($this->session->userdata('user_id'));
        return $user;
    }

    public function is_admin()
    {
        $user = $this->user_model->get($this->session->userdata('user_id'));
        if($user->role_id != 1)
        {
            return FALSE;
        }

        return TRUE;
    }
}