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
                !empty(trim(INPUT_POST['sender']))
            &&  !empty(trim(INPUT_POST['receiver']))
            &&  !empty(trim(INPUT_POST['label']) && strlen($_POST['label']) <= 100)
            &&  !empty(trim(INPUT_POST['price']))
            &&  !empty(trim(INPUT_POST['description']))
            ){
                
            }else{
                //return header("Location: ../index.php");
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
                !empty(trim(INPUT_POST['firstname']))
            &&  !empty(trim(INPUT_POST['lastname']))
            &&  !empty(trim(INPUT_POST['postalcode']) && strlen($_POST['postalcode']) == 5)
            &&  !empty(trim(INPUT_POST['dateofbirth']))
            ){
                
            }else{
                //return header("Location: ../index.php");
            }
        }
    }else{
        //return header("Location: ../index.php");
    }
}else{
    //return header("Location: ../index.php");
}