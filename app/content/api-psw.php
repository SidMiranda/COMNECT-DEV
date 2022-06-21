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
       max-width: 800px;
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
                TESTE DE INTEGRAÇÃO DA API SCOPE PSW
            </h6>
        </div>
    </div>
    <div class="card-body wrap">
        <br>
        <div class="d-flex">
            <div class="input-group">
                <input id="ip" type="text" value="192.168.20.197" class="form-control h-auto">
            </div><br>
            <div class="input-group">
                <select class="custom-select h-auto" id="req">
                    <option selected value="info">Info</option>
                    <option value="servidor">Servidor</option>
                    <option value="perfil-servico-terminal">Perfil serviço terminal</option>
                    <option value="perfil-fisico-terminal">Perfil fisico terminal</option>
                    <option value="rede">Rede</option>
                    <option value="especificacao-rede">Especificação Rede</option>
                    <option value="bandeira">Bandeira</option>
                    <option value="bandeira-rede">Bandeira Rede</option>
                    <option value="produto">Produto</option>
                    <option value="produto-perfil">Perfil Produto</option>
                    <option value="servico">Serviço</option>
                    <option value="grupo-servico">Grupo Serviço</option>
                    <option value="contrato">Contrato</option>
                </select>
            </div>
            <button class="btn btn-primary h-auto" type="button" onClick="sendApiRequest()">Enviar</button>
        </div>
        
    </div>  
</div>

<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">
                RESULT
            </h6>
        </div>
    </div>
    <div class="card-body wrap">
        <br>
        <div class="d-flex">
            
            <span id="resp">resultado</span>
            
        </div>
        
    </div>  
</div>

<script>
    sendApiRequest()
    function sendApiRequest(){
        let ip = document.getElementById('ip').value
        let req = document.getElementById('req').value
        
        $.get('API/teste-api-psw.php', {ip:ip, req:req}, function(response){
            console.log(response);
            document.getElementById('resp').innerText = JSON.stringify(response)
        })
    }

</script>
