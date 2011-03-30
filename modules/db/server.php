<?php
$result = $DB->GetRow("SELECT * FROM users_profiles WHERE user_id = '$_SESSION[id]'");

echo json_encode($result);
?>
