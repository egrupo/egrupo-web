
$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 

		$('#obj-alc').hide();
		$('#obj-tes').hide();
		$('#obj-tex').hide();
		$('#obj-cla').hide();
	});

$('#enviaremail').change(
	function(){
		if($(this).is(':checked')){
			$('#botao').html('Enviar');
		} else {
			$('#botao').html('Download');
		}
	});

/* Cenas para os Objetivos Educativos */
$('.muda-obj').click(function(){
	
	$('#obj-geral').hide();
	$('#obj-alc').hide();
	$('#obj-tes').hide();
	$('#obj-tex').hide();
	$('#obj-cla').hide();

	$('.muda-obj').removeClass('active');
	$(this).addClass('active');

	var divisao = $(this).data('divisao');
	if(divisao == 0){
		$('#obj-geral').show();
	} else if(divisao == 1){
		$('#obj-alc').show();
	} else if(divisao == 2){
		$('#obj-tes').show();
	} else if(divisao == 3){
		$('#obj-tex').show();
	} else if(divisao == 4){
		$('#obj-cla').show();
	}

});