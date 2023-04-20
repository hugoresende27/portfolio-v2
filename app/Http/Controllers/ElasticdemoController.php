<?php

namespace App\Http\Controllers;

use App\Models\Elasticdemo;
use Elastic\Elasticsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ElasticdemoController extends Controller
{
    public function index()
    {

        $quote = $this->inspire();
        $data = Elasticdemo::paginate(10);
        return view('projects.elastic', compact('quote','data'));

    }


    private function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }
}
