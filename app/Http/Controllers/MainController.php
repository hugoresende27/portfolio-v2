<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MainController extends Controller
{

    /**
     * @return View
     */
    public function welcome(): View
    {
        $quote = $this->inspire();
        return view('welcome', compact('quote'));
    }


    /**
     * @return string
     */
    private function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }

    public function reloadInspire(Request $request)
    {
        // Reload the component's data
        $quote = $this->inspire();

        // Return the updated HTML in a JSON response
        return response()->json(['quote' => $quote]);
    }



}
