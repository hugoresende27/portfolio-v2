<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SwaggerController extends Controller
{

    /**
     * Get a random inspirational quote.
     *
     * @OA\Get(
     *     path="/api/gen-docs",
     *     summary="Generate swagger documentation",
     *     description="Returns artisan output of l5-swagger:generate",
     *     tags={"Swagger"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="quote",
     *                 type="string",
     *                 description="output artisan"
     *             )
     *         )
     *     )
     * )
     */
    public function generateDocs(): string
    {
        Artisan::call('l5-swagger:generate');
        return (Artisan::output());
    }
}
