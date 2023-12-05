<?php

namespace App\Core;

use App\Models\ProgrammingLanguage;
use App\Models\User;
use Illuminate\Support\Facades\Process;

class CodeRunner
{

    protected string $code;
    protected ProgrammingLanguage $language;
    protected User $user;

    public function setCode(string $code): CodeRunner
    {
        $this->code = $code;
        return $this;
    }

    public function setLanguage($language): CodeRunner
    {
        $this->language = $language;
        return $this;
    }

    public function setUser(User $user): CodeRunner
    {
        $this->user = $user;
        return $this;
    }

    public function runCode(): array
    {
        $this->writeCodeToFile();
        $command = $this->language->run_command . ' ' . 'code.' . $this->language->extension;
        $output = Process::timeout(5)
            ->path(storage_path('codes/' . $this->user->id . '/' . $this->language->name))
            ->run($command);
        return [
            'output' => $output->output(),
            'error' => $output->errorOutput()
        ];
    }

    public function writeCodeToFile(): string
    {
        $path = storage_path('codes/' . $this->user->id . '/' . $this->language->name . '/code.' . $this->language->extension);
        file_put_contents($path, $this->code);
        return $path;
    }
}
