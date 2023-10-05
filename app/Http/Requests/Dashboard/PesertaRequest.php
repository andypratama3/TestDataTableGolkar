<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PesertaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getNik()
    {
        return $this->nik;
    }
    public function getTglLahir()
    {
        return $this->tgl_lahir;
    }
    public function getHp()
    {
        return $this->hp;
    }

    public function getKecamatan()
    {
        return $this->kecamatan;
    }
    public function getDesa()
    {
        return $this->desa;
    }
    public function getTps()
    {
        return $this->tps;
    }
    public function getAlamat()
    {
        return $this->alamat;
    }
    public function getWarna()
    {
        return $this->warna;
    }
    public function getPerekrut()
    {
        return $this->perekrut;
    }
    // public function getLatitude()
    // {
    //     return $this->latitude;
    // }
    // public function getLongitude()
    // {
    //     return $this->longitude;
    // }
    public function getStatus()
    {
        return $this->status;
    }
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'nik' => 'required|unique:pesertas,nik',
        ];
    }
}
