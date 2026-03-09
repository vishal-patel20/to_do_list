<?php

include "db_connect.php";

$id = $_POST['id'];

$stmt = $conn->prepare("UPDATE tasks SET status='Completed' WHERE id=?");

$stmt->execute([$id]);

header("Location:index.php");

?>  