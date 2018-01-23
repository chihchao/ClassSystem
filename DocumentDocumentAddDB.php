<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$folder_id = intval($_POST["folder_id"]);
$document_title = StripSlashes($_POST["document_title"]);
$document_content = StripSlashes($_POST["document_content"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["ADD"]);

$check_ltrim = ltrim($document_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的標題沒填或是只填空白，這樣無法加入文件。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into document_document (teacher_id, folder_id, document_title, document_content, document_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($folder_id) . "', '" . func_escape_string($document_title) . "', '" . func_escape_string($document_content) . "', now())";
$result = QueryDatabase($str);

if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
	$str = "Select LAST_INSERT_ID()";
	$result = QueryDatabase($str);
	list($document_id) = mysql_fetch_row($result);
	$localfile_name = $document_id . "_" . $_FILES["uploadfile"]["name"];
	$localfile = "UploadDocument/" . $localfile_name;
	if (copy($_FILES["uploadfile"]["tmp_name"], $localfile)){
		$str = "Update document_document Set document_file = '" . func_escape_string($localfile_name) . "' Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
		if (!QueryDatabase($str)) unlink($localfile);
	}
	unlink($_FILES["uploadfile"]["tmp_name"]);
}


header("location:Document.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>