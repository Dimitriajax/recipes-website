<?php

require 'vendor/autoload.php';

$r = R::setup('mysql:host=localhost;dbname=mydatabase', 'bit_academy', 'bit_academy');


function recipeResult()
{
    $recipes =
        [
            [
                'id'    => 1,
                'name'  => 'Pannekoeken',
                'type'  => 'dinner',
                'level' => 'easy',
                'kitchen' => 1,
            ],
            [
                'id'    => 24,
                'name'  => 'Tosti',
                'type'  => 'lunch',
                'level' => 'easy',
                'kitchen' => 2,
            ],
            [
                'id'    => 36,
                'name'  => 'Boeren ommelet',
                'type'  => 'lunch',
                'level' => 'easy',
                'kitchen' => 4,
            ],
            [
                'id'    => 47,
                'name'  => 'Broodje Pulled Pork',
                'type'  => 'lunch',
                'level' => 'hard',
                'kitchen' => 1,
            ],
            [
                'id'    => 5,
                'name'  => 'Hutspot met draadjesvlees',
                'type'  => 'dinner',
                'level' => 'medium',
                'kitchen' => 1,
            ],
            [
                'id'    => 6,
                'name'  => 'Nasi Goreng met Babi ketjap',
                'type'  => 'dinner',
                'level' => 'hard',
                'kitchen' => 1,
            ]
        ];

    foreach ($recipes as $r) {
        $recipe = R::dispense('recipes');
        $recipe->name = $r['name'];
        $recipe->type = $r['type'];
        $recipe->level = $r['level'];
        $recipe->kitchen = R::load('kitchens', $r["kitchen"]);
        // $kitchen = R::dispense('kitchens');
        // $kitchenDetails = R::findOne('kitchens', "id = ?", [$r["kitchen"]]);
        // $kitchen->name = $kitchenDetails["name"];
        // $kitchen->description = $kitchenDetails["description"];



        // var_dump($kitchen->name);
        // $kitchen->ownRecipeList[] = $recipe;

        R::store($recipe);


        // var_dump($recipe->kitchen);



        // $kitchen = R::dispense('kitchens');
        // $recipe->kitchen = R::findOne('kitchens', "id = ?", [$r["kitchen"]]);



        // $recipe->kitchen = R::findOne('kitchens', "id = ?", [$r["kitchen"]]);
        // $kitchenName =  $recipe->kitchen.name
        // var_dump(R::findOne('kitchens', "id = ?", [$r["kitchen"]]));
        // $recipe->kitchen_id = $r['kitchen'];
        // $beanTable = R::inspect();
        // var_dump($recipe);
    }

    echo count($recipes) . " recipes inserted" . PHP_EOL;
}

function kitchenResult()
{
    $kitchens = [
        [
            'id' => 1,
            'name' => 'Franse keuken',
            'description' =>
            'De Franse keuken is een internationaal gewaardeerde keuken met een lange traditie. Deze 
            keuken wordt gekenmerkt door een zeer grote diversiteit, zoals dat ook wel gezien wordt in de Chinese 
            keuken en Indische keuken.',
        ],
        [
            'id' => 2,
            'name' => 'Chineese keuken',
            'description' =>
            'De Chinese keuken is de culinaire traditie van China en de Chinesen die in de diaspora 
            leven, hoofdzakelijk in Zuid-Oost-Azië. Door de grootte van China en de aanwezigheid van vele volkeren met 
            eigen culturen, door klimatologische afhankelijkheden en regionale voedselbronnen zijn de variaties groot.',
        ],
        [
            'id' => 3,
            'name' => 'Hollandse keuken',
            'description' =>
            'De Nederlandse keuken is met name geïnspireerd door het landbouwverleden van Nederland.
            Alhoewel de keuken per streek kan verschillen en er regionale specialiteiten bestaan, zijn er voor 
            Nederland typisch geachte gerechten. Nederlandse gerechten zijn vaak relatief eenvoudig en voedzaam, 
            zoals pap, Goudse kaas, pannenkoek, snert en stamppot.',
        ],
        [
            'id' => 4,
            'name' => 'Mediterraans',
            'description' =>
            'De mediterrane keuken is de keuken van het Middellandse Zeegebied en bestaat onder 
            andere uit de tientallen verschillende keukens uit Marokko,Tunesie, Spanje, Italië, Albanië en Griekenland 
            en een deel van het zuiden van Frankrijk (zoals de Provençaalse keuken en de keuken van Roussillon).',
        ],
    ];

    foreach ($kitchens as $k) {
        $kitchen = R::dispense('kitchens');
        $kitchen->name = $k['name'];
        $kitchen->description = $k['description'];
        R::store($kitchen);
    }

    echo count($kitchens) . " kitchens inserted" . PHP_EOL;
}
R::nuke();

kitchenResult();
recipeResult();