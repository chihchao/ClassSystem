<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$teacher_password = StripSlashes($_POST["teacher_password"]);
$teacher_name = StripSlashes($_POST["teacher_name"]);
$teacher_email = StripSlashes($_POST["teacher_email"]);
$grade = StripSlashes($_POST["grade"]);
$class_number = StripSlashes($_POST["class_number"]);
$manage_password = StripSlashes($_POST["manage_password"]);
$class_password = StripSlashes($_POST["class_password"]);
$homepage_title = StripSlashes($_POST["homepage_title"]);
$homepage_describe = StripSlashes($_POST["homepage_describe"]);
$homepage_theme = StripSlashes($_POST["homepage_theme"]);
$homepage_counter = StripSlashes($_POST["homepage_counter"]);
$homepage_image_delete = stripslashes($_POST["homepage_image_delete"]);

//拼出功能類別
if ($_POST["function_a"]!=null) $function=$function.$_POST["function_a"];
if ($_POST["function_b"]!=null) $function=$function.$_POST["function_b"];
if ($_POST["function_c"]!=null) $function=$function.$_POST["function_c"];
if ($_POST["function_d"]!=null) $function=$function.$_POST["function_d"];
if ($_POST["function_e"]!=null) $function=$function.$_POST["function_e"];
if ($_POST["function_f"]!=null) $function=$function.$_POST["function_f"];
if ($_POST["function_g"]!=null) $function=$function.$_POST["function_g"];

if (empty($teacher_id)) exit();

//page=======================
NoCache();

LinkDatabase();

$login_user = login($PAGE_AUTHENTICATE_USER["MANAGE"]["EDIT"]);

$str = "Update teacher Set teacher_password = '" . func_escape_string($teacher_password) . "', teacher_name = '" . func_escape_string($teacher_name) . "', teacher_email = '" . func_escape_string($teacher_email) . "', grade = '" . func_escape_string($grade) . "', class_number = '" . func_escape_string($class_number) . "', class_password = '" . func_escape_string($class_password) . "', homepage_title = '" . func_escape_string($homepage_title) . "', homepage_describe = '" . func_escape_string($homepage_describe) . "', homepage_theme = '" . func_escape_string($homepage_theme) . "', homepage_counter = '" . func_escape_string($homepage_counter) . "', manage_password = '" . func_escape_string($manage_password) . "', function = '" . func_escape_string($function) . "' Where teacher_id = '" . func_escape_string($teacher_id) . "'";
if (!QueryDatabase($str)) exit();

if ($homepage_image_delete == "delete"){

	$str = "Select homepage_image From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "'";
	$result = QueryDatabase($str);
	list($homepage_image) = mysql_fetch_row($result);
	if (!empty($homepage_image)){
		$localfile = "UploadHomepage/" . $homepage_image;
		unlink($localfile);
		$str = "Update teacher Set homepage_image = '', homepage_image_flash = '0' Where teacher_id = '" . $teacher_id . "'";
		$result = QueryDatabase($str);
	}
	if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])) unlink($_FILES["uploadfile"]["tmp_name"]);

}else{

	$allowed_types_array = array("image/gif", "image/pjpeg", "image/jpeg", "image/jpg", "application/x-shockwave-flash");

	if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
		if (in_array($_FILES["uploadfile"]["type"], $allowed_types_array)){
			$str = "Select homepage_image From teacher Where teacher_id = '" . func_escape_string($teacher_id) . "'";
			$result = QueryDatabase($str);
			list($homepage_image) = mysql_fetch_row($result);
			if (!empty($homepage_image)){
				$homepage_image = "UploadHomepage/" . $homepage_image;
				unlink($homepage_image);
			}
			$localfile_name = $teacher_id . "_" . $_FILES["uploadfile"]["name"];
			$localfile = "UploadHomepage/" . $localfile_name;
			if ($_FILES["uploadfile"]["type"] == "application/x-shockwave-flash"){
				$homepage_image_flash = 1;
			}else{
				$homepage_image_flash = 0;
			}
			if (copy($_FILES["uploadfile"]["tmp_name"], $localfile)){
				$str = "Update teacher Set homepage_image = '" . func_escape_string($localfile_name) . "', homepage_image_flash = '" . $homepage_image_flash . "' Where teacher_id = '" . func_escape_string($teacher_id) . "'";
				if (!QueryDatabase($str)) unlink($localfile);
			}
			unlink($_FILES["uploadfile"]["tmp_name"]);
		}else{
			echo("<script language=javascript>");
			echo("alert('你所提供的首頁圖片不是影像檔或 SWF 檔，所以未處理首頁圖片。');");
			echo("</script>");
		}
	}

}

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.open("Homepage.php?teacher_id=<? echo($teacher_id); ?>", "_top");
//-->
</SCRIPT>