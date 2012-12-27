<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
    }
    public function index() {
        $data['title'] = 'VTC Channel 10';
        $this->load->view('templates/header', $data);
        $this->load->view('home_index', $data);
        $this->load->view('templates/footer', $data);
    }
}