<?php include 'includes/header.inc.php' ?>
<?php
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
} elseif (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
}
// Process the form
if (isset($_POST['submit'])) {

    // Sanitize form fields and assign them to variables
    $message = '';
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT) ?? null;
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
        header("Location: edit_post.php?msg=" . urlencode($message) . "&id=" . $postId);
        exit();
    }
    // create insert query
    $sql = "UPDATE posts
            SET category = '$categoryId',
                title = '$title',
                body ='$body',
                author = '$author',
                tags = '$tags'
            WHERE id = $postId";

    // run the query
    $insertedRecord = $db->update($sql);
} elseif (isset($_POST['delete'])) { // delete the category

    // create delete query
    $sql = "DELETE FROM posts
            WHERE id = $postId";
    echo $sql;
    // run the query
    $db->delete($sql);
}
// posts and categories query to populate form fields
$sql = "SELECT p.id AS id,
                p.title AS title,
                c.name AS category,
                c.id AS categoryId,
                p.author AS author,
                p.tags AS tags,
                p.body AS body,
                p.date AS `date`
        FROM posts AS p
        INNER JOIN categories AS c
        ON p.category = c.id
        WHERE p.id = $postId";

//run posts query
$posts = $db->select($sql)->fetch_assoc();

// categories query for the select input field
$sql = 'SELECT id, `name`
FROM categories
ORDER BY `name` ASC';

//run categories query
$categories = $db->select($sql);
?>

<form action="edit_post.php" method="post">
    <input type="hidden" name="post_id" value="<?= $postId ?>">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Add a title for this post." value="<?= $posts['title'] ?>">
    </div>
    <div class="form-group">
        <label>Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author" placeholder="Add an author for this post." value="<?= $posts['author'] ?>">
    </div>
    <div class="form-group">
        <label>Tags</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags" placeholder="Add a list of comma-separated tags for this post." value="<?= $posts['tags'] ?>">
    </div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" id="post_category" name="post_category">
            <?php while ($category = $categories->fetch_assoc()) : ?>
                <option value="<?= $posts['categoryId'] ?>" <?php if ($posts['categoryId'] == $category['id']) : ?> selected <?php endif; ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Post Body</label>
        <textarea class="form-control" id="post_body" name="post_body" rows="3"><?= $posts['body'] ?></textarea>
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