<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use App\Models\Kantor;
use App\Models\TimKerja;
use App\Models\TrSPPD;
use App\Models\TrSPPDPegawai;
use App\Models\Kwitansi;
use App\Models\Role;
use App\Models\User;
use App\Models\SPJ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;
use Session;
use ZipArchive;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// use Barryvdh\DomPDF\Facade as PDF; 

class SPPDController extends Controller
    {

        public function detail_profile()
        {
            // Get the currently authenticated user
            $user = Auth::user();

            // Fetch the associated team name based on the user's team ID
            $team = DB::table('tim_kerja')->where('id_tim_kerja', $user->nama_tim)->first();

            return view('profile.detailprofile', [
                'username' => $user->username,
                'nama_tim' => $team->nama_tim ?? 'Tim tidak ditemukan', // Default message if team is not found
            ]);
        }
        
        // public function updatePassword(Request $request)
        // {
        //     // Validate the input
        //     $request->validate([
        //         'password_sekarang' => 'required',
        //         'password_baru' => 'required|min:6',
        //         'konfirmasi_password' => 'required|same:password_baru',
        //     ]);
    
        //     // Get the currently authenticated user
        //     $user = Auth::user();
    
        //     // Check if the current password is correct
        //     if (!Hash::check($request->password_sekarang, $user->password)) {
        //         return back()->withErrors(['password_sekarang' => 'Password saat ini tidak sesuai.']);
        //     }
    
        //     // Update the password
        //     $user->password = Hash::make($request->password_baru);
        //     $user->save();
    
        //     return redirect()->route('profile.detailprofile')->with('success', 'Password berhasil diubah.');
        // }
    

        public function dashboard()
        {
            // Get the currently authenticated user
            $user = Auth::user();
        
            // Fetch the associated team budget based on the user's team ID
            $timKerja = DB::table('tim_kerja')->where('id_tim_kerja', $user->nama_tim)->first();
            
            // Fetch the role name
            $roleName = $user->role->nama_role ?? 'User'; // Default to 'User' if not found
        
            return view('dashboard', [
                'anggaran_awal' => $timKerja->anggaran_awal ?? 0,
                'sisa_anggaran' => $timKerja->sisa_anggaran ?? 0,
                'tahun_anggaran' => $timKerja->tahun_anggaran ?? date('Y'), // Default tahun sekarang jika tidak ditemukan
                'roleName' => $roleName
            ]);
        }

        public function updateAnggaran(Request $request)
        {
            // Validasi input form
            $request->validate([
                'total_keseluruhan' => 'required|numeric',
            ]);
        
            // Dapatkan user yang sedang login
            $user = Auth::user();
        
            // Ambil anggaran awal dan sisa anggaran tim kerja user
            $timKerja = DB::table('tim_kerja')->where('id_tim_kerja', $user->nama_tim)->first();
            $sisaAnggaran = $timKerja->sisa_anggaran;
            $anggaranAwal = $timKerja->anggaran_awal;
        
            // Kurangi anggaran awal dengan total keseluruhan
            $newSisaAnggaran = $sisaAnggaran - $request->total_keseluruhan;
        
            // Update kolom sisa_anggaran di tabel tim_kerja
            DB::table('tim_kerja')
                ->where('id_tim_kerja', $user->nama_tim)
                ->update(['sisa_anggaran' => $newSisaAnggaran]);
        
            // Redirect ke halaman dashboard dengan pesan sukses
            return redirect()->route('dashboard')->with('success', 'Sisa anggaran berhasil diperbarui.');
        }        

        public function inputSPPD()
        {
            // Ambil semua karyawan
            $karyawans = Karyawan::all(); // Ambil semua karyawan
            $kantors = DB::table('kantor')->get(); // Mengambil data kantor
        
            return view('input_sppd', compact('karyawans', 'kantors'));
        }    

        public function getKaryawan($nama_staff)
        {
            $karyawan = Karyawan::where('nama_staff', $nama_staff)->first(); // Ambil data karyawan berdasarkan Nama staff
            return response()->json($karyawan); // Kirim sebagai JSON
        }

        public function storeSPPD(Request $request)
        {
            $validatedData = $request->validate([
                'no_spt' => 'required',
                'tanggal_spt' => 'required|date',
                'ppk' => 'required',
                'angkutan' => 'required',
                'perihal' => 'required',
                'tujuan' => 'required',
                'tgl_berangkat' => 'required|date',
                'tgl_kembali' => 'required|date',
                'lama_perjalanan' => 'required',
                'nama_staff.*' => 'required', // validasi NIP pegawai
            ]);
        
            // Insert ke tabel tr_sppd
            $sppd = new TrSPPD();
            $sppd->no_spt = $request->input('no_spt');
            $sppd->ppk = $request->input('ppk');
            $sppd->perihal_sppd = $request->input('perihal');
            $sppd->angkutan = $request->input('angkutan');
            $sppd->tujuan = $request->input('tujuan');
            $sppd->tgl_berangkat = $request->input('tgl_berangkat');
            $sppd->tgl_kembali = $request->input('tgl_kembali');
            $sppd->lama_perjalanan = $request->input('lama_perjalanan');
            $sppd->tgl_spt = $request->input('tanggal_spt');
            $sppd->status = 'Aktif'; // default status
            $sppd->save();
        
            // Dapatkan nama_tim user yang melakukan input
            $nama_tim_user = Auth::user()->nama_tim;
        
            // Insert ke tabel tr_sppd_pegawai
            foreach ($request->input('nama_staff') as $nama_staff) {
                $karyawan = Karyawan::where('nama_staff', $nama_staff)->first();
        
                if ($karyawan) {
                    $pegawai = new TrSPPDPegawai();
                    $pegawai->id_sppd = $sppd->id_sppd; // Pastikan id_sppd yang sama
                    $pegawai->id_staff = $karyawan->id_staff;
                    $pegawai->nama_tim = $nama_tim_user; // Set nama_tim dari user yang login
                    $pegawai->save();
                } else {
                    return redirect()->back()->with('error', 'Karyawan dengan Nama ' . $nama_staff . ' tidak ditemukan.');
                }
            }
        
            return redirect()->route('sppd.index')->with('success', 'Data SPPD berhasil disimpan.');
        }                

        public function index(Request $request)
        {
            // Ambil parameter sorting dari request, defaultnya adalah ascending (asc)
            $sort = $request->input('sort', 'asc');
        
            // Dapatkan nama_tim user yang sedang login
            $nama_tim_user = Auth::user()->nama_tim;
        
            // Query untuk mengambil data SPPD yang aktif, urutkan berdasarkan Tanggal SPT, dan filter berdasarkan nama_tim
            $sppds = TrSPPD::where('status', 'Aktif')
                            ->whereHas('pegawai', function($query) use ($nama_tim_user) {
                                $query->where('nama_tim', $nama_tim_user);
                            })
                            ->orderBy('tgl_spt', $sort)
                            ->paginate(10); // Batasi 10 data per halaman
        
            // Kembalikan ke view dengan data SPPD, dan sertakan sorting untuk digunakan di view
            return view('sppd.index', compact('sppds'))->with('sort', $sort);
        }             

        public function detail($id)
        {
            $sppd = TrSppd::findOrFail($id);
        
            $pegawaiList = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->where('tr_sppd_pegawai.id_sppd', $id)
                ->select('karyawan.nama_staff', 'karyawan.nip', 'karyawan.golongan', 'karyawan.jabatan')
                ->get();
        
            $kantorList = DB::table('kantor')->select('nama_kantor')->get();
            
            $lamaPerjalanan = \Carbon\Carbon::parse($sppd->tgl_berangkat)->diffInDays($sppd->tgl_kembali);
        
            return view('sppd.detail', compact('sppd', 'pegawaiList', 'kantorList', 'lamaPerjalanan'));
        }

        public function editsppd($id)
        {
            $sppd = TrSppd::findOrFail($id);
        
            $pegawaiList = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->where('tr_sppd_pegawai.id_sppd', $id)
                ->select('karyawan.nama_staff', 'karyawan.nip', 'karyawan.golongan', 'karyawan.jabatan')
                ->get();
        
            $kantorList = DB::table('kantor')->select('nama_kantor')->get();
            
            $lamaPerjalanan = \Carbon\Carbon::parse($sppd->tgl_berangkat)->diffInDays($sppd->tgl_kembali);
        
            return view('sppd.editsppd', compact('sppd', 'pegawaiList', 'kantorList', 'lamaPerjalanan'));
        }
    
        public function update(Request $request, $id)
        {
            $sppd = TrSppd::findOrFail($id);
            
            $sppd->no_spt = $request->no_spt;
            $sppd->tgl_spt = $request->tgl_spt;
            $sppd->perihal_sppd = $request->perihal;
            $sppd->angkutan = $request->angkutan;
            $sppd->tujuan = $request->tujuan;
            $sppd->tgl_berangkat = $request->tgl_berangkat;
            $sppd->tgl_kembali = $request->tgl_kembali;
            $sppd->lama_perjalanan = $request->lama_perjalanan;
            
            $sppd->save();
        
            return redirect()->route('sppd.detail', $id)->with('success', 'SPT updated successfully');
        }        

        public function cetakSPT($id)
        {
            // Ambil data SPPD berdasarkan id
            $sppd = TrSppd::findOrFail($id);

            // Ambil data pegawai terkait dengan SPPD melalui tabel tr_sppd_pegawai
            $pegawaiList = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->where('tr_sppd_pegawai.id_sppd', $id)
                ->select('karyawan.nama_staff', 'karyawan.nip', 'karyawan.golongan', 'karyawan.jabatan')
                ->get();

            // Ambil data PPK berdasarkan nama_staff di tabel karyawan
            $ppk = DB::table('karyawan')
                ->where('nama_staff', $sppd->ppk) // Mencari PPK dari nama_staff
                ->select('nip', 'golongan')
                ->first();

            // Ambil data pegawai dengan id_staff = 1
            $staffFixed = DB::table('karyawan')
                ->where('id_staff', 1)  // Mengambil data dari id_staff = 1
                ->select('nip', 'golongan')
                ->first();

            // Ambil alamat kantor berdasarkan tujuan (nama kantor)
            $kantor = DB::table('kantor')
                ->where('nama_kantor', $sppd->tujuan) // Mencari alamat_kantor sesuai tujuan
                ->select('alamat_kantor')
                ->first();

            // Kembalikan view untuk dicetak
            return view('pdf.cetak-spt', compact('sppd', 'pegawaiList', 'ppk', 'staffFixed', 'kantor'));
        }

        // public function cetakSPT($id)
        // {
        //     // Ambil data SPPD berdasarkan id
        //     $sppd = TrSppd::findOrFail($id);
        
        //     // Ambil data pegawai terkait dengan SPPD melalui tabel tr_sppd_pegawai
        //     $pegawaiList = DB::table('tr_sppd_pegawai')
        //         ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
        //         ->where('tr_sppd_pegawai.id_sppd', $id)
        //         ->select('karyawan.nama_staff', 'karyawan.nip', 'karyawan.golongan', 'karyawan.jabatan')
        //         ->get();
        
        //     // Ambil data PPK berdasarkan nama_staff di tabel karyawan
        //     $ppk = DB::table('karyawan')
        //         ->where('nama_staff', $sppd->ppk) // Mencari PPK dari nama_staff
        //         ->select('nip', 'golongan')
        //         ->first();
        
        //     // Ambil data pegawai dengan id_staff = 1
        //     $staffFixed = DB::table('karyawan')
        //         ->where('id_staff', 1)  // Mengambil data dari id_staff = 1
        //         ->select('nip', 'golongan')
        //         ->first();
        
        //     // Ambil alamat kantor berdasarkan tujuan (nama kantor)
        //     $kantor = DB::table('kantor')
        //         ->where('nama_kantor', $sppd->tujuan) // Mencari alamat_kantor sesuai tujuan
        //         ->select('alamat_kantor')
        //         ->first();
        
        //     // Generate PDF dengan data yang ada
        //     $pdf = PDF::loadView('pdf.cetak-spt', compact('sppd', 'pegawaiList', 'ppk', 'staffFixed', 'kantor'));
        
        //     return $pdf->download('spt.pdf');
        // }    

        public function cetakSpd($id)
        {
            // Ambil data SPPD berdasarkan ID yang diberikan
            $sppd = TrSppd::findOrFail($id);
        
            // Ambil semua pegawai yang terkait dengan SPPD ini
            $pegawaiList = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->where('tr_sppd_pegawai.id_sppd', $id)
                ->select('karyawan.nama_staff', 'karyawan.nip', 'karyawan.golongan', 'karyawan.jabatan')
                ->get();
        
            // Ambil data kantor
            $kantor = DB::table('kantor')->where('id_kantor', 1)->first();

            $staff1 = DB::table('karyawan')->where('id_staff', 1)->first();
        
            // Hitung lama perjalanan
            $lamaPerjalanan = \Carbon\Carbon::parse($sppd->tgl_berangkat)->diffInDays($sppd->tgl_kembali);
        
            // $pdf = PDF::loadView('sppd.spd_template', compact('sppd', 'pegawaiList', 'kantor', 'lamaPerjalanan'));
        
            // Return the PDF for printing
            // return $pdf->stream('SPD_All_Employees.pdf');

            // Return tampilan yang akan dicetak
            return view('sppd.spd_template', compact('sppd', 'pegawaiList', 'kantor', 'lamaPerjalanan','staff1'));
        }                

        public function cetakTTD($id)
        {
            $sppd = TrSppd::findOrFail($id);
            
            $ppkDetails = DB::table('karyawan')
                ->where('id_staff', 1)
                ->first();
            
                return view('pdf.ttd_template', compact('sppd', 'ppkDetails'));
                // $pdf = PDF::loadView('pdf.ttd_template', compact('sppd', 'ppkDetails'));
                
                // return $pdf->download('ttd_sppd_'.$sppd->no_spt.'.pdf');
            }        

        public function laporan($id)
        {
            // Ambil data SPPD berdasarkan id
            $sppd = TrSppd::findOrFail($id);

            // Ambil data pegawai yang terkait dengan SPPD tersebut
            $pegawai = DB::table('karyawan')
                ->join('tr_sppd_pegawai', 'karyawan.id_staff', '=', 'tr_sppd_pegawai.id_staff')
                ->join('tr_sppd', 'tr_sppd_pegawai.id_sppd', '=', 'tr_sppd.id_sppd') 
                ->where('tr_sppd_pegawai.id_sppd', $id)
                ->select('karyawan.*', 'tr_sppd.tujuan') // Ambil kolom tujuan
                ->get();

            // Ambil data kantor berdasarkan nama_kantor yang ada di kolom tujuan
            $kantor = DB::table('kantor')
                ->where('nama_kantor', $sppd->tujuan) // Sesuaikan berdasarkan tujuan (nama_kantor)
                ->select('akomodasi', 'uang_harian', 'transport')
                ->first();

            return view('sppd.laporan', compact('sppd', 'pegawai', 'kantor'));
        }

        public function storeLaporan(Request $request, $id)
        {
            $id_sppd = $id;
            
            $idStaffArray = $request->input('id_staff');
            $no_kwitansi = $request->input('no_kwitansi');
            $laporan = $request->input('laporan');
            
            $uangHariArray = $request->input('total_harian');
            $lamaPerjalananArray = $request->input('lama_perjalanan');
            $uangTransportArray = $request->input('total_transport');
            $biayaTransportArray = $request->input('biaya_transport');
            $uangAkomodasiArray = $request->input('total_akomodasi');
            $lamaAkomodasiArray = $request->input('lama_akomodasi');
            $totalKwitansiArray = $request->input('total_biaya');
        
            for ($i = 0; $i < count($idStaffArray); $i++) {
                $id_tr_sppd_pegawai = DB::table('tr_sppd_pegawai')
                    ->where('id_sppd', $id_sppd)
                    ->where('id_staff', $idStaffArray[$i])
                    ->value('id_tr_sppd_pegawai');
        
                // Insert into tr_kwitansi
                DB::table('tr_kwitansi')->insert([
                    'no_kwitansi' => $no_kwitansi,
                    'id_sppd' => $id_sppd,
                    'id_tr_sppd_pegawai' => $id_tr_sppd_pegawai,
                    'laporan' => $laporan,
                    'uang_hari' => $uangHariArray[$i],
                    'lama_perjalanan' => $lamaPerjalananArray[$i],
                    'total_harian' => $uangHariArray[$i] * $lamaPerjalananArray[$i], // Total Harian
                    'uang_transport' => $uangTransportArray[$i],
                    'biaya_transport' => $biayaTransportArray[$i],
                    'total_transport' => $uangTransportArray[$i] * $biayaTransportArray[$i], // Total Transport
                    'uang_akomodasi' => $uangAkomodasiArray[$i],
                    'lama_akomodasi' => $lamaAkomodasiArray[$i],
                    'total_akomodasi' => $uangAkomodasiArray[$i] * $lamaAkomodasiArray[$i], // Total Akomodasi
                    'total_kwitansi' => $totalKwitansiArray[$i], // Total Kwitansi
                ]);
            }
        
            DB::table('tr_sppd')
                ->where('id_sppd', $id_sppd)
                ->update(['status' => 'Laporan Submitted']);
        
            return redirect()->route('riwayat.riwayatsppd')->with('success', 'Laporan kwitansi berhasil disimpan!');
        }                   

        public function riwayatsppd()
        {
            $userTeamId = auth()->user()->nama_tim; 
        
            $riwayat = DB::table('tr_sppd')
                ->join('tr_sppd_pegawai', 'tr_sppd.id_sppd', '=', 'tr_sppd_pegawai.id_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->where('tr_sppd_pegawai.nama_tim', $userTeamId)
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.tgl_spt',
                    'tr_kwitansi.no_kwitansi',
                    DB::raw('count(tr_kwitansi.id_kwitansi) as total_pegawai')
                )
                ->groupBy('tr_sppd.no_spt', 'tr_sppd.tgl_spt', 'tr_kwitansi.no_kwitansi')
                ->orderBy('tr_kwitansi.id_kwitansi', 'desc')
                ->paginate(10); // Menambahkan pagination dengan 10 item per halaman
        
            return view('riwayat.riwayatsppd', compact('riwayat'));
        }        

        public function detailriwayat($no_kwitansi)
        {
            $details = DB::table('tr_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->join('tr_sppd_pegawai', 'tr_kwitansi.id_tr_sppd_pegawai', '=', 'tr_sppd_pegawai.id_tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.tgl_spt',
                    'tr_kwitansi.no_kwitansi',
                    'tr_kwitansi.laporan',
                    'tr_kwitansi.uang_hari',
                    'tr_kwitansi.lama_perjalanan',
                    'tr_kwitansi.uang_transport',
                    'tr_kwitansi.biaya_transport',
                    'tr_kwitansi.uang_akomodasi',
                    'tr_kwitansi.lama_akomodasi',
                    'tr_kwitansi.total_harian',
                    'tr_kwitansi.total_transport',
                    'tr_kwitansi.total_akomodasi',
                    'tr_kwitansi.total_kwitansi',
                    'karyawan.nip',
                    'karyawan.nama_staff'
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();

            return view('riwayat.detailriwayat', compact('details'));
        }

        public function downloadSPT($no_kwitansi)
        {
            // Ambil data detail SPPD
            $details = DB::table('tr_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->join('tr_sppd_pegawai', 'tr_kwitansi.id_tr_sppd_pegawai', '=', 'tr_sppd_pegawai.id_tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.ppk',
                    'tr_sppd.perihal_sppd',
                    'tr_sppd.tgl_spt',
                    'tr_sppd.tgl_berangkat',
                    'tr_sppd.tgl_kembali',
                    'karyawan.nip',
                    'karyawan.nama_staff',
                    'karyawan.golongan',
                    'karyawan.jabatan'
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();

            // Ambil data pegawai dengan id_staff = 1
            $pegawai_satu = DB::table('karyawan')
                ->where('id_staff', 1)
                ->first();

            // Data untuk dikirim ke view PDF
            $data = [
                'details' => $details,
                'pegawai_satu' => $pegawai_satu,
                'no_spt' => $details->first()->no_spt,
                'ppk' => $details->first()->ppk,
                'perihal_sppd' => $details->first()->perihal_sppd,
                'tgl_spt' => $details->first()->tgl_spt,
            ];
            
            \Carbon\Carbon::setLocale('id');
            return view('pdf.downloadspt', $data);
            // $pdf = PDF::loadView('pdf.downloadspt', $data);

            // return $pdf->download('downloadspt.pdf');
        }

        public function downloadSPD($no_kwitansi)
        {
            setlocale(LC_TIME, 'id_ID.UTF-8');
            Carbon::setLocale('id');
        
            // Ambil data karyawan yang terkait dengan kwitansi
            $details = DB::table('tr_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->join('tr_sppd_pegawai', 'tr_kwitansi.id_tr_sppd_pegawai', '=', 'tr_sppd_pegawai.id_tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.perihal_sppd',
                    'tr_sppd.angkutan',
                    'tr_sppd.tujuan',
                    'tr_sppd.lama_perjalanan',
                    'tr_sppd.tgl_berangkat',
                    'tr_sppd.tgl_kembali',
                    'tr_sppd.tgl_spt',
                    'tr_sppd.ppk',
                    'karyawan.nip',
                    'karyawan.nama_staff',
                    'karyawan.golongan',
                    'karyawan.jabatan'
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();
                
            // Ambil data Pejabat Pembuat Komitmen
            $staff1 = DB::table('karyawan')->where('id_staff', 1)->first();
        
            // Load halaman untuk cetak langsung
            return view('pdf.downloadspd', [
                'details' => $details, // Pass multiple details here
                'staff1' => $staff1

            //     // Generate satu PDF dengan beberapa halaman
            // $pdf = PDF::loadView('pdf.downloadspd', [
            //     'details' => $details, // Pass multiple details here
            //     'staff1' => $staff1
            // ]);
        
            // // Output PDF langsung untuk di-download atau di-print
            // return $pdf->stream('Surat_PSPD.pdf');
            ]);
        }                        

        public function downloadTtd($no_kwitansi)
        {
            // Mengambil data dari tabel tr_kwitansi berdasarkan no_kwitansi
            $kwitansi = Kwitansi::where('no_kwitansi', $no_kwitansi)->first();
        
            // Memastikan data kwitansi ditemukan
            if (!$kwitansi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
        
            // Mengambil data dari tabel tr_sppd berdasarkan id_sppd dari tabel tr_kwitansi
            $sppd = TrSPPD::where('id_sppd', $kwitansi->id_sppd)->first();
        
            // Memastikan data SPPD ditemukan
            if (!$sppd) {
                return redirect()->back()->with('error', 'Data SPPD tidak ditemukan.');
            }
        
            // Mengambil data karyawan untuk keperluan tanda tangan
            $staff = Karyawan::where('id_staff', 1)->first();
        
            return view('pdf.downloadttd', compact('kwitansi', 'sppd', 'staff'));
        }        
        // $pdf = PDF::loadView('pdf.downloadttd', compact('staff'));

        // return $pdf->download('ttd.pdf');

        public function cetakLaporan($no_kwitansi)
        {
            $details = DB::table('tr_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->join('tr_sppd_pegawai', 'tr_kwitansi.id_tr_sppd_pegawai', '=', 'tr_sppd_pegawai.id_tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.perihal_sppd',
                    'tr_sppd.tgl_spt',
                    'karyawan.nama_staff',
                    'tr_kwitansi.laporan'
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();
        
            $kantor = DB::table('kantor')
                ->select('nama_kantor')
                ->where('id_kantor', 1)
                ->first();
        
            $tim_kerja = DB::table('tim_kerja')
                ->select('nama_tim')
                ->where('id_tim_kerja', 3)
                ->first();
        
                return view('pdf.laporan', compact('details', 'kantor', 'tim_kerja'));

            // $pdf = PDF::loadView('pdf.laporan', compact('details', 'kantor', 'tim_kerja'));
    
            // return $pdf->download('laporan_sppd_' . $no_kwitansi . '.pdf');
        }

        public function downloadKwitansi($no_kwitansi)
        {
            // Get employees involved in the SPPD based on the no_kwitansi
            $employees = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->join('tr_kwitansi', 'tr_sppd_pegawai.id_tr_sppd_pegawai', '=', 'tr_kwitansi.id_tr_sppd_pegawai')
                ->join('tr_sppd', 'tr_sppd_pegawai.id_sppd', '=', 'tr_sppd.id_sppd') // Join ke tabel tr_sppd
                ->select(
                    'karyawan.nama_staff',
                    'karyawan.nip',
                    'tr_kwitansi.no_kwitansi',
                    'tr_kwitansi.total_harian',
                    'tr_kwitansi.total_transport',
                    'tr_kwitansi.total_akomodasi',
                    'tr_kwitansi.total_kwitansi',
                    'tr_kwitansi.lama_perjalanan',
                    'tr_kwitansi.biaya_transport',
                    'tr_kwitansi.lama_akomodasi',
                    'tr_kwitansi.uang_hari',
                    'tr_kwitansi.uang_transport',
                    'tr_kwitansi.uang_akomodasi',
                    'tr_sppd.perihal_sppd', // Mengambil data perihal_sppd dari tabel tr_sppd
                    'tr_sppd.tgl_berangkat', // Mengambil data perihal_sppd dari tabel tr_sppd
                    'tr_sppd.tgl_kembali' // Mengambil data perihal_sppd dari tabel tr_sppd
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();
            
            // Split employees into groups of 2
            $employeeGroups = $employees->chunk(2); // Each group contains 2 employees
        
            return view('pdf.downloadkwitansi', compact('employeeGroups'));
            // // Load the view and pass the groups of employees
            // $pdf = Pdf::loadView('pdf.downloadkwitansi', compact('employeeGroups'));
        
            // // Download the PDF file
            // return $pdf->download('kwitansi-' . $no_kwitansi . '.pdf');
        }

        public function editdetailriwayat($no_kwitansi)
        {
            $details = DB::table('tr_sppd')
                ->join('tr_kwitansi', 'tr_sppd.id_sppd', '=', 'tr_kwitansi.id_sppd')
                ->join('tr_sppd_pegawai', 'tr_kwitansi.id_tr_sppd_pegawai', '=', 'tr_sppd_pegawai.id_tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->select(
                    'tr_sppd.no_spt',
                    'tr_sppd.tgl_spt',
                    'tr_kwitansi.no_kwitansi',
                    'tr_kwitansi.laporan',
                    'tr_kwitansi.uang_hari',
                    'tr_kwitansi.lama_perjalanan',
                    'tr_kwitansi.uang_transport',
                    'tr_kwitansi.biaya_transport',
                    'tr_kwitansi.uang_akomodasi',
                    'tr_kwitansi.lama_akomodasi',
                    'tr_kwitansi.total_harian',
                    'tr_kwitansi.total_transport',
                    'tr_kwitansi.total_akomodasi',
                    'tr_kwitansi.total_kwitansi',
                    'tr_kwitansi.id_tr_sppd_pegawai',
                    'tr_kwitansi.id_sppd',
                    'karyawan.nip', 
                    'karyawan.nama_staff'
                )
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->get();

            return view('riwayat.editdetailriwayat', compact('details'));
        }    

        public function updateDetailRiwayat(Request $request, $no_kwitansi)
        {
            DB::table('tr_kwitansi')
                ->where('no_kwitansi', $no_kwitansi)
                ->update([
                    'no_kwitansi' => $request->input('no_kwitansi'),
                    'laporan' => $request->input('laporan')
                ]);
        
            $id_tr_sppd_pegawai_list = $request->input('id_tr_sppd_pegawai');
            $uang_hari_list = $request->input('uang_hari');
            $lama_perjalanan_list = $request->input('lama_perjalanan');
            $total_harian_list = $request->input('total_harian');
            $uang_transport_list = $request->input('uang_transport');
            $biaya_transport_list = $request->input('biaya_transport');
            $total_transport_list = $request->input('total_transport');
            $uang_akomodasi_list = $request->input('uang_akomodasi');
            $lama_akomodasi_list = $request->input('lama_akomodasi');
            $total_akomodasi_list = $request->input('total_akomodasi');
            $total_kwitansi_list = $request->input('total_kwitansi');
        
            foreach ($id_tr_sppd_pegawai_list as $index => $id_tr_sppd_pegawai) {
                DB::table('tr_kwitansi')
                    ->where('id_tr_sppd_pegawai', $id_tr_sppd_pegawai)
                    ->update([
                        'uang_hari' => $uang_hari_list[$index],
                        'lama_perjalanan' => $lama_perjalanan_list[$index],
                        'total_harian' => $total_harian_list[$index],
                        'uang_transport' => $uang_transport_list[$index],
                        'biaya_transport' => $biaya_transport_list[$index],
                        'total_transport' => $total_transport_list[$index],
                        'uang_akomodasi' => $uang_akomodasi_list[$index],
                        'lama_akomodasi' => $lama_akomodasi_list[$index],
                        'total_akomodasi' => $total_akomodasi_list[$index],
                        'total_kwitansi' => $total_kwitansi_list[$index]
                    ]);
            }
        
            return redirect()->route('riwayat.detail', ['no_kwitansi' => $request->input('no_kwitansi')])
                ->with('success', 'Data updated successfully!');
        }                   

        public function cetakkwitansi($no_kwitansi)
        {
            // Fetch data for kwitansi
            $kwitansi = DB::table('tr_sppd_pegawai')
                ->join('karyawan', 'tr_sppd_pegawai.id_staff', '=', 'karyawan.id_staff')
                ->join('tr_kwitansi', 'tr_sppd_pegawai.id_tr_sppd_pegawai', '=', 'tr_kwitansi.id_tr_sppd_pegawai')
                ->where('tr_kwitansi.no_kwitansi', $no_kwitansi)
                ->select('karyawan.nip', 'karyawan.nama_staff')
                ->get();

            if ($kwitansi->isEmpty()) {
                return back()->with('error', 'No data found for this Kwitansi');
            }

            return view('riwayat.cetakkwitansi', compact('kwitansi'));
        }

        public function inputSPJ($no_kwitansi)
        {
            $spj = SPJ::where('no_kwitansi', $no_kwitansi)->first(); // Fetch SPJ record
            return view('riwayat.inputspj', compact('no_kwitansi', 'spj'));
        }        

        public function storeSPJ(Request $request)
        {
            // Validasi input file
            $request->validate([
                'file_spt' => 'nullable|mimes:pdf',
                'file_spd' => 'nullable|mimes:pdf',
                'file_visum' => 'nullable|mimes:pdf',
                'file_laporan' => 'nullable|mimes:pdf',
                'file_kwitansi' => 'nullable|mimes:pdf',
                'file_poto' => 'nullable|mimes:jpg,jpeg,png',
                'file_notabensin' => 'nullable|mimes:pdf',
            ]);
        
            // Cari id_sppd berdasarkan no_kwitansi di tabel tr_kwitansi
            $kwitansi = Kwitansi::where('no_kwitansi', $request->no_kwitansi)->first();
        
            if (!$kwitansi) {
                return redirect()->back()->withErrors('No Kwitansi tidak ditemukan.');
            }
        
            // Temukan SPJ jika ada
            $spj = SPJ::where('no_kwitansi', $request->no_kwitansi)->first();
        
            // Upload files ke direktori app/public
            $fileFields = ['file_spt', 'file_spd', 'file_visum', 'file_laporan', 'file_kwitansi', 'file_poto', 'file_notabensin'];
        
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Hapus file lama jika ada
                    if ($spj && $spj->$field) {
                        Storage::delete('public/' . $spj->$field);
                    }
                    // Store file baru
                    $data[$field] = $request->file($field)->store('spj', 'public');
                } elseif ($spj) {
                    // Jika tidak ada file baru, gunakan file yang sudah ada
                    $data[$field] = $spj->$field;
                }
            }
        
            // Simpan data ke tabel spj
            SPJ::updateOrCreate(
                ['no_kwitansi' => $request->no_kwitansi],  // Use no_kwitansi to find the record
                array_merge($data, ['id_sppd' => $kwitansi->id_sppd]) // Merge file data with id_sppd
            );            
        
            // Redirect ke route dengan parameter no_kwitansi
            return redirect()->route('riwayat.inputspj', ['no_kwitansi' => $request->no_kwitansi])
                             ->with('success', 'Data SPJ berhasil disimpan.');
        }
    
        public function updateSPJ(Request $request, $no_kwitansi)
        {
            // Validasi input file jika ada perubahan
            $request->validate([
                'file_spt' => 'mimes:pdf',
                'file_spd' => 'mimes:pdf',
                'file_visum' => 'mimes:pdf',
                'file_laporan' => 'mimes:pdf',
                'file_kwitansi' => 'mimes:pdf',
                'file_poto' => 'mimes:jpg,jpeg,png',
                'file_notabensin' => 'mimes:pdf',
            ]);
        
            // Temukan SPJ berdasarkan no_kwitansi
            $spj = SPJ::where('no_kwitansi', $no_kwitansi)->first();
        
            if (!$spj) {
                return redirect()->back()->withErrors('Data SPJ tidak ditemukan.');
            }
        
            // Update files jika ada file yang diupload baru
            if ($request->file('file_spt')) {
                Storage::delete('public/' . $spj->file_spt); // Hapus file lama
                $spj->file_spt = $request->file('file_spt')->store('spj', 'public');
            }
        
            if ($request->file('file_spd')) {
                Storage::delete('public/' . $spj->file_spd);
                $spj->file_spd = $request->file('file_spd')->store('spj', 'public');
            }
        
            if ($request->file('file_visum')) {
                Storage::delete('public/' . $spj->file_visum);
                $spj->file_visum = $request->file('file_visum')->store('spj', 'public');
            }
        
            if ($request->file('file_laporan')) {
                Storage::delete('public/' . $spj->file_laporan);
                $spj->file_laporan = $request->file('file_laporan')->store('spj', 'public');
            }
        
            if ($request->file('file_kwitansi')) {
                Storage::delete('public/' . $spj->file_kwitansi);
                $spj->file_kwitansi = $request->file('file_kwitansi')->store('spj', 'public');
            }
        
            if ($request->file('file_poto')) {
                Storage::delete('public/' . $spj->file_poto);
                $spj->file_poto = $request->file('file_poto')->store('spj', 'public');
            }
        
            if ($request->file('file_notabensin')) {
                Storage::delete('public/' . $spj->file_notabensin);
                $spj->file_notabensin = $request->file('file_notabensin')->store('spj', 'public');
            }
        
            $spj->save(); // Simpan perubahan
        
            return redirect()->route('riwayat.inputspj', ['no_kwitansi' => $spj->no_kwitansi])
                            ->with('success', 'File SPJ berhasil diperbarui.');
        }        

        public function detailprofile(){
            return view('profile.detailprofile');
        }

        // public function dataUser()
        // {
        //     $users = User::all(); // Ambil semua data user
        //     return view('superadmin.datauser', compact('users')); // Kirim data ke view
        // }        

        // public function datatimkerja() 
        // {
        //     // Mengambil semua data dari tabel tim_kerja
        //     $timkerja = TimKerja::all();
            
        //     // Mengirim data ke view
        //     return view('superadmin.datatimkerja', compact('timkerja'));
        // }

        // public function datapegawai()
        // {
        //     // Ambil semua data dari tabel karyawan
        //     $karyawans = Karyawan::all();

        //     // Kirim data ke view
        //     return view('superadmin.datapegawai', compact('karyawans'));
        // }

        // public function datakantor() 
        // {
        //     // Mengambil semua data kantor dari tabel kantor
        //     $kantor = Kantor::all();
            
        //     // Mengirim data ke view
        //     return view('superadmin.datakantor', compact('kantor'));
        // }

        // public function create()
        // {
        //     $timKerja = TimKerja::all(); // Ambil semua data tim kerja
        //     $roles = Role::all(); // Ambil semua data role
        //     return view('addtimkerja', compact('timKerja', 'roles'));
        // }

        // public function storeTimKerja(Request $request)
        // {
        //     // Validasi input
        //     $request->validate([
        //         'nama_tim' => 'required|string|max:255',
        //         'anggaran' => 'required|numeric',
        //         'sisa_anggaran' => 'required|numeric',
        //         'tahun' => 'required|numeric|min:4',
        //     ]);

        //     // Simpan data ke tabel tim_kerja
        //     TimKerja::create([
        //         'nama_tim' => $request->nama_tim,
        //         'anggaran_awal' => $request->anggaran,
        //         'sisa_anggaran' => $request->sisa_anggaran,
        //         'tahun_anggaran' => $request->tahun,
        //     ]);

        //     return redirect()->route('superadmin.datatimkerja')->with('success', 'Data Tim Kerja berhasil ditambahkan!');
        // }
        
        // public function storeKantor(Request $request)
        // {
        //     // Validasi input
        //     $request->validate([
        //         'nama_kantor' => 'required|string|max:255',
        //         'alamat' => 'required|string|max:255',
        //         'uang_harian' => 'required|numeric',
        //         'transport' => 'required|numeric',
        //         'akomodasi' => 'required|numeric',
        //     ]);

        //     // Simpan data ke tabel kantor
        //     Kantor::create([
        //         'nama_kantor' => $request->nama_kantor,
        //         'alamat_kantor' => $request->alamat,
        //         'uang_harian' => $request->uang_harian,
        //         'transport' => $request->transport,
        //         'akomodasi' => $request->akomodasi,
        //     ]);

        //     // Redirect ke halaman data kantor dengan pesan sukses
        //     return redirect()->route('superadmin.datakantor')->with('success', 'Data Kantor berhasil ditambahkan!');
        // }

        // public function storePegawai(Request $request)
        // {
        //     // Validasi input dari form
        //     $request->validate([
        //         'nip' => 'required|string|max:100',
        //         'nama' => 'required|string|max:255',
        //         'golongan' => 'required|string|max:255',
        //         'jabatan' => 'required|string|max:255',
        //     ]);

        //     Karyawan::create([
        //         'nip' => $request->nip,
        //         'nama_staff' => $request->nama,
        //         'golongan' => $request->golongan,
        //         'jabatan' => $request->jabatan,
        //     ]);

        //     return redirect()->route('superadmin.datapegawai')->with('success', 'Data Pegawai berhasil ditambahkan!');
        // }

        // public function editPegawai($id)
        // {
        //     // Cari pegawai berdasarkan ID (id_staff)
        //     $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();

        //     // Kirim data pegawai ke view editdatapegawai
        //     return view('superadmin.editdatapegawai', compact('pegawai'));
        // }

        // public function updatePegawai(Request $request, $id)
        // {
        //     // Validasi input
        //     $request->validate([
        //         'nip' => 'required|string|max:255',
        //         'nama' => 'required|string|max:255',
        //         'golongan' => 'required|string|max:255',
        //         'jabatan' => 'required|string|max:255',
        //     ]);

        //     // Temukan pegawai berdasarkan ID (id_staff) dan update datanya
        //     $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();
        //     $pegawai->update([
        //         'nip' => $request->nip,
        //         'nama_staff' => $request->nama,
        //         'golongan' => $request->golongan,
        //         'jabatan' => $request->jabatan,
        //     ]);

        //     // Redirect kembali ke halaman data pegawai dengan pesan sukses
        //     return redirect()->route('superadmin.datapegawai')->with('success', 'Data Pegawai berhasil diperbarui!');
        // }

        // public function deletePegawai($id)
        // {
        //     // Temukan pegawai berdasarkan ID dan hapus datanya
        //     $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();
        //     $pegawai->delete();

        //     // Redirect kembali ke halaman data pegawai dengan pesan sukses
        //     return redirect()->route('superadmin.datapegawai')->with('success', 'Data Pegawai berhasil dihapus!');
        // }

        // public function editdatatimkerja($id)
        // {
        //     $timkerja = TimKerja::findOrFail($id); // Mengambil data berdasarkan ID
        //     return view('superadmin.editdatatimkerja', compact('timkerja'));
        // }

        // public function updateTimKerja(Request $request, $id)
        // {
        //     // Validasi input
        //     $request->validate([
        //         'nama_tim' => 'required|string|max:255',
        //         'anggaran_awal' => 'required|numeric',
        //         'sisa_anggaran' => 'required|numeric',
        //         'tahun_anggaran' => 'required|numeric',
        //     ]);

        //     // Temukan tim kerja berdasarkan ID dan perbarui datanya
        //     $timkerja = TimKerja::findOrFail($id);
        //     $timkerja->update([
        //         'nama_tim' => $request->nama_tim,
        //         'anggaran_awal' => $request->anggaran_awal,
        //         'sisa_anggaran' => $request->sisa_anggaran,
        //         'tahun_anggaran' => $request->tahun_anggaran,
        //     ]);

        //     return redirect()->route('superadmin.datatimkerja')->with('success', 'Data Tim Kerja berhasil diperbarui!');
        // }

        // public function deletetimkerja($id)
        // {
        //     $tim = TimKerja::find($id);
        //     if ($tim) {
        //         $tim->delete();
        //         return redirect()->route('superadmin.datatimkerja')->with('success', 'Data tim kerja berhasil dihapus.');
        //     }
        //     return redirect()->route('superadmin.datatimkerja')->with('error', 'Data tim kerja tidak ditemukan.');
        // }

        // public function editdatakantor($id)
        // {
        //     $kantor = Kantor::findOrFail($id);
        //     return view('superadmin.editdatakantor', compact('kantor'));
        // }

        // public function updatekantor(Request $request, $id)
        // {
        //     $request->validate([
        //         'nama_kantor' => 'required|string|max:255',
        //         'alamat_kantor' => 'required|string|max:255',
        //         'uang_harian' => 'required|numeric',
        //         'transport' => 'required|numeric',
        //         'akomodasi' => 'required|numeric',
        //     ]);

        //     $kantor = Kantor::findOrFail($id);
        //     $kantor->update($request->all());

        //     return redirect()->route('superadmin.datakantor')->with('success', 'Data kantor berhasil diperbarui.');
        // }

        // public function deletekantor($id)
        // {
        //     $kantor = Kantor::findOrFail($id);
        //     $kantor->delete();

        //     return redirect()->route('superadmin.datakantor')->with('success', 'Data kantor berhasil dihapus.');
        // }

        // public function addDataUser()
        // {
        //     $tim_kerja = TimKerja::all();
        //     $roles = Role::all();
            
        //     return view('superadmin.adddatauser', compact('tim_kerja', 'roles')); // Send data to the view
        // }

        // public function storeuserdata(Request $request)
        // {
        //     $user = User::create([
        //         'email' => $request->email,
        //         'username' => $request->username,
        //         'password' => Hash::make($request->password),
        //         'nama_role' => $request->nama_role,
        //         'nama_tim' => $request->nama_tim,
        //         'active' => 1
        //     ]);
        //     Session::flash('message', 'Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        
        //     $users = User::all();
        
        //     return view('superadmin.datauser', compact('users'));
        // }                  

        // public function editdataUser($id_user)
        // {
        //     $user = User::findOrFail($id_user); // Temukan user berdasarkan id
        //     $tim_kerja = TimKerja::all(); // Mengambil semua data tim kerja
        //     $roles = Role::all(); // Mengambil semua data role
        //     return view('superadmin.editdatauser', compact('user', 'tim_kerja', 'roles')); // Kirim data user ke view
        // }
        
        // public function updateDataUser(Request $request, $id_user)
        // {
        //     $request->validate([
        //         'username' => 'required',
        //         'nama_tim' => 'required',
        //         'nama_role' => 'required',
        //         // Jangan mewajibkan password diisi
        //     ]);
        
        //     $user = User::findOrFail($id_user);
            
        //     // Update data user
        //     $user->username = $request->username;
        //     $user->nama_tim = $request->nama_tim;
        //     $user->nama_role = $request->nama_role;
        
        //     // Jika password diisi, lakukan hashing
        //     if ($request->password) {
        //         $user->password = Hash::make($request->password);
        //     }
        
        //     $user->save();
        
        //     return redirect()->route('superadmin.datauser')->with('success', 'User updated successfully.');
        // }

        // public function deleteUser($id_user)
        // {
        //     $user = User::findOrFail($id_user);
        //     $user->delete();
        
        //     return redirect()->route('superadmin.datauser')->with('success', 'User deleted successfully.');
        // }        

    }