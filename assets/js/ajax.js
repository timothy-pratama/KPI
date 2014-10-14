function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   	var bool=re.test(email);
   	if(bool===false){
   		document.getElementById("errorEmail").innerHTML="Email tidak valid";
   		return false;
   	}
   	else{
   		document.getElementById("errorEmail").innerHTML="";
   		return true;
   	}
} 

function comment(ID)
{
	var nama=document.getElementById("Nama").value;
	var email=document.getElementById("Email").value;
	var komen=document.getElementById("Komentar").value;
	if(validate_new_comment() && validateEmail(email))
	{
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		  	xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    	document.getElementById("yeay").innerHTML=xmlhttp.responseText;
		    }
		}
		xmlhttp.open("GET","insert_comment.php?ID="+ID+"&nama="+nama+"&komentar="+komen,true);
		xmlhttp.send();
		document.getElementById('comen').reset();
	}
	else
	{ 
		return false;
	}
}

function show_comment(ID){
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	document.getElementById("yeay").innerHTML=xmlhttp.responseText;
	    }
	}
	xmlhttp.open("GET","show_comment.php?ID="+ID,true);
	xmlhttp.send();
}

function validate_new_comment(){
		var nama=document.getElementById("Nama").value;
		var email=document.getElementById("Email").value;
		var komen=document.getElementById("Komentar").value;
		var errorMessage=document.getElementById("error");
		if(nama == "" || email == "" || komen == ""){
			errorMessage.innerHTML="Ada data yang belum diisi";
			return false;
		}
		else{
			errorMessage.innerHTML="";
			return true;
		}
}