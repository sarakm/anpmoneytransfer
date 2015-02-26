<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin section</title>
<script language="JavaScript" type="text/javascript" src="ajax_suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="js/checkSender.js"></script>

<style>
/*#content{
	width: 950px;
	background-color: white;
	margin: 0 auto;
	position: relative;
	padding-top: 5px;
	min-height: 750px;
}
.menu{
    float:right;
	padding-right:350px;
	height:32px;
	padding: 5px;
	width: 40%;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:14px; 
	font-weight:bold; 
	background-color:#E7E7E7; 
	border-right: 1px solid black; 
	border-left: 1px solid black; 
	border-bottom: 1px solid black;
}
.menu a
{
	display: block;
	float: left;
	text-decoration: none;
	color: #990033;	
	padding: 0 10px;
	border-right: 1px solid black;
	line-height: 30px;
}
.menu a#first
{border-left: 1px solid black;
}
.menu a#last{
	border-right: 0px solid black;
}
.menu a:hover
{
	color: #0000ff;	
	background-color: #D3D3D3;
}

/* add_product 
#add_product .style1 {color: #990000}
#add_product .tf {		width: 150px;
}
#add_product .rtf {		width: 100px;
}
#add_product .stf {		width: 50px;
		height: 15px;
}
#add_product .tf1 {		width: 150px;
}
#add_product .ta {		width: 430px;
		height: 80px;	
}
#add_product .btn {		width: 120px;
		height: 25px;
}
/* add_category 
#add_category .style1 {color: #990000}
#add_category .tf {		width: 300px;
		height: 20px;
}
#add_category .btn {		width: 120px;
		height: 25px;
}
/* edit_category 
#edit_category .style1 {color: #990000}
#edit_category .tf {		width: 150px;
		height: 20px;
}
#edit_category .btn {		width: 120px;
		height: 25px;
}
#edit_category h3 {
	margin-top: 40px;
	margin-left: 10px;
	color: #990000;
}
.catparent {
	padding: 5px;
	height: 20px;
	text-indent: 5px;
	color: #990000; 
	font-weight: bold; 
	background-color: #FDC9C9;
}
.catchild {
	margin-left: 20px;
	padding: 5px;
	height: 20px;
}
.cat_tbl {
	background-color: 
	#990000; color: #fff;
	font-weight: bold;
	text-align: center;
	font-size:12px;
}
/* edit 
#edit .btn
	{
		width: 120px;
		height: 25px;
	}
#edit .tf
	{
		width: 300px;
		height: 20px;
	}
#edit .rtf
	{
		width: 100px;
		height: 20px;
	}
#edit .stf
	{
		width: 50px;
		height: 20px;
	}
#edit .ta
	{
		width: 300px;
		height: 80px;	
	}
#edit .style1 {color: #990000}
#last_product{
	margin:10px;
}

.p_list1 
	{
	color: #ffffff;
	font-weight: bold;
	}
.p_list2 {color: #990000}*/
.td(align:middle;)
</style>
<script>
function changeTxt(i)
{
	switch(parseInt(i))
	{
		case 1:
			document.getElementById('submitbtn').value = "Search transId #";
		break;
		
		case 2:
			document.getElementById('submitbtn').value = "Search Agent #";
		break;
		
		case 3:
			document.getElementById('submitbtn').value = "Search Location #";
		break;
		
		case 4:
			document.getElementById('submitbtn').value = "Trans Status";
		break;
		case 5:
			document.getElementById('submitbtn').value = "Search emailStatus";
		break;
		case 6:
			document.getElementById('submitbtn').value = "Search userid";
		break;
	}
}

</script>
</head>

<body bgcolor="#999999">

<div>
  <div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; font-weight:bold; margin-bottom:20px;">ANP Transaction Panel</div>
</div>
<div class="menu"> 
         <!--<a href="trans_list.php" >View </a>-->   
<!--        <a href="update.php" >Update </a>-->
        <input type="submit" name="sendmail" id="sendmail" value="Email"/><!--email_trans.php -->                  
        <a href="print.php" >Print</a>         
        <a href="logout.php" id="last">Logout</a>
      </div>  

	  <form name="f1" id="f1" action="edit.php" method="get" style="margin-top:20px;">
          <div style="margin-left:20px;">
            <input type="text" name="search" id="search" style="margin-bottom:10px; width:145px;"/>
                <select name="filter" id="filter" style="margin-bottom:10px; width:145px;" onchange="getTransactions(this.value);">
                    <option value="0">SELECT ANY ONE</option>
                	<option value="1">transId#</option>
                    <option value="2">Agent#</option>
                    <option value="3">Location#</option>
                    <option value="4">Trans Status</option>
                    <option value="5">emailStatus</option>
                    <option value="6">SenderId</option>
                </select>
           <!-- <input type="submit" id="submitbtn" value="Search Part #" style="width: 120px;"/>-->
           <p></p>
            <hr style="background-color: #990000; height: 5px;" />
     </div>      
       </form>  
      
       
  
     </body>
  </html> 
