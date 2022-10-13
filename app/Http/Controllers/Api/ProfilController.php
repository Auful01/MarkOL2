<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilRequest;
use App\Models\Pendidikan;
// use App\Models\Profil;
use App\Models\Profil;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
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
        // $pendidikan = Pendidikan::find($id);
        // $profil = Profil::find($id);
        $lengkap = DB::table('users')
        ->select(  
                'profil.id',
                'profil.id_user',
                'users.name',
                'profil.nim',
                'profil.tgl_lahir',
                'profil.domisili',
                'profil.wa',
                'profil.photo',
                'profil.jenis_kelamin',
                // 'pendidikan.instansi',
                // 'pendidikan.jenjang',
                // 'pendidikan.fakultas',
                // 'pendidikan.jurusan',
                // 'pendidikan.tahun_masuk',
                // 'pendidikan.tahun_keluar'
                )
            ->join('profil', 'profil.id_user', '=', 'users.id')
            // ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            // ->groupBy('users.name')
            // ->orderBy('users.id', 'asc')
            
            ->get();
            
            // $pendidikan = DB::table('users')
            // ->select(
            //     'pendidikan.instansi',
            //     'pendidikan.jenjang',
            //     'pendidikan.fakultas',
            //     'pendidikan.jurusan',
            //     'pendidikan.tahun_masuk',
            //     'pendidikan.tahun_keluar'
            //     )
            // ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            // // ->where('users.id', '=', $id)
            // ->get();
            
            
            // return $pendidikan;
        // return $this->apiSuccess([$profil,  $pendidikan]);
        $customData = [];
        foreach($lengkap as $l){
            $pendidikan = Pendidikan::with('user')->where('id_user', $l->id_user)->get();
            $customPendidikan= [];
            if($pendidikan != null){
                foreach($pendidikan as $p){
                $tes['b'] = [
                    'id' => $p->id,
                  'instansi' => $p->instansi,
                    'jenjang' => $p->jenjang,
                    'fakultas' => $p->fakultas,
                    'jurusan' => $p->jurusan,
                    'tahun_masuk' => $p->tahun_masuk,
                    'tahun_keluar' => $p->tahun_keluar,
                    
                ];
                $customPendidikan[] = $tes['b'];
                }
            }
                
            $tes['a'] = [
                'id_profil' => $l->id,
                'id_user' => $l->id_user,
                'name' => $l->name,
                'nim' => $l->nim,
                'tgl_lahir' => $l->tgl_lahir,
                'wa' => $l->wa,
                'domisili' => $l->domisili,
                'photo' => $l->photo,
                'jenis_kelamin' => $l->jenis_kelamin,
                'pendidikan' => $customPendidikan

            ];
            $customData[] = $tes['a'];
            
          
               
          
            
        }
        return ['data' => $customData];
        // return ['data' => [ 
        //         $lengkap->pluck(['name','nim'])->toArray(),
        //         ], 'pendidikan' => $pendidikan ];
        // foreach($lengkap as $l){
        //     $l->name;
        // }
        // return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfilRequest $request)
    {
        $request->validated();
        if ($request->file('photo')) {
            $img_name = $request->file('photo')->store('gambar', 'public');
        }
        $user = auth()->user();
        $profil = Profil::create([
            'id_user' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nim' => $request->nim,
            'tgl_lahir' => $request->tgl_lahir,
            'domisili' => $request->domisili,
            'wa' => $request->wa,
            'photo' => $img_name
        ]);

        return $this->apiSuccess($profil);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByIDProfil($id)
    {
        // return $id;
        $user = auth()->user();
        // $pendidikan = Pendidikan::find($id);
        // $profil = Profil::find($id);
        $lengkap = DB::table('users')
        ->select(  
                'profil.id',
                'profil.id_user',
                'users.name',
                'profil.nim',
                'profil.tgl_lahir',
                'profil.domisili',
                'profil.wa',
                'profil.photo',
                'profil.jenis_kelamin',
                
                )
            ->join('profil', 'profil.id_user', '=', 'users.id')
            // ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            ->where('profil.id', '=' , $id)
            // ->groupBy('users.name')
            // ->orderBy('users.id', 'asc')
            
            ->get();
            
            $pendidikan = DB::table('users')
            ->select(
                'pendidikan.instansi',
                'pendidikan.jenjang',
                'pendidikan.fakultas',
                'pendidikan.jurusan',
                'pendidikan.tahun_masuk',
                'pendidikan.tahun_keluar'
                )
            ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->get();
        // return $this->apiSuccess([$profil,  $pendidikan]);
        $customData = [];
        foreach($lengkap as $l){
            $pendidikan = Pendidikan::with('user')->where('id_user', $l->id_user)->get();
            $customPendidikan= [];
            if($pendidikan != null){
                foreach($pendidikan as $p){
                $tes['b'] = [
                    'id' => $p->id,
                  'instansi' => $p->instansi,
                    'jenjang' => $p->jenjang,
                    'fakultas' => $p->fakultas,
                    'jurusan' => $p->jurusan,
                    'tahun_masuk' => $p->tahun_masuk,
                    'tahun_keluar' => $p->tahun_keluar,
                    
                ];
                $customPendidikan[] = $tes['b'];
                }
            }
                
            $tes['a'] = [
                'id' => $l->id,
                'id_user' => $l->id_user,
                'name' => $l->name,
                'nim' => $l->nim,
                'tgl_lahir' => $l->tgl_lahir,
                'wa' => $l->wa,
                'domisili' => $l->domisili,
                'photo' => $l->photo,
                'jenis_kelamin' => $l->jenis_kelamin,
                'pendidikan' => $customPendidikan

            ];
            $customData[] = $tes['a'];
            
            
        }
        return ['data' => $customData];
        // return ['data' => $lengkap, 'pendidikan' => $pendidikan ];
    }
    
      public function show($id)
    {
        // return $id;
        $user = auth()->user();
        // $pendidikan = Pendidikan::find($id);
        // $profil = Profil::find($id);
        $lengkap = DB::table('users')
        ->select(  
                'profil.id',
                'profil.id_user',
                'users.name',
                'profil.nim',
                'profil.tgl_lahir',
                'profil.domisili',
                'profil.wa',
                'profil.photo',
                'profil.jenis_kelamin',
                
                )
            ->join('profil', 'profil.id_user', '=', 'users.id')
            // ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            ->where('users.id', '=' , $id)
            // ->groupBy('users.name')
            // ->orderBy('users.id', 'asc')
            
            ->get();
            
            $pendidikan = DB::table('users')
            ->select(
                'pendidikan.instansi',
                'pendidikan.jenjang',
                'pendidikan.fakultas',
                'pendidikan.jurusan',
                'pendidikan.tahun_masuk',
                'pendidikan.tahun_keluar'
                )
            ->join('pendidikan', 'pendidikan.id_user', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->get();
        // return $this->apiSuccess([$profil,  $pendidikan]);
        $customData = [];
        foreach($lengkap as $l){
            $pendidikan = Pendidikan::with('user')->where('id_user', $l->id_user)->get();
            $customPendidikan= [];
            if($pendidikan != null){
                foreach($pendidikan as $p){
                $tes['b'] = [
                    'id' => $p->id,
                  'instansi' => $p->instansi,
                    'jenjang' => $p->jenjang,
                    'fakultas' => $p->fakultas,
                    'jurusan' => $p->jurusan,
                    'tahun_masuk' => $p->tahun_masuk,
                    'tahun_keluar' => $p->tahun_keluar,
                    
                ];
                $customPendidikan[] = $tes['b'];
                }
            }
                
            $tes['a'] = [
                'id' => $l->id,
                'id_user' => $l->id_user,
                'name' => $l->name,
                'nim' => $l->nim,
                'tgl_lahir' => $l->tgl_lahir,
                'wa' => $l->wa,
                'domisili' => $l->domisili,
                'photo' => $l->photo,
                'jenis_kelamin' => $l->jenis_kelamin,
                'pendidikan' => $customPendidikan

            ];
            $customData[] = $tes['a'];
            
          
               
          
            
        }
        return ['data' => $customData];
        // return ['data' => $lengkap, 'pendidikan' => $pendidikan ];
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
        // $request->validated();
        //return $request->file('photo');
        $user = auth()->user();
        $profil = Profil::with('user')->where('id_user', $id)->first();
        // return $user->id = ;
        // $profil->id_user =  $request['id_user'];
        if($user->id == $profil->id_user || $user->level == 1){
            $gbrlama = $profil->photo;
            //return $gbrlama;
            if ($request->file('photo') != null) {
                Storage::delete('storage/' . $profil->photo);
                $img_name = $request->file('photo')->store('photo', 'public');
            } else {
                $img_name = $gbrlama;
            }
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->nim = $request->nim;
            $profil->tgl_lahir = $request->tgl_lahir;
            $profil->domisili = $request->domisili;
            $profil->wa = $request->wa;
            $profil->photo = $img_name;
            $profil->save();
            $message = 'Update Sukses';
        }else{
            $message = 'Update Gagal, Anda Tidak Memiliki Akses';
        }

        return ['message' => $message];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        if (auth()->user()->id == $profil->id_user) {
            $profil->delete();
            return $this->apiSuccess($profil);
        }

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
