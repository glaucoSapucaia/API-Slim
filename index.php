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

        return $response->getBody()->write($nome . ' | ' . $email);
    });

    // init app
    $app->run();
?>