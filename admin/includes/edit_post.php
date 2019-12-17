<?php
     if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
     }
     $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
     $select_posts_by_id = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($select_posts_by_id))
     {
         $post_id = $row['post_id'];
         $post_category_id = $row['post_category_id'];
         $post_title = $row['post_title'];
         $post_author = $row['post_author'];
         $post_date = $row['post_date'];
         $post_image = $row['post_image'];
         $post_content = $row['post_content'];
         $post_tag = $row['post_tag'];
         $post_comment_count = $row['post_comment_count'];
         $post_status = $row['post_status'];
         
         if(isset($_POST['update_post'])){
             $post_category_id = $_POST['post_category'];
             $post_title = $_POST['post_title'];
             $post_author = $_POST['post_author'];

             $post_image = $_FILES['image']['name'];
             $post_image_temp = $_FILES['image']['tmp_name'];

             $post_content = $_POST['post_content'];
             $post_tag = $_POST['post_tag'];
             $post_status = $_POST['post_status'];
             
             move_uploaded_file($post_image_temp, "../images/$post_image");
             if(empty($post_image)) 
             {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_image = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($select_image)) {
                    $post_image = $row['post_image'];

                }
             }
             
             $query = "UPDATE posts SET ";
             $query .= "post_category_id = '{$post_category_id}', ";
             $query .= "post_title = '{$post_title}', ";
             $query .= "post_author = '{$post_author}', ";
             $query .= "post_date = now(), ";
             $query .= "post_image = '{$post_image}', ";
             $query .= "post_content = '{$post_content}', ";
             $query .= "post_tag = '{$post_tag}', ";
             $query .= "post_status = '{$post_status}' ";
             $query .= "WHERE post_id = '{$the_post_id}' ";
             
             $update_query = mysqli_query($conn, $query);
             confirmQuery($update_query);
         }
         
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
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input  type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input value="<?php echo $post_tag; ?>" type="text" class="form-control" name="post_tag">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?>
             
        </textarea>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    
    
    
    <div class="form-group">
        
        <input type="submit" class="btn btn-primary" name="update_post" value="Update">
    </div>
    
</form> 
