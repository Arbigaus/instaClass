<!DOCTYPE html>
<html>
<head>
        <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
        <title>Logar</title>
        <link href="<?= BASE; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= BASE; ?>/assets/css/font-awesome.css" rel="stylesheet">

        <script src="<?= BASE; ?>/assets/js/jquery.js"></script>
        <script src="<?= BASE; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?= BASE; ?>/assets/js/ajax.js"></script>
</head>
<body>


<div class="col-md-3 col-md-offset-4 box">
  <form method="POST">
    <fieldset>
      <legend>Login</legend>

      <div class="form-group">
        <input type="email" name="user_email" placeholder="Digite seu email" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="user_pass" placeholder="Digite sua senha" class="form-control"></input>
      </div>
    </fieldset>

    <div class="form-group"><button class="btn btn-primary form-control" type="submit"> Entrar </button></div>

  </form>
</div>


</body>
</html>