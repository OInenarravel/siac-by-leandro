function validarSenha(form){
	with(form){
        if(senha.value == "" || confirmaSenha.value == ""){
            alert("Uma senha precisa ser informada primeiro!");
            return false;
        }else{
            if(senha.value != confirmaSenha.value){
                alert("A senha informada possui um valor diferente da senha confirmada!\nVerifique a senha informada.");
                return false;
            }
            return true;
        }
    }
}

function habilitaUsuario(tipo){
	var radios = document.getElementsByName('radioCurso');
	var selects = document.getElementsByName('selectTurma');
	var checks = document.getElementsByName('checkDisciplina');
	
	//USUARIO
	if(tipo == 0){
		document.getElementById("campoNFuncional").disabled = true;
		document.getElementById("campoNFuncional").value = "";
		document.getElementById("campoCarteiraTrabalho").disabled = true;
		document.getElementById("campoCarteiraTrabalho").value = "";
		document.getElementById("campoRaca").disabled = true;
		document.getElementById("campoNecessidades").disabled = true;
		document.getElementById("nivelAcesso").disabled = true;
		document.getElementById("ocultoNivelAcesso").value = "Usu�rio";

		for (var i=0;i<radios.length;i++){
			ii = i+1;
			document.getElementById("radioCurso"+ii).disabled = true;
			document.getElementById("radioCurso"+ii).checked = false;
		}
		
		for (var i=0;i<selects.length;i++){
			ii = i+1;
			document.getElementById("selectTurma"+ii).disabled = true;
		}
		
		for (var i=0;i<checks.length;i++){
			ii = i+1;
			document.getElementById("checkDisciplina"+ii).disabled = true;
			document.getElementById("checkDisciplina"+ii).checked = false;
		}
	}
	
	//ALUNO
	if(tipo == 1){		
		document.getElementById("campoNFuncional").disabled = true;
		document.getElementById("campoNFuncional").value = "";
		document.getElementById("campoCarteiraTrabalho").disabled = true;
		document.getElementById("campoCarteiraTrabalho").value = "";
		document.getElementById("campoRaca").disabled = false;
		document.getElementById("campoNecessidades").disabled = false;
		document.getElementById("nivelAcesso").disabled = false;

		for (var i=0;i<radios.length;i++){
			ii = i+1;
			document.getElementById("radioCurso"+ii).disabled = false;
			document.getElementById("radioCurso"+ii).checked = false;
		}
		
		for (var i=0;i<selects.length;i++){
			ii = i+1;
			document.getElementById("selectTurma"+ii).disabled = true;
		}
		
		for (var i=0;i<checks.length;i++){
			ii = i+1;
			document.getElementById("checkDisciplina"+ii).disabled = true;
			document.getElementById("checkDisciplina"+ii).checked = false;
		}
	}
	
	//FUNCIONARIO
	if(tipo == 2){
		document.getElementById("campoNFuncional").disabled = true;
		document.getElementById("campoCarteiraTrabalho").disabled = false;		
		document.getElementById("campoRaca").disabled = true;
		document.getElementById("campoNecessidades").disabled = true;
		document.getElementById("nivelAcesso").disabled = false;
		
		for (var i=0;i<radios.length;i++){
			ii = i+1;
			document.getElementById("radioCurso"+ii).disabled = true;
			document.getElementById("radioCurso"+ii).checked = false;
		}

		for (var i=0;i<selects.length;i++){
			ii = i+1;
			document.getElementById("selectTurma"+ii).disabled = true;
			document.getElementById("selectTurma"+ii).selectedIndex=0;
		}
		
		for (var i=0;i<checks.length;i++){
			ii = i+1;
			document.getElementById("checkDisciplina"+ii).disabled = true;
		}
	}
	
	//PROFESSOR
	if(tipo == 3){
		document.getElementById("campoNFuncional").disabled = false;
		document.getElementById("campoCarteiraTrabalho").disabled = false;
		document.getElementById("campoRaca").disabled = true;
		document.getElementById("campoNecessidades").disabled = true;
		document.getElementById("nivelAcesso").disabled = false;

		for (var i=0;i<radios.length;i++){
			ii = i+1;
			document.getElementById("radioCurso"+ii).disabled = true;
			document.getElementById("radioCurso"+ii).checked = false;
		}
		
		for (var i=0;i<selects.length;i++){
			ii = i+1;
			document.getElementById("selectTurma"+ii).disabled = true;
			document.getElementById("selectTurma"+ii).selectedIndex=0;
		}
		
		for (var i=0;i<checks.length;i++){
			ii = i+1;
			document.getElementById("checkDisciplina"+ii).disabled = false;			
		}
	}
}

function habilitaCurso(select){	
	var selects = document.getElementsByName('selectTurma');

	for (var i=0;i<selects.length;i++){
		ii = i+1;
		document.getElementById("selectTurma"+ii).disabled = true;
		document.getElementById("selectTurma"+ii).selectedIndex=0;
		var atual = document.getElementById("selectTurma"+ii);

		if(atual.id == select){
			document.getElementById(atual.id).disabled = false;
		}
	}
}

function gerarLogin(){	
	
	var radios = document.getElementsByName('tipoUsuario');
	var tipoUsuario;
	
	for(var i=0;i<radios.length;i++){		
		if(document.getElementById("tipoUsuario"+i).checked){
			tipoUsuario = document.getElementById("tipoUsuario"+i).value;
			break;
		}
	}
	
	var nAleat = Math.random();
	nAleat = nAleat.toString().substr(6,4);	
	
	var nome = document.getElementById("nome").value.substring(0,5);	
	var exp = new RegExp("[���������������������������������������������~^�`{}]","g");
	nome = nome.replace(exp, "");
	exp = new RegExp(" ","g");
	nome = nome.replace(exp, "");
	
	if(document.getElementById("genLog").checked && tipoUsuario == 0){		
		var concat = nome+nAleat;
		document.getElementById("campoLogin").value = concat.toLowerCase();
	}
	
	if(document.getElementById("genLog").checked && tipoUsuario == 1){
		var selects = document.getElementsByName('selectTurma');
		var turma = "";
		
		for(var i=0;i<selects.length;i++){
			ii = i+1;
			if(document.getElementById("selectTurma"+ii).disabled == false){
				turma = document.getElementById("selectTurma"+ii).options[document.getElementById("selectTurma"+ii).selectedIndex].text;
			}
		}
		
		var concat = nome+turma+nAleat;
		document.getElementById("campoLogin").value = concat.toLowerCase();
	}
	
	if(document.getElementById("genLog").checked && tipoUsuario == 2){
		var nFuncional = document.getElementById("campoNFuncional").value;		
		var concat = nome+nFuncional+nAleat;
		document.getElementById("campoLogin").value = concat.toLowerCase();
	}
	
	if(document.getElementById("genLog").checked && tipoUsuario == 3){
		var nCarteira = document.getElementById("campoCarteiraTrabalho").value;		
		var concat = nome+nCarteira+nAleat;
		document.getElementById("campoLogin").value = concat.toLowerCase();
	}
}

function mudarFoco(campoOrigem, campoDestino, qtdTeclas){		
	if(document.getElementById(campoOrigem).value.length == qtdTeclas){
		document.getElementById(campoDestino).focus();
	}
}

function validarForm(){
	capturaDisciplinas();
	if(validarSenha()){
		return true;
	}else{
		return false;
	}
}

function disableBotao(nome,condicao){
	document.getElementById(nome).disabled = condicao;
}

function gerarNomeTurma(){
	var nTurma = document.getElementById("selectCurso").options[document.getElementById("selectCurso").selectedIndex].value;
	nTurma = nTurma.substr(2,1);
	nTurma = nTurma.valueOf();
	nTurma++;
	if(nTurma < 10){
		nTurma = "0"+nTurma.toString();
	}
	var curso = document.getElementById("selectCurso").options[document.getElementById("selectCurso").selectedIndex].text;
	curso = curso.substr(0,4);
	curso = curso.toUpperCase();
	
	var turno = document.getElementById("selectTurno").options[document.getElementById("selectTurno").selectedIndex].text;
	turno = turno.toUpperCase();
	if(turno == "VESPERTINO"){
		turno = turno.substr(0,4);
	}else{
		turno = turno.substr(0,3);
	}
	var inicio = document.getElementById("selectInicio").options[document.getElementById("selectInicio").selectedIndex].text;
	inicio = inicio.substr(2,2);
	
	document.getElementById("campoNomeTurma").value=curso+turno+nTurma;
	document.getElementById("ocultoNomeTurma").value=curso+turno+nTurma;
	document.getElementById("botaoCadastrar").disabled = false;
	document.getElementById("botaoLimpar").disabled = false;
}

function verificarCampos(){
	var campoNome = document.getElementById("campoNome").value;
	
	
	var cargaHCurso = document.getElementById("cargaHCurso").value;
	var cargaHEstagio = document.getElementById("cargaHEstagio").value;

	if(campoNome != "" && campoHabilitacao != "" && cargaHCurso != "" && cargaHEstagio != ""){
		document.getElementById("botaoCadastrar").disabled = false;
		document.getElementById("botaoLimpar").disabled = false;
	}else{
		document.getElementById("botaoCadastrar").disabled = true;
		document.getElementById("botaoLimpar").disabled = true;
	}
}

function validarCadastroCurso(){
	var campoNome = document.getElementById("campoNome").value;
	var cargaHCurso = document.getElementById("cargaHCurso").value;
	var cargaHEstagio = document.getElementById("cargaHEstagio").value;
	var campoAmparoLegal = document.getElementById("campoAmparoLegal").value;
	var campoSobre = document.getElementById("campoSobre").value;
	var campoPerfilProfissional = document.getElementById("campoPerfilProfissional").value;
	var erro = "";
	
	if(campoNome == ""){
		erro += "* NOME\n";
	}
	
	if(cargaHCurso == ""){
		erro += "* CARGA HOR�RIA DO CURSO\n";
	}
	
	if(cargaHEstagio == ""){
		erro += "* CARGA HOR�RIA DO EST�GIO\n";
	}
	
	if(campoAmparoLegal == ""){
		erro += "* AMPARO LEGAL\n";
	}
	
	if(campoSobre == ""){
		erro += "* SOBRE\n";
	}
	
	if(campoPerfilProfissional == ""){
		erro += "* PERFIL PROFISSIONAL\n";
	}
	
	if(erro != ""){
		erro = "Os seguintes campos estao vazios e sao de preenchimento obrigatorio:\n\n"+erro;
		alert(erro);
		return false;
	}else return true;
}

function capturaDisciplinas(){
	var checks = document.getElementsByName("checkDisciplina");
	
	listaDisciplinas = new String();
	
	for(var i=0;i<checks.length;i++){
		ii = i+1;
		if(document.getElementById("checkDisciplina"+ii).checked){
			listaDisciplinas += document.getElementById("checkDisciplina"+ii).value+"/";
		}
	}
	
	document.getElementById("ocultoListaDisciplinas").value = listaDisciplinas;
}

function validarFormulario(formName){
	var erro = "";

	with(formName){
        if(nome.value == "")
            erro = "* NOME\n";
        

        if(campoRua.value == "")
            erro += "* RUA\n";
        
        if(campoNumero.value == "")
            erro += "* NUMERO\n";
        
        if(campoBairro.value == "")
            erro += "* BAIRRO\n";
        
        if(campoMunicipio.value == "")
            erro += "* MUNICIPIO\n";
       
        if(campoCEP1.value == "" || campoCEP2.value == "")
            erro += "* CEP\n";
        
        if(campoNacionalidade.value == "")
            erro += "* NACIONALIDADE\n";
        
        if(campoPai.value == "")
            erro += "* NOME DO PAI\n";
        
        if(campoMae.value == "")
            erro += "* NOME DA MAE\n";
        
        if(campoRG.value == "")
            erro += "* RG\n";
        
        if(campoCPF.value == "")
            erro += "* CPF\n";
        
        if(campoTelefoneFixoDDD.value == "" || campoTelefoneFixo1.value == "" || campoTelefoneFixo2.value == "")
            erro += "* TELEFONE FIXO\n";
        
        if(campoRecadoDDD.value == "" || campoRecado1.value == "" || campoRecado2.value == "")
            erro += "* RECADO\n";
        
        if(campoCelularDDD.value == "" || campoCelular1.value == "" || campoCelular2.value == "")
            erro += "* CELULAR\n";
        
        if(campoEmail.value == "")
            erro+= "* EMAIL\n";

        //---------------------------------------------------------------------
        // ALUNO

        if(formName.name == "formAluno"){
            var x = false;
            var radios = document.getElementsByName('radioCurso');
            var selects = document.getElementsByName('selectTurma');
            
            if(campoRaca.value == ""){
                erro += "* RACA\n";
            }
            if(campoNecessidades.value == ""){
                erro += "* NECESSIDADES ESPECIAIS\n";
            }

            for(var i=0;i<radios.length;i++){
                j = i+1;
                if(document.getElementById("radioCurso"+j).checked){
                    x = true;
                    break;
                }
            }

            if(x){
                x = false;

                //if(document.getElementById("selectTurma"+j).options[document.getElementById("selectTurma"+j).selectedIndex].text != ""){
                if(document.getElementById("selectTurma"+j) != null){
                    x = true;
                }
                if(!x){
                    alert("Este curso nao possui turmas cadastradas!\nEscolha outro curso ou cadastre uma nova turma no curso escolhido.");
                    erro += "* TURMA\n";
                }
            }else{
                alert("E necessario cadastrar o aluno em um dos cursos disponiveis!");
                erro += "* CURSO\n";
            }
        }

        //---------------------------------------------------------------------
        // FUNCIONARIO
        if(formName.name == "formFuncionario"){
            if(campoCarteiraTrabalho.value == "")
                erro += "* CARTEIRA DE TRABALHO\n";
        }

        //---------------------------------------------------------------------
        // PROFESSOR
        if(formName.name == "formProfessor"){
            x = false;
            var checks = document.getElementsByName('checkDisciplina');

            if(campoCarteiraTrabalho.value == ""){
                erro += "* CARTEIRA DE TRABALHO\n";
            }
            if(campoNFuncional.value == ""){
                erro += "* NUMERO FUNCIONAL\n";
            }

            for (var i=0;i<checks.length;i++){
                ii = i+1;
                if(document.getElementById("checkDisciplina"+ii).checked){
                    x = true;
                    break;
                }
            }
            if(!x)
                erro += "* DISCIPLINA (E NECESSARIO ESCOLHER NO MINIMO UMA DISCIPLINA)\n";
            else
                capturaDisciplinas();
        }

        if(campoLogin.value == "")
            erro += "* LOGIN\n";

        if(!validarSenha(formName))
            erro += "* SENHA\n* CONFIRMAR SENHA\n";

        if(erro != ""){
            alert("Os seguintes campos estao vazios e sao de preenchimento obrigatorio:\n\n"+erro);
            return false;
        }else
            return true;
    }
}

function validarBuscaUsuario(){
	var campoBusca = document.getElementById("campoBusca").value;
	var radioParametro = document.getElementsByName("radioParametro");
	var radioChecked;
	
	for(var i=0;i< radioParametro.length;i++){
		if(document.getElementById("radioParametro"+(i+1)).checked){
			radioChecked = i+1;
			break;
		}
	}
	
	if((radioChecked == 1 || radioChecked == 3 || radioChecked == 4) && isNaN(campoBusca)){
		alert("O valor informado � invalido para este tipo de busca!");
		return false;
	}
	return true;
}

function validarBuscaCurso(){
	var campoBusca = document.getElementById("campoBusca").value;
	var radioParametro = document.getElementsByName("radioParametro");
	var radioChecked;
	
	for(var i=0;i< radioParametro.length;i++){
		if(document.getElementById("radioParametro"+(i+1)).checked){
			radioChecked = i+1;
			break;
		}
	}
	
	if((radioChecked == 1 || radioChecked == 4) && isNaN(campoBusca)){
		alert("O valor informado � invalido para este tipo de busca!");
		return false;
	}
	return true;
}

function validarBuscaDisciplina(){
	var campoBusca = document.getElementById("campoBusca").value;
	var radioParametro = document.getElementsByName("radioParametro");
	var radioChecked;
	
	for(var i=0;i< radioParametro.length;i++){
		if(document.getElementById("radioParametro"+(i+1)).checked){
			radioChecked = i+1;
			break;
		}
	}
	
	if((radioChecked == 1 && isNaN(campoBusca)) || (radioChecked == 2 && !isNaN(campoBusca))){
		alert("O valor informado e invalido para este tipo de busca!");
		return false;
	}
	return true;
}

function exibirSenha(campoSenha){
    objPassword = document.getElementById(campoSenha);

    if(objPassword.type == 'password'){
        document.getElementById(campoSenha).setAttribute('type', 'text');
        document.getElementById("confirmaSenha").setAttribute('type', 'text');
        //document.getElementById(campoSenha).type = 'text';
    }else{
        document.getElementById(campoSenha).setAttribute('type', 'password');
        document.getElementById("confirmaSenha").setAttribute('type', 'password');
    }
        //document.getElementById(campoSenha).type = 'password';
}