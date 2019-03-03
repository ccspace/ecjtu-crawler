<?php
 /*
 * @Author: Megoc
 * @Date: 2019-01-19 11:43:08
 * @Last Modified by: Megoc
 * @Last Modified time: 2019-02-13 11:17:09
 * @Email: megoc@megoc.org
 * @Description: Create by vscode
 */

namespace Megoc\Ecjtu\Traits;

use GuzzleHttp\Client;
use Megoc\Ecjtu\Exceptions\CacheException;
use Symfony\Component\Cache\Simple\FilesystemCache;

trait EducationTrait
{
    /**
     * username
     *
     * @var string
     */
    protected $username = '';
    /**
     * password
     *
     * @var string
     */
    protected $password = '';
    /**
     * uid use as cache key
     *
     * @var string
     */
    protected $uid = '';
    /**
     * cache handler
     *
     * @var \Symfony\Component\Cache\Simple\FilesystemCache
     */
    protected $cache_handler;
    /**
     * a client handler
     *
     * @var \GuzzleHttp\Client
     */
    protected $a_client;
    /**
     * dcp authority client handler
     *
     * @var \GuzzleHttp\Client
     */
    protected $auth_client;

    /**
     * uid
     *
     * @return string
     */
    public function uid(string $uid = '')
    {
        if ($uid) {
            $this->uid = $uid;
            $this->init_http_client_handler($this->uid);
        } else {
            if (empty($this->username) || empty($this->password)) {
                throw new CacheException("Can not generate uid, cause by username or password is null!", -3);
            }

            $this->uid = md5(sha1($this->username . $this->password));
        }

        return $this->uid;
    }
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        $this->cache_handler->delete($this->uid());
    }
    /**
     * 获取有效的学期
     *
     * @return array
     */
    public function terms()
    {
        if (!$this->username) {
            return [];
        }

        $grade = substr($this->username, 0, 4);
        $terms = [];

        for ($i = $grade; $i <= date('Y'); $i++) {

            if ($i != date('Y')) {
                $terms[] = $i . '.1';
                $terms[] = $i . '.2';
            } elseif ($i == date('Y') && date('m') >= 1) {
                $terms[] = $i . '.1';
            }
        }

        return $terms;
    }

    /**
     * init cache handler
     *
     * @param string $namespace
     * @return self
     */
    protected function init_cache_handler(string $namespace = '')
    {
        $this->cache_handler = new FilesystemCache($namespace);

        return $this;
    }
    /**
     * set user form
     *
     * @param array $user
     * @return void
     */
    protected function set_user(array $user)
    {
        if (empty($user) || empty($user['username']) || empty($user['password'])) {
            return;
        }

        $this->username = $user['username'];
        $this->password = $user['password'];
    }

    /**
     * init http client
     *
     * @param string $uid
     * @return void
     */
    protected function init_http_client_handler($uid = '')
    {
        $this->a_client = new Client([
            'base_uri' => self::BASE_URI,
            'timeout' => 10,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
            ],
        ]);

        if (!$uid) {
            return $this->auth_client = $this->a_client;
        }

        if ($this->cache_handler->has($uid)) {
            $this->auth_client = new Client([
                'base_uri' => self::BASE_URI,
                'timeout' => 10,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
                    'Cookie' => $this->cache_handler->get($uid),
                ],
            ]);
        } else {
            throw new CacheException("Can not find authoritied sessionid from local cache!", -30);
        }
    }
}
