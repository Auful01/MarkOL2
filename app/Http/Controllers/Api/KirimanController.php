<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KirimanRequest;
use App\Models\Kiriman;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KirimanController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Auth::user();
        // $kiriman = Kiriman::with('user')->with('profil')->get();
        $kiriman = DB::table('kiriman')->select('kiriman.id', 'kiriman.id_user', 'users.name', 'profil.photo','kiriman.gambar','kiriman.konten',  'kiriman.created_at', 'kiriman.updated_at')->join('users','kiriman.id_user', '=', 'users.id')->join('profil', 'profil.id_user', '=','users.id')->orderBy('id','DESC')->get();

        return ['data' => $kiriman];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        //return $request;
        if($user){
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            return $this->apiError('Eror', 404, 'Gambar harus diisi');
        }
        //return $img_name;
        //$user = auth()->user();
        $kiriman = Kiriman::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'konten' => $request->konten
        ]);
        
        $message = 'Berhasil Tambah Data';
        //return $kiriman;
       
        return ['message' => $message];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kiriman = DB::table('kiriman')->select('kiriman.id', 'kiriman.id_user', 'users.name', 'profil.photo','kiriman.gambar','kiriman.konten',  'kiriman.created_at', 'kiriman.updated_at')->join('users','kiriman.id_user', '=', 'users.id')->join('profil', 'profil.id_user', '=','users.id')->where('kiriman.id','=',$id)->get();

        return ['data' => $kiriman];
        // $kiriman = Kiriman::find($id);
        // return $this->apiSuccess($kiriman);
    }
    
    public function showID($id)
    {
        // return $id;
        $kiriman = DB::table('kiriman')->select('kiriman.id', 'kiriman.id_user', 'users.name', 'profil.photo','kiriman.gambar','kiriman.konten',  'kiriman.created_at', 'kiriman.updated_at')->join('users','kiriman.id_user', '=', 'users.id')->join('profil', 'profil.id_user', '=','users.id')->where('kiriman.id_user','=',$id)->get();

        return ['data' => $kiriman];
        // $kiriman = Kiriman::find($id);
        // return $this->apiSuccess($kiriman);
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
        // return $kiriman->gambar;
        // if ($kiriman->id) {
        // $request->validated();
        // return Request::get();
        $kiriman = Kiriman::find($id);
        // return $request;
        $gbrlama = $kiriman->gambar;
        if ($request->file('gambar') != null) {
            Storage::delete('storage/' . $kiriman->gambar);
            $img_name = $request->file('gambar')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        // $kiriman->id_user = auth()->user()->id;
        $kiriman->gambar = $img_name;
        $kiriman->konten = $request->konten;
        $kiriman->save();
        // }
        
        if($kiriman){
            $message = 'Update Sukses';
        }else{
            $message = 'Update Gagal';
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
        $kiriman = Kiriman::find($id);
        // return $kiriman;
        if ($kiriman && auth()->user()->level == 1 || auth()->user()->id == $kiriman->id_user) {
            $kiriman->delete();
                // if($kiriman->delete()){
            $message = 'Hapus Berhasil';
            return ['message' => $message];
            // }
        }else{
            return $this->apiError(
                'Unauthorized',
                Response::HTTP_UNAUTHORIZED
            );
        }
    }
}
