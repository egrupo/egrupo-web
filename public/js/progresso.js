
function toggleProgresso(){
	$('#marcar-progresso').toggle('400');
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

$(function () {
	$('[data-toggle="popover"]').popover()

	$('.prova').dblclick(function() {

		var that = $(this);
		var url = window.location.origin+'/escoteiros/'+$(this).data('escoteiro-id')+'/';

		if($(this).hasClass('prova-undone')){
			url = url+'concluirProvaEtapa';
	  		$.ajax({
	  			type: "POST",
				url: url,
				data: {
					prova: $(this).data('prova'),
					etapa: $(this).data('etapa'),
					divisao: $(this).data('divisao')
				},
				success: function(response){
					that.removeClass('prova-undone');
					that.addClass('prova-done');
				},
				error: function(response){
					console.log('deu erro> '+response.responseText);
				},
				dataType: 'json'
  			});
		} else if($(this).hasClass('prova-done')) {
			url = url+'desconcluirProvaEtapa';
	  		$.ajax({
	  			type: "POST",
				url: url,
				data: {
					prova: $(this).data('prova'),
					etapa: $(this).data('etapa'),
					divisao: $(this).data('divisao')
				},
				success: function(response){
					that.removeClass('prova-done');
					that.addClass('prova-undone');
				},
				dataType: 'json'
	  		});
		}

		
	});
})

