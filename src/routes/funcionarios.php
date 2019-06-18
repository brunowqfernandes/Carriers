<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Retorna lista de todos os funcionários
$app->get('/api/funcionarios/relatorio', function(Request $request, Response $response){
	$sql = "SELECT COUNT(id) AS 'Funcionarios do sexo masculino' FROM funcionarios WHERE sexo = 'm';";
	$sql .= "SELECT COUNT(*) AS 'Funcionarios do sexo feminino' FROM funcionarios WHERE sexo = 'f';";
	$sql .= "SELECT CAST(AVG(idade) AS INT) AS 'Idade media dos funcionarios'  FROM funcionarios;";
	$sql .= "SELECT MAX(idade) AS 'Idade do funcionario mais velho' FROM funcionarios;";
	$sql .= "SELECT MiN(idade) AS 'Idade do funcionario mais novo' FROM funcionarios ";

	try{
		//db
		$db = new db();
		$db = $db->connect();		
		$stmt = $db->query($sql);
		do {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            //echo json_encode($rows);
            $resultSets[] = $rows;
        }

    } while ($stmt->nextRowset());
		$db = null;
		return $response->withStatus(200)->withJson($resultSets);
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});
//retorna relatório de funcionários
$app->get('/api/funcionarios', function(Request $request, Response $response){
	$sql = 'SELECT * FROM funcionarios';

	try{
		//db
		$db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
		$funcionarios = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		return $response->withStatus(200)->withJson($funcionarios);
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});
//Retorna dados de um funcionário
$app->get('/api/funcionario/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');

	$sql = "SELECT * FROM funcionarios  WHERE id = $id";

	try{
		//db
		$db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
		$funcionario = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		return $response->withStatus(200)->withJson($funcionario);
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});
//Cadastrar funcionário
$app->post('/api/funcionario/add', function(Request $request, Response $response){
	$nome = $request->getParam('nome');
	$sobrenome = $request->getParam('sobrenome');
	$idade = $request->getParam('idade');
	$sexo = $request->getParam('sexo');

	$sql = "INSERT INTO funcionarios (nome,sobrenome,idade,sexo) VALUES (:nome,:sobrenome,:idade,:sexo)";

	try{
		//db
		$db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);


		$stmt-> bindParam(':nome',$nome);
		$stmt-> bindParam(':sobrenome',$sobrenome);
		$stmt-> bindParam(':idade',$idade);
		$stmt-> bindParam(':sexo',$sexo);

		$stmt->execute();

		echo '{"notice": {"text": "funcionario criado"}';
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});

//Editar funcionário
$app->put('/api/funcionario/update/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');	
	$nome = $request->getParam('nome');
	$sobrenome = $request->getParam('sobrenome');
	$idade = $request->getParam('idade');
	$sexo = $request->getParam('sexo');


	$sql = "UPDATE funcionarios SET
				nome   = :nome,
				sobrenome    = :sobrenome,
				idade        = :idade,
				sexo 	     = :sexo
			WHERE id = $id";

	try{
		//db
		$db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);


		$stmt-> bindParam(':nome',$nome);
		$stmt-> bindParam(':sobrenome',$sobrenome);
		$stmt-> bindParam(':idade',$idade);
		$stmt-> bindParam(':sexo',$sexo);

		$stmt->execute();

		echo '{"notice": {"text": "funcionario atualizado"}';
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});
//Remover funcionário
$app->delete('/api/funcionario/delete/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');	

	$sql = "DELETE FROM funcionarios WHERE id = $id";

	try{
		//db
		$db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);

		$stmt->execute();

		echo '{"notice": {"text": "funcionario apagado"}';
	}catch(PDOException $e){
		echo '{"error": {"text":' .$e->getMessage().'}';
	}

});