<?php
class FormHelper
{
	public static function buildOptions($options, $selected = 0) {
		
		$text = "";
		
		foreach($options as $k => $v) {
			
			$op = ($k == $selected) ? 'selected="selected"' : null;
			$text.= "<option value='$k' $op>".$v."</option>\n";
		}		
		return $text;
	}

	public static function years() {
	
		$currentYears = date('Y');
		$years = ['Выберите год рождения'];

		for($i = 1920; $i < $currentYears; $i++) {
				$years[$i] = $i;
		}
		return $years;
	}

}
?>