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
echo("--�n�R������...<BR>");

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
echo("--�n�R���ۤ���...<BR>");

$str = "Delete From link_folder Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Delete From link_document Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R���s����...<BR>");

$str = "Delete From board Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R�����i��...<BR>");

$str = "Delete From calendar Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R����ƾ�...<BR>");

$str = "Delete From discuss_reply Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
$str = "Delete From discuss_subject Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R���Q�װ�...<BR>");

$str = "Delete From message Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R���d����...<BR>");

$str = "Select homepage_image From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
list($homepage_image) = mysql_fetch_row($result);
if (!empty($homepage_image)) {
	$localfile = "UploadHomepage/" . $homepage_image;
	unlink($localfile);
}
$str = "Delete From teacher Where teacher_id = '" . $teacher_id . "'";
QueryDatabase($str);
echo("--�n�R���Z�Ű򥻸��...<BR>");
?>
<FORM METHOD=POST ACTION="System.php" name="form">
<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
</FORM>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert('�����R���Z�šI');
form.submit();
//-->
</SCRIPT>