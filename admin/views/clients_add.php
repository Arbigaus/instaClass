<div class="container-fluid">
<h2>Add Client</h2>

<div class="col-md-4 col-md-offset-4 alert ">
	<div class="result"></div>
</div>

<form method="POST" id="clients/add_ajax">
	<div class="col-md-4 col-md-offset-4">
		<div class="form-group">
			<input type="text" name="client_name" class="form-control">
		</div>
	
	<div class="form-group">
		<select name="client_genre" class="form-control">
			<option value="">Selecione o Sexo</option>
			<option value="m">Masculino</option>
			<option value="f">Feminino</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-success">
			<i class="i-send fa "></i> Atualizar <i class="fa"></i>
		</button>
	</div>
	</div>

</form>

</div>