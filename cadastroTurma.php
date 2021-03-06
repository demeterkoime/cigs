<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro de Turma</title>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="css/scrollTable.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .format {
            padding-top:20px;
        }
    </style>
    <script>
        function acceptDateEmpty() {
            var date = document.getElementById("date");
            if (date.value == '') {
                date.value = "NULL";
            }
        }
    </script>
</head>

<body>

    <script src="js/common.js"></script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <center>Cadastro de Turma</center>
                        </h1>
                    </div>
                </div><br>
                <!-- /.row -->
                
                <?php 
                    include_once 'database.php';
                    $cod = $_POST['cod'];
                    $matricula = $_POST['ni'];
                    $da = $_POST['dc'];
                    $ng = $_POST['da'];
                    $trigrama = $_POST['dt'];
                    $aqs = $_POST['abreviatura'];
                    $pg = $_POST['turno'];
                    $forca = $_POST['ma'];

                    if (isset($_POST['cadastroTurma'])) {
                    
                    // Para Back-End
                    /*
                        $dao = new Database();
                        $dao->uploadPhoto($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"]);
                        $sql = "insert into titular (dataInscricao, validade, tipoPermissao, posto, nome, identidade, orgaoExpedidor, 
                            dataExpedicao, tipo, estadoCivil, cpf, nascimento, telResidencial, celular, email, empresa, cargo, telComercial) 
                            values ('$dataInscricao', '$validade', '$tipoPermissao', '$posto', '$nome', '$idt', '$orgaoExpedidor', 
                                    '$dataExpedicao', '$tipo', '$estadoCivil', '$cpf', '$nasc', '$telResidencial', '$celular', '$email', 
                                    '$empresa', '$cargo', '$telComercial');";
                        $sql = str_replace("''", "NULL", $sql);
                        if ($dao->query($sql)) 
                            $id = mysqli_insert_id($dao->link);
//                            echo "<script>getElementById('nrInscricao').innerHTML = " . $id + 1 . ";</script>";
                            $sqlEndereco = "insert into endereco (cod, numero, complemento, bairro, cidade, uf) values ('$id', '$numero', 
                                '$complemento', '$bairro', '$cidade', '$uf');";
                            $dao->query($sqlEndereco);
                            */
                    }
                ?>    

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                            <aside class="col-lg-2">
                                <img width="120px" class="img-rounded" src="fotos/.jpg">
                                <input type="file" name="fileToUpload" id="fileToUpload" style="">
                            </aside>
                    </div> <br>
                    
                 <fieldset>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label>Nº de Identificação</label>
                                <input class="form-control" type="text" name="ni" id="nrInscricao" readonly>
                            </div>
                            <div class="col-lg-8">
                                <label>Denominação da Turma</label>
                                <input class="form-control" type="text" name="dc">
                            </div>
                        </div>
                    </div> <br/>
                    
                    
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label>Data de Início</label>
                                <input class="form-control" type="date" name="da" value="<?php echo date("Y-m-d");?>" >
                            </div>
                            <div class="col-lg-4">
                                <label>Data de Término</label>
                                <input class="form-control" type="date" name="dt" value="<?php echo date("Y-m-d");?>" >
                            </div>
                            <div class="col-lg-2">
                                <label>Abreviatura</label>
                                <input class="form-control" type="text" max="6" name="abreviatura" placeholder="ABC">
                            </div>
                        </div>
                    </div>                    
                    
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-4 format">
                                <label>Curso Alocado</label>
                                <select class="form-control" name="turno">
                                   <option value=""></option>
                                   <option value="A">A - Oficiais Superiores</option>
                                   <option value="B">B - Oficiais Subalternos</option> 
                                   <option value="C">C - Subtenentes e Sargentos</option>
                                </select> 
                            </div>
                        	<div class="col-lg-4 format">
                                <label>Mês-Ano</label>
                                <input class="form-control" type="month" name="ma">
                            </div>
                        </div>  
                    </div>
                </fieldset>
                
                <br/>
                
                <fieldset>
                   <legend>Docentes Responsáveis</legend>
                   
                   <!-- TAG COM A CAIXA DAS DISCIPLINAS, RESULTADO DE CONSULTA -->
                   <div class="scrollContainer">
                    <center>
                        <table class="table table-condensed" id="docentes">
                            <thead>
                                <tr>
                                    <th>Nome de Guerra</th>
                                    <th>Cargo / Função</th>
                                    <th>Matrícula</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text_data selected_grey">
                                <td>Fulano da Selva</td>
                                <td>Instrutor</td>
                                <td>123456</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Sicrano da Caatinga</td>
                                <td>Monitor</td>
                                <td>123457</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Alguém da Fronteira</td>
                                <td>Médico</td>
                                <td>123458</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Um Indivíduo</td>
                                <td>Técnico</td>
                                <td>123459</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Índio Guerreiro</td>
                                <td>Fiscal</td>
                                <td>123460</td>
                              </tr>
                            </tbody>
                      </table>
                    </center>
                </div>
                   
                   <div class="row">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-4">
                                <button type="button" class="btn btn-success" name="ad" data-toggle="modal" data-target="#modalAD">Adicionar</button>
								   <div class="modal fade" id="modalAD" role="dialog">
									  <div class="modal-dialog">
                                        <!-- Modal content-->
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									         <h4 class="modal-title">Docentes envolvidos na Disciplina</h4>
										  </div>
										  <div class="modal-body">
											<!--<p>Some text in the modal.</p>-->
											<div class="scrollContainer"> 
                                              <center>
                                                <table class="table table-condensed" id="docentes">
                                                    <thead>
                                                      <tr>
                                                        <th>Nome de Guerra</th>
                                                        <th>Cargo / Função</th>
                                                        <th>Matrícula</th>
                                                      </tr>
                                                    </thead>
												    <tbody>
												      <tr class="text_data selected_grey">
												        <td>Fulano da Selva</td>
                                                        <td>Instrutor</td>
                                                        <td>123456</td>
												      </tr>
												      <tr class="text_data selected_grey">
												        <td>Sicrano da Caatinga</td>
                                                        <td>Monitor</td>
                                                        <td>123457</td>
												      </tr>
												      <tr class="text_data selected_grey">
												        <td>Alguém da Fronteira</td>
                                                        <td>Médico</td>
                                                        <td>123458</td>
												      </tr>
												      <tr class="text_data selected_grey">
												        <td>Um Indivíduo</td>
                                                        <td>Técnico</td>
                                                        <td>123459</td>
												      </tr>
												      <tr class="text_data selected_grey">
												        <td>Índio Guerreiro</td>
                                                        <td>Fiscal</td>
                                                        <td>123460</td>
												      </tr>
												    </tbody>
											    </table>
											  </center>
										    </div>
										  </div>  
										  <div class="modal-footer">
										    <input class="form-control" type="text" name="inserir">
										    <br/>
										    <button type="button" class="btn btn-success" >Inserir</button>
										    <button type="button" class="btn btn-danger" >Remover</button>
										    <button type="button" class="btn btn-info" data-dismiss="modal">Sair</button>
									      </div>
									    </div>
									  </div>
									</div>
			                    <button type="button" class="btn btn-danger" name="ed">Excluir</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset>
                   <legend>Alunos</legend>
                   <!-- TAG COM A CAIXA DAS DISCIPLINAS, RESULTADO DE CONSULTA -->
                   
                   <div class="scrollContainer">
                    <center>
                        <table class="table table-condensed" id="alunos">
                            <thead>
                                <tr>
                                    <th>Nome de Guerra</th>
                                    <th>Cargo / Função</th>
                                    <th>Matrícula</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="text_data selected_grey">
                                <td>Fulano2 da Selva</td>
                                <td>Aluno</td>
                                <td>123</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Sicrano2 da Caatinga</td>
                                <td>Aluno</td>
                                <td>124</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Alguém2 da Fronteira</td>
                                <td>Aluno</td>
                                <td>125</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Um Indivíduo2</td>
                                <td>Aluno</td>
                                <td>126</td>
                              </tr>
                              <tr class="text_data selected_grey">
                                <td>Índio Guerreiro2</td>
                                <td>Aluno</td>
                                <td>127</td>
                              </tr>
                            </tbody>
                      </table>
                    </center>
                </div>
                   
                   <div class="row">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-4">
                                <button type="button" class="btn btn-success" name="aa">Adicionar</button>
			                    <button type="button" class="btn btn-danger" name="ea">Excluir</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
                
                    <br/> <br/>
                    
                    <legend> </legend>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-4">
                                <button type="reset" class="btn btn-default">Limpar</button>
                                <button type="submit" name="cadastroCurso" class="btn btn-success">Salvar</button>
                                <a href="mostrarTurma.php" class="btn btn-info" role="button">Saír Edição</a>
                                
                            </div>
                        </div>
                    </div>

                </form>
                            
            </div>

        </div>
    <script src="js/selectTable.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
