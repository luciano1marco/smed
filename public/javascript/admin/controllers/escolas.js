$(document).ready(function() {

    $('#datatable').DataTable({
        'language': { 'url': '../assets/plugins/datatables/portugues-br.json' },
        'paging': true,
        'ordering': true,
        'info': true,
        'searching': true,
        'autoWidth': true,
        //'scrollX': true,
        "columnDefs": [
            { "width": "20%", "targets": 3 }
        ]
    });

    $(".alert").delay(2000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%' // optional
    });

    $('.select2').select2({
        allowClear: true,
        minimumInputLength: 3,
        minimumResultsForSearch: 20,
        theme: 'flat'
    });

    $('.select2_multiple').select2({
        minimumResultsForSearch: 20,
        theme: 'flat' //Classic Default
    });

    $(".tag").on("change keyup", function() {
        $tag = slugify($(this).val());
        $("#tag").not($(this)).val($tag);
    });

    function slugify(str) {
        var map = {
            '-': ' ',
            '-': '_',
            'a': 'á|à|ã|â|À|Á|Ã|Â',
            'e': 'é|è|ê|É|È|Ê',
            'i': 'í|ì|î|Í|Ì|Î',
            'o': 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
            'u': 'ú|ù|û|ü|Ú|Ù|Û|Ü',
            'c': 'ç|Ç',
            'n': 'ñ|Ñ'
        };

        str = str.toLowerCase();
        str = str.replace(/\s/g, '-');

        for (var pattern in map) {
            str = str.replace(new RegExp(map[pattern], 'g'), pattern);
        };

        return str;
    };

    $('#cep').mask('99999-999');   

    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");
               
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);         
                        $('#estado').select2().trigger('change');           
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    
                        
    let lat = $('#latitude').val();
    let lng = $('#longitude').val();
    let titulo = $('#titulo').val();

    var tam_lat = null;
    var tam_lng = null;
    
    if(!testa_empty(lat) && !testa_empty(lat)){
        markers.clearLayers();

        if(testa_empty(titulo)){
            titulo = 'Adicione um Título';
        }
        
        var pin = addMarker(lat,lng,titulo);
        markers.addLayer(pin);

        map.addLayer(markers);
        ajustaBounds();
    }

    $('#latitude , #longitude, #titulo').on('blur keyup', function( event ) {    

        if ($(this).val() != '') {
            let value = ($(this).val());
            let campo = ($(this).attr('id'));

            if(campo == 'latitude'){
                lat = value;
                tam_lat =  value.length;
            }
            if(campo == 'longitude'){
                lng = value;
                tam_lng =  value.length;
            }

            var titulo = $('#titulo').val();

            if(testa_empty(titulo)){
                titulo = 'Adicione o Titulo';
            }

            if(!testa_empty(lat) && !testa_empty(lat)){
                if(tam_lat >= 3 && tam_lng >= 3){ 
                    markers.clearLayers();
                    var pin = addMarker(lat,lng,titulo);
                    markers.addLayer(pin);

                    map.addLayer(markers);
                    ajustaBounds();
                }
            }               
        }
        });
    
    function addMarker(lat, lng, titulo){
        //Icone      
        formato = 'circle';           
        css = 'font-size: 20px; margin-top: 4px;';  
        icone = 'graduation-cap';
        cor = 'red';  

        var icone_mapa = getBeautifyIcon(formato, icone, cor, css); 
        var coords = new L.LatLng(lat, lng);

        var marker = new Pin(1, titulo, coords, icone_mapa );                               
        marker.bindPopup(titulo);

        return marker;       
    }                                                  
});