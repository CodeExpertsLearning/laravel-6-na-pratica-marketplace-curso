<?php
namespace App\Payment\PagSeguro;

class CreditCard
{
	private $items;
	private $user;
	private $cardInfo;
	private $reference;

	public function __construct($items, $user, $cardInfo, $reference)
	{
		$this->items = $items;
		$this->user  = $user;
		$this->cardInfo = $cardInfo;
		$this->reference = $reference;
	}

	public function doPayment()
	{
		$creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

		$creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
		$creditCard->setReference(base64_encode($this->reference));
		$creditCard->setCurrency("BRL");

		foreach($this->items as $item) {
			$creditCard->addItems()->withParameters(
				$item['id'],
				$item['name'],
				$item['amount'],
				$item['price']
			);
		}

		$user = $this->user;
		$email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

		$creditCard->setSender()->setName($user->name);
		$creditCard->setSender()->setEmail($email);
		$creditCard->setSender()->setPhone()->withParameters(
			11,
			56273440
		);
		$creditCard->setSender()->setDocument()->withParameters(
			'CPF',
			'27121238918'
		);
		$creditCard->setSender()->setHash($this->cardInfo['hash']);
		$creditCard->setSender()->setIp('127.0.0.0');

		$creditCard->setShipping()->setAddress()->withParameters(
			'Av. Brig. Faria Lima',
			'1384',
			'Jardim Paulistano',
			'01452002',
			'São Paulo',
			'SP',
			'BRA',
			'apto. 114'
		);

		$creditCard->setBilling()->setAddress()->withParameters(
			'Av. Brig. Faria Lima',
			'1384',
			'Jardim Paulistano',
			'01452002',
			'São Paulo',
			'SP',
			'BRA',
			'apto. 114'
		);

		$creditCard->setToken($this->cardInfo['card_token']);
		list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);

		$installmentAmount = number_format($installmentAmount, 2, '.', '');

		$creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

		$creditCard->setHolder()->setBirthdate('01/10/1979');
		$creditCard->setHolder()->setName($this->cardInfo['card_name']);
		$creditCard->setHolder()->setPhone()->withParameters(
			11,
			56273440
		);
		$creditCard->setHolder()->setDocument()->withParameters(
			'CPF',
			'27121238918'
		);

		$creditCard->setMode('DEFAULT');

		$result = $creditCard->register(
			\PagSeguro\Configuration\Configure::getAccountCredentials()
		);

		return $result;
	}
}