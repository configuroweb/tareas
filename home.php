<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 2): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM department_list ")->num_rows; ?></h3>

                <p>Total de Departmentos</p>
              </div>
              <div class="icon">
                <i class="fa fa-th-list"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM designation_list")->num_rows; ?></h3>

                <p>Total de Cargos</p>
              </div>
              <div class="icon">
                <i class="fa fa-list-alt"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h3>

                <p>Total de Usuarios</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM employee_list")->num_rows; ?></h3>

                <p>Total de Empleados</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-friends"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM evaluator_list")->num_rows; ?></h3>

                <p>Total de Evaluadores</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-secret"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM task_list")->num_rows; ?></h3>

                <p>Total de Tareas</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
            </div>
          </div>
      </div>

<?php else: ?>
   <div class="col-12">
          <div class="card">
            <div class="card-body">
              Bienvenid@ <?php echo $_SESSION['login_name'] ?>!
            </div>
          </div>
      </div>
          
<?php endif; ?>
