<?php include 'includes/header.inc.php' ?>
<?php
//create query
$sql = 'SELECT p.id AS id,
                p.title AS title,
                c.name AS category,
                p.author AS author,
                p.date AS `date`
        FROM posts AS p
        INNER JOIN categories AS c
        ON p.category = c.id
        ORDER BY `date` DESC';

//run query
$posts = $db->select($sql)
?>
<?php if ($posts) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Post ID#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $posts->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td>
                        <a href="edit_post.php?id=<?= $row['id'] ?>"> <?= $row['title'] ?> </a> </td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['author'] ?></td>
                    <td><?= formatDate($row['date']) ?></td>
                </tr>
            <?php endwhile; ?>

        </tbody>
    </table>
<?php else : ?>
    <p>There are no posts yet.</p>
<?php endif; ?>

<?php
// categories query
$sql = 'SELECT * FROM categories ORDER BY `name`';

// run the query
$categories = $db->select($sql);
?>

<?php if ($categories) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Category ID#</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $categories->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="edit_category.php?id=<?= $row['id'] ?>"> <?= $row['name'] ?> </a> </td>
                </tr>
            <?php endwhile; ?>

        </tbody>
    </table>
<?php else : ?>
    <p>There are no posts yet.</p>
<?php endif; ?>
<?php include 'includes/footer.inc.php' ?>