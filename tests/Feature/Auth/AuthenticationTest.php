<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Carbon\CarbonImmutable;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Token;
use Laravel\Passport\Client;
use Laravel\Passport\Database\Factories\ClientFactory;
use Laravel\Passport\PersonalAccessTokenFactory;
use Tests\TestCase;
use Throwable;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful login.
     *
     * @return void
     */

    /**
     * @throws BindingResolutionException
     * @throws Throwable
     */
    public function testGettingAccessTokenWithPasswordGrant()
    {
        $this->withoutExceptionHandling();

        $user = UserFactory::new()->create([
            'email' => 'foo@gmail.com',
            'password' => $this->app->make(Hasher::class)->make('foobar123'),
        ]);

        /** @var Client $client */
        $client = ClientFactory::new()->asPasswordClient()->create(['user_id' => $user->getKey()]);

        $response = $this->post(
            'api/v1/oauth/token',
            [
                'grant_type' => 'password',
                'client_id' => $client->getKey(),
                'client_secret' => $client->plainSecret,
                'username' => $user->email,
                'password' => 'foobar123',
            ]
        );

        $response->assertOk();

        $response->assertHeader('pragma', 'no-cache');
        $response->assertHeader('cache-control', 'no-store, private');
        $response->assertHeader('content-type', 'application/json; charset=UTF-8');

        $decodedResponse = $response->decodeResponseJson()->json();

        $this->assertArrayHasKey('token_type', $decodedResponse);
        $this->assertArrayHasKey('expires_in', $decodedResponse);
        $this->assertArrayHasKey('access_token', $decodedResponse);
        $this->assertSame('Bearer', $decodedResponse['token_type']);
        $expiresInSeconds = 1296000;
        $this->assertEqualsWithDelta($expiresInSeconds, $decodedResponse['expires_in'], 5);

        $token = $this->app->make(PersonalAccessTokenFactory::class)->findAccessToken($decodedResponse);
        $this->assertInstanceOf(Token::class, $token);
        $this->assertFalse($token->revoked);
        $this->assertTrue($token->user->is($user));
        $this->assertTrue($token->client->is($client));
        $this->assertNull($token->name);
        $this->assertLessThanOrEqual(
            5,
            CarbonImmutable::now()->addSeconds($expiresInSeconds)
                ->diffInSeconds($token->expires_at)
        );
    }
}
