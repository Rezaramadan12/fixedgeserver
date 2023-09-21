<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\untan;
use Exception;
use Carbon\carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class untanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postedgeuntan(Request $request)
    {
        try {
            $request->validate([
                'volumeorganik' => 'required',
                'volumenonorganik' => 'required',
                'volumeB3' => 'required',
            ]);

            $url = 'http://10.100.1.152:8000/api/untan';
            $volumeorganik = $request->volumeorganik;
            $volumenonorganik = $request->volumenonorganik;
            $volumeB3 = $request->volumeB3;
            $volumetotaledge = number_format(($volumeorganik + $volumenonorganik + $volumeB3)/3,2);

            $data = [
                'volumeorganik' => $volumeorganik,
                'volumenonorganik' => $volumenonorganik,
                'volumeB3' => $volumeB3,
                'volumetotaledge' => $volumetotaledge,
            ];

            $client = new Client();
            $response = $client->post($url, [
                'timeout' => 4,
                'form_params' => $data
            ]);
            $data = untan::create([
                'volumeorganik' => $volumeorganik,
                'volumenonorganik' => $volumenonorganik,
                'volumeB3' => $volumeB3,
                'volumetotaledge' => $volumetotaledge,
                // 'status' => 'pending'
            ]);
            // ... (kode program lainnya)
        } catch (Exception $e) {
            // Ambil id_sensor dari request
            $id_sensor = $request->id_sensor;

            $data = untan::create([
                'volumeorganik' => $request -> volumeorganik,
                'volumenonorganik' => $request -> volumenonorganik,
                'volumeB3' => $request -> volumeB3,
                'volumetotaledge' => $request -> volumetotaledge,
                // 'status' => 'pending'
            ]);

            return response()->json([
                'message' => 'Error occurred while sending data to cloud',
                'error' => $e->getMessage(),
                'data' => $data
            ], 500);
        }
    }
    public function index()
    {
        //
        $data = untan::latest()->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
