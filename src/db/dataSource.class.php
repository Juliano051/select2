<?php

require_once("/home/wwwdisco1/portal/html/common/dataSourcePHP/dataSourcePHP.phb"); // A extensao eh (.phb), pois a classe estah compilada
/**
 * Classe para conexao datasource generico, enviado por Calabria 
 * */

class DataSource extends dataSourcePHP {
  /*
   * Retorna um registro do resulSet
   * @return $registro (array)
   */

  public function fetchRow($resultSet) {
    $registro = $resultSet->fetch(PDO::FETCH_NUM);
    return $registro;
  }

  /*
   * Executa uma query (select) para tabelas com long e retorna um array com registros
   * @return $rows
   */

  public function execSelect($query, $fetch_style=PDO::FETCH_ASSOC) {
    $rows = array();
    $resultSet = $this->instance->prepare($query);
    if ($resultSet->execute()) {
      while ($row = $resultSet->fetch($fetch_style)) {
        $rows[] = $row;
      }
      return $rows;
    } else {
      throw new PDOException(self::preparaMens($query));
    }
  }

  /*
   * Executa uma query (insert/update/delete) e retorna a quantidade de registros envolvidos
   * @return $numRows
   */

  public function execUpdate($query) {
    $numRows = $this->instance->exec($query);
    if ($this->instance->errorCode() != '0') {
      throw new PDOException(self::preparaMens($query));
    }
    return $numRows;
  }

  public function beginTransaction() {
    $this->instance->beginTransaction();
  }

  public function commit() {
    $this->instance->commit();
  }

  public function rollBack() {
    $this->instance->rollBack();
  }

  /*
   * Formata a mensagem
   * @return
   */

  private function preparaMens($query) {
    $pdoErro = $this->instance->errorInfo();
    $mensErro = "Mensagem de " . strtolower($pdoErro[2]);
    $mensErro .= " - erro nº: (" . $pdoErro[0];
    $mensErro .= ") - query executada: " . $query;
    $mensErro = $mensErro;
    return $mensErro;
  }

}

?>