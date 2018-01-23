<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$document_id = intval($_GET["document_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$str = "Select document_file From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($document_file) = mysql_fetch_row($result))) exit();

$document_file_url = rawurlencode($document_file);
header("Content-type:application");
header("Content-Disposition: inline; filename=" . substr(strstr($document_file, "_"), 1));
//substr(strstr($document_file, "_"), 1)
readfile("UploadDocument/" . $document_file);
exit();
?>