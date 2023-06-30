$(document).ready(function() {
    if ($("#dt_logradouros").length) {
        var mobile = $('#ehmobile').val();
        var modoresponsivo = false;

        var base = $("#base_url").val();
        var url = base + '/logradouros/getLogradouros';

        if (mobile == 1) {
            var modoresponsivo = true;
        }

        $('#dt_logradouros').DataTable({
            'language': {
                'url': dir_base + '/assets/frameworks/datatables/lang/portugues-br.json'
            },
            'responsive': modoresponsivo,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': url
            },
            'columns': [
                { data: 'id' },                
                { data: 'nome_endereco' },
                { data: 'cep' },
                { data: 'bairro' },
                { data: 'zona_setor' }               
            ]
        });
    }

    if ($("#dt_modelojucis").length) {
        var mobile = $('#ehmobile').val();
        var modoresponsivo = false;

        var base = $("#base_url").val();
        var url = base + '/logradouros/getModelojucis';

        if (mobile == 1) {
            var modoresponsivo = true;
        }

        $('#dt_modelojucis').DataTable({
            'language': {
                'url': dir_base + '/assets/frameworks/datatables/lang/portugues-br.json'
            },
            'responsive': modoresponsivo,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': url
            },
            'columns': [
                { data: 'id' },
                { data: 'bairro' },
                { data: 'cep' },
                { data: 'logradouro' },
                { data: 'numero' },
                { data: 'complemento_endereco' },                
                { data: 'endereco_completo' }                
            ]
        });
    }   
});