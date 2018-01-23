<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$password = StripSlashes($_POST["password"]);
$teacher_account = StripSlashes($_POST["teacher_account"]);
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

//page=======================
NoCache();

LinkDatabase();

if ($password != $APPLY_PASSWORD){
	include("PublicPassword.php");
	exit();
}

$check_ltrim = ltrim($teacher_account);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的帳號沒填或是只填空白，這樣無法申請班級網頁。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into teacher (teacher_account, teacher_password, teacher_name, teacher_email, grade, class_number, class_password, homepage_title, homepage_describe, homepage_theme, homepage_counter, manage_password, apply_time) Values ('" . func_escape_string($teacher_account) . "', '" . func_escape_string($teacher_password) . "', '" . func_escape_string($teacher_name) . "', '" . func_escape_string($teacher_email) . "', '" . func_escape_string($grade) . "', '" . func_escape_string($class_number) . "', '" . func_escape_string($class_password) . "', '" . func_escape_string($homepage_title) . "', '" . func_escape_string($homepage_describe) . "', '" . func_escape_string($homepage_theme) . "', '" . func_escape_string($homepage_counter) . "', '" . func_escape_string($manage_password) . "', now())";
if (!QueryDatabase($str)){
	echo("<script language=javascript>");
	echo("alert('申請班級網頁失敗，可能是你的帳號有人使用，請換一個帳號試試看');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$allowed_types_array = array("image/gif", "image/pjpeg", "image/jpeg", "image/jpg", "application/x-shockwave-flash");

if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
	if (in_array($_FILES["uploadfile"]["type"], $allowed_types_array)){
		$str = "Select LAST_INSERT_ID()";
		$result = QueryDatabase($str);
		list($teacher_id) = mysql_fetch_row($result);
		$localfile_name = $teacher_id . "_" . $_FILES["uploadfile"]["name"];
		$localfile = "UploadHomepage/" . $localfile_name;
		if ($_FILES["uploadfile"]["type"] == "application/x-shockwave-flash"){
			$homepage_image_flash = 1;
		}else{
			$homepage_image_flash = 0;
		}
		if (copy($_FILES["uploadfile"]["tmp_name"], $localfile)){
			$str = "Update teacher Set homepage_image = '" . func_escape_string($localfile_name) . "', homepage_image_flash = '" . $homepage_image_flash . "' Where teacher_id = '" . $teacher_id . "'";
			if (!QueryDatabase($str)) unlink($localfile);
		}
		unlink($_FILES["uploadfile"]["tmp_name"]);
	}else{
		echo("<script language=javascript>");
		echo("alert('你所提供的首頁圖片不是影像檔或 SWF 檔，所以未處理首頁圖片。');");
		echo("window.open('index.php', '_self');");
		echo("</script>");
		exit();
	}
}


header("location:index.php");
?>