<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helpers\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;

class VideoListController /*extends ControllerWithHtml*/ implements Controller
{
    use HtmlRendererTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    { 
        $videoList = $this->videoRepository->all();
        echo $this->renderTemplate(
            'video-list',
            ['videoList' => $videoList]
        );
    }
}
