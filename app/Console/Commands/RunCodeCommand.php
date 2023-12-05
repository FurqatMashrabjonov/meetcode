<?php

namespace App\Console\Commands;

use App\Core\CodeGenerator;
use App\Core\CodeRunner;
use App\Models\CodeTemplate;
use App\Models\ProgrammingLanguage;
use App\Models\User;
use Illuminate\Console\Command;

class RunCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lang = ProgrammingLanguage::query()->where('extension', 'js')->first();
        $user = User::find(101);
        $template = CodeTemplate::query()->where('programming_language_id', $lang->id)->first();
        $code = 'function draw(arr){
    for(let i = 0; i < arr.length; i++){
        arr[i] = arr[i] * 2;
    }
        }';

        $template_generator = new CodeGenerator();
        $template_generator->setCode($code)->setTemplate($template->code);
        $code = $template_generator->generateCode();
        $runner = new CodeRunner();
        $runner->setUser($user)->setLanguage($lang)->setCode($code);
        $res = $runner->runCode();
        $this->info(json_encode($res));
    }
}
