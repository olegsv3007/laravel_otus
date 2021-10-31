<?php
return [
    'form' => [
        'title' => 'Choose dates',
        'labels' => [
            'arriving_date' => 'Arriving date',
            'departure_date' => 'Departure date',
            'summary_price' => 'Summary',
            'book_button' => 'Book'
        ],
        'validate_messages' => [
            'date_start' => [
                'required' => 'Arriving date is required',
                'format' => 'Unsupported date format (YYYY-mm-dd)',
                'after_or_equal' => 'Arriving date can\'t be before today',
            ],
            'date_end' => [
                'required' => 'Departure date is required',
                'format' => 'Unsupported date format (YYYY-mm-dd)',
                'after' => 'Departure date can\'t be before arriving date',
            ]
        ]
    ],
];
