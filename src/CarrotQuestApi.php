<?php

namespace Evgeny\CarrotQuestApiPhpClient;

use Exception;
use GuzzleHttp\Client;

class CarrotQuestApi
{
    const PACKAGE_NAME_FOR_CONSOLE = "\e[33m[ CarrotQuestApiPhpClient ] \n\n\e[0m";

    const API_URL = 'https://api.carrotquest.io/v1/';

    private String $authToken;
    private Int $appId;

    public function __construct(String $authToken, Int $appId)
    {
        try{
            if (!$authToken) {
                throw new Exception(self::PACKAGE_NAME_FOR_CONSOLE . 'Не передан токен');
            } 

            if (!$appId) {
                throw new Exception(self::PACKAGE_NAME_FOR_CONSOLE . 'Не передан id аккаунта');
            } 

            $this->authToken = $authToken;
            $this->appId = $appId;

        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Отправляет запрос
     *
     * @param String $url
     * @param array $data
     * @param String $requestType
     * @return Array
     */
    private function sendRequest(String $url, Array $data = [], String $requestType): Array
    {
        $client = new Client([
            'base_uri' => self::API_URL
        ]);
        
        $formData = array_merge($data, ['auth_token' => $this->authToken]);
        
        $data = [
            'form_params' => $formData
        ];

        $response = $client->$requestType($url, $data);
        $response = $response->getBody()->getContents();

        return json_decode($response, true);
    }
    
    /**
     * Отправляет Post запрос
     *
     * @param String $url
     * @param array $data
     * @return Array
     */
    private function sendRequestPost(String $url, Array $data = []): Array
    {
        return $this->sendRequest($url, $data, 'post');
    }

    /**
     * Отправляет Get запрос
     *
     * @param String $url
     * @param array $data
     * @return Array
     */
    private function sendRequestGet(String $url, Array $data = []): Array
    {
        return $this->sendRequest($url, $data, 'get');
    }
    
    /**
     * Получить пользователей (лидов)
     *
     * @param string $filters
     * @param string $sortProp
     * @param string $sortOrder
     * @param integer $offset
     * @param integer $limit
     * @return Array
     */
    public function getUsers(String $filters = '', String $sortProp = 'last_seen', String $sortOrder = 'desc', Int $offset = 0, Int $limit = 20)
    {
        $url = "apps/{$this->appId}/users";

        $params = [
            'sort_prop' => $sortProp,
            'sort_order' => $sortOrder,
            'offset' => $offset,
            'limit' => $limit
        ];

        if ($filters) $params = array_merge($params, ['filters' => $filters]);

        try{
            $response = $this->sendRequestGet($url, $params);

            return $response['data']['users'];

        } catch (Exception $e)
        {
            return self::PACKAGE_NAME_FOR_CONSOLE . $e->getMessage();
        }
    }   

    /**
     * Получить пользователей (лидов) Рекурсивно
     *
     * @param string $filters
     * @param string $sortProp
     * @param string $sortOrder
     * @param integer $offset
     * @param integer $limit
     * @param array $usersArr
     * @return void
     */
    public function getUsersRecursive(String $filters = '', String $sortProp = 'last_seen', String $sortOrder = 'desc',Int $limit = 20, Array $recursiveData = ['offset' => 0, 'users' => []])
    {
        $offset = $recursiveData['offset'];
        $users = $this->getUsers($filters, $sortProp, $sortOrder, $offset, $limit);
        $recursiveData['users'] = array_merge($recursiveData['users'], $users);

        if(count($users) > 0){
            $recursiveData['offset']++;
            $recursiveData =  $this->getUsersRecursive($filters, $sortProp, $sortOrder, $limit, $recursiveData);
        }

        return $recursiveData;
    }

    /**
     * Получить онлайн-пользователей на сайте
     *
     * @return void
     */
    public function getActiveUsers()
    {
        $url = "/apps/{$this->appId}/activeusers";
        $response = $this->sendRequestGet($url);
        return $response['data'];
    }

    /**
     * Получить диалоги приложения
     *
     * @return void
     */
    public function getConversations()
    {
        $url = "/apps/{$this->appId}/conversations";
    }

    /**
     * Получить диалог
     *
     * @param Int $id
     * @return Array
     */
    public function getConversationsItem(Int $id): Array
    {
        $url = "/conversations/{$id}";
        $response = $this->sendRequestGet($url);
        return $response['data'];
    }

    /**
     * Получить части диалога
     *
     * @param Int $id
     * @param [type] $after
     * @param Int $count
     * @return Array
     */
    public function getConversationsItemPart(Int $id, $after, Int $count): Array
    {
        $url = "/conversations/{$id}/parts";
        $response = $this->sendRequestGet($url, [
            'after' => $after,
            'count' => $count
        ]);

        return $response['data'];
    }

    /**
     * Отметить диалог прочитанным
     *
     * @param Int $id
     * @return String
     */
    public function markreadConversationItem(Int $id): String
    {
        $url = "/conversations/{$id}/markread";
        $response = $this->sendRequestPost($url);
        return $response['meta']['status'];
    }

    /**
     * Получить каналы приложения
     *
     * @return void
     */
    public function getChannels(): Array
    {
        $url = "/apps/{$this->appId}/channels";
        $response = $this->sendRequestGet($url);
        return $response['data'];
    }

    
}