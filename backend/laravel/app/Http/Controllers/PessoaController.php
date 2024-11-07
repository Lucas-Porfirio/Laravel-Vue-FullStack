<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PessoaController extends Controller
{

    public function index()
    {
        return response()->json(Pessoa::all());
    }

    public function store(PessoaRequest $request)
    {
        return response()->json(Pessoa::create($request->validated()), Response::HTTP_CREATED);
    }

    public function show(Pessoa $pessoa)
    {
        return response()->json($pessoa);
    }

    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $pessoa->update($request->validated());
        return response()->json($pessoa);
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return response()->json(['message' => 'Pessoa excluída com sucesso.']);
    }
}
