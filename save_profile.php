<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "19990420";
	$dbName = "sotarodb";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "パスワードが一致しません。";
		exit();
	}
	$strSQL = "UPDATE member SET Password = '".trim($_POST['txtPassword'])."' 
	,Name = '".trim($_POST['txtName'])."' WHERE UserID = '".$_SESSION["UserID"]."' ";
	$objQuery = mysqli_query($objCon,$strSQL);
	
	echo "変更を保存しました。<br>";		
	
	if($_SESSION["Status"] == "ADMIN")
	{
		echo "<br><a href='admin_page.php'>戻る</a>";
	}
	else
	{
		echo "<br><a href='user_page.php'>戻る</a>";
	}
	
	mysqli_close($objCon);
?>