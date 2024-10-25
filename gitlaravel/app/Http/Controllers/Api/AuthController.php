<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        /*Je recupère les champ validés ici email et password et je les stocke
          dans $credentials*/
        $credentials = $request->validated();
        /*Verifie si une ligne dans la base de donnée correpond aux infos
          saisies par le user*/
        if(!Auth::attempt($credentials)){
            return response([
                'message' => "Provided email or password is incorrect"
            ],422);
        }
        /**
         * @var User $user
         */
        /*Je recupère les données dans la base de données concernant l'utilisateur
          et je les stocke dans $user*/
        $user = Auth::user();

        /*Un token d'authentification est créé pour l'utilisateur via la méthode createToken()
         et stocker dans la base de données.
         Ce token sera utilisé pour les futures requêtes authentifiées par cet utilisateur. Le
         nom du token est main. Le token est ensuite converti en texte brut avec plainTextToken
         pour être renvoyé dans la réponse.*/
        $token= $user->createToken('main')->plainTextToken;
        /*Enfin, la méthode retourne une réponse JSON contenant l'utilisateur authentifié (user)
         et le token (token). La fonction compact('user', 'token') crée un tableau associatif
         avec les clés user et token, et leurs valeurs respectives*/
        return response(compact('user','token'));
    }
    public function signup(SignupRequest $request){
        $data = $request->validated();
       /**
        * @var User $user
        */
       $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user','token'));
    }
    public function logout(Request $request){
        /**
         * @var User $user
         */
        $user = $request->user();
        /*Cette ligne supprime le token d'accès actuel de l'utilisateur. La méthode
        currentAccessToken() retourne le token que l'utilisateur a utilisé pour faire
        la requête actuelle, et delete() supprime ce token de la base de données.
        Cela invalide le token, empêchant son utilisation pour des requêtes futures. */
        $user->currentAccessToken()->delete();
        /*Cette ligne retourne une réponse HTTP vide avec le code de statut 204 No Content. */
        return response('' , 204);
    }
}
