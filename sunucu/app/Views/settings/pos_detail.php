<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3">Sanal Pos Bilgileri</div>
                <form autocomplete="off" method="post" action="<?=base_url()?>/Settings/pos_add">
                <input type="hidden" class="form-control" id="id" value="<?=$id?>" name="data[id]">
                <input type="hidden" class="form-control" id="status" value="0" name="data[status]">
                    <div class="row">
                  
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;" for="firstName1">Mağaza No</label>
                            <input style="float: right;width: 60%;" type="text" class="form-control" id="store_number" value="<?=$store_number?>" name="data[store_number]">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">API Kullanıcısı</label>
                            <input style="float: right;width: 60%;"  type="text" class="form-control" id="username" value="<?=$username?>"  name="data[username]">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">Şifre</label>
                            <input style="float: right;width: 60%;"  type="text" class="form-control" id="password" value="<?=$password?>"  name="data[password]">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="three_d_status">3D Secure Kullan</label>
                            <label class="switch pr-5 switch-primary mr-3">
                              <input type="checkbox" name="data[three_d_status]" id="three_d_status" <?php if($three_d_status == 'on'){ ?> checked  <?php } ?>>
                               <span class="slider"></span>
                            </label>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">3D Secure İşyeri Anahtarı</label>
                            <input style="float: right;width: 60%;"  type="text" class="form-control" id="three_d_secure_key" value="<?=$three_d_secure_key?>" name="data[three_d_secure_key]">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">Otorizasyon Tipi(Ön - Normal)</label>
                            <label class="switch pr-5 switch-primary mr-3">
                               <input type="checkbox" id="authorization_type" name="data[authorization_type]" value="first"  <?php if($authorization_type == 'first'){ ?> checked  <?php } ?>>
                               <span class="slider"></span>
                            </label>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">Minimum Taksit Tutarı (TL)</label>
                            <input style="float: right;width: 60%;"  type="text" class="form-control" id="minimum_installment_amount" name="data[minimum_installment_amount]" value="<?=$minimum_installment_amount?>">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label style="width: 40%;float: left;line-height: 2;"  for="lastName1">Taksit Adedi</label>
                            <input style="float: right;width: 60%;"  type="text" class="form-control" id="installment" name="data[installment]" value="<?=$installment?>">
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
               <div class="card-title mb-3">Taksit Bilgileri</div>
               <div class="notification information mB10 b">
                    Buradaki Oranlar (%) Yüzde cinsinden yazılacaktır.
                </div>
                <div class="formRow">
        <label style="float: left;    width: 13%;">Oranlar</label>
        <div class="colon" style="    float: left;">:</div>
        <div class="input" id="rates_div" style="    width: 80%; float: right;">
                                             01.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;">&nbsp;&nbsp;
                                             02.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             03.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             04.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             05.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             06.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             07.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             08.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             09.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             10.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             11.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;
                                             12.                 <input type="number" name="installment_rates[]" placeholder="-" style="width:50px; font-size:10px;    margin-bottom: 5px;">&nbsp;&nbsp;

                                     </div>
                                    
    </div>

            </div>
            <div class="col-md-12" style="    margin-bottom: 16px;">
                            <button class="btn btn-primary">Kaydet</button>
                        </div>
        </div>
    </div>
</div>

<style>
    .notification.information {
    border: 1px solid #7ea2bf;
    background: url(<?=base_url()?>/assets/images/information-balloon.webp) no-repeat 7px 6px #b6d9f4;
    color: #444;
}
.notification {
    display: block;
    padding: 8px 10px 9px 50px;
    font-size: 12px;
    position: relative;
}
.mB10 {
    margin-bottom: 10px;
}
.b {
    font-weight: 700;
}
@media (min-width: 0)
.formRow {
    margin: 0 0 11px\0/!important;
}
.formRow {
    margin: 0 0 10px;
}

 
.form .colon {
    width: 12px;
    padding-top: 5px;
}
.form label, .form .colon {
    font-weight: 700;
}
.form .input {
    position: relative;
}
.form label {
    width: 200px;
    padding-top: 5px;
}
.form label, .form .colon {
    font-weight: 700;
}
.form label, .form .colon, .form .input, .input-seperator, .formNotice, .form .dateInput {
    float: left;
}
</style>