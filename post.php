<?php include 'includes/header.inc.php' ?>
<?php

if (isset($_GET['id'])) {
  $postId = urldecode($_GET['id']);

  // create query
  $sql = 'SELECT *
          FROM posts
          WHERE id = ' . $postId;

  // run query
  $post = $db->select($sql)->fetch_assoc();
} else {
  die('Error: Oops no post id passed.');
}

?>
</div>
<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">

      <div class="blog-post">
        <h2 class="blog-post-title"><?= $post['title'] ?></h2>
        <p class="blog-post-meta"><?= formatDate($post['date']) ?> by <a href="#"><?= $post['author'] ?></a></p>

        <p><?= $post['body'] ?></p>

      </div><!-- /.blog-post -->


      <?php include 'includes/footer.inc.php' ?>