<?php include 'includes/header.inc.php' ?>

<?php
// Process the form
if (isset($_POST['submit'])) {

    // Sanitize form fields and assign them to variables
    $message = '';
    $title = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING) ?? null;
    $author = filter_input(INPUT_POST, 'post_author', FILTER_SANITIZE_STRING) ?? null;
    $tags = filter_input(INPUT_POST, 'post_tags', FILTER_SANITIZE_STRING) ?? null;
    $body = filter_input(INPUT_POST, 'post_body', FILTER_SANITIZE_STRING) ?? null;
    $categoryId = $_POST['post_category'] ?? null;

    // crude validation to check all fields have been completed
    if (
        !isset($title) ||
        empty($title) ||
        !isset($author) ||
        empty($author) ||
        !isset($body) ||
        empty($body) ||
        !isset($categoryId)
    ) {
        // if something missing, include a message and bail out
        $message = 'Please complete the entire form.';
        header("Location: add_post.php?msg=" . urlencode($message));
        exit();
    }


    // create insert query
    $sql = "INSERT INTO posts (
                category, title, body, author, tags, `date`)
            VALUES ('$categoryId', '$title', '$body', '$author', '$tags', NOW() )";

    // run the query
    $insertedRecord = $db->insert($sql);
}

// categories query for the select input field
$sql = 'SELECT id, `name`
        FROM categories
        ORDER BY `name` ASC';

//run categories query
$categories = $db->select($sql);
?>

<form action="add_post.php" method="post">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Add a title for this post.">
    </div>
    <div class="form-group">
        <label>Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author" placeholder="Add an author for this post.">
    </div>
    <div class="form-group">
        <label>Tags</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags" placeholder="Add a list of comma-separated tags for this post.">
    </div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" id="post_category" name="post_category">
            <option value="" disabled selected>Select a category...</option>
            <?php while ($category = $categories->fetch_assoc()) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Post Body</label>
        <textarea class="form-control" id="post_body" name="post_body" rows="3" placeholder="Add the post body"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>&nbsp;&nbsp;
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>
<br>
<?php include 'includes/footer.inc.php' ?>