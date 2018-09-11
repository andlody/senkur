<?php

class Sedes extends Model {
	public function getZonal(){
		return $this->query("SELECT DISTINCT data FROM mdl_user_info_data WHERE fieldid=8 ORDER BY data ASC");
	}

	public function getCampus($zonal){
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

	public function getCursos($zonal,$campus,$carrera){
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
