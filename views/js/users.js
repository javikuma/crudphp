// Datatable
// traer datos desde json -->>   "ajax": "ajax/datatable-productos.ajax.php",
let loadTable = $('#usersTable').DataTable({
    "ajax": "ajax/users.datatable.ajax.php",
    "stateSave": true,
    "ordering": false,
    "language": {
        "sProcessing": 			"Procesando...",
        "sLengthMenu": 			"Mostrar _MENU_ registros",
        "sZeroRecords":  		"No se encontraron resultados",
        "sEmptyTable":        	"Ningun dato disponible en esta tabla",
        "sInfo": 				"Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":  			"Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": 		"(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": 		"",
        "sSearch": 				"Buscar:",
        "sUrl": 				"",
        "sInfoThousands": 		",",
        "sLoadingRecords": 		"Cargando...",
        "oPaginate": {
            "sFirst": 				"<i class='fa fa-fw fa-backward'></i>",
            "sLast": 				"<i class='fa fa-fw fa-forward'></i>",
            "sNext": 				"<i class='fa fa-fw fa-chevron-right'></i>",
            "sPrevious": 			"<i class='fa fa-fw fa-chevron-left'></i>"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente",
        }
    }
    });

// --> END DATATABLE

// GLOBAL VARIABLES
const form = document.querySelector('#form');
const userTable = document.querySelector('#userTable');
const tableBody = document.querySelector('.tableBody');

// ADD USER 
///////////////////////////////
const addUser = ()=>{

    const request = new XMLHttpRequest();

    request.open('POST', 'ajax/users.ajax.php');

    const user = form.user.value;
    const password = form.password.value;
    const name = form.name.value;


    if (validate('new')) {
    
        const params = `user=${user}&password=${password}&name=${name}`;

        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        request.onload = () => {
            loadTable.ajax.url('ajax/users.datatable.ajax.php').load();
            clearForm();
        }
        
        request.send(params);
        
        
    } else {
        return console.log('Error, completar los campos *');
    }
        
} // END ADD USER

// EDIT USER
///////////////////////
const editUser = (tokken) => {

    const request = new XMLHttpRequest();
    request.open('POST', 'ajax/users.ajax.php');

    if (validate('edit')) {

        const user = form.user.value;
        let pass;
        let modify;
        if( form.password.value === ''){
            pass = form.actualPassword.value;
            modify = 'no';
        } else {
            pass = form.password.value;
            modify = 'yes';
        }
        const name = form.name.value;
//2aJNeUxacD4xM
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        const params = `tokkenEdit=${tokken}&userEdit=${user}&passwordEdit=${pass}&nameEdit=${name}&modify=${modify}`;

        request.onload = () => {

            loadTable.ajax.url('ajax/users.datatable.ajax.php').load();
            clearForm();

        }

        request.send(params);

    } else {
        return console.log('Error, completar los campos *');
    }

}// END EDIT USER

// DELETE USER
///////////////////////////
const deleteUser = (id)=>{

    const request = new XMLHttpRequest();

    request.open('POST', 'ajax/users.ajax.php');

    const params = 'id='+id;

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    request.onload = ()=>{

        let data = request.responseText;

        if (data[0] == 'e') {
            
            let alertaError = document.querySelector('.alertaerror');
            alertaError.classList.remove('d-none');

            setTimeout( ()=> {
               alertaError.classList.add('d-none');
            }, 2500);

        }
        
        if(data[0] == 'o') {

            let alerta = document.querySelector('.alerta');
            alerta.classList.remove('d-none');

            setTimeout( ()=> {
               alerta.classList.add('d-none');
            }, 2500);
            
        }

        loadTable.ajax.url('ajax/users.datatable.ajax.php').load();
        
    }

    request.send(params);

}// END DELETE USER

// VIEW USER
/////////////////////////////////
const viewUser = (tokken) => {

    const request = new XMLHttpRequest();
    request.open('POST', 'ajax/users.ajax.php');

    let params = `tokken=${tokken}`;

    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


    request.onload = () => {

        if(document.querySelector('.texto-editando') != null){
            document.querySelector('.texto-editando').remove();
        }

        const data = JSON.parse(request.responseText);

        let tokken = document.querySelector('#tokken');

        form.user.value = data.user;
        form.actualPassword.value = data.password;
        form.name.value = data.name;

        tokken.setAttribute('tokken', data.id);

        const span = document.createElement('span');
        span.classList.add('texto-editando');
        span.classList.add('text-warning');
        const text = document.createTextNode(`Estás editando el usuario: ${data.user}`);
        span.appendChild(text);
        form.before(span);

    }

    request.send(params);

}// END VIEW USER

// VALIDATE FORM
///////////////////////////
const validate = ($arg)=>{
    
    if(form.user.value === ''){
        return false;
    } else 
    if(form.password.value === ''){
        if ($arg === 'edit') {
            return true;
        }
        if($arg === 'new'){
            return false;
        }
    } else
    if(form.name.value === ''){
        return false;
    } else {
        return true;
    }

}// END VALIDATE FORM

// CLEAR FORM
/////////////////////////////
const clearForm = () => {

    form.user.value = '';
    form.password.value = '';
    form.name.value = '';
    form.tokken.setAttribute('tokken','');

    if(document.querySelector('.texto-editando') != null){
        document.querySelector('.texto-editando').remove();
    }
}// END CLEAR FORM



// EVENTS
tableBody.addEventListener('click', (e) => {
    let target = e.target.getAttribute('tipo');
    let id = e.target.getAttribute('idUser');
    if ( target == 'del' ) {

        deleteUser(id);

    }
    if ( target == 'edit' ) {

        const tokken = document.querySelector('#tokken')
        tokken.setAttribute('tokken', id);
        const idTokken = tokken.getAttribute('tokken');
        
        viewUser(id);

     }
 }, false);

 form.addEventListener('submit', (e) => {
    e.preventDefault();
    const tokken = document.querySelector('#tokken');

    if (tokken.getAttribute('tokken') == '' || tokken.getAttribute('tokken') == null) {
    
        console.log('addUser');
        addUser();

    } else {

        console.log('con tokken', tokken.getAttribute('tokken'));
        editUser(tokken.getAttribute('tokken'));

    }
 });

 document.querySelector('.clear').addEventListener('click', ()=> clearForm() );
