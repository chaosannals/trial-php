<?php require dirname(__DIR__) . '/vendor/autoload.php';

echo snake_to_camel('snake_case_case_case') . PHP_EOL;
echo snake_to_kebab('snake_case_case_case') . PHP_EOL;

echo camel_to_snake('camelCaseCaseCase') . PHP_EOL;
echo camel_to_kebab('camelCaseCaseCase') . PHP_EOL;

echo kebab_to_snake('kebab-case-case-case') . PHP_EOL;
echo kebab_to_camel('kebab-case-case-case') . PHP_EOL;
