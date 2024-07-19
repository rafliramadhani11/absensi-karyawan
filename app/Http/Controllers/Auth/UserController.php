<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hadir;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Firebase\JWT\Key;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    public function hadir($jwt)
    {
        $user = auth()->user();
        $date = Carbon::now()->format('Y-m-d');
        $jwtDecoded = JWT::decode($jwt, new Key('secretKey', 'HS256'));

        if ($jwtDecoded->nik != $user->nik) {
            return back()->with('absenFailed', 'Gunakan Qr Code yang sesuai !');
        }

        foreach ($user->hadirs as $hadir) {
            if ($hadir->waktu_datang && $hadir->created_at->format('Y-m-d') == $date) {
                return back()->with('failedHadirAgain', 'Anda sudah melakukan kehadiran hari ini, tidak dapat melakukannya lagi.');
            }
        }

        Hadir::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $date,
            ],
            [
                'user_id' => $user->id,
                'date' => $date,
                'waktu_datang' => $jwtDecoded->timeNow,
                'status' => 'Hadir'
            ]
        );
        return redirect()->route('user.kehadiran')->with('succesedAbsen', 'Terimakasih, sudah melakukan absen hari ini, Selamat Pagi !');
    }

    public function pulang($jwt)
    {
        $user = auth()->user();
        $date = Carbon::now()->format('Y-m-d');
        $jwtDecoded = JWT::decode($jwt, new Key('secretKey', 'HS256'));

        if ($jwtDecoded->nik != $user->nik) {
            return back()->with('absenFailed', 'Gunakan Qr Code yang sesuai !');
        }

        foreach ($user->hadirs as $hadir) {
            if ($hadir->waktu_pulang && $hadir->created_at->format('Y-m-d') == $date) {
                return back()->with('failedPulangAgain', 'Anda sudah melakukan Pulang hari ini, tidak dapat melakukan nya lagi');
            }
        }

        Hadir::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $date,
            ],
            [
                'user_id' => $user->id,
                'waktu_pulang' => $jwtDecoded->timeNow,
            ]
        );
        return redirect()->route('user.kehadiran')->with('sucessedPulang', 'Terimakasih sudah melakukan absen pulang, Terimakasih sudah bekerja hari ini !');
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
        $qr = QrCode::generate($user->id);
        return view('auth.user.profile', compact('user', 'qr'));
    }
    public function edit(User $user)
    {
        if (Auth::user()->slug != $user->slug) {
            return redirect()->back();
        }
        return view('auth.user.edit', compact('user'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        $updated = false;
        foreach ($validatedData as $key => $value) {
            if ($user->{$key} != $value) {
                $updated = true;
                break;
            }
        }
        if (!$updated) {
            return redirect()->route('user.profile');
        }

        $user->update($validatedData);
        return redirect()->route('user.profile')->with('updatedProfile', 'Kamu baru saja berhasil merubah data profile');
    }
}
