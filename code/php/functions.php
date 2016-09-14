<?php
	function logged_in () {
		if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}

	function redirect_to ($url) {
		header("Location:{$url}");
	}

function getUser($user_id, $field){
    $query = mysqli_query("SELECT $field FROM user WHERE userid = '$user_id'");
    $run = mysqli_fetch_array($query);
    return $run[$field];
}


?>