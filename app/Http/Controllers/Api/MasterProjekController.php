<?php

namespace App\Http\Controllers\Api;

use App\Models\MasterProjek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterProjekResource;
use Illuminate\Support\Facades\Validator;

class MasterProjekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $masterProjeks = MasterProjek::latest()->paginate(10);
        return new MasterProjekResource(true, 'List Master Data Projek', $masterProjeks);
    }

    /**
     * 
     * @param  mixed $request
     *  @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
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
        $master_Projeks = masterProjek::create([
            'nama_project' => $request->nama_project,
            'kode_project' => $request->kode_project,
            'tenggat' => $request->tenggat,
            'mulai' => $request->mulai,
            'akhir' => $request->akhir,
        ]);

        // return reponse
        return new MasterProjekResource(true, 'Data Master Projek Berhasil Ditambahkan!', $master_Projeks);
    }

    /**
     * show
     *
     * @param  mixed $master_projeks
     * @return void
     */
    public function show($id)
    {
        // Find Master Projek by ID
        $master_Projeks = MasterProjek::find($id);

        // Check if the master_projek exists
        if ($master_Projeks) {
            return new MasterProjekResource(true, 'Detail Data Master Projek!', $master_Projeks);
        } else {
            return response()->json(['message' => 'Data master projek tidak ditemukan!'], 404);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $master_projeks
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

        // return resonse
        return new MasterProjekResource(true, 'Data Master Projek Berhasil Diperbarui!', $masterProjek);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // find the 'master projek' by ID
        $masterProjek = MasterProjek::find($id);

        // check if master projek exists
        if (!$masterProjek) {
            return response()->json(['message' => 'Data master projek tidak ditemukan!'], 404);
        }

        // Delete master projek
        $masterProjek->delete();

        // Return response
        return response()->json(['message' => 'Data master projek berhasil dihapus!', 'success' => true, 'data' => null], 200);
    }
}
