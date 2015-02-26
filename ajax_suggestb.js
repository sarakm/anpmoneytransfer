var index = -1;
var count = 0;
var showing = 0;
var t;

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser doesn't support AJAX technology!");
	}
}


var searchReqb = getXmlHttpRequestObject();
var searchAg = getXmlHttpRequestObject();
var resultObj=getXmlHttpRequestObject();
//this will called the php file to handle the search and then call another function to complete
function searchSuggestb() {
	if (searchReqb.readyState == 4 || searchReqb.readyState == 0) {
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

//this will handle the amount box
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
	var place=document.getElementById("cityb").value;
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
	var city = document.getElementById('cityb').value;
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


function autoHide()
{
	document.getElementById('search_suggestb').style.display = "none";
	showing = 0;
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

//this is use the set the value choosen from the suggestion div
function setSearch(value) {
	document.getElementById('cityb').value = value;
	document.getElementById('search_suggestb').innerHTML = '';
	document.getElementById('search_suggestb').style.display = "none";
	getTotalResult();
}

function setSearchA(value) {
	document.getElementById('agent').value = value;
	document.getElementById('search_agent').innerHTML = '';
	document.getElementById('search_agent').style.display = "none";

}


function hideSuggest()
{
	document.getElementById('search_suggestb').style.display = "none";
}

function showDivs()
{
	ss = document.getElementById('search_suggestb');
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById('search_suggestb').childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index < count-1)
		{
			index++;
		}
		document.getElementById('search_suggestb').childNodes[index].className = 'suggest_link_over';
	}	
}

function showDivsUp()
{
	ss = document.getElementById('search_suggestb');
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById('search_suggestb').childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index > 0)
		{
			index--;
		}
		document.getElementById('search_suggestb').childNodes[index].className = 'suggest_link_over';
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



