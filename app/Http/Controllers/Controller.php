<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // ← لازم يكون موجود
abstract class Controller
{
        use AuthorizesRequests; // ← AuthorizesRequests هنا مهم

}
