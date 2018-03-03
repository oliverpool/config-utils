Config utilities for Laravel configuration
==========================================

Implements classes to store a config to a JsonFile and shadow config objects.

```php
$fallback = config('json') ?? ['answer' => 42];
$config = Helper::jsonShadowedIlluminateConfig('config.json', $fallback);
```