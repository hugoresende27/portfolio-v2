<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     @OA\Xml(name="Elasticdemo"),
 *     @OA\Property(property="id", type="integer", readOnly=true, example=33),
 *     @OA\Property(property="name", type="string", description="Name", example="Alanna Hill Jr.s"),
 *     @OA\Property(property="street", type="string", description="Address", example="82258 Larue Walk Suite 407"),
 *     @OA\Property(property="number", type="string", maxLength=10, example="2953"),
 *     @OA\Property(property="code", type="string", maxLength=10, example="01819"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-04-23T23:23:17.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-04-23T23:26:11.000000Z"),
 * )
 *
 * Class Elasticdemo
 */

class Elasticdemo extends Model
{
    use HasFactory;
}
