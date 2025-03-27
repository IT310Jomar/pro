<?php
require "../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;



// $secret_key = '123alex22';

// $payload = array(
//     'isd' => 'localhost',
//     'aud' => 'localhost',
//     'username' => 'root',
//     'password' => '',
// );


// $encode = JWT::encode($payload, $secret_key, 'HS256');
// $decode = JWT::decode($encode, new Key($secret_key, 'HS256'));


// // print_r($decode);
// echo $encode;

function generate_jwt_token($user_id, $secret_key) {
    $issued_at = time();
    $expiration_time = $issued_at + (60 * 60); // valid for 1 hour

    $payload = array(
        'iat' => $issued_at,
        'exp' => $expiration_time,
        'sub' => $user_id
    );
    return JWT::encode($payload, $secret_key);
}


function validate_jwt_token($jwt_token, $secret_key) {
    try {
        return JWT::decode($jwt_token, $secret_key, array('HS256'));
    } catch (ExpiredException $e) {
        throw new Exception('Token expired');
    } catch (SignatureInvalidException $e) {
        throw new Exception('Invalid token signature');
    } catch (BeforeValidException $e) {
        throw new Exception('Token not valid yet');
    } catch (Exception $e) {
        throw new Exception('Invalid token');
    }
}



?>