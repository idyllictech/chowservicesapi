<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class UserController extends Controller
{
    //
    public function register(Request $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // Check for empty fields
        if (empty($validatedData['full_name']) || empty($validatedData['email']) || empty($validatedData['password'])) {
            return response()->json(['error' => 'Full name, email, and password are required.'], 400);
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        return response()->json(['user' => $user], 201);
    } catch (ValidationException $e) {
        // Handle validation errors, check if it's a unique constraint violation
        $errors = $e->errors();
        if (isset($errors['email']) && $errors['email'][0] === 'The email has already been taken.') {
            return response()->json(['error' => 'Email address already exists.'], 400);
        }

        // If it's not a unique constraint violation, you can handle other validation errors here
        return response()->json(['error' => 'Validation failed.'], 400);
    }
}

    public function testRegister(Request $request)
{
    // Simulate a registration request
    $requestData = [
        'full_name' => 'Yinka OKEGBEMI',
        'email' => 'idigits.solutions@gmail.com',
        'password' => 'securepassword',
        'address' => '123 Main St',
        'phone' => '1234567890',
    ];

    // Send the registration request to the actual register method
    $response = $this->register(new Request($requestData));

    // Return the response from the actual register method
    return $response;
}

}
