

<?php 
session_start();
include("php/functions.php");
if (logged_in()== true) {
			include("php/headerLoggedin.php");
		} else {
			include("php/header.php");
		}
		$userid=$_SESSION['user_id'];
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
var c=0
var t

function update()
{
             $.ajax({
                url: "update.php",
                type: "POST",
                data: { 'userid':<?php echo $_SESSION['user_id']?>, 'timer': c },                   
                success: function()
                            {
                                //alert("ok");                                    
                            }
							
            });
}

function timedCount()
 {
 document.getElementById('txt').innerHTML="<h3>"+c+"</h3>"
 c=c+1
 t=setTimeout("timedCount()",1000)
 }

function stopCount()
{
 clearTimeout(t)
 update()
}  

</script>

<div class="row">
    <p> </p>
</div>
<div class="row">
    <p> </p>
</div>
<div class="row">
    <p> </p>
</div>
<div class="row" id="containerRow">
    <div class="col-lg-4 .col-md-4" id="walkingTimePanel" style="background-color:rgba(255, 226, 223, 0)">
        <label style='color:rgba(255, 208, 209, 1)' for="walkingTime">Walking time</label>
        <input type="text" id="walkingTime" placeholder="Minutes" value="<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $_POST["minText"];
        }
        ?>"  class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
        <div class="dropdown">
            <button id="dropPoi" onclick="myFunction()"  class="dropbtn">Select place of interest <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
            <div id="myDropdown" class="dropdown-content">
                <a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground(); clickButton();" id="forPlayground">Playground</a>
                <a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe(); clickButton();" id="forCafe" >Cafe</a>
                <a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet(); clickButton(); " id="forToilet">Restroom</a>
            </div>
        </div>

        <div class="btn btn-primary" style="display: none;" id="submit" >Show places!</div>


        <div id="list">
            <!--                    can we set this dynamically?-->
            <h3 style='color:rgba(255, 208, 209, 1)'>List of places</h3>
            <ul id="places" class="nav nav-pills nav-stacked"></ul>
        </div>
        <label style='color:rgba(255, 208, 209, 1)' for="start">Start</label>
        <input class="form-control" type="text" id="start" placeholder="You are here" style="background-color:rgba(255, 226, 223, 0.6);border:0px">

        <label style='color:rgba(255, 208, 209, 1)' for="end">End</label>
        <input class="form-control" type="text" id="end" placeholder="Pick a marker or enter an address" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
        <button id="route" class="dropbtn" >Get me there</button>
     <!-- <button id="startTimer" class="dropbtn" onclick="startTimer">Start timer</button>
        <button id="startTimer" class="dropbtn" onclick="endTimer">Finish walk</button> ?-->
		
		
        <form>
            <label style='color:rgba(255, 208, 209, 1)'><h3>I have walked for</h3></label>
            
            <label> </label>
            
            <label style='color:rgba(255, 208, 209, 1)' id="txt"><h3>0</h3></label>
            
            <label> </label>
            
            <label style='color:rgba(255, 208, 209, 1)'><h3>seconds</h3></label><br/>
            
            <input type="button" class="dropbtn" value="Start walking" onClick="timedCount()">
            
            <input type="button" class="dropbtn" value="Stop walking" onClick="stopCount()">
</form>
    
    </div>
    <div class="col-lg-7" id="map" style="border:0px"></div>
</div>        
<?php include("php/footer.php") ?>
<script>
    $(document).ready(function () {
        checkDropDownValue('<?php if(isset($_POST["dpText"])){ echo $_POST["dpText"];} ?>')
    });
</script>

