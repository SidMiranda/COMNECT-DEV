<style>
    table tr:hover{
        cursor:pointer;
        color:white;
        background-color: #2A52C4;
        user-select:none;
        transition:0.3s;
    }
    table tr:active{
        background-color: aliceblue;
    }
    .card{margin-left: 10px;}
    @media only screen and (max-width: 800px) {
        .card {
            
            margin:auto;
        }
}
</style>
<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">
                SCOPE (NCR)
            </h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr><th>Primeiros Passos</th></tr>
                    <tr><th>Manuais</th></tr>
                    <tr onclick="goToCode()"><th>Exemplos de códigos</th></tr>
                    <script>function goToCode(){location.href = 'codigo.php'}</script>
                    <tr><th>API's</th></tr>
                    <tr><th>Downloads</th></tr>
                </thead>
                <tbody class="tb-orders"> 
                      <!-- loaded by action > app-order-load.php -->
                </tbody>
                <tfoot> <tr><th>Videos</th></tr></tfoot>
            </table>
        </div>
    </div>  
</div>
<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary ">
                SITEF (SOFTWARE EXPRESS)
            </h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr><th>Primeiros Passos</th></tr>
                    <tr><th>Manuais</th></tr>
                    <tr><th>Exemplos de códigos</th></tr>
                    <tr><th>API's</th></tr>
                    <tr><th>Downloads</th></tr>
                </thead>
                <tbody class="tb-orders"> 
                      <!-- loaded by action > app-order-load.php -->
                </tbody>
                <tfoot><tr><th>Videos</th></tr></tfoot>
            </table>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header">
    	<div class="card-header py-3 d-flex flex-row justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary ">
                PORTAL (COMNECT)
            </h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr><th>Primeiros Passos</th></tr>
                    <tr><th>Manuais</th></tr>
                    <tr><th>Exemplos de códigos</th></tr>
                    <tr><th>API's</th></tr>
                    <tr><th>Downloads</th></tr>
                </thead>
                <tbody class="tb-orders"> 
                      <!-- loaded by action > app-order-load.php -->
                </tbody>
                <tfoot><tr><th>Videos</th></tr></tfoot>
            </table>
        </div>
    </div>
</div>
