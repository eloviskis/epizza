<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Lista de Usuários</h4>
                  <p class="card-category"> Administradores do sistema</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cadastro</th>
                        <th>Ações</th>
                      </thead>
                      <tbody>
					  <?php foreach($page['users'] as $user){ ?>
                        <tr>
                          <td><?php echo $user['id']; ?></td>
                          <td><?php echo $user['name']; ?></td>
                          <td><?php echo $user['email']; ?></td>
                          <td><?php echo $user['created_at']; ?></td>
                          <td></td>
                        </tr>
					  <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>