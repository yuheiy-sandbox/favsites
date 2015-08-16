<?php

session_start();
$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;
session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Favorite Web Sites.</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <header class="jumbotron">
      <div class="container">
        <h1>My Favorite Web Sites.</h1>
      </div>
    </header>

    <div class="container">
      <form action="regist.php" method="post">
        <div class="form-group">
          <label for="url">URL</label>
          <input class="form-control" id="url" type="url" name="url" placeholder="URL" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
        </div>

<?php if ($status === 'done'): ?>
        <p class="text-success">success !</p>
<?php elseif ($status === 'fail'): ?>
        <p class="text-danger">failure !</p>
<?php endif; ?>
        <button class="btn btn-primary" type="submit" name="send">Submit</button>
      </form>

      <hr>
      <footer>
        <p class="text-center">© 2015 <a href="/">Yuhei Yasuda</a> All Rights Resered.</p>
      </footer>
    </div>
  </body>
</html>
