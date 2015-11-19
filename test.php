<html>
<head>
</head>
<body>
<?php
include("dbconx.php");

$db = conn_db();
$result = pg_query($db, "SELECT * from users");
$row = pg_fetch_row($result);
echo $row[0]." ".$row[1];
$row = pg_fetch_row($result);
echo $row[0]." ".$row[1];
// if (!$result){echo "Error!\n";}
// for ($i = 0; $i < pg_num_rows($result; ++$i){
	// echo pg_fetch_row($result);
// }

?>

</body>
</html>