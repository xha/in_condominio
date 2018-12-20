	$(document).ajaxStart(function() { Pace.restart(); });	

    $(function() {
        var msj_principal = $('#msj_principal').html().split('|');
        if (msj_principal[1]!=undefined) {
            oculta_mensaje('msj_principal',msj_principal[1],msj_principal[0]);
        }
    });