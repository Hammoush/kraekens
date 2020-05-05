<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kreaken</title>
    <link rel="stylesheet" type="text/css" href="css/kreaken.css ">
</head>
<body>
<!----- hier komt het menu------->
    <div id="menu">
        <ul>
            <li><a href="">Home</a> </li>
            <li><a href="">Contact</a> </li>
            <li><a href="AllKanaal.php">Zender</a></li>
            <li><a href="song.php">song</a></li>
            <li style="float: right;"><a href="zoeken">zoeken</a></li>

            <?php

           

            if(isset($_SESSION['user']))

                    { ?>
                 <li style="float: right;"><a href="logout.php">logout</a></li>

                 <?php   } else{ ?>
                     <li style="float: right;"><a href="login.php">login</a></li>
                 <?php }
             ?>
          
           
        </ul>
    </div>
    <div id="content">
