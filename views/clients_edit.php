<?php if(!empty($list_client)){
	foreach ($list_client as $Clients) {
		extract($Clients);
	}
}
?>
<div class="container-fluid">
<h2>Client Edit</h2>

<div class="col-md-4 col-md-offset-4 alert ">
	<div class="result"></div>
</div>


<form method="POST" id="clients/edit_ajax">
	<div class="col-md-4 col-md-offset-4">
		<div class="form-group">
			<input type="text" name="client_name" class="form-control" value="<?php echo $client_name; ?>">
			<input type="hidden" name="id_client" value="<?php echo $id_client; ?>">
		</div>
	
	<div class="form-group">
		<select name="client_genre" class="form-control">
			<option value="">Selecione o Sexo</option>
			<option <?php echo ($client_genre == "M" ? "selected" : ""); ?> value="m">Masculino</option>
			<option <?php echo ($client_genre == "F" ? "selected" : ""); ?> value="f">Feminino</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-primary">
			<i class="i-send fa "></i> Editar <i class="fa"></i>
		</button>
	</div>
	</div>

</form>

</div>