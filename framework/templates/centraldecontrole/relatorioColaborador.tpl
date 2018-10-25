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
            <form action="?pagina=centraldecontrole/relatorioColaborador" method="post" class="form-inline">
                <div class="form-group">
                    <label class="sr-only">Data</label>
                    <input type="text" style="width:80px;" name="inputDataInicial" id="inputDataInicial" value="{$sDataInicial}" /> à
                    <input type="text" style="width:80px;" name="inputDataFinal" id="inputDataFinal" value="{$sDataFinal}"/> 
                </div>
                <br/>
                <input type="submit" class="btn btn-default" name="inputFiltrar" id="inputFiltrar" value="Filtrar"/> 
            </form>
            <a class="btn btn-primary" href='javascript:window.print();'>
                <i class="icon-print icon-white"></i> Imprimir
            </a>    
        </div>
        <br/>
        <div class="boxBody" >
            {if $sExibeRelatorio==true}
                <div class="boxTop" style="float:left">
                <img src="{$WWW_IMG}topo/logo-site.png" alt="{$sNomeSite}" title="{$sNomeSite}"  style="max-width:180px;max-height:60px;"/>
                </div>
                <div class="boxTop cabecalho" style="float:left;width:550px;margin-left:20px;">
                    <h1>Relatório de Colaboradores </h1>
                </div>  
                <div class="boxTop left" style="float:left;width:50px;height:80px">
                    <span></span>
                    <p class="tright">{$smarty.now|date_format:"d/m/Y"}</p>
                </div>
                <br class="clear"/>
                <div style="width:100%;float:left">
                    {foreach $arrObjColaborador as $oColaborador}
                        <ul>
                            <li>
                                <b>Código: </b> {$oColaborador->iCodigo}
                            </li>
                            <li>
                                <b>Nome: </b> {$oColaborador->sNome}
                            </li>
                            <li>
                                <b>Endereço: </b> {$oColaborador->oLogradouro->sDescricao} {$oColaborador->sEndereco} N� {$oColaborador->iNumero} {$oColaborador->sComplemento}  - {$oColaborador->sBairro} - {$oColaborador->sCidade} - {$oColaborador->sEstado}
                            </li>
                            <li>
                                <b>CEP: </b> {$oColaborador->sCEP}
                            </li>
                            <li>
                                <b>Data de nascimento: </b> {$oColaborador->sDataNascimento|date_format:"%d/%m/%Y"}
                            </li>
                            <li>
                                <b>Telefone: </b> {$oColaborador->sTelefone}
                            </li>
                            <li>
                                <b>E-mail: </b> {$oColaborador->sEmail}
                            </li>
                            <li>
                                <b>CPF: </b> {$oColaborador->sCPF}
                            </li>
                            <li>
                                <b>Sexo: </b> {$oColaborador->sSexo}
                            </li>
                            <li>
                                <b>Data de cadastro: </b> {$oColaborador->sDataCadastro|date_format:"%d/%m/%Y"}
                            </li>
                        </ul>
                    {foreachelse}
                        <p>Nenhum colaborador Encontrado</p>
                    {/foreach}
                </div>    
                <br class="clear"/>
            {/if}
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