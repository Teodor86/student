<?php
class UserValidator{
	
	private $errors = [];
	private $gateway;
	
	function __construct(UserGateway $userGateway) {
		$this->gateway = $userGateway;
	}
	
	function check(User $user) {

		if( empty($user->getName() )) {
			$this->errors[] = 'Имя должно быть заполнено';
		} elseif (is_numeric($user->getName())) {
			$this->errors[] = 'Имя не может быть цифрой';
		} elseif(mb_strlen($user->getName()) > 40) {
			$this->errors[] = 'Имя не может быть длинее более 40 символов';
		}

		if( empty($user->getSurname() )) {
			$this->errors[] = 'Фамилия должно быть заполнено';
		} elseif (is_numeric($user->getsurName() )) {
			$this->errors[] = 'Фамилия не может быть цифрой';
		} elseif(mb_strlen($user->getsurName()) > 40) {
			$this->errors[] = 'Фамилия не может быть длинее более 40 символов';
		}

		if( empty($user->getEmail() )) {
			$this->errors[] = 'Напишите свою электронную почту';
		} elseif( !filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL) ) {
			$this->errors[] = 'Не правильная электронная почта';
		} elseif( $this->gateway->checkEmail($user->getEmail(), $user->getUserId() )) {
			$this->errors[] = 'Эта электронная почта сушествует в базе данных';
		}

		if( empty($user->getBirthday() )) {
			$this->errors[] = 'Вы не выбрали год рождения';
		}

		if( empty($user->getGender() )) {
			$this->errors[] = 'Вы не выбрали пол';
		}

		return $this->errors;
	}
}
?>
