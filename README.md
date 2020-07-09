# SDK Lojas Colombo em PHP - WIP

#### Link de acesso ao painel Colombo:
https://www.marketplace.colombo.com.br/login

#### Endpoints

**Sandbox:** https://api.marketplace-homolog.colombo.com.br/v1/

**Produção:** https://api.marketplace.colombo.com.br/v1/

### Instalação

`composer required prhost/lojas-colombo-sdk`

### Autenticando com o SDK

```php
use Prhost\Sdk\Classes\Colombo;

Colombo::init(
    'api_token_id',
    'api_key',
    true //Sandbox true or false
);
```