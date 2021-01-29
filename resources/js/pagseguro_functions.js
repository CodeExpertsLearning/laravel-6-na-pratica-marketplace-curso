function proccessPayment(token, paymentType, buttonTarget)
{
    let data = {
        hash: PagSeguroDirectPayment.getSenderHash(),
        paymentType: paymentType,
        _token: csrf
    };

    if(paymentType === 'CREDITCARD') {
        data.card_token = token;
        data.installment = document.querySelector('select.select_installments').value;
        data.card_name =  document.querySelector('input[name=card_name]').value;
    }

    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function(res) {
            let redirectUrl = `${urlThanks}?order=${res.data.order}`; // 127.0.0.1:8000/checkout/thanks?order=21212
            let linkBoleto = `${redirectUrl}&b=${res.data.link_boleto}`; // 127.0.0.1:8000/checkout/thanks?order=21212&b=link-boleto

            toastr.success(res.data.message, 'Sucesso');
            window.location.href = paymentType === 'BOLETO' ? linkBoleto : redirectUrl;
        },
        error: function(err) {
            buttonTarget.disabled = false;
            buttonTarget.innerHTML = 'Efetuar Pagamento';

            let message = JSON.parse(err.responseText);
            document.querySelector('div.msg').innerHTML = showErrorMessages(message.data.message.error.message);
        }
    });
}


function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function(res) {
            let selectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;
        },
        error: function(err) {
            console.log(err);
        },
        complete: function(res) {

        },
    })
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for(let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }


    select += '</select>';

    return select;
}

function showErrorMessages(message)
{
    return `
        <div class="alert alert-danger">${message}</div>
    `;
}

function errorsMapPagseguroJS(code)
{
    switch(code) {
        case "10000":
            return 'Bandeira do cartão inválida!';
            break;

        case "10001":
            return 'Número do Cartão com tamanho inválido!';
            break;

        case "10002":
        case  "30405":
            return 'Data com formato inválido!';
            break;

        case "10003":
            return 'Código de segurança inválido';
            break;

        case "10004":
            return 'Código de segurança é obrigatório!';
            break;

        case "10006":
            return 'Tamanho do código de segurança inválido!';
            break;

        default:
            return 'Houve um erro na validação do seu cartão de crédito!';
    }
}
