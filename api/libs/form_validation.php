<?php
 class form_validation
 {
   public static function rules($name, $label, $type, $is_required = FALSE)
		{
			$errorText = "";
      $input = $_POST["$name"];
			if($is_required === TRUE && empty($input))
				$errorText =  $label . " is required";
			else {
				$result = self::validateInput($input);
				switch ($type) {
					case 'alpha':
						if(!preg_match("/^[a-zA-Z ]*$/",$result))
							$errorText =  "Only alphabets and white space allowed";
						break;
					case 'numeric':
						if(preg_match("/^[a-zA-Z]*$/", $result))
							$errorText = "Only numbers allowed";
						break;
					case 'email':
						if(!filter_var($result, FILTER_VALIDATE_EMAIL))
						   $errorText = "Invalid email format";
						break;
					case 'other':
						/**
						* Do nothing if input is not empty, but
						* the error msg is display when the field is empty.
						*/
						break;
					default:
						# code...
						break;
				}
			}
			return $errorText;
		}

    public static function validateInput($inputValue)
		{
			# code...
			$inputValue = trim($inputValue);
			$inputValue = stripcslashes($inputValue);
			$inputValue = htmlspecialchars($inputValue);
			return $inputValue;
		}

    public static function failed($valiation_errors)
    {
      foreach ($valiation_errors as $key => $value) {
        if( ! empty($value))
          return TRUE;
      }
      return FALSE;
    }

 }
