<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");
require("PhotoResize.php");

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

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["ADD"]);

$check_ltrim = ltrim($document_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('�A�����D�S��άO�u��ťաA�o�˵L�k�[�J�ۤ��C');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$allowed_types_array = array("image/gif", "image/pjpeg" , "image/jpeg", "image/jpg", "application/x-shockwave-flash");

if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){

	if (in_array($_FILES["uploadfile"]["type"], $allowed_types_array)){
		$str = "insert into photo_document (teacher_id, folder_id, document_title, document_content, document_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($folder_id) . "', '" . func_escape_string($document_title) . "', '" . func_escape_string($document_content) . "', now())";
		if (!QueryDatabase($str)) exit();
		$str = "Select LAST_INSERT_ID()";
		$result = QueryDatabase($str);
		list($document_id) = mysql_fetch_row($result);
		$localfile_name = $document_id . "_" . $_FILES["uploadfile"]["name"];
		$localfile = "UploadPhoto/" . $localfile_name;
		if ($_FILES["uploadfile"]["type"] == "application/x-shockwave-flash"){
			$document_file_flash = 1;
		}else{
			$document_file_flash = 0;
			resizeImage($_FILES["uploadfile"]["tmp_name"], "UploadPhoto/tn_" . $document_id, 100, 100);
		}
		if (copy($_FILES["uploadfile"]["tmp_name"], $localfile)){
			$str = "Update photo_document Set document_file = '" . func_escape_string($localfile_name) . "', document_file_flash = '" . $document_file_flash . "' Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
			if (!QueryDatabase($str)) unlink($localfile);
		}
		unlink($_FILES["uploadfile"]["tmp_name"]);

	}else{
		echo("<script language=javascript>");
		echo("alert('�A�Ҵ��Ѫ��ɮפ��O�v���ɩ� SWF �ɡA�Э��s��ܡC');");
		echo("history.back();");
		echo("</script>");
		exit();
	}
}else{
	echo("<script language=javascript>");
	echo("alert('�A�S�����Ѭۤ��ɡA�o�˵L�k�[�J�ۤ��C');");
	echo("history.back();");
	echo("</script>");
	exit();
}

header("location:Photo.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>