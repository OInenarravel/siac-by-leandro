function excluirMensagem(){
	
	var retorno = false;
	
	var inputs = document.formMensagem.getElementsByTagName('input');
		
	for (var i=0;i<inputs.length;i++){  
		
		if (inputs[i].checked == true){
			retorno = true;
		}
	}
	if(retorno){
	
		if(confirm("Deseja realmente excluir esta(s) mensagem(ns)?")){
			document.getElementById("campoOculto").value = 1;
			document.formMensagem.submit();
		}
		else{						
			return false;
		}
	}
	else{
		alert("Nenhuma mensagem foi selecionada!\nSelecione uma mensagem e tente novamente.");
		return false;
	}
}

function marcarMensagem(){

	var retorno = false;
	
	var inputs = document.formMensagem.getElementsByTagName('input');
		
	for (var i=0;i<inputs.length;i++){  
		
		if (inputs[i].checked == true){
			retorno = true;
		}
	}
	if(retorno){
	
		if(confirm("Deseja marcar esta(s) mensagem(ns) como não-lida?")){
			document.getElementById("campoOculto").value = 2;
			document.formMensagem.submit();
		}
		else{						
			return false;
		}
	}
	else{
		alert("Nenhuma mensagem foi selecionada!\nSelecione uma mensagem e tente novamente.");
		return false;
	}
}

function excluirArquivo(){				

	var retorno = false;
	
	var inputs = document.formArquivo.getElementsByTagName('input');
		
	for (var i=0;i<inputs.length;i++){  
		
		if (inputs[i].checked == true){
			retorno = true;
		}
	}
	if(retorno){
	
		if(confirm("Deseja realmente excluir este(s) arquivo(s)?")){
			return true;
		}
		else{						
			return false;
		}
	}
	else{
		alert("Nenhum arquivo foi selecionado!\nSelecione um arquivo e tente novamente.");
		return false;
	}
}