<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Utility extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('upload');
        $this->load->helper(array('form', 'url','file'));

        //$this->load->library('fpdf17/fpdf');
        $this->load->model('m_function_global');

        $this->load->model('M_data_utility');

        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }   

/*--------------------------------------------------------------------------------------------------------------------*/
// (1) Management User/reset passsword
	public function user_manage(){
		$this->load->view('desain/v_header');
		$this->load->view('utility/v_user_manage');
		$this->load->view('desain/v_footer');
	}

    public function user_group(){
        $this->load->view('desain/v_header');
        $this->load->view('utility/v_user_group');
        $this->load->view('desain/v_footer');
    }
    
    public function about(){
        $this->load->view('desain/v_header');
        $this->load->view('utility/v_about');
        $this->load->view('desain/v_footer');
    }
}