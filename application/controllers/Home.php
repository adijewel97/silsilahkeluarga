<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
/* ====================================================================================================================== */	
	public function __construct(){
        parent::__construct();
        $this->load->helper('form');

        //lib pdf
       /* $this->load->library('fpdf17/fpdf');
        $this->load->library('map/googlemaps');*/
        
        $this->load->model('M_event');
        
        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }   
/* ====================================================================================================================== */
	public function menu(){
		$this->load->view('desain/v_header');
		$this->load->view('dashboard/v_dashboard_main');
		$this->load->view('desain/v_footer');
	}

	public function silsilah(){
		$this->load->view('desain/v_header');
		$this->load->view('silsilah/v_silsilah');
		$this->load->view('desain/v_footer');
	}

	public function keluarga(){
		$this->load->view('desain/v_header');
		$this->load->view('keluarga/v_keluarga');
		$this->load->view('desain/v_footer');
	}

	public function menu_event(){
		$this->load->view('desain/v_header');
		$this->load->view('event/v_event_all');
		$this->load->view('desain/v_footer');
	}

}