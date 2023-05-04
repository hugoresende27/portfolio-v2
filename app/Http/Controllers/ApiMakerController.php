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
        $modelName = $payload->modelName.now()->format('YmdHis');
        $columns = $payload->columns;




        $modelName = "Post20230504203825";//TODO dev tests

        $controllerName = $modelName."Controller.php";
        $apiMakerControllerPath = app_path('Http/Controllers/'.$controllerName);
        $apiMakerControllerContent = file_get_contents($apiMakerControllerPath);

        foreach ($columns as $column) {
            $arrayData[] = [
                "name" => mb_strtolower($column->name),
                "type" => $column->type
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
            $function =
                "
        public function store(Request \$request)
        {
            \$validatedData = \$request->validate([".$dataToValidate."]);
            \$post = new ".$modelName.";
            ".$dataToStore."
            \$post->save();
            return response()->json(['message' => '".$modelName." created successfully', 'data' => \$post]);
        }";

            $apiMakerControllerContent = preg_replace(
                '/public\s+function\s+store\(Request\s+\$request\)\s+{[^}]*}/s',
                $function,
                $apiMakerControllerContent
            );
            file_put_contents($apiMakerControllerPath, $apiMakerControllerContent);
        }


//        echo $this->makeModelRunMigrationRoute($modelName, $columns);




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
            $columnType = $column->type;
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
