<?php 

namespace Plunder\Core\HttpRequest;
use Plunder\Core\Config\Config;

/**
* Class Response
*/
class RedirectResponse extends Response
{
	public function __construct($url, $status = 302){
		header(sprintf("Location: %s", $url),TRUE,$status);
		$this->setContent(
            sprintf('<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="1;url=%1$s" />
        <title>Redirecionando para %1$s</title>
    </head>
    <body>
        Redirecionando to <a href="%1$s">%1$s</a>.
    </body>
</html>', htmlspecialchars($url, ENT_QUOTES, 'UTF-8')));

	}



}