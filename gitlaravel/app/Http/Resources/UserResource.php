<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /*J'ajoute ca pour que quand je fais {data} directement dans react
      je puisse avoir les données directement au lieu de devoir faire data.data*/
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /*En Laravel, un UserResource (ou une ressource en général) est une
         classe utilisée pour transformer les modèles ou collections de données
         en un format JSON spécifique lors de l'envoi des réponses API. Cela permet
         de structurer les données de manière claire et concise, en incluant uniquement
         les champs nécessaires.
         Dans cet exemple, on transforme le modèle User en une structure JSON
         avec les champs id, name, email et created_at*/
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d H:i-s')
        ];
    }
}
