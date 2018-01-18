<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Snippet;
use App\Repositories\SnippetRepository;
use App\Translate;
use App\Url;

class SnippetController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $snippets;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(SnippetRepository $snippets)
    {
        $this->middleware('auth');

        $this->snippets = $snippets;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('snippets.index', [
            'snippets' => $this->snippets->forUser($request->user()),
            //'t' => new Translate(),
            //'snippets' => request()->user()->account()->snippets()->get(),
            'accounts' => request()->user()->accounts()->get(),
            
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //if ($request->user()->snippets()->count() >= 42){
        //if ($request->user()->snippets()->count() >= $request->user()->max){
        if ($request->user()->account()->snippets()->count() >= $request->user()->max){
          return response('Max count reached', 500);
        }
      
        $this->validate($request, [
            'content' => 'required|max:255',
        ]);

        //$s = $request->user()->snippets()->create([
        $s = $request->user()->account()->snippets()->create([
            'content' => $request->content,
           // 'snippet' => $this->snippets->generate($request->content)
            'nickname' => 'New nick',
          //  'num' => $request->user()->snippets()->max('num') + 1,
            'num' => $request->user()->counter + 1,
            'on' => 'on',
           // 'tags' => 'new hint,new nick',
            'tags' => '',
          
            'header' => '',
            'footer' => '',
            // 'activation' => 'click',
            'activation' => 'persistent',
           // 'icon' => 'info.ico',
            'icon' => explode(',', $request->user()->icons)[0],
          
            'type' => 'inline',
           // 'icons' => 'info.ico,success.ico,default.ico',
            'icons' => $request->user()->icons,
            'voting' => 'on', // $request->user()->voting
        ]);
        $s->snippet = $this->snippets->generate($s->id);
        $s->user_id = request()->user()->id;
        $s->save();
        
        $request->user()->counter++;
        $request->user()->save();

        // return redirect('/snippets');
        //return response()->json($s);
        return $s;
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Snippet $snippet)
    {
        //$this->authorize('destroy', $snippet);

        $snippet->delete();

        //return redirect('/snippets');
    }
  
    public function update(Request $request){
        $s = Snippet::find($request->id);
        $s->content = $request->content;
        $s->snippet = $this->snippets->generate($request->id);
        $s->nickname = $request->nickname;
        $s->save();
        //return response()->json($s);
        return $s;
    }
  
   // public function show($id){
    public function show($user, $hint){
        $this->middleware('guest');
        
        return response()->json( [
                // 'snippet' => Snippet::find($id),
               // 'snippet' => Snippet::where('user_id', $user)->where('num', $hint)->first(),
                'snippet' => Snippet::where('account_id', $user)->where('num', $hint)->first(),
                'domains' => User::find($user)->domains,
            ])
            ->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);   
    }
  
    public function edit($id){
        //$s = request()->user()->snippets()->find($id);
        $s = request()->user()->account()->snippets()->find($id);
        
       // $next = request()->user()->snippets()->where('id', '>', $id)->min('id');
        //$prev = request()->user()->snippets()->where('id', '<', $id)->max('id');
        $next = request()->user()->account()->snippets()->where('id', '>', $id)->min('id');
        $prev = request()->user()->account()->snippets()->where('id', '<', $id)->max('id');
        
        if (!$s) {
            return redirect('/snippets')->with([
                'message' => 'Hint not found'
            ]);
        }
        return view('snippets.edit', [ 
           // 'snippet' => Snippet::find($id) 
            'snippet' => $s,
            'next' => $next,
            'prev' => $prev,
           // 'helpful' => request()->user()->votes()->where('value', 'helpful'),
           // 'nothelpful' => request()->user()->votes()->where('value', 'not helpful'),
            'helpful' => $s->votes()->where('value', 'helpful'),
            'nothelpful' => $s->votes()->where('value', 'not helpful'),
        ]);
    }
  
    public function save(Request $request){
     // dd($request);
        $s = Snippet::find($request->id);
      
        $s->content = $request->content;
        $s->snippet = $this->snippets->generate($request->id);
        $s->nickname = $request->nickname;
        $s->on = $request->on;
        $s->tags = $request->tags;
        $s->header = $request->header;
        $s->footer = $request->footer;
        $s->activation = $request->activation;
        $s->icon = $request->icon;
        $s->icons = $request->icons;
        $s->type = $request->type;
        $s->voting = $request->voting;
      
        $s->save();
        //Snippet::where('voting', '')->update(['voting' => 'on']);
        // return redirect('/snippets');
        /*
        return redirect()->back()->with([
            'message' => 'Successfully saved'
        ]);
        */
    }
  
    public function auto(Request $request){
      //return $request->user()->snippets() 
      return $request->user()->account()->snippets()
        ->where('tags', 'like', '%'.$request->tags.'%')->lists('tags');
      //return [ 's1', 's2', 's3' ];
    }
  
    public function all(){
      return [
        'snippets' => request()->user()->account()->snippets()->get(),
        'accounts' => request()->user()->accounts()->get(),
       // 'columns' => request()->user()->columns,
      //  'max' => request()->user()->max,
        'columns' => request()->user()->account()->columns,
        'max' => request()->user()->account()->max,
        'account' => request()->user()->account(),
        //'url' => '/dragdrop'
        'url' => Url::orderBy('created_at', 'desc')->first()->dragdrop,
      ];
    }
}
