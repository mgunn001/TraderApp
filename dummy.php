<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // when the Apply Filters in clicked
    if(isset($_POST['additionalFilterSubmit'])){
        foreach($_POST as $key => $value) {     
           
            if(!empty($_POST[$key])) {
                $curReqObj = $_POST[$key];
                if(is_array($curReqObj) ){
                      echo "<p>".$key."</p>";
                    foreach( $curReqObj  as $selected) {
                        echo "<p>".$selected ."</p>";
                    }
                }
                // echo "<br/>";
            }

        }
    }


    // when the Search button is clicked
    if(isset($_POST['mandatoryFilterSubmit'])){
        foreach($_POST as $key => $value) {     
            echo "<p>".$key.":</p>";
             echo "<p>".$value."</p><br/>";
        }
    }

?>