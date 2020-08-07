<?php include 'includes/header.inc.php' ?>

<?php
// Process the form
if (isset($_POST['submit'])) {

    // Sanitize form fields and assign them to variables
    $message = '';
    $category = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING) ?? null;

    // crude validation to check all fields have been completed
    if (
        !isset($category) ||
        empty($category)

    ) {
        // if something missing, include a message and bail out
        $message = 'Please enter a name for the category';
        header("Location: add_post.php?msg=" . urlencode($message));
        exit();
    }


    // create insert query
    $sql = "INSERT INTO categories (
                name)
            VALUES ('$category')";

    // run the query
    $insertedRecord = $db->insert($sql);
}
?>

<form action="add_category.php" method="post">
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Add a name for this category.">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>&nbsp;&nbsp;
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>
<br>
<?php include 'includes/footer.inc.php' ?>