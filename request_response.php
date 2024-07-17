<?php
    // Imports
    // Iterface que define o tipo das requests e responses (requisições e respostas)
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    // autoload
    require 'vendor/autoload.php';

    // app
    $app = new \Slim\App;

    // routes

    $app->get('/', function(Request $request, Response $response) {
        $response->getBody()->write('Index on!');
    });

    // Tipando request e response
    $app->get('/postagens', function(Request $request, Response $response) {
        // PADRÂO PSR-7
        // getBody()-> Acessa corpo da ResponseInterface
        // write()-> Escreve no obj chamado
        $response->getBody()->write('Lista de Postagens');

        return $response;
    });

    // Tipos de requisição | Verbos HTTP
        // get -> recupera recursos do servidor (select)
        // post -> Cria dados no servidor (insert)
        // put -> Atualiza dados no servidor (update)
        // delete -> Deleta dados no servidor (delete)

    $app->post('/usuarios/adiciona', function(Request $request, Response $response) {
        // Recuoerando dados $_POST (Postman)
        // getParseBody() -> recupera dados de forms (post)
        $post = $request->getParsedBody();
        $nome = $post['nome'];
        $email = $post['email'];

        // Faça sua lógica para insert into DB

        return $response->getBody()->write('Dados salvos no DB via post request!');
    });

    $app->put('/usuarios/atualiza', function(Request $request, Response $response) {
        // Recuoerando dados $_POST (Postman)
        // getParseBody() -> recupera dados de forms (post)
        $post = $request->getParsedBody();
        $id = $post['id'];
        $nome = $post['nome'];
        $email = $post['email'];

        // Faça sua lógica para update DB

        return $response->getBody()->write('Dados ATUALIZADOS no DB via put request!');
    });

    $app->delete('/usuarios/remove/{id}', function(Request $request, Response $response) {
        $id = $request->getAttribute('id');

        // Faça sua lógica para delete no DB

        return $response->getBody()->write('Usuário removido | ID: ' . $id);
    });

    // init app
    $app->run();
?>