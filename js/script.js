$(document).ready(function(){

    $('#keyword').on('keyup', function(){
        
        $.get('ajax/search.php?keyword=' + $('#keyword').val(), function(data){
            $('.table-wrap').html(data);
        });

    });

    $('.logout').on('click', function(){
        confirm('Yakin logout ?');
    });

});