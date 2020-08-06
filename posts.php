<?php include 'includes/header.inc.php' ?>
<?php
// create query
$sql = 'SELECT *
        FROM posts';

if (isset($_GET['category'])) {
  $categoryId = urldecode($_GET['category']);

  // append to query
  $sql .= ' WHERE category = ' . $categoryId;
}

// run the query
$posts = $db->select($sql);
?>

</div>
<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>

      <?php if ($posts) : ?>
        <?php while ($row = $posts->fetch_assoc()) : ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?= $row['title'] ?></h2>
            <p class="blog-post-meta"><?= formatDate($row['date']) ?> by <a href="#"><?= $row['author'] ?></a></p>

            <p><?= shortenText($row['body']) ?></p>

            <a class="readmore" href="post.php?id=<?= urlencode($row['id']) ?>">Read more</a>
          </div><!-- /.blog-post -->

        <?php endwhile; ?>

      <?php else : ?>
        <p>There are no posts yet</p>
      <?php endif; ?>

      <?php include 'includes/footer.inc.php' ?>