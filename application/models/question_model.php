<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Question_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_all_chosen_questions() {
        $this->db->select('question.*, account.name as adviser_name');
        $this->db->from('question');
        $this->db->join('account','question.adviser = account.id');
        $this->db->where('question.active', 1);
        $this->db->where('question.status', 1); //1 là chua tr? l?i, 2 là dã dc tr? l?i
        return $this->db->get();
    }
    public function get_question_by_adviser($account_id) {
        $this->db->select('question.*, account.name as adviser_name');
        $this->db->from('question');
        $this->db->join('account','question.adviser = account.id');
        $this->db->where('account.id', $account_id);
        $this->db->where('question.active', 1);
        $this->db->where('question.status', 1); //1 là chua tr? l?i, 2 là dã dc tr? l?i
        return $this->db->get();
    }
    public function get_all_unchosen_questions() {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('adviser', null);
        $this->db->where('question.active', 1);
        $this->db->where('question.status', 1); //1 là chua tr? l?i, 2 là dã dc tr? l?i
        $this->db->order_by('question.date', 'desc');
        return $this->db->get();
    }
    public function get_unchosen_questions_by_adviser_id($adviserID) {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('adviser', null);
        $this->db->where('question.active', 1);
        $this->db->where('question.status', 1); //1 là chua tr? l?i, 2 là dã dc tr? l?i
        $this->db->where('for', $adviserID);
        $this->db->order_by('question.date', 'desc');
        return $this->db->get();
    }
    public function solve($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('status'=>'2'));
    }
    public function unsolve($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('status'=>'1'));
    }
    public function upload($question, $for) {
        $this->db->insert('question', array('content'=>$question, 'for' => $for));
    }
    public function answer_later($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('later' => 1));
    }
    public function answer_now($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('later' => 0));
    }
    public function answer_next($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('status' => 3));
    }
    public function get_answered_question() {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('status', 2);        
        $this->db->where('active', 1);
        return $this->db->get();
    }
    public function remove($questionID) {
        $this->db->where('id', $questionID);
        $this->db->update('question', array('active' => 0));
    }
    public function get_next_questions() {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('status', 3);
        $this->db->where('active', 1);
        return $this->db->get();
    }
    public function reset() {
        $this->db->update('question', array('active' => 0));
    }
}
