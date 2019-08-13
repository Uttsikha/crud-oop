<?php
include_once 'databse.php';
include_once 'animals.php';
include_once 'Categories.php';
?>
<style><?php include 'index_css.css'; ?></style>
<?php
	// get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	// pass connection to objects
	$animal = new Animal($db);
	$category= new categories($db);
	$nameErr="";

	echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn '>Read Products</a>";
echo "</div>";
 
?>
<?php 
// if the form was submitted - PHP OOP CRUD 
if($_POST){
 
    // set product property values

    if (empty($_POST['name'])) {
    $nameErr = "Name is required";
  } 
    // check if name only contains letters and whitespace
    elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) {
      $nameErr = "Only letters and white space allowed"; 
    }
    else{
    $animal->name = $_POST['name'];
    $animal->color = $_POST['color'];
    $animal->weight = $_POST['weight'];
    $animal->category=$_POST['category'];
    
    // create the product
    if($animal->create()){
        echo "<div class='alert'>Product was created.</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert'>Unable to create product.</div>";
    }
}
}
?><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table '>
 		<tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo $animal->name;?>"/></td> 
            <span class="alert">* <?php echo $nameErr;?></span>
        </tr>
 
        <tr>
            <td>Color</td>
            <td><input type='color' class= "color" name='color'  /></td>
        </tr>
 
        <tr>
            <td>Weight</td>
            <td><input type="number" name='weight'></td>
        </tr>
  		 <tr>
            <td>
            <?php
				// read the product categories from the database
				$stmt = $category->readAll();
				 
				// put them in a select drop-down
				echo "<select class='form-control' name='category'>";
				    echo "<option>Select category...</option>";
				 
				    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
				        extract($row_category);
				        echo "<option value='{$id}'>{$name}</option>";
				    }
				 
				echo "</select>";
				?>
				</td>
        </tr>
       
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn">Create</button>
            </td>
        </tr>
 
    </table>
</form>
