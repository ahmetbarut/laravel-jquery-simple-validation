<?php

namespace ahmetbarut\Validation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Helper\Validation\Form setRules(array $rules): static
 * @method static \App\Helper\Validation\Form setMessages(array $messages): static
 * @method static \App\Helper\Validation\Form getErrors(array $rules): array|false
 * @method static \App\Helper\Validation\Form make(Request $request): static
 */
class Form extends Facade{
    public static function getFacadeAccessor()
    {
        return 'form';
    }
}
