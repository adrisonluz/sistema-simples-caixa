<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Movimentacao;
use App\Caixa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Auth;

class AdminMovimentacaoController extends Controller {
    public function entrada(Request $request) {
        $this->setMovimentacao('entry', $request);

        return redirect('admin/caixas/' . $request->get('caixa_id'));
    }

    public function saida(Request $request) {
        $this->setMovimentacao('output', $request);

        return redirect('admin/caixas/' . $request->get('caixa_id'));
    }

    public function setMovimentacao($type, $request){
        $movimentacao = new Movimentacao;
        $movimentacao->value = $request->get('value');
        $movimentacao->type = $type;
        $movimentacao->caixa_id = $request->get('caixa_id');
        $movimentacao->description = $request->get('description');
        $movimentacao->save();
    }
}
