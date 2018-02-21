<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Connection</title>
  </head>
  <body>
    <center></br></br>
      <h2> Connection </h2></br>
    <form method ="post" action ="">
      <table>
        <tr>
          <td><label for="email">Email : </label></td>
          <td><input type="email" name="email" value="" pattern="^[@_A-z0-9.]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="password">Mot de passe : </label></td>
          <td><input type="password" name="password" value="" required></td>
        </tr>
        <tr>
          <td>
            <button type="reset" class="btn btn-warning" name="reset">Réinitialiser</button></td>
          <td><button type="submit" class="btn btn-primary" name="validerconnect">Se Connecter</button></td>
        </tr>
      </table>
  </center></body>
</html>
