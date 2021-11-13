<?php
namespace App\Services;

use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;
use Illuminate\Database\Eloquent\Model;

class ShippingService
{
    private $shippingService;

    private $zipcodeOrigin;

    public function __construct(Client $client)
    {
        $this->shippingService = $client->freight();
    }

    public function setItem(Model $model)
    {
        $this->shippingService->item(...$model->shippingOpts);

        $this->zipcodeOrigin = $model->store->zipcode;

        return $this;
    }

    public function calculateShipping(string $zipcode)
    {
       return $this->shippingService
                    ->origin($this->zipcodeOrigin) //CEP de Origem
                    ->destination($zipcode) // Cep Destino
                    ->services(Service::SEDEX, Service::PAC)
                    //->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade
                    ->calculate();
    }
}