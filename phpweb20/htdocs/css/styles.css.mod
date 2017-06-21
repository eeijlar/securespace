*{margin: 0px; padding: 0;}
body{
	margin: 0 auto;
	margin-bottom: 10px;
	text-align:center;
	background: #E6E8DA url(../images/none.jpg) left top repeat-x;
	font: normal 62.5% "Trebuchet MS",Verdana,Arial;
	font-size: 10px;
	line-height: 1.5em;
	color: #404040;
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
/*h1 {
	border-bottom: 1px solid #C3C3C3;
	border-top: 1px solid #C3C3C3;
	border-right: 20px solid #656c6f;
	color: #FFFFFF;
	font-size: 130%;
	font-weight: normal;
	margin: 5px 0;
	background: #EF7700;
}*/

fieldset {
	border: 1px solid #C3C3C3;
	padding: 5px;
}
form{font-size: 11px;}

input {
	width: 100px;
	border: 1px solid #C1C3C1;
	margin: 5px;
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
/*#wrap {
	background-image: url(/images/arrow.gif);
	background-image: url(/images/arrow_outline.gif);
	background-image: url(/images/background.gif);
	background-image: url(/images/header_big.gif);
	background-image: url(/images/selector.gif);
	background-image: url(/images/selector_sub.gif);
	background-repeat: no-repeat;
	background-position: -5000px -5000px;
	
	width: 820px;
	margin: 10px auto;
	text-align: left;
	border: 2px solid #BEBFBA;
	}*/
#wrapper{
	width: 820px;
	margin: 10px auto;
	text-align: left;
	border: 2px solid #BEBFBA;
	background: #fff;
	}
#mastHead{
	width: 820px;
	margin: 0 auto;
	height: 90px;
	background: #fff url(../images/secure-ban.jpg) 0px 0px no-repeat;
	}
/* ------------ mainNav ------------ */

#mainNav{
	margin: 0px auto;
	height:42px;
	z-index:1;
	background: #fff url(../images/none.jpg) left top repeat-x;
	}
#mainNav ul {
	list-style-type: none;
	text-align: center;
	margin: 0 auto;
	height: 40px;
	margin-left: 10px;
	}

#mainNav li{
	float: left;
	display: inline;
	padding: 10px 2px 10px 2px;
	z-index:2;
	}
#mainNav a {
	margin: 0;
	color:#fff;
	text-align:center;
	text-decoration:none;
	font: 12px Verdana, Arial, Helvetica, sans-serif;
	display: inline;
	height: 42px;
	padding: 12px 32px;
	border-right: 1px solid #ccc;
	border-right: 1px solid #ccc;
	z-index:3;
	background: #7D6D53;
	}
body.home #mainNav a#home, #mainNav a#home:hover,
body.ber #mainNav a#ber, #mainNav a#ber:hover,
body.ther #mainNav a#ther, #mainNav a#ther:hover,
body.com #mainNav a#com, #mainNav a#com:hover,
body.ren #mainNav a#ren, #mainNav a#ren:hover,
body.cost #mainNav a#cost, #mainNav a#cost:hover{
	height: 42px;
	color: #eef;
	background: #AC7D57 url(../images/none.jpg) left top repeat-x;
	}
	
#mainNav a:hover, #mainNav a:active {
	height: 35px;
	color: #eef;
	background: #AC7D57 url(../images/none.jpg) left top repeat-x;
	}
/*content*/
#content{
	width: 820px;
	margin: 0 auto;
	background:#fff url(../images/none.jpg) right top repeat-y;
	}
#content p{
	padding: 12px 9px 12px 9px;
	text-align: left;
	font-size: 1.25em;
	}
/*.paraJustify p{
	padding: 0px 15px;
	text-align: justify;
		}
*/
#content h2,h3,h4,h5{		
	font-family: bold "Trebuchet MS",Verdana,Arial;
	color: #737373;
	font-weight: normal;
	padding: 15px 7px 5px 7px;
	}
#content h2{
	font-size: 21px;
	}
#content p strong{
	color: #333;
	font-weight: bold;
	font-size: 1.2em;
	}
#content a{
	text-decoration: none;
	background-color: #eff;
	color: navy;
	font-size: 1.25em;
	}
#content a:hover{
	text-decoration: underline;
	}
h1{
	position: absolute;
	top: 25px;
	text-indent: -10000px;
	color: #000;
	padding: 20px 0;
	}
#content h3{
	font-size: 1.8em;
	}
#content ul{
	padding: 0 30px 0 0px;}
#content ol{
	padding: 0 30px;
	}
#content ul li{
	list-style-type:none;
	background: #eeeeff url(../images/arrowbullet2.png) left 14px no-repeat;
	padding: 10px 10px 10px 20px;
	margin-bottom: 2px;
	margin-left: 30px;}

	#content ul li{
	/margin-left: -10px}

#content ol li{
	background: #eef;
	padding: 10px 10px;
	margin-left: 20px;
	margin-bottom: 2px;
	font-style: italic;
	}
#content ol li{
	/margin-left: -10px}
	
#content li.noListStyle{
	list-style: none;
	position: relative;
	left: -15px;
	text-align: justify;
	}
#content li.noListStyle2{
	list-style: none;
	}
#mainContent{
	float: right;
	width: 600px;
	margin: 20px 9px 0 0;
	}
#mainContentWide{
	margin: 0px 10px 0 10px;
	}
/*#header {
	width: 820px;
	margin: 0 auto;
	height: 90px;
	background: #fff url('images/secure-ban.jpg') 0px 0px no-repeat;
	color: #fff;
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
*/
/* remove the 'text-decoration: underline;' in #nav li a:hover if you don't want the links in the left nav menu to be underlined when the user hovers over them with their mouse */
/*#nav li a:hover {
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
*/
/* in the tag below, #column2, I used the Underscore Hack to give the column2 div the correct margins in Firefox 1 */
/*#column2 {
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
	padding: 30px 30px 30px 30px;
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
/*#footer {
	clear: both;
	color: #999;
	font-size: 9px;
	padding: 30px 0 10px 0;
	text-indent: 185px;
}
#footer a {
	color: #999999;
	text-decoration: underline;
}*/
/*
.rbenter1 {
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
*/
    /**
     * Forms
     */

/*    div.error {
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
*/
  /*   .customFooter {
		border-top: 1px solid #C3C3C3;
        background-color: #FFFFFF;
    }

   .customFooterAuth {
        background-color: #FFFFFF;
    }  */  

/*    .textarea {
	    border: 1px dotted #C3C3C3;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 69%;        
    }
*/

        div#navigation li {
        display: inline;
        }

        div#navigation li a {
                padding: .15em 1em;
                background-color: #54B446;
                color: #fff;
                text-decoration: none;
                float: left;
                border-bottom: solid 1px #fff;
                border-top: solid 1px #fff;
                border-right: solid 1px #fff;
        }

        div#navigation li a:hover {
                background-color: #428E37;
                text-decoration: none 
         }


/*
*/	.admin {
		margin-left :80px;
	}
/*
	a:link, a:visited { color: #C3C3C3; }

	}    

	div#content {
		border: solid 1px #C3C3C3;
		background-color: #FFFFFF;
	}
*/	
	div#inboxBorder {
		height:20px;
		border-bottom: solid 1px #fff;
	}	
/*
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
*/	
/*	div#footerBorder {
		border-bottom: solid 1px #C3C3C3;
	}*/
/*

*/	div#inboxBorder li { 
 		display: inline;
 	}

	div#inboxHeader {
		height:5px;	
	}
/*
	div#mailHeader{
	
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
	}
	
	div#replyBorder{
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
	}
*/
/*	div#mailFooter{
		border-left :solid 1px #C3C3C3; 
		border-right :solid 1px #C3C3C3;
		border-bottom :solid 1px #C3C3C3; 
		padding: 5px;
	}*/	
/*	
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
		margin-left :155px;
	}
	
	label#margin {
		margin-left :5px;
	}
*/	
	p#margin {
		margin-left :0px;
		padding: 0;
	}
/*
	
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
 */	
/*sidebar*/
#sidebar {
	padding: 0;
	float: left;
	width: 188px;
	margin: 20px 9px 0 9px;
	padding: 1px 1px 0 1px;
	border: 1px solid #ccc;
	}
#sidebar p{
	padding: 4px;
	font-size: 1em;
	font-weight: bold;
	text-style: italic;
	color: #8A8A8A;
	}

#sidebar #sideNav{
	margin:2px 0px;
	}
#sidebar #sideNav a {
	font-family: Verdana,Arial,Helvetica,sans-serif;
	/font-size: 1.5em;
	font-size: 1.3em;
	line-height: 33px;
	color: #ffffff;
	text-decoration: none;
	display: block;
	height: 34px;
	background: #54B446; /*bgcolor green*/
	border-top: 1px solid #659cd3;
	padding: 0 10px;
	}
#sidebar #sideNav a:hover {	
	text-decoration: none;
	background: #AC7D57;}

#sidebar #sideNav a#home:hover, 
#sidebar #sideNav a#overview:hover, 
#sidebar #sideNav a#educational:hover, 
#sidebar #sideNav a#training:hover, 
#sidebar #sideNav a#about:hover, 
#sidebar #sideNav a#contact:hover, 
#sidebar #sideNav a#invest:hover, 
#sideNav a#recruitment:hover{
	background: #0065cb url(../images/sideNav-bg2.gif) left top repeat-x;
	}
#sidebar #sideNav ul li{
	margin: 1px;
	background: #AC7D57;
	padding: 0px;
	width: 186px;
	}
#sidebar #sideNav img{
	margin: 0 auto;
	}
#sidebar h3{
	padding: 15px 0px 5px 0px;
	text-align: center;
	margin: 3px auto;
	font-size: 1.05em;
	font-style: italic;
	font-weight: bold;
	color: #8E8E8E;
	width: 170px;
	}
#sidebar h4{
	margin: 5px auto;
	font: 900 1.8em "Trebuchet MS",Verdana,Arial;
	color: navy;
	}	
#sidebar h5{
	padding: 10px 0px 0px 0px;
	margin: 5px auto;
	font: 600 13px "Trebuchet MS",Verdana,Arial;
	color: navy;
	}

#sidebar .quote{
	border: medium double #E87D1B;
	text-align: left;
	padding: 4px;
	margin: 20px 15px;
	color: #FFF799;
	font: normal italic 14px "Times New Roman",Times,Georgia;
	background-color: #E04F00;	
	}

/* footer */
#footer{
	width: 820px;
	margin: 0 auto;
	clear: both;
	padding: 20px 0;
	font-size: 1.1em;
	background: #fff url(../images/none.jpg) left top repeat-x;
	color: #ccc;
	}
#footer a{
	color: #584;
	text-decoration: none;
	border-bottom: 1px dotted #584;
	}
#footer p{
	border-top: 1px solid #ccc;
	padding-top: 20px;
	margin: 0 100PX;
	color: #584;
	text-align: center;
	}
/*other classes*/
.imageLeft{
	float: left;
	padding: 5px 20px 10px 30px;
	}
.imageRight{
	float: right;
	padding: 5px 30px 10px 20px;
	}
.backgroundGrey{
	/*background: #E6E6E6;*/
	background: #fff;
	padding: 2px;
	}
		
