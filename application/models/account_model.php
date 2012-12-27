<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function check_user($username, $password, $position) {
        $user = $this->db->get_where('account', array('username' => $username, 'password' => $password, 'position' => $position));
        if($user->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function attach($adviserID, $questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('adviser'=>$adviserID));
    }
    public function deattach($adviserID, $questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('adviser'=>null));
    }
    public function get_user_info($username) {
        return $this->db->get_where('account', array('username' => $username));
    }
    public function get_user_by_id($id) {
        return $this->db->get_where('account', array('id' => $id));
    }
}