<?php 

function hasAccess($page) {
    $page_role_map = [
        'coffee-beans-management.php' => 'coffeebeansmanagement',
        'customer-management.php' => 'customermanagement',
        'business-management.php' => 'businessmanagement',
        'orders-management.php' => 'ordersmanagement',
        'offer-management.php' => 'offermanagement'
    ];

    if (in_array('superadmin', $_SESSION['admin_role'])) {
        return true;
    }

    $page_role = $page_role_map[$page] ?? null;
    if ($page_role && in_array($page_role, $_SESSION['admin_role'])) {
        return true;
    }

    return false;
}


//function to validate roles
function hasRole($roles, $role) {
    return in_array($role, $roles);
}





?>