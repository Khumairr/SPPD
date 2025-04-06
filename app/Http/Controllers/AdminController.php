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

class AdminController extends Controller
{
    public function dataUser()
    {
        $users = User::all(); // Ambil semua data user
        return view('adminutama.datauser', compact('users')); // Kirim data ke view
    }

    public function addDataUser()
    {
        $tim_kerja = TimKerja::all();
        $roles = Role::all();
        
        return view('adminutama.adddatauser', compact('tim_kerja', 'roles')); // Send data to the view
    }

    public function tambahdatauser(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_role' => $request->nama_role,
            'nama_tim' => $request->nama_tim,
            'active' => 1
        ]);
    
        $users = User::all();
    
        return view('adminutama.datauser', compact('users'));
    }

    public function ubahdataUser($id_user)
    {
        $user = User::findOrFail($id_user); // Temukan user berdasarkan id
        $tim_kerja = TimKerja::all(); // Mengambil semua data tim kerja
        $roles = Role::all(); // Mengambil semua data role
        return view('adminutama.ubahdatauser', compact('user', 'tim_kerja', 'roles')); // Kirim data user ke view
    }
    
    public function updatedatauser(Request $request, $id_user)
    {
        $request->validate([
            'username' => 'required',
            'nama_tim' => 'required',
            'nama_role' => 'required',
            // Jangan mewajibkan password diisi
        ]);
    
        $user = User::findOrFail($id_user);
        
        // Update data user
        $user->username = $request->username;
        $user->nama_tim = $request->nama_tim;
        $user->nama_role = $request->nama_role;
    
        // Jika password diisi, lakukan hashing
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('adminutama.datauser')->with('success', 'User updated successfully.');
    }

    public function hapusdatauser($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();
    
        return redirect()->route('adminutama.datauser')->with('success', 'User deleted successfully.');
    }

    public function datapegawai()
    {
        // Ambil semua data dari tabel karyawan
        $karyawans = Karyawan::all();

        // Kirim data ke view
        return view('adminutama.datapegawai', compact('karyawans'));
    }

    public function tambahPegawai(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nip' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        Karyawan::create([
            'nip' => $request->nip,
            'nama_staff' => $request->nama,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('adminutama.datapegawai')->with('success', 'Data Pegawai berhasil ditambahkan!');
    }

    public function ubahPegawai(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        // Temukan pegawai berdasarkan ID (id_staff) dan update datanya
        $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();
        $pegawai->update([
            'nip' => $request->nip,
            'nama_staff' => $request->nama,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
        ]);

        // Redirect kembali ke halaman data pegawai dengan pesan sukses
        return redirect()->route('adminutama.datapegawai')->with('success', 'Data Pegawai berhasil diperbarui!');
    }

    public function hapusPegawai($id)
    {
        // Temukan pegawai berdasarkan ID dan hapus datanya
        $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();
        $pegawai->delete();

        // Redirect kembali ke halaman data pegawai dengan pesan sukses
        return redirect()->route('adminutama.datapegawai')->with('success', 'Data Pegawai berhasil dihapus!');
    }

    public function datatimkerja() 
    {
        // Mengambil semua data dari tabel tim_kerja
        $timkerja = TimKerja::all();
        
        // Mengirim data ke view
        return view('adminutama.datatimkerja', compact('timkerja'));
    }
    
    public function tambahTimKerja(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'anggaran' => 'required|numeric',
            'sisa_anggaran' => 'required|numeric',
            'tahun' => 'required|numeric|min:4',
        ]);

        // Simpan data ke tabel tim_kerja
        TimKerja::create([
            'nama_tim' => $request->nama_tim,
            'anggaran_awal' => $request->anggaran,
            'sisa_anggaran' => $request->sisa_anggaran,
            'tahun_anggaran' => $request->tahun,
        ]);

        return redirect()->route('adminutama.datatimkerja')->with('success', 'Data Tim Kerja berhasil ditambahkan!');
    }

    public function ubahdatatimkerja($id)
    {
        $timkerja = TimKerja::findOrFail($id); // Mengambil data berdasarkan ID
        return view('adminutama.ubahdatatimkerja', compact('timkerja'));
    }

    public function ubahTimKerja(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'anggaran_awal' => 'required|numeric',
            'sisa_anggaran' => 'required|numeric',
            'tahun_anggaran' => 'required|numeric',
        ]);

        // Temukan tim kerja berdasarkan ID dan perbarui datanya
        $timkerja = TimKerja::findOrFail($id);
        $timkerja->update([
            'nama_tim' => $request->nama_tim,
            'anggaran_awal' => $request->anggaran_awal,
            'sisa_anggaran' => $request->sisa_anggaran,
            'tahun_anggaran' => $request->tahun_anggaran,
        ]);

        return redirect()->route('adminutama.datatimkerja')->with('success', 'Data Tim Kerja berhasil diperbarui!');
    }

    public function hapustimkerja($id)
    {
        $tim = TimKerja::find($id);
        if ($tim) {
            $tim->delete();
            return redirect()->route('adminutama.datatimkerja')->with('success', 'Data tim kerja berhasil dihapus.');
        }
        return redirect()->route('adminutama.datatimkerja')->with('error', 'Data tim kerja tidak ditemukan.');
    }

    public function datakantor() 
    {
        // Mengambil semua data kantor dari tabel kantor
        $kantor = Kantor::all();
        
        // Mengirim data ke view
        return view('adminutama.datakantor', compact('kantor'));
    }

    public function tambahKantor(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'uang_harian' => 'required|numeric',
            'transport' => 'required|numeric',
            'akomodasi' => 'required|numeric',
        ]);

        // Simpan data ke tabel kantor
        Kantor::create([
            'nama_kantor' => $request->nama_kantor,
            'alamat_kantor' => $request->alamat,
            'uang_harian' => $request->uang_harian,
            'transport' => $request->transport,
            'akomodasi' => $request->akomodasi,
        ]);

        // Redirect ke halaman data kantor dengan pesan sukses
        return redirect()->route('adminutama.datakantor')->with('success', 'Data Kantor berhasil ditambahkan!');
    }

    public function ubahdatakantor($id)
    {
        $kantor = Kantor::findOrFail($id);
        return view('adminutama.ubahdatakantor', compact('kantor'));
    }

    public function ubahkantor(Request $request, $id)
    {
        $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat_kantor' => 'required|string|max:255',
            'uang_harian' => 'required|numeric',
            'transport' => 'required|numeric',
            'akomodasi' => 'required|numeric',
        ]);

        $kantor = Kantor::findOrFail($id);
        $kantor->update($request->all());

        return redirect()->route('adminutama.datakantor')->with('success', 'Data kantor berhasil diperbarui.');
    }

    public function hapuskantor($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->delete();

        return redirect()->route('adminutama.datakantor')->with('success', 'Data kantor berhasil dihapus.');
    }

    public function ubahdatapegawai($id)
    {
        // Cari pegawai berdasarkan ID (id_staff)
        $pegawai = Karyawan::where('id_staff', $id)->firstOrFail();

        // Kirim data pegawai ke view editdatapegawai
        return view('adminutama.ubahdatapegawai', compact('pegawai'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session dan redirect ke halaman login
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
