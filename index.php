<?php
include "db_connect.php";
include "add_task.php";

$stmt = $conn->prepare("SELECT * FROM tasks ORDER BY id DESC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

<title>Task Manager</title>
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Task Management System</h2>

<!-- Add Task -->

<div class="task-form">

<form action="add_task.php" method="POST">

<input type="text" name="task_name" placeholder="Enter Task"   required>


<button class="add-btn">Add Task</button>

</form>
<?php

if(isset($_GET['error'])){
echo "<div class='message error'>".$_GET['error']."</div>";
}

if(isset($_GET['success'])){
echo "<div class='message success'>".$_GET['success']."</div>";
}

?>

</div>


<!-- Task Table -->

<table>

<tr>
<th>No</th>
<th>Task</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php

$no = 1;

foreach($tasks as $task){

echo "<tr>";

echo "<td>".$no++."</td>";
echo "<td>".$task['task_name']."</td>";
echo "<td>".$task['status']."</td>";

echo "<td class='actions'>";

if($task['status']=="Pending"){

echo "<form action='update_task.php' method='POST'>
<input type='hidden' name='id' value='".$task['id']."'>
<button class='complete-btn'>Complete</button>
</form>";

}

echo "<form action='delete_task.php' method='POST'>
<input type='hidden' name='id' value='".$task['id']."'>
<button class='delete-btn'>Delete</button>
</form>";

echo "</td>";

echo "</tr>";

}

?>

</table>

<?php

/* total tasks */
$totalStmt = $conn->query("SELECT COUNT(*) FROM tasks");
$totalTasks = $totalStmt->fetchColumn();

/* pending tasks */
$pendingStmt = $conn->query("SELECT COUNT(*) FROM tasks WHERE status='Pending'");
$pendingTasks = $pendingStmt->fetchColumn();

/* completed tasks */
$completeStmt = $conn->query("SELECT COUNT(*) FROM tasks WHERE status='Completed'");
$completeTasks = $completeStmt->fetchColumn();

?>
<div class="dashboard">

<div class="card total">
Total Tasks
<span><?php echo $totalTasks; ?></span>
</div>

<div class="card pending">
Pending Tasks
<span><?php echo $pendingTasks; ?></span>
</div>

<div class="card completed">
Completed Tasks
<span><?php echo $completeTasks; ?></span>
</div>

</div>
</div>

</body>
</html>