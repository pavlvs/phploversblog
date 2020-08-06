<?php
// create categories query
$sql = 'SELECT * FROM categories';
// run the query
$categories = $db->select($sql);
?>
</div><!-- /.blog-main -->

<aside class="col-md-4 blog-sidebar">
  <div class="p-4 mb-3 bg-light rounded">
    <h4 class="font-italic">About</h4>
    <p class="mb-0"><?= $siteDescription ?></p>
  </div>
  <?php if ($categories) : ?>
    <div class="p-4">
      <h4 class="font-italic">Categories</h4>
      <ol class="list-unstyled mb-0">
        <?php while ($row = $categories->fetch_assoc()) : ?>
          <li><a href="posts.php?category=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
        <?php endwhile; ?>
      </ol>
    </div>
  <?php else : ?>
    <p>There are no categories yet.</p>
  <?php endif; ?>

</aside><!-- /.blog-sidebar -->

</div><!-- /.row -->
</main><!-- /.container -->

<footer class="blog-footer">
  <p>PHPLoversBlog &copy; 2020</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
  assets / js / bootstrap.min.js
</script>
</body>

</html>