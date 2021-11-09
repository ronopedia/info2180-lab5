<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

filter_var($_GET['country'], FILTER_SANITIZE_STRING);
$country= $_GET['country'];

if(isset($country)==true && isset($_GET['context'])==false){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table>
  <tr>
    <th>Name</th>
    <th>Continent</th>
    <th>Independence</th>
    <th>Head of State</th>
  </tr>";
  foreach ($results as $row){
  echo "<tr>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['continent']."</td>";
  echo "<td>".$row['independence_year']."</td>";
  echo "<td>".$row['head_of_state']."</td>";
  echo "</tr>";
  }
  // endforeach
  echo "</table>";
}
elseif(isset($country)==true && isset($_GET['context'])==true){
  $stmt = $conn->query("SELECT cities.name, cities.district,cities.population FROM countries INNER JOIN cities ON countries.code = cities.country_code WHERE countries.name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table>
  <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </tr>";
  foreach ($results as $row){
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['district']."</td>";
    echo "<td>".$row['population']."</td>";
    echo "</tr>";
    }
  // endforeach;
  echo "</table>";

}
else{
  echo 'ERROR!!!';
}
?>


