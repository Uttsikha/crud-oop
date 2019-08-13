<?php
include_once 'databse.php';
include_once 'animals.php';
include_once 'Categories.php';?>
<style><?php include 'index_css.css'; ?></style>
<?php
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$animal = new Animal($db);
$category= new Categories($db);
$category1= new Categories($db);
 
// query products
$stmt = $animal->readAll();
$num = $stmt->rowCount();
$stmt1=$category->readAll();
$num1 = $stmt1->rowCount();
$stmt3=$animal->agg();

echo "<div class='right-button-margin'>
    <a href='create_animal.php' class='btn'>Create Animal</a>
</div>

";


if($num>0){
 echo "<table class='table' border=1>
 		<caption>Animals Details</caption>
        
 ";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Color</th>";
            echo "<th>Weight</th>";
            echo "<th>Category</th>";
            echo "<th>Actions</th>";

          
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$color}</td>";
                echo "<td>{$weight}</td>";
                $category1->id=$category;
                $category1->readName();
                echo "<td>{$category1->name}</td>";
                echo "<td>";
					    echo "<a href='readone.php?id={$id}' class='btn '>
					     Read
					</a>
					 
					<a href='update_product.php?id={$id}' class='btn'>
					    Edit
					</a>
					 
					<a href='delete_product.php?id={$id}' class='btn'>
					     Delete
					</a>";
                echo "</td>";
 
            echo "</tr>";
            }
            $result = $stmt3->fetch(PDO::FETCH_ASSOC);
              echo"<tr>

              <td colspan='2'>Aggregate Weight</td>

              <td>";
              echo $result['wt'];

              echo"</td>

            </tr>";
        
 
    echo "</table><hr>";
    }
 
// tell the user there are no products
else{
    echo "<div class='alert'>No animals found.</div>";
}
if($num1>0){
 echo "<table class='table' border=1>
 		<caption>Categories Details</caption>
        
 ";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
             	echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>";
					    echo "<a href='readcategory.php?id={$id}' class='btn'>
					    Read
					</a>";
					 
					
                echo "</td>";
            echo "</tr>";
 			
        }
 
    echo "</table>";
    }
 
// tell the user there are no products
else{
    echo "<div class='alert '>No animals found.</div>";
}
?>