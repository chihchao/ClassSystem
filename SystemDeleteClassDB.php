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

$str = "Delete From document_folder Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Select document_file From document_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while(list($document_file) = mysql_fetch_row($result)){
	if (!empty($document_file)) {
		$localfile = "UploadDocument/" . $document_file;
		unlink($localfile);
	}
}
$str = "Delete From document_document Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除文件區...<BR>");

$str = "Delete From photo_folder Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Select document_file From photo_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while(list($document_file) = mysql_fetch_row($result)){
	if (!empty($document_file)) {
		$localfile = "UploadPhoto/" . $document_file;
		unlink($localfile);
	}
}
$str = "Delete From photo_document Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除相片區...<BR>");

$str = "Delete From link_folder Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Delete From link_document Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除連結區...<BR>");

$str = "Delete From board Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除公告區...<BR>");

$str = "Delete From calendar Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除行事曆...<BR>");

$str = "Delete From discuss_reply Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Delete From discuss_subject Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除討論區...<BR>");

$str = "Delete From message Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除留言區...<BR>");

$str = "Select homepage_image From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
list($homepage_image) = mysql_fetch_row($result);
if (!empty($homepage_image)) {
	$localfile = "UploadHomepage/" . $homepage_image;
	unlink($localfile);
}
$str = "Delete From teacher Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--》刪除班級基本資料...<BR>");
?>
<FORM METHOD=POST ACTION="System.php" name="form">
<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
</FORM>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert('完成刪除班級！');
form.submit();
//-->
</SCRIPT>