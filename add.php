<html>
<head>
<title>データ追加</title>
<h1>企業登録フォーム</h1>
<style>
h1 {
  margin-left: 50px;
}
th {
  width: 200px;
  margin: 10px 0;
  padding-left: 50px;
  text-align: left;
}
input#send {
  margin-left: 256px;
  margin-top: 30px;
}
</style>
</head>
<body>
<form action="save.php" name="frmAdd" method="post">
<table>
<tr><th>企業番号</th><td><input type="text" name="id" size="20" maxlength="10" required></td></tr>
<tr><th>企業名</th><td><input type="text" name="name" size="20" maxlength="10" required></td></tr>
<tr><th>業種</th><td><input type="text" name="type" size="20" maxlength="10" required></td></tr>
<tr><th>概要</th><td><textarea type="text" name="overview" cols="50" rows="4" maxlength="400" required></textarea></td></tr>
<tr><th>募集人数</th><td><input type="text" name="number" size="20" maxlength="10" required></td></tr>
</table>
<input type="submit" id="send" value="submit">
</form>
<a href="admin_page.php">戻る</a>
</body>
</html>