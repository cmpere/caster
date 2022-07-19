# Caster
Castea un valor a diferentes tipos

## Usage
```php
    Cast::as($value, 'type')    
```
Type chain
```php
     Cast::as('   -159.056     ', 'trim|abs|currency')
     //159.06
```
## Cast
```php
Cast::as('   -159.056     ', 'trim|abs|currency') //159.06
Cast::as('     999   ', 'spaces') //999
Cast::as('     999   ', 'trim') //999
Cast::as(['1'], 'boolean') //true
Cast::as('true', 'boolean') //true
Cast::as(' true ', 'boolean') //true
Cast::as(['3',4], 'boolean') //true
Cast::as('false', 'boolean') //false
Cast::as('other', 'boolean') //true
Cast::as('', 'boolean') //false
Cast::as('0', 'boolean') //false
Cast::as(0, 'boolean') //false
Cast::as([], 'boolean') //false
Cast::as('18-ene-2022', 'date') //Carbon\Carbon
Cast::as('15-11-1985', 'date') //Carbon\Carbon
Cast::as('2022-02-25', 'date') //Carbon\Carbon
Cast::as('2022-02', 'date') //Carbon\Carbon (year and month)
Cast::as('2022-feb', 'date') //Carbon\Carbon (year and month)
Cast::as('jun-1985', 'date') //Carbon\Carbon (year and month)
Cast::as('123.126666', 'integer') //123
Cast::as('123.126666', 'int') //123
Cast::as('123.126666', 'float') //123.126666
Cast::as('123.126666', 'double') //123.126666
Cast::as('123.126666', 'currency') //123.13
Cast::as('1578.56666', 'currency') //1578.57
Cast::as('1578.544466', 'currency') //1578.54
```
## Manipulations
```php
Cast::as('   123456789     ', 'trim|truncate:3') //123
Cast::as('123.126666', 'roundup:3') //123.127
Cast::as('123.126666', 'round:3') //123.127
Cast::as('1221.129316666', 'round:2') //1221.13
Cast::as('123.9999', 'floor') //123
Cast::as('123.126666', 'ceil') //124

// spread:max-words:max-items:key1,key2,key(max-items)
Cast::as('123123123', 'spread:3') //['123','123','123']
Cast::as('123123123', 'spread:3,2') //['123','123']
Cast::as('123123123', 'spread:3,2,one,two') //['one'=>'123','two'=>'123']

// spreadword:max-words:max-items:key1,key2,key(max-items)
$str = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.';
Cast::as($str, 'spreadword:4:2') //['Lorem', 'ipsum']
Cast::as($str, 'spreadword:4,2,line1,line2') //['line1' => 'Lorem', 'line2' => 'ipsum']
Cast::as($str, 'spreadword:spreadword:15') //['Lorem ipsum', 'dolor sit amet', 'consectetur,', 'adipisicing', 'elit.']
```

## Licence

This package is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT) license.


