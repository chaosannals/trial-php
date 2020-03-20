<?php require dirname(__DIR__) . '/vendor/autoload.php';

echo snake_to_camel('snake_case_case_case') . PHP_EOL;
timing('s -> c', function () {
    for ($i = 0; $i < 1000; ++$i) {
        snake_to_camel('snake_case_case_case');
    }
});

echo snake_to_kebab('snake_case_case_case') . PHP_EOL;
timing('s -> k', function () {
    for ($i = 0; $i < 1000; ++$i) {
        snake_to_kebab('snake_case_case_case');
    }
});

echo camel_to_snake('camelCaseCaseCase') . PHP_EOL;
timing('c -> s', function () {
    for ($i = 0; $i < 1000; ++$i) {
        camel_to_snake('camelCaseCaseCase');
    }
});

echo camel_to_kebab('camelCaseCaseCase') . PHP_EOL;
timing('c -> k', function () {
    for ($i = 0; $i < 1000; ++$i) {
        camel_to_kebab('camelCaseCaseCase');
    }
});

echo kebab_to_snake('kebab-case-case-case') . PHP_EOL;
timing('k -> s', function () {
    for ($i = 0; $i < 1000; ++$i) {
        kebab_to_snake('kebab-case-case-case');
    }
});

echo kebab_to_camel('kebab-case-case-case') . PHP_EOL;
timing('k -> c', function () {
    for ($i = 0; $i < 1000; ++$i) {
        kebab_to_camel('kebab-case-case-case');
    }
});
