<?php

namespace App\Models;

use CodeIgniter\Model;

class IzipayCredentialsModel extends Model
{
    protected $table = 'izipay_credentials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'public_key', 'hmac_sha256', 'endpoint_api_rest'];

    public function getCredentials()
    {
        return $this->first();
    }

    
}
