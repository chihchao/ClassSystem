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

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["DELETE"]);

$str = "Select folder_id From link_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id) = mysql_fetch_row($result))) exit();

$str = "Delete From link_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
QueryDatabase($str);
header("location:Link.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>