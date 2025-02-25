<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function checkOngkir($destination_id)
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'key' => 'f710acbf62e57b4afc707940f3b0e2c5',
                ])
                ->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => '1',
                    'destination' => $destination_id,
                    'weight' => '1',
                    'courier' => 'jne',
                ])
                ->json();

            // dd(env('RAJAONGKIR_API_KEY'));

            if (isset($response['rajaongkir']['status']['code']) && $response['rajaongkir']['status']['code'] != 200) {
                $statusCode = $response['rajaongkir']['status']['code'];
                $statusDescription = $response['rajaongkir']['status']['description'];

                if ($statusCode == 403 || str_contains($statusDescription, 'expired')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'API key has expired. Please contact the administrator to update the Raja Ongkir API key.',
                        'data' => [],
                    ], 403);
                }

                return response()->json([
                    'success' => false,
                    'message' => $statusDescription,
                    'data' => [],
                ], $statusCode);
            }

            $costs = $response['rajaongkir']['results'][0]['costs'];
            return response()->json($costs);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the shipping cost: ' . $th->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function getCities($province_id)
    {
        $province = Province::find($province_id);
        $cities = $province->cities;
        return response()->json($cities);
    }

    public function getAllCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }
}
