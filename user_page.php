<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "ログインしてください。";
		exit();
	}

	if($_SESSION['Status'] != "USER")
	{
		echo "This page for User only!";
		exit();
	}	
	
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "19990420";
	$dbName = "sotarodb";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<html>
<head>
<title>企業一覧</title>
<link href="common.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header"><span><?php echo $objResult["Username"];?>さんでログイン中 <br><a href="./login/logout.php">Logout</a></span></div>
  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li>アカウント<span><?php echo $objResult["UserID"];?> <?php echo $objResult["Name"];?> <a href="edit_profile.php">編集</a><br></span></li>
      <li><a href="" target="_blank">企業一覧</a></li>
      <li><a href="" target="_blank">企業検索</a></li>
      <li><a href="" target="_blank">ブックマーク</a></li>
      <li><a href="" target="_blank">ヘルプ</a></li>
      <li><a href="" target="_blank">その他</a></li>
    </ul>
  </div>
<?php echo $objResult["Name"];?>さんでログイン中 <br><a href="./login/logout.php">Logout</a>
<?php
/*-----検索-----*/
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
	if(isset($_GET["txtKeyword"]))
	{
		$strKeyword = $_GET["txtKeyword"];
	}
?>
<?php
/*-----DB接続 リスト表示-----*/   
   $serverName = "localhost";
   $userName = "root";
   $userPassword = "19990420";
   $dbName = "sotarodb";

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$sql = "SELECT * FROM company WHERE name LIKE '%".$strKeyword."%' "; //　検索範囲　”id” or ”name”
	$query = mysqli_query($conn,$sql);

	$num_rows = mysqli_num_rows($query);

	$per_page = 5;   // Per Page
	$page  = 1;
	
	if(isset($_GET["Page"]))
	{
		$page = $_GET["Page"];
	}

	$prev_page = $page-1;
	$next_page = $page+1;

	$row_start = (($per_page*$page)-$per_page);
	if($num_rows<=$per_page)
	{
		$num_pages =1;
	}
	else if(($num_rows % $per_page)==0)
	{
		$num_pages =($num_rows/$per_page) ;
	}
	else
	{
		$num_pages =($num_rows/$per_page)+1;
		$num_pages = (int)$num_pages;
	}
	$row_end = $per_page * $page;
	if($row_end > $num_rows)
	{
		$row_end = $num_rows;
	}

	$sql .= " ORDER BY name ASC LIMIT $row_start ,$row_end ";
	$query = mysqli_query($conn,$sql);

?>
<h1>企業一覧</h1>
<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
  <table>
    <tr>
      <th>
      <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>" placeholder="企業名">
      <input type="submit" value="検索"></th>
    </tr>
  </table>
</form>
検索結果 <?php echo $num_rows;?>件
<table>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
  <td class="list">
		<ul>
			<li><?php echo $result['name']; ?></li><li><?php echo $result['id']; ?></li>
	   </ul>
	</td>
	<td>
		<ul>
			<li><span>業種</span>: <?php echo $result['type']; ?></li>
			<li><span>概要</span>: <?php echo $result['overview']; ?></li>
			<li><span>募集人数</span>: <?php echo $result['number']; ?>人</li>
	    </ul>
	</td>
  </tr>
<?php
}
?>
</table>
<br><br>
<?php
/*-----検索2-----*/
if($prev_page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&txtKeyword=$strKeyword'>< Back</a> ";
}

for($i=1; $i<=$num_pages; $i++){
	if($i != $page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$strKeyword'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($page!=$num_pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&txtKeyword=$strKeyword'>Next ></a> ";
}
$conn = null;
?>
</body>
</html>