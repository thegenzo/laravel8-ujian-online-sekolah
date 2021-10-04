<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Soal;
use App\Models\Opsi;
use App\Models\Ujian;
use App\Models\Hasil;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UjianController extends Controller
{
    public function pilihMapel()
    {
        $mapel = MataPelajaran::where('status', '1')->get();

        return view('pages.ujian.index', compact('mapel'));
    }

    public function mulaiUjian($id)
    {
        $siswa = DB::table('siswas')->where('id_user', auth()->user()->id)->first();
        if(Ujian::where('id_siswa', $siswa->id)->where('id_mapel', $id)->exists()) {

            Alert::error('Gagal', 'Tidak bisa diakses karena sudah melakukan ujian');

            return redirect()->back();
        }
        else {
            $soal = Soal::where('id_mapel', $id)->inRandomOrder()->limit(40)->get();

            $mapel = MataPelajaran::where('id', $id)->first();
    
            return view('pages.ujian.mulai', compact('mapel', 'soal'));
        }

    }

    public function kirimJawaban(Request $request)
    {
        // mendapatkan data login
        // $user = auth()->user()->mahasiswa;
        $siswa = DB::table('siswas')->where('id_user', auth()->user()->id)->first();
        $data = $request->all();
        // dd($mahasiswa[0]);
        // exit();
        
        for($i = 1; $i <= $request->index; $i++) {
            
            if(isset($data['id_soal'.$i])) {

                $ujian = new Ujian();
                
                $soal = Soal::where('id', $data['id_soal'.$i])->get()->first();
                if($soal->jawaban_benar == $data['jawaban'.$i]) {
                    $ujian->betul = 1;
                }
                else {
                    $ujian->salah = 1;
                }

                $ujian->id_siswa = $siswa->id;
                $ujian->id_mapel = (int)$request->id_mapel;
                $ujian->id_soal = $soal->id;
                $ujian->save();
            }
            
        }

        // insert data ke tabel hasil yang dijadikan sebagai acuan
        $hasil = Hasil::create([
            'id_siswa' => $siswa->id,
            'id_mapel' => (int)$request->id_mapel,
            'nilai_final' => Ujian::where('id_siswa', $siswa->id)->where('id_mapel', $request->id_mapel)->where('betul', 1)->count('betul') * 2,
        ]);

        Alert::success('Berhasil', 'Ujian berhasil dilakukan');

        return redirect('/ujian');
    }

    public function daftarNilai()
    {
        // $hasil = Hasil::with('siswa.user')->where('id_user', auth()->user()->id)->get();
        $hasil = Hasil::whereHas('siswa', function ($query) {
            return $query->where('id_user', auth()->user()->id);
        })->get();

        return view('pages.ujian.daftar', compact('hasil'));
    }
}
