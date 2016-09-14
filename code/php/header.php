<div id="title_bar">
    <ul>
        <li><a href="friend.php">Home</a></li>
        <?php
        if (logged_in()){
            ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="request.php">Requests</a></li>
            <li><a href="friends.php">Friends</a></li>
            <li><a href="members.php">Members</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
            } else {
            ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php
        }
?>
                    <div class="clear"></div>
    </ul>
</div>