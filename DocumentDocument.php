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

$str = "Select folder_id, document_title, document_content, document_file, document_time From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_title, $document_content, $document_file, $document_time) = mysql_fetch_row($result))) exit();
$document_title = htmlspecialchars($document_title);
$document_content = nl2br($document_content);

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
<TITLE><? echo($homepage_title); ?> → 文件區 → 文件內容</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">文 . 件 . 內 . 容</font></TD>
	<TD>
	<a href="Document.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/DocumentReturnButton.gif" BORDER=0 ALT="回資料夾"></a></TD>
	<TD>
	<a href="DocumentDocumentEdit.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/DocumentDocumentEditButton.gif" BORDER=0 ALT="編輯文件"></a></TD>
	<TD>
	<a href="DocumentDocumentMove.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/DocumentDocumentMoveButton.gif" BORDER=0 ALT="搬移文件"></a></TD>
	<TD>
	<a href="DocumentDocumentDelete.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/DocumentDocumentDeleteButton.gif" BORDER=0 ALT="刪除文件"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<BR>
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
	<TD><? echo($document_title); ?></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">文件內容：</TD>
	<TD><? echo($document_content); ?></TD>
</TR>
<?
if (!empty($document_file)){
	$document_file_url = rawurlencode($document_file);
?>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">文件附檔：</TD>
	<TD><a href="DocumentDocumentDownload.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>" target=_blank><? echo(substr(strstr($document_file, "_"), 1)); ?></a></TD>
</TR>
<? } ?>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">文件日期：</TD>
	<TD><? echo($document_time); ?></TD>
</TR>
</TABLE>

</BODY>
</HTML>
