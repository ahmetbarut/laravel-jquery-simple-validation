# Laravel Jquery Doğrulama
Laravel ve jquery ile sayfa yenilemeden doğrulama işlemi yaptırmak.

# Kurulum 
```
 composer require ahmetbarut/laravel-jq-validation
```
Kurulduktan hemen sonra servisi yayınlayın. `php artisan vendor:publish` komutunu çalıştırın, ardından listeden `ahmetbarut\Validation\Provider\ValidationServiceProvider`'in sıra numarasını yazıp onaylayın.
`Publish` yaptıktan sonra `public/laravel-validation/main.js` dosyasını `view`de dahil edin.

# Kullanım
## Formda Kullanımı 
`validateForm` yöntemi, 4 parametre alır,`validateForm(HTMLElementSelector, requestURI, METHOD, ErrorClass)` 
```html 
    <form name="testform">
        ...
        
        <button onclick="validateForm('form[name=testform]', '{{ route("login") }}', 'POST',['danger'])">
    </form>
```
Şimdi arka uçtan bakalım. Sadece zorunlu alanları geçmezse geriye mesaj döndürelim:
```php
use Form;
use Illuminate\Http\Request;
public function index(Request $request){
    Form::setRules([
        'username' => 'required|string',
        'password' => 'required'
    ])->make($request);

    // Ve doğrulama başarısız olursa geriye mesajları döndürelim.
    if(false !== Form::getErrors()){
        return response()->json(
            [
               'errors' => Form::getErrors()
            ], 422
        );
    }
}

```
Örnek Dönüş :
Hatalı form alanı yoksa `getErrors` false döndürür, varsa da input alanları ve hata mesajlarını dizi olarak döndürür. Örn: 
```php
    [
        0 => [
            'rule' => 'rule_adi',
            'message' => 'Hata mesajı!'
        ]    
    ]
```
## Mesaj Döndürelim 

```php
Form::setRules([
            'username' => 'required|string|max:35',
            'password' => 'required|integer|max:35'
        ])->setMessages([
            'username.required' => 'Kullanıcı adı alanı zorunludur!',
            'password.integer' => 'Parola alanı sayılardan oluşmalıdır '
        ])->make(
            $request
        );
```
