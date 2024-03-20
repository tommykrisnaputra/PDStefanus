<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use App\Models\User;

class LoginRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return TRUE;
        }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email'    => 'required',
            'password' => 'required',
        ];
        }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials() {
        $credentials = $this->get('email');

        if (is_numeric($credentials)) {
            return ['phone' => $credentials, 'password' => $this->get('password')];
            } else {
            return ['email' => $credentials, 'password' => $this->get('password')];
            }
        }

    /**
     * Checks if the credentials exists
     *
     * @return boolean
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkCredentials($param) {
        if (array_key_exists('email', $param)) {
            $user = User::where('email', $param['email'])->first();
            } else {
            $user = User::where('phone', $param['phone'])->first();
            }

        // dd ($user_id);
        if (empty ($user)) {
            return FALSE;
            } else {
            return $user->id;
            }
        }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param) {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(['email' => $param], ['username' => 'email'])->fails();
        }
    }
