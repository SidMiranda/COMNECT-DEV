<div class="card shadow mb-4">
    <div class="card-body wrap">
        <div class="d-flex">
            <div class="input-group">
                <select class="custom-select h-auto" id="pagamento">
                    <option selected>hosts</option>
                    <option value="1">Bandaca teste</option>
                    <option value="2">Servidor RCKY</option>
                    <option value="1">Suporte Lenovo</option>
                    <option value="2">Maquina Sidney</option>
                </select>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Start</span>
                </div>
                <input id="valor" type="number" class="form-control h-auto">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">End</span>
                </div>
                <input id="valor" type="text" class="form-control h-auto">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Transaction</span>
                </div>
                <input id="valor" type="number" class="form-control h-auto">
            </div>
            <button class="btn btn-primary h-auto" type="button" onClick="teste()">ESTRESSAR</button>        
        </div>    
    </div>  

    <div class="row justify-content-center">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PDV's Connected</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><spam id="pdvs-connected"><spam></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transactions per minute</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">600</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transactions
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">26.000</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <div class="card-body d-flex wrap">
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-6">
                <canvas id='myChart' style='width:500px; margin:auto;'></canvas>
            </div>
            <div class="col-xl-6 col-md-6 mb-6">
                <canvas id='myChart2' style='width:500px; margin:auto;'></canvas>
            </div>
        </div>
    </div>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js'></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
var yValues = [5,5,1,4,6,10,12,5,5,6,5]
var zValues = [2,4,6,8,10,15,6,18,22,21,23]
var xValues = [1653946170,1653946175,1653946176,1653946180,1653946186,1653946186,1653946186,1653946191,1653946196,1653946202,1653946207]

new Chart('myChart', {type: 'line',data: {labels: xValues,datasets: [{fill: false,lineTension: 0,backgroundColor: 'rgba(0,0,255,1.0)',borderColor: 'rgba(0,0,255,0.1)',data: yValues}]},options: {legend: {display: false},animation: false,scales: {yAxes: [{ticks: {min: 0, max:30}}],}}});
new Chart('myChart2', {type: 'line',data: {labels: xValues,datasets: [{fill: false,lineTension: 0,backgroundColor: 'rgba(0,0,255,1.0)',borderColor: 'rgba(0,0,255,0.1)',data: zValues}]},options: {legend: {display: false},animation: false,scales: {yAxes: [{ticks: {min: 0, max:30}}],}}});</script>

<script>
    
    $.get('API/get-pdvs-connected.php', function(response){
        document.getElementById('pdvs-connected').innerText = response
    })

    var getPdvs = function(){

        $.get('API/get-pdvs-connected.php', function(response){
            document.getElementById('pdvs-connected').innerText = response
        })
    }

    setInterval(getPdvs, 5000);
    

</script>
