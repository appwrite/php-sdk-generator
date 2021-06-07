<?php

namespace Appwrite\SDK\Language;

use Appwrite\SDK\Language;
use MatthiasMullie\Minify\Minify;

class Kotlin extends Language {

    /**
     * @return string
     */
    public function getName()
    {
        return 'Kotlin';
    }

    /**
     * Get Language Keywords List
     *
     * @return array
     */
    public function getKeywords()
    {
        return [
            "abstract",
            "actual",
            "annotation",
            "as",
            "assert",
            "break",
            "case",
            "catch",
            "class",
            "companion",
            "const",
            "constructor",
            "continue",
            "crossinline",
            "data",
            "delegate",
            "do",
            "dynamic",
            "else",
            "enum",
            "expect",
            "field",
            "final",
            "finally",
            "for",
            "fun",
            "if",
            "import",
            "in",
            "inner",
            "infix",
            "init",
            "inline",
            "interface",
            "internal",
            "is",
            "it",
            "lateinit",
            "noinine",
            "object",
            "open",
            "operator",
            "out",
            "override",
            "package",
            "protected",
            "private",
            "public",
            "reified",
            "return",
            "sealed",
            "suspend",
            "super",
            "switch",
            "synchronized",
            "tailrec",
            "this",
            "throw",
            "transient",
            "try",
            "typealias",
            "vararg",
            "when",
            "where",
            "while"
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
                return 'Int';
            break;
            case self::TYPE_STRING:
                return 'String';
            break;
            case self::TYPE_FILE:
                return 'File';
            break;
            case self::TYPE_BOOLEAN:
                return 'Boolean';
            break;
            case self::TYPE_ARRAY:
            	return 'List<Any>?';
			case self::TYPE_OBJECT:
				return 'Any?';
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
        $type       = $param['type'] ?? '';
        $default    = $param['default'] ?? '';
        $required   = $param['required'] ?? '';

        if($required) {
            return '';
        }

        $output = ' = ';

        if(empty($default) && $default !== 0 && $default !== false) {
            switch ($type) {
                case self::TYPE_INTEGER:
                    $output .= '-1';
                    break;
                case self::TYPE_ARRAY:
                case self::TYPE_OBJECT:
                    $output .= 'null';
                    break;
                case self::TYPE_BOOLEAN:
                    $output .= 'false';
                    break;
                case self::TYPE_STRING:
                    $output .= '""';
                    break;
            }
        }
        else {
            switch ($type) {
                case self::TYPE_INTEGER:
                    $output .= $default;
                    break;
                case self::TYPE_BOOLEAN:
                    $output .= ($default) ? 'true' : 'false';
                    break;
                case self::TYPE_STRING:
                    $output .= "\"{$default}\"";
                    break;
                case self::TYPE_ARRAY:
                case self::TYPE_OBJECT:
                    $output .= 'null';
                    break;
            }
        }

        return $output;
    }

    /**
     * @param array $param
     * @return string
     */
    public function getParamExample(array $param)
    {
        $type       = $param['type'] ?? '';
        $example    = $param['example'] ?? '';

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
                    $output .= "\"\"";
                    break;
                case self::TYPE_OBJECT:
                    $output .= 'Any()';
                    break;
                case self::TYPE_ARRAY:
                    $output .= 'List<Any>()';
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
                    $output .= "\"{$example}\"";
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
            // Config for root project 
            [
                'scope'         => 'default',
                'destination'   => '.github/workflows/publish.yml',
                'template'      => '/kotlin/.github/workflows/publish.yml.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'method',
                'destination'   => 'docs/examples/{{service.name | caseLower}}/{{method.name | caseDash}}.md',
                'template'      => '/kotlin/docs/example.md.twig',
                'minify'        => false,
            ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => 'gradle/wrapper/gradle-wrapper.jar',
            //     'template'      => 'kotlin/gradle/wrapper/gradle-wrapper.jar',
            // ],
            [
                'scope'         => 'default',
                'destination'   => 'gradle/wrapper/gradle-wrapper.properties',
                'template'      => '/kotlin/gradle/wrapper/gradle-wrapper.properties.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'scripts/publish-config.gradle',
                'template'      => '/kotlin/scripts/publish-config.gradle.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'scripts/publish-module.gradle',
                'template'      => '/kotlin/scripts/publish-module.gradle.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '.gitignore',
                'template'      => '/kotlin/.gitignore.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'build.gradle',
                'template'      => '/kotlin/build.gradle.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'CHANGELOG.md',
                'template'      => '/kotlin/CHANGELOG.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'gradle.properties',
                'template'      => '/kotlin/gradle.properties.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'gradlew',
                'template'      => '/kotlin/gradlew.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'gradlew.bat',
                'template'      => '/kotlin/gradlew.bat.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'LICENSE.md',
                'template'      => '/kotlin/LICENSE.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'README.md',
                'template'      => '/kotlin/README.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => 'settings.gradle',
                'template'      => '/kotlin/settings.gradle.twig',
                'minify'        => false,
            ],
            // Config for project :library 
            [
                'scope'         => 'default',
                'destination'   => '/library/example/README.md',
                'template'      => '/kotlin/library/example/README.md.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/Client.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/Client.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/enums/OrderType.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/enums/OrderType.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/exceptions/{{spec.title | caseUcfirst}}Exception.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/exceptions/Exception.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/extensions/JsonExtensions.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/extensions/JsonExtensions.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/models/Error.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/models/Error.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/WebAuthComponent.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/WebAuthComponent.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/views/CallbackActivity.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/views/CallbackActivity.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/services/KeepAliveService.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/services/KeepAliveService.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/services/BaseService.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/services/Service.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'service',
                'destination'   => '/library/src/main/java/{{ sdk.namespace | caseSlash }}/services/{{service.name | caseUcfirst}}.kt',
                'template'      => '/kotlin/library/src/main/java/io/appwrite/services/ServiceTemplate.kt.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/src/main/AndroidManifest.xml',
                'template'      => '/kotlin/library/src/main/AndroidManifest.xml.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/build.gradle',
                'template'      => '/kotlin/library/build.gradle.twig',
                'minify'        => false,
            ],
            [
                'scope'         => 'default',
                'destination'   => '/library/.gitignore',
                'template'      => '/kotlin/library/.gitignore.twig',
                'minify'        => false,
            ],
            // Config for project :example
            // [
            //     'scope'         => 'default',
            //     'destination'   => '/example/src/main/java/{{ sdk.namespace | caseSlash }}/android/MainActivity.kt',
            //     'template'      => '/kotlin/example/src/main/java/io/appwrite/android/MainActivity.kt.twig',
            //     'minify'        => false,
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/drawable/ic_launcher_background.xml',
            //     'template'      => '/kotlin/example/src/main/res/drawable/ic_launcher_background.xml',
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/layout/activity_main.xml',
            //     'template'      => '/kotlin/example/src/main/res/layout/activity_main.xml',
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/mipmap-anydpi-v26/ic_launcher_round.xml',
            //     'template'      => '/kotlin/example/src/main/res/mipmap-anydpi-v26/ic_launcher_round.xml',
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/mipmap-anydpi-v26/ic_launcher.xml',
            //     'template'      => '/kotlin/example/src/main/res/mipmap-anydpi-v26/ic_launcher.xml'
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/values/colors.xml',
            //     'template'      => '/kotlin/example/src/main/res/values/colors.xml',
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/values/strings.xml',
            //     'template'      => '/kotlin/example/src/main/res/values/strings.xml',
            // ],
            // [
            //     'scope'         => 'copy',
            //     'destination'   => '/example/src/main/res/values/themes.xml',
            //     'template'      => '/kotlin/example/src/main/res/values/themes.xml',
            // ],
            // [
            //     'scope'         => 'default',
            //     'destination'   => '/example/src/main/AndroidManifest.xml',
            //     'template'      => '/kotlin/example/src/main/AndroidManifest.xml.twig',
            //     'minify'        => false,
            // ],
            // [
            //     'scope'         => 'default',
            //     'destination'   => '/example/build.gradle',
            //     'template'      => '/kotlin/example/build.gradle.twig',
            //     'minify'        => false,
            // ],
            // [
            //     'scope'         => 'default',
            //     'destination'   => '/example/.gitignore',
            //     'template'      => '/kotlin/example/.gitignore.twig',
            //     'minify'        => false,
            // ],
            
        ];
    }
}

