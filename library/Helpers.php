<?php
class Helpers {
  private static $String;
  private static $Format;

  public static function limitWords($string,$limit,$end = null){
    self::$String = strip_tags(trim($string));
    $Limit = (int) $limit;

    $ArrayWords = explode(' ',self::$String);
    $NumWords = count($ArrayWords);
    $NewWords = implode(' ', array_slice($ArrayWords, 0, $Limit));

    $End = (empty($end) ? '...' : ' '.$end);
    $Result = ($Limit <  $NumWords ? $NewWords.$End : self::$String );

    return $Result;
  }

  public static function isMail($email){
    self::$String = $email;
    self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

    if(preg_match(self::$Format, self::$String)):
      return true;
    else:
      return false;
    endif;
  }

}
