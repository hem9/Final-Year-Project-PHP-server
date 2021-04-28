<?php
    class FormValidator {

        private $filename = 'contact_database.txt';
        private $name;
        private $email;
        private $phone;

        function __construct($name,$email,$phone) {
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
        }

        function submitForm()
        {
            if ($this->validForm())
            {
                $currentData = "";
                if (file_exists($this->filename)) {
                    $currentData = file_get_contents($this->filename);
                } 
                $currentData .= $this->name." ".$this->email." ".$this->phone."\n";
                file_put_contents($this->filename, $currentData);
                echo "Contact Details Submitted.";
            }
        }

        function validForm() {
            $nameValid = preg_match('/^[a-z\sA-Z]+$/',$this->name);
            $emailValid = preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$this->email);
            $phoneValid = preg_match('/^[0-9]+$/',$this->phone);

            if(!$nameValid) {
                echo "Name must contain only letters and spaces.<br>";
            }

            if(!$emailValid) {
                echo "Email must be a valid email.<br>";
            }

            if(!$phoneValid) {
                echo "Phone number must be valid.<br>";
            }            

            return $nameValid && $emailValid && $phoneValid;
        }
    }

    $formValidator = new FormValidator($_POST["name"],$_POST["email"],$_POST["phone"]);
    $formValidator->submitForm();
?>