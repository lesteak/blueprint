<?php

return [

    /**
     * Whether to show Newsletters in the CMS.
     *
     * If you enable this, you will need to ensure that you have added the
     * crudRoutes and added the database table.
     */
    'enable_admin' => true,

    /**
     * Newsletter definitions
     */
    'newsletters' => [
        'enquiry' => [
            'handler' => \App\Enso\Newsletters\EnquiryForm::class,
            'list_name' => 'subscribers',
        ],
    ],

];
