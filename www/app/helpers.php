<?php


if (!function_exists('redir')) {
    function redir($uri, $status = '302', $headers = [])
    {
        return new \Zend\Diactoros\Response\RedirectResponse($uri, $status, $headers);
    }
}


if (!function_exists('redirect')) {
    function redirect($uri, $data = [])
    {
        
        if (isset($data) AND is_array($data)) {
            $datas = implode('', $data);
            header("Location:{$uri}{$datas}");
            exit();
        } else {
            header("Location:{$uri}");
            exit();
        }
        
    }
}
