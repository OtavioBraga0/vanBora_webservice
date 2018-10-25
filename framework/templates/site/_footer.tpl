<section class="bg-azul-escuro" id="contato">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="titulo">Contato</h2>
            </div>
        </div>
        
        <div class="row container-contato">

            <div class="col-lg-4 contato-item have-active" align="center">
                <div class="icone">
                    <i class="fa fa-facebook"></i>
                </div>
                
                <div id="media-facebook">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Famexassessoria%2F&tabs=timeline&&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" style="overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
            <div class="col-lg-4 contato-item have-active active">
                <div class="icone">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="bg-azul-escuro contato">
                    <p><i class="fa fa-phone" aria-hidden="true"></i> (12) 3133-2890</p>
                    <p><i class="fa fa-whatsapp" aria-hidden="true"></i> (12) ??????????</p>
                    <p>Atendimento: segunda a sexta - 09h às 17h</p>
                </div>
                <address>
                    <p><strong>Endereço:</strong></p>
                    <p>Rua Coronel Pires Barbosa, 761</p>
                    <p>Campo do Galvão</p>
                    <p>Guaratinguetá - SP</p>
                </address>

                <div class="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d919.4286498648012!2d-45.19881686180158!3d-22.81303282007045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ccc45bd3d4dca1%3A0x4229bd46486d7fd4!2sR.+Cel.+P%C3%ADres+Barbosa%2C+761+-+Vila+Alves%2C+Guaratinguet%C3%A1+-+SP%2C+12500-290!5e0!3m2!1spt-BR!2sbr!4v1537213446438" frameborder="0" style="border:none" allowfullscreen></iframe>
                    <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d919.4286498648012!2d-45.19881686180158!3d-22.81303282007045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ccc45bd3d4dca1%3A0x4229bd46486d7fd4!2sR.+Cel.+P%C3%ADres+Barbosa%2C+761+-+Vila+Alves%2C+Guaratinguet%C3%A1+-+SP%2C+12500-290!5e0!3m2!1spt-BR!2sbr!4v1537213446438" class="btn btn-map btn-block" target="_blank"><i class="fa fa-map-marker"></i> Ver no mapa</a>
                </div>
            </div>
            <div class="col-lg-4 contato-item have-active">
                    <div class="icone">
                        <i class="fa fa-envelope"></i>
                    </div>
                <form action="{$WWW}contato" id="formContato">
                    <div class="form-group">
                        <label for="inputNome" class="sr-only">Nome:</label>
                        <input type="text" class="form-control" name="inputNome" id="inputNome" placeholder="Nome" required />
                    </div>
                    <div class="form-group">
                        <label for="inputEntidade" class="sr-only">Par�quia/Entidade:</label>
                        <input type="text" class="form-control" name="inputEntidade" id="inputEntidade" placeholder="Paróquia/Entidade" required />
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">E-mail:</label>
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="E-mail" required />
                    </div>
                    <div class="form-group">
                        <label for="inputTelefone" class="sr-only">Telenone:</label>
                        <input type="number" class="form-control" name="inputTelefone" id="inputTelefone" placeholder="Somente números" />
                    </div>
                    <div class="form-group">
                        <label for="inputTelefone" class="sr-only">Mensagem:</label>
                        <textarea class="form-control" rows="10" required name="inputMensagem" placeholder="Digite sua mensagem..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="inputEnviar">Enviar</button>
                </form>
            </div>

        </div>
    </div>
</section>

{*<!-- 
<section id="chamada-contato">

    <div class="container">
        <div class="row">
            <div class="col text-uppercase">
                <img src="{$WWW_IMG}shared/message.svg" alt="Entre em contato conosco" title="Entre em contato conosco" />
                <p>Seja nosso parceiro. Fale conosco!</p>
                <p>Telefone: (12) 3133-2890</p>    
            </div>
        </div>
    </div>

</section>
 -->*}
<footer id="footer" class="bg-azul-escuro">
    <div class="container">
        <div class="row">
            <a href="http://amexassessoria.com/" target="_blank">
                <img src="{$WWW_IMG}shared/logo-amex-branco.svg" alt="Amex Assessoria - Marketing e Comunica��o Integrada" title="Amex Assessoria - Marketing e Comunica��o Integrada" class="logo-footer" />
            </a>
        </div>
    </div>
</footer>

<a id="toTop" title="Voltar ao topo" alt="Voltar ao topo"><i class="fa fa-chevron-up"></i></a>

{include file="site/_scripts.tpl"}

</body>

</html>