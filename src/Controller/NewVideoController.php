<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            $this->addErrorMessage("URL inválida.");
            header('Location: /novo-video');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            $this->addErrorMessage("Título não informado.");
            header('Location: /novo-video');
            return;
        }

        $video = new Video($url, $titulo);
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);

            // Verificar o tipo de arquivo usando uma biblioteca mais robusta
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mineType = $finfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mineType, 'image/')){
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName 
                );
                $video->setFilePath($safeFileName);
            }
        }

        $success = $this->videoRepository->add($video);
        if ($success === false) {
            $this->addErrorMessage("Erro ao cadastrar vídeo.");
            header('Location: /novo-video');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
