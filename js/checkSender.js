// JavaScript Document
function sender_check(form)
{
	//var     cid=form.getElementById("custid").value;
//	var my_form=form.getElementById("f1");
      var s_id=form.custid.value;
      var sf_name=form.firstname.value;
	  var sl_name=form.lastname.value; 
	  var s_ad=form.address1.value;
	  var s_city=form.city.value;
	  var s_country=form.country.value;
	  var s_phone=form.phone1.value;
	  var s_pid=form.pid.value;
	  var rec_fname=form.receiver_firstname.value;
	  var rec_lname=form.receiver_lastname.value;
	  var rec_addr=form.receiver_address1.value;
	  var rec_city=form.receiver_city.value;
	  var rec_country=form.receiver_country.value;
	  var cvt=form.cvt.value;
	  var grt=form.grt.value;
	  var currency=form.currency.value;
	  if(s_id.length<1||sf_name.length<2||sl_name.length<2||s_ad.length<2||s_city.length<2||s_country.length<2||s_phone.length<9||s_pid.length<9)
	  {
		alert("Please fill all the required information of Sender");
		//f1.firstname.focus;
		return false;
	  }
	   if(rec_fname.length<2||rec_lname.length<2||rec_addr.length<2||rec_city.length<2||rec_country.length<2)
	  {
		alert("Please fill all the required information of Receiver");
		//f1.receiver_firstname.focus;
		return false;
		
	  }
	   if(cvt.length<3||grt.length<3||currency.length<1)
	  {
		alert("Please fill all the required information of transaction Amount and currency type");
		//f1.amt.focus;
		return false;
		
	  }
	  
	   
	//alert(s);
	return confirm("Do You want to send the transaction now?");

	
};


function getTransactions(criteria){
alert(criteria);
var filter;
var searchval=escape(document.getElementById("search").value);
if((searchval != 0)||(searchval!="")||(parseInt(criteria)!=0))
{
	switch(parseInt(criteria))
	{
		case 0:
		    break;
		case 1:
			filter = "transactionid";
		break;
		
		case 2:
			filter = "agent";
		break;
		
		case 3:
			filter = "city";
		break;
		
		case 4:
			filter = "status";
		break;
		case 5:
			filter= "email_status";
		break;
		case 6:
			filter = "userid";
		break;
	}

      window.location.href='edit.php?search=' + searchval + '&filter='+filter;
	  f1.submit();
	}

	
}





function saveDB(col,val,tid)
{   

	/*alert(col);
	alert(val);
	alert(tid);*/
	var dbRequest=getXmlHttpRequestObject();
	if(dbRequest.readyState == 4 || dbRequest.readyState == 0)
		{
			confirm("updating database!");
		dbRequest.open("GET", 'updateDB.php?tid=' + tid + '&col='+ col + '&val=' + val, true);
		
		if(dbRequest.readyState==4)
		{
			
		str=dbRequest.responseText.split("\n"); 
		alert(str);
		}
		dbRequest.send(null);
	   }
}

function changeDBState(col,val,tid)
{  
	
	if(escape(val)=="false")
	val=0;
	else if(escape(val)=="true") 
	 val=1;
	
		  
	var changeRequest=getXmlHttpRequestObject();
	if(changeRequest.readyState == 4 ||changeRequest.readyState == 0)
		{
			confirm("updating database!");
	changeRequest.open("GET", 'updateDB.php?tid=' + tid + '&col='+ col + '&val=' + val, true);
		
		if(changeRequest.readyState==4)
		{
			
		str=changeRequest.responseText.split("\n"); 
		alert(str);
		}
		changeRequest.send(null);
	   }
}

function saveSelected(state,id)
{  
	//alert(state);
	//alert(id);
	if(escape(state)=="false")
	val='NO';
	else if(escape(state)=="true") 
	 val='YES';
	 col='selected';
		  
	var changeRequest=getXmlHttpRequestObject();
	if(changeRequest.readyState == 4 ||changeRequest.readyState == 0)
		{
			confirm("updating database!");
	changeRequest.open("GET", 'updateDB.php?tid=' + id + '&col='+ col + '&val=' + val, true);
		
		if(changeRequest.readyState==4)
		{
			
		str=changeRequest.responseText.split("\n"); 
		alert(str);
		}
		changeRequest.send(null);
	   }
}






/*function sendmail()
{
	var f=document.form1.getElementByName(transactionid).value;
	alert(f);
	
	
	
	
	
}*/
function agentTrans(id)
{
/*var name=document.getElementById("selectagent").selectedOption.value;
alert(name);*/
window.location.href='edit.php?filter='+id;
	  f1.submit();
}
function email()
{
/*var name=document.getElementById("selectagent").selectedOption.value;
alert(name);*/
var id=document.getElementById("selectagent").value;
alert(id);
var val="email";
if(id!=0)
{
window.location.href='edit.php?id='+id + '&val=' + val;
	  f1.submit();
}
}