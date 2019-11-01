<?php
	function verify() {
		$array_from_to =  array(' ' => '%20',
		'!' => '%21',
		'\'' => '%22',
		'#' => '%23',
		'\\$' => '%24',
		'%' => '%25',
		'&' => '%26',
		"'" => '%27',
		'' => '%28',
		')' => '%29',
		'*' => '%2a',
		'+' => '%2b',
		' =>' => '%2c',
		'~' => '%2d',
		'.' => '%2e',
		'/' => '%2f',
		'0' => '%30',
		'1' => '%31',
		'2' => '%32',
		'3' => '%33',
		'4' => '%34',
		'5' => '%35',
		'6' => '%36',
		'7' => '%37',
		'8' => '%38',
		'9' => '%39',
		':' => '%3a',
		';' => '%3b',
		'<' => '%3c',
		'=' => '%3d',
		'>' => '%3e',
		'?' => '%3f',
		'@' => '%40',
		'A' => '%41',
		'B' => '%42',
		'C' => '%43',
		'D' => '%44',
		'E' => '%45',
		'F' => '%46',
		'G' => '%47',
		'H' => '%48',
		'I' => '%49',
		'J' => '%4a',
		'K' => '%4b',
		'L' => '%4c',
		'M' => '%4d',
		'N' => '%4e',
		'O' => '%4f',
		'P' => '%50',
		'Q' => '%51',
		'R' => '%52',
		'S' => '%53',
		'T' => '%54',
		'U' => '%55',
		'V' => '%56',
		'W' => '%57',
		'X' => '%58',
		'Y' => '%59',
		'Z' => '%5a',
		'[' => '%5b',
		'\\\\' => '%5c',
		']' => '%5d',
		'^' => '%5e',
		'_' => '%5f',
		'`' => '%60',
		'a' => '%61',
		'b' => '%62',
		'c' => '%63',
		'd' => '%64',
		'e' => '%65',
		'f' => '%66',
		'g' => '%67',
		'h' => '%68',
		'i' => '%69',
		'j' => '%6a',
		'k' => '%6b',
		'l' => '%6c',
		'm' => '%6d',
		'n' => '%6e',
		'o' => '%6f', 
		'p' => '%70',
		'q' => '%71',
		'r' => '%72',
		's' => '%73',
		't' => '%74',
		'u' => '%75',
		'v' => '%76',
		'w' => '%77',
		'x' => '%78',
		'y' => '%79',
		'z' => '%7a',
		'{' => '%7b',
		'|' => '%7c',
		'}' => '%7d',
		'~' => '%7e');
	
		$origem = $_GET['origem'];
		$array = str_split($origem);
		$estado = 0;
		$destino = '';

		if ($estado == 0) {
			for ($i = 0; $i < sizeof($array); $i++) {
				if ($array[$i] != '%') {
					$destino .= $array[$i];
				} else {
					$char = $array[$i];
					$estado++;
				}

				if ($estado == 1) {
					$j = $i;
					$char .= $array[$j+1];
					$char .= $array[$j+2];

					if (preg_match_all('/[%]{1}[0-9A-Fa-f]{2}/m', $char, array_keys($array_from_to), PREG_SET_ORDER, 0)) {
						$charDecrypt = str_replace(array_values($array_from_to), array_keys($array_from_to), $char);
						$destino .= $charDecrypt;

						$i++;
						$i++;

						$estado = 0;
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
<style>
	* {
		font-family: 'Comic Sans MS', 'Comic Sans', cursive;
	}
	iframe{
		width: 100%;
		height: 100px;
	}
	.jumbotron{
		padding: 2rem;
	}
	.background {
		background: url("img.jpg") no-repeat;
		background-size: contain;
		width: 100%;
		height: 100%;
	}
</style>
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
					<form action="verify()" target="iframeUpload">
						<div class="form-group">
							<label>URL:</label>
							<input type="text" name="origem" class="form-control">
						</div>
						<button type="submit" id="bt_carregar" class="btn">Carregar</button>
						<button type="reset" class="btn">Limpar</button>
					</form>
					<iframe name="iframeUpload" id="iframeUpload"> 
						<?php
							echo $destino;
						?>
					</iframe>
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