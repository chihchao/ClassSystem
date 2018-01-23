<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$password = StripSlashes($_POST["password"]);

//page=======================
NoCache();

if ($password != $APPLY_PASSWORD){
	include("PublicPassword.php");
	exit();
}
?>
<HTML>
<HEAD><meta http-equiv="content-type" content="text/html; charset=BIG5" />
<TITLE>班級網頁系統 → 申請班級網頁</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<? function_bar(0, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
				<TR>
					<TD width="100%"><font color="#FFFFFF">申 . 請 . 班 . 級 . 網 . 頁</font></TD>
					<TD>
					<a href="index.php"><IMG SRC="Images/ApplyReturnButton.gif" BORDER=0 ALT="回班級網頁系統"></a></TD>
				</TR>
				</TABLE>

<? function_bar(0, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="ApplyDB.php">
<TABLE>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="60" height="0"><BR>老師帳號：</TD>
	<TD><INPUT TYPE="text" NAME="teacher_account" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師密號：</TD>
	<TD><INPUT TYPE="password" NAME="teacher_password" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師姓名：</TD>
	<TD><INPUT TYPE="text" NAME="teacher_name" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">老師信箱：</TD>
	<TD><INPUT TYPE="text" NAME="teacher_email" size="40"></TD>
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
		if ($option_counter == 1) echo(" selected");
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
		if ($option_counter == 1) echo(" selected");
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
	<TD><INPUT TYPE="password" NAME="manage_password" size="40"><BR><font color="#FF0000">※</font> 請注意，管理密碼不可和老師密碼相同，否則管理者將擁有和老師一樣的權限。</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">班級密碼：</TD>
	<TD><INPUT TYPE="password" NAME="class_password" size="40"><BR><font color="#FF0000">※</font> 請注意，班級密碼不可和老師密碼、管理密碼相同，否則班級使用者將擁有和老師、管理者一樣的權限。</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">網站名稱：</TD>
	<TD><INPUT TYPE="text" NAME="homepage_title" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">首頁圖片：</TD>
	<TD><INPUT TYPE="file" NAME="uploadfile" size="40"><BR><font color="#FF0000">※</font> 可使用檔案類型包括 JPG、GIF、SWF（Flash）。</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">首頁文字：</TD>
	<TD><TEXTAREA NAME="homepage_describe" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">佈景類型：</TD>
	<TD>
	<INPUT TYPE="radio" NAME="homepage_theme" value="0" checked><img src="Images/PublicTheme0.gif" border="1" align="top">　　
	<INPUT TYPE="radio" NAME="homepage_theme" value="1"><img src="Images/PublicTheme1.gif" border="1" align="top"><BR><BR>
	<INPUT TYPE="radio" NAME="homepage_theme" value="2"><img src="Images/PublicTheme2.gif" border="1" align="top">
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">起始人數：</TD>
	<TD><INPUT TYPE="text" NAME="homepage_counter" size="40" value="0"></TD>
</TR>
<TR>
	<TD valign="top"></TD>
	<TD valign="top"></TD>
	<TD><INPUT TYPE="hidden" name="password" value="<? echo($password); ?>"><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="清除"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>