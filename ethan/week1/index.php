<?php
    require 'functions.php';

    $animals = [
        'Tigers',
        'Lions',
        'Bears',
        'Dogs',
        'Cats'
    ];

    $animals[] = 'Elephant';

    $person = [
        'age' => 25,
        'hair' => 'brown',
        'major' => 'software development'
    ];
    $person['name'] = 'Ethan';

    $task = [
        'title' => 'Do Homework',
        'due' => date(1),
        'assigned-to' => 'Ethan Markham',
        'completed' => true
    ];

    $list_of_numbers = range(1,100);

    //dd($animals);

    require 'index.view.php';

