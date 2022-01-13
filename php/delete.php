<?php
require_once "class/gift.php";
require_once "class/person.php";
require_once "class/sql.php";

if(isset($_POST) && isset($_GET['type']) && isset($_GET['id'])){
    if($_GET['type'] == "gdelete"){
        $todel = new Gift();
        $todel->delete($_GET['id']);
        return header("Location: ../index.php");
    }else if($_GET['type'] == "pdelete"){
        $todel = new Person();
        $todel->delete($_GET['id']);
        //return header("Location: ../index.php");
    }else{
        return header("Location: ../error.php?errorid=404");
    }
}else{
    return header("Location: ../error.php?errorid=404");
}