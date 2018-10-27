<?php

class GrupoDB
{
    
    private static $mArrCampos = '';
    private static $mArrJoin   = '';
    private static $sOrdem     = 'Grupo_lng_Codigo';
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
    
    public static function pesquisaGrupoLista( )
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
                           FROM Grupo
                           WHERE 1 = 1 ".$sFiltros."                       
                           ORDER BY ".self::$sOrdem."
                           ".$sLimite."
                         ");  

//        echo $mResultado->queryString;
        $mResultado->execute();

        $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
        
         /* Instancia o Objeto */
        $arrObjGrupo = [];
        
        if (is_array($mArrDados))
        { 
            for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
            {
                 $oGrupo = [
                    'Grupo_lng_Codigo'  => $mArrDados[$a]['Grupo_lng_Codigo'],
                    'Grupo_vch_Nome'    => utf8_encode($mArrDados[$a]['Grupo_vch_Nome']),
                    'Grupo_vch_Horario' => $mArrDados[$a]['Grupo_vch_Horario'],
                    'Usuario_lng_Codigo'=> $mArrDados[$a]['Usuario_lng_Codigo'],
                    'Periodo_lng_Codigo'=> $mArrDados[$a]['Periodo_lng_Codigo'],
                 ];

                 $arrObjGrupo[] = $oGrupo;
            }
        } 
        return $arrObjGrupo;
    }
    
    public static function pesquisaGrupo( $tipo = false )
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
                           FROM Grupo
                           ".$sJoin."
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        
        $mResultado->execute();
        
        $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
        ;
         /* Instancia o Objeto */
      
        if (is_array($mArrDados))
        {          
            $oGrupo = [
                'Grupo_lng_Codigo'  => $mArrDados[$a]['Grupo_lng_Codigo'],
                'Grupo_vch_Nome'    => utf8_encode($mArrDados[$a]['Grupo_vch_Nome']),
                'Grupo_vch_Horario' => $mArrDados[$a]['Grupo_vch_Horario'],
                'Usuario_lng_Codigo'=> $mArrDados[$a]['Usuario_lng_Codigo'],
                'Periodo_lng_Codigo'=> $mArrDados[$a]['Periodo_lng_Codigo'],
             ];
        }
        
        return $oGrupo;     
    }

    public static final function alteraGrupo( $oGrupo )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Grupo SET
                    Grupo_vch_Nome       = :nome,
                    Grupovch_Horario      = :horario,
                    Usuario_lng_Codigo  = :usuario,
                    Periodo_lng_Codigo  = :periodo
                    WHERE Grupo_lng_Codigo = :codigo " );
 
        $sSql->bindParam(':codigo',   ($oGrupo->Grupo_lng_Codigo));
        $sSql->bindParam(':nome',   ($oGrupo->Grupo_vch_Nome));
        $sSql->bindParam(':horario',  ($oGrupo->Grupo_vch_Horario));
        $sSql->bindParam(':periodo',     ($oGrupo->Periodo_lng_Codigo));
        $sSql->bindParam(':usuario',  ($oGrupo->Usuario_lng_Codigo));
        
        $sSql->execute();
    }
    
    public static final function salvaGrupo( $oGrupo )
    { 
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("INSERT INTO Grupo (
                    Grupo_vch_Nome,
                    Grupo_vch_Horario,
                    Usuario_lng_Codigo,
                    Periodo_lng_Codigo
                    ) VALUES ( ?,?,?,? )"); 
        
        $sSql->bindParam(1,   ($oGrupo->Grupo_vch_Nome));
        $sSql->bindParam(2,  ($oGrupo->Grupo_vch_Horario));
        $sSql->bindParam(3,     ($oGrupo->Periodo_lng_Codigo));
        $sSql->bindParam(4,  ($oGrupo->Usuario_lng_Codigo));
        $sSql->execute();
        
        return $oConexao->lastInsertId(); 
        //$sSql->debugDumpParams(); 
    }
    
    public static final function excluiGrupo( $iCodigo  )
    {
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("DELETE FROM Grupo 
                    WHERE Grupo_lng_Codigo = :codigo ");
       
        $sSql->bindParam(':codigo',$iCodigo, PDO::PARAM_INT);   
        $sSql->execute();
    }
 
}

?>