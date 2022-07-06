<?php

/**
 * @author Marconi Clementino de Oliveira
 * @date 22/03/2007
 * Classe de data
 */
define("DT_DOMINGO", 0);
define("DT_SEGUNDA", 1);
define("DT_TERCA", 2);
define("DT_QUARTA", 3);
define("DT_QUINTA", 4);
define("DT_SEXTA", 5);
define("DT_SABADO", 6);

class Data {

  private $dia;
  private $mes;
  private $ano;
  private $hora;
  private $minuto;
  private $segundo;

  /**
   * Construtor
   */
  function __construct() {
    $agora = getdate();
    $this->loadArrayData($agora);
  }

//__construct

  /**
   * Preenche a data com os valores de um array
   * do modelo da função getdate()
   */
  private function loadArrayData($arrayData) {
    $this->setDia($arrayData["mday"]);
    $this->setMes($arrayData["mon"]);
    $this->setAno($arrayData["year"]);
    $this->setHora($arrayData["hours"]);
    $this->setMinuto($arrayData["minutes"]);
    $this->setSegundo($arrayData["seconds"]);
  }

  /**
   * Carrega variável apenas com data(dia/mes/ano)
   * @param int $dia
   * @param int $mes
   * @param int $ano
   */
  public function loadData($dia, $mes, $ano) {
    $this->setDia($dia);
    $this->setMes($mes);
    $this->setAno($ano);
    $this->zerarHora();
    $this->verificarData();
  }

//loadData

  /**
   * Carrega variável com o formato dd/mm/aaaa
   */
  public function loadStrDataInput($strData) {
    $arrTmp = explode("/", $strData);
    $this->setDia($arrTmp[0]);
    $this->setMes($arrTmp[1]);
    $this->setAno($arrTmp[2]);
    $this->zerarHora();
    $this->verificarData();
  }

  /**
   * Carrega variável com hora:minuto:segundo
   * @param int $hora
   * @param int $minuto
   * @param int $segundo
   */
  public function loadTime($hora, $minuto, $segundo) {
    $this->setHora($hora);
    $this->setMinuto($minuto);
    $this->setSegundo($segundo);
    $this->verificarData();
  }

//loadTime

  /**
   * Carrega uma string de data no seguinte formato: "aaaa-mm-dd hh:mi:ss"
   * Pode ser para carregar datas vindas de selects em banco de dados
   */
  public function loadStrData($strData) {
    $arrTmp = explode(" ", $strData);
    $arrData = explode("-", $arrTmp[0]);
    $arrHora = explode(":", $arrTmp[1]);
    $this->setAno($arrData[0]);
    $this->setMes($arrData[1]);
    $this->setDia($arrData[2]);
    $this->setHora($arrHora[0]);
    $this->setMinuto($arrHora[1]);
    $this->setSegundo($arrHora[2]);
    $this->verificarData();
  }

//loadSrtData

  /**
   * Carrega uma string de data no seguinte formato: "dd/mm/aaaa hh:mi:ss"
   * Pode ser para carregar datas vindas de selects em banco de dados
   */
  public function loadStrDataBR($strData) {
    $arrTmp = explode(" ", $strData);
    $arrData = explode("/", $arrTmp[0]);
    $arrHora = explode(":", $arrTmp[1]);
    $this->setDia($arrData[0]);
    $this->setMes($arrData[1]);
    $this->setAno($arrData[2]);
    $this->setHora($arrHora[0]);
    $this->setMinuto($arrHora[1]);
    $this->setSegundo($arrHora[2]);
    $this->verificarData();
  }

//loadSrtData

  public function setDia($dia) {
    $this->dia = intval($dia);
  }

//setDay

  /**
   * Verifica se a data é válida levando em consideração 
   * os anos bissestos
   */
  private function verificarData() {
    if (!checkdate($this->mes, $this->dia, $this->ano)) {
      //throw new Exception("AAAAAAAAAAAa");
      //die("Data Inválida: ".$this->dia."/".$this->mes."/".$this->ano);
    }//if
  }

//verificaData

  public function getDia() {
    $this->verificarData();
    return $this->dia;
  }

//getDay

  public function setMes($mes) {
    $this->mes = intval($mes);
  }

//setMes

  public function getMes() {
    $this->verificarData();
    return $this->mes;
  }

//getMes

  public function setAno($ano) {
    $this->ano = intval($ano);
    if (strlen($this->ano) == 2) {
      if ($this->ano > 50)
        $this->ano = '19' . $this->ano;
      else
        $this->ano = '20' . $this->ano;
    }
  }

//setAno

  public function getAno() {
    $this->verificarData();
    return $this->ano;
  }

//getAno

  public function setHora($hora) {
    $this->hora = intval($hora);
  }

//setHora

  public function getHora() {
    $this->verificarData();
    return $this->hora;
  }

//getHora

  public function setMinuto($minuto) {
    $this->minuto = intval($minuto);
  }

//setMinuto

  public function getMinuto() {
    $this->verificarData();
    return $this->minuto;
  }

//getMinuto

  public function setSegundo($segundo) {
    $this->segundo = intval($segundo);
  }

//setSegundo

  public function getSegundo() {
    $this->verificarData();
    return $this->segundo;
  }

//getSegundo	

  /**
   * Retorna a data com a string no seguinte formato: dd/mm/aaaa
   */
  public function getStringData() {
    $this->verificarData();
    if (intval($this->dia) !== 0) {
      return substr("00" . $this->dia, -2) . "/" . substr("00" . $this->mes, -2) . "/" . substr("0000" . $this->ano, -4);
    }
  }

//getStrData

  /**
   * Retorna o tempo com a string no seguinte formato: hh:mi:ss
   */
  public function getStringTime() {
    $this->verificarData();
    return substr("00" . $this->hora, -2) . ":" . substr("00" . $this->minuto, -2) . ":" . substr("00" . $this->segundo, -2);
  }

//getStringTime

  /**
   * Retorna a data e hora com uma string no seguinte formato: dd/mm/aaaa hh:mi:ss
   */
  public function getStringDataTime() {
    $this->verificarData();
    return $this->getStringData() . " " . $this->getStringTime();
  }

//getStrngDataTime();

  /**
   * Seta a hora para 00:00:00
   */
  public function zerarHora() {
    $this->setHora(0);
    $this->setMinuto(0);
    $this->setSegundo(0);
    $this->verificarData();
  }

//zerarHora

  /**
   * Seta a hora para 23:59:59
   */
  public function toparHora() {
    $this->setHora(23);
    $this->setMinuto(59);
    $this->setSegundo(59);
    $this->verificarData();
  }

//toparHora

  /**
   * Retorna a data transformada em segundos a partir da Era Unix (January 1 1970)
   */
  public function getTotalSegundos() {
    return mktime($this->getHora, $this->getMinuto(), $this->getSegundo(), $this->getMes(), $this->getDia(), $this->getAno(), 0);
  }

//getTotalSegundos

  /**
   * Adiciona $dias a data
   */
  public function addDia($dias) {
    $tmpMinuto = 60; // segundos
    $tmpHora = 60 * $tmpMinuto;
    $tmpDia = 24 * $tmpHora;
    $this->loadArrayData(getdate($this->getTotalSegundos() + (intval($dias) * $tmpDia)));
  }

  /**
   * Retorna o dia da semana
   * 0 = Domingo
   * 6 = Sabado
   */
  public function getDiaDaSemana() {
    $arrTmp = getdate($this->getTotalSegundos());
    return intval($arrTmp["wday"]);
  }

  /**
   * Retorna a data no formato do xsd:dateTime, usado em Webservices
   * http://books.xmlschemata.org/relaxng/ch19-77049.html
   */
  public function getXsdDateTime() {
    return str_replace("@", "T", date("Y-m-d@H:i:s", $this->getTotalSegundos()));
  }

  public function __toString() {
    return "<b>Data: </b>" . $this->getStringDataTime();
  }

//__toString

  public static function __getStringData($data) {
    $ret = "";
    if (trim($data != null) && ($data instanceof Data)) {
      $ret = $data->getStringData();
    }//if
    return $ret;
  }

}

//Data
?>