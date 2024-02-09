<!-- resources/views/api-docs.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>FoodHubs API Documentation</h1>

        <h2>Endpoints:</h2>

        <ul>
            <li class="text-info"><strong>GET /api/v1.0/chowhubs/services</strong>: Retrieve a list of services.</li>
            <li class="text-success"><strong>POST /api/v1.0/chowhubs/register</strong>: Register a new user. Parameters: full_name, email, password, address (optional), phone (optional).</li>
            <li class="text-success"><strong>POST /api/v1.0/chowhubs/login</strong>: User login. Parameters: email, password.</li>
            <li class="text-success"><strong>POST /api/v1.0/chowhubs/forgot-password</strong>: Request a password reset. Parameters: email.</li>
            <!-- Add more endpoints as needed -->
        </ul>

        <h2>Authentication:</h2>

        <p>For protected endpoints, include the user's token in the Authorization header.</p>

        <h2>Examples:</h2>

        <p class="text-success"><strong>User Registration:</strong></p>
        <pre>
            <code>
                POST /api/v1.0/chowhubs/register

                {
                    "full_name": "John Doe",
                    "email": "john@example.com",
                    "password": "secret123",
                    "address": "123 Main St",
                    "phone": "123-456-7890"
                }
            </code>
        </pre>

        <!-- Add more examples as needed -->

    </div>
@endsection
