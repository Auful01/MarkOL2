<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $agenda = DB::table('agenda')->select('agenda.id','agenda.id_user', 'users.name','profil.photo', 'agenda.title','agenda.lokasi', 'agenda.konten', 'agenda.waktu', 'agenda.tanggal', 'agenda.photo', 'agenda.status','agenda.updated_at', 'agenda.created_at')->join('users','users.id','=','agenda.id_user')->join('profil','profil.id_user' ,'=','users.id')->where('agenda.status','=','1')->orderBy('id','DESC')->get();
        // $agenda = Agenda::all();
        return ['data'=>$agenda];
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
        if(auth()->user()){
            if ($request->file('photo')) {
                $img_name = $request->file('photo')->store('photo', 'public');
            }else{
                $message = "Gambar Harus diisi";
                return $message;
            }
            // return $request->file('photo');
            $user = auth()->user();
            $agenda = Agenda::create([
                'id_user' => $user->id,
                'title' => $request->title,
                'lokasi' => $request->lokasi,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'konten' => $request->konten,
                'photo' => $img_name,
                'status' => $request->status
            ]);
            
            $hasil = DB::table('agenda')->select('agenda.id','agenda.id_user','users.name','profil.photo','agenda.title', 'agenda.lokasi', 'agenda.tanggal', 'agenda.waktu', 'agenda.konten', 'agenda.photo', 'agenda.status', 'agenda.updated_at', 'agenda.created_at')->join('users','agenda.id_user','=','users.id')->join('profil','profil.id_user','=', 'users.id')->where('agenda.id', '=' , $agenda->id)->get();
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
    public function show($id)
    {

        $req = Agenda::find($id);
        return $this->apiSuccess($req);
    }
    
     public function showAgendaID($id)
    {
        // return $id;
        $hasil = DB::table('agenda')->select('agenda.id','agenda.id_user','users.name','profil.photo','agenda.title', 'agenda.lokasi', 'agenda.tanggal', 'agenda.waktu', 'agenda.konten', 'agenda.photo', 'agenda.status', 'agenda.updated_at', 'agenda.created_at')->join('users','agenda.id_user','=','users.id')->join('profil','profil.id_user','=', 'users.id')->where('users.id', '=' , $id)->get();
        // $req = Agenda::with('user')->where('id_user',$id)->get();
        return $hasil;
        // return $this->apiSuccess($req);
    }

    public function detail($id)
    {
        $req = Agenda::find($id);
        return $this->apiSuccess($req, 200, 'Data Ditemukan');
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
        // return $request;
        $user = auth()->user();
        $agenda = Agenda::find($id);
        if($user->id == $agenda->id_user || $user->level == 1){
          
        // return $agenda;
            $gbrlama = $agenda->photo;
            if ($request->file('photo') != null) {
                Storage::delete('public/' . $agenda->photo);
                $img_name = $request->file('photo')->store('gambar', 'public');
            } else {
                $img_name = $gbrlama;
            }
            $agenda->title = $request['title'];
            $agenda->lokasi = $request['lokasi'];
            $agenda->tanggal = $request['tanggal'];
            $agenda->waktu = $request['waktu'];
            $agenda->konten = $request['tanggal'];
            $agenda->photo = $img_name;
            $agenda->status = $request['status'];
            $agenda->save();
            $message = 'Update Sukses';
        }else{
            $message = 'Update Gagal';
        }
        return ['message' => $message];
    }

    public function pembaruan(Request $request, $id)
    {
        // $request->validated()
        $agenda = Agenda::find($id);
        // return $agenda;
        $gbrlama = $agenda->photo;
        if ($request->file('photo') != null) {
            Storage::delete('public/' . $agenda->photo);
            $img_name = $request->file('photo')->store('gambar', 'public');
        } else {
            $img_name = $gbrlama;
        }
        $agenda->title = $request['title'];
        $agenda->lokasi = $request['lokasi'];
        $agenda->tanggal = $request['tanggal'];
        $agenda->waktu = $request['waktu'];
        $agenda->konten = $request['tanggal'];
        $agenda->photo = $img_name;
        $agenda->status = $request['status'];
        $agenda->save();

        return $this->apiSuccess($agenda->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        if (auth()->user()->id == $agenda->id_user) {
            $agenda->delete();
            return $this->apiSuccess($agenda);
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }

    public function hapus($id)
    {
        $agenda = Agenda::find($id);
        if (auth()->user()->id == $agenda->id_user) {
            $agenda->delete();
            if($agenda->delete()){
                $message = 'Hapus Sukses';
                return $message;
            }
            
        }

        return $this->apiError(
            'Unauthorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
