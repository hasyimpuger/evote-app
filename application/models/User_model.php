<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'users';
        $this->primary_key = 'id';
        $this->soft_deletes = false;
        $this->has_one['role'] = array('Role_model','id','id');
        $this->has_one['vote'] = array('Vote_model','id','id');
        //$this->has_one['details'] = 'User_details_model';
        // $this->has_one['details'] = array('User_details_model','user_id','id');
        //$this->has_one['details'] = array('local_key'=>'id', 'foreign_key'=>'user_id', 'foreign_model'=>'User_details_model');
        //$this->has_many['posts'] = 'Post_model';

		parent::__construct();
	}

    public function login($username, $password)
    {
        $this->load->library('bcrypt');
        $user = $this->where('username', $username)->get();
        if($user) {
            $chk_password = $this->bcrypt->verify($password, $user->password);
            if ($chk_password === TRUE)
            {
                if ($user->active == 0)
                {
                    return FALSE;
                }

                $this->set_session($user);
                return TRUE;
            }
        }
    }

    public function hash_password($password)
    {
        $this->load->library('bcrypt');
        return $this->bcrypt->hash($password);
    }

    public function set_session($user)
    {
        $session_data = array(
            'user_id'              => $user->id,
            'username'             => ($user->nis) ? $user->nis : $user->username
        );
        $this->session->set_userdata($session_data);
        return TRUE;
    }
}