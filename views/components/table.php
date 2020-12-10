<div class="col-6 bg-light border border-dark rounded p-4 ml-5">
    <h4>Tabla usuarios</h4>
    <!-- <button type="button" id="loadTable" class="btn btn-outline-success my-3 float-right">Cargar tabla</button> -->
    <table id="usersTable" class="table table-striped table-bordered mt-2" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="tableBody">
            
        </tbody>
    </table>

    <div class="container-fluid alerta d-none">
            <div class="row position-fixed fixed-bottom">
                <div class="col-6"></div>
                <div class="col-6">
                        <div class="alert alert-success">Usuario eliminado</div>
                </div>
            </div>
    </div>
    <div class="container-fluid alertaError d-none">
            <div class="row position-fixed fixed-bottom">
                <div class="col-6"></div>
                <div class="col-6">
                        <div class="alert alert-success">Usuario eliminado</div>
                </div>
            </div>
    </div>

</div>
