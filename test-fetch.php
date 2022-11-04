<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Här är innehållet</h2>
    <div class="jsoncontent"></div>
    <script>
        let jsonData = [];
        
        async function getData() {
            const response = await fetch('https://jsonplaceholder.typicode.com/users/1');
            return response.json();
        }
        
        getData() 
            .then((data) => {
                const el = document.querySelector(".jsoncontent");
                el.innerHTML = JSON.stringify(data);    
                jsonData = data;
                console.log("In .then...");
                console.log(jsonData);
            });
        
        console.log("Outside of async..");
        console.log(jsonData);

    </script>
</body>
</html>