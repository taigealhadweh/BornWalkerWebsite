<?php
include("php/header.php");
?>
<div class="row" id="containerRow">
    <div class="col-lg-4 .col-md-4" id="walkingTimePanel" style="background-color:rgba(255, 226, 223, 0)">
        <div>Walking time(minutes):</div>
        <input type="text" id="walkingTime" placeholder="Enter a walking time" value="<?php echo $_POST["minText"]; ?>"  class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
        <div class="dropdown">
            <button id="dropPoi" onclick="myFunction()"  class="dropbtn">Select place of interest</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet(); " id="forToilet">Toilet</a>
                <a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe();" id="forCafe">Cafe</a>
                <a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground();" id=forPlayground"">Playground</a>
            </div>
        </div>

        <input class="btn btn-primary" id="submit" value="Show places!">
        <br>

        <div id="list">
            <!--                    can we set this dynamically?-->
            <h3>List of places</h3>
            <ul id="places" class="nav nav-pills nav-stacked"></ul>
        </div>
        <label for="start">Start</label>
        <input class="form-control" type="text" id="start" placeholder="You are here" style="background-color:rgba(255, 226, 223, 0.6);border:0px">

        <label for="end">End</label>
        <input class="form-control" type="text" id="end" placeholder="Pick a marker or enter an address" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
        <input type="submit" id="route" class="btn btn-primary" value="Route">
    </div>
    <div class="col-lg-7" id="map" style="border:0px"></div>
</div>        
<?php include("php/footer.php") ?>
<script>

    $(document).ready(function () {
        checkDropDownValue('<?php echo $_POST["dpText"] ?>')
    });
</script>