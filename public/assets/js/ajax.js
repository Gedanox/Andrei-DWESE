/*global fetch*/

let csrf = document.querySelector('meta[name="csrf-token"]').content;


let orderby;
let ordertype; 
let q;
let search = '';
let string;

window.addEventListener('load', () => {
    document.getElementById('pagination').addEventListener('click', handleClick);
    fetchdata('fetchdata');
});

window.onpopstate = function(e) {
    if(e.state) {
        //getPage(e.state.page, e.state.params);
        console.log('page');
        console.log(e.state);
    }
};

function fetchdata(page) {
    fetch(page, {
        method: 'POST',
        headers: {
            'Accept' : 'application/json',
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrf
        },
            body: JSON.stringify(
                {
                'sorting' : q,
            }),
    })
    .then(function(response) {
        //console.log(response);
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
        //console.log(e.target.getAttribute('data-url'));
        fetchdata(e.target.getAttribute('data-url'));
    }
}

/*function showData(data) {
    let tbody = document.getElementById('itemAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    let items = data.items.data;
    
    let pagination = data.items.links;

    //csrf
    //console.log(csrf == data.csrf,csrf, data.csrf);

    // table body
    let string = '';
    items.forEach(item => {
        string += `
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4"><a class="row g-0" href="" data-toggle="modal" data-target="#modalLogin">
          <div class="col-12 overflow-hidden rounded position-relative">
            <div class="hoverbox">
              <div class="row">
                <div class="col"><img class="w-100" src="${item.photo}" alt="" /></div>
              </div>
              <div class="hoverbox-content hoverbox-background">
                <div class="hoverbox-bg d-flex flex-center h-100 w-100"><img class="w-100" src="" alt="" /></div>
              </div>
            </div>
          </div>
          <div class="col-6 mt-2">
            <h5 class="fs-0">${item.name}</h5>
          </div>
          <div class="col-6 mt-2 text-end">
            <h6 class="fw-normal mb-0 d-inline-block">${item.price}€</h6>
          </div></a>
        </div>
        `
        ;
    });
    tbody.innerHTML = string;

    // pagination
    string = '';
    pagination.forEach(pag => {
        if (pag.active) {
            string += `
                <li class="page-item active" aria-current="page">
                    <span class="fakebtn page-link" data-url="${pag.url}">${pag.label}</span>
                </li>
            `;
        } else if (pag.url != null) {
            string += `
                <li class="page-item">
                    <span class="btn page-link pulsable" data-url="${pag.url}" id="${'pag' + pag.label}">${pag.label}</span>
                </li>
            `;
        } else {
            string += `
                <li class="page-item">
                    <span class="fakebtn page-link" aria-hidden="true">${pag.label}</span>
                </li>
            `;
        }
    });
    paginationDiv.innerHTML = string;
}*/

function showData(data) {
    let tbody = document.getElementById('itemAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    let modalsDiv = document.getElementById('modalShow');
    let items = data.items.data;
    let url = data.url;
    
    let pagination = data.items.links;

    //csrf
    //console.log(csrf == data.csrf,csrf, data.csrf);

    // table body
    string = '';
    items.forEach(item => {
        string += `
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4"><a class="row g-0" href="${url}/${item.id}" data-toggle="modal" data-target="#modalProfile">
          <div class="col-12 overflow-hidden rounded position-relative">
            <div class="hoverbox">
              <div class="row">
                <div class="col"><img class="w-100" src="${item.photo}" alt="" /></div>
              </div>
              <div class="hoverbox-content hoverbox-background">
                <div class="hoverbox-bg d-flex flex-center h-100 w-100"><img class="w-100" src="" alt="" /></div>
              </div>
            </div>
          </div>
          <div class="col-6 mt-2">
            <h5 class="fs-0">${item.name}</h5>
          </div>
          <div class="col-6 mt-2 text-end">
            <h6 class="fw-normal mb-0 d-inline-block">${item.price}€</h6>
          </div></a>
        </div>
        `
        ;
    });
    tbody.innerHTML = string;
    
/*    string = '';
    items.forEach(item => {
        string += `
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4 modal fade container"><a class="row g-0">
          Hello world
        </div>
        `
        ;
    });
    modalsDiv.innerHTML = string;*/

    // pagination
    string = '';
    pagination.forEach(pag => {
        if (pag.active) {
            string += `
                <li class="page-item active" aria-current="page">
                    <span class="fakebtn page-link" data-url="${pag.url}">${pag.label}</span>
                </li>
            `;
        } else if (pag.url != null) {
            string += `
                <li class="page-item">
                    <span class="btn page-link pulsable" data-url="${pag.url}" id="${'pag' + pag.label}">${pag.label}</span>
                </li>
            `;
        } else {
            string += `
                <li class="page-item">
                    <span class="fakebtn page-link" aria-hidden="true">${pag.label}</span>
                </li>
            `;
        }
    });
    paginationDiv.innerHTML = string;
}



let price1 = document.getElementById("pasc");

price1.addEventListener('click', function(){
    orderby = 'c2';
    ordertype = 't1'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

let price2 = document.getElementById("pdesc");
price2.addEventListener('click', function(){
    orderby = 'c2';
    ordertype = 't2'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

let name1 = document.getElementById("nasc");
name1.addEventListener('click', function(){
    orderby = 'c1';
    ordertype = 't1'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

let name2 = document.getElementById("ndesc");
name2.addEventListener('click', function(){
    orderby = 'c1';
    ordertype = 't2'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

let newdate = document.getElementById("new");
newdate.addEventListener('click', function(){ 
    orderby = 'c3';
    ordertype = 't2'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

let old = document.getElementById("old");
old.addEventListener('click', function(){
    orderby = 'c3';
    ordertype = 't1'; 
    fetchdata('fetchdata?orderby=' + orderby + '&ordertype=' + ordertype + '&q=' + search);
});

q = document.getElementById("q");
q.addEventListener('keyup', function(){
    search = q.value;
    console.log(search);
    q = document.getElementById("q");
    fetchdata('fetchdata?q=' + search);
});



