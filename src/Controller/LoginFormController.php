<?php
declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helpers\HtmlRendererTrait;


class LoginFormController /*extends ControllerWithHtml*/ implements Controller
{
        use HtmlRendererTrait;

        public function processaRequisicao(): void
        {
                if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
                        header('Location: /');
                        return;
                }

                echo $this->renderTemplate('login-form');
        }
}