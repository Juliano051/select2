<?php

require_once("./src/db/dataSource.class.php");

/**
 * Classe de conexão com o banco Postgre;
 * @author Marconi Clementino de Oliveira
 * @date 11/07/2008
 *
 */
class ConexaoDataSource {

  // Guarda uma instância da classe
  static private $instance;
  private $conexao;
  private $ambiente = "";
  private $sqls = array();
  private $status = "Desconectado";
  private $transactionOpened = false;
  private $dbErro = "Nenhum";

  /**
   * Método Construtor
   * @author: Marconi Clementino de Oliveira
   */
  protected function __construct($dataSourceName) {

    //Desenvolvimento
    if (($_SERVER["SERVER_NAME"] == "cohab.recife") || ($_SERVER["SERVER_NAME"] == "portal.emprel.recife") || ($_SERVER["SERVER_NAME"] == "intranet.emprel.recife")) {

      $this->ambiente = "desenvolvimento";

      //Homologação
    } elseif (($_SERVER["SERVER_NAME"] == "portal.homolog.recife") || ($_SERVER["SERVER_NAME"] == "cdu.recife") || ($_SERVER["SERVER_NAME"] == "intranet.homolog.recife")) {

      $this->ambiente = "homologacao";

      //Producao
    } elseif (($_SERVER["SERVER_NAME"] == "varzea.recife") || ($_SERVER["SERVER_NAME"] == "www.recife.pe.gov.br") || ($_SERVER["SERVER_NAME"] == "intranet.recife")) {

      $this->ambiente = "producao";
    }//if

    try {
      $this->conexao = new DataSource($dataSourceName);
      if (!$this->conexao) {
        throw new Exception("Não foi possível conectar: " . @implode(", ", utf8_encode($this->conexao->errorInfo())));
      }//if
    } catch (Exception $e) {
      throw new Exception("Não foi possível conectar: " . utf8_encode($e->getMessage()));
    }//if
    //Conexao bem sucedida

    $this->status = "Conectado";
  }

//construtor

  /**
   * Método destrutor
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  function __destruct() {
    
  }

//destructor


  /**
   * Método do padrão de projeto Singleton
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  /*
    static public function getInstance($dataSourceName){
    if (!isset(self::$instance)) {
    $c = __CLASS__;
    self::$instance = new $c($dataSourceName);
    }//if
    return self::$instance;
    }//getInstance
   */

  /**
   * Método que executa um sql e retorna um result set
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  public function execSql($sql) {
    $this->sqls[] = $sql;

    try {
      $rsRet = $this->conexao->execSelect($sql);
    } catch (Exception $e) {
      //throw new Exception(utf8_encode($e->getMessage()));
      $this->dbErro = $e->getMessage();
    }

    $ret = array();
    for ($i = 0; $i < count($rsRet); $i++) {
      $ret[] = array_change_key_case($rsRet[$i], CASE_LOWER);
    }//while

    return $ret;
  }

//execSql;

  /**
   * Método que executar um update/delete e retorna se algum registro foi afetado
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  public function execUpdate($sql) {
    $this->sqls[] = $sql;

    $closeTransaction = false;
    if (!$this->isTransactionOpened()) {
      $closeTransaction = true;
      $this->beginTrans();
    }//if
    //try

    try {
      //var_dump($this->conexao);
      $this->conexao->execUpdate($sql);

      if ($closeTransaction) {
        $this->commitTrans();
        $closeTransaction = false;
      }//if
      return true;
    } catch (Exception $e) {
      $this->dbErro = $e->getMessage();
      echo $this->dbErro;
      if ($closeTransaction) {
        $this->rollbackTrans();
        $closeTransaction = false;
      }//if

      return false;
    }//try
  }

//execUpdate

  /**
   * Inicia Transação
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  public function beginTrans() {
    if ($this->transactionOpened === false) {
      $this->execSql("BEGIN TRANSACTION");
      $this->transactionOpened = true;
    }
  }

//beginTrans

  /**
   * Commit da Transação
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  public function commitTrans() {
    if ($this->transactionOpened === true) {
      $this->execSql("COMMIT");
      //$this->conexao->beginTransaction();
      $this->transactionOpened = false;
    }
  }

//beginTrans

  /**
   * Rollback da Transação
   * @author: Marconi Clementino de Oliveira
   * @date: 27/02/2007
   */
  public function rollbackTrans() {
    if ($this->transactionOpened === true) {
      $this->execSql("ROLLBACK");
      //$this->conexao->rollBack();
      $this->transactionOpened = false;
    }
  }

//beginTrans

  /**
   * Retorna o status da conexão (Conectado/Desconectado)
   */
  public function getStatus() {
    return $this->status;
  }

//getStatus

  public function isTransactionOpened() {
    return $this->transactionOpened;
  }

  /**
   * Retorna o último erro do banco de dados
   */
  public function getErro() {
    return $this->dbErro;
  }

//getErro

  /**
   * Retorna todos os sqls executados
   */
  public function getSqls() {
    return $this->sqls;
  }

}

//ConexaoDataSource
/*
  $objCon = ConexaoDataSource::getInstance("DSCGPT01");

  $rsTmp = $objCon->execSql("select * from cgpt.tbdwdespesaporcredor limit 10");

  echo "<pre>";
  print_r($rsTmp);
  echo "</pre>";
 */
?>