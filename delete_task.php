<?php

include "db_connect.php";

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");

$stmt->execute([$id]);

header("Location:index.php");

?>