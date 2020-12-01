<?php namespace App\Controllers;

use App\Models\PaymentModel;

class Payment extends BaseController
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }

    public function index()
    {

        $reference = rand(0,999);

        try{
//            $year = substr($request->year, -2);

            $db = \Config\Database::connect();
            $builder = $db->table('log');
            $data = [ 'message' => $this->request->getPost("id_seller")." nolu bayi ".$this->request->getPost("price")." TL'lik ödeme işlemi başlattı", ];
            $builder->set($data);
            $builder->insert();
             $expiriy =  $this->request->getPost("Mounth").$this->request->getPost("Year");

            $hashcard = $this->request->getPost("name").$this->request->getPost("Pan").$this->request->getPost("Cvv2").$expiriy;

            $carddata  =  [
                'card' => base64_encode($hashcard),
                'id_seller' => $this->request->getPost("id_seller"),
                'id_order' => $reference,
                'card_number' => $this->request->getPost("Pan"),
                'amount' => $this->request->getPost("price"),
                'type' => "income",
            ];
            $db = \Config\Database::connect();
            $builder = $db->table('seller_payment');
            $builder->set($carddata);
            $builder->insert();

            $amount =  $this->request->getPost("price");
            $MbrId="5";                                                                 //Kurum Kodu
            $MerchantID="038100000024877";                                               //Üye işyeri numarası
            $MerchantPass="49390368";                                                      //Üye işyeri 3D şifresi
            $UserCode="3dsatis";                                                          //Kullanıcı Kodu
            $UserPass="@SaHbaz38@";                                                          //Kullanıcı Şifre
            $SecureType="3DPay";                                                       //Güvenlik tipi
            $TxnType="Auth";                                                             //İşlem Tipi
            $InstallmentCount="0";                                                       //Taksit Sayısı
            $Currency = "949";                              //Para Birimi
            $OkUrl= base_url()."/payment/paymentStatus/".$reference."";   //Başarılı işlem URL
            $FailUrl= base_url()."/payment/paymentStatus/".$reference."";
            $OrderId= $reference;                                                            // İşlem  Sipariş numarası
            $PurchAmount= $amount;                                                            //Tutar
            $OrgOrderId= "";                                                            //Tutar
            $Lang="TR";                                                                  //Dil bilgisi
            $Rnd = microtime();
            $hashstr = $MbrId . $OrderId . $PurchAmount . $OkUrl . $FailUrl . $TxnType . $InstallmentCount . $Rnd . $MerchantPass;
            $Hash = base64_encode(pack('H*',sha1($hashstr)));

            print('<form method="post" action="https://vpos.qnbfinansbank.com/Gateway/Default.aspx" id="three_d_form" style="display: none">');
            print('<table>');
            print(' <tr>');
            print('<td>Kredi Kart Numarasi:</td>');
            print('<td><input type="text" name="Pan" value="'.$this->request->getPost("Pan").'" size="20"/>');
            print('</tr>');
            print('<tr>');
            print('    <td>Güvenlik Kodu:</td>');
            print('     <td><input type="text" name="Cvv2" size="4" value="'.$this->request->getPost("Cvv2") .'"/></td>');
            print(' </tr>');
            print(' <tr>');
            print('    <td>Son Kullanma Yili:</td>');
            print('    <td><input type="text" name="Expiry" value="'.$expiriy.'"/></td>');
            print('</tr>');
            print('</table>');
            print('<input type="hidden" name="MbrId" value="'.$MbrId.'">');
            print('<input type="hidden" name="MerchantID" value="'.$MerchantID.'">');
            print('<input type="hidden" name="UserCode" value="'.$UserCode.'">');
            print('<input type="hidden" name="UserPass" value="'.$UserPass.'">');
            print('<input type="hidden" name="SecureType" value="'.$SecureType.'">');
            print('<input type="hidden" name="TxnType" value="'.$TxnType.'">');
            print('<input type="hidden" name="InstallmentCount" value="'.$InstallmentCount.'">');
            print('<input type="hidden" name="Currency" value="'.$Currency.'">');
            print('<input type="hidden" name="OkUrl" value="'.$OkUrl.'">');
            print('<input type="hidden" name="FailUrl" value="'.$FailUrl.'">');
            print('<input type="hidden" name="OrderId" value="'.$OrderId.'">');
            print('<input type="hidden" name="OrgOrderId" value="'.$OrgOrderId.'">');
            print('<input type="hidden" name="PurchAmount" value="'.$PurchAmount.'">');
            print('<input type="hidden" name="Lang" value="'.$Lang.'">');
            print('<input type="hidden" name="Rnd" value="'.$Rnd.'">');
            print('<input type="hidden" name="Hash" value="'.$Hash.'">');
            print('</form>');
            print('<script>document.getElementById("three_d_form").submit();</script>');
        }catch(Exception $e){
            echo "mesaj -> ".$e->getMessage();
        }

    }

    public function getHistory($id)
    {
        $PaymentModel = new PaymentModel();
        $query = $PaymentModel->where('id_seller', $id)->findAll();
        echo json_encode($query);
    }

    public function paymentStatus()
    {

        $datapayment = [
             'card_mask'  => $this->request->getPost("CardMask"),
             'status'    => $this->request->getPost("ErrMsg"),
             'paymentStatus'    => $_POST["ProcReturnCode"],
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('seller_payment');
        $builder->where("id_order",$this->request->getPost("OrderId"));
        $builder->set($datapayment);
        $builder->update();

        if(($_POST["3DStatus"] == "1")) {
            if (($_POST["ProcReturnCode"] == "00")) {
                $db = \Config\Database::connect();
                $builder = $db->table('log');
                $data = [ 'message' => $this->request->getPost("OrderId")." id'li başarılı ödeme işlemi yapıldı", ];
                $builder->set($data);
                $builder->insert();
                return redirect()->to('https://tahsilat.sahbaz.com.tr/#/payment/ok/'.$this->request->getPost("OrderId").'');
            }else{
                $db = \Config\Database::connect();
                $builder = $db->table('log');
                $data = [ 'message' => $this->request->getPost("OrderId")." id'li hatalı ödeme işlemi yapıldı", ];
                $builder->set($data);
                $builder->insert();
                 return redirect()->to('https://tahsilat.sahbaz.com.tr/#/payment/fail/'.$this->request->getPost("OrderId").'');
            }
        }else {
            $db = \Config\Database::connect();
            $builder = $db->table('log');
            $data = [ 'message' => $this->request->getPost("OrderId")." id'li hatalı ödeme işlemi yapıldı", ];
            $builder->set($data);
            $builder->insert();
            return redirect()->to('https://tahsilat.sahbaz.com.tr/#/payment/fail/'.$this->request->getPost("OrderId").'');
        }
    }

    public function getInstallment()
    {
        $data = "".
             "MbrId=5&".                                                                         //Kurum Kodu
            "MerchantID=038100000024877&".                                                               //Language_MerchantID
            "UserCode=3dsatis&".                                                                   //Kullanici Kodu
            "UserPass=@SaHbaz38@&".                                                                   //Kullanici Sifre
            "OrderId=&".                                                         //Siparis Numarasi
            "SecureType=NonSecure&".                                                                  //Language_SecureType
            "TxnType=Auth&".                                                                          //Islem Tipi
            "PurchAmount=10&".                                                 //Tutar
            "InstallmentCount=5&".                                       //Taksit Sayisi
            "Currency=949&".                                                                   //Para Birimi
            "CardHolderName=Ahmet DALDEMİR&".                                           //Kart Sahibinin Adı
            "Pan=5549601550670030&".                                                                 //Kredi Kart Numarasi
            "Expiry=0324&".                                                           //Son Kullanma Tarihi (MMYY)
            "Cvv2=570&".                                                               //Guvenlik Kodu (Cvv)
            "MOTO=0&".                                                               //Language_MOTO
            "Lang=TR&".                                                                           //Language_Lang
            $url = "https://vpostest.qnbfinansbank.com/Gateway/Default.aspx";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        echo "<br>";
        if (curl_errno($ch)) {
            print curl_error($ch);
        } else {
            curl_close($ch);
        }
        $resultValues = explode(";;", $result);
        echo "<center><table class='tableClass'>";
        foreach($resultValues as $resultt)
        {
            list($key,$value)= explode("=", $resultt);
            echo "<tr><td style='text-align: right'>".$key."</td>";
            echo "<td style='text-align: left'>".$value."</td></tr>";
        }
        echo "</table></center><br>";
    }

}