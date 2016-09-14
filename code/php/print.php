<?php
$my_id = 1;
$user = 4;
$query = "SELECT id from frnd_req WHERE (from = $my_id AND to = $user)";

print_r($query);
?>