<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manager extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->model('question_model');
        $this->load->model('account_model');
        $this->load->model('chat_model');
    }
    public function index() {
        
        if(!$this->session->userdata('username')) {
            $data['page'] = 'manager';
            $data['error'] = false;
            $data['username_input'] = array('name' => 'username', 'id' => 'username');
            $data['password_input'] = array('name' => 'password', 'id' => 'password');
            $this->load->view('templates/header', $data);
            $this->load->view('manager_login', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['title'] = 'MC Homepage';
            $data['adviser1'] = $this->account_model->get_user_by_id(1)->row();
            $data['adviser2'] = $this->account_model->get_user_by_id(2)->row();
            $data['adviser3'] = $this->account_model->get_user_by_id(3)->row();
            $data['adviser1_questions'] = $this->question_model->get_question_by_adviser(1)->result();
            $data['adviser2_questions'] = $this->question_model->get_question_by_adviser(2)->result();
            $data['adviser3_questions'] = $this->question_model->get_question_by_adviser(3)->result();
            $data['unchosen_questions_arr'] = $this->question_model->get_all_unchosen_questions()->result();
            $data['answered_questions'] = $this->question_model->get_answered_question()->result();
            $data['chats'] = $this->chat_model->get_chat(20,0)->result();
            $this->load->view('templates/header', $data);
            $this->load->view('manager_index', $data);
            $this->load->view('templates/footer', $data);
        }
    }
    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $position = 'manager';
        if($this->account_model->check_user($username, $password, $position)) {
            $user = $this->account_model->get_user_info($username)->row();
            $this->session->set_userdata(array('username' => $username, 'position' => $position, 'name' => $user->name, 'userid' => $user->id));
        }
        redirect('thuky/index', 'refresh');
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('thuky/index', 'refresh');
    }
    public function solve() {
        if($this->session->userdata('username')) {            
            $questionID = $this->input->post('question');
            $this->question_model->solve($questionID);
        }        
    }
    public function unsolve() {
        if($this->session->userdata('username')) {            
            $questionID = $this->input->post('question');
            $this->question_model->unsolve($questionID);
        }        
    }
    public function ajax_load() {
        if($this->session->userdata('username')) {
            $data['adviser1'] = $this->account_model->get_user_by_id(1)->row();
            $data['adviser2'] = $this->account_model->get_user_by_id(2)->row();
            $data['adviser3'] = $this->account_model->get_user_by_id(3)->row();
            $data['adviser1_questions'] = $this->question_model->get_question_by_adviser(1)->result();
            $data['adviser2_questions'] = $this->question_model->get_question_by_adviser(2)->result();
            $data['adviser3_questions'] = $this->question_model->get_question_by_adviser(3)->result();
            $data['unchosen_questions_arr'] = $this->question_model->get_all_unchosen_questions()->result();
            $data['answered_questions'] = $this->question_model->get_answered_question()->result();
            $this->load->view('manager_ajax_index', $data);
        }
    }
    public function upload_question() {
        if($this->session->userdata('username')) {
            $question = $this->input->post('question');
            $this->question_model->upload($question);
        }
    }
    public function ajax_chat() {
        if($this->session->userdata('username')) {
            $data['chats'] = $this->chat_model->get_chat(20,0)->result();
            $this->load->view('manager_ajax_chat', $data);
        }
    }
    public function insert_chat() {
        if($this->session->userdata('username')) {
            $content = $this->input->post('content');
            $manager_id = $this->input->post('managerID');
            $this->chat_model->insert($content, $manager_id);
        }
    }
}