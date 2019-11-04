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
				}
			}
		}
	}
?>


<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Desofuscando URLs</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>

<body>
	<div class="title">
		<h1>Desofuscamento de Dados</h1>
	</div>

	<div class="menu">
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link active" href="#">Active</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" tabindex="-1" aria-disabled="true" href="#">Sobre</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" tabindex="-1" aria-disabled="true" href="#">Blog</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" tabindex="-1" aria-disabled="true" href="#">Contato</a>
			</li>
		</ul>
	</div>

	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#leitura" role="tab" aria-controls="home" aria-selected="true">Leitura de URL</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="profile" aria-selected="false">Upload de URL</a>
						</li>
					</ul>
					
					<div class="card-body">
						<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="leitura">
							<form target="result">
								<div class="form-group">
									<label>URL:</label>
									<div class="url">

										<select name="select">
											<option value="select">Selecione a linguagem</option>
											<option value="hexa">Hexa</option>
											<option value="bi">Bi</option>
										</select>
										<input type="text" name="origem" class="form-control origem">

									</div>
								</div>

								<div class="buttons">
									<button type="submit" id="bt_loading" class="btn float">Carregar</button>
									<button type="reset" class="btn float">Cancelar</button>
								</div>

							</form>
							<div class="form-group">

								<label for="res">Resultado:</label>
								<input type="text" name="result" class="form-control">

							</div>
						</div>

						<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="upload">
							<form action="grava.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="inputUpload">
								<div class="form-group">

									<label>Arquivo:</label>
									<div class="arq">
										<input type="text" name="arquivos[]" class="form-control arquivo" id="arq">
									</div>

								</div>

								<div class="buttons">
									<button type="submit" id="bt_loading" class="btn float">Carregar</button>
									<button type="reset" class="btn float">Cancelar</button>
								</div>

							</form>

							<div class="form-group">
								<label for="res">Resultado:</label>
								<textarea name="inputUpload" id="inputUpload" disabled></textarea>
							</div>

							<button type="" class="btn float">Download</button>
						</div>

					</div>
				</div>
			</div>
			
			<div class="col">
				<div class="background"></div>
			</div>

		</div>
	</div>
</body>
</html>