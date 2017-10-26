$(function() {

  var alerts = ["alert","alert-info","alert-warning","alert-success","alert-danger"];
  var icons = ["fa","fa-ban","fa-info","fa-warning","fa-check"];

  $('form').submit(function(){

    var form = $(this);
    var cap = form.attr('id'); //TODO: CAP = Controller - Action - Param
    var dados = new FormData($(this)[0]);

    $.ajax({
      url: BASE + cap,
      data: dados,
      type: 'POST',
      dataType:'json',
      processData: false,
      contentType: false,
      beforeSend: function(data){

        $.each(alerts, function(key,value){
          $(".alerta").removeClass(value);
        });

        $.each(icons, function(key,value){
          $(".icon").removeClass(value);
        });

        $(".i-send").addClass("fa-spinner fa-spin");
      },
      success: function(data){
        $(".i-send").removeClass("fa-spinner fa-spin");

        if(data.return){
          $('.alerta').addClass(data.return[0]);
          $('.icon').addClass(data.return[1]);
          $('.title').html(data.return[2]);
          $('.result').html(data.return[3]);
        }

        if(data.redirect){
          window.setTimeout(function(){
            window.location.href = BASE + data.redirect[0];
          },data.redirect[1]);

        }

      }
    });
    return false;
  });

  // TODO: Verificar senha repetida

  $(".v_passwd").on("blur",function(){
    var v_passwd = $(this).val();
    var passwd = $(".passwd").val();

    if(v_passwd != passwd){
      $('.alerta').addClass("alert alert-danger");
      $('.icon').addClass("fa fa-ban");
      $('.title').html("Erro");
      $('.result').html("Senhas não conferem, favor digitar novamente.");
    }

  });


});
