<?php 

namespace Plunder\Core\HttpRequest;
use Plunder\Core\Config\Config;

/**
* Class Response
*/
class Response
{
	protected $content;
	protected $status;
	protected $headers 		= array();

    public static $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',                      // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    );
	public function __construct($content = "", $status = 200, $headers = array()){
		header('Content-Type: text/html; charset=' . Config::get("plunder.charset"));
		$this->setContent($content);
		$this->setStatusCode($status);
		$this->setHeaders($headers);
	}

	public function setContent($content){
		$this->content = $content;
		return $this;
	}

	public function setStatusCode($status){
		if(array_key_exists($status, self::$statusTexts)):
			$this->status = $status;
			$status = sprintf("%s %d %s",$_SERVER["SERVER_PROTOCOL"], $status, self::$statusTexts[$status]);
			$this->setHeader($status);
		else:
			throw new \Exception("Codigo de status inválido " . $status, 500);
		endif;
		
		return $this;
	}

	public function setContentType($value){
		$this->setHeader("Content-Type: " .$value);
		return $this;
	}

	public function setHeader($value){
		$this->headers[] = $value;
	}

	public function setHeaders(array $value){
		$this->header = $value;
	}

	public function send(){
		foreach ($this->headers as $key => $value):
			header($value);
		endforeach;
		echo $this->content;
		
	}


}