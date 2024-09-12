<?php

namespace App\Http\Controllers;

use App\Models\Menabung;
use Illuminate\Http\Request;
use App\Models\Tabungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        $tabungan = Tabungan::where('id_user', $id_user)->get();
        foreach ($tabungan as $t) {
            $t->progress = ($t->nominal_terkumpul / $t->target_nominal) * 100;
        }

        return view('home', [
            'tabungan' => $tabungan,
        ]);
    }

    public function buattabungan(Request $request)
    {
        if ($request->nominal_terkumpul > $request->target_nominal) {
            return redirect()->route('home')->with('gagal', 'Nominal tidak boleh melebihi target!');;
        }

        
        if ($request->hasFile('foto'))
        {
            $id_user = Auth::user()->id;
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $namafoto = $id_user . '_' . $request->judul . '.' . $extension;

            $data = [
                'id_user' => $id_user,
                'judul' => $request->judul,
                'foto' => $namafoto,
                'target_nominal' => $request->target_nominal,
                'target_tanggal' => $request->target_tanggal,
                'nominal_terkumpul' => $request->nominal_terkumpul ?? 0,
            ];

            $simpantabungan = Tabungan::create($data);
            if ($simpantabungan) {
                $foto->storeAs('tabungan', $namafoto, 'public');
                return redirect()->route('home')->with('berhasil', 'Tabungan Berhasil Dibuat');
            }
        }
    }

    public function edittabungan(Request $request, $id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $id_user = Auth::user()->id;

        if ($request->nominal_terkumpul > $request->target_nominal) {
            return redirect()->route('home')->with('gagal', 'Nominal tidak boleh melebihi target!');;
        }

        $tabungan->judul = $request->judul;
        $tabungan->target_nominal = $request->target_nominal;
        $tabungan->target_tanggal = $request->target_tanggal;
        $tabungan->nominal_terkumpul = $request->nominal_terkumpul ?? 0;

        if ($request->hasFile('foto')) {
            if ($tabungan->foto) {
                Storage::delete('public/' . $tabungan->foto);
            }

            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $namafoto = $id_user . '_' . $request->judul . '.' . $extension;

            $foto->storeAs('tabungan', $namafoto, 'public');
            $tabungan->foto = $namafoto;
        }

        $tabungan->save();

        return redirect()->route('home')->with('berhasil', 'Tabungan Berhasil Diubah');
    }

    public function hapustabungan($id)
    {
        $tabungan = Tabungan::findOrFail($id);

        if ($tabungan->foto) {
            Storage::delete('public/' . $tabungan->foto);
        }

        $tabungan->delete();

        return redirect()->route('home')->with('berhasil', 'Tabungan Berhasil Dihapus');
    }

    public function menabung(Request $request, $id)
    {
        $tabungan = Tabungan::findOrFail($id);

        $cekNominal = $request->nominal + $tabungan->nominal_terkumpul;
        if ($cekNominal > $tabungan->target_nominal) {
            return redirect()->route('home')->with('gagal', 'Nominal yang Anda masukkan melebihi target tabungan!');;
        }

        $tabungan->update([
            'nominal_terkumpul' => $tabungan->nominal_terkumpul + $request->nominal,
        ]);

        $data = [
            'id_tabungan' => $tabungan->id,
            'nominal' => $request->nominal,
            'tanggal_menabung' => now()->format('Y-m-d'),
        ];

        Menabung::create($data);
        return redirect()->route('home')->with('berhasil', 'Anda berhasil menabung');;
    }
}
