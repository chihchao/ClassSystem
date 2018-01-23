<?php
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$folder_id = intval($_GET["folder_id"]);
$document_type = (empty($_GET["document_type"]) || $_GET["document_type"] != 'd') ? 'p' : 'd';

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

if ($document_type == 'd') {
	$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["ADD"]);
} else {
	$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["ADD"]);
}

if ($folder_id == 0){
	$folder_name = ($document_type == 'd') ? '文件區' : "相片區";
}else{
	$str = ($document_type == 'd') ? 'document_folder' : 'photo_folder';
	$str = "Select folder_name From " . $str . " Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name) = mysql_fetch_row($result))) exit();
}
$folder_name = htmlspecialchars($folder_name);
?>
<html>
<head>
<title><? echo($homepage_title); ?> → <?php if ($document_type == 'd') { echo('文件區 → 新增多個文件'); } else { echo('相片區 → 新增多張相片'); } ?></title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function addFileField(e) {
$('#FormFileField').append('<li>檔　　案：<input type="file" name="uploadfile[]" size="10" /><br />檔案標題：<input type="text" name="document_title[]" value="" /></li>');
}
$(document).ready(function(e){
	$("#FormFileFieldAdd").click(addFileField);
});
</script>
</head>
<? require("PublicDhtmlStyle.php"); ?>
<body bgcolor="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
<tr>
	<td width="100%"><font color="#ffffff">新 . 增 . <?php if ($document_type == 'd') { echo('文 . 件'); } else { echo('相 . 片'); } ?></font></td>
	<td>
	<a href="Photo.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><img src="Images/PhotoReturnButton.gif" border="0" alt="回資料夾"></a>
	</td>
</tr>
</table>
<? function_bar($homepage_theme, 1); ?>

<form method="post" enctype="multipart/form-data" action="DocumentMultiUploadDB.php">
<table border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<tr>
	<td valign="top"><img src="Images/PublicPointer.gif" border="0"></td>
	<td valign="top" width="100%">在 『<? echo($folder_name); ?>』 下新增<?php if ($document_type == 'd') { echo('文件'); } else { echo('相片'); } ?>。</td>
</tr>
</table>

<ul id="FormFileField">
<li>檔　　案：<input type="file" name="uploadfile[]" size="10" /><br />檔案標題：<input type="text" name="document_title[]" value="" /></li>
</ul>
<ul><li><input id="FormFileFieldAdd" type="button" value="新增欄位" /></li></ul>
<input type="hidden" name="folder_id" value="<? echo($folder_id); ?>">
<input type="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<input type="submit" value="送出">


</form>

</body>
</html>