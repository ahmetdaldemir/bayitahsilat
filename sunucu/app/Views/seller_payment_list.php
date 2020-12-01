<div ng-controller="sellerCtrl">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form class="needs-validation"  id="getFilter" action="javascript:;" ng-submit="getFilter()">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01"><b>Bayi</b></label>
                                <select  class="form-control" ng-init="getSeller()" id="id_seller" name="id_seller">
                                    <option>Seçiniz</option>
                                    <option ng-repeat="value in sellerList" value="{{value.id}}">{{value.firstname}} {{value.lastname}}</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Başlangıç Tarihi</label>
                                <input id="picker2" class="form-control" placeholder="dd-mm-yyyy" name="date1">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Bitiş Tarihi</label>
                                <input id="picker2" class="form-control" placeholder="dd-mm-yyyy" name="date2">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Filtrele</button>
                        <button class="btn btn-primary" type="button" ng-click="getAllFilter()">Tümünü Listele</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-3" style="    width: 11%;float: left;">Bayi Ödeme Listesi</h4>
                        <div style="    top: -10px;position: relative;float: right;">
                            <button type="button" class="btn btn-raised btn-raised-primary m-1" data-toggle="modal" data-target="#sellerFormModal">Bayi Ekle</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="zero_configuration_table" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 5%;"> #</th>
                                <th style="width: 15%;">İşlem Referans Numarası</th>
                                <th style="width: 15%;">İsim Soyisim</th>
                                <th style="width: 10%;">Tarih</th>
                                <th style="width: 5%;">Miktar</th>
                                <th style="width: 15%;">Kart No</th>
                                <th style="width: 30%;">Durum</th>
                                <th style="width: 5%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="value in paymentList" style="line-height: 2.7;">
                                <td>{{value.id}}</td>
                                <td>{{value.id_order}}</td>
                                <td>{{value.seller}}</td>
                                <td>{{value.date_add}}</td>
                                <td>{{value.amount}}</td>
                                <td>{{value.card_mask}}</td>
                                <td>{{value.status}}</td>
                                <td>
                                    <a href="javascript:;" ng-click="refund(value.id)" class="btn  btn-sm  btn-info btn-icon m-1">İade </a>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">İade Formu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" ng-submit="addRefund()" id="addRefund">
                    <input type="hidden" class="form-control" id="id" name="id" >
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">İade Tutarı</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="amount" name="amount">
                                <small style="color: #f00">* Virgüllü ise 0.00 Şeklinde (.) kullanarak yazınız</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">İşlem Referans Numarası</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="code" name="code">
                                <small style="color: #f00">* Bankanızın sanal pos ekranında bulunan işlem referans numarası</small>
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


</div>


<script>

    app.controller("sellerCtrl", function ($scope, $http, $window) {

        $scope.getFilter = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/seller/get_filter/',
                data:$("#getFilter").serialize(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                 $scope.paymentList = response.data;
            });
        }

        $scope.getAllFilter = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/seller/get_all_filter/',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response);
                $scope.paymentList = response.data;
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

        $scope.refund = function (id) {
            $("#refundModal").modal("show");
            $("#refundModal").find("input#id").val(id);
        }
        $scope.addRefund = function (id) {
             $http({
                method: 'POST',
                url: '<?=base_url()?>/seller/add_refund/',
                data:$("#addRefund").serialize(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                 $("#refundModal").modal("hide");
                $scope.getAllFilter();
            });
        }



    });
</script>
