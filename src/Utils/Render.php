<?php

namespace App\Utils;

class Render
{
    /**
     * cuida de importar e carregar uma view
    */
    public static function load(string $view, array $args = [])
    {
        // recupera as mensagens flash
        $flashMessages = Flash::all();
        $args = array_merge($args, ['flash' => $flashMessages]);

        /**
         * pega um array e quebra as associações em váriáveis
         * ex: ['nome' => 'arthur', 'idade' => 19]
         * vira: $nome = 'arthur' e $idade => 19
         */
        extract($args);

        /**
         * pega o conteúdo da view usando um buffer e limpa ele
         * esse 'conetúdo' é a parte única da view (dashoard, tabela, formulário...)
         * tudo isso fica encapsulado em $content
        */
        ob_start();
        require __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean(); 

        // Inclui o layout base, abre ele se quiser ver como $content é usdo
        require __DIR__ . "/../Views/layout.php";
    }
}