<div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><?= $button ?></h1>
              </div>
              <form class="user" method="post" action="index.php?c=<?= Database::encryptor('encrypt', 'usuario') ?>&a=<?= Database::encryptor('encrypt', 'crud') ?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" placeholder="Correo del Usuario">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="password" name="password" value="<?= $password ?>" placeholder="Contraseña del Usuario">
                  </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del usuario" value="<?= $nombre ?>">
                </div>
                 <div class="col-sm-6">
                <select name="genero" id="genero" class="form-control">
                      <option <?= $select1 ?> value="Masculino">Masculino</option>
                      <option <?= $select2 ?> value="Femenino">Femenino</option>
                </select>
                </div>
                </div>
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  <?= $button ?>
                </button>
              </form>