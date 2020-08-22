<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
              <a href="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'edit') ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Crear Usuario</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Nombre</th>
                      <th>Genero</th>
                      <th>Editar</th>
                      <th>Borrar</th>
                      <th>Subir Archivo</th>
                      <th>Mostrar Archivo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($rows as $row){
                    ?>
                    <tr>
                      <td><?= $row->email ?></td>
                      <td><?= $row->password ?></td>
                      <td><?= $row->nombre ?></td>
                      <td><?= $row->genero ?></td>
                      <!-- Editar El Usuario -->
                      <th>
                        <a class="btn btn-primary"  href="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'edit') ?>&id=<?= $row->id ?>">
                          <i class="fa fa-edit"></i>
                        </a>
                      </th>

                      <!-- Eliminar El Usuario -->
                      <th>
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModalEliminar">
                        <i class="fa fa-trash"></i> 
                    	</a>
                      </th>

                      <th>
                        <a class="btn btn-warning"  href="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'upload') ?>&id=<?= Database::encryptor('encrypt', $row->id) ?>">
                        	<i class="fa fa-cloud"></i>
                        </a>
                      </th>
                      <th>
                        <a class="btn btn-info"  href="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'viewDoc') ?>&id=<?= Database::encryptor('encrypt', $row->id) ?>">
                          <i class="fas fa-file-upload"></i>
                        </a>
                      </th>
                    </tr>
                  </tbody>
                  <?php
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>

                  <div class="modal fade" id="logoutModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Borrar El Usuario</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">¿Esta Seguro Que Desea Eliminar Este Usuario?</div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" href="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'delete') ?>&id=<?= $row->id ?>">Eliminar</a>
                      </div>
                    </div>
                  </div>
              </div>