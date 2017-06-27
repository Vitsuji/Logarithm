<?php
if(isset($_POST['submitcom']) ? $_POST['submitcom'] : null){
$use = $_POST['submitcom'];
echo $use;
}
?>

<html>
<body>
<form method="post" action="tesy.php">
<input type="submit" value="myname" name="submitcom">

<form>
</body>
</html>