<div class="col-5 bg-light border border-dark rounded p-4">
    <h4>Formulario</h4>
    <form class="my-3" id="form" autocomplete="off">
        <input type="hidden" id="tokken" tokken>
        <div class="form-group row">
            <label for="user" class="col-3 col-form-label">Usuario</label>
            <div class="col-9">
                <input type="text" class="form-control" id="user" name="user" placeholder="Ingrese nombre de usuario">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-3 col-form-label">Password</label>
            <div class="col-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese password">
                <input type="hidden" id="actualPassword" name="actualPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-3 col-form-label">Nombre</label>
            <div class="col-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre">
            </div>
        </div>

        <div class="row float-right">
            <div class="col-12">
                <button type="button" class="btn btn-warning clear"><i class="fas fa-broom mr-2"></i>Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Guardar</button>
            </div>
        </div>
    </form>
</div>
