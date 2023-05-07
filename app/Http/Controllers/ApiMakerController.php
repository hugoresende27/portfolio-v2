<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiMakerController extends Controller
{


    public function index()
    {
        return view ('projects.apimaker.index');
    }

    public function showCreate()
    {
        $makeApi = session('makeApi');
        return view ('projects.apimaker.create', compact('makeApi'));
    }

    public function showEndpoints()
    {
        // Retrieve the value from the session
        $makeApi = session('makeApi');
        return view ('projects.apimaker.final', compact('makeApi'));
    }

    public function handleFormRequest(Request $request)
    {


        $modelName = $request->modelName;
        $count = 1;
        $colName = "colName".$count;
        $colType = "colType".$count;

        $columnsObj = new \stdClass();

        while (isset($request->{$colName})) {
            $columnNumber = 'column'.$count;

            $columnsObj->{$columnNumber} = new \stdClass();
            $columnsObj->{$columnNumber}->name = $request->{$colName};
            $columnsObj->{$columnNumber}->type = $request->{$colType};

            $count++;
            $colName = "colName".$count;
            $colType = "colType".$count;
        }

        $jsonData = [
            'modelName' => $modelName,
            'columns' => $columnsObj
        ];


        // Create a new Request object with JSON data
        $request = Request::create(route('projects.apimaker'), 'POST', [], [], [], [], json_encode($jsonData));


        $makeApi = $this->makeApi($request);
        $makeApi = json_decode($makeApi->getContent());

        // Store the $apiMaker variable in the session
        session(['makeApi' => $makeApi]);


        return view ('projects.apimaker.final', compact('makeApi'));

    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function makeApi(Request $request): JsonResponse
    {
        // Get the JSON payload from the request and convert it to an array
        $payload = json_decode($request->getContent());
        $modelName = $payload->modelName;
        $columns = $payload->columns;

        $modelName = ucfirst($modelName). now()->format('YmdHis');
        $lowModelName = mb_strtolower($modelName);

        $this->makeModelRunMigrationRoute($modelName, $columns);


        $this->fillCRUDfunctions($modelName, $columns);


        return response()->json([
            'modelName' => $modelName,
            'columns' => $columns,
            'routes' => [
                'GET' => "api/api-maker/".$lowModelName." ............. ".$lowModelName.".index › ".$modelName."Controller@index",
                'POST' => "api/api-maker/".$lowModelName." ............. ".$lowModelName.".store › ".$modelName."Controller@store",
                'PUT' => "api/api-maker/".$lowModelName."/{".$lowModelName."} ............. ".$lowModelName.".show › ".$modelName."Controller@show",
                'GET1' => "api/api-maker/".$lowModelName."/{".$lowModelName."} ............. ".$lowModelName.".update › ".$modelName."Controller@update",
                'DELETE' => "api/api-maker/".$lowModelName."/{".$lowModelName."} ............. ".$lowModelName.".destroy › ".$modelName."Controller@destroy",
            ]
        ]);


    }


    /**
     * @param string $modelName
     * @param object $columns
     * @return void
     */
    private function fillCRUDfunctions(string $modelName, object $columns): void
    {

        $controllerName = $modelName."Controller.php";
        $apiMakerControllerPath = app_path('Http/Controllers/'.$controllerName);
        $apiMakerControllerContent = file_get_contents($apiMakerControllerPath);

        foreach ($columns as $column) {
            $arrayData[] = [
                "name" => mb_strtolower($column->name),
                "type" => $this->getValidatorType( $column->type)
            ];
        }
        if (!empty($arrayData)) {

            $dataToValidate = "";
            foreach ($arrayData as $data) {
                $dataToValidate .= "\n\t\t\t\t\t'".$data['name']."' => 'required|".$data['type']."',";
            }


            $dataToStore = "";
            foreach ($arrayData as $data) {
                $dataToStore .= "\n\t\t\t\t\t\$post->".$data['name']." = \$validatedData['".$data['name']."'];";
            }

            $lowModelName = mb_strtolower($modelName);

            ////////////// CREATE show all (index) FUNCTION ////////////////////////////////////
            $functionShowAll =  "
        public function index(): \Illuminate\Database\Eloquent\Collection
        {
            return ".$modelName."::all();
        }";


            $apiMakerControllerContent = preg_replace(
                '/public function index\(\)[^{]*\{[^}]*\}/s',
                $functionShowAll,
                $apiMakerControllerContent
            );
            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);

            ////////////// CREATE STORE FUNCTION ////////////////////////////////////
            $functionStore =
                "
        public function store(Request \$request) : \Illuminate\Http\JsonResponse
        {
            \$validatedData = \$request->validate([".$dataToValidate."]);
            \$post = new ".$modelName.";
            ".$dataToStore."
            \$post->save();
            return response()->json(['message' => '".$modelName." created successfully', 'data' => \$post]);
        }";

            $apiMakerControllerContent = preg_replace(
                '/public\s+function\s+store\(Request\s+\$request\)\s+{[^}]*}/s',
                $functionStore,
                $apiMakerControllerContent
            );
            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);

            ////////////// CREATE UPDATE FUNCTION ////////////////////////////////////
            $dataToUpdate = "";
            foreach ($arrayData as $data) {
                $dataToUpdate .= "\n\t\t\t\t\t\$".$lowModelName."->".$data['name']." = \$validatedData['".$data['name']."'];";
            }
            $functionUpdate =
                "
        public function update(Request \$request, ".$modelName." \$".$lowModelName.") : \Illuminate\Http\JsonResponse
        {
            \$validatedData = \$request->validate([".$dataToValidate."]);
            \n"
            .$dataToUpdate.
                "
            \$".$lowModelName."->save();

             return response()->json([
                'message' => '".$lowModelName." updated successfully',
                'data' => \$".$lowModelName.",
            ]);
        }";


            $apiMakerControllerContent = preg_replace(
                '/public\s+function\s+update\(Request\s+\$request,\s+'.$modelName.'\s+\$'.$lowModelName.'\)\s+{[^}]*}/s',
                $functionUpdate,
                $apiMakerControllerContent
            );

            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);


            ////////////// CREATE SHOW FUNCTION ////////////////////////////////////
            $functionShow =
                "
        public function show(".$modelName." \$".$lowModelName.") : ".$modelName."
        {
            return \$".mb_strtolower($modelName).";
        }";

            $lowModelName = mb_strtolower($modelName);
            $apiMakerControllerContent = preg_replace(
                '/public\s+function\s+show\('.$modelName.'\s+\$'.$lowModelName.'\)\s+{[^}]*}/s',
                $functionShow,
                $apiMakerControllerContent
            );
            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);



            ////////////// CREATE DESTROY FUNCTION ////////////////////////////////////
            $functionDestroy =  "
        public function destroy(".$modelName." \$".$lowModelName.") : ?bool
        {
            return \$".$lowModelName."->delete();
        }";


            $apiMakerControllerContent = preg_replace(
                '/public\s+function\s+destroy\('.$modelName.'\s+\$'.$lowModelName.'\)\s+{[^}]*}/s',
                $functionDestroy,
                $apiMakerControllerContent
            );
            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);
        }





    }



    //Todo finish this with match case
    private function getValidatorType(string $type): string
    {
        if ($type =="text") {
            $type ="string";
        } else if ($type == "float"){
            $type ="numeric";
        }
        return $type;
    }


    /**
     * @param string $modelName
     * @return void
     */
    public function makeEndpoints(string $modelName): void
    {
        $apiMakerRoutePath = base_path('routes/api.php');
        $apiMakerRouteContent = file_get_contents($apiMakerRoutePath);
        $enpointUrl = "Route::apiResource('/api-maker/".mb_strtolower( $modelName)."', \App\Http\Controllers\\".$modelName."Controller::class );";
        $apiMakerRouteContent = str_replace(
            '/**API_MAKER**/',
            "/**API_MAKER**/\n" . $enpointUrl,
            $apiMakerRouteContent
        );
        file_put_contents($apiMakerRoutePath, $apiMakerRouteContent);
    }

    /**
     * @param string $modelName
     * @param object $columns
     * @return string
     */
    public function makeModelRunMigrationRoute(string $modelName, object $columns): string
    {
        $model = $this->makeModel($modelName);

        if (str_contains($model, "ERROR") || is_string($model)) {
            // If makeModel returned an error message, return it immediately
            return $model;
        }

        $migration = $this->makeMigration($columns, $modelName);
        if (str_contains($migration, "ERROR") || is_string($migration)) {
            // If makeMigration returned an error message, return it immediately
            return $migration;
        }
        $this->makeEndpoints($modelName);
        Artisan::call('migrate');
        return Artisan::output();
    }



    /**
     * @param object $columns
     * @param string $modelName
     * @return bool|string
     */
    public function makeMigration(object $columns, string $modelName): bool|string
    {
        // Call the make:migration Artisan command to create the migration file
        Artisan::call('make:migration', [
            'name' => "create_" . strtolower($modelName) . "_table",
            '--create' => strtolower($modelName),
            '--table' => strtolower($modelName),
            '--path' => 'database/migrations',
        ]);
        $output = Artisan::output();

        // Extract the file name from the Artisan output
        $pattern = "/\[([^\]]+)\]/";
        preg_match($pattern, $output, $matches);
        $filename = $matches[1];
        $filename = basename($filename);

        if (!str_contains($filename, 'table.php')) {
            return 'No migration file found.';
        }

        // Construct the migration schema from the column information
        $migrationSchema = '';
        foreach ($columns as $column) {
            $columnName = mb_strtolower( $column->name);
            if ($column->type == mb_strtolower("data")) {
                $columnType = "dateTime";
            } else {
                $columnType = $column->type;
            }

            $migrationSchema .= "\$table->$columnType('$columnName');\n\t\t\t";
        }

        // Modify the migration file contents to include the schema
        $migrationPath = database_path('migrations/' . $filename);
        $migrationContent = file_get_contents($migrationPath);
        $migrationContent = str_replace(
            '$table->id();',
            "\$table->id();\n\t\t\t" . $migrationSchema,
            $migrationContent
        );
        $migrationContent = str_replace(
            "', function (Blueprint \$table) {",
            "s', function (Blueprint \$table) {" ,
            $migrationContent
        );
        file_put_contents($migrationPath, $migrationContent);

        return true;
    }

    /**
     * @param string $modelName
     * @return bool|string
     */
    public function makeModel(string $modelName): bool|string
    {
        $modelNamespace = 'ApiMaker/'.$modelName;
        $modelPath = app_path('Models/'.$modelNamespace.'.php');


        // Create the model using Artisan command
        Artisan::call('make:model', [
            'name' => $modelNamespace,
            '--controller' => true,
            '--resource' => true,
        ]);

        $artisanOutput = Artisan::output();

        if (str_contains($artisanOutput, 'ERROR')) {
            return $artisanOutput;
        }

        // Add guarded properties to model
        $guarded = ['id']; // Add any other columns you want to guard here
        $modelContent = file_get_contents($modelPath);
        $modelContent = str_replace(
            'use HasFactory;',
            'use HasFactory;   protected $guarded = ' . json_encode($guarded) . ';',
            $modelContent
        );
        file_put_contents($modelPath, $modelContent);

        return true;
    }

}
