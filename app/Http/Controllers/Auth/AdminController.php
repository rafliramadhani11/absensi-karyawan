<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hadir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $users = User::where('admin', '!=', 1)->latest()->paginate(10);

        return view('auth.admin.index', compact('admin', 'users'));
    }

    public function absensi()
    {
        $admin = auth()->user();
        $date = Carbon::now()->format('Y-m-d');

        $hadirs = DB::table('hadirs')
            ->join('users', 'hadirs.user_id', '=', 'users.id')
            ->whereDate('hadirs.date', $date)
            ->select('hadirs.*', 'users.name as user_name')
            ->orderBy('hadirs.created_at', 'desc')
            ->latest()->paginate(10);
        return view('auth.admin.absensi', compact('admin', 'hadirs', 'date'));
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

    public function detailAbsensi(User $user)
    {
        $admin = auth()->user();

        $date = Carbon::now()->format('Y-m-d');
        $hadir = Hadir::where('user_id', $user->id)
            ->whereDate('date', $date)
            ->first();

        return view('auth.admin.detailAbsensi', compact('admin', 'user', 'hadir'));
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
        return redirect()->back();
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
        do {
            $validated['kode'] = 'P' . rand(0, 9999);
        } while (User::where('kode', $validated['kode'])->exists());

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

        $user->update($validatedData);
        return redirect()->route('admin.show.user', $user->slug)->with('updatePegawai', 'Kamu baru saja memperbarui data pegawai');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('hapusPegawai', 'Kamu berhasil menghapus data & kehadiran Pegawai');
    }
}
