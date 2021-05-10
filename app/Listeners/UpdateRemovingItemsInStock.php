<?php

namespace App\Listeners;

use App\Events\UserOrderedItems;
use App\Services\ProductStockManagerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRemovingItemsInStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserOrderedItems  $event
     * @return void
     */
    public function handle(UserOrderedItems $event)
    {
        (new ProductStockManagerService($event->userOrder))->removeProductFromStock();
    }
}


// Existir o disparar do Evento UserOrderedItems ->
// UpdateRemovingItemsInStock (removendo items da coluna in-stock) do produto(s) do pedido do usuario

// Existir o disparar do Evento UserCancelledOrder -> UpdateAddingBackItemsInStock
// (vai adicionar de voltar os items do pedido do usuario)
