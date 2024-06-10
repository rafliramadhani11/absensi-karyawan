<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Hadir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function kehadiran()
    {
        $user = auth()->user();
        $hadirs = Hadir::where('user_id', $user->id)->latest()->paginate(10);

        $date = Carbon::now();

        $startTime = $date->copy()->setTime(9, 0, 0);
        $endTime = $date->copy()->setTime(17, 0, 0);
        $totalHours = $startTime->diffInHours($endTime);

        $hadir = Hadir::where('user_id', $user->id)->latest()->first();
        $showFormHadir = false;
        $showFormPulang = false;
        $showAlreadyhadirMessage = false;
        $showIzinMessage = false;
        $showAlfaMessage = false;

        if (empty($hadir) || Carbon::parse($hadir->date)->format('Y-m-d') !== $date->format('Y-m-d')) {
            $showFormHadir = true;
        } else {
            if ($hadir->status == 'Izin') {
                $showIzinMessage = true;
            } elseif ($hadir->status == 'Alfa') {
                $showAlfaMessage = true;
            } elseif (empty($hadir->waktu_datang)) {
                $showFormHadir = true;
            } elseif (empty($hadir->waktu_pulang)) {
                $showFormPulang = true;
            } else {
                $showAlreadyhadirMessage = true;
            }
        }
        return view('auth.user.kehadiran', compact('hadir', 'date', 'showFormHadir', 'showFormPulang', 'showAlreadyhadirMessage', 'user', 'hadirs', 'startTime', 'endTime', 'showIzinMessage', 'showAlfaMessage'));
    }

    public function izin()
    {
        $user = auth()->user();
        $date = Carbon::now();

        return view('auth.user.izin', compact('user', 'date'));
    }

    public function izinAction(Request $request)
    {
        $user = auth()->user();
        $date = Carbon::now()->format('Y-m-d');
        $alasan = $request->alasan;

        Hadir::updateOrCreate(
            ['user_id' => $user->id, 'date' => $date,],
            [
                'user_id' => $user->id, 'date' => $date, 'status' => 'Izin', 'alasan' => $alasan
            ]
        );
        return redirect()->route('user.kehadiran');
    }
    public function hadir()
    {
        $user = Auth::user();
        $date = Carbon::now()->format('Y-m-d');
        $waktuDatang = Carbon::now()->format('H:i:s');;
        Hadir::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $date,
            ],
            [
                'user_id' => $user->id,
                'date' => $date,
                'waktu_datang' => $waktuDatang,
                'status' => 'Hadir'
            ]
        );


        return redirect()->route('user.kehadiran');
    }

    public function pulang()
    {
        $user = auth()->user();
        $date = Carbon::now()->format('Y-m-d');
        $waktu_pulang = Carbon::now()->format('H:i:s');
        Hadir::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $date,
            ],
            [
                'user_id' => $user->id,
                'waktu_pulang' => $waktu_pulang,
            ]
        );
        return redirect()->route('user.kehadiran');
    }

    public function pemantauanGaji()
    {
        $user = Auth::user();
        $hadirs = Hadir::where('user_id', $user->id)
            ->get()
            ->groupBy(function ($hadir) {
                return Carbon::parse($hadir->date)->format('F');
            })
            ->map(function ($group) {
                $statusCounts = $group->pluck('status')->countBy();
                $alfaIzinCount = $statusCounts->only(['Alfa', 'Izin'])->sum();

                $totalJamLembur = 0;
                foreach ($group as $hadir) {
                    $waktuPulangCarbon = Carbon::parse($hadir->waktu_pulang);
                    if ($waktuPulangCarbon->greaterThanOrEqualTo($waktuPulangCarbon->copy()->hour(17))) {
                        $totalJamLembur += abs(intval($waktuPulangCarbon->diffInHours($waktuPulangCarbon->copy()->hour(17))));
                    }
                }

                $totalIzin = $group->pluck('status')->filter(function ($status) {
                    return $status === 'Izin';
                })->count();
                $totalAlfa = $group->pluck('status')->filter(function ($status) {
                    return $status === 'Alfa';
                })->count();

                $potonganIzin = $totalIzin * 100000;
                $potonganAlfa = $totalAlfa * 200000;
                $gajiPokok =  $group->count() * 120000;
                $bayaranLembur =  $totalJamLembur  * 25000;
                $potongan =  $potonganIzin +  $potonganAlfa;

                return [
                    'totalData' => $group->count(),
                    'totalAlfa' => $totalAlfa,
                    'totalIzin' =>  $totalIzin,
                    'alfaIzinCount' => $alfaIzinCount,
                    'totalJamLembur' => $totalJamLembur,

                    'gajiPokok' => $gajiPokok,
                    'bayaranLembur' => $bayaranLembur,
                    'potongan' =>  $potongan,
                    'totalGaji' => $gajiPokok + $bayaranLembur - $potongan
                ];
            });

        return view('auth.user.gaji', compact('user', 'hadirs'));
    }

    public function absensi()
    {
        $user = Auth::user();
        $hadirs = Hadir::where('user_id', $user->id)->get();

        $monthsData = $hadirs->groupBy(function ($hadir) {
            return Carbon::parse($hadir->date)->format('Y-m');
        })->map(function ($group) {
            $month = Carbon::parse($group->first()->date)->format('F Y');
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
                'yearMonth' => Carbon::parse($group->first()->date)->format('Y-m'),
                'month' => $month,
                'totalDays' => $totalDays,
                'countHadir' => $countHadir,
                'countIzin' => $countIzin,
                'countAlfa' => $countAlfa,
                'totalMasuk' => $totalMasuk,
            ];
        });

        return view('auth.user.absensi', compact('user', 'monthsData'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('auth.user.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('auth.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'tanggalLahir' => ['required', 'date'],
            'jeniskelamin' => ['required', Rule::in(['Laki - Laki', 'Perempuan'])],
            'jabatan' => [
                'required', Rule::in([
                    'Direktur Utama',
                    'Manajer Proyek',
                    'Pengawas Lapangan',
                    'Kepala Gudang',
                    'Finance',
                    'Purchasing',
                    'Supervisor',
                ]),
            ],
            'alamat' => 'required|string|max:255',
        ]);

        $user->update($validatedData);

        return redirect()->route('user.profile')->with('updatedProfile', 'Kamu baru saja berhasil merubah data profile');
    }
}
