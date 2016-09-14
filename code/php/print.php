<?php
$my_id = 1;
$user = 4;
$query = "INSERT INTO frnd_req VALUES ('', $my_id, $user)";
$test = 'location: profile.php?user='.$user;
print_r($test);
?>