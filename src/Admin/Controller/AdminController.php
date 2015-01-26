<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;

use Table\Model\Cliente;
use Table\Model\ClienteQuery;
use Table\Model\User;
use Admin\Form\ClienteType;
use Plunder\Form\Form;

use Propel\Runtime\Propel;
/**
* @Route("/") 
*/
class AdminController extends Controller
{

	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		$con = Propel::getWriteConnection('default');
		$con->useDebug(true);
		
		$cliente = ClienteQuery::create()->select(array('RazaoSocial', 'Contato'))->find();
		
		var_dump($con->getLastExecutedQuery());
		return $this->render("Admin:Admin:index.html.twig", array("cliente"=>$cliente));
	}

	/**
	 * @Route("/insert", name="admin_insert")
	 */
	public function insertAction(Request $request){
		$cliente = new Cliente();
		$form = new Form(new ClienteType(), $cliente);
		var_dump($request->request);


		return $this->render("Admin:Admin:insert.html.twig", array("form"=>$form->createView()));
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($user, $id ){
		$cliente = new Cliente();
		$cliente->setRazaoSocial("Wep2 Locações");
		$cliente->setContato("Paulo Alexandre");
		
		$usuario = new User();
		$usuario->setPassword('143486');
		$usuario->setSalt('Set Cliente');
		//$usuario->getCliente();
		$cliente->setUser($usuario);

		$cliente->save();
		echo $cliente->getId();
		//echo $cliente->getId() . $user;
	}


}