<!DOCTYPE html>
<?php
require 'database.php';
$_session=[];
session_unset();
session_destroy();
header('Location: hello.php');
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Welcome</h1>
<a href="logout.php">Logout</a>

</body>
</html>

