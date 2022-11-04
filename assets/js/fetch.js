async function getValues() {
    //let url = "https://ghibliapi.herokuapp.com/people";
    //let url = "https://jsonplaceholder.typicode.com/users";
    let url = "http://localhost/diagram-test/api/v1/api.php?apikey=5519&action=get"
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderUsers() {
    let values = await getValues();
    console.log(values);
    let html = "<ul>";
    if(values.status) {
        values.data.forEach(value => {
            let htmlSegment= `<div class="card col-lg-3 m-2 p-0">
                <div class="card-body">
                    <h4 class="card-title">${value.id}</h2>
                    <p class="card-text">${value.tank_level} (${value.timestamp})</p>
                </div>
                </div>`;
            html += htmlSegment;
        });
    }
    else {
        html = '<h2>There was an error getting the data..</h2>';
    }
    /* 
    users.forEach(user => {
        let htmlSegment = `<div class="card col-lg-3 m-2 p-0">
                             <img class="card-img-top" src="https://via.placeholder.com/200x100?text=${user.name}">
                             <div class="card-body">
                               <h4 class="card-title">${user.name}</h2>
                               <p class="card-text">${user.company.catchPhrase}</p>
                               <a href="email:${user.email}" class="btn btn-primary">Email me..</a>
                            </div>
                        </div>`;
        html += htmlSegment;
    });
    */

    let container = document.querySelector('.row');
    container.innerHTML = html;
}

renderUsers();