# ETrans (Laravel)
 
The ETrans package is to download and deploy translations to your project from Elicits translation service.

### Composer:

```
  "require": {
    "heppykarlsson/subtype-laravel": "^1.0"
  },
  "repositories": [
    { "type": "vcs", "url": "https://github.com/HeppyKarlsson/subtype-laravel.git" }
  ],
```

Add Service provider to your providers array in config.app

```
   'providers' => [
        /** Miscellaneous providers */
        HeppyKarlsson\ETrans\ServiceProvider::class,
   ]
```

To download the languages run artisan command etrans:install

```
    php artisan etrans:install
```


If you want to change the desired languages to use publish the config file and modify it.
```
    php artisan vendor:publish
```

