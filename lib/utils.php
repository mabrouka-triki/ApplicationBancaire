<?php

function isAdmin() {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        return true;
    }
    header('Location: ?');
    exit;
}

function isConnected() {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        return true;
    }
    header('Location: ?');
    exit;
}