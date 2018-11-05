<?php

class Sedes extends Model {
	public function getCampus(){
		return $this->query("SELECT DISTINCT data FROM mdl_user_info_data WHERE fieldid=4 ORDER BY data ASC");
	}

	public function getCursos($campus,$per){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=4 AND  data LIKE ?",array($campus));
		
		$b = array();
		$k=0;
		foreach ($a as $v) {
			$zz = $this->query("SELECT roleid FROM mdl_role_assignments WHERE userid = ".$v[0]);
			$zz = (sizeof($zz)>0)?$zz[0][0]:0;
			if($zz == 5){
				$b[$k]=$v;
				$k++;
			}
		}

		$a=$b;
		
		for($i=0;$i<sizeof($a);$i++){
			$a[$i][1] = $this->query("SELECT DISTINCT enrolid FROM mdl_user_enrolments WHERE userid=".$a[$i][0]);
		}

		$b = array();
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			foreach ($a[$i][1] as $v) {
				$aux = $this->query("SELECT courseid,(SELECT fullname FROM mdl_course WHERE mdl_course.id = courseid) FROM mdl_enrol WHERE id=".$v[0])[0];
				
				$bnd=true;
				for($j=0;$j<sizeof($b);$j++) {
					if($aux[0]==$b[$j][0]){
						$b[$j][2] += 1;
						$bnd=false;
					}
				}

				if($bnd){
					$b[$k] = $aux;
					$b[$k][2] = 1;
					$k++;
				}
			}
		}

		if($per!=0 && trim($per)!=''){
			foreach ($b as $v) {
				if(strpos($v[1], $per)) 
					$c[] = $v;
			}
		}
		else
			return $b;
		return $c;
	}

	public function getListado($campus,$id){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=4 AND  data LIKE ?",array($campus));
		
		$b = array();
		$k=0;
		foreach ($a as $v) {
			if($this->query("SELECT roleid FROM mdl_role_assignments WHERE userid = ".$v[0])[0][0] == 5){
				$b[$k]=$v;
				$k++;
			}
		}

		$a=$b;

		$idNotaFinal = $this->query("SELECT id FROM mdl_grade_items WHERE itemtype LIKE 'course' AND courseid = ?",array($id))[0][0];

		$x = array();
		$k=0;
		foreach ($a as $v) {
			$aux = $this->query("SELECT userid FROM mdl_user_enrolments WHERE enrolid = (SELECT id FROM mdl_enrol WHERE courseid= ? LIMIT 1) AND userid = ".$v[0],array($id));
			if(sizeof($aux)>0){
				$x[$k] = $this->query("SELECT id,firstname,lastname,email,
					(SELECT finalgrade FROM mdl_grade_grades WHERE mdl_grade_grades.userid=mdl_user.id AND itemid=$idNotaFinal ) FROM mdl_user WHERE id=".$aux[0][0])[0];
				$k++;
			}
		}

		return $x;
	}

	public function getNombreCurso($id){
		return $this->query("SELECT fullname FROM mdl_course WHERE id = ?",array($id))[0][0];
	}

	public function getHeadCurso($id){
		return $this->query("SELECT itemname,aggregationcoef FROM mdl_grade_items WHERE courseid = ? ORDER BY sortorder ASC",array($id));
	}

	public function getEvidencias($campus,$id){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=4 AND  data LIKE ?",array($campus));
		
		$b = array();
		$k=0;
		foreach ($a as $v) {
			if($this->query("SELECT roleid FROM mdl_role_assignments WHERE userid = ".$v[0])[0][0] == 5){
				$b[$k]=$v;
				$k++;
			}
		}

		$a=$b;

		//$idNotaFinal = $this->query("SELECT id FROM mdl_grade_items WHERE itemtype LIKE 'course' AND courseid = ?",array($id))[0][0];

		$n = $this->query("SELECT id FROM mdl_grade_items WHERE courseid = ?  ORDER BY sortorder ASC",array($id));

		$x = array();
		$k=0;
		foreach ($a as $v) {
			$aux = $this->query("SELECT userid FROM mdl_user_enrolments WHERE enrolid = (SELECT id FROM mdl_enrol WHERE courseid= ? LIMIT 1) AND userid = ".$v[0],array($id));
			if(sizeof($aux)>0){
				$x[$k]['a'] = $this->query("SELECT id,CONCAT(firstname,' ',lastname) FROM mdl_user WHERE id=".$aux[0][0])[0];

				for($i=0;$i<sizeof($n);$i++){
					$zz = $this->query("SELECT finalgrade FROM mdl_grade_grades WHERE userid=".$aux[0][0]." AND itemid=".$n[$i][0]);
					$x[$k]['b'][$i] = (sizeof($zz)>0)? number_format($zz[0][0],1):'-';
				}
				$k++;
			}
		}

		$y = array();
		for($i=0;$i<sizeof($x);$i++){
			$y[$i][0] = $i+1;
			$y[$i][1] = $x[$i]['a'][0];
			$y[$i][2] = $x[$i]['a'][1];

			for($j=1;$j<sizeof($x[$i]['b']);$j++){
				$y[$i][2+$j] = $x[$i]['b'][$j];	
			}
			$y[$i][2+$j] = $x[$i]['b'][0];	
			if($y[$i][2+$j]=='-')
				$y[$i][3+$j] = '-';
			else	
				$y[$i][3+$j] = ($y[$i][2+$j]>10.5)?'<span style="color:blue">Aprobado</span>':'<span style="color:red">Desaprobado</span>';	
		}

		return $y;
	}


























	public function getZonal(){
		return $this->query("SELECT DISTINCT data FROM mdl_user_info_data WHERE fieldid=8 ORDER BY data ASC");
	}

	public function getCampusBK($zonal){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$aux = '';
		$k=0;
		$b=array();
		for($i=0;$i<sizeof($a);$i++){
			 $dat = $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0];
			 if($aux != $dat){
			 	$bnd = true;
			 	foreach ($b as $val) {
			 		if($val == $dat) $bnd = false;
			 	}

			 	if($bnd){
			 		$b[$k] = $dat;
			 		$k++;	
			 	}	
			 }
		}
		return $b;		
	}

	public function getCursosBKKK($zonal,$campus){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			 if($campus == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0]){
			 	$b[$k] = $a[$i][0];
			 	$k++;
			 }
		}

		return array(array(sizeof($b),3));
//return $b;//array(sizeof($b));
		$k=0;
		$x=array();
		foreach ($b as $v) {
			$c = $this->query("SELECT DISTINCT enrolid FROM mdl_user_enrolments WHERE userid=".$v);//return $c;
			foreach ($c as $m) {
				$bnd = true;
				foreach ($x as $u) {
					if($u == $m[0]) $bnd = false;
				}

				if($bnd){
					$x[$k] = $m[0];
					$k++;
				} 			
			}
		}

		$k=0;
		foreach ($x as $v) {
			$y[$k] = $this->query("SELECT (SELECT fullname FROM mdl_course WHERE mdl_course.id = courseid),id FROM mdl_enrol WHERE id=".$v)[0];
			$k++;
		}

		$k=0;
		foreach ($y as $v) {
			$y[$k][1] = $this->query("SELECT COUNT(id) FROM mdl_user_enrolments WHERE enrolid=".$v[1])[0][0];//return $c;
			$k++;
		}


		return $y;

	}









// =         ========















	public function getCarrera($zonal,$campus){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			 if($campus == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0]){
			 	$b[$k] = $a[$i][0];
			 	$k++;
			 }
		}

		$aux = '';
		$k=0;
		$c=array();
		for($i=0;$i<sizeof($b);$i++){
			 $dat = $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=6 AND userid = ".$b[$i])[0][0];
			 if($aux != $dat){
			 	$bnd = true;
			 	foreach ($c as $val) {
			 		if($val == $dat) $bnd = false;
			 	}

			 	if($bnd){
			 		$c[$k] = $dat;
			 		$k++;	
			 	}	
			 }
		}
		return $c;			
	}






	public function esJefe($id){
		$dat = $this->query("SELECT roleid FROM mdl_role_assignments WHERE userid = ".$id)[0][0];
		return $dat;
	}


















/*
	public function getPeriodo($zonal,$campus,$carrera){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			 if($campus == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0]){
			 	$b[$k] = $a[$i][0];
			 	$k++;
			 }
		}

		$k=0;
		for($i=0;$i<sizeof($b);$i++){
			 if($carrera == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=6 AND userid = ".$b[$i])[0][0]){
			 	$c[$k] = $b[$i];
			 	$k++;
			 }
		}

		$aux = '';
		$k=0;
		$d=array();
		for($i=0;$i<sizeof($c);$i++){
			 $dat = $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=9 AND userid = ".$c[$i])[0][0];
			 if($aux != $dat){
			 	$bnd = true;
			 	foreach ($d as $val) {
			 		if($val == $dat) $bnd = false;
			 	}

			 	if($bnd){
			 		$d[$k] = $dat;
			 		$k++;	
			 	}	
			 }
		}
		return $d;			
	}
	*/

	public function getAlumnos($zonal,$campus,$carrera){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			 if($campus == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0]){
			 	$b[$k] = $a[$i][0];
			 	$k++;
			 }
		}

		$k=0;
		for($i=0;$i<sizeof($b);$i++){
			if($carrera == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=6 AND userid = ".$b[$i])[0][0]){
				$c[$k] = $b[$i];
				$k++;
			}
		}

		$aux = '';
		$k=0;
		$d=array();
		for($i=0;$i<sizeof($c);$i++){
			 $dat = $this->query("SELECT id,firstname,lastname,email FROM mdl_user WHERE id=".$c[$i])[0];
			 if($aux != $dat[0]){
			 	$bnd = true;
			 	foreach ($d as $val) {
			 		if($val[0] == $dat[0]) $bnd = false;
			 	}

			 	if($bnd){
			 		$d[$k] = $dat;
			 		$k++;	
			 	}	
			 }
		}
		return $d;			
	}

//---------------------

	public function getCursosBK($zonal,$campus,$carrera){
		$a = $this->query("SELECT DISTINCT userid FROM mdl_user_info_data WHERE fieldid=8 AND  data LIKE ? ORDER BY userid ASC",array($zonal));
		
		$k=0;
		for($i=0;$i<sizeof($a);$i++){
			 if($campus == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=4 AND userid = ".$a[$i][0])[0][0]){
			 	$b[$k] = $a[$i][0];
			 	$k++;
			 }
		}

		$k=0;
		for($i=0;$i<sizeof($b);$i++){
			if($carrera == $this->query("SELECT data FROM mdl_user_info_data WHERE fieldid=6 AND userid = ".$b[$i])[0][0]){
				$c[$k] = $b[$i];
				$k++;
			}
		}

		$aux = '';
		$k=0;
		$d=array();
		for($i=0;$i<sizeof($c);$i++){
			 $dd = $this->query("SELECT '1',groupid,'2','3','4','5' FROM mdl_groups_members WHERE userid=".$c[$i]);
			 if (sizeof($dd)==0) continue;
			 $dat = $dd[0];
			 if($aux != $dat[0]){
			 	$bnd = true;
			 	foreach ($d as $val) {
			 		if($val[0] == $dat[0]) $bnd = false;
			 	}

			 	if($bnd){
			 		$d[$k] = $dat;
			 		$k++;	
			 	}	
			 }
		}

		$x=array();$k=0;
		foreach($d as $v) {
			$x[$k] = $this->query("SELECT id,fullname,(SELECT name FROM mdl_course_categories WHERE id=category LIMIT 1) FROM mdl_course WHERE id=(SELECT courseid FROM mdl_groups WHERE id= ? )",array($v[1]))[0];
			$k++;
		}

		//$rr = $this->query("SELECT '1',fullname,'3','4' FROM mdl_course WHERE id=(SELECT courseid FROM mdl_groups WHERE id= ? )",array($d[0][1]));

		return $x;			
	}


}
