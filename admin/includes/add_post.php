<?php
if(isset($_POST['create_post'])){
     $post_category_id = $_POST['post_category'];
     $post_title = $_POST['post_title'];
     $post_author = $_POST['post_author'];
     $post_date = date('d-m-y');
    
     $post_image = $_FILES['image']['name'];
     $post_image_temp = $_FILES['image']['tmp_name'];
    
     $post_content = $_POST['post_content'];
     $post_tag = $_POST['post_tag'];
     $post_comment_count = 4;
     $post_status = $_POST['post_status'];
    
     
     
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
   $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_comment_count,  post_status)";
   $query .="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tag}','{$post_comment_count}','{$post_status}')";
   $create_post_query = mysqli_query($conn, $query);
    confirmQuery($create_post_query);
}

?>
   

   
   <form action="" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
        <select class="form-control" name="post_category" id="">
            <?php 
               $query = "SELECT * FROM categories";
               $select_categories = mysqli_query($conn, $query);
               confirmQuery($select_categories);
               while($row = mysqli_fetch_assoc($select_categories))
                {
                    $cat_id = $row['cat_id']; 
                    $cat_title = $row['cat_title']; 
                    
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    
    
    <div class="form-group">
        <label for="post_image">Post image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input type="text" class="form-control" name="post_tag">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    
    
    
    <div class="form-group">
        
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
    
</form>