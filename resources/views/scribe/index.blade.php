<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>StripeApi API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "{{ config("app.url") }}";
        var useCsrf = Boolean(1);
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-4.37.2.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-4.37.2.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-register">
                                <a href="#authentication-POSTapi-v1-auth-register">Register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-oauth-token">
                                <a href="#authentication-POSTapi-v1-oauth-token">Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-DELETEapi-v1-oauth-token">
                                <a href="#authentication-DELETEapi-v1-oauth-token">Log out</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-stripe" class="tocify-header">
                <li class="tocify-item level-1" data-unique="stripe">
                    <a href="#stripe">Stripe</a>
                </li>
                                    <ul id="tocify-subheader-stripe" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="stripe-POSTapi-v1-stripe-update">
                                <a href="#stripe-POSTapi-v1-stripe-update">Update Payment Method</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="stripe-POSTapi-v1-stripe-charge">
                                <a href="#stripe-POSTapi-v1-stripe-charge">charging request for a user</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: September 11, 2024 (f7fc3a1)</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Comprehensive API documentation for StripeApi.</p>
<aside>
    <strong>Base URL</strong>: <code>{{ config("app.url") }}</code>
</aside>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Retrieve your token by logging in and visiting the API settings page.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-v1-auth-register">Register</h2>

<p>
</p>

<p>This endpoint allows a new user to register by providing their details. Upon successful registration,
a new user account will be created, and the created user’s data will be returned along with a success message.</p>

<span id="example-requests-POSTapi-v1-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "{{ config("app.url") }}/api/v1/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"John Doe\",
    \"email\": \"user@example.com\",
    \"password\": \"123456789\",
    \"password_confirmation\": \"123456789\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "{{ config("app.url") }}/api/v1/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "John Doe",
    "email": "user@example.com",
    "password": "123456789",
    "password_confirmation": "123456789"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = '{{ config("app.url") }}/api/v1/auth/register';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'John Doe',
            'email' =&gt; 'user@example.com',
            'password' =&gt; '123456789',
            'password_confirmation' =&gt; '123456789',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = '{{ config("app.url") }}/api/v1/auth/register'
payload = {
    "name": "John Doe",
    "email": "user@example.com",
    "password": "123456789",
    "password_confirmation": "123456789"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;success&quot;: true,
  &quot;status_code&quot;: 201,
  &quot;data&quot;: {
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;John Doe&quot;,
    &quot;email&quot;: &quot;user@example.com&quot;,
    &quot;registered_at&quot;: &quot;2024-09-10T12:34:56.000000Z&quot;,
  },
  &quot;message&quot;: &quot;Account Created.&quot;,
  &quot;errors&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;success&quot;: false,
  &quot;status_code&quot;: 422,
  &quot;data&quot;: null,
  &quot;message&quot;: &quot;The given data was invalid.&quot;,
  &quot;errors&quot;: {
    &quot;name&quot;: [&quot;The name field is required.&quot;],
    &quot;email&quot;: [&quot;The email field is required.&quot;, &quot;The email must be a valid email address.&quot;],
    &quot;password&quot;: [&quot;The password field is required.&quot;, &quot;The password confirmation does not match.&quot;],
  }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-register" data-method="POST"
      data-path="api/v1/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-register"
                    onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-auth-register"
               value="John Doe"
               data-component="body">
    <br>
<p>The full name of the user. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-register"
               value="user@example.com"
               data-component="body">
    <br>
<p>The email address of the user. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-register"
               value="123456789"
               data-component="body">
    <br>
<p>The password for the user account. Example: <code>123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-auth-register"
               value="123456789"
               data-component="body">
    <br>
<p>The confirmation of the user's password. Example: <code>123456789</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-oauth-token">Login</h2>

<p>
</p>

<p>This endpoint allows a user to log in using their credentials.
If the login is successful, it returns an authentication token that can be used for subsequent requests.</p>

<span id="example-requests-POSTapi-v1-oauth-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "{{ config("app.url") }}/api/v1/oauth/token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"grant_type\": \"password\",
    \"client_id\": \"1\",
    \"client_secret\": \"O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN\",
    \"username\": \"user@example.com\",
    \"password\": \"123456789\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "{{ config("app.url") }}/api/v1/oauth/token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "grant_type": "password",
    "client_id": "1",
    "client_secret": "O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN",
    "username": "user@example.com",
    "password": "123456789"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = '{{ config("app.url") }}/api/v1/oauth/token';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'grant_type' =&gt; 'password',
            'client_id' =&gt; '1',
            'client_secret' =&gt; 'O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN',
            'username' =&gt; 'user@example.com',
            'password' =&gt; '123456789',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = '{{ config("app.url") }}/api/v1/oauth/token'
payload = {
    "grant_type": "password",
    "client_id": "1",
    "client_secret": "O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN",
    "username": "user@example.com",
    "password": "123456789"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-oauth-token">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token_type&quot;: &quot;Bearer&quot;,
    &quot;expires_in&quot;: 1296000,
    &quot;access_token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiMjQ5ODQ1NmRmMjYzN2M3ZGZiNzVkYThmYjQyMjY3OTU4NDBhNGY1MGFjZDQyN2ZmZTg5ZWVhMTI1YzViZjdlOTE2NzkwZjExMGYwMmEyM2QiLCJpYXQiOjE3MjYwNzE1MzguNjI1MDk4LCJuYmYiOjE3MjYwNzE1MzguNjI1MTAxLCJleHAiOjE3MjczNjc1MzguMTg0ODY3LCJzdWIiOiI1Iiwic2NvcGVzIjpbXX0.RX3-hbHB16gSl0jbCIq0OcDCzC6FxfDZLctPLCapUPNROskb_4bYq8UU-DfVsIFMqhMu8anX2W4x0ylQqom3tv0TRfDkkYc4rKMba1gM_n81VMV4AZAomFq-tZN5p7w_jhQQzR7T3bOk54OG4pRsZdtgCnx0MIfc2TyA34xtkBePMZ3Ptyj3S8JwESMiv_BY92ZCx2ghMwkxNold-_nSmfZo2WqYXnwiHccZbFNM2w7kDjsiZwiW5-oABDoqKEhDI-Iyxum_DpS_HmgFmRLUrZUADUuvUsy089nQN-vKJy_2Oh7BEJtsA2VQYGkW8reAbAuH0Tm60KrILS-eVMYYXPXT6w6aqPvHL2bEKXNC2Pepmcx7EgqoW_McZ5XxTbb9WRdeFmaYVQniIVJXv8DINhWPRQRVzMko60xqEPVz0E7EmU9JzUKMmxKARJIfBGd1hWHkXzVYJIKQQkXHlnNAwKwFfgyEVdLJacZvsYazjaPnYCDT1Bj2Eq7UsxVAtKI0vA9Wvq8hjFBgfZGuKJyXfkSsImhjYEXcC4CCgLzE9M-h7Y0z40bcmrf37fmfdPAmD1bIxMDwUMaWA0Z0juFcNuvC5jwaZ5LghpgGLebHhAqhofgfT0mkM8rOKnTl8TUgZxI4E1nY2d5CSstHvF7vVBAnL9LdhMfAQm3wBZrXywk&quot;,
    &quot;refresh_token&quot;: &quot;def502005c31b158e7204a0b9871d4e4c8b6fcc200b7fc9da341818e9817581a068f0b2f488791e373f392217c0f6ef15fbb9a5d49f6667e1a52e95ea65261f14e77c6e56e3794b72c364ba825effd63af6dd25a9ac0fcb2d47fa7b8e7b47fcb00b975ad0ad0aa91cbb8797e65dcef733a91117d4e87ef68c76ae11b0209f9af10d6d4a441417780347a434cdb4adb757bcdb22c656009b9647fa9465296e14adedd7024efb9d9fcc4355c02a942ab393884fa70435782edd2f10cc6bbc80c23c8d54dee35f89f64df7c33312152c3b35ad3486679fcee572668d1c32a5d36202aa533b09a30b151f283a55e5389578ee646375e544a3c8c45bca1275ae6c06a41919ee689f5acb8f8c6d25d555771f5df30137ec81266b5f0d92b1cf67e19b2b639b5f0b382f5afb27220aa9606cd66418240c2b8fc88ee52716f93b414b7be279beabf5fce8aa3530cde5032d5877879e3f7af6b046eb034153c212ee0706fd6&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;error&quot;: &quot;unsupported_grant_type&quot;,
    &quot;error_description&quot;: &quot;The authorization grant type is not supported by the authorization server.&quot;,
    &quot;hint&quot;: &quot;Check that all required parameters have been provided&quot;,
    &quot;message&quot;: &quot;The authorization grant type is not supported by the authorization server.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;error&quot;: &quot;invalid_client&quot;,
    &quot;error_description&quot;: &quot;Client authentication failed&quot;,
    &quot;message&quot;: &quot;Client authentication failed&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-oauth-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-oauth-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-oauth-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-oauth-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-oauth-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-oauth-token" data-method="POST"
      data-path="api/v1/oauth/token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-oauth-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-oauth-token"
                    onclick="tryItOut('POSTapi-v1-oauth-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-oauth-token"
                    onclick="cancelTryOut('POSTapi-v1-oauth-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-oauth-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/oauth/token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-oauth-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-oauth-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>grant_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="grant_type"                data-endpoint="POSTapi-v1-oauth-token"
               value="password"
               data-component="body">
    <br>
<p>The type of grant being requested. Example: <code>password</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>client_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="client_id"                data-endpoint="POSTapi-v1-oauth-token"
               value="1"
               data-component="body">
    <br>
<p>Client ID issued during registration. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>client_secret</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="client_secret"                data-endpoint="POSTapi-v1-oauth-token"
               value="O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN"
               data-component="body">
    <br>
<p>Secret for the client ID. Example: <code>O1Cr5SjPKC0gz2GkeTQmwbXjw76n8e88RhoPWuiN</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-v1-oauth-token"
               value="user@example.com"
               data-component="body">
    <br>
<p>User's email or identifier. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-oauth-token"
               value="123456789"
               data-component="body">
    <br>
<p>The password for the user account. Example: <code>123456789</code></p>
        </div>
        </form>

                    <h2 id="authentication-DELETEapi-v1-oauth-token">Log out</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows the authenticated user to log out by revoking their current access token</p>

<span id="example-requests-DELETEapi-v1-oauth-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "{{ config("app.url") }}/api/v1/oauth/token" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "{{ config("app.url") }}/api/v1/oauth/token"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = '{{ config("app.url") }}/api/v1/oauth/token';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = '{{ config("app.url") }}/api/v1/oauth/token'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-oauth-token">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 401,
    &quot;data&quot;: null,
    &quot;message&quot;: &quot;Unauthenticated.&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-oauth-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-oauth-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-oauth-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-oauth-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-oauth-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-oauth-token" data-method="DELETE"
      data-path="api/v1/oauth/token"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-oauth-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-oauth-token"
                    onclick="tryItOut('DELETEapi-v1-oauth-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-oauth-token"
                    onclick="cancelTryOut('DELETEapi-v1-oauth-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-oauth-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/oauth/token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-oauth-token"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-oauth-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-oauth-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="stripe">Stripe</h1>

    

                                <h2 id="stripe-POSTapi-v1-stripe-update">Update Payment Method</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This method is invoked when a user requests to update their payment method. It utilizes the
StripePaymentService to update the user's payment method details on Stripe and then updates
the user's payment method in the local application. If an error occurs during the Stripe API
call, it returns an error response with the appropriate message and HTTP status code.</p>

<span id="example-requests-POSTapi-v1-stripe-update">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "{{ config("app.url") }}/api/v1/stripe/update" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"card_number\": \"4242424242424242\",
    \"expiration_year\": 2025,
    \"expiration_month\": 12,
    \"cvc\": 123
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "{{ config("app.url") }}/api/v1/stripe/update"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "card_number": "4242424242424242",
    "expiration_year": 2025,
    "expiration_month": 12,
    "cvc": 123
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = '{{ config("app.url") }}/api/v1/stripe/update';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'card_number' =&gt; '4242424242424242',
            'expiration_year' =&gt; 2025,
            'expiration_month' =&gt; 12,
            'cvc' =&gt; 123,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = '{{ config("app.url") }}/api/v1/stripe/update'
payload = {
    "card_number": "4242424242424242",
    "expiration_year": 2025,
    "expiration_month": 12,
    "cvc": 123
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-stripe-update">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
     &quot;success&quot;: true,
     &quot;status_code&quot;: 200,
     &quot;data&quot;: {
         &quot;id&quot;: 1,
         &quot;name&quot;: &quot;John Doe&quot;,
         &quot;email&quot;: &quot;johndoe@example.com&quot;,
         &quot;card&quot;: {
             &quot;card_last_four&quot;: &quot;4242&quot;,
             &quot;card_type&quot;: &quot;card&quot;
         }
     },
     &quot;message&quot;: &quot;Payment Method Updated.&quot;
     &quot;errors&quot;: [],
}</code>
 </pre>
            <blockquote>
            <p>Example response (402):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 402,
    &quot;data&quot;: null,
    &quot;message&quot;: &quot;Your card was declined.&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-stripe-update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-stripe-update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-stripe-update"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-stripe-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-stripe-update">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-stripe-update" data-method="POST"
      data-path="api/v1/stripe/update"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-stripe-update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-stripe-update"
                    onclick="tryItOut('POSTapi-v1-stripe-update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-stripe-update"
                    onclick="cancelTryOut('POSTapi-v1-stripe-update');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-stripe-update"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/stripe/update</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-stripe-update"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-stripe-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-stripe-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>card_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="card_number"                data-endpoint="POSTapi-v1-stripe-update"
               value="4242424242424242"
               data-component="body">
    <br>
<p>The credit card number of the user. Example: <code>4242424242424242</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>expiration_year</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="expiration_year"                data-endpoint="POSTapi-v1-stripe-update"
               value="2025"
               data-component="body">
    <br>
<p>The expiration year of the credit card. Example: <code>2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>expiration_month</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="expiration_month"                data-endpoint="POSTapi-v1-stripe-update"
               value="12"
               data-component="body">
    <br>
<p>The expiration month of the credit card. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cvc</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cvc"                data-endpoint="POSTapi-v1-stripe-update"
               value="123"
               data-component="body">
    <br>
<p>The CVC (Card Verification Code) of the credit card. Example: <code>123</code></p>
        </div>
        </form>

                    <h2 id="stripe-POSTapi-v1-stripe-charge">charging request for a user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This method processes a payment request for the authenticated user by attempting
to charge the user using the Stripe payment service. If the user does not have
a payment method, or if an error occurs during the charge attempt, an appropriate
error response is returned.</p>

<span id="example-requests-POSTapi-v1-stripe-charge">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "{{ config("app.url") }}/api/v1/stripe/charge" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"amount\": 29.99,
    \"currency\": \"USD\",
    \"description\": \"\\\"Subscription for September\\\"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "{{ config("app.url") }}/api/v1/stripe/charge"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 29.99,
    "currency": "USD",
    "description": "\"Subscription for September\""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = '{{ config("app.url") }}/api/v1/stripe/charge';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'amount' =&gt; 29.99,
            'currency' =&gt; 'USD',
            'description' =&gt; '"Subscription for September"',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = '{{ config("app.url") }}/api/v1/stripe/charge'
payload = {
    "amount": 29.99,
    "currency": "USD",
    "description": "\"Subscription for September\""
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-stripe-charge">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;pi_3Pxr2fLZrVU5jGta3mtpME1Q&quot;,
        &quot;object&quot;: &quot;payment_intent&quot;,
        &quot;amount&quot;: 10000,
        &quot;amount_capturable&quot;: 0,
        &quot;amount_details&quot;: {
            &quot;tip&quot;: []
        },
        &quot;amount_received&quot;: 10000,
        &quot;application&quot;: null,
        &quot;application_fee_amount&quot;: null,
        &quot;automatic_payment_methods&quot;: {
            &quot;allow_redirects&quot;: &quot;always&quot;,
            &quot;enabled&quot;: true
        },
        &quot;canceled_at&quot;: null,
        &quot;cancellation_reason&quot;: null,
        &quot;capture_method&quot;: &quot;automatic_async&quot;,
        &quot;client_secret&quot;: &quot;pi_3Pxr2fLZrVU5jGta3mtpME1Q_secret_zqm4jKsxh7swSxhmOXz07jdi3&quot;,
        &quot;confirmation_method&quot;: &quot;automatic&quot;,
        &quot;created&quot;: 1726063029,
        &quot;currency&quot;: &quot;usd&quot;,
        &quot;customer&quot;: &quot;cus_QpW3Dcpn1DtJIz&quot;,
        &quot;description&quot;: &quot;Charge for user@example.com. One Time Monthly Subscribtion&quot;,
        &quot;invoice&quot;: null,
        &quot;last_payment_error&quot;: null,
        &quot;latest_charge&quot;: &quot;ch_3Pxr2fLZrVU5jGta37YiLuH0&quot;,
        &quot;livemode&quot;: false,
        &quot;metadata&quot;: [],
        &quot;next_action&quot;: null,
        &quot;on_behalf_of&quot;: null,
        &quot;payment_method&quot;: &quot;pm_1Pxr1lLZrVU5jGtawrensV0o&quot;,
        &quot;payment_method_configuration_details&quot;: {
            &quot;id&quot;: &quot;pmc_1LVAaTLZrVU5jGtaFXrWqZ8L&quot;,
            &quot;parent&quot;: null
        },
        &quot;payment_method_options&quot;: {
            &quot;card&quot;: {
                &quot;installments&quot;: null,
                &quot;mandate_options&quot;: null,
                &quot;network&quot;: null,
                &quot;request_three_d_secure&quot;: &quot;automatic&quot;
            }
        },
        &quot;payment_method_types&quot;: [
            &quot;card&quot;
        ],
        &quot;processing&quot;: null,
        &quot;receipt_email&quot;: null,
        &quot;review&quot;: null,
        &quot;setup_future_usage&quot;: null,
        &quot;shipping&quot;: null,
        &quot;source&quot;: null,
        &quot;statement_descriptor&quot;: null,
        &quot;statement_descriptor_suffix&quot;: null,
        &quot;status&quot;: &quot;succeeded&quot;,
        &quot;transfer_data&quot;: null,
        &quot;transfer_group&quot;: null
    },
    &quot;message&quot;: &quot;Payment Complete.&quot;,
    &quot;errors&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (402):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 402,
    &quot;data&quot;: null,
    &quot;message&quot;: &quot;Your card was declined.&quot;,
    &quot;errors&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-stripe-charge" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-stripe-charge"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-stripe-charge"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-stripe-charge" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-stripe-charge">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-stripe-charge" data-method="POST"
      data-path="api/v1/stripe/charge"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-stripe-charge', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-stripe-charge"
                    onclick="tryItOut('POSTapi-v1-stripe-charge');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-stripe-charge"
                    onclick="cancelTryOut('POSTapi-v1-stripe-charge');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-stripe-charge"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/stripe/charge</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-stripe-charge"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-stripe-charge"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-stripe-charge"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-stripe-charge"
               value="29.99"
               data-component="body">
    <br>
<p>The amount to be charged. Example: <code>29.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-v1-stripe-charge"
               value="USD"
               data-component="body">
    <br>
<p>The currency code for the payment. Example: <code>USD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-stripe-charge"
               value=""Subscription for September""
               data-component="body">
    <br>
<p>A description of the payment. Example: <code>"Subscription for September"</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>
