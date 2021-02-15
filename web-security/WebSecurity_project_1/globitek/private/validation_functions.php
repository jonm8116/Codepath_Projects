<?php

  // is_blank('abcd')
  function is_blank($value='') {
	//The reason that $value is set to something in the parameter
	//is because that this is a default value for the parameter.
    if($value==""){
		return true;
	} else{
		return false;
	}
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
	$counter = strlen($value);
	/*for($i=0; $i<2; $i++){
		echo $options[$i] . ' ';
	}*/
	if($counter < $options[0] || $counter > $options[1]){
		return false;
	//if($counter > 255){
	//	return false;
	} else{
		return true;
	}
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    $truthValue=false;
	for($i=0; $i<strlen($value); $i++){
		if($value[$i]=="@"){
			return true;
		}
	}
	return $truthValue;
  }

?>
