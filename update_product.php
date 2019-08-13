<?php 

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

 
// include database and object files
include_once 'databse.php';
include_once 'animals.php';
include_once 'Categories.php';
?>
<style><?php include 'index_css.css'; ?></style>
<?php
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$animal = new Animal($db);
$category = new categories($db);
// set ID property of product to be edited
$animal->id = $id;

// read the details of product to be edited
$animal->readOne();


 if($_POST){
 
    // set product property values
    $animal->name = $_POST['name'];
    $animal->color = $_POST['color'];
    $animal->weight = $_POST['weight'];
    $animal->category=$_POST['category_id'];
    
    // update the product
    if($animal->update()){
        echo "<div class='alert'>";
            echo "Product was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert '>";
            echo "Unable to update product.";
        echo "</div>";
    }
}

    echo "<a href='index.php' class='btn'>Read Products</a>";

?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table '>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $animal->name; ?>'  /></td>
        </tr>
 
        <tr>
            <td>Color</td>
            <td><input type='color' class= "color" name='color' value='<?php echo $animal->color; ?>'  /></td>
        </tr>
 
        <tr>
            <td>Weight</td>
            <td><input type='number' name='weight' value='<?php echo $animal->weight; ?>'  /></td>
            
        </tr>
 		 <tr>
        
            	 <td>Category</td>
            	 <td>
            <?php
				// read the product categories from the database
				$stmt = $category->readAll();
				 

				echo "<select name='category_id'>";
			 
			    echo "<option>Please select...</option>";
			    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
			        $category_id=$row_category['id'];
			        $category_name = $row_category['name'];
			 
			        // current category of the product must be selected
			        if($animal->category==$category_id){
			            echo "<option value='$category_id' selected>";
			        }else{
			            echo "<option value='$category_id'>";
			        }
			 
			        echo "$category_name</option>";
			    }
			echo "</select>";
				?>
				</td>
        </tr>
   
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn ">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php


?>