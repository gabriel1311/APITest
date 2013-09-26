<?php if (!defined('BASEPATH')) die();


class Login extends CI_Controller {

   public function index(){
	  	   
	   $this->load->view('header');	   
	   $this->load->view('login');
	   
	   
   }
   
   
   
   public function verificaLogin(){
	  	   
   }
   
   
   public function logout(){
	   
	  $this->session->sess_destroy();
	  
	  $session_id = $this->session->userdata('session_id');
	  
	  if(empty($session_id))
	  {
		   
		   $this->load->view('header');
		   $this->load->view('login');
	  }
	   
   }
   
   
   
   public function recuperarSenha(){
	   $dados = array(
   			'buscarSenha' => 'sim',
   		);
	   
	   $this->load->view('header');
	   $this->load->view('login',$dados);
	   
   }
   
   
   
   public function enviaSenha(){
	   $email = $this->input->post('txtEmail');
	   
	   $this->load->model('login_m');
	   $dados = $this->login_m->enviaSenha($email);
	   
	   
	   
	   if(empty($dados['nome']))
	   {
		   $dados = array(
	     		'buscarSenha' => 'sim',
	   			'naoEncontrado' => '<div class="alert">Este e-mail não existe na Base de Dados. <br>Tente Novamente.</div>',
	   		);
		   
		   $this->load->view('header');
		   $this->load->view('login',$dados);
	   }
	   else
	   {
	   //envia o email com a senha
		   $config = Array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.gmail.com',
	      'smtp_port' => 465,
	      'smtp_user' => 'testeapicarros@gmail.com',
	      'smtp_pass' => 'senha123api',
	      'charset' => 'utf-8',
	      'mailtype' => 'html',
	      );


	      $this->load->library('email', $config);
	      $this->email->set_newline("\r\n");
	
	      $this->email->from('emailapitest@gmail.com', 'Teste API');
	      $this->email->to($email);
	
	
	      $this->email->subject('Recuperacao de Senha');
	      $this->email->message('<h3>Olá <b>'.$dados['nome'].'. </b></h3><h3>Sua senha é: <u>'. $dados['senha'].'</h3></u>');

	     if($this->email->send())
	     {
	     	$dados = array(
	   			'emailEnviado' => 'sim',
	   		);
		   
		   $this->load->view('header');
		   $this->load->view('login',$dados);
	     }
	     else
	     {
	     	echo "erro na aplicação, informe o suporte";
	     }
	   
	   }
	  	  
	  
	  
	  
	  /* 
	   */
   }
   
   
   
   public function validarUsuario(){
   
   		$dados = array(
   			'usuario' => $this->input->post('txtUser'),
   			'senha' => $this->input->post('txtSenha'),
   		);
	   
   		$this->load->model('login_m');
   		$q=$this->login_m->validar($dados);
   		
   		if($q == true)
   		{
   		    //tem login, a ideia é gravar na sessao e mandar para index	e registrar acesso 
   		    date_default_timezone_set('America/Sao_Paulo');
   		    $dataHora = date('d/m/Y');
   		    $dataHora .= ' - '. date("H:i:s");
   		    $dados1 = array(
					'usuario'=> $dados['usuario'],
					'data'=> $dataHora,
				);
				
			$this->login_m->gravaAcessoLog($dados1);
   		       
   		    $this->load->model('carros_m');
		 	$carros = $this->carros_m->retornaCarros();
		 	$ultimos = $this->carros_m->retornaUltimos(5);
		
		
			$dados = array(
				'carros' => $carros,
				'ultimos' => $ultimos,
			);
   
   		       
   		       
	   		$this->load->view('header');
	   		$this->load->view('frontpage',$dados);
	   		$this->load->view('footer');
   		}
   		else//erro no login
   		{
	   		$dados = array(
	     		'erroLogin' => 'sim',
	   		);
		   
		   $this->load->view('header');
		   $this->load->view('login',$dados);   		
		}
	   
   }
   
   
}