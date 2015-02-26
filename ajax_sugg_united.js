
//Below the XmlHttp RequestObject function creates an http Object to communicate with the server from web client page.
//The searchSuggest function accepts id of the field which it is being called from, and creates a variable which refers to div(where values are dynamically visible if //the response is coming from server page. Everything echoed in server php page wil be visible through these div tags only. I am naming the text fields(eg:firstname) //and corresponding div tags underneath it with related name(eg: firstname_suggest). Here in ajax file, once I receive the id of calling field, I am naming the variable id + _suggest. So this function works for any text field which calls this function, by passing it's id to this function. But there should be a div tag underneath it, by the name ( _suggest) prefixed by text field's id. Once the search string is sent to server page, respective prompts will come back through xmlobject variable. To receive it, handleSearchSuggest function is written. It splits the responseObject and uses the changeState,showDivs, showDivsUp functions to display theresponse, autohide,autohide2 functions to hide the divs after display timeout.  id of the calling function is passed to the related functions, so everything works smoothly by simply calling the searchSuggest(id) function (by providing the id and showing a div to put the response in.
//																																																																																																																																																																									// This is a great functionality to get dynamic data from database prompting possible values as you type.      -----documentation by vijaya



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
var searchReqb = getXmlHttpRequestObject();
var cityReq = getXmlHttpRequestObject();
var searchAg = getXmlHttpRequestObject();
var resultObj=getXmlHttpRequestObject();
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
		if (str.length > 2)
		{
		searchReq.open("GET", 'searchSuggest.php?id=' + id + '&search='+ str, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
		}
	}		
}



function citySuggest(id) {
	alert("Hi vijaya");
	
	if (cityReq.readyState == 4 || cityReq.readyState == 0) {
		var str = escape(document.getElementById(id).value);
		
		if (str.length > 2)
		{
			cityReq.open("GET", 'citySuggest.php?search=' + str, true);
			//alert(str);
			var c="city2";
			cityReq.onreadystatechange = handleCitySuggest(c);
			cityReq.send(null);
			//alert("bye vijaya");
	
		}
	}
}

function handleCitySuggest(c) {
	
	if (cityReq.readyState == 4) {
		var cs = document.getElementById(c);
		
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
			ct = setTimeout("autoHide2()", 15000);
		} else {
			cs.style.display = "none";
			cshowing = 0;
		}
		
	}
}


//this is to search Agent 
function searchAgent() {
	if (searchReqb.readyState == 4 || searchReqb.readyState == 0) {
		var str = escape(document.getElementById('agent').value);
		searchReqb.open("GET", 'searchAgent.php?search=' + str, true);
		searchReqb.onreadystatechange = handleSearchAgent; 
		searchReqb.send(null);
	}		
}

//this completes the action by showing and handling the suggestions
function handleSearchAgent() {
	
	if (searchReqb.readyState == 4) {
		var ss = document.getElementById('search_agent');
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str = searchReqb.responseText.split("\n");
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

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById('receiver_lastname').innerHTML=xmlhttp.responseText;
}
}

/*function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

*/

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

//this will call the php file to handle the search of cities for money transaction area and then call another function to complete
function searchSuggestb() {
	if (searchReqb.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('cityb').value);
		searchReqb.open("GET", 'searchSuggestb.php?search=' + str, true);
		searchReqb.onreadystatechange = handleSearchSuggestb; 
		searchReqb.send(null);
	}		
}

//this completes the action by showing and handling the suggestions 
function handleSearchSuggestb() {
	if (searchReqb.readyState == 4) {
		var ss = document.getElementById('search_suggestb');
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str = searchReqb.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setSearchb(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearchb(this.innerHTML);" ';
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

function autoHide()
{ 
	//document.getElementById('search_suggest').style.display = "none";
	document.getElementById(search_suggest).style.display = "none";
	showing = 0;
	document.getElementById(search_suggestb).style.display = "none";
	showing = 0;
	document.getElementById('citysuggest').style.display = "none";
	cshowing = 0;
	document.getElementById('citysuggest').style.display = "none";
//	cshowing=0;
}

function autoHide2()
{
	document.getElementById(search_suggest).style.display = "none";
	cshowing = 0;
	document.getElementById(search_suggestb).style.display = "none";
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

function setSearchA(value) {
	document.getElementById('agent').value = value;
	document.getElementById('search_agent').innerHTML = '';
	document.getElementById('search_agent').style.display = "none";

}
function setSearchb(value) {
	document.getElementById('cityb').value = value;
	document.getElementById('search_suggestb').innerHTML = '';
	document.getElementById('search_suggestb').style.display = "none";
	getTotalResult();
}



function checkAmount(value)
{
	if(isNaN(value) || value=="")
	{
		document.getElementById("money").focus();
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
	var place=document.getElementById("cityb").value;
	if(place.length>0 || place !="")
	{
		getTotalResult();
	}
	
}

//the total result
function getTotalResult()
{

	var amt = escape(document.getElementById('money').value);
	var city = document.getElementById('cityb').value;
	var url = 'totalResult.php?amount=' + amt+'&city='+city;
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

/*function setCity(value) {
	value = value.replace(/&amp;/, '&');
	document.getElementById('city2').value = value;
	document.getElementById('cityDrop').innerHTML = '';
	document.getElementById('cityDrop').style.display = "none";
}*/

function hideSuggest()
{
	document.getElementById(search_suggest).style.display = "none";
	document.getElementById(search_suggestb).style.display = "none";
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

