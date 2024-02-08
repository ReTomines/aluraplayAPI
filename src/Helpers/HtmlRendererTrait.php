<?php
// Essa Trait substitui o controller ControllerWithHtml.php (para histórico, ver na pasta lixo)

declare(strict_types=1);

namespace Alura\Mvc\Helpers;

trait HtmlRendererTrait
{
    // Não é suportado pelo php Traits terem constantes
    
    private function renderTemplate(string $templateName, array $context = []): string
    {   
        $templatePath = __DIR__ . '/../../views/';
        extract($context);
        
        ob_start();// Iniciar um buffer de saída ()Output Buffer)
        require_once $templatePath . $templateName . '.php';
        return ob_get_clean(); // Retorna e limpa o buffer
        
    }
}