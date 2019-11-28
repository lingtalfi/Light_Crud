[Back to the Ling/Light_Crud api](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud.md)<br>
[Back to the Ling\Light_Crud\CrudRequestHandler\LightCrudRequestHandlerInterface class](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightCrudRequestHandlerInterface.md)


LightCrudRequestHandlerInterface::execute
================



LightCrudRequestHandlerInterface::execute — and throws an exception if a problem occurs.




Description
================


abstract public [LightCrudRequestHandlerInterface::execute](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightCrudRequestHandlerInterface/execute.md)(string $pluginContextIdentifier, string $table, string $action, ?array $params = []) : mixed




Executes the sql request identified by the given arguments,
and throws an exception if a problem occurs.




Parameters
================


- pluginContextIdentifier

    

- table

    

- action

    

- params

    


Return values
================

Returns mixed.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







Source Code
===========
See the source code for method [LightCrudRequestHandlerInterface::execute](https://github.com/lingtalfi/Light_Crud/blob/master/CrudRequestHandler/LightCrudRequestHandlerInterface.php#L23-L23)


See Also
================

The [LightCrudRequestHandlerInterface](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightCrudRequestHandlerInterface.md) class.



