<?php

class index_controller extends Controller
{ 
	function before(){
		//$this->set('full_name','pruebas@senati.com');
		/*
		if($this->session('status')){
			$this->set('full_name','Andre Ochoa');	
		} else
			$this->redirect('denied');
		//*/

		//*	
		require_once('../config.php');
		//var_dump($USER);
		//$obj = $this->model('Sedes');
		//echo $obj->pruebas($USER->id);return;
		//$this->write("");
		//return;

	/*	
		if($USER->id!=0 && $this->session('status')){
			$this->set('full_name',$USER->firstname.' '.$USER->lastname);
		}else{
			if($USER->id!=0){
				$obj = $this->model('Sedes');
				$n = $obj->esJefe($USER->id);
				if($n == 1 || $n == 11){
					$this->session('status',true);
					$this->session('tipo',$n);
					$this->session('id',$USER->id);
					$this->set('full_name',$USER->firstname.' '.$USER->lastname);
				}
				else{
					$this->session('status',false);
					header("Location: /");	
				}
			}
			else{
				$this->session('status',false);
				header("Location: /");
			}
		}
	*/


		if($USER->id == 0){
			header("Location: /");
		}else{
			$this->set('full_name',$USER->firstname.' '.$USER->lastname);echo $obj->pruebas($USER->id);
			$obj = $this->model('Sedes');
			$n = $obj->esJefe($USER->id);
			if($n == 1 || $n == 11){
				$this->session('tipo',$n);
				$this->session('id',$USER->id);
			}else{
				header("Location: /");
			}
		}


/*
		if($USER->id==0){
			//$this->redirect('denied');
			$this->write("NO");
			return;
		}
		else{
			$this->write("NO");
		}
		$this->set('full_name',$USER->username);
//*/

/*
		if($this->session('status') != true){
			require_once('../config.php');
			if($USER->id!=0){
				$this->set('full_name',$USER->username);
				$this->session('status',true);
			}
			else
				$this->redirect('denied');
		}
//*/
	}

	//function index(){$this->write('d');}
	
	function index(){
		$this->redirect('index/senati');
	}

	function senati($id,$per){
		$this->view('index/otro');
		
		$obj = $this->model('Sedes');
		//$this->set('sedes',$obj->getZonal());
		$this->set('campus',$obj->getCampusX($this->session('tipo'),$this->session('id')));

		//------
		$this->set('body',array());
		if(trim($id)!=''){
			$obj = $this->model('Sedes');
			$this->set('body',$obj->getCursos($id,$per));
			$this->set('sede',$id);
			if($per==0 || trim($per)=='')
				$this->set('periodo','Todos');
			else
				$this->set('periodo',$per);
		}
	}

	function getcursos(){
		$obj = $this->model('Sedes');
		$a = $obj->getCursos($this->parameter('campus'));

		$txt = ''; $k=1;
		foreach($a as $val) {
		 	//$txt .= '<tr onClick="location.href=\'?k=index/verCurso/'.$val[0].'\'" style="cursor:pointer;color:#0000AA"><td>'.$k."</td>";
		 	$txt .= "<tr><td>".$k."</td>";
		 	$txt .= "<td>".$val[0]."</td>";
		 	$txt .= "<td>".$val[1]."</td>";
		 	$txt .= "<td>".$val[2]."</td>";
		 	$txt .= "<td><a href=\"?k=index/listado/".$this->parameter('campus')."/".$val[0]."\">Listado</a></td>";
		 	$txt .= "<td><a href=\"?k=index/evidencias/".$this->parameter('campus')."/".$val[0]."\">Evidencias</a></td></tr>";
		 	$k++;
		} 
		$this->write($txt);
	}


	function listado($campus,$id){
		$obj = $this->model('Sedes');

		$a = $obj->getListado($campus,$id);
		$this->set('body',$a);
		$this->set('campus',$campus);
		$this->set('id',$id);
		$this->set('curso',$obj->getNombreCurso($id));
	}


	function evidencias($campus,$id){
		$obj = $this->model('Sedes');
	
		$this->set('campus',$campus);
		$this->set('id',$id);
		$this->set('curso',$obj->getNombreCurso($id));

		$a = $obj->getHeadCurso($id);
		$this->set('head',$a);

		$a = $obj->getEvidencias($campus,$id);
		$this->set('body',$a);
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


	function cursosBKK(){
		$obj = $this->model('Sedes');
		$a = $obj->getCursos($this->parameter('zonal'),$this->parameter('campus'));

		//var_dump($a);
		//return;

		$txt = ''; $k=1;
		foreach($a as $val) {
		 	//$txt .= '<tr onClick="location.href=\'?k=index/verCurso/'.$val[0].'\'" style="cursor:pointer;color:#0000AA"><td>'.$k."</td>";
		 	$txt .= "<tr><td>-</td>";
		 	$txt .= "<td>".$val[0]."</td>";
		 	$txt .= "<td>".$val[1]."</td></tr>";
		 	//$txt .= "<td>".$val[2]."</td></tr>";
		 	$k++;
		} 
		$this->write($txt);
	}










/*
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
		 	$txt .= '<tr onClick="location.href=\'?k=index/verCurso/'.$val[0].'\'" style="cursor:pointer;color:#0000AA"><td>'.$k."</td>";
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
		 	$txt .= '<tr onClick="location.href=\'?k=index/verCurso/'.$val[0].'\'"><td>'.$k."</td>";
		 	$txt .= "<td>".$val[1]."</td>";
		 	$txt .= "<td>".$val[2]."</td>";
		 	$txt .= "<td>".$val[3]."</td></tr>";
		 	$k++;
		} 
		$this->write($txt);
	}


	function verCurso($id){
		$obj = $this->model('Cursos');
		$crs = $obj->getHeadCurso($id);
		$txt='';
		foreach ($crs[0] as $v) {
			$title = (strlen($v[1])>25)? substr($v[1],0,25).'...':$v[1];
			$txt .= '<th scope="col" title="'.$v[1].'">'.$title.'</th>';
		}
		$this->set('head',$txt);
		$this->set('body',$crs[1]);
	}







	function cursosx(){
	//	$this->write('hola');return;
		$obj = $this->model('Cursos');
		$this->set('cursos',$obj->getCategorias());
	}
	*/
}


