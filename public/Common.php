<?php
        /*
        common function
        (ans[BOOL]) isBase64(base64Code[STRING])
        (ans[BOOL]) isMd5(md5Code[STRING])
        (VOID) funcAlias(newFunctionName[STRING], originalFunctionName[STRING])
        (VOID) classAlias(newClassName[STRING], originalClassName[STRING])
        (ans[BOOL]) arrayKeyExists(searchByArray[ARRAY], searchFromArray[ARRAY])
        (code[STRING]) saveSystemError(fileLine[INT], filePath[STRING], errorMessage[STRING])
        */
        define("NULLSTRING", "");
        define("BR", "<br />");
        define("LF", "\n");
        define("CR", "\r");
        define("CRLF", CR.LF);
        define("TAB", "\t");
        define("SQ", "'");
        define("DQ", '"');
        define("prefix", "_");
        define("urlPrefix", "/");
        define("questionPrefix", "?");
        define("andPrefix", "&");
        define("equalPrefix", "=");
        define("portPrefix", ":");
        define("httpPrefix", "://");
        define("moneyPrefix", "$");
        define("KmKey", "JdlBQ4Yj79VHq5tEkDIoi2rxnTaS8UON1eLmf0_XzusAPcvGKZw6F3-CMWbpyRhg_");
        define("KmHeader", "?Km#");
        define("KmFooter", "|{kM])");
        define("KmNullString", 'N&u(@l@-L=_^S&#t@&%r*%^i~!`i*^n%$G');
        function km64Encode($source = KmNullString) {
                if (isNullString($source) === true || is_string($source) === false) {
                        $source = KmNullString;
                }
                $headerPos = random(0, mb_strlen($source) - 1);
                $source = mb_substr($source, 0, $headerPos).KmHeader.mb_substr($source,(mb_strlen($source) - $headerPos) * -1).KmFooter.(strlen($headerPos) % 2 === 1 ? "0" : NULLSTRING).$headerPos;
                $encode = NULLSTRING;
                $k = 0;
                $sourceSize = strlen($source);
                for ($i = 0; $i < $sourceSize; $i += 2) {
                        $encode .= substr(KmKey, ord($source[$i]) & 0x3F, 1);
                        $encode .= substr(KmKey, ($i + 1 == $sourceSize ? 64 : ord($source[$i + 1]) & 0x3F), 1);
                        $encode .= substr(KmKey, (($i + 1 == $sourceSize ? 0 : ord($source[$i + 1]) / 0x40 & 0x3) | ord($source[$i]) / 0x10 & 0x0C), 1);
                        if (++$k > 24) {
                                $k = 0;
                                $encode .= CRLF;
                        }
                }
                return $encode;
        }
        function km64Decode($source = NULLSTRING) {
                if (isNullString($source) === true || is_string($source) === false) {
                        $source = NULLSTRING;
                }
                $decodeSize = strlen($source);
                $decode = NULLSTRING;
                for ($i = 0; $i < $decodeSize; $i += 3) {
                        if (ord($source[$i]) == 0x0D || ord($source[$i]) == 0x0A) {
                                $i -= 2;
                        } else {
                                $tempArray = array();
                                for ($j = 0; $j < 3; $j++) {
                                        if (isset($source[$i + $j]) === false) {
                                                return  NULLSTRING;
                                        }
                                        $tempArray[$j] = strpos(KmKey,$source[$i + $j]);
                                }
                                $decode .= chr($tempArray[0] | ($tempArray[2] & 0x0C) * 0x10);
                                if ($tempArray[1] == 64) {
                                        break;
                                }
                                $decode .= chr( $tempArray[1] | ($tempArray[2] & 0x03) * 0x40);
                        }
                }
                
                if (($footerPos = strpos($decode, KmFooter)) === false) {
                        return NULLSTRING;      
                }
                $headerPos = (int)substr($decode, (strlen($decode) - strpos($decode, KmFooter) - strlen(KmFooter)) * -1);
                if (substr($decode, $headerPos, strlen(KmHeader)) !== KmHeader) {
                        return NULLSTRING;      
                }
                $decode = substr($decode, 0, $headerPos).substr($decode, $headerPos + strlen(KmHeader), $footerPos - $headerPos - strlen(KmHeader));
                if ($decode === KmNullString) {
                        return NULLSTRING;      
                }
                return $decode;
        }
        function isKm64($source = NULLSTRING) {
                if (isNullString($source) === true || is_string($source) === false) {
                        return false;   
                }
                $decodeSize = strlen($source);
                $decode = NULLSTRING;
                for ($i = 0; $i < $decodeSize; $i += 3) {
                        if (ord($source[$i]) == 0x0D || ord($source[$i]) == 0x0A) {
                                $i -= 2;
                        } else {
                                $tempArray = array();
                                for ($j = 0; $j < 3; $j++) {
                                        if (isset($source[$i + $j]) === false) {
                                                return false;
                                        }
                                        $tempArray[$j] = strpos(KmKey,$source[$i + $j]);
                                }
                                $decode .= chr($tempArray[0] | ($tempArray[2] & 0x0C) * 0x10);
                                if ($tempArray[1] == 64) {
                                        break;
                                }
                                $decode .= chr( $tempArray[1] | ($tempArray[2] & 0x03) * 0x40);
                        }
                }
                
                if (($footerPos = strpos($decode, KmFooter)) === false) {
                        return false;   
                }
                $headerPos = (int)substr($decode, (strlen($decode) - strpos($decode, KmFooter) - strlen(KmFooter)) * -1);
                if (substr($decode, $headerPos, strlen(KmHeader)) !== KmHeader) {
                        return false;   
                }
                return true;
        }
        function random($min, $max) {
                $rand = base_convert(md5(microtime()), 16, 10);
                $rand = substr($rand, 10, 6);
                $diff = $max - $min + 1;
                return ($diff === 0 ? 0 : ($rand % $diff) + $min);
        }
        function isBase64($code = NULLSTRING) {
                return base64_encode(base64_decode($code)) === $code;
        }
        function isMd5($md5 = NULLSTRING) {
                return !empty($md5) && preg_match('/^[a-f0-9]{32}$/', $md5);
        }
        function isNullString($object = NULLSTRING) {
                return is_string($object) && strlen($object) === 0 && $object !== NULL;
        }
        function isConstantEqualValue($constantName, $constantValue) {
                if (defined($constantName) === true) {
                        if (constant($constantName) === $constantValue) {
                                return true;
                        }
                }
                return false;
        }
        function funcAlias($alias = NULLSTRING, $original = NULLSTRING) {
                if (isNullString($alias) === true || isNullString($original) === true || is_string($alias) === false || is_string($original) === false) {
                        return; 
                }
                ob_start();
                ?>
                function __ALIAS__() {
                        $args = func_get_args();
                        return __ORIGINAL__($args);
                }
                <?php
                $script = ob_get_clean();
                $script = preg_replace("/__ALIAS__/", $alias, $script);
                eval(preg_replace("/__ORIGINAL__/", $original, $script));
        }
        function classAlias($alias = NULLSTRING, $original = NULLSTRING) {
                if (isNullString($alias) === true || isNullString($original) === true || is_string($alias) === false || is_string($original) === false) {
                        return; 
                }
                ob_start();
                ?>
                class __ALIAS__ extends __ORIGINAL__ {}
                <?php
                $script = ob_get_clean();
                $script = preg_replace("/__ALIAS__/", $alias, $script);
                eval(preg_replace("/__ORIGINAL__/", $original, $script));
        }
        function arrayKeyExists(array $searchBy = array(), array $searchFrom = array()) {
                foreach($searchBy as $value) {
                        if (array_key_exists($value, $searchFrom) === true) {
                                return true;
                                break;
                        }
                }
                return false;
        }
        function saveSystemError($fileLine, $filePath, $errorMessage) {
                $nowTime = date("Y-m-d H:i:s");
                $errorCode = md5($nowTime);
                $errorLogMsg = CRLF."Error Code:".TAB.SQ.strtoupper($errorCode).SQ.CRLF;
                $errorLogMsg .= "Error Time:".TAB.SQ.$nowTime.SQ.CRLF;
                $errorLogMsg .= "Error File:".TAB.SQ.$filePath.SQ.CRLF;
                $errorLogMsg .= "Error Line:".TAB.SQ.$fileLine.SQ.CRLF;
                $errorLogMsg .= "Error Type:".TAB.SQ."Unknown Error".SQ.CRLF;
                $errorLogMsg .= "Error Message:".TAB.SQ.$errorMessage.SQ.CRLF;
                error_log($errorLogMsg, 3, __CURRENT_DIR__.__DEFAULT_ERROR_LOG__);
                return $errorCode;
        }
?>