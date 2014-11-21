<?php
$hostname = 'mysql';
$username = 'root';
$password = 'password';
$database = 'demoDb';
$table = 'demoTable';

$results = [];
try {
    $handler = new PDO("mysql:host={$hostname}", $username, $password);
    $query = $handler->prepare("create database {$database}");
    $query->execute();
    $query = $handler->prepare("use {$database}");
    $query->execute();
    $query = $handler->prepare("create table ${database}(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, time INT)");
    $query->execute();
    $time = (int)microtime(true);
    $query = $handler->prepare("insert into {$database} (time) values ({$time})");
    $query->execute();
    $query = $handler->prepare("select * from ${database}");
    $query->execute();
    $results = $query->fetchAll();
} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage() . "<br/>";
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8" />
</head>
<body>
  <table border=1>
    <thead>
      <tr>
        <td>
          ID
        </td>
        <td>
          TIME
        </td>
      </tr>
    </thead>
    <tbody>
<?php
foreach ($results as $result) {
    ?>
      <tr>
        <td>
<?php echo $result['id']; ?>
        </td>
        <td>
<?php echo date('d-m-Y G:i:s', $result['time']); ?>
        </td>
      </tr>
    <?php
}
?>
    </tbody>
  </table>
</body>
</html>
