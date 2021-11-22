<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php if (!empty($errors)) :?>
      <div class="errors">
        <p>Your account could not be created,
        please check the following:</p>
        <ul>
          <?php foreach ($errors as $error) :?>
          <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="/author/register" method = "post">
      <div class="mb-3">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="Email" name='author[authoremail]' value=<?= $author['authoremail'] ?? '' ?> >
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for={"Name" class="form-label">Name</label>
        <input type="text" class="form-control" id="Name" name='author[authorname]' value=<?= $author['authorname'] ?? '' ?>>
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control" id="Password" name='author[password]' value=<?= $author['password  '] ?? '' ?>>
      </div>
      <input type="submit" class="btn btn-primary" value='Register Account'>
    </form>
  </body>
</html>
