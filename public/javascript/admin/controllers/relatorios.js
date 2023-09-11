$(document).ready(function () {
    var escola = $("#id").val();
    
    function reltotal() {
        var escola = $('input[name=id]').val();

        
        $.ajax({
            url: 'http://' + window.location.host + '/smed/admin/relatorios/gettotal/'+escola,
            method: "GET",
            success: function (data) {
                //console.log(data); 
               // var descturma = new Array();
                var matriculas = new Array();
                var capacidade_p = new Array();
                
                var cor = [];
     
                for (var i in data) {
                   // console.log(data);
                   // descricao.push(data[i].descricao);
                    matriculas.push(data[i].matriculas);
                    capacidade_p.push(data[i].capacidade_p);
                    
                    cor.push(data[i].cor);
                }
                
                var chartdata = {
                    labels: capacidade_p,
                    datasets: [
                        {
                            label: matriculas,
                            backgroundColor: getColors(12),
                            // backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: matriculas
                }]};

                var ctx = $("#reltotal");
                var barGraph = new Chart(ctx, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        legend: { display: true, position: 'left', align: 'start' },
                        title: {
                            display: true,
                            text: 'Total da Escola'
                }}});
            },
            error: function (data) {
                
            }
        });
    }
    function relserie() {
        var escola = $('input[name=idescola]').val();

        //console.log(escola);
        $.ajax({
            url: 'http://' + window.location.host + '/smed/admin/relatorios/getserie/'+escola,
            method: "GET",
            success: function (data) {
                //console.log(data); 
               // var descturma = new Array();
                var matriculas = new Array();
                var capacidade_p = new Array();
                var restante = new Array();
                var nomeserie = new Array();
                var nometurno = new Array();
                //var nomes = new Array();
                var cor = [];
                

                for (var i in data) {
                    matriculas.push(data[i].matriculas);
                    capacidade_p.push(data[i].capacidade_p);
                    restante.push(data[i].restante);
                    nomeserie.push(data[i].nomeserie);
                    nometurno.push(data[i].nometurno);
                    cor.push(data[i].cor);
                }
                
                var chartdata = {
                    labels:  nomeserie ,
                    options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      },
                    datasets: [
                        {
                            label: restante,
                            backgroundColor: getColors(12),
                            // backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: restante
                        }]};

                var ctx = $("#relserie");
               
                var barGraph = new Chart(ctx, {
                    type: 'doughnut',
                    data: chartdata,
                    options: {
                        legend: { display: true, position: 'left', align: 'start' },
                        title: {
                            display: true,
                            text: 'Vagas da Escola por serie'
                        }
                    }
                });
                
               
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    
   
    //----fim ----------
    function barchart() {
        var ctx = $('#barChart').get(0).getContext('2d');

        var data = {
            labels: ["Chocolate", "Vanilla", "Strawberry"],
            datasets: [
                {
                    label: "Blue",
                    backgroundColor: "blue",
                    data: [3, 7, 4]
                },
                {
                    label: "Red",
                    backgroundColor: "red",
                    data: [4, 3, 5]
                },
                {
                    label: "Green",
                    backgroundColor: "green",
                    data: [7, 2, 6]
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }],
                    
                }
            }
        });

    }
    function initGraph() {
        reltotal();
        relserie();
        
        
        //barchart();
    }
    //Metodo prático de validar vazios em JS
    function testa_empty(val) {
        if (val === undefined)
            return true;
        if (typeof (val) == 'function' || typeof (val) == 'number' || typeof (val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
            return false;
        if (val == null || val.length === 0) // null or 0 length array
            return true;
        if (typeof (val) == "object") {
            // empty object

            var r = true;

            for (var f in val) {
                r = false;
            }
            return r;
        }
        return false;
    }
    function getSafe(fn, defaultVal) {
        try {
            return fn();
        } catch (e) {
            return defaultVal;
        }
    }
    function getColors(c = 1) {
        var cor = new Array();

        for (var i = 0; i < c; i++) {
            cor.push(getRandomColor());
        }

        return cor;
    }
    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    function getmes(mes) {
        for (var i = 0; i < 12; i++) {
            if (mes[i] == 1) mes[i] = 'janeiro';
            if (mes[i] == 2) mes[i] = 'fevereiro';
            if (mes[i] == 3) mes[i] = 'março';
            if (mes[i] == 4) mes[i] = 'abril';
            if (mes[i] == 5) mes[i] = 'maio';
            if (mes[i] == 6) mes[i] = 'junho';
            if (mes[i] == 7) mes[i] = 'julho';
            if (mes[i] == 8) mes[i] = 'agosto';
            if (mes[i] == 9) mes[i] = 'setembro';
            if (mes[i] == 10) mes[i] = 'outubro';
            if (mes[i] == 11) mes[i] = 'novembro';
            if (mes[i] == 12) mes[i] = 'dezembro';
        }
        return mes;
    }
   
    initGraph();
});