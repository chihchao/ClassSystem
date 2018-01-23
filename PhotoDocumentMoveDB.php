<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$document_id = intval($_GET["document_id"]);
$folder_id = intval($_GET["folder_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["MOVE"]);

if ($folder_id != 0){
	$str = "Select folder_id From photo_folder Where teacher_id = '" . func_escape_string($teacher_id) . "' And folder_id = '" . func_escape_string($folder_id) . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_id) = mysql_fetch_row($result))) exit();
}

$str = "Update photo_document Set folder_id = '" . func_escape_string($folder_id) . "' Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
QueryDatabase($str);
header("location:PhotoDocument.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id);
?>