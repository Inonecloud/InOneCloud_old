<?php

$user = 'root';
$pass = '';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=inonecloud', $user, $pass);
    foreach($dbh->query('SELECT * from accounts') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
/*try{
	$db = new PDO('mysql:host=mysql.hostinger.ru; dbname = u511004072_inone', 'u511004072_admin', 'N6CL4wjRMqzlWm8');
}catch (PDOException $e){
		echo "ggg" . $e->getMessage();
		exit;
}
echo "Hello";

$sth = $db->prepare("SELECT * FROM accounts");
$sth->execute();

$result = $sth->fetchAll();
print_r($result);*/


