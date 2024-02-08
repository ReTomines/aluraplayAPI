<?php
//Autenticação do usuário

declare(strict_types=1);

namespace Alura\Mvc\Controller;
use Alura\Mvc\Helper\HtmlRendererTrait;


class LoginController implements Controller
{
    use FlashMessageTrait;
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=alura', 'root', '123456');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        $userData = $statement->fetch(\PDO::FETCH_ASSOC);
        $correctPassword = password_verify($password, $userData['password'] ?? '');

        if ($correctPassword) {
            $_SESSION['logado'] = true;
            header('Location: /');
        } else {
            $this->addErrorMessage("Usuário ou senha inválido.");
            header('Location: /login');
        }
    }
}