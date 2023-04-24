<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateElasticdemoRequest;
use App\Models\Elasticdemo;
use App\Models\fs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HorizonController extends Controller
{

    /**
     * @OA\Get(
     *     path="projects/my-horizon",
     *     summary="Get all Elasticdemo records",
     *     tags={"Record"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", readOnly="true", example="1"),
     *                     @OA\Property(property="name", type="string", description="name"),
     *                     @OA\Property(property="street", type="string", description="address", example="user@gmail.com"),
     *                     @OA\Property(property="number", type="string", maxLength=10),
     *                     @OA\Property(property="code", type="string", maxLength=10, example="John"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2023-04-23T23:23:17.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-04-23T23:26:11.000000Z"),
     *                 )
     *             ),
     *             @OA\Property(property="quote", type="string", example="Inspiring quote"),
     *         ),
     *     ),
     * )
     */
    public function index()
    {

        $quote = $this->inspire();
        $data = Elasticdemo::orderBy('updated_at', 'DESC')->paginate(10);
        return view('projects.horizon', compact('quote','data'));

    }



    /**
     * @OA\Get(
     *     path="/api/get-records",
     *     summary="Get records",
     *     description="Get records from Elasticdemo table",
     *     operationId="getRecords",
     *     tags={"Record"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Elasticdemo")),
     *         )
     *     ),
     *
     * )
     */
    public function getRecords(): JsonResponse
    {
        $data = Elasticdemo::orderBy('updated_at', 'DESC')->paginate(10);
        $data->setPath('my-horizon');
        $links = $data->links()->toHtml();
        return response()->json(['data' => $data, 'links' => $links]);
    }

    /**
     * @OA\Get(
     *      path="/api/get-record/{id}",
     *      summary="Get a single record",
     *      description="Returns a single record based on the provided ID",
     *      operationId="getRecord",
     *      tags={"Record"},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the record to retrieve",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Record retrieved successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(
     *                  property="record",
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="name", type="string", example="John"),
     *                  @OA\Property(property="street", type="string", example="123 Main St"),
     *                  @OA\Property(property="number", type="string", example="12345"),
     *                  @OA\Property(property="code", type="string", example="ABC123"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-04-24T10:30:00.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-04-24T10:30:00.000000Z")
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Record not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Record not found")
     *          )
     *      )
     * )
     */
    public function getRecord(int $id): JsonResponse
    {
        $rec = Elasticdemo::where('id', $id)->firstOrFail();
        return response()->json([
            'success' => true,
            'record' => $rec ?? null
        ], 200);
    }


    /**
     * @OA\Post(
     *     path="/add-record",
     *     summary="Store a new record",
     *     tags={"Record"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Provide record data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="street", type="string", example="123 Main St"),
     *             @OA\Property(property="number", type="string", example="555-1234"),
     *             @OA\Property(property="code", type="string", example="A1B2C3")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Record created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Record created"),
     *             @OA\Property(
     *                 property="record",
     *                 ref="#/components/schemas/Elasticdemo"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation errors"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new record in the database
        $record = new Elasticdemo;
        $record->name = $request->input('name');
        $record->street = $request->input('street');
        $record->number = $request->input('number');
        $record->code = $request->input('code');
        $record->save();

        // Return response with success message
        return response()->json([
            'success' => true,
            'message' => 'Record created',
            'record' => $record
        ], 200);
    }


    /**
     * Update a record.
     *
     * @OA\Patch(
     *     path="/api/edit-record/{id}",
     *     summary="Update a record",
     *     description="Update a record in the elasticdemo table.",
     *     tags={"Record"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the record to update.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="New data for the record",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Elasticdemo")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record updated successfully.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Record updated."
     *             ),
     *             @OA\Property(
     *                 property="record",
     *                 ref="#/components/schemas/Elasticdemo"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Record not found."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation errors."
     *             ),
     *         )
     *     )
     * )
     */
    public function edit(Request $request,int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the record in the database
        $record = Elasticdemo::find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        // Update the record with the new data
        $record->name = $request->input('name');
        $record->street = $request->input('street');
        $record->number = $request->input('number');
        $record->code = $request->input('code');
        $record->save();

        // Return response with success message
        return response()->json([
            'success' => true,
            'message' => 'Record updated',
            'record' => $record
        ], 200);
    }





    /**
     * Get a random inspirational quote.
     *
     * @OA\Get(
     *     path="/inspire",
     *     summary="Get an inspirational quote",
     *     description="Returns a random quote from the Artisan command inspire",
     *     tags={"General"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="quote",
     *                 type="string",
     *                 description="The inspirational quote"
     *             )
     *         )
     *     )
     * )
     */
    public function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }

    /**
     * Delete a record from Elasticdemo table.
     *
     * @OA\Delete(
     *     path="/api/delete-record/{id}",
     *     tags={"Record"},
     *     description="Delete a record from Elasticdemo table",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the record to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     *
     * @param int $id
     * @return Response
     */
    public function delete(int $id)
    {
        return Elasticdemo::where('id', $id)->delete();
    }

    /**
     * @OA\Delete(
     *     path="/api/delete-all-records",
     *     tags={"Record"},
     *     summary="Delete all records from the Elasticdemo table",
     *     @OA\Response(
     *         response="204",
     *         description="All records have been deleted successfully"
     *     )
     * )
     */
    public function deleteAll()
    {
        DB::table('elasticdemos')->truncate();
    }


    /**
     * Populates the elasticdemos table with fake data using Laravel's Model Factories.
     *
     * @return void
     *
     * @OA\Get(
     *     path="/api/seed-records",
     *     summary="Insert fake data into elasticdemos table",
     *     tags={"Record"},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Seeder executed successfully")
     *         )
     *     )
     * )
     */
    public function runSeeder()
    {
        Elasticdemo::factory(10)->create();
    }
}
