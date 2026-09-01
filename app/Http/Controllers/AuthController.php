<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // =====================================================
    // REGISTER
    // =====================================================

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'age' => 'required|integer|min:1',
            'role' => 'required'
        ]);

        $prefix = match ($request->role) {
            'medical officer' => 'MO',
            'nurse' => 'NS',
            'operation manager' => 'OM',
            'doctor' => 'DC',
            default => 'ST'
        };

        do {
            $number = rand(100, 999);
            $userID = $prefix . $number;
        } while (
            DB::table('users')
                ->where('userID', $userID)
                ->exists()
        );

        DB::table('users')->insert([
            'userID' => $userID,
            'name' => trim($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'role' => $request->role,
            'must_change_password' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/login')
            ->with('success', 'User created successfully.');
    }

    // =====================================================
    // ADD STAFF
    // =====================================================

    public function storeStaff(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'age' => 'required|integer|min:1',
                'role' => 'required'
            ]);

            $prefix = match ($request->role) {
                'doctor',
                'doctor_haematology',
                'doctor_cardiology' => 'DC',
                'nurse_frontdesk',
                'nurse_haematology',
                'nurse_cardiology' => 'NS',
                'operation manager' => 'OM',
                default => 'ST'
            };

            do {
                $number = rand(100, 999);
                $userID = $prefix . $number;
            } while (
                DB::table('users')
                    ->where('userID', $userID)
                    ->exists()
            );

            $generatedPassword = substr(
                str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789@$!'),
                0,
                10
            );

            DB::table('users')->insert([
                'userID' => $userID,
                'name' => trim($request->name),
                'email' => trim($request->email),
                'password' => Hash::make($generatedPassword),
                'age' => $request->age,
                'role' => $request->role,
                'must_change_password' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $displayRole = match($request->role) {
                'doctor' => 'Doctor (General)',
                'doctor_haematology' => 'Doctor - Haematology',
                'doctor_cardiology' => 'Doctor - Cardiology',
                'nurse_frontdesk' => 'Nurse - Front Desk',
                'nurse_haematology' => 'Nurse - Haematology',
                'nurse_cardiology' => 'Nurse - Cardiology',
                'operation manager' => 'Operation Manager',
                default => ucfirst(str_replace('_',' ',$request->role))
            };

            try {
                Mail::raw(
                    "Welcome to Healthsistant\n\n" .
                    "Your staff account has been created.\n\n" .
                    "User ID: " . $userID . "\n" .
                    "Role: " . $displayRole . "\n" .
                    "Email: " . $request->email . "\n\n" .
                    "Temporary Password: " . $generatedPassword . "\n\n" .
                    "Please login and change your password immediately.",
                    function ($message) use ($request) {
                        $message->to($request->email)
                                ->subject('Healthsistant Staff Account');
                    }
                );
            } catch (\Exception $mailError) {
                return redirect('/dashboard/admin')
                    ->with('error', 'Staff added but email failed: ' . $mailError->getMessage());
            }

            return redirect('/staff/add')
                ->with('success', 'New staff account created successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // =====================================================
    // LOGIN
    // =====================================================

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = trim($request->email);
        $password = $request->password;

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return back()->with('error', 'Debug: Email [' . $email . '] NOT found in Aiven DB');
        }

        if (!Hash::check($password, $user->password)) {
            return back()->with('error', 'Debug: User found (' . $user->userID . '), but Hash::check failed');
        }

        session([
            'userID' => $user->userID,
            'name'   => $user->name,
            'role'   => $user->role
        ]);

        if ((int)$user->must_change_password === 1) {
            return redirect('/change-password');
        }

        $role = strtolower(trim($user->role));

        if ($role === 'operation manager' || $role === 'om') {
            return redirect('/dashboard/admin');
        }

        if (str_contains($role, 'doctor')) {
            return redirect('/dashboard/doctor');
        }

        if ($role === 'nurse_cardiology') {
            return redirect('/dashboard/nurse-cardiology');
        }

        if ($role === 'nurse_haematology') {
            return redirect('/dashboard/nurse-haematology');
        }

        if (str_contains($role, 'nurse')) {
            return redirect('/dashboard/nurse');
        }

        return redirect('/dashboard/admin');
    }

    // =====================================================
    // FIRST TIME LOGIN
    // =====================================================

    public function firstTimeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = trim($request->email);

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $generatedPassword = substr(
            str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789@$!'),
            0,
            10
        );

        DB::table('users')
            ->where('email', $email)
            ->update([
                'password' => Hash::make($generatedPassword),
                'must_change_password' => 1,
                'updated_at' => now()
            ]);

        return back()->with('success', 'Temporary Password: ' . $generatedPassword);
    }

    // =====================================================
    // CHANGE PASSWORD
    // =====================================================

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ]
        ]);

        DB::table('users')
            ->where('userID', session('userID'))
            ->update([
                'password' => Hash::make($request->password),
                'must_change_password' => 0,
                'updated_at' => now()
            ]);

        return redirect('/dashboard')
            ->with('success', 'Password updated successfully!');
    }

    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}