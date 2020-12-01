<?php

namespace App\Models;
use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = 'seller';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname','lastname','email','password','company','address','taxNumber','taxOffice','date_add','saasid','add_user'];

}

