var index = -1;
var count = 0;
var showing = 0;
var t;

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) 
	{
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser doesn't support AJAX technology!");
	}
}


/*var searchReq = getXmlHttpRequestObject();*/
var cityReq = getXmlHttpRequestObject();
var searchAg = getXmlHttpRequestObject();
var resultObj=getXmlHttpRequestObject();

function searchAgent() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('agent').value);
		searchReq.open("GET", 'searchAgent.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchAgent; 
		searchReq.send(null);
	}		
}

//this completes the action by showing and handling the suggestions

function handleSearchAgent() {
	
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_agent');
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

//search customer id
function searchByCustID() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('custId').value);
		searchReq.open("GET", 'searchCustomerID.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchCustID; 
		searchReq.send(null);
	}		
}

//this completes the action by showing and handling the suggestions
function handleSearchCustID() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_cID');
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
				suggest += 'onclick="javascript:setSearchCustID(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearchCustID(this.innerHTML);" ';
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
	var place=document.getElementById("city").value;
	if(place.length>0 || place !="")
	{
		getTotalResult();
	}
	
}

function getCity(id)
{
	
	
	if (cityReq.readyState == 4 || cityReq.readyState == 0) {
		var str = escape(document.getElementById(id).value);
		cityReq.open("GET", 'searchCity.php?search=' + str, true);
		cityReq.onreadystatechange = handleSearchCity; 
		cityReq.send(null);
	}
	
	
}
function handleSearchCity() {
	if (cityReq.readyState == 4) {
		var ss = document.getElementById('cityDrop');
		ss.innerHTML = '';
		index = -1;
		count = 0;
		var str =cityReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this); javascript:clearTimeout(t);"';
			
			if ((i % 2 == 0))
			{
				suggest += 'onmouseout="javascript:suggestOut(this);" ';
				suggest += 'onclick="javascript:setSearchCustID(this.innerHTML);" ';
				suggest += 'class="suggest_link">' + str[i] + '</div>';				
			}
			else
			{
				suggest += 'onmouseout="javascript:suggestOut2(this);" ';
				suggest += 'onclick="javascript:setSearchCustID(this.innerHTML);" ';
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

//the total result
function getTotalResult()
{

	var amt = escape(document.getElementById('money').value);
	var city = document.getElementById('city').value;
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


function autoHide()
{
	document.getElementById('search_suggest').style.display = "none";
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
	document.getElementById('city').value = value;
	document.getElementById('search_suggest').innerHTML = '';
	document.getElementById('search_suggest').style.display = "none";
	getTotalResult();
}

function setSearchA(value) {
	document.getElementById('agent').value = value;
	document.getElementById('search_agent').innerHTML = '';
	document.getElementById('search_agent').style.display = "none";

}

function setSearchCustID(value) {
	document.getElementById('custId').value = value;
	document.getElementById('search_cID').innerHTML = '';
	document.getElementById('search_cID').style.display = "none";

}

function hideSuggest()
{
	document.getElementById('search_suggest').style.display = "none";
}

function showDivs()
{
	ss = document.getElementById('search_suggest');
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById('search_suggest').childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index < count-1)
		{
			index++;
		}
		document.getElementById('search_suggest').childNodes[index].className = 'suggest_link_over';
	}	
}

function showDivsUp()
{
	ss = document.getElementById('search_suggest');
	count = ss.childNodes.length;

	if (count > 0)
	{
		document.getElementById('search_suggest').childNodes[(index==-1)?0:index].className = 'suggest_link';
		
		if (index > 0)
		{
			index--;
		}
		document.getElementById('search_suggest').childNodes[index].className = 'suggest_link_over';
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



