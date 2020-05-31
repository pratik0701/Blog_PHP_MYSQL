<?php include('includes/header.php'); ?>            

<?php 
    
        $id = $_GET['id'];
        $db = new Database();
        
        $query = "SELECT * FROM categories WHERE id=".$id;
        $categories = $db->select($query)->fetch_assoc();
    
    
?>

<?php 

    
    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($db->link,$_POST['name']);
        
        //Simple Validation
        if($name==''){
            //Set error
            $error = "Please fill out all the fields";
        }
        else{
            $query = "UPDATE categories
                        SET name = '$name'
                        WHERE id=".$id;
            $update_row = $db->update($query);
        }
           
    }
?>


<?php 
    if(isset($_POST['delete'])){
        $query = "DELETE FROM categories WHERE id=".$id;
        $delete_row = $db->delete($query);
    }

?>



<form role="form" method="post" action="edit_category.php?id=<?php echo $id; ?>"> 
  <div class="form-group">
    <label>Category Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter Category" value="<?php echo $categories['name']; ?>">
  </div>
  <a href="index.php" class="btn btn-default">Cancel</a>
  <input name="submit" type="submit" class="btn btn-default" value="Submit">
    <input name="delete" type="submit" class="btn btn-danger" value="Delete">
</form>

<?php include('includes/footer.php'); ?>            