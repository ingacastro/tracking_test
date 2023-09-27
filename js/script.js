$(document).ready(function() {	
    $('#tablero').hide();
    $('.pagination li a').on('click', function(){
        $('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');

        var page = $(this).attr('data');		
        var dataString = 'page='+page;
        
        $.ajax({
            type: "GET",
            url: "ajax.php",
            data: dataString,
            success: function(data) {
                $('.items').fadeIn(2000).html(data);
                $('.pagination li').removeClass('active');
                $('.pagination li a[data="'+page+'"]').parent().addClass('active');
            }
        });
        return false;
    });

    $('#buscar').on('click', function(){
        buscarFechaCreacion();
        let fecha_creacion = $('#fecha_creacion').val();
        let tracking = $('#tracking').val();
    });

    $("#login").on('click', function(){
        if( $("#loginusername").val()=='admin' && $("#loginpassword").val()=='password') {
                $("#first").hide();
                $("#second").append("<p>Hello, admin</p> <input type='button' id='logout' value='Log Out' />");
                $('#tablero').show();
        } else {
            alert("Please try again");
        }

        $("#logout").click(function() {
            $("form")[0].reset();
            $("#first").show();
            $("#second, #tablero").hide();
        });
    });

});

function buscarFechaCreacion(){
    $('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');
    var fecha_creacion = $('#fecha_creacion').val();
    var numero_tracking = $('#numero_tracking').val();
    let buscar = '';
    if(fecha_creacion.length > 0 && numero_tracking.length > 0){
        buscar = 'fecha_creacion='+fecha_creacion+'&tracking='+numero_tracking;
    }else if(fecha_creacion.length > 0){
        buscar = 'fecha_creacion='+fecha_creacion;
    }else if(numero_tracking.length > 0){
        buscar = 'tracking='+numero_tracking;
    }
    
    $.ajax({
        type : 'GET',
        url : 'ajax_fecha.php',
        data : buscar,
        success : function(data){
            $('.items').fadeIn(2000).html(data);
            $('.pagination li').removeClass('active');
            $('.pagination li a[data="1"]').parent().addClass('active');
        }
    });
}

