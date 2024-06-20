<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function showLogin()
    {
        if (Auth::check())
            return redirect()->route("home.show");

        return view("login");
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("home.show");
        }

        return back()->withErrors([
            "error" => "The provieded credentials do not math our records.",
        ])->onlyInput("email");
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return back();
    }

    public function showRegister()
    {
        if (Auth::check())
            return redirect()->route("home.show");

        return view("register");
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            "name" => ["required"],
            "email" => ["required", "email", "unique:App\Models\User"],
            "password" => ["required", "min:6"],
            "avatar" => [File::image()->max(1024)]
        ]);

        try {
            $user = new User();
            $user->name = $credentials["name"];
            $user->email = $credentials["email"];
            $user->password = $credentials["password"];
            $user->save();
            $user->refresh();

            $this->storeAvatar($request, $user);
        } catch (\Exception $e) {
            return back()->withErrors([
                "error" => $e->getMessage(),
            ])->withInput(["name", "email"]);
        }

        return redirect()->route("login.show")->onlyInput("email");
    }

    private function storeAvatar(Request $request, User $user)
    {
        if ($avatar = $request->file("avatar")) {
            $convertedAvatar = Image::make($avatar)->encode("jpg", 75);
            if(!file_exists(public_path("storage/avatars")))
                mkdir(public_path("storage/avatars"), recursive: true);
            $convertedAvatar->save(public_path("storage/avatars/") . $user->id . ".jpg");
        }
    }

    public function deleteUser(int $userId = null)
    {
        try {
            User::where("id", $userId)->delete();
        } catch (\Exception $e) {
            return back()->withErrors([
                "error" => $e->getMessage(),
            ]);
        }

        return back()->with(["deletionSuccess", true]);
    }
}
