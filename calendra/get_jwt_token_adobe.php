<?php require "connect.php" ?>




<?php

 
$fp = fsockopen("acs106.msavlab.adobe.com", 80, $errno, $errstr, 1);
 
if($fp) {
    echo("<BR>ACS Connexion ok");
    
    
    
 if($_SESSION['jwt']){$authToken = $_SESSION['jwt'];}
else{$authToken = "Bearer " . get_access_token();
$_SESSION['jwt'] = $authToken;}
$Moam = $_SESSION['MoAM'];
$Mopm = $_SESSION['MoPM'];
$Tuam = $_SESSION['TuAM'];
$Tupm = $_SESSION['TuPM'];
$Weam = $_SESSION['WeAM'];
$Wepm = $_SESSION['WePM'];
$Tham = $_SESSION['ThAM'];
$Thpm = $_SESSION['ThPM'];
$Fram = $_SESSION['FrAM'];
$Frpm = $_SESSION['FrPM'];




$data = '{"cusMoAM":"'.$Moam.'","cusMoPM":"'.$Mopm.'","cusTuAM":"'.$Tuam.'","cusTuPM":"'.$Tupm.'","cusWeAM":"'.$Weam.'","cusWePM":"'.$Wepm.'","cusThAM":"'.$Tham.'","cusThPM":"'.$Thpm.'","cusFrAM":"'.$Fram.'","cusFrPM":"'.$Frpm.'"}';

$url = "https://mc.adobe.io/acs106.msavlab.adobe.com/campaign/profileAndServicesExt/profile/".$_SESSION['email'];
$headers = array("Content-Type: application/json","Authorization: $authToken","x-api-key: 6fbc42d02d8b42c4b6c35c06808370c1","Cache-Control: no-cache");
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($curl);
if($response) {echo "&#10003; Save in AC";}


curl_close($curl);
    
} else {
    echo("ACS Campaign acs106.msavlab.adobe.com DOWN <a href=https://kite.corp.adobe.com/?a=TEAP.toggleEnvironment&state=start&instanceID=i-003db5c1c8b46cc9b&region=eu-west-1&owner=bachiary>Start Server</a>");
}
 


/**
 * Generate a JWT
 *
 * @param $privateKey The private key filename or string literal to use to sign the token
 * @param $iss The issuer, usually the client_id
 * @param $sub The subject, usually a user_id
 * @param $aud The audience, usually the URI for the oauth server
 * @param $exp The expiration date. If the current time is greater than the exp, the JWT is invalid
 * @param $nbf The "not before" time. If the current time is less than the nbf, the JWT is invalid
 * @param $jti The "jwt token identifier", or nonce for this JWT
 *
 * @return string
 */
function generate_jwt($privateKey, $iss, $sub, $aud, $exp = null, $nbf = null, $jti = null)
{
    if (file_exists($privateKey)) {
        $privateKey = file_get_contents($privateKey);
    }

    $algo = 'RS256';


    if (!$exp) {
        $exp = time() + 1000;
    }

    
    $payload = array(
    'exp' => $exp,
    'iss' => 'CB63659F568CE2667F000101@AdobeOrg',
    'sub' => '1CA4977F59DFC5440A495CB6@techacct.adobe.com',
    'https://ims-na1.adobelogin.com/s/ent_campaign_sdk' => true,
    'https://ims-na1.adobelogin.com/s/event_receiver_api' => true,
    'aud' => 'https://ims-na1.adobelogin.com/c/6fbc42d02d8b42c4b6c35c06808370c1'
        );


    

    if ($nbf) {
        $payload['nbf'] = $nbf;
    }

    if ($jti) {
        $payload['jti'] = $jti;
    }

    $header = array('typ' => 'JWT', 'alg' => $algo);

    $find = array('+', '/', '\r', '\n', '=');
    $replace = array('-', '_');

    $segments = array(
        str_replace($find, $replace, base64_encode(json_encode($header))),
        str_replace($find, $replace, base64_encode(json_encode($payload))),
    );

    $signing_input = implode('.', $segments);

    @openssl_sign($signing_input, $signature, $privateKey, 'sha256');

    $segments[] = str_replace($find, $replace, base64_encode($signature));

    return implode('.', $segments);
}

function get_access_token()
{
    // Query preprocessing
    $conf = [
        'org_id' => 'CB63659F568CE2667F000101@AdobeOrg',
        'tech_acct' => '447bf5ce-8ab1-4aad-98bf-555f7cb42b19@techacct.adobe.com',
        'api_key' => '6fbc42d02d8b42c4b6c35c06808370c1',
        'client_secret' => '4717f1c0-1256-4908-b7d5-2952c494a0a8',
        'priv_key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEA4DPfCq73amr69kAlmw+KxsiUQyLrLLdI8bv7kKXwndfb/55C
okgZtBIgKgjYmAKSByuGVCw+4A4scGF+v4j/3jo/6Ntd/PjOQRKwCKN43YYpcG6h
TYayPl7xsqGSjSnPJb+qwHFdukVPA1dY55q90XTj2mi3j+SFKJmVbzETZVZ4++2W
BhjHAu9CfHeKTfesMues6cn5rJt+DnPhTQvUwhTm7EjqIMSWSiN8c82nZgahH5eu
fVNbFqCNJxenR+W+zX4xb2SInLBO2/cgS8mJTciD2Ri+svQwrSUyQGF/2AN5y9ly
plhydWAtlnpszyDAcdwcH6pH48BkWZBUIMFQgQIDAQABAoIBABDa9Xa5JrKiblGb
Cvi4V2eQZs0RT/rhoKNDzarXPtqvAsQZ4sqOfxgxkKd4WMg80TumwweK+AMiLacZ
PU0rAIl1eZ6I92zwS5lKzV8o4wpMbsscFhZc/QOBYcxbJ0hjj0Y4PZ8QJsq9MS6A
H5fx4zle/05JNxujQ3uE6F4eo2Wn0Y0jMNbeca6ATye4PDipPpBhf8IdCdRULS3z
zQN+AAczZtMUngxAp4LXQP2NlLHOvz2WlrxkilZ2dqRIm4AtJAC/CqXzsrVi2EA5
cElKlmdYnege1GJB4xGCKF6zIfwlg1jlx6Y3P8QKLjjsOOZ81vIAzArf98oQ6Cmk
qUXPUa0CgYEA+Z2gfRcVWKZov6f5G5IZUD9haflGkg3YI7Dxgj3PJAXqrKf3y8dX
BB4i+1r4NNNyHfVHIuKwlEFcvc7WDU4L7/NEz5523cxbpZHQkE1fzu1RBpRCUidG
gG7bpMws1Lc2tZmw9uyfXun9Wf2z3Gru0On3iMJjYVbpfz0eyBG4k4sCgYEA5e/Z
wCIgPVC7NwVd24phOy9TVbd5LAEsIIdWQp95MfITXVBZKlvIGFruy5BPEduBzgUs
UDdhbUGb39QqIJyn3dKILssKAJfSrgOosTWZfmuIailqyqNbhmVmf/O865gfdXUS
/vkeIwNceVbeeWOIeeedLqI5uHYLnv2Jjmyh/aMCgYEAyGUZoRNVGdSPJ76sqMvD
8r7PcAql8z+WFCFL4mnI0HzHiFFZCIpCe5XOM8k2lwJiDVcLAyDG7l8DG4bgJdJQ
lxTQW3Y2q54SvXuw2wijMDcp44RHMjlByn41a7pXC3cDPwviHHqe/84OjZ62NPDM
RYBwL6UPr+fckT/6ZFiFvD0CgYBCfkHyFexMzvPUzXB+9F15yA3JU+1ulEg2f+yq
B4P8tYx0B7BBV5ldsa4sn+a9u0SmV0ihSeKavcZdy/UCyUqiEyfeoEicM0txlw1J
cb6ZmG8yhBel0ee9zcT+a3XOi4dNaDW+Fjxo06gCTuS3Jdlpp1kFC1S1yy1BJQCK
d0/BEQKBgQDUUrL18ycvSo1SKNU+2b+S+cLuQOgWL2fCsuKMeqCeAbyRHCHcbKhw
WelNlbYEU6ohmYhLMecXjI7daH8x13Qlk2zqvqhDMr1JkbXpjWBuEkg6CRlXmTvC
s1nL0jA8uFYmOOaSUGq6jDciwCXExJaf9QFaSpf0ZF71YiI5LdmUHA==
-----END RSA PRIVATE KEY-----',
		'audience' => 'https://ims-na1.adobelogin.com/c/6fbc42d02d8b42c4b6c35c06808370c1',
        'access_endpoint' => 'https://ims-na1.adobelogin.com/ims/exchange/jwt/'
    ];

    $jwt = generate_jwt($conf['priv_key'], $conf['api_key'], $conf['org_id'], $conf['audience']);

    $payload = [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'client_id' => $conf['api_key'],
        'client_secret' => $conf['client_secret'],
        'jwt_token' => $jwt
    ];
	
	
	
    // Query processing
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $conf['access_endpoint']);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $server_output = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);


    $data = json_decode($server_output);

    return $data ? $data->access_token: ['code' => $status,
        'message' => 'Bad credentials'
    ];
    
    }


       


?>




