<?php

class AlunoDB
{
    
    private static $mArrCampos = '';
    private static $mArrJoin   = '';
    private static $sOrdem     = 'Aluno_lng_Codigo';
    private static $iLimite = 0;
    private static $iInicio = 0;
    
    public static function setaFiltro($sArgCampo)
    {
        self::$mArrCampos['CONDICAO'][] = $sArgCampo;
    }
    
    public static function setaJoin($sArgJoin)
    {
        self::$mArrJoin['JOIN'][] = $sArgJoin;
    }
    
    public static function setaOrdem($sArgOrdem)
    {
        self::$sOrdem = $sArgOrdem;
    }
    
    public static final function setaLimite($iArgLimite, $iArgInicio = 0)
    {
        self::$iLimite = $iArgLimite;
        self::$iInicio = $iArgInicio;
    }
    
    public static function pesquisaAlunoLista( )
    {
        $oConexao = db::conectar();
        
        $sFiltros = '';
        $sJoin = '';
        $sLimite  = '';

        // Define os Filtros
        if (isset(self::$mArrCampos['CONDICAO']))
        {
            if ( self::$mArrCampos['CONDICAO'] <> '' )
            {
                for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
                {
                    $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
                }
            }
            //Limpa Filtros
            self::$mArrCampos['CONDICAO'] = '';
        }

        // Define os Joins
        if (isset(self::$mArrJoin['JOIN']))
        {
            if ( self::$mArrJoin['JOIN'] <> '' )
            {
                for ($a = 0, $iCount = count(self::$mArrJoin['JOIN']); $a < $iCount; ++$a)
                {
                    $sJoin .= (self::$mArrJoin['JOIN'][$a]);
                }
            }
            //Limpa Filtros
            self::$mArrJoin['JOIN'] = '';
        }

        /* Define o Limite */
        if (self::$iLimite > 0)
        {
            $sLimite = (' LIMIT '.self::$iInicio.",".self::$iLimite);

            //Limpa Filtro
            self::$iInicio = 0;
            self::$iLimite = 0;
        }
             
        $mResultado = $oConexao->prepare("SELECT
                           *
                           FROM Aluno
                           ".$sJoin."
                           WHERE 1 = 1 ".$sFiltros."                       
                           ORDER BY ".self::$sOrdem."
                           ".$sLimite."
                         ");  

    //    echo $mResultado->queryString;
        $mResultado->execute();

        $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
        
         /* Instancia o Objeto */
        $arrObjAluno = [];
        
        if (is_array($mArrDados))
        { 
            for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
            {
                 $oAluno = [
                    'Aluno_lng_Codigo'      => $mArrDados[$a]['Aluno_lng_Codigo'],
                    'Grupo_lng_Codigo'      => $mArrDados[$a]['Grupo_lng_Codigo'],
                    'Usuario_lng_Codigo'    => $mArrDados[$a]['Usuario_lng_Codigo'],
                    'Aluno_chr_Confirmacao' => $mArrDados[$a]['Aluno_chr_Confirmacao'],
                    'Usuario_vch_Nome'      => utf8_encode($mArrDados[$a]['Usuario_vch_Nome']),
                 ];

                 $arrObjAluno[] = $oAluno;
            }
        } 
        return $arrObjAluno;
    }
    
    public static function pesquisaAluno( $tipo = false )
    {
        $oConexao = db::conectar();
        
        $sFiltros = '';
        $sJoin = '';
        $sLimite  = '';

        // Define os Filtros
        if (isset(self::$mArrCampos['CONDICAO']))
        {
            if ( self::$mArrCampos['CONDICAO'] <> '' )
            {
                for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
                {
                    $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
                }
            }
            //Limpa Filtros
            self::$mArrCampos['CONDICAO'] = '';
        }

        // Define os Joins
        if (isset(self::$mArrJoin['JOIN']))
        {
            if ( self::$mArrJoin['JOIN'] <> '' )
            {
                for ($a = 0, $iCount = count(self::$mArrJoin['JOIN']); $a < $iCount; ++$a)
                {
                    $sJoin .= (self::$mArrJoin['JOIN'][$a]);
                }
            }
            //Limpa Filtros
            self::$mArrJoin['JOIN'] = '';
        }

        /* Define o Limite */
        if (self::$iLimite > 0)
        {
            $sLimite = (' LIMIT '.self::$iInicio.",".self::$iLimite);

            //Limpa Filtro
            self::$iInicio = 0;
            self::$iLimite = 0;
        }
             
        $mResultado = $oConexao->prepare("SELECT
                           *
                           FROM Aluno
                           ".$sJoin."
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        
        $mResultado->execute();
        
        $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
        ;
         /* Instancia o Objeto */
      
        if (is_array($mArrDados))
        {          
            $oAluno = [
                'Aluno_lng_Codigo' => $mArrDados[0]['Aluno_lng_Codigo'],
                'Grupo_lng_Codigo' => $mArrDados[0]['Grupo_lng_Codigo'],
                'Usuario_lng_Codigo' => $mArrDados[0]['Usuario_lng_Codigo'],
                'Aluno_chr_Confirmacao' => $mArrDados[0]['Aluno_chr_Confirmacao'],
                'Usuario_vch_Nome'      => utf8_encode($mArrDados[$a]['Usuario_vch_Nome'])
             ];
        }
        
        return $oAluno;     
    }

    public static final function alteraAluno( $oAluno )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Aluno SET
                    Grupo_lng_Codigo = :grupo,
                    Usuario_lng_Codigo = :usuario,
                    Aluno_chr_Confirmacao = :confirmacao,
                    WHERE Aluno_lng_Codigo = :codigo " );
 
        $sSql->bindParam(':codigo',   ($oAluno->Aluno_lng_Codigo));
        $sSql->bindParam(':grupo',   ($oAluno->Grupo_lng_Codigo));
        $sSql->bindParam(':usuario',  ($oAluno->Usuario_lng_Codigo));
        $sSql->bindParam(':confirmacao',  ($oAluno->Aluno_chr_Confirmacao));
        
        $sSql->execute();
    }
    
    public static final function alteraResposta( $oAluno )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Aluno SET
                    Aluno_chr_Confirmacao = :confirmacao
                    WHERE Grupo_lng_Codigo = :grupo
                    AND Usuario_lng_Codigo = :usuario " );
 
        $sSql->bindParam(':grupo',   ($oAluno->Grupo_lng_Codigo));
        $sSql->bindParam(':usuario',  ($oAluno->Usuario_lng_Codigo));
        $sSql->bindParam(':confirmacao',  ($oAluno->Aluno_chr_Confirmacao));
        
        $sSql->execute();
    }

    public static final function salvaAluno( $oAluno )
    { 
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("INSERT INTO Aluno (
                    Grupo_lng_Codigo,
                    Usuario_lng_Codigo,
                    Aluno_chr_Confirmacao
                    ) VALUES ( ?,?,? )"); 
        
        $sSql->bindParam(1,  ($oAluno->Grupo_lng_Codigo));
        $sSql->bindParam(2,  ($oAluno->Usuario_lng_Codigo));
        $sSql->bindParam(3,  ($oAluno->Aluno_chr_Confirmacao));
        $sSql->execute();
        
        return $oConexao->lastInsertId(); 
        //$sSql->debugDumpParams(); 
    }
    
    public static final function excluiAluno( $iCodigo  )
    {
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("DELETE FROM Aluno 
                    WHERE Aluno_lng_Codigo = :codigo ");
       
        $sSql->bindParam(':codigo',$iCodigo, PDO::PARAM_INT);   
        $sSql->execute();
    }
  
 
}

?>