Config utilities for Laravel configuration
==========================================

Implements classes to store a config to a JsonFile and shadow multiple configurations.

```php
$config = new Shadowed(new JsonFile("config.json"), new Config([]));
```