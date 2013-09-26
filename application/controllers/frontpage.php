<?php if (!defined('BASEPATH')) die();


class Frontpage extends CI_Controller {

   public function index()
	{   
		//$this->load->view('testes');
		
		 if( ! $this->session->userdata('logado')) redirect('login');
		
		 $logado = $this->session->userdata('logado');
	   
		 if(empty($logado))
		 {
		   $this->load->view('header');
		   $this->load->view('login');
		 }
		 else
		 {
		 
		 
		 	$this->load->model('carros_m');
		 	$carros = $this->carros_m->retornaCarros();
		 	$ultimos = $this->carros_m->retornaUltimos(5);
		
		
			$dados = array(
				'carros' => $carros,
				'ultimos' => $ultimos,
			);

		 
		 
		   $this->load->view('header');	
		   $this->load->helper('url');
		   $this->load->view('frontpage',$dados);
		   $this->load->view('footer');
		 }	

	
	}
	
	
	
	
	
	
		public function buscaCarroTxt(){
		
		if( ! $this->session->userdata('logado')) redirect('login');
		
		$this->load->model('carros_m');
		
		$carros = $this->carros_m->retornaCarros();
		$ultimos = $this->carros_m->retornaUltimos(5);
		
        $txtBusca = $this->input->post('txtBusca');
		
		$busca = $this->carros_m->buscarCarroTxt($txtBusca);
		$dados = array(
			'carrosBuscaTxt' => $busca,	
			'ultimos' => $ultimos,	
		);
		
		$this->load->view('header');	
		$this->load->helper('url');
		$this->load->view('frontpage',$dados);
		$this->load->view('footer');
		
	}
	
	
	
	
	
	
	
	public function buscaCarroId(){
		
		if( ! $this->session->userdata('logado')) redirect('login');
		
		
		$this->load->model('carros_m');
		
		$carros = $this->carros_m->retornaCarros();
		$ultimos = $this->carros_m->retornaUltimos(5);
		
        $idBusca = $this->uri->segment(3);
		
		$busca = $this->carros_m->buscarCarroId($idBusca);
		$dados = array(
			'carrosBuscaId' => $busca,	
			'ultimos' => $ultimos,	
		);
		
		$this->load->view('header');	
		$this->load->helper('url');
		$this->load->view('frontpage',$dados);
		$this->load->view('footer');
		
	}
	
	
	
	
	
	public function admin(){
	
		if( ! $this->session->userdata('logado')) redirect('login');
		
		 $logado = $this->session->userdata('logado');
	   
		 if(empty($logado))
		 {
		   $this->load->view('header');
		   $this->load->view('login');
		 }
		 else
		 {
		 	$action = array(
			'action' => "",
			'admin'=> "admin",
			'info'=>"sim",
			);		
			
			
			$this->load->view('header',$action);				
			$this->load->view('admin',$action);	
			$this->load->view('footer');
		}
	
		
	}
	
	
	
	
	
	
	
		
	
	
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
