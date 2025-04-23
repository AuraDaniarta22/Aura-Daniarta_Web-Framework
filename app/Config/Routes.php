<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contact', 'Contact::index');
$routes->get('/about', 'About::index');
$routes->get('/project', 'Project::index');
$routes->get('/service', 'Service::index');
