<?php
    function getStatus($req){
        $value = '';
        if($req == 0){
            $value = "Pending";
        }elseif($req == 1){
            $value = "Submit";
        }elseif ($req == 2){
            $value = "Done";
        }elseif ($req == 3){
            $value = "Revisi";
        }elseif ($req == 4){
            $value = "Revisi";
        }elseif ($req == 9){
            $value = "Delete";
        }

        return $value;
    }

    function getPriority($req){
        $value = '';
        if($req == 1){
            $value = "Low";
        }elseif ($req == 2){
            $value = "Medium";
        }elseif ($req == 3){
            $value = "High";
        }elseif ($req == 4){
            $value = "Urgent";
        }

        return $value;
    }

