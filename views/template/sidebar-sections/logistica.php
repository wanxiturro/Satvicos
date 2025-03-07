
          <!-- Sidebar Menu -->
          <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a id="m_inicio" href="<?php echo $functions->direct_paginas()."home" ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Inicio</p>
            </a>
          </li>

          <li class="nav-item">
            <a id="m_clientes" href="<?php echo $functions->direct_paginas()."clientes/registro-cliente" ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Clientes</p>
            </a>
          </li>

          <li class="nav-header"></i>____________________________</li>
          <li class="nav-header">LOGÍSTICA</li>
          <li class="nav-item">
            <a id="m_proveedores" href="<?php echo $functions->direct_paginas()."proveedores/registro-proveedor" ?>" class="nav-link">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>Proveedores</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a id="m_almacen" href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Almacén
                <i class="right fas fa-angle-left nav-icon"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="m_registro_producto" href="<?php echo $functions->direct_paginas()."productos/registro-producto" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p>Registro de Producto</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_listado_producto" href="<?php echo $functions->direct_paginas()."productos/listado-producto" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Listado de Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_actualizar_stock" href="<?php echo $functions->direct_paginas()."productos/actualizar-stock" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-warning"></i>
                  <p>Actualizar Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_historial_movimiento" href="<?php echo $functions->direct_paginas()."productos/historial-movimiento" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Historial de Movimientos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-close">
            <a id="m_registro_entrada" href="#" class="nav-link">
              <i class="fa-solid fa-file-import"></i>
              <p>
                Entradas
                <i class="right fas fa-angle-left nav-icon"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="m_entrada" href="<?php echo $functions->direct_paginas()."entradas/entrada-producto" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p>Entradas</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_entrada_listado" href="<?php echo $functions->direct_paginas()."entradas/entrada-listado" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Reportes de entradas</p>
                </a>
              </li>
            </ul>
          </li>
        
          <li class="nav-item has-treeview menu-close">
            <a id="m_registro_salida" href="#" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Salidas
                <i class="right fas fa-angle-left nav-icon"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="m_salidad" href="<?php echo $functions->direct_paginas()."salidas/salida-producto" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p>Salidas</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_salida_listado" href="<?php echo $functions->direct_paginas()."salidas/salida-listado" ?>" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Reporte de salidas</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header"></i>____________________________</li>
          <li class="nav-header"><i class="nav-icon fas fa-layer-group"></i> DATOS</li>

          <li class="nav-item has-treeview menu-close">
            <a id="m_reportes" href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left nav-icon"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a id="m_rpt_clientes" href="<?php echo $functions->direct_paginas()."reportes/clientes" ?>" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                <p>Clientes</p>
              </a>
              </li>
              <li class="nav-item">
                <a id="m_rpt_productos" href="<?php echo $functions->direct_paginas()."reportes/productos" ?>" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_score_ventas" href="<?php echo $functions->direct_paginas()."reportes/score-ventas" ?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Score de Ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_ventas_periodo" href="<?php echo $functions->direct_paginas()."reportes/ventas-periodo" ?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Ventas por Periodo</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="m_gastos_compras" href="<?php echo $functions->direct_paginas()."reportes/gastos-compras" ?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Gastos en Compras</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"></i>____________________________</li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
