<?php include('includes/header.php'); ?>            

<?php 

    $db = new Database();
    
    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $body = mysqli_real_escape_string($db->link,$_POST['body']);
        $category = mysqli_real_escape_string($db->link,$_POST['category']);
        $author = mysqli_real_escape_string($db->link,$_POST['author']);
        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
        
        //Simple Validation
        if($title=='' || $body=='' || $category=='' || $author==''){
            //Set error
            $error = "Please fill out all the fields";
        }
        else{
            $query = "INSERT INTO posts
                        (title,body,category,author,tags) 
                        VALUES('$title','$body','$category','$author','$tags')";
            $insert_row = $db->insert($query);
        }
           
    } 
?>

<?php 
        $query = "SELECT * FROM categories";
        $categories = $db->select($query);
?>



<form method="post" action="add_post.php"> 
  <div class="form-group">
    <label>Post Title</label>
    <input type="text" class="form-control" placeholder="Enter title" name="title">
  </div>
  
   <div class="form-group">
    <label>Post Body</label>
    <textarea name="body" class="form-control" placeholder="Enter post body"></textarea>
  </div>
    
  <div class="form-group">
    <label>Category Select </label>
      <select name="category" class="form-control">
        <?php while($row = $categories->fetch_assoc()): ?>
          <?php if($row['id']==$posts['category']){
                $selected = 'selected';        
                
            }else{
                $selected = '';
            }
          
          ?>
            
          <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
        <?php endwhile; ?>
      </select>
  </div>
    
  <div class="form-group">
    <label>Post Author</label>
    <input type="text" class="form-control" placeholder="Enter author" name="author">
  </div>
    
    <div class="form-group">
    <label>Tags</label>
    <input type="text" class="form-control" placeholder="Enter tags" name="tags">
  </div>
    <div>
  <input name="submit" type="submit" class="btn btn-default" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
    <br> <br> 
    </div>
</form>


<?php include('includes/footer.php'); ?>            