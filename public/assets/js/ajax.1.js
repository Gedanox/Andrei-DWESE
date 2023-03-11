/*global fetch*/

let csrf = document.querySelector('meta[name="csrf-token"]').content;

window.addEventListener('load', () => {
    document.getElementById('pagination').addEventListener('click', handleClick);
    fetchData('fetchdata');
});

function fetchData(page) {
    fetch(page)
    .then(function(response) {
        return response.json();
    })
    .then(function(jsonData) {
        //console.log(jsonData);
        showData(jsonData);
    })
    .catch(function(error) {
        console.log(error);
    });
}

function handleClick(e) {
    if (e.target.classList.contains('pulsable')) {
        fetchData(e.target.getAttribute('data-url'));
    }
}

function showData(data) {
    let tbody = document.getElementById('yateAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    // let ajaxnavbar = document.getElementById('ajax-navbar');
    let navbarli = document.querySelectorAll('#ajax-navbar .nav-item');
    navbarli.forEach(li => {
        if (data.user == null) {
            if (li.classList.contains('logged')) {
                li.classList.add('hide');
            } else if(li.classList.contains('not-logged')) {
                li.classList.remove('hide'); 
            }
        } else {
            if (li.classList.contains('logged')) {
                li.classList.remove('hide');
            } else if(li.classList.contains('not-logged')) {
                li.classList.add('hide'); 
            }
        }
        
    });
    let yates = data.yates.data;
    let pagination = data.yates.links;

    //csrf
    console.log(csrf == data.csrf,csrf, data.csrf);

    // table body
    let string = '';
    yates.forEach(yate => {
        let descripcion = yate.descripcion.substring(1, 10);
        string += `
            <tr>
                <td>${yate.id}</td>
                <td>${yate.nombre}</td>
                <td>${yate.tnombre}</td>
                <td>${yate.uname}</td>
                <td>${yate.anombre}</td>
                <td>${descripcion}</td>
                <td>${yate.precio}</td>
            </tr>`
        ;
    });
    tbody.innerHTML = string;

    // pagination
    string = '';
    pagination.forEach(pag => {
        if (pag.active) {
            string += `
                <li class="page-item active" aria-current="page">
                    <span class="page-link pulsable" data-url="${pag.url}">${pag.label}</span>
                </li>
            `;
        } else if (pag.url != null) {
            string += `
                <li class="page-item">
                    <span class="btn btn-link pulsable" data-url="${pag.url}" id="${'pag' + pag.label}">${pag.label}</span>
                </li>
            `;
        } else {
            string += `
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">${pag.label}</span>
                </li>
            `;
        }
    });
    paginationDiv.innerHTML = string;
}