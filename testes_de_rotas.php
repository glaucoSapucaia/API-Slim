<?php
    // Importando autoload
    require 'vendor/autoload.php';

    // instanciando app
    $app = new \Slim\App;

    // get() -> declara rotas
    // param 1 -> route
    // pram 2 -> ação
    $app->get('/postagens2', function() {
        echo 'Lista de postagens';
    });

    // {} -> define valores/variaveis (placeholder) dinâmicos para a url | são obrigatórios
    // [] -> Define valore dinâmico como OPCIONAL
    $app->get('/usuarios[/{id}]', function($request, $response) {
        // getAttribute() -> recupera attrs da requisição
        $id = $request->getAttribute('id');

        echo 'Lista de usuários | ID: ' . $id;
    });

    // [[]] -> sub valores opcionais
    $app->get('/postagens[/{ano}[/{mes}]]', function($request, $response) {
        $ano = $request->getAttribute('ano');
        $mes = $request->getAttribute('mes');

        echo 'Lista de postagens | Ano: ' . $ano . ' | Mês: ' . $mes;
    });

    // Definindo diversos valores oara a url
    // .* -> aceita qq valor como param
    $app->get('/lista/{itens:.*}', function($request, $response) {
        $itens = $request->getAttribute('itens');

        // debug
        // echo $itens;

        // exbindo diversos itens
        // var_dump() -> retorna uma string com identificação do obj chamado
        // explode() -> divide strings a partir de um caractere demilitador
        var_dump(explode('/', $itens));

    });

    // Nomeando rotas
    $app->get('/blog/postagens/{id}', function($request, $response) {
        $id = $request->getAttribute('id');

        echo "lista de posts por ID | ID: " . $id;

    // Defina um nome para a rota
    })->setName('blog');

    $app->get('/meusite', function($request, $response) {
        // get('router')-> Captura rota declarada
        // pathFor()-> indica caminho para rota nomeada | pode incluir params
        $retorno = $this->get('router')->pathFor('blog', ["id" => "19"]);

        echo $retorno;
    });

    // Agrupando rotas
    // group() -> cria grupos de rotas
    $app->group('/v1', function() {
        $this->get('/usuarios', function() {
            echo 'Lista de usuários V1';
        });

        $this->get('/postagens', function() {
            echo 'Lista de postagens V1';
        });
    });

    // run() -> executa app
    $app->run();
?>