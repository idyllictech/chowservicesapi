<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function services()
    {
        // Add your logic to retrieve and return services
        return response()->json(['services' => 'Welcome to FoodHup API Your services data here'], 200);
    }

}
