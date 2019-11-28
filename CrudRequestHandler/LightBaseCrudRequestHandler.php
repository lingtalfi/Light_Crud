<?php


namespace Ling\Light_Crud\CrudRequestHandler;


use Ling\Bat\ArrayTool;
use Ling\Light\ServiceContainer\LightServiceContainerAwareInterface;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_Crud\Exception\LightCrudException;
use Ling\Light_Database\Service\LightDatabaseService;
use Ling\Light_DatabaseInfo\Service\LightDatabaseInfoService;
use Ling\Light_MicroPermission\Service\LightMicroPermissionService;


/**
 * The LightBaseCrudRequestHandler class.
 */
class LightBaseCrudRequestHandler implements LightCrudRequestHandlerInterface, LightServiceContainerAwareInterface
{

    /**
     * This property holds the pluginName for this instance.
     * @var string
     */
    protected $pluginName;

    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * Builds the LightBaseCrudRequestHandler instance.
     */
    public function __construct()
    {
        $this->pluginName = null;
    }

    /**
     * @implementation
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @implementation
     */
    public function execute(string $pluginContextIdentifier, string $table, string $action, array $params = [])
    {

        if (false === in_array($table, $this->getAllowedTables())) {
            $this->error("Table not allowed: $table.");
        }
        $this->checkMicroPermission($pluginContextIdentifier, $table, $action);


        switch ($action) {
            case "create":
                $this->executeCreate($pluginContextIdentifier, $table, $params);
                break;
            case "read":
                $this->error("Not implemented yet: action read, with table=$table.");
                break;
            case "update":
                $this->executeUpdate($pluginContextIdentifier, $table, $params);
                break;
            case "delete":
                $this->executeDelete($pluginContextIdentifier, $table, $params);
                break;
            case "deleteMultiple":
                $this->executeDelete($pluginContextIdentifier, $table, $params, true);
                break;
            default:
                break;
        }


    }





    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Executes the crud.create request.
     *
     * @param string $pluginContextIdentifier
     * @param string $table
     * @param array $params
     * @throws \Exception
     */
    protected function executeCreate(string $pluginContextIdentifier, string $table, array $params = [])
    {
        /**
         * @var $dbInfoService LightDatabaseInfoService
         */
        $dbInfoService = $this->container->get("database_info");
        $tableInfo = $dbInfoService->getTableInfo($table);
        $columns = $tableInfo['columns'];

        $userData = $params['data'];
        /**
         * Make sure the user doesn't use the key to do some sql injection.
         */
        $data = ArrayTool::intersect($userData, $columns);

        /**
         * @var $db LightDatabaseService
         */
        $db = $this->container->get("database");
        $db->insert($table, $data);
    }


    /**
     * Executes the crud.update request.
     *
     * @param string $pluginContextIdentifier
     * @param string $table
     * @param array $params
     * @throws \Exception
     */
    protected function executeUpdate(string $pluginContextIdentifier, string $table, array $params = [])
    {

        /**
         * @var $dbInfoService LightDatabaseInfoService
         */
        $dbInfoService = $this->container->get("database_info");
        $tableInfo = $dbInfoService->getTableInfo($table);
        $columns = $tableInfo['columns'];
        $ricStrict = $tableInfo['ricStrict'];


        $userData = $params['data'];
        $userRic = $params['updateRic']; // array of key/value pairs
        /**
         * Make sure the user doesn't use the key to do some sql injection.
         */
        $data = ArrayTool::intersect($userData, $columns);
        /**
         * Make sure the user uses all the ric columns, otherwise he could potentially update more than one row,
         * for instance:
         *
         * update user_has_permission_group where user_id=4 (missing and permission_group_id=xxx)
         *
         *
         */
        ArrayTool::arrayKeyExistAll($ricStrict, $userRic, true);
        $ric = ArrayTool::intersect($userRic, $ricStrict);


        /**
         * @var $db LightDatabaseService
         */
        $db = $this->container->get("database");
        $db->update($table, $data, $ric);
    }


    /**
     * Executes the crud.delete request.
     *
     * @param string $pluginContextIdentifier
     * @param string $table
     * @param array $params
     * @param bool $isMultiple
     * @throws \Exception
     */
    protected function executeDelete(string $pluginContextIdentifier, string $table, array $params = [], bool $isMultiple = false)
    {
        /**
         * @var $dbInfoService LightDatabaseInfoService
         */
        $dbInfoService = $this->container->get("database_info");
        $tableInfo = $dbInfoService->getTableInfo($table);

        /**
         * @var $db LightDatabaseService
         */
        $db = $this->container->get('database');
        $ricStrict = $tableInfo['ricStrict'];

        if (false === $isMultiple) {

            $userRic = $params['ric'];
            ArrayTool::arrayKeyExistAll($ricStrict, $userRic, true);
            $ric = ArrayTool::intersect($userRic, $ricStrict);
            $rics = [$ric];
        } else {
            $userRics = $params['rics'];
            foreach ($userRics as $userRic) {
                ArrayTool::arrayKeyExistAll($ricStrict, $userRic, true);
                $ric = ArrayTool::intersect($userRic, $ricStrict);
                $rics[] = $ric;
            }
        }

        $markers = [];
        $sWhere = $this->getWhereByRics($ricStrict, $rics, $markers);
        $db->delete($table, $sWhere, $markers);
    }


    /**
     *
     * Checks whether the current user has the correct micro permission, based on the given parameters,
     * and throws an exception if that's not the case.
     *
     * @param string $pluginContextIdentifier
     * @param string $table
     * @param string $action
     * @throws \Exception
     */
    protected function checkMicroPermission(string $pluginContextIdentifier, string $table, string $action)
    {
        $microAction = $action;
        if ('deleteMultiple' === $microAction) {
            $microAction = 'delete';
        }
        $microPermission = $this->pluginName . ".tables.$table.$microAction";
        /**
         * @var $microP LightMicroPermissionService
         */
        $microP = $this->container->get("micro_permission");
        if (false === $microP->hasMicroPermission($microPermission)) {
            $this->error("Micro-permission denied: $microPermission.");
        }
    }


    /**
     * Returns the array of allowed tables.
     * @return array
     * @throws \Exception
     */
    protected function getAllowedTables(): array
    {
        /**
         * @var $dbInfoService LightDatabaseInfoService
         */
        $dbInfoService = $this->container->get("database_info");
        return $dbInfoService->getTables();
    }

    /**
     *
     * Returns the where part of an sql query (where keyword excluded) based on the given
     * rics.
     * Also feeds the pdo markers array.
     *
     * It returns a string that looks like this for instance (parenthesis are part of the returned string)):
     *
     * - (
     *      (user_id like '1' AND permission_group_id like '5')
     *      OR (user_id like '3' AND permission_group_id like '4')
     *      ...
     *   )
     *
     *
     * The given rics is an array of ric column names,
     * whereas the given userRics is an array of items, each of which representing a row and
     * being an array of (ric) column to value.
     *
     *
     *
     * @param array $ricColumns
     * @param array $userRics
     * @param array $markers
     * @return string
     */
    protected function getWhereByRics(array $ricColumns, array $userRics, array &$markers): string
    {
        $s = '';
        $markerInc = 1;
        if ($userRics) {
            $s .= '(';
            $c = 0;
            foreach ($userRics as $userRic) {
                if (0 !== $c) {
                    $s .= ' or ';
                }
                $s .= '(';
                $d = 0;
                foreach ($userRic as $col => $val) {
                    if (in_array($col, $ricColumns, true)) {
                        if (0 !== $d) {
                            $s .= ' and ';
                        }
                        $marker = $col . '_' . $markerInc++;
                        $s .= "$col like :$marker";
                        $d++;
                        $markers[$marker] = $val;
                    }
                }

                $s .= ')';
                $c++;
            }
            $s .= ')';
        }
        return $s;
    }


    /**
     * Throws an error message.
     *
     * @param string $msg
     * @throws LightCrudException
     */
    protected function error(string $msg)
    {
        throw new LightCrudException($msg);
    }
}