# Caster
Castea un valor a diferentes tipos

## Usage
Hace cast del valor que se le proporcione
```php
    Cast::as($value, 'type')    
```
Se pueden pasar varios tipos para encadenarlos ejemplo
```php
     Cast::as('   -159.056     ', 'trim|abs|currency')
     //159.06
```
## Tipos soportados
- abs, absolute: Valor absoluto
- bool, boolean: Boolean
- currency, money: Regresa un double redondeado a 2 decimales
- int, integer: A entero
- str, text, string: Como texto
- arr, array: Como arreglo
- float, double: Como float (double)
- date: Intenta regresar una instancia de `Carbon\Carbon`
- trim,spaces: Elimina los espacios de los extremos de una cadena

## Licence

This package is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT) license.


