<div ng-controller="sellerCtrl">
<div class="row">
<div class="col-md-12 mb-4">
        <div class="card text-left">
        <div class="card-body">
            <div class="card-title">
            <h4 class="mb-3" style="    width: 11%;float: left;">Bayi Listesi</h4>
            <div style="    top: -10px;position: relative;float: right;">
                <button type="button" class="btn btn-raised btn-raised-primary m-1" data-toggle="modal" data-target="#sellerFormModal">Bayi Ekle</button>
             </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="zero_configuration_table" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>İsim Soyisim</th>
                            <th>Email</th>
                            <th>Şifre</th>
                            <th>Ödenecek Bakiye</th>
                            <th>Ödenen Bakiye</th>
                            <th>Bakiye</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody ng-init="getSeller()">
                         <tr ng-repeat="value in sellerList" style="line-height: 2.7;">
                            <td>{{value.firstname}}  {{value.lastname}}</td>
                            <td>{{value.email}}</td>
                            <td>Şifre Değiştir</td>
                            <td style="text-align: right;font-weight:700">0 ₺</td>
                            <td style="text-align: right;font-weight:700">0 ₺</td>
                            <td style="text-align: right;font-weight:700">0 ₺</td>
                            <td>
                                <button type="button"  ng-click="sellerEdit(value.id)" class="btn  btn-sm  btn-info btn-icon m-1">
                                    Düzenle
                                 </button>
                            </td>
                            <td>
                                <button type="button" ng-click="getBalance(value.id)" class="btn  btn-sm  btn-info btn-icon m-1">
                                    Bakiye Ekle
                                 </button>
                            </td>
                            <td>
                                <a href="<?=base_url()?>/home/sellerdelete/{{value.id}}" class="btn  btn-sm  btn-info btn-icon m-1">
                                    Sil
                                 </a>
                            </td>   
                        </tr>
                     </tbody>

                </table>
            </div>

        </div>
        </div>
        </div>     
</div>


<div class="modal fade" id="sellerFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Bayi Formu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?=base_url()?>/home/selleradd">
                <input type="hidden" class="form-control" id="id" name="id" value="{{sellerData[0].id}}">
                <div class="modal-body">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">İsim</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{sellerData[0].firstname}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Soyisim</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{sellerData[0].lastname}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="{{sellerData[0].email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Şifre</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="password"  name="password" value="{{sellerData[0].password}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Fatura Başılığı</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="company" name="company" value="{{sellerData[0].company}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Adres</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="address"  name="address">{{sellerData[0].address}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Vergi No</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="taxNumber"  name="taxNumber" value="{{sellerData[0].taxNumber}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Vergi Dairesi</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control"  id="taxOffice"  name="taxOffice" value="{{sellerData[0].taxOffice}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary ml-2">Kaydet</button>
            </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="BalanceFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Bayi Bakiye Formu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" ng-submit="addBalance()" id="addBalance">
            <input type="hidden" class="form-control" id="id" name="id">
            <div class="modal-body">
            <div class="row">
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="firstName1">Bakiye</label>
                    <input type="text" class="form-control" id="price" name="price"  >
                </div>

                <div class="col-md-6 form-group mb-3">
                    <label for="lastName1">Fiş No</label>
                    <input type="text" class="form-control" id="voucher" name="voucher" >
                </div>
            </div>
            <div class="form-group ">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                  <button type="submit" class="btn btn-primary ml-2">Kaydet</button>
                </div>
            </div>
           
            </div>
               
            </div>
          
            <div class="modal-footer balances">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Bakiye</th>
                        <th>Voucher</th>
                        <th>Sil</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="value in balanceList">
                        <td>{{value.price}}</td>
                        <td>{{value.voucher}}</td>
                        <td> 
                            <a ng-click="deleteBalance(value.id,value.id_seller)" class="btn btn-sm  btn-info btn-icon m-1">
                                    Sil
                                 </a>
                                </td>
                    </tr>
                    </tbody>
                </table>  
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>

    app.controller("sellerCtrl", function ($scope, $http, $window) {

        $scope.getBalance = function (id) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/get_seller_balance/'+id+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $("#BalanceFormModal").find("input#id").val(id);
                $("#BalanceFormModal").modal("show");
                $scope.balanceList = response.data;
            });
        }
        

        $scope.addBalance = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/add_seller_balance',
                data:$("#addBalance").serialize(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response);
                $("#BalanceFormModal").modal("hide");
            });
        }

        $scope.sellerEdit = function (id) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/edit_seller/'+id+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.sellerData = response.data;
                $("#sellerFormModal").modal("show");
            });
        }


        $scope.deleteBalance = function (id,id_seller) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/delete_seller_balance/'+id+'/'+id_seller+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.balanceList = response.data;
            });
        }

        $scope.getSeller = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/get_seller',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.sellerList = response.data;
            });
        }

        $scope.getTotalBalance = function (id) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/get_total_balance/'+id+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
               return response.data;
            });
        }
        
    });
</script>
