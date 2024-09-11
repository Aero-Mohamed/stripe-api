<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisteredUserController extends Controller
{
    use ApiResponse;

    /**
     * Register
     *
     * This endpoint allows a new user to register by providing their details. Upon successful registration,
     * a new user account will be created, and the created user’s data will be returned along with a success message.
     *
     * @group Authentication
     * @route POST /api/v1/auth/register
     *
     * @bodyParam name string required The full name of the user. Example: John Doe
     * @bodyParam email string required The email address of the user. Example: user@example.com
     * @bodyParam password string required The password for the user account. Example: 123456789
     * @bodyParam password_confirmation string required The confirmation of the user's password. Example: 123456789
     *
     * @response 201 {
     *   "success": true,
     *   "status_code": 201,
     *   "data": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "email": "user@example.com",
     *     "registered_at": "2024-09-10T12:34:56.000000Z",
     *   },
     *   "message": "Account Created.",
     *   "errors": null
     * }
     *
     * @response 422 {
     *   "success": false,
     *   "status_code": 422,
     *   "data": null,
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name field is required."],
     *     "email": ["The email field is required.", "The email must be a valid email address."],
     *     "password": ["The password field is required.", "The password confirmation does not match."],
     *   }
     * }
     *
     * @param RegisterRequest $request The validated registration request containing user details.
     * @return JsonResponse Returns a JSON response.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        return $this->success(
            data: new UserResource($user),
            message: "Account Created.",
            statusCode: self::$responseCode::HTTP_CREATED
        );
    }
}
