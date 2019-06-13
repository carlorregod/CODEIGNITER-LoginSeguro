var CFG = { 
    url: $('input:hidden[name="url_base"]').val(), 
    token: $('meta[name="token"]').attr('content')
};  

$(document).ready(function($){
    $.ajaxSetup({data: {token: CFG.token}});
    $(document).ajaxSuccess(function(e,x) {
        var result = $.parseJSON(x.responseText); 
        $('meta[name="token"]').val(result.token); 
        $.ajaxSetup({data: {token: result.token}}); 
        });
}); 

ajaxCallbackJQuery = function(parametros, url, method, callback, asynchr=true) 
{
    //Notar que las respuestas que se entregarán son del tipo JSON
	$.ajax({
		'type':method,
		'url':url,
        'data':parametros,
        'dataType': 'json',
		'asynchr':asynchr
	})
	.done(callback)
	.fail(function(jqxhr, textStatus, errorThrown) {
		console.log('Error: ' + textStatus + " : " + errorThrown);
	});
};
