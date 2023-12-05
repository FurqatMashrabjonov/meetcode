<?php

namespace App\Core;

use App\Models\CodeTemplate;
use App\Models\User;

class CodeGenerator
{

    protected string $code;
    protected string $template;

    public function setCode(string $code): CodeGenerator
    {
        $this->code = $code;
        return $this;
    }

    public function setTemplate(string $template): CodeGenerator
    {
        $this->template = $template;
        return $this;
    }

    public function generateCode(): string
    {
        $code = $this->template;
        return str_replace('{{code}}', $this->code, $code);
    }


}
