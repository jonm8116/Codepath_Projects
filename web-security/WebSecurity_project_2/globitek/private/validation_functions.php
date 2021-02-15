<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    return strpos($value, '@') !== false;
  }
  //This function is used to check for valid characters with
  //phone and email
  function character_validations($value, $isPhone, $isEmail, $isUsername){
    //Possible regex expressions for:
    //phone: -> '/^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$/'
    //email: -> '/^[^0-9.\_][A-Za-z0-9]+[@][A-Za-z0-9_]+[.][a-z]{3}'
    if($isPhone){
      //if the string mathces this pattern then it will return true or
      return preg_match('/^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$/', $value);
    } elseif($isEmail){
      //this condition is if its for an email
      return preg_match("/^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[a-z]{3}$/", $value);
    } elseif($isUsername){
      //check if username has proper characters
      return !(preg_match("/[\W]/", $value));
    }
  }

?>
