<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendidikanRequest;
use App\Models\Pendidikan;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PendidikanController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pendidikan = Pendidikan::with('users')->where('id_user', $user->id);

        return $this->apiSuccess($pendidikan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validated();
     
        $user = auth()->user();
           if($user->id  || $user->level ==1){
                $pendidikan = Pendidikan::create([
                    'id_user' => $user->id,
                    'instansi' => $request->instansi,
                    'jenjang' => $request->jenjang,
                    'fakultas' => $request->fakultas,
                    'jurusan' => $request->jurusan,
                    'tahun_masuk' => $request->tahun_masuk,
                    'tahun_keluar' => $request->tahun_keluar
                ]);
                
                $message = 'Pendidikan '. $user->name .' Dengan id : '. $pendidikan->id . ' Berhasil Ditambah';
           }else{
               $message = 'Pendidikan '. $user->name .' Gagal Ditambah';
           }
            
            return ['message' => $message];
        // $data = DB::table('pendidikan')
        //             ->select('pendidikan.id', 'pendidikan.id_user', 'pendidikan.instansi' , 'pendidikan.jenjang', 'pendidikan.fakultas', 'pendidikan.jurusan', 'pendidikan.tahun_masuk', 'pendidikan.tahun_keluar')
        //             ->join('users', 'users.id', '=', 'pendidikan.id_user')
        //             ->get();
        // return [
        //         'id' => $pendidikan->id, 
        //         'instansi' => $pendidikan->instansi, 
        //         'jenjang' => $pendidikan->jenjang, 
        //         'jurusan' => $pendidikan->jurusan, 
        //         'tahun_masuk' => $pendidikan->tahun_masuk, 
        //         'tahun_keluar' => $pendidikan->tahun_keluar];
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pendidikan $pendidikan)
    {
        return $this->apiSuccess($pendidikan->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $pendidikan = Pendidikan::find($id)->first();
        // return auth()->user()->level;
        // $request->validated();
        $user = auth()->user();
        if($pendidikan->id_user == $user->id || $user->level == 1){ 
            $pendidikan->instansi = $request['instansi'];
            $pendidikan->jenjang  = $request['jenjang'];
            $pendidikan->fakultas = $request['fakultas'];
            $pendidikan->jurusan = $request['jurusan'];
            $pendidikan->tahun_masuk = $request['tahun_masuk'];
            $pendidikan->tahun_keluar = $request['tahun_keluar'];
            $pendidikan->save();
            $message = 'Data '. $pendidikan->user->name . ' Berhasil diupdate'; 
        }else{
            $message = 'Data '. $pendidikan->user->name . ' Gagal diupdate, Anda tidak memiliki akses';
        }
        

        return ['message' => $message];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $pendidikan->id;
        $pendidikan = Pendidikan::find($id);
        $user = auth()->user();
        if ($pendidikan->id_user == $user->id || $user->level == 1) {
            $pendidikan->delete();
            $message = 'Berhasil Dihapus';
            return ['message' => $message];
        }

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED, 'Anda Tidak memiliki akses untuk menghapus');
    }
}
