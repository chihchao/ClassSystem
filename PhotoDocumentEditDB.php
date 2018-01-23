<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");
require("PhotoResize.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$document_id = intval($_POST["document_id"]);
$document_title = StripSlashes($_POST["document_title"]);
$document_content = StripSlashes($_POST["document_content"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["EDIT"]);

$check_ltrim = ltrim($document_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的標題沒填或是只填空白，這樣無法加入相片。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update photo_document Set document_title = '" . func_escape_string($document_title) . "', document_content = '" . func_escape_string($document_content) . "', document_time = now() Where teacher_id = '" . func_escape_string($teacher_id) . "' And document_id = '" . $document_id . "'";
if (!QueryDatabase($str)) exit();

$allowed_types_array = array("image/gif", "image/pjpeg" , "image/jpeg", "image/jpg", "application/x-shockwave-flash");

if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){

	if (in_array($_FILES["uploadfile"]["type"], $allowed_types_array)){

		$str = "Select document_file From photo_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
		$result = QueryDatabase($str);
		list($document_file) = mysql_fetch_row($result);
		if (!empty($document_file)){
			$document_file = "UploadPhoto/" . $document_file;
			unlink($document_file);
			if (file_exists('UploadPhoto/tn_' . $document_id)) unlink('UploadPhoto/tn_' . $document_id);
		}
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
		echo("alert('你所提供的檔案不是影像檔或 SWF 檔，未處理重新上傳的檔案。');");
		echo("window.open('PhotoDocument.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id . "', '_self');");
		echo("</script>");
		exit();
	}
}

header("location:PhotoDocument.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id);
?>