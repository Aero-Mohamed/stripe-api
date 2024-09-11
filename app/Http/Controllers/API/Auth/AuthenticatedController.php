<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response as Psr7Response;

class AuthenticatedController extends Controller
{
    use ApiResponse;
    use HandlesOAuthErrors;

    /**
     * The token repository implementation.
     *
     * @var TokenRepository
     */
    protected TokenRepository $tokenRepository;

    /**
     * The refresh token repository implementation.
     *
     * @var RefreshTokenRepository
     */
    protected RefreshTokenRepository $refreshTokenRepository;

    /**
     * The authorization server.
     *
     * @var AuthorizationServer
     */
    protected AuthorizationServer $server;

    /**
     * The token repository instance.
     *
     * @var TokenRepository
     */
    protected TokenRepository $tokens;

    /**
     * Create a new controller instance.
     *
     * @param TokenRepository $tokenRepository
     * @param RefreshTokenRepository $refreshTokenRepository
     * @param AuthorizationServer $server
     * @param TokenRepository $tokens
     */
    public function __construct(
        TokenRepository $tokenRepository,
        RefreshTokenRepository $refreshTokenRepository,
        AuthorizationServer $server,
        TokenRepository $tokens
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    /**
     * Login
     *
     * This endpoint allows a user to log in using their credentials.
     * If the login is successful, it returns an authentication token that can be used for subsequent requests.
     *
     * @group Authentication
     * @route POST /api/v1/oauth/token
     *
     * @bodyParam grant_type string required The type of grant being requested. Example: password
     * @bodyParam client_id string required Client ID issued during registration. Example: 1
     * @bodyParam client_secret string required Secret for the client ID. Example: O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN
     * @bodyParam username string required User's email or identifier. Example: user@example.com
     * @bodyParam password string required The password for the user account. Example: 123456789
     *
     * @response {
     *  "token_type": "Bearer",
     *  "expires_in": 1296000,
     *  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiMjQ5ODQ1NmRmMjYzN2M3ZGZiNzVkYThmYjQyMjY3OTU4NDBhNGY1MGFjZDQyN2ZmZTg5ZWVhMTI1YzViZjdlOTE2NzkwZjExMGYwMmEyM2QiLCJpYXQiOjE3MjYwNzE1MzguNjI1MDk4LCJuYmYiOjE3MjYwNzE1MzguNjI1MTAxLCJleHAiOjE3MjczNjc1MzguMTg0ODY3LCJzdWIiOiI1Iiwic2NvcGVzIjpbXX0.RX3-hbHB16gSl0jbCIq0OcDCzC6FxfDZLctPLCapUPNROskb_4bYq8UU-DfVsIFMqhMu8anX2W4x0ylQqom3tv0TRfDkkYc4rKMba1gM_n81VMV4AZAomFq-tZN5p7w_jhQQzR7T3bOk54OG4pRsZdtgCnx0MIfc2TyA34xtkBePMZ3Ptyj3S8JwESMiv_BY92ZCx2ghMwkxNold-_nSmfZo2WqYXnwiHccZbFNM2w7kDjsiZwiW5-oABDoqKEhDI-Iyxum_DpS_HmgFmRLUrZUADUuvUsy089nQN-vKJy_2Oh7BEJtsA2VQYGkW8reAbAuH0Tm60KrILS-eVMYYXPXT6w6aqPvHL2bEKXNC2Pepmcx7EgqoW_McZ5XxTbb9WRdeFmaYVQniIVJXv8DINhWPRQRVzMko60xqEPVz0E7EmU9JzUKMmxKARJIfBGd1hWHkXzVYJIKQQkXHlnNAwKwFfgyEVdLJacZvsYazjaPnYCDT1Bj2Eq7UsxVAtKI0vA9Wvq8hjFBgfZGuKJyXfkSsImhjYEXcC4CCgLzE9M-h7Y0z40bcmrf37fmfdPAmD1bIxMDwUMaWA0Z0juFcNuvC5jwaZ5LghpgGLebHhAqhofgfT0mkM8rOKnTl8TUgZxI4E1nY2d5CSstHvF7vVBAnL9LdhMfAQm3wBZrXywk",
     *  "refresh_token": "def502005c31b158e7204a0b9871d4e4c8b6fcc200b7fc9da341818e9817581a068f0b2f488791e373f392217c0f6ef15fbb9a5d49f6667e1a52e95ea65261f14e77c6e56e3794b72c364ba825effd63af6dd25a9ac0fcb2d47fa7b8e7b47fcb00b975ad0ad0aa91cbb8797e65dcef733a91117d4e87ef68c76ae11b0209f9af10d6d4a441417780347a434cdb4adb757bcdb22c656009b9647fa9465296e14adedd7024efb9d9fcc4355c02a942ab393884fa70435782edd2f10cc6bbc80c23c8d54dee35f89f64df7c33312152c3b35ad3486679fcee572668d1c32a5d36202aa533b09a30b151f283a55e5389578ee646375e544a3c8c45bca1275ae6c06a41919ee689f5acb8f8c6d25d555771f5df30137ec81266b5f0d92b1cf67e19b2b639b5f0b382f5afb27220aa9606cd66418240c2b8fc88ee52716f93b414b7be279beabf5fce8aa3530cde5032d5877879e3f7af6b046eb034153c212ee0706fd6"
     *  }
     *
     * @response 400 {
     * "error": "unsupported_grant_type",
     * "error_description": "The authorization grant type is not supported by the authorization server.",
     * "hint": "Check that all required parameters have been provided",
     * "message": "The authorization grant type is not supported by the authorization server."
     * }
     *
     * @response 401 {
     * "error": "invalid_client",
     * "error_description": "Client authentication failed",
     * "message": "Client authentication failed"
     * }
     *
     *
     *
     * @param ServerRequestInterface $request
     * @return Response
     * @throws OAuthServerException
     */
    public function issueToken(ServerRequestInterface $request): Response
    {
        return $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response())
            );
        });
    }

    /**
     * Log out
     *
     * This endpoint allows the authenticated user to log out by revoking their current access token
     *
     * @group Authentication
     * @authenticated
     *
     * @response 204 {
     * "success": true,
     * "status_code": 200,
     * "data": "Logged out successfully.",
     * "message": "204",
     * "errors": null
     * }
     *
     * @response 401 {
     * "success": false,
     * "status_code": 401,
     * "data": null,
     * "message": "Unauthenticated.",
     * "errors": []
     * }
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Get the authenticated user's access token
        $accessToken = $request->user()->token();

        // Revoke the access token
        $this->tokenRepository->revokeAccessToken($accessToken->id);

        // Revoke all refresh tokens linked to this access token
        $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($accessToken->id);

        return $this->success('Logged out successfully.', statusCode: 204);
    }
}
