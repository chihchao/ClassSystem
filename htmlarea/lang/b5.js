// I18N constants

// LANG: "en", ENCODING: UTF-8 | ISO-8859-1
// Author: Mihai Bazon, http://dynarch.com/mishoo

// FOR TRANSLATORS:
//
//   1. PLEASE PUT YOUR CONTACT INFO IN THE ABOVE LINE
//      (at least a valid email address)
//
//   2. PLEASE TRY TO USE UTF-8 FOR ENCODING;
//      (if this is not possible, please include a comment
//       that states what encoding is necessary.)

HTMLArea.I18N = {

	// the following should be the filename without .js extension
	// it will be used for automatically load plugin language.
	lang: "b5",

	tooltips: {
		bold:           "粗體",
		italic:         "斜體",
		underline:      "底線",
		strikethrough:  "刪除線",
		subscript:      "下標",
		superscript:    "上標",
		justifyleft:    "位置靠左",
		justifycenter:  "位置居中",
		justifyright:   "位置靠右",
		justifyfull:    "位置左右平等",
		insertorderedlist:    "編號項目",
		insertunorderedlist:  "項目符號",
		outdent:        "減小行前空白",
		indent:         "加寬行前空白",
		forecolor:      "文字顏色",
		hilitecolor:    "背景顏色",
		inserthorizontalrule: "水平線",
		createlink:     "插入超連結",
		insertimage:    "插入圖形",
		inserttable:    "插入表格",
		htmlmode:       "切換HTML原始碼",
		popupeditor:    "放大",
		about:          "關於 HTMLArea",
		showhelp:       "說明",
		textindicator:  "字體例子",
		undo:           "復原",
		redo:           "取消復原",
		cut:            "剪下",
		copy:           "複製",
		paste:          "貼上",
		lefttoright:    "Direction left to right",
		righttoleft:    "Direction right to left"
	},

	buttons: {
		"ok":           "確定",
		"cancel":       "取消"
	},

	msg: {
		"Path":         "路徑",
		"TEXT_MODE":    "您現在正在看的是 HTML 信件的原始碼. 請按下 [<>] 按鈕回到 HTML 編輯模式.",

		"IE-sucks-full-screen" :
		// translate here
		"The full screen mode is known to cause problems with Internet Explorer, " +
		"due to browser bugs that we weren't able to workaround.  You might experience garbage " +
		"display, lack of editor functions and/or random browser crashes.  If your system is Windows 9x " +
		"it's very likely that you'll get a 'General Protection Fault' and need to reboot.\n\n" +
		"You have been warned.  Please press OK if you still want to try the full screen editor."
	},

	fontname: {
		"細明體":           '細明體',
		"標楷體":           '標楷體',
		"Arial":           'arial,helvetica,sans-serif',
		"Courier New":     'courier new,courier,monospace',
		"Georgia":         'georgia,times new roman,times,serif',
		"Tahoma":          'tahoma,arial,helvetica,sans-serif',
		"Times New Roman": 'times new roman,times,serif',
		"Verdana":         'verdana,arial,helvetica,sans-serif',
		"impact":          'impact',
		"WingDings":       'wingdings'
	},

	fontsize: {
		"1 (8 點)":  "1",
		"2 (10 點)": "2",
		"3 (12 點)": "3",
		"4 (14 點)": "4",
		"5 (18 點)": "5",
		"6 (24 點)": "6",
		"7 (36 點)": "7"
	},

	formatblock: {
		"標題 1": "h1",
		"標題 2": "h2",
		"標題 3": "h3",
		"標題 4": "h4",
		"標題 5": "h5",
		"標題 6": "h6",
		"段落": "p",
		"位址": "address",
		"已格式化": "pre"
	},

	dialogs: {
		"Cancel"                                            : "Cancel",
		"Insert/Modify Link"                                : "Insert/Modify Link",
		"New window (_blank)"                               : "New window (_blank)",
		"None (use implicit)"                               : "None (use implicit)",
		"OK"                                                : "OK",
		"Other"                                             : "Other",
		"Same frame (_self)"                                : "Same frame (_self)",
		"Target:"                                           : "Target:",
		"Title (tooltip):"                                  : "Title (tooltip):",
		"Top frame (_top)"                                  : "Top frame (_top)",
		"URL:"                                              : "URL:",
		"You must enter the URL where this link points to"  : "You must enter the URL where this link points to"
	}
};
