<?php
class FormHelper
{
	public static function buildOptions($options, $selected = 0) {
		
		$text = "";
		
		foreach($options as $k => $v) {
			$op = ($k == $selected) ? 'selected="selected"' : null;
			$text.= "<option value='$k' $op>".$v."</option>\n\t\t\t\t\t";
		}		
		return $text;
	}

	public static function years() {
	
		$currentYears = date('Y');
		$years[] = 'Выберите год рождения';
    
		for($i = $currentYears; $i; $i--) {
        		if($i == 1919) break;
			$years[$i] = $i;
		}
    		return $years;
	}
}
?>
