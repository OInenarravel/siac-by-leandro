function validarFormulario(){	
	var titulo = document.getElementById("campoTitulo").value;
	var resumo = document.getElementById("resumo").value;
	var noticia_completa = document.getElementById("noticia_completa").value;
	var erro = "";
	
	if(titulo == ""){
		erro = "* TITULO\n";
	}
	if(resumo == ""){
		erro += "* RESUMO\n";
	}
	if(noticia_completa == ""){
		erro += "* NOTICIA COMPLETA";
	}
	
	if(!erro){
		return true;
	}else{
		alert("Os seguintes campos estao em branco e sao de preenchimento obrigatorio:\n\n"+erro);
		return false;
	}
}

function pesquisar(){
	var campoPesquisar = document.getElementById("campoPesquisar").value;
	var radioParametro = document.getElementsByName('radioParametro');
	var radio = false;
	
	for(var i=0;i<radioParametro.length;i++){
		j = i+1;
		if(document.getElementById("radioParametro"+j).checked){
			radio = document.getElementById("radioParametro"+j).value;
			break;
		}else{
			radio = false;
		}
	}	
	
	if(!radio){
		alert("Escolha um parametro de pesquisa e clique em PESQUISAR!");
		return false;
	}
	else if(campoPesquisar == ""){
		alert("O campo de pesquisa deve ser preenchido antes!");
		return false;
	}else if(radio == 3){
        return validaData(campoPesquisar);
    }
}

function validaData(valor){
    var date = valor;
	var ardt = new Array;
	var ExpReg = new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt = date.split("/");
	erro = false;

	if(ardt.valueOf() < 3){
        erro = true;
    }
    if (date.search(ExpReg) == -1){
		erro = true;
    }
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if (ardt[1] == 2) {
		if ((ardt[0]>28)&&((ardt[2]%4) != 0))
			erro = true;
		if ((ardt[0]>29)&&((ardt[2]%4) == 0))
			erro = true;
	}

	if(erro){
		alert("\"" + valor + "\" nao e uma data valida!!!");
		return false;
	}else
        return true;
}

function criarEditor(idDivTextArea){
	alert();
	ClassicEditor
		.create( document.querySelector( '#'+idDivTextArea ) )
		.then( editor => {
			console.log( editor );
		} )
		.catch( error => {
			console.error( error );
		} );
}

function getConteudo(){
	const conteudo = document.querySelector( '.ck-editor__editable' ).ckeditorInstance.getData();
	return conteudo;
}

function setTexto(texto){
	document.querySelector( '.ck-editor__editable' ).ckeditorInstance.setData(texto);
}