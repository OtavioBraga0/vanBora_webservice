<?php

class UsuarioDB
{
    
    private static $mArrCampos = '';
    private static $mArrJoin   = '';
    private static $sOrdem     = 'Usuario_lng_Codigo';
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
    
    public static function pesquisaUsuarioLista( )
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
                           FROM Usuario
                           WHERE 1 = 1 ".$sFiltros."                       
                           ORDER BY ".self::$sOrdem."
                           ".$sLimite."
                         ");  

//        echo $mResultado->queryString;
        $mResultado->execute();

        $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
        
         /* Instancia o Objeto */
        $arrObjUsuario = [];
        
        if (is_array($mArrDados))
        { 
            for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
            {
                 $oUsuario = [
                    'Usuario_lng_Codigo' => $mArrDados[$a]['Usuario_lng_Codigo'],
                    'Usuario_vch_Nome' => $mArrDados[$a]['Usuario_vch_Nome'],
                    'Usuario_dat_DataNascimento' => $mArrDados[$a]['Usuario_dat_DataNascimento'],
                    'Usuario_vch_Endereco' => $mArrDados[$a]['Usuario_vch_Endereco'],
                    'Usuario_vch_Numero' => $mArrDados[$a]['Usuario_vch_Numero'],
                    'Usuario_vch_Complemento' => $mArrDados[$a]['Usuario_vch_Complemento'],
                    'Usuario_vch_Celular' => $mArrDados[$a]['Usuario_vch_Celular'],
                    'Usuario_chr_Tipo' => $mArrDados[$a]['Usuario_chr_Tipo']
                 ];

                 $arrObjUsuario[] = $oUsuario;
            }
        } 
        return $arrObjUsuario;
    }
    
    public static function pesquisaUsuario( $tipo = false )
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
                           FROM Usuario
                           ".$sJoin."
                           WHERE 1 = 1 ".$sFiltros."                       
                         ");  
        
        $mResultado->execute();
        
        $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
      
        if (is_array($mArrDados))
        {          
            $oUsuario = [
                'Usuario_lng_Codigo' => $mArrDados['Usuario_lng_Codigo'],
                'Usuario_vch_Nome' => $mArrDados['Usuario_vch_Nome'],
                'Usuario_dat_DataNascimento' => $mArrDados['Usuario_dat_DataNascimento'],
                'Usuario_vch_Endereco' => $mArrDados['Usuario_vch_Endereco'],
                'Usuario_vch_Numero' => $mArrDados['Usuario_vch_Numero'],
                'Usuario_vch_Complemento' => $mArrDados['Usuario_vch_Complemento'],
                'Usuario_vch_Celular' => $mArrDados['Usuario_vch_Celular'],
                'Usuario_chr_Tipo' => $mArrDados['Usuario_chr_Tipo']
             ];
        }
        
        return $oUsuario;     
    }

    public static final function alteraUsuario( $oUsuario )
    {                 
        $oConexao = db::conectar();
        
        $sSql=$oConexao->prepare("UPDATE Usuario SET
                        Usuario_vch_Nome = :nome,
                        Usuario_dat_DataNascimento = :data,
                        Usuario_vch_Endereco = :endereco,
                        Usuario_vch_Numero = :numero,
                        Usuario_vch_Complemento = :complemento,
                        Usuario_vch_Celular = :celular,
                        Usuario_chr_Tipo = :tipo
                    WHERE Usuario_lng_Codigo = :codigo " );
 
        $sSql->bindParam(':codigo',   ($oUsuario->Usuario_lng_Codigo));
        $sSql->bindParam(':nome',   ($oUsuario->Usuario_vch_Nome));
        $sSql->bindParam(':data',  ($oUsuario->Usuario_dat_DataNascimento));
        $sSql->bindParam(':endereco',  ($oUsuario->Usuario_vch_Endereco));
        $sSql->bindParam(':numero',     ($oUsuario->Usuario_vch_Numero));
        $sSql->bindParam(':complemento',  ($oUsuario->Usuario_vch_Complemento));
        $sSql->bindParam(':celular',  ($oUsuario->Usuario_vch_Celular));
        $sSql->bindParam(':tipo',  ($oUsuario->Usuario_chr_Tipo));
        
        $sSql->execute();
    }
    
    public static final function salvaUsuario( $oUsuario )
    { 
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("INSERT INTO Usuario (
                    Usuario_vch_Nome,
                    Usuario_dat_DataNascimento,
                    Usuario_vch_Endereco,
                    Usuario_vch_Numero,
                    Usuario_vch_Complemento,
                    Usuario_vch_Celular,
                    Usuario_chr_Tipo
                    ) VALUES ( ?,?,?,?,?,?,? )"); 
        
        $sSql->bindParam(1,   ($oUsuario->Usuario_vch_Nome));
        $sSql->bindParam(2,  ($oUsuario->Usuario_dat_DataNascimento));
        $sSql->bindParam(3,  ($oUsuario->Usuario_vch_Endereco));
        $sSql->bindParam(4,     ($oUsuario->Usuario_vch_Numero));
        $sSql->bindParam(5,  ($oUsuario->Usuario_vch_Complemento));
        $sSql->bindParam(6,  ($oUsuario->Usuario_vch_Celular));
        $sSql->bindParam(7,  ($oUsuario->Usuario_chr_Tipo));
        $sSql->execute();
        
        return $oConexao->lastInsertId(); 
    }
    
    public static final function excluiUsuario( $iCodigo  )
    {
        $oConexao = db::conectar();
        
        $sSql = $oConexao->prepare("DELETE FROM Usuario 
                    WHERE Usuario_lng_Codigo = :codigo ");
       
        $sSql->bindParam(':codigo',$iCodigo, PDO::PARAM_INT);   
        $sSql->execute();
    }  
 
}

?>