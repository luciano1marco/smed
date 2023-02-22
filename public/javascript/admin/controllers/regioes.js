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

    $('#poligono').on('blur change',mostrarPoligono);
    
    var p = $('#poligono').val();
    
    if(!testa_empty(p)){
        mostrarPoligono();
    }

    function mostrarPoligono() {
        let id = $('#id').val();
        let titulo = $('#titulo').val();
        let poligono = $('#poligono').val();

        if(!testa_empty(poligono)){

        var geojson = JSON.parse(poligono);
            //console.log(obj);

            var estilo = {
                "color": "#FF0000",
                "weight": 5,
                "opacity": 0.65
            };
            
            if(!testa_empty(id)){
                id = 1;
            }
            if(!testa_empty(titulo)){
                titulo = 'Sem Título';
            }

            var regiao = Polygon(id, titulo, geojson, estilo);
            //LayerGroup
            polygons.addLayer(regiao);
            //Add Layer no Mapa
            polygons.addTo(map);
            ajustaBounds();
        }
    }
                                                        
});