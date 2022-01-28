<?php

namespace App\Utils;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class Utils 
{
	public $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	
	function getUser($is_practitioner)
	{
		$users = $this->em->getRepository(User::class)->findBy(['is_practitioner' => $is_practitioner], ['id' => 'DESC'], 1);

		return $users;
	}

	function createUserCode($is_practitioner){
		//PAT : 0001-PAT-2022
		//PRA : 0001-PRA-2022

		$user_code = "";
	
		if( count($this->getUser($is_practitioner)) <= 0 ){
			if ( $is_practitioner == false ) 
				$user_code = "0001-PAT-".strval(date("Y"));
			else
				$user_code = "0001-PRA-".strval(date("Y"));

		}
		else{
			$last_user_code = $this->getUser($is_practitioner)[0]->getCode();
			$arr_last_user_code = explode("-", $last_user_code);
			$user_number = $arr_last_user_code[0] + 1;
			if ( $is_practitioner == false )
				$user_code = strval(sprintf("%'.04d", $user_number))."-PAT-".strval(date("Y"));
			else
				$user_code = strval(sprintf("%'.04d",$user_number))."-PRA-".strval(date("Y"));
		}
		
		return $user_code;		
	}


}