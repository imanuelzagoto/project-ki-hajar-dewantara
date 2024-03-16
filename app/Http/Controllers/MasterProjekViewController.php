<?php

namespace App\Http\Controllers;

use App\Models\MasterProjek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterProjekViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterProjeks = MasterProjek::latest()->paginate(10);
        return view('masterProjek.index')->with('masterProjeks', $masterProjeks);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define Validation rules
        $validator = Validator::make($request->all(), [
            'nama_project' => 'required',
            'kode_project' => 'required',
            'tenggat' => 'nullable|date',
            'mulai' => 'nullable|date',
            'akhir' => 'nullable|date',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create new MasterProjek instance
        $master_Projeks = MasterProjek::create([
            'nama_project' => $request->input('nama_project'),
            'kode_project' => $request->input('kode_project'),
            'tenggat' => $request->input('tenggat'),
            'mulai' => $request->input('mulai'),
            'akhir' => $request->input('akhir'),
        ]);

        // return response
        return redirect()->route('masterProjek.index')->with('success', 'Projek berhasil dibuat');
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
            return view('masterProjek.show.blade.php')->with('master_Projeks', $master_Projeks);
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
        $masterProjek = MasterProjek::find($id);

        if (!$masterProjek) {
            return response()->json(['message' => 'Data master projek tidak ditemukan!'], 404);
        }
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_project' => 'required',
            'kode_project' => 'required',
            'tenggat' => 'nullable|date',
            'mulai' => 'nullable|date',
            'akhir' => 'nullable|date',
        ]);

        // periksa jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update nilai baru master projek
        $masterProjek->update([
            'nama_project' => $request->nama_project,
            'kode_project' => $request->kode_project,
            'tenggat' => $request->tenggat,
            'mulai' => $request->mulai,
            'akhir' => $request->akhir,
        ]);
        // return response
        return redirect(route('masterProjek.index'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $masterProjek = MasterProjek::find($id);

        // check if the master projek exists
        if (!$masterProjek) {
            return response()->json(['message' => 'Data master projek tidak ditemukan!'], 404);
        }

        // Delete the 'Master Projek'
        $masterProjek->delete();

        // Return response
        return redirect(route('masterProjek.index'));
    }
}
