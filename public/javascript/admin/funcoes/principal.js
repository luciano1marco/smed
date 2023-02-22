$(document).ready(function() {
    if ($('.animsition').length) {
        $('.animsition').animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 400,
            outDuration: 200,
            linkElement: 'a[href]:not([target="_blank"]):not([href^="mailto\\:"]):not([href^="\\#"])',
            loading: true,
            loadingParentElement: 'body',
            loadingClass: 'animsition-loading',
            unSupportCss: ['animation-duration', '-webkit-animation-duration', '-o-animation-duration'],
            overlay: false,
            overlayClass: 'animsition-overlay-slide',
            overlayParentElement: 'body'
        });
    }

    if ($('#datatable').length) {
        $('#datatable').DataTable({
            'language': { 'url': dir_base + '/assets/frameworks/datatables/lang/portugues-br.json' },
            'paging': true,
            'ordering': true,
            'info': true,
            'searching': true,
            'autoWidth': true,
            'responsive': true
        });
    }

    if ($('.alert').length) {
        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    }

    if ($('#password').length) {
        $('#password').pwstrength({
            ui: { showVerdictsInsideProgressBar: true }
        });
    }

    if ($('.icheck').length) {
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '40%' // optional
        });
    }

    if ($(".selectpicker").length) {
        $('.selectpicker').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    }

    $.each($(".selectpicker option"), function(e) {
        var icon = ($(this).attr("value"));
        $(this).attr("data-icon", icon);

        var flag = false;

        if ($(".selectpicker")[0].selectedIndex <= 0) {
            flag = false;
        } else {
            flag = true
        }

        //Se e verdadeiro tem Valor selecionado e tem que dar um render para aparecer o Ícone
        if (flag === true) {
            $('.selectpicker').selectpicker('render');
        }
        //Caso não deixa o titulo padrão
    });

    if ($('.select2').length) {
        $('.select2').select2();
    }

    if ($('.select2bs4').length) {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    }

    // Mascaras
    if ($('.cpfcnpj').length) {
        $('.cpfcnpj').length > 11 ? $('#pr_cpfcnpj').mask('00.000.000/0000-00', options) : $('#pr_cpfcnpj').mask('000.000.000-00#', options);
    }

    if ($('.phone').length) {
        $('.phone').mask('(00) 00000-0000');
    }

    if ($('.decimal').length) {
        $('.decimal').mask("#.###,00", { reverse: true });
    }

    if ($('.integer').length) {
        $('.integer').mask('000');
    }

    // Gera Strings para Inputs
    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    // Gerador Numeros Float
    function generateRandomFloat(min, max) {
        var r = min + Math.random() * (max + 1 - min);
        r = r.toFixed(2);
        return r
    }

    // Usado para dar TRUE ou FALSE em diversas condições de logica JS
    function testa_empty(val) {
        if (val === undefined)
            return true;
        if (typeof(val) == 'function' || typeof(val) == 'number' || typeof(val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
            return false;
        if (val == null || val.length === 0) // null or 0 length array
            return true;
        if (typeof(val) == "object") {
            // empty object

            var r = true;

            for (var f in val) {
                r = false;
            }
            return r;
        }
        return false;
    }

});