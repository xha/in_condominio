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
            $menuItems[] = ['label' => 'Tablas Básicas', 'icon' => 'folder-o', 'url' => '#',
                                'items' => [
                                    ['label' => 'Canon', 'icon' => 'unlock', 'url' => ['../../frontend/web/correl/update?id=1']],
                                    ['label' => 'Pisos', 'icon' => 'folder', 'url' => ['../../frontend/web/piso']],
                                    ['label' => 'Ubicaciones', 'icon' => 'gear', 'url' => ['../../frontend/web/ubicacion']],
                            ],];
            $menuItems[] = ['label' => 'Centro Comercial', 'icon' => 'home', 'url' => ['../../frontend/web/ccomercial']];
            $menuItems[] = ['label' => 'Local', 'icon' => 'star', 'url' => ['../../frontend/web/local']];
            $menuItems[] = ['label' => 'Presupuesto', 'icon' => 'clock-o', 'url' => ['../../frontend/web/presupuesto']];
            $menuItems[] = ['label' => 'Condominio', 'icon' => 'folder', 'url' => ['../../frontend/web/presupuesto/procesar']];
            $menuItems[] = ['label' => 'Arrendamiento', 'icon' => 'lock', 'url' => ['../../frontend/web/presupuesto/arrendamiento']];
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
