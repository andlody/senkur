<?php

class Cursos extends Model {
	public function getCategorias(){
		$a = $this->query("SELECT DISTINCT category FROM mdl_course");
		$x = array();
		$k=0;
		foreach ($a as $v) {
			$b = $this->query("SELECT name FROM mdl_course_categories WHERE id=".$v[0]);
			$r = (sizeof($b)>0)?$b[0][0]:' Sin nombre ';
			$s = $this->query("SELECT COUNT(id) FROM mdl_course WHERE category=".$v[0])[0][0];
			$x[$k][0] = $v[0];
			$x[$k][1] = (strlen($r)>30) ? substr($r,0,30).'...' : $r;
			$x[$k][2] = '('.$s.')';
			$k++;
		}
		return $x;
	}

	public function getCursos($id){
		//return $this->query("SELECT name FROM mdl_course_categories");
		return $this->query("SELECT fullname FROM mdl_course WHERE category = ? ",array($id));
		
	}

	public function getHeadCurso($id){
		$a = $this->query("SELECT id,itemname,aggregationcoef2,itemmodule,iteminstance FROM mdl_grade_items WHERE courseid = ? ",array($id));

		$b = $this->query("SELECT (SELECT CONCAT(firstname,' ',lastname) FROM mdl_user WHERE id=userid),grade FROM mdl_assign_grades WHERE assignment = 547");
		return array($a,$b);
	}
}