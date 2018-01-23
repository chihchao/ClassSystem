<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$document_id = intval($_POST["document_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["DELETE"]);

$str = "Select folder_id, document_file From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_file) = mysql_fetch_row($result))) exit();

if (!empty($document_file)){
	$localfile = "UploadDocument/" . $document_file;
	unlink($localfile);
}
$str = "Delete From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
QueryDatabase($str);
header("location:Document.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>