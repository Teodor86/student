<?php
class PasswordGenerator
{
	function createPass($length) {
		
		$chars = [
            'a','b','c','d','e','f',
             'g','h','i','j','k','l',
             'm','n','o','p','r','s',
             't','u','v','x','y','z',
             'A','B','C','D','E','F',
             'G','H','I','J','K','L',
             'M','N','O','P','R','S',
             'T','U','V','X','Y','Z',
             '1','2','3','4','5','6',
             '7','8','9','0','.',',',
             '(',')','[',']','!','?',
             '^','%','@','*','$','+',
             '-','{','}','`','~'];
				 
		$size = sizeOf($chars) - 1;
		$pass = '';
		
		for($i = 0; $i < $length; $i++) {
			$randomChars = mt_rand(0, $size);
			$pass .= $chars[$randomChars];
		}
		
		return $pass;
	}	
}
?>