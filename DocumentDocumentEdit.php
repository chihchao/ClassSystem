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

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["EDIT"]);

$str = "Select folder_id, document_title, document_content, document_file, document_time From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_title, $document_content, $document_file, $document_time) = mysql_fetch_row($result))) exit();

if ($folder_id == 0){
	$folder_name = "文件區";
}else{
	$str = "Select folder_name From document_folder Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name) = mysql_fetch_row($result))) exit();
}
$folder_name = htmlspecialchars($folder_name);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 文件區 →文件內容 → 編輯文件</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">編 . 輯 . 文 . 件</font></TD>
	<TD>
	<a href="DocumentDocument.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/DocumentDocumentReturnButton.gif" BORDER=0 ALT="回文件內容"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="DocumentDocumentEditDB.php">
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicFolder.gif" BORDER=0></TD>
	<TD valign="top" width="100%"><? echo($folder_name); ?></TD>
</TR>
</TABLE>
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="65" height="0"><BR>文件標題：</TD>
	<TD><INPUT TYPE="text" NAME="document_title" size="40" value="<? echo($document_title); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">文件內容：</TD>
	<TD><TEXTAREA NAME="document_content" ROWS="8" COLS="40"><? echo($document_content); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">文件附檔：</TD>
	<TD>
	<?
	if (empty($document_file)){
		echo("目前此文件沒有附加檔案，如要新增附加檔案，請選擇你要上傳的檔案。");
	}else{
		echo("目前此文件的附加檔案為『" . $document_file . "』，如要變更附加檔案，請選擇你要變更的檔案。");
	}
	?>
	<BR><INPUT TYPE="file" NAME="uploadfile" size="40">
	<? if (!empty($document_file)) echo("<BR><INPUT TYPE=checkbox NAME=document_file_delete value=delete>如果你要刪除附加檔案請勾選這個項目。"); ?></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="document_id" value="<? echo($document_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="清除"></TD>
</TR>
</TABLE>

</FORM>

</BODY>
</HTML>
