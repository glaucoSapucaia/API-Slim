<?php
// Não esquece do NAMESPACE
    namespace MyApp\controllers;

    // instanciando controllers | class OBJ
    // O Slim cria objetos automaticamente ao chamarmos as classes junto da route, no metodo get(), por exemplo
    class Home {
        // attr container
        // protected $container;
        protected $view;

        // container injection | Use no contrutor
        public function __construct($view) {
            $this->view = $view;
        }

        public function index($request, $response) {
            // recuprando param request | Recperando Class View do container
            // $view = $this->container->get('View');

            // debug
            // var_dump($view);
            var_dump($this->view);

            return $response->write('Teste do metodo Index | Classe Home');
        }
    }
?>