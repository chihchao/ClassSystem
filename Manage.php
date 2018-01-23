<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);

if (empty($teacher_id)) exit();

//function===================
function show_page($page_str){
	global $HOMEPAGE, $homepage_theme, $teacher_id, $PAGE_AUTHENTICATE_USER, $page_str_array, $link_str_array, $auth_str_array, $user_str_array;
	echo("<TABLE border=0 WIDTH=100% bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><TR><TD>" . $page_str_array[$page_str] . "</TD></TR></TABLE>");
	echo("<TABLE><TR><TD valign=top><img src=Images/PublicPointer.gif border=0></TD><TD valign=top>網址：</TD>");
	echo("<TD>http://" . $_SERVER["SERVER_NAME"] . str_replace("Manage.php", "", $_SERVER["SCRIPT_NAME"]) . $link_str_array[$page_str] . "?teacher_id=" . $teacher_id . "</TD></TR>");
	echo("<TR><TD valign=top><img src=Images/PublicPointer.gif border=0></TD><TD valign=top>權限：</TD><TD>");
	while (list($auth_str) = each($PAGE_AUTHENTICATE_USER[$page_str])){
		echo($auth_str_array[$auth_str]);
		echo(" → ");
		echo($user_str_array[$PAGE_AUTHENTICATE_USER[$page_str][$auth_str]]);
		echo("<BR>");
	}
	echo("</TD></TR></TABLE>");
	echo("<BR>");
}

//page=======================
NoCache();

LinkDatabase();

$str = "Select teacher_account, teacher_password, teacher_name, teacher_email, grade, class_number, homepage_theme, homepage_title, homepage_describe, homepage_counter, class_password, apply_time, homepage_image, manage_password, function From teacher Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
if (!(list($teacher_account, $teacher_password, $teacher_name, $teacher_email, $grade, $class_number, $homepage_theme, $homepage_title, $homepage_describe, $homepage_counter, $class_password, $apply_time, $homepage_image, $manage_password, $function) = mysql_fetch_row($result))) exit();
$homepage_account = htmlspecialchars($homepage_account);
$homepage_image = htmlspecialchars($homepage_image);

$login_user = login($PAGE_AUTHENTICATE_USER["MANAGE"]["EDIT"]);

$page_str_array["DOCUMENT"] = "文件區";
$page_str_array["PHOTO"] = "相片區";
$page_str_array["LINK"] = "連結區";
$page_str_array["BOARD"] = "公告區";
$page_str_array["CALENDAR"] = "行事曆";
$page_str_array["DISCUSS"] = "討論區";
$page_str_array["MESSAGE"] = "留言區";
$page_str_array["MANAGE"] = "管理區";

$link_str_array["DOCUMENT"] = "Document.php";
$link_str_array["PHOTO"] = "Photo.php";
$link_str_array["LINK"] = "Link.php";
$link_str_array["BOARD"] = "Board.php";
$link_str_array["CALENDAR"] = "Calendar.php";
$link_str_array["DISCUSS"] = "Discuss.php";
$link_str_array["MESSAGE"] = "Message.php";
$link_str_array["MANAGE"] = "Manage.php";

$auth_str_array["ADD"] = "新增";
$auth_str_array["DELETE"] = "刪除";
$auth_str_array["EDIT"] = "編輯";
$auth_str_array["MOVE"] = "搬移";
$auth_str_array["POST"] = "張貼";
$auth_str_array["REPLY"] = "回應";

$user_str_array["teacher"] = "老師";
$user_str_array["manager"] = "管理者";
$user_str_array["classuser"] = "班級使用者";
$user_str_array["everybody"] = "所有人";
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 管理區</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar(0, 0); ?>

<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">管 . 理 . 區</font></TD>
	<TD>
	<a href="Homepage.php?teacher_id=<? echo($teacher_id); ?>" target="_top"><IMG SRC="Images/ManageRetrunButton.gif" BORDER=0 ALT="回班級網頁"></a></TD>
	<TD>
</TR>
</TABLE>

<? function_bar(0, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="ManageDB.php">
<TABLE>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="60" height="0"><BR>老師帳號：</TD>
	<TD><? echo($teacher_account); ?></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師密號：</TD>
	<TD><INPUT TYPE="password" NAME="teacher_password" size="40" value="<? echo($teacher_password); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師姓名：</TD>
	<TD><INPUT TYPE="text" NAME="teacher_name" size="40" value="<? echo($teacher_name); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師信箱：</TD>
	<TD><INPUT TYPE="text" NAME="teacher_email" size="40" value="<? echo($teacher_email); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">年級班級：</TD>
	<TD>
	<select name="grade">
	<?
	reset($GRADE_ARRAY);
	while (list($option_counter) = each($GRADE_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == $grade) echo(" selected");
		echo(">");
		echo($GRADE_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> 年
	<select name="class_number">
	<?
	reset($CLASS_NUMBER_ARRAY);
	while (list($option_counter) = each($CLASS_NUMBER_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == $class_number) echo(" selected");
		echo(">");
		echo($CLASS_NUMBER_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> 班
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">管理密碼：</TD>
	<TD><INPUT TYPE="password" NAME="manage_password" size="40" value="<? echo($manage_password); ?>"><BR><font color="#FF0000">※</font> 請注意，管理密碼不可和老師密碼相同，否則管理者將擁有和老師一樣的權限。</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">班級密碼：</TD>
	<TD><INPUT TYPE="password" NAME="class_password" size="40" value="<? echo($class_password); ?>"><BR><font color="#FF0000">※</font> 請注意，班級密碼不可和老師密碼、管理密碼相同，否則班級使用者將擁有和老師、管理者一樣的權限。</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">網站名稱：</TD>
	<TD><INPUT TYPE="text" NAME="homepage_title" size="40" value="<? echo($homepage_title); ?>"></TD>
</TR>
<!-- By 蔡俊彥-->
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">開放功能：</TD>
	<TD>
	<?
		if ( stristr($function, 'a') ){
			echo ("<input type=checkbox name=function_a value=a checked>");
        }else{
			echo ("<input type=checkbox name=function_a value=a>");
        }
		echo($page_str_array["DOCUMENT"] . "　");
		if ( stristr($function, 'b') ){
			echo ("<input type=checkbox name=function_b value=b checked>");
        }else{
			echo ("<input type=checkbox name=function_b value=b>");
        }
		echo($page_str_array["PHOTO"] . "　");
		if ( stristr($function, 'c') ){
			echo ("<input type=checkbox name=function_c value=c checked>");
        }else{
			echo ("<input type=checkbox name=function_c value=c>");
        }
		echo($page_str_array["LINK"] . "　");
		if ( stristr($function, 'd') ){
			echo ("<input type=checkbox name=function_d value=d checked>");
        }else{
			echo ("<input type=checkbox name=function_d value=d>");
        }
		echo($page_str_array["BOARD"] . "　");
		if ( stristr($function, 'e') ){
			echo ("<input type=checkbox name=function_e value=e checked>");
        }else{
			echo ("<input type=checkbox name=function_e value=e>");
        }
		echo($page_str_array["CALENDAR"] . "　");
		if ( stristr($function, 'f') ){
			echo ("<input type=checkbox name=function_f value=f checked>");
        }else{
			echo ("<input type=checkbox name=function_f value=f>");
        }
		echo($page_str_array["DISCUSS"] . "　");
		if ( stristr($function, 'g') ){
			echo ("<input type=checkbox name=function_g value=g checked>");
        }else{
			echo ("<input type=checkbox name=function_g value=g>");
        }
		echo($page_str_array["MESSAGE"] . "　");
	?>
	</TD>
</TR>
<!-------------->
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">首頁圖片：</TD>
	<TD>
	<?
	if (empty($homepage_image)){
		echo("目前沒有首頁圖片，如果想加入首頁圖片，請選擇一張圖片。");
	}else{
		echo("目前圖片是『" . $homepage_image . "』，如果想改換別的圖片，請重新選擇一張新的圖片。");
	}
	?>
	<BR><INPUT TYPE="file" NAME="uploadfile" size="40">
	<? if (!empty($homepage_image)) echo("<BR><INPUT TYPE=checkbox NAME=homepage_image_delete value=delete>如果你要刪除首頁圖片請勾選這個項目。"); ?>
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">首頁文字：</TD>
	<TD><TEXTAREA NAME="homepage_describe" ROWS="8" COLS="40"><? echo($homepage_describe); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">佈景類型：</TD>
	<TD>
	<?
	$option_counter = 0;
	while ($option_counter <= 2){
		if ($option_counter == 1) echo("　　");
		if ($option_counter == 2) echo("<BR><BR>");
		echo("<INPUT TYPE=radio NAME=homepage_theme value=" . $option_counter);
		if ($option_counter == $homepage_theme) echo(" checked");
		echo(">");
		echo("<img src=Images/PublicTheme" . $option_counter . ".gif border=1 align=top>");
		$option_counter ++;
	}
	?>
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">起始人數：</TD>
	<TD><INPUT TYPE="text" NAME="homepage_counter" size="40" value="<? echo($homepage_counter); ?>"></TD>
</TR>
<TR>
	<TD valign="top"></TD>
	<TD valign="top">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="重置"></TD>
</TR>
</TABLE>
</FORM>

<HR width=100% size=1 color="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR3"]); ?>">

<?
while (list($page_str) = each($PAGE_AUTHENTICATE_USER)){
	show_page($page_str);
}
?>

</BODY>
</HTML>