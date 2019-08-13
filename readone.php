<?php // get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'databse.php';
include_once 'animals.php';
?>
<style><?php include 'index_css.css'; ?></style>
<?php
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$animal = new Animal($db);

// set ID property of product to be read
$animal->id = $id;
 
// read the details of product to be read
$animal->readOne();
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn '>";
        echo " Read Products";
    echo "</a>";
echo "</div>";	
echo "<table class='table' border=1>";
 
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$animal->name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Color</td>";
        echo "<td>{$animal->color}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Weight</td>";
        echo "<td>{$animal->weight}</td>";
    echo "</tr>";
      echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>{$animal->category}</td>";
    echo "</tr>";
 
 
echo "</table>";
?>