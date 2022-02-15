<?php
$connection = require_once "./Connection.php";
$notes = $connection->getNotes();

$currentNote = ['id' => '', 'title' => '', 'description' => ''];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id'])[0];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PHP personal notes application">
    <meta name="author" content="Javad Khaleghi">

    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/pricing/pricing.css" rel="stylesheet">

    <title>Personal Notes</title>
</head>

<body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Personal Notes</h1>
    </div>

    <div class="container-fluid">
        <div class="card mb-3">
            <form action="save.php" method="POST">
                <input type="hidden" name="id" value="<?= $currentNote['id'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?= $currentNote['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="description"><?= str_replace('<br />', '', $currentNote['description']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.replace('index.php')">Cancel</button>
                    <button type="submit" class="btn btn-primary">New note</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>

        <div class="container">
            <?php foreach ($notes as $note) : ?>
                <div class="card mb-3 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"><?= $note['title'] ?></h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li class="mb-3"><?= $note['description'] ?></li>
                            <li>[@ <?= $note['create_date'] ?>]</li>
                        </ul>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="editButton" data-toggle="modal" data-target="#editModal" onclick="window.location.href='index.php?id=<?= $note['id'] ?>';">Edit</button>

                        <form action="delete.php" method="POST" style="display: inline-block" onsubmit="return confirm('Do you really want to delete this note?');">
                            <input type="hidden" name="id" value="<?= $note['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">Personal Notes [PHP Mini-project <?= date('Y') ?>]</small>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>