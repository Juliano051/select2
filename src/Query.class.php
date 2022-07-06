<?php
include_once './src/db/conexaoSAHV.class.php';
include_once './src/util/rotinas.inc.php';

class Query
{
    public static function getAll()
    {
        $con = ConexaoSAHV::getInstance();
        $sql = "
            SELECT cpf, nome, valor_pago, rua, numero, bairro, cidade, uf, telefone, telefone_whatsapp, cep, complemento, codigo_banco, agencia, conta, nome_do_banco
            FROM sahv.tbdvtaxa;
        ";

        $result = $con->execSql($sql);
        return $result;
    }

    public static function getPessoa($cpf)
    {

        $result = null;

        if (trim($cpf) != '') {
            $con = ConexaoSAHV::getInstance();
            $sql = "
                SELECT cpf, nome, valor_pago, rua, numero, bairro, cidade, uf, telefone, email, telefone_whatsapp, cep, complemento, codigo_banco, agencia, conta, nome_do_banco
                FROM sahv.tbdvtaxa
                WHERE cpf = " . formatBanco($cpf, 'n') . " ";

            $result = $con->execSql($sql);
            $result = $result[0];
        }

        return $result;
    }

    public static function salvar($cpf, $rua, $numero, $complemento, $bairro, $cidade, $uf, $cep, $telefone, $telefoneWhatsapp, $email, $bancoCodigo, $bancoNome, $agencia, $conta)
    {
        $con = ConexaoSAHV::getInstance();

        $sql = "
            UPDATE sahv.tbdvtaxa
            SET 
              rua=" . formatBanco($rua, 's') . ",
              numero=" . formatBanco($numero, 's') . ",
              complemento=" . formatBanco($complemento, 's') . ",  
              bairro=" . formatBanco($bairro, 's') . ", 
              cidade=" . formatBanco($cidade, 's') . ", 
              uf=" . formatBanco($uf, 's') . ",
              cep=" . formatBanco($cep, 's') . ",
              telefone=" . formatBanco($telefone, 's') . ", 
              telefone_whatsapp=" . formatBanco($telefoneWhatsapp, 's') . ",
              email =" . formatBanco($email, 's') . ",
              codigo_banco=" . formatBanco($bancoCodigo, 'n') . ",
              nome_do_banco=" . formatBanco($bancoNome, 's') . ", 
              agencia=" . formatBanco($agencia, 's') . ", 
              conta=" . formatBanco($conta, 's') . "              
            WHERE cpf = " . formatBanco($cpf, 'n') . " 
        ";
        return $con->execUpdate($sql);
    }
}
