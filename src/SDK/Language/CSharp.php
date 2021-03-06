<?php

namespace Appwrite\SDK\Language;

use Appwrite\SDK\Language;

class CSharp extends Language {

    /**
     * @return string
     */
    public function getName()
    {
        return 'CSharp';
    }

    /**
     * Get Language Keywords List
     *
     * @return array
     */
    public function getKeywords()
    {
        return [
            'abstract',
            'add',
            'alias',
            'as',
            'ascending',
            'async',
            'await',
            'base',
            'bool',
            'break',
            'by',
            'byte',
            'case',
            'catch',
            'char',
            'checked',
            'class',
            'const',
            'continue',
            'decimal',
            'default',
            'delegate',
            'do',
            'double',
            'descending',
            'dynamic',
            'else',
            'enum',
            'equals',
            'event',
            'explicit',
            'extern',
            'false',
            'finally',
            'fixed',
            'float',
            'for',
            'foreach',
            'from',
            'get',
            'global',
            'goto',
            'group',
            'if',
            'implicit',
            'in',
            'int',
            'interface',
            'internal',
            'into',
            'is',
            'join',
            'let',
            'lock',
            'long',
            'nameof',
            'namespace',
            'new',
            'null',
            'object',
            'on',
            'operator',
            'orderby',
            'out',
            'override',
            'params',
            'partial',
            'private',
            'protected',
            'public',
            'readonly',
            'ref',
            'remove',
            'return',
            'sbyte',
            'sealed',
            'select',
            'set',
            'short',
            'sizeof',
            'stackalloc',
            'static',
            'string',
            'struct',
            'switch',
            'this',
            'throw',
            'true',
            'try',
            'typeof',
            'uint',
            'ulong',
            'unchecked',
            'unmanaged', # Added in C# 7.3
            'unsafe',
            'ushort',
            'using',
            'using static',
            'value',
            'var',
            'virtual',
            'void',
            'volatile',
            'when',
            'where',
            'while',
            'yield'
        ];
    }

    /**
     * @param $type
     * @return string
     */
    public function getTypeName($type)
    {
        switch ($type) {
            case self::TYPE_INTEGER:
                return 'int';
            break;
            case self::TYPE_STRING:
                return 'string';
            break;
            case self::TYPE_FILE:
                return 'FileInfo';
            break;
            case self::TYPE_BOOLEAN:
                return 'bool';
            break;
            case self::TYPE_ARRAY:
            	return 'List<object>';
			case self::TYPE_OBJECT:
				return 'object';
            break;
        }

        return $type;
    }

    /**
     * @param array $param
     * @return string
     */
    public function getParamDefault(array $param)
    {
        return '';
    }

    /**
     * @param array $param
     * @return string
     */
    public function getParamExample(array $param)
    {
        $type       = (isset($param['type'])) ? $param['type'] : '';
        $example    = (isset($param['example'])) ? $param['example'] : '';

        $output = '';

        if(empty($example) && $example !== 0 && $example !== false) {
            switch ($type) {
                case self::TYPE_FILE:
                    $output .= 'new File("./path-to-files/image.jpg")';
                    break;
                case self::TYPE_NUMBER:
                case self::TYPE_INTEGER:
                    $output .= '0';
                break;
                case self::TYPE_BOOLEAN:
                    $output .= 'false';
                    break;
                case self::TYPE_STRING:
                    $output .= "''";
                    break;
                case self::TYPE_OBJECT:
                    $output .= 'new Object()';
                    break;
                case self::TYPE_ARRAY:
                    $output .= '{}';
                    break;
            }
        }
        else {
            switch ($type) {
                case self::TYPE_OBJECT:
                case self::TYPE_FILE:
                case self::TYPE_NUMBER:
                case self::TYPE_INTEGER:
                case self::TYPE_ARRAY:
                    $output .= $example;
                    break;
                case self::TYPE_BOOLEAN:
                    $output .= ($example) ? 'true' : 'false';
                    break;
                case self::TYPE_STRING:
                    $output .= "'{$example}'";
                    break;
            }
        }

        return $output;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return [
            [
                'scope'         => 'default',
                'destination'   => 'README.md',
                'template'      => '/csharp/README.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'CHANGELOG.md',
                'template'      => '/csharp/CHANGELOG.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'LICENSE',
                'template'      => '/csharp/LICENSE.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/src/Appwrite.sln',
                'template'      => '/csharp/src/Appwrite.sln',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/src/Appwrite/Appwrite.csproj',
                'template'      => '/csharp/src/Appwrite/Appwrite.csproj',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Client.cs',
                'template'      => '/csharp/src/Appwrite/Client.cs.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Helpers/ExtensionMethods.cs',
                'template'      => '/csharp/src/Appwrite/Helpers/ExtensionMethods.cs',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Models/OrderType.cs',
                'template'      => '/csharp/src/Appwrite/Models/OrderType.cs.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Models/Rule.cs',
                'template'      => '/csharp/src/Appwrite/Models/Rule.cs.twig',
                'minify'        => false,
            ],

            [
                'scope'         => 'default',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Services/Service.cs',
                'template'      => '/csharp/src/Appwrite/Services/Service.cs.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'service',
                'destination'   => '/{{ sdk.namespace | caseSlash }}/src/Appwrite/Services/{{service.name | caseUcfirst}}.cs',
                'template'      => '/csharp/src/Appwrite/Services/ServiceTemplate.cs.twig',
                'minify'        => false,
            ]
        ];
    }
}

