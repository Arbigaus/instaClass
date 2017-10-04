$(function() {

    $("#popular_classes").on("change", function() {
        var controller = $(this).val();
        $.ajax({
            url: BASE + "menu_submenu/getIdMenu",
            data: {idmenu: controller},
            type: 'POST',
            dataType: 'json',
            beforeSend: function(data) {

            },
            success: function(data) {
                if (data.metodos) {
                    $("#popular_metodos").html(data.metodos);
                }

            }

        });
    });


});

