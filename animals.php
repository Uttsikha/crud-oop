<?php
class Animal{
 
    // database connection and table name
    private $conn;
    private $table_name = "animals";
 
    // object properties
    public $id;
    public $name;
    public $color;
    public $weight;
    public $category;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
 // create product
    function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, color=:color, weight=:weight, category=:category";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->color=htmlspecialchars(strip_tags($this->color));
        $this->weight=htmlspecialchars(strip_tags($this->weight));
        $this->category=htmlspecialchars(strip_tags($this->category));
        
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":weight", $this->weight);
        $stmt->bindParam(":category", $this->category);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    function readAll(){
 
    $query = "SELECT
                id, name, color, weight, category
            FROM
                " . $this->table_name . "
            ORDER BY
                name ASC
           ";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
function readOne(){
 
    $query = "SELECT
                 name, color, weight, category
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->name = $row['name'];
    $this->color = $row['color'];
    $this->weight = $row['weight'];
    $this->category = $row['category'];
   
}
function agg(){
      $query = "SELECT AVG(weight) AS wt
                
            FROM
                " . $this->table_name . "
            
           ";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;

}
function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                color= :color,
                weight = :weight
            WHERE
                id = :id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->color=htmlspecialchars(strip_tags($this->color));
    $this->weight=htmlspecialchars(strip_tags($this->weight));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind parameters
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':color', $this->color);
    $stmt->bindParam(':weight', $this->weight);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// delete the product
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function countCat(){

   $query = " SELECT COUNT(id), category FROM " . $this->table_name . " GROUP BY category";
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    return $stmt;

}
}
?>