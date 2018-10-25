<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
        <link rel="stylesheet" href="{$WWW_CSS}report.css" type="text/css" media="screen" charset="ISO-8859-1" />
        <link rel="stylesheet" type="text/css" href="{$WWW_CSS}reportPrint.css" media="print" />
    </head>
    <body>
        <div class="boxFiltro">
            <br/>
            <form action="?pagina=centraldecontrole/imprimirNoticias" method="post" class="form-inline">
                <div class="form-group">
                    <label class="sr-only">Data</label>
                    <input type="text" style="width:80px;" name="inputDataInicial" id="inputDataInicial" value="{$sDataInicial}" /> à
                    <input type="text" style="width:80px;" name="inputDataFinal" id="inputDataFinal" value="{$sDataFinal}"/> 
                </div>
                <input type="submit" class="btn btn-default" name="inputFiltrar" id="inputFiltrar" value="Filtrar"/> 
            </form>
            <a class="btn btn-primary" href='javascript:window.print();'>
                <i class="icon-print icon-white"></i> Imprimir
            </a>    
        </div>
        <br/>
        <div class="boxBody" >
            {if $sExibeRelatorio==true}
                <div class="topo">
                    <div class="boxTop" style="float:left">
                    <img src="{$WWW_IMG}topo/logo-site.png" alt="{$sNomeSite}" title="{$sNomeSite}"  style="max-width:180px;max-height:60px;"/>
                    </div>
                    <div class="boxTop cabecalho" style="float:left;width:450px;margin-left:20px;">
                        <h1>Relatório de Notícias</h1>
                    </div>  
                    <div class="boxTop left" style="float:left;width:50px;height:80px">
                        <span></span>
                        <p class="tright">{$smarty.now|date_format:"d/m/Y"}</p>
                    </div>
                </div>
                <br class="clear"/>
                {foreach $arrObjArtigo as $oArtigo}
                    <div class="repetidor {if $oArtigo@last}no-border{/if} ">
                        <h5>{$oArtigo->sDataCadastro|date_format:"%d/%m/%Y"}</h5>
                        <h2>{$oArtigo->sTitulo}</h2>
                        <h3>{$oArtigo->sResumo}</h3>
                        <img src="{$oArtigo->sUrlImagem}"/>
                        <h4>{$oArtigo->sConteudo}</h4>
                    </div>
                {/foreach}
              
            {/if}
            <br class="clear" />
        </div>
        <script type="text/javascript" src="{$WWW_JS}jquery.maskedinput.js"></script>
        <script type="text/javascript" >
            $(document).ready(function(){  
                $(function(){  
                    $("#inputDataInicial").mask("99/99/9999");   
                    $("#inputDataFinal").mask("99/99/9999"); 
                });  
            });  
            //$('#inputDataInicial').datepicker();
            //$('#inputDataFinal').datepicker();
        </script>
    </body>
</html>