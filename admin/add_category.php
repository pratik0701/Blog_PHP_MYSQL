<?php include('includes/header.php'); ?>            

<?php 
    $db = new Database();

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
        
        if($name == ''){
            $error = 'Please fill the details';
        }
        else{
            $query = "INSERT INTO categories (name) VALUES ('$name')";
            $update_row = $db->update($query);
        }
    }

?>



<form role="form" method="post" action="add_category.php"> 
  <div class="form-group">
    <label>Category Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter Category">
  </div>
  
  <input name="submit" type="submit" class="btn btn-default" value="Submit">
</form>

<?php include('includes/footer.php'); ?>             