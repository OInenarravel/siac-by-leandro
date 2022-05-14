<?php
	function gerarPainel($nivelAcesso){
		switch($nivelAcesso){
			case "Administrador":
				$painel = "
				<div id='painel_secretaria'>
					<ul>
						<li><a>Usu&aacute;rio</a>
							<ul>
								<li><a href='usuarios.php?opcao=0'>Listar Todos</a></li>
								<li><a href='usuario.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=1'>Procurar</a></li>
							</ul>
						</li>

						<li>Aluno
							<ul>
								<li><a href='alunos.php?opcao=0'>Listar Todos</a></li>
								<li><a href='aluno.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=2'>Procurar</a></li>
							</ul>
						</li>

						<li>Funcion&aacute;rio
							<ul>
								<li><a href='funcionarios.php?opcao=0'>Listar Todos</a></li>
								<li><a href='funcionario.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=3'>Procurar</a></li>
							</ul>
						</li>

						<li>Professor
							<ul>
								<li><a href='professores.php?opcao=0'>Listar Todos</a></li>
								<li><a href='professor.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=4'>Procurar</a></li>
							</ul>
						</li>

						<li>Curso
							<ul>
								<li><a href='cursos.php?opcao=0'>Listar Todos</a></li>
								<li><a href='curso.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=5'>Procurar</a></li>
							</ul>
						</li>
					
						<li>Disciplina
							<ul>
								<li><a href='disciplinas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='disciplina.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=6'>Procurar</a></li>
							</ul>
						</li>

						<li>Turma
							<ul>
								<li><a href='turmas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='turma.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=7'>Procurar</a></li>
							</ul>
						</li>
					</ul>
				</div>";
				break;
				
			case "Secretaria":
				$painel = "
				<div id='painel_secretaria'>
					<ul>
						<li>Usu&aacute;rio
							<ul>
								<li><a href='usuarios.php?opcao=0'>Listar Todos</a></li>
								<li><a href='usuario.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=1'>Procurar</a></li>
							</ul>
						</li>

						<li>Aluno
							<ul>
								<li><a href='alunos.php?opcao=0'>Listar Todos</a></li>
								<li><a href='aluno.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=2'>Procurar</a></li>
							</ul>
						</li>

						<li>Funcion&aacute;rio
							<ul>
								<li><a href='funcionarios.php?opcao=0'>Listar Todos</a></li>
								<li><a href='funcionario.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=3'>Procurar</a></li>
							</ul>
						</li>

						<li>Professor
							<ul>
								<li><a href='professores.php?opcao=0'>Listar Todos</a></li>
								<li><a href='professor.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=4'>Procurar</a></li>
							</ul>
						</li>

						<li>Curso
							<ul>
								<li><a href='cursos.php?opcao=0'>Listar Todos</a></li>
								<li><a href='curso.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=5'>Procurar</a></li>
							</ul>
						</li>
					
						<li>Disciplina
							<ul>
								<li><a href='disciplinas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='disciplina.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=6'>Procurar</a></li>
							</ul>
						</li>

						<li>Turma
							<ul>
								<li><a href='turmas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='turma.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=7'>Procurar</a></li>
							</ul>
						</li>
					</ul>
				</div>";
				break;
				
			default:
				$painel = "
				<div id='painel_secretaria'>
					<ul>
						<li>Curso
							<ul>
								<li><a href='cursos.php?opcao=0'>Listar Todos</a></li>
								<li><a href='curso.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=5'>Procurar</a></li>
							</ul>
						</li>
					
						<li>Disciplina
							<ul>
								<li><a href='disciplinas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='disciplina.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=6'>Procurar</a></li>
							</ul>
						</li>

						<li>Turma
							<ul>
								<li><a href='turmas.php?opcao=0'>Listar Todas</a></li>
								<li><a href='turma.php?opcao=0'>Cadastrar</a></li>
								<li><a href='procurar.php?opcao=7'>Procurar</a></li>
							</ul>
						</li>
					</ul>
				</div>";
				break;
		}
		
		return $painel;
	}
?>