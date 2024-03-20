<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class HelperController extends Controller {
    static function checkPhone($phone) {
        if ($phone && $phone[0] == 8)
            $phone = "0" . $phone;
        return $phone;
        }
    }