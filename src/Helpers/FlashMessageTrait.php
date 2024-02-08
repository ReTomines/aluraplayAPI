<?php 
// Traits ("características") é como adicionar características à outras classes. 
// funcionam como heranças horizontais. 
// Por exemplo, uma classe pode ter a característica de ter HTML e de ter flash messages.

declare(strict_types=1);

namespace Alura\Mvc\Helper;

trait FlashMessageTrait
{
    private function addErrorMassage(string $errorMassage): void{
        $_SESSION['error_message'] = $errorMassage;
    }
}

?>