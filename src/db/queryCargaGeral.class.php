<?php

require_once("./util/rotinas.inc.php");
require_once("./db/conexaoSAHV.class.php");
require_once("./util/Data.class.php");

class QueryCargaGeral {

  static private function getConn() {
    return ConexaoSCOP::getInstance();
  }

  /*static public function getDataContabil_DespesasDetalhadasUnidadeGestora() {
    $sql = 'select max(tdesorulat) as data from cmpt.tbdwdespesapororgao ';
    return self::getConn()->execSql($sql);
  }*/
  
  public static function listarPeriodos() {
    $conexao = ConexaoSCOP::getInstance();
    /* @var $conexao ConexaoDataSource */
    $sql = 'select distinct(epsateperiodo) from scop.tbpsatendimento order by epsateperiodo';
    $result = $conexao->execSql($sql); 
    $ret = array();
    foreach($result as $periodo) {
      $ret[] = $periodo['epsateperiodo'];
    }
    return $ret;
  }

  public static function inserirLinha(array $dados) {    
    $conexao = ConexaoSCOP::getInstance();
    /* @var $conexao ConexaoDataSource */
    $transactionOpened = $conexao->isTransactionOpened();
    $conexao->beginTrans();
    
    if ($dados['dataExecucao']) { 
      $dataAux = new Data();
      $dataAux->loadStrDataBR($dados['dataExecucao']);
      $dados['dataExecucao'] = $dataAux;
    }

    $sql = "
      INSERT INTO scop.tbpsatendimento (
          cpsateatendimento, tpsatedataexecucao, cpsatecodigoprocedimento, epsateprocedimento, cpsateempresa, epsaterazaosocial, epsateperiodo, epsatetipocredenciado, 
          epsatetipocontrato, cpsatecodigoprestador, epsateprestador, cpsatecodigobeneficiario, epsatebeneficiario, epsatedependencia, epsateagrupamento, qpsatequantidade, 
          vpsatevalorpago, cpsatecodigotitular, epsatetitular, epsatetiposervico, cemprecodi, ausuacmatr
      ) VALUES ( ".
          formatBanco($dados['atendimento'], "n").", ".
          formatBanco($dados['dataExecucao'], "dt").", ".
          formatBanco($dados['procedimento'], "n").", ".
          formatBanco($dados['descricao'], "s+").", ".
          formatBanco($dados['codigoEmpresa'], "n").", ".
          formatBanco($dados['empresa'], "s+").", ".
          formatBanco($dados['periodo'], "s+").", ".
          formatBanco($dados['tipoCredenciado'], "s+").", ".
          formatBanco($dados['tipoContrato'], "s+").", ".
          formatBanco($dados['codigoPrestador'], "n").", ".
          formatBanco($dados['prestador'], "s+").", ".  
          formatBanco($dados['codigoBeneficiario'], "n").", ".
          formatBanco($dados['beneficiario'], "s+").", ".
          formatBanco($dados['depenciancia'], "s+").", ".
          formatBanco($dados['agrupamento'], "s+").", ".  
          formatBanco($dados['quantidade'], "n").", ".
          formatBanco($dados['valorPago'], "n").", ".  
          formatBanco($dados['codigoTitular'], "n").", ".
          formatBanco($dados['titular'], "s+").", ".
          formatBanco($dados['tipoServico'], "s+").", ".  
          formatBanco($_SESSION['_loginEMAC_']->usuario->empresa, "n").", ".  
          formatBanco($_SESSION['_loginEMAC_']->usuario->matricula, "n")."  
      )
    ";
    
    if (! $conexao->execUpdate($sql)) {
      return "Erro SQL $sql";      
    }
    if (!$transactionOpened) $conexao->commitTrans();
    
    return true;
  }

}
