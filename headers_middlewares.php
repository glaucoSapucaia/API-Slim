<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require "vendor/autoload.php";

    $app = new \Slim\App(
        [
            "settings" => [
                "displayErrorDetails" => true
            ]
        ]
    );

    $app->get('/', function(Request $request, Response $response) {
        return $response->getBody()->write("My App Slim ON!");
    });

    // Tipos de respostas | cabeçalho, txt, JSON, XML
    // Cabeçalhos
    $app->get('/header', function(Request $request, Response $response) {
        $response->write("retorno HEADER!");

        // withHeader() -> Manipula elementos do cabeçalho
        // allow ->param de permissão | method -> PUT
        return $response->withHeader('allow', 'PUT')
                        //  encadeando métodos
                        // definindo tamanho (length) da resposta               
                        ->withAddedHeader('Content-length', 5);
    });

    // JSON
    $app->get('/json', function(Request $request, Response $response) {
        return $response->withJson(
            [
                "nome" => "João Silva",
                "email" => "joao@teste.com",
                "apelido" => "Jaumzin"
            ]
            );
    });

    // XML
    $app->get('/xml', function(Request $request, Response $response) {
        // file_get_contents() -> Carrega arquivos locais
        $xml = file_get_contents('teste.xml');

        $response->write($xml);
        return $response->withHeader('Content-Type', 'application/xml');
    });

    // middleware
    // add() -> adiciona middleware
    // com função anonima | next= próximo middleware a ser executado
    $app->add(function(Request $request, Response $response, $next) {
        $response->write("middleware inicio | 1 | ----> ");

        // next() -> possibilita a continuidade do código (acesso a routes)
        $response = $next($request, $response);

        // Valindando também a saida do niddleware
        $response->write(" | ----> middleware fim | 1 |");

        return $response;
    });

    $app->add(function(Request $request, Response $response, $next) {
        $response->write("middleware inicio | 2 | ----> ");

        // next() -> possibilita a continuidade do código (acesso a routes)
        $response = $next($request, $response);

        // Valindando também a saida do niddleware
        $response->write(" | ----> middleware fim | 2 |");

        return $response;
    });

    // $app->add(function(Request $request, Response $response, $next) {
    //     $response->write("middleware | 2 | ----> ");

    //     // next() -> possibilita a continuidade do código (acesso a routes)
    //     return $next($request, $response);
    // });

    $app->get('/usuarios', function(Request $request, Response $response) {
        $response->write('Route usuarios');
    });

    $app->get('/postagens', function(Request $request, Response $response) {
        $response->write('Route postagens');
    });

    $app->run();
?>