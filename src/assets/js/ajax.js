function comment(ID)
{
	var nama=document.getElementById("Nama").value;
	var komen=document.getElementById("Komentar").value;
	if(validate_new_comment())
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
		var komen=document.getElementById("Komentar").value;
		var errorMessage=document.getElementById("error");
		if(nama == "" || komen == ""){
			errorMessage.innerHTML="Ada data yang belum diisi";
			return false;
		}
		else{
			errorMessage.innerHTML="";
			return true;
		}
}