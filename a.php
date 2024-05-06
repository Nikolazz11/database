<?php
    include("conexion.php");
    $sort = isset($_GET['sort']) && strtolower($_GET['sort']) == 'desc' ? 'DESC' : 'ASC';
    $column = isset($_GET['column']) ? $_GET['column'] : 'ID_Empleado';
    $table = isset($_GET['table']) ? $_GET['table'] : 'default_table';
    $consulta = "SELECT * FROM $table ORDER BY $column $sort";
    $resultado = mysqli_query($conexion, $consulta);
    $fields = array_keys(mysqli_fetch_assoc($resultado)); // Get column names
    mysqli_data_seek($resultado, 0); // Reset result set pointer
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Your head content... -->
</head>
<body>
    <header>
        <button onclick="changeTable('table1')">Table 1</button>
        <button onclick="changeTable('table2')">Table 2</button>
        <!-- Add more buttons for more tables... -->
    </header>

    <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <?php foreach ($fields as $field): ?>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <button onclick="sortTable('<?php echo $field; ?>')"><?php echo $field; ?></button>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <?php foreach ($fields as $field): ?>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $fila[$field]; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>