@extends('layouts.front')


@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Carrinho de Compras</h2>
            <hr>
        </div>
        <div class="col-12">
            @if($cart)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp

                    @foreach($cart as $c)

                        <tr>
                            <td>{{$c['name']}}</td>
                            <td>R$ {{number_format($c['price'], 2, ',', '.')}}</td>
                            <td>{{$c['amount']}}</td>

                            @php
                                $subtotal = $c['price'] * $c['amount'];
                                $total += $subtotal;
                            @endphp

                            <td>R$ {{number_format($subtotal, 2, ',', '.')}}</td>
                            <td>
                                <a href="{{route('cart.remove', ['slug' => $c['slug']])}}" class="btn btn-sm btn-danger">REMOVER</a>
                            </td>
                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="3">Total:</td>
                        <td colspan="2"> R$ {{number_format($total, 2, ',', '.')}} </td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <div class="col-md-12">
                    <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
                    <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left">Cancelar Compra</a>
                </div>
            @else
                <div class="alert alert-warning">Carrinho vazio...</div>
            @endif
        </div>
    </div>

@endsection