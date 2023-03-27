<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        $credentials = $this->get('email');

        if (is_numeric($credentials)) {
            return ['phone' => $credentials, 'password' => $this->get('password')];
        } elseif ($this->isEmail($credentials)) {
            return ['email' => $credentials, 'password' => $this->get('password')];
        }
    }

    /**
     * Checks if the credentials exists
     *
     * @return boolean
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkCredentials($param)
    {
        if (array_key_exists('email', $param)) {
            $user_id = User::where('email', $param['email'])->first()->id;
        } else {
            $user_id = User::where('phone', $param['phone'])->first()->id;
        }
        
        // dd ($user_id);
        if (empty($user_id)) {
            return false;
        } else {
            return $user_id;
        }
    }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return !$factory->make(['email' => $param], ['username' => 'email'])->fails();
    }
}
