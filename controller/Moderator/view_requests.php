<?php
session_start();

require_once(__DIR__ . '/../../models/RequestModel.php');

$requests = getAllRequests();

include(__DIR__ . '/../../view/moderator/request.php');
?>