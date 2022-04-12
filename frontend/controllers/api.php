<?php

/**
 * @SWG\Swagger(
 *     schemes={"https"},
 *     basePath="/summery",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Besplatka safe deal web API Documentation"
 *     ),
 *     consumes={"application/json"},
 *     produces={"text/html", "application/json", "application/xml"},
 * )
 *
 * @SWG\SecurityScheme(
 *      securityDefinition="bearerAuth",
 *      type="apiKey",
 *      name="Authorization",
 *      in="header"
 * )
 */