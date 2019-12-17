 <form action="" method="post">
    <?php
         if(isset($_GET['edit'])){
               $cat_id = $_GET['edit'];
               $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
               $select_categories_id = mysqli_query($conn, $query);
               while($row = mysqli_fetch_assoc($select_categories_id))
                {
                   $cat_id = $row['cat_id']; 
                    $cat_title = $row['cat_title']; 
                   ?>
                   <div class="form-group">
                       <label for="cat-title">Edit Category</label>
                       <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
                   </div>
              <?php }
         }

    ?>

    <?php    //update Query
        if(isset($_POST['update_category'])){
                $the_cat_title = $_POST['cat_title'];
                $query = "UPDATE  categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
                $update_query = mysqli_query($conn, $query);
                if(!$update_query){
                    die("QUERY FAILED" . mysqli_error);
                }
            }

    ?>


    <div class="form-group">
        <input type="submit" name="update_category" value="Update Category" class="btn btn-success">
    </div>
</form>