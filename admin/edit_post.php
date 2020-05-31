<?php include('includes/header.php'); ?>            

<?php 
    
        $id = $_GET['id'];
        $db = new Database();
        $query = "SELECT * FROM posts
            WHERE id=".$id;
        $posts = $db->select($query)->fetch_assoc();
        
        $query = "SELECT * FROM categories";
        $categories = $db->select($query);
    
    
?>

<?php 

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
            $query = "UPDATE posts 
                        SET title = '$title',
                        body = '$body',
                        category = '$category',
                        author = '$author',
                        tags = '$tags' 
                        WHERE id=".$id;
            $update_row = $db->update($query);
        }
           
    }
?>

<?php 
    if(isset($_POST['delete'])){
        $query = "DELETE FROM posts WHERE id=".$id;
        $delete_row = $db->delete($query);
    }

?>

<form method="post" action="edit_post.php?id=<?php echo $id; ?>"> 
    
    
    
  <div class="form-group">
    <label>Post Title</label>
    <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo $posts['title']; ?>">
  </div>
  
   <div class="form-group">
    <label>Post Body</label>
    <textarea name="body" class="form-control" placeholder="Enter post body" ><?php echo $posts['body']; ?></textarea>
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
            
          <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?> > <?php echo $row['name']; ?></option>
        <?php endwhile; ?>
      </select>
  </div>
    
  <div class="form-group">
    <label>Post Author</label>
    <input type="text" class="form-control" placeholder="Enter author" name="author" value="<?php echo $posts['author']; ?>"> 
  </div>
    
    <div class="form-group">
    <label>Tags</label>
    <input type="text" class="form-control" placeholder="Enter tags" name="tags" value ="<?php echo $posts['tags']; ?>" >
  </div>
    <div>
  
    <a href="index.php" class="btn btn-default">Cancel</a>
    <input name="submit" type="submit" class="btn btn-default" value="Submit">
        <input name="delete" type="submit" class="btn btn-danger" value="Delete">
    <br> <br> 
    </div>
    
</form>


<?php include('includes/footer.php'); ?>            