<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| Website Title
|--------------------------------------------------------------------------
*/
define('TITLE', "INKUBATOR LIPI | ");
define('COMPANY_NAME', "Inkubator Teknologi Pusinov LIPI");

/*
|--------------------------------------------------------------------------
| Server/Base URL
|--------------------------------------------------------------------------
*/
define('SCHEMA', ( @$_SERVER["HTTPS"] == "on" ) ? "https://" : "http://");
define('BASE_URL', SCHEMA . ( isset( $_SERVER["SERVER_NAME"] ) ? $_SERVER["SERVER_NAME"] : '' ) . '/');

/*
|--------------------------------------------------------------------------
| Document Root Path
|--------------------------------------------------------------------------
*/
define('ROOTPATH', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/');

/*
|--------------------------------------------------------------------------
| Page Settings
|--------------------------------------------------------------------------
|
| Backend page
|
*/
define('VIEW_BACK',         'backend/');
define('VIEW_FRONT',        'frontend/');
define('VIEW_COMING_SOON',  'comingsoon/');
define('VIEW_MAINTENANCE',  'maintenance/');

/*
|--------------------------------------------------------------------------
| Backend Assets Path Settings
|--------------------------------------------------------------------------
*/
define('BE_CSS_PATH',       BASE_URL . 'smitassets/backend/css/');
define('BE_IMG_PATH',       BASE_URL . 'smitassets/backend/images/');
define('BE_AVA_PATH',       BASE_URL . 'smitassets/backend/images/user/');
define('BE_JS_PATH',        BASE_URL . 'smitassets/backend/js/');
define('BE_PLUGIN_PATH',    BASE_URL . 'smitassets/backend/plugins/');

/*
|--------------------------------------------------------------------------
| Bootsrap Assets Path Settings
|--------------------------------------------------------------------------
*/
define('BOOTSTRAP_PATH',        BASE_URL . 'smitassets/bootstrap/');
define('BOOTSTRAP_CSS_PATH',    BASE_URL . 'smitassets/bootstrap/dist/css/');
define('BOOTSTRAP_JS_PATH',     BASE_URL . 'smitassets/bootstrap/dist/js/');

/*
|--------------------------------------------------------------------------
| Frontend Assets Path Settings
|--------------------------------------------------------------------------
*/
define('FE_CSS_PATH',           BASE_URL . 'smitassets/frontend/css/');
define('FE_IMG_PATH',           BASE_URL . 'smitassets/frontend/images/');
define('FE_JS_PATH',            BASE_URL . 'smitassets/frontend/js/');
define('FE_PLUGIN_PATH',        BASE_URL . 'smitassets/frontend/plugins/');
define('FE_FONTS',              BASE_URL . 'smitassets/frontend/fonts/');

/*
|--------------------------------------------------------------------------
| Coming Soon and Maintenance Assets Path Settings
|--------------------------------------------------------------------------
*/
define('COMINGSOON_CSS_PATH',   BASE_URL . 'smitassets/comingsoon/css/');
define('COMINGSOON_JS_PATH',    BASE_URL . 'smitassets/comingsoon/js/');
define('MAINTENANCE_CSS_PATH',  BASE_URL . 'smitassets/maintenance/css/');
define('MAINTENANCE_JS_PATH',   BASE_URL . 'smitassets/maintenance/js/');

/*
|--------------------------------------------------------------------------
| Export Assets Path Settings
|--------------------------------------------------------------------------
*/
define('EXPORT_PATH', BASE_URL . 'smitassets/export/');

/*
|--------------------------------------------------------------------------
| MM Constant 
|--------------------------------------------------------------------------
|
| These modes for set cookie
|
*/
define('AUTH_KEY',          '%4 N}|@na%Q;Tq$!3m?1^=u|PO_OO?!6Cr_l4h%MLbB<qu?%oj}l)+C~7;8p!vqI');
define('SECURE_AUTH_KEY',   '9`)6N;cRNBBEQG<}6P5zNS*F~#NU| uBsFb$K33-ynxgX1FE=SUP;BF-^@)Bj`CO');
define('LOGGED_IN_KEY',     '~16PA%~YtB1eWEvbozyjv01vo*4`[q3bI,O]I_].#9~S>qZHWgv/F??$=+?>uQ2l');
define('NONCE_KEY',         '))Z3:G![C@Oyb2bi=,OedV,n97J5b2M/Z&IJ*SmK*j/ApHxsRVt.cq|RDsY1mQ,)');
define('AUTH_SALT',         'w?e[S&y@,Pv7qJ&i.3*_I}{&uVm=2%B3AHt3{?PjFwvOQ|vYA^IPTf.^@,vx=d8&');
define('SECURE_AUTH_SALT',  '/wKdAgx=D?{wbw8{Mi-57JG6(+rfS:]MD{Gxp`dWyr^WyCtW]+ihseR]Rmh5p=N*');
define('LOGGED_IN_SALT',    'E(:=@55g ^ODRh9i6>PVRpW4J/u-}70N}7ALGnBey1hg7_#|-@1G<c8g]*|Fp]Q1');
define('NONCE_SALT',        'l`)q2S5Y6rY&%/Q`U,17@KfP)Okc?[Dwxqq,P*X!vh!Lp0/E|cw^d?z6D:F|4FuP');

/*
|--------------------------------------------------------------------------
| MM Unique Hash Cookie
|--------------------------------------------------------------------------
|
| Used to guarantee unique hash cookies
|
*/
define('COOKIEHASH', md5('[:smituser:]'));
define('USER_COOKIE', 'smituser_' . COOKIEHASH);
define('PASS_COOKIE', 'smitpass_' . COOKIEHASH);
define('AUTH_COOKIE', 'smit_' . COOKIEHASH);
define('SECURE_AUTH_COOKIE', 'smit_sec_' . COOKIEHASH);
define('LOGGED_IN_COOKIE', 'smit_logged_in_' . COOKIEHASH);

/*
|--------------------------------------------------------------------------
| Member Type
|--------------------------------------------------------------------------
*/
define('ADMINISTRATOR', 1);
define('PENDAMPING',    2);
define('TENANT',        3);
define('JURI',          4);
define('PENGUSUL',      5);
define('PELAKSANA',     6);

/*
|--------------------------------------------------------------------------
| Member Status
|--------------------------------------------------------------------------
*/
define('NONACTIVE',     0);
define('ACTIVE',        1);
define('BANNED',        2);
define('DELETED',       3);

/*
|--------------------------------------------------------------------------
| Incubation Selection Status
|--------------------------------------------------------------------------
*/
define('NOTCONFIRMED',  0);
define('CONFIRMED',     1);
define('RATED',         2);
define('ACCEPTED',      3);
define('REJECTED',      4);

/*
|--------------------------------------------------------------------------
| Incubation Selection Report Status
|--------------------------------------------------------------------------
*/
define('REPORT_CALLED',     1);
define('REPORT_REJECTED',   0);

/*
|--------------------------------------------------------------------------
| Religion
|--------------------------------------------------------------------------
*/
define('MOSLEM',        1);
define('PROTESTANT',    2);
define('CATHOLIC',      3);
define('HINDU',         4);
define('BUDDHA',        5);
define('KONGHUCHU',     6);

/*
|--------------------------------------------------------------------------
| Gender
|--------------------------------------------------------------------------
*/
define('GENDER_MALE',   'male');
define('GENDER_FEMALE', 'female');

/*
|--------------------------------------------------------------------------
| Step Selection
|--------------------------------------------------------------------------
*/
define('ONE',           1);
define('TWO',           2);

/*
|--------------------------------------------------------------------------
| Password Global
|--------------------------------------------------------------------------
*/
define('PASSWORD_GLOBAL',   '123qwe');

/*
|--------------------------------------------------------------------------
| KKM Score Selection
|--------------------------------------------------------------------------
*/
define('KKM_STEP1',   70);
define('KKM_STEP2',   70);
define('MAX_SCORE',   100);

/*
|--------------------------------------------------------------------------
| Mailer Engine
|--------------------------------------------------------------------------
|
| Swift Mailer Location
|
*/
define('SWIFT_MAILSERVER', realpath(dirname(__FILE__) . '/..') . DIRECTORY_SEPARATOR . '/libraries/swiftmailer/swift_required.php');

/* End of file constants.php */
/* Location: ./application/config/constants.php */