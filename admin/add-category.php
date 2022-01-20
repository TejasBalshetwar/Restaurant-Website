<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //we need to reset session variable so that the message is dislayed only once
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //we need to reset session variable so that the message is dislayed only once
        }
        ?><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name='title' placeholder="Enter Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name='featured' value='Yes'>Yes
                        <input type="radio" name='featured' value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name='active' value='Yes'>Yes
                        <input type="radio" name='active' value='No'>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>
<?php include('partials/footer.php') ?>
<?php
//check if submit is click or not
if (isset($_POST['submit'])) {
    // get values from form
    $title = $_POST['title'];

    // for radio input type we need to check of button is selected or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }
    // check whether image is selectedd or not and set the value for image accordingly

    // print_r($_FILES['image']);
    // die();

    if (isset($_FILES['image']['name'])) {
        //upload image
        // to upload image we need image name, source path and destination path
        $image_name = $_FILES['image']['name'];
        // upload image name only if it is selected

        if ($image_name != "") {
            // auto rename image

            // get the extension of image
            $ext = end(explode('.', $image_name));

            // rename image
            $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
            //upload image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check if image is uploaded is uploaded or not
            // if image is not uploaded then we will stop the process and redirect with error message
            if ($upload == FALSE) {
                $_SESSION['upload'] = "<div class='error text-center'>Image Upload Unsuccessful</div> ";
                header("location:" . SITEURL . "admin/add-category.php");
                // stop the process 
                die();
            }
        }
    } else {
        // dont upload image and set image_name value as blank
        $image_name = "";
    }
    // sql query to insert into category

    $sql = "INSERT INTO tbl_category (title,image_name,featured,active) VALUES ('$title','$image_name','$featured','$active')";

    // execute query


    $res = mysqli_query($conn, $sql);

    //check if query executed or not
    if ($res == TRUE) {
        // echo 'done';
        // query executed category added
        $_SESSION['add'] = "<div class='success'> Category Added Successfully</div> ";
        //redirect to manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        // echo 'not done';
        // failed to add category
        $_SESSION['add'] = "<div class='error'>Failed to Add Category</div> ";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
}
?>