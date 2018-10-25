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
                //Limpa Filtros
                self::$mArrCampos['CONDICAO'] = '';
            }
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
                           Grupo_lng_Codigo,
                           Grupo_vch_Nome,
                           Grupo_vch_Horario,
                           Usuario_lng_Codigo
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
                    'Grupo_vch_Nome'    => $mArrDados[$a]['Grupo_vch_Nome'],
                    'Grupo_vch_Horario' => $mArrDados[$a]['Grupo_vch_Horario'],
                    'Usuario_lng_Codigo'=> $mArrDados[$a]['Usuario_lng_Codigo']
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
        
        // Define os Filtros
        if (isset(self::$mArrCampos['CONDICAO']))
        {
            for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
            {
                $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
            }
            //Limpa Filtros
            self::$mArrCampos['CONDICAO'] = '';
        }
             
        $mResultado = $oConexao->prepare("SELECT
                           Grupo_lng_Codigo,
                           Grupo_vch_Titulo,
                           Grupo_chr_Visivel,
                           Grupo_vch_Credito,
                           Grupo_Tipo_lng_Codigo,
                           Grupo_vch_Tipo
                           FROM Grupo
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        
        $mResultado->execute();
        
        $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
        ;
         /* Instancia o Objeto */
        $oGrupo = new Grupo;
      
        if (is_array($mArrDados))
        {          
           $oGrupo->iCodigo  = $mArrDados['Grupo_lng_Codigo'];
           $oGrupo->sTitulo  = utf8_encode($mArrDados['Grupo_vch_Titulo']);
           $oGrupo->sVisivel = $mArrDados['Grupo_chr_Visivel'];
           $oGrupo->sCredito = utf8_encode($mArrDados['Grupo_vch_Credito']);
           $oGrupo->sTipo = $mArrDados['Grupo_vch_Tipo'];
           
           if ($tipo == true)
           {
               GrupoTipoDB::setaFiltro(" AND Grupo_Tipo_lng_Codigo = ".$mArrDados['Grupo_Tipo_lng_Codigo']);
               $oGrupoTipo = GrupoTipoDB::pesquisaGrupoTipo();
               $oGrupo->oGrupoTipo = $oGrupoTipo;
           }
           
           FotoDB::setaFiltro(" AND Grupo_lng_Codigo = $oGrupo->iCodigo");
           $arrObjFoto = FotoDB::pesquisaFotoLista();
           
           $oGrupo->arrObjFoto = $arrObjFoto;
        }
        
        return $oGrupo;     
    }
    
    public static function pesquisaGrupoJson( $tipo = false )
    {
        $oConexao = db::conectar();
        
        $sFiltros = '';
        
        // Define os Filtros
        if (isset(self::$mArrCampos['CONDICAO']))
        {
            for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
            {
                $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
            }
            //Limpa Filtros
            self::$mArrCampos['CONDICAO'] = '';
        }
             
        $mResultado = $oConexao->prepare("SELECT
                           Grupo_lng_Codigo,
                           Grupo_vch_Titulo,
                           Grupo_chr_Visivel,
                           Grupo_vch_Credito,
                           Grupo_Tipo_lng_Codigo,
                           Grupo_vch_Tipo
                           FROM Grupo
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        
        $mResultado->execute();
        
        $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
        
      
        if (is_array($mArrDados))
        {          
           $oGrupo->iCodigo  = $mArrDados['Grupo_lng_Codigo'];
           $oGrupo->sTitulo  = utf8_encode($mArrDados['Grupo_vch_Titulo']);
           $oGrupo->sVisivel = $mArrDados['Grupo_chr_Visivel'];
           $oGrupo->sCredito = utf8_encode($mArrDados['Grupo_vch_Credito']);
           $oGrupo->sTipo = $mArrDados['Grupo_vch_Tipo'];
           
           FotoDB::setaFiltro(" AND Grupo_lng_Codigo = $oGrupo->iCodigo");
           $arrObjFoto = FotoDB::pesquisaFotoListaJson();

           $oGrupo = array(
                'iCodigo'  => $mArrDados['Grupo_lng_Codigo'],
                'sTitulo'  => utf8_encode($mArrDados['Grupo_vch_Titulo']),
                'sVisivel' => $mArrDados['Grupo_chr_Visivel'],
                'sCredito' => utf8_encode($mArrDados['Grupo_vch_Credito']),
                'sTipo' => $mArrDados['Grupo_vch_Tipo'],
                'arrObjFoto' => $arrObjFoto
           );
        }
        
        return $oGrupo;     
    }

    public static final function alteraGrupo( $oGrupo )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Grupo SET
                    Grupo_vch_Titulo       = :titulo,
                    Grupo_chr_Visivel      = :visivel,
                    Grupo_vch_Credito      = :credito,
                    Grupo_Tipo_lng_Codigo  = :Grupo_tipo,
                    Grupo_vch_Tipo         = :tipo
                    WHERE Grupo_lng_Codigo = :codigo " );
 
        $sSql->bindParam(':codigo',   ($oGrupo->iCodigo));
        $sSql->bindParam(':titulo',   ($oGrupo->sTitulo));
        $sSql->bindParam(':visivel',  ($oGrupo->sVisivel));
        $sSql->bindParam(':credito',  ($oGrupo->sCredito));
        $sSql->bindParam(':tipo',     ($oGrupo->sTipo));
        $sSql->bindParam(':Grupo_tipo',  ($oGrupo->oGrupoTipo->iCodigo));
        
        $sSql->execute();
    }
    
    public static final function salvaGrupo( $oGrupo )
    { 
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("INSERT INTO Grupo (
                    Grupo_vch_Titulo,
                    Grupo_chr_Visivel,
                    Grupo_vch_Credito,
                    Grupo_Tipo_lng_Codigo,
                    Grupo_vch_Tipo
                    ) VALUES ( ?,?,?,?,? )"); 
        
        $sSql->bindParam(1, ($oGrupo->sTitulo));
        $sSql->bindParam(2, ($oGrupo->sVisivel));
        $sSql->bindParam(3, ($oGrupo->sCredito));
        $sSql->bindParam(4, ($oGrupo->oGrupoTipo->iCodigo));
        $sSql->bindParam(5, ($oGrupo->sTipo));
        $sSql->execute();
        
        return $oConexao->lastInsertId(); 
        //$sSql->debugDumpParams(); 
    }
    
        
    public static final function alteraCapa( $oGrupo )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Grupo SET
                    Foto_lng_Codigo      = :GrupoCodigo
                    WHERE Grupo_lng_Codigo = :fotoCodigo " );
        //var_dump($sSql);
        $sSql->bindParam(':GrupoCodigo', ($oGrupo->iCodigo));
        $sSql->bindParam(':fotoCodigo',  ($oGrupo->iFotoCodigo));
        
        $sSql->execute();
    }
    
    public static final function excluiGrupo( $iCodigo  )
    {
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("DELETE FROM Grupo 
                    WHERE Grupo_lng_Codigo = :codigo ");
       
        $sSql->bindParam(':codigo',$iCodigo, PDO::PARAM_INT);   
        $sSql->execute();
    }
    
    public static final function contaGrupo( )
    {
        $oConexao = db::conectar();
        
        $sFiltros = '';
        $sJoin    = '';
        
        // Define os Filtros
        if (isset(self::$mArrCampos['CONDICAO']))
        {
            for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
            {
                $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
            }
            //Limpa Filtros
            //self::$mArrCampos['CONDICAO'] = '';
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
            //self::$mArrJoin['JOIN'] = '';
        }
             
        $mResultado = $oConexao->prepare("SELECT
                           count(*)
                           FROM Grupo
                           ".$sJoin."
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        //echo $mResultado->queryString;
        $mResultado->execute();
        
        $iTotal = $mResultado->fetchColumn();
        
        return $iTotal;     
    }
    
 
}

?>