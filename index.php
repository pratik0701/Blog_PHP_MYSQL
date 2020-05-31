<?php include('include/header.php'); ?>

<?php 
    //Create db object
    $db = new Database();

    $query = "SELECT * FROM `posts`";
    $posts = $db->select($query);

    $query = "SELECT * FROM `categories`";
    $categories = $db->select($query);


?>

<?php if($posts): ?>

<?php while($row = $posts->fetch_assoc()): ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
            <p class="blog-post-meta"><?php echo formatDate($row['date']);  ?> by <a href="https://medium.com/@pratik0701ahu"><?php echo $row['author']; ?></a></p>

            <p><?php echo shortenText($row['body']); ?></p>
              
                <a class="readmore" href="post.php?id=<?php echo $row['id']; ?>">Read more...</a>
              
          </div><!-- /.blog-post -->

<?php endwhile; ?>

<?php else: ?>
    <p><u>There are no posts to show yet</u></p>

<?php endif; ?>
          
<?php include('include/footer.php'); ?>