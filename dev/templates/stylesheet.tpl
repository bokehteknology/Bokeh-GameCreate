* {
	margin: 0;
	padding: 0;
}

body {
	font: 12px/14px Arial, Helvetica, sans-serif;
	color: #666;
	text-align: left;
	background: #f7f7f7 url({U_images/background.gif}) repeat-x;
}

/* Styles */

a { color: #0088cc; text-decoration: none;}
a:hover { text-decoration: underline;}
a img { border: none;}

p { margin: 0px 0px 20px 0px; line-height: 18px;}

ul { margin: 5px 0px 15px 0px; padding: 0px;}
li { margin-left: 20px;}

#notice {
	clear: both;
	margin: 0 0 15px;
	padding: 0 10px;
	background: #fffbcc;
	border: 1px solid #e6db55;
	line-height: 25px;
	color: #222;
}

#succeed {
	clear: both;
	margin: 0 0 15px;
	padding: 0 10px;
	background: #d1ecb8;
	border: 1px solid #81c445;
	line-height: 25px;
	color: #222;
}

#error {
	clear: both;
	margin: 0 0 15px;
	padding: 0 10px;
	background: #ffebe8;
	border: 1px solid #f0baa2;
	line-height: 25px;
	color: #222;
}

.clear { clear:both;}

/* Header */

#header {
	height: 45px;
	margin: 0 auto;
	padding: 0 20px;
	max-width: 1280px;
	min-width: 760px;
}

#header h1 {
	float: left;
	font: bold 20px/21px Helvetica, Arial, sans-serif;
	line-height: 45px;
}

#header h1 a {
	color: #fff;
	text-decoration: none;
}

#header .menu {
	float: right;
	line-height: 45px;
}

#header .menu a {
	color: #fff;
}

/* Wrapper */

#wrapper {
	margin: 0 auto;
	padding: 25px 20px;
	max-width: 1280px;
	min-width: 760px;
	padding-bottom:90px;
}

#wrapper h2 {
	margin: 0 0 10px;
	font: bold 20px/21px Helvetica, Arial, sans-serif;
	color: #333;
}

.box {
	margin: 0 0 20px;
	padding: 15px 15px 0 15px;
	border: 1px solid #e8e8e8;
	background: #fff;
	position: relative;
}

.boxsearch {
	margin: 0 0 0 0;
	padding: 0 0 0 15px;
	background: #fff;
	position: relative;
}

/* Sidebar */

#sidebar {
	float: left;
	width: 220px;
	position: relative;
}

/* Navigation */

.navigation {
	margin: 0 0 20px;
	background: #fff;
	border-left: 1px solid #e8e8e8;
	border-right: 1px solid #e8e8e8;
	border-bottom: 1px solid #e8e8e8;
}

.navigation ul {
	margin: 0;
	padding: 0;
	list-style: none;
}

.navigation ul li {
	margin: 0;
	padding: 0 15px;
	border-top: 1px solid #e8e8e8;
	background: url({U_images/navigation-off.gif}) repeat-x;
	line-height: 24px;
	height: 100%;
	display: block;
	font-size: 12px;
}

.navigation ul li a {
	color: #666;
	height: 100%;
	width: 100%;
	display: block;
}

.navigation ul li.active {
	background: url({U_images/navigation-on.gif}) repeat-x;
}

.navigation ul li.active a {
	color: #fff;
}

.navigation ul li ul {
	margin: 5px 0;
}

.navigation ul li ul li {
	margin: 0;
	padding: 0;
	font-size: 11px;
	border: none;
	background: none;
}

.navigation ul li ul li a {
	color: #0088cc;
}

/* Search */

#search-form {
	height: 33px;
}

.search-input {
	border: 1px solid #d2d2d2;
	width: 133px;
	height: 12px;
	padding: 3px 5px;
	position: absolute;
	font-size: 11px;
}

.search-submit {
	left: 160px;
	position: absolute;
}

/* Blog */

#blog li {
	margin: 0;
	padding: 0;
	list-style: none;
}

#blog li h4 {
	margin: 0 0 5px;
	font-size: 12px;
	font-weight: normal;
}

#blog li h4 abbr {
	font-size: 10px;
	color: #999;
	border: none;
}

/* Content */

#content {
	padding-left: 240px;
}

#content h3 {
	margin: 0 0 15px;
	padding: 0 0 10px;
	color: #222;
	font-size: 16px;
	border-bottom: 1px dotted #d2d2d2;
}

#content h4 {
	margin: 0 0 15px;
	color: #222;
	font-size: 14px;
}

/* Pagination */

.pagination {
	text-align: right;
	display: block;
	margin: 0 0 15px;
	font-weight: bold;
	position: relative;
}

.pagination ul {
	margin: 0;
	padding: 0;
	list-style: none;
}

.pagination ul li {
	display: inline;
	margin: 0 5px 0 0;
	padding: 0;
	color: #222;
}

.pagination ul li a {
}

/* Footer */

#footer {
	background: #fff;
	border: 0x solid #e8e8e8;
	padding-bottom:8px;
	height: 10px;
	clear: both;
}

#footer .left { float: left;}
#footer .right { float: right;}

.delserver a { color: #FF0000; text-decoration: none;}
.delserver { color: #FF0000; text-decoration: none;}

.suspendserver a { color: #FAC000; text-decoration: none;}
.suspendserver { color: #FAC000; text-decoration: none;}

.editserver a { color: #34E000; text-decoration: none;}
.editserver { color: #34E000; text-decoration: none;}

.visibleDiv, #footerstatuswrap
{
    position: fixed;
    width: 100%;
    height: 90px;
    vertical-align: middle;
    text-align: left;
    background: #fff;
    border: 1px solid #e8e8e8;
}


#footerstatuswrap
{
    bottom: 0px;
    overflow:auto;
}

/* Table Style */

table {
/*	width: 99%;*/
	height: 100%;
	margin: 0 0 15px;
	text-align: left;
	border-collapse: collapse;
}

table thead,
table tfoot {
	background: url({U_images/background-table.gif}) repeat-x;
}

table th {
	font-weight: bold;
	padding: 5px 8px;
	color: #444;
}

table td {
	padding: 8px;
	color: #444;
	border-bottom: 1px solid #d2d2d2;
}

table td span.active { color: #55a34a;}
table td span.pending { color: #c5a059;}
table td span.closed { color: #a02b2b;}

table .odd {
	background: #f6f6f6; 
}

/* Form Style */

form ul li {
	margin: 0 0 15px;
	padding: 0;
	list-style: none;
}

form ul li label {
	color: #222;
	font-weight: bold;
	font-size: 12px;
}

label.note {
	color: #444;
	font-weight: normal;
	font-size: 10px;
}

label.choice {
	margin: 0 15px 0 0;
	font-weight: normal;
	font-size: 12px;
	color: #666;
}

input.text,
textarea {
	margin: 5px 0 5px 0;
	padding: 3px 5px;
	border: 1px solid #d2d2d2;
	font-size: 12px;
}

input.radio,
input.checkbox,
input.file {
	margin: 5px 5px 0 0;
}

input.button {
	padding: 0 5px 3px 5px;
	font-size: 12px;
}

select.drop {
	font-size: 12px;
	margin: 5px 5px 0 0;
	border: 1px solid #d2d2d2;
}

input.short { width: 20%;}
input.medium { width: 45%;}
input.long { width:70%;}
input.max { width: 95%;}

.success {
	color: #008000;
}

.error, .req {
	color: #d8122d;
	font-weight: normal;
}