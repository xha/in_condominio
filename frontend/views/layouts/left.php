<aside class="main-sidebar">

    <section class="sidebar">
    <?php
       if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registrarse', 'icon' => 'file-o', 'url' => ['../../backend/web/site/register']];
            $menuItems[] = ['label' => 'Login', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/login']];
            $menuItems[] = ['label' => 'Recuperar Usuario', 'icon' => 'unlock', 'url' => ['../../backend/web/site/recuperar']];
        } else {
            $menuItems[] = ['label' => 'Configuración', 'icon' => 'circle-o', 'url' => ['../../backend/web/site/']];
            $menuItems[] = ['label' => 'Tablas Básicas', 'icon' => 'folder-o', 'url' => '#',
                                'items' => [
                                    ['label' => 'Canon', 'icon' => 'check', 'url' => ['../../frontend/web/correl/']],
                                    ['label' => 'Pisos', 'icon' => 'check', 'url' => ['../../frontend/web/piso']],
                                    ['label' => 'Ubicaciones', 'icon' => 'check', 'url' => ['../../frontend/web/ubicacion']],
                            ],];
            $menuItems[] = ['label' => 'Centro Comercial', 'icon' => 'building', 'url' => ['../../frontend/web/ccomercial']];
            $menuItems[] = ['label' => 'Local', 'icon' => 'home', 'url' => ['../../frontend/web/local']];
            $menuItems[] = ['label' => 'Presupuesto', 'icon' => 'clock-o', 'url' => ['../../frontend/web/presupuesto']];
            $menuItems[] = ['label' => 'Condominio', 'icon' => 'archive', 'url' => ['../../frontend/web/presupuesto/procesar']];
            $menuItems[] = ['label' => 'Arrendamiento', 'icon' => 'clone', 'url' => ['../../frontend/web/presupuesto/arrendamiento']];
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
