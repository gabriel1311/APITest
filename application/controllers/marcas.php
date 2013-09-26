<?php if (!defined('BASEPATH')) die();


class Marcas extends CI_Controller {


	public function newMarca(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$action = array(
			'action' => "nova_marca",
			'admin'=> "admin",
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');		
	}
	
	
	//editar marca buscada
	public function editar(){
	
	if( ! $this->session->userdata('logado')) redirect('login');

		$this->load->model('marcas_m');

		$retorno = $this->marcas_m->editarMarca($this->uri->segment(3),$this->input->post('txtNomeMarca'));
		
		$marcas = $this->marcas_m->retornaMarcas();
		
		$dados = array(
			'action' => "buscar_marca",
			'admin'=> "admin",
			'marca_atualizada' => $retorno,
			'marcas' => $marcas,
		);
		
		$this->load->view('header',$dados);				
		$this->load->view('admin',$dados);	
		$this->load->view('footer');
		
	}
	
	
	
	
	
	//carrega marca para alterar
	public function buscarMarca(){
	
	if( ! $this->session->userdata('logado')) redirect('login');

		$this->load->model('marcas_m');
		$retorno = $this->marcas_m->buscarMarca($this->uri->segment(3));
		
		$dados = array(
			'action' => "nova_marca",
			'admin'=> "admin",
			'marca_carregada' => $retorno,
		);
		
		$this->load->view('header',$dados);				
		$this->load->view('admin',$dados);	
		$this->load->view('footer');
		
	}
	
	
	
	
	
	public function excluir(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->model('marcas_m');
		$q = $this->marcas_m->excluir($this->uri->segment(3));
		
		$this->load->model('marcas_m');
		$marcas = $this->marcas_m->retornaMarcas();
		
		if($q == 'sucesso')
		{
			$excluir = 'sim';			
		}
		if($q == 'erro')
		{
			$excluir = 'nao';
		}
		if($q == 'marca_em_uso')
		{
			$excluir = 'em_uso';
		}
		
		$action = array(
					'action' => "buscar_marca",
					'admin'=> "admin",
					'excluirMarca' => $excluir,
					'marcas' => $marcas,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');
		
	}

	
	
	
	public function searchMarca(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->model('marcas_m');
		$marcas = $this->marcas_m->retornaMarcas();
	
		
		$action = array(
			'action' => "buscar_marca",
			'admin'=> "admin",
			'marcas' => $marcas,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');		
	}


	
	
	public function inserir(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->helper('date');
	
		$dados = array(
			'nome_marca'    => $this->input->post('txtNomeMarca'),
			'data_cadastro' => mdate('%Y-%m-%d',time()),
			'id_usuario'    => $this->session->userdata('id_user')
		);
				
		$this->load->model('marcas_m');
		$q = $this->marcas_m->inserir($dados);	
		
		if($q == 'duplicado')
		{
				$action = array(
				'action' => "nova_marca",
				'admin'=> "admin",
				'nova_marca' => 'duplicado',
				);
			
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');
		}	
		
		if($q == 'sucesso')//sucesso ao cadastrar a marca
		{
				
				$action = array(
				'action' => "nova_marca",
				'admin'=> "admin",
				'nova_marca' => 'sucesso',
				);
			
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');
		}
		
		if($q == 'erro')//erro no cadastro da marca
		{
				$action = array(
				'action' => "nova_marca",
				'admin'=> "admin",
				'nova_marca' => 'erro',
				);
			
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');
		}		
	}





}