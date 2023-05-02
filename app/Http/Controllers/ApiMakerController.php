<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiMakerController extends Controller
{
    public function index()
    {
        return view ('projects.apimaker');
    }


    public function makeApi(Request $request)
    {
        // Get the JSON payload from the request and convert it to an array
        $payload = json_decode($request->getContent());
//        var_dump($payload);
        $modelName = $payload->modelName;
        $model = $this->makeModel($modelName);
        dd($model);




    }

    /**
     * @param string $modelName
     * @return bool|string
     */
    public function makeModel(string $modelName): bool|string
    {
        Artisan::call('make:model', [
            'name' => $modelName,
        ]);

        $modelPath = app_path('Models/' . $modelName . '.php');
        $modelContent = file_get_contents($modelPath);
        $guarded = ['id']; // Add any other columns you want to guard here
        $modelContent = str_replace(
            'use HasFactory;',
            'use HasFactory;    protected $guarded = ' . json_encode($guarded) . ';',
            $modelContent
        );

        file_put_contents($modelPath, $modelContent);

        $artisan = Artisan::output();
        if (str_contains($artisan, 'ERROR')) {
            return $artisan;
        } else {
            return true;
        }
    }
}
