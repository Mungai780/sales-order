<?php
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
	echo "<script> alert('Please Log In');
		window.location.href='../employeeforms.php'; 
		</script>";
}
?>
