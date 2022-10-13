<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
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
        $produk = DB::table('produk')->select('produk.id','produk.id_user', 'users.name', 'users.level','profil.photo','produk.gambar', 'produk.harga','produk.nama_produk', 'produk.deskripsi', 'profil.wa', 'produk.created_at', 'produk.updated_at')->join('users','produk.id_user','=','users.id')->join('profil','profil.id_user' ,'=','users.id')->orderBy('id', 'DESC')->get();
        // return $produk[$produk.length]['id'];
        return ['data' => $produk];
        // $name = $produk->user->name;
        // return $this->apiSuccess(
        //         // 'nama' => $produk[1]->user->name,
        //       $produk
            
        //     );
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
        if($user){
 
        if ($request->file('gambar')) {
            $img_name = $request->file('gambar')->store('gambar', 'public');
        }else{
            $message = 'Gambar Harus Diisi';
            return ['message' => $message];
        }
        $produk = Produk::create([
            'id_user' => $user->id,
            'gambar' => $img_name,
            'harga' => $request->harga,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi
        ]);
        
        $id = $produk->id;
        $hasil = DB::table('produk')->select('produk.id', 'produk.id_user', 'users.name', 'profil.photo','produk.gambar','produk.harga', 'produk.nama_produk', 'produk.deskripsi', 'produk.updated_at', 'produk.created_at')->join('users','produk.id_user', '=', 'users.id')->join('profil','profil.id_user','=', 'users.id')->where('produk.id','=',$id)->get();
        $message = 'Berhasil Menambah Data';
        }else{
            $message = 'Gagal Menambah Data';
        }
        
        return ['message' => $message];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk, $id)
    {
        
         $produk = DB::table('produk')->select('produk.id','produk.id_user', 'users.name', 'users.level','profil.photo','produk.gambar', 'produk.harga','produk.nama_produk', 'produk.deskripsi', 'profil.wa', 'produk.created_at', 'produk.updated_at')->join('users','produk.id_user','=','users.id')->join('profil','profil.id_user' ,'=','users.id')->where('produk.id', '=' ,$id)->get();
        return ['data' => $produk];
    }
    
    public function showProdukID($id)
    {
        //  return $id;
         $produk = DB::table('produk')->select('produk.id','produk.id_user', 'users.name', 'users.level','profil.photo','produk.gambar', 'produk.harga','produk.nama_produk', 'produk.deskripsi', 'profil.wa', 'produk.created_at', 'produk.updated_at')->join('users','produk.id_user','=','users.id')->join('profil','profil.id_user' ,'=','users.id')->where('users.id', '=' ,$id)->get();
        return ['data' => $produk];
    }
    
    public function showProdukLevel($id)
    {
        //  return $id;
         $produk = DB::table('produk')->select('produk.id','produk.id_user', 'users.name', 'users.level','profil.photo','produk.gambar', 'produk.harga','produk.nama_produk', 'produk.deskripsi', 'profil.wa', 'produk.created_at', 'produk.updated_at')->join('users','produk.id_user','=','users.id')->join('profil','profil.id_user' ,'=','users.id')->where('users.level', '=' ,$id)->get();
        return ['data' => $produk];
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
        //return $request;
        $user = auth()->user();
        //return $user;
        $produk = Produk::find($id);
        // return $user->level;
        if($user->id == $produk->id_user || $user->level == 1){
            
            $gbrlama = $produk->gambar;
            if ($request->file('gambar') != null) {
                Storage::delete('storage/' . $produk->gambar);
                $img_name = $request->file('gambar')->store('gambar', 'public');
            } else {
                $img_name = $gbrlama;
            }
            $produk->gambar = $img_name;
            $produk->harga = $request['harga'];
            $produk->nama_produk = $request['nama_produk'];
            $produk->deskripsi = $request['deskripsi'];
            $produk->save();
            $message = "Berhasil Update";
        }else{
            $message = "Gagal Update";
        }
        $id = $produk->id;
        $hasil = DB::table('produk')->select('produk.id', 'produk.id_user', 'users.name','users.level', 'profil.photo','produk.gambar','produk.harga', 'produk.nama_produk', 'produk.deskripsi', 'produk.updated_at', 'produk.created_at')->join('users','produk.id_user', '=', 'users.id')->join('profil','profil.id_user','=', 'users.id')->where('produk.id','=',$id)->get();
        // if($produk->save()){
            
        // }else{
            
        // }
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        // return $produk->id_user;
        $user = auth()->user();
        // return $user->id;
        if ($produk->id_user == $user->id || $user->level==1) {
            $produk->delete();
            // if($produk->delete()){
              $message = "Hapus Berhasil" ;
               return ['message' => $message];
            // }
           
        }else{

        return $this->apiError('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
    }
}
