<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

/**
 * Parser
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
abstract class Parser
{
    #region methods
    /**
     * @param string $path
     *
     * @return ParserResult|null
     * @throws \Com\PaulDevelop\Library\Common\ArgumentException
     * @throws \Com\PaulDevelop\Library\Common\TypeCheckException
     * @throws \Exception
     */
    public static function parse($path = '')
    {
        // init
        $result = null;
        $rFilter = new FilterCollection();
        $rView = null;

        // action
        $entityIsOpen = true;
        $currentEntityName = '';
        $currentAttributes = '';
        $viewIsOpen = false;
        $view = '';
        for ($i = 0; $i < strlen($path); $i++) {
            $currentChar = substr($path, $i, 1);

            if ($viewIsOpen) {
                $view .= $currentChar;
                continue;
            }

            if ($entityIsOpen == true && $currentChar == '[') {
                $entityIsOpen = false;
                continue;
            } elseif (!$entityIsOpen && $currentChar == ']') {
                $entityIsOpen = true;
                continue;
            } elseif ($entityIsOpen && $currentChar == '/') {
                $qfc = self::parseAttributes($currentAttributes);
                foreach ($qfc as $qf) {
                    $rFilter->Add($qf);
                }

                $currentEntityName = '';
                $currentAttributes = '';
                continue;
            } elseif ($entityIsOpen && $currentChar == '#') {
                $viewIsOpen = true;
                continue;
            }

            if ($entityIsOpen) {
                $currentEntityName .= $currentChar;
            } else {
                $currentAttributes .= $currentChar;
            }
        }

        $qfc = self::parseAttributes($currentAttributes);
        foreach ($qfc as $qf) {
            $rFilter->Add($qf);
        }

        $rView = ViewParameter::factory($path);

        $result = new ParserResult(
            $currentEntityName,
            $rFilter,
            $rView
        );

        // result
        return $result;
    }

    private static function parseAttributes($attributes = '')
    {
        // init
        $result = new FilterCollection();

        // action
        $keyIsOpen = true;
        $currentKey = '';
        $currentOperator = '';
        $currentValue = '';
        $stringIsOpen = false;
        for ($i = 0; $i < strlen($attributes); $i++) {
            $currentChar = substr($attributes, $i, 1);
            $nextChar = $i < strlen($attributes) ? substr($attributes, $i + 1, 1) : '';

            if ($keyIsOpen) {
                if ($currentChar == '=') {
                    $currentOperator = $currentChar;
                    $keyIsOpen = false;
                    continue;
                } elseif ($currentChar == '<') {
                    $currentOperator = $currentChar;
                    if ($nextChar == '=') {
                        $i++;
                        $currentOperator .= $nextChar;
                    }
                    $keyIsOpen = false;
                    continue;
                } elseif ($currentChar == '>') {
                    $currentOperator = $currentChar;
                    if ($nextChar == '=') {
                        $i++;
                        $currentOperator .= $nextChar;
                    }
                    $keyIsOpen = false;
                    continue;
                } elseif ($currentChar == '!') {
                    if ($nextChar == '=') {
                        $currentOperator = $currentChar.$nextChar;
                        $i++;
                        $keyIsOpen = false;
                        continue;
                    } else {
                        throw new \Exception(
                            'LibraryPersistence.PathQuery.Parser: Unknown operator '.$currentChar.$nextChar
                        );
                    }
                } elseif ($currentChar == ':') {
                    if ($nextChar == '=') {
                        $currentOperator = $currentChar.$nextChar;
                        $i++;
                        $keyIsOpen = false;
                        continue;
                    } else {
                        throw new \Exception(
                            'LibraryPersistence.PathQuery.Parser: Unknown operator '.$currentChar.$nextChar
                        );
                    }
                }
            } elseif (!$keyIsOpen && !$stringIsOpen && $currentChar == '\'') {
                $stringIsOpen = true;
                continue;
            } elseif (!$keyIsOpen && $stringIsOpen && $currentChar == '\'') {
                $stringIsOpen = false;
                continue;
            } elseif (!$stringIsOpen && $currentChar == ',') {
                $isNull = false;
                if ($currentOperator == ':=') {
                    $isNull = true;
                }
                $result->Add(
                    new Filter(
                        trim($currentKey, '@')."",
                        $currentOperator,
                        $currentValue,
                        Compositions::_AND,
                        $isNull
                    )
                );

                $currentKey = '';
                $currentOperator = '';
                $currentValue = '';
                $keyIsOpen = true;
                continue;
            }

            if ($keyIsOpen) {
                $currentKey .= $currentChar;
            } else {
                $currentValue .= $currentChar;
            }

        }

        if ($currentKey != '') {
            $isNull = false;
            if ($currentOperator == ':=') {
                $isNull = true;
            }
            $result->Add(
                new Filter(
                    trim($currentKey, '@')."",
                    $currentOperator,
                    $currentValue,
                    Compositions::_AND,
                    $isNull
                )
            );
        }

        // result
        return $result;
    }
    #endregion
}
