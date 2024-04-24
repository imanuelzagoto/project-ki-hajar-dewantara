<?php

namespace App\Http\Controllers;

use App\Models\MasterProjek;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class MasterProjekViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get(env('API_MASTER_PROJECT') . 'projects');

        // Periksa apakah permintaan berhasil.
        if ($response->successful()) {
            $projects = $response->json()['data'];
            return view('masterProjek.index', ['projects' => $projects]);
        } else {
            // Handle kesalahan jika permintaan tidak berhasil.
            return redirect()->back()->with('error', 'Failed to fetch projects from API');
        }
    }

    public function create()
    {
        return view('masterProjek.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'code_project' => 'required',
            'deadline' => 'nullable|date',
            'start' => 'nullable|date'
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_MASTER_PROJECT') . 'projects/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('project_name' => $request->project_name, 'code_project' => $request->code_project, 'deadline' => $request->deadline, 'start' => $request->start),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . Session::get('token')
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // return response
        return redirect()->route('master-projek.index')->with('success', 'Projek berhasil dibuat');
    }

    /**
     * show
     *
     * @param  mixed $master_projeks
     * @return void
     */

    public function show($id)
    {
        // Find surat perintah kerja by ID
        $master_Projeks = MasterProjek::find($id);

        // Check if the Surat_perintah_kerja exists
        if ($master_Projeks) {
            return view('masterProjek.show', compact('master_Projeks'));
        } else {
            return view('page404');
        }
    }

    public function edit($id)
    {
        $url = env('API_MASTER_PROJECT') . 'projects/' . $id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $masterProjek = json_decode($response, true)['data'];
        // dd($projects);

        if ($masterProjek) {
            return view('masterProjek.edit')->with('masterProjek', $masterProjek);
        } else {
            return view('page404');
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $surat_Perintah_Kerja
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'code_project' => 'required',
            'deadline' => 'nullable|date',
            'start' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Http::withHeaders([
            'Authorization' => Session::get('token')
        ])->put(env('API_MASTER_PROJECT') . 'projects/' . $id, $request->all());

        if ($response->successful()) {
            return redirect()->route('master-projek.index')->with('success', 'Projek berhasil diperbarui');
        } else {
            return redirect()->route('master-projek.index')->with('error', 'Gagal memperbarui projek');
        }
    }


    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $url = 'http://172.15.2.134/api/projects/' . $id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return redirect()->route('master-projek.index')->with('success', 'Data berhasil dihapus');
    }
}
