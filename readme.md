# Carriers
Teste PHP Carriers

Instruções:

Fornecer propriedades do banco no arquivo db.php, tabela funcionarios e campos criados conforme nome informado no teste;

endpoints

Relatório geral de funcionários
http://localhost/carriers/public/api/funcionarios

Cadastrar

http://localhost/carriers/public/api/funcionario/add

Funcionário Específico

http://localhost/carriers/public/api/funcionario/id_do_funcionario

Editar

http://localhost/carriers/public/api/funcionario/update/id_do_funcionario

Remover

http://localhost/carriers/public/api/funcionario/delete/id_do_funcionário

_________________________________________________//__________________________________________________________________________________

Exemplos

relatório geral
request
GET http://localhost/carriers/public/api/funcionarios
response
status 200 OK
[
{
id: "2",
nome: "Sam",
sobrenome: "Smith",
idade: "35",
sexo: "f"
},
{
id: "3",
nome: "Bruno",
sobrenome: "Fernandes",
idade: "26",
sexo: "m"
},
{
id: "4",
nome: "Jhon",
sobrenome: "Doe",
idade: "33",
sexo: "m"
}
]

_________________________________________________//__________________________________________________________________________________

Cadastrar
request 
POST http://localhost/carriers/public/api/funcionario/add
{
	"nome" : "Bruno",
	"sobrenome" : "Fernandes",
	"idade" : "26",
	"sexo" : "m"
}
response
status 200 OK
{"notice": {"text": "funcionario criado"}

_________________________________________________//__________________________________________________________________________________

Funcionário Específico
GET http://localhost/carriers/public/api/funcionario/4
response
status 200 OK
{
id: "4",
nome: "Jhon",
sobrenome: "Doe",
idade: "33",
sexo: "m"
}

_________________________________________________//__________________________________________________________________________________

Editar funcionário
request
PUT http://localhost/carriers/public/api/funcionario/update/3
{
"nome" : "Bruno",
"sobrenome" : "Fernandes",
"idade" : "26",
"sexo" : "m"
}
response
status 200 OK
{"notice": {"text": "funcionario atualizado"}

_________________________________________________//__________________________________________________________________________________

Remover funcionário
request
DELETE http://localhost/carriers/public/api/funcionario/4

response 
status 200 OK
{"notice": {"text": "funcionario apagado"}

_________________________________________________//__________________________________________________________________________________
Relatório de dados solicitados
request
GET http://localhost/carriers/public/api/funcionarios/relatorio
response
status 200 OK
[
[
{
Funcionarios do sexo masculino: "4"
}
],
[
{
Funcionarios do sexo feminino: "1"
}
],
[
{
Idade media dos funcionarios: "29"
}
],
[
{
Idade do funcionario mais velho: "35"
}
],
[
{
Idade do funcionario mais novo: "26"
}
]
]
_________________________________________________//__________________________________________________________________________________

