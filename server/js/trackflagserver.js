var wavingyellowTimeout;


function checkforStatus() {
 			var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    eval(xmlhttp.responseText);
                }
            }
            var url = 'https://trackflag.nasasafety.com/server/adminstatusajax.php?event_id=' + document.getElementById('event_id').value.toString();
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
       randomrefresh = 5000;
       setTimeout(checkforStatus, randomrefresh );
}

function clickbtn(btnid){
	var btnname = 'btn'+btnid.toString();
	var fieldname = 'field'+btnid.toString();
	if (document.getElementById(fieldname).value == 1){
		document.getElementById(btnname).className = 'turnbuttoninactive';
		document.getElementById(fieldname).value = 0;
	}else{
		document.getElementById(btnname).className = 'turnbuttonactive';
		document.getElementById(fieldname).value = 1;
	}
}

function clearallflags(e) {
  	event_id = document.getElementById('event_id').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=-1', true);
    xmlhttpevent.send();

}

function clearglobalflags(e) {
  	event_id = document.getElementById('event_id').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=-2', true);
    xmlhttpevent.send();

}
function clearlocalflags(e) {
  	event_id = document.getElementById('event_id').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=-3', true);
    xmlhttpevent.send();

}

function loadpreview() {
  	div = document.getElementById('previewdiv');
  	div.innerHTML = "<iframe src='https://trackflag.nasasafety.com/web' width=100% height=100%></iframe>";
}

function clickblack(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action1 = document.getElementById('action1').value;
	if(action1 == 0){
	  action1 = 1; 
	  document.getElementById('action1').value = 1;
	  document.getElementById('blackFlag').style.border = "blue 5px solid";
	}else{
	  action1 = 0;
	  document.getElementById('action1').value = 0;
	  document.getElementById('blackFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=1&action='+action1.toString(), true);
    	xmlhttpevent.send();
    }

}

function clickwhite(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action2 = document.getElementById('action2').value;
	if(action2 == 0){
	  action2 = 1; 
	  document.getElementById('action2').value = 1;
	  document.getElementById('whiteFlag').style.border = "blue 5px solid";
	}else{
	  action2 = 0;
	  document.getElementById('action2').value = 0;
	  document.getElementById('whiteFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }
	if(noupdate != 1){
   	 xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=2&action='+action2.toString(), true);
   	 xmlhttpevent.send();
	}

}

function clicksafety(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action3 = document.getElementById('action3').value;
	if(action3 == 0){
	  action3 = 1; 
	  document.getElementById('action3').value = 1;
	  document.getElementById('safetyFlag').style.border = "blue 5px solid";
	}else{
	  action3 = 0;
	  document.getElementById('action3').value = 0;
	  document.getElementById('safetyFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
   	 xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=3&action='+action3.toString(), true);
    	xmlhttpevent.send();
    }

}

function clickdblyellow(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action4 = document.getElementById('action4').value;
	if(action4 == 0){
	  action4 = 1; 
	  document.getElementById('action4').value = 1;
	  document.getElementById('doubleyellowFlag').style.border = "blue 5px solid";
	}else{
	  action4 = 0;
	  document.getElementById('action4').value = 0;
	  document.getElementById('doubleyellowFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
  	  xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=4&action='+action4.toString(), true);
    	xmlhttpevent.send();
    }

}


function clickred(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action5 = document.getElementById('action5').value;
	if(action5 == 0){
	  action5 = 1; 
	  document.getElementById('action5').value = 1;
	  document.getElementById('redFlag').style.border = "blue 5px solid";
	}else{
	  action5 = 0;
	  document.getElementById('action5').value = 0;
	  document.getElementById('redFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=5&action='+action5.toString(), true);
   	 xmlhttpevent.send();
   	}

}


function clickgreen(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action6 = document.getElementById('action6').value;
	if(action6 == 0){
	  action6 = 1; 
	  document.getElementById('action6').value = 1;
	  document.getElementById('greenFlag').style.border = "blue 5px solid";
	}else{
	  action6 = 0;
	  document.getElementById('action6').value = 0;
	  document.getElementById('greenFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
   	 xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=6&action='+action6.toString(), true);
    	xmlhttpevent.send();
    }

}

function clickrestart(e, noupdate) {
  	event_id = document.getElementById('event_id').value;
	action7 = document.getElementById('action7').value;
	if(action7 == 0){
	  action7 = 1; 
	  document.getElementById('action7').value = 1;
	  document.getElementById('restartFlag').style.border = "blue 5px solid";
	}else{
	  action7= 0;
	  document.getElementById('action7').value = 0;
	  document.getElementById('restartFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
   	 xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=7&action='+action7.toString(), true);
   	 xmlhttpevent.send();
   	}

}

function clickcheckered(e, noupdate) {

  	event_id = document.getElementById('event_id').value;
	action11 = document.getElementById('action11').value;
	if(action11 == 0){
	  action11 = 1; 
	  document.getElementById('action11').value = 1;
	  document.getElementById('checkeredFlag').style.border = "blue 5px solid";
	}else{
	  action11 = 0;
	  document.getElementById('action11').value = 0;
	  document.getElementById('checkeredFlag').style.border = "white 5px solid";
	}
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }

    }

	if(noupdate != 1){
    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=11&action='+action11.toString(), true);
   	 xmlhttpevent.send();
   	}

}



// Local flags
function clickdebris(e, noupdate) {
	turns = gatherturns();
  	event_id = document.getElementById('event_id').value;
	action8 = document.getElementById('action8').value;
  	var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
            showlocaldebris(turns);
            document.getElementById("localdebrisFlag").style.display = "inline-block";
        }

    }
    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=8&action=1&turn='+turns.toString(), true);
    	xmlhttpevent.send();
}

function clickstandingyellow(e) {
	turns = gatherturns();
  	event_id = document.getElementById('event_id').value;
	action9 = document.getElementById('action9').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
            showlocalyellow(turns);
            document.getElementById("localyellowFlag").style.display = "inline-block";
        }

    }


    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=9&action=1&turn='+turns.toString(), true);
    	xmlhttpevent.send();


}

function clickwavingyellow(e) {
	turns = gatherturns();
  	event_id = document.getElementById('event_id').value;
	action10 = document.getElementById('action10').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
		    var canvas = document.getElementById('localwavingFlag');
		    ctx = canvas.getContext('2d');
		    var clientHeight = 100;
		    var clientWidth = 100;
		    ctx.clearRect(0, 0, clientWidth, clientHeight);
		    clearTimeout(wavingyellowTimeout);            
            showwavingyellow(turns);
            document.getElementById("localwavingFlag").style.display = "inline-block";
        }
    }

    	xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=10&action=1&turn='+turns.toString(), true);
    	xmlhttpevent.send();


}

function clearlocaldebris(e) {
  	event_id = document.getElementById('event_id').value;
	action8 = document.getElementById('action8').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }
    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=8&action=0', true);
    xmlhttpevent.send();
    document.getElementById("localdebrisFlag").style.display = "none";

}

function hidelocaldebris(e) {
  document.getElementById("localdebrisFlag").style.display = "none";

}

function clearlocalyellow(e) {
  	event_id = document.getElementById('event_id').value;
	action9 = document.getElementById('action9').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }
    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=9&action=0', true);
    xmlhttpevent.send();
    document.getElementById("localyellowFlag").style.display = "none";

}

function hidelocalyellow(e) {
  document.getElementById("localyellowFlag").style.display = "none";

}


function clearwavingyellow(e) {
  	event_id = document.getElementById('event_id').value;
	action10 = document.getElementById('action10').value;
  var xmlhttpevent = new XMLHttpRequest();
    xmlhttpevent.onreadystatechange = function() {
        if (xmlhttpevent.readyState == 4 && xmlhttpevent.status == 200) {
            document.getElementById("runscript").innerHTML = xmlhttpevent.responseText;
        }
    }

    xmlhttpevent.open("GET", 'https://trackflag.nasasafety.com/server/updateflag.php?event_id='+event_id.toString()+'&id=10&action=0', true);
    xmlhttpevent.send();
    document.getElementById("localwavingFlag").style.display = "none";
    var canvas = document.getElementById('localwavingFlag');
    ctx = canvas.getContext('2d');
    var clientHeight = 100;
    var clientWidth = 100;
    ctx.clearRect(0, 0, clientWidth, clientHeight);
    clearTimeout(wavingyellowTimeout);    

}

function hidewavingyellow(e) {
    document.getElementById("localwavingFlag").style.display = "none";
    var canvas = document.getElementById('localwavingFlag');
    ctx = canvas.getContext('2d');
    var clientHeight = 100;
    var clientWidth = 100;
    ctx.clearRect(0, 0, clientWidth, clientHeight);
    clearTimeout(wavingyellowTimeout);    

}


function gatherturns(){
	var turns = '';
	var t = 1
	while (t <= 20){
		var btnname = 'btn'+t.toString();
		var fieldname = 'field'+t.toString();
		if(document.getElementById(fieldname).value==1){
			turns = turns + t.toString() + ',';
			document.getElementById(btnname).className = 'turnbuttoninactive';
			document.getElementById(fieldname).value = 0;
		}
		t = t + 1;
	}
	turns = turns.substring(0,turns.length-1);
return turns;
}

function showlocaldebris(turns){
    //showlocaldebris

    var canvas = document.getElementById('localdebrisFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width; 
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'yellow';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'red';
    context.stroke();

    var barwidth = width / 10;

    var c=document.getElementById("localdebrisFlag");
    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(barwidth,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(barwidth * 3,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(barwidth * 5,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(barwidth * 7,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(barwidth * 9,0,barwidth,height);

    var artificiallength = turns.length + 7;
    var divisor = '1.'+artificiallength.toString();
    var divisor = 5.7;            
    var textheight = (height / divisor);
    var textString = turns.trim();
    var ctx = c.getContext("2d");
    ctx.font= textheight.toString()+"px Verdana";
    context.fillStyle = 'black';
    textWidth = ctx.measureText(textString ).width;
    ctx.fillText(textString , (width/2) - (textWidth / 2), (height/2) - (textheight/2));

    canvas.addEventListener("click", clearlocaldebris, false);
}


function showlocalyellow(turns){
    //showlocaldebris

    var canvas = document.getElementById('localyellowFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width; 
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'yellow';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    var artificiallength = turns.length + 7;
    var divisor = '1.'+artificiallength.toString();
    var divisor = 5.7;            
    var textheight = (height / divisor);
    var textString = turns.trim();
    var ctx = canvas.getContext("2d");
    ctx.font= textheight.toString()+"px Verdana";
    context.fillStyle = 'black';
    textWidth = ctx.measureText(textString ).width;
    ctx.fillText(textString , (width/2) - (textWidth / 2), (height/2) - (textheight/2));

    canvas.addEventListener("click", clearlocalyellow, false);
}


function showwavingyellow(turns){
    //showwavingyellow
  hidewavingYellow();
    var canvas = document.getElementById('localwavingFlag');
	blinkwavingYellow(canvas,turns.trim(), 1);

    canvas.addEventListener("click", clearwavingyellow, false);
}



function blinkwavingYellow(canvas, turns, even){
        if (even == 1)
            {
               even = 0;
                var context = canvas.getContext('2d');

                var clientHeight = 100;
                var clientWidth = 100;

                // resize the canvas
                canvas.height = clientHeight;
                canvas.width = clientWidth;

                var fillcolor;
                var othercolor;
                fillcolor = 'yellow';
                othercolor = '#c0c0c0';


                context.beginPath();
                context.clearRect(0, 0, clientWidth/2, clientHeight);
                context.rect(0, 0, clientWidth/2, clientHeight);
                context.fillStyle = fillcolor;
                context.fill();
                context.lineWidth = 1;
                context.strokeStyle = 'black';
                context.stroke();

                context.beginPath();
                context.clearRect(clientWidth/2, 0, clientWidth/2, clientHeight);
                context.rect(clientWidth/2, 0, clientWidth/2, clientHeight);
                context.fillStyle = othercolor;
                context.fill();
                context.lineWidth = 1;
                context.strokeStyle = 'black';
                context.stroke();    

                if ( turns ) {
                        var textheight = (clientHeight / 5.7);
                        var textString = turns.trim();
                        var ctx = canvas.getContext("2d");
                        ctx.font= textheight.toString()+"px Verdana";
                        context.fillStyle = 'black';
                        textWidth = ctx.measureText(textString ).width;
                        ctx.fillText(textString , (clientWidth/2) - (textWidth / 2), (clientHeight/2) - (textheight/2));
                }                

            } else{
                even = 1;
                var context = canvas.getContext('2d');//

                var clientHeight = 100;   
                var clientWidth = 100;

                // resize the canvas
                canvas.height = clientHeight;
                canvas.width = clientWidth;

                var fillcolor;
                var othercolor;
                fillcolor = '#c0c0c0';
                othercolor = 'yellow';


                context.beginPath();
                context.clearRect(0, 0, clientWidth/2, clientHeight);
                context.rect(0, 0, clientWidth/2, clientHeight);
                context.fillStyle = fillcolor;
                context.fill();
                context.lineWidth = 1;
                context.strokeStyle = 'black';
                context.stroke();

                context.beginPath();
                context.clearRect(clientWidth/2, 0, clientWidth/2, clientHeight);
                context.rect(clientWidth/2, 0, clientWidth/2, clientHeight);
                context.fillStyle = othercolor;
                context.fill();
                context.lineWidth = 1;
                context.strokeStyle = 'black';
                context.stroke();

                if ( turns ) {
                        var textheight = (clientHeight / 5.7);
                        var textString = turns.trim();
                        var ctx = canvas.getContext("2d");
                        ctx.font= textheight.toString()+"px Verdana";
                        context.fillStyle = 'black';
                        textWidth = ctx.measureText(textString ).width;
                        ctx.fillText(textString , (clientWidth/2) - (textWidth / 2), (clientHeight/2) - (textheight/2));
                }                    
            }
            
randomrefresh = 500;
wavingyellowTimeout = setTimeout(blinkwavingYellow, randomrefresh, canvas, turns, even);    
        
}