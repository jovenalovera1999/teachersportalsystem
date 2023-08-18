<?php

namespace App\Models;
use CodeIgniter\Model;

class PositionModel extends Model 
{
    protected $table = 'tbl_positions';
    protected $primaryKey = 'position_id';
    protected $allowedFields = ['position'];
    protected $returnType = 'object';
}