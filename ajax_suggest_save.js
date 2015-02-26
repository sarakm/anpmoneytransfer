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
		var str = escape(document.getElementById('city').value);
		
		if (str.length > 2)
		{
			cityReq.open("GET", 'citySuggest.php?search=' + str, true);
			cityReq.onreadystatechange = handleCitySuggest;
			cityReq.send(null);
		}
	}
}

function handleCitySuggest() {
	if (cityReq.readyState == 4) {
		var cs = document.getElementById('citysuggest');
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

function autoHide()
{ 
	//document.getElementById('search_suggest').style.display = "none";
	document.getElementById(search_suggest).style.display = "none";
	showing = 0;
	document.getElementById('citysuggest').style.display = "none";
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
	document.getElementById('city').value = value;
	document.getElementById('citysuggest').innerHTML = '';
	document.getElementById('citysuggest').style.display = "none";
}

function hideSuggest()
{
	document.getElementById(search_suggest).style.display = "none";
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

