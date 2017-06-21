/* CSS version 2.0, by Boris Cherny. */
/*Many thanks to Andreas, NickyD, ditchCrawler, TomW, whowrotewhat, hash bar, and Sanden Cottongame */
* {
	border: 0;
	margin: 0;
	padding: 0;
}
body {
	background: #DEDEDE;
	color: #9A9A9A;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 69%;
	text-align: center;
}
a {
	color: #303030;
	text-decoration: underline;
}
a:hover {
	color: #303030;
	text-decoration: none;
}
acronym {
	border-bottom: 1px dashed #999999;
	cursor: help;
}
h1 {
	border-bottom: 1px solid #C3C3C3;
	border-top: 1px solid #C3C3C3;
	border-right: 20px solid #656c6f;
	color: #FFFFFF;
	font-size: 130%;
	font-weight: normal;
	margin: 5px 0;
	background: #EF7700;
}

fieldset {
	border: 1px solid #C3C3C3;
	padding: 5px;
}

input {
	width: 100px;
	border: 1px solid #C1C3C1;
}

countries {
	color: #303030;
	border: 1px solid #C1C3C1;
}

#column2 ul {
	margin: 10px 0;
}
#column2 li {
	color: #999999;
	list-style: square inside;
	text-indent: 10px;
}
/* The background-image's for the #wrap below are for preloading all the page's images, just add your own images to the pattern */
#wrap {
	background-image: url(/images/arrow.gif);
	background-image: url(/images/arrow_outline.gif);
	background-image: url(/images/background.gif);
	background-image: url(/images/header_big.gif);
	background-image: url(/images/selector.gif);
	background-image: url(/images/selector_sub.gif);
	background-repeat: no-repeat;
	background-position: -5000px -5000px;
	margin: 0 auto;
	text-align: left;
	width: 800px;
}
#header {
	background: url(/images/header_big.gif) center no-repeat;
	color: #e0e0e0;
	font-size: 300%;
	font-weight: bold;
	height: 60px;
	line-height: 60px;
	text-indent: 150px;
	border-top: solid 1px #C3C3C3;
	border-left: solid 1px #C3C3C3;
	border-right: solid 1px #C3C3C3;
}
#nav {
	padding-left: 1px;
	width: 185px;

}

#regnav {
	padding-bottom: 610px;
	width: 179px;
	border-right: 1px solid #D0D0D0;
}

#nav ul li {
	display: inline;
	line-height: 16px;
	list-style: none;
}

#regnav ul li {
	display: inline;
	line-height: 16px;
	list-style: none;
}

#nav ul li a {
	border-bottom: 1px solid #D0D0D0;
	color: #303030;
	display: block;
	padding: 5px;
	text-decoration: none;
	width: 169px;
}

#regnav ul li a {
	border-bottom: 1px solid #D0D0D0;
	color: #303030;
	display: block;
	padding: 5px;
	text-decoration: none;
	width: 169px;
}

/* remove the 'text-decoration: underline;' in #nav li a:hover if you don't want the links in the left nav menu to be underlined when the user hovers over them with their mouse */
#nav li a:hover {
	background: #C3C3C3;
	color: #000;
}

#regnav li a:hover {
	background: #C3C3C3;
	color: #000;
}

#column1 {
	float: left;
	width: 190px;
	background-color: #FFFFFF;
}
#column1 img {
	border: 1px solid #c9dcea;
	margin: 5px 20px;
	padding: 10px 20px;
}
/* in the tag below, #column2, I used the Underscore Hack to give the column2 div the correct margins in Firefox 1 */
#column2 {
	float: none !important;
	float: right;
	margin-left: 192px !important;
	margin-left: 0;
	padding: 15px 25px 25px 25px;
	background-color: #FFFFFF;
	
}

#column5 {
	float: none !important;
	float: right;
	padding: 12px 20px 20px 20px;
	background-color: #FFFFFF;
}

#column2 p {
	line-height: 190%;
}
#links div {
	float: left;
	width: 140px;
}
#links div li {
	list-style: none;
}
#links div li a {
	background: url(/images/arrow_outline.gif) left no-repeat;
	padding-left: 15px;
	text-decoration: none;
}
#links div li a:hover {
	background-image: url(/images/arrow.gif);
	color: #ac835c;
	text-decoration: underline;
}
#footer {
	clear: both;
	color: #999;
	font-size: 9px;
	padding: 30px 0 10px 0;
	text-indent: 185px;
}
#footer a {
	color: #999999;
	text-decoration: underline;
}.rbenter1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #9A9A9A;
	background-color: #FFFFFF;
	left: 0px;
	text-align: left;
	text-indent: 0px;
	float: left;
	clear: left;
	width: auto;
	background-position: left;
	white-space: normal;
	padding-left: 0px;
	clip: rect(auto,auto,auto,0px);
	border: thin solid #7F9DB9;
}
    /**
     * Forms
     */

    div.error {
        background : #FF0000;
        padding    : 5px;
        margin     : 5px 0;
        color      : #fff;
    }

    form .row div.error {
        font-size : 0.8em;
        line-height : 1em;
    }

    form .row { margin : 10px 0; clear : both; }

    form .row label {
        width       : 150px;
        float       : left;
        display     : block;
        font-weight : bold;
    }

    form .row input[type=text] { width : 175px; }
    form .row input[type=password] { width : 175px; }
    
    form .area input[type=text] { width : 50px; }
    form .local input[type=text] { margin-left: 10px; }
    
	form .captcha { margin-left : 150px; }

    form .subject input[type=text] { width : 300px; }
    
    form .spacer {margin-left :10px;
		padding-left: 10px;}
    
    form .mobile { margin : 5px 0; clear : both; }
    form .mobile input[type=text] { width : 90px; }
	
	li.inline {
	  display: inline;
	
	  }

	li.second_label {
	  display: inline;
	  margin-left: 200px;
	  } 

	li.last {
	  display: inline;
	  padding-left: 32px;
	}

	li.first {
	  display: inline;
	  padding-left: 12px;
	}	
	 

	label#local_number {
		margin-left: 20px;
	}

	label#area_code {
		margin-left: 170px;
	}

    .customLogin {
        margin-left : 150px;
		border: 1px solid #C3C3C2;
    }

	.countries {
		width : 20px;
	}

    .customSave {
        margin-left : 150px;
		border: 1px solid #C3C3C2;
    }

    .customFooter {
		border-top: 1px solid #C3C3C3;
        background-color: #FFFFFF;
    }

    .customFooterAuth {
        background-color: #FFFFFF;
    }    

    .textarea {
	    border: 1px dotted #C3C3C3;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 69%;        
    }

 	div#navigation li { 
 	display: inline;
 	}

	div#navigation li a {
		padding: .15em 1em;
		background-color: #656c6f;
		color: #fff;
		text-decoration: none;
		float: left;
		border-bottom: solid 1px #fff;
		border-top: solid 1px #fff;
		border-right: solid 1px #fff;	
	}

	.admin {
		margin-left :80px;
	}

	a:link, a:visited { color: #C3C3C3; }

	div#navigation li a:hover {
		color: #000;
		background-color: #C3C3C3;
	}    

	div#content {
		border: solid 1px #C3C3C3;
		background-color: #FFFFFF;
	}
	
	div#inboxBorder {
		height:20px;
		border-bottom: solid 1px #C3C3C3;
	}	

	div#padding {
		margin-left:5px;

	}	

	div#regpadding {
		margin-left:10px;

	}	
		
	div#outlineBorder {
		height:300px;
		border-left: solid 1px #C3C3C3;
		border-right: solid 1px #C3C3C3;
		border-bottom: solid 1px #C3C3C3;
	}
	
	div#detailsBorder {
		padding: .15em 1em;
		height:300px;
		border-top: solid 1px #C3C3C3;
		border-left: solid 1px #C3C3C3;
		border-right: solid 1px #C3C3C3;
		border-bottom: solid 1px #C3C3C3;
	}	
	
	div#footerBorder {
		border-bottom: solid 1px #C3C3C3;
	}

	div#inboxBorder li { 
 		display: inline;
 	}

	div#inboxHeader {
		height:5px;	
	}

	div#mailHeader{
	
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
	}
	
	div#replyBorder{
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
	}

	div#mailFooter{
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
		border-bottom :solid 1px #C3C3C3; 
		padding: 5px;
	}	
	
	div#inboxSpacer {
		height:50px;	
	}

	div#buynowspacer {
		padding: 40px;
		margin-left: 5px;
		height:5px;
	}
	
	div#buynow {
		margin-left: 45px;
	}		

	div#spacer{
		padding: .15em 1em;
		height:5px;
		border-left: solid 1px #C3C3C3;
		border-right: solid 1px #C3C3C3;
	}

	div#regSpacer{
		padding: .15em 1em;
		height:15px;
	}	

	div#sessionSpacer{
		height:5px;
	}

	div#sessions{
		padding: 40px;
		margin-left: 5px;
		height:5px;
	}	
	
	div#margin {
		margin-left :5px;
	}
	
	label#margin {
		margin-left :5px;
	}
	
	p#margin {
		margin-left :5px;
	}
	
	textarea#margin {
		margin-left :5px;
	}
	
	submit#margin {
		margin-left :5px;
	}
		

	div#upload {
		margin-left :5px;
	}
	
	.margin {
		margin-left :10px;
	}

	label#total {
		margin-right :20px;
	}

	.mailSpacer {
		height: 15px;		
	}
	
	.inboxSpacer {
		height: 5px;
	}
	
	.clientsHeader{	
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
	}

	.mail_receive_icon {
		margin-left :5px;
		float:left;		
	}

	.mail_icon {
		margin-left :5px;
		margin-bottom :-5.0px;
		float:left;		
	}	
		
	.from_message {
		margin-left :5px;
		font-family: Arial, sans-serif;
		font-size: 10px;
		float:left;	
	}
	
	.subject_message {
		margin-left :100px;
		font-family: Arial, sans-serif;
		font-size: 10px;	
		display:block;
		text-align:center;
		width:300px;
	}
	.date_message {
		margin-right :5px;
		font-family: Arial, sans-serif;
		font-size: 10px;
		float:right;	
	}
	
	.bigSpacer {
		height: 230px;
	
	}
	
	.identity {
		margin-left :300px;
	}	
	
	.credits {
		float:right;
	}		