<?php
    function confirmQuery($result){
        global $conn;
        if(!$result){
            die("Query FAILED ." . mysqli_error($conn));
        }
    }
    
    function insert_categories()
    {
        global $conn;
        if(isset($_POST['submit']))
        {
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title))
            {
                echo "This field shouldn't be empty";
            } else
            {
                $query ="insert into categories(cat_title) value('$cat_title')";

                $create_category = mysqli_query($conn, $query);
                if(!$create_category){
                    die('QUERY Failed' . mysqli_error($conn));
            } 
        }
    }
    }
    

    function findAllCategories(){
        global $conn;
       $query = "SELECT * FROM categories";
       $select_categories = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($select_categories))
        {
           $cat_id = $row['cat_id']; 
            $cat_title = $row['cat_title']; 
           echo "<tr>";
               echo "<td>{$cat_id}</td>";
               echo "<td>{$cat_title}</td>";
               echo "<td><a href='categories.php?edit={$cat_id}'><i class='glyphicon glyphicon-pencil'></i></a></td>";

               echo "<td><a href='categories.php?delete={$cat_id}'><i class='glyphicon glyphicon-trash'></i></a></td>";
           echo "</tr>";
        }
    }

   function deleteCategories(){
       global $conn;
       if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location: categories.php");
    }
   }
?>