<?php
//\Config::get('constants.OPERATION.EDIT')

return [

  'UNDEFINED' => '0',

  'MODULES'   =>  [
                  'MMS' => '1',
                  'QMS' => '2',
                  'WMS' => '3',
                  'TMS' => '4',
                ],

  'VIEW_CODE' => [
                  'PRODUCTION' => '1',
                  'QUALITY' => '2',
                  'WAREHOUSES' => '3',
                  'SHIPMENTS' => '4',
                  'USERS' => '5',
                  'PERMISSIONS' => '6',
                  'PRIVILEGES' => '7',
                  'ASSIGNAMENTS' => '8',
                  'ACCESS' => '9',
                  'COMPANIES' => '10',
                  'DATABASES' => '11',
                ],

  'TP_USER' => ['ADMIN' => '1',
                  'DEFAULT' => '2'],

	'PRIVILEGES' => ['NA' => '1',
                    'READER' => '2',
                    'AUTHOR' => '3',
                    'EDITOR' => '4',
                    'MANAGER' => '5'],

  'OPERATION' => ['CREATE' => '0',
                  'EDIT' => '1',
                  'DEL' => '2'],

  'STATUS' => ['ACTIVE' => '0',
                'DEL' => '1'],

  'FILTER' => ['DELETED' => '1',
                'ACTIVES' => '2',
                'ALL' => '3']
];
