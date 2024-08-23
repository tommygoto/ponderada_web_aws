<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../inc/dbinfo.inc"; 
?>
<html>
<body>
<h1>Customer Registration</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();  // Stop script if the connection fails
  }

  $database = mysqli_select_db($connection, DB_DATABASE);

  if (!$database) {
    echo "Error selecting database: " . mysqli_error($connection);
    exit();  // Stop script if the database selection fails
  }

  /* Ensure that the CUSTOMERS table exists. */
  VerifyCustomersTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the CUSTOMERS table. */
  $first_name = htmlentities($_POST['FIRST_NAME'] ?? '');
  $last_name = htmlentities($_POST['LAST_NAME'] ?? '');
  $email = htmlentities($_POST['EMAIL'] ?? '');
  $date_of_birth = htmlentities($_POST['DATE_OF_BIRTH'] ?? '');

  if (strlen($first_name) || strlen($last_name) || strlen($email) || strlen($date_of_birth)) {
    AddCustomer($connection, $first_name, $last_name, $email, $date_of_birth);
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Email</td>
      <td>Date of Birth</td>
    </tr>
    <tr>
      <td><input type="text" name="FIRST_NAME" maxlength="50" size="30" /></td>
      <td><input type="text" name="LAST_NAME" maxlength="50" size="30" /></td>
      <td><input type="email" name="EMAIL" maxlength="100" size="30" /></td>
      <td><input type="date" name="DATE_OF_BIRTH" /></td>
      <td><input type="submit" value="Add Customer" /></td>
    </tr>
  </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Email</td>
    <td>Date of Birth</td>
    <td>Join Date</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM CUSTOMERS");

if ($result) {
  while($query_data = mysqli_fetch_row($result)) {
    echo "<tr>";
    echo "<td>",$query_data[0], "</td>",
         "<td>",$query_data[1], "</td>",
         "<td>",$query_data[2], "</td>",
         "<td>",$query_data[3], "</td>",
         "<td>",$query_data[4], "</td>",
         "<td>",$query_data[5], "</td>";
    echo "</tr>";
  }
  mysqli_free_result($result);
} else {
  echo "<p>Error fetching data: " . mysqli_error($connection) . "</p>";
}

?>

</table>

<!-- Clean up. -->
<?php mysqli_close($connection); ?>

</body>
</html>

<?php

/* Add a customer to the table. */
function AddCustomer($connection, $first_name, $last_name, $email, $date_of_birth) {
   $fn = mysqli_real_escape_string($connection, $first_name);
   $ln = mysqli_real_escape_string($connection, $last_name);
   $em = mysqli_real_escape_string($connection, $email);
   $dob = mysqli_real_escape_string($connection, $date_of_birth);

   $query = "INSERT INTO CUSTOMERS (FIRST_NAME, LAST_NAME, EMAIL, DATE_OF_BIRTH, JOIN_DATE) 
             VALUES ('$fn', '$ln', '$em', '$dob', NOW());";

   if(!mysqli_query($connection, $query)) {
      echo("<p>Error adding customer data: " . mysqli_error($connection) . "</p>");
   }
}

/* Check whether the table exists and, if not, create it. */
function VerifyCustomersTable($connection, $dbName) {
  if(!TableExists("CUSTOMERS", $connection, $dbName)) {
     $query = "CREATE TABLE CUSTOMERS (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         FIRST_NAME VARCHAR(50),
         LAST_NAME VARCHAR(50),
         EMAIL VARCHAR(100),
         DATE_OF_BIRTH DATE,
         JOIN_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       )";

     if(!mysqli_query($connection, $query)) {
        echo("<p>Error creating table: " . mysqli_error($connection) . "</p>");
     }
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>

