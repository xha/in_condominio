<aside class="main-sidebar">

    <section class="sidebar">
    <?php
       if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registrarse', 'icon' => 'file-o', 'url' => ['../../backend/web/site/register']];
            $menuItems[] = ['label' => 'Login', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/login']];
            $menuItems[] = ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']];
        } else {
            $menuItems[] = ['label' => 'Configuración', 'icon' => 'circle-o', 'url' => '#',
                                'items' => [
                                    ['label' => 'Accion', 'icon' => 'check', 'url' => ['../../backend/web/accion']],
                                    ['label' => 'Rol', 'icon' => 'check', 'url' => ['../../backend/web/rol']],
                                    ['label' => 'Rol - Accion', 'icon' => 'check', 'url' => ['../../backend/web/rol-accion']],
                                    ['label' => 'Recuperar Usuario', 'icon' => 'check', 'url' => ['../../backend/web/site/recuperar']],
                                    ['label' => 'Activar Usuario', 'icon' => 'check', 'url' => ['../../backend/web/site/activar']],
                                    ['label' => 'Cambiar Clave', 'icon' => 'check', 'url' => ['../../backend/web/site/cambiar']],
                            ],];
            $menuItems[] = ['label' => 'Pisos', 'icon' => 'folder', 'url' => ['../../frontend/web/piso']];
            $menuItems[] = ['label' => 'Ubicaciones', 'icon' => 'gear', 'url' => ['../../frontend/web/ubicacion']];
            $menuItems[] = ['label' => 'Local', 'icon' => 'star', 'url' => ['../../frontend/web/local']];
            $menuItems[] = ['label' => 'Presupuesto', 'icon' => 'clock-o', 'url' => ['../../frontend/web/presupuesto']];
            $menuItems[] = ['label' => 'Condominio', 'icon' => 'folder-o', 'url' => ['../../frontend/web/presupuesto/procesar']];
            $menuItems[] = ['label' => 'Reportes', 'icon' => 'book', 'url' => '#',
                                'items' => [
                                    ['label' => 'Ordenes', 'icon' => 'check', 'url' => ['../../frontend/web/vw-resumen-orden/reporte-ordenes']],
                                    ['label' => 'Consulta de Orden', 'icon' => 'check', 'url' => ['../../frontend/web/transaccion/consulta-estatus']],
                            ],];
        }
    ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
