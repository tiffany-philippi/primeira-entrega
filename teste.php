<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mineração de emoções</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
	iframe{
		width: 100%;
		height: 100px;
	}
	.jumbotron{
		padding: 0px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
	// Funções executadas no momento da carga da página
	atualiza_sw();
	atualiza_arq();

	$('#btn_nova_sw').click(function(){
		var nova_sw = $('#ins_sw').val().trim();
		if(nova_sw.length>0){
			fn_grava_sw(nova_sw);
			atualiza_sw();
			$('#ins_sw').val('');
		}else{
			$('#result').html("Insira uma palavra válida");
		}
	});

	$('#btn_exc_sw').click(function(){
		fn_exclui_sw();
	});
	
	$('#bt_resultado').click(function(){
		var qual_arquivo = $('#lista_proc option:selected').val()
		$('#dv_resultado').html('');
		if(qual_arquivo != 0){
			fn_mostra_resultado(qual_arquivo);
		}
	});

	$('#bt_comparar').click(function(){
		var qual_arquivo = $('#lista_proc option:selected').val()
		$('#dv_resultado').html('');
		$('#dv_original').html('');
		
		if(qual_arquivo != 0){
			fn_carrega_original(qual_arquivo);
			fn_mostra_resultado(qual_arquivo);
			fn_mostra_resultado_html();
		}
	});
	
	function fn_mostra_resultado_html(){
		var txt_dv_original = $('#dv_original').html();
		var txt_dv_resultado = $('#dv_resultado').html();
		$.ajax({
			url: 'resultado_html.php',
			data: {original: txt_dv_original, resultado: txt_dv_resultado},
			timeout: 1200000,
			async: false,
			type: 'POST',
			dataType: 'html',
			success: function(retorno) {
				$('#dv_original').html(retorno);
			}
		});
	}

	$('#iframeUpload').click(function(){
		atualiza_arq();
	});

	function fn_mostra_resultado(qual_arquivo){
		$.ajax({
				url: 'resultado.php',
				data: {arquivo: qual_arquivo},
				timeout: 1200000,
				async: false,
				type: 'POST',
				dataType: 'json',
				success: function(retorno) {
					$.each(retorno.lista, function(key,arq){
						$('#dv_resultado').append(' ' + arq.palavra);
					});
				}
			});
	}

	function fn_carrega_original(qual_arquivo){
		$.ajax({
			url: qual_arquivo,
			timeout: 1200000,
			async: false,
			dataType: 'text',
			success: function(retorno) {
					$('#dv_original').append(retorno);
			}
		});
	}

	function fn_exclui_sw(){
		var codigo_sw = $('#lista_sw option:selected').val();
		if(codigo_sw != 0){
			var qual_sw = $('#lista_sw option:selected').text();
			$('#result').html("");
			$.ajax({
				url: 'exclui_sw.php',
				data: {codigo: codigo_sw},
				timeout: 1200000,
				async: false,
				type: 'POST',
				dataType: 'json',
				success: function(retorno) {
					alert('Palavra ' + qual_sw + ' excluída');
				}
			});
			atualiza_sw();
		}else{
			alert("Selecione uma palavra para excluir")
		}
	}

	function atualiza_sw(){
		$('#lista_sw').find('option:not(:first)').remove();
		$.ajax({
			url: 'lista_sw.php',
			timeout: 1200000,
			async: true,
			type: 'POST',
			dataType: 'json',
			success: function(retorno) {
				$('#quant').html(retorno.quant + " palavras cadastradas");
				$.each(retorno.lista, function(key,sw){
					$('#lista_sw').append('<option value="' + sw.codigo + '" >' + sw.palavra + '</option>');
				});
			}
		});
	}

	function atualiza_arq(){
		$('#lista_proc').find('option:not(:first)').remove();
		$.ajax({
			url: 'arquivos_proc.php',
			timeout: 1200000,
			async: true,
			type: 'POST',
			dataType: 'json',
			success: function(retorno) {
				if(parseInt(retorno.quant)>0){
					$('#quant_proc').html(retorno.quant + " arquivos processados");
					$.each(retorno.lista, function(key,arq){
						$('#lista_proc').append('<option value="' + arq.arquivo + '" >' + arq.arquivo + '</option>');
					});
				}
			}
		});
	}

	function fn_grava_sw(nova_palavra){
		$('#result').html("");
		$.ajax({
			url: 'grava_sw.php',
			data: {palavra: nova_palavra},
			timeout: 1200000,
			async: false,
			type: 'POST',
			dataType: 'json',
			success: function(retorno) {
				if(retorno.sucesso == 'true'){
					$('#result').html("Nova palavra " + nova_palavra + " inserida");
				}else {
					$('#result').html("Palavra " + nova_palavra + " já existe na lista");
				}
			}
		});
	}
});
</script>
</head>

<body>
<div class="jumbotron text-center">
  <h1>Identificação de padrões afetivos</h1>
</div>
<div class="container">
	<div class="row">
		<div class="col" >
			<div class="card">
				<div class="card-header">Upload de arquivo processado</div>
				<div class="card-body">
					<form action="emocoes_ler_arq_V3.php" method="post" name="enviar" id="enviar" enctype="multipart/form-data" target="iframeUpload">
						<div class="form-group">
							<label for="arq">Arquivo:</label>
							<input type="file" name="arquivos[]" class="form-control" id="arq">
						</div>
						<button type="button" id="bt_carregar" class="btn">Carregar</button>
						<button type="reset" class="btn">Limpar</button>
					</form>
					<iframe name="iframeUpload" id="iframeUpload"></iframe>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-header">Manutençao StopWords</div>
				<div class="card-body">
					<form>
						<div class="form-group mb-3 input-group-sm">
							<input type="text" name="ins_sw" class="form-control" id="ins_sw" placeholder="Nova StopWord">
							<button type="button" id="btn_nova_sw" class="btn">Salvar</button>
							<span id="result"></span>
						</div>
					</form>
					<select class="form-control" id="lista_sw">
						<option value="0">Selecione</option>
					</select>
					<button type="button" id="btn_exc_sw" class="btn">Excluir</button>
					<span id="quant"></span><br><br>
					<select class="form-control" id="lista_proc">
						<option value="0">Selecione</option>
					</select>
					<span id="quant_proc"></span><br><br>
					<button type="button" class="btn" id="bt_resultado">Resultado</button>
					<button type="button" class="btn" id="bt_comparar">Comparar</button>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col" >
			<div class="card">
				<div class="card-header">Texto Original</div>
				<div class="card-body">
					<div id="dv_original"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col" >
			<div class="card">
				<div class="card-header">Texto processado</div>
				<div class="card-body">
					<div id="dv_resultado"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
