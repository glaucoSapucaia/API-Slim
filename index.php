<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require "vendor/autoload.php";

    $app = new \Slim\App;

    $app->get('/', function(Request $request, Response $response) {
        $response->getBody()->write('My Slim API ON!');
    });

    // Container Dependency Injection
    class Servico {

    }

    $servico = new Servico;

    // use ($servico) -> Acessa container externos ao Slim | Não muito utilizado

    // Pimple Container
    // insanciando container
    $container = $app->getContainer();

    // definindo container
    $container['servico'] = function() {
        return new Servico;
    };

    $app->get('/servico', function(Request $request, Response $response) {
        // recuperando container | Injeção de dependencia
        $servico = $this->get('servico');

        var_dump($servico);
    });

    // Controller como Serviço
    // $app->get('/usuario', 'Classe:metodo'{

    // });

    $app->run();
?>