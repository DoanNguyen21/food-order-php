<?php 
  //include constants file
  include('../config/constants.php');

//    echo "Delete Page";
     //check whether id and image_name value is set or not
     if(isset($_GET['id']) AND isset($_GET['image_name']))
     {
        //get to the value and delete
        // echo "Get value and delete";
        //1. get id and image_name of category to delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is available
        if($image_name != "")
        {
            //image is available. so remove it
            $path = "../images/category/".$image_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

          //delete data from database

          //2. create the query to delete
          $sql = "DELETE FROM tbl_category WHERE id = $id"; 

          //3. Execute the query
        $res = mysqli_query($conn, $sql);

        
        //4. check whether the query was successful or not
        if($res==TRUE)
        {
         //set success message and redirect
         $_SESSION['delete'] = "<div class='success'>Category Delete Successfully.</div>";
         header('location:'.SITEURL.'admin/manage-category.php');
            
        }else{
       //Failed to Delete Admin 
        $_SESSION['delete'] = "<div class='error'>Failed Category Delete .</div>";
         header('location:'.SITEURL.'admin/manage-category.php');
        }


          //redirect to manage category page with message       
     }
     else{
        //redirect to message category page
        header('location:'.SITEURL.'admin/manage-category.php');
     }
?>