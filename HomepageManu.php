<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();
session_start();

LinkDatabase();
$str = "Select function From teacher Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
if (!(list($function) = mysql_fetch_row($result))) exit();
GetThemeTitle();
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<TITLE><? echo($homepage_title); ?></TITLE>
<base target="HomepageMain">
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR2"]); ?>" topmargin="10" leftmargin="0">

<TABLE border="0" width="100%">
<?if ( stristr($function, 'a') ){?>
<TR>
	<TD align="center"><a href="Document.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuDocumentButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="文件區"></a></TD>
</TR>
<?}if ( stristr($function, 'b') ){?>
<TR>
	<TD align="center"><a href="Photo.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuPhotoButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="相片區"></a></TD>
</TR>
<?}if ( stristr($function, 'c') ){?>
<TR>
	<TD align="center"><a href="Link.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuLinkButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="連結區"></a></TD>
</TR>
<?}if ( stristr($function, 'd') ){?>
<TR>
	<TD align="center"><a href="Board.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuBoardButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="公告區"></a></TD>
</TR>
<?}if ( stristr($function, 'e') ){?>
<TR>
	<TD align="center"><a href="Calendar.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuCalendarButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="行事曆"></a></TD>
</TR>
<?}if ( stristr($function, 'f') ){?>
<TR>
	<TD align="center"><a href="Discuss.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuDiscussButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="討論區"></a></TD>
</TR>
<?}if ( stristr($function, 'g') ){?>
<TR>
	<TD align="center"><a href="Message.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuMessageButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="留言區"></a></TD>
</TR>
<?}?>
<TR>
	<TD align="center"><a href="Manage.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuManageButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="管理區"></a></TD>
</TR>
<TR>
	<TD align="center"><a href="HomepageMain.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/HomepageManuReturnButton<? echo($homepage_theme); ?>.gif" BORDER=0 ALT="回首頁"></a></TD>
</TR>
</TABLE>
<br><br>
<?
if ( (! empty($_SESSION["user_id"]) ) && ($_SESSION["user_id"] == $teacher_id) ){
    switch ($_SESSION["user_level"]){
     case "teacher":
          $user_level_str = "班級老師";
          break;
     case "manager":
          $user_level_str = "班級管理者";
          break;
     case "classuser":
          $user_level_str = "班級使用者";
          break;
    }
	echo("<center>");
	echo("<font face=Arial color=#FFFFFF>" . $user_level_str);
	echo("<br><a href='Logout.php?teacher_id=" . $teacher_id . "'>【登出】</a></font>");
}
?>
</BODY>
</HTML>