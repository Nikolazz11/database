<?php
    include("conexion.php");
    $table = isset($_GET['table']) ? $_GET['table'] : 'default_table';
    $consulta = "SELECT * FROM $table";
    $resultado = mysqli_query($conexion, $consulta);
    $fields = array_keys(mysqli_fetch_assoc($resultado));
    mysqli_data_seek($resultado, 0);

    $sort = isset($_GET['sort']) && strtolower($_GET['sort']) == 'desc' ? 'DESC' : 'ASC';
    $column = isset($_GET['column']) && in_array($_GET['column'], $fields) ? $_GET['column'] : $fields[0];
    $consulta = "SELECT * FROM $table ORDER BY $column $sort";
    $resultado = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function sortTable(column) {
            const url = new URL(window.location.href);
            const sort = url.searchParams.get('sort') === 'asc' ? 'desc' : 'asc';
            url.searchParams.set('sort', sort);
            url.searchParams.set('column', column);
            window.location.href = url.href;
        }
        function changeTable(table) {
            const url = new URL(window.location.href);
            url.searchParams.set('table', table);
            window.location.href = url.href;
        }
    </script>
</head>
<body>
    <header class="bg-gray-800 text-white text-center py-4">
        <button onclick="changeTable('empleados')">Empleados</button>
        <button onclick="changeTable('clientes')">Clientes</button>
        <button onclick="changeTable('productos')">Productos</button>
        <button onclick="changeTable('ventas')">Ventas</button>
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