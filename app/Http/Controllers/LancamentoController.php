<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LancamentoController extends Controller
{
    public function index(): JsonResponse
    {
        $lancamentos = Lancamento::with('categoria')->get();
        
        return response()->json([
            'data' => $lancamentos
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), Lancamento::rules(), Lancamento::messages());

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $lancamento = Lancamento::create($request->all());

        return response()->json([
            'data' => $lancamento
        ], 201);
    }
} 