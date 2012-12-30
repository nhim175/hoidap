<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function insert($content, $account_id, $box=1) {
        $this->db->insert('chat', array('content' => $content, 'account_id' => $account_id, 'box' => $box));
    }
    public function get_chat($box, $limit, $offset) {
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->join('account', 'account.id = chat.account_id');
        $this->db->where('active', 1);
        $this->db->where('box', $box);
        $this->db->order_by('chat.id', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get();
    }
    public function reset() {
        $this->db->update('chat', array('active' => 0));
    }
}