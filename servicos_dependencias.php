<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require "vendor/autoload.php";

    // Podemos definir caracteristicas do App quando o instanciamos
    $app = new \Slim\App(
        // array para configurações | JSON
        // displayErrorDetails -> Mostra detalhes de erro! Use apenas para testes, não em produção
        [
            'settings' => ['displayErrorDetails' => true]
        ]
    );

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

    // Buscando container e classes (dependencias)

    $container = $app->getContainer();

    $container['Home'] = function() {
        return new MyApp\controllers\Home(new MyApp\View);
    };

    // param 1 -> route
    // param 2 -> Classe a utilizada | O slim cria a instancia automaticamente
    $app->get('/usuario', 'Home:index');

    $app->run();
?>