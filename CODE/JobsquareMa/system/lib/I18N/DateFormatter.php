<?php

class SJB_DateFormatter
{
    private $format;

    private static $months = [

        'es' => [
            'ene.', 'feb.', 'mar.', 'abr.', 'may.', 'jun.', 'jul.', 'ago.', 'sep.', 'oct.', 'nov.', 'dic.',
        ],

        'fr' => [
            'janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.',
        ],

        'en' => [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ],

        'de' => [
            'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez',
        ],

        'ru' => [
            'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек',
        ],

        'nl' => [
            'jan', 'feb', 'mrt', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'
        ],

        'no' => [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'
        ],

        'ro' => [
            'Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ],

        'th' => [
            'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
        ],

        'tr' => [
            'Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'
        ],

    ];

    public static function localizeFormat($date, $reverse = false)
    {
        $lang = SJB_I18N::getInstance()->getCurrentLanguage();

        if ($reverse) {
            foreach (self::$months[$lang] as $id => $month) {
                $date = str_replace($month, self::$months['en'][$id], $date);
            }
        } else {
            foreach (self::$months['en'] as $id => $month) {
                $date = str_replace($month, self::$months[$lang][$id], $date);
            }
        }

        return $date;
    }

    public static function getFormats()
    {
        return [
            '%b %d, %Y' => '%b %d, %Y',
            '%b %d' => '%b %d',
            '%d %b, %Y' => '%d %b, %Y',
            '%d %b' => '%d %b',
            '%m/%d/%Y (mm/dd/yyyy)' => '%m/%d/%Y',
            '%d/%m/%Y (dd/mm/yyyy)' => '%d/%m/%Y',
        ];
    }

    function getOutput($date, $format = false, $withTime = false)
    {

        if (empty($format)) {
            $format = SJB_Settings::getValue('date_format');
        }
        $date = self::localizeFormat($date, true);


        $alreadyFormatted = (($parsed = strptime($date, $format)) || ($withTime && $parsed = strptime($date, $format . ' %H:%M')));

        $defaultFormatted = ($parsed = strptime($date, SJB_Settings::getValue('date_format')));
        //$defaultFormatted &= empty($parsed['unparsed']);

        if (is_numeric($date)) { // если таймстемп
            $time = $date;
        } elseif ($defaultFormatted) { // если в дефолтовом формате
            $time = SJB_DateFormatter::getInput($date);
            $time = strtotime($time);
        } elseif ($alreadyFormatted) { // если уже в формате который нужно
            return self::localizeFormat($date);
        } else {
            $time = strtotime($date); // ну и на последок хоть как-нибуть
        }
        if ($time === false) {
            return $date;
        }
        if ($withTime) {
            $format .= ' %H:%M';
        }
        $date = strftime($format, $time);
        if ($withTime && strpos($date, ' 00:00') !== false) {
            $date = str_replace(' 00:00', '', $date);
        }
        return self::localizeFormat($date);
    }
function formatLanguage(DateTime $dt,string $format,string $language = 'en') : string {
   
 $curTz = $dt->getTimezone();
    if($curTz->getName() === 'Z'){
      //INTL don't know Z
      $curTz = new DateTimeZone('UTC');
    }

    $formatPattern = strtr($format,array(
        'D' => '{#1}',
        'l' => '{#2}',
        'M' => '{#3}',
        'F' => '{#4}',
      ));
      $strDate = $dt->format($formatPattern);
      $regEx = '~\{#\d\}~';
      while(preg_match($regEx,$strDate,$match)) {
        $IntlFormat = strtr($match[0],array(
          '{#1}' => 'E',
          '{#2}' => 'EEEE',
          '{#3}' => 'MMM',
          '{#4}' => 'MMMM',
        ));
        $fmt = datefmt_create( $language ,IntlDateFormatter::FULL, IntlDateFormatter::FULL,
        $curTz, IntlDateFormatter::GREGORIAN, $IntlFormat);
        $replace = $fmt ? datefmt_format( $fmt ,$dt) : "???";
        $strDate = str_replace($match[0], $replace, $strDate);
      }

    return $strDate;
}
    function getInput($date)
    {
        $date = trim($date);
        $date = self::localizeFormat($date, true);

        if (preg_match('/\-/', $date)) {
            $format = preg_replace('/%b/u', 'M', SJB_Settings::getValue('date_format'));
            $format = preg_replace('/[\%]/u', '', $format);
            $date = date($format, strtotime($date));
        }
        if (empty($date)) {
            return '';
        }
        $parsedDate = strptime($date, SJB_Settings::getValue('date_format'));
        if (empty($parsedDate)) {
            return SJB_DateType::mysqlNow();
        }

        return sprintf('%s-%02s-%02s', $parsedDate['tm_year'] + 1900, $parsedDate['tm_mon'] + 1, $parsedDate['tm_mday']);
    }

    function isValid($date)
    {
        $date = self::localizeFormat($date, true);

        $parsedDate = strptime($date, SJB_Settings::getValue('date_format'));
        if (empty($parsedDate)) {
            $parsedDate = strptime($date, '%F');
            $parsedDate = $parsedDate ?: strptime($date, '%F %T');
        }
        if ($parsedDate === false) {
           return false;
        }

        return isset($parsedDate['tm_year'], $parsedDate['tm_mon'], $parsedDate['tm_mday']);
    }

    /**
     * PHP 8 compatible replacement for strftime().
     * Converts strftime format specifiers to date() format and applies them.
     */
    public static function strftimeCompat($format, $timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        $mapping = [
            '%b' => 'M',   // Abbreviated month name
            '%B' => 'F',   // Full month name
            '%d' => 'd',   // Day of month (01-31)
            '%e' => 'j',   // Day of month (1-31)
            '%m' => 'm',   // Month (01-12)
            '%Y' => 'Y',   // 4-digit year
            '%y' => 'y',   // 2-digit year
            '%H' => 'H',   // Hour (00-23)
            '%I' => 'h',   // Hour (01-12)
            '%M' => 'i',   // Minutes (00-59)
            '%S' => 's',   // Seconds (00-59)
            '%p' => 'A',   // AM/PM
            '%A' => 'l',   // Full weekday name
            '%a' => 'D',   // Abbreviated weekday name
            '%F' => 'Y-m-d', // ISO date
            '%T' => 'H:i:s', // ISO time
            '%n' => "\n",
            '%t' => "\t",
            '%%' => '%',
        ];

        $dateFormat = strtr($format, $mapping);
        return date($dateFormat, $timestamp);
    }

    /**
     * PHP 8 compatible replacement for strptime().
     * Parses a date string according to a strftime-style format.
     */
    public static function strptimeCompat($date, $format)
    {
        $mapping = [
            '%b' => '(?P<month_abbr>[A-Za-z]+)',
            '%B' => '(?P<month_full>[A-Za-z]+)',
            '%d' => '(?P<day>\d{1,2})',
            '%e' => '(?P<day>\d{1,2})',
            '%m' => '(?P<month>\d{1,2})',
            '%Y' => '(?P<year>\d{4})',
            '%y' => '(?P<year2>\d{2})',
            '%H' => '(?P<hour>\d{1,2})',
            '%M' => '(?P<minute>\d{1,2})',
            '%S' => '(?P<second>\d{1,2})',
            '%F' => '(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})',
            '%T' => '(?P<hour>\d{2}):(?P<minute>\d{2}):(?P<second>\d{2})',
        ];

        $pattern = $format;
        foreach ($mapping as $spec => $re) {
            $pattern = str_replace($spec, $re, $pattern);
        }
        $pattern = '/^' . $pattern . '/';

        if (!preg_match($pattern, $date, $matches)) {
            return false;
        }

        $months = ['jan' => 0, 'feb' => 1, 'mar' => 2, 'apr' => 3, 'may' => 4, 'jun' => 5,
                    'jul' => 6, 'aug' => 7, 'sep' => 8, 'oct' => 9, 'nov' => 10, 'dec' => 11];

        $result = [
            'tm_sec' => isset($matches['second']) ? (int)$matches['second'] : 0,
            'tm_min' => isset($matches['minute']) ? (int)$matches['minute'] : 0,
            'tm_hour' => isset($matches['hour']) ? (int)$matches['hour'] : 0,
            'tm_mday' => isset($matches['day']) ? (int)$matches['day'] : 0,
            'tm_mon' => 0,
            'tm_year' => 0,
            'unparsed' => '',
        ];

        if (isset($matches['month'])) {
            $result['tm_mon'] = (int)$matches['month'] - 1;
        } elseif (isset($matches['month_abbr'])) {
            $key = strtolower(substr($matches['month_abbr'], 0, 3));
            $result['tm_mon'] = $months[$key] ?? 0;
        }

        if (isset($matches['year'])) {
            $result['tm_year'] = (int)$matches['year'] - 1900;
        } elseif (isset($matches['year2'])) {
            $result['tm_year'] = (int)$matches['year2'] + 100;
        }

        return $result;
    }

    function setDateFormat($format)
    {
        $this->format = $format;
    }
}
