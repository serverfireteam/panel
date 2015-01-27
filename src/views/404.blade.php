<!DOCTYPE HTML>
<html>
<head>
<title>404 NotFound</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
	font-family: 'Courgette', cursive;
}
@-webkit-keyframes AnimationName {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@-moz-keyframes AnimationName {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@keyframes AnimationName { 
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
body{
    
background: linear-gradient(270deg, #ffffff, #f5f5ad);
background-size: 400% 400%;

-webkit-animation: AnimationName 10s ease infinite;
-moz-animation: AnimationName 10s ease infinite;
animation: AnimationName 10s ease infinite;



}


.wrap{
	margin:0 auto;
	width:1000px;
}
.logo{
	margin-top:50px;
}	
.logo h1{
	font-size:200px;
	color:#191B28;
	text-align:center;
	margin-bottom:1px;
	text-shadow:1px 1px 6px #fff;
}	
.logo p{
	color:#F26101;
	font-size:20px;
	margin-top:1px;
	text-align:center;
}	
.logo p span{
	color:lightgreen;
}	
.sub a{
    
	color:#191B28;
	border:1px solid #191B28;
	text-decoration:none;
	padding:7px 120px;
	font-size:13px;
	font-family: 'Courgette', cursive;
	font-weight:bold;
	-webkit-border-radius:3em;
	-moz-border-radius:.1em;
	-border-radius:.1em;
        transition:  all ease 250ms;
        cursor: pointer;
}
.sub a:hover{
    background-color: #191B28;
    color :#fff;
    box-shadow: 0px 0px 15px rgba(0,0,0,0.5);
}
.footer{
	color:#8F8E8C;
	position:absolute;
	right:10px;
	bottom:10px;
}	
.footer a{
	color:rgb(228, 146, 162);
}	
</style>
</head>


<body>


	<div class="wrap">
	   <div class="logo">
	   <h1>404</h1>
	    <p>Error occured! - File not Found</p>
  	      <div class="sub">
	        <p><a onclick="window.history.back();return false;" href="#">Back</a></p>
	      </div>
        </div>
	</div>
	
	
	
</body>
