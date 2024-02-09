<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Validation\ValidationException;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class UserController extends Controller
{
    //
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = config('mail.mail_host');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = config('mail.mail_username');
        $this->mail->Password = config('mail.mail_password');
        $this->mail->SMTPSecure = config('mail.mail_encryption');
        $this->mail->Port = config('mail.mail_port');
    }
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

            // Generate OTP
            $otp = mt_rand(100000, 999999);

            // Save OTP to the database (You might want to create an OTPs table for this purpose)
            // For demonstration purposes, I'm assuming a 'otp' column in the 'users' table.
            $validatedData['otp'] = $otp;

            // Create a new user
            $user = User::create($validatedData);

            // Send email with OTP
            $this->sendOtpEmail($user->email, $otp);

           // return response()->json(['user' => $user], 201);

           // Modify the response
            return response()->json([
                'message' => 'User registered successfully. Please check your email for the OTP.',
                'email_prompt' => 'A confirmation email has been sent to your email address. Please verify your email by clicking the link provided in the email.',
                'mock_email' => 'Check your email inbox for the OTP.',
            ], 201);
            
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


    // GEL All Users
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);
    }

    //LOGIN

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    private function sendOtpEmail($email, $otp)
    {
        // Email Configuration
        $this->mail->setFrom(config('mail.mail_from_address'), config('mail.mail_from_name'));
        $this->mail->addAddress($email);
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Email Verification OTP';
        $this->mail->Body = "Your OTP for email verification is: $otp. This OTP is valid for 15 minutes.";

        // Send the email
        if (!$this->mail->send()) {
            // Handle email sending failure
            return false;
        }

        // Save the OTP to the user record in the database
        // Assuming you have an 'otp' column in the 'users' table
        User::where('email', $email)->update(['otp' => $otp]);

        return true;
    }

    public function sendPasswordResetLink(Request $request)
        {
            $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Generate a unique token
        $token = Str::random(60);

        // Store the token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        // Send the password reset link to the user's email
        $resetLink = url("/api/v1.0/chowhubs/reset-password/$token");
        Mail::to($user->email)->send(new ResetPasswordEmail($resetLink));

        return response()->json(['message' => 'Password reset link sent to your email'], 200);
    }

}
