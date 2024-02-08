<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

abstract class ControllerWithHtml implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';
    
    protected function renderTemplate(string $templateName, array $context = []): string
    {   
        extract($context);
        
        // Iniciar um buffer de saída ()Output Buffer)
        ob_start();

        require_once self::TEMPLATE_PATH . $templateName . '.php';

        // Retornar o buffer - ob_get_contents()
        // Limpar o buffer - ob_clean()

        // Retorna e limpa o buffer
        return ob_get_clean();
    }
}