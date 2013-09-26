<?php

class Login_m extends CI_Model{
	
	
	
	//grava no log
		public function gravaAcessoLog($dados){
			
			$this->load->database();
			$this->db->insert('log',$dados);
		}

	
	
	
	//retorna nome e senha para o controller enviar o email com a senha esquecida
	public function enviaSenha($email){
	
			
		if($email == "" || (empty($email)))
		{
			return ("Informe um Email");
		}
		else
		{
			$this->load->database();
		
			$query = $this->db->query("SELECT nome,senha FROM user WHERE email = '$email'");
			
			if($query->num_rows() > 0)
			{
			
				foreach($query->result() as $linha)
				{
				   $dados = array(
				   		'nome' => $linha->nome,
				   		'senha' => $linha->senha
				   );
				}

			}
			else
			{
				$dados = array(
				   		'nome' => '',
				   		'senha' => ''
				   );
			}
			return $dados;
		}
		
		
		
	}
	
	
	
	//validaçao para o login de acesso ao sistema
	public function validar($dados){
		
		$this->load->database();
		
		$query = $this->db->query("SELECT * FROM user WHERE login = '$dados[usuario]' AND senha = '$dados[senha]'");

		if ($query->num_rows() > 0)
		{
		   foreach($query->result() as $linha)
		   {
		   		$novosdados['nome'] = $linha->nome;	
		   		$novosdados['perfil'] = $linha->perfil;	
		   		$novosdados['id_user'] = $linha->id_user;	   
		   }
		

           $this->session->set_userdata($novosdados);
           $this->session->set_userdata('logado','sim');
           
		   
		   return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	
	
}