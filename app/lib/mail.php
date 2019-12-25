<?php
class Mail{
    private static $token;
    private static $username;
    private static $password;
    private static $server;
    private static $port;
    public static function init(){
        include("../config/.mailconfig");
        self::$token = $token;
        self::$username = $username;
        self::$password = $password;
        self::$server = $server;
        self::$port = $port;
    }
    public static function Send($target,$sub,$body,$then=""){
?>
<script src="../asset/js/smtp.js"></script>
    <script>
    Email.send({
        SecureToken: "<?php echo self::$token?>",
        To: '<?php echo $target?>',
        From: "<?php echo self::$username?>",
        Subject: "<?php echo $sub ?>",
        Body: "<?php echo $body?>"
    }).then(
        message => {
            <?php echo $then ?>
        }
    ).catch(e=>console.log(e));
</script>
<?php
    }
}
Mail::init();
Mail::Send("jkt48eater@gmail.com","baru","hai","alert('hai')");
?>