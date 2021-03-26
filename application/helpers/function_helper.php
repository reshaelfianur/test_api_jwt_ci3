<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function numbFormat($numb)
{
    $numb = number_format($numb, 2, ',', '.');
    return (strpos($numb, ',') ? rtrim(rtrim($numb, 0), ',') : $numb);
}
function replaceNumbFormat($numb)
{
    return str_replace('.', '', $numb);
}
function initials($words)
{
    $ex = explode(' ', $words);
    $re = '';

    foreach ($ex as $word) {
        $re .= substr($word, 0, 1);
    }
    return strtoupper($re);
}
function randomString($length)
{
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}
function splitRoute($route, $index, $filter = '/')
{
    return explode($filter,  $route)[$index];
}
function subModules($modCode)
{
    $view = 'templates/sub-module/' . $modCode;

    if (file_exists(APPPATH . 'views/' . $view . '.php')) {
        $ci = &get_instance();
        return $ci->load->view($view);
    }

    return null;
}
function nullifyArray($array)
{
    foreach ($array as $index => $value) {
        if (strlen(trim($value)) < 1)
            $array[$index] = NULL;
    }

    return $array;
}
function nullifyString($string)
{
    if (strlen(trim($string)) < 1)
        return NULL;

    return $string;
}
function safeText($text, $default = '')
{
    if ($text == null or !isset($text))
        return $default;
    else
        return $text;
}
function plural($number, $unit)
{
    if ($number > 1)
        return $number . ' ' . $unit . 's';
    else
        return $number . ' ' . $unit;
}
function textTable($text)
{
    $result = $text;
    $result = str_replace('<table>', ' ', $result);
    $result = str_replace('</table>', ' ', $result);
    $result = str_replace('<tr>', ' ', $result);
    $result = str_replace('</tr>', ' ', $result);
    $result = str_replace('<td>', ' ', $result);
    $result = str_replace('</td>', ' ', $result);

    return $result;
}
function multiTextToSingle($multi, $delimiter = ', ')
{
    $result = $multi;
    $result = str_replace('<br/>', $delimiter, $result);
    $result = str_replace('<br>', $delimiter, $result);
    $result = str_replace('\n', $delimiter, $result);

    return nbsp($result);
}
function pretext($text, $length = 50)
{
    if (strlen($text) > $length) {
        $result = substr($text, 0, $length);
        $result .= '...';
    } else {
        $result = $text;
    }
    return $result;
}
function textArray($key, $array, $return = 'key')
{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        if ($return == 'key') {
            return $key;
        } else if ($return == 'null') {
            return NULL;
        } else if ($return == 'blank') {
            return '';
        }
    }
}
function nbsp($string)
{
    return str_replace(' ', '&nbsp;', $string);
}
function formatThousand($value, $decimal = 0)
{
    return number_format($value, $decimal, ',', '.');
}
function formatByType($value, $type = 'string')
{
    if ($type == 'number')
        return formatThousand($value);
    else if ($type == 'percent')
        return $value . '%';
    else
        return $value;
}
function formatTax($string)
{
    if (strlen(trim($string)) == 15) {
        $exploded = str_split($string);
        $result = '';
        $result .= $exploded[0];
        $result .= $exploded[1];
        $result .= '.';
        $result .= $exploded[2];
        $result .= $exploded[3];
        $result .= $exploded[4];
        $result .= '.';
        $result .= $exploded[5];
        $result .= $exploded[6];
        $result .= $exploded[7];
        $result .= '.';
        $result .= $exploded[8];
        $result .= '-';
        $result .= $exploded[9];
        $result .= $exploded[10];
        $result .= $exploded[11];
        $result .= '.';
        $result .= $exploded[12];
        $result .= $exploded[13];
        $result .= $exploded[14];

        return $result;
    } else {
        return $string;
    }
}
function affixesNumber($num)
{
    if (!in_array(($num % 100), array(11, 12, 13))) {
        switch ($num % 10) {
            case 1:
                return $num . 'st';
            case 2:
                return $num . 'nd';
            case 3:
                return $num . 'rd';
        }
    }
    return $num . 'th';
}
function printInt($nilai, $digit = 1, $decPoint = '.', $thousandSep = ',')
{
    $str_int = strval(intval($nilai));
    $str_str = strval($nilai);
    $eval    = $str_int == $str_str;
    if ($eval)
        return intval($nilai);
    else
        return number_format($nilai, $digit, $decPoint, $thousandSep);
}
function formatBigNumbers($number, $delimiter)
{
    $len = strlen($number);
    if ($len > 3) {
        if ($len % 3 == 0) {
            $split = str_split($number, 3);
            $numberWithCommas = implode($delimiter, $split);

            return $numberWithCommas;
        } else if ($len % 3 == 1) {
            $front = substr($number, 0, 1);
            $split = substr($number, 1, $len - 1);
            $split = str_split($split, 3);
            $numberWithCommas = implode($delimiter, $split);
            $numberWithCommas = $front . $delimiter . $numberWithCommas;

            return $numberWithCommas;
        } else {
            $front = substr($number, 0, 2);
            $split = substr($number, 2, $len - 2);
            $split = str_split($split, 3);
            $numberWithCommas = implode($delimiter, $split);
            $numberWithCommas = $front . $delimiter . $numberWithCommas;

            return $numberWithCommas;
        }
    } else {
        return $number;
    }
}
function checkInternet()
{
    $num   = null;
    $error = null;

    if (!@fsockopen('www.google.com', 80, $num, $error, 5) || !@fsockopen('www.tmf-group.com', 80, $num, $error, 5))
        return FALSE;
    else
        return TRUE;
}
function convertMonth($value)
{
    $indoMonth = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $index     = $value - 1;

    return $indoMonth[$index];
}
function month($value, $language = 'english')
{
    $englishMonth = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $indoMonth    = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $index        = $value - 1;

    if ($language == 'indonesia')
        return $indoMonth[$index];
    else
        return $englishMonth[$index];
}
function convertEnglishDateToIndonesia($englishDate, $format = '-')
{
    $date     = explode($format, $englishDate);
    return $date[2] . '-' . $date[1] . '-' . $date[0];
}
function convertIndoDateToEnglish($indoDate, $format = '-')
{
    $date = explode($format, $indoDate);
    return $date[2] . '-' . $date[1] . '-' . $date[0];
}
function daysName($index = null)
{
    $daysName = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday'
    ];

    if (empty($index))
        return $daysName;
    else
        return $daysName[$index];
}
function day($index, $language = 'english')
{
    $englishDay = [
        'Sun' => 'Sun',
        'Mon' => 'Mon',
        'Tue' => 'Tue',
        'Wed' => 'Wed',
        'Thu' => 'Thu',
        'Fri' => 'Fri',
        'Sat' => 'Sat'
    ];
    $indoDay = [
        'Sun' => 'Mng',
        'Mon' => 'Sen',
        'Tue' => 'Sel',
        'Wed' => 'Rab',
        'Thu' => 'Kam',
        'Fri' => 'Jum',
        'Sat' => 'Sab'
    ];

    if ($language == 'indonesia')
        return $indoDay[$index];
    else
        return $englishDay[$index];
}
function getDateTime($datetime)
{ //format datetime= yyyy/mm/dd hh:mm:ss
    return explode(' ', $datetime)[0];
}
function getHour($datetime)
{ //format datetime= yyyy/mm/dd hh:mm:ss
    return explode(' ', $datetime)[1];
}
function getYear($date)
{ //format date = yyyy-mm-dd
    return explode('-', $date)[0];
}
function dateVerification($date, $format = 'Y-m-d', $strict = true)
{
    $dateTime = DateTime::createFromFormat($format, $date);

    if ($strict) {
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
    }
    return $dateTime !== false;
}
function scramble($key)
{
    return time() . '.' . sha1($key);
}
function greetingTime()
{
    $date = new DateTime();
    $hour = (int) date_format($date, 'H');
    $time = 'pagi';

    if ($hour < 9)
        $time = 'morning';
    else if ($hour < 15)
        $time = 'day';
    else if ($hour < 18)
        $time = 'afternoon';
    else if ($hour < 24)
        $time = 'evening';

    return $time;
}
function dateFormat($date, $format = 'Y-m-d H:i:s', $return = 'blank')
{
    if ($date == '0000-00-00 00:00:00' or  $date == '1900-01-01 00:00:00' or $date == null or $date == '0000-00-00') {
        if ($return == 'blank')
            return '';
        else if ($return == 'zero')
            return '0000-00-00';
        else if ($return == 'null')
            return null;
        else if ($return == 'msg')
            return 'Date $date is invalid';
    } else {
        return date_format(new DateTime($date), $format);
    }
}
function getMonthArray()
{
    $result = [];

    for ($i = 1; $i < 13; $i++) {
        if ($i < 10) {
            $m = '0' . $i;
        } else {
            $m = $i;
        }
        $s = '2013-' . $m . '-01';
        $result[$i] = date('F', strtotime($s));
    }

    return $result;
}
function getAllDateFormat()
{
    return [
        'yyyy-mm-dd' => 'yyyy-mm-dd',
        'dd-mm-yyyy' => 'dd-mm-yyyy',
        'yyyy/mm/dd' => 'yyyy/mm/dd',
        'dd/mm/yyyy' => 'dd/mm/yyyy',
        'mm/dd/yyyy' => 'mm/dd/yyyy'
    ];
}
function secondsToHour($seconds, $format = 'time')
{
    $hour            = floor($seconds / 3600);
    $remainingMinute = $seconds % 3600;
    $minute          = floor($remainingMinute / 60);
    $remainingSecond = $remainingMinute % 60;

    if ($format == 'time') {
        $strHour   = $hour;
        $strMinute = $minute;
        $strSecond = $remainingSecond;

        if ($hour < 10)
            $strHour   = '0$hour';
        if ($minute < 10)
            $strMinute = '0$minute';
        if ($remainingSecond < 10)
            $strSecond = '0$remainingSecond';

        return $strHour . ':' . $strMinute . ':' . $strSecond;
    } else {
        return '$hour h $minute min';
    }
}
function secondsToHourArray($seconds)
{
    $hour            = floor($seconds / 3600);
    $remainingMinute = $seconds % 3600;
    $minute          = floor($remainingMinute / 60);

    $result           = [];
    $result['hour']   = $hour;
    $result['minute'] = $minute / 60;

    return $result;
}
function timeToSecond($time)
{
    $array        = explode(':', $time);
    $hourSecond   = intval($array[0]) * 3600;
    $minuteSecond = intval($array[1]) * 60;
    $second       = intval($array[2]);

    return $hourSecond + $minuteSecond + $second;
}
function dateNow()
{
    return date('Y-m-d');
}
function dateTimeNow()
{
    return date('Y-m-d H:i:s');
}
function tsToDto($timestamp)
{
    return new DateTime(date('Y-m-d H:i:s', $timestamp));
}
function timeToDecimal($seconds)
{
    $hour            = floor($seconds / 3600);
    $remainingMinute = $seconds % 3600;
    $minute          = floor($remainingMinute / 60);
    $remainingSecond = $remainingMinute % 60;

    $strHour   = $hour;
    $strMinute = $minute;
    $strSecond = $remainingSecond;

    if ($hour < 10)
        $strHour   = '0' . $hour;
    if ($minute < 10)
        $strMinute = '0' . $minute;
    if ($remainingSecond < 10)
        $strSecond = '0' . $remainingSecond;

    $time    = $strHour . ':' . $strMinute . ':' . $strSecond;
    $timeArr = explode(':', $time);

    return ($timeArr[0] * 60) + ($timeArr[1]) + ($timeArr[2] / 60);
}
function decimalToTime($dec)
{
    $seconds = ($dec * 3600);
    $hours   = floor($dec);
    $seconds -= $hours * 3600;
    $minutes = round($seconds / 60);
    $seconds -= $minutes * 60;

    if (intval($seconds) > 0) {
        $seconds_fix = round(leadingZero($seconds));
    } else {
        $seconds = 0;
        $seconds_fix = leadingZero($seconds);
    }

    return leadingZero($hours) . ':' . leadingZero($minutes) . ':' . $seconds_fix;
}
function decimalToSeconds($dec)
{
    return floor($dec * 3600);
}
function leadingZero($num)
{
    return (strlen($num) < 2) ? '0{' . $num . '}' : $num;
}
function hoursToDecimal($hms)
{
    $hmsObj = explode(':', $hms);
    $total  = $hmsObj[0];
    $total  += ($hmsObj[1] / 60);
    $total  += ($hmsObj[2] / 3600);

    return floatval(number_format($total, 4, '.', ''));
}
function checkFormatDate($date, $format = 'Y-m-d H:i:s', $return = 'blank')
{
    if ($date == '0000-00-00 00:00:00' or $date == null or $date == '0000-00-00') {
        if ($return == 'blank')
            return '';
        else if ($return == 'zero')
            return '0000-00-00';
        else if ($return == 'null')
            return null;
        else if ($return == 'msg')
            return 'Date $date is invalid';
        else
            return $return;
    } else {
        return date_format(new DateTime($date), $format);
    }
}
function notif($message)
{
    echo '<div>
            <h1 style="color:#90a4ae; margin: 0;
            position: absolute;
            text-align: center;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);">' . $message . '</h1>
        </div>';
    die();
}
function dd($value1 = null, $value2 = null, $value3 = null)
{
    echo '<pre>';
    print_r($value1);
    echo '</pre>';
    echo '</br>';

    if ($value2) {
        echo '<pre>';
        print_r($value2);
        echo '</pre>';
        echo '</br>';
    }

    if ($value3) {
        echo '<pre>';
        print_r($value3);
        echo '</pre>';
        echo '</br>';
    }
    die();
}
function ddQ()
{
    $ci = &get_instance();
    $ci->load->database();
    die($ci->db->last_query());
}
function decimal($value)
{
    $value = abs($value);
    $huruf = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $temp  = '';

    if ($value < 12)
        $temp = ' ' . $huruf[$value];
    else if ($value < 20)
        $temp = decimal($value - 10) . ' belas';
    else if ($value < 100)
        $temp = decimal($value / 10) . ' puluh' . decimal($value % 10);
    else if ($value < 200)
        $temp = ' seratus' . decimal($value - 100);
    else if ($value < 1000)
        $temp = decimal($value / 100) . ' ratus' . decimal($value % 100);
    else if ($value < 2000)
        $temp = ' seribu' . decimal($value - 1000);
    else if ($value < 1000000)
        $temp = decimal($value / 1000) . 'ribu' . decimal($value % 1000);
    else if ($value < 1000000000)
        $temp = decimal($value / 1000000) . ' juta' . decimal($value % 1000000);
    else if ($value < 1000000000000)
        $temp = decimal($value / 1000000000) . ' milyar' . decimal(fmod($value, 1000000000));
    else if ($value < 1000000000000000)
        $temp = decimal($value / 1000000000000) . ' trilyun' . decimal(fmod($value, 1000000000000));

    return $temp;
}
function valueNumber($value)
{
    if ($value < 0)
        $result = 'minus ' . trim(decimal($value));
    else
        $result = trim(decimal($value));

    return $result;
}
function splitWords($text, $cnt = 2)
{
    $result = [];
    $words  = explode(' ', $text);
    $icnt   = count($words) - ($cnt - 1);

    for ($i = 0; $i < $icnt; $i++) {
        $str = '';

        for ($o = 0; $o < $cnt; $o++) {
            $str .= $words[$i + $o] . ' ';
        }

        array_push($result, trim($str));
    }

    return $result;
}
function linkify($string)
{
    $pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

    return preg_replace($pattern, '\\0\'', $string);
}
function unlinkify($string, $twitter = false)
{
    $pattern   = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $newString = preg_replace($pattern, '', $string);

    if ($twitter) {
        $pattern   = '/@([a-zA-Z0-9_]+)/';
        $replace   = '';
        $newString = preg_replace($pattern, $replace, $newString);
    }

    return $newString;
}
function delSign($string)
{
    $pattern   = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
    $newString = preg_replace($pattern, '', $string);
    $pattern   = '/@([a-zA-Z0-9_]+)/';
    $replace   = '';
    $newString = preg_replace($pattern, $replace, $newString);

    return str_replace(array(':', '+'), array('', ''), $newString);
}
function trimImage($str = '')
{
    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
    return empty($image['src']) ? base_url() . 'images/no-image-box.png' : $image['src'];
}
function trimRss($str = '')
{
    preg_match('/<font.+size=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
    return empty($image['src']) ? base_url() . 'images/no-image-box.png' : $image['src'];
}
function treeData($table = '', $id = '', $params = [])
{
    $CI = &get_instance();
    $tablenya = $table;
    $CI->db->select('t1.title AS lev_1,t1.id AS idlev_1,t1.kode AS kode_1,t1.status AS status_1,
                        t2.title as lev_2,t2.id AS idlev_2,t2.kode AS kode_2,t2.status AS status_2,
                        t3.title as lev_3,t3.id AS idlev_3,t3.kode AS kode_3,t3.status AS status_3,
                        t4.title as lev_4,t4.id AS idlev_4,t4.kode AS kode_4,t4.status AS status_4');

    $CI->db->join($tablenya . ' as default_t2', ' t2.parent_id = t1.id', 'LEFT');
    $CI->db->join($tablenya . ' as default_t3', ' t3.parent_id = t2.id', 'LEFT');
    $CI->db->join($tablenya . ' as default_t4', ' t4.parent_id = t3.id', 'LEFT');
    $CI->db->where('t1.parent_id', $id);

    if (isset($params['limit']) && is_array($params['limit']))
        $CI->db->limit($params['limit'][0], $params['limit'][1]);
    elseif (isset($params['limit']))
        $CI->db->limit($params['limit']);

    $res =  $CI->db->get($tablenya . ' as default_t1')->result();

    foreach ($res as $dat => $val) {
        $data[$val->idlev_2]['nama'] = '<b>' . strtoupper($val->lev_2) . '</b>';
        $data[$val->idlev_3]['nama'] = '&raquo; <b><em>' . $val->lev_3 . '</em></b>';
        $data[$val->idlev_4]['nama'] = '&raquo;&raquo; ' . $val->lev_4;

        $data[$val->idlev_2]['kode'] = $val->kode_2;
        $data[$val->idlev_3]['kode'] = $val->kode_3;
        $data[$val->idlev_4]['kode'] = $val->kode_4;

        $data[$val->idlev_2]['status'] = $val->status_2;
        $data[$val->idlev_3]['status'] = $val->status_3;
        $data[$val->idlev_4]['status'] = $val->status_4;

        $data[$val->idlev_2]['id'] = $val->idlev_2;
        $data[$val->idlev_3]['id'] = $val->idlev_3;
        $data[$val->idlev_4]['id'] = $val->idlev_4;
    }

    return $data;
}
function textOnly($str = '')
{
    return preg_replace('/<img[^>]+\>/i', ' ', $str);
}
function indoDay($day = '')
{
    switch ($day) {
        case 'Sun':
            $thisDay = 'Minggu';
            break;
        case 'Mon':
            $thisDay = 'Senin';
            break;
        case 'Tue':
            $thisDay = 'Selasa';
            break;
        case 'Wed':
            $thisDay = 'Rabu';
            break;
        case 'Thu':
            $thisDay = 'Kamis';
            break;
        case 'Fri':
            $thisDay = 'Jumat';
            break;
        case 'Sat':
            $thisDay = 'Sabtu';
            break;
        default:
            $thisDay = 'Tidak di ketahui';
            break;
    }

    return $thisDay;
}
function dateIndo()
{
    for ($i = 1; $i <= 31; $i++) {
        $frm        = str_pad($i, 2, '0', STR_PAD_LEFT);
        $date[$frm] = $frm;
    }
    return $date;
}
function yearIndo($first = '', $last = '')
{
    if ($first == '')
        $first = '2000';

    if ($last == '')
        $last = date('Y');

    for ($i = $first; $i <= $last; $i++)
        $year[$i] = $i;

    return $year;
}
function timeElapsedString($dateTime, $full = false)
{
    $now  = new DateTime;
    $ago  = new DateTime($dateTime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k)
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        else
            unset($string[$k]);
    }

    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}
function countDay($datetime)
{
    $now  = new DateTime;
    $ago  = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    return $diff->days;
}
function timeAgo($time = '')
{
    $periods = array('detik', 'menit', 'jam', 'hari', 'minggu', 'bulan', 'tahun', 'dekade');
    $lengths = array('60', '60', '24', '7', '4.35', '12', '10');

    $now = time();

    $difference = $now - $time;
    $tense      = 'yang lalu';

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++)
        $difference /= $lengths[$j];

    $difference = round($difference);

    if ($difference != 1)
        $periods[$j] .= '';

    return $difference . ' ' . $periods[$j] . ' ' . $tense;
}
function daysInMonth($month = '', $year = '')
{
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}
function dmy($originalDate)
{
    return date('d-m-Y', strtotime($originalDate));
}
function repairSerializeString($value)
{
    $regex = "/s:([0-9]+):'(.*?)'/";

    return preg_replace_callback(
        $regex,
        function ($match) {
            return 's:' . mb_strlen($match[2]) . ':\'' . $match[2] . '\'';
        },
        $value
    );
}
function dataEnum($table, $field)
{
    $obj   = &get_instance();
    $row   = $obj->db->query('SHOW COLUMNS FROM ' . $table . ' LIKE ' . $field)->row()->Type;
    $regex = "/'(.*?)'/";

    preg_match_all($regex, $row, $enumArray);
    $enumFields = $enumArray[1];

    foreach ($enumFields as $value)
        $enums[$value] = $value;

    return $enums;
}
function moveFolder($source, $target)
{
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);
        while (FALSE !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..')
                continue;

            $Entry = $source . '/' . $entry;

            if (is_dir($Entry)) {
                moveFolder($Entry, $target . '/' . $entry);
                continue;
            }
            copy($Entry, $target . '/' . $entry);
        }

        $d->close();
    } else {
        copy($source, $target);
    }
}
function createDateRange($startDate, $endDate, $format = 'Y-m-d')
{
    $begin     = new DateTime($startDate);
    $end       = new DateTime($endDate);
    $interval  = new DateInterval('P1D'); // 1 Day
    $dateRange = new DatePeriod($begin, $interval, $end);

    $range = [];
    foreach ($dateRange as $date) {
        $range[] = $date->format($format);
    }

    return $range;
}
function fullCopy($source, $target)
{
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);

        while (FALSE !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..')
                continue;

            $Entry = $source . '/' . $entry;

            if (is_dir($Entry)) {
                fullCopy($Entry, $target . '/' . $entry);
                continue;
            }

            copy($Entry, $target . '/' . $entry);
        }

        $d->close();
    } else {
        copy($source, $target);
    }
}
function makeDir($path)
{
    return is_dir($path) || mkdir('./' . $path, 0777, true);
}
