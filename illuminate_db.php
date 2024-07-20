<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    // illuminate DB
    use Illuminate\Database\Capsule\Manager as Capsule;

    require "vendor/autoload.php";

    $app = new \Slim\App(
        [
            "settings" => [
                "displayErrorDetails" => true
            ]
        ]
    );
    
    // config container
    $container = $app->getContainer();

    // Conexão com DB
    $container['db'] = function() {
        // definindo capsule
        $capsule = new Capsule;

        // definindo conexão
        $capsule->addConnection(
            [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'slim',
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => ''
            ]
        );

        // tornando capsule uma instancia global
        $capsule->setAsGlobal();

        // Efetivando conexão
        $capsule->bootEloquent();

        return $capsule;
    };

    // routes
    $app->get('/usuarios', function(Request $request, Response $response) {
        // recuperando container | encadeando métodos
        $db = $this->get('db');

        // // configurações
        // // schema() -> manipula o DB

        // // dropIfExists() -> remove um elemento caso exuista
        // $db->schema()->dropIfExists('usuarios');

        // // create() -> cria elemento
        // $db->schema()->create('usuarios', function($table) {
        //     // increments() -> campo auto_increment
        //     $table->increments('id');

        //     // string -> campo varchar
        //     $table->string('nome');
        //     $table->string('email');

        //     // timestamps() -> Cria dois campos que retornam data de criação e atualização dos elementos
        //     $table->timestamps();
        // });


        // CRUD
        // insert into
        // $db->table('usuarios')->insert(
        //     [
        //         'nome' => 'José Ricardo',
        //         'email' => 'ricardo@teste.com'
        //     ]
        // );

        // $db->table('usuarios')->insert(
        //     [
        //         'nome' => 'Carlos Eduardo',
        //         'email' => 'carlosedu@teste.com'
        //     ]
        // );

        // update
        // $db->table('usuarios')
        //         ->where('id', 1)
        //         ->update(
        //             [
        //                 'nome' => 'José'
        //             ]
        //         );

        // delete
        // $db->table('usuarios')
        //         ->where('id', 1)
        //         ->delete();

        // listar dados | get()
        $usuarios = $db->table('usuarios')->get();

        foreach($usuarios as $usuario) {
            echo $usuario->nome . '<br>';
        }
    });

    $app->run();
?>