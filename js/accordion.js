$(function(){
	$("#painel_secretaria ul li ul").hide();
	$("#painel_secretaria ul li a").click(function(){
		$("#painel_secretaria ul li ul").slideUp("slow");
		$(this).next().slideToggle();
	})
})

$(function(){ 
	$('#painel_exibicao_conteudo table.tabela tr.linhaDados').hover( 
		function(){ 
			$(this).addClass('destaque'); 
		}, 
		function(){ 
			$(this).removeClass('destaque'); 
		} 
	); 
});