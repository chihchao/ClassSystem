<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$password = StripSlashes($_POST["password"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

if ($password != $MANAGE_PASSWORD){
	include("PublicPassword.php");
	exit();
}

LinkDatabase();

GetThemeTitle();

?>
<FORM METHOD="POST" ACTION="SystemDeleteClassDB.php" name="form">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
<input style="display: none;" type="submit">
</FORM>
<SCRIPT LANGUAGE="JavaScript">
<!--
if (confirm('�A�u���n�R���o�ӯZ�ŶܡH')){
	form.submit();
}else{
	history.back();
}
//-->
</SCRIPT>
