* {
	margin: 0;
	padding: 0;
}

body {
	font: 12px/14px Arial, Helvetica, sans-serif;
	color: #666;
	text-align: left;
	background: #404040;
}

a { color: #0088cc; text-decoration: none;}
a:hover { text-decoration: underline;}
a img { border: none;}

p { margin: 0px 0px 20px 0px; line-height: 18px;}

#box {
	margin: 40px auto;
	padding: 25px;
	width: 400px;
	background: #fff;
}

#box h2 {
	font-size: 28px;
	font-weight: bold;
	margin: 0 0 20px;
	text-align: center;
}

.light {
	color: #ccc;
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