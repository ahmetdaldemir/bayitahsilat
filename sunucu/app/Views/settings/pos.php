<div ng-controller="sellerCtrl">
<div class="row">
<div class="col-md-12 mb-4">
        <div class="card text-left">
        <div class="card-body">
            <div class="card-title">
            <h4 class="mb-3" style="    width: 11%;float: left;">Pos Listesi</h4>
            </div>
            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Banka Adı</th>
                                            <th scope="col">Durum</th>
                                            <th scope="col">Düzenle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Finans Bank</td>
                                            <td>
                                            <label class="switch pr-5 switch-primary mr-3">
                                                <input type="checkbox" ng-click="changeStatus(1,<?=$finansbank?>)" <?php if($finansbank == 1){echo"checked";} ?>>
                                                <span class="slider"></span>
                                            </label>
                                            </td>
                                            <td>
                                            <a href="<?=base_url()?>/settings/posDetail/1" class="btn btn-primary ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Garanti Bankası</td>
                                            <td>
                                            <label class="switch pr-5 switch-primary mr-3">
                                                <input type="checkbox" ng-click="changeStatus(2,<?=$garanti?>)"  <?php if($garanti == 1){echo"checked";} ?>>
                                                <span class="slider"></span>
                                            </label>
                                            </td>
                                            <td>
                                                <a href="<?=base_url()?>/settings/posDetail/2" class="btn btn-primary ">
                                                <i class="nav-icon i-Pen-2 "></i>
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

 
</div>


<script>

    app.controller("sellerCtrl", function ($scope, $http, $window) {

        $scope.changeStatus = function (id,status) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/settings/change_pos_status/'+id+'/'+status+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                alert("Güncellendi");
            });
        }
        
 
    });
</script>


<style>
    .btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.135rem 0.35rem 0;
    font-size: 0.813rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
label {
    display: inline-block;
    margin-bottom: 0.2rem;
    margin-top: 3px;
}
</style>