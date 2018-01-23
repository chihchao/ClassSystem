<?
function show_board($board_id){
	global $teacher_id, $board_array;
	echo("<TR><TD valign=top><IMG SRC=Images/PublicPointer.gif BORDER=0></TD><TD valign=top>");
	echo("<a href=BoardContent.php?teacher_id=" . $teacher_id . "&board_id=" . $board_id . ">");
	echo($board_array[$board_id]["title"]);
	echo("</a>");
	echo("</TD><TD align=center valign=top><font size=1>");
	echo($board_array[$board_id]["date_time"]);
	echo("</font></TD></TR>");
}

$list_counter = 0;
$list_numbers = 10;
$board_array = array();
if ($list_all){
	$str = "Select board_id, title, date_time From board Where teacher_id = '" . func_escape_string($teacher_id) . "' Order By date_time DESC";
}else{
	$str = "Select board_id, title, date_time From board Where teacher_id = '" . func_escape_string($teacher_id) . "' Order By date_time DESC Limit 0, " . ($list_numbers + 1);
}
$result = QueryDatabase($str);
while(list($board_id, $title, $date_time) = mysql_fetch_row($result)){
	$board_array[$board_id]["title"] = htmlspecialchars($title);
	$board_array[$board_id]["date_time"] = $date_time;
	$list_counter ++;
}
?>

<? display_frame($homepage_theme, 0); ?>

		<TABLE border="0">
		<TR>
			<TD width="100%"><font color="#FFFFFF">公 . 告 . 區</font></TD>
			<TD><a href="BoardPost.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/BoardPostButton.gif" BORDER=0 ALT="張貼公告"></a></TD>
		</TR>
		</TABLE>

<? display_frame($homepage_theme, 1); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD></TD>
			<TD width="100%"></TD>
			<TD><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="125" height="1"></TD>
		</TR>
			<?
			reset($board_array);
			$i = 0;
			while ((list($board_id) = each($board_array)) && ($i < $list_numbers || $list_all)){
				show_board($board_id);
				$i ++;
			}
			?>
		<? if (!$list_all && $list_counter > $list_numbers) echo("<TR><TD></TD><TD><a href=\"Board.php?teacher_id=" . $teacher_id . "\">. . . 更多公告 . . .</a></TD><TD></TD></TR>"); ?>
		</TABLE>

<? display_frame($homepage_theme, 2); ?>
