<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'], // Validate the phone field
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone, // Include phone value
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create the user's inventory
        $inventory = Inventory::create([
            'user_id' => $user->id,
        ]);

        // Free product logic
        $freeProductId = 15;

        InventoryItem::create([
            'inventory_id' => $inventory->id,
            'product_id' => $freeProductId,
        ]);

        event(new Registered($user));

        Auth::login($user);
        Log::info('Register was succesfull');

        return redirect(route('product.index', absolute: false));
    }
}
