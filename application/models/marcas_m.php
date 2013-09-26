<?php

class Marcas_m extends CI_Model{
	
	
	
	    //inserir nova marca
		public function inserir($dados){
		
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM marca WHERE nome_marca = '$dados[nome_marca]'");

			if($query->num_rows() == 0)
			{
			   $q = $this->db->insert('marca',$dados);
			
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
		
		
		
		
		//buscar marca pelo id
		public function buscarMarca($idMarca){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM marca WHERE id_marca = $idMarca");
			
				   $dados = array();
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_marca'] = $linha->id_marca;
				   		$dados['nome_marca'] = $linha->nome_marca;
				   		$dados['data_cadastro'] = $linha->data_cadastro;
				   		$dados['id_usuario'] = $linha->id_usuario;
				    }

			return($dados);
			
		}
		
		
		
		//editar marca pelo id
		public function editarMarca($idMarca, $novoNome){
			
			$this->load->database();
			
			$this->db->where('id_marca', $idMarca);
			
			$dados = array(
				'nome_marca' => $novoNome,	
				'id_usuario' => $this->session->userdata('id_user'),		
			);
			
				if( ! $this->db->update('marca', $dados))
				{
					return "erro";
				}
				else
				{
					return "sucesso";
				}
			
		}
		
		
		
		
		
		//funcao excluir marca
		public function excluir($idMarca){
			
			$this->load->database();			
			
			$query = $this->db->query("SELECT * FROM carro WHERE id_marca = $idMarca");

			if($query->num_rows() == 0)
			{
				$this->db->where('id_marca', $idMarca);
				if( ! $this->db->delete('marca'))
				{
					return "erro";
				}
				else
				{
					return "sucesso";
				}
			}
			else
			{
				return "marca_em_uso";
			}
			
			
			
			
			
			
		}
		
		
		
		
		
		
		
		//retornar todas marcas e id
		public function retornaMarcas(){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM marca ORDER BY nome_marca ASC");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_marca'.$cont] = $linha->id_marca;
				   		$dados['nome_marca'.$cont] = $linha->nome_marca;
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