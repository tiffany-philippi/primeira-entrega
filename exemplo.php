<?php
include 'conecta_sql.php';

$original = $_POST["original"];
$resultado = $_POST["resultado"];
$array_r = explode(" ",$resultado);

foreach($array_r as $emocao) {
    $sql = "select valencia from emocoes where emocao = '" . $emocao . "'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    foreach($rows as $emo) {
        if ($emo['valencia'] == '+'){
            $cor = " <b><span style='color:Blue'>" . $emocao . "</span></b>";
        }else{
            $cor = " <b><span style='color:Red'>" . $emocao . "</span></b>";
        }
        $emocao = " ". $emocao;
        $original = str_replace($emocao,$cor,$original);
    }
    
    
}
echo $original;