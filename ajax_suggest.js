var index = -1;
var count = 0;
var showing = 0;
var t;

var cshowing = 0;
var ct;

function getXmlHttpRequestObject() {
	//alert("hi");
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser doesn't support AJAX technology!");
	}
}


var searchReq = getXmlHttpRequestObject();
var cityReq = getXmlHttpRequestObject();
var resultObj=getXmlHttpRequestObject();
//resultObj.overrideMimeType('text/xml');

var agentReq = getXmlHttpRequestObject();
var search_suggest='';
var sid="";

function searchSuggest(id) {
	//alert(id);
	 search_suggest=id + "_suggest";
	 sid=id;
	// alert(search_suggest);
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		//var str = escape(document.getElementById('firstname').value);
		
		
		var str = escape(document.getElementById(id).value);
		//alert(str);
		//searchReq.open("GET", 'searchSuggest.php?id=' + id + '&search=' + str, true);
		if (str.length > 1)
		{
		searchReq.open("GET", 'searchSuggest.php?id=' + id + '&search='+ str, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
		}
	}		
}

function citySuggest() {
	
	if (cityReq.readyState == 4 || cityReq.readyState == 0) {
		var str = escape(document.getElementById('citi').value);
		
		if (str.length > 1)
		{
			cityReq.open("GET", 'citiSuggest.php?search=' + str, true);
			cityReq.onreadystatechange = handleCitySuggest;
			cityReq.send(null);
		}
	}
}

function handleCitySuggest() {
	if (cityReq.readyState == 4) {
		var cs = document.getElementById('citisuggest');
		cs.innerHTML = '';
		index = -1;
		count = 0;
		var str = cityReq.responseText.split("\n");
		for(i=0; i < str.length -1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setCity(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setCity(this.innerHTML);" ';
				suggest += 'class="suggest_link_grey">' + str[i] + '</div>';
			}						
			cs.innerHTML += suggest;
		}
		
		if (str.length > 1) {
			cs.style.display = "block";			
			cshowing = 1;
			clearTimeout(ct);
			ct = setTimeout("autoHide()", 1500);
		} else {
			cs.style.display = "none";
			cshowing = 0;
		}
		
	}
}


function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		//var ss = document.getElementById('search_suggest');
		var ss = document.getElementById(search_suggest);
		//alert(search_suggest);
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
		
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
				suggest += 'class="suggest_link_grey">' + str[i] + '</div>';
			}
			
			ss.innerHTML += suggest;
			//alert(suggest);
			
		}

		if (str.length > 1) {
			ss.style.display = "block";
			showing = 1;
			t = setTimeout("autoHide()", 5000);
		} else {
			ss.style.display = "none";
			showing = 0;
		}
	}
}

/*function searchSuggest_citi(id) {
	//alert(id);
	 search_suggest=id + "_suggest";
	 sid=id;
	// alert(search_suggest);
	if (citiReq.readyState == 4 || citiReq.readyState == 0) {
		var str = escape(document.getElementById(id).value);
		//alert(str);
		//searchReq.open("GET", 'searchSuggest.php?id=' + id + '&search=' + str, true);
		if (str.length > 1)
		{
		citiReq.open("GET", 'citiSuggest.php?id=' + id + '&search='+ str, true);
		citiReq.onreadystatechange = handleCitiSuggest; 
		citiReq.send(null);
		}
	}		
}*/

/*function handleCitiSuggest() {
	if (citiReq.readyState == 4) {
		//var ss = document.getElementById('search_suggest');
		var ss = document.getElementById(search_suggest);
		//alert(search_suggest);
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str = citiReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
		
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
				suggest += 'class="suggest_link_grey">' + str[i] + '</div>';
			}
			
			ss.innerHTML += suggest;
			//alert(suggest);
			
		}

		if (str.length > 1) {
			ss.style.display = "block";
			showing = 1;
			t = setTimeout("autoHide()", 5000);
		} else {
			ss.style.display = "none";
			showing = 0;
		}
	}
}

*/
function autoHide()
{ 
	//document.getElementById('search_suggest').style.display = "none";
	document.getElementById(search_suggest).style.display = "none";
	showing = 0;
	document.getElementById('citisuggest').style.display = "none";
	cshowing = 0;
}

function autoHide2()
{
	document.getElementById(search_suggest).style.display = "none";
	cshowing = 0;
}

function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}

function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}

function suggestOut2(div_value) {
	div_value.className = 'suggest_link_grey';
}

function setSearch(value) {
	//document.getElementById('firstname').value = value;
	//alert(sid);
	document.getElementById(sid).value = value;
	document.getElementById(search_suggest).innerHTML = '';
	document.getElementById(search_suggest).style.display = "none";
}

function setCity(value) {
	value = value.replace(/&amp;/, '&');
	document.getElementById('citi').value = value;
	document.getElementById('citisuggest').innerHTML = '';
	document.getElementById('citisuggest').style.display = "none";
}

function hideSuggest()
{
	document.getElementById(search_suggest).style.display = "none";
	document.getElementById(citisuggest).style.display = "none";
}

function showDivs()
{
	ss = document.getElementById(search_suggest);
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById(search_suggest).childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index < count-1)
		{
			index++;
		}
		document.getElementById(search_suggest).childNodes[index].className = 'suggest_link_over';
	}	
}

function showDivsUp()
{
	ss = document.getElementById(search_suggest);
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById(search_suggest).childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index > 0)
		{
			index--;
		}
		document.getElementById(search_suggest).childNodes[index].className = 'suggest_link_over';
	}	
}

function useKeyboard(e)
{
	var unicode = e.keyCode ? e.keyCode : e.charCode;

	if (unicode == 38)
	{
		showDivsUp();
	}
	else if (unicode == 40)
	{
		showDivs();
	}
}

/**************************************************************************************************************************************************************/
function checkAmount()
{
	var value = document.getElementById("money").value;
	if(isNaN(value) || value=="")
	{
		alert("got here");
		//document.getElementById("money").focus();
		document.getElementById("moneyalert").style.visibility="visible";
		document.getElementById("money").value="";
		

	}
	else
		document.getElementById("moneyalert").style.visibility="hidden";
		
	if(value>999)
	{
		document.getElementById("moneyEx").style.visibility="visible";
	}
	else
	{
		document.getElementById("moneyEx").style.visibility="hidden";
	}
	var place=document.getElementById("citi").value;
	if(place.length>0 || place !="")
	{
		getTotalResult();
	}
	
}

//this will handle the amount box


//the total result
function getTotalResult()
{

	var amt = escape(document.getElementById('money').value);
	var city = document.getElementById('citi').value;
	//city = "New York,USA";
	
	var url = 'totalResult.php?amount=' + amt+'&city='+city;
	//alert(url);
	resultObj.open("GET", url, true);
	
	resultObj.onreadystatechange =function()
	{
			if (resultObj.readyState == 4) 
			{
    	   		document.getElementById("result").innerHTML =resultObj.responseText;
			}
	}	



	resultObj.send(null);
}

	
	
	       


function searchAgent() {
	if (agentReq.readyState == 4 || agentReq.readyState == 0) {
		var str = escape(document.getElementById('agent').value);
		agentReq.open("GET", 'searchAgent.php?search=' + str, true);
		agentReq.onreadystatechange = handleSearchAgent; 
		agentReq.send(null);
	}		
}
function handleSearchAgent() {
	
	if (agentReq.readyState == 4) {
		var ss = document.getElementById('search_agent');
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str = agentReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setSearchA(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearchA(this.innerHTML);" ';
				suggest += 'class="suggest_link_grey">' + str[i] + '</div>';
			}
			
			ss.innerHTML += suggest;
		}

		if (str.length > 1) {
			ss.style.display = "block";
			showing = 1;
			t = setTimeout("autoHide()", 5000);
		} else {
			ss.style.display = "none";
			showing = 0;
		}
	}
}


function setSearchA(value) {
	document.getElementById('agent').value = value;
	document.getElementById('search_agent').innerHTML = '';
	document.getElementById('search_agent').style.display = "none";

}

function checkStatus()
{
	//alert("hi vij");
if((document.getElementById("rank").value=="admin")||(document.getElementById("rank").value=="Admin"))
{
  document.getElementById("del").style.visibility="visible";	
  document.getElementById("upd").style.visibility="visible";	
}
else
{
  document.getElementById("del").style.visibility="hidden";	
  document.getElementById("upd").style.visibility="hidden";	
	
	
}
}

function confirmChoice()

{
var str = document.getElementById("firstname").value;
  if (str.length > 2)
	{
	answer = confirm("Do you really want to update the Client information?")
	
		if (answer !=0)
		
		{
		
		return true;
		
		}
	else
	return false;
	}
}
function confirmit(id)

{
var str = document.getElementById(id).value;
  if (str.length > 2)
	{
	answer = confirm("Do you really want to update the Client information?")
	
		if (answer !=0)
		
		{
		
		return true;
		
		}
	else
	return false;
	}
}


//*************************************************************************money**************************************************************
function check()
{
	var value = document.getElementById("money").value;
	if(isNaN(value) || value=="")
	{
		alert("got here");
		//document.getElementById("money").focus();
		document.getElementById("moneyalert").style.visibility="visible";
		document.getElementById("money").value="";
		

	}
	else
		document.getElementById("moneyalert").style.visibility="hidden";
		
	if(value>999)
	{
		document.getElementById("moneyEx").style.visibility="visible";
	}
	else
	{
		document.getElementById("moneyEx").style.visibility="hidden";
	}
	/*var place=document.getElementById("citi").value;
	if(place.length>0 || place !="")
	{
		getTotalResult();
	}*/
	
}

//this will handle the amount box


//the total result
function getAmount()
{

	var amt = escape(document.getElementById('money').value);
	var city = document.getElementById('citi').value;
	//city = "New York,USA";
	//alert(city);
	var str=city;
	if(str.split(",").length==2 && (amt!=""))
	{
	var url = 'totalResult.php?amount=' + amt+'&city='+city;
	//alert(url);
	resultObj.open("GET", url, true);
	
	resultObj.onreadystatechange =function()
	{
			if (resultObj.readyState == 4) 
			{
    	   		//document.getElementById("result").innerHTML =resultObj.responseText;
				var arr=resultObj.responseText.split("\n");
				//alert(arr[0]);
				document.getElementById("cvt").value=arr[0];
				//alert(arr[0]);
				document.getElementById("currency").value=arr[1];
				document.getElementById("amt").value=arr[2];
				document.getElementById("sender_currency").value=arr[3];
				document.getElementById("fee").value=arr[4];
				document.getElementById("grt").value=arr[5];
			    document.getElementById("rate").value=arr[6];
			}
	}	



	resultObj.send(null);
	}
}

	
