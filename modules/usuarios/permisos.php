<?php
function userHasPermission($userId, $permissionName, $conn) {
    $query = "
        SELECT COUNT(*) as cnt
        FROM tbl_user_roles ur
        JOIN tbl_role_permissions rp ON ur.role_id = rp.role_id
        JOIN permissions p ON rp.permission_id = p.id
        WHERE ur.user_id = ? AND p.permission_name = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $userId, $permissionName);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['cnt'] > 0;
}

// Ejemplo de uso
if (userHasPermission($loggedInUserId, 'create_user', $conn)) {
    include 'insert-update-usuario.php';
} else {
    // El usuario no tiene permiso
    echo "No tienes permiso para crear usuarios.";
}

?>
