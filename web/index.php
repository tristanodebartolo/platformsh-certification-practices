<?php

declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';

try {

    // Connect to the database.
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s', getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_PATH"));

    $conn = new \PDO($dsn, getenv("DB_USER"), "", [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE,
        \PDO::MYSQL_ATTR_FOUND_ROWS => TRUE,
    ]);

    // Creating a table.
    $sql = "CREATE TABLE People (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(30) NOT NULL,
      city VARCHAR(30) NOT NULL
      )";
    $conn->query($sql);

    // Insert data.
    $sql = "INSERT INTO People (name, city) VALUES
        ('Neil Armstrong', 'Moon'),
        ('Buzz Aldrin', 'Glen Ridge'),
        ('Sally Ride', 'La Jolla');";
    $conn->query($sql);

    // Show table.
    $sql = "SELECT * FROM People";
    $result = $conn->query($sql);
    $result->setFetchMode(\PDO::FETCH_OBJ);

    if ($result) {
        print <<<TABLE
<table>
<thead>
<tr><th>Name</th><th>City</th></tr>
</thead>
<tbody>
TABLE;
        foreach ($result as $record) {
            printf("<tr><td>%s</td><td>%s</td></tr>\n", $record->name, $record->city);
        }
        print "</tbody>\n</table>\n";
    }

    // Drop table
    $sql = "DROP TABLE People";
    $conn->query($sql);

} catch (\Exception $e) {
    print $e->getMessage();
}
