<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aba;

class AbaController extends Controller
    {
    public function index ()
        {
        $aba = Aba::orderBy ( 'order_number' )->paginate ( 10 )->withQueryString ();
        return view ( 'aba.index', [ 'aba' => $aba ] );
        }

    public function add ()
        {
        return view ( 'aba.add' );
        }

    public function edit ( $id )
        {
        $aba = Aba::find ( $id );
        return view ( 'aba.form', [ 'aba' => $aba ] );
        }
    }
