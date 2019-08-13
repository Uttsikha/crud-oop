<?php
// check if value was posted
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
    // include database and object file
    include_once 'databse.php';
    include_once 'animals.php';?>
<style><?php include 'index_css.css'; ?></style>
<?php
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare product object
    $animal = new Animal($db);
     
    // set product id to be deleted
    $animal->id = $id;
     
    // delete the product
    if($animal->delete()){
        echo "Object was deleted.";
        echo "<a href='index.php' class='btn'>Go back</a>";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    
}
?>