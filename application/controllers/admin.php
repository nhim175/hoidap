<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
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
            $data['page'] = 'admin';
            $data['error'] = false;
            $data['username_input'] = array('name' => 'username', 'id' => 'username');
            $data['password_input'] = array('name' => 'password', 'id' => 'password');
            $this->load->view('templates/header', $data);
            $this->load->view('admin_login', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['title'] = 'Admin Homepage';
            $data['data'] = $data;
            $this->load->view('templates/header', $data);
            $this->load->view('admin_index', $data);
            $this->load->view('templates/footer', $data);
        }
    }
    public function login() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $position = 'admin';
        if($this->account_model->check_user($username, $password, $position)) {
            $user = $this->account_model->get_user_info($username)->row();
            $this->session->set_userdata(array('username' => $username, 'position' => $position, 'name' => $user->name, 'userid' => $user->id));
        }
        redirect('admin/index', 'refresh');
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/index', 'refresh');
    }
    public function reset() {
        if($this->session->userdata('username')) {
            $this->question_model->reset();
            $this->chat_model->reset();
            redirect('admin/index', 'refresh');
        }
    }
}