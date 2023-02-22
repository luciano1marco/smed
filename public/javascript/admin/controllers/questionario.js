$(document).ready(function() {
    $('#datatable').DataTable({
        'language': { 'url': '../assets/plugins/datatables/portugues-br.json' },
        'paging': true,
        'ordering': true,
        'info': true,
        'searching': true,
        'autoWidth': true,
        'lengthMenu': [[25, 50, 75,100, -1], [25, 50, 75, 100, 'All']]
        //'scrollX': true,       
    });

    $(".alert").delay(2000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%' // optional
    });

    let lat = $('#latitude').val();
    let lng = $('#longitude').val();

    let latwork = $('#latitude_trabalho').val();
    let lngwork = $('#longitude_trabalho').val();

    var tam_lat = null;
    var tam_lng = null;
    
    if(!testa_empty(lat) && !testa_empty(lat)){       
        var titulo = 'CASA';
        var icon = 'home';
        
        var pin = addMarker(lat,lng,titulo,icon);
        markers.addLayer(pin);

        map.addLayer(markers);

        setTimeout(function() {
            ajustaBounds();
        }, 1000);
       
    }

    if(!testa_empty(latwork) && !testa_empty(lngwork)){  
        var titulo = 'TRABALHO';      
        var icon = 'briefcase';

        var pin = addMarker(latwork,lngwork,titulo,icon);
        markers.addLayer(pin);

        map.addLayer(markers);

        setTimeout(function() {
            ajustaBounds();
        }, 1000);
      
    }
    
    function addMarker(lat, lng, titulo,icon ){
        //Icone      
        formato = 'circle';           
        css = 'font-size: 20px; margin-top: 4px;';  
        icone = icon;
        cor = 'red';  

        var icone_mapa = getBeautifyIcon(formato, icone, cor, css); 
        var coords = new L.LatLng(lat, lng);

        var marker = new Pin(1, titulo, coords, icone_mapa );                               
        marker.bindPopup(titulo);

        return marker;       
    }   

    setTimeout(function() {
        carregarPDM();
    }, 1000);
        
    $("body").on("shown.bs.tab", "#tgeo", function() {      
        map.invalidateSize(false);
       
    });

    function carregarPDM() {      
        $.ajax({
            url: dir_base + 'admin/questionario/getPoligonos',
            success: function(data) {     
                $.each(data, function(index, value) {           
                    var id = value.id;
                    var nome_unidade = value.titulo;        
                    var geojson = JSON.parse(value.poligono);
    
                    var r = Math.floor(Math.random() * 256); 
                    var g = Math.floor(Math.random() * 256); 
                    var b = Math.floor(Math.random() * 256); 

                    // Override no Nome do GeoJSON
                    geojson.properties.name = nome_unidade;
                    
                    if(!testa_empty(geojson)){
                        var estilo = {
                            "color": 'rgb('+r+','+g+','+b+')',
                            "weight": 1,
                            "opacity": 0.65
                        };
    
                        var poligono = new Polygon(id, nome_unidade, geojson, estilo);  
                        polygons.addLayer(poligono);                   
                    }
                });  
            map.addLayer(polygons);             
            }
        });
    }

});