<?php

class denied_controller extends Controller
{ 
	function index(){
//		if($this->session('status'))
//			$this->redirect('index');

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
