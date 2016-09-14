<?php
$currentId = 1;
$user = 4;
$query = "SELECT 'user_one', 'user_two' from frnds where user_one = $currentId OR user_two = $currentId";
print_r($query);
?>