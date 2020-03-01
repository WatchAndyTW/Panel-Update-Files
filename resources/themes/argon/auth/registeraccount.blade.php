<?php
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$user = $_REQUEST["user"];
$email = $_REQUEST["email"];
$pw = $_REQUEST["password"];
$pwr = $_REQUEST["passwordrepeat"];



if ($pw == $pwr) {
	echo "Pretty much nothing but good";
} else {
	header('Location: ' . $_SERVER['HTTP_REFERER'].'?password');
}




$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://p-panel.amtz.xyz/api/application/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "\n  {\n      \"username\": \"$user\",\n      \"email\": \"$email\",\n      \"first_name\": \"$fname\",\n      \"last_name\": \"$lname\",\n      \"password\": \"$pw\"\n  }");
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = 'Authorization: base64:GJ+IUO8e0v8VA2OHCldgFDL7mxnBWKpeMI0cOfS4djM=';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: Application/vnd.pterodactyl.v1+json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);




if (strpos($result, 'errors') !== false) {

	header('Location: ' . $_SERVER['HTTP_REFERER'].'?exists');

} else if (strpos($result, 'created_at') !== false) {

	header('Location: ' . $_SERVER['HTTP_REFERER'].'?success');

} else {

	header('Location: ' . $_SERVER['HTTP_REFERER'].'?unknown');

}

?>