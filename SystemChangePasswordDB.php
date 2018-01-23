<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$password = StripSlashes($_POST["password"]);
$teacher_password = StripSlashes($_POST["teacher_password"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

if ($password != $MANAGE_PASSWORD){
	include("PublicPassword.php");
	exit();
}

LinkDatabase();

GetThemeTitle();

$str = "Update teacher Set teacher_password = '" . func_escape_string($teacher_password) . "' Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
?>
<FORM METHOD=POST ACTION="System.php" name="form">
<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
</FORM>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert('修改老師密碼成功！');
form.submit();
//-->
</SCRIPT>