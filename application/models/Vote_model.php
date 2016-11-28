<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vote_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'votes';
        $this->primary_key = 'id';
        $this->soft_deletes = false;
        $this->has_one['user'] = array('User_model','id','user_id');
        $this->has_one['candidate'] = array('Candidate_model','id','nominee_id');
        parent::__construct();
    }
}