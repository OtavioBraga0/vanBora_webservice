$(document).ready(function() {
    var confirmDelete = 0;
    $('#toUp').click(function() {
        $.scrollTo($('#status-bar'), 1000);
    });
    $('#toDown').click(function() {
        $.scrollTo($('#footer'), 1000);
    });
    $('#toBack').click(function() {
        window.location = $(this).attr('url');
    });
    $('#toUpdate').click(function() {
        $('#f-update').submit();
    });

    $('.updateAlbum').click(function() {
        
        var sNome = $(".album_name").val();
        if ($.trim(sNome) === '')
        {
            alert('Preencha o nome do Álbum');
        }
        else
        {
            var album_id = $('.album_name').attr('id');
            var album_name = $.trim($('.album_name').val());
            var album_credito = $.trim($('.album_credito').val());
            var album_tipo = $.trim($('.album_tipo').val());
            var album_categoria = $.trim($('.album_categoria').val());
            var visivel = $('.inputVisivel option:selected').val();

            $.post('?pagina=centraldecontrole/acao_foto&action=updateAlbum',
                    {
                        album_name: album_name,
                        visivel: visivel,
                        album_credito: album_credito,
                        album_tipo: album_tipo,
                        album_categoria: album_categoria,
                        album_id: album_id
                    },
            function(data) {
                $.notify('Álbum ' + album_name + ' atualizado', 'success');
            });
        }
        //$('.refresh').click();
    });

    /*$('.foto_captions').click(function(){
     var foto_id = $(this).attr('id');
     var foto_caption = $(this).val();
     
     $.post('?pagina=centraldecontrole/acao_foto&action=updateFotoName',
     {
     foto_caption:foto_caption,
     foto_id:foto_id
     },
     function(data){
     notify('<h5>'+data+'</h5>');
     $('#'+foto_id).attr('title',$('#'+foto_id).val());
     $('#'+foto_id).hideTip();
     $('#'+foto_id).showTip();
     $('#'+foto_id).refreshTip();
     });
     });*/

    $('.refresh').click(function() {

        var foto_id = "f_" + $(this).attr('id');
        var foto_caption = $("#" + foto_id).val();
        //var foto_url = $("#l_"+$(this).attr('id')).val();

        $.post('?pagina=centraldecontrole/acao_foto&action=updateFotoName',
                {
                    foto_caption: foto_caption,
                    foto_id: foto_id
                },
        function(data) {
            notify('<h5>' + data + '</h5>');
            //$('#'+foto_id).attr('title',$('#'+foto_id).val());
            //$('#'+foto_id).hideTip();
            //$('#'+foto_id).showTip();
            //$('#'+foto_id).refreshTip();
        });
    });

    $('.cover').click(function() {
        var foto_id = $(this).attr('id');
        var foto_album = $(this).attr('album');

        $.post('?pagina=centraldecontrole/acao_foto&action=updateFotoCover',
                {
                    foto_album: foto_album,
                    foto_id: foto_id
                },
        function(data) {
            $.notify(data);
        });
    });

    $('.deleteAlbum').click(function() {
        var id = $(this).attr('id');
        var msg = '<ul class="dialog_delete">';
        msg += '<br><h5>Você está prestes a remover um álbum e suas fotos!</h5>';
        msg += '<br><p>Deseja realmente prosseguir?</p>';
        msg += '</ul>'

        $('body').append('<div id="dialog"  class="dialogr" title="Remover álbum">' + msg + '</div>');
        $("#dialog").dialog({
            modal: true,
            open: function(event, ui) {
                $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
            },
            width: 420,
            height: 260,
            buttons: {
                "Cancelar": function() {
                    $(this).dialog("close");
                    $("#dialog").remove();
                },
                "Prosseguir": function() {
                    window.location = '?pagina=centraldecontrole/album&delete=' + id;
                }
            }
        });

        

        return false;
    });


    /*Sorter Foto*/
    $(".sortable").sortable({
        cursor: 'crosshair',
        helper: "clone",
        opacity: 0.6,
        update: function(event, ui) {
            var order = $(this).sortable('serialize');
            var url = "?pagina=centraldecontrole/acao_foto&action=updateFotoPos";
            $.post(url, {
                item: order
            }, function(data) {
                //var arr = Array;
                //arr = ["Muito bom!", "Demais!", "Ficou legal!", "Super!", "Agora est� bonito!","Contiue assim!"];
                //msg  = arr[Math.floor(Math.random()*arr.length)];
                //notify('<h5>Posi��o Atualizada<br> '+msg+'</h5>');
                $.notify('Posição Atualizada', 'success');
            });
        }
    });
    $(".drag").disableSelection();

    $('.delete').click(function() {
        var foto_id = $(this).attr('id');

        if (confirmDelete !== 1)
        {
            var msg = '<ul class="dialog_delete">';
            msg += '<br><h5>Você está prestes a remover uma foto!</h5>';
            msg += '<br><p>Deseja realmente prosseguir?</p>';
            msg += '</ul>'
            $('body').append('<div id="dialog"  class="dialogr" title="Remover Foto">' + msg + '</div>');
            $("#dialog").dialog({
                modal: true,
                open: function(event, ui) {
                    $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
                },
                width: 420,
                height: 260,
                buttons: {
                    "Cancelar": function() {
                        $(this).dialog("close");
                        $("#dialog").remove();
                    },
                    "Prosseguir": function() {
                        $(this).dialog("close");
                        $("#dialog").remove();
                        $.post('?pagina=centraldecontrole/acao_foto&action=deleteFoto',
                                {
                                    foto_id: foto_id
                                },
                        function(data) {
                            $('#item_' + foto_id).remove();
                            $.notify(data);
                            if (confirmDelete === 0)
                            {
                                var msg = '<ul class="dialog_delete">';
                                msg += '<br><p>Deseja exibir a confirma��o de exclus�o na pr�xima <br> foto que remover deste �lbum?</p>';
                                msg += '</ul>'
                                $('body').append('<div id="dialog"  class="dialogr" title="Confirma��o de Exclus�o">' + msg + '</div>');
                                $("#dialog").dialog({
                                    modal: true,
                                    open: function(event, ui) {
                                        $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
                                    },
                                    width: 420,
                                    height: 200,
                                    buttons: {
                                        "Não": function() {
                                            confirmDelete = 1;
                                            $(this).dialog("close");
                                            $("#dialog").remove();
                                        },
                                        "Sim": function() {
                                            confirmDelete = 2;
                                            $(this).dialog("close");
                                            $("#dialog").remove();
                                        }
                                    }
                                });
                            }

                        });
                    }
                }
            });
        }
        else
        {
            $.post('?pagina=centraldecontrole/acao_foto&action=deleteFoto',
                    {
                        foto_id: foto_id
                    },
            function(data) {
                $('#item_' + foto_id).remove();
                $.notify(data);
                $(this).dialog("close");
                $("#dialog").remove();
            });
        }
    });
});