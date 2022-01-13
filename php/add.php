<?php
require_once "class/gift.php";
require_once "class/person.php";
require_once "class/sql.php";

if(isset($_POST) && isset($_GET['type'])){
    if($_GET['type'] == "gadd"){
        if(
            filter_has_var(INPUT_POST, "sender")
        &&  filter_has_var(INPUT_POST, "receiver")
        &&  filter_has_var(INPUT_POST, "label")
        &&  filter_has_var(INPUT_POST, "price")
        &&  filter_has_var(INPUT_POST, "description")
        ){
            if(
                !empty(trim($_POST['sender']))
            &&  !empty(trim($_POST['receiver']))
            &&  !empty(trim($_POST['label']) && strlen($_POST['label']) <= 100)
            &&  !empty(trim($_POST['price']))
            &&  !empty(trim($_POST['description']))
            ){
                //var_dump($_POST['sender'], $_POST['receiver'], $_POST['label'], $_POST['price'], $_POST['description']);
                if(!is_numeric(str_replace(",",".",$_POST['price']))){  }
                $price = str_replace(",",".",$_POST['price']);
                if($price < 0) {  }
                    $gft = new Gift();
                    $gft->add($_POST['sender'], $_POST['receiver'], $_POST['label'], $price, $_POST['description']);
                return header("Location: ../index.php");
            }else{
                return header("Location: ../index.php");
            }
        }
    }else if($_GET['type'] == "padd"){
        if(
            filter_has_var(INPUT_POST, "firstname")
        &&  filter_has_var(INPUT_POST, "lastname")
        &&  filter_has_var(INPUT_POST, "postalcode")
        &&  filter_has_var(INPUT_POST, "dateofbirth")
        ){
            if(
                !empty(trim($_POST['firstname'])) && strlen($_POST['firstname']) <= 100
            &&  !empty(trim($_POST['lastname'])) && strlen($_POST['lastname']) <= 100
            &&  !empty(trim($_POST['postalcode'])) && strlen($_POST['postalcode']) == 6
            &&  !empty(trim($_POST['dateofbirth']))
            ){
              echo $_POST['firstname']." ".$_POST['lastname']." | ".$_POST['postalcode']." ".$_POST['dateofbirth'];
              $per = new Person();
              $per->add($_POST['firstname'], $_POST['lastname'], $_POST['postalcode'], $_POST['dateofbirth']);
              return header("Location: ../index.php");
            }else{
                return header("Location: ../index.php");
            }
        }
    }else{
        return header("Location: ../index.php");
    }
}else{
    return header("Location: ../index.php");
}