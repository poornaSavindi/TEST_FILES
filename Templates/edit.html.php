<html>
    <head>
    </head>
    <body>
<!--anyone else cant access the jokes, unless you are logged in-->
        <form action="/joke/edit" method="post">
          <input type="hidden" name="joke[id]"value="<?=$joke['id'] ?? '';?>">
          <div id='textarea'class="form-floating">
            <textarea class="form-control" required='required' id="floatingTextarea" name='joke[joketext]'>
                                    <?=$joke['joketext'] ?? ''?></textarea>
            <label for="floatingTextarea">Insert your joke here.. :</label>
            <input type="submit" class="btn btn-primary" id='submit-button' value="Save">
          </div>

        </form>
    </body>
</html>
