<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$document_id = intval($_POST["document_id"]);
$document_title = StripSlashes($_POST["document_title"]);
$document_content = StripSlashes($_POST["document_content"]);
$document_file_delete = StripSlashes($_POST["document_file_delete"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["EDIT"]);

$check_ltrim = ltrim($document_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的標題沒填或是只填空白，這樣無法加入文件。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update document_document Set document_title = '" . func_escape_string($document_title) . "', document_content = '" . func_escape_string($document_content) . "', document_time = now() Where teacher_id = '" . func_escape_string($teacher_id) . "' And document_id = '" . func_escape_string($document_id) . "'";
if (!QueryDatabase($str)) exit();

if ($document_file_delete == "delete"){

	$str = "Select document_file From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
	$result = QueryDatabase($str);
	list($document_file) = mysql_fetch_row($result);
	if (!empty($document_file)){
		$document_file = "UploadDocument/" . $document_file;
		unlink($document_file);
		$str = "Update document_document Set document_file = '' Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
		$result = QueryDatabase($str);
	}
	if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])) unlink($_FILES["uploadfile"]["tmp_name"]);

}else{

	if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
		$str = "Select document_file From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
		$result = QueryDatabase($str);
		list($document_file) = mysql_fetch_row($result);
		if (!empty($document_file)){
			$document_file = "UploadDocument/" . $document_file;
			unlink($document_file);
		}
		$localfile_name = $document_id . "_" . $_FILES["uploadfile"]["name"];
		$localfile = "UploadDocument/" . $localfile_name;
		if (copy($_FILES["uploadfile"]["tmp_name"], $localfile)){
			$str = "Update document_document Set document_file = '" . func_escape_string($localfile_name) . "' Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
			if (!QueryDatabase($str)) unlink($localfile);
		}
		unlink($_FILES["uploadfile"]["tmp_name"]);
	}

}

header("location:DocumentDocument.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id);
?>