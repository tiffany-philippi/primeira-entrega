<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Desofuscando URLs</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- SCRIPT DE FUNCOES AJAx -->
	<script>
		// CONSTRUTOR DO JQUERY
		$(document).ready(function() {
			$('#bt_carregar').click(function() {

				var input_original = $('#origem').val();
				$.ajax({
					url: 'percentDecrypt.php',
					data: {
						original: input_original
					},
					timeout: 1200000,
					async: true,
					type: 'POST',
					dataType: 'json',
					success: function(retorno) {
						//alert(retorno.resultado);
						$('#destino').html(retorno.resultado);
					}
				})
			});
		});
	</script>
</head>

<body>
	<div class="jumbotron text-center">
		<h1>Ofuscamento de Dados</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">Leitura de URL</div>
					<div class="card-body">
						<form target="iframeUpload">
							<div class="form-group">
								<label>URL:</label>
								<input type="text" name="origem" id="origem" class="form-control">
							</div>
							<button type="submit" id="bt_carregar" class="btn">Carregar</button>
							<button type="reset" class="btn">Limpar</button>
						</form>
						<div id="destino"></div>


						<!-- <input type="text" disabled name="destino" id="destino" class="form-control"> -->
					</div>
				</div>
			</div>

			<div class="col">
				<div class="background"></div>
			</div>

		</div>
		<br>
	</div>
</body>
</html>