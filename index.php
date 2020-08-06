<?php include 'libraries/Database.php' ?>
<?php include 'helpers/format_helper.php' ?>
<?php include 'includes/header.inc.php' ?>
<?php
// Create DB object
$db = new Database();

// create query
$sql = 'SELECT * FROM posts';

// run the query
$posts = $db->select($sql);
?>

<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">Lots of PHP love</h1>
    <p class="lead my-3">PHP News, tutorials, videos & more...</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>
<div class="row mb-2">
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">World</strong>
        <h3 class="mb-0">Featured post</h3>
        <div class="mb-1 text-muted">Nov 12</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
        </svg>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">Design</strong>
        <h3 class="mb-0">Post title</h3>
        <div class="mb-1 text-muted">Nov 11</div>
        <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
        </svg>
      </div>
    </div>
  </div>
</div>
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