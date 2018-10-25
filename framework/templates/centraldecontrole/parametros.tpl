<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
                <form action="?pagina=centraldecontrole/parametros" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <br/>
                        <h4>Parâmetros</h4>
                        <br/>
                        
                        <label class="sr-only" for="inputRespostaTestemunho" >Resposta padrão dos Testemunhos</label>
                        <textarea name="inputRespostaTestemunho" style="height:150px;" maxlength="">{$oParametro->sRespostaTestemunho}</textarea>
                        <br/><br/>
                        
                        <label class="sr-only" for="inputRespostaPedidoOracao" >Resposta padrão dos Pedidos de oração</label>
                        <textarea name="inputRespostaPedidoOracao" style="height:150px;" maxlength="">{$oParametro->sRespostaPedidoOracao}</textarea>
                        <br/><br/>
                        
                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                    </div>
                </form>
        </div>
    </body>
</html>