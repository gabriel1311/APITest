<?php if (!defined('BASEPATH')) die();


class Carros extends CI_Controller {


	public function newCar(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
	
		$this->load->model('marcas_m');
		$marcas = $this->marcas_m->retornaMarcas();
		
		
		
		$action = array(
			'action' => "novo_carro",
			'admin'=> "admin",
			'marcas' => $marcas,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');		
	}
	
	
	
	
	
	public function excluir(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->model('carros_m');
		$q = $this->carros_m->excluir($this->uri->segment(3));
		
		$this->load->model('carros_m');
		$carros = $this->carros_m->retornaCarros();
		
		if($q == 'sucesso')
		{
			$excluir = 'sim';			
		}
		else
		{
			$excluir = 'nao';
		}
		
		$action = array(
					'action' => "buscar_carro",
					'admin'=> "admin",
					'excluir' => $excluir,
					'carros' => $carros,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');
		
	}
	
	
	
	
	
	public function searchCar(){
		
		if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->model('carros_m');
		$carros = $this->carros_m->retornaCarros();
		
		
		$action = array(
			'action' => "buscar_carro",
			'admin'=> "admin",
			'carros' => $carros,
		);
		
		$this->load->view('header',$action);				
		$this->load->view('admin',$action);	
		$this->load->view('footer');		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function inserir(){
	
	if( ! $this->session->userdata('logado')) redirect('login');
	
		$config['upload_path'] = './fotos/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			
			$action = array(
			'action' => "novo_carro",
			'admin'=> "admin",
			'error' => $this->upload->display_errors(),
			);
			
			$this->load->view('header',$action);				
			$this->load->view('admin',$action);	
			$this->load->view('footer');

		}	
		else//sucesso no upload da imagem, continua com os demais..
		{
			
			$action = array(
			'action' => "novo_carro",
			'admin'=> "admin",
			'upload_data' => $this->upload->data(),
			);
			
			
			
			$this->load->helper('date');
			
			$valorCru = $this->input->post('txtValor');
			
			include_once('classes/clsMetodos.php');
			$metodo = new Metodos();
			$valor = $metodo->FormataValorRealParaGravar($valorCru);
		
			//tratar antes de mandar pro banco
		
			$dados = array(
				'modelo' => $this->input->post('txtModelo'),
				'id_marca' => $this->input->post('sbMarca'),
				'ano' => $this->input->post('txtAno'),
				'foto' => $action['upload_data']['file_name'],
				'valor' => $valor,
				'max_parcelas' => $this->input->post('sbParcelas'),
				'data_cadastro' => mdate('%Y-%m-%d',time()),
				'id_usuario' => $this->session->userdata('id_user'),
			);
			
			$this->load->model('carros_m');
			$q = $this->carros_m->inserir($dados);
			
			
			if($q=='erro')
			{
				$caminho = $action['upload_data']['full_path'];
				unlink($caminho);
				
				$action = array(
					'action' => "novo_carro",
					'admin'=> "admin",
					'novo_carro' => $q,
				);
				
				
			}
			
			if($q=='duplicado')
			{
				$caminho = $action['upload_data']['full_path'];
				unlink($caminho);			
				
				$action = array(
					'action' => "novo_carro",
					'admin'=> "admin",
					'novo_carro' => $q,
				);

				
			}
			if($q=='sucesso')
			{
				$action = array(
					'action' => "novo_carro",
					'admin'=> "admin",
					'novo_carro' => $q,
				);
				
							
			}
			
				$this->load->view('header',$action);				
				$this->load->view('admin',$action);	
				$this->load->view('footer');
			
			
			
		}
	
	
	
	
		
		
		
	}

	
	
}