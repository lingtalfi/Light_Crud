[Back to the Ling/Light_Crud api](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud.md)



The LightBaseCrudRequestHandler class
================
2019-11-28 --> 2019-11-28






Introduction
============

The LightBaseCrudRequestHandler class.



Class synopsis
==============


class <span class="pl-k">LightBaseCrudRequestHandler</span> implements [LightCrudRequestHandlerInterface](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightCrudRequestHandlerInterface.md), [LightServiceContainerAwareInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerAwareInterface.md) {

- Properties
    - protected string [$pluginName](#property-pluginName) ;
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [$container](#property-container) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/__construct.md)() : void
    - public [setContainer](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [execute](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/execute.md)(string $pluginContextIdentifier, string $table, string $action, ?array $params = []) : mixed
    - protected [executeCreate](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeCreate.md)(string $pluginContextIdentifier, string $table, ?array $params = []) : void
    - protected [executeUpdate](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeUpdate.md)(string $pluginContextIdentifier, string $table, ?array $params = []) : void
    - protected [executeDelete](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeDelete.md)(string $pluginContextIdentifier, string $table, ?array $params = [], ?bool $isMultiple = false) : void
    - protected [checkMicroPermission](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/checkMicroPermission.md)(string $pluginContextIdentifier, string $table, string $action) : void
    - protected [getAllowedTables](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/getAllowedTables.md)() : array
    - protected [getWhereByRics](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/getWhereByRics.md)(array $ricColumns, array $userRics, array &$markers) : string
    - protected [error](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/error.md)(string $msg) : void

}




Properties
=============

- <span id="property-pluginName"><b>pluginName</b></span>

    This property holds the pluginName for this instance.
    
    

- <span id="property-container"><b>container</b></span>

    This property holds the container for this instance.
    
    



Methods
==============

- [LightBaseCrudRequestHandler::__construct](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/__construct.md) &ndash; Builds the LightBaseCrudRequestHandler instance.
- [LightBaseCrudRequestHandler::setContainer](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/setContainer.md) &ndash; Sets the light service container interface.
- [LightBaseCrudRequestHandler::execute](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/execute.md) &ndash; and throws an exception if a problem occurs.
- [LightBaseCrudRequestHandler::executeCreate](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeCreate.md) &ndash; Executes the crud.create request.
- [LightBaseCrudRequestHandler::executeUpdate](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeUpdate.md) &ndash; Executes the crud.update request.
- [LightBaseCrudRequestHandler::executeDelete](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/executeDelete.md) &ndash; Executes the crud.delete request.
- [LightBaseCrudRequestHandler::checkMicroPermission](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/checkMicroPermission.md) &ndash; and throws an exception if that's not the case.
- [LightBaseCrudRequestHandler::getAllowedTables](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/getAllowedTables.md) &ndash; Returns the array of allowed tables.
- [LightBaseCrudRequestHandler::getWhereByRics](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/getWhereByRics.md) &ndash; rics.
- [LightBaseCrudRequestHandler::error](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightBaseCrudRequestHandler/error.md) &ndash; Throws an error message.





Location
=============
Ling\Light_Crud\CrudRequestHandler\LightBaseCrudRequestHandler<br>
See the source code of [Ling\Light_Crud\CrudRequestHandler\LightBaseCrudRequestHandler](https://github.com/lingtalfi/Light_Crud/blob/master/CrudRequestHandler/LightBaseCrudRequestHandler.php)



SeeAlso
==============
Next class: [LightCrudRequestHandlerInterface](https://github.com/lingtalfi/Light_Crud/blob/master/doc/api/Ling/Light_Crud/CrudRequestHandler/LightCrudRequestHandlerInterface.md)<br>