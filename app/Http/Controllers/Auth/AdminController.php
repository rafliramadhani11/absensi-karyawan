<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hadir;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $users = User::where('admin', '!=', 1)->latest()->paginate(10);

        return view('auth.admin.index', compact('admin', 'users'));
    }

    public function profile()
    {
        $admin = auth()->user();
        return view('auth.admin.profile', compact('admin'));
    }

    public function ubahNama(Request $request)
    {
        $validated = $request->validate([
            'name' => 'min:3|max:100|string',
            'email' => 'min:12|max:50|email'
        ]);
        User::updateOrCreate(
            ['admin' => 1],
            ['name' => $validated['name'], 'email' => $validated['email']]
        );
        return redirect()->back()->with('nameUpdated', 'Berhasil merubah data');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required', 'min:3',
            'password' => ['required', 'string', 'confirmed', 'min:3']
        ]);

        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with('passwordUpdated', 'Password berhasil diubah.');
        } else {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }
    }



    public function absensi()
    {
        $admin = auth()->user();
        $date = Carbon::now();
        $hadirs = Hadir::with('user')->latest()->paginate(10);

        return view('auth.admin.absensi', compact('admin', 'hadirs', 'date'));
    }

    public function qrCode()
    {
        $admin = auth()->user();
        $date = Carbon::now();
        $users = User::where('admin', '!=', 1)->get();

        foreach ($users as $user) {
            $jwt_payload = [
                'nik' => $user->nik,
                'timeNow' => Carbon::parse($date)->translatedFormat('H:i:s'),
                'dateNow' => Carbon::parse($date)->translatedFormat('l, j F Y')
            ];
            $jwt = JWT::encode($jwt_payload, 'secretKey', 'HS256');
            $user->qr_code_jwt = $jwt;
        }
        return view('auth.admin.qrCode', compact('admin', 'date', 'users'));
    }

    public function userAbsensi(User $user)
    {
        $admin = auth()->user();
        $hadirs = Hadir::where('user_id', $user->id)->get();

        $monthsData = $hadirs->groupBy(function ($hadir) {
            return Carbon::parse($hadir->date)->format('F');
        })->map(function ($group) {
            $month = Carbon::parse($group->first()->date)->format('F');
            $totalDays = Carbon::parse($group->first()->date)->daysInMonth;
            $countHadir = $group->filter(function ($hadir) {
                return $hadir->status == 'Hadir';
            })->count();
            $countIzin = $group->filter(function ($hadir) {
                return $hadir->status == 'Izin';
            })->count();
            $countAlfa = $group->filter(function ($hadir) {
                return $hadir->status == 'Alfa';
            })->count();

            $totalMasuk = $countHadir;
            return [
                'month' => $month,
                'totalDays' => $totalDays,
                'countHadir' => $countHadir,
                'countIzin' => $countIzin,
                'countAlfa' => $countAlfa,
                'totalMasuk' => $totalMasuk,
            ];
        });

        return view('auth.admin.userAbsensi', compact('admin', 'user', 'monthsData'));
    }

    public function detailAbsensi(Hadir $hadir)
    {

        $admin = auth()->user();

        return view('auth.admin.detailAbsensi', compact('admin',  'hadir'));
    }

    public function hadir(Request $request)
    {
        return redirect()->back();
    }

    public function addKomentar(Request $request, Hadir $hadir)
    {
        Hadir::updateOrCreate(
            [
                'id' => $hadir->id,
                'date' => $hadir->date,
            ],
            [
                'komen' => $request->komen,
            ]
        );
        return redirect()->back()->with('komentarAdded', 'Komentar akan muncul di data kehadiran karyawan sebagai feedback');
    }

    public function ubahAbsen(Request $request, Hadir $hadir)
    {

        Hadir::updateOrCreate(
            ['id' => $hadir->id, 'date' => $hadir->date],
            ['waktu_datang' => $request->waktu_datang, 'waktu_pulang' => $request->waktu_pulang, 'status' => $request->status]
        );
        return redirect()->route('admin.user.absensi')->with('updateAbsenPegawai', 'Kamu baru saja memperbarui kehadiran pegawai');
    }

    public function add()
    {
        $admin = auth()->user();
        return view('auth.admin.add', compact('admin'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['name'] = ucwords($validated['name']);
        $validated['alamat'] = ucwords($validated['alamat']);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.index')->with('addPegawai', 'Kamu berhasil menambah data pegawai baru !');
    }

    public function show(User $user)
    {
        $admin = auth()->user();
        return view('auth.admin.show', compact('admin', 'user'));
    }

    public function edit(User $user)
    {
        $admin = auth()->user();

        return view('auth.admin.edit', compact('user', 'admin'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $validatedData = $request->validated();

        $validatedData['name'] = ucwords($validatedData['name']);
        $validatedData['alamat'] = ucwords($validatedData['alamat']);
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $userData = User::findOrFail($user->id);

        $changes = array_diff_assoc($validatedData, $userData->toArray());

        if (!empty($changes)) {
            $userData->update($validatedData);
            $userSlug = $validatedData['slug'];

            return redirect()->route('admin.show.user', $userSlug)
                ->with('updatePegawai', 'Kamu baru saja memperbarui data pegawai');
        }

        return redirect()->route('admin.show.user', $user->slug);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('hapusPegawai', 'Kamu berhasil menghapus data & kehadiran Pegawai');
    }
}
