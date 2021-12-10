<?php

namespace ahmetbarut\Validation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Form
{
    /**
     * Doğrulanmayan input alanlarını tutar.
     * @var array|false
     */
    protected $errors;

    /**
     * İnput alanları
     * @var array
     */
    protected $rules;

    /**
     * Farklı hata mesajları döndürülmesi istenirse kullanılabilir.
     * @var array
     */
    protected $messages = [];

    /**
     * Doğrulamanın yapılmasını sağlar.olmalıdır
     * @param Request $request
     * @return static
     */
    public function make(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules(), $this->getMessages());
        if (true === $validator->fails()) {
            $this->errors = [];
            foreach ($validator->errors()->messages() as $rule => $message) {
                array_push($this->errors, [
                    "rule" => $rule,
                    "message" => $message[0]
                ]);
            }
        }else {
            $this->setErrors(false);
        }

        return $this;
    }

    /**
     * Belirtilen input alanlarını getirir
     * @return array
     */
    private function getRules(): array
    {
        return $this->rules;
    }

    /**
     * İnput alanlarını belirtir.
     * @param array $rules
     * @return static
     */
    public function setRules($rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * Doğrulama başarısız ise hata üretir.
     * @return false|array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Sınıf içinden hataları ekler.
     * @param array|false $errors
     * @return static
     */
    private function setErrors($errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * Değiştirilecek mesajları sınıf içinde erişilmesini sağlar.
     * @return array|null
     */
    private function getMessages()
    {
        return $this->messages;
    }

    /**
     * Dönüşü yapılacak hata mesajlarını değiştirmenize olanak sağlar.
     * @param array $messages
     * @return static
     */
    public function setMessages($messages): self
    {
        $this->messages = $messages;
        return $this;
    }
}
