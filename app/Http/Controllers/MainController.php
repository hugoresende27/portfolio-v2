<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
        return view('welcome', compact('quote' ));
    }

    public function contactMe(): View
    {
        return view ('contact');
    }


    /**
     * @return string
     */
    private function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }

    /**
     * @return JsonResponse
     */
    public function reloadInspire() : JsonResponse
    {
        // Reload the component's inspire quote
        $quote = $this->inspire();

        // Return the updated HTML in a JSON response
        return response()->json(['quote' => $quote]);
    }


    /**
     * @return View
     */
    public function projects(): View
    {
        $quote = $this->inspire();

        return view ('projects.index', compact('quote'));
    }





}
