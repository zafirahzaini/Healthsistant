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

        // DEBUG 1: Check if user exists in database
        if (!$user) {
            return back()->with('error', 'Debug: User email [' . $email . '] was NOT found in the database.');
        }

        // DEBUG 2: Check if password hash matches
        if (!Hash::check($password, $user->password)) {
            return back()->with('error', 'Debug: Email found (' . $user->userID . '), but Hash::check failed for password.');
        }

        // ================= LOGIN SUCCESS =================
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