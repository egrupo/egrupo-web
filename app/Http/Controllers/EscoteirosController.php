<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\MyBaseController;

use App\Models\Escoteiro;
use App\User;
use App\Models\ProvaEtapa;
use App\Models\Etapa;
use App\Models\Especialidade;
use App\Models\ProvaEspecialidade;

use App;
use Auth;
use DB;
use Redirect;
use File;
use Storage;
use Image;

class EscoteirosController extends MyBaseController {

	protected $escoteiro;

	public function __construct(Escoteiro $escoteiro){
		$this->escoteiro = $escoteiro;
		$this->middleware('auth.organization');
	}

	public function create(){
		return View::make('escoteiros.create');
	}

	public function store(Request $request){
 	
 		$this->escoteiro->fill($request->all());
 		$this->escoteiro->organization_id = Auth::user()->organization_id;

	 	if( ! $this->escoteiro->isValid() ){
	 		return redirect()->back()->withInput()->withErrors($this->escoteiro->errors);
	 	}

	 	$this->escoteiro->save();

 		return redirect()->route('escoteiros.show',[ mySlug(), $this->escoteiro->id]);
 	}

	public function index(){
 		return Escoteiro::all();
	}

 public function show($slug,$id){

 	$escoteiro = Escoteiro::where('id',$id)
 					->where('organization_id',Auth::user()->organization_id)
 					->first();
	
 	if(!$escoteiro)
 		App::abort(404);

 
 	return view('organization.escoteiros.show',array('escoteiro' => $escoteiro));
 }

	public function edit($slug, $id){

 		if(Auth::user()->level > User::$CAMINHEIRO && $id != Escoteiro::getRealId(Auth::user()->escoteiro_id)){
 			return 'Este não é o teu perfil para poderes editar';
 		}
 	
 		$escoteiro = Escoteiro::where('id',$id)
 					->where('organization_id',Auth::user()->organization_id)
 					->first();

 		if(!$escoteiro)
 			return 'nao ha este escoteiro '.$id;

 		return view('organization.escoteiros.edit')->with('escoteiro',$escoteiro);
	}

	public function update($slug, $id,Request $request){

 		$escoteiro = Escoteiro::find($id);
 		$escoteiro->update($request->all());

	 	if($request->hasFile('avatar')){

	 		$image = $request->file('avatar');
 			Storage::disk('local')->put(mySlug().'/avatars/'.$escoteiro->id.'.jpg',file_get_contents($image));

 			// $name = mySlug().'/avatars/'.$escoteiro->id.'.jpg';
 			// $file = $request->file('avatar');
 			// Storage::put($name,$file);

 			// $path = 'avatar/'.mySlug();
 			// if(!File::exists($path)){
 			// 	File::makeDirectory($path, $mode = 0777, true, true);
 			// }

 			// $file->move($path.'/',$name);

 			//resize, crop, do that stuff. avatar is 250px

 			// $image = Image::make(sprintf('avatar/%s',$name))->resize(150,150)->save();
 			$escoteiro->avatar_url = true;
 			$escoteiro->save();
 		}

 		return redirect()->route('escoteiros.show',array(mySlug(),$id));
	}

	public function getAvatar($slug,$name,Request $request){

		$escoteiro = Escoteiro::find($name);

		// $w = $request->get('w');
		// $h = $request->get('h');

		$image = null;

		if($escoteiro->avatar_url){
			$image = Image::make(storage_path().'/app/'.$slug.'/avatars/'.$name.'.jpg'); 
			// $image = Image::make(storage_path('app/'.$slug.'/avatars/'.$name.'.jpg'));	
		} else {
			$image = Image::make('images/default_pic.png');
		}

		return $image->response();

		// if($w == null && $h == null){
		// 	$w = 500;
		// 	$h = 500;
		// }

		// $image->resize($w,$h,function ($constraint) {
		// 	$constraint->aspectRatio();
		// 	$constraint->upsize();
		// });

		// return $image->response();
	}

	public function showProgresso($slug,$id){
	 	$escoteiro = Escoteiro::where('id',$id)
 					->where('organization_id',Auth::user()->organization_id)
 					->first();

		if(!$escoteiro)
 			return 'nao ha este escoteiro '.$id;

	 	return view('organization.escoteiros.showprogresso',array('escoteiro' => $escoteiro));
	}

	public function showProgressoEspecialidades($slug,$id){
	 	$escoteiro = Escoteiro::where('id',$id)
 					->where('organization_id',Auth::user()->organization_id)
 					->first();

		if(!$escoteiro)
 			return 'nao ha este escoteiro '.$id;
	 	return view('organization.escoteiros.showprogressoespecialidades',array('escoteiro' => $escoteiro));
	}

	public function showPresencas($slug,$id){
	 	$escoteiro = Escoteiro::where('id',$id)
 					->where('organization_id',Auth::user()->organization_id)
 					->first();

		if(!$escoteiro)
 			return 'nao ha este escoteiro '.$id;

	 	$anos = DB::table('atividades')
						->join('presencas','atividades.id','=','presencas.atividade_id')
						->groupBy('atividades.ano')
						->select('atividades.ano')
						->orderBy('atividades.ano','DESC')
						->get();

	 	return view('organization.escoteiros.showpresencas',array('escoteiro' => $escoteiro, 'anos' => $anos));
	}

	public function desconcluirProvaEspecialidade(Request $request,$slug,$id){
		if(Auth::user()->level > 3){
			return Redirect::back()->withErrors('Não tens permissão para assinar esta prova!');
		}

		$especialidade = $request->get('especialidade');
		$prova = $request->get('prova');

		$p = ProvaEspecialidade::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'especialidade' => $especialidade));

		$p->delete();

		return Response::json('Done!',200);
	}

	public function desconcluirProvaEtapa(Request $request,$slug,$id){
		if(Auth::user()->level > 3){
			return Redirect::back()->withErrors('Não tens permissão para assinar esta prova!');
		}

		$etapa = $request->get('etapa');
		$prova = $request->get('prova');

		$p = ProvaEtapa::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'etapa' => $etapa));

		$p->delete();

		return Response::json('Done!',200);
	}

	public function concluirProvaEtapa(Request $request,$slug, $id,$prova = null, $etapa = null, $divisao = null,$concluded_at = null){
		if(Auth::user()->level > 3){
			return redirect()->back()->withErrors('Não tens permissão para assinar esta prova!');
		}

		$etapa = is_null($etapa) ? $request->get('etapa') : $etapa;
		$divisao = is_null($divisao) ? $request->get('divisao') : $divisao;
		$prova = is_null($prova) ? $request->get('prova') : $prova;

		if($prova > Etapa::getNProvas($etapa,$divisao))
			return redirect()->back()->withErrors('O numero da prova de '.Etapa::getLabel($etapa,$divisao).' tem que ser menor que '.(Etapa::getNProvas($etapa,$divisao)+1).'!');

		$p = ProvaEtapa::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'etapa' => $etapa,'divisao' => $divisao));

		$concluded_at = is_null($concluded_at) ? $request->get('concluded_at') : $concluded_at;

		if($request->get('concluded_at')){
			$p->concluded_at = $request->get('concluded_at');
		} else {
			$p->concluded_at = date('Y-m-d');
		}
			
		$p->save();

		if($request->ajax()){
			return $p;
		} else {
			return redirect()->back();	
		}

	}

	public function concluirEtapa(Request $request,$slug,$id){
		if(Auth::user()->level > 3){
			return Redirect::back()->withErrors('Não tens permissão para assinar esta prova!');
		}

		$divisao = $request->get('divisao');
		$etapa = $request->get('etapa');

		$e = Etapa::firstOrNew(array('etapa' => $etapa,'divisao' => $divisao,'escoteiro_id' => $id));

		$e->concluded_at = $request->get('concluded_at');
		$e->save();

		return redirect()->back();
	
	}

	public function concluirProvaEspecialidade(Request $request,$slug, $id){
		if(Auth::user()->level > 3){
			return Redirect::back()->withErrors('Não tens permissão para assinar esta prova!');
		}

		$prova = $request->get('prova');
		$especialidade = $request->get('especialidade');

		$p = ProvaEspecialidade::firstOrNew(array('prova' => $prova,'escoteiro_id' => $id,'especialidade' => $especialidade));

		if($request->get('concluded_at')){
			$p->concluded_at = $request->get('concluded_at');
		} else {
			$p->concluded_at = date('Y-m-d');
		}

		$p->save();

		if($request->ajax()){
			return $p;
		} else {
			return redirect()->back();
		}
	}

	public function concluirEspecialidade(Request $request,$slug, $id){
		if(Auth::user()->level > 3){
			return Redirect::back()->withErrors('Não tens permissão para assinar esta prova!');
		}
		
		$especialidade = $request->get('especialidade');

		$e = Especialidade::firstOrNew(array('especialidade' => $especialidade,'escoteiro_id' => $id));
		$e->concluded_at = $request->get('concluded_at');
		$e->save();

		return redirect()->back();
	}

	/* BULKAGE YA!? */ 
	public function concluirProvas(Request $request, $slug){

		$provas = $request->get('provas');
		$concluded_at = $request->get('concluded_at');
		$escoteiro_id = $request->get('escoteiro_id');
		$divisao = $request->get('divisao');

		$etapa = 0;
		$prova = 0;

		$inds = explode(',',$provas);

		//Convem avaliar se o input está bem!
		for($j = 0 ; $j < count($inds) ; $j++){
			if(strlen($inds[$j]) != 3){
				return 'Formato erradissimo!';
			}
		}

		for($i = 0 ; $i < count($inds) ; $i++){
			$prova = substr($inds[$i], 1,2);
			if($inds[$i] >= 300){
				$etapa = 3;
			} else if($inds[$i] < 200){
				$etapa = 1;
			} else {
				$etapa = 2;
			}

			$this->concluirProvaEtapa($request,$slug,$request->get('escoteiro_id'),$prova,$etapa,$divisao,$concluded_at);
		}

		return redirect()->back();
	}


}