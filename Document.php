<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$folder_id = intval($_GET["folder_id"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//function===================
function router_folder_path($router_folder_path_str, $router_folder_id){
	global $teacher_id, $folder_id, $folder_array;
	$path_str = "<TABLE border=0><TR><TD valign=top>";
	if ($router_folder_id != $folder_id){
		$path_str = $path_str . "<img src=Images/PublicFolder.gif>";
	}else{
		$path_str = $path_str . "<img src=Images/PublicFolderOpen.gif>";
	}
	$path_str = $path_str . "</TD><TD>";
	$path_str = $path_str . "<a href=\"Document.php?teacher_id=" . $teacher_id . "&folder_id=" . $router_folder_id . "\">" . $folder_array[$router_folder_id]["folder_name"] . "</a>";
	$path_str = $path_str . "</TD></TR>";
	if ($router_folder_id != $folder_id) $path_str = $path_str . "<TR><TD align=center>↓</TD><TD></TD></TR>";
	$path_str = $path_str . "</TABLE>";
	$router_folder_path_str = $path_str . $router_folder_path_str;
	return $router_folder_path_str;
}

function show_folder($down_folder_id){
	global $teacher_id, $folder_array;
	echo("<TR>");
	echo("<TD valign=top><img src=Images/PublicFolder.gif>");
	echo("</TD>");
	echo("<TD width=100%>");
	echo("<a href=\"Document.php?teacher_id=" . $teacher_id . "&folder_id=" . $down_folder_id . "\">" . $folder_array[$down_folder_id]["folder_name"] . "</a>");
	echo("</TD>");
	echo("<TD valign=top><img src=Images/PublicBlankSpace.gif border=0 width=125 height=0><BR><font size=1>");
	echo($folder_array[$down_folder_id]["folder_time"]);
	echo("</font></TD>");
	echo("</TR>");
}

function show_document($document_id){
	global $teacher_id, $document_array;
	echo("<TR>");
	echo("<TD valign=top>");
	if (empty($document_array[$document_id]["document_file"])){
		echo("<img src=Images/DocumentTextDocument.gif>");
	}else{
		echo("<img src=Images/DocumentFileDocument.gif>");
	}
	echo("</TD>");
	echo("<TD width=100%>");
	echo("<a href=\"DocumentDocument.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id . "\">" . $document_array[$document_id]["document_title"] . "</a>");
	echo("</TD>");
	echo("<TD valign=top><img src=Images/PublicBlankSpace.gif border=0 width=125 height=0><BR><font size=1>");
	echo($document_array[$document_id]["document_time"]);
	echo("</font></TD>");
	echo("</TR>");
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$folder_array = array();
$folder_array[0]["up_folder_id"] = 0;
$folder_array[0]["folder_name"] = "文件區";
$folder_array[0]["folder_time"] = "";
$str = "Select up_folder_id, folder_id, folder_name, folder_time From document_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_up_folder_id, $array_folder_id, $array_folder_name, $array_folder_time) = mysql_fetch_row($result)){
	$folder_array[$array_folder_id]["up_folder_id"] = $array_up_folder_id;
	$folder_array[$array_folder_id]["folder_name"] = htmlspecialchars($array_folder_name);
	$folder_array[$array_folder_id]["folder_time"] = $array_folder_time;
}

if ($folder_id == 0){
	$folder_explain = $homepage_title . "的文件區。";
}else{
	$str = "Select folder_explain From document_folder Where folder_id = '" . func_escape_string($folder_id) . "'";
	$result = QueryDatabase($str);
	list($folder_explain) = mysql_fetch_row($result);
	$folder_explain = nl2br(htmlspecialchars($folder_explain));
}

$document_array = array();
$str = "Select document_id, document_title, document_file, document_time From document_document Where teacher_id = '" . func_escape_string($teacher_id) . "' And folder_id = '" . func_escape_string($folder_id) . "'";
$result = QueryDatabase($str);
while (list($array_document_id, $array_document_title, $array_document_file, $array_document_time) = mysql_fetch_row($result)){
	$document_array[$array_document_id]["document_title"] = htmlspecialchars($array_document_title);
	$document_array[$array_document_id]["document_file"] = $array_document_file;
	$document_array[$array_document_id]["document_time"] = $array_document_time;
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 文件區</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">
<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">文 . 件 . 區</font></TD>
	<TD>
	<a href="Document.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_array[$folder_id]["up_folder_id"]); ?>"><IMG SRC="Images/PublicFolderUpButton.gif" BORDER=0 ALT="上移一層"></a></TD>
	<TD>
	<a href="DocumentDocumentAdd.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/DocumentDocumentAddButton.gif" BORDER=0 ALT="新增文件"></a></TD>
	<TD>
	<a href="DocumentFolderAdd.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/PublicFolderAddButton.gif" BORDER=0 ALT="新增資料夾"></a></TD>
	<TD>
	<a href="DocumentFolderEdit.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/PublicFolderEditButton.gif" BORDER=0 ALT="修改資料夾"></a></TD>
	<TD>
	<a href="DocumentFolderMove.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/PublicFolderMoveButton.gif" BORDER=0 ALT="搬移資料夾"></a></TD>
	<TD>
	<a href="DocumentFolderDelete.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/PublicFolderDeleteButton.gif" BORDER=0 ALT="刪除資料夾"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
<TR><TD><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="1" height="10"></TD><TD></TD></TR>
<TR>
	<TD valign="top">

	<? display_frame($homepage_theme, 0); ?>

	<CENTER><font color="#FFFFFF">資 . 料 . 夾 . 路 . 徑</font></CENTER>

	<? display_frame($homepage_theme, 1); ?>

	<?
	$router_folder_path_str = "";
	$router_folder_id = $folder_id;
	while($router_folder_id != 0){
		$router_folder_path_str = router_folder_path($router_folder_path_str, $router_folder_id);
		$router_folder_id = $folder_array[$router_folder_id]["up_folder_id"];
	}
	$router_folder_path_str = router_folder_path($router_folder_path_str, 0);
	echo($router_folder_path_str);
	?>

	<? display_frame($homepage_theme, 2); ?>


	</TD>
	<TD><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="10" height="1"></TD>
	<TD width="100%" valign="top">

	<TABLE border="0" cellpadding="1" cellspacing="2">
	<TR>
		<TD valign="top"><IMG SRC="Images/PublicFolderOpenBI.gif" BORDER="0"></TD>
		<TD width="100%"><B><font size="3" color="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR3"]); ?>"><? echo($folder_array[$folder_id]["folder_name"]); ?><font></B></TD>
	</TR>
	<TR>
		<TD valign="top"></TD>
		<TD width="100%">

		<TABLE border="0" cellpadding="0" cellspacing="0"><TR><TD><? echo($folder_explain); ?></TD></TR></TABLE>

		<BR>

		<TABLE border="0">
		<?
		asort($folder_array);
		while (list($down_folder_id) = each($folder_array)){
			if ($folder_array[$down_folder_id]["up_folder_id"] == $folder_id && $down_folder_id != 0) show_folder($down_folder_id);
		}

		asort($document_array);
		while (list($document_id) = each($document_array)){
			show_document($document_id);
		}
		?>
		</TABLE>
		</TD>
	</TR>
	</TABLE>

	</TD>
</TR>
</TABLE>

</BODY>
</HTML>