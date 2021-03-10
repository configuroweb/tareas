<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_evaluation"><i class="fa fa-plus"></i> Agregar Nueva Evaluación</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Tarea</th>
						<th>Nombre</th>
						<?php if($_SESSION['login_type'] != 1): ?>
						<th>Evaluador</th>
						<?php endif; ?>
						<th width="15%">Rendimiento Promedio</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if($_SESSION['login_type'] == 1)
						$where = " where r.evaluator_id = {$_SESSION['login_id']} ";
					$qry = $conn->query("SELECT r.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name,t.task,concat(ev.lastname,', ',ev.firstname,' ',ev.middlename) as ename,((((r.efficiency + r.timeliness + r.quality + r.accuracy)/4)/5) * 100) as pa FROM ratings r inner join employee_list e on e.id = r.employee_id inner join task_list t on t.id = r.task_id inner join evaluator_list ev on ev.id = r.evaluator_id $where order by concat(e.lastname,', ',e.firstname,' ',e.middlename) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ($row['task']) ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<?php if($_SESSION['login_type'] != 1): ?>
						<td><b><?php echo ucwords($row['ename']) ?></b></td>
						<?php endif; ?>
						<td><b><?php echo number_format($row['pa'],2)."%" ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Acción
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_evaluation" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Ver</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_evaluation&id=<?php echo $row['id'] ?>">Editar</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_evaluation" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Eliminar</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_evaluation').click(function(){
		uni_modal("Detalles de Evaluación","view_evaluation.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_evaluation').click(function(){
	_conf("¿Estás seguro de eliminar esta evaluación?","delete_evaluation",[$(this).attr('data-id')])
	})
	})
	function delete_evaluation($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_evaluation',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Datos Eliminados",'Proceso Exitoso')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>