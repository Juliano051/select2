<?php

function formatBanco($campo, $tipo = "s") {
  if ($tipo != "dt") {
    $retorno = trim($campo) . "";
    if (($retorno === "")) {
      $retorno = "null";
    } elseif ((strtolower($tipo) == "n")) {
      $retorno = str_replace(".", "", $retorno);
      $retorno = str_replace(",", ".", $retorno);
    } elseif ((strtolower($tipo) == "b")) {
      if (($campo === true) || (intval($campo) === 1)) {
        $retorno = "1"; //true
      } else {
        $retorno = "0"; //false
      }//if
    } elseif ((strtolower($tipo) == "s")) {
      /* Trecho de cÛdigo repassado para o request campos post/get
        $retorno = str_replace('\"', '"', $retorno);
        $retorno = str_replace("\'", "'", $retorno);
        $retorno = str_replace('\\\\', '\\', $retorno);
       */
      $retorno = "'" . str_replace("'", "''", strtoupper($retorno)) . "'";
    } elseif ((strtolower($tipo) == "s+")) {
      /* Trecho de cÛdigo repassado para o request campos post/get
        $retorno = str_replace('\"', '"', $retorno);
        $retorno = str_replace("\'", "'", $retorno);
        $retorno = str_replace('\\\\', '\\', $retorno);
       */
      $retorno = "'" . str_replace("'", "''", $retorno) . "'";
    } elseif ((strtolower($tipo) == "d")) {
      $retorno = "TO_DATE('$campo', 'DD/MM/YYYY')";
    }//if
    $function_ret = $retorno;
  } else {
    if (is_object($campo)) {
      //$function_ret = "'".$campo->getAno()."-".$campo->getMes()."-".$campo->getDia()." ".$campo->getHora().":".$campo->getMinuto().":".$campo->getSegundo()."'";
      $function_ret = "TO_DATE('" . $campo->getStringDataTime() . "', 'DD/MM/YYYY HH24:MI:SS')";
    } else {
      $function_ret = "null";
    }//if
  }//if
  return $function_ret;
}

//formatBanco($campo,$tipo)

function formatMoney($valor) {
  if ($valor == "") {
    $retorno = number_format(0, 2, ",", ".");
  } elseif (is_numeric($valor)) {
    $retorno = number_format($valor, 2, ",", ".");
  } elseif (is_string($valor)) {
    $valor = str_replace(",", ".", $valor);
    if (is_numeric($valor)) {
      $retorno = number_format($valor, 2, ",", ".");
    } else {
      $retorno = number_format(0, 2, ",", ".");
    }//if
  } else {
    $retorno = number_format(0, 2, ",", ".");
  }//if
  return $retorno;
}

//formatMoney

function retiraMascara($campo) {
  extract($GLOBALS);
  $campo = str_replace("/", "", $campo);
  $campo = str_replace("-", "", $campo);
  $campo = str_replace("(", "", $campo);
  $campo = str_replace(")", "", $campo);
  $campo = str_replace("%", "", $campo);
  $campo = str_replace("'", "", $campo);
  $function_ret = $campo;
  return $function_ret;
}

//retiraMascara

function retiraAcentos($texto) {
  $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
  return strtr($texto, "???????•µ¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ⁄€‹›ﬂ‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘˙˚¸˝ˇ", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}

//retiraAcentos

function htmlEncode($texto) {
  return htmlspecialchars($texto, ENT_QUOTES);
}

//htmlEncode

/**
 * Retorna o indice de um array multidimensional/matriz
 * @param array $array
 * @param String $chave
 * @param String $valor
 */
function procurarNaMatriz($array, $chave, $valor) {
  $indice = "";

  while (list($key, $value) = each($array)) {

    if ($value[$chave] == $valor) {
      $indice = $key;
    }//if
  }//while

  return $indice;
}

//procurarNaMatriz

function getStrException(Exception $e) {
  $ret = '<div align="left" style="border: thin solid Black; font-size: 10pt; background-color:#e6e6e6; color: #000000; padding: 2px;"><pre>Erro' . "\n\n";
  $ret .= 'Mensagem: ' . $e->getMessage() . "\n";
  $ret .= 'CÛdigo: ' . $e->getCode() . "\n";
  $ret .= 'Arquivo: ' . $e->getFile() . "\n";
  $ret .= 'Linha: ' . $e->getLine() . "\n";
  $ret .= 'Trace: ' . "\n" . $e->getTraceAsString() . "\n";
  $ret .= '</pre></div>' . "\n";
  return $ret;
}

//getStrExcepti

function setarBoolean($valor) {
  $ret = "";
  if (($valor === true) || ($valor === "1")) {
    $ret = "1";
  } elseif (($valor === false) || ($valor === "0")) {
    $ret = "0";
  }//if
  return $ret;
}

//setarBoolean

function mascara($str, $mask = "") {
  if (strpos(' ' . $mask, '#')) {
    $indice = -1;
    for ($i = 0; $i < strlen($mask); $i++) {
      if ($mask[$i] == '#')
        $mask[$i] = $str[++$indice];
    }
    $str = $mask;
  }
  return $str;
}

function deleteDir($dirPath) {
    if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}

?>