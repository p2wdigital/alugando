<?php 

namespace Plunder\Helpers\Cache;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
/**
* 
*/
class Cache 
{
	protected $finder;
	protected $files;

	public function __construct(Finder $finder, FileSystem $file){
		$this->finder 	= $finder;
		$this->file 	= $file;
		return $this;
	}

	/**
	 * [verifyChanges Verifica se houve alteracoes nos arquivos geradores de determinado cache]
	 * @param  [type] $path  [apelido do arquivo]
	 * @param  array  $files [Array com arquivos geradores do cache]
	 * @return [boolean]     [true: arquivos alterados, false: arquivos mantidos]
	 */
	public function verifyChanges($path, $files = array()){
		//inicializa as variavéis possiveis do cache;
		$filesCache 	= null;
		$contentCache	= null;
		$pathFile = $this->generatePath($path);

		//Se enviado array de files vazio, não temos com o 
		//que comparar, então consideramos como alterado
		if ($files === array()): 
			//TODO: Incluir informação no LOG de que o 
			//verifyChanges foi chamado sem os arquivos de origem
			return true;
		endif;
		
		//Monta caminho do arquivo em cache, se o arquivo 
		//não existe é considerado como alterado
		if(!$this->existsFile($path)):
			return true;
		endif;

		eval(file_get_contents($pathFiles));
		//Se as variaveis continuam com os valores iniciais
		//provavelmente tivemos algum erro no comando eval ou
		//o cache foi geredo de forma errada
		if($filesCache === null && $contentCache === null):
			throw new \ErrorException("Problemas no arquivo de cache eval", 1);
		endif;

		//Se não foi inicializado o filesCache geramos um arquivo sem parametros
		//para futuras comparacoes
		if($filesCache === null):
			//TODO: Incluir log arquivo em cache sem filesCache e contentCache Array
			return true;
		endif;

		//Se a quantidade de $files e $filesCache forem diferentes
		//temos um alteracao
		if(count($files) != count($filesCache))
			return true;

		//Valida se o timestamp de atualizacao é o mesmo para 
		//todos os arquivos;
		foreach ($files as $key => $value):
			if(!array_key_exists($value, $filesCache)):
				return true;
				break;
			else:
				$stat = stat($value);
				if ($stat["mtime"] != $filesCache[$value]):
					return true;
					break;
				endif;
			endif;

		endforeach;

		return false;
	}

	public function setCache($path, $content, $files){
		
	}

	public function getCache($path){
		eval(file_get_contents($this->generatePath($path)));
		return $contentCache;
	}

	public  function existsFile($path){
		return $this->files->exists($this->generatePath($path));
	}

	private function generatePath($path){
		return ENVIRONMENT . str_replace(".", "/", $path) . "/".$path .".cache";
	}




}