    <?php
require_once ('database.php');
$conn = database::getInstance()->getConnection();

$table = "CREATE TABLE IF NOT EXISTS clients(
ID int NOT NULL AUTO_INCREMENT,
name VARCHAR(25) NOT NULL,
surname VARCHAR(25) NOT NULL,
email VARCHAR(55) NOT NULL,
phone1 INT(9) NOT NULL,
phone2 INT(9) NOT NULL,
comment VARCHAR(55) NOT NULL,
PRIMARY KEY (ID))";

if ($conn->query($table) === false) {
    echo "Failed to create table: " . $conn->error;
    exit();
}
?>