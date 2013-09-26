<?php

class Carros_m extends CI_Model{
	
	
	
	    //inserir nova marca
		public function inserir($dados){
		
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM carro WHERE modelo = '$dados[modelo]' AND ano = '$dados[ano]' ");

			if($query->num_rows() == 0)
			{
			   $q = $this->db->insert('carro',$dados);
			
				if($q)
				{
					return 'sucesso';
				}
				else
				{	
					return 'erro';
				}
			}
		    else
		    {
				return 'duplicado';
		    }
		
		}//fim funcao inserir
		
		
		
		
		
		
		//funcao excluir carro
		public function excluir($idCarro){
			
			$this->load->database();
			
			$this->db->select('foto');
			$this->db->from('carro');
			$this->db->where('id_carro', $idCarro);
			$get = $this->db->get();
			$foto = $get->result_array();
			$foto = $foto['0']['foto'];
			
			unlink(FCPATH.'fotos/'.$foto);
			
			$this->db->where('id_carro', $idCarro);
			if( ! $this->db->delete('carro'))
			{
				return "erro";
			}
			else
			{
				return "sucesso";
			}
			
			
		}
		
		
		
		
		//ultimos carros
		public function retornaUltimos($qtd){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM carro ORDER BY id_carro DESC LIMIT $qtd");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_carro'.$cont] = $linha->id_carro;
				   		$dados['modelo'.$cont] = $linha->modelo;
				   		$dados['ano'.$cont] = $linha->ano;
				   		$cont++;		
				    }
        
			return($dados);
			
		}
		
		
		
		
		
		
		//busca carro pelo TXT
		public function buscarCarroTxt($txtBusca){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM carro WHERE modelo LIKE '%$txtBusca%'");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_carro'.$cont] = $linha->id_carro;
				   		$dados['modelo'.$cont] = $linha->modelo;
				   		
				   		$this->db->select('nome_marca');
				   		$this->db->from('marca');
				   		$this->db->where('id_marca', $linha->id_marca);
				   		$get = $this->db->get();
				   		$marca = $get->result_array();

				   		$dados['id_marca'.$cont] = $marca['0']['nome_marca'];
				   		$dados['ano'.$cont] = $linha->ano;
				   		$dados['foto'.$cont] = $linha->foto;
				   		$dados['valor'.$cont] = $linha->valor;
				   		$dados['max_parcelas'.$cont] = $linha->max_parcelas;
				   		$dados['data_cadastro'.$cont] = $linha->data_cadastro;
				   		
				   		$this->db->select('nome');
				   		$this->db->from('user');
				   		$this->db->where('id_user', $linha->id_usuario);
				   		$get = $this->db->get();
				   		$nome = $get->result_array();
				   		$dados['id_usuario'.$cont] = $nome['0']['nome'];
				   		$cont++;		
				    }
    
			return($dados);
			
			
		}
		
		
		
		
		
		
		
		
		
		//busca carro pelo ID
		public function buscarCarroId($idBusca){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM carro WHERE id_carro = $idBusca");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_carro'.$cont] = $linha->id_carro;
				   		$dados['modelo'.$cont] = $linha->modelo;
				   		
				   		$this->db->select('nome_marca');
				   		$this->db->from('marca');
				   		$this->db->where('id_marca', $linha->id_marca);
				   		$get = $this->db->get();
				   		$marca = $get->result_array();

				   		$dados['id_marca'.$cont] = $marca['0']['nome_marca'];
				   		$dados['ano'.$cont] = $linha->ano;
				   		$dados['foto'.$cont] = $linha->foto;
				   		$dados['valor'.$cont] = $linha->valor;
				   		$dados['max_parcelas'.$cont] = $linha->max_parcelas;
				   		$dados['data_cadastro'.$cont] = $linha->data_cadastro;
				   		
				   		$this->db->select('nome');
				   		$this->db->from('user');
				   		$this->db->where('id_user', $linha->id_usuario);
				   		$get = $this->db->get();
				   		$nome = $get->result_array();
				   		$dados['id_usuario'.$cont] = $nome['0']['nome'];
				   		$cont++;		
				    }
    
			return($dados);
			
			
		}
		
		
		
		//retornar todos carros
		public function retornaCarros(){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM carro ORDER BY id_carro DESC");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_carro'.$cont] = $linha->id_carro;
				   		$dados['modelo'.$cont] = $linha->modelo;
				   		
				   		$this->db->select('nome_marca');
				   		$this->db->from('marca');
				   		$this->db->where('id_marca', $linha->id_marca);
				   		$get = $this->db->get();
				   		$marca = $get->result_array();

				   		$dados['id_marca'.$cont] = $marca['0']['nome_marca'];
				   		$dados['ano'.$cont] = $linha->ano;
				   		$dados['foto'.$cont] = $linha->foto;
				   		$dados['valor'.$cont] = $linha->valor;
				   		$dados['max_parcelas'.$cont] = $linha->max_parcelas;
				   		$dados['data_cadastro'.$cont] = $linha->data_cadastro;
				   		
				   		$this->db->select('nome');
				   		$this->db->from('user');
				   		$this->db->where('id_user', $linha->id_usuario);
				   		$get = $this->db->get();
				   		$nome = $get->result_array();
				   		$dados['id_usuario'.$cont] = $nome['0']['nome'];
				   		$cont++;		
				    }
				   
				
		        
		        

		        
		        
			return($dados);
			
		}
				
		
		
		
			
	
	
	
}