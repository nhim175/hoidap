<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adviser extends CI_Controller {
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
       
        if((!$this->session->userdata('username'))||($this->session->userdata['position']!='adviser')) {
            $data['page'] = 'adviser';
            $data['error'] = false;
            $data['username_input'] = array('name' => 'username', 'id' => 'username');
            $data['password_input'] = array('name' => 'password', 'id' => 'password');
            $this->load->view('templates/header', $data);
            $this->load->view('adviser_login', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['title'] = 'Adviser Homepage';
            $user = $this->account_model->get_user_info($this->session->userdata('adviser'))->row();
            $data['name'] = $user->username;
            $id = $this->session->userdata('userid');
            $data['adviser1'] = $this->account_model->get_user_by_id(1)->row();
            $data['adviser2'] = $this->account_model->get_user_by_id(2)->row();
            $data['adviser3'] = $this->account_model->get_user_by_id(3)->row();
            $data['adviser_questions'] = $this->question_model->get_question_by_adviser($id)->result();
            $data['adviser1_questions'] = $this->question_model->get_question_by_adviser(1)->result();
            $data['adviser2_questions'] = $this->question_model->get_question_by_adviser(2)->result();
            $data['adviser3_questions'] = $this->question_model->get_question_by_adviser(3)->result();
            $data['next_questions'] = $this->question_model->get_next_questions()->result();
            $data['unchosen_questions_arr'] = $this->question_model->get_unchosen_questions_by_adviser_id($id)->result();
            $data['chats'] = $this->chat_model->get_chat(1,20,0)->result();
            $data['data'] = $data;
            $this->load->view('templates/header', $data);
            $this->load->view('adviser_index', $data);
            $this->load->view('templates/footer', $data);
        }
    }
    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $position = 'adviser';
        if($this->account_model->check_user($username, $password, $position)) {
            $user = $this->account_model->get_user_info($username)->row();
            $name = $user->name;
            $this->session->set_userdata(array('username' => $name, 'position' => $position, 'adviser' => $user->username, 'userid' => $user->id));
        }
        redirect('adviser/index', 'refresh');
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }
    public function choose_question() {
        if($this->session->userdata('username')) {
            $adviserID = $this->input->post('adviser');
            $questionID = $this->input->post('question');
            $this->account_model->attach($adviserID, $questionID);
        }
    }
    public function unchoose_question() {
        if($this->session->userdata('username')) {
            $adviserID = $this->input->post('adviser');
            $questionID = $this->input->post('question');
            $this->account_model->deattach($adviserID, $questionID);
        }
    }
    public function answer_later() {
        if($this->session->userdata('username')) {
            $questionID = $this->input->post('question');
            $this->question_model->answer_later($questionID);
        }
    }
    public function answer_now() {
        if($this->session->userdata('username')) {
            $questionID = $this->input->post('question');
            $this->question_model->answer_now($questionID);
        }
    }
    public function answer_next() {
        if($this->session->userdata('username')) {
            $questionID = $this->input->post('question');
            $this->question_model->answer_next($questionID);
        }
    }
    public function ajax_load() {
        if($this->session->userdata('username')) {
            $id = $this->session->userdata('userid');
            $data['adviser1'] = $this->account_model->get_user_by_id(1)->row();
            $data['adviser2'] = $this->account_model->get_user_by_id(2)->row();
            $data['adviser3'] = $this->account_model->get_user_by_id(3)->row();
            $data['adviser_questions'] = $this->question_model->get_question_by_adviser($this->session->userdata('userid'))->result();
            $data['adviser1_questions'] = $this->question_model->get_question_by_adviser(1)->result();
            $data['adviser2_questions'] = $this->question_model->get_question_by_adviser(2)->result();
            $data['adviser3_questions'] = $this->question_model->get_question_by_adviser(3)->result();
            $data['next_questions'] = $this->question_model->get_next_questions()->result();
            $data['unchosen_questions_arr'] = $this->question_model->get_unchosen_questions_by_adviser_id($id)->result();
            
            $this->load->view('adviser_ajax_index', $data);
        }
    }
    public function ajax_chat() {
        if($this->session->userdata('username')) {
            $data['chats'] = $this->chat_model->get_chat(1,20,0)->result();
            $this->load->view('adviser_ajax_chat', $data);
        }
    }
    public function insert_chat() {
        if($this->session->userdata('username')) {
            $content = $this->input->post('content');
            $adviser_id = $this->input->post('adviserID');
            $this->chat_model->insert($content, $adviser_id);
        }
    }
}