<div class="container-fluid">
<h2>Client List</h2>

<div class="col-md-4 col-md-offset-4 alert ">
	<div class="result"></div>
</div>

	<div class="col-md-6 col-md-offset-3">
		<table class="table table-stripped table-bordered">
			<thead>
				<th>Id</th>
				<th>Nome</th>
				<th>Sexo</th>
			</thead>
			<tbody>
			  <?php if(!empty($lista)): ?>
          <?php foreach ($lista as $clients): ?>
            <?php extract($clients); ?>
            <tr>
              <td><?php echo $id_client; ?></td>
              <td><?php echo $client_name; ?></td>
              <td><?php echo $client_genre; ?></td>
            </tr>
          <?php endforeach; ?>
			  <?php endif; ?>
			</tbody>
      <tfoot>
        <tr>
          <td colspan="3">
            <?php foreach($links as $l): ?>
              <?php echo $l; ?>
            <?php endforeach; ?>
          </td>
        </tr>
      </tfoot>
		</table>

	</div>
</div>
