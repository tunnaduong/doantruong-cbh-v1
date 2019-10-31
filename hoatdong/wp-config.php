<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'members' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2+-#JY:wpd}_8N0#3p)W3p/LGL1z4la04B[RS^{NwEom%CnSRUyG~7z=;3xQ=xnI' );
define( 'SECURE_AUTH_KEY',  ')2wI},_HZj PIa!227W|=ITiw)hNU|$ zZQM ^Iax(!2+AS|-Y+[_}I3WAS3,qMA' );
define( 'LOGGED_IN_KEY',    'QPy>9k=;[M$D@@g+jh2zv-9UPKU*;<PH2M,%H%?DP+q(*]wNiXb9cF_n_c{H-8ra' );
define( 'NONCE_KEY',        '&mhw&V/Pp,^KHHbdSS8Enrj.:pPmfq+jT#k8KS0p%&<GcyPMuYC[G3i(~32`:NEp' );
define( 'AUTH_SALT',        'cvzVY/ZYg!2yB[O-FeFK^Y*%_+cT@PEig1H9t3xRBc*QZ&K#Lj{Ru+<,]#DeEW;D' );
define( 'SECURE_AUTH_SALT', 'Rlm[p+M;3??h`O (~pPEXaY{-+ N.8%=_B_[={DVRa:bVd;6ff%i^pIW_5rm!-}S' );
define( 'LOGGED_IN_SALT',   '9g(bt6dnC{cc5)5,kS1NZ;?-Lqd[N{b_Cm1dy90WHsRV(n{ZQHbXAQtawa^vFou7' );
define( 'NONCE_SALT',       '>ZcuT%B+875LIfk5)g[kW^*>GSj{|]15<.o<F/=_kdGx(d`q()fwTx,)RR/5YaCy' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
