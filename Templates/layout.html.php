<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
          <link rel="stylesheet" href="/app.css">
    <title><?= $title?></title>
  </head>
  <body>
    <nav>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/joke/list">Jokes List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/joke/edit">Add a joke</a>
        </li>
        <?php if($loggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="/logout">Log Out</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/login">Log In </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <header>
      <h1 class="display-5">Internet joke database</h1>
    </header>
    <main>
      <?=  $output ?>
    </main>
    <footer>&copy;IJDB 2021</footer>
  </body>
</html>
