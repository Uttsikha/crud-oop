<?php // get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'databse.php';
include_once 'Categories.php';
include_once 'animals.php';
?>
<style><?php include 'index_css.css'; ?></style>
<?php
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$categories = new Categories($db);
$animal = new Animal($db);

// set ID property of product to be read
$categories->id = $id;
$stmt=$animal->countCat();
// read the details of product to be read
$categories->readOne();
	
echo "<table class='table' border=1>";
 
     echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>{$categories->id}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$categories->name}</td>";
    echo "</tr>";
 
echo "</table>";
echo "<table class='table' border=1>";
 
     echo "<tr>";
        echo "<th>Category ID</th>";
        echo "<th>Number of animals</th>";
    echo "</tr>";
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

 
            extract($row);
            $categories->id=$category;
            $categories->readName(); 
            echo "<tr>";
                echo "<td>{$categories->name}</td>";
                 echo "<td>{$row['COUNT(id)']}</td>";
            echo "</tr>";


            }
    echo "</table>";
?>