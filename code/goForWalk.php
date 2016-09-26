<?php include("php/header.php") ?>

<header>
    <form method="post" action="listPlaces.php" name="listPlaces" id="listPlaces">
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading" >How long do you feel like walking?</h1>
                <div id="walkingTimeInput" class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" id="start" name="minText" placeholder="minutes" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>


                <h1 id="homeHeading">What would you like on your trip?</h1>

                <div id="interestInput" class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <select name="dpText" id="dpText" class="dropbtn">
                            <option value="Toilet">Toilet</option>
                            <option value="Cafe">Cafe</option>
                            <option value="Playground">Playground</option>
                        </select>
                        <!--<input class="form-control" type="text" id="start" name="dpText" placeholder="this should be a dropdown button" style="background-color:rgba(255, 226, 223, 0.6);border:0px">-->
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>

                <h1><p></p></h1>

                <hr>
                <div id="button" class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-xl page-scroll goBtn"><h3>Back</h3></button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-xl page-scroll goBtn"><h3>Let's go</h3></button>
                    </div>
                    <div class="col-md-3">
                    </div>
                
                </div>

            </div>
        </div>
    </form>
</header>

<?php include("php/footer.php") ?>