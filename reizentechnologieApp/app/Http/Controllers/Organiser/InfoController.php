<?php

namespace App\Http\Controllers\Organiser;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\InfoRepository;

class InfoController extends Controller
{
    private $info;
    
    public function __construct(InfoRepository $info) {
        $this->info = $info;
    }
    
    public function CheckDbConnection(){
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return  true ;  
        }
    }
    
    public function index() {
        if($this->CheckDbConnection()){
            return redirect()->route('home')->withErrors(["DB connectie mislukt" => "Kan niet met de database connecteren."]);
        }
        else{
            $info_content = $this->info->getAlgemeneInfo();
            //dd($info_content);
            /*$info_content = trim($info_content);
            $firstIndex = strpos($info_content, 'e":"');
            $lastIndex = strrpos($info_content, '"');
            $length = $lastIndex - $firstIndex - 4;
            $content = substr($info_content, $firstIndex + 4, $length);*/

            return view('organizer.info', ['info_content' => $info_content->info_value]);
        }
    }
}

