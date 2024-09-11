<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends Controller
{
    use ApiResponse;

    /**
     * Login
     *
     * This endpoint allows a user to log in using their credentials.
     * If the login is successful, it returns an authentication token that can be used for subsequent requests.
     *
     * @group Authentication
     * @route POST /api/v1/auth/login
     *
     * @bodyParam email string required The email of the user. Example: user@example.com
     * @bodyParam password string required The password of the user. Example: secret
     *
     * @response 200 {
     *   "success": true,
     *   "status_code": 200,
     *   "data": {
     *     "token": "2|1edc890as98d1a7df1...",
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "user@example.com",
     *       "registered_at": "2024-01-01T00:00:00.000000Z",
     *     }
     *   },
     *   "message": "Success",
     *   "errors": null
     * }
     *
     * @response 401 {
     *   "success": false,
     *   "status_code": 401,
     *   "data": null,
     *   "message": "Invalid credentials",
     *   "errors": null
     * }
     *
     * @param LoginRequest $request The validated login request containing user credentials.
     * @return JsonResponse Returns a JSON response.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = auth_user();

            $user->tokens()->delete();
            $authToken = $user->createToken('auth-token')->plainTextToken;

            return $this->success([
                'token'  => $authToken,
                'user'  => new UserResource($user)
            ]);
        }

        return $this->error(message: "Invalid credentials", statusCode: self::$responseCode::HTTP_UNAUTHORIZED);
    }

    /**
     * Log out
     *
     * This endpoint allows an authenticated user to log out by deleting all of their existing tokens.
     * After logging out, the user will no longer be able to use their previous tokens to access protected routes.
     *
     * @authenticated
     * @group Authentication
     * @route POST /api/v1/auth/logout
     *
     * @response 200 {
     *   "success": true,
     *   "status_code": 200,
     *   "data": null,
     *   "message": "Success",
     *   "errors": null
     * }
     *
     * @response 401 {
     *   "success": false,
     *   "status_code": 401,
     *   "data": null,
     *   "message": "Unauthorized",
     *   "errors": null
     * }
     *
     * @return JsonResponse Returns a JSON response.
     */
    public function logout(): JsonResponse
    {
        $user = auth_user();

        $user->tokens()->delete();

        return $this->success();
    }
}
