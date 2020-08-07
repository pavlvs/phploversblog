<?php include 'includes/header.inc.php' ?>
<?php
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
} elseif (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
} else {
    $categoryId = '';
}
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
        $message = 'Please enter a name for the category.';
        header("Location: edit_category.php?msg=" . urlencode($message));
        exit();
    }
    // create update query
    $sql = "UPDATE categories
            SET `name` = '$category'
            WHERE id = $categoryId";

    // run the query
    $updatedRecord = $db->update($sql);
} elseif (isset($_POST['delete'])) { // delete the category
    // create delete query
    $sql = "DELETE FROM categories
            WHERE id = $categoryId";
    echo $sql;
    // run the query
    $db->delete($sql);
}
//create sql query to populate the form field(s)
$query = "SELECT *
            FROM categories
            WHERE id = $categoryId";

//run the query
$categories = $db->select($query)->fetch_assoc();
?>

<form action="edit_category.php" method="post">
    <input type="hidden" name="category_id" value="<?= $categoryId ?>">
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $categories['name'] ?>">
    </div>
    <div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>&nbsp;&nbsp;
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" name="delete" class="btn btn-secondary"><svg width=" 1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg></button>
    </div>
</form>

<br>
<?php include 'includes/footer.inc.php' ?>