
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

	$('.provaespecialidade').dblclick(function() {

		var that = $(this);
		var url = window.location.origin+'/escoteiros/'+$(this).data('escoteiro-id')+'/';

		if($(this).hasClass('prova-undone')){

			url = url+'concluirProvaEspecialidade';
	  		$.ajax({
	  			type: "POST",
				url: url,
				data: {
					prova: $(this).data('prova'),
					especialidade: $(this).data('especialidade')
				},
				success: function(response){
					that.removeClass('prova-undone');
					that.addClass('prova-done');
				},
				dataType: 'json'
  			});
		} else if($(this).hasClass('prova-done')) {
			url = url+'desconcluirProvaEspecialidade';
	  		$.ajax({
	  			type: "POST",
				url: url,
				data: {
					prova: $(this).data('prova'),
					especialidade: $(this).data('especialidade')
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

