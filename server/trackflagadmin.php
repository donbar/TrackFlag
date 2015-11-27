<!DOCTYPE html>
<?php
    include "includes/trackflag.css";
    $event_id = $_REQUEST['event_id'];

    if($event_id == NULL){
      print"
      <script>
        location.replace('login.php');
      </script>";
    }

    if($_REQUEST['initializedb'] == 1){
        include "includes/dbconnection.php";
        $db = getdbconnection();
        $query = "select count(*) as cnt from flag where event_id = " . $event_id;
        $event_result = $db->query($query);
        $event_row = $event_result->fetch(PDO::FETCH_ASSOC);
        if($event_row['cnt'] > 0){
            $db->connection = null;
        }else{
          $sql = "insert into flag (id, flag_name, active, event_id) values (1,'black',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (2,'white',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (3,'safety',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (4,'fullyellow',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (5,'red',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (6,'green',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (7,'restart',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (8,'debris',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (9,'yellow',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (10,'wavingyellow',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (11,'checkered',0," . $event_id . ")";
          $event_result = $db->query($sql);
          $sql = "insert into flag (id, flag_name, active, event_id) values (12,'oil',0," . $event_id . ")";
          $event_result = $db->query($sql);          
          $db->connection = null;
        }

    }
?>


<html>
  <head>
    <meta charset="utf-8">
    <title>TrackFlag - Real-time Racetrack Flags Administration</title>
    <script src="js/trackflagserver.js?random=1"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </head>
  <body onload='checkforStatus(); loadpreview();'>
    <div id="txtGetStatus" style='display:none'></div>
    <form name='trackflag'>
            <span id='verticaldiv' class='verticaldiv'>Active Local Flags
              <span id='activelocalflags'>
                <canvas id="localdebrisFlag" style='display:none'></canvas>
                <canvas id="localyellowFlag" style='display:none'></canvas>
                <canvas id="localwavingFlag" style='display:none'></canvas>
                <canvas id="localoilFlag" style='display:none'></canvas>
            </span></span>
            <div id='previewdiv' class='previewdiv'>Driver View</div>
            <br>
      <input type='hidden' id='event_id' name='event_id' value='<?php print $event_id ?>'></input>
      <input type='hidden' id='action1' name='action1'></input>
      <input type='hidden' id='action2' name='action2'></input>
      <input type='hidden' id='action3' name='action3'></input>
      <input type='hidden' id='action4' name='action4'></input>
      <input type='hidden' id='action5' name='action5'></input>
      <input type='hidden' id='action6' name='action6'></input>
      <input type='hidden' id='action7' name='action7'></input>
      <input type='hidden' id='action8' name='action8'></input>
      <input type='hidden' id='action9' name='action9'></input>
      <input type='hidden' id='action10' name='action10'></input>
      <input type='hidden' id='action11' name='action11'></input>
      <input type='hidden' id='action12' name='action12'></input>
  		<div id='runscript' style='display: none'></div>
        <center>
          
          <canvas id="greenFlag" style="border: 5px white solid"></canvas>
          <canvas id="doubleyellowFlag" style="border: 5px white solid"></canvas>
          <canvas id="safetyFlag" style="border: 5px white solid"></canvas>
          <canvas id="whiteFlag" style="border: 5px white solid"></canvas>
          <canvas id="checkeredFlag" class='checkered' style="border: 5px white solid"></canvas>
          <br>
          <canvas id="blackFlag" style="border: 5px white solid"></canvas>
          <canvas id="restartFlag" style="border: 5px white solid"></canvas>
          <canvas id="redFlag"  style="border: 5px white solid"></canvas>
          


                <input type='hidden' id='field1' name='field1'></input>
                <input type='hidden' id='field2' name='field2'></input>
                <input type='hidden' id='field3' name='field3'></input>
                <input type='hidden' id='field4' name='field4'></input>
                <input type='hidden' id='field5' name='field5'></input>
                <input type='hidden' id='field6' name='field6'></input>
                <input type='hidden' id='field7' name='field7'></input>
                <input type='hidden' id='field8' name='field8'></input>
                <input type='hidden' id='field9' name='field9'></input>
                <input type='hidden' id='field10' name='field10'></input>
                <input type='hidden' id='field11' name='field11'></input>
                <input type='hidden' id='field12' name='field12'></input>
                <input type='hidden' id='field13' name='field13'></input>
                <input type='hidden' id='field14' name='field14'></input>
                <input type='hidden' id='field15' name='field15'></input>
                <input type='hidden' id='field16' name='field16'></input>
                <input type='hidden' id='field17' name='field17'></input>
                <input type='hidden' id='field18' name='field18'></input>
                <input type='hidden' id='field19' name='field19'></input>
                <input type='hidden' id='field20' name='field20'></input>
                <br><br>
                
                <input type='button' value='  1  ' class='turnbuttoninactive' id='btn1' onclick='clickbtn(1);'>&nbsp;
                <input type='button' value='  2  ' class='turnbuttoninactive' id='btn2' onclick='clickbtn(2);'>&nbsp;
                <input type='button' value='  3  ' class='turnbuttoninactive' id='btn3' onclick='clickbtn(3);'>&nbsp;
                <input type='button' value='  4  ' class='turnbuttoninactive' id='btn4' onclick='clickbtn(4);'>&nbsp;
                <input type='button' value='  5  ' class='turnbuttoninactive' id='btn5' onclick='clickbtn(5);'>&nbsp;
                <input type='button' value='  6  ' class='turnbuttoninactive' id='btn6' onclick='clickbtn(6);'>&nbsp;
                <input type='button' value='  7  ' class='turnbuttoninactive' id='btn7' onclick='clickbtn(7);'>&nbsp;
                <input type='button' value='  8  ' class='turnbuttoninactive' id='btn8' onclick='clickbtn(8);'>&nbsp;
                <input type='button' value='  9  ' class='turnbuttoninactive' id='btn9' onclick='clickbtn(9);'>&nbsp;
                <input type='button' value=' 10  ' class='turnbuttoninactive' id='btn10' onclick='clickbtn(10);'>
                <br><br>
                <input type='button' value=' 11  ' class='turnbuttoninactive' id='btn11' onclick='clickbtn(11);'>&nbsp;
                <input type='button' value=' 12  ' class='turnbuttoninactive' id='btn12' onclick='clickbtn(12);'>&nbsp;
                <input type='button' value=' 13  ' class='turnbuttoninactive' id='btn13' onclick='clickbtn(13);'>&nbsp;
                <input type='button' value=' 14  ' class='turnbuttoninactive' id='btn14' onclick='clickbtn(14);'>&nbsp;
                <input type='button' value=' 15  ' class='turnbuttoninactive' id='btn15' onclick='clickbtn(15);'>&nbsp;
                <input type='button' value=' 16  ' class='turnbuttoninactive' id='btn16' onclick='clickbtn(16);'>&nbsp;
                <input type='button' value=' 17  ' class='turnbuttoninactive' id='btn17' onclick='clickbtn(17);'>&nbsp;
                <input type='button' value=' 18  ' class='turnbuttoninactive' id='btn18' onclick='clickbtn(18);'>&nbsp;
                <input type='button' value=' 19  ' class='turnbuttoninactive' id='btn19' onclick='clickbtn(19);'>&nbsp;
                <input type='button' value=' S/F  ' class='turnbuttoninactive' id='btn20' onclick='clickbtn(20);'>
                <br><br><br>


          <canvas id="debrisFlag" style="border: 5px white solid"></canvas>
          <canvas id="standingYellow" style="border: 5px white solid"></canvas>
          <canvas id="wavingYellow" style="border: 5px white solid"></canvas>
          <canvas id="oilFlag" style="border: 5px white solid"></canvas>
          <br><br><br>
                  </center>
            <span style="float:right">
          <input id='clearglobal' type='button' value='Clear Global' onclick='clearglobalflags();'></td>
          <input id='clearlocal' type='button' value='Clear Local' onclick='clearlocalflags();'></td>
          <input id='clearall' type='button' value='Clear All' onclick='clearallflags();'></td>
        </span>
        
      </span>




<script>
//flag 1
    var canvas = document.getElementById('blackFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'black';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clickblack, false);

//flag 2
    var canvas = document.getElementById('whiteFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'white';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clickwhite, false);

//flag 3
    var canvas = document.getElementById('safetyFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'white';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clicksafety, false);

    var c=document.getElementById("safetyFlag");
    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    var barwidth = width * .05;
    ctx.fillRect(width/2 - (barwidth/2),0,barwidth,height);

    // Red Cross for Safety flag
    var c=document.getElementById("safetyFlag");
    var ctx=c.getContext("2d");
    ctx.fillStyle = 'red';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'red';
    ctx.fillRect(0,height/2 - (barwidth/2),width,barwidth);

    //flag 4
    var canvas = document.getElementById('doubleyellowFlag');
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
    canvas.addEventListener("click", clickdblyellow, false);    


    //flag 5
    var canvas = document.getElementById('redFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'red';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clickred, false);


    //flag 6
    var canvas = document.getElementById('greenFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'green';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clickgreen, false);    



    //flag 7
    var canvas = document.getElementById('restartFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width; 
    context.beginPath();
    context.rect(0, 0, width/2, height);
    context.fillStyle = 'red';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();

    context.beginPath();
    context.rect(width/2, 0, width/2, height);
    context.fillStyle = 'yellow';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();
    canvas.addEventListener("click", clickrestart, false);


    //flag 8
    var canvas = document.getElementById('debrisFlag');
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

    var c=document.getElementById("debrisFlag");
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
    canvas.addEventListener("click", clickdebris, false);

    //flag 9
    var canvas = document.getElementById('standingYellow');
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
    canvas.addEventListener("click", clickstandingyellow, false);

    var textheight = (height / 5.7);
    var textString = 'Standing';
    var ctx = canvas.getContext("2d");
    ctx.font= textheight.toString()+"px Verdana";
    context.fillStyle = 'black';
    textWidth = ctx.measureText(textString ).width;
    ctx.fillText(textString , (width/2) - (textWidth / 2), (height/2) - (textheight/2));

    //flag 10
     var canvas = document.getElementById('wavingYellow');
    var canvas = document.getElementById('wavingYellow');
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

    var textheight = (height / 5.7);
    var textString = 'Waving';
    var ctx = canvas.getContext("2d");
    ctx.font= textheight.toString()+"px Verdana";
    context.fillStyle = 'black';
    textWidth = ctx.measureText(textString ).width;
    ctx.fillText(textString , (width/2) - (textWidth / 2), (height/2) - (textheight/2));

    canvas.addEventListener("click", clickwavingyellow, false);   


    //flag 11
    var canvas = document.getElementById('checkeredFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.lineWidth = 1;
    context.strokeStyle = 'black'
    context.stroke();    
    canvas.addEventListener("click", clickcheckered, false);      

    //flag 12
    var canvas = document.getElementById('oilFlag');
    var context = canvas.getContext('2d');
    var height = 100;
    var width = 100;
    canvas.height = height;
    canvas.width = width; 
    context.beginPath();
    context.rect(0, 0, width, height);
    context.fillStyle = 'purple';
    context.fill();
    context.lineWidth = 1;
    context.strokeStyle = 'black';
    context.stroke();

    var barwidth = width / 10;

    var c=document.getElementById("oilFlag");
    var ctx=c.getContext("2d");
    ctx.fillStyle = 'black';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'black';
    ctx.fillRect(barwidth,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'black';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'black';
    ctx.fillRect(barwidth * 3,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'black';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'black';
    ctx.fillRect(barwidth * 5,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'black';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'black';
    ctx.fillRect(barwidth * 7,0,barwidth,height);

    var ctx=c.getContext("2d");
    ctx.fillStyle = 'black';
    ctx.lineWidth = 1;
    ctx.strokeStyle = 'black';
    ctx.fillRect(barwidth * 9,0,barwidth,height);
    canvas.addEventListener("click", clickoil, false);


</script>    

	  </form>
  </body>
</html>

