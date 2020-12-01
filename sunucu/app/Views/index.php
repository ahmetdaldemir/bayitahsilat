<div ng-controller="sellerCtrl">
<div class="row" >
                <div class="col-lg-12 col-md-12">
                    <!-- CARD ICON -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Data-Upload"></i>
                                    <p class="text-muted mt-2 mb-2">Toplam Tahsilat</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?=$total_payment_item?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Toplam Bayi</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?=$total_seller?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Money-2"></i>
                                    <p class="text-muted mt-2 mb-2">Toplam Tahsilat Tutarı</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?=$total_payment?></p>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-big mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Money-2"></i>
                                    <p class="text-muted mt-2 mb-2">Günlük Tahsilat Tutarı</p>
                                    <p class="line-height-1 text-title text-18 mt-2 mb-0"><?=$today_payment?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <h5 class="card-title m-0 p-3">Haftalık Tahsilat Adetleri</h5>
                            <div id="echart4" style="height: 200px"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end of row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card o-hidden mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="w-50 float-left card-title m-0">Günlük Bayi İşlemleri</h3>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table  class="table table-collapse text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">İsim Soyisim</th>
                                            <th scope="col">Ödeme Miktarı</th>
                                            <th scope="col">Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($today_seller_process as $val){  ?>
                                        <tr>
                                            <th scope="row"><?=$val["id"]?></th>
                                            <td><?=$val["seller"]?></td>
                                            <td><?=$val["amount"]?></td>
                                            <td><span class="badge badge-success"><?=$val["status"]?></span></td>
                                        </tr>
                                     <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-4  mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="ul-widget__head">
                          <div class="ul-widget__head-label">
                            <h3 class="ul-widget__head-title">
                              Son İşlemler
                            </h3>
                          </div>

                        </div>
                        <div class="ul-widget__body">
                            <div class="ul-widget-s6__items" ng-init="getLog()">

                                <div class="ul-widget-s6__item" ng-repeat="value in logList">
                                  <span class="ul-widget-s6__badge">
                                    <p class="badge-dot-success ul-widget6__dot"></p>
                                  </span>
                                    <p class="ul-widget-s6__text">
                                       {{value.message}}
                                    </p>
                                    <span class="ul-widget-s6__time"> {{value.date_add}}</span>
                                </div>


                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- end of row-->
</div>


<script>

    app.controller("sellerCtrl", function ($scope, $http, $window) {

        $scope.getLog = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/home/get_log/',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response);
                $scope.logList = response.data;
            });
        }



    });
</script>
