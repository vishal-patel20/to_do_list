<?php

include "db_connect.php";

if(isset($_POST['task_name'])){

$task = trim($_POST['task_name']);

if($task == ""){
    header("Location:index.php?error=Task cannot be empty");
    exit;
}

if(strlen($task) > 100){
    header("Location:index.php?error=Task cannot be more than 100 characters");
    exit;
}

$stmt = $conn->prepare("INSERT INTO tasks(task_name) VALUES(?)");
$stmt->execute([$task]);

header("Location:index.php?success=Task Added Successfully");

}

?>