<?php
  if (isset($error)):
    echo '<div class="errors">' . $error . '</div>';
  endif;
?>
<form action="" method="post">
  <div class="mb-3">
    <label for="Email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="Email" name='email'>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="Password" name='password'>
  </div>
  <input type="submit" class="btn btn-primary" value='Log In'>
</form>
<p>Don't have an account? <a href="/author/register">Click here to register an account</a></p>
