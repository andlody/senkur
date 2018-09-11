<?php

class index_controller extends Controller
{ 
	function before(){
		if($this->session('status')){
			$this->set('full_name','Andre Ochoa');	
		} else
			$this->redirect('denied');
	}

	function index(){
		$obj = $this->model('Sedes');
		$this->set('sedes',$obj->getZonal());
	}

	function campus(){
		$obj = $this->model('Sedes');
		$a = $obj->getCampus($this->parameter('zonal'));
		$txt = '<option value="0"></option>';
		foreach($a as $val) {
		 	$txt .= "<option value='$val'>$val</option>";
		 } 
		$this->write($txt);
	}

	function carreras(){
		$obj = $this->model('Sedes');
		$a = $obj->getCarrera($this->parameter('zonal'),$this->parameter('campus'));
		$txt = '<option value="0"></option>';
		foreach($a as $val) {
		 	$txt .= "<option value='$val'>$val</option>";
		 } 
		$this->write($txt);
	} 

	function periodo(){
		$obj = $this->model('Sedes');
		$a = $obj->getPeriodo($this->parameter('zonal'),$this->parameter('campus'),$this->parameter('carrera'));
		$txt = '<select id="">';
		foreach($a as $val) {
		 	$txt .= "<option value='$val'>$val</option>";
		 } 
		$this->write($txt."</select>");
	}


	function cursos(){
		$obj = $this->model('Sedes');
		$a = $obj->getCursos($this->parameter('zonal'),$this->parameter('campus'),$this->parameter('carrera'));
		$txt = ''; $k=1;
		foreach($a as $val) {
		 	$txt .= "<tr><td>".$k."</td>";
		 	$txt .= "<td>".$val[1]."</td>";
		 	$txt .= "<td>".$val[2]."</td></tr>";
		 	$k++;
		} 
		$this->write($txt);
	}


	function alumnos(){
		$obj = $this->model('Sedes');
		$a = $obj->getAlumnos($this->parameter('zonal'),$this->parameter('campus'),$this->parameter('carrera'));
		$txt = ''; $k=1;
		foreach($a as $val) {
		 	$txt .= "<tr><td>".$k."</td>";
		 	$txt .= "<td>".$val[1]."</td>";
		 	$txt .= "<td>".$val[2]."</td>";
		 	$txt .= "<td>".$val[3]."</td></tr>";
		 	$k++;
		} 
		$this->write($txt);
	}



	function cursosx(){
		$obj = $this->model('Cursos');
		$this->set('cursos',$obj->getCategorias());
	}
}


