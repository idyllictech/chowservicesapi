<!-- resources/views/api-docs.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>FoodHubs API Documentation</h2>

        <h5 class="text-primary">Endpoints:</h5>
        <ul>
            <li > <span class="text-info"><strong>GET /api/v1.0/chowhubs/services</strong>:</span> Retrieve Services Welcome mesage.</li>
            <li > <span class="text-info"><strong>GET /api/v1.0/chowhubs/generate-temp-token</strong>:</span> Generate Public Tokens before Creating Users.</li>
            <li ><span class="text-success"><strong><strong>POST /api/v1.0/chowhubs/register</strong>:</span> Register a new user. Parameters: full_name, email, password, address (optional), phone (optional).</li>
            <li > <span class="text-success"><strong>POST /api/v1.0/chowhubs/login</strong>:</span> User login. Parameters: email, password.</li>
            <li > <span class="text-success"><strong>POST /api/v1.0/chowhubs/forgot-password</strong>:</span> Request a password reset. Parameters: email.</li>
            <li > <span class="text-danger"> <strong>DELETE /api/v1.0/chowhubs/users/{uuid}</strong>:</span> Delete a user . Parameters: uuid.</li>
            <!-- Add more endpoints as needed -->
        </ul>

        <h5 class="text-primary">Authentication:</h5>

        <p>For protected endpoints, include the user's token in the Authorization header Bearer Token: GENERATED TOKENS.</p>

        <h3>Examples:</h3>

        <p class="text-success"><strong>User Registration:</strong></p>
        <pre>
            <code>
                POST /api/v1.0/chowhubs/register
                Content-Type: "application/json"
                Authorization: Bearer GENERATED-TOKENS

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
