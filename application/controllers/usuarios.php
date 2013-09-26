<?php if (!defined('BASEPATH')) die();

class Usuarios extends CI_Controller {


	public function newUser(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$action = array(
			'action' => "novo_usuario",
			'admin'=> "admin",
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');
		
	}
	
	
	
	
	public function excluir(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
	
		if($this->session->userdata('perfil') != 'admin') 
		{
			redirect('login','logout');
		}
		
		
		$this->load->model('usuarios_m');
		$retorno = $this->usuarios_m->excluir($this->uri->segment(3));
		$usuarios = $this->usuarios_m->retornaUsuarios();
				
		$action = array(
					'action' => "busca_usuario",
					'admin'=> "admin",
					'excluirUsuario' => $retorno,
					'usuarios' => $usuarios,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');
		
	}



	//editar usuario buscado
	public function editar(){
	
	if( ! $this->session->userdata('logado')) redirect('login');

		$this->load->model('usuarios_m');
		
		$dadosNovos = array(
			'nome'=> $this->input->post('txtNomeUser'),
			'email'=> $this->input->post('txtEmail'),
			'id_user'=> $this->input->post('txtId'),
			'login'=> $this->input->post('txtLogin'),
			'perfil'=> $this->input->post('rdPerfil')
		);
				

		$retorno = $this->usuarios_m->editarUsuario($dadosNovos);
		
		$usuarios = $this->usuarios_m->retornaUsuarios();
		
		$dados = array(
			'action' => "busca_usuario",
			'admin'=> "admin",
			'usuario_atualizado' => $retorno,
			'usuarios' => $usuarios,
		);
		
		$this->load->view('header',$dados);				
		$this->load->view('admin',$dados);	
		$this->load->view('footer');
		
	}
	
	
	
	
	//carrega usuario para alterar
	public function buscarUsuario(){
	
	if( ! $this->session->userdata('logado')) redirect('login');

		$this->load->model('usuarios_m');
		$retorno = $this->usuarios_m->buscarUsuario($this->uri->segment(3));
		
		$dados = array(
			'action' => "novo_usuario",
			'admin'=> "admin",
			'usuario_carregado' => $retorno,
		);
		
		$this->load->view('header',$dados);				
		$this->load->view('admin',$dados);	
		$this->load->view('footer');
		
	}

	
	
	
	
	
	
	
	//retorna todos usuarios
	public function searchUser(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
	
		$this->load->model('usuarios_m');
		$usuarios = $this->usuarios_m->retornaUsuarios();
		
		$dados = array(
			'action' => "busca_usuario",
			'admin'=> "admin",
			'usuarios' => $usuarios,
		);
		
		$this->load->view('header',$dados);			
		$this->load->view('admin',$dados);	
		$this->load->view('footer');
		
	}
	
	
	
	
	
	public function inserir(){	
	
	if( ! $this->session->userdata('logado')) redirect('login');
			//recebendo os dados =ok
		$dados = array(
			'nome'=> $this->input->post('txtNomeUser'),
			'email'=> $this->input->post('txtEmail'),
			'login'=> $this->input->post('txtLogin'),
			'senha'=> $this->input->post('txtSenha'),
			'perfil'=> $this->input->post('rdPerfil')
		);
		
		if(($dados['nome'] == "") || ($dados['login'] == "") || ($dados['senha'] == "") || ($dados['perfil'] == "" || ($dados['email'] == "")))//tudo deve ser preenchido para continuar
		{
				$action = array(
				'action' => "novo_usuario",
				'admin'=> "admin",
				'inserir'=>"erro",
				);
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');

		}
		else
		{
			$this->load->model('usuarios_m');
			$q = $this->usuarios_m->inserir($dados);
		
			if($q)//entra se inseriu no db
			{
						
				$action = array(
				'action' => "novo_usuario",
				'admin'=> "admin",
				'inserir'=>"ok",
				);		
			}
			else//nao insere e informa erro
			{
				$action = array(
				'action' => "novo_usuario",
				'admin'=> "admin",
				'inserir'=>"erro",
				);
			}
			
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');
		}
			
		
		
		
	}

	
	
}