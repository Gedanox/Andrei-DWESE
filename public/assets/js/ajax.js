/*global fetch*/

let csrf = document.querySelector('meta[name="csrf-token"]').content;


let orderby;
let ordertype; 
let q;
let search = '';
let string;
let temp;
let tempid;

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
        }
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

function fetchdata2(page) {
    fetch(page, {
        method: 'POST',
        headers: {
            'Accept' : 'application/json',
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrf
        },
            body: JSON.stringify(
                {
                'id' : tempid,
            }),
    })
    .then(function(response) {
        //console.log(response);
        return response.json();
    })
    .then(function(jsonData) {
        //console.log(jsonData);
        showData2(jsonData);
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

function showData(data) {
    let tbody = document.getElementById('itemAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    let items = data.items.data;
    let url = data.url;
    
    let pagination = data.items.links;

    //csrf
    //console.log(csrf == data.csrf,csrf, data.csrf);

    // table body
    string = '';
    items.forEach(item => {
    //console.log(item);
        string += `
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4" id="item/${item.id}"><a class="row g-0" href="#">
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
    items.forEach(item => {
        item.temp = document.getElementById("item/"+item.id);
        item.temp.addEventListener('click', function(){
            //console.log('has presionado item/'+item.id);
            fetchdata2('fetchdata2?q='+item.id);
        });
    });

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

function showData2(data) {
    let tbody = document.getElementById('itemAjaxBody');
    let paginationDiv = document.getElementById('pagination');
    let items = data.items.data[0];
    // table body
    string = '';
    string += `
    <div class="container px-4">
      <div class="row" >
        <div class="col-lg-8 pe-lg-6">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb font-sans-serif py-2 my-1">
                  <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Shop</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Shirts
                  </li>
                </ol>
              </nav>
              <h1 class="fs-3 mb-2">${items.name}</h1>
              <div class="stars d-inline-block">
                <span class="fas fa-star"></span
                ><span class="fas fa-star"></span
                ><span class="fas fa-star"></span
                ><span class="fa-layers fa-fw"
                  ><i class="fas fa-star-half"></i
                  ><i
                    class="far fa-star-half"
                    data-fa-transform="flip-h"
                  ></i></span
                ><span class="far fa-star"></span>
              </div>
              <a
                class="d-inline-block ms-2 text-600 font-sans-serif"
                href="#!"
                >125 customer review</a
              >
            </div>
            <div class="col-12 mt-4">
              <img
                class="rounded img-fluid"
                src="${items.photo}"
                alt=""
              />
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="sticky-top py-6 py-lg-8">
            <div
              class="badge border text-danger border-danger font-sans-serif"
            >
              <span class="fas fa-star me-1"></span>Best Seller
            </div>
            <h2 class="fw-normal">
              ${items.price}€&nbsp;<del class="text-500 fw-light fs-2">free?</del>
            </h2>
            <h6 class="mt-4">Product details</h6>
            <p class="text-600">
              ${items.description}
            </p>
            <h6 class="mt-4">Material &amp; Care</h6>
            <p>Lyocell<br />Machine-wash</p>
            <h6 class="mt-4">Select size</h6>
            <div class="d-flex align-items-center mb-4 me-3">
              <div class="d-sm-flex align-items-center me-3">
                <label class="me-2 mb-0">Sizes</label
                ><select class="form-select font-sans-serif">
                  <option>xs</option>
                  <option>s</option>
                  <option>m</option>
                  <option>l</option>
                  <option>xl</option>
                </select>
              </div>
              <div class="d-sm-flex align-items-center ms-3">
                <label class="me-2 mb-0">Quantity</label
                ><select class="form-select font-sans-serif">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
            <div class="d-grid">
              <a class="btn btn-dark" href="../pages/cart.html"
                >add to cart</a
              >
            </div>
            <a class="fs--1 text-900 d-block mt-4" href="#!">size guide</a
            ><a class="fs--1 text-900 d-block" href="#!"
              >delivery &amp; returns</a
            >
          </div>
        </div>
      </div>
    </div>
    `
    ;
    tbody.innerHTML = string;
    paginationDiv.innerHTML = " ";
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
    //console.log(search);
    q = document.getElementById("q");
    fetchdata('fetchdata?q=' + search);
});



