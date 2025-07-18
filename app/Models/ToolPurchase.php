<?php

namespace App\Models;
use App\Concerns\Flagable;

use Illuminate\Database\Eloquent\Model;

class ToolPurchase extends Model
{
    use Flagable;
    protected $appends = ['active', 'purchased'];

    public const FLAG_ACTIVE = 1;
    public const FLAG_PURCHASED = 2;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function getPurchasedAttribute() {
        return ($this->flags & self::FLAG_PURCHASED) == self::FLAG_PURCHASED;
    }
}
