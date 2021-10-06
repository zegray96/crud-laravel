function store() {
    axios.get('https://apis.marandu.com.ar/direccion/pais?id=034')
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}


export { store };

