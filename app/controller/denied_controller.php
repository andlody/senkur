<?php

class denied_controller extends Controller
{ 
	function index(){
		if($this->session('status') != true){
			require_once('../config.php');
			if($USER->id!=0){
				$this->set('full_name',$USER->username);
				$this->set('status',true);
				$this->redirect('index');
			}
		}

		$this->view("index/denied");
		$this->template('_404');
	}

	function act(){
		$this->session('status',true);
		$this->write("Activo");
	}

	function des(){
		$this->session('status',false);
		$this->write("Desactivo");
	}
}
