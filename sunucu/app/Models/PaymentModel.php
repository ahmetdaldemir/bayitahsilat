<?php

namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_seller','card_number','name','price','date_add','installment'];
}                                

