<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <div class="page-header">
                <a class="btn btn-primary" href="?pagina=centraldecontrole/boleto&acao=editar">
                    <i class="icon-plus-sign icon-white"></i> Novo Boleto
                </a>
            </div>
            {if $sAcao == 'lista'}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Convênio</th>
                            <th>Banco</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjBoleto as $oBoleto}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/boleto&acao=editar&codigo={$oBoleto->iCodigo}" title="Editar boleto">{$oBoleto->sConvenio}</a>
                                </td>
                                <td>
                                    {$oBoleto->oBanco->sDescricao}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/boleto&excluir&codigo={$oBoleto->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                       <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="3">
                                    Nenhum Boleto
                                </td>
                            </tr>

                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/boleto&acao=lista" method="post"  >
                    <div class="form-group">
                        
                        <input name="inputCodigo" type="hidden" value="{$oBoleto->iCodigo}" />
                        
                        <label >Banco</label>
                        <select name="inputBanco">
                            {foreach $arrObjBanco as $oBanco}
                                <option value="{$oBanco->iId}" {if $oBanco->iId == $oBoleto->iIdBanco}selected{/if}>{$oBanco->sDescricao}</option>
                            {/foreach}
                        </select>
                        <br/><br/>
                        
                        
                        <label  for="inputAtivo">Ativo</label>
                        <select class="inputAtivo" name="inputAtivo" id="inputAtivo" style="width:80px;">
                            <option value="S" {if $oBoleto->sAtivo == 'S'}selected{/if}>Sim</option>
                            <option value="N" {if $oBoleto->sAtivo == 'N'}selected{/if}>Não</option>
                        </select>
                        <br/><br/>
                        
                        <label  for="inputConvenio">Convênio</label>
                        <input name="inputConvenio" style="width: 80px;" type="text" value="{$oBoleto->sConvenio}" />
                        <br/><br/>
                        
                        <label  for="inputCarteira">Carteira</label>
                        <input name="inputCarteira" style="width: 40px;" type="text" value="{$oBoleto->sCarteira}" />
                        <br/><br/>
                        
                        <label  for="inputCodigoCedente">Código Cedente</label>
                        <input name="inputCodigoCedente" style="width: 100px;" type="text" value="{$oBoleto->sCodigoCedente}" />
                        <br/><br/>
                        
                        <label  for="inputNomeCedente">Nome do Cedente</label>
                        <input name="inputNomeCedente" style="width: 500px;" type="text" value="{$oBoleto->sNomeCedente}" />
                        <br/><br/>
                        
                        <label  for="inputCNPJCedente">CNPJ do Cedente</label>
                        <input name="inputCNPJCedente" style="width: 150px;" type="text" value="{$oBoleto->sCNPJCedente}" />
                        <br/><br/>
                        
                        <label  for="inputCEPCedente">CEP do Cedente</label>
                        <input name="inputCEPCedente" style="width: 150px;" type="text" value="{$oBoleto->sCEPCedente}" />
                        <br/><br/>
                        
                        <label  for="inputEnderecoCedente">Endereço do Cedente</label>
                        <input name="inputEnderecoCedente" style="width: 500px;" type="text" value="{$oBoleto->sEnderecoCedente}" />
                        <br/><br/>
                        
                        <label  for="inputNumeroCedente">Número</label>
                        <input name="inputNumeroCedente" style="width: 80px;" type="text" value="{$oBoleto->sNumeroCedente}" />
                        <br/><br/>
                        
                        <label  for="inputBairroCedente">Bairro do Cedente</label>
                        <input name="inputBairroCedente" style="width: 500px;" type="text" value="{$oBoleto->sBairroCedente}" />
                        <br/><br/>
                        
                        <label  for="inputCidadeCedente">Cidade do Cedente</label>
                        <input name="inputCidadeCedente" style="width: 500px;" type="text" value="{$oBoleto->sCidadeCedente}" />
                        <br/><br/>
                        
                        <label  for="inputEstadoCedente">Estado do Cedente</label>
                        <select name="inputEstadoCedente" id="inputEstadoCedente" style="width: 200px;" >
                            <option value="-">Selecione o Estado</option>
                            <option {if $oBoleto->sEstadoCedente == 'AC'} selected {/if} value="AC">Acre</option>
                            <option {if $oBoleto->sEstadoCedente == 'AL'} selected {/if} value="AL">Alagoas</option>
                            <option {if $oBoleto->sEstadoCedente == 'AP'} selected {/if} value="AP">Amapá</option>
                            <option {if $oBoleto->sEstadoCedente == 'AM'} selected {/if} value="AM">Amazonas</option>
                            <option {if $oBoleto->sEstadoCedente == 'BA'} selected {/if} value="BA">Bahia</option>
                            <option {if $oBoleto->sEstadoCedente == 'CE'} selected {/if} value="CE">Ceará</option>
                            <option {if $oBoleto->sEstadoCedente == 'DF'} selected {/if} value="DF">Distrito Federal</option>
                            <option {if $oBoleto->sEstadoCedente == 'ES'} selected {/if} value="ES">Espirito Santo</option>
                            <option {if $oBoleto->sEstadoCedente == 'GO'} selected {/if} value="GO">Goiás</option>
                            <option {if $oBoleto->sEstadoCedente == 'MA'} selected {/if} value="MA">Maranhão</option>
                            <option {if $oBoleto->sEstadoCedente == 'MS'} selected {/if} value="MS">Mato Grosso do Sul</option>
                            <option {if $oBoleto->sEstadoCedente == 'MT'} selected {/if} value="MT">Mato Grosso</option>
                            <option {if $oBoleto->sEstadoCedente == 'MG'} selected {/if} value="MG">Minas Gerais</option>
                            <option {if $oBoleto->sEstadoCedente == 'PA'} selected {/if} value="PA">Pará</option>
                            <option {if $oBoleto->sEstadoCedente == 'PB'} selected {/if} value="PB">Paraíba</option>
                            <option {if $oBoleto->sEstadoCedente == 'PR'} selected {/if} value="PR">Paraná</option>
                            <option {if $oBoleto->sEstadoCedente == 'PE'} selected {/if} value="PE">Pernambuco</option>
                            <option {if $oBoleto->sEstadoCedente == 'PI'} selected {/if} value="PI">Piauí</option>
                            <option {if $oBoleto->sEstadoCedente == 'RJ'} selected {/if} value="RJ">Rio de Janeiro</option>
                            <option {if $oBoleto->sEstadoCedente == 'RN'} selected {/if} value="RN">Rio Grande do Norte</option>
                            <option {if $oBoleto->sEstadoCedente == 'RS'} selected {/if} value="RS">Rio Grande do Sul</option>
                            <option {if $oBoleto->sEstadoCedente == 'RO'} selected {/if} value="RO">Rondônia</option>
                            <option {if $oBoleto->sEstadoCedente == 'RR'} selected {/if} value="RR">Roraima</option>
                            <option {if $oBoleto->sEstadoCedente == 'SC'} selected {/if} value="SC">Santa Catarina</option>
                            <option {if $oBoleto->sEstadoCedente == 'SP'} selected {/if} value="SP">São Paulo</option>
                            <option {if $oBoleto->sEstadoCedente == 'SE'} selected {/if} value="SE">Sergipe</option>
                            <option {if $oBoleto->sEstadoCedente == 'TO'} selected {/if} value="TO">Tocantins</option>
                        </select>
                        <br/><br/>
                        
                        <label  for="inputAgenciaNumero">Número da Agência</label>
                        <input name="inputAgenciaNumero" style="width: 80px;" type="text" value="{$oBoleto->sAgenciaNumero}" />
                        <br/><br/>
                        
                        <label  for="inputAgenciaDigito">Dígito da Agência</label>
                        <input name="inputAgenciaDigito" style="width: 20px;" type="text" value="{$oBoleto->sAgenciaDigito}" />
                        <br/><br/>
                        
                        <label  for="inputContaNumero">Número da Conta</label>
                        <input name="inputContaNumero" style="width: 200px;" type="text" value="{$oBoleto->sContaNumero}" />
                        <br/><br/>
                        
                        <label  for="inputContaDigito">Dígito da Conta</label>
                        <input name="inputContaDigito" style="width: 20px;" type="text" value="{$oBoleto->sContaDigito}" />
                        <br/><br/>
                        
                        <label  for="inputOperacao">Operação</label>
                        <input name="inputOperacao" style="width: 40px;" type="text" value="{$oBoleto->sOperacao}" />
                        <br/><br/>
                        
                        <label  for="inputLocalPagamento1">Local de pagamento 1</label>
                        <input name="inputLocalPagamento1" style="width: 500px;" type="text" value="{$oBoleto->sLocalPagamento1}" />
                        <br/><br/>
                        
                        <label  for="inputLocalPagamento2">Local de pagamento 2</label>
                        <input name="inputLocalPagamento2" style="width: 500px;" type="text" value="{$oBoleto->sLocalPagamento2}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao1">Instrução 1</label>
                        <input name="inputInstrucao1" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao1}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao2">Instrução 2</label>
                        <input name="inputInstrucao2" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao2}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao3">Instrução 3</label>
                        <input name="inputInstrucao3" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao3}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao4">Instrução 4</label>
                        <input name="inputInstrucao4" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao4}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao5">Instrução 5</label>
                        <input name="inputInstrucao5" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao5}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao6">Instrução 6</label>
                        <input name="inputInstrucao6" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao6}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao7">Instrução 7</label>
                        <input name="inputInstrucao7" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao7}" />
                        <br/><br/>
                        
                        <label  for="inputInstrucao8">Instrução 8</label>
                        <input name="inputInstrucao8" style="width: 500px;" type="text" value="{$oBoleto->sInstrucao8}" />
                        <br/><br/>
                        
                        <button type="submit" name="inputSalvar" id="inputSalvar" class="btn btn-default">Salvar</button>
                        <a href="?pagina=centraldecontrole/boleto&acao=lista"  class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript">
            function confirmaExcluir()
            {
                var btnConfirm = confirm ( 'Deseja realmente excluir esta Boleto?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
            
            $("#inputSalvar").click(function() {
            
                if ($("#inputAtivo").val() === 'S')
                {
                    var btnConfirm = confirm ( 'Ativar este convênio irá desativar o convênio atualmente ativado, caso houver. Deseja continuar?' );

                    if ( btnConfirm )
                    {
                        return true;
                    }
                    return false;
                }
            });
        </script>
    </body>
</html>