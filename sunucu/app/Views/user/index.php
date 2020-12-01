
<div ng-controller="userCtrl">
<div class="row">
<div class="col-md-12 mb-4">
        <div class="card text-left">
        <div class="card-body">
            <div class="card-title">
            <h4 class="mb-3" style="    width:30%;float: left;">Kullanıcı Listesi</h4>
            <div style="    top: -10px;position: relative;float: right;">
                <button type="button" class="btn btn-raised btn-raised-primary m-1" data-toggle="modal" data-target="#userFormModal">Bayi Ekle</button>
             </div>
            </div>
            <hr>
            <div class="table-responsive">
                <div class="alert alert-success"><?=$flashdata?></div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">İsim Soyisim</th>
                                <th scope="col">Email</th>
                                <th scope="col">Şifre</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Düzenle</th>
                                <th scope="col">Sil</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getUser()">
                            <tr ng-repeat="value in userList">
                                <th scope="row">{{value.id}}</th>
                                <td>{{value.firstname}} {{value.lastname}}</td>
                                <td>{{value.email}}</td>
                                <td>Şifre Değiştir</td>
                                <td>
                                <label class="switch pr-5 switch-primary mr-3">
                                    <input type="checkbox" ng-click="changeStatus(value.id,value.status)" ng-checked="value.status == 1">
                                    <span class="slider"></span>
                                </label>
                                </td>
                                <td>
                                <a href="#" class="btn btn-primary ">
                                    <i class="nav-icon i-Pen-2 "></i>
                                </a>
                                </td>
                                <td>
                                <a href="javascript():;" ng-click="deleteUser(value.id)" class="btn btn-primary ">
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


<div class="modal fade" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Bayi Formu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?=base_url()?>/user/add_user">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">İsim</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Soyisim</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Şifre</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="password"  name="password">
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

    app.controller("userCtrl", function ($scope, $http, $window) {

        $scope.getUser = function () {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/user/get_user',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.userList = response.data;
            });
        }
        

        $scope.changeStatus = function (id,status) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/user/user_change_status/'+id+'/'+status+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
               alert("Güncellendi");
            });
        }
     
        $scope.deleteUser = function (id) {
            $http({
                method: 'POST',
                url: '<?=base_url()?>/user/delete_user/'+id+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.getUser();
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
    padding: 0.175rem 0.35rem 0;
    font-size: 0.813rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>