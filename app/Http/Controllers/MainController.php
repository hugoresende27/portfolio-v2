<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MainController extends Controller
{
    public function welcome()
    {
        $quote = $this->inspire();
        return view('welcome', compact('quote'));
    }


    private function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }

}
