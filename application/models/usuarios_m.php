<?php

class Usuarios_m extends CI_Model{
	
	
	
	    //inserir novo usuario
		public function inserir($dados){
		
			$this->load->database();
			$q = $this->db->insert('user',$dados);
			
			
			if($q)
			{
				return true;
			}
			else
			{	
				return false;
			}
		
		}
		
		
		
		//editar usuario pelo id
		public function editarUsuario($dadosNovos){
			
			$this->load->database();
			
			//print_r($dadosNovos);
			
			$this->db->where('id_user', $dadosNovos['id_user']);
			
						
				if( ! $this->db->update('user', $dadosNovos))
				{
					return "erro";
				}
				else
				{
					return "sucesso";
				}
			
		}
		
		
		
		
		//buscar usuario pelo id
		public function buscarUsuario($idUser){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM user WHERE id_user = $idUser");
			
				   $dados = array();
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_user'] = $linha->id_user;
				   		$dados['nome'] = $linha->nome;
				   		$dados['email'] = $linha->email;
				   		$dados['login'] = $linha->login;
				   		$dados['perfil'] = $linha->perfil;
				    }

			return($dados);
			
		}
		
		
		
		
		
		
		
		
		//funcao excluir usuario
		public function excluir($idUsuario){
			
			$this->load->database();			
			
			$query = $this->db->query("SELECT * FROM carro WHERE id_usuario = $idUsuario");
			$query1 = $this->db->query("SELECT * FROM marca WHERE id_usuario = $idUsuario");


			if($query->num_rows() == 0)
			{
				if($query1->num_rows() == 0)
				{
					$this->db->where('id_user', $idUsuario);
					if( ! $this->db->delete('user'))
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
					return 'Não foi possível excluir o Usuário, pois existem Marcas que ele cadastrou.';
				}
			}
			else
			{
				return 'Não foi possível excluir o Usuário, pois existem Carros que ele cadastrou.';
			}
			

			
			
			
			
			
		}

		
		
		
		//retornar todos usuarios
		public function retornaUsuarios(){
			
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM user ORDER BY nome ASC");
			
				   $dados = array();
				   $cont=1;
				   	foreach($query->result() as $linha)
				   	{
				   		$dados['id_user'.$cont] = $linha->id_user;
				   		$dados['nome'.$cont] = $linha->nome;
				   		$dados['email'.$cont] = $linha->email;
				   		$dados['login'.$cont] = $linha->login;
				   		$dados['perfil'.$cont] = $linha->perfil;
				   		
				   		$cont++;		
				    }

			return($dados);
			
		}
		


		
		
		
			
	
	
	
}