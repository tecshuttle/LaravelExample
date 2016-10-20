<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Session, Validator, DB, Auth;
use App\Http\Requests\ValidateRequest;

class Oauth2ClientController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(Request $request)
    {
        return $request->user();
    }

    function form()
    {
        $params = [
            'client_id' => 'demoapp', //'tom.xie@que360.com', //demoapp',
            'redirect_uri'  => 'http://www.tomtalk.com',
            'response_type' => 'code',
            'state'         => '123456',
            'scope'         => 'scope1'
        ];

        return view('oauth2.grant', ['params' => $params]);
    }

    function access_token()
    {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => 'demoapp', //'tom.xie@que360.com', //demoapp',    // The client ID assigned to you by the provider
            'clientSecret'            => 'demopass',   // The client password assigned to you by the provider
            'redirectUri'             => 'http://example.com/your-redirect-url/',
            'urlAuthorize'            => 'http://laravel.example.com/oauth/authorize',
            'urlAccessToken'          => 'http://laravel.example.com/oauth/access_token',
            'urlResourceOwnerDetails' => 'http://laravel.example.com/oauth/resource'
        ]);

// If we don't have an authorization code then get one
        if (!isset($_GET['code'])) {
            // Fetch the authorization URL from the provider; this returns the
            // urlAuthorize option and generates and applies any necessary parameters
            // (e.g. state).
            $authorizationUrl = $provider->getAuthorizationUrl();

            // Get the state generated for you and store it to the session.
            $_SESSION['oauth2state'] = $provider->getState();

            // Redirect the user to the authorization URL.
            header('Location: ' . $authorizationUrl);
            exit;

// Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            exit('Invalid state');

        } else {
            try {

                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                // We have an access token, which we may use in authenticated
                // requests against the service provider's API.
                echo $accessToken->getToken() . "\n";
                echo $accessToken->getRefreshToken() . "\n";
                echo $accessToken->getExpires() . "\n";
                echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n";

                // Using the access token, we may look up details about the
                // resource owner.
                $resourceOwner = $provider->getResourceOwner($accessToken);

                var_export($resourceOwner->toArray());

                // The provider provides a way to get an authenticated API request for
                // the service, using the access token; it returns an object conforming
                // to Psr\Http\Message\RequestInterface.
                $request = $provider->getAuthenticatedRequest(
                    'GET',
                    'http://brentertainment.com/oauth2/lockdin/resource',
                    $accessToken
                );

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

                // Failed to get the access token or user details.
                exit($e->getMessage());

            }

        }
    }


}

//end file