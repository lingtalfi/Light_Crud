<?php


namespace Ling\Light_Crud\CrudRequestHandler;

/**
 * The LightCrudRequestHandlerInterface interface.
 */
interface LightCrudRequestHandlerInterface
{

    /**
     * Executes the sql request identified by the given arguments,
     * and throws an exception if a problem occurs.
     *
     * @param string $pluginContextIdentifier
     * @param string $table
     * @param string $action
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function execute(string $pluginContextIdentifier, string $table, string $action, array $params = []);
}