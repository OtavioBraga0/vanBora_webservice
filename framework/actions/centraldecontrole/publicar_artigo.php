<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/artigo/artigo');
Controller::loadClass('site/artigo/artigoDB');
Controller::loadClass('site/tag/tag');
Controller::loadClass('site/tag/tagDB');
Controller::loadClass('site/artigoTipo/artigoTipo');
Controller::loadClass('site/artigoTipo/artigoTipoDB');
Controller::loadClass('site/artigoTag/artigoTag');
Controller::loadClass('site/artigoTag/artigoTagDB');
Controller::loadClass('site/album/album');
Controller::loadClass('site/album/albumDB');
Controller::loadClass('site/foto/foto');
Controller::loadClass('site/foto/fotoDB');

Controller::loadClass('core/util');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oArtigo = new Artigo();
TagDB::setaOrdem('Tag_vch_Descricao');
$arrObjTag   = TagDB::pesquisaTagLista();
$arrObjAlbum = AlbumDB::pesquisaAlbumLista();

if ( isset ( $_GET['codigo'] ) )
{
    ArtigoDB::setaFiltro(' AND Artigo_lng_Codigo = '.$_GET['codigo']);
    $oArtigo = ArtigoDB::pesquisaArtigo();
}

if ( isset( $_GET['tipo'] ) )
{
    ArtigoTipoDB::setaFiltro( ' AND Tipo_lng_Codigo = '.$_GET['tipo'] );
    $oArtigoTipo = ArtigoTipoDB::pesquisaArtigoTipo();

    $oArtigo->oArtigoTipo = $oArtigoTipo;
}
//else
//
    //ArtigoTipoDB::setaFiltro( ' AND Tipo_lng_Codigo = '.$oArtigo->iCodigoTipo );
   // $oArtigoTipo = ArtigoTipoDB::pesquisaArtigoTipo();

    //$oArtigo->oArtigoTipo = $oArtigoTipo;
//}

//$arrObjArtigoTipo = ArtigoTipoDB::pesquisaArtigoTipoLista();

if ( isset ( $_POST ['inputSalvarArtigo'] ) )
{
    $sDestaque         = (isset($_POST['inputDestaque'])) ? 'S' : 'N';
    $sOcultarMiniatura = (isset($_POST['inputOcultarMiniatura'])) ? 'S' : 'N';
    $sAno              = (isset($_POST['inputAno'])) ? $_POST['inputAno'] : NULL;
    $iCodigoAlbum      = ($_POST['inputAlbum'] <> '-') ? $_POST['inputAlbum'] : NULL;
    $sCarrossel        = (isset($_POST['inputCarrossel'])) ? 'S' : 'N';

    $oArtigoTipo = new ArtigoTipo();
    $oAlbum      = new Album();

    $oArtigoTipo->iCodigo = $_POST['inputTipo'];
    $oAlbum->iCodigo      = $iCodigoAlbum;

    if ($_POST['inputAgenda'] !== "") {
        $oArtigo->sAgenda   = Util::converterDataParaMysql($_POST['inputAgenda']);
        $oArtigo->sAgenda = $oArtigo->sAgenda.' '.$_POST['inputHoraAgenda'];
    }
    else {
        $oArtigo->sAgenda = null;
    }


    $oArtigo->sDataCadastro = date( 'Y-m-d H:i:s' );
    $oArtigo->iCodigo        = $_POST['inputCodigo'];
    $oArtigo->sTitulo        = $_POST['inputTitulo'];
    $oArtigo->sConteudo      = $_POST['inputConteudo'];
    $oArtigo->iCodigoUsuario = $_SESSION['CODIGO'];
    $oArtigo->iCodigoUsuario = $_SESSION['CODIGO'];
    $oArtigo->sDataAlteracao = date( 'Y-m-d H:i:s' );
    $oArtigo->sDestaque      = $sDestaque;
    $oArtigo->sAtivo         = $_POST['inputAtivo'];
    $oArtigo->sOcultarMiniatura = $sOcultarMiniatura;
    $oArtigo->sCarrossel     = $sCarrossel;
    $oArtigo->sCredito       = $_POST['inputCredito'];
    $oArtigo->sResumo        = $_POST['inputResumo'];

    if ($_FILES['inputiniatura']['name'] != '') {

        if (!file_exists('images/fotosAlbuns')) {
            mkdir('fotosAlbuns');
        }

        move_uploaded_file($_FILES['inputMiniatura']['tmp_name'], 'images/fotosAlbuns/' . $_FILES['inputMiniatura']['name']);

    }
    move_uploaded_file($_FILES['inputMiniatura']['tmp_name'], 'images/fotosAlbuns/' . $_FILES['inputMiniatura']['name']);

	if($_FILES['inputMiniatura']['name'] != ''){
		$oArtigo->sUrlImagem= $_FILES['inputMiniatura']['name'];
	}
	else {
		$oArtigo->sUrlImagem= $_POST['inputMiniaturaVazio'];
	}

    $oArtigo->oArtigoTipo    = $oArtigoTipo;
    $oArtigo->oAlbum         = $oAlbum;
    $oArtigo->sAno           = $sAno;
    $oArtigo->sLink          = date('Y-m-d').Util::formataUrl($oArtigo->sTitulo);
    $oArtigo->sFonteDescricao = $_POST['inputFonteDescricao'];
    $oArtigo->sFonteUrl       = $_POST['inputFonteUrl'];

    if ( isset ( $_POST['inputData'] ) )
    {
        $sData = explode('/', $_POST['inputData']);

        $oArtigo->sDia = $sData[0];
        $oArtigo->sMes = $sData[1];
    }


    if ($sDestaque == 'S')
    {

        $sLinkPortal = '';
        if ($oArtigo->iCodigo != '')
        {
            $sLinkPortal = $_POST['inputLink'];
            //$oArtigo->sLink = $oArtigo->iCodigo;
        }
        else
        {
            $sLinkPortal = 'artigo/'.$oArtigo->sLink.'.html';
            //$oArtigo->sLink = '2';
        }

        /* Carrega o NUSOAP*/
        Controller::loadClass('core/nusoap');

        // Cria uma inst�ncia do cliente
        $oClient = new nusoap_client('http://santuariosdobrasil.com/webservice/noticia.php?wsdl', true);

        // verifica se ocorreu erro na cria��o do objeto
        $sErro = $oClient->getError();

        if ($sErro)
        {
            echo "Erro no construtor<pre>".$sErro."</pre>";
        }

        // chamada do m�todo SOAP
        $mArrDados = $oClient->call ( 'insereNoticia',array( 'ame%@1', addslashes($oArtigo->sTitulo), addslashes($oArtigo->sResumo), $sLinkPortal, $oArtigo->sUrlImagem, Config::SITE_CODIGO) );

        /*if ($oClient->fault)
        {
                echo "Falha<pre>".print_r($mArrDados)."</pre>";
        }
        else
        {
            // Verifica se ocorreu erro
            $err = $oClient->getError();

            if ($err)
            {
                echo "Erro<pre>".$err."</pre>";
            }
            else
            {
                VAR_DUMP ( $mArrDados );
            }
        }*/
    }

    if ( $oArtigo->iCodigo == '')
    {
        if ( $_SESSION['PERMISSOES']['ADICIONAR_ARTIGO'] == 'S' )
        {
            $oArtigo->iCodigo = ArtigoDB::salvaArtigo($oArtigo);

            if ( isset ( $_POST['inputTag'] ) )
            {
                foreach ( $_POST['inputTag'] as $iCodigoTag )
                {
                    ArtigoTagDB::salvaArtigoTag($oArtigo->iCodigo, $iCodigoTag);
                }
            }
        }
    }
    else
    {
        if ( $_SESSION['PERMISSOES']['EDITAR_ARTIGO'] == 'S' )
        {
            ArtigoTagDB::excluiArtigoTag($oArtigo->iCodigo);
            ArtigoDB::alteraArtigo($oArtigo);

            if ( isset ( $_POST['inputTag'] ) )
            {
                foreach ( $_POST['inputTag'] as $iCodigoTag )
                {
                    ArtigoTagDB::salvaArtigoTag($oArtigo->iCodigo, $iCodigoTag);
                }
            }
        }
    }

    if ( $_POST ['inputSalvarArtigo'] == 'Salvar' )
    {
        header('Location: ?pagina=centraldecontrole/inicial');
    }
    elseif ( $_POST ['inputSalvarArtigo'] == 'Salvar e Novo' )
    {
        header("Location: ?pagina=centraldecontrole/publicar_artigo&tipo=".$_GET['tipo']);
    }

}

/* Define P�gina/Template a ser executado */
$oTemplate->assign ('oArtigo', $oArtigo );
$oTemplate->assign ('arrObjTag', $arrObjTag );
$oTemplate->assign ('arrObjAlbum', $arrObjAlbum );

$oTemplate->assign ('sMenu', 'layout' );
$oTemplate->assign ('sPagina', 'postagens' );

$oTemplate->display('centraldecontrole/publicar_artigo.tpl');


//echo '<pre>';

?>