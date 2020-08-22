          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            

          <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Estadisticas de los Usuarios Por Genero</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <?php
                    $datos1 = null;

                    foreach($rows1 as $row){
                    if($datos1 == null){
                    $datos1 .= $row->cantidad;
                    }else{
                      $datos1 .= ",".$row->cantidad;
                    }
                    }?>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Hombres
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Mujeres
                    </span>
                  </div>
                </div>
              </div>
            </div>

        </div>