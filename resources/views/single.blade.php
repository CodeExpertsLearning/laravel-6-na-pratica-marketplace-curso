@extends('layouts.front')


@section('content')
    <div class="row">
        <div class="col-6">
            @if($product->photos->count())
                <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="" class="card-img-top">
                <div class="row" style="margin-top: 20px;">
                    @foreach($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
            @endif
        </div>

        <div class="col-6">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>
                <p>
                    {{$product->description}}
                </p>

                <h3>
                    R$ {{number_format($product->price, '2', ',', '.')}}
                </h3>

                <span>
                    Loja: {{$product->store->name}}
                </span>
            </div>

            <div class="product-add col-md-12">
                <hr>

                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>

                <hr>
            </div>

            <!-- trecho calculo de frete -->

            <div class="col-md-12">

            <div class="mt-4">
                <h4>Calcule o Frete</h4>
                <form action="" class="form-inline formShipping">
                    <input
                    placeholder="99999-999" 
                    type="text" 
                    class="zipcode form-control col-md-6 mr-3">
                    <button class="btn btn-outline-success buttonShipping">Calcular</button>
                </form>
            </div>

            </div>

            <!-- trecho calculo de frete -->

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
        </div>
    </div>
@endsection

@section('scripts')

<script>
    let formShipping = document.querySelector('form.formShipping');

    formShipping.addEventListener('submit', e => { 
        e.preventDefault();
        let url = '/api/shipping';

        let body = {
            'zipcode': document.querySelector('input.zipcode').value,
            '_token': '{{csrf_token()}}',
            'productId': document.querySelector('input[name="product[slug]"]').value
        };

        fetch(url, {
            'method': 'POST',
            'headers': {
                'Content-Type': 'application/json'
            },
            'body': JSON.stringify(body)
        })
        .then(response => response.json())
        .then(responseBody => {
            let formParent = formShipping.parentElement;
            
            for(let shipping of responseBody.data.shipping) {
            
                let elDiv = document.createElement('div');
                
                elDiv.className = 'mt-3';
                elDiv.innerHTML = `<div class="mb-3 d-flex justify-content-between"> 
                            <strong> ${shipping.name}:</strong>
                            <strong> ${shipping.price}</strong>
                </div>`;

                formParent.appendChild(elDiv);
            }    
        });
    });
</script>

@endsection