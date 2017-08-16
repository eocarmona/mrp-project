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
                  'USERS' => '1',
                  'PERMISSIONS' => '2',
                  'PRIVILEGES' => '3',
                  'ASSIGNAMENTS' => '4',
                  'ACCESS' => '5',
                  'COMPANIES' => '6',
                ],

  'TP_USER' => ['ADMIN' => '1',
                  'DEFAULT' => '2'],

  'TP_PERMISSION' => [
                  'MODULE' => '1',
                  'BRANCH' => '2',
                  'WAREHOUSE' => '3',
                  'VIEW' => '4',
                ],

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
