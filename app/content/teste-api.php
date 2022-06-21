<style>
    .row{
        flex-direction: column!important;
    }
    .btn{
        width:130px;
        margin:10px;
        display:flex;
        align-items: center;
    }
    .card{
       max-width: 600px;
    }
    .card-body{
        flex-wrap: wrap;
        
    }
    .h-auto{
        height:auto;
        font-size:1.5em;
        margin:0;
    }
</style>
<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">
                ENVIAR PAGAMENTO PARA POS
            </h6>
        </div>
    </div>
    <div class="card-body wrap">
        <div class="d-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                </div>
                <input id="valor" type="number" min="1" step="any" class="form-control h-auto" placeholder="0,00" style="margin-right:5px;">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">PDV</span>
                </div>
                <input id="pdv" type="number" class="form-control h-auto" style="margin-right:5px;">
            </div>
        </div>
        <br>
        <div class="d-flex">
            <div class="input-group">
                <select class="custom-select h-auto" id="pagamento">
                    <option selected>pagamento</option>
                    <option value="1">Debito</option>
                    <option value="2">Credito</option>
                </select>
            </div>
            <div class="input-group">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary h-auto" type="button" onClick="sendPayment()">Enviar</button>
                </div>
            </div>
            <button class="btn btn-primary h-auto" type="button" onClick="sendPaymentTeste()">TESTE</button>
        </div>
        
    </div>  
</div>
<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">
                ENDPOINTS
            </h6>
        </div>
    </div>
    <div class="card-body d-flex wrap">
        GET -> http://192.168.20.152/API/getall.php<br>
        GET -> http://192.168.20.152/API/get.php (numero)<br>
        POST -> http://192.168.20.152/API/insert.php (numero, valor, formaPag)<br>
        PUT -> http://192.168.20.152/API/update.php (numero, valor, formaPag)<br>
        DELETE -> http://192.168.20.152/API/delete.php (numero)<br>
    </div>  
</div>

<script>
    function sendPayment(){
        let valor = parseFloat(document.getElementById('valor').value)
        let novoValor = valor.toLocaleString('pt-br', {minimumFractionDigits: 2})
        
        //alert(novoValor)
        //return

        if(novoValor == NaN){
            alert("Valor não pode ser 0!")
            return
        }

        pagamento = document.getElementById('pagamento').value
        pdv = document.getElementById('pdv').value ?? 0

        if(novoValor != NaN || pdv != NaN){
            if(pagamento == 1 || pagamento == 2){

                if(pagamento == 1){
                    pagamento = 'COMPRA_DEBITO';
                }if(pagamento == 2){
                    pagamento = 'COMPRA_CREDITO';
                }

                $.get('API/insert-action.php', {valor:novoValor, pagamento:pagamento, pdv:pdv}, function(response){
                    if(response){
                        alert("Solicitação enviada com sucesso!")
                        document.getElementById('valor').value = ''
                        document.getElementById('pdv').value = ''
                    }else{
                        alert("Serviço indisponivel!")
                    }
                })
            }else{
                alert("Escolha forma de pagamento")
            }
        }else{
            alert("Campo valor/pdv obrigatórios!")
        }
    }

    function sendPaymentTeste(){

        let valor = "10,00"
        let pagamento = "COMPRA_CREDITO"
        let pdv = 3

        $.get('API/insert-action.php', {valor:valor, pagamento:pagamento, pdv:pdv}, function(response){
            if(response){
                alert("Solicitação enviada com sucesso!")
                document.getElementById('valor').value = ''
                document.getElementById('pdv').value = ''
            }else{
                alert("Serviço indisponivel!")
            }
        })
    }

</script>
