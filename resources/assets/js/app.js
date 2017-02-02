require('./bootstrap');


function defaultAjax(url, params, btn) {
    btn.addClass('loading');
    return new Promise(function(success, fail){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: params,
            success: function( d ){
                success( d );
                btn.removeClass('loading');
            },
            error: function( d ){
                fail( fail );
                btn.removeClass('loading');
            }
        });
    });
}


$('.form-ajax').submit( function(){
    event.preventDefault();

    defaultAjax( $(this).attr('action'), $(this).serialize(), $(this).find('input[type="submit"]') ).then(
        function(d){
            alert('ok');
        },
        function(d){
            alert('no');
        }
    );

    // let data = $(this).serialize();
    // // console.log( $(this).attr('action') );
    // $.ajax({
    //     type: "POST",
    //     dataType: "json",
    //     url: $(this).attr('action'),
    //     data: data,
    //     success: function( d ){
    //
    //     },
    //     error: function( d ){
    //         console.log(d.responseJSON);
    //     }
    // });

});