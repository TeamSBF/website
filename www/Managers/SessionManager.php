<?php
class SessionManager extends SessionHandler
{
    protected $key, $name, $cookie;

    /**
     * @param $key
     * @param string $name
     * @param array $cookie
     */
    public function __construct($key, $name = "sbfSession", $cookie = [])
    {
        $this->key = $key;
        $this->name = $name;
        $this->cookie = $cookie;

        $this->cookie += [
            'lifetime'  => 0,
            'path'      => ini_get('session.cookie_path'),
            'domain'    => ini_get('session.cookie_domain'),
            'secure'    => isset($_SERVER['HTTPS']),
            'httponly'  => true
        ];

        $this->setup();
    }

    /**
     *
     */
    private function setup()
    {
        ini_set("session.use_cookies", 1);
        ini_set("session.use_only_cookies", 1);

        session_name($this->name);

        session_set_cookie_params(
            $this->cookie['lifetime'],
            $this->cookie['path'],
            $this->cookie['domain'],
            $this->cookie['secure'],
            $this->cookie['httponly']
        );
    }

    /**
     * @return bool
     */
    public function start()
    {
        if(self::is_session_started() === FALSE)
        {
            if(session_start())
            {
                return mt_rand(0, 4) === 0 ? $this->refresh() : true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function forget()
    {
        if(self::is_session_started() === FALSE)
            return false;

        $_SESSION = [];

        setcookie(
            $this->name, '', time() - 42000,
            $this->cookie['path'], $this->cookie['domain'],
            $this->cookie['secure'], $this->cookie['httponly']
        );

        return session_destroy();
    }

    /**
     * @return bool
     */
    public function refresh()
    {
        return session_regenerate_id(true);
    }

    /**
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        return mcrypt_decrypt(MCRYPT_3DES, $this->key, parent::read($id), MCRYPT_MODE_ECB);
    }

    /**
     * @param string $id
     * @param string $data
     * @return bool
     */
    public function write($id, $data)
    {
        return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB));
    }

    /**
     * @param int $ttl
     * @return bool
     */
    public function isExpired($ttl = 30)
    {
        $last = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;

        if($last !== false && time() - $last > $ttl * 60)
            return true;

        $_SESSION['_last_activity'] = time();
        return false;
    }

    /**
     * @return bool
     */
    public function isFingerprint()
    {
        $hash = md5(
            $_SERVER['HTTP_USER_AGENT'] .
            (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
        );

        if(isset($_SESSION['_fingerprint']))
            return $_SESSION['_fingerprint'] === $hash;

        $_SESSION['_fingerprint'] = $hash;
        return true;
    }

    /**
     * @param int $ttl
     * @return bool
     */
    public function isValid($ttl = 30)
    {
        return !$this->isExpired($ttl) && $this->isFingerprint();
    }

    /**
     * @param $name
     * @return null
     */
    public function get($name)
    {
        $parsed = explode('.', $name);
        $result = $_SESSION;

        while($parsed)
        {
            $next = array_shift($parsed);

            if(isset($result[$next]))
                $result = $result[$next];
            else
                return null;
        }

        return $result;
    }

    public function put($name, $value)
    {
        $parsed = explode('.', $name);

        $session =& $_SESSION;

        while(count($parsed) > 1)
        {
            $next = array_shift($parsed);
            if(!isset($session[$next]) || !is_array($session[$next]))
                $session[$next] = [];

            $session =& $session[$next];
        }

        $session[array_shift($parsed)] = $value;
    }

    // http://php.net/session_status#113468
    /**
     *
     */
    private static function is_session_started()
    {
        if(php_sapi_name() !== 'cli')
        {
            if(version_compare(phpversion(), '5.4.0','>='))
            {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            }
            else
            {
                return session_id() === '' ? FALSE : TRUE;
            }
        }

        return FALSE;
    }
}