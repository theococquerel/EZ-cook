<?php
session_start();
if (!empty($_POST)and isset($_POST['login']) and isset($_POST['password'])){
    if ($_POST['login']=="admin2026" and $_POST['password']=="projet3"){
        $_SESSION['login']=$_POST['login'];
        header("Location:index.php");
        exit();

    }
    else{
        $_SESSION['error']="Identififiant ou mot de passe incorrect";
        header("Location:index.php");
        exit();
    }
} 