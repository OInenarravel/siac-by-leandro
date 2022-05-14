function enviarComentario(){
	var conteudo = document.formulario.conteudo_comentario.value;
	
	if(conteudo == ''){
		alert("� preciso preencher o conteudo para enviar o coment�rio!");
		return false;
	}
	else{
		return true;
	}
}

function enviarTopico(){
	var nome = document.formulario.nome_topico.value;
	var descricao = document.formulario.descricao_topico.value;
	
	if(nome != '' && descricao != ''){
		return true;
	}
	else{
		alert('Todos os campos sao de preenchimento obrigat�rio!\nPor favor confira o formulario e tente novamente.');
		return false;
	}
}

function redirect(idsubcategoria){
	window.top.location.href="./criar_topico.php?idsubcategoria="+idsubcategoria;
}

function validarCategoria(){
	var nome = document.getElementById("campoNome").value;
	var descricao = document.getElementById("campoDescricao").value;
	var erro = "";
	
	if(nome == ""){
		erro = "\n* NOME";
	}
	
	if(descricao == ""){
		erro += "\n* DESCRICAO";
	}
	
	if(erro == ""){
		return true;
	}else{
		alert("Existem campos vazios no formul�rio!\n"+erro);
		return false;
	}
}

function nomearModerador(){
	document.getElementById("opcao").value = 1;
	
	var checks = document.getElementsByName("check");
	var retorno = false;

	for (var i=0;i<checks.length;i++){
		if (checks[i].checked == true){
			if(confirm("Deseja tornar este membro moderador do f�rum?")){
				var idusuario = checks[i].value;
				
				window.location = './tornarModerador.php?idusuario='+idusuario;
				retorno = true;
				break;
			}else{
				return false;
			}
		}else{
			retorno = false;
		}
	}
	if(!retorno){
		alert("Nenhum usu�rio foi selecionado!\nSelecione um usu�rio e tente novamente.");		
		return false;
	}	
}

function reintegrarUsuario(){
	document.getElementById("opcao").value = 2;
	
	var checks = document.getElementsByName("check");
	var retorno = false;

	for (var i=0;i<checks.length;i++){
		if (checks[i].checked == true){
			if(confirm("Deseja reintegrar este membro ao f�rum?")){
				var idusuario = checks[i].value.value;
				
				document.getElementById("idusuario").value = idusuario;
				document.formUsuario.submit();
				retorno = true;
			}else{
				return false;
			}
		}else{
			retorno = false;
		}
	}
	if(!retorno){
		alert("Nenhum usu�rio foi selecionado!\nSelecione um usu�rio e tente novamente.");		
	}	
}

function banirUsuario(){
	
	if(document.getElementById("campoMotivo").value == ""){
		alert("� obrigat�rio o preenchimento do motivo do banimento!");
	}else{
		document.getElementById("opcao").value = 3;
	
		var checks = document.getElementsByName("check");
		var retorno = false;

		for (var i=0;i<checks.length;i++){
			if (checks[i].checked == true){
				if(confirm("Deseja banir este membro do f�rum?")){
					var idusuario = checks[i].value.value;
					
					document.getElementById("idusuario").value = idusuario;
					document.formUsuario.submit();
					retorno = true;
					break;
				}else{
					return false;
				}
			}else{
				retorno = false;
			}
		}
		if(!retorno){
			alert("Nenhum usu�rio foi selecionado!\nSelecione um usu�rio e tente novamente.");		
			return false;
		}	
	}
}

function validarModerador(){
	
	var checks = document.getElementsByName("check");
	var listaCategorias = "";

	for (var i=0;i<checks.length;i++){
		if (checks[i].checked == true){
			listaCategorias += checks[i].value+".";
		}
	}	
	if(listaCategorias == ""){
		alert("Nenhuma categoria foi selecionada!\nSelecione ao menos uma categoria e tente novamente.");		
		return false;
	}else{
		document.getElementById("listaCategorias").value = listaCategorias;
		return true;
	}
}

function exonerarModerador(){
	document.getElementById("opcao").value = 1;
	var checks = document.getElementsByName("check");
	var retorno = true;

	for (var i=0;i<checks.length;i++){
		if (checks[i].checked == true){
			if(confirm("Deseja exonerar este moderador do forum?")){
				var idusuario = checks[i].value;
				
				document.getElementById("idusuario").value = idusuario;
				document.formModerador.submit();
				retorno = true;
				break;
			}else{
				return false;
				retorno = true;
			}
		}else{
			retorno = false;
		}
	}
	if(!retorno){
		alert("Nenhum moderador foi selecionado!\nSelecione um moderador e tente novamente.");		
		return false;
	}
}

function advertirUsuario(remetente, destinatario) {
	var mensagem = prompt("Informe a mensagem de advert�ncia:", "");
	
	alert("REMETENTE: "+remetente+"\nDESTINATARIO: "+destinatario);
	while(mensagem == ""){
		alert("� obrigat�ria uma mensagem para advert�ncia!");
		
		mensagem = prompt("Informe a mensagem de advert�ncia:", "");
	}
	if (mensagem != null){
		window.location = '../Forum/enviarMensagem.php?opcao=1&mensagem='+mensagem+"&remetente="+remetente+"&destinatario="+destinatario;
	}
}