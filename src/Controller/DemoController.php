<?php

namespace Eden\MealOrder\Controller;

use Doctrine\DBAL\Connection;
use Eden\CommunicationStandards\Message\Success;
use Symfony\Component\HttpFoundation\Request;

class DemoController
{
    /** @var  Connection */
    private $connection;

    /**
     * DemoController constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getSomething(Request $request, $valueToGet)
    {
        // the URI being requested (e.g. /about) minus any query parameters
        $request->getPathInfo();

        // retrieve $_GET variables
        $request->query->get('id');
        // retrieve $_POST variables
        $request->request->get('category', 'default category');

        // retrieve $_SERVER variables
        $request->server->get('HTTP_HOST');

        // retrieves an instance of UploadedFile identified by "attachment"
        $request->files->get('attachment');

        // retrieve a $_COOKIE value
        $request->cookies->get('PHPSESSID');

        // retrieve an HTTP request header, with normalized, lowercase keys
        $request->headers->get('host');
        $request->headers->get('content_type');

        $request->getMethod();    // e.g. GET, POST, PUT, DELETE or HEAD
        $request->getLanguages(); // an array of languages the client accepts

        return new Success(['is this what you wanted?' => $valueToGet]);
    }

    public function getUserFromDb($restaurant)
    {
        $sql = "SELECT * FROM menu WHERE restaurant = :restaurant";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('restaurant', $restaurant);
        $stmt->execute();

        $menus = [];
        while($menu = $stmt->fetch()) {
            $menus[] = $menu;
        }

        return new Success($menus);
    }
    public function getAllMenus(){
        $sql = "SELECT * FROM menu";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $menus = [];
        while($menu = $stmt->fetch()) {
            $menus[] = $menu;
        }

        return new Success($menus);
    }
    public function updateName(Request $request, $nameToChange)
    {
        $newName = $request->request->get('newName');
        $count = $this->connection->executeUpdate('UPDATE users SET name = ? WHERE name = ?', [$newName, $nameToChange]);

        return new Success($count);
    }

    public function createSomething(Request $request)
    {
        // retrieve $_POST variables
        $allValuesFromRequestBody = $request->request->all();

        return new Success($allValuesFromRequestBody);
    }
    public function addMenu(Request $request,$menu)
    {
        // retrieve $_POST variables
        $allValuesFromRequestBody = $request->request->all();

        return new Success($allValuesFromRequestBody);
    }


}