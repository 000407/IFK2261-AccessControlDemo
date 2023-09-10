<?php

namespace App\Http\Controllers\Api;

// Imports
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function login(Request $req) {
		$resposeBody = [];
		$status = 200;

		try {
			$data = $req->json()->all();

			$email = $data['email'];
			$password = $data['password'];

			$user = User::where('email', $email)->first();

			if ($user != null && password_verify($password, $user->password)) {
				// Valid user
				// Set the sessions

				$roles = [];

				foreach ($user->userRoles()->get() as $key => $role) {
					$roles[] = $role->name;
				}
				
				$responseBody['message'] = 'Authentication successful';
				$responseBody['data'] = [
					'accessToken' => $user->createToken($user->email, $roles)->plainTextToken,
					'tokenType' => 'Bearer'
				];
				// Redirect the user to the target location or home page
			} else {
				$status = 404;
				$responseBody['message'] = 'User not found!';
			}

		} catch (Throwable $e) {
			report($e);

			$responseBody['message'] = 'Internal server error!';
			$status = 500;
		}
		
		return response()->json($responseBody, $status);
	}
}
