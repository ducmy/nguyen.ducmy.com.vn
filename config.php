<?php
// ini_set('include_path', ".:/var/www/vhosts/b-angelheart.jp/httpdocs/www/etc:/var/www/vhosts/b-angelheart.jp/httpdocs/etc:/var/www/vhosts/b-angelheart.jp/httpdocs/lib:/usr/local/share/pear");

ini_set('short_open_tag', 0);
ini_set('display_errors', 1);
error_reporting(2039);

ini_set('mbstring.language', 'Japanese');
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('mbstring.script_encoding', 'UTF-8');
ini_set('mbstring.http_output', 'UTF-8');
ini_set('mbstring.http_input', 'UTF-8');

ini_set('auto_detect_line_endings', 1);
ini_set('output_handler', 'none');
ini_set('mbstring.encoding_translation', 1);
ini_set('mbstring.detect_order', 'auto');
ini_set('mbstring.substitute_character', 'none');
ini_set('magic_quotes_gpc', 0);

ini_set('session.gc_maxlifetime', 604800);
ini_set('session.cookie_lifetime', 604800);

ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid', 0);
ini_set('session.name', 'cwsid');

ini_set('date.timezone', 'Asia/Tokyo');
ini_set('upload_max_filesize', '1280M');
ini_set('post_max_size', '1920M');
ini_set('max_execution_time', 120);
ini_set('max_input_vars', 10000);
ini_set('max_file_uploads', 30);
