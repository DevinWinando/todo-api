<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



/**
* @OA\OpenApi(
*     @OA\Info(
*         version="1.0.0",
*         title="TODO API",
*         description= "Todo API."
*     ),
*     @OA\Server(
*         description="LIVE server",
*         url="/api/v1/",
*     ),
* )


* @OA\SecurityScheme(
*   securityScheme="Bearer",
*   type="apiKey",
*   name="Authorization",
*   in="header"
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
