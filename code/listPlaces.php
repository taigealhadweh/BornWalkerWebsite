<?php 
session_start();
include("php/functions.php");
if (logged_in()== true) {
			include("php/headerLoggedin.php");
		} else {
			include("php/header.php");
		}
?>
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
		
          <!--   <button id="startTimer" class="dropbtn" onclick="startTimer">Start timer</button>
        <button id="startTimer" class="dropbtn" onclick="endTimer">Finish walk</button>?-->
		<form  method="post" >
  
			<input type="submit" name="starttimer" value="Start">  
			<input type="submit" name="endtimer" value="Finish">
  
		</form>
		
		<p>Time:</p><p id='timewindow'> <?php 
		$conn = mysqli_connect("40.126.240.245", "k10838a", "password", "bornWalkerMap")
	or die("<p>Unable to connect to the database server1.</p>"
	. "<p>Error code " . mysqli_connect_errno()
	. ": " . mysqli_connect_error()) . "</p>";
	
		$showquery="select period from walk  WHERE walkid = ( SELECT MAX(walkid) FROM bornWalkerMap.walk ) ";
		$showtimeresault=mysqli_query($conn, $showquery) or die('search error' . mysqli_error());
		
	  if(!$showtimeresault )
			{
			  die('Could not get data: ' . mysqli_error());
			}
		while($rowshow = mysqli_fetch_assoc($showtimeresault))
		{
			$period=$rowshow['period'];
			Echo $period;
			
		}
		?> </p>
    </div>
    <div class="col-lg-7" id="map" style="border:0px"></div>
</div>        
<?php
	$userid=$_SESSION['user_id'];
if (isset($_POST["starttimer"])) {
	$conn = mysqli_connect("40.126.240.245", "k10838a", "password", "bornWalkerMap")
	or die("<p>Unable to connect to the database server1.</p>"
	. "<p>Error code " . mysqli_connect_errno()
	. ": " . mysqli_connect_error()) . "</p>";
	
	$starttimequery="insert into bornWalkerMap.walk(starttime,userid) values (current_timestamp(),'$userid')";
	$starttimeresult = mysqli_query($conn, $starttimequery) or die('search error' . mysqli_error());
	
	
}

if (isset($_POST["endtimer"])) {
	$conn = mysqli_connect("40.126.240.245", "k10838a", "password", "bornWalkerMap")
	or die("<p>Unable to connect to the database server1.</p>"
	. "<p>Error code " . mysqli_connect_errno()
	. ": " . mysqli_connect_error()) . "</p>";
	
	$widquery="SELECT walkid FROM bornWalkerMap.walk WHERE walkid = ( SELECT MAX(walkid) FROM bornWalkerMap.walk )";
	/*$widquery="SELECT MAX(walkid) FROM bornWalkerMap.walk WHERE userid='41'";*/
	$widresult = mysqli_query($conn, $widquery) or die('search error' . mysqli_error());
	
	  if(!$widresult )
			{
			  die('Could not get data: ' . mysqli_error());
			}
		while($row1 = mysqli_fetch_assoc($widresult))
			{	
			$walkid = $row1['walkid']; 
			/*$walkid = $row1['walkid'];*/
			$endtimequery="UPDATE bornWalkerMap.walk SET endtime =current_timestamp() WHERE walkid='$walkid'";
			$endtimeresult = mysqli_query($conn, $endtimequery) or die('search error' . mysqli_error());
			
			$ctquery= "select endtime, starttime from bornWalkerMap.walk  WHERE walkid='$walkid'";
			$ctresult=mysqli_query($conn, $ctquery)or die('search error' . mysqli_error());
			
			if(!$ctresult )
			{
			  die('Could not get data: ' . mysqli_error());
			}
			while($row2 = mysqli_fetch_assoc($ctresult))
			{	
			$endtime = $row2['endtime']; 
			$starttime = $row2['starttime'];
			$period = strtotime($endtime) - strtotime($starttime);
			
			$periodquery="UPDATE bornWalkerMap.walk SET period ='$period' WHERE walkid='$walkid'";
			$periodresult = mysqli_query($conn, $periodquery)or die('search error' . mysqli_error());
			
			}
		
			} 
			
}

 include("php/footer.php") ?>
<script>
    $(document).ready(function () {
        checkDropDownValue('<?php if(isset($_POST["dpText"])){ echo $_POST["dpText"];} ?>')
    });
</script>