<?php

require_once("./src/db/conexaoDataSource.class.php");

/**
 * Classe de conexao com o banco
 * DataSource: SAHV
 */
class ConexaoSAHV extends ConexaoDataSource {

  /* @var $instance ConexaoDataSource */
  static private $instance; // Guarda uma instancia da classe

  /**
   * Metodo do padrao de projeto Singleton
   * return ConexaoDataSource
   */
  static public function getInstance() {

    if (!isset(self::$instance)) {

      self::$instance = new ConexaoDataSource('DSSAHV01');

    }
    return self::$instance;
  }

//getInstance
}