<?php

namespace App\Views;

use Akuren\Session\FlashMessageService;
use Akuren\Session\Session;
use App\Views\Extensions\AssetExtension;
use App\Views\Extensions\AuthExtension;
use App\Views\Extensions\CsrfExtension;
use App\Views\Extensions\DumpExtension;
use App\Views\Extensions\ErrorsExtension;
use App\Views\Extensions\FlashMessageExtension;
use App\Views\Extensions\FormExtension;
use App\Views\Extensions\MarkdownExtension;
use App\Views\Extensions\MembersExtension;
use App\Views\Extensions\MonthExtension;
use App\Views\Extensions\NowExtension;
use App\Views\Extensions\PasswordExtension;
use App\Views\Extensions\PaymentIcon;
use App\Views\Extensions\RealpathExtension;
use App\Views\Extensions\ProjectDurationExtention;
use App\Views\Extensions\SlugExtension;
use App\Views\Extensions\StatusExtension;
use Psr\Http\Message\ResponseInterface;
use Spipu\Html2Pdf\Html2Pdf;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Zend\Diactoros\Response;


class View
{
    protected $twig;
    protected $viewPath;
    
    public function render(ResponseInterface $response, $view, array $data = []): ResponseInterface
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../resources/views');
        $twig = new  Twig_Environment($loader, [
            'cache' => false //__DIR__.'/../../bootstrap/cache',
        ]);
        
        $twig->addExtension(new MarkdownExtension());
        $twig->addExtension(new ErrorsExtension());
        $twig->addExtension(new AssetExtension());
        $twig->addExtension(new CsrfExtension());
        $twig->addExtension(new ProjectDurationExtention());
        $twig->addExtension(new StatusExtension());
        $twig->addExtension(new SlugExtension());
        $twig->addExtension(new AuthExtension());
        $twig->addExtension(new PasswordExtension());
        $twig->addExtension(new NowExtension());
        $twig->addExtension(new MonthExtension());
        $twig->addExtension(new DumpExtension());
        $flash = new FlashMessageService(new Session());
        
        $twig->addExtension(new FlashMessageExtension($flash));
        
        
        $response->getBody()->write($twig->render($view, $data));
        return $response;
    }
    
    
    public function Json(array $data = []): ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        
        return $response->withStatus(202);
        
    }

    public function viewSimple($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require  (dirname($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR).'/resources/views/'. str_replace('.', '/', $view) .".php");
    }
}