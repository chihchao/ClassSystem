<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//page=======================
NoCache();
session_start();
?>

<?
function CheckPassword($password, $teacher_id, $authenticate_user, $url){
	if ($authenticate_user == "classuser"){
		$str = "Select teacher_id From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "' And (teacher_password = '" . func_escape_string($password) . "' Or manage_password = '" . func_escape_string($password) . "' Or class_password = '" . func_escape_string($password) . "')";
	}elseif ($authenticate_user == "manager"){
		$str = "Select teacher_id From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "' And (teacher_password = '" . func_escape_string($password) . "' Or manage_password = '" . func_escape_string($password) . "')";
	}else{
		$str = "Select teacher_id From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "' And teacher_password = '" . func_escape_string($password) . "'";
	}
	LinkDatabase();
	$result = QueryDatabase($str);
	$RowNum = mysql_num_rows($result);

	if ($RowNum == 0){
		echo("<SCRIPT LANGUAGE='JavaScript'>");
		echo("alert('你沒有權限能夠進入該網頁\\n請取得授權的密碼。');");
		echo("history.back();");
		echo("</SCRIPT>");
	}else{
		$_SESSION["user_id"] = $teacher_id;
		$_SESSION["user_level"] = $authenticate_user;
		echo("<SCRIPT LANGUAGE='JavaScript'>parent.HomepageManu.location.reload();</SCRIPT>");
		echo("<meta http-equiv='refresh' content='0;URL=" . $url . "'>");
	}
}
?>

<?
$password = StripSlashes($_POST["password"]);

if (! empty($password)){
	//$password = str_replace("'","",$password); //防止資料隱碼攻擊
	//$password = str_replace("%","",$password);
	//$password = rtrim($password);

	$teacher_id = StripSlashes($_POST["teacher_id"]);
	$authenticate_user = StripSlashes($_POST["authenticate_user"]);
	$url = StripSlashes($_POST["url"]);
	CheckPassword($password, $teacher_id, $authenticate_user, $url);

}else{

	$teacher_id = intval($_GET["teacher_id"]);
	$authenticate_user = StripSlashes($_GET["authenticate_user"]);
	$url = StripSlashes($_GET["url"]);

    switch ($authenticate_user){
     case "teacher":
          $user_level_str = "班級老師";
          break;
     case "manager":
          $user_level_str = "班級管理者";
          break;
     case "classuser":
          $user_level_str = "班級使用者";
          break;
    }
?>
<html><head><meta http-equiv="content-type" content="text/html; charset=BIG5" /><title>班級網頁系統認証</title></head>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">
<br><br>

<TABLE border="0" align="center"><TR><TD>

<form name=logonform action=Authenticate.php method=post>

<? display_frame(0, 0); ?>
		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF" size="2">驗 . 證 . 密 . 碼</font></TD>
		</TR>
		</TABLE>

<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD colspan=2><font color=#FF0000 size=2><B>
				！請輸入<?=$user_level_str?>密碼...<br>
			</B></font>
			</TD>
		</TR>
		<TR>
			<TD>
			<INPUT TYPE="password" NAME="password" size="15">
			<input type=hidden name=teacher_id value=<?=$teacher_id?>>
			<input type=hidden name=authenticate_user value=<?=$authenticate_user?>>
			<input type=hidden name=url value=<?=$url?>>
			<INPUT TYPE="submit" value="送出">
			<INPUT TYPE="reset" value="清除">
			</TD>
		</TR>
		</TABLE>

<? display_frame(0, 2); ?>
</form>

</TD></TR></TABLE>

</BODY>

</html>
<?
}
?>