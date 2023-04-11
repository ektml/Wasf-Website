<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;

class ChatController extends Controller
{
    use ApiResponseTrait;

    public function message(Request $request)
    {
        return [];
    }
}
