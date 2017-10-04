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
				<th>Ações</th>
			</thead>
			<tbody>
			<?php if(!empty($list_client)): ?>
				<?php foreach($list_client as $Clients): ?>
				<?php extract($Clients); ?>
				<tr>
					<td><?php echo $id_client; ?></td>
					<td><?php echo $client_name; ?></td>
					<td><?php echo $client_genre; ?></td>
					<td>
						<a class="btn btn-default" href="<?php echo BASE."/clients/edit/".$id_client; ?>"><em class="fa fa-edit"></em></a>
						<a class="btn btn-danger remover" id="<?php echo $id_client; ?>" rel="clients/del/" href="#"><em class="fa fa-trash"></em></a>
						</td>
				</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="4">Sem registros...</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
		<a class="btn btn-default" href="<?php echo BASE; ?>/clients/add"><span class="fa fa-plus"> Adicionar</span></a>
	</div>
</div>