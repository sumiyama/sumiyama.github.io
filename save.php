<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "19990420";
	$dbName = "sotarodb";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$sql = "INSERT INTO company (id, name, type, overview, number) 
		VALUES ('".$_POST["id"]."','".$_POST["name"]."','".$_POST["type"]."','".$_POST["overview"]."','".$_POST["number"]."')";

	$query = mysqli_query($conn,$sql);

	if($query) {
		echo "登録が完了しました。";
	}
	else {
		echo "登録に失敗しました。";
	}
	

	mysqli_close($conn);
?>

<html>
<head>
<title>登録フォーム</title>
<style>
h1 {
  margin-left: 50px;
}
th {
  width: 200px;
  margin: 10px 0;
}
input#send {
  margin-left: 100px;
  margin-top: 30px;
}
</style>
</head>
<body>
<p><a href="add.php">続けて追加する</a></p>
<a href="admin_page.php">入力を確認する</a>
</body>
</html>