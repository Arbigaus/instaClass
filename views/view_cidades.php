<div class="container-fluid">

  <div class="col-md-4 col-md-offset-4 alert">
    <div class="result"></div>
  </div>

  <div class="row"></div>
  <div class="col-md-6 col-md-offset-4">
    <form method="post" class="form-inline" id="cidades/addCidades">

      <div class="form-group">
        <select name="client_state" class="form-control estado" id="cidades/buscaCidades">
          <option value="" selected="">Selecione o Estado</option>
          <?php if(!empty($lista_estados)): ?>
            <?php foreach ($lista_estados as $Estados): ?>
              <?php extract($Estados); ?>
              <option value="<?php echo $cod_estados; ?>"><?php echo $nome; ?></option>
          <?php endforeach;endif; ?>
        </select>
      </div>

      <div class="form-group">
        <select name="client_city" id="" class="form-control cidade">
          <option value="" selected="">Selecione o estado antes...</option>
        </select>
      </div>

      <div class="row"></div>
      <br>
      <div class="form-group">
        <button class="btn btn-success">
          <i class="fa "></i>Enviar
        </button>
      </div>

    </form>

  </div>


</div>
